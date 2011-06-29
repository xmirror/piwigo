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
 * The IfdReader class is the dedicated to read IFDs from a TIFF structure
 *
 * =====> See TiffReader.class.php to know more about a Tiff structure <========
 *
 *
 * An IFD is formatted as this :
 *  - number of IFD entries : 2 bytes
 *  - entries               : 12 bytes x number of entries
 *  - next IFD offset       : 4 bytes
 *  - extra datas           : number of bytes depends of the stored extra datas
 *
 * ====> See IfdEntryReader.class.php to know more about an IFD structure <=====
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 *
 * The Ifdreader class is derived from the GenericReader class.
 *
 * ======> See GenericReader.class.php to know more about common methods <======
 *
 *
 * Derived classes :
 *  - GpsReader         (for exif GPS tags)
 *  - MakerNotesReader  (for maker notes tags)
 *  - PentaxReader      (for Pentax exif tags, in fact derived from
 *                      MakerNotesReader)
 *
 *
 * This class provides theses public functions :
 *  - (static) convert
 *  - getNextIFDOffset
 *
 * -----------------------------------------------------------------------------
 */

  require_once(JPEG_METADATA_DIR."Common/Data.class.php");
  require_once(JPEG_METADATA_DIR."Common/GlobalTags.class.php");
  require_once(JPEG_METADATA_DIR."Common/MakerNotesSignatures.class.php");
  require_once(JPEG_METADATA_DIR."Readers/GenericReader.class.php");
  require_once(JPEG_METADATA_DIR."Readers/IfdEntryReader.class.php");
  require_once(JPEG_METADATA_DIR."TagDefinitions/IfdTags.class.php");


  class IfdReader extends GenericReader
  {
    protected $byteOrder = BYTE_ORDER_LITTLE_ENDIAN;
    protected $schema = Schemas::EXIF;


    private $nextIFDOffset = 0;

    private $dataOffset = 0;


    /**
     * The constructor needs, like the ancestor, the datas to be parsed
     *
     * Some datas are offfset on extra data, and this offset can be (some time)
     * absolute inside the IFD, or relative. So, the offset of the IFD structure
     * is needed
     *
     * The byte order of data is the same byte order than the TIFF structure
     *
     * @param String $data
     * @param ULong $offset : offset of IFD block in the jpeg file
     * @param String $byteOrder
     */
    function __construct($data, $offset, $byteOrder)
    {
      parent::__construct($data);

      $this->data->setByteOrder($byteOrder);
      $this->byteOrder=$byteOrder;
      $this->dataOffset=$offset;


      $this->skipHeader($this->headerSize);



      $dataPointer = $this->data->offset();

      /*
       * number of entries is defined byte an UShort at the begining of the
       * data structure
       */
      $this->nbEntries=$this->data->readUShort();

      /*
       * if the file is written in little_endian, we assume the maker note
       * values are stored with little_endian byte order too
       *
       * in some case, software modify the exif and rewrite the file with the
       * big_endian byte order. but the maker note stays in little_endian
       *
       * this code try to determine the maker note byte order : if number of
       * entries is higher than 256, we can think that the maker note byte order
       * is inverted...
       * (the constructor for maker note is not overrided, so this trick is
       * placed here)
       *
       */
      if($this->nbEntries>0xff)
      {
        $this->data->seek($dataPointer);
        if($this->byteOrder==BYTE_ORDER_BIG_ENDIAN)
          $this->byteOrder = BYTE_ORDER_LITTLE_ENDIAN;
        else
          $this->byteOrder = BYTE_ORDER_BIG_ENDIAN;

        $this->data->setByteOrder($this->byteOrder);
        $this->nbEntries=$this->data->readUShort();
        if($this->nbEntries>0xff)
        {
          /*
           * if number of entries is always higher than 0xFF after reverting the
           * byte order, set num entries to 0
           * (at now, unable to manage this)
           */
          $this->nbEntries=0;
        }

      }

      $this->initializeEntries();

      /* Next IFD Offset is defined after the entries  */
      $this->nextIFDOffset=$this->data->readULong();
    }

    function __destruct()
    {
      parent::__destruct();
    }

    /**
     * return the offset for the next IFD block
     * offset of next IFD is relative to the current TIFF block, not the Jpeg
     * file
     *
     * @return ULong
     */
    public function getNextIFDOffset()
    {
      return($this->nextIFDOffset);
    }

    public function toString()
    {
      $returned="IFD Offset: ".sprintf("%08x", $this->dataOffset).
                " ; NbEntries: ".sprintf("%02d", $this->nbEntries).
                " ; next IFD Offset: 0x".sprintf("%08x", $this->nextIFDOffset);
      return($returned);
    }

    /**
     * initialize the definition for classic exif tags (in fact Tiff 6.0 and
     * Exif 2.2 tags)
     */
    protected function initializeTagDef()
    {
      $this->tagDef = new IfdTags();
    }

    /**
     * reads all the entries in the IFD block, and set the Tag properties for
     * the entry.
     *
     * An entry is a IfdEntryReader object
     *
     * Add the entry to the entries array
     *
     */
    protected function initializeEntries()
    {
      for($i=0;$i<$this->nbEntries;$i++)
      {
        $entry=new IfdEntryReader($this->data->readASCII(12), $this->byteOrder, $this->data, $this->dataOffset, $this->tagDef);
        $this->setTagProperties($entry);
        $this->entries[]=$entry;
      }
    }

    /**
     * Interprets the tag values into a 'human readable values'
     *
     * @param IfdEntryReader $entry
     */
    private function setTagProperties($entry)
    {
      /*
       * if the given tag id is defined, analyzing its values
       */
      if($this->tagDef->tagIdExists($entry->getTagId()))
      {
        $tag=$this->tagDef->getTagById($entry->getTagId());

        $entry->getTag()->setKnown(true);
        $entry->getTag()->setName($tag['tagName']);
        $entry->getTag()->setImplemented($tag['implemented']);
        $entry->getTag()->setTranslatable($tag['translatable']);
        $entry->getTag()->setSchema($this->schema);

        /*
         * if there is values defined for the tag, analyze it
         */
        if(array_key_exists('tagValues', $tag))
        {
          /*
           * if the combiTag value equals 0 exploit it as this
           */
          if($tag['combiTag']==0 and !is_array($entry->getValue()))
          {
            if(array_key_exists($entry->getValue(), $tag['tagValues']))
            {
              $entry->getTag()->setLabel($tag['tagValues'][$entry->getValue()]);
            }
            else
            {
              $entry->getTag()->setLabel("[unknown value 0x".sprintf("%04x", $entry->getValue())."]");
            }
          }
          else
          {
            /*
             * the combiTag value does not equals 0, so exploit it as a combi tag
             */
            $combiValue=$this->processCombiTag($entry->getValue(), ($tag['combiTag']==0)?1:$tag['combiTag'] );
            if(array_key_exists($combiValue, $tag['tagValues']))
            {
              $entry->getTag()->setLabel($tag['tagValues'][$combiValue]);
            }
            else
            {
              $entry->getTag()->setLabel("[unknown combi value 0x".sprintf("%0".(2*$tag['combiTag'])."x", $combiValue)."]");
            }
          }
        }
        else
        {
          /*
           * there is no values defined for the tag, analyzing it with dedicated
           * function
           */
          $entry->getTag()->setLabel($this->processSpecialTag($entry->getTagId(), $entry->getValue(), $entry->getType(), $entry->getExtraDataOffset()));
        }
      }
    }

    /**
     * Some values are obtained after combination of values
     */
    private function processCombiTag($values, $combi)
    {
      if(is_array($values))
      {
        $returned=0;
        if($combi<=count($values))
        {
          for($i=0;$i<$combi;$i++)
          {
            $returned+=$values[$i]*pow(2,8*($combi-$i-1));
          }
        }
      }
      else
      {
        $returned=$values;
      }
      return($returned);
    }

    /**
     * skip IFD header, if any
     * (used by maker sub IFD classes)
     */
    protected function skipHeader($headerSize=0)
    {
      $this->data->seek($headerSize);
    }

    /**
     * this function do the interpretation of specials tags
     * must be overrided by derived classes
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
        /*
         * Tags managed
         */
        case 0x0100: // ImageWidth, tag 0x0100
        case 0x0101: // ImageHeight, tag 0x0101
        case 0x0102: // BitsPerSample, tag 0x0102
        case 0x0115: // SamplesPerPixel, tag 0x0115
        case 0x0116: // RowsPerStrip, tag 0x0116
        case 0x0117: // StripByteCounts, tag 0x0117
        case 0x0201: // JPEGInterchangeFormat, tag 0x0201
        case 0x0202: // JPEGInterchangeFormatLength, tag 0x0202
        case 0x8824: // SpectralSensitivity, tag 0x8824
        case 0x8827: // ISOSpeedRatings, tag 0x8827
        case 0xA002: // PixelXDimension, tag 0xA002
        case 0xA003: // PixelYDimension, tag 0xA003
          $returned=$values;
          break;
        case 0x000b: // ProcessingSoftware, tag 0x000b
        case 0x010D: // DocumentName, tag 0x010D
        case 0x010E: // ImageDescription, tag 0x010E
        case 0x0131: // Software, tag 0x0131
        case 0x013B: // Artist, tag 0x013B
        case 0x8298: // Copyright, tag 0x8298
        case 0x9290: // SubsecTime, tag 0x9290
        case 0x9291: // SubsecTimeOriginal, tag 0x9291
        case 0x9292: // SubsecTimeDigitized, tag 0x9292
        case 0xA004: // RelatedSoundFile, tag 0xA004
          /*
           * null terminated strings
           */
          $returned=ConvertData::toStrings($values);
          break;
        case 0x010F: // Make, tag 0x010F
        case 0x0110: // Model, tag 0x0110
          /* Make and Model are null terminated strings
           * memorize the maker & camera from the exif tag : it's used to
           * recognize the Canon camera (no header in the maker note)
           */
          $returned=ConvertData::toStrings($values);
          GlobalTags::setExifMaker($returned);
          break;
        case 0x011A: // XResolution, tag 0x011A
        case 0x011B: // YResolution, tag 0x011B
          if($values[1]>0)
            $returned=$values[0]/$values[1];
          else
            $returned=$values[0];
          break;
        case 0x0132: // DateTime, tag 0x0132
        case 0x9003: // DateTimeOriginal, tag 0x9003
        case 0x9004: // DateTimeDigitized, tag 0x9004
          /* formatted as "YYYY:MM:DD HH:MM:SS\x00"
           * if date is defined, returns a DateTime object
           * otherwise return "unknown date"
           */
          $returned=ConvertData::toDateTime($values);
          break;
        case 0x0212: // YCbCrSubSampling, tag 0x0212
          /* is a rationnal number
           * [1, 1] = YCbCr4:4:4
           * [1, 2] = YCbCr4:4:0
           * [1, 4] = YCbCr4:4:1
           * [2, 1] = YCbCr4:2:2
           * [2, 2] = YCbCr4:2:0
           * [2, 4] = YCbCr4:2:1
           * [4, 1] = YCbCr4:1:1
           * [4, 2] = YCbCr4:1:0
           */
          $tag=$this->tagDef->getTagById(0x0212);
          if(array_key_exists($values[0], $tags['tagValues.special']))
          {
            if(array_key_exists($values[1], $tags['tagValues.special'][$values[0]]))
            {
              $returned=$tags['tagValues.special'][$values[0]][$values[1]];
            }
            else
            {
              $returned="Unknown";
            }
          }
          else
          {
            $returned="Unknown";
          }
          break;
        case 0x829A: // ExposureTime, tag 0x829A
          if($values[1]==0) $values[1]=1;
          $returned=ConvertData::toExposureTime($values[0]/$values[1]);
          break;
        case 0x829D: // FNumber, tag 0x829D
          if($values[1]==0) $values[1]=1;
          $returned=ConvertData::toFNumber(GlobalTags::setExifAperture($values[0]/$values[1]));
          break;
        case 0x8769: // Exif IFD Pointer, tag 0x8769
          /*
           * the tag 0x8769 value is an offset to an EXIF sub IFD
           * the returned value is a parsed sub IFD
           */
          if($values>$this->dataOffset)
          {
            $returned=new IfdReader($this->data->readASCII(-1,$values-$this->dataOffset), $values, $this->byteOrder);
          }
          else
          {
            /* ELSE implemented with the mantis bug:1686
             * when the offset of a sub IFD tag is lower than the offset of the
             * current IFD, ignore the sub IFD
             *
             * A method have to be coded to manage this kind of sub IFD
             */
            $returned="Feature not implemented: read negative offset";
          }
          break;
        case 0x8825: // GPS IFD Pointer, tag 0x8825
          /*
           * the tag 0x8825 value is an offset to an EXIF sub IFD
           * the returned value is a parsed sub IFD
           */
          require_once(JPEG_METADATA_DIR."Readers/GpsReader.class.php");
          $returned=new GpsReader($this->data->readASCII(-1,$values-$this->dataOffset), $values, $this->byteOrder);
          break;
        case 0x9000: // ExifVersion, tag 0x9000
        case 0xA000: // FlashpixVersion, tag 0xa0000
          $returned=(int)substr($values,0,2).".".(int)substr($values,2);
          break;
        case 0x9101: // ComponentsConfiguration, tag0x9101
          switch($values)
          {
            case "\x01\x02\x03\x00":
              $returned="YCbCr";
              break;
            case "\x04\x05\x06\x00":
              $returned="RGB";
              break;
            default:
              $returned="Unknown";
              break;
          }
          break;
        case 0x9102: // CompressedBitsPerPixel, tag0x9102
        case 0x9203: // BrightnessValue, tag 0x9203 (APEX format)
          if($values[1]==0) $values[1]=1;
          $returned=round($values[0]/$values[1],4);
          break;
        case 0x9201: // ShutterSpeedValue, tag0x9201
          if($values[1]==0) $values[1]=1;
          /*
           * the formula to compute the shutter speed value is 1/pow(2, x)
           *
           * Because of rounding errors, the result obtained using this formula
           * is sometimes incorrect.
           *
           * We consider that if the result is greater than the second, the
           * result is rounded to 2 hundredths of a second (to avoid something
           * like 3.0000124500015s)
           *
           * in other case (result is less than 1 second) there is no rules
           * result can be strange, but for now I don't know how to resolve this
           * problem
           *
           */

          $value=($values[0]<=0)?0:1/pow(2, $values[0]/$values[1]);
          if($value>1)
          {
            $value=round($value,2);
          }
          $returned=ConvertData::toExposureTime($value);
          break;
        case 0x9202: // ApertureValue, tag0x9202
          if($values[1]==0) $values[1]=1;
          if(GlobalTags::getExifAperture()=="")
          {
            // set only if empty (if not empty, it means the value was already
            // set with the FNumber tag)
            GlobalTags::setExifAperture(pow(1.414213562, $values[0]/$values[1]));
          }
          //no break, $returned value is the same than the 0x9205 tag
        case 0x9205: // MaxApertureValue, tag0x9205
          if($values[1]==0) $values[1]=1;
          $returned=ConvertData::toFNumber(pow(1.414213562, $values[0]/$values[1]));
          break;
        case 0x9204: // ExposureBiasValue, tag0x9204
          if($values[1]==0) $values[1]=1;
          $returned=ConvertData::toEV($values[0]/$values[1]);
          break;
        case 0x9206: // SubjectDistance, tag 0x9206
          if($values[1]==0) $values[1]=1;
          $returned=ConvertData::toDistance($values[0]/$values[1], "m");
          break;
        case 0x9209: // flash, tag 0x9209
          $tag=$this->tagDef->getTagById(0x9209);
          $returned=Array(
            "computed" => (isset($tag['tagValues.computed'][$values])?$tag['tagValues.computed'][$values]:"unknown"),
            "detail" => Array()
          );

          $value=$values & 0x0001;
          $returned["detail"][]=$tag['tagValues.specialValues'][0x0001][$value];

          $value=($values & 0x0006)>>1;
          $returned["detail"][]=$tag['tagValues.specialValues'][0x0006][$value];

          $value=($values & 0x0018)>>3;
          $returned["detail"][]=$tag['tagValues.specialValues'][0x0018][$value];

          $value=($values & 0x0020)>>5;
          $returned["detail"][]=$tag['tagValues.specialValues'][0x0020][$value];

          $value=($values & 0x0040)>>6;
          $returned["detail"][]=$tag['tagValues.specialValues'][0x0040][$value];

          break;
        case 0x920A: // FocalLength, tag 0x920A
          if($values[1]==0) $values[1]=1;
          $returned=ConvertData::toFocalLength(GlobalTags::setExifFocal($values[0]/$values[1]));
          break;
        case 0x927c: // MakerNote, tag 0x927c
          /* try to return a specific maker sub ifd
           *
           * if $values is n
           */
          $makerSignature=MakerNotesSignatures::getMaker($values);
          switch($makerSignature)
          {
            case MakerNotesSignatures::OlympusHeader:
            case MakerNotesSignatures::Olympus2Header:
              $returned="Olympus is not implemented yet";
              break;
            case MakerNotesSignatures::FujiFilmHeader:
              $returned="FujiFilm is not implemented yet";
              break;
            case MakerNotesSignatures::Nikon2Header:
            case MakerNotesSignatures::Nikon3Header:
              require_once(JPEG_METADATA_DIR."Readers/NikonReader.class.php");
              $returned=new NikonReader($values, $valuesOffset, $this->byteOrder, $makerSignature);
              break;
            case MakerNotesSignatures::PanasonicHeader:
              $returned="Panasonic is not implemented yet";
              break;
            case MakerNotesSignatures::PentaxHeader:
            case MakerNotesSignatures::Pentax2Header:
              require_once(JPEG_METADATA_DIR."Readers/PentaxReader.class.php");
              $returned=new PentaxReader($values, $valuesOffset, $this->byteOrder, $makerSignature);
              break;
            case MakerNotesSignatures::SigmaHeader:
            case MakerNotesSignatures::Sigma2Header:
              $returned="Sigma is not implemented yet";
              break;
            case MakerNotesSignatures::SonyHeader:
              $returned="Sony is not implemented yet";
              break;
            default:
              /*
               * Canon maker notes don't have any header
               * So, the only method to know if the maker note is from a Canon
               * camera is looking the exif maker value equals "Canon" or
               * the camera model contains "Canon"
               */
              if(preg_match("/.*canon.*/i",GlobalTags::getExifMaker()))
              {
                require_once(JPEG_METADATA_DIR."Readers/CanonReader.class.php");
                $returned=new CanonReader($values, $valuesOffset, $this->byteOrder, "");
              }
              else
              {
                $returned="unknown maker => ".ConvertData::toHexDump($values, $type, 16);
              }
              break;
          }
          break;
        case 0x9286: // UserComment, tag 0x9286
          /*
           * user comment format :
           *  first 8 bytes : format type
           *  other bytes : text
           */
          $returned=substr($values,8);
          break;
        case 0xA20B: // FlashEnergy, tag 0xA20B
        case 0xA20E: // FocalPlaneXResolution, tag 0xA20E
        case 0xA20F: // FocalPlaneYResolution, tag 0xA20F
        case 0xA215: // ExposureIndex, tag 0xA20F
        case 0xA404: // DigitalZoomRatio, tag 0xA404
          if($values[1]==0) $values[1]=1;
          $returned=round($values[0]/$values[1],2);
          break;
        case 0xA405: // FocalLengthIn35mmFilm, tag 0xA405
          $returned=ConvertData::toFocalLength($values);
          break;
        /*
         * Tags not managed
         */
        case 0x0111: // StripOffsets, tag 0x0111
        case 0x012D: // TransferFunction, tag 0x012D
        case 0x013E: // WhitePoint, tag 0x013E
        case 0x013F: // PrimaryChromaticities, tag 0x013F
        case 0x0211: // YCbCrCoefficients, tag 0x0211
        case 0x0214: // ReferenceBlackWhite, tag 0x0214
        case 0x8828: // ReferenceBlackWhite, tag 0x0214
        case 0x9214: // SubjectArea, tag 0x9214
        case 0xA20C: // SpatialFrequencyResponse, tag 0xA20C
        case 0xA40B: // DeviceSettingDescription, tag 0xA40B
        default:
          $returned="Not yet implemented;".ConvertData::toHexDump($tagId, ByteType::USHORT)." => ".ConvertData::toHexDump($values, $type, 64);
          break;
      }
      return($returned);
    }
  }


?>
