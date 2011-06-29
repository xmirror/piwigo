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
 * The Data class is used to read Strings content like files
 *
 * The class manages automaticaly the offset allowing to read sequentially the
 * datas
 *  - Opening a new String reset the offset to zero.
 *  - Reading data moves the offset to the next byte
 *
 *
 * -----------------------------------------------------------------------------
 *
 * This class provides theses public functions :
 *  - getLength
 *  - getByteOrder
 *  - setByteOrder
 *  - clear
 *  - setData
 *  - seek
 *  - eod
 *  - bod
 *  - offset
 *  - seekPush
 *  - seekPop
 *  - readUByte
 *  - readSByte
 *  - readUShort
 *  - readSShort
 *  - readULong
 *  - readSLong
 *  - readURational
 *  - readSRational
 *  - readASCII
 *
 * -----------------------------------------------------------------------------
 */

  require_once(JPEG_METADATA_DIR."Common/Const.class.php");
  require_once(JPEG_METADATA_DIR."Common/ConvertData.class.php");

  class Data
  {
    private $data = "";
    private $byteOrder;
    private $offset=0;
    private $length;
    private $startOffset = 0;
    private $currentPos = Array();

    /**
     * The constructor needs datas, and optionaly the byteOrder (by default,
     * assuming the byte order is little endian)
     *
     * offset is set to zero when the object is instancied
     *
     * @param String $data                 : datas
     * @param String $byteOrder (optional) : a valid byte order value (uses the
     *                                       BYTE_ORDER const)
     *
     */
    function __construct($data, $byteOrder = BYTE_ORDER_LITTLE_ENDIAN)
    {
      $this->setData($data);
      $this->byteOrder = $byteOrder;
    }

    function __destruct()
    {
      unset($this->byteOrder);
      unset($this->offset);
      unset($this->length);
      unset($this->startOffset);
      unset($this->data);
      unset($this->currentPos);
    }

    /**
     * returns the datas length
     *
     * @return ULong
     */
    public function getLength()
    {
      return($this->length);
    }

    /**
     * returns the byte order
     *
     * @return String
     */
    public function getByteOrder()
    {
      return($this->byteOrder);
    }


    /**
     * set the byte order
     *
     * @param String $value : a valid byte order value
     * @return String
     */
    public function setByteOrder($value)
    {
      if($value==BYTE_ORDER_BIG_ENDIAN or
         $value==BYTE_ORDER_LITTLE_ENDIAN) $this->byteOrder=$value;
      return($this->byteOrder);
    }

    /**
     * clear the datas
     */
    public function clear()
    {
      $this->setData("");
    }

    /**
     * set the datas and reset the offset to zero
     *
     * @param String $data : the datas
     */
    public function setData($data)
    {
      $this->data = $data;
      $this->length=strlen($data);
      $this->seek();
      unset($this->currentPos);
      $this->currentPos=Array();
    }


    /**
     * seek the given offset
     *
     * if offset is not specified, or offset is less than zero, assuming to seek
     * on the offset zero
     *
     * if offset is greater than the data length, assuming to seek on the last
     * byte
     *
     *
     * @param ULong $offset : offset to seek on
     */
    public function seek($offset=0)
    {
      if($offset<0)
      {
        $this->offset=0;
      }
      elseif($offset>$this->length)
      {
        $this->offset=$this->length;
      }
      else
      {
        $this->offset=$offset;
      }
    }

    /**
     * returns true if the offset is on the last data byte
     *
     * @return Boolean
     */
    public function eod()
    {
      return($this->offset>=$this->length);
    }

    /**
     * returns true if the offset is on the first data byte (zero)
     *
     * @return Boolean
     */
    public function bod()
    {
      return($this->offset==0);
    }

    /**
     * returns the current offset
     *
     * @return ULong
     */
    public function offset()
    {
      return($this->offset);
    }

    /**
     * Memorize the current offset by pushing it in a stack
     */
    public function seekPush()
    {
      $this->currentPos[]=$this->offset;
    }

    /**
     * Restore the last pushed offset on the stack
     * If there is nothing in the stack, returns -1
     *
     * @return ULong
     */
    public function seekPop()
    {
      if(count($this->currentPos)>0)
        $this->seek(array_pop($this->currentPos));
      else return(-1);
    }

    /**
     * Read an unsigned byte from the data
     *
     * If offset is given, reading data from the given offset
     * If offset is not given, reading data from the current offset, and
     * increment it (+1)
     *
     * @param ULong $offset (optional) : optional offset
     * @return UByte
     */
    public function readUByte($offset=null)
    {
      if(is_null($offset))
      {
        $offset=$this->offset;
        $this->offset+=ByteType::$typeSizes[ByteType::UBYTE];
      }

      if($offset+ByteType::$typeSizes[ByteType::UBYTE]>$this->length) return(0);

      return(ConvertData::toUbyte(substr($this->data,$offset,ByteType::$typeSizes[ByteType::UBYTE])));
    }

    /**
     * Read a signed byte from the data
     *
     * If offset is given, reading data from the given offset
     * If offset is not given, reading data from the current offset, and
     * increment it (+1)
     *
     * @param ULong $offset (optional) : optional offset
     * @return SByte
     */
    public function readSByte($offset=null)
    {
      if(is_null($offset))
      {
        $offset=$this->offset;
        $this->offset+=ByteType::$typeSizes[ByteType::SBYTE];
      }

      if($offset+ByteType::$typeSizes[ByteType::SBYTE]>$this->length) return(0);

      return(ConvertData::toSbyte(substr($this->data,$offset,ByteType::$typeSizes[ByteType::SBYTE])));
    }

    /**
     * Read an unsigned Short from the data
     *
     * If offset is given, reading data from the given offset
     * If offset is not given, reading data from the current offset, and
     * increment it (+2)
     *
     * @param ULong $offset (optional) : optional offset
     * @return UShort
     */
    public function readUShort($offset=null)
    {
      if(is_null($offset))
      {
        $offset=$this->offset;
        $this->offset+=ByteType::$typeSizes[ByteType::USHORT];
      }

      if($offset+ByteType::$typeSizes[ByteType::USHORT]>$this->length) return(0);

      return(ConvertData::toUShort(substr($this->data, $offset,ByteType::$typeSizes[ByteType::USHORT]), $this->byteOrder));
    }

    /**
     * Read a signed Short from the data
     *
     * If offset is given, reading data from the given offset
     * If offset is not given, reading data from the current offset, and
     * increment it (+2)
     *
     * @param ULong $offset (optional) : optional offset
     * @return SShort
     */
    public function readSShort($offset=null)
    {
      if(is_null($offset))
      {
        $offset=$this->offset;
        $this->offset+=ByteType::$typeSizes[ByteType::SSHORT];
      }

      if($offset+ByteType::$typeSizes[ByteType::SSHORT]>$this->length) return(0);

      return(ConvertData::toSShort(substr($this->data, $offset,ByteType::$typeSizes[ByteType::SSHORT]), $this->byteOrder));
    }

    /**
     * Read an unsigned Long from the data
     *
     * If offset is given, reading data from the given offset
     * If offset is not given, reading data from the current offset, and
     * increment it (+4)
     *
     * @param ULong $offset (optional) : optional offset
     * @return ULong
     */
    public function readULong($offset=null)
    {
      if(is_null($offset))
      {
        $offset=$this->offset;
        $this->offset+=ByteType::$typeSizes[ByteType::ULONG];
      }

      if($offset+ByteType::$typeSizes[ByteType::ULONG]>$this->length) return(0);

      return(ConvertData::toULong(substr($this->data, $offset,ByteType::$typeSizes[ByteType::ULONG]), $this->byteOrder));
    }

    /**
     * Read a signed Long from the data
     *
     * If offset is given, reading data from the given offset
     * If offset is not given, reading data from the current offset, and
     * increment it (+4)
     *
     * @param ULong $offset (optional) : optional offset
     * @return SLong
     */
    public function readSLong($offset=null)
    {
      if(is_null($offset))
      {
        $offset=$this->offset;
        $this->offset+=ByteType::$typeSizes[ByteType::SLONG];
      }

      if($offset+ByteType::$typeSizes[ByteType::SLONG]>$this->length) return(0);

      return(ConvertData::toSLong(substr($this->data, $offset,ByteType::$typeSizes[ByteType::SLONG]), $this->byteOrder));
    }

    /**
     * Read an unsigned Rational from the data
     *
     * If offset is given, reading data from the given offset
     * If offset is not given, reading data from the current offset, and
     * increment it (+8)
     *
     * @param ULong $offset (optional) : optional offset
     * @return URational
     */
    public function readURational($offset=null)
    {
      if(is_null($offset))
      {
        $offset=$this->offset;
        $this->offset+=ByteType::$typeSizes[ByteType::URATIONAL];
      }
      if($offset+ByteType::$typeSizes[ByteType::URATIONAL]>$this->length) return(0);

      return(ConvertData::toURational(substr($this->data, $offset,ByteType::$typeSizes[ByteType::URATIONAL]), $this->byteOrder));
    }

    /**
     * Read a signed Rational from the data
     *
     * If offset is given, reading data from the given offset
     * If offset is not given, reading data from the current offset, and
     * increment it (+8)
     *
     * @param ULong $offset (optional) : optional offset
     * @return SRational
     */
    public function readSRational($offset=null)
    {
      if(is_null($offset))
      {
        $offset=$this->offset;
        $this->offset+=ByteType::$typeSizes[ByteType::SRATIONAL];
      }

      if($offset+ByteType::$typeSizes[ByteType::SRATIONAL]>$this->length) return(0);

      return(ConvertData::toSRational(substr($this->data, $offset,ByteType::$typeSizes[ByteType::SRATIONAL]), $this->byteOrder));
    }

    /**
     * Read a string from the data
     *
     * If length is given, read a number of char equals to the length
     * If length is not given, or length is negative, read all char from the
     * offset to the data length
     *
     * If offset is given, reading data from the given offset
     * If offset is not given, reading data from the current offset, and
     * increment it by the number of char readed
     *
     * @param ULong $length (optional) : optional length
     * @param ULong $offset (optional) : optional offset
     * @return String
     */

    public function readASCII($length=-1, $offset=null)
    {
      if($length<=0) $length=$this->length;

      if(is_null($offset))
      {
        $offset=$this->offset;
        $this->seek($this->offset+$length);
      }

      //if($offset+$length>$this->length) return("");

      return(substr($this->data, $offset,$length));
    }

    public function readFloat($offset=null)
    {
    }

    public function readDouble($offset=null)
    {
    }

  }


?>
