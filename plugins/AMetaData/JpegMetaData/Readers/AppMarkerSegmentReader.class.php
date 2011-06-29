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
 * The AppMarkerSegmentReader is a class for reading the segment of a Jpeg file
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 * The class can recognize many kind of segments, but the content is not
 * analyzed for all of them.
 *
 * If you want to implement new functionnality to read segment, you must start
 * here.
 *
 * Datas are exploited only for the segments :
 *  - APP1  : for Exif IFDs & Xmp datas
 *  - APP13 : for 8BIM Iptc blocks
 *  - COM   : comments block
 *
 *
 * This class provides theses public functions :
 *  - (static) read
 *  - (static) isValidMarkerHeader
 *  - (static) markerName
 *  - getHeader
 *  - getOffset
 *  - getLength
 *  - getSubType
 *  - dataLoaded
 *  - getData
 *
 *  Read the code for help
 *
 * -----------------------------------------------------------------------------
 *
 */

  require_once(JPEG_METADATA_DIR."Common/ConvertData.class.php");
  require_once(JPEG_METADATA_DIR."Common/Data.class.php");

  require_once(JPEG_METADATA_DIR."Readers/TiffReader.class.php");
  require_once(JPEG_METADATA_DIR."Readers/XmpReader.class.php");
  require_once(JPEG_METADATA_DIR."Readers/IptcReader.class.php");
  require_once(JPEG_METADATA_DIR."Readers/ComReader.class.php");

  class AppMarkerSegmentReader
  {
    const SEGMENT_HEAD  = 0xFF;
    const SEGMENT_APP0  = 0xE0;
    const SEGMENT_APP1  = 0xE1;
    const SEGMENT_APP2  = 0xE2;
    const SEGMENT_APP3  = 0xE3;
    const SEGMENT_APP4  = 0xE4;
    const SEGMENT_APP5  = 0xE5;
    const SEGMENT_APP6  = 0xE6;
    const SEGMENT_APP7  = 0xE7;
    const SEGMENT_APP8  = 0xE8;
    const SEGMENT_APP9  = 0xE9;
    const SEGMENT_APP10 = 0xEA;
    const SEGMENT_APP11 = 0xEB;
    const SEGMENT_APP12 = 0xEC;
    const SEGMENT_APP13 = 0xED;
    const SEGMENT_APP14 = 0xEE;
    const SEGMENT_APP15 = 0xEF;

    const SEGMENT_SOF0  = 0xC0;  // Start Of Frame - Baseline DCT (huffman)
    const SEGMENT_SOF1  = 0xC1;  // Start Of Frame - Extended sequential DCT (huffman)
    const SEGMENT_SOF2  = 0xC2;  // Start Of Frame - Progressive DCT (huffman)
    const SEGMENT_SOF3  = 0xC3;  // Start Of Frame - Spatial (Lossless) DCT (Huffman)
    const SEGMENT_SOF5  = 0xC5;  // Start Of Frame - Differential sequential DCT (Huffman)
    const SEGMENT_SOF6  = 0xC6;  // Start Of Frame - Progressive sequential DCT (Huffman)
    const SEGMENT_SOF7  = 0xC7;  // Start Of Frame - Differential spatial DCT (Huffman)
    const SEGMENT_SOF9  = 0xC9;  // Start Of Frame - Extended sequential DCT (arithmetic)
    const SEGMENT_SOFA  = 0xCA;  // Start Of Frame - Progressive DCT (arithmetic)
    const SEGMENT_SOFB  = 0xCB;  // Start Of Frame - Spatial (lossless) DCT (arithmetic)
    const SEGMENT_SOFD  = 0xCD;  // Start Of Frame - Differential sequential DCT (arithmetic)
    const SEGMENT_SOFE  = 0xCE;  // Start Of Frame - Differential progressive DCT (arithmetic)
    const SEGMENT_SOFF  = 0xCF;  // Start Of Frame - Differential lossless (arithmetic)

    const SEGMENT_DQT   = 0xDB;  // Define Quantization Table
    const SEGMENT_DHT   = 0xC4;  // Define Huffman Tables
    const SEGMENT_JPG   = 0xC8;  // Reserved for JPEG extensions
    const SEGMENT_DAC   = 0xCC;  // Arithmetic Conditionning info
    const SEGMENT_SOS   = 0xDA;  // Start Of Scan
    const SEGMENT_DRI   = 0xDD;  // Define Restart Interval
    const SEGMENT_COM   = 0xFE;  // Comment



    const UNKNOWN          = "?";

    /*
     * APP0 SubTypes
     */
    const APP0_JFIF        = "JFIF";
    const APP0_JFXX        = "JFXX";
    const APP0_CIFF        = "CIFF";
    const APP0_AVI1        = "AVI1";

    /*
     * APP1 SubTypes
     */
    const APP1_EXIF        = "EXIF";
    const APP1_XMP         = "XMP";
    const APP1_EXTENDEDXMP = "ExtendedXMP";

    /*
     * APP2 SubTypes
     */
    const APP2_ICCPROFILE  = "ICC Profile";
    const APP2_FPXR        = "FlashPix";
    const APP2_MPF         = "MPF";
    const APP2_SAMSUNGLP   = "Samsung large preview";

    /*
     * APP3 SubTypes
     */
    const APP3_META        = "Meta";
    const APP3_STIM        = "Stim";

    /*
     * APP4 SubTypes
     */
    const APP4_SCALADO     = "Scalado";

    /*
     * APP5 SubTypes
     */
    const APP5_RMETA       = "Ricoh Meta";

    /*
     * APP6 SubTypes
     */
    const APP6_EPPIM       = "EPPIM";
    const APP6_NITF        = "NITF";

    /*
     * APP8 SubTypes
     */
    const APP8_SPIFF       = "SPIFF";

    /*
     * APP10 SubTypes
     */
    const APP10_COMMENT    = "Comment";

    /*
     * APP12 SubTypes
     */
    const APP12_PICTUREINFO = "PictureInfo";
    const APP12_DUCKY      = "Ducky";

    /*
     * APP13 SubTypes
     */
    const APP13_PHOTOSHOP  = "Photoshop";
    const APP13_ADOBECM    = "Adobe CM";

    /*
     * APP14 SubTypes
     */
    const APP14_ADOBE      = "Adobe";

    /*
     * APP15 SubTypes
     */
    const APP15_GRAPHICCONVERTER = "GraphicConverter";

    /*
     * Other SubTypes
     */
    const SOF0 = "Start Of Frame - Baseline DCT (huffman)";
    const SOF1 = "Start Of Frame - Extended sequential DCT (huffman)";
    const SOF2 = "Start Of Frame - Progressive DCT (huffman)";
    const SOF3 = "Start Of Frame - Spatial (Lossless) DCT (Huffman)";
    const SOF5 = "Start Of Frame - Differential sequential DCT (Huffman)";
    const SOF6 = "Start Of Frame - Progressive sequential DCT (Huffman)";
    const SOF7 = "Start Of Frame - Differential spatial DCT (Huffman)";
    const SOF9 = "Start Of Frame - Extended sequential DCT (arithmetic)";
    const SOFA = "Start Of Frame - Progressive DCT (arithmetic)";
    const SOFB = "Start Of Frame - Spatial (lossless) DCT (arithmetic)";
    const SOFD = "Start Of Frame - Differential sequential DCT (arithmetic)";
    const SOFE = "Start Of Frame - Differential progressive DCT (arithmetic)";
    const SOFF = "Start Of Frame - Differential lossless (arithmetic)";
    const DHT  = "Define Huffman Tables";
    const JPG  = "Reserved for JPEG extensions";
    const DAC  = "Arithmetic Conditionning info";
    const SOS  = "Start Of Scan";
    const DRI  = "Define Restart Interval";
    const COM  = "Comment";
    const DQT  = "Define Quantization Table";



    private $header = 0xFF;
    private $offset = 0;
    private $length = 0;
    private $subType = "";
    private $data = NULL;
    private $dataLoaded = false;
    private $workData = NULL;


    /**
     * try to read a marker at the designed offset
     *
     * @param handler $fileHandler : a handler on an opened and valid file
     *
     * @param ULong $offset : where start reading the segment in the file
     *
     * @return false if there is no marker at this offset, otherwise returns an
     * instance of a new AppMarkerSegmentReader object
     */
    static public function read($fileHandler, $offset)
    {
      /* if end of file, return false */
      if(feof($fileHandler)) return(false);

      fseek($fileHandler, $offset);
      $header=ConvertData::toUByte(fread($fileHandler, 1));

      /*
       * each segment header start with 0xFF
       *
       * if the reader byte equals 0xFF, read the next byte.
       * the next byte must equals one of the defined segment headers (between
       * the first and last valid segments)
       *
       * if the segment is valid, the next 2 bytes determine the size of the
       * segment, excluding the header, but including the segment size
       *
       */
      if($header==self::SEGMENT_HEAD)
      {
        $header=ConvertData::toUByte(fread($fileHandler, 1));
        if(self::isValidMarkerHeader($header))
        {
          $length=ConvertData::toUShort(fread($fileHandler, 2), BYTE_ORDER_BIG_ENDIAN);
          /*
           * inside a segment, length include the 2 byte designed for the length
           * size, so to read the associated data, needs to read length-2bytes
           *
           * the length exclude the 2bytes needed for the header identifier
           *
           */
          $datas=fread($fileHandler, $length-2);

          switch($header)
          {
            case self::SEGMENT_APP0:
              if(preg_match('/^JFIF\x00/',$datas)>0)
              {
                $subType=self::APP0_JFIF;
              }
              elseif(preg_match('/^JFXX\x00\x10/',$datas)>0)
              {
                $subType=self::APP0_JFXX;
              }
              elseif(preg_match('/^(II|MM).{4}HEAPJPGM/s',$datas)>0)
              {
                $subType=self::APP0_CIFF;
              }
              elseif(preg_match('/^AVI1/s',$datas)>0)
              {
                $subType=self::APP0_AVI1;
              }
              else
              {
                $subType=self::UNKNOWN;
              }
              break;
            case self::SEGMENT_APP1:
              if(preg_match('/^Exif\x00\x00/',$datas)>0)
              {
                $subType=self::APP1_EXIF;
                $datas = substr($datas, 6);
              }
              elseif(preg_match('/^http:\/\/ns.adobe.com\/xmp\/extension\/\x00/',$datas)>0)
              {
                $subType=self::APP1_EXTENDEDXMP;
              }
              elseif(preg_match('/^(http:\/\/|<exif:)/',$datas)>0)
              {
                $subType=self::APP1_XMP;
              }
              else
              {
                $subType=self::UNKNOWN;
              }
              break;
            case self::SEGMENT_APP2:
              if(preg_match('/^ICC_PROFILE\x00/',$datas)>0)
              {
                $subType=self::APP2_ICCPROFILE;
              }
              elseif(preg_match('/^FPXR\x00/',$datas)>0)
              {
                $subType=self::APP2_FPXR;
              }
              elseif(preg_match('/^MPF\x00/',$datas)>0)
              {
                $subType=self::APP2_MPF;
              }
              elseif(preg_match('/^\xff\xd8\xff\xdb/',$datas)>0)
              {
                $subType=self::APP2_SAMSUNGLP;
              }
              else
              {
                $subType=self::UNKNOWN;
              }
              break;
            case self::SEGMENT_APP3:
              if(preg_match('/^(Meta|META|Exif)\x00\x00/',$datas)>0)
              {
                $subType=self::APP3_META;
              }
              elseif(preg_match('/^Stim\x00/',$datas)>0)
              {
                $subType=self::APP3_STIM;
              }
              else
              {
                $subType=self::UNKNOWN;
              }
              break;
            case self::SEGMENT_APP4:
              if(preg_match('/^SCALADO\x00/',$datas)>0)
              {
                $subType=self::APP4_SCALADO;
              }
              else
              {
                $subType=self::UNKNOWN;
              }
              break;
            case self::SEGMENT_APP5:
              if(preg_match('/^RMETA\x00/',$datas)>0)
              {
                $subType=self::APP5_RMETA;
              }
              else
              {
                $subType=self::UNKNOWN;
              }
              break;
            case self::SEGMENT_APP6:
              if(preg_match('/^EPPIM\x00/',$datas)>0)
              {
                $subType=self::APP6_EPPIM;
              }
              elseif(preg_match('/^NTIF\x00/',$datas)>0)
              {
                $subType=self::APP6_NTIF;
              }
              else
              {
                $subType=self::UNKNOWN;
              }
              break;
            case self::SEGMENT_APP7:
              $subType=self::UNKNOWN;
              break;
            case self::SEGMENT_APP8:
              if(preg_match('/^SPIFF\x00/',$datas)>0)
              {
                $subType=self::APP8_SPIFF;
              }
              else
              {
                $subType=self::UNKNOWN;
              }
              break;
            case self::SEGMENT_APP9:
              $subType=self::UNKNOWN;
              break;
            case self::SEGMENT_APP10:
              if(preg_match('/^UNICODE\x00/',$datas)>0)
              {
                $subType=self::APP10_COMMENT;
              }
              else
              {
                $subType=self::UNKNOWN;
              }
              break;
            case self::SEGMENT_APP11:
              $subType=self::UNKNOWN;
              break;
            case self::SEGMENT_APP12:
              if(preg_match('/^(\[picture info\]|Type=)/',$datas)>0)
              {
                $subType=self::APP12_PICTUREINFO;
              }
              elseif(preg_match('/^Ducky/',$datas)>0)
              {
                $subType=self::APP12_DUCKY;
              }
              else
              {
                $subType=self::UNKNOWN;
              }
              break;
            case self::SEGMENT_APP13:
              if(preg_match('/^(Photoshop 3.0\0|Adobe_Photoshop2.5)/',$datas)>0)
              {
                $subType=self::APP13_PHOTOSHOP;
              }
              elseif(preg_match('/^Adobe_CM/',$datas)>0)
              {
                $subType=self::APP13_ADOBECM;
              }
              else
              {
                $subType=self::UNKNOWN;
              }
              break;
            case self::SEGMENT_APP14:
              if(preg_match('/^Adobe/',$datas)>0)
              {
                $subType=self::APP14_ADOBE;
              }
              else
              {
                $subType=self::UNKNOWN;
              }
              break;
            case self::SEGMENT_APP15:
              if(preg_match('/^Q\s*(\d+)/',$datas)>0)
              {
                $subType=self::APP15_GRAPHICCONVERTER;
              }
              else
              {
                $subType=self::UNKNOWN;
              }
              break;
            case self::SEGMENT_DQT:
                $subType=self::DQT;
              break;
            case self::SEGMENT_SOF0:
                $subType=self::SOF0;
              break;
            case self::SEGMENT_SOF1:
                $subType=self::SOF1;
              break;
            case self::SEGMENT_SOF2:
                $subType=self::SOF2;
              break;
            case self::SEGMENT_SOF3:
                $subType=self::SOF3;
              break;
            case self::SEGMENT_SOF5:
                $subType=self::SOF5;
              break;
            case self::SEGMENT_SOF6:
                $subType=self::SOF6;
              break;
            case self::SEGMENT_SOF7:
                $subType=self::SOF7;
              break;
            case self::SEGMENT_SOF9:
                $subType=self::SOF9;
              break;
            case self::SEGMENT_SOFA:
                $subType=self::SOFA;
              break;
            case self::SEGMENT_SOFB:
                $subType=self::SOFB;
              break;
            case self::SEGMENT_SOFD:
                $subType=self::SOFD;
              break;
            case self::SEGMENT_SOFE:
                $subType=self::SOFE;
              break;
            case self::SEGMENT_SOFF:
                $subType=self::SOFF;
              break;
            case self::SEGMENT_DHT:
                $subType=self::DHT;
              break;
            case self::SEGMENT_JPG:
                $subType=self::JPG;
              break;
            case self::SEGMENT_DAC:
                $subType=self::DAC;
              break;
            case self::SEGMENT_SOS:
                $subType=self::SOS;
              break;
            case self::SEGMENT_DRI:
                $subType=self::DRI;
              break;
            case self::SEGMENT_COM:
                $subType=self::COM;
                break;
            default:
              /* in other case, return an new object Marker */
              $subType=self::UNKNOWN;
          }
          return(new AppMarkerSegmentReader($header, $offset, $length+2, $subType, $datas));
        }
      }

      return(false);
    }

    /**
     * returns true if the given segment marker is a known segment
     *
     * @param UByte $value : the identifier of the segment
     * @return Boolean
     */
    static function isValidMarkerHeader($value)
    {
      if($value==self::SEGMENT_HEAD or
         $value==self::SEGMENT_APP0 or
         $value==self::SEGMENT_APP1 or
         $value==self::SEGMENT_APP2 or
         $value==self::SEGMENT_APP3 or
         $value==self::SEGMENT_APP4 or
         $value==self::SEGMENT_APP5 or
         $value==self::SEGMENT_APP6 or
         $value==self::SEGMENT_APP7 or
         $value==self::SEGMENT_APP8 or
         $value==self::SEGMENT_APP9 or
         $value==self::SEGMENT_APP10 or
         $value==self::SEGMENT_APP11 or
         $value==self::SEGMENT_APP12 or
         $value==self::SEGMENT_APP13 or
         $value==self::SEGMENT_APP14 or
         $value==self::SEGMENT_APP15 or
         $value==self::SEGMENT_SOF0 or
         $value==self::SEGMENT_SOF1 or
         $value==self::SEGMENT_SOF2 or
         $value==self::SEGMENT_SOF3 or
         $value==self::SEGMENT_SOF5 or
         $value==self::SEGMENT_SOF6 or
         $value==self::SEGMENT_SOF7 or
         $value==self::SEGMENT_SOF9 or
         $value==self::SEGMENT_SOFA or
         $value==self::SEGMENT_SOFB or
         $value==self::SEGMENT_SOFD or
         $value==self::SEGMENT_SOFE or
         $value==self::SEGMENT_SOFF or
         $value==self::SEGMENT_DHT  or
         $value==self::SEGMENT_JPG  or
         $value==self::SEGMENT_DAC  or
         $value==self::SEGMENT_SOS  or
         $value==self::SEGMENT_DRI  or
         $value==self::SEGMENT_COM  or
         $value==self::SEGMENT_DQT)
      {
        return(true);
      }
      return(false);
    }

    /**
     * returns the name of the given segment
     *
     * @param UByte $value : the identifier of the segment
     *
     * @return String
     */
    static function markerName($value)
    {
      switch($value)
      {
        case self::SEGMENT_APP0:
          return("APP0");
        case self::SEGMENT_APP1:
          return("APP1");
        case self::SEGMENT_APP2:
          return("APP2");
        case self::SEGMENT_APP3:
          return("APP3");
        case self::SEGMENT_APP4:
          return("APP4");
        case self::SEGMENT_APP5:
          return("APP5");
        case self::SEGMENT_APP6:
          return("APP6");
        case self::SEGMENT_APP7:
          return("APP7");
        case self::SEGMENT_APP8:
          return("APP8");
        case self::SEGMENT_APP9:
          return("APP9");
        case self::SEGMENT_APP10:
          return("APP10");
        case self::SEGMENT_APP11:
          return("APP11");
        case self::SEGMENT_APP12:
          return("APP12");
        case self::SEGMENT_APP13:
          return("APP13");
        case self::SEGMENT_APP14:
          return("APP14");
        case self::SEGMENT_APP15:
          return("APP15");
        case self::SEGMENT_DQT:
          return("DQT");
        case self::SEGMENT_SOF0:
          return("SOF0");
        case self::SEGMENT_SOF1:
          return("SOF1");
        case self::SEGMENT_SOF2:
          return("SOF2");
        case self::SEGMENT_SOF3:
          return("SOF3");
        case self::SEGMENT_SOF5:
          return("SOF5");
        case self::SEGMENT_SOF6:
          return("SOF6");
        case self::SEGMENT_SOF7:
          return("SOF7");
        case self::SEGMENT_SOF9:
          return("SOF9");
        case self::SEGMENT_SOFA:
          return("SOFA");
        case self::SEGMENT_SOFB:
          return("SOFB");
        case self::SEGMENT_SOFD:
          return("SOFD");
        case self::SEGMENT_SOFE:
          return("SOFE");
        case self::SEGMENT_SOFF:
          return("SOFF");
        case self::SEGMENT_DHT:
          return("DHT");
        case self::SEGMENT_JPG:
          return("JPG");
        case self::SEGMENT_DAC:
          return("DAC");
        case self::SEGMENT_SOS:
          return("SOS");
        case self::SEGMENT_DRI:
          return("DRI");
        case self::SEGMENT_COM:
          return("COM");
        default:
          return(sprintf("%02x", $value));
      }
    }


    /**
     *
     *
     * @param UByte $header   : the identifier of the segment
     *
     * @param ULong $offset   : offset of the segment in the jpeg file
     *
     * @param UShort $length  : size of the segment, including the header and
     *                          including the segment size (4bytes)
     *
     * @param String $subType : the subtype of the segment (for example an APP1
     *                          segment can have EXIF or XMP datas)
     *
     * @param String $data    : the raw data of the segment, excluding the
     *                          segment size and header
     *
     */
    function __construct($header, $offset, $length, $subType, $data)
    {
      $this->header = $header;
      $this->offset = $offset;
      $this->length = $length;
      $this->subType = $subType;
      $this->workData = new Data($data);

      $this->readData();

      $this->workData->clear();
    }

    function __destruct()
    {
      unset($this->workData);
      unset($this->data);
      unset($this->header);
      unset($this->offset);
      unset($this->length);
      unset($this->subType);
      unset($this->dataLoaded);
    }

    /**
     * returns the identifiant of the segment (see the consts SEGMENT_xxxxxx for
     * to know the list)
     *
     * @return UByte
     */
    public function getHeader()
    {
      return($this->header);
    }


    /**
     * returns the offset of the segment in the jpeg file
     *
     * @return ULong
     */
    public function getOffset()
    {
      return($this->offset);
    }

    /**
     * returns the length of the segment, including the segment header and the
     * segment size (4 bytes)
     *
     * @return UShort
     */
    public function getLength()
    {
      return($this->length);
    }

    /**
     * returns the subtype of the segment
     *
     * @return String
     */
    public function getSubType()
    {
      return($this->subType);
    }

    /**
     * returns true if the segment data has been loaded
     *
     * @return Boolean
     */
    public function dataLoaded()
    {
      return($this->dataLoaded);
    }

    /**
     * returns the data of the segment.
     *
     * @return depends on the segment subtype
     */
    public function getData()
    {
      return($this->data);
    }


    /**
     * read the segment datas
     */
    private function readData()
    {
      switch($this->header)
      {
        case self::SEGMENT_APP0:
          /* not implemented */
          break;
        case self::SEGMENT_APP1:
          $this->readSegmentAPP1();
          break;
        case self::SEGMENT_APP2:
          /* not implemented */
          break;
        case self::SEGMENT_APP3:
          /* not implemented */
          break;
        case self::SEGMENT_APP4:
          /* not implemented */
          break;
        case self::SEGMENT_APP5:
          /* not implemented */
          break;
        case self::SEGMENT_APP6:
          /* not implemented */
          break;
        case self::SEGMENT_APP7:
          /* not implemented */
          break;
        case self::SEGMENT_APP8:
          /* not implemented */
          break;
        case self::SEGMENT_APP9:
          /* not implemented */
          break;
        case self::SEGMENT_APP10:
          /* not implemented */
          break;
        case self::SEGMENT_APP11:
          /* not implemented */
          break;
        case self::SEGMENT_APP12:
          /* not implemented */
          break;
        case self::SEGMENT_APP13:
          $this->readSegmentAPP13();
          break;
        case self::SEGMENT_APP14:
          /* not implemented */
          break;
        case self::SEGMENT_APP15:
          /* not implemented */
          break;
        case self::SEGMENT_COM:
          $this->readSegmentCOM();
          break;
        default:
          break;
      }
    }

    /**
     *  read the content of an "APP1" segment
     */
    private function readSegmentAPP1()
    {
      switch($this->subType)
      {
        case self::APP1_EXIF:
          $this->data = new TiffReader($this->workData, $this->offset+10);
          $this->dataLoaded=true;
          break;
        case self::APP1_XMP:
          $this->data = new XmpReader($this->workData->readASCII());
          $this->dataLoaded=true;
          break;
        case self::APP1_EXTENDEDXMP:
          /* When Xmp data size exceed 65458 bytes, the Xmp tree is splited.
           * Each chunk is written into the JPEG file within a separate APP1
           * marker segment.
           *
           * Each ExtendedXMP marker segment contains:
           *  - A null-terminated signature string of "http://ns.adobe.com/xmp/extension/".
           *  - A 128-bit GUID stored as a 32-byte ASCII hex string, capital A-F,
           *    no null termination. The GUID is a 128-bit MD5 digest of the
           *    full ExtendedXMP serialization
           *  - The full length of the ExtendedXMP serialization as a 32-bit
           *    unsigned integer
           *  - The offset of this portion as a 32-bit unsigned integer.
           *  - The portion of the ExtendedXMP
           *
           * Each chunck is returned as an array :
           *  - 'uid'    => the 128-bit GUID
           *  - 'offset' => the offset
           *  - 'data'   => xmp data packet
           *
           * Xmp Tree is rebuilded after all extendedXmp chunks are loaded, by
           * the class calling the AppMarkerSegmentReader class (the JpegReader
           * class)
           */

          $this->workData->setByteOrder(BYTE_ORDER_BIG_ENDIAN);
          $this->data=Array(
            'uid'    => $this->workData->readASCII(32, 35),
            'offset' => $this->workData->readULong(71),
            'data'   => $this->workData->readASCII(-1, 75)
          );

          $this->dataLoaded=true;
          break;
        default:
          break;
      }
    }

    /**
     *  read the content of an "APP13" segment
     */
    private function readSegmentAPP13()
    {
      switch($this->subType)
      {
        case self::APP13_PHOTOSHOP:
          $this->data = new IptcReader($this->workData->readASCII());
          $this->dataLoaded=true;
          break;
        case self::APP13_ADOBECM:
          break;
        default:
          break;
      }
    }

    /**
     *  read the content of an "COM" segment
     */
    private function readSegmentCOM()
    {
      $this->data = new ComReader($this->workData->readASCII());
      $this->dataLoaded=true;
    }

    public function toString()
    {
      $returned="Header: 0xff".sprintf("%02x", $this->header)." (".self::markerName($this->header).")".
                " ; offset: 0x".sprintf("%08x", $this->offset).
                " ; length: 0x".sprintf("%04x", $this->length).
                " ; subType: ".$this->subType;
      return($returned);
    }


  }


 ?>
