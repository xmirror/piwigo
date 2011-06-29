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
 * The IfdEntryReader class is the class dedicated to read IFD entries
 *
 * ======> See IfdReader.class.php to know more about an IFD structure <========
 *
 *
 * An entry is made with 12 bytes
 *  2 bytes (UShort) : tag id
 *  2 bytes (UShort) : data format
 *  4 bytes (ULong)  : component size
 *  4 bytes          : value, or offset is value size is higher than 4bytes
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 * This class provides theses public functions :
 *  - getTagId
 *  - getTypeName
 *  - getValue
 *  - getSize
 *  - getType
 *  - isOffset
 *  - getExtraDataOffset
 *  - getRaw
 *  - getTag
 *
 */

  require_once(JPEG_METADATA_DIR."Common/ConvertData.class.php");
  require_once(JPEG_METADATA_DIR."Common/Tag.class.php");

  class IfdEntryReader
  {
    private $raw = "\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00";
    private $byteOrder = BYTE_ORDER_LITTLE_ENDIAN;

    private $type = ByteType::UNKNOWN;
    private $typeName = "Unknown";

    private $size = 0;

    private $isOffset = false;
    private $extraDataOffset = 0;

    private $tag = null;

    /**
     *
     * the constructor needs :
     *  - raw data, the 12 bytes of the IFD entry
     *  - the byte order of TIFF segment
     *  - the segment data, allowing to acces the extra data
     *  - the segment data offset, allowing to compute the relative offset
     *  - the tags definitions (a KnonwTags derived object)
     *
     * @param String $data
     * @param String $byteOrder
     * @param String $segmentData
     * @param ULong $segmentDataOffset
     * @param KnownTags $tagDef
     */
    function __construct($data, $byteOrder, $segmentData, $segmentDataOffset, $TagDef)
    {
      $this->tag=new Tag();

      if(strlen($data)>=12)
      {
        $this->tag->setId(ConvertData::toUShort($data, $byteOrder));

        $this->byteOrder = $byteOrder;
        $this->raw   = substr($data,0,12);
        $this->type  = ConvertData::toUShort(substr($data, 2), $this->byteOrder);
        $this->size  = ConvertData::toULong(substr($data, 4), $this->byteOrder);


        if(!isset(ByteType::$typeSizes[$this->type]))
        {
          /*
           * invalid IFD marker type ?
           * process it as dummy
           */
          $this->tag->setValue(0);
        }
        else
        {
          /*
           * the entry value is stored in 4 bytes
           * if the entry type size multiplied by the entry size is greater than 4
           * it means that the entry value is an offset
           */
          $numBytes = $this->size * ByteType::$typeSizes[$this->type];

          if($numBytes>4)
          {
            $this->isOffset = true;
            $this->extraDataOffset = ConvertData::toULong(substr($data, 8), $this->byteOrder);
            $this->tag->setValue($this->extractExtraData(new Data($segmentData->readASCII($this->size*ByteType::$typeSizes[$this->type], $this->extraDataOffset - $segmentDataOffset), $this->byteOrder), $this->byteOrder));
          }
          else
          {
            $this->tag->setValue($this->extractExtraData(new Data(substr($data,8), $this->byteOrder)));
          }
        }

        switch($this->type)
        {
          case ByteType::UBYTE :
            $this->typeName = "unsigned Byte (int8u)";
            break;
          case ByteType::ASCII :
            $this->typeName = "ASCII";
            break;
          case ByteType::USHORT :
            $this->typeName = "unsigned Short (int16u)";
            break;
          case ByteType::ULONG :
            $this->typeName = "unsigned Long (int32u)";
            break;
          case ByteType::URATIONAL :
            $this->typeName = "unsigned Rational (int32u int32u)";
            break;
          case ByteType::UNDEFINED :
            $this->typeName = "Undefined";
            break;
          case ByteType::SBYTE :
            $this->typeName = "Signed Byte (int8s)";
            break;
          case ByteType::SSHORT :
            $this->typeName = "Signed Short (int16s)";
            break;
          case ByteType::SLONG :
            $this->typeName = "Signed Long (int32s)";
            break;
          case ByteType::SRATIONAL :
            $this->typeName = "Signed Rational (int32s int32s)";
            break;
          case ByteType::FLOAT :
            $this->typeName = "Float";
            break;
          case ByteType::DOUBLE :
            $this->typeName = "Double";
            break;
          default:
            $this->typeName = "Unknown";
            break;
        }
        //Array size...
        $this->typeName.="[".$this->size."]";
      }
    }

    function __destruct()
    {
      unset($this->tag);
    }

    /**
     * return the tag id
     *
     * @return UShort
     */
    public function getTagId()
    {
      return($this->tag->getId());
    }

    /**
     * return the name of the data type
     *
     * @return String
     */
    public function getTypeName()
    {
      return($this->typeName);
    }

    /**
     * return the raw value
     *
     * @return type depends of the type of the tag
     */
    public function getValue()
    {
      return($this->tag->getValue());
    }

    /**
     * return the tag size
     *
     * @return UShort
     */
    public function getSize()
    {
      return($this->size);
    }

    /**
     * return the tag type
     *
     * @return UByte : look on the ByteType class for known values
     */
    public function getType()
    {
      return($this->type);
    }

    /**
     * return true if entry value is an offset
     *
     * @return Boolean
     */
    public function isOffset()
    {
      return($this->isOffset);
    }

    /**
     * return the extra data offset (if the tag value is in an extra data block)
     *
     * @return ULong
     */
    public function getExtraDataOffset()
    {
      if($this->isOffset)
        return($this->extraDataOffset);
      return(0);
    }

    /**
     * return the raw data of the IFD entry
     *
     * @return String
     */
    public function getRaw()
    {
      return($this->raw);
    }

    /**
     * return the Tag object of the entry
     *
     * @return Boolean
     */
    public function getTag()
    {
      return($this->tag);
    }

    public function toString()
    {
      $returned="raw: ".ConvertData::toHexDump($this->raw, ByteType::ASCII);

      $returned.=" ; tag: 0x".sprintf("%04x", $this->tag->getId()).
                 " ; type: ".str_replace(" ", "&nbsp;", sprintf(" %-36s", $this->typeName)).
                 " ; offset: 0x".sprintf("%08x", $this->extraDataOffset).
                 " ; value: ";
      if(is_string($this->tag->getValue()))
      {
        $returned.=((strlen($this->tag->getValue())>64)?"[returns only the first 64 of ".strlen($this->tag->getValue())." bytes] ":"").substr($this->tag->getValue(),0,64);
      }
      else
        $returned.=print_r($this->tag->getValue(), true);
      return($returned);
    }

    /**
     * this function extract the value of a Tag from the extra datas
     *
     * @param String $data : the data
     */
    private function extractExtraData($data)
    {
      /*
       * A size equals 0 means an error ?
       *
       * A size equals 1 means the value is a single variable
       *
       * A size greater than 1 and a type diffrent than ASCII or UNDEFINED and
       * the value is not an offset means that values are stored in an array
       */
      $returned=Array();

      if($this->type==ByteType::ASCII or $this->type==ByteType::UNDEFINED)
      {
        return($data->readASCII($this->size,0));
      }
      else
      {
        for($i=0;$i<$this->size;$i++)
        {
          switch($this->type)
          {
            case ByteType::UBYTE :
              $returned[]=$data->readUByte();
              break;
            case ByteType::USHORT :
              $returned[]=$data->readUShort();
              break;
            case ByteType::ULONG :
              $returned[]=$data->readULong();
              break;
            case ByteType::URATIONAL :
              $returned[]=$data->readURational();
              break;
            case ByteType::SBYTE :
              $returned[]=$data->readSByte();
              break;
            case ByteType::SSHORT :
              $returned[]=$data->readSShort();
              break;
            case ByteType::SLONG :
              $returned[]=$data->readSLong();
              break;
            case ByteType::SRATIONAL :
              $returned[]=$data->readSRational();
              break;
            case ByteType::FLOAT :
              $returned[] = $data->readFloat();
              break;
            case ByteType::DOUBLE :
              $returned[] = $data->readDouble();
              break;
            default:
              $returned[] = "Can't extract datas...";
              break;
          }
        }
      }

      if($this->size==1)
      {
        return($returned[0]);
      }
      else
      {
        return($returned);
      }
    }

  }



?>
