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
 * The NikonReader class is the dedicated to read the specific Nikon tags
 *
 * ====> See MakerNotesReader.class.php to know more about the structure <======
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 *
 * ****             All known tags are not implemented !!                   ****
 *
 *
 * The NikonReader class is derived from the MakerNotesReader class.
 *
 * =====> See MakerNotesReader.class.php to know more about common methods <====
 *
 * -----------------------------------------------------------------------------
 */



  require_once(JPEG_METADATA_DIR."TagDefinitions/NikonTags.class.php");
  require_once(JPEG_METADATA_DIR."Readers/MakerNotesReader.class.php");

  class NikonReader extends MakerNotesReader
  {
    protected $schema = Schemas::EXIF;

    /* these 2 specific metadata are used to decrypt some information, like the
     * data lens
     */
    protected $serialNumber="";
    protected $shutterCount=-1;

    protected $toDecode=Array();

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
      $this->maker = MAKER_NIKON;
      switch($makerSignature)
      {
        case MakerNotesSignatures::Nikon2Header:
          $this->header = MakerNotesSignatures::Nikon2Header;
          $this->headerSize = MakerNotesSignatures::Nikon2HeaderSize;
          break;
        case MakerNotesSignatures::Nikon3Header:
          $this->header = MakerNotesSignatures::Nikon3Header;
          $this->headerSize = MakerNotesSignatures::Nikon3HeaderSize;
          break;
      }

      // offset inside Nikon maker note are relative
      $offset=-10;

      parent::__construct($data, $offset, $byteOrder);

      $this->processEncryptedTags();
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
      $this->tagDef = new NikonTags();
    }

    /**
     * skip the IFD header
     */
    protected function skipHeader($headerSize=0)
    {
      parent::skipHeader($headerSize);
      if($this->header == MakerNotesSignatures::Nikon3Header)
      {
        /*
         * the nikon3header is made of 7 char, and then 3 next char ?????
         */
        $header=$this->data->readASCII(3);


        $header=$this->data->readASCII(2);
        /*
         * The Nikon3Header is formatted as a TIFF header, but the class is not
         * derived from TiffReader, because we can think there is no more than
         * one IFD in the maker notes.
         * By this way, it's easier to skip the header and start reading the
         * entries.
         *
         * begins wih "II" or "MM" (indicate the byte order)
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
            $header=$this->data->readULong();
          }
        }
      }
    }

    /**
     * encrypted values are processed in one shot when all the tags are processed
     * with this method, we are sure the "SerialNumber" (0x001d) and the
     * "ShutterCount" (0x00a7) tags are initialized
     */
    protected function processEncryptedTags()
    {
      foreach($this->toDecode as $key=>$val)
      {
        $tagIndex=$this->getTagIndexById($key);
        if($tagIndex>-1)
        {
          $this->entries[$tagIndex]->getTag()->setLabel($this->processSpecialTag($key, $val[0], $val[1]));
          //echo sprintf("%04x * %s => %s<br>",$key,ConvertData::toHexDump($val[0], ByteType::ASCII),$this->processSpecialTag($key, $val[0], $val[1]));
        }
      }
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
        case 0x0001: // "MakerNoteVersion"
          // 0x30323030 => String "0200" => 2.00
          $major=substr($values,0,2);
          if(substr($values,0,1)=="0")
          {
            $major=substr($values,1,1);
          }
          else
          {
            $major=substr($values,0,2);
          }
          $minor=substr($values,2);
          $returned=sprintf("%s.%s", $major, $minor);
          break;
        case 0x001d: // "SerialNumber"
          $returned=ConvertData::toStrings($values);
          $this->serialNumber=$returned;
          break;
        case 0x0003: // "ColorMode"
        case 0x0004: // "Quality"
        case 0x0005: // "WhiteBalance"
        case 0x0006: // "Sharpness"
        case 0x0007: // "FocusMode"
        case 0x0008: // "FlashSetting"
        case 0x0009: // "FlashType"
        case 0x000f: // "ISOSelection"
        case 0x0080: // "ImageAdjustment"
        case 0x0081: // "ToneComp"
        case 0x0082: // "AuxiliaryLens"
        case 0x008D: // "ColorHue"
        case 0x008f: // "SceneMode"
        case 0x0090: // "LightSource"
        case 0x0095: // "NoiseReduction"
        case 0x009c: // "SceneAssist"
        case 0x00a0: // "SerialNumber"
        case 0x00a9: // "ImageOptimization"
        case 0x00aa: // "Saturation"
        case 0x00ab: // "VariProgram"
        case 0x0e09: // "NikonCaptureVersion"
          /*
           * null terminated strings
           */
          $returned=ConvertData::toStrings($values);
          break;
        case 0x092: // "HueAdjustment"
        case 0x00a2: // "ImageDataSize"
          $returned=$values;
          break;
        case 0x0a7: // "ShutterCount"
          $this->shutterCount=$values;
          $returned=$values;
          break;
        case 0x001f: // "VRInfo"
          $returned=(ord($values{4})==1)?"On":"Off";
          break;
        case 0x0083: // "LensType"
          $tag=$this->tagDef->getTagById(0x0083);

          $returned=Array();
          if(($values & 0x0001) == 0x0001)
            $returned[]=$tag['tagValues.specialValues'][0x0001];

          if(($values & 0x0002) == 0x0002)
            $returned[]=$tag['tagValues.specialValues'][0x0002];

          if(($values & 0x0004) == 0x0004)
            $returned[]=$tag['tagValues.specialValues'][0x0004];

          if(($values & 0x0008) == 0x0008)
            $returned[]=$tag['tagValues.specialValues'][0x0008];
          unset($tag);
          break;
        case 0x0084: // "Lens"
          /* array of 4 rationnal
           * - short focal
           * - long focal
           * - aperture at short focal
           * - aperture at long focal
           *
           * ==> 18-70mm f/3.5-4.5
           */
          $result=array();
          foreach($values as $val)
          {
            if($val[1]==0) $val[1]==1;
            $result[]=$val[0]/$val[1];
          }

          if($result[0]!=$result[1])
          {
            $returned=sprintf("%.0f-%.0fmm ", $result[0], $result[1]);
          }
          else
          {
            $returned=sprintf("%.0fmm ", $result[0]);
          }

          if($result[2]!=$result[3])
          {
            $returned.=sprintf("f/%.1f-%.1f", $result[2], $result[3]);
          }
          else
          {
            $returned.=sprintf("f/%.1f", $result[2]);
          }
          break;
        case 0x0086: // "DigitalZoom"
          if($values[1]==0) $values[1]=1;
          $returned=sprintf("x%.1f", $values[0]/$values[1]);
          break;
        case 0x0088: // "AFInfo"
          /* - shortInt : AFAreaMode
           * - shortInt : AFPoint
           * - longInt  : AFPointsInFocus
           */
          $tag=$this->tagDef->getTagById(0x0088);

          $values.="\0\0\0\0";

          $returned=Array();

          $tmp=ord($values{0});
          $returned['AFAreaMode'] = $tag['tagValues.specialValues'][0][$tmp];

          $tmp=ord($values{1});
          $returned['AFPoint'] = $tag['tagValues.specialValues'][1][$tmp];

          if($values=="\x00\x07\xff\xff")
          {
            $returned['AFPointsInFocus'] = $tag['tagValues.specialValues'][2][$values];
          }
          else
          {
            $tmp=ord($values{2}) * 256 + ord($values{3});
            $returned['AFPointsInFocus']=Array();
            foreach($tag['tagValues.specialValues'][2] as $key => $val)
            {
              if(($tmp & $key) == $key)
                $returned['AFPointsInFocus'][]=$val;
            }
          }
          unset($tag);
          break;
        case 0x0089: // "ShootingMode"
          $returned=Array();
          $tag=$this->tagDef->getTagById(0x0089);

          if(!($values & 0x87))
          {
            $returned[]=$tag['tagValues.specialValues'][0x00];
          }

          if(preg_match("/.*d70.*/i",GlobalTags::getExifMaker()))
          {
            $bit5=1;
          }
          else
          {
            $bit5=0;
          }

          if($values)
          {
            foreach($tag['tagValues.specialValues'] as $key => $val)
            {
              if((($values & $key) == $key) && ($key!=0x00))
              {
                if($key==0x20)
                {
                  $returned[]=$val[$bit5];
                }
                else
                {
                  $returned[]=$val;
                }
              }
            }
          }
          unset($tag);
          break;
        case 0x0098: // "LensData"
          if(($this->shutterCount==-1 or $this->serialNumber=="") and
            ( substr($values,0,2)=="02" ))
          {
            $this->toDecode[0x0098]=Array($values, $type);
          }
          $returned=$this->readLensData($values);
          break;
        case 0x0099: // "RawImageCenter"
          $returned=Array(
            'x' => $values[0],
            'y' => $values[1],
          );
          break;
        case 0x009a: // "SensorPixelSize"
          if($values[0][1]==0) $values[0][1]=1;
          if($values[1][1]==0) $values[1][1]=1;

          $returned=sprintf("%.1f x %.1f µm", ($values[0][0]/$values[0][1]), ($values[1][0]/$values[1][1]));
          break;
        default:
          $returned="Not yet implemented;".ConvertData::toHexDump($tagId, ByteType::USHORT)." => ".ConvertData::toHexDump($values, $type);
          break;
      }
      return($returned);
    }

    /**
     * this function is used to decrypt datas from the Nikon "LensData" tag
     *
     * @param String $data : data from the exif.Nikon.LensData metadata
     * @return Array : list of properties + lens name (computed)
     */
    private function readLensData($data)
    {
      $returned="";
      $nfo=Array();
      $dataReader=new Data($data, $this->byteOrder);

      $nfo['LensDataVersion']=$dataReader->readASCII(4);

      if(substr($nfo['LensDataVersion'],0,2)=="02")
      {
        // in this case, data are encrypted
        $decrypted=$nfo['LensDataVersion'].$this->decryptData($this->serialNumberInteger(), $this->shutterCount,$dataReader->readASCII(-1,4));
        $dataReader->setData($decrypted);
      }

      switch($nfo['LensDataVersion'])
      {
        case '0100' :
            $nfo['LensIDNumber']=$dataReader->readUByte(6);
            $nfo['LensFStops']=$dataReader->readUByte(7);
            $nfo['MinFocalLength']=$dataReader->readUByte(8);
            $nfo['MaxFocalLength']=$dataReader->readUByte(9);
            $nfo['MaxApertureAtMinFocal']=$dataReader->readUByte(10);
            $nfo['MaxApertureAtMaxFocal']=$dataReader->readUByte(11);
            $nfo['MCUVersion']=$dataReader->readUByte(12);
          break;
        case '0101' :
        case '0201' :
        case '0202' :
        case '0203' :
            $nfo['LensIDNumber']=$dataReader->readUByte(11);
            $nfo['LensFStops']=$dataReader->readUByte(12);
            $nfo['MinFocalLength']=$dataReader->readUByte(13);
            $nfo['MaxFocalLength']=$dataReader->readUByte(14);
            $nfo['MaxApertureAtMinFocal']=$dataReader->readUByte(15);
            $nfo['MaxApertureAtMaxFocal']=$dataReader->readUByte(16);
            $nfo['MCUVersion']=$dataReader->readUByte(17);
          break;
        case '0204' :
            $nfo['LensIDNumber']=$dataReader->readUByte(12);
            $nfo['LensFStops']=$dataReader->readUByte(13);
            $nfo['MinFocalLength']=$dataReader->readUByte(14);
            $nfo['MaxFocalLength']=$dataReader->readUByte(15);
            $nfo['MaxApertureAtMinFocal']=$dataReader->readUByte(16);
            $nfo['MaxApertureAtMaxFocal']=$dataReader->readUByte(17);
            $nfo['MCUVersion']=$dataReader->readUByte(18);
          break;
      }

      $keyLens = sprintf("%02X %02X %02X %02X %02X %02X %02X %02X",
        $nfo['LensIDNumber'],
        $nfo['LensFStops'],
        $nfo['MinFocalLength'],
        $nfo['MaxFocalLength'],
        $nfo['MaxApertureAtMinFocal'],
        $nfo['MaxApertureAtMaxFocal'],
        $nfo['MCUVersion'],
        $this->getTagById(0x0083)->getValue()
      );

      $tag=$this->tagDef->getTagById(0x0098);
      if(array_key_exists($keyLens, $tag['tagValues.lenses']))
      {
        $returned = $tag['tagValues.lenses'][$keyLens];
      }
      else
      {
        $returned = $tag['tagValues.lenses']['unknown']." (".$keyLens." / ".$nfo['LensDataVersion'].")";
      }

      if(is_array($returned))
        $returned=$returned[0];

      unset($data);
      unset($nfo);
      return($returned);
    }

    /**
     * Nikon encrypt some data
     * This function is used to decrypt them. Don't ask anything about "how does
     * it work" abd "what's it doing", I just translated the C++ & Perl code
     * from Exiv2, Exiftool & Raw Photo Parser (Copyright 2004-2006 Dave Coffin)
     *
     * @param Integer $serialNumber : the camera serial number, in Integer
     *                                format (from the 0x001d tag, not the 0x00a0)
     * @param Integer $shutterCount : shutterCount value in the file
     * @param String $data : data to decrypt
     * @param Integer $decryptedLength : number of byte to decrypt
     * @return String : the decrypted data
     */
    private function decryptData($serialNumber, $shutterCount, $data, $decryptedLength=0)
    {
      $xlat = Array(
                Array(0xc1,0xbf,0x6d,0x0d,0x59,0xc5,0x13,0x9d,0x83,0x61,0x6b,0x4f,0xc7,0x7f,0x3d,0x3d,
                      0x53,0x59,0xe3,0xc7,0xe9,0x2f,0x95,0xa7,0x95,0x1f,0xdf,0x7f,0x2b,0x29,0xc7,0x0d,
                      0xdf,0x07,0xef,0x71,0x89,0x3d,0x13,0x3d,0x3b,0x13,0xfb,0x0d,0x89,0xc1,0x65,0x1f,
                      0xb3,0x0d,0x6b,0x29,0xe3,0xfb,0xef,0xa3,0x6b,0x47,0x7f,0x95,0x35,0xa7,0x47,0x4f,
                      0xc7,0xf1,0x59,0x95,0x35,0x11,0x29,0x61,0xf1,0x3d,0xb3,0x2b,0x0d,0x43,0x89,0xc1,
                      0x9d,0x9d,0x89,0x65,0xf1,0xe9,0xdf,0xbf,0x3d,0x7f,0x53,0x97,0xe5,0xe9,0x95,0x17,
                      0x1d,0x3d,0x8b,0xfb,0xc7,0xe3,0x67,0xa7,0x07,0xf1,0x71,0xa7,0x53,0xb5,0x29,0x89,
                      0xe5,0x2b,0xa7,0x17,0x29,0xe9,0x4f,0xc5,0x65,0x6d,0x6b,0xef,0x0d,0x89,0x49,0x2f,
                      0xb3,0x43,0x53,0x65,0x1d,0x49,0xa3,0x13,0x89,0x59,0xef,0x6b,0xef,0x65,0x1d,0x0b,
                      0x59,0x13,0xe3,0x4f,0x9d,0xb3,0x29,0x43,0x2b,0x07,0x1d,0x95,0x59,0x59,0x47,0xfb,
                      0xe5,0xe9,0x61,0x47,0x2f,0x35,0x7f,0x17,0x7f,0xef,0x7f,0x95,0x95,0x71,0xd3,0xa3,
                      0x0b,0x71,0xa3,0xad,0x0b,0x3b,0xb5,0xfb,0xa3,0xbf,0x4f,0x83,0x1d,0xad,0xe9,0x2f,
                      0x71,0x65,0xa3,0xe5,0x07,0x35,0x3d,0x0d,0xb5,0xe9,0xe5,0x47,0x3b,0x9d,0xef,0x35,
                      0xa3,0xbf,0xb3,0xdf,0x53,0xd3,0x97,0x53,0x49,0x71,0x07,0x35,0x61,0x71,0x2f,0x43,
                      0x2f,0x11,0xdf,0x17,0x97,0xfb,0x95,0x3b,0x7f,0x6b,0xd3,0x25,0xbf,0xad,0xc7,0xc5,
                      0xc5,0xb5,0x8b,0xef,0x2f,0xd3,0x07,0x6b,0x25,0x49,0x95,0x25,0x49,0x6d,0x71,0xc7),
                Array(0xa7,0xbc,0xc9,0xad,0x91,0xdf,0x85,0xe5,0xd4,0x78,0xd5,0x17,0x46,0x7c,0x29,0x4c,
                      0x4d,0x03,0xe9,0x25,0x68,0x11,0x86,0xb3,0xbd,0xf7,0x6f,0x61,0x22,0xa2,0x26,0x34,
                      0x2a,0xbe,0x1e,0x46,0x14,0x68,0x9d,0x44,0x18,0xc2,0x40,0xf4,0x7e,0x5f,0x1b,0xad,
                      0x0b,0x94,0xb6,0x67,0xb4,0x0b,0xe1,0xea,0x95,0x9c,0x66,0xdc,0xe7,0x5d,0x6c,0x05,
                      0xda,0xd5,0xdf,0x7a,0xef,0xf6,0xdb,0x1f,0x82,0x4c,0xc0,0x68,0x47,0xa1,0xbd,0xee,
                      0x39,0x50,0x56,0x4a,0xdd,0xdf,0xa5,0xf8,0xc6,0xda,0xca,0x90,0xca,0x01,0x42,0x9d,
                      0x8b,0x0c,0x73,0x43,0x75,0x05,0x94,0xde,0x24,0xb3,0x80,0x34,0xe5,0x2c,0xdc,0x9b,
                      0x3f,0xca,0x33,0x45,0xd0,0xdb,0x5f,0xf5,0x52,0xc3,0x21,0xda,0xe2,0x22,0x72,0x6b,
                      0x3e,0xd0,0x5b,0xa8,0x87,0x8c,0x06,0x5d,0x0f,0xdd,0x09,0x19,0x93,0xd0,0xb9,0xfc,
                      0x8b,0x0f,0x84,0x60,0x33,0x1c,0x9b,0x45,0xf1,0xf0,0xa3,0x94,0x3a,0x12,0x77,0x33,
                      0x4d,0x44,0x78,0x28,0x3c,0x9e,0xfd,0x65,0x57,0x16,0x94,0x6b,0xfb,0x59,0xd0,0xc8,
                      0x22,0x36,0xdb,0xd2,0x63,0x98,0x43,0xa1,0x04,0x87,0x86,0xf7,0xa6,0x26,0xbb,0xd6,
                      0x59,0x4d,0xbf,0x6a,0x2e,0xaa,0x2b,0xef,0xe6,0x78,0xb6,0x4e,0xe0,0x2f,0xdc,0x7c,
                      0xbe,0x57,0x19,0x32,0x7e,0x2a,0xd0,0xb8,0xba,0x29,0x00,0x3c,0x52,0x7d,0xa8,0x49,
                      0x3b,0x2d,0xeb,0x25,0x49,0xfa,0xa3,0xaa,0x39,0xa7,0xc5,0xa7,0x50,0x11,0x36,0xfb,
                      0xc6,0x67,0x4a,0xf5,0xa5,0x12,0x65,0x7e,0xb0,0xdf,0xaf,0x4e,0xb3,0x61,0x7f,0x2f)
              );
      $returned="";

      if($decryptedLength==0 or $decryptedLength>strlen($data))
        $decryptedLength=strlen($data);

      $key = 0;
      for($i=0; $i < 4; $i++)
      {
        $key = $key ^ (($shutterCount >> ($i*8)) & 0xff);
      }
      $ci = $xlat[0][$serialNumber & 0xff];
      $cj = $xlat[1][$key];
      $ck = 0x60;

      for($i=0;$i<$decryptedLength;++$i)
      {
        $cj+=$ci*$ck++;
        $returned.= chr(ord($data{$i}) ^ $cj);
      }
      return($returned);
    }

    /**
     * return the serialNumber as an integer
     */
    private function serialNumberInteger()
    {
      if(trim($this->serialNumber)!="")
      {
        return(0+$this->serialNumber);
      }
      elseif(preg_match("/.*d50.*/i",GlobalTags::getExifMaker()))
      {
        //D50
        return(0x22);
      }
      else
      {
        //D200, D40X, ...
        return(0x60);
      }
    }
  }


?>
