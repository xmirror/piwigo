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
 * The PentaxTags is the definition of the specific Pentax Exif tags
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 * The PentaxTags class is derived from the KnownTags class.
 *
 * ======> See KnownTags.class.php to know more about the tag definitions <=====
 *
 *
 * Pentax values from
 *  - Exiftool by Phil Harvey    => http://www.sno.phy.queensu.ca/~phil/exiftool/
 *                                  http://owl.phy.queensu.ca/~phil/exiftool/TagNames
 *  - Exiv2 by Andreas Huggel    => http://www.exiv2.org/
 *
 */

  require_once(JPEG_METADATA_DIR."TagDefinitions/KnownTags.class.php");

  /**
   * Define the tags for Pentax camera
   */
  class PentaxTags extends KnownTags
  {
    protected $label = "Pentax specific tags";
    protected $tags = Array(
      /*
       * tags with defined values
       */

      // ShootingMode, tag 0x0001
      0x0001 => Array(
        'tagName'     => "ShootingMode",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0 => "Auto",
          1 => "Night-Scene",
          2 => "Manual"
        )
      ), // < ShootingMode

      // CameraModel, tag 0x0005
      0x0005 => Array(
        'tagName'     => "CameraModel",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x0000d => "Optio 330/430",
          0x12926 => "Optio 230",
          0x12958 => "Optio 330GS",
          0x12962 => "Optio 450/550",
          0x1296c => "Optio S",
          0x12994 => "*ist D",
          0x129b2 => "Optio 33L",
          0x129bc => "Optio 33LF",
          0x129c6 => "Optio 33WR/43WR/555",
          0x129d5 => "Optio S4",
          0x12a02 => "Optio MX",
          0x12a0c => "Optio S40",
          0x12a16 => "Optio S4i",
          0x12a34 => "Optio 30",
          0x12a52 => "Optio S30",
          0x12a66 => "Optio 750Z",
          0x12a70 => "Optio SV",
          0x12a75 => "Optio SVi",
          0x12a7a => "Optio X",
          0x12a8e => "Optio S5i",
          0x12a98 => "Optio S50",
          0x12aa2 => "*ist DS",
          0x12ab6 => "Optio MX4",
          0x12ac0 => "Optio S5n",
          0x12aca => "Optio WP",
          0x12afc => "Optio S55",
          0x12b10 => "Optio S5z",
          0x12b1a => "*ist DL",
          0x12b24 => "Optio S60",
          0x12b2e => "Optio S45",
          0x12b38 => "Optio S6",
          0x12b4c => "Optio WPi",
          0x12b56 => "BenQ DC X600",
          0x12b60 => "*ist DS2",
          0x12b62 => "Samsung GX-1S",
          0x12b6a => "Optio A10",
          0x12b7e => "*ist DL2",
          0x12b80 => "Samsung GX-1L",
          0x12b9c => "K100D",
          0x12b9d => "K110D",
          0x12ba2 => "K100D Super",
          0x12bb0 => "Optio T10",
          0x12be2 => "Optio W10",
          0x12bf6 => "Optio M10",
          0x12c1e => "K10D",
          0x12c20 => "Samsung GX10",
          0x12c28 => "Optio S7",
          0x12c2d => "Optio L20",
          0x12c32 => "Optio M20",
          0x12c3c => "Optio W20",
          0x12c46 => "Optio A20",
          0x12c8c => "Optio M30",
          0x12c78 => "Optio E30",
          0x12c7d => "Optio E35",
          0x12c82 => "Optio T30",
          0x12c96 => "Optio W30",
          0x12ca0 => "Optio A30",
          0x12cb4 => "Optio E40",
          0x12cbe => "Optio M40",
          0x12cc8 => "Optio Z10",
          0x12cdc => "Optio S10",
          0x12ce6 => "Optio A40",
          0x12cf0 => "Optio V10",
          0x12cd2 => "K20D",
          0x12cdc => "Optio S10",
          0x12ce6 => "Optio A40",
          0x12cf0 => "Optio V10",
          0x12cfa => "K200D",
          0x12d04 => "Optio S12", //from exiftool
          0x12d0e => "Optio E50",
          0x12d18 => "Optio M50",
          0x12d2c => "Optio V20", //from exiftool
          0x12d40 => "Optio W60", //from exiftool
          0x12d4a => "Optio M60", //from exiftool
          0x12d68 => "Optio E60", //from exiftool
          0x12d72 => "K2000", //from exiftool
          0x12d73 => "K-m", //from exiftool
          0x12d86 => "Optio P70", //from exiftool
          0x12d9a => "Optio E70", //from exiftool
          0x12dae => "X70", //from exiftool
          0x12db8 => "K-7", //from exiftool
          0x12dcc => "Optio W80", //from exiftool
          0x12dea => "Optio P80", //from exiftool
          0x12df4 => "Optio WS80", //from exiftool
          0x12dfe => "K-x", //from exiftool
            )
      ), // < CameraModel

      // Quality, tag 0x0008
      0x0008 => Array(
        'tagName'     => "Quality",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0 => "Good",
          1 => "Better",
          2 => "Best",
          3 => "TIFF",
          4 => "RAW",
          5 => "Premium"
        )
      ), // < Quality


      // Size, tag 0x0009
      0x0009 => Array(
        'tagName'     => "Size",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0 => "640x480",
          1 => "Full",
          2 => "1024x768",
          3 => "1280x960",
          4 => "1600x1200",
          5 => "2048x1536",
          8 => "2560x1920 or 2304x1728",
          9 => "3072x2304",
          10 => "3264x2448",
          19 => "320x240",
          20 => "2288x1712",
          21 => "2592x1944",
          22 => "2304x1728 or 2592x1944",
          23 => "3056x2296",
          25 => "2816x2212 or 2816x2112",
          27 => "3648x2736",
          29 => "4000x3000",
          37 => "3008x2000"
        )
      ), // < Size

      // PictureMode, tag 0x000b, from exiftool
      0x000b => Array(
        'tagName'     => "PictureMode",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0  => "Program",
          1  => "Shutter Speed Priority",
          2  => "Program AE",
          3  => "Manual",
          5  => "portrait",
          6  => "Landscape",
          8  => "Sport",
          9  => "night scene",
          11 => "Soft",
          12 => "Surf & Snow",
          13 => "Candlelight",
          14 => "Autumn",
          15 => "macro",
          17 => "Fireworks",
          18 => "Text",
          19 => "Panorama",
          30 => "Self Portrait",
          31 => "Illustrations",
          33 => "Digital Filter",
          35 => "Night Scene Portrait",
          37 => "Museum",
          38 => "Food",
          39 => "Underwater",
          40 => "Green Mode",
          49 => "Light Pet",
          50 => "Dark Pet",
          51 => "Medium Pet",
          53 => "Underwater",
          54 => "Candlelight",
          55 => "Natural Skin Tone",
          56 => "Synchro Sound Record",
          58 => "Frame Composite",
          59 => "Report",
          60 => "Kids",
          61 => "Blur Reduction",
          65 => "Half-length Portrait",
          255=> "Digital Filter?",
        )
      ),

      // Flash, tag 0x000c
      0x000c => Array(
        'tagName'     => "Flash",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.special'   => Array(
          Array(
            0x000 => "auto, did not fire",
            0x001 => "off, did not fire",
            0x002 => "on, did not fire", //from exiftool
            0x003 => "auto, did not fire, red-eye reduction",
            0x100 => "auto, fired",
            0x102 => "on, fired",
            0x103 => "auto, fired, red-eye reduction",
            0x104 => "on, red-eye reduction",
            0x105 => "on, wireless (master)", // from exiftool
            0x106 => "on, wireless (control)", // from exiftool
            0x108 => "on, soft",
            0x109 => "on, slow-sync",
            0x10a => "on, slow-sync, red-eye reduction",
            0x10b => "on, trailing-curtain sync"
          ),
          Array( //from exiftool
            0x0000 => "n/a - off-auto-aperture",
            0x003f => "internal",
            0x0100 => "external, auto",
            0x023f => "external, flash problem",
            0x0300 => "external, manual",
            0x0304 => "external, p-ttl auto",
            0x0305 => "external, contrast-control sync",
            0x0306 => "external, high-speed sync",
            0x030c => "external, wireless",
            0x030d => "external, wireless, high-speed sync"
          )
        )
      ), // < Flash

      // Focus, tag 0x000d
      0x000d => Array(
        'tagName'     => "Focus",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0 => "normal",
          1 => "macro",
          2 => "infinity",
          3 => "Manual",
          4 => "super macro", // from exiftool
          5 => "pan focus",
          16 => "AF-S",
          17 => "AF-C",
          18 => "AF-A", // from exiftool
        )
      ), // < Focus

      // AFPoint, tag 0x000e
      0x000e => Array(
        'tagName'     => "AFPoint",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0xffff => "Auto",
          0xfffe => "Fixed Center",
          0xfffd => "Automatic Tracking AF", //from exiftool
          0xfffc => "Face Recognition AF", //from exiftool
          1 => "Upper-left",
          2 => "Top",
          3 => "Upper-right",
          4 => "Left",
          5 => "Mid-left",
          6 => "Center",
          7 => "Mid-right",
          8 => "Right",
          9 => "Lower-left",
          10 => "Bottom",
          11 => "Lower-right"
        )
      ), // < AFPoint

      // AFPointsInFocus, tag 0x000f, from exiftool
      0x000f => Array(
        'tagName'     => "AFPointsInFocus",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0xffff => "none",
          0 => "Fixed Center or Multiple",
          1 => "Top-left",
          2 => "Top-center",
          3 => "Top-right",
          4 => "Left",
          5 => "Center",
          6 => "Right",
          7 => "Bottom-left",
          8 => "Bottom-center",
          9 => "Bottom-right",
        )
      ),

      // ISO, tag 0x0014
      0x0014 => Array(
        'tagName'     => "ISO",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          3 => "50",
          4 => "64",
          5 => "80",
          6 => "100",
          7 => "125",
          8 => "160",
          9 => "200",
          10 => "250",
          11 => "320",
          12 => "400",
          13 => "500",
          14 => "640",
          15 => "800",
          16 => "1000",
          17 => "1250",
          18 => "1600",
          19 => "2000", //from exiftool
          20 => "2500", //from exiftool
          21 => "3200",
          22 => "4000", //from exiftool
          23 => "5000", //from exiftool
          24 => "6400", //from exiftool

          50 => "50",
          100 => "100",
          200 => "200",
          258 => "50", //from exiftool
          259 => "70", //from exiftool
          260 => "100", //from exiftool
          261 => "140", //from exiftool
          262 => "200", //from exiftool
          263 => "280", //from exiftool
          264 => "400", //from exiftool
          265 => "560", //from exiftool
          266 => "800", //from exiftool
          267 => "1100", //from exiftool
          268 => "1600", //from exiftool
          269 => "2200", //from exiftool
          270 => "3200", //from exiftool
          400 => "400",
          800 => "800",
          1600 => "1600",
          3200 => "3200",
        )
      ), // < ISO

      // MeteringMode, tag 0x0017
      0x0017 => Array(
        'tagName'     => "MeteringMode",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0 => "Multi Segment",
          1 => "Center Weighted",
          2 => "spot"
        )
      ), // < MeteringMode

      // WhiteBalance, tag 0x0019
      0x0019 => Array(
        'tagName'     => "WhiteBalance",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0 => "Auto",
          1 => "Daylight",
          2 => "Shade",
          3 => "Fluorescent",
          4 => "Tungsten",
          5 => "Manual",
          6 => "DaylightFluorescent",
          7 => "DaywhiteFluorescent",
          8 => "WhiteFluorescent",
          9 => "Flash",
          10 => "Cloudy",
          17 => "Kelvin", //from exiftool
          65534 => "Unknown",
          65535 => "User Selected"
        )
      ), // < WhiteBalance

      // WhiteBalanceMode, tag 0x001a
      0x001a => Array(
        'tagName'     => "WhiteBalanceMode",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          1 => "Auto (Daylight)",
          2 => "Auto (Shade)",
          3 => "Auto (Flash)",
          4 => "Auto (Tungsten)",
          6 => "Auto (DaylightFluorescent)", // rom exiftool
          7 => "Auto (DaywhiteFluorescent)",
          8 => "Auto (WhiteFluorescent)",
          10 => "Auto (Cloudy)",
          0xffff => "User-Selected",
          0xfffe => "Preset (Fireworks?)"
        )
      ), // < < WhiteBalanceMode

      // Saturation, tag 0x001f
      0x001f => Array(
        'tagName'     => "Saturation",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0 => "low",
          1 => "normal",
          2 => "high",
          3 => "Med Low",
          4 => "Med High",
          5 => "Very Low",
          6 => "Very High",
          65535 => "none", //from exiftool
        )
      ), // < Saturation

      // Contrast, tag 0x0020
      0x0020 => Array(
        'tagName'     => "Contrast",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0 => "low",
          1 => "normal",
          2 => "high",
          3 => "Med Low",
          4 => "Med High",
          5 => "Very Low",
          6 => "Very High"
        )
      ), // < Contrast

      // Sharpness, tag 0x0021
      0x0021 => Array(
        'tagName'     => "Sharpness",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0 => "Soft",
          1 => "normal",
          2 => "Hard",
          3 => "Med Soft",
          4 => "Med Hard",
          5 => "Very Soft",
          6 => "Very Hard"
        )
      ), // < Sharpness

      // WorldTimeLocation, tag 0x0022
      0x0022 => Array(
        'tagName'     => "WorldTimeLocation",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0 => "Home town",
          1 => "Destination"
        )
      ), // < Location

      // HomeCityName, tag 0x0023
      0x0023 => Array(
        'tagName'     => "HomeCityName",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0 => "Pago Pago",
          1 => "Honolulu",
          2 => "Anchorage",
          3 => "Vancouver",
          4 => "San Fransisco",
          5 => "Los Angeles",
          6 => "Calgary",
          7 => "Denver",
          8 => "Mexico City",
          9 => "Chicago",
          10 => "Miami",
          11 => "Toronto",
          12 => "New York",
          13 => "Santiago",
          14 => "Caracus",
          15 => "Halifax",
          16 => "Buenos Aires",
          17 => "Sao Paulo",
          18 => "Rio de Janeiro",
          19 => "Madrid",
          20 => "London",
          21 => "Paris",
          22 => "Milan",
          23 => "Rome",
          24 => "Berlin",
          25 => "Johannesburg",
          26 => "Istanbul",
          27 => "Cairo",
          28 => "Jerusalem",
          29 => "Moscow",
          30 => "Jeddah",
          31 => "Tehran",
          32 => "Dubai",
          33 => "Karachi",
          34 => "Kabul",
          35 => "Male",
          36 => "Delhi",
          37 => "Colombo",
          38 => "Kathmandu",
          39 => "Dacca",
          40 => "Yangon",
          41 => "Bangkok",
          42 => "Kuala Lumpur",
          43 => "Vientiane",
          44 => "Singapore",
          45 => "Phnom Penh",
          46 => "Ho Chi Minh",
          47 => "Jakarta",
          48 => "Hong Kong",
          49 => "Perth",
          50 => "Beijing",
          51 => "Shanghai",
          52 => "Manila",
          53 => "Taipei",
          54 => "Seoul",
          55 => "Adelaide",
          56 => "Tokyo",
          57 => "Guam",
          58 => "Sydney",
          59 => "Noumea",
          60 => "Wellington",
          61 => "Auckland",
          62 => "Lima",
          63 => "Dakar",
          64 => "Algiers",
          65 => "Helsinki",
          66 => "Athens",
          67 => "Nairobi",
          68 => "Amsterdam",
          69 => "Stockholm",
          70 => "Lisbon",
          71 => "Copenhagen", // from exiftool
        )
      ), // < City names

      // DestinationCityName, tag 0x0024
      0x0024 => Array(
        'tagName'     => "DestinationCityName",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0 => "Pago Pago",
          1 => "Honolulu",
          2 => "Anchorage",
          3 => "Vancouver",
          4 => "San Fransisco",
          5 => "Los Angeles",
          6 => "Calgary",
          7 => "Denver",
          8 => "Mexico City",
          9 => "Chicago",
          10 => "Miami",
          11 => "Toronto",
          12 => "New York",
          13 => "Santiago",
          14 => "Caracus",
          15 => "Halifax",
          16 => "Buenos Aires",
          17 => "Sao Paulo",
          18 => "Rio de Janeiro",
          19 => "Madrid",
          20 => "London",
          21 => "Paris",
          22 => "Milan",
          23 => "Rome",
          24 => "Berlin",
          25 => "Johannesburg",
          26 => "Istanbul",
          27 => "Cairo",
          28 => "Jerusalem",
          29 => "Moscow",
          30 => "Jeddah",
          31 => "Tehran",
          32 => "Dubai",
          33 => "Karachi",
          34 => "Kabul",
          35 => "Male",
          36 => "Delhi",
          37 => "Colombo",
          38 => "Kathmandu",
          39 => "Dacca",
          40 => "Yangon",
          41 => "Bangkok",
          42 => "Kuala Lumpur",
          43 => "Vientiane",
          44 => "Singapore",
          45 => "Phnom Penh",
          46 => "Ho Chi Minh",
          47 => "Jakarta",
          48 => "Hong Kong",
          49 => "Perth",
          50 => "Beijing",
          51 => "Shanghai",
          52 => "Manila",
          53 => "Taipei",
          54 => "Seoul",
          55 => "Adelaide",
          56 => "Tokyo",
          57 => "Guam",
          58 => "Sydney",
          59 => "Noumea",
          60 => "Wellington",
          61 => "Auckland",
          62 => "Lima",
          63 => "Dakar",
          64 => "Algiers",
          65 => "Helsinki",
          66 => "Athens",
          67 => "Nairobi",
          68 => "Amsterdam",
          69 => "Stockholm",
          70 => "Lisbon",
          71 => "Copenhagen", // from exiftool
        )
      ), // < City names


      // ImageProcessing, tag 0x0032, combi-tag 4 bytes
      0x0032 => Array(
        'tagName'     => "ImageProcessing",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 4,
        'implemented' => true,
        'tagValues'   => Array(
          0x00000000 => "Unprocessed",
          0x00000004 => "Digital Filter",
          0x02000000 => "Cropped",
          0x04000000 => "Color Filter",
          0x10000000 => "Frame Synthesis?"
        )
      ), // < ImageProcessing


      // PictureMode, tag 0x0033, combi-tag 3 bytes
      0x0033 => Array(
        'tagName'     => "PictureMode",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 3,
        'implemented' => true,
        'tagValues'   => Array(
          0x000000 => "Program",
          0x000100 => "Hi-speed Program", // from exiftool
          0x000200 => "DOF Program", // from exiftool
          0x000300 => "MTF Program",
          0x000400 => "standard",
          0x000500 => "portrait",
          0x000600 => "Landscape",
          0x000700 => "macro",
          0x000800 => "Sport",
          0x000900 => "Night Scene Portrait",
          0x000a00 => "no flash",
        /* SCN modes (menu-selected) */
          0x000b00 => "night scene",
          0x000c00 => "Surf & Snow",
          0x000d00 => "Text",
          0x000e00 => "Sunset",
          0x000f00 => "Kids",
          0x001000 => "Pet",
          0x001100 => "Candlelight",
          0x001200 => "Museum",
          0x001300 => "Food", //from exiftool
          0x001400 => "Stage Lighting", //from exiftool
          0x001500 => "Night Snap", //from exiftool
        /* AUTO PICT modes (auto-selected) */
          0x010400 => "Auto PICT (Standard)",
          0x010500 => "Auto PICT (Portrait)",
          0x010600 => "Auto PICT (Landscape)",
          0x010700 => "Auto PICT (Macro)",
          0x010800 => "Auto PICT (Sport)",
        /* Manual dial modes */
          0x020000 => "Program AE",
          0x030000 => "Green Mode",
          0x040000 => "Shutter Speed Priority",
          0x050000 => "Aperture Priority",
          0x080000 => "Manual",
          0x090000 => "Bulb",
        /* *istD modes */
          0x020001 => "Program AE",
          0x020101 => "Hi-speed Program",
          0x020201 => "DOF Program",
          0x020301 => "MTF Program",
          0x030001 => "Green Mode",
          0x040001 => "Shutter Speed Priority",
          0x050001 => "Aperture Priority",
          0x060001 => "Program Tv Shift",
          0x070001 => "Program Av Shift",
          0x080001 => "Manual",
          0x090001 => "Bulb",
          0x0a0001 => "Aperture Priority (Off-Auto-Aperture)",
          0x0b0001 => "Manual (Off-Auto-Aperture)",
          0x0c0001 => "Bulb (Off-Auto-Aperture)",
        /* K10D modes */
          0x060000 => "shutter priority",
          0x0d0000 => "Shutter & Aperture Priority AE, 1/2 EV steps",
          0x0d0001 => "Shutter & Aperture Priority AE, 1/3 EV steps",
          0x0f0000 => "Sensitivity Priority AE, 1/2 EV steps",
          0x0f0001 => "Sensitivity Priority AE, 1/3 EV steps",
          0x100000 => "Flash X-Sync Speed AE, 1/2 EV steps",
          0x100001 => "Flash X-Sync Speed AE, 1/3 EV steps",
        /* K-7 , K-x */
          0xff0000 => "Video (30 fps)", // from exiftool
          0xff0400 => "Video (24 fps)", // from exiftool
        /* other modes */
          0x000001 => "Program"
        )
      ), // < PictureMode


      // DriveMode, tag 0x0034, combi-tag 4 bytes
      0x0034 => Array(
        'tagName'     => "DriveMode",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 4,
        'implemented' => true,
        'tagValues'   => Array(
          0x00000000 => "Single-frame;No timer;Shutter button;Single exposure",
          0x01000000 => "Continuous",
          0x02000000 => "Continuous (Hi)",
          0x03000000 => "Burst",
          0xff000000 => "Video", // from exiftool
          0x00010000 => "Self-timer (12 sec)",
          0x00020000 => "Self-timer (2 sec)",
          0x00ff0000 => "n/a", //from exiftool (K-x ?)
          0x00000100 => "Remote Control (3 sec)",
          0x00000200 => "Remote Control",
          0x00000001 => "Multiple Exposure",
          0x000000ff => "Video" //from exiftool
        )
      ), // < DriveMode


      // ColorSpace, tag 0x0037
      0x0037 => Array(
        'tagName'     => "ColorSpace",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0 => "sRGB",
          1 => "Adobe RGB"
        )
      ), // < ColorSpace

      // LensType, tag 0x003f, combi-tag 2 bytes
      0x003f => Array(
        'tagName'     => "LensType",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 2,
        'implemented' => true,
        'tagValues.special'   => Array(
          0x0000 => "M-42 or No Lens",
          0x0100 => "K,M Lens",
          0x0200 => "A Series Lens",
          0x0300 => "Sigma",
          0x0311 => "smc PENTAX-FA SOFT 85mm F2.8",
          0x0312 => "smc PENTAX-F 1.7X AF ADAPTER",
          0x0313 => "smc PENTAX-F 24-50mm F4",
          0x0314 => "smc PENTAX-F 35-80mm F4-5.6",
          0x0315 => "smc PENTAX-F 80-200mm F4.7-5.6",
          0x0316 => "smc PENTAX-F FISH-EYE 17-28mm F3.5-4.5",
          0x0317 => Array(
                      "smc PENTAX-F 100-300mm F4.5-5.6",
                      "Sigma AF 28-300mm F3.5-5.6 DL IF",
                      "Sigma AF 28-300mm F3.5-6.3 DG IF Macro",
                    ),
          0x0318 => "smc PENTAX-F 35-135mm F3.5-4.5",
          0x0319 => Array(
                      "smc PENTAX-F 35-105mm F4-5.6",
                      "Sigma AF 28-300mm F3.5-5.6 DL IF",
                      "Sigma 55-200mm F4-5.6 DC",
                      "Sigma AF 28-300mm F3.5-5.6 DL IF",
                      "Sigma AF 28-300mm F3.5-6.3 DG IF Macro",
                      "Tokina 80-200mm F2.8 ATX-Pro",
                    ),
          0x031a => "smc PENTAX-F* 250-600mm F5.6 ED[IF]",
          0x031b => Array(
                      "smc PENTAX-F 28-80mm F3.5-4.5",
                      "Tokina AT-X Pro AF 28-70mm F2.6-2.8",
                    ),
          0x031c => Array(
                      "smc PENTAX-F 35-70mm F3.5-4.5",
                      "Tokina 19-35mm F3.5-4.5 AF",
                    ),
          0x031d => Array(
                      "PENTAX-F 28-80mm F3.5-4.5",
                      "Sigma AF 18-125mm F3.5-5.6 DC",
                      "Tokina AT-X PRO 28-70mm F2.6-2.8",
                    ),
          0x031e => "PENTAX-F 70-200mm F4-5.6",
          0x031f => Array(
                      "smc PENTAX-F 70-210mm F4-5.6",
                      "Tokina AF 730 75-300mm F4.5-5.6",
                      "Takumar-F 70-210mm F4-5.6",
                    ),
          0x0320 => "smc PENTAX-F 50mm F1.4",
          0x0321 => "smc PENTAX-F 50mm F1.7",
          0x0322 => "smc PENTAX-F 135mm F2.8 [IF]",
          0x0323 => "smc PENTAX-F 28mm F2.8",
          0x0324 => "Sigma 20mm F1.8 EX DG ASPHERICAL RF",
          0x0326 => "smc PENTAX-F* 300mm F4.5 ED[IF]",
          0x0327 => "smc PENTAX-F* 600mm F4 ED[IF]",
          0x0328 => "smc PENTAX-F MACRO 100mm F2.8",
          0x0329 => Array(
                      "smc PENTAX-F MACRO 50mm F2.8",
                      "Sigma 50mm F2.8 Macro",
                    ),
          0x032c => Array(
                      "Tamron 35-90mm F4 AF",
                      "Sigma AF 10-20mm F4-5.6 EX DC",
                      "Sigma 12-24mm F4.5 EX DG",
                      "Sigma 17-70mm F2.8-4.5 DC Macro",
                      "Sigma 18-50mm F3.5-5.6 DC",
                    ),
          0x032e => Array(
                      "Sigma APO 70-200mm F2.8 EX",
                      "Sigma EX APO 100-300mm F4 IF",
                    ),
          0x0332 => "smc PENTAX-FA 28-70mm F4 AL",
          0x0333 => "Sigma 28mm F1.8 EX DG ASPHERICAL MACRO",
          0x0334 => Array(
                      "smc PENTAX-FA 28-200mm F3.8-5.6 AL[IF]",
                      "Tamron AF LD 28-200mm F3.8-5.6 [IF] Aspherical (171D)",
                    ),
          0x0335 => "smc PENTAX-FA 28-80mm F3.5-5.6 AL",
          0x03f7 => "smc PENTAX-DA FISH-EYE 10-17mm F3.5-4.5 ED[IF]",
          0x03f8 => "smc PENTAX-DA 12-24mm F4 ED AL[IF]",
          0x03fa => "smc PENTAX-DA 50-200mm F4-5.6 ED",
          0x03fb => "smc PENTAX-DA 40mm F2.8 Limited",
          0x03fc => "smc PENTAX-DA 18-55mm F3.5-5.6 AL",
          0x03fd => "smc PENTAX-DA 14mm F2.8 ED[IF]",
          0x03fe => "smc PENTAX-DA 16-45mm F4 ED AL",
          0x03ff => Array(
                      "Sigma 18-200mm F3.5-6.3 DC",
                      "Sigma DL-II 35-80mm F4-5.6",
                      "Sigma DL Zoom 75-300mm F4-5.6",
                      "Sigma DF EX Aspherical 28-70mm F2.8",
                      "Sigma AF Tele 400mm F5.6 Multi-coated",
                      "Sigma 24-60mm F2.8 EX DG",
                      "Sigma 70-300mm F4-5.6 Macro",
                      "Sigma 55-200mm F4-5.6 DC",
                      "Sigma 18-50mm F2.8 EX DC",
                    ),
          0x0401 => "smc PENTAX-FA SOFT 28mm F2.8",
          0x0402 => "smc PENTAX-FA 80-320mm F4.5-5.6",
          0x0403 => "smc PENTAX-FA 43mm F1.9 Limited",
          0x0406 => "smc PENTAX-FA 35-80mm F4-5.6",
          0x040c => "smc PENTAX-FA 50mm F1.4",
          0x040f => "smc PENTAX-FA 28-105mm F4-5.6 [IF]",
          0x0410 => "Tamron AF 80-210mm F4-5.6 (178D)",
          0x0413 => "Tamron SP AF 90mm F2.8 (172E)",
          0x0414 => "smc PENTAX-FA 28-80mm F3.5-5.6",
          0x0416 => "TOKINA 28-80mm F3.5-5.6",
          0x0417 => "smc PENTAX-FA 20-35mm F4 AL",
          0x0418 => "smc PENTAX-FA 77mm F1.8 Limited",
          0x0419 => "Tamron SP AF 14mm F2.8",
          0x041a => Array(
                      "smc PENTAX-FA MACRO 100mm F3.5",
                      "Cosina 100mm F3.5 Macro",
                    ),
          0x041b => "Tamron AF28-300mm F/3.5-6.3 LD Aspherical[IF] MACRO (285D)",
          0x041c => "smc PENTAX-FA 35mm F2 AL",
          0x041d => "Tamron AF 28-200mm F/3.8-5.6 LD Super II MACRO (371D)",
          0x0422 => "smc PENTAX-FA 24-90mm F3.5-4.5 AL[IF]",
          0x0423 => "smc PENTAX-FA 100-300mm F4.7-5.8",
          0x0424 => "Tamron AF70-300mm F/4-5.6 LD MACRO",
          0x0425 => "Tamron SP AF 24-135mm F3.5-5.6 AD AL (190D)",
          0x0426 => "smc PENTAX-FA 28-105mm F3.2-4.5 AL[IF]",
          0x0427 => "smc PENTAX-FA 31mm F1.8AL Limited",
          0x0429 => "Tamron AF 28-200mm Super Zoom F3.8-5.6 Aspherical XR [IF] MACRO (A03)",
          0x042b => "smc PENTAX-FA 28-90mm F3.5-5.6",
          0x042c => "smc PENTAX-FA J 75-300mm F4.5-5.8 AL",
          0x042d => Array(
                      "Tamron AF 28-300mm F3.5-6.3 XR Di LD Aspherical [IF] Macro",
                      "Tamron 28-300mm F3.5-6.3 Ultra zoom XR",
                    ),
          0x042e => "smc PENTAX-FA J 28-80mm F3.5-5.6 AL",
          0x042f => "smc PENTAX-FA J 18-35mm F4-5.6 AL",
          0x0431 => "Tamron SP AF 28-75mm F2.8 XR Di (A09)",
          0x0433 => "smc PENTAX-D FA 50mm F2.8 MACRO",
          0x0434 => "smc PENTAX-D FA 100mm F2.8 MACRO",
          0x044b => "Tamron SP AF 70-200mm F2.8 Di LD [IF] Macro (A001)", // from exiftool
          0x04e5 => "smc PENTAX-DA 18-55mm F3.5-5.6 AL II", // from exiftool
          0x04e6 => "Tamron SP AF 17-50mm F2.8 XR Di II", // from exiftool
          0x04e7 => "smc PENTAX-DA 18-250mm F3.5-6.3 ED AL [IF]", // from exiftool
          0x04ed => "Samsung/Schneider D-XENOGON 10-17mm F3.5-4.5", // from exiftool
          0x04ef => "Samsung D-XENON 12-24mm F4 ED AL [IF]", // from exiftool
          0x04f3 => "smc PENTAX-DA 70mm F2.4 Limited", // from exiftool
          0x04f4 => "smc PENTAX-DA 21mm F3.2 AL Limited",
          0x04f5 => "Schneider D-XENON 50-200mm",
          0x04f6 => "Schneider D-XENON 18-55mm",
          0x04f7 => "smc PENTAX-DA 10-17mm F3.5-4.5 ED [IF] Fisheye zoom",
          0x04f8 => "smc PENTAX-DA 12-24mm F4 ED AL [IF]",
          0x04f9 => "Tamron XR DiII 18-200mm F3.5-6.3 (A14)",
          0x04fa => "smc PENTAX-DA 50-200mm F4-5.6 ED",
          0x04fb => "smc PENTAX-DA 40mm F2.8 Limited",
          0x04fc => "smc PENTAX-DA 18-55mm F3.5-5.6 AL",
          0x04fd => "smc PENTAX-DA 14mm F2.8 ED[IF]",
          0x04fe => "smc PENTAX-DA 16-45mm F4 ED AL",
          0x0501 => "smc PENTAX-FA* 24mm F2 AL[IF]",
          0x0502 => "smc PENTAX-FA 28mm F2.8 AL",
          0x0503 => "smc PENTAX-FA 50mm F1.7",
          0x0504 => "smc PENTAX-FA 50mm F1.4",
          0x0505 => "smc PENTAX-FA* 600mm F4 ED[IF]",
          0x0506 => "smc PENTAX-FA* 300mm F4.5 ED[IF]",
          0x0507 => "smc PENTAX-FA 135mm F2.8 [IF]",
          0x0508 => "smc PENTAX-FA MACRO 50mm F2.8",
          0x0509 => "smc PENTAX-FA MACRO 100mm F2.8",
          0x050a => "smc PENTAX-FA* 85mm F1.4 [IF]",
          0x050b => "smc PENTAX-FA* 200mm F2.8 ED[IF]",
          0x050c => "smc PENTAX-FA 28-80mm F3.5-4.7",
          0x050d => "smc PENTAX-FA 70-200mm F4-5.6",
          0x050e => "smc PENTAX-FA* 250-600mm F5.6 ED[IF]",
          0x050f => "smc PENTAX-FA 28-105mm F4-5.6",
          0x0510 => "smc PENTAX-FA 100-300mm F4.5-5.6",
          0x0562 => "smc PENTAX-FA 100-300mm F4.5-5.6", //from exiftool
          0x0601 => "smc PENTAX-FA* 85mm F1.4[IF]",
          0x0602 => "smc PENTAX-FA* 200mm F2.8 ED[IF]",
          0x0603 => "smc PENTAX-FA* 300mm F2.8 ED[IF]",
          0x0604 => "smc PENTAX-FA* 28-70mm F2.8 AL",
          0x0605 => "smc PENTAX-FA* 80-200mm F2.8 ED[IF]",
          0x0606 => "smc PENTAX-FA* 28-70mm F2.8 AL",
          0x0607 => "smc PENTAX-FA* 80-200mm F2.8 ED[IF]",
          0x0608 => "smc PENTAX-FA 28-70mm F4AL",
          0x0609 => "smc PENTAX-FA 20mm F2.8",
          0x060a => "smc PENTAX-FA* 400mm F5.6 ED[IF]",
          0x060d => "smc PENTAX-FA* 400mm F5.6 ED[IF]",
          0x060e => "smc PENTAX-FA* MACRO 200mm F4 ED[IF]",
          0x0700 => "smc PENTAX-DA 21mm F3.2 AL Limited",
          0x073d => "Tamron SP AF 70-200mm F2.8 Di LD [IF] Macro (A001)", //from exiftool
          0x07d9 => "smc PENTAX-DA 50-200mm F4-5.6 ED WR", //from exiftool
          0x07da => "smc PENTAX-DA 18-55mm F3.5-5.6 AL WR", //from exiftool
          0x07dc => "Tamron SP AF 10-24mm F3.5-4.5 Di II LD Aspherical [IF]", // from exiftool
          0x07dd => "smc PENTAX-DA 50-200mm F4-5.6 ED", // from LucMorizur
          0x07de => "smc PENTAX-DA 18-55mm F3.5-5.6 AL II", //from exiftool
          0x07df => "Samsung D-XENON 18-55mm F3.5-5.6 II", //from exiftool
          0x07e0 => "smc PENTAX-DA 15mm F4 ED AL Limited", //from exiftool
          0x07e1 => "Samsung D-XENON 18-250mm F3.5-6.3", //from exiftool
          0x07e5 => "smc PENTAX-DA 18-55mm F3.5-5.6 AL II",
          0x07e6 => "Tamron AF 17-50mm F2.8 XR Di-II LD (Model A16)",
          0x07e7 => "smc PENTAX-DA 18-250mm F3.5-6.3ED AL [IF]",
          0x07e9 => "smc PENTAX-DA 35mm F2.8 Macro Limited",
          0x07ea => "smc PENTAX-DA* 300mm F4ED [IF] SDM (SDM not used)",
          0x07eb => "smc PENTAX-DA* 200mm F2.8 ED [IF] SDM (SDM not used)",
          0x07ec => "smc PENTAX-DA 55-300mm F4-5.8 ED", //from exiftool
          0x07ee => "Tamron AF 18-250mm F3.5-6.3 Di II LD Aspherical [IF] MACRO",
          0x07f1 => "smc PENTAX-DA* 50-135mm F2.8 ED [IF] SDM (SDM not used)",
          0x07f2 => "smc PENTAX-DA* 16-50mm F2.8 ED AL [IF] SDM (SDM not used)",
          0x07f3 => "smc PENTAX-DA 70mm F2.4 Limited",
          0x07f4 => "smc PENTAX-DA 21mm F3.2 AL Limited",
          0x08e2 => "smc PENTAX-DA* 55mm F1.4 SDM", //from exiftool
          0x08e3 => "smc PENTAX DA* 60-250mm F4 [IF] SDM", //from exiftool
          0x08e8 => "smc PENTAX-DA 17-70mm F4 AL [IF] SDM", //from exiftool
          0x08ea => "smc PENTAX-DA* 300mm F4ED [IF] SDM",
          0x08eb => "smc PENTAX-DA* 200mm F2.8 ED [IF] SDM",
          0x08f1 => "smc PENTAX-DA* 50-135mm F2.8 ED [IF] SDM",
          0x08f2 => "smc PENTAX-DA* 16-50mm F2.8 ED AL [IF] SDM",
          0x08ff => Array(
                      "Sigma 70-200mm F2.8 EX DG Macro HSM II",
                      "Sigma APO 150-500mm F5-6.3 DG OS HSM",
                    ),
          0xffff => "Unknown",
        ),
      ), // < LensType


      // ImageTone, tag 0x004f
      0x004f => Array(
        'tagName'     => "ImageTone",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0 => "Natural",
          1 => "Bright",
          2 => "portrait",
          3 => "Landscape",
          4 => "Vibrant",
          5 => "Monochrome"
        )
      ), // < ImageTone


      // DynamicRangeExpansion, tag 0x0069
      0x0069 => Array(
        'tagName'     => "DynamicRangeExpansion",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 4,
        'implemented' => true,
        'tagValues'   => Array(
          0x0000000 => "Off",
          0x1000000 => "On"
        )
      ), // < DynamicRangeExpansion


      // HighISONoiseReduction, tag 0x0071
      0x0071 => Array(
        'tagName'     => "HighISONoiseReduction",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0 => "Off",
          1 => "Weakest",
          2 => "Weak",
          3 => "Strong"
        )
      ), // < HighISONoiseReduction


      /*
       * tags with special values
       */

      // Version, tag 0x0000, "Pentax Makernote version"
      0x0000 => Array(
        'tagName'     => "Version",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // PreviewResolution, tag 0x0002, "Resolution of a preview image"
      0x0002 => Array(
        'tagName'     => "PreviewResolution",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // PreviewLength, tag 0x0003, "Size of an IFD containing a preview image"
      0x0003 => Array(
        'tagName'     => "PreviewLength",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // PreviewOffset, tag 0x0004, "Offset to an IFD containing a preview image"
      0x0004 => Array(
        'tagName'     => "PreviewOffset",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // Date, tag 0x0006
      0x0006 => Array(
        'tagName'     => "Date",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // Date, tag 0x0007
      0x0007 => Array(
        'tagName'     => "Time",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // FocusPosition, tag 0x0010, from exiftool, "related to focus distance but affected by focal length"
      0x0010 => Array(
        'tagName'     => "FocusPosition",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // ExposureTime, tag 0x0012, "Exposure time"
      0x0012 => Array(
        'tagName'     => "ExposureTime",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // FNumber, tag 0x0013, "F-Number"
      0x0013 => Array(
        'tagName'     => "FNumber",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // LightReading, tag 0x0015, from exiftool
      0x0015 => Array(
        'tagName'     => "LightReading",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),


      // ExposureCompensation, tag 0x0016, "Exposure compensation"
      0x0016 => Array(
        'tagName'     => "ExposureCompensation",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // AutoBracketing, tag 0x0018, "AutoBracketing"
      0x0018 => Array(
        'tagName'     => "AutoBracketing",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // BlueBalance, tag 0x001b, "BlueBalance", from exiftool
      0x001b => Array(
        'tagName'     => "BlueBalance",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // RedBalance, tag 0x001c, "RedBalance"
      0x001c => Array(
        'tagName'     => "RedBalance",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // FocalLength, tag 0x001d, "FocalLength"
      0x001d => Array(
        'tagName'     => "FocalLength",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // DigitalZoom, tag 0x001e, "DigitalZoom", from exiftool
      0x001e => Array(
        'tagName'     => "DigitalZoom",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),


      // HometownDST, tag 0x0025, "Whether day saving time is active in home town"
      0x0025 => Array(
        'tagName'     => "HometownDST",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // DestinationDST, tag 0x0026, "Whether day saving time is active in destination"
      0x0026 => Array(
        'tagName'     => "DestinationDST",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // DSPFirmwareVersion, tag 0x0027, "DSPFirmwareVersion"
      0x0027 => Array(
        'tagName'     => "DSPFirmwareVersion",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // CPUFirmwareVersion, tag 0x0028, "CPUFirmwareVersion"
      0x0028 => Array(
        'tagName'     => "CPUFirmwareVersion",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // FrameNumber, tag 0x0029, "FrameNumber"
      0x0029 => Array(
        'tagName'     => "FrameNumber",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // EffectiveLV, tag 0x002d, "Camera calculated light value, includes exposure compensation"
      0x002d => Array(
        'tagName'     => "EffectiveLV",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // ImageAreaOffset, tag 0x0038, "ImageAreaOffset"
      0x0038 => Array(
        'tagName'     => "ImageAreaOffset",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // RawImageSize, tag 0x0039, "RawImageSize"
      0x0039 => Array(
        'tagName'     => "RawImageSize",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // AFPointsInFocus, tag 0x003e, "AFPointsInFocus"
      0x003c => Array(
        'tagName'     => "AFPointsInFocus",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // PreviewImageBorders, tag 0x003e, "'top, bottom, left, right'"
      0x003e => Array(
        'tagName'     => "PreviewImageBorders",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // SensitivityAdjust, tag 0x0040, "SensitivityAdjust"
      0x0040 => Array(
        'tagName'     => "SensitivityAdjust",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // DigitalFilter, tag 0x0041, "Digital filter"
      0x0041 => Array(
        'tagName'     => "DigitalFilter",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // Temperature, tag 0x0047, "Camera temperature"
      0x0047 => Array(
        'tagName'     => "Temperature",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // AELock, tag 0x0048, "AELock"
      0x0048 => Array(
        'tagName'     => "AELock",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // NoiseReduction, tag 0x0049, "NoiseReduction"
      0x0049 => Array(
        'tagName'     => "NoiseReduction",
        'schema'      => "Pentax",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // FlashExposureCompensation, tag 0x004d, "FlashExposureCompensation"
      0x004d => Array(
        'tagName'     => "FlashExposureCompensation",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // ColorTemperature, tag 0x0050, "ColorTemperature"
      0x0050 => Array(
        'tagName'     => "ColorTemperature",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ),

      // ShakeReduction, tag 0x005c, "ShakeReduction"
      0x005c => Array(
        'tagName'     => "ShakeReduction",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // ShutterCount, tag 0x005d, "ShutterCount"
      0x005d => Array(
        'tagName'     => "ShutterCount",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // AFAdjustment, tag 0x0072, "AFAdjustment", from exiftool
      0x0072 => Array(
        'tagName'     => "AFAdjustment",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),


      // BlackPoint, tag 0x0200, "BlackPoint"
      0x0200 => Array(
        'tagName'     => "BlackPoint",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // WhitePoint, tag 0x0201, "WhitePoint"
      0x0201 => Array(
        'tagName'     => "WhitePoint",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // ColorMatrixA, tag 0x0203, "ColorMatrixA" //from exiftool
      0x0203 => Array(
        'tagName'     => "ColorMatrixA",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // ColorMatrixB, tag 0x0204, "ColorMatrixB" //from exiftool
      0x0204 => Array(
        'tagName'     => "ColorMatrixB",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // ShotInfo, tag 0x0205, "ShotInfo"
      0x0205 => Array(
        'tagName'     => "ShotInfo",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // AEInfo, tag 0x0206, "AEInfo"
      0x0206 => Array(
        'tagName'     => "AEInfo",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // AEInfo, tag 0x0207, "LensInfo"
      0x0207 => Array(
        'tagName'     => "LensInfo",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // FlashInfo, tag 0x0208, "FlashInfo"
      0x0208 => Array(
        'tagName'     => "FlashInfo",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // AEMeteringSegments, tag 0x0209, "AEMeteringSegments"
      0x0209 => Array(
        'tagName'     => "AEMeteringSegments",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // FlashADump, tag 0x020a, "FlashADump"
      0x020a => Array(
        'tagName'     => "FlashADump",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // FlashBDump, tag 0x020b, "FlashBDump"
      0x020b => Array(
        'tagName'     => "FlashBDump",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // WB_RGGBLevelsDaylight, tag 0x020d, "WB_RGGBLevelsDaylight"
      0x020d => Array(
        'tagName'     => "WB_RGGBLevelsDaylight",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // WB_RGGBLevelsShade, tag 0x020e, "WB_RGGBLevelsShade"
      0x020e => Array(
        'tagName'     => "WB_RGGBLevelsShade",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // WB_RGGBLevelsCloudy, tag 0x020f, "WB_RGGBLevelsCloudy"
      0x020f => Array(
        'tagName'     => "WB_RGGBLevelsCloudy",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // WB_RGGBLevelsTungsten, tag 0x0210, "WB_RGGBLevelsTungsten"
      0x0210 => Array(
        'tagName'     => "WB_RGGBLevelsTungsten",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // WB_RGGBLevelsFluorescentD, tag 0x0211, "WB_RGGBLevelsFluorescentD"
      0x0211 => Array(
        'tagName'     => "WB_RGGBLevelsFluorescentD",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // WB_RGGBLevelsFluorescentN, tag 0x0212, "WB_RGGBLevelsFluorescentN"
      0x0212 => Array(
        'tagName'     => "WB_RGGBLevelsFluorescentN",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // WB_RGGBLevelsFluorescentW, tag 0x0213, "WB_RGGBLevelsFluorescentW"
      0x0213 => Array(
        'tagName'     => "WB_RGGBLevelsFluorescentW",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // WB_RGGBLevelsFlash, tag 0x0214, "WB_RGGBLevelsFlash"
      0x0214 => Array(
        'tagName'     => "WB_RGGBLevelsFlash",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // CameraInfo, tag 0x0215, "CameraInfo"
      0x0215 => Array(
        'tagName'     => "CameraInfo",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // BatteryInfo, tag 0x0216, "BatteryInfo"
      0x0216 => Array(
        'tagName'     => "BatteryInfo",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // SaturationInfo, tag 0x021b, "SaturationInfo"
      0x021b => Array(
        'tagName'     => "SaturationInfo",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // AFInfo, tag 0x021f, "AFInfo"
      0x021f => Array(
        'tagName'     => "AFInfo",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // HuffmanTable, tag 0x0220, "HuffmanTable" from exiftool
      0x0220 => Array(
        'tagName'     => "HuffmanTable",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // ColorInfo, tag 0x0222, "ColorInfo"
      0x0222 => Array(
        'tagName'     => "ColorInfo",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // EVStepInfo, tag 0x0224, "EVStepInfo"
      0x0224 => Array(
        'tagName'     => "EVStepInfo",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // SerialNumber, tag 0x0229, "SerialNumber"
      0x0229 => Array(
        'tagName'     => "SerialNumber",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // FirmwareVersion, tag 0x0230, "FirmwareVersion" from exiftool
      0x0230 => Array(
        'tagName'     => "FirmwareVersion",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // DataDump, tag 0x03fe, "DataDump" from exiftool
      0x03fe => Array(
        'tagName'     => "DataDump",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // UnknownInfo, tag 0x03ff, "UnknownInfo" from exiftool
      0x03ff => Array(
        'tagName'     => "UnknownInfo",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // ToneCurve, tag 0x0402, "ToneCurve" from exiftool
      0x0402 => Array(
        'tagName'     => "ToneCurve",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // ToneCurves, tag 0x0403, "ToneCurves" from exiftool
      0x0403 => Array(
        'tagName'     => "ToneCurves",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

      // PrintIM, tag 0x0e00, "PrintIM" from exiftool
      0x0e00 => Array(
        'tagName'     => "PrintIM",
        'schema'      => "Pentax",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ),

    );

    function __destruct()
    {
      parent::__destruct();
    }
  } // PentaxTags



?>
