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
 * The TiffReader class is the dedicated to read a TIFF structure
 *
 * A Tiff structure is formatted as this :
 *  - byte order            : 2 bytes, "II" or "MM", indicates the byte order
 *  - header tag            : 2 bytes, UShort equals 0x002a
 *  - first IFD offset      : 4 bytes, ULong
 *  - IFDs                  :
 *
 * => See IfdReader.class.php & IfdEntryReader.class.php to know more on IFD <==
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 *
 * The TiffReader class is derived from the SegmentReader class.
 *
 * ======> See SegmentReader.class.php to know more about common methods <======
 *
 *
 * This class provides theses public functions :
 *  - getNbIFDs
 *  - getIFDs
 *  - getIFD
 *
 * -----------------------------------------------------------------------------
 */


  require_once(JPEG_METADATA_DIR."Common/ConvertData.class.php");
  require_once(JPEG_METADATA_DIR."Common/Data.class.php");
  require_once(JPEG_METADATA_DIR."Readers/SegmentReader.class.php");
  require_once(JPEG_METADATA_DIR."Readers/IfdReader.class.php");

  class TiffReader extends SegmentReader
  {
    private $IFDs = Array();
    private $offsetData = 0;
    private $byteOrder = BYTE_ORDER_LITTLE_ENDIAN;
    private $firstIFDOffset = 0;

    /**
     * The constructor need the Tiff block datas (given as a Data object) and
     * offset of the TIFF block inside the jpeg file
     *
     * @param Data $data :
     * @param ULong $offsetData (optional) :
     */
    function __construct(Data $data, $offsetData=0)
    {
      parent::__construct($data);

      $this->offsetData = $offsetData;
      $header=$this->data->readASCII(2);

      /*
       * TIFF Header begins wih "II" or "MM" (indicate the byte order)
       * next value is an USHORT, must equals 0x2a
       *
       * all data have to be read with the byte order defined in header
       */
      if($header=="II" or $header="MM")
      {
        $this->byteOrder=$header;
        $this->data->setByteOrder($this->byteOrder);

        $header=$this->data->readUShort();
        if($header==0x002a)
        {
          $this->isValid=true;
          $this->firstIFDOffset=$this->data->readULong();
          $this->readData();
        }
      }
    }

    function __destruct()
    {
      parent::__destruct();
      unset($this->IFDs);
    }

    /**
     * return the number of IFDs found in the Tiff block
     *
     * @return Integer
     */
    public function getNbIFDs()
    {
      return(count($this->IFDs));
    }

    /**
     * return an array of IFD found in the the Tiff block
     *
     * @return IFD[]
     */
    public function getIFDs()
    {
      return($this->IFDs);
    }

    /**
     * returns a specific IFD
     *
     * @param Integer $num : index of the needed IFD
     * @return IFD
     */
    public function getIFD($num)
    {
      if($num>=0 and $num<count($this->IFDs))
        return($this->IFDs[$num]);
      else
        return(null);
    }

    public function toString()
    {
      $returned="TIFF block offset: ".sprintf("%08x", $this->offsetData).
                " ; byteOrder: ".$this->byteOrder.
                " ; isValid: ".($this->isValid?"Y":"N").
                " ; isLoaded: ".($this->isValid?"Y":"N").
                " ; IFDs: ".count($this->IFDs).
                " ; first IFD Offset: ".sprintf("0x%04x", $this->firstIFDOffset);
      return($returned);
    }

    /**
     * The readData function read IFDs from the Tiff block, and add them into
     * the IFDs array
     */
    private function readData()
    {
      $nextIFD = $this->firstIFDOffset;
      /*
       * while the next IFD offset is not zero, read the IFD at the designed
       * offset
       *
       * the next IFD offset is given at the end of the last IFD read.
       */
      while($nextIFD!=0)
      {
        $this->data->seek($nextIFD);
        $IFD = new IfdReader($this->data->readASCII(), $nextIFD, $this->byteOrder);
        $this->IFDs[]=$IFD;
        $nextIFD = $IFD->getNextIFDOffset();
        unset($IFD);
      }
    }
  }


?>
