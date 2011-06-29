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
 * The GpsReader class is dedicated to read GPS tags from a sub IFD structure
 *
 * ======> See IfdReader.class.php to know more about an IFD structure <========
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 *
 * The GpsReader class is derived from the IfdReader class.
 *
 * ========> See IfdReader.class.php to know more about common methods <========
 *
 * -----------------------------------------------------------------------------
 */

  require_once(JPEG_METADATA_DIR."TagDefinitions/GpsTags.class.php");
  require_once(JPEG_METADATA_DIR."Readers/MakerNotesReader.class.php");

  class GpsReader extends IfdReader
  {
    protected $schema = Schemas::EXIF;

    function __destruct()
    {
      parent::__destruct();
    }

    /**
     * initialize the definition of the GPS tags
     */
    protected function initializeTagDef()
    {
      $this->tagDef = new GpsTags();
    }

    /**
     * this function do the interpretation of specials tags and overrides the
     * IfdReader function
    */
    protected function processSpecialTag($tagId, $values, $type, $valuesOffset=0)
    {
      switch($tagId)
      {
        case 0x0000: // Version
          $returned=sprintf("%d.%d.%d.%d", $values[0], $values[1], $values[2], $values[3]);
          break;
        case 0x0001: // GPSLatitudeRef
        case 0x0003: // GPSLongitudeRef
        case 0x0013: // GPSDestLatitudeRef
        case 0x0015: // GPSDestLongitudeRef
          $tag=$this->tagDef->getTagById($tagId);
          $key=substr($values, 0, 1);
          if(array_key_exists($key, $tag['tagValues.special']))
          {
            $returned=$tag['tagValues.special'][$key];
          }
          else
          {
            $returned="";
          }
          break;
        case 0x0002: // GPSLatitude
        case 0x0004: // GPSLongitude
        case 0x0014: // GPSDestLatitude
        case 0x0016: // GPSDestLongitude
          /*
           * converted in degrees, minutes and seconds
           */
          $returned=ConvertData::toDMS($values[0], $values[1], $values[2]);
          break;
        case 0x0006: // GPSAltitude
        case 0x000D: // GPSSpeed
        case 0x000F: // GPSTrack
        case 0x0011: // GPSImgDirection
        case 0x0018: // GPSDestBearing
        case 0x001A: // GPSDestDistance
          if($values[1]==0) $values[1]=1;
          $returned=round($values[0]/$values[1],2);
          break;
        case 0x0008: // GPSSatellites
        case 0x0012: // GPSMapDatum
        case 0x001B: // GPSProcessingMethod => not sure about the string format...
        case 0x001C: // GPSAreaInformation => not sure about the string format...
          $returned=ConvertData::toStrings($values);
          break;
        case 0x0009: // GPSStatus
        case 0x000A: // GPSMeasureMode
        case 0x000C: // GPSSpeedRef
        case 0x0019: // GPSDestDistanceRef
        case 0x000E: // GPSTrackRef
        case 0x0010: // GPSImgDirectionRef
        case 0x0017: // GPSDestBearingRef
          $tag=$this->tagDef->getTagById(0x0009);
          $key=substr($values,0,1);
          if(array_key_exists($key, $tag['tagValues.special']))
          {
            $returned=$tag['tagValues.special'][$key];
          }
          else
          {
            $returned=$tag['tagValues.special']['unknown'];
          }
          break;
        case 0x001D: // GPSDateStamp
          $returned=ConvertData::toDateTime($values);
          break;
        default:
          $returned="Not yet implemented;".ConvertData::toHexDump($tagId, ByteType::USHORT)." => ".ConvertData::toHexDump($values, $type);
          break;
      }
      return($returned);
    }

  }


?>
