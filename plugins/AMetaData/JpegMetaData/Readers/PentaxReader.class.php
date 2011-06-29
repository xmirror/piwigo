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
 * The PentaxReader class is the dedicated to read the specific Pentax tags
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
 * The PentaxReader class is derived from the MakerNotesReader class.
 *
 * ======> See MakerNotesReader.class.php to know more about common methods <======
 *
 * -----------------------------------------------------------------------------
 */



  require_once(JPEG_METADATA_DIR."Common/GlobalTags.class.php");
  require_once(JPEG_METADATA_DIR."TagDefinitions/PentaxTags.class.php");
  require_once(JPEG_METADATA_DIR."Readers/MakerNotesReader.class.php");

  class PentaxReader extends MakerNotesReader
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
      $this->maker = MAKER_PENTAX;
      switch($makerSignature)
      {
        case MakerNotesSignatures::PentaxHeader:
          $this->header = MakerNotesSignatures::PentaxHeader;
          $this->headerSize = MakerNotesSignatures::PentaxHeaderSize;
          break;
        case MakerNotesSignatures::Pentax2Header:
          $this->header = MakerNotesSignatures::Pentax2Header;
          $this->headerSize = MakerNotesSignatures::Pentax2HeaderSize;
          break;
      }

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
      $this->tagDef = new PentaxTags();
    }

    /**
     * skip the IFD header
     */
    protected function skipHeader($headerSize=0)
    {
      parent::skipHeader($this->headerSize);
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
        case 0x0000: // "Version"
          $returned=sprintf("%d.%d.%d.%d", $values[0], $values[1], $values[2], $values[3]);
          break;
        case 0x0002: // "PreviewResolution"
          $returned=sprintf("%dx%d", $values[0], $values[1]);
          break;
        case 0x0003: // "PreviewLength",
        case 0x0004: // "PreviewOffset",
          $returned=$values;
          break;
        case 0x0006: // "Date",
          $returned=sprintf("%04d/%02d/%02d", ConvertData::toUShort($values, BYTE_ORDER_BIG_ENDIAN), ConvertData::toUByte($values{2}), ConvertData::toUByte($values{3}));
          break;
        case 0x0007: // "Time",
          $returned=sprintf("%02d:%02d:%02d", ConvertData::toUByte($values{0}), ConvertData::toUByte($values{1}), ConvertData::toUByte($values{2}));
          break;
        case 0x000c: // "Flash",
          $tag=$this->tagDef->getTagById(0x000c);
          $returned=Array();
          if(array_key_exists($values[0], $tag['tagValues.special'][0]))
            $returned[]=$tag['tagValues.special'][0][$values[0]];
          if(array_key_exists($values[1], $tag['tagValues.special'][1]))
            $returned[]=$tag['tagValues.special'][1][$values[1]];
          unset($tag);
          break;
        case 0x0012: // "ExposureTime", from exiftool
           $returned=ConvertData::toExposureTime($values/100000);
          break;
        case 0x0013: // "FNumber",
          $returned=ConvertData::toFNumber($values/10);
          break;
        case 0x0016: // "ExposureCompensation",
          $returned=sprintf("%.1f EV", ($values-50)/10);
          break;
        case 0x0018: // "AutoBracketing",
          /*
           * $values if an array
           *  [0] : exposure compensation
           *  [1] : bracketing mode
           */
          if($values[0]<10)
            $returned=Array(($values[0]/3)." EV");
          else
            $returned=Array(($values[0]-9.5)." EV");

          if($values[1]==0)
            $returned[]="No extended bracketing";
          else
          {
            $type = $values[1] >> 8;
            $range = $values[1] & 0xff;
            switch ($type)
            {
              case 1:
                $returned[]="WB-BA";
                break;
              case 2:
                $returned[]="WB-GM";
                break;
              case 3:
                $returned[]="Saturation";
                break;
              case 4:
                $returned[]="Sharpness";
                break;
              case 5:
                $returned[]="Contrast";
                break;
              default:
                $returned[]="Unknown;".ConvertData::toHexDump($type, ByteType::USHORT);
                break;
            }
            $returned[]=$range;
          }
          break;
        case 0x001b: // "BlueBalance",
        case 0x001c: // "RedBalance", from exiftool
          $returned=sprintf("%d", $values/256+0.5);
          break;
        case 0x001d: // "FocalLength",
          /* note : in exiftool, the formula change with the camera model... ? */
          $returned=($values/100)." mm";
          break;
        case 0x001e: // "DigitalZoom", from exiftool
          $returned=($values/100);
          break;
        case 0x0025: // "HometownDST",
        case 0x0026: // "DestinationDST",
          $returned=($values==1)?"Yes":"No";
          break;
        case 0x0027: // "DSPFirmwareVersion",
        case 0x0028: // "CPUFirmwareVersion",
          $returned=sprintf("%d.%d.%d.%d", 0xff-ConvertData::toUByte($values{0}), 0xff-ConvertData::toUByte($values{1}), 0xff-ConvertData::toUByte($values{2}), 0xff-ConvertData::toUByte($values{3}));
          break;
        case 0x002d: // "EffectiveLV",
          $returned=sprintf("%.1f", $values/1024);
          break;
        case 0x0039: // "RawImageSize",
          $returned=sprintf("%dx%d", $values[0], $values[1]);
          break;
        case 0x003e: // "PreviewImageBorders",
          $returned=ConvertData::toHexDump($values, ByteType::UBYTE);
          break;
        case 0x003f: // "LensType",
          $tag=$this->tagDef->getTagById(0x003f);
          $id=$values[1]+($values[0]<<8);
          if(!array_key_exists($id, $tag['tagValues.special'])) $id=0xffff;

          $returned="";

          $lensesList=$tag['tagValues.special'][$id];
          if(is_array($lensesList))
          {
            foreach($lensesList as $lens)
            {
              /*
               * If there is more than one lens associated with a lens id
               *
               * 1/ try to found the min/max focals of the lens
               * 2/ try to found the min/max aperture of the lens
               * 3/ if focal is fixed, make min = max
               * 4/ if aperture is constant, make min)max
               * 5/ look if : min focal <= photo focal <= max focal  and
               *              photo aperture >= min aperture
               *            if yes, the lens is returned, otherwise test next
               *            lens
               */
              preg_match("/.*\s(?:([0-9]+){1}(?:-([0-9]+))?)mm.*/i", $lens, $focals);
              preg_match("/.*\sF(?:([0-9\.]+){1}(?:-([0-9\.]+))?).*/i", $lens, $apertures);

              if(count($focals)==2)
              {
                //focal is not a zoom, min = max
                $focals[]=$focal[1];
              }
              elseif(count($focals)==0)
              {
                $focal=Array(0,0,0);
              }


              if(count($apertures)==2)
              {
                //aperture is constant, min = max
                $apertures[]=$apertures[1];
              }
              elseif(count($apertures)==0)
              {
                $apertures=Array(0,0,0);
              }

              $focal=GlobalTags::getExifFocal();
              if($focal=="") $focal=-1;

              $aperture=GlobalTags::getExifAperture();
              if($aperture=="") $aperture=-1;

              if($focals[1]<=$focal && $focal<=$focals[2] && $aperture>=$apertures[1] && $returned=="")
              {
                $returned=$lens;
              }

              unset($lens);
              unset($focals);
              unset($apertures);
            }
            if($returned=="")
            {
              // no lens seems to be valid, returns the lens list
              $returned=$lensesList;
            }
          }
          else
          {
            // not a list, just a single lens
            $returned=$lensesList;
          }

          unset($tag);
          unset($id);
          break;
        case 0x0040: // "SensitivityAdjust", from exiftool
          /* is the conversion perl => php is good !? */
          $returned=sprintf("%.1f", ($values-50)/10+50);
          break;
        case 0x0047: // "Temperature",
          $returned=(($values>127)?256-$values:$values)."°C";
          break;
        case 0x0048: // "AELock",
        case 0x0049: // "NoiseReduction",
          $returned=($values==1)?"On":"Off";
          break;
        case 0x004d: // "FlashExposureCompensation",
          $returned=ConvertData::toEV($values/256);
          break;
        case 0x0050: // "ColorTemperature", from exiftool
          $returned=53190 -$values;
          break;

        /* theses tags decoding is not yet implemented
         * have to take a look on the algorithm in exiftool (it seems to work
         * but I don't understand everything...)
         */

        case 0x0205: // "ShotInfo",
        case 0x0206: // "AEInfo",
        case 0x0207: // "LensInfo",
        case 0x0208: // "FlashInfo",
        case 0x0209: // "AEMeteringSegments",
        case 0x020a: // "FlashADump",
        case 0x020b: // "FlashBDump",
        case 0x020d: // "WB_RGGBLevelsDaylight",
        case 0x020e: // "WB_RGGBLevelsShade",
        case 0x020f: // "WB_RGGBLevelsCloudy",
        case 0x0210: // "WB_RGGBLevelsTungsten",
        case 0x0211: // "WB_RGGBLevelsFluorescentD",
        case 0x0212: // "WB_RGGBLevelsFluorescentN",
        case 0x0213: // "WB_RGGBLevelsFluorescentW",
        case 0x0214: // "WB_RGGBLevelsFlash",
        case 0x0215: // "CameraInfo",
        case 0x0216: // "BatteryInfo",
        case 0x021f: // "AFInfo",
        case 0x0222: // "ColorInfo",

        case 0x0029: // "FrameNumber",
        case 0x0041: // "DigitalFilter",
        case 0x005c: // "ShakeReduction",
        case 0x005d: // "ShutterCount",
        case 0x0200: // "BlackPoint",
        case 0x0201: // "WhitePoint",
        case 0x0203: // "ColorMatrixA",
        case 0x0204: // "ColorMatrixB",
        default:
          $returned="Not yet implemented;".ConvertData::toHexDump($tagId, ByteType::USHORT)." => ".ConvertData::toHexDump($values, $type);
          break;
      }
      return($returned);
    }
  }

?>
