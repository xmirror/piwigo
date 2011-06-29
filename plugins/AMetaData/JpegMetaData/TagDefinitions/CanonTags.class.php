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
 * The CanonTags is the definition of the specific Canon Exif tags
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 * The CanonTags class is derived from the KnownTags class.
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
   * Define the tags for Canon camera
   */
  class CanonTags extends KnownTags
  {
    protected $label = "Canon specific tags";
    protected $tags = Array(
      /*
       * tags with defined values
       */

      // CanonCameraSettings, tag 0x0001
      0x0001 => Array(
        'tagName'     => "CanonCameraSettings",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < CanonCameraSettings

      /*
       * The 'CanonCameraSettings' tags is composed by an array of sub tags
       * Each subtag name is defined bu the class by the concatenation of
       * "CanonCameraSettings" and the subtag name
       *
       * Giving something like :
       *  "CanonCameraSettings.MacroMode" for the subtag 0x01
       *
       * This kind of data needs a particular algorythm in the CanonReader class
       * provided by the processSubTag0x0001 function
       *
       * Keys are defined by a string build with :
       *  - the tag number in hexa "0x0001"
       *  - a dot "."
       *  - sub tag number in decimal "10"
       *  ==> "0x0001.10" => "CanonCameraSettings.CanonImageSize"
       *
       * >>> Begin of CanonCameraSettings subtags
       *
       */
      "0x0001.1" => Array(
        'tagName'     => "CanonCameraSettings.MacroMode",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            1 => "macro",
            2 => "normal",
          ),
      ),

      "0x0001.2" => Array(
        'tagName'     => "CanonCameraSettings.SelfTimer",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
      ),

      "0x0001.3" => Array(
        'tagName'     => "CanonCameraSettings.Quality",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0x01 => "Economy",
            0x02 => "normal",
            0x03 => "Fine",
            0x04 => "RAW",
            0x05 => "Superfine",
            0x82 => "Normal Movie"
          ),
      ),

      "0x0001.4" => Array(
        'tagName'     => "CanonCameraSettings.CanonFlashMode",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0x00 => "Off",
            0x01 => "Auto",
            0x02 => "On",
            0x03 => "Red-eye reduction",
            0x04 => "Slow-sync",
            0x05 => "Red-eye reduction (Auto)",
            0x06 => "Red-eye reduction (On)",
            0x10 => "External flash",
          ),
      ),

      "0x0001.5" => Array(
        'tagName'     => "CanonCameraSettings.ContinuousDrive",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0 => "Single",
            1 => "Continuous",
            2 => "Movie",
            3 => "Continuous, Speed Priority",
            4 => "Continuous, Low",
            5 => "Continuous, High",
          ),
      ),

      "0x0001.7" => Array(
        'tagName'     => "CanonCameraSettings.FocusMode",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0x00 => "One-shot AF",
            0x01 => "AI Servo AF",
            0x02 => "AI Focus AF",
            0x03 => "Manual Focus (3)",
            0x04 => "Single",
            0x05 => "Continuous",
            0x06 => "Manual Focus (6)",
            0x10 => "pan focus",
          ),
      ),

      "0x0001.9" => Array(
        'tagName'     => "CanonCameraSettings.RecordMode",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0x01 => "JPEG",
            0x02 => "CRW+THM",
            0x03 => "AVI+THM",
            0x04 => "TIF",
            0x05 => "TIF+JPEG",
            0x06 => "CR2",
            0x07 => "CR2+JPEG",
          ),
      ),

      "0x0001.10" => Array(
        'tagName'     => "CanonCameraSettings.CanonImageSize",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0x00 => "Large",
            0x01 => "Medium",
            0x02 => "Small",
            0x05 => "Medium 1",
            0x06 => "Medium 2",
            0x07 => "Medium 3",
            0x08 => "Postcard",
            0x09 => "Widescreen",
            0x81 => "Medium Movie",
            0x82 => "Small Movie",
          ),
      ),

      "0x0001.11" => Array(
        'tagName'     => "CanonCameraSettings.EasyMode",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0x00 => "Full auto",
            0x01 => "Manual",
            0x02 => "Landscape",
            0x03 => "Fast shutter",
            0x04 => "Slow shutter",
            0x05 => "Night",
            0x06 => "Gray Scale",
            0x07 => "Sepia",
            0x08 => "portrait",
            0x09 => "Sports",
            0x0a => "macro",
            0x0b => "Black & White",
            0x0c => "pan focus",
            0x0d => "Vivid",
            0x0e => "Neutral",
            0x0f => "Flash Off",
            0x10 => "Long Shutter",
            0x11 => "super macro",
            0x12 => "Foliage",
            0x13 => "Indoor",
            0x14 => "Fireworks",
            0x15 => "Beach",
            0x16 => "Underwater",
            0x17 => "Snow",
            0x18 => "Kids & Pets",
            0x19 => "Night Snapshot",
            0x1a => "Digital Macro",
            0x1b => "My Colors",
            0x1c => "Still Image",
            0x1d => "Color Accent",
            0x1e => "Color Swap",
            0x20 => "Aquarium",
            0x21 => "ISO 3200",
            0x26 => "Creative Auto",
            0x105 => "Sunset",
          ),
      ),

      "0x0001.12" => Array(
        'tagName'     => "CanonCameraSettings.DigitalZoom",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0 => "none",
            1 => "2x",
            2 => "4x",
            3 => "other",
          ),
      ),

      "0x0001.13" => Array(
        'tagName'     => "CanonCameraSettings.Contrast",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ),

      "0x0001.14" => Array(
        'tagName'     => "CanonCameraSettings.Saturation",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ),

      "0x0001.15" => Array(
        'tagName'     => "CanonCameraSettings.Sharpness",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ),

      "0x0001.16" => Array(
        'tagName'     => "CanonCameraSettings.CameraISO",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ),

      "0x0001.17" => Array(
        'tagName'     => "CanonCameraSettings.MeteringMode",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0x00 => "default",
            0x01 => "spot",
            0x02 => "average",
            0x03 => "evaluative",
            0x04 => "partial",
            0x05 => "center-weighted average",
        ),
      ),

      "0x0001.18" => Array(
        'tagName'     => "CanonCameraSettings.FocusRange",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0x00 => "Manual",
            0x01 => "Auto",
            0x02 => "not known",
            0x03 => "macro",
            0x04 => "very close",
            0x05 => "close",
            0x06 => "middle range",
            0x07 => "far range",
            0x08 => "pan focus",
            0x09 => "super macro",
            0x0a => "infinity"
        ),
      ),

      "0x0001.19" => Array(
        'tagName'     => "CanonCameraSettings.AFPoint",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0x2005 => "Manual AF point selection",
            0x3000 => "None (MF)",
            0x3001 => "Auto AF point selection",
            0x3002 => "Right",
            0x3003 => "Center",
            0x3004 => "Left",
            0x4001 => "Auto AF point selection",
            0x4006 => "Face Detect"
        ),
      ),

      "0x0001.20" => Array(
        'tagName'     => "CanonCameraSettings.CanonExposureMode",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0 => "Easy",
            1 => "Program AE",
            2 => "Shutter speed priority AE",
            3 => "Aperture-priority AE",
            4 => "Manual",
            5 => "Depth-of-field AE",
            6 => "M-Dep",
            7 => "Bulb"
        ),
      ),

      "0x0001.22" => Array(
        'tagName'     => "CanonCameraSettings.LensType",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.special' => Array(
              /* some lenses have the same Id. In this case associated name is
               * not a single string, but an Array
               *
               * the lens CanonReader->processSubTag0x0001 function try to find
               * to good lens by looking in each name if the ShortFocal-LongFocal
               * correspond
               */
         0xffff => "Unknown lens",
              1 => "Canon EF 50mm f/1.8",
              2 => "Canon EF 28mm f/2.8",
              3 => "Canon EF 135mm f/2.8 Soft",
              4 => Array(
                      "Canon EF 35-105mm f/3.5-4.5",
                      "Sigma UC Zoom 35-135mm f/4-5.6",
                    ),
              5 => "Canon EF 35-70mm f/3.5-4.5",
              6 => Array(
                      "Canon EF 28-70mm f/3.5-4.5",
                      "Sigma 18-50mm f/3.5-5.6 DC",
                      "Sigma 18-125mm f/3.5-5.6 DC IF ASP",
                      "Tokina AF193-2 19-35mm f/3.5-4.5",
                    ),
              7 => "Canon EF 100-300mm f/5.6L",
              8 => Array(
                      "Canon EF 100-300mm f/5.6",
                      "Sigma 70-300mm f/4-5.6 DG Macro",
                      "Tokina AT-X242AF 24-200mm f/3.5-5.6",
                    ),
              9 => Array(
                      "Canon EF 70-210mm f/4",
                      "Sigma 55-200mm f/4-5.6 DC",
                    ),
              10 => Array(
                      "Canon EF 50mm f/2.5 Macro",
                      "Sigma 50mm f/2.8 EX",
                      "Sigma 28mm f/1.8",
                      "Sigma 105mm f/2.8 Macro EX",
                    ),
              11 => "Canon EF 35mm f/2",
              13 => "Canon EF 15mm f/2.8 Fisheye",
              14 => "Canon EF 50-200mm f/3.5-4.5L",
              15 => "Canon EF 50-200mm f/3.5-4.5",
              16 => "Canon EF 35-135mm f/3.5-4.5",
              17 => "Canon EF 35-70mm f/3.5-4.5A",
              18 => "Canon EF 28-70mm f/3.5-4.5",
              20 => "Canon EF 100-200mm f/4.5A",
              21 => "Canon EF 80-200mm f/2.8L",
              22 => Array(
                        "Canon EF 20-35mm f/2.8L",
                        "Tokina AT-X280AF PRO 28-80mm f/2.8 Aspherical",
                      ),
              23 => "Canon EF 35-105mm f/3.5-4.5",
              24 => "Canon EF 35-80mm f/4-5.6 Power Zoom",
              25 => "Canon EF 35-80mm f/4-5.6 Power Zoom",
              26 => Array(
                        "Canon EF 100mm f/2.8 Macro",
                        "Cosina 100mm f/3.5 Macro AF",
                        "Tamron SP AF 90mm f/2.8 Di Macro",
                        "Tamron SP AF 180mm f/3.5 Di Macro",
                        "Carl Zeiss Planar T* 50mm f/1.4",
                      ),
              27 => "Canon EF 35-80mm f/4-5.6",
              28 => Array(
                        "Canon EF 80-200mm f/4.5-5.6",
                        "Tamron SP AF 28-105mm f/2.8 LD Aspherical IF",
                        "Tamron SP AF 28-75mm f/2.8 XR Di LD Aspherical [IF] Macro",
                        "Tamron AF 70-300mm f/4.5-5.6 Di LD 1:2 Macro Zoom",
                        "Tamron AF Aspherical 28-200mm f/3.8-5.6",
                      ),
              29 => "Canon EF 50mm f/1.8 MkII",
              30 => "Canon EF 35-105mm f/4.5-5.6",
              31 => Array(
                        "Canon EF 75-300mm f/4-5.6",
                        "Tamron SP AF 300mm f/2.8 LD IF",
                      ),
              32 => Array(
                        "Canon EF 24mm f/2.8",
                        "Sigma 15mm f/2.8 EX Fisheye",
                      ),
              33 => "Voigtlander Ultron 40mm f/2 SLII Aspherical",
              35 => "Canon EF 35-80mm f/4-5.6",
              36 => "Canon EF 38-76mm f/4.5-5.6",
              37 => Array(
                        "Canon EF 35-80mm f/4-5.6",
                        "Tamron 70-200mm f/2.8 Di LD IF Macro",
                        "Tamron AF 28-300mm f/3.5-6.3 XR Di VC LD Aspherical [IF] Macro Model A20",
                      ),
              38 => "Canon EF 80-200mm f/4.5-5.6",
              39 => "Canon EF 75-300mm f/4-5.6",
              40 => "Canon EF 28-80mm f/3.5-5.6",
              41 => "Canon EF 28-90mm f/4-5.6",
              42 => Array(
                        "Canon EF 28-200mm f/3.5-5.6",
                        "Tamron AF 28-300mm f/3.5-6.3 XR Di VC LD Aspherical [IF] Macro Model A20",
                      ),
              43 => "Canon EF 28-105mm f/4-5.6",
              44 => "Canon EF 90-300mm f/4.5-5.6",
              45 => "Canon EF-S 18-55mm f/3.5-5.6",
              46 => "Canon EF 28-90mm f/4-5.6",
              48 => "Canon EF-S 18-55mm f/3.5-5.6 IS",
              49 => "Canon EF-S 55-250mm f/4-5.6 IS",
              50 => "Canon EF-S 18-200mm f/3.5-5.6 IS",
              51 => "Canon EF-S 18-135mm f/3.5-5.6 IS",
              94 => "Canon TS-E 17mm f/4L",
              95 => "Canon TS-E 24.0mm f/3.5 L II",
              124 => "Canon MP-E 65mm f/2.8 1-5x Macro Photo",
              125 => "Canon TS-E 24mm f/3.5L",
              126 => "Canon TS-E 45mm f/2.8",
              127 => "Canon TS-E 90mm f/2.8",
              129 => "Canon EF 300mm f/2.8L",
              130 => "Canon EF 50mm f/1.0L",
              131 => Array(
                        "Canon EF 28-80mm f/2.8-4L",
                        "Sigma 8mm f/3.5 EX DG Circular Fisheye",
                        "Sigma 17-35mm f/2.8-4 EX DG Aspherical HSM",
                        "Sigma 17-70mm f/2.8-4.5 DC Macro",
                        "Sigma APO 50-150mm f/2.8 [II] EX DC HSM",
                        "Sigma APO 120-300mm f/2.8 EX DG HSM",
                      ),
              132 => "Canon EF 1200mm f/5.6L",
              134 => "Canon EF 600mm f/4L IS",
              135 => "Canon EF 200mm f/1.8L",
              136 => "Canon EF 300mm f/2.8L",
              137 => Array(
                        "Canon EF 85mm f/1.2L",
                        "Sigma 18-50mm f/2.8-4.5 DC OS HSM",
                        "Sigma 50-200mm f/4-5.6 DC OS HSM",
                        "Sigma 18-250mm f/3.5-6.3 DC OS HSM",
                        "Sigma 24-70mm f/2.8 IF EX DG HSM",
                        "Sigma 18-125mm f/3.8-5.6 DC OS HSM",
                      ),
              138 => "Canon EF 28-80mm f/2.8-4L",
              139 => "Canon EF 400mm f/2.8L",
              140 => "Canon EF 500mm f/4.5L",
              141 => "Canon EF 500mm f/4.5L",
              142 => "Canon EF 300mm f/2.8L IS",
              143 => "Canon EF 500mm f/4L IS",
              144 => "Canon EF 35-135mm f/4-5.6 USM",
              145 => "Canon EF 100-300mm f/4.5-5.6 USM",
              146 => "Canon EF 70-210mm f/3.5-4.5 USM",
              147 => "Canon EF 35-135mm f/4-5.6 USM",
              148 => "Canon EF 28-80mm f/3.5-5.6 USM",
              149 => "Canon EF 100mm f/2 USM",
              150 => Array(
                        "Canon EF 14mm f/2.8L",
                        "Sigma 20mm EX f/1.8",
                        "Sigma 30mm f/1.4 DC HSM",
                        "Sigma 24mm f/1.8 DG Macro EX",
                      ),
              151 => "Canon EF 200mm f/2.8L",
              152 => Array(
                        "Canon EF 300mm f/4L IS",
                        "Sigma 12-24mm f/4.5-5.6 EX DG ASPHERICAL HSM",
                        "Sigma 14mm f/2.8 EX Aspherical HSM",
                        "Sigma 10-20mm f/4-5.6",
                        "Sigma 100-300mm f/4",
                      ),
              153 => Array(
                        "Canon EF 35-350mm f/3.5-5.6L",
                        "Sigma 50-500mm f/4-6.3 APO HSM EX",
                        "Tamron AF 28-300mm f/3.5-6.3 XR LD Aspherical [IF] Macro",
                        "Tamron AF 18-200mm f/3.5-6.3 XR Di II LD Aspherical [IF] Macro Model A14",
                        "Tamron 18-250mm f/3.5-6.3 Di II LD Aspherical [IF] Macro",
                      ),
              154 => "Canon EF 20mm f/2.8 USM",
              155 => "Canon EF 85mm f/1.8 USM",
              156 => "Canon EF 28-105mm f/3.5-4.5 USM",
              160 => Array(
                        "Canon EF 20-35mm f/3.5-4.5 USM",
                        "Tamron AF 19-35mm f/3.5-4.5",
                      ),
              161 => Array(
                        "Canon EF 28-70mm f/2.8L",
                        "Sigma 24-70mm EX f/2.8",
                        "Tamron 90mm f/2.8",
                        "Tamron AF 17-50mm f/2.8 Di-II LD Aspherical",
                      ),
              162 => "Canon EF 200mm f/2.8L",
              163 => "Canon EF 300mm f/4L",
              164 => "Canon EF 400mm f/5.6L",
              165 => "Canon EF 70-200mm f/2.8 L",
              166 => "Canon EF 70-200mm f/2.8 L + 1.4x",
              167 => "Canon EF 70-200mm f/2.8 L + 2x",
              168 => "Canon EF 28mm f/1.8 USM",
              169 => Array(
                        "Canon EF 17-35mm f/2.8L",
                        "Sigma 18-200mm f/3.5-6.3 DC OS",
                        "Sigma 15-30mm f/3.5-4.5 EX DG Aspherical",
                        "Sigma 18-50mm f/2.8 Macro",
                        "Sigma 50mm f/1.4 EX DG HSM",
                      ),
              170 => "Canon EF 200mm f/2.8L II",
              171 => "Canon EF 300mm f/4L",
              172 => "Canon EF 400mm f/5.6L",
              173 => Array(
                        "Canon EF 180mm Macro f/3.5L",
                        "Sigma 180mm EX HSM Macro f/3.5",
                        "Sigma APO Macro 150mm f/2.8 EX DG HSM",
                      ),
              174 => "Canon EF 135mm f/2L",
              175 => "Canon EF 400mm f/2.8L",
              176 => "Canon EF 24-85mm f/3.5-4.5 USM",
              177 => "Canon EF 300mm f/4L IS",
              178 => "Canon EF 28-135mm f/3.5-5.6 IS",
              179 => "Canon EF 24mm f/1.4L",
              180 => "Canon EF 35mm f/1.4L",
              181 => "Canon EF 100-400mm f/4.5-5.6L IS + 1.4x",
              182 => "Canon EF 100-400mm f/4.5-5.6L IS + 2x",
              183 => "Canon EF 100-400mm f/4.5-5.6L IS",
              184 => "Canon EF 400mm f/2.8L + 2x",
              185 => "Canon EF 600mm f/4L IS",
              186 => "Canon EF 70-200mm f/4L",
              187 => "Canon EF 70-200mm f/4L + 1.4x",
              188 => "Canon EF 70-200mm f/4L + 2x",
              189 => "Canon EF 70-200mm f/4L + 2.8x",
              190 => "Canon EF 100mm f/2.8 Macro",
              191 => "Canon EF 400mm f/4 DO IS",
              193 => "Canon EF 35-80mm f/4-5.6 USM",
              194 => "Canon EF 80-200mm f/4.5-5.6 USM",
              195 => "Canon EF 35-105mm f/4.5-5.6 USM",
              196 => "Canon EF 75-300mm f/4-5.6 USM",
              197 => "Canon EF 75-300mm f/4-5.6 IS USM",
              198 => "Canon EF 50mm f/1.4 USM",
              199 => "Canon EF 28-80mm f/3.5-5.6 USM",
              200 => "Canon EF 75-300mm f/4-5.6 USM",
              201 => "Canon EF 28-80mm f/3.5-5.6 USM",
              202 => "Canon EF 28-80mm f/3.5-5.6 USM IV",
              208 => "Canon EF 22-55mm f/4-5.6 USM",
              209 => "Canon EF 55-200mm f/4.5-5.6",
              210 => "Canon EF 28-90mm f/4-5.6 USM",
              211 => "Canon EF 28-200mm f/3.5-5.6 USM",
              212 => "Canon EF 28-105mm f/4-5.6 USM",
              213 => "Canon EF 90-300mm f/4.5-5.6 USM",
              214 => "Canon EF-S 18-55mm f/3.5-4.5 USM",
              215 => "Canon EF 55-200mm f/4.5-5.6 II USM",
              224 => "Canon EF 70-200mm f/2.8L IS",
              225 => "Canon EF 70-200mm f/2.8L IS + 1.4x",
              226 => "Canon EF 70-200mm f/2.8L IS + 2x",
              227 => "Canon EF 70-200mm f/2.8L IS + 2.8x",
              228 => "Canon EF 28-105mm f/3.5-4.5 USM",
              229 => "Canon EF 16-35mm f/2.8L",
              230 => "Canon EF 24-70mm f/2.8L",
              231 => "Canon EF 17-40mm f/4L",
              232 => "Canon EF 70-300mm f/4.5-5.6 DO IS USM",
              233 => "Canon EF 28-300mm f/3.5-5.6L IS",
              234 => "Canon EF-S 17-85mm f4-5.6 IS USM",
              235 => "Canon EF-S 10-22mm f/3.5-4.5 USM",
              236 => "Canon EF-S 60mm f/2.8 Macro USM",
              237 => "Canon EF 24-105mm f/4L IS",
              238 => "Canon EF 70-300mm f/4-5.6 IS USM",
              239 => "Canon EF 85mm f/1.2L II",
              240 => "Canon EF-S 17-55mm f/2.8 IS USM",
              241 => "Canon EF 50mm f/1.2L",
              242 => "Canon EF 70-200mm f/4L IS",
              243 => "Canon EF 70-200mm f/4L IS + 1.4x",
              244 => "Canon EF 70-200mm f/4L IS + 2x",
              245 => "Canon EF 70-200mm f/4L IS + 2.8x",
              246 => "Canon EF 16-35mm f/2.8L II",
              247 => "Canon EF 14mm f/2.8L II USM",
              248 => "Canon EF 200mm f/2L IS",
              249 => "Canon EF 800mm f/5.6L IS",
              250 => "Canon EF 24 f/1.4L II",
              254 => "Canon EF 100mm f/2.8L Macro IS USM",
              488 => "Canon EF-S 15-85mm f/3.5-5.6 IS USM",
        ),
      ),

      "0x0001.23" => Array(
        'tagName'     => "CanonCameraSettings.LongFocal",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ),

      "0x0001.24" => Array(
        'tagName'     => "CanonCameraSettings.ShortFocal",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ),

      "0x0001.25" => Array(
        'tagName'     => "CanonCameraSettings.FocalUnits",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ),

      "0x0001.26" => Array(
        'tagName'     => "CanonCameraSettings.MaxAperture",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ),

      "0x0001.27" => Array(
        'tagName'     => "CanonCameraSettings.MinAperture",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ),

      "0x0001.28" => Array(
        'tagName'     => "CanonCameraSettings.FlashActivity",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0x00 => "Did not fire",
            0x01 => "fired",
        ),
      ),

      "0x0001.29" => Array(
        'tagName'     => "CanonCameraSettings.FlashBits",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.special' => Array(
            0x0001 => "Manual",                  //b0000000000000001
            0x0002 => "TTL",                     //b0000000000000010
            0x0004 => "A-TTL",                   //b0000000000000100
            0x0008 => "E-TTL",                   //b0000000000001000
            0x0010 => "FP sync enabled",         //b0000000000010000
            0x0080 => "2nd-curtain sync used",   //b0000000010000000
            0x0800 => "FP sync used",            //b0000100000000000
            0x2000 => "Built-in",                //b0010000000000000
            0x4000 => "External",                //b0100000000000000
        ),
      ),

      "0x0001.32" => Array(
        'tagName'     => "CanonCameraSettings.FocusContinuous",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0x00 => "Single",
            0x01 => "Continuous",
            0x08 => "Manual",
            0xFFFF => "Unknown",
        ),
      ),

      "0x0001.33" => Array(
        'tagName'     => "CanonCameraSettings.AESetting",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0x00 => "Normal AE",
            0x01 => "Exposure Compensation",
            0x02 => "AE Lock",
            0x03 => "AE Lock + Exposure Comp.",
            0x04 => "No AE"
        ),
      ),

      "0x0001.34" => Array(
        'tagName'     => "CanonCameraSettings.ImageStabilization",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0x00 => "Off",
            0x01 => "On",
            0x02 => "On, Shot Only",
            0x03 => "On, Panning",
            0xFFFF => "Unknown",
        ),
      ),

      "0x0001.35" => Array(
        'tagName'     => "CanonCameraSettings.DisplayAperture",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ),

      "0x0001.36" => Array(
        'tagName'     => "CanonCameraSettings.ZoomSourceWidth",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ),

      "0x0001.37" => Array(
        'tagName'     => "CanonCameraSettings.ZoomTargetWidth",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ),

      "0x0001.39" => Array(
        'tagName'     => "CanonCameraSettings.SpotMeteringMode",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0x00 => "Center",
            0x01 => "AF Point",
            0xFFFF => "Unknown",
        ),
      ),

      "0x0001.40" => Array(
        'tagName'     => "CanonCameraSettings.PhotoEffect",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0x00 => "Off",
            0x01 => "Vivid",
            0x02 => "Neutral",
            0x03 => "Smooth",
            0x04 => "Sepia",
            0x05 => "B&W",
            0x06 => "Custom",
            0x64 => "My Color Data",
            0xFFFF => "Unknown",
        ),
      ),

      "0x0001.41" => Array(
        'tagName'     => "CanonCameraSettings.ManualFlashOutput",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0x0000 => "n/a",
            0x0500 => "Full",
            0x0502 => "Medium",
            0x0504 => "low",
            0x7fff => "n/a",
        ),
      ),

      "0x0001.42" => Array(
        'tagName'     => "CanonCameraSettings.ColorTone",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0x0000 => "normal",
        ),
      ),

      "0x0001.46" => Array(
        'tagName'     => "CanonCameraSettings.SRAWQuality",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0x00 => "n/a",
            0x01 => "sRAW1 (mRAW)",
            0x02 => "sRAW2 (sRAW)"
        ),
      ),

      /*
       * <<< End of CanonCameraSettings subtags
       */

      // CanonFocalLength, tag 0x0000
      0x0002 => Array(
        'tagName'     => "CanonFocalLength",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < CanonFocalLength

      // CanonFlashInfo?, tag 0x0003
      0x0003 => Array(
        'tagName'     => "CanonFlashInfo",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < CanonFlashInfo

      // CanonShotInfo, tag 0x0004
      0x0004 => Array(
        'tagName'     => "CanonShotInfo",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // <

      /*
       * The 'CanonShotInfo' tags is composed by an array of sub tags
       *
       * Like the CanonCameraSettings tag, this kind of data needs a particular
       * algorythm in the CanonReader class, provided by the processSubTag0x0004
       * function
       *
       * >>> Begin of CanonShotInfo subtags
       *
       */
      "0x0004.1" => Array(
        'tagName'     => "CanonShotInfo.AutoISO",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ),

      "0x0004.2" => Array(
        'tagName'     => "CanonShotInfo.BaseISO",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ),

      "0x0004.3" => Array(
        'tagName'     => "CanonShotInfo.MeasuredEV",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ),

      "0x0004.4" => Array(
        'tagName'     => "CanonShotInfo.TargetAperture",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ),

      "0x0004.5" => Array(
        'tagName'     => "CanonShotInfo.TargetExposureTime",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ),

      "0x0004.6" => Array(
        'tagName'     => "CanonShotInfo.ExposureCompensation",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ),

      "0x0004.7" => Array(
        'tagName'     => "CanonShotInfo.WhiteBalance",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0x00 => "Auto",
            0x01 => "Daylight",
            0x02 => "Cloudy",
            0x03 => "Tungsten",
            0x04 => "Fluorescent",
            0x05 => "Flash",
            0x06 => "Custom",
            0x07 => "Black & White",
            0x08 => "Shade",
            0x09 => "Manual Temperature (Kelvin)",
            0x0A => "PC Set1",
            0x0B => "PC Set2",
            0x0C => "PC Set3",
            0x0E => "Daylight Fluorescent",
            0x0F => "Custom 1",
            0x10 => "Custom 2",
            0x11 => "Underwater",
            0x12 => "Custom 3",
            0x13 => "Custom 4",
            0x14 => "PC Set4",
            0x15 => "PC Set5",
        ),
      ),

      "0x0004.8" => Array(
        'tagName'     => "CanonShotInfo.SlowShutter",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0x00 => "Off",
            0x01 => "night scene",
            0x02 => "On",
            0x03 => "none",
        ),
      ),

      "0x0004.9" => Array(
        'tagName'     => "CanonShotInfo.SequenceNumber",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ),

      "0x0004.10" => Array(
        'tagName'     => "CanonShotInfo.OpticalZoomCode",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ),

      "0x0004.13" => Array(
        'tagName'     => "CanonShotInfo.FlashGuideNumber",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ),

      "0x0004.14" => Array(
        'tagName'     => "CanonShotInfo.AFPointsInFocus",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => false,
        'tagValues'   => Array(
            // (used by D30, D60 and some PowerShot/Ixus models)
            0x3000 => "None (MF)",
            0x3001 => "Right",
            0x3002 => "Center",
            0x3003 => "Center+Right",
            0x3004 => "Left",
            0x3005 => "Left+Right",
            0x3006 => "Left+Center",
            0x3007 => "All",
        ),
      ),

      "0x0004.15" => Array(
        'tagName'     => "CanonShotInfo.FlashExposureComp",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ),

      "0x0004.16" => Array(
        'tagName'     => "CanonShotInfo.AutoExposureBracketing",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            -1 => "On",
            0 => "Off",
            1 => "On (shot 1)",
            2 => "On (shot 2)",
            3 => "On (shot 3)",
        ),
      ),

      "0x0004.17" => Array(
        'tagName'     => "CanonShotInfo.AEBBracketValue",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ),

      "0x0004.18" => Array(
        'tagName'     => "CanonShotInfo.ControlMode",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0 => "n/a",
            1 => "Camera Local Control",
            3 => "Computer Remote Control",
        ),
      ),

      "0x0004.19" => Array(
        'tagName'     => "CanonShotInfo.FocusDistanceUpper",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ),

      "0x0004.20" => Array(
        'tagName'     => "CanonShotInfo.FocusDistanceLower",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ),

      "0x0004.21" => Array(
        'tagName'     => "CanonShotInfo.FNumber",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ),

      "0x0004.22" => Array(
        'tagName'     => "CanonShotInfo.ExposureTime",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ),

      "0x0004.23" => Array(
        'tagName'     => "CanonShotInfo.MeasuredEV2",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ),

      "0x0004.24" => Array(
        'tagName'     => "CanonShotInfo.BulbDuration",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ),

      "0x0004.26" => Array(
        'tagName'     => "CanonShotInfo.CameraType",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            248 => "EOS High-end",
            250 => "Compact",
            252 => "EOS Mid-range",
            255 => "DV Camera",
        ),
      ),

      "0x0004.27" => Array(
        'tagName'     => "CanonShotInfo.AutoRotate",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
       0xFFFF => "Unknown",
            0 => "none",
            1 => "Rotate 90 CW",
            2 => "Rotate 180",
            3 => "Rotate 270 CW",
        ),
      ),

      "0x0004.28" => Array(
        'tagName'     => "CanonShotInfo.NDFilter",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
            0 => "Off",
            1 => "On",
       0xFFFF => "Unknown",
        ),
      ),

      "0x0004.29" => Array(
        'tagName'     => "CanonShotInfo.SelfTimer2",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ),

      "0x0004.33" => Array(
        'tagName'     => "CanonShotInfo.FlashOutput",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ),

      /*
       * <<< Begin of CanonShotInfo subtags
       *
       */


      // CanonPanorama, tag 0x0005
      0x0005 => Array(
        'tagName'     => "CanonPanorama",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < CanonPanorama

      // CanonImageType, tag 0x0006
      0x0006 => Array(
        'tagName'     => "CanonImageType",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // <

      // CanonFirmwareVersion, tag 0x0007
      0x0007 => Array(
        'tagName'     => "CanonFirmwareVersion",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < CanonFirmwareVersion

      // FileNumber, tag 0x0008
      0x0008 => Array(
        'tagName'     => "FileNumber",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < FileNumber

      // OwnerName, tag 0x0009
      0x0009 => Array(
        'tagName'     => "OwnerName",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < OwnerName

      // UnknownD30, tag 0x000a
      0x000a => Array(
        'tagName'     => "UnknownD30",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < UnknownD30

      // SerialNumber, tag 0x000c
      0x000c => Array(
        'tagName'     => "SerialNumber",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < SerialNumber

      // CanonCameraInfo, tag 0x000d
      0x000d => Array(
        'tagName'     => "CanonCameraInfo",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
        'tagValues.special' => Array(
          '40D'      => Array(3, 4, 6, 21, 24, 27, 29, 48, 67, 69, 111, 115, 214, 216, 218, 255, 307, 319, 2347),
          '1DMarkIV' => Array(3, 4, 6, 7, 21, 25, 30, 53, 84, 86, 488, 493),
        )
      ), // < CanonCameraInfo

      /*
       * The 'CanonCameraInfo' tags structure depends of the camera model
       *
       * Like the CanonCameraSettings tag, this kind of data needs a particular
       * algorythm in the CanonReader class, provided by the processSubTag0x000d
       * functions
       *
       * >>> Begin of CanonCameraInfo subtags
       *
       */

      /*
       * Canon EOS 40D CameraInfo tags
       */
      "0x000d.40D.3" => Array(
        'tagName'     => "CanonCameraInfo.FNumber",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
        'pos'         => 3,
        'type'        => ByteType::UBYTE,
      ),

      "0x000d.40D.4" => Array(
        'tagName'     => "CanonCameraInfo.ExposureTime",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
        'pos'         => 4,
        'type'        => ByteType::UBYTE,
      ),

      "0x000d.40D.6" => Array(
        'tagName'     => "CanonCameraInfo.ISO",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
        'pos'         => 6,
        'type'        => ByteType::UBYTE,
      ),

      "0x000d.40D.21" => Array(
        'tagName'     => "CanonCameraInfo.FlashMeteringMode",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'pos'         => 21,
        'type'        => ByteType::UBYTE,
        'tagValues'   => Array(
            0 => "E-TTL",
            3 => "TTL",
            4 => "External Auto",
            5 => "External Manual",
            6 => "Off",
        )
      ),

      "0x000d.40D.24" => Array(
        'tagName'     => "CanonCameraInfo.CameraTemperature",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'pos'         => 24,
        'type'        => ByteType::UBYTE,
      ),

      "0x000d.40D.27" => Array(
        'tagName'     => "CanonCameraInfo.MacroMagnification",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
        'pos'         => 29,
        'type'        => ByteType::UBYTE,
      ),

      "0x000d.40D.29" => Array(
        'tagName'     => "CanonCameraInfo.FocalLength",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'pos'         => 29,
        'type'        => ByteType::USHORT,
        'byteOrder'   => BYTE_ORDER_BIG_ENDIAN,
      ),

      "0x000d.40D.48" => Array(
        'tagName'     => "CanonCameraInfo.CameraOrientation",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'pos'         => 48,
        'type'        => ByteType::UBYTE,
        'tagValues'   => Array(
            0 => "Horizontal (normal)",
            1 => "Rotate 90 CW",
            2 => "Rotate 270 CW",
        )
      ),

      "0x000d.40D.67" => Array(
        'tagName'     => "CanonCameraInfo.FocusDistanceUpper",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
        'pos'         => 67,
        'type'        => ByteType::USHORT,
        'byteOrder'   => BYTE_ORDER_BIG_ENDIAN,
      ),

      "0x000d.40D.69" => Array(
        'tagName'     => "CanonCameraInfo.FocusDistanceLower",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
        'pos'         => 69,
        'type'        => ByteType::USHORT,
        'byteOrder'   => BYTE_ORDER_BIG_ENDIAN,
      ),

      "0x000d.40D.111" => Array(
        'tagName'     => "CanonCameraInfo.WhiteBalance",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'pos'         => 111,
        'type'        => ByteType::USHORT,
      ),

      "0x000d.40D.115" => Array(
        'tagName'     => "CanonCameraInfo.ColorTemperature",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
        'pos'         => 115,
        'type'        => ByteType::USHORT,
      ),

      "0x000d.40D.214" => Array(
        'tagName'     => "CanonCameraInfo.LensType",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'pos'         => 214,
        'type'        => ByteType::USHORT,
        'byteOrder'   => BYTE_ORDER_BIG_ENDIAN,
      ),

      "0x000d.40D.216" => Array(
        'tagName'     => "CanonCameraInfo.ShortFocal",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'pos'         => 216,
        'type'        => ByteType::USHORT,
        'byteOrder'   => BYTE_ORDER_BIG_ENDIAN,
      ),

      "0x000d.40D.218" => Array(
        'tagName'     => "CanonCameraInfo.LongFocal",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'pos'         => 218,
        'type'        => ByteType::UBYTE,
        'byteOrder'   => BYTE_ORDER_BIG_ENDIAN,
      ),

      "0x000d.40D.255" => Array(
        'tagName'     => "CanonCameraInfo.FirmwareVersion",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'pos'         => 255,
        'type'        => ByteType::ASCII,
        'length'      => 6,
      ),

      "0x000d.40D.307" => Array(
        'tagName'     => "CanonCameraInfo.FileIndex",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
        'pos'         => 307,
        'type'        => ByteType::ULONG,
      ),

      "0x000d.40D.319" => Array(
        'tagName'     => "CanonCameraInfo.DirectoryIndex",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
        'pos'         => 319,
        'type'        => ByteType::ULONG,
      ),

      "0x000d.40D.2347" => Array(
        'tagName'     => "CanonCameraInfo.LensModel",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'pos'         => 2347,
        'type'        => ByteType::ASCII,
        'length'      => 64,
      ),


      /*
       * Canon EOS 40D CameraInfo tags
       */
      "0x000d.1DMarkIV.3" => Array(
        'tagName'     => "CanonCameraInfo.FNumber",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
        'pos'         => 3,
        'type'        => ByteType::UBYTE,
      ),

      "0x000d.1DMarkIV.4" => Array(
        'tagName'     => "CanonCameraInfo.ExposureTime",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
        'pos'         => 4,
        'type'        => ByteType::UBYTE,
      ),

      "0x000d.1DMarkIV.6" => Array(
        'tagName'     => "CanonCameraInfo.ISO",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
        'pos'         => 6,
        'type'        => ByteType::UBYTE,
      ),

      "0x000d.1DMarkIV.7" => Array(
        'tagName'     => "CanonCameraInfo.HighlightTonePriority",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'pos'         => 7,
        'type'        => ByteType::UBYTE,
        'tagValues'   => Array(
            0 => "Off",
            1 => "On"
        ),
      ),

      "0x000d.1DMarkIV.21" => Array(
        'tagName'     => "CanonCameraInfo.FlashMeteringMode",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'pos'         => 21,
        'type'        => ByteType::UBYTE,
        'tagValues'   => Array(
            0 => "E-TTL",
            3 => "TTL",
            4 => "External Auto",
            5 => "External Manual",
            6 => "Off",
        )
      ),

      "0x000d.1DMarkIV.25" => Array(
        'tagName'     => "CanonCameraInfo.CameraTemperature",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'pos'         => 25,
        'type'        => ByteType::UBYTE,
      ),

      "0x000d.1DMarkIV.30" => Array(
        'tagName'     => "CanonCameraInfo.FocalLength",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'pos'         => 30,
        'type'        => ByteType::USHORT,
        'byteOrder'   => BYTE_ORDER_BIG_ENDIAN,
      ),

      "0x000d.1DMarkIV.53" => Array(
        'tagName'     => "CanonCameraInfo.CameraOrientation",
        'schema'      => "Canon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'pos'         => 53,
        'type'        => ByteType::UBYTE,
        'tagValues'   => Array(
            0 => "Horizontal (normal)",
            1 => "Rotate 90 CW",
            2 => "Rotate 270 CW",
        )
      ),

      "0x000d.1DMarkIV.84" => Array(
        'tagName'     => "CanonCameraInfo.FocusDistanceUpper",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
        'pos'         => 84,
        'type'        => ByteType::USHORT,
        'byteOrder'   => BYTE_ORDER_BIG_ENDIAN,
      ),

      "0x000d.1DMarkIV.86" => Array(
        'tagName'     => "CanonCameraInfo.FocusDistanceLower",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
        'pos'         => 86,
        'type'        => ByteType::USHORT,
        'byteOrder'   => BYTE_ORDER_BIG_ENDIAN,
      ),


      /*
       * <<< end of CanonCameraInfo subtags
       *
       */

      // CanonFileLength, tag 0x000e
      0x000e => Array(
        'tagName'     => "CanonFileLength",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < CanonFileLength

      // CustomFunctions, tag 0x000f
      0x000f => Array(
        'tagName'     => "CustomFunctions",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < CustomFunctions

      // CanonModelID, tag 0x0010
      0x0010 => Array(
        'tagName'     => "CanonModelID",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.special'   => Array(
            '0x01010000' => "PowerShot A30",
            '0x01040000' => "PowerShot S300 / Digital IXUS 300 / IXY Digital 300",
            '0x01060000' => "PowerShot A20",
            '0x01080000' => "PowerShot A10",
            '0x01090000' => "PowerShot S110 / Digital IXUS v / IXY Digital 200",
            '0x01100000' => "PowerShot G2",
            '0x01110000' => "PowerShot S40",
            '0x01120000' => "PowerShot S30",
            '0x01130000' => "PowerShot A40",
            '0x01140000' => "EOS D30",
            '0x01150000' => "PowerShot A100",
            '0x01160000' => "PowerShot S200 / Digital IXUS v2 / IXY Digital 200a",
            '0x01170000' => "PowerShot A200",
            '0x01180000' => "PowerShot S330 / Digital IXUS 330 / IXY Digital 300a",
            '0x01190000' => "PowerShot G3",
            '0x01210000' => "PowerShot S45",
            '0x01230000' => "PowerShot SD100 / Digital IXUS II / IXY Digital 30",
            '0x01240000' => "PowerShot S230 / Digital IXUS v3 / IXY Digital 320",
            '0x01250000' => "PowerShot A70",
            '0x01260000' => "PowerShot A60",
            '0x01270000' => "PowerShot S400 / Digital IXUS 400 / IXY Digital 400",
            '0x01290000' => "PowerShot G5",
            '0x01300000' => "PowerShot A300",
            '0x01310000' => "PowerShot S50",
            '0x01340000' => "PowerShot A80",
            '0x01350000' => "PowerShot SD10 / Digital IXUS i / IXY Digital L",
            '0x01360000' => "PowerShot S1 IS",
            '0x01370000' => "PowerShot Pro1",
            '0x01380000' => "PowerShot S70",
            '0x01390000' => "PowerShot S60",
            '0x01400000' => "PowerShot G6",
            '0x01410000' => "PowerShot S500 / Digital IXUS 500 / IXY Digital 500",
            '0x01420000' => "PowerShot A75",
            '0x01440000' => "PowerShot SD110 / Digital IXUS IIs / IXY Digital 30a",
            '0x01450000' => "PowerShot A400",
            '0x01470000' => "PowerShot A310",
            '0x01490000' => "PowerShot A85",
            '0x01520000' => "PowerShot S410 / Digital IXUS 430 / IXY Digital 450",
            '0x01530000' => "PowerShot A95",
            '0x01540000' => "PowerShot SD300 / Digital IXUS 40 / IXY Digital 50",
            '0x01550000' => "PowerShot SD200 / Digital IXUS 30 / IXY Digital 40",
            '0x01560000' => "PowerShot A520",
            '0x01570000' => "PowerShot A510",
            '0x01590000' => "PowerShot SD20 / Digital IXUS i5 / IXY Digital L2",
            '0x01640000' => "PowerShot S2 IS",
            '0x01650000' => "PowerShot SD430 / IXUS Wireless / IXY Wireless",
            '0x01660000' => "PowerShot SD500 / Digital IXUS 700 / IXY Digital 600",
            '0x01668000' => "EOS D60",
            '0x01700000' => "PowerShot SD30 / Digital IXUS i zoom / IXY Digital L3",
            '0x01740000' => "PowerShot A430",
            '0x01750000' => "PowerShot A410",
            '0x01760000' => "PowerShot S80",
            '0x01780000' => "PowerShot A620",
            '0x01790000' => "PowerShot A610",
            '0x01800000' => "PowerShot SD630 / Digital IXUS 65 / IXY Digital 80",
            '0x01810000' => "PowerShot SD450 / Digital IXUS 55 / IXY Digital 60",
            '0x01820000' => "PowerShot TX1",
            '0x01870000' => "PowerShot SD400 / Digital IXUS 50 / IXY Digital 55",
            '0x01880000' => "PowerShot A420",
            '0x01890000' => "PowerShot SD900 / Digital IXUS 900 Ti / IXY Digital 1000",
            '0x01900000' => "PowerShot SD550 / Digital IXUS 750 / IXY Digital 700",
            '0x01920000' => "PowerShot A700",
            '0x01940000' => "PowerShot SD700 IS / Digital IXUS 800 IS / IXY Digital 800 IS",
            '0x01950000' => "PowerShot S3 IS",
            '0x01960000' => "PowerShot A540",
            '0x01970000' => "PowerShot SD600 / Digital IXUS 60 / IXY Digital 70",
            '0x01980000' => "PowerShot G7",
            '0x01990000' => "PowerShot A530",
            '0x02000000' => "PowerShot SD800 IS / Digital IXUS 850 IS / IXY Digital 900 IS",
            '0x02010000' => "PowerShot SD40 / Digital IXUS i7 / IXY Digital L4",
            '0x02020000' => "PowerShot A710 IS",
            '0x02030000' => "PowerShot A640",
            '0x02040000' => "PowerShot A630",
            '0x02090000' => "PowerShot S5 IS",
            '0x02100000' => "PowerShot A460",
            '0x02120000' => "PowerShot SD850 IS / Digital IXUS 950 IS / IXY Digital 810 IS",
            '0x02130000' => "PowerShot A570 IS",
            '0x02140000' => "PowerShot A560",
            '0x02150000' => "PowerShot SD750 / Digital IXUS 75 / IXY Digital 90",
            '0x02160000' => "PowerShot SD1000 / Digital IXUS 70 / IXY Digital 10",
            '0x02180000' => "PowerShot A550",
            '0x02190000' => "PowerShot A450",
            '0x02230000' => "PowerShot G9",
            '0x02240000' => "PowerShot A650 IS",
            '0x02260000' => "PowerShot A720 IS",
            '0x02290000' => "PowerShot SX100 IS",
            '0x02300000' => "PowerShot SD950 IS / Digital IXUS 960 IS / IXY Digital 2000 IS",
            '0x02310000' => "PowerShot SD870 IS / Digital IXUS 860 IS / IXY Digital 910 IS",
            '0x02320000' => "PowerShot SD890 IS / Digital IXUS 970 IS / IXY Digital 820 IS",
            '0x02360000' => "PowerShot SD790 IS / Digital IXUS 90 IS / IXY Digital 95 IS",
            '0x02370000' => "PowerShot SD770 IS / Digital IXUS 85 IS / IXY Digital 25 IS",
            '0x02380000' => "PowerShot A590 IS",
            '0x02390000' => "PowerShot A580",
            '0x02420000' => "PowerShot A470",
            '0x02430000' => "PowerShot SD1100 IS / Digital IXUS 80 IS / IXY Digital 20 IS",
            '0x02460000' => "PowerShot SX1 IS",
            '0x02470000' => "PowerShot SX10 IS",
            '0x02480000' => "PowerShot A1000 IS",
            '0x02490000' => "PowerShot G10",
            '0x02510000' => "PowerShot A2000 IS",
            '0x02520000' => "PowerShot SX110 IS",
            '0x02530000' => "PowerShot SD990 IS / Digital IXUS 980 IS / IXY Digital 3000 IS",
            '0x02540000' => "PowerShot SD880 IS / Digital IXUS 870 IS / IXY Digital 920 IS",
            '0x02550000' => "PowerShot E1",
            '0x02560000' => "PowerShot D10",
            '0x02570000' => "PowerShot SD960 IS / Digital IXUS 110 IS / IXY Digital 510 IS",
            '0x02580000' => "PowerShot A2100 IS",
            '0x02590000' => "PowerShot A480",
            '0x02600000' => "PowerShot SX200 IS",
            '0x02610000' => "PowerShot SD970 IS / Digital IXUS 990 IS / IXY Digital 830 IS",
            '0x02620000' => "PowerShot SD780 IS / Digital IXUS 100 IS / IXY Digital 210 IS",
            '0x02630000' => "PowerShot A1100 IS",
            '0x02640000' => "PowerShot SD1200 IS / Digital IXUS 95 IS / IXY Digital 110 IS",
            '0x02700000' => "PowerShot G11",
            '0x02710000' => "PowerShot SX120 IS",
            '0x02720000' => "PowerShot S90",
            '0x02750000' => "PowerShot SX20 IS",
            '0x02760000' => "PowerShot SD980 IS / Digital IXUS 200 IS / IXY Digital 930 IS",
            '0x02770000' => "PowerShot SD940 IS / Digital IXUS 120 IS / IXY Digital 220 IS",
            '0x02800000' => "PowerShot A495",
            '0x02810000' => "PowerShot A490",
            '0x02820000' => "PowerShot A3100 IS",
            '0x02830000' => "PowerShot A3000 IS",
            '0x02840000' => "PowerShot SD1400 IS / Digital IXUS 130 / IXY Digital 400F",
            '0x02850000' => "PowerShot SD1300 IS / Digital IXUS 105 / IXY Digital 200F",
            '0x02860000' => "PowerShot SD3500 IS / Digital IXUS 210 / IXY Digital 10S",
            '0x02870000' => "PowerShot SX210 IS",
            '0x03010000' => "PowerShot Pro90 IS",
            '0x04040000' => "PowerShot G1",
            '0x06040000' => "PowerShot S100 / Digital IXUS / IXY Digital",
            '0x4007d675' => "HV10",
            '0x4007d777' => "iVIS DC50",
            '0x4007d778' => "iVIS HV20",
            '0x4007d779' => "DC211",
            '0x4007d77b' => "iVIS HR10",
            '0x4007d87f' => "FS100",
            '0x4007d880' => "iVIS HF10",
            '0x80000001' => "EOS-1D",
            '0x80000167' => "EOS-1DS",
            '0x80000168' => "EOS 10D",
            '0x80000169' => "EOS-1D Mark III",
            '0x80000170' => "EOS Digital Rebel / 300D / Kiss Digital",
            '0x80000174' => "EOS-1D Mark II",
            '0x80000175' => "EOS 20D",
            '0x80000176' => "EOS Digital Rebel XSi / 450D / Kiss X2",
            '0x80000188' => "EOS-1Ds Mark II",
            '0x80000189' => "EOS Digital Rebel XT / 350D / Kiss Digital N",
            '0x80000190' => "EOS 40D",
            '0x80000213' => "EOS 5D",
            '0x80000215' => "EOS-1Ds Mark III",
            '0x80000218' => "EOS 5D Mark II",
            '0x80000232' => "EOS-1D Mark II N",
            '0x80000234' => "EOS 30D",
            '0x80000236' => "EOS Digital Rebel XTi / 400D / Kiss Digital X (and rare K236)",
            '0x80000250' => "EOS 7D",
            '0x80000252' => "EOS Rebel T1i / 500D / Kiss X3",
            '0x80000254' => "EOS Rebel XS / 1000D / Kiss F",
            '0x80000261' => "EOS 50D",
            '0x80000270' => "EOS Rebel T2i / 550D / Kiss X4",
            '0x80000281' => "EOS-1D Mark IV",
        ),
      ), // < CanonModelID

      // CanonAFInfo, tag 0x0012
      0x0012 => Array(
        'tagName'     => "CanonAFInfo",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < CanonAFInfo

      // ThumbnailImageValidArea, tag 0x0013
      0x0013 => Array(
        'tagName'     => "ThumbnailImageValidArea",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ThumbnailImageValidArea

      // SerialNumberFormat, tag 0x0015
      0x0015 => Array(
        'tagName'     => "SerialNumberFormat",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.special' => Array(
            '0x90000000' => "Format 1",
            '0xa0000000' => "Format 2",
        )
      ), // < SerialNumberFormat

      // SuperMacro, tag 0x001a
      0x001a => Array(
        'tagName'     => "SuperMacro",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < SuperMacro

      // DateStampMode, tag 0x001c
      0x001c => Array(
        'tagName'     => "DateStampMode",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < DateStampMode

      // MyColors, tag 0x001d
      0x001d => Array(
        'tagName'     => "MyColors",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < MyColors

      // FirmwareRevision, tag 0x001e
      0x001e => Array(
        'tagName'     => "FirmwareRevision",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < FirmwareRevision

      // Categories, tag 0x0023
      0x0023 => Array(
        'tagName'     => "Categories",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < Categories

      // FaceDetect1, tag 0x0024
      0x0024 => Array(
        'tagName'     => "FaceDetect1",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < FaceDetect1

      // FaceDetect2, tag 0x0025
      0x0025 => Array(
        'tagName'     => "FaceDetect2",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < FaceDetect2

      // CanonAFInfo2, tag 0x0026
      0x0026 => Array(
        'tagName'     => "CanonAFInfo2",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < CanonAFInfo2

      // ImageUniqueID, tag 0x0028
      0x0028 => Array(
        'tagName'     => "ImageUniqueID",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ImageUniqueID

      // RawDataOffset, tag 0x0081
      0x0081 => Array(
        'tagName'     => "RawDataOffset",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < RawDataOffset

      // OriginalDecisionDataOffset, tag 0x0083
      0x0083 => Array(
        'tagName'     => "OriginalDecisionDataOffset",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < OriginalDecisionDataOffset

      // CustomFunctions1D, tag 0x0090
      0x0090 => Array(
        'tagName'     => "CustomFunctions1D",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < CustomFunctions1D

      // PersonalFunctions, tag 0x0091
      0x0091 => Array(
        'tagName'     => "PersonalFunctions",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < PersonalFunctions

      // PersonalFunctionValues, tag 0x0092
      0x0092 => Array(
        'tagName'     => "PersonalFunctionValues",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < PersonalFunctionValues

      // CanonFileInfo, tag 0x0093
      0x0093 => Array(
        'tagName'     => "CanonFileInfo",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < CanonFileInfo

      // AFPointsInFocus1D, tag 0x0094
      0x0094 => Array(
        'tagName'     => "AFPointsInFocus1D",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < AFPointsInFocus1D

      // LensModel, tag 0x0095
      0x0095 => Array(
        'tagName'     => "LensModel",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < LensModel

      // InternalSerialNumber, tag 0x0096
      0x0096 => Array(
        'tagName'     => "InternalSerialNumber",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < InternalSerialNumber

      // DustRemovalData, tag 0x0097
      0x0097 => Array(
        'tagName'     => "DustRemovalData",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < DustRemovalData

      // CustomFunctions2, tag 0x0099
      0x0099 => Array(
        'tagName'     => "CustomFunctions2",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < CustomFunctions2

      // ProcessingInfo, tag 0x00a0
      0x00a0 => Array(
        'tagName'     => "ProcessingInfo",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ProcessingInfo

      // ToneCurveTable, tag 0x00a1
      0x00a1 => Array(
        'tagName'     => "ToneCurveTable",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ToneCurveTable

      // SharpnessTable, tag 0x00a2
      0x00a2 => Array(
        'tagName'     => "SharpnessTable",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < SharpnessTable

      // SharpnessFreqTable, tag 0x00a3
      0x00a3 => Array(
        'tagName'     => "SharpnessFreqTable",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < SharpnessFreqTable

      // WhiteBalanceTable, tag 0x00a4
      0x00a4 => Array(
        'tagName'     => "WhiteBalanceTable",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < WhiteBalanceTable

      // ColorBalance, tag 0x00a9
      0x00a9 => Array(
        'tagName'     => "ColorBalance",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ColorBalance

      // MeasuredColor, tag 0x00aa
      0x00aa => Array(
        'tagName'     => "MeasuredColor",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < MeasuredColor

      // ColorTemperature, tag 0x00ae
      0x00ae => Array(
        'tagName'     => "ColorTemperature",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ColorTemperature

      // CanonFlags, tag 0x00b0
      0x00b0 => Array(
        'tagName'     => "CanonFlags",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < CanonFlags

      // ModifiedInfo, tag 0x00b1
      0x00b1 => Array(
        'tagName'     => "ModifiedInfo",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ModifiedInfo

      // ToneCurveMatching, tag 0x00b2
      0x00b2 => Array(
        'tagName'     => "ToneCurveMatching",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ToneCurveMatching

      // WhiteBalanceMatching, tag 0x00b3
      0x00b3 => Array(
        'tagName'     => "WhiteBalanceMatching",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < WhiteBalanceMatching

      // ColorSpace, tag 0x00b4
      0x00b4 => Array(
        'tagName'     => "ColorSpace",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ColorSpace

      // PreviewImageInfo, tag 0x00b6
      0x00b6 => Array(
        'tagName'     => "PreviewImageInfo",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < PreviewImageInfo

      // VRDOffset, tag 0x00d0
      0x00d0 => Array(
        'tagName'     => "VRDOffset",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < VRDOffset

      // SensorInfo, tag 0x00e0
      0x00e0 => Array(
        'tagName'     => "SensorInfo",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < SensorInfo

      // ColorData, tag 0x4001
      0x4001 => Array(
        'tagName'     => "ColorData",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ColorData

      // ColorInfo, tag 0x4003
      0x4003 => Array(
        'tagName'     => "ColorInfo",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ColorInfo

      // AFMicroAdj, tag 0x4013
      0x4013 => Array(
        'tagName'     => "AFMicroAdj",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < AFMicroAdj

      // VignettingCorr, tag 0x4015
      0x4015 => Array(
        'tagName'     => "VignettingCorr",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < VignettingCorr

      // VignettingCorr2, tag 0x4016
      0x4016 => Array(
        'tagName'     => "VignettingCorr2",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < VignettingCorr2

      // LightingOpt, tag 0x4018
      0x4018 => Array(
        'tagName'     => "LightingOpt",
        'schema'      => "Canon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < LightingOpt


    );

    function __destruct()
    {
      parent::__destruct();
    }

  } // CanonTags



?>
