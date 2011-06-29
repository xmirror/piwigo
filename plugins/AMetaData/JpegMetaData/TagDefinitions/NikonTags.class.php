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
 * The NikonTags is the definition of the specific Nikon Exif tags
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 * The NikonTags class is derived from the KnownTags class.
 *
 * ======> See KnownTags.class.php to know more about the tag definitions <=====
 *
 *
 * Nikon values from
 *  - Exiftool by Phil Harvey    => http://www.sno.phy.queensu.ca/~phil/exiftool/
 *                                  http://owl.phy.queensu.ca/~phil/exiftool/TagNames
 *  - Exiv2 by Andreas Huggel    => http://www.exiv2.org/
 *
 */

  require_once(JPEG_METADATA_DIR."TagDefinitions/KnownTags.class.php");

  /**
   * Define the tags for Nikon camera
   */
  class NikonTags extends KnownTags
  {
    protected $label = "Nikon specific tags";
    protected $tags = Array(
      /*
       * tags with defined values
       */

      // MakerNoteVersion, tag 0x0001
      0x0001 => Array(
        'tagName'     => "MakerNoteVersion",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < MakerNoteVersion

      // ISO, tag 0x0002
      0x0002 => Array(
        'tagName'     => "ISO",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ISO

      // ColorMode, tag 0x0003
      0x0003 => Array(
        'tagName'     => "ColorMode",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < ColorMode

      // , tag 0x0004
      0x0004 => Array(
        'tagName'     => "Quality",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < Quality

      // WhiteBalance, tag 0x0005
      0x0005 => Array(
        'tagName'     => "WhiteBalance",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < WhiteBalance

      // Sharpness, tag 0x0006
      0x0006 => Array(
        'tagName'     => "Sharpness",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < Sharpness

      // FocusMode, tag 0x0007
      0x0007 => Array(
        'tagName'     => "FocusMode",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < FocusMode

      // FlashSetting, tag 0x0008
      0x0008 => Array(
        'tagName'     => "FlashSetting",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < FlashSetting

      // FlashType, tag 0x0009
      0x0009 => Array(
        'tagName'     => "FlashType",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < FlashType

      // WhiteBalanceFineTune, tag 0x000b
      0x000b => Array(
        'tagName'     => "WhiteBalanceFineTune",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < WhiteBalanceFineTune

      // WB_RBLevels, tag 0x000c
      0x000c => Array(
        'tagName'     => "WB_RBLevels",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < WB_RBLevels

      // ProgramShift, tag 0x000d
      0x000d => Array(
        'tagName'     => "ProgramShift",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ProgramShift

      // ExposureDifference, tag 0x000e
      0x000e => Array(
        'tagName'     => "ExposureDifference",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ExposureDifference

      // ISOSelection, tag 0x000f
      0x000f => Array(
        'tagName'     => "ISOSelection",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < ISOSelection

      // DataDump, tag 0x0010
      0x0010 => Array(
        'tagName'     => "DataDump",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < DataDump

      // NikonPreview, tag 0x0011
      0x0011 => Array(
        'tagName'     => "NikonPreview",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < NikonPreview

      // FlashExposureComp, tag 0x0012
      0x0012 => Array(
        'tagName'     => "FlashExposureComp",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < FlashExposureComp

      // ISOSetting, tag 0x0013
      0x0013 => Array(
        'tagName'     => "ISOSetting",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ISOSetting

      // ColorBalanceA, tag 0x0014
      0x0014 => Array(
        'tagName'     => "ColorBalanceA",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ColorBalanceA

      // ImageBoundary, tag 0x0016
      0x0016 => Array(
        'tagName'     => "ImageBoundary",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ImageBoundary

      // FlashExposureComp, tag 0x0017
      0x0017 => Array(
        'tagName'     => "FlashExposureComp",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < FlashExposureComp

      // FlashExposureBracketValue, tag 0x0018
      0x0018 => Array(
        'tagName'     => "FlashExposureBracketValue",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < FlashExposureBracketValue

      // ExposureBracketValue, tag 0x0019
      0x0019 => Array(
        'tagName'     => "ExposureBracketValue",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ExposureBracketValue

      // ImageProcessing, tag 0x001a
      0x001a => Array(
        'tagName'     => "ImageProcessing",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ImageProcessing

      // CropHiSpeed, tag 0x001b
      0x001b => Array(
        'tagName'     => "CropHiSpeed",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < CropHiSpeed

      // ExposureTuning, tag 0x001c
      0x001c => Array(
        'tagName'     => "ExposureTuning",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ExposureTuning

      // SerialNumber, tag 0x001d
      0x001d => Array(
        'tagName'     => "SerialNumber",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < SerialNumber

      // ColorSpace, tag 0x001e
      0x001e => Array(
        'tagName'     => "ColorSpace",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          1 => "sRGB",
          2 => "Adobe RGB"
        )
      ), // < ColorSpace

      // VRInfo, tag 0x001f
      0x001f => Array(
        'tagName'     => "VRInfo",
        'schema'      => "Nikon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < VRInfo

      // ImageAuthentication, tag 0x0020
      0x0020 => Array(
        'tagName'     => "ImageAuthentication",
        'schema'      => "Nikon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0 => "Off",
          1 => "On"
        )
      ), // < ImageAuthentication

      // ActiveD-Lighting, tag 0x0022
      0x0022 => Array(
        'tagName'     => "ActiveD-Lighting",
        'schema'      => "Nikon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0 => "Off",
          1 => "low",
          3 => "normal",
          5 => "high",
          0xffff => "Auto"
        )
      ), // < ActiveD-Lighting

      // PictureControl, tag 0x0023
      0x0023 => Array(
        'tagName'     => "PictureControl",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < PictureControl

      // WorldTime, tag 0x0024
      0x0024 => Array(
        'tagName'     => "WorldTime",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < WorldTime

      // ISOInfo, tag 0x0025
      0x0025 => Array(
        'tagName'     => "ISOInfo",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ISOInfo

      // VignetteControl, tag 0x002a
      0x002a => Array(
        'tagName'     => "VignetteControl",
        'schema'      => "Nikon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0 => "Off",
          1 => "low",
          3 => "normal",
          5 => "high",
        )
      ), // < VignetteControl

      // DistortInfo, tag 0x002b
      0x002b => Array(
        'tagName'     => "DistortInfo",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < DistortInfo

      // ImageAdjustment, tag 0x0080
      0x0080 => Array(
        'tagName'     => "ImageAdjustment",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < ImageAdjustment

      // ToneComp, tag 0x0081
      0x0081 => Array(
        'tagName'     => "ToneComp",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < ToneComp

      // AuxiliaryLens, tag 0x0082
      0x0082 => Array(
        'tagName'     => "AuxiliaryLens",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < AuxiliaryLens

      // LensType, tag 0x0083
      0x0083 => Array(
        'tagName'     => "LensType",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.specialValues' => Array(
          0x0001 => "MF", //b0001
          0x0002 => "D",  //b0010
          0x0004 => "G",  //b0100
          0x0008 => "VR"  //b1000
        ),
      ), // < LensType

      // Lens, tag 0x0084
      0x0084 => Array(
        'tagName'     => "Lens",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < Lens

      // ManualFocusDistance, tag 0x0085
      0x0085 => Array(
        'tagName'     => "ManualFocusDistance",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ManualFocusDistance

      // DigitalZoom, tag 0x0086
      0x0086 => Array(
        'tagName'     => "DigitalZoom",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < DigitalZoom

      // FlashMode, tag 0x0087
      0x0087 => Array(
        'tagName'     => "FlashMode",
        'schema'      => "Nikon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0 => "Did not fire",
          1 => "Fired, manual",
          3 => "Not ready",
          7 => "Fired, external",
          8 => "Fired, commander mode",
          9 => "Fired, TTL mode",
        )
      ), // < FlashMode

      // AFInfo, tag 0x0088
      0x0088 => Array(
        'tagName'     => "AFInfo",
        'schema'      => "Nikon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.specialValues' => Array(
          0 => Array(
                  0x0 => "Single Area",
                  0x1 => "Dynamic Area",
                  0x2 => "Dynamic Area (closest subject)",
                  0x3 => "Group Dynamic",
                  0x4 => "Single Area (wide)",
                  0x5 => "Dynamic Area (wide)",
                ),
          1 => Array(
                  0x0 => "Center",
                  0x1 => "Top",
                  0x2 => "Bottom",
                  0x3 => "Mid-left",
                  0x4 => "Mid-right",
                  0x5 => "Upper-left",
                  0x6 => "Upper-right",
                  0x7 => "Lower-left",
                  0x8 => "Lower-right",
                  0x9 => "Far Left",
                  0xA => "Far Right",
                ),
          2 => Array(
                  0x0001 => "Center",
                  0x0002 => "Top",
                  0x0004 => "Bottom",
                  0x0008 => "Mid-left",
                  0x0010 => "Mid-right",
                  0x0020 => "Upper-left",
                  0x0040 => "Upper-right",
                  0x0080 => "Lower-left",
                  0x0100 => "Lower-right",
                  0x0200 => "Far Left",
                  0x0400 => "Far Right",
                  0x07ff => "All 11 Points"
                )
        )
      ), // <

      // ShootingMode, tag 0x0089
      0x0089 => Array(
        'tagName'     => "ShootingMode",
        'schema'      => "Nikon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.specialValues' => Array(
            0x00 => "Single frame",                            //special value
            0x01 => "Continuous",                              //b00000001(bit0)
            0x02 => "Delay",                                   //b00000010
            0x04 => "PC Control",                              //b00000100
            0x08 => "?",                                       //b00001000
            0x10 => "Exposure Bracketing",                     //b00010000
            0x20 => Array(0=>"Auto ISO", 1=>"Unused LE-NR Slowdown"),//b00100000(bit5)
            0x40 => "White-Balance Bracketing",                //b01000000
            0x80 => "IR Control",                              //b10000000(bit7)
        ),
      ), // < ShootingMode

      // LensFStops, tag 0x008b
      0x008b => Array(
        'tagName'     => "LensFStops",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < LensFStops

      // ContrastCurve, tag 0x008c
      0x008c => Array(
        'tagName'     => "ContrastCurve",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ContrastCurve

      // ColorHue, tag 0x008d
      0x008d => Array(
        'tagName'     => "ColorHue",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < ColorHue

      // SceneMode, tag 0x008f
      0x008f => Array(
        'tagName'     => "SceneMode",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < SceneMode

      // LightSource, tag 0x0090
      0x0090 => Array(
        'tagName'     => "LightSource",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < LightSource

      // ShotInfo, tag 0x0091
      0x0091 => Array(
        'tagName'     => "ShotInfo",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // <

      // HueAdjustment, tag 0x0092
      0x0092 => Array(
        'tagName'     => "HueAdjustment",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < HueAdjustment

      // NEFCompression, tag 0x0093
      0x0093 => Array(
        'tagName'     => "NEFCompression",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues' => Array(
          0x01 => "Lossy (type 1)",
          0x02 => "Uncompressed",
          0x03 => "Lossless",
          0x04 => "Lossy (type 2)",
        ),
      ), // < NEFCompression

      // Saturation, tag 0x0094
      0x0094 => Array(
        'tagName'     => "Saturation",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < Saturation

      // NoiseReduction, tag 0x0095
      0x0095 => Array(
        'tagName'     => "NoiseReduction",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < NoiseReduction

      // LinearizationTable, tag 0x0096
      0x0096 => Array(
        'tagName'     => "LinearizationTable",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < LinearizationTable

      // ColorBalance, tag 0x0097
      0x0097 => Array(
        'tagName'     => "ColorBalance",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ColorBalance

      //  LensData, tag 0x0098
      0x0098 => Array(
        'tagName'     => "LensData",
        'schema'      => "true",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.lenses' => Array(
          'unknown' => "Unknown lenses",
          '01 58 50 50 14 14 02 00' => 'AF Nikkor 50mm f/1.8',
          '02 42 44 5C 2A 34 02 00' => 'AF Zoom-Nikkor 35-70mm f/3.3-4.5',
          '02 42 44 5C 2A 34 08 00' => 'AF Zoom-Nikkor 35-70mm f/3.3-4.5',
          '03 48 5C 81 30 30 02 00' => 'AF Zoom-Nikkor 70-210mm f/4',
          '04 48 3C 3C 24 24 03 00' => 'AF Nikkor 28mm f/2.8',
          '05 54 50 50 0C 0C 04 00' => 'AF Nikkor 50mm f/1.4',
          '06 54 53 53 24 24 06 00' => 'AF Micro-Nikkor 55mm f/2.8',
          '07 40 3C 62 2C 34 03 00' => 'AF Zoom-Nikkor 28-85mm f/3.5-4.5',
          '08 40 44 6A 2C 34 04 00' => 'AF Zoom-Nikkor 35-105mm f/3.5-4.5',
          '09 48 37 37 24 24 04 00' => 'AF Nikkor 24mm f/2.8',
          '0A 48 8E 8E 24 24 03 00' => 'AF Nikkor 300mm f/2.8 IF-ED',
          '0B 48 7C 7C 24 24 05 00' => 'AF Nikkor 180mm f/2.8 IF-ED',
          '0D 40 44 72 2C 34 07 00' => 'AF Zoom-Nikkor 35-135mm f/3.5-4.5',
          '0E 48 5C 81 30 30 05 00' => 'AF Zoom-Nikkor 70-210mm f/4',
          '0F 58 50 50 14 14 05 00' => 'AF Nikkor 50mm f/1.8 N',
          '10 48 8E 8E 30 30 08 00' => 'AF Nikkor 300mm f/4 IF-ED',
          '11 48 44 5C 24 24 08 00' => 'AF Zoom-Nikkor 35-70mm f/2.8',
          '12 48 5C 81 30 3C 09 00' => 'AF Nikkor 70-210mm f/4-5.6',
          '13 42 37 50 2A 34 0B 00' => 'AF Zoom-Nikkor 24-50mm f/3.3-4.5',
          '14 48 60 80 24 24 0B 00' => 'AF Zoom-Nikkor 80-200mm f/2.8 ED',
          '15 4C 62 62 14 14 0C 00' => 'AF Nikkor 85mm f/1.8',
          '17 3C A0 A0 30 30 0F 00' => 'Nikkor 500mm f/4 P ED IF',
          '17 3C A0 A0 30 30 11 00' => 'Nikkor 500mm f/4 P ED IF',
          '18 40 44 72 2C 34 0E 00' => 'AF Zoom-Nikkor 35-135mm f/3.5-4.5 N',
          '1A 54 44 44 18 18 11 00' => 'AF Nikkor 35mm f/2',
          '1B 44 5E 8E 34 3C 10 00' => 'AF Zoom-Nikkor 75-300mm f/4.5-5.6',
          '1C 48 30 30 24 24 12 00' => 'AF Nikkor 20mm f/2.8',
          '1D 42 44 5C 2A 34 12 00' => 'AF Zoom-Nikkor 35-70mm f/3.3-4.5 N',
          '1E 54 56 56 24 24 13 00' => 'AF Micro-Nikkor 60mm f/2.8',
          '1F 54 6A 6A 24 24 14 00' => 'AF Micro-Nikkor 105mm f/2.8',
          '20 48 60 80 24 24 15 00' => 'AF Zoom-Nikkor 80-200mm f/2.8 ED',
          '21 40 3C 5C 2C 34 16 00' => 'AF Zoom-Nikkor 28-70mm f/3.5-4.5',
          '22 48 72 72 18 18 16 00' => 'AF DC-Nikkor 135mm f/2',
          '23 30 BE CA 3C 48 17 00' => 'Zoom-Nikkor 1200-1700mm f/5.6-8 P ED IF',
          '24 48 60 80 24 24 1A 02' => 'AF Zoom-Nikkor 80-200mm f/2.8D ED',
          '25 48 44 5C 24 24 1B 02' => 'AF Zoom-Nikkor 35-70mm f/2.8D',
          '25 48 44 5C 24 24 52 02' => 'AF Zoom-Nikkor 35-70mm f/2.8D',
          '27 48 8E 8E 24 24 1D 02' => 'AF-I Nikkor 300mm f/2.8D IF-ED',
          '27 48 8E 8E 24 24 F1 02' => 'AF-I Nikkor 300mm f/2.8D IF-ED + TC-14E',
          '27 48 8E 8E 24 24 E1 02' => 'AF-I Nikkor 300mm f/2.8D IF-ED + TC-17E',
          '27 48 8E 8E 24 24 F2 02' => 'AF-I Nikkor 300mm f/2.8D IF-ED + TC-20E',
          '28 3C A6 A6 30 30 1D 02' => 'AF-I Nikkor 600mm f/4D IF-ED',
          '28 3C A6 A6 30 30 F1 02' => 'AF-I Nikkor 600mm f/4D IF-ED + TC-14E',
          '28 3C A6 A6 30 30 E1 02' => 'AF-I Nikkor 600mm f/4D IF-ED + TC-17E',
          '28 3C A6 A6 30 30 F2 02' => 'AF-I Nikkor 600mm f/4D IF-ED + TC-20E',
          '2A 54 3C 3C 0C 0C 26 02' => 'AF Nikkor 28mm f/1.4D',
          '2B 3C 44 60 30 3C 1F 02' => 'AF Zoom-Nikkor 35-80mm f/4-5.6D',
          '2C 48 6A 6A 18 18 27 02' => 'AF DC-Nikkor 105mm f/2D',
          '2D 48 80 80 30 30 21 02' => 'AF Micro-Nikkor 200mm f/4D IF-ED',
          '2E 48 5C 82 30 3C 28 02' => 'AF Nikkor 70-210mm f/4-5.6D',
          '2F 48 30 44 24 24 29 02' => Array(
            /*
             * Different lenses can have the same Id.
             * The Nikon Id are made with the focal min/max and the aperture
             * min/max values.
             *
             * So, it's not possible to apply the method used with the Canon
             * lens Id.
             *
             * For multiple lenses with the same key, the method used is to
             * return the first lens
             */
                                          'AF Zoom-Nikkor 20-35mm f/2.8D IF',
                                          'Tokina AT-X 235 AF PRO (AF 20-35mm f/2.8)',
                                       ),
          '30 48 98 98 24 24 24 02' => 'AF-I Nikkor 400mm f/2.8D IF-ED',
          '30 48 98 98 24 24 F1 02' => 'AF-I Nikkor 400mm f/2.8D IF-ED + TC-14E',
          '30 48 98 98 24 24 E1 02' => 'AF-I Nikkor 400mm f/2.8D IF-ED + TC-17E',
          '30 48 98 98 24 24 F2 02' => 'AF-I Nikkor 400mm f/2.8D IF-ED + TC-20E',
          '31 54 56 56 24 24 25 02' => 'AF Micro-Nikkor 60mm f/2.8D',

          '32 54 6A 6A 24 24 35 02' => Array(
                                          'AF Micro-Nikkor 105mm f/2.8D',
                                          'Sigma Macro 105mm f/2.8 EX DG',
                                       ),
          '33 48 2D 2D 24 24 31 02' => 'AF Nikkor 18mm f/2.8D',
          '34 48 29 29 24 24 32 02' => 'AF Fisheye Nikkor 16mm f/2.8D',
          '35 3C A0 A0 30 30 33 02' => 'AF-I Nikkor 500mm f/4D IF-ED',
          '35 3C A0 A0 30 30 F1 02' => 'AF-I Nikkor 500mm f/4D IF-ED + TC-14E',
          '35 3C A0 A0 30 30 E1 02' => 'AF-I Nikkor 500mm f/4D IF-ED + TC-17E',
          '35 3C A0 A0 30 30 F2 02' => 'AF-I Nikkor 500mm f/4D IF-ED + TC-20E',
          '36 48 37 37 24 24 34 02' => 'AF Nikkor 24mm f/2.8D',
          '37 48 30 30 24 24 36 02' => 'AF Nikkor 20mm f/2.8D',
          '38 4C 62 62 14 14 37 02' => 'AF Nikkor 85mm f/1.8D',
          '3A 40 3C 5C 2C 34 39 02' => 'AF Zoom-Nikkor 28-70mm f/3.5-4.5D',
          '3B 48 44 5C 24 24 3A 02' => 'AF Zoom-Nikkor 35-70mm f/2.8D N',
          '3C 48 60 80 24 24 3B 02' => 'AF Zoom-Nikkor 80-200mm f/2.8D ED',
          '3D 3C 44 60 30 3C 3E 02' => 'AF Zoom-Nikkor 35-80mm f/4-5.6D',
          '3E 48 3C 3C 24 24 3D 02' => 'AF Nikkor 28mm f/2.8D',
          '3F 40 44 6A 2C 34 45 02' => 'AF Zoom-Nikkor 35-105mm f/3.5-4.5D',
          '41 48 7C 7C 24 24 43 02' => 'AF Nikkor 180mm f/2.8D IF-ED',
          '42 54 44 44 18 18 44 02' => 'AF Nikkor 35mm f/2D',
          '43 54 50 50 0C 0C 46 02' => 'AF Nikkor 50mm f/1.4D',
          '44 44 60 80 34 3C 47 02' => 'AF Zoom-Nikkor 80-200mm f/4.5-5.6D',
          '45 40 3C 60 2C 3C 48 02' => 'AF Zoom-Nikkor 28-80mm f/3.5-5.6D',
          '46 3C 44 60 30 3C 49 02' => 'AF Zoom-Nikkor 35-80mm f/4-5.6D N',
          '47 42 37 50 2A 34 4A 02' => 'AF Zoom-Nikkor 24-50mm f/3.3-4.5D',
          '48 48 8E 8E 24 24 4B 02' => 'AF-S Nikkor 300mm f/2.8D IF-ED',
          '48 48 8E 8E 24 24 F1 02' => 'AF-S Nikkor 300mm f/2.8D IF-ED + TC-14E',
          '48 48 8E 8E 24 24 E1 02' => 'AF-S Nikkor 300mm f/2.8D IF-ED + TC-17E',
          '48 48 8E 8E 24 24 F2 02' => 'AF-S Nikkor 300mm f/2.8D IF-ED + TC-20E',
          '49 3C A6 A6 30 30 4C 02' => 'AF-S Nikkor 600mm f/4D IF-ED',
          '49 3C A6 A6 30 30 F1 02' => 'AF-S Nikkor 600mm f/4D IF-ED + TC-14E',
          '49 3C A6 A6 30 30 E1 02' => 'AF-S Nikkor 600mm f/4D IF-ED + TC-17E',
          '49 3C A6 A6 30 30 F2 02' => 'AF-S Nikkor 600mm f/4D IF-ED + TC-20E',
          '4A 54 62 62 0C 0C 4D 02' => 'AF Nikkor 85mm f/1.4D IF',
          '4B 3C A0 A0 30 30 4E 02' => 'AF-S Nikkor 500mm f/4D IF-ED',
          '4B 3C A0 A0 30 30 F1 02' => 'AF-S Nikkor 500mm f/4D IF-ED + TC-14E',
          '4B 3C A0 A0 30 30 E1 02' => 'AF-S Nikkor 500mm f/4D IF-ED + TC-17E',
          '4B 3C A0 A0 30 30 F2 02' => 'AF-S Nikkor 500mm f/4D IF-ED + TC-20E',
          '4C 40 37 6E 2C 3C 4F 02' => 'AF Zoom-Nikkor 24-120mm f/3.5-5.6D IF',
          '4D 40 3C 80 2C 3C 62 02' => 'AF Zoom-Nikkor 28-200mm f/3.5-5.6D IF',
          '4E 48 72 72 18 18 51 02' => 'AF DC-Nikkor 135mm f/2D',
          '4F 40 37 5C 2C 3C 53 06' => 'IX-Nikkor 24-70mm f/3.5-5.6',
          '50 48 56 7C 30 3C 54 06' => 'IX-Nikkor 60-180mm f/4-5.6',
          '53 48 60 80 24 24 57 02' => 'AF Zoom-Nikkor 80-200mm f/2.8D ED',
          '53 48 60 80 24 24 60 02' => 'AF Zoom-Nikkor 80-200mm f/2.8D ED',
          '54 44 5C 7C 34 3C 58 02' => 'AF Zoom-Micro Nikkor 70-180mm f/4.5-5.6D ED',
          '56 48 5C 8E 30 3C 5A 02' => 'AF Zoom-Nikkor 70-300mm f/4-5.6D ED',
          '59 48 98 98 24 24 5D 02' => 'AF-S Nikkor 400mm f/2.8D IF-ED',
          '59 48 98 98 24 24 F1 02' => 'AF-S Nikkor 400mm f/2.8D IF-ED + TC-14E',
          '59 48 98 98 24 24 E1 02' => 'AF-S Nikkor 400mm f/2.8D IF-ED + TC-17E',
          '59 48 98 98 24 24 F2 02' => 'AF-S Nikkor 400mm f/2.8D IF-ED + TC-20E',
          '5A 3C 3E 56 30 3C 5E 06' => 'IX-Nikkor 30-60mm f/4-5.6',
          '5B 44 56 7C 34 3C 5F 06' => 'IX-Nikkor 60-180mm f/4.5-5.6',
          '5D 48 3C 5C 24 24 63 02' => 'AF-S Zoom-Nikkor 28-70mm f/2.8D IF-ED',
          '5E 48 60 80 24 24 64 02' => 'AF-S Zoom-Nikkor 80-200mm f/2.8D IF-ED',
          '5F 40 3C 6A 2C 34 65 02' => 'AF Zoom-Nikkor 28-105mm f/3.5-4.5D IF',
          '60 40 3C 60 2C 3C 66 02' => 'AF Zoom-Nikkor 28-80mm f/3.5-5.6D',
          '61 44 5E 86 34 3C 67 02' => 'AF Zoom-Nikkor 75-240mm f/4.5-5.6D',
          '63 48 2B 44 24 24 68 02' => 'AF-S Nikkor 17-35mm f/2.8D IF-ED',
          '64 00 62 62 24 24 6A 02' => 'PC Micro-Nikkor 85mm f/2.8D',
          '65 44 60 98 34 3C 6B 0A' => 'AF VR Zoom-Nikkor 80-400mm f/4.5-5.6D ED',
          '66 40 2D 44 2C 34 6C 02' => 'AF Zoom-Nikkor 18-35mm f/3.5-4.5D IF-ED',
          '67 48 37 62 24 30 6D 02' => 'AF Zoom-Nikkor 24-85mm f/2.8-4D IF',
          '68 42 3C 60 2A 3C 6E 06' => 'AF Zoom-Nikkor 28-80mm f/3.3-5.6G',
          '69 48 5C 8E 30 3C 6F 06' => 'AF Zoom-Nikkor 70-300mm f/4-5.6G',
          '6A 48 8E 8E 30 30 70 02' => 'AF-S Nikkor 300mm f/4D IF-ED',
          '6B 48 24 24 24 24 71 02' => 'AF Nikkor ED 14mm f/2.8D',
          '6D 48 8E 8E 24 24 73 02' => 'AF-S Nikkor 300mm f/2.8D IF-ED II',
          '6E 48 98 98 24 24 74 02' => 'AF-S Nikkor 400mm f/2.8D IF-ED II',
          '6F 3C A0 A0 30 30 75 02' => 'AF-S Nikkor 500mm f/4D IF-ED II',
          '70 3C A6 A6 30 30 76 02' => 'AF-S Nikkor 600mm f/4D IF-ED II',
          '72 48 4C 4C 24 24 77 00' => 'Nikkor 45mm f/2.8 P',
          '74 40 37 62 2C 34 78 06' => 'AF-S Zoom-Nikkor 24-85mm f/3.5-4.5G IF-ED',
          '75 40 3C 68 2C 3C 79 06' => 'AF Zoom-Nikkor 28-100mm f/3.5-5.6G',
          '76 58 50 50 14 14 7A 02' => 'AF Nikkor 50mm f/1.8D',
          '77 48 5C 80 24 24 7B 0E' => 'AF-S VR Zoom-Nikkor 70-200mm f/2.8G IF-ED',
          '78 40 37 6E 2C 3C 7C 0E' => 'AF-S VR Zoom-Nikkor 24-120mm f/3.5-5.6G IF-ED',
          '79 40 3C 80 2C 3C 7F 06' => 'AF Zoom-Nikkor 28-200mm f/3.5-5.6G IF-ED',
          '7A 3C 1F 37 30 30 7E 06' => Array(
                                        'AF-S DX Zoom-Nikkor 12-24mm f/4G IF-ED',
                                        'Tokina AT-X 124 AF PRO DX II (AF 12-24mm f/4)',
                                       ),
          '7B 48 80 98 30 30 80 0E' => 'AF-S VR Zoom-Nikkor 200-400mm f/4G IF-ED',
          '7D 48 2B 53 24 24 82 06' => 'AF-S DX Zoom-Nikkor 17-55mm f/2.8G IF-ED',
          '7F 40 2D 5C 2C 34 84 06' => 'AF-S DX Zoom-Nikkor 18-70mm f/3.5-4.5G IF-ED',
          '80 48 1A 1A 24 24 85 06' => 'AF DX Fisheye-Nikkor 10.5mm f/2.8G ED',
          '81 54 80 80 18 18 86 0E' => 'AF-S VR Nikkor 200mm f/2G IF-ED',
          '82 48 8E 8E 24 24 87 0E' => 'AF-S VR Nikkor 300mm f/2.8G IF-ED',
          '89 3C 53 80 30 3C 8B 06' => 'AF-S DX Zoom-Nikkor 55-200mm f/4-5.6G ED',
          '8A 54 6A 6A 24 24 8C 0E' => 'AF-S VR Micro-Nikkor 105mm f/2.8G IF-ED',
          '8B 40 2D 80 2C 3C 8D 0E' => 'AF-S DX VR Zoom-Nikkor 18-200mm f/3.5-5.6G IF-ED',
          '8B 40 2D 80 2C 3C FD 0E' => 'AF-S DX VR Zoom-Nikkor 18-200mm f/3.5-5.6G IF-ED (II)',
          '8C 40 2D 53 2C 3C 8E 06' => 'AF-S DX Zoom-Nikkor 18-55mm f/3.5-5.6G ED',
          '8D 44 5C 8E 34 3C 8F 0E' => 'AF-S VR Zoom-Nikkor 70-300mm f/4.5-5.6G IF-ED',
          '8F 40 2D 72 2C 3C 91 06' => 'AF-S DX Zoom-Nikkor 18-135mm f/3.5-5.6G IF-ED',
          '90 3B 53 80 30 3C 92 0E' => 'AF-S DX VR Zoom-Nikkor 55-200mm f/4-5.6G IF-ED',
          '92 48 24 37 24 24 94 06' => 'AF-S Zoom-Nikkor 14-24mm f/2.8G ED',
          '93 48 37 5C 24 24 95 06' => 'AF-S Zoom-Nikkor 24-70mm f/2.8G ED',
          '94 40 2D 53 2C 3C 96 06' => 'AF-S DX Zoom-Nikkor 18-55mm f/3.5-5.6G ED II',
          '95 4C 37 37 2C 2C 97 02' => 'PC-E Nikkor 24mm f/3.5D ED',
          '95 00 37 37 2C 2C 97 06' => 'PC-E Nikkor 24mm f/3.5D ED',
          '96 48 98 98 24 24 98 0E' => 'AF-S VR Nikkor 400mm f/2.8G ED',
          '97 3C A0 A0 30 30 99 0E' => 'AF-S VR Nikkor 500mm f/4G ED',
          '98 3C A6 A6 30 30 9A 0E' => 'AF-S VR Nikkor 600mm f/4G ED',
          '99 40 29 62 2C 3C 9B 0E' => 'AF-S DX VR Zoom-Nikkor 16-85mm f/3.5-5.6G ED',
          '9A 40 2D 53 2C 3C 9C 0E' => 'AF-S DX VR Zoom-Nikkor 18-55mm f/3.5-5.6G',
          '9B 54 4C 4C 24 24 9D 02' => 'PC-E Micro Nikkor 45mm f/2.8D ED',
          '9B 00 4C 4C 24 24 9D 06' => 'PC-E Micro Nikkor 45mm f/2.8D ED',
          '9C 54 56 56 24 24 9E 06' => 'AF-S Micro Nikkor 60mm f/2.8G ED',
          '9D 54 62 62 24 24 9F 02' => 'PC-E Micro Nikkor 85mm f/2.8D',
          '9D 00 62 62 24 24 9F 06' => 'PC-E Micro Nikkor 85mm f/2.8D',
          '9E 40 2D 6A 2C 3C A0 0E' => 'AF-S DX VR Zoom-Nikkor 18-105mm f/3.5-5.6G ED',
          '9F 58 44 44 14 14 A1 06' => 'AF-S DX Nikkor 35mm f/1.8G',
          'A0 54 50 50 0C 0C A2 06' => 'AF-S Nikkor 50mm f/1.4G',
          'A1 40 18 37 2C 34 A3 06' => 'AF-S DX Nikkor 10-24mm f/3.5-4.5G ED',
          'A2 48 5C 80 24 24 A4 0E' => 'AF-S Nikkor 70-200mm f/2.8G ED VR II',
          '01 00 00 00 00 00 02 00' => 'TC-16A',
          '01 00 00 00 00 00 08 00' => 'TC-16A',
          '00 00 00 00 00 00 F1 0C' => 'TC-14E [II] or Sigma APO Tele Converter 1.4x EX DG or Kenko Teleplus PRO 300 DG 1.4x',
          '00 00 00 00 00 00 F2 18' => 'TC-20E [II] or Sigma APO Tele Converter 2x EX DG or Kenko Teleplus PRO 300 DG 2.0x',
          '00 00 00 00 00 00 E1 12' => 'TC-17E II',
          'FE 47 00 00 24 24 4B 06' => 'Sigma 4.5mm F2.8 EX DC HSM Circular Fisheye',
          '26 48 11 11 30 30 1C 02' => 'Sigma 8mm F4 EX Circular Fisheye',
          '79 40 11 11 2C 2C 1C 06' => 'Sigma 8mm F3.5 EX Circular Fisheye',
          'DC 48 19 19 24 24 4B 06' => 'Sigma 10mm F2.8 EX DC HSM Fisheye',
          '02 3F 24 24 2C 2C 02 00' => 'Sigma 14mm F3.5',
          '48 48 24 24 24 24 4B 02' => 'Sigma 14mm F2.8 EX Aspherical HSM',
          '26 48 27 27 24 24 1C 02' => 'Sigma 15mm F2.8 EX Diagonal Fisheye',
          '26 58 31 31 14 14 1C 02' => 'Sigma 20mm F1.8 EX DG Aspherical RF',
          '26 58 37 37 14 14 1C 02' => 'Sigma 24mm F1.8 EX DG Aspherical Macro',
          'E1 58 37 37 14 14 1C 02' => 'Sigma 24mm F1.8 EX DG Aspherical Macro',
          '02 46 37 37 25 25 02 00' => 'Sigma 24mm F2.8 Super Wide II Macro',
          '26 58 3C 3C 14 14 1C 02' => 'Sigma 28mm F1.8 EX DG Aspherical Macro',
          '48 54 3E 3E 0C 0C 4B 06' => 'Sigma 30mm F1.4 EX DC HSM',
          'F8 54 3E 3E 0C 0C 4B 06' => 'Sigma 30mm F1.4 EX DC HSM',
          'DE 54 50 50 0C 0C 4B 06' => 'Sigma 50mm F1.4 EX DG HSM',
          '32 54 50 50 24 24 35 02' => 'Sigma Macro 50mm F2.8 EX DG',
          '79 48 5C 5C 24 24 1C 06' => 'Sigma Macro 70mm F2.8 EX DG',
          '02 48 65 65 24 24 02 00' => 'Sigma 90mm F2.8 Macro',
          'E5 54 6A 6A 24 24 35 02' => 'Sigma Macro 105mm F2.8 EX DG',
          '48 48 76 76 24 24 4B 06' => 'Sigma 150mm F2.8 EX DG APO Macro HSM',
          'F5 48 76 76 24 24 4B 06' => 'Sigma 150mm F2.8 EX DG APO Macro HSM',
          '48 4C 7C 7C 2C 2C 4B 02' => 'Sigma 180mm F3.5 EX DG Macro',
          '48 4C 7D 7D 2C 2C 4B 02' => 'Sigma APO Macro 180mm F3.5 EX DG HSM',
          '48 54 8E 8E 24 24 4B 02' => 'Sigma APO 300mm F2.8 EX DG HSM',
          'FB 54 8E 8E 24 24 4B 02' => 'Sigma APO 300mm F2.8 EX DG HSM',
          '26 48 8E 8E 30 30 1C 02' => 'Sigma APO Tele Macro 300mm F4',
          '02 2F 98 98 3D 3D 02 00' => 'Sigma 400mm F5.6 APO',
          '02 37 A0 A0 34 34 02 00' => 'Sigma APO 500mm F4.5',
          '48 44 A0 A0 34 34 4B 02' => 'Sigma APO 500mm F4.5 EX HSM',
          '48 3C B0 B0 3C 3C 4B 02' => 'Sigma APO 800mm F5.6 EX HSM',
          'A1 41 19 31 2C 2C 4B 06' => 'Sigma 10-20mm F3.5 EX DC HSM',
          '48 3C 19 31 30 3C 4B 06' => 'Sigma 10-20mm F4-5.6 EX DC HSM',
          'F9 3C 19 31 30 3C 4B 06' => 'Sigma 10-20mm F4-5.6 EX DC HSM',
          '48 38 1F 37 34 3C 4B 06' => 'Sigma 12-24mm F4.5-5.6 EX DG Aspherical HSM',
          'F0 38 1F 37 34 3C 4B 06' => 'Sigma 12-24mm F4.5-5.6 EX DG Aspherical HSM',
          '26 40 27 3F 2C 34 1C 02' => 'Sigma 15-30mm F3.5-4.5 EX DG Aspherical DF',
          '48 48 2B 44 24 30 4B 06' => 'Sigma 17-35mm F2.8-4 EX DG  Aspherical HSM',
          '26 54 2B 44 24 30 1C 02' => 'Sigma 17-35mm F2.8-4 EX Aspherical',
          '7A 47 2B 5C 24 34 4B 06' => 'Sigma 17-70mm F2.8-4.5 DC Macro Asp. IF HSM',
          '7A 48 2B 5C 24 34 4B 06' => 'Sigma 17-70mm F2.8-4.5 DC Macro Asp. IF HSM',
          '7F 48 2B 5C 24 34 1C 06' => 'Sigma 17-70mm F2.8-4.5 DC Macro Asp. IF',
          '26 40 2D 44 2B 34 1C 02' => 'Sigma 18-35 F3.5-4.5 Aspherical',
          '26 48 2D 50 24 24 1C 06' => 'Sigma 18-50mm F2.8 EX DC',
          '7F 48 2D 50 24 24 1C 06' => 'Sigma 18-50mm F2.8 EX DC Macro',
          '7A 48 2D 50 24 24 4B 06' => 'Sigma 18-50mm F2.8 EX DC Macro',
          '26 40 2D 50 2C 3C 1C 06' => 'Sigma 18-50mm F3.5-5.6 DC',
          '7A 40 2D 50 2C 3C 4B 06' => 'Sigma 18-50mm F3.5-5.6 DC HSM',
          '26 40 2D 70 2B 3C 1C 06' => 'Sigma 18-125mm F3.5-5.6 DC',
          'CD 3D 2D 70 2E 3C 4B 0E' => 'Sigma 18-125mm F3.8-5.6 DC OS HSM',
          '26 40 2D 80 2C 40 1C 06' => 'Sigma 18-200mm F3.5-6.3 DC',
          'ED 40 2D 80 2C 40 4B 0E' => 'Sigma 18-200mm F3.5-6.3 DC OS HSM',
          'A5 40 2D 88 2C 40 4B 0E' => 'Sigma 18-250mm F3.5-6.3 DC OS HSM',
          '26 48 31 49 24 24 1C 02' => 'Sigma 20-40mm F2.8',
          '26 48 37 56 24 24 1C 02' => 'Sigma 24-60mm F2.8 EX DG',
          'B6 48 37 56 24 24 1C 02' => 'Sigma 24-60mm F2.8 EX DG',
          'A6 48 37 5C 24 24 4B 06' => 'Sigma 24-70mm F2.8 IF EX DG HSM',
          '26 54 37 5C 24 24 1C 02' => 'Sigma 24-70mm F2.8 EX DG Macro',
          '67 54 37 5C 24 24 1C 02' => 'Sigma 24-70mm F2.8 EX DG Macro',
          'E9 54 37 5C 24 24 1C 02' => 'Sigma 24-70mm F2.8 EX DG Macro',
          '26 40 37 5C 2C 3C 1C 02' => 'Sigma 24-70mm F3.5-5.6 Aspherical HF',
          '26 54 37 73 24 34 1C 02' => 'Sigma 24-135mm F2.8-4.5',
          '02 46 3C 5C 25 25 02 00' => 'Sigma 28-70mm F2.8',
          '26 54 3C 5C 24 24 1C 02' => 'Sigma 28-70mm F2.8 EX',
          '26 48 3C 5C 24 24 1C 06' => 'Sigma 28-70mm F2.8 EX DG',
          '26 48 3C 5C 24 30 1C 02' => 'Sigma 28-70mm F2.8-4 DG',
          '02 3F 3C 5C 2D 35 02 00' => 'Sigma 28-70mm F3.5-4.5 UC',
          '26 40 3C 60 2C 3C 1C 02' => 'Sigma 28-80mm F3.5-5.6 Mini Zoom Macro II Aspherical',
          '26 40 3C 65 2C 3C 1C 02' => 'Sigma 28-90mm F3.5-5.6 Macro',
          '26 48 3C 6A 24 30 1C 02' => 'Sigma 28-105mm F2.8-4 Aspherical',
          '26 3E 3C 6A 2E 3C 1C 02' => 'Sigma 28-105mm F3.8-5.6 UC-III Aspherical IF',
          '26 40 3C 80 2C 3C 1C 02' => 'Sigma 28-200mm F3.5-5.6 Compact Aspherical Hyperzoom Macro',
          '26 40 3C 80 2B 3C 1C 02' => 'Sigma 28-200mm F3.5-5.6 Compact Aspherical Hyperzoom Macro',
          '26 3D 3C 80 2F 3D 1C 02' => 'Sigma 28-300mm F3.8-5.6 Aspherical',
          '26 41 3C 8E 2C 40 1C 02' => 'Sigma 28-300mm F3.5-6.3 DG Macro',
          '26 40 3C 8E 2C 40 1C 02' => 'Sigma 28-300mm F3.5-6.3 Macro',
          '02 3B 44 61 30 3D 02 00' => 'Sigma 35-80mm F4-5.6',
          '02 40 44 73 2B 36 02 00' => 'Sigma 35-135mm F3.5-4.5 a',
          '7A 47 50 76 24 24 4B 06' => 'Sigma 50-150mm F2.8 EX APO DC HSM',
          'FD 47 50 76 24 24 4B 06' => 'Sigma 50-150mm F2.8 EX APO DC HSM II',
          '48 3C 50 A0 30 40 4B 02' => 'Sigma 50-500mm F4-6.3 EX APO RF HSM',
          '26 3C 54 80 30 3C 1C 06' => 'Sigma 55-200mm F4-5.6 DC',
          '7A 3B 53 80 30 3C 4B 06' => 'Sigma 55-200mm F4-5.6 DC HSM',
          '48 54 5C 80 24 24 4B 02' => 'Sigma 70-200mm F2.8 EX APO IF HSM',
          '7A 48 5C 80 24 24 4B 06' => 'Sigma 70-200mm F2.8 EX APO DG Macro HSM II',
          'EE 48 5C 80 24 24 4B 06' => 'Sigma 70-200mm F2.8 EX APO DG Macro HSM II',
          '02 46 5C 82 25 25 02 00' => 'Sigma 70-210mm F2.8 APO',
          '26 3C 5C 82 30 3C 1C 02' => 'Sigma 70-210mm F4-5.6 UC-II',
          '26 3C 5C 8E 30 3C 1C 02' => 'Sigma 70-300mm F4-5.6 DG Macro',
          '56 3C 5C 8E 30 3C 1C 02' => 'Sigma 70-300mm F4-5.6 APO Macro Super II',
          'E0 3C 5C 8E 30 3C 4B 06' => 'Sigma 70-300mm F4-5.6 APO DG Macro HSM',
          '02 37 5E 8E 35 3D 02 00' => 'Sigma 75-300mm F4.5-5.6 APO',
          '02 3A 5E 8E 32 3D 02 00' => 'Sigma 75-300mm F4.0-5.6',
          '77 44 61 98 34 3C 7B 0E' => 'Sigma 80-400mm F4.5-5.6 EX OS',
          '48 48 68 8E 30 30 4B 02' => 'Sigma 100-300mm F4 EX IF HSM',
          '48 54 6F 8E 24 24 4B 02' => 'Sigma APO 120-300mm F2.8 EX DG HSM',
          '7A 54 6E 8E 24 24 4B 02' => 'Sigma APO 120-300mm F2.8 EX DG HSM',
          'CF 38 6E 98 34 3C 4B 0E' => 'Sigma APO 120-400mm F4.5-5.6 DG OS HSM',
          '26 44 73 98 34 3C 1C 02' => 'Sigma 135-400mm F4.5-5.6 APO Aspherical',
          'CE 34 76 A0 38 40 4B 0E' => 'Sigma 150-500mm F5-6.3 DG OS APO HSM',
          '26 40 7B A0 34 40 1C 02' => 'Sigma APO 170-500mm F5-6.3 Aspherical RF',
          '48 3C 8E B0 3C 3C 4B 02' => 'Sigma APO 300-800 F5.6 EX DG HSM',
          'F4 54 56 56 18 18 84 06' => 'Tamron SP AF 60mm f/2.0 Di II Macro 1:1 (G005)',
          '1E 5D 64 64 20 20 13 00' => 'Tamron SP AF 90mm f/2.5 (52E)',
          '32 53 64 64 24 24 35 02' => 'Tamron SP AF 90mm f/2.8 Di Macro 1:1 (272E)',
          'F8 55 64 64 24 24 84 06' => 'Tamron SP AF 90mm f/2.8 Di Macro 1:1 (272NII)',
          '00 4C 7C 7C 2C 2C 00 02' => 'Tamron SP AF 180mm f/3.5 Di Model (B01)',
          'F6 3F 18 37 2C 34 84 06' => 'Tamron SP AF 10-24mm f/3.5-4.5 Di II LD Aspherical (IF) (B001)',
          '00 36 1C 2D 34 3C 00 06' => 'Tamron SP AF 11-18mm f/4.5-5.6 Di II LD Aspherical (IF) (A13)',
          '07 46 2B 44 24 30 03 02' => 'Tamron SP AF 17-35mm f/2.8-4 Di LD Aspherical (IF) (A05)',
          '00 53 2B 50 24 24 00 06' => 'Tamron SP AF 17-50mm f/2.8 XR Di II LD Aspherical (IF) (A16)',
          '00 54 2B 50 24 24 00 06' => 'Tamron SP AF 17-50mm f/2.8 XR Di II LD Aspherical (IF) (A16NII)',
          'F3 54 2B 50 24 24 84 0E' => 'Tamron SP AF 17-50mm F/2.8 XR Di II VC LD Aspherical (IF) (B005)',
          '00 3F 2D 80 2B 40 00 06' => 'Tamron AF 18-200mm f/3.5-6.3 XR Di II LD Aspherical (IF) (A14)',
          '00 3F 2D 80 2C 40 00 06' => 'Tamron AF 18-200mm f/3.5-6.3 XR Di II LD Aspherical (IF) Macro (A14)',
          '00 40 2D 80 2C 40 00 06' => 'Tamron AF 18-200mm f/3.5-6.3 XR Di II LD Aspherical (IF) Macro (A14NII)',
          '00 40 2D 88 2C 40 62 06' => 'Tamron AF 18-250mm f/3.5-6.3 Di II LD Aspherical (IF) Macro (A18)',
          '00 40 2D 88 2C 40 00 06' => 'Tamron AF 18-250mm f/3.5-6.3 Di II LD Aspherical (IF) Macro (A18NII)',
          'F5 40 2C 8A 2C 40 40 0E' => 'Tamron AF 18-270mm f/3.5-6.3 Di II VC LD Aspherical (IF) Macro (B003)',
          '07 40 2F 44 2C 34 03 02' => 'Tamron AF 19-35mm f/3.5-4.5 (A10)',
          '07 40 30 45 2D 35 03 02' => 'Tamron AF 19-35mm f/3.5-4.5 (A10)',
          '00 49 30 48 22 2B 00 02' => 'Tamron SP AF 20-40mm f/2.7-3.5 (166D)',
          '0E 4A 31 48 23 2D 0E 02' => 'Tamron SP AF 20-40mm f/2.7-3.5 (166D)',
          '45 41 37 72 2C 3C 48 02' => 'Tamron SP AF 24-135mm f/3.5-5.6 AD Aspherical (IF) Macro (190D)',
          '33 54 3C 5E 24 24 62 02' => 'Tamron SP AF 28-75mm f/2.8 XR Di LD Aspherical (IF) Macro (A09)',
          'FA 54 3C 5E 24 24 84 06' => 'Tamron SP AF 28-75mm f/2.8 XR Di LD Aspherical (IF) Macro (A09NII)',
          '10 3D 3C 60 2C 3C D2 02' => 'Tamron AF 28-80mm f/3.5-5.6 Aspherical (177D)',
          '45 3D 3C 60 2C 3C 48 02' => 'Tamron AF 28-80mm f/3.5-5.6 Aspherical (177D)',
          '00 48 3C 6A 24 24 00 02' => 'Tamron SP AF 28-105mm f/2.8 LD Aspherical IF (176D)',
          '0B 3E 3D 7F 2F 3D 0E 00' => 'Tamron AF 28-200mm f/3.8-5.6 (71D)',
          '0B 3E 3D 7F 2F 3D 0E 02' => 'Tamron AF 28-200mm f/3.8-5.6D (171D)',
          '12 3D 3C 80 2E 3C DF 02' => 'Tamron AF 28-200mm f/3.8-5.6 AF Aspherical LD (IF) (271D)',
          '4D 41 3C 8E 2B 40 62 02' => 'Tamron AF 28-300mm f/3.5-6.3 XR Di LD Aspherical (IF) (A061)',
          '4D 41 3C 8E 2C 40 62 02' => 'Tamron AF 28-300mm f/3.5-6.3 XR LD Aspherical (IF) (185D)',
          'F9 40 3C 8E 2C 40 40 0E' => 'Tamron AF 28-300mm f/3.5-6.3 XR Di VC LD Aspherical (IF) Macro (A20)',
          '00 47 53 80 30 3C 00 06' => 'Tamron AF 55-200mm f/4-5.6 Di II LD (A15)',
          'F7 53 5C 80 24 24 84 06' => 'Tamron SP AF 70-200mm f/2.8 Di LD (IF) Macro (A001)',
          '69 48 5C 8E 30 3C 6F 02' => 'Tamron AF 70-300mm f/4-5.6 LD Macro 1:2 (772D)',
          '00 48 5C 8E 30 3C 00 06' => 'Tamron AF 70-300mm f/4-5.6 Di LD Macro 1:2 (A17)',
          '20 3C 80 98 3D 3D 1E 02' => 'Tamron AF 200-400mm f/5.6 LD IF (75D)',
          '00 3E 80 A0 38 3F 00 02' => 'Tamron SP AF 200-500mm f/5-6.3 Di LD (IF) (A08)',
          '00 3F 80 A0 38 3F 00 02' => 'Tamron SP AF 200-500mm f/5-6.3 Di (A08)',
          '00 40 2B 2B 2C 2C 00 02' => 'Tokina AT-X 17 AF PRO (AF 17mm f/3.5)',
          '00 47 44 44 24 24 00 06' => 'Tokina AT-X M35 PRO DX (AF 35mm f/2.8 Macro)',
          '00 54 68 68 24 24 00 02' => 'Tokina AT-X M100 PRO D (AF 100mm f/2.8 Macro)',
          '00 54 8E 8E 24 24 00 02' => 'Tokina AT-X 300 AF PRO (AF 300mm f/2.8)',
          '00 40 18 2B 2C 34 00 06' => 'Tokina AT-X 107 DX Fisheye (AF 10-17mm f/3.5-4.5)',
          '00 48 1C 29 24 24 00 06' => 'Tokina AT-X 116 PRO DX (AF 11-16mm f/2.8)',
          '00 3C 1F 37 30 30 00 06' => 'Tokina AT-X 124 AF PRO DX (AF 12-24mm f/4)',
          '00 48 29 50 24 24 00 06' => 'Tokina AT-X 165 PRO DX (AF 16-50mm f/2.8)',
          '00 40 2A 72 2C 3C 00 06' => 'Tokina AT-X 16.5-135 DX (AF 16.5-135mm F3.5-5.6)',
          '2F 40 30 44 2C 34 29 02' => 'Tokina AF 235 II (AF 20-35mm f/3.5-4.5)',
          '25 48 3C 5C 24 24 1B 02' => 'Tokina AT-X 270 AF PRO II (AF 28-70mm f/2.6-2.8)',
          '07 48 3C 5C 24 24 03 00' => 'Tokina AT-X 287 AF (AF 28-70mm f/2.8)',
          '07 47 3C 5C 25 35 03 00' => 'Tokina AF 287 SD (AF 28-70mm f/2.8-4.5)',
          '00 48 3C 60 24 24 00 02' => 'Tokina AT-X 280 AF PRO (AF 28-80mm f/2.8)',
          '00 48 50 72 24 24 00 06' => 'Tokina AT-X 535 PRO DX (AF 50-135mm f/2.8)',
          '14 54 60 80 24 24 0B 00' => 'Tokina AT-X 828 AF PRO (AF 80-200mm f/2.8)',
          '24 44 60 98 34 3C 1A 02' => 'Tokina AT-X 840 AF-II (AF 80-400mm f/4.5-5.6)',
          '00 44 60 98 34 3C 00 02' => 'Tokina AT-X 840 AF D (AF 80-400mm f/4.5-5.6)',
          '14 48 68 8E 30 30 0B 00' => 'Tokina AT-X 340 AF (AF 100-300mm f/4)',
          '06 3F 68 68 2C 2C 06 00' => 'Cosina AF 100mm F3.5 Macro',
          '07 36 3D 5F 2C 3C 03 00' => 'Cosina AF Zoom 28-80mm F3.5-5.6 MC Macro',
          '07 46 3D 6A 25 2F 03 00' => 'Cosina AF Zoom 28-105mm F2.8-3.8 MC',
          '12 36 5C 81 35 3D 09 00' => 'Cosina AF Zoom 70-210mm F4.5-5.6 MC Macro',
          '12 39 5C 8E 34 3D 08 02' => 'Cosina AF Zoom 70-300mm F4.5-5.6 MC Macro',
          '12 3B 68 8D 3D 43 09 02' => 'Cosina AF Zoom 100-300mm F5.6-6.7 MC Macro',
          '00 40 31 31 2C 2C 00 00' => 'Voigtlander Color Skopar 20mm F3.5 SLII Aspherical',
          '00 54 48 48 18 18 00 00' => 'Voigtlander Ultron 40mm F2 SLII Aspherical',
          '00 54 55 55 0C 0C 00 00' => 'Voigtlander Nokton 58mm F1.4 SLII',
          '00 54 56 56 30 30 00 00' => 'Coastal Optical Systems 60mm 1:4 UV-VIS-IR Macro Apo',
          '02 40 44 5C 2C 34 02 00' => 'Exakta AF 35-70mm 1:3.5-4.5 MC',
          '07 3E 30 43 2D 35 03 00' => 'Soligor AF Zoom 19-35mm 1:3.5-4.5 MC',
          '03 43 5C 81 35 35 02 00' => 'Soligor AF C/D Zoom UMCS 70-210mm 1:4.5',
          '12 4A 5C 81 31 3D 09 00' => 'Soligor AF C/D Auto Zoom+Macro 70-210mm 1:4-5.6 UMCS',
          '00 00 00 00 00 00 00 01' => 'Manual Lens No CPU',
          '00 47 10 10 24 24 00 00' => 'Fisheye Nikkor 8mm f/2.8 AiS',
          '00 54 44 44 0C 0C 00 00' => 'Nikkor 35mm f/1.4 AiS',
          '00 48 50 50 18 18 00 00' => 'Nikkor H 50mm f/2',
          '00 48 68 68 24 24 00 00' => 'Series E 100mm f/2.8',
          '00 4C 6A 6A 20 20 00 00' => 'Nikkor 105mm f/2.5 AiS',
          '00 48 80 80 30 30 00 00' => 'Nikkor 200mm f/4 AiS',
        )
      ), // < LensData

      // RawImageCenter, tag 0x0099
      0x0099 => Array(
        'tagName'     => "RawImageCenter",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < RawImageCenter

      // SensorPixelSize, tag 0x009a
      0x009a => Array(
        'tagName'     => "SensorPixelSize",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < SensorPixelSize

      // SceneAssist, tag 0x009c
      0x009c => Array(
        'tagName'     => "SceneAssist",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < SceneAssist

      // RetouchHistory, tag 0x009e
      0x009e => Array(
        'tagName'     => "RetouchHistory",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < RetouchHistory

      // SerialNumber, tag 0x00a0
      0x00a0 => Array(
        'tagName'     => "SerialNumber2",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < SerialNumber

      // ImageDataSize, tag 0x00a2
      0x00a2 => Array(
        'tagName'     => "ImageDataSize",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // <

      // ImageCount, tag 0x00a5
      0x00a5 => Array(
        'tagName'     => "ImageCount",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ImageCount

      // DeletedImageCount, tag 0x00a6
      0x00a6 => Array(
        'tagName'     => "DeletedImageCount",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < DeletedImageCount

      // ShutterCount, tag 0x00a7
      0x00a7 => Array(
        'tagName'     => "ShutterCount",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < ShutterCount

      // FlashInfo, tag 0x00a8
      0x00a8 => Array(
        'tagName'     => "FlashInfo",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < FlashInfo

      // ImageOptimization, tag 0x00a9
      0x00a9 => Array(
        'tagName'     => "ImageOptimization",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < ImageOptimization

      // Saturation, tag 0x00aa
      0x00aa => Array(
        'tagName'     => "Saturation",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < Saturation

      // VariProgram, tag 0x00ab
      0x00ab => Array(
        'tagName'     => "VariProgram",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < VariProgram

      // ImageStabilization, tag 0x00ac
      0x00ac => Array(
        'tagName'     => "ImageStabilization",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ImageStabilization

      // AFResponse, tag 0x00ad
      0x00ad => Array(
        'tagName'     => "AFResponse",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < AFResponse

      // MultiExposure, tag 0x00b0
      0x00b0 => Array(
        'tagName'     => "MultiExposure",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < MultiExposure

      // HighISONoiseReduction, tag 0x00b1
      0x00b1 => Array(
        'tagName'     => "HighISONoiseReduction",
        'schema'      => "Nikon",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0 => "Off",
          1 => "Minimal",
          2 => "low",
          4 => "normal",
          6 => "high",
        )
      ), // < HighISONoiseReduction

      // ToningEffect, tag 0x00b3
      0x00b3 => Array(
        'tagName'     => "ToningEffect",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ToningEffect

      // PowerUpTime, tag 0x00b6
      0x00b6 => Array(
        'tagName'     => "PowerUpTime",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < PowerUpTime

      // AFInfo2, tag 0x00b7
      0x00b70 => Array(
        'tagName'     => "AFInfo2",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < AFInfo2

      // FileInfo, tag 0x00b8
      0x00b8 => Array(
        'tagName'     => "FileInfo",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < FileInfo

      // AFTune, tag 0x00b9
      0x00b9 => Array(
        'tagName'     => "AFTune",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < AFTune

      // PictureControl, tag 0x00bd
      0x00bd => Array(
        'tagName'     => "PictureControl",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < PictureControl

      // PrintIM, tag 0x0e00
      0x0e00 => Array(
        'tagName'     => "PrintIM",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // <

      // NikonCaptureData, tag 0x0e01
      0x0e01 => Array(
        'tagName'     => "NikonCaptureData",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < NikonCaptureData

      // NikonCaptureVersion, tag 0x0e09
      0x0e09 => Array(
        'tagName'     => "NikonCaptureVersion",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < NikonCaptureVersion

      // NikonCaptureOffsets, tag 0x0e0e
      0x0e0e => Array(
        'tagName'     => "NikonCaptureOffsets",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < NikonCaptureOffsets

      // NikonScanIFD, tag 0x0e10
      0x0e10 => Array(
        'tagName'     => "NikonScanIFD",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < NikonScanIFD

      // NikonICCProfile, tag 0x0e1d
      0x0e1d => Array(
        'tagName'     => "NikonICCProfile",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < NikonICCProfile

      // NikonCaptureOutput, tag 0x0e1e
      0x0e1e => Array(
        'tagName'     => "NikonCaptureOutput",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < NikonCaptureOutput

      // NEFBitDepth, tag 0x0e22
      0x0e22 => Array(
        'tagName'     => "NEFBitDepth",
        'schema'      => "Nikon",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < NEFBitDepth

    );

    function __destruct()
    {
      parent::__destruct();
    }
  } // NikonTags



?>
