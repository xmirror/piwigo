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
 * The GpsTags is the definition of the Gps Exif tags
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 * The GpsTags class is derived from the KnownTags class.
 *
 * ======> See KnownTags.class.php to know more about the tag definitions <=====
 *
 */

  require_once(JPEG_METADATA_DIR."TagDefinitions/KnownTags.class.php");

  /**
   * Define the tags for GPS
   */
  class GpsTags extends KnownTags
  {
    protected $label = "Exif GPS tags";
    protected $tags = Array(
      /*
       * tags with defined values
       */

      // GPSVersionID, tag 0x0000
      0x0000 => Array(
        'tagName'     => "GPSVersionID",
        'schema'      => "GPS",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < GPSVersionID

      // GPSLatitudeRef, tag 0x0001
      0x0001 => Array(
        'tagName'     => "GPSLatitudeRef",
        'schema'      => "GPS",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.special'   => Array(
          'N' => "North",
          'S' => "South",
        ),
      ), // < GPSLatitudeRef

      // GPSLatitude, tag 0x0002
      0x0002 => Array(
        'tagName'     => "GPSLatitude",
        'schema'      => "GPS",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < GPSLatitude

      // GPSLongitudeRef, tag 0x0003
      0x0003 => Array(
        'tagName'     => "GPSLongitudeRef",
        'schema'      => "GPS",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.special'   => Array(
          'E' => "East",
          'W' => "West",
        ),
      ), // < GPSLongitudeRef

      // GPSLongitude, tag 0x0004
      0x0004 => Array(
        'tagName'     => "GPSLongitude",
        'schema'      => "GPS",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < GPSLongitude

      // GPSAltitudeRef, tag 0x0005
      0x0005 => Array(
        'tagName'     => "GPSAltitudeRef",
        'schema'      => "GPS",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x00 => "over the sea",
          0x01 => "under the sea"
        )
      ), // < GPSAltitudeRef

      // GPSAltitude, tag 0x0006
      0x0006 => Array(
        'tagName'     => "GPSAltitude",
        'schema'      => "GPS",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < GPSAltitude

      // GPSTimeStamp, tag 0x0007
      0x0007 => Array(
        'tagName'     => "GPSTimeStamp",
        'schema'      => "GPS",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < GPSTimeStamp

      // GPSSatellites, tag 0x0008
      0x0008 => Array(
        'tagName'     => "GPSSatellites",
        'schema'      => "GPS",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < GPSSatellites

      // GPSStatus, tag 0x0009
      0x0009 => Array(
        'tagName'     => "GPSStatus",
        'schema'      => "GPS",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.special' => Array(
          'A' => "measurement in progress",
          'V' => "measurement interoperability",
          'unknown' => "Unknown",
        )
      ), // < GPSStatus

      // GPSMeasureMode, tag 0x000a
      0x000A => Array(
        'tagName'     => "GPSMeasureMode",
        'schema'      => "GPS",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.special' => Array(
          '2' => "2-dimensional measurement",
          '3' => "3-dimensional measurement",
          'unknown' => "Unknown",
        )
      ), // < GPSMeasureMode

      // GPSDOP, tag 0x000b
      0x000B => Array(
        'tagName'     => "GPSDOP",
        'schema'      => "GPS",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < GPSDOP

      // GPSSpeedRef, tag 0x000c
      0x000C => Array(
        'tagName'     => "GPSSpeedRef",
        'schema'      => "GPS",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.special' => Array(
          'K' => "kilometers per hour",
          'M' => "miles per hour",
          'N' => "knots",
          'unknown' => "Unknown",
        )
      ), // < GPSSpeedRef

      // GPSSpeed, tag 0x000d
      0x000D => Array(
        'tagName'     => "GPSSpeed",
        'schema'      => "GPS",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < GPSSpeed

      // GPSTrackRef, tag 0x000e
      0x000E => Array(
        'tagName'     => "GPSTrackRef",
        'schema'      => "GPS",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.special' => Array(
          'T' => "true direction",
          'M' => "magnetic direction",
          'unknown' => "Unknown",
        )
      ), // < GPSTrackRef

      // GPSTrack, tag 0x000f
      0x000F => Array(
        'tagName'     => "GPSTrack",
        'schema'      => "GPS",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < GPSTrack

      // GPSImgDirectionRef, tag 0x0010
      0x0010 => Array(
        'tagName'     => "GPSImgDirectionRef",
        'schema'      => "GPS",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.special' => Array(
          'T' => "true direction",
          'M' => "magnetic direction",
          'unknown' => "Unknown",
        )
      ), // < GPSImgDirectionRef

      // GPSImgDirection, tag 0x0011
      0x0011 => Array(
        'tagName'     => "GPSImgDirection",
        'schema'      => "GPS",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < GPSImgDirection

      // GPSMapDatum, tag 0x0012
      0x0012 => Array(
        'tagName'     => "GPSMapDatum",
        'schema'      => "GPS",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < GPSMapDatum

      // GPSDestLatitudeRef, tag 0x0013
      0x0013 => Array(
        'tagName'     => "GPSDestLatitudeRef",
        'schema'      => "GPS",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.special'   => Array(
          'N' => "North",
          'S' => "South",
        ),
      ), // < GPSDestLatitudeRef

      // GPSDestLatitude, tag 0x0014
      0x0014 => Array(
        'tagName'     => "GPSDestLatitude",
        'schema'      => "GPS",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < GPSDestLatitude

      // GPSDestLongitudeRef, tag 0x0015
      0x0015 => Array(
        'tagName'     => "GPSDestLongitudeRef",
        'schema'      => "GPS",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.special'   => Array(
          'E' => "East",
          'W' => "West",
        ),
      ), // < GPSDestLongitudeRef

      // GPSDestLongitude, tag 0x0016
      0x0016 => Array(
        'tagName'     => "GPSDestLongitude",
        'schema'      => "GPS",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < GPSDestLongitude

      // GPSDestBearingRef, tag 0x0017
      0x0017 => Array(
        'tagName'     => "GPSDestBearingRef",
        'schema'      => "GPS",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.special' => Array(
          'T' => "true direction",
          'M' => "magnetic direction",
          'unknown' => "Unknown",
        )
      ), // < GPSDestBearingRef

      // GPSDestBearing, tag 0x0018
      0x0018 => Array(
        'tagName'     => "GPSDestBearing",
        'schema'      => "GPS",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < GPSDestBearing

      // GPSDestDistanceRef, tag 0x0019
      0x0019=> Array(
        'tagName'     => "GPSDestDistanceRef",
        'schema'      => "GPS",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.special' => Array(
          'K' => "kilometers per hour",
          'M' => "miles per hour",
          'N' => "knots",
          'unknown' => "Unknown",
        )
      ), // < GPSDestDistanceRef

      // GPSDestDistance, tag 0x001A
      0x001A=> Array(
        'tagName'     => "GPSDestDistance",
        'schema'      => "GPS",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < GPSDestDistance


      // GPSProcessingMethod, tag 0x001B
      0x001B=> Array(
        'tagName'     => "GPSProcessingMethod",
        'schema'      => "GPS",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < GPSProcessingMethod

      // GPSAreaInformation, tag 0x001C
      0x001C=> Array(
        'tagName'     => "GPSAreaInformation",
        'schema'      => "GPS",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < GPSAreaInformation

      // GPSDateStamp, tag 0x001D
      0x001D=> Array(
        'tagName'     => "GPSDateStamp",
        'schema'      => "GPS",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < GPSDateStamp


      // GPSDifferential, tag 0x001E
      0x001E=> Array(
        'tagName'     => "GPSDifferential",
        'schema'      => "GPS",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x00 => "measurement without differential correction",
          0x01 => "differential correction applied"
        )
      ), // < GPSDifferential



    );


    function __destruct()
    {
      parent::__destruct();
    }

  }


?>
