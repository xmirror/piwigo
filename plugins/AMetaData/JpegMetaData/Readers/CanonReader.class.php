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
 * The CanonReader class is the dedicated to read the specific Canon tags
 *
 * ====> See MakerNotesReader.class.php to know more about the structure <======
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 *
 * The CanonReader class is derived from the MakerNotesReader class.
 *
 * =====> See MakerNotesReader.class.php to know more about common methods <====
 *
 * -----------------------------------------------------------------------------
 */



  require_once(JPEG_METADATA_DIR."TagDefinitions/CanonTags.class.php");
  require_once(JPEG_METADATA_DIR."Readers/MakerNotesReader.class.php");

  class CanonReader extends MakerNotesReader
  {
    protected $schema = Schemas::EXIF;

    /**
     * The constructor needs, like the ancestor, the datas to be parsed
     *
     * Some datas are offset on extra data, and this offset can be (some time)
     * absolute inside the IFD, or relative. So, the offset of the IFD structure
     * is needed
     *
     * The byte order can be different from the TIFF byte order !
     *
     * The constructor need the maker signature (see the MakerNotesSignatures
     * class for a list of known signatures)
     *
     * @param String $data
     * @param ULong $offset : offset of IFD block in the jpeg file
     * @param String $byteOrder
     * @param String $makerSignature :
     */
    function __construct($data, $offset, $byteOrder, $makerSignature)
    {
      /*
       * Canon don't have signatures in his maker note, starting directly with
       * the number of entries
       */
      $this->maker = MAKER_CANON;
      $this->header = "";
      $this->headerSize = 0;

      parent::__construct($data, $offset, $byteOrder);
    }

    function __destruct()
    {
      parent::__destruct();
    }


    /**
     * initialize the definition for Pentax exif tags
     */
    protected function initializeTagDef()
    {
      $this->tagDef = new CanonTags();
    }

    /**
     * skip the IFD header
     */
    protected function skipHeader($headerSize=0)
    {
      parent::skipHeader($headerSize);
    }

    /**
     * this function do the interpretation of specials tags
     *
     * the function return the interpreted value for the tag
     *
     * @param $tagId             : the id of the tag
     * @param $values            : 'raw' value to be interpreted
     * @param UByte $type        : if needed (for IFD structure) the type of data
     * @param ULong $valueOffset : if needed, the offset of data in the jpeg file
     * @return String or Array or DateTime or Integer or Float...
     */
    protected function processSpecialTag($tagId, $values, $type, $valuesOffset=0)
    {
      switch($tagId)
      {
        case 0x0001: // "CanonImageType"
          $this->processSubTag0x0001($values);
          $returned=$values;
          break;
        case 0x0004: // "CanonShotInfo"
          $this->processSubTag0x0004($values);
          $returned=$values;
          break;
        case 0x0006: // "CanonImageType"
        case 0x0007: // "CanonFirmwareVersion"
        case 0x0009: // "OwnerName"
        case 0x0095: // "LensModel"
        case 0x0096: // "InternalSerialNumber"
          /*
           * null terminated strings
           */
          $returned=ConvertData::toStrings($values);
          break;
        case 0x000c: // "SerialNumber"
          $returned=$values;
          break;
        case 0x000d: // "CanonCameraInfo"
          $returned=$this->processSubTag0x000d($values);
          break;
        case 0x0010: // "CanonModelID"
          $tag=$this->tagDef->getTagById(0x0010);
          $returned=$tag['tagValues.special'][sprintf("0x%08x", $values)];
          unset($tag);
          break;
        case 0x0015: // "SerialNumberFormat"
          $tag=$this->tagDef->getTagById(0x0015);
          $returned=$tag['tagValues.special'][sprintf("0x%08x", $values)];
          unset($tag);
          break;
        default:
          $returned="Not yet implemented;".ConvertData::toHexDump($tagId, ByteType::USHORT)." => ".ConvertData::toHexDump($values, $type);
          break;
      }
      return($returned);
    }

    /**
     * this function process the subtag of the 0x0001 "CanonCameraSettings" tag
     *
     * @param Boolean $add : if set to false, the function return the tag value
     *                       otherwise the function adds the tag
     */
    protected function processSubTag0x0001($values, $add=true)
    {
      foreach($values as $key => $val)
      {
        $tagDef=$this->tagDef->getTagById("0x0001.$key");

        if(is_array($tagDef))
        {
          // make a fake IFDEntry
          $entry=new IfdEntryReader("\xFF\xFF\x00\x00\x00\x00\x00\x00\xFF\x01\x00".chr($key), $this->byteOrder, "", 0, null);

          $entry->getTag()->setId("0x0001.$key");
          $entry->getTag()->setName($tagDef['tagName']);
          $entry->getTag()->setValue($val);
          $entry->getTag()->setKnown(true);
          $entry->getTag()->setImplemented($tagDef['implemented']);
          $entry->getTag()->setTranslatable($tagDef['translatable']);
          $entry->getTag()->setSchema($this->schema);

          if(array_key_exists('tagValues', $tagDef))
          {
            if(array_key_exists($val, $tagDef['tagValues']))
            {
              $returned=$tagDef['tagValues'][$val];
            }
            else
            {
              $returned="unknown (".$val.")";
            }
          }
          else
          {
            switch($key)
            {
              case 2: // SelfTimer
                if($val==0)
                {
                  $returned=Array("Off");
                }
                else
                {
                  $returned=Array((($val & 0xfff) / 10).' s');
                  if($val & 0x4000)
                    $returned[]="Custom";
                }
                break;
              case 22: // LensType
                /* in most case, with one Id we have one lens
                 * in some case, with one Id we can have more than one lens
                 * in this case, we made a $focal var like :
                 *             "90 mm"
                 *             "28-300mm"
                 * and try to find a lens with this properties
                 */
                if(array_key_exists($val, $tagDef['tagValues.special']))
                {
                  $lens=$tagDef['tagValues.special'][$val];

                  if(is_array($lens))
                  {
                    $focalUnit=(array_key_exists(25, $values))?$values[25]:1;
                    $FocalShort=(array_key_exists(24, $values) && ($focalUnit!=0))?$values[24]/$focalUnit:0;
                    $FocalLong=(array_key_exists(23, $values) && ($focalUnit!=0))?$values[23]/$focalUnit:0;
                    $focal=(($FocalShort==$FocalLong or $FocalLong==0)?$FocalShort:$FocalShort."-".$FocalLong)."mm";

                    foreach($lens as $name)
                    {
                      if(preg_match("/.*".$focal.".*/i", $name))
                        $returned=$name;
                    }
                  }
                  else
                  {
                    $returned=$lens;
                  }
                }
                else
                {
                  $returned=$tagDef['tagValues.special'][0xffff];
                }

                break;
              case 23: // LongFocal
              case 24: // ShortFocal
                /* note : the values seems to be divided by the FocalUnit
                 * (subTag #25)
                 */
                if(array_key_exists(25, $values))
                {
                  $focalUnit=$values[25];
                }
                else
                {
                  $focalUnit=1;
                }
                if($focalUnit==0) $focalUnit=1;

                $returned=ConvertData::toFocalLength($val/$focalUnit);
                break;
              case 25: // FocalUnit
                $returned=$val."/mm";
                break;
              case 26: // MaxAperture
              case 27: // MinAperture
                $returned=ConvertData::toFNumber(round(exp($this->canonEv($val)*log(2)/2),1));
                break;
              case 29: // FlashBits
                $returned=Array();
                foreach($tagDef['tagValues.special'] as $key => $name)
                {
                  if(($key & $val) == $key)
                  {
                    $returned[]=$name;
                  }
                }
                break;
              default:
                $returned="not yet implemented";
                break;
            }
          }

          if($add)
          {
            $entry->getTag()->setLabel($returned);
            $this->entries[]=$entry;
          }
          else
          {
            // only return the value for the asked tag
            unset($entry);
            unset($tagDef);
            return($returned);
          }

          unset($entry);
        }
        unset($tagDef);
      }
    }

    /**
     * this function process the subtag of the 0x0004 "CanonShotInfo" tag
     *
     * @param Boolean $add : if set to false, the function return the tag value
     *                       otherwise the function adds the tag
     */
    protected function processSubTag0x0004($values, $add=true)
    {
      foreach($values as $key => $val)
      {
        $tagDef=$this->tagDef->getTagById("0x0004.$key");

        if(is_array($tagDef))
        {
          // make a fake IFDEntry
          $entry=new IfdEntryReader("\xFF\xFF\x00\x00\x00\x00\x00\x00\xFF\x04\x00".chr($key), $this->byteOrder, "", 0, null);

          $entry->getTag()->setId("0x0004.$key");
          $entry->getTag()->setName($tagDef['tagName']);
          $entry->getTag()->setValue($val);
          $entry->getTag()->setKnown(true);
          $entry->getTag()->setImplemented($tagDef['implemented']);
          $entry->getTag()->setTranslatable($tagDef['translatable']);
          $entry->getTag()->setSchema($this->schema);

          if(array_key_exists('tagValues', $tagDef))
          {
            if(array_key_exists($val, $tagDef['tagValues']))
            {
              $returned=$tagDef['tagValues'][$val];
            }
            else
            {
              $returned="unknown (".$val.")";
            }
          }
          else
          {
            switch($key)
            {
              case 1: // AutoISO
                $returned=round(exp($val/32*log(2))*100,0);
                break;
              case 2: // BaseISO
                $returned=exp($this->canonEv($val) * log(2)) * 100 / 32;
                break;
              case 4: // TargetAperture
              case 21: // FNumber
                $returned=ConvertData::toFNumber(round(exp($this->canonEv($val)*log(2)/2), 1));
                break;
              case 5: // TargetExposureTime
                $returned=ConvertData::toExposureTime(exp(-$this->CanonEv($val)*log(2)));
                break;
              case 6: // ExposureCompensation
              case 15: // FlashExposureComp
              case 17: // AEBBracketValue
                $returned=ConvertData::$this->CanonEv($val);
                break;
              case 9: // SlowShutter
                $returned=$val;
                break;
              case 13: // FlashGuideNumber
                $returned=$val/32;
                break;
              case 23: // MeasuredEV2
                $returned=$val/8-6;
                break;
              case 24: // BulbDuration
              case 29: // SelfTimer2
                $returned=$val/10;
                break;
              default:
                $returned="not yet implemented";
                break;
            }
          }

          if($add)
          {
            $entry->getTag()->setLabel($returned);
            $this->entries[]=$entry;
          }
          else
          {
            // only return the value for the asked tag
            unset($entry);
            unset($tagDef);
            return($returned);
          }

          unset($entry);
        }
        unset($tagDef);
      }
    }

    /**
     * this function process the subtag of the 0x000d "CanonCameraInfo" tag
     *
     * @param Boolean $add : if set to false, the function return the tag value
     *                       otherwise the function adds the tag
     */
    protected function processSubTag0x000d($values, $add=true)
    {
      $name=GlobalTags::getExifMaker();

      if(preg_match("/\b1DS?$/", $name))
      {

      }/*
      elseif(preg_match("/\b1Ds? Mark II$/", $name))
      {

      }
      elseif(preg_match("/\b1Ds? Mark II N$/", $name))
      {

      }
      elseif(preg_match("/\b1Ds? Mark III$/", $name))
      {

      }
      elseif(preg_match("/EOS 5D$/", $name))
      {

      }
      elseif(preg_match("/EOS 5D Mark II$/", $name))
      {

      }
      elseif(preg_match("/EOS 7D$/", $name))
      {

      }*/
      elseif(preg_match("/.*\b1D Mark IV/i", $name))
      {
        $returned=$this->processSubTag0x000d_1DMarkIV($values, $add);
      }
      elseif(preg_match("/.*EOS 40D/i", $name))
      {
        $returned=$this->processSubTag0x000d_40D($values, $add);
      }/*
      elseif(preg_match("/EOS 50D$/", $name))
      {

      }
      elseif(preg_match("/\b(450D|REBEL XSi|Kiss X2)\b/", $name))
      {

      }
      elseif(preg_match("/\b(500D|REBEL T1i|Kiss X3)\b/", $name))
      {

      }
      elseif(preg_match("/\b(1000D|REBEL XS|Kiss F)\b/", $name))
      {

      }
      elseif(preg_match("/\b1DS?/", $name))
      {

      }*/
      else
      {
        /*
         * note : powershot are not implemented, in exiftool condition to
         * determine the model are not very understandable
         */
        $returned="$name is not yet implemented => ".ConvertData::toHexDump($values, ByteType::ASCII);
      }
      return($returned);
    }

    /**
     * this function process the subtag of the 0x000d "CanonCameraInfo" tag
     * for the EOS 40D camera
     */
    protected function processSubTag0x000d_40D($values)
    {
      $tagDef=$this->tagDef->getTagById(0x000d);
      $list=$tagDef['tagValues.special']['40D'];
      $data=new Data($values);

      foreach($list as $tagIndex)
      {
        $subTagDef=$this->tagDef->getTagById("0x000d.40D.$tagIndex");

        if(is_array($subTagDef))
        {
          $val=$this->readDataFromSubTag($data, $subTagDef);

          // make a fake IFDEntry
          $entry=new IfdEntryReader("\xFF\xFF\x00\x00\x00\x00\x00\x00\xFF\x0d\x00\x00", $this->byteOrder, "", 0, null);

          $entry->getTag()->setId("0x000d.40D.$tagIndex");
          $entry->getTag()->setName($subTagDef['tagName']);
          $entry->getTag()->setValue($val);
          $entry->getTag()->setKnown(true);
          $entry->getTag()->setImplemented($subTagDef['implemented']);
          $entry->getTag()->setTranslatable($subTagDef['translatable']);
          $entry->getTag()->setSchema($this->schema);

          if(array_key_exists('tagValues', $subTagDef))
          {
            if(array_key_exists($val, $subTagDef['tagValues']))
            {
              $returned=$subTagDef['tagValues'][$val];
            }
            else
            {
              $returned="unknown (".$val.")";
            }
          }
          else
          {
            switch($tagIndex)
            {
              case 24: // CameraTemperature
                $returned=($val-128)."°C";
                break;
              case 29: // FocalLength
                $returned=ConvertData::toFocalLength($val);
                break;
              case 111: // WhiteBalance
                // same method than the ShotInfo.WhiteBalance tag
                $returned=$this->processSubTag0x0004(Array(7 => $val), false);
                break;
              case 214: // LensType
                // same method than the CanonCameraSettings.LensType tag
                $FocalShort=$this->readDataFromSubTag($data, $this->tagDef->getTagById("0x000d.40D.216"));
                $FocalLong=$this->readDataFromSubTag($data, $this->tagDef->getTagById("0x000d.40D.218"));

                $returned=$this->processSubTag0x0001(Array(22 => $val, 23 => $FocalLong, 24 => $FocalShort), false);
                break;
              case 216: // ShortFocal
              case 218: // LongFocal
                $returned=ConvertData::toFocalLength($val);
                break;
              case 255: // FirmwareVersion
              case 2347: // LensModel
                $returned=ConvertData::toStrings($val);
                break;
              default:
                $returned="not yet implemented ($tagIndex)";
                break;
            }
          }

          $entry->getTag()->setLabel($returned);
          $this->entries[]=$entry;

          unset($entry);
        }
        unset($subTagDef);
      }
      unset($tagDef);
      unset($list);
      unset($data);

      return("[EOS 40D]");
    }

    /**
     * this function process the subtag of the 0x000d "CanonCameraInfo" tag
     * for the EOS 1D Mark IV camera
     *
     */
    protected function processSubTag0x000d_1DMarkIV($values)
    {
      $tagDef=$this->tagDef->getTagById(0x000d);
      $list=$tagDef['tagValues.special']['1DMarkIV'];
      $data=new Data($values);

      foreach($list as $tagIndex)
      {
        $subTagDef=$this->tagDef->getTagById("0x000d.1DMarkIV.$tagIndex");

        if(is_array($subTagDef))
        {
          $val=$this->readDataFromSubTag($data, $subTagDef);

          // make a fake IFDEntry
          $entry=new IfdEntryReader("\xFF\xFF\x00\x00\x00\x00\x00\x00\xFF\x0d\x00\x00", $this->byteOrder, "", 0, null);

          $entry->getTag()->setId("0x000d.1DMarkIV.$tagIndex");
          $entry->getTag()->setName($subTagDef['tagName']);
          $entry->getTag()->setValue($val);
          $entry->getTag()->setKnown(true);
          $entry->getTag()->setImplemented($subTagDef['implemented']);
          $entry->getTag()->setTranslatable($subTagDef['translatable']);
          $entry->getTag()->setSchema($this->schema);

          if(array_key_exists('tagValues', $subTagDef))
          {
            if(array_key_exists($val, $subTagDef['tagValues']))
            {
              $returned=$subTagDef['tagValues'][$val];
            }
            else
            {
              $returned="unknown (".$val.")";
            }
          }
          else
          {
            switch($tagIndex)
            {
              case 25: // CameraTemperature
                $returned=($val-128)."°C";
                break;
              case 30: // FocalLength
                $returned=ConvertData::toFocalLength($val);
                break;
              default:
                $returned="not yet implemented ($tagIndex)";
                break;
            }
          }

          $entry->getTag()->setLabel($returned);
          $this->entries[]=$entry;

          unset($entry);
        }
        unset($subTagDef);
      }
      unset($tagDef);
      unset($list);
      unset($data);

      return("[EOS 1D Mark IV]");
    }



    /**
     * read datas from a $data object, according to the tag definition
     *
     * @param Data $data : a Data object
     * @param Array $tagDef : the tag definition
     */
    protected function readDataFromSubTag($data, $tagDef)
    {
      if(!array_key_exists('pos', $tagDef))
        return("Invalid tagDef (no 'pos')");

      $pos=$tagDef['pos'];

      if(array_key_exists('byteOrder', $tagDef))
      {
        $data->setByteOrder($tagDef['byteOrder']);
      }
      else
      {
        $data->setByteOrder(BYTE_ORDER_LITTLE_ENDIAN);
      }

      $returned="";
      switch($tagDef['type'])
      {
        case ByteType::UNDEFINED:
        case ByteType::UNKNOWN :
        case ByteType::ASCII:
          $nbCar=(array_key_exists('length', $tagDef))?$tagDef['length']:1;
          $returned=$data->readASCII($nbCar, $pos);
          break;
        case ByteType::UBYTE:
          $returned=$data->readUByte($pos);
          break;
        case ByteType::USHORT:
          $returned=$data->readUShort($pos);
          break;
        case ByteType::ULONG:
          $returned=$data->readULong($pos);
          break;
        case ByteType::URATIONAL:
          $returned=$data->readURational($pos);
          break;
        case ByteType::SBYTE:
          $returned=$data->readSByte($pos);
          break;
        case ByteType::SSHORT:
          $returned=$data->readSShort($pos);
          break;
        case ByteType::SLONG:
          $returned=$data->readSLong($pos);
          break;
        case ByteType::SRATIONAL:
          $returned=$data->readSRational($pos);
          break;
        case ByteType::FLOAT:
          $returned="";
          break;
        case ByteType::DOUBLE:
          $returned="";
          break;
      }
      return($returned);
    }


    /**
     * Convert Canon hex-based EV (modulo 0x20) to real number
     *     0x00 -> 0
     *     0x0c -> 0.33333
     *     0x10 -> 0.5
     *     0x14 -> 0.66666
     *     0x20 -> 1   ...  etc
     *
     * function from exiftool
     *
     * @param Integer $value : the canon EV value
     * @return Float : the converted value
     */
    protected function canonEv($val)
    {
      //$val=95;

      if($val<0)
      {
        $val=-$val;
        $sign=-1;
      }
      else
      {
        $sign=1;
      }
      $frac = (float) ($val & 0x1f); //$frac = $val % 0x20;
      $val -= $frac;  // remove fraction
      // Convert 1/3 and 2/3 codes
      if ($frac == 0x0c)
      {
        $frac = 0x20 / 3;
      }
      elseif($frac==0x14)
      {
        $frac = 0x40 / 3;
      }
      return($sign * ($val + $frac) / 0x20);
    }
  }

?>
