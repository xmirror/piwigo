<?php
/*
 * --:: JPEG MetaDatas ::-------------------------------------------------------
 *
 *  Author    : Grum
 *   email    : grum at piwigo.org
 *   website  : http://photos.grum.fr
 *
 *   << May the Little SpaceFrog be with you ! >>
 *
 * +-----------------------------------------------------------------------+
 * | JpegMetaData - a PHP based Jpeg Metadata manager                      |
 * +-----------------------------------------------------------------------+
 * | Copyright(C) 2010  Grum - http://www.grum.fr                          |
 * +-----------------------------------------------------------------------+
 * | This program is free software; you can redistribute it and/or modify  |
 * | it under the terms of the GNU General Public License as published by  |
 * | the Free Software Foundation                                          |
 * |                                                                       |
 * | This program is distributed in the hope that it will be useful, but   |
 * | WITHOUT ANY WARRANTY; without even the implied warranty of            |
 * | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU      |
 * | General Public License for more details.                              |
 * |                                                                       |
 * | You should have received a copy of the GNU General Public License     |
 * | along with this program; if not, write to the Free Software           |
 * | Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, |
 * | USA.                                                                  |
 * +-----------------------------------------------------------------------+
 *
 *
 * -----------------------------------------------------------------------------
 *
 * The JpegReader is the class for reading a Jpeg file
 *
 * Datas provided by this class are less friendly than data provided by the
 * JpegMetaData class, because here you have to know the Jpeg format to
 * understand how to exploit datas
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 * The JpegReader class use a dedicated AppMarkerSegmentReader class rather than
 * the php "getimagesize()" function because the php function returns an
 * associative array of markers like ("APP1" => "......", "APPx" => "......")
 *
 * Typically a jpeg file contains XMP data inside an APP1 marker, like the exif
 * codes. So, when using the php function, APP1 with XMP values isn't present
 * (only the first APP1 segment found and used for EXIF is present)
 *
 *
 * A Jpeg file normally begins with the 2 bytes FFD8 (the SOI marker) and ends
 * with the 2 bytes FFD9 (the EOI marker)
 * Some file have extra data after the EOI marker ; for now, the class can't
 * manage this kind of file.
 *
 * The class use the AppMarkerSegmentReader class to get the content of :
 *  - APP1 marker  => Exif, XMP
 *  - APP13 marker => Iptc
 *
 * This class provides theses public functions :
 *  - load
 *  - getFileName
 *  - isLoaded
 *  - isValid
 *  - countAppMarkerSegments
 *  - getAppMarkerSegments
 *
 *  Read the code for help
 *
 * -----------------------------------------------------------------------------
 */

  require_once(JPEG_METADATA_DIR."Readers/AppMarkerSegmentReader.class.php");

  class JpegReader
  {
    /**
     * start of image file tag
     */
    const JPEG_SOI = 0xFFD8;
    /**
     * end of image file tag
     */
    const JPEG_EOI = 0xFFD9;
    /**
     * start of scan tag
     */
    const JPEG_SOS = 0xFFDA;


    private $fileName = "";
    private $isLoaded = false;
    private $isValid = false;
    private $appMarkerSegmentReader = Array();

    private $fileHandler = false;

    /**
     * the constructor need an optional filename
     *
     * if no filename is given, you can use the "load" function after the object
     * is instancied
     *
     * @Param String $fileName (optional)
     *
     */
    function __construct($fileName = "")
    {
      if($fileName!="") $this->load($fileName);
    }

    function __destruct()
    {
      unset($this->appMarkerSegmentReader);
      unset($this->fileHandler);
      unset($this->fileName);
    }

    /**
     * load a file
     *
     * @Param String $fileName
     *
     */
    public function load($fileName)
    {
      /*
       * initialize values
       *
       * if the file isn't a valid file, theses properties will not be in an
       * uncertain state
       */
      $this->isLoaded=false;
      $this->fileName="";
      $this->isValid = false;
      $this->appMarkerSegmentReader=Array();

      /*
       * if the file exist, try to open it
       * determine if the file is a valid JPEG file
       *
       * if the file is valid, read the markers and close the file
       */
      if(file_exists($fileName))
      {
        $this->fileName=$fileName;

        $this->fileHandler = fopen($fileName, "r");
        if($this->fileHandler)
        {
          $this->isValid = $this->isAValidFile();

          if($this->isValid)
          {
            $this->readAppMarkerSegments();
            $this->processSpecialAppMarkerSegments();
            $this->isLoaded=true;
          }

          fclose($this->fileHandler);
          return(true);
        }
        return(false);
      }
      return(false);
    }

    /**
     *
     * this function try to see if the given file is a valid jpg file (the file
     * must begins with the SOI and ends with the EOI)
     *
     */
    protected function isAValidFile()
    {
      fseek($this->fileHandler, -2, SEEK_END);
      $header=fread($this->fileHandler, 2);
      $haveEOI=(ConvertData::toUShort($header, BYTE_ORDER_BIG_ENDIAN) == self::JPEG_EOI);

      // look if 2 first bytes of file are SOI
      fseek($this->fileHandler, 0);
      $header=fread($this->fileHandler, 2);
      if(ConvertData::toUShort($header, BYTE_ORDER_BIG_ENDIAN) == self::JPEG_SOI)
      {
        //if file have EOI, it seems to be a valid JPEG file
        if($haveEOI) return(true);

        // otherwise, try to find SOS
        while(!feof($this->fileHandler))
        {
          $header=ConvertData::toUShort(fread($this->fileHandler, 2), BYTE_ORDER_BIG_ENDIAN);

          if($header==self::JPEG_EOI or $header==self::JPEG_SOS )
          {
            //seems to be a valid JPEG file
            return(true);
          }
          elseif($header>>8==0xFF)
          {
            //seems to be a valid marker, jump to next marker...
            $sizeBlock=ConvertData::toUShort(fread($this->fileHandler, 2), BYTE_ORDER_BIG_ENDIAN);
            fseek($this->fileHandler, $sizeBlock-2, SEEK_CUR);
          }
          else
          {
            // not a marker, not e JPEG file
            return(false);
          }
        }
      }
      return(false);
    }

    /**
     *
     * This function reads all the segment of the jpeg file
     *
     */
    private function readAppMarkerSegments()
    {
      /*
       * loop to read all markers
       */
      $offset=2;
      while(true)
      {
        $marker=AppMarkerSegmentReader::read($this->fileHandler, $offset);
        if($marker)
        {
          /*
           * if there is a marker returned, push it on the markers array
           */
          $this->appMarkerSegmentReader[]=$marker;
          $offset+=$marker->getLength();
          unset($marker);
        }
        else
        {
          /*
           * if there is no marker returned (end of file ?) stop markers loading
           */
          return(false);
        }
      }

    }


    /**
     *
     * This function process special APP marker segment
     *
     * At now, only the extendedXmp segment are managed
     *
     */
    protected function processSpecialAppMarkerSegments()
    {
      /*
       * process APP extendedXmp segment
       *
       * 1/ read all APP segment and find APP1/EXTENDEDXMP segments
       * 2/ sort APP1/EXTENDEDXMP segments by UID+OFFSET
       * 3/ merge segment data
       * 4/ build a new AppMarkerSegmentReader (as an APP1_XMP segement)
       */
      $extendedXmp=Array();
      foreach($this->appMarkerSegmentReader as $marker)
      {
        if($marker->getHeader()==AppMarkerSegmentReader::SEGMENT_APP1 and
           $marker->getSubType()==AppMarkerSegmentReader::APP1_EXTENDEDXMP)
        {
          $extendedXmp[]=$marker->getData();
        }
      }
      usort($extendedXmp, Array(&$this, "sortExtendedXmp"));

      $xmp="";
      foreach($extendedXmp as $marker)
      {
        $xmp.=$marker['data'];
      }

      $marker=new AppMarkerSegmentReader(
        AppMarkerSegmentReader::SEGMENT_APP1,
        0,
        strlen($xmp),
        AppMarkerSegmentReader::APP1_XMP,
        "http://ns.adobe.com/xap/1.0/\x00".$xmp
      );

      if($marker)
      {
        /*
         * if there is a marker returned, push it on the markers array
         */
        $this->appMarkerSegmentReader[]=$marker;
        unset($marker);
      }
      unset($extendedXmp);
      unset($xmp);
    }

    /**
     * This function is used to sort the extendedXmp segments
     */
    protected function sortExtendedXmp($a, $b)
    {
      if (($a['uid'].$a['offset']) == ($b['uid'].$b['offset']))
      {
        return(0);
      }
      return((($a['uid'].$a['offset']) < ($b['uid'].$b['offset'])) ? -1 : 1);
    }


    /**
     *
     * returns the filename given to the object
     *
     */
    public function getFileName()
    {
      return($this->fileName);
    }

    /**
     *
     * returns true if the given jpeg file has been succesfully loaded
     *
     */
    public function isLoaded()
    {
      return($this->isLoaded);
    }

    /**
     *
     * returns true if the given jpeg file is a valid file
     *
     */
    public function isValid()
    {
      return($this->isValid);
    }

    /**
     *
     * returns the number od segments loaded
     *
     */
    public function countAppMarkerSegments()
    {
      return(count($this->appMarkerSegmentReader));
    }

    /**
     *
     * returns an array of AppMarkerSegments
     *
     * see the AppMarkerSegmentsReader.class.php for more informations
     *
     */
    public function getAppMarkerSegments()
    {
      return($this->appMarkerSegmentReader);
    }

  }


 ?>
