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
 * The IfdTags is the definition of the Tiff & Exif tags
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 * The IfdTags class is derived from the KnownTags class.
 *
 * ======> See KnownTags.class.php to know more about the tag definitions <=====
 *
 */

  require_once(JPEG_METADATA_DIR."TagDefinitions/KnownTags.class.php");

  /**
   * Define the tags for EXIF
   */
  class IfdTags extends KnownTags
  {
    protected $label = "Exif & Tiff tags";
    protected $tags = Array(
      /*
       * tags with defined values
       */

      // ProcessingSoftware, tag 0x000b
      0x000b => Array(
        'tagName'     => "ProcessingSoftware",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < ProcessingSoftware

      // SubfileType, tag 0x00fe
      0x00fe => Array(
        'tagName'     => "SubfileType",
        'schema'      => "tiff",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x00 => "full-resolution image",
          0x01 => "reduced-resolution image",
          0x02 => "single page of multi-page image",
          0x03 => "single page of multi-page reduced-resolution image",
          0x04 => "transparency mask",
          0x05 => "transparency mask of reduced-resolution image",
          0x06 => "transparency mask of multi-page image",
          0x07 => "transparency mask of reduced-resolution multi-page image",
        )
      ), // < SubfileType

      // OldSubfileType, tag 0x00ff
      0x00ff => Array(
        'tagName'     => "OldSubfileType",
        'schema'      => "tiff",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x01 => "full-resolution image",
          0x02 => "reduced-resolution image",
          0x03 => "single page of multi-page image",
        )
      ), // < SubfileType

      // ImageWidth, tag 0x0100
      0x0100 => Array(
        'tagName'     => "ImageWidth",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < ImageWidth

      // ImageHeight, tag 0x0101
      0x0101 => Array(
        'tagName'     => "ImageLength",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < ImageLength

      // BitsPerSample, tag 0x0102
      0x0102 => Array(
        'tagName'     => "BitsPerSample",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < BitsPerSample

      // Compression, tag 0x0103
      0x0103 => Array(
        'tagName'     => "Compression",
        'schema'      => "tiff",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x0001 => "uncompressed",
          0x0002 => "CCITT 1D",
          0x0003 => "T4/Group 3 Fax",
          0x0004 => "T6/Group 4 Fax",
          0x0005 => "LZW",
          0x0006 => "JPEG (old style)",
          0x0007 => "JPEG",
          0x0008 => "Adobe Deflate",
          0x0009 => "JBIG B&W",
          0x0010 => "JBIG Color",
          0x0063 => "JPEG",
          0x0106 => "Kodak 262",
          0x7FFE => "Next",
          0x7FFF => "Sony ARW Compressed",
          0x8001 => "Epson ERF Compressed",
          0x8003 => "CCIRLEW",
          0x8005 => "PackBits",
          0x8029 => "Thunderscan",
          0x8063 => "Kodak KDC Compressed",
          0x807F => "IT8CTPAD",
          0x8080 => "IT8LW",
          0x8081 => "IT8MP",
          0x8082 => "IT8BL",
          0x808c => "PixarFilm",
          0x808D => "PixarLog",
          0x80B2 => "Deflate",
          0x80B3 => "DCS",
          0x8765 => "JBIG",
          0x8774 => "SGILog",
          0x8775 => "SGILog24",
          0x8798 => "JPEG 2000",
          0x8799 => "Nikon NEF Compressed",
          0x879E => "Microsoft Document Imaging (MDI) Binary Level Codec",
          0x879F => "Microsoft Document Imaging (MDI) Progressive Transform Codec",
          0x87A0 => "Microsoft Document Imaging (MDI) Vector",
          0xFDE8 => "Kodak DCR Compressed",
          0xFFFF => "Pentax PEF Compressed",
        )
      ), // < Compression

      // PhotometricInterpretation, tag 0x0106
      0x0106 => Array(
        'tagName'     => "PhotometricInterpretation",
        'schema'      => "tiff",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x0000 => "WhiteIsZero",
          0x0001 => "BlackIsZero",
          0x0002 => "RGB",
          0x0003 => "RGB Palette",
          0x0004 => "transparency mask",
          0x0005 => "CMYK",
          0x0006 => "YCbCr",
          0x0008 => "CIELab",
          0x0009 => "ICCLab",
          0x000A => "ITULab",
          0x8023 => "Color Filter Array",
          0x804C => "Pixar LogL",
          0x804D => "Pixar LogLuv",
          0x884C => "Linear Raw",
        )
      ), // < PhotometricInterpretation

      // Thresholding, tag 0x0107
      0x0107 => Array(
        'tagName'     => "Thresholding",
        'schema'      => "tiff",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x0001 => "no dithering or halftoning",
          0x0002 => "ordered dither or halftone",
          0x0003 => "randomized dither",
        )
      ), // < Thresholding

      // CellWidth, tag 0x0108
      0x0108 => Array(
        'tagName'     => "CellWidth",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < CellWidth

      // CellLength, tag 0x0109
      0x0109 => Array(
        'tagName'     => "CellLength",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < CellLength

      // FillOrder, tag 0x010A
      0x010A => Array(
        'tagName'     => "FillOrder",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x0001 => "normal",
          0x0002 => "reversed",
        )
      ), // < FillOrder

      // DocumentName, tag 0x010D
      0x010d => Array(
        'tagName'     => "DocumentName",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < DocumentName

      // ImageDescription, tag 0x010E
      0x010E => Array(
        'tagName'     => "ImageDescription",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < ImageDescription

      // Make, tag 0x010F
      0x010F => Array(
        'tagName'     => "Make",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < Make

      // Model, tag 0x0110
      0x0110 => Array(
        'tagName'     => "Model",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < Model

      // StripOffsets, tag 0x0111
      0x0111 => Array(
        'tagName'     => "StripOffsets",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < StripOffsets

      // Orientation, tag 0x0112, see EXIF2.2 documentation
      0x0112 => Array(
        'tagName'     => "Orientation",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x0001 => "horizontal (normal)",
          0x0002 => "mirror horizontal",
          0x0003 => "rotate 180",
          0x0004 => "mirror vertical",
          0x0005 => "mirror horizontal and rotate 270 CW",
          0x0006 => "rotate 90 CW",
          0x0007 => "mirror horizontal and rotate 90 CW",
          0x0008 => "rotate 270 CW"
        )
      ), // < Orientation

      // SamplesPerPixel, tag 0x0115
      0x0115 => Array(
        'tagName'     => "SamplesPerPixel",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < SamplesPerPixel

      // RowsPerStrip, tag 0x0116
      0x0116 => Array(
        'tagName'     => "RowsPerStrip",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < RowsPerStrip

      // StripByteCounts, tag 0x0117
      0x0117 => Array(
        'tagName'     => "StripByteCounts",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < StripByteCounts

      // MinSampleValue, tag 0x0118
      0x0118 => Array(
        'tagName'     => "MinSampleValue",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < MinSampleValue

      // MaxSampleValue, tag 0x0119
      0x0119 => Array(
        'tagName'     => "MaxSampleValue",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < MaxSampleValue

      // XResolution, tag 0x011A
      0x011A => Array(
        'tagName'     => "XResolution",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < XResolution

      // YResolution, tag 0x011B
      0x011B => Array(
        'tagName'     => "YResolution",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < YResolution

      // PlanarConfiguration, tag 0x011C
      0x011C => Array(
        'tagName'     => "PlanarConfiguration",
        'schema'      => "tiff",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x01 => "chunky",
          0x02 => "planar"
        )
      ), // < PlanarConfiguration

      // PageName, tag 0x011D
      0x011D => Array(
        'tagName'     => "PageName",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < PageName

      // XPosition, tag 0x011E
      0x011E => Array(
        'tagName'     => "XPosition",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < XPosition


      // YPosition, tag 0x011F
      0x011F => Array(
        'tagName'     => "YPosition",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < YPosition


      // FreeOffsets, tag 0x0120
      0x0120 => Array(
        'tagName'     => "FreeOffsets",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < FreeOffsets

      // FreeByteCounts, tag 0x0121
      0x0121 => Array(
        'tagName'     => "FreeByteCounts",
        'schema'      => "Unknown",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < FreeByteCounts

      // GrayResponseUnit, tag 0x0122
      0x0122 => Array(
        'tagName'     => "GrayResponseUnit",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x01 => 0.1,
          0x02 => 0.001,
          0x03 => 0.0001,
          0x04 => 0.00001,
          0x05 => 0.000001
        )
      ), // < GrayResponseUnit

      // GrayResponseCurve, tag 0x0123
      0x0123 => Array(
        'tagName'     => "GrayResponseCurve",
        'schema'      => "Unknown",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < GrayResponseCurve

      // T4Options, tag 0x0124
      0x0124 => Array(
        'tagName'     => "T4Options",
        'schema'      => "Unknown",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < T4Options


      // T6Options, tag 0x0125
      0x0125 => Array(
        'tagName'     => "T6Options",
        'schema'      => "Unknown",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < T6Options


      // ResolutionUnit, tag 0x0128
      0x0128 => Array(
        'tagName'     => "ResolutionUnit",
        'schema'      => "tiff",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x01 => "none",
          0x02 => "inches",
          0x03 => "centimeters"
        )
      ), // < ResolutionUnit

      // PageNumber, tag 0x0129
      0x0129 => Array(
        'tagName'     => "PageNumber",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < PageNumber

      // ColorResponseUnit, tag 0x012c
      0x012c => Array(
        'tagName'     => "ColorResponseUnit",
        'schema'      => "Unknown",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < ColorResponseUnit

      // TransferFunction, tag 0x012D
      0x012D => Array(
        'tagName'     => "TransferFunction",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < TransferFunction


      // Software, tag 0x0131
      0x0131 => Array(
        'tagName'     => "Software",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < DateTime

      // DateTime, tag 0x0132
      0x0132 => Array(
        'tagName'     => "DateTime",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < DateTime

      // Artist, tag 0x013B
      0x013B => Array(
        'tagName'     => "Artist",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < Artist

      // HostComputer, tag 0x013C
      0x013C => Array(
        'tagName'     => "HostComputer",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < HostComputer


      // Predictor, tag 0x013D
      0x013D => Array(
        'tagName'     => "Predictor",
        'schema'      => "tiff",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x01 => "none",
          0x02 => "horizontal differencing"
        )
      ), // < Predictor


      // WhitePoint, tag 0x013E
      0x013E => Array(
        'tagName'     => "WhitePoint",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < WhitePoint

      // PrimaryChromaticities, tag 0x013F
      0x013F => Array(
        'tagName'     => "PrimaryChromaticities",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < PrimaryChromaticities


      // JPEGInterchangeFormat, tag 0x0201, see EXIF2.2 documentation to implement
      0x0201 => Array(
        'tagName'     => "JPEGInterchangeFormat",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < JPEGInterchangeFormat

      // JPEGInterchangeFormatLength, tag 0x0202, see EXIF2.2 documentation to implement
      0x0202 => Array(
        'tagName'     => "JPEGInterchangeFormatLength",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
      ), // < JPEGInterchangeFormatLength

      // YCbCrCoefficients, tag 0x0211, see EXIF2.2 documentation to implement
      0x0211 => Array(
        'tagName'     => "YCbCrCoefficients",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < YCbCrCoefficients

      // YCbCrSubSampling, tag 0x0212, see EXIF2.2 documentation to implement
      0x0212 => Array(
        'tagName'     => "YCbCrSubSampling",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.special' => Array(
          1 => Array(
                1 => "YCbCr4:4:4",
                2 => "YCbCr4:4:0",
                4 => "YCbCr4:4:1"
              ),
          2 => Array(
                1 => "YCbCr4:2:2",
                2 => "YCbCr4:2:0",
                4 => "YCbCr4:2:1",
              ),
          4 => Array(
                1 => "YCbCr4:1:1",
                2 => "YCbCr4:1:0"
              )
        )
      ), // < YCbCrSubSampling

      // YCbCrPositioning, tag 0x0213, see EXIF2.2 documentation to implement
      0x0213 => Array(
        'tagName'     => "YCbCrPositioning",
        'schema'      => "tiff",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x01 => "centered",
          0x02 => "co-sited"
        )
      ), // < YCbCrPositioning

      // ReferenceBlackWhite, tag 0x0214, see EXIF2.2 documentation to implement
      0x0214 => Array(
        'tagName'     => "ReferenceBlackWhite",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false,
      ), // < ReferenceBlackWhite

      // Rating, tag 0x4746
      0x4746 => Array(
        'tagName'     => "Rating",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < Rating

      // RatingPercent, tag 0x4749
      0x4749 => Array(
        'tagName'     => "RatingPercent",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < RatingPercent


      // Copyright, tag 0x8298
      0x8298 => Array(
        'tagName'     => "Copyright",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < Copyright

      // ExposureTime, tag 0x829A, exprimed in seconds
      0x829A => Array(
        'tagName'     => "ExposureTime",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < ExposureTime

      // FNumber, tag 0x829D, exprimed in seconds
      0x829D => Array(
        'tagName'     => "FNumber",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < FNumber

      // IPTC-NAA, tag 0x83BB
      0x83BB => Array(
        'tagName'     => "IPTC-NAA",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < IPTC-NAA

      // AFCP_IPTC, tag 0x8568
      0x8568 => Array(
        'tagName'     => "AFCP_IPTC",
        'schema'      => "Unknown",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < AFCP_IPTC

      // Exif IFD Pointer, tag 0x8769
      0x8769 => Array(
        'tagName'     => "Exif IFD Pointer",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false  // set to false even if the tag management is
                                // implemented, the IFD pointer can't be
                                // exploited as a classic metadata
      ), // < Exif IFD Pointer

      // ICC_Profile, tag 0x8773
      0x8773 => Array(
        'tagName'     => "ICC_Profile",
        'schema'      => "Unknown",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < ICC_Profile


      // ExposureProgram, tag 0x8822
      0x8822 => Array(
        'tagName'     => "ExposureProgram",
        'schema'      => "exif",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x00 => "not defined",
          0x01 => "Manual",
          0x02 => "normal program",
          0x03 => "Aperture Priority",
          0x04 => "shutter priority",
          0x05 => "creative program",
          0x06 => "action program",
          0x07 => "portrait mode",
          0x08 => "landscape mode"
        )
      ), // < ExposureProgram

      // SpectralSensitivity, tag 0x8824
      0x8824 => Array(
        'tagName'     => "SpectralSensitivity",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < SpectralSensitivity

      // GPS IFD Pointer, tag 0x8825
      0x8825 => Array(
        'tagName'     => "GPS IFD Pointer",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false  // set to false even if the tag management is
                                // implemented, the IFD pointer can't be
                                // exploited as a classic metadata
      ), // < GPS IFD Pointer

      // ISOSpeedRatings, tag 0x8827
      0x8827 => Array(
        'tagName'     => "ISOSpeedRatings",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < ISOSpeedRatings

      // OECF, tag 0x8828
      0x8828 => Array(
        'tagName'     => "OECF",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < OECF

      // TimeZoneOffset, tag 0x882A
      0x882A => Array(
        'tagName'     => "TimeZoneOffset",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < TimeZoneOffset

      // SelfTimerMode, tag 0x882B
      0x882A => Array(
        'tagName'     => "SelfTimerMode",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < SelfTimerMode

      // ExifVersion, tag 0x9000
      0x9000 => Array(
        'tagName'     => "ExifVersion",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < ExifVersion

      // DateTimeOriginal, tag 0x9003, "YYYY:MM:DD HH:MM:SS"
      0x9003 => Array(
        'tagName'     => "DateTimeOriginal",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < DateTimeOriginal

      // DateTimeDigitized, tag 0x9004, "YYYY:MM:DD HH:MM:SS"
      0x9004 => Array(
        'tagName'     => "DateTimeDigitized",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < DateTimeDigitized


      // ComponentsConfiguration, tag 0x9101
      0x9101 => Array(
        'tagName'     => "ComponentsConfiguration",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < ComponentsConfiguration

      // CompressedBitsPerPixel, tag 0x9102
      0x9102 => Array(
        'tagName'     => "CompressedBitsPerPixel",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < CompressedBitsPerPixel

      // ShutterSpeedValue, tag 0x9201
      0x9201 => Array(
        'tagName'     => "ShutterSpeedValue",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < ShutterSpeedValue

      // ApertureValue, tag 0x9202
      0x9202 => Array(
        'tagName'     => "ApertureValue",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < ApertureValue

      // BrightnessValue, tag 0x9203
      0x9203 => Array(
        'tagName'     => "BrightnessValue",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < BrightnessValue

      // ExposureBiasValue, tag 0x9204
      0x9204 => Array(
        'tagName'     => "ExposureBiasValue",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < ExposureBiasValue

      // MaxApertureValue, tag 0x9205
      0x9205 => Array(
        'tagName'     => "MaxApertureValue",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < MaxApertureValue

      // SubjectDistance, tag 0x9206
      0x9206 => Array(
        'tagName'     => "SubjectDistance",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < SubjectDistance

      // MeteringMode, tag 0x9207
      0x9207 => Array(
        'tagName'     => "MeteringMode",
        'schema'      => "exif",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x0000 => "Unknown",
          0x0001 => "average",
          0x0002 => "CenterWeightedAverage",
          0x0003 => "spot",
          0x0004 => "multispot",
          0x0005 => "pattern",
          0x0006 => "partial",
          0x00ff => "other"
        )
      ), // < MeteringMode

      // LightSource, tag 0x9208
      0x9208 => Array(
        'tagName'     => "LightSource",
        'schema'      => "exif",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x0000 => "Unknown",
          0x0001 => "Daylight",
          0x0002 => "Fluorescent",
          0x0003 => "tungsten (incandescent light)",
          0x0004 => "Flash",
          0x0009 => "fine weather",
          0x000a => "cloudy weather",
          0x000b => "Shade",
          0x000c => "daylight fluorescent (D 5700 - 7100K)",
          0x000d => "day white fluorescent (N 4600 - 5400K)",
          0x000e => "cool white fluorescent (W 3900 - 4500K)",
          0x000f => "white fluorescent (WW 3200 - 3700K)",
          0x0011 => "standard light A",
          0x0012 => "standard light B",
          0x0013 => "standard light C",
          0x0014 => "D55",
          0x0015 => "D65",
          0x0016 => "D75",
          0x0017 => "D50",
          0x0018 => "ISO studio tungsten",
          0x00ff => "other light source"
        )
      ), // < LightSource

      // flash, tag 0x9209, see EXIF 2.2 documentation
      0x9209 => Array(
        'tagName'     => "Flash",
        'schema'      => "exif",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues.specialNames'   => Array(
                  0x00 => "flash fired",
                  0x06 => "returned light",
                  0x18 => "flash mode",
                  0x20 => "flash function",
                  0x40 => "red-eye mode"
                ),
        'tagValues.specialValues' => Array(
          0x0001 => Array( // b00000001 => 'fired'
                  0x00 => "flash did not fire",
                  0x01 => "flash fired"
                ),
          0x0006 => Array( // b00000110 => 'return'
                  0x00 => "no strobe",                        // 00
                  0x01 => "reserved",                         // 01
                  0x02 => "strobe return light not detected", // 10
                  0x03 => "strobe return light detected"      // 11
                ),
          0x0018 => Array( // b00011000 => 'mode'
                  0x00 => "Unknown",
                  0x01 => "compulsory flash firing",
                  0x02 => "compulsory flash suppression",
                  0x03 => "auto mode"
                ),
          0x0020 => Array( // b00100000 => 'function'
                  0x00 => "flash function present",
                  0x01 => "no flash function"
                ),
          0x0040 => Array( // b01000000 => 'red-eye'
                  0x00 => "no red-eye reduction mode or unknown",
                  0x01 => "red-eye reduction supported"
                ),
        ),
        'tagValues.computed' => Array(
          0x0000 => "no flash",
          0x0001 => "fired",
          0x0005 => "fired, return not detected",
          0x0007 => "fired, return detected",
          0x0008 => "on, did not fire",
          0x0009 => "on, fired",
          0x000d => "on, return not detected",
          0x000f => "on, return detected",
          0x0010 => "off, did not fire",
          0x0014 => "off, did not fire, return not detected",
          0x0018 => "auto, did not fire",
          0x0019 => "auto, fired",
          0x001d => "auto, fired, return not detected",
          0x001f => "auto, fired, return detected",
          0x0020 => "no flash function",
          0x0030 => "off, no flash function",
          0x0041 => "fired, red-eye reduction",
          0x0045 => "fired, red-eye reduction, return not detected",
          0x0047 => "fired, red-eye reduction, return detected",
          0x0049 => "on, red-eye reduction",
          0x004d => "on, red-eye reduction, return not detected",
          0x004f => "on, red-eye reduction, return detected",
          0x0050 => "off, red-eye reduction",
          0x0058 => "auto, did not fire, red-eye reduction",
          0x0059 => "auto, fired, red-eye reduction",
          0x005d => "auto, fired, red-eye reduction, return not detected",
          0x005f => "auto, fired, red-eye reduction, return detected",
        ),
      ), // < flash

      // FocalLength, tag 0x920a
      0x920a => Array(
        'tagName'     => "FocalLength",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < FocalLength

      // ImageNumber, tag 0x9211
      0x9211 => Array(
        'tagName'     => "ImageNumber",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < ImageNumber

      // SecurityClassification, tag 0x9212
      0x9212 => Array(
        'tagName'     => "SecurityClassification",
        'schema'      => "exif",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          "C\x00" => "confidential",
          "R\x00" => "restricted",
          "S\x00" => "secret",
          "T\x00" => "top secret",
          "U\x00" => "unclassified",
        )
      ), // < SecurityClassification

      // ImageHistory, tag 0x9213
      0x9213 => Array(
        'tagName'     => "ImageHistory",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < SubjectArea

      // SubjectArea, tag 0x9214
      0x9214 => Array(
        'tagName'     => "SubjectArea",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < SubjectArea

      // TIFF-EPStandardID, tag 0x9216
      0x9216 => Array(
        'tagName'     => "TIFF-EPStandardID",
        'schema'      => "Unknown",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < TIFF-EPStandardID


      // MakerNote, tag 0x927c
      0x927c => Array(
        'tagName'     => "MakerNote",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false  // set to false even if the tag management is
                                // implemented, the IFD pointer can't be
                                // exploited as a classic metadata
      ), // < MakerNote

      // UserComment, tag 0x9286, see EXIF2.2 for documentation
      0x9286 => Array(
        'tagName'     => "UserComment",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < UserComment

      // SubsecTime, tag 0x9290, see EXIF2.2 for documentation
      0x9290 => Array(
        'tagName'     => "SubsecTime",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < SubsecTime

      // SubsecTimeOriginal, tag 0x9291, see EXIF2.2 for documentation
      0x9291 => Array(
        'tagName'     => "SubsecTimeOriginal",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < SubsecTimeOriginal

      // SubsecTimeDigitized, tag 0x9292, see EXIF2.2 for documentation
      0x9292 => Array(
        'tagName'     => "SubsecTimeDigitized",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < SubsecTimeDigitized


      // XPTitle, tag 0x9c9b
      0x9c9b => Array(
        'tagName'     => "XPTitle",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < XPTitle

      // XPComment, tag 0x9c9c
      0x9c9c => Array(
        'tagName'     => "XPComment",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < XPComment

      // XPAuthor, tag 0x9c9d
      0x9c9d => Array(
        'tagName'     => "XPAuthor",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < XPAuthor

      // XPKeywords, tag 0x9c9e
      0x9c9e => Array(
        'tagName'     => "XPKeywords",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < XPKeywords

      // XPSubject, tag 0x9c9
      0x9c9f => Array(
        'tagName'     => "XPSubject",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < XPSubject

      // FlashpixVersion, tag 0xA000
      0xA000 => Array(
        'tagName'     => "FlashpixVersion",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < FlashpixVersion

      // ColorSpace, tag 0xA001
      0xA001 => Array(
        'tagName'     => "ColorSpace",
        'schema'      => "exif",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x0001 => "sRGB",
          0x0002 => "Adobe RGB",
          0xFFFF => "Uncalibrated"
        )
      ), // < ColorSpace

      // PixelXDimension, tag 0xA002
      0xA002 => Array(
        'tagName'     => "PixelXDimension",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < PixelXDimension

      // PixelYDimension, tag 0xA003
      0xA003 => Array(
        'tagName'     => "PixelYDimension",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < PixelYDimension

      // RelatedSoundFile, tag 0xA004
      0xA004 => Array(
        'tagName'     => "RelatedSoundFile",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < RelatedSoundFile

      // Interoperability IFD Pointer, tag 0xA005
      0xA005 => Array(
        'tagName'     => "Interoperability IFD Pointer",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < Interoperability IFD Pointer

      // FlashEnergy, tag 0xA20B
      0xA20B => Array(
        'tagName'     => "FlashEnergy",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < FlashEnergy

      // SpatialFrequencyResponse, tag 0xA20C
      0xA20C => Array(
        'tagName'     => "SpatialFrequencyResponse",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < SpatialFrequencyResponse


      // Noise, tag 0xA20D
      0xA20D => Array(
        'tagName'     => "Noise",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < Noise

      // FocalPlaneXResolution, tag 0xA20E
      0xA20E => Array(
        'tagName'     => "FocalPlaneXResolution",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < FocalPlaneXResolution

      // FocalPlaneYResolution, tag 0xA20F
      0xA20F => Array(
        'tagName'     => "FocalPlaneYResolution",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < FocalPlaneXResolution

      // FocalPlaneResolutionUnit, tag 0xA210
      0xA210 => Array(
        'tagName'     => "FocalPlaneResolutionUnit",
        'schema'      => "exif",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x0001 => "none",
          0x0002 => "inches",
          0x0003 => "centimeters",
          0x0004 => "millimeters",
          0x0005 => "micrometers",
        )
      ), // < FocalPlaneResolutionUnit

      // SubjectLocation, tag 0xA214
      0xA214 => Array(
        'tagName'     => "SubjectLocation",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < SubjectLocation

      // ExposureIndex, tag 0xA215
      0xA215 => Array(
        'tagName'     => "ExposureIndex",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < ExposureIndex

      // SensingMethod, tag 0xA217
      0xA217 => Array(
        'tagName'     => "SensingMethod",
        'schema'      => "exif",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x01 => "not defined",
          0x02 => "one-chip color area sensor",
          0x03 => "two-chip color area sensor",
          0x04 => "three-chip color area sensor",
          0x05 => "color sequential area sensor",
          0x07 => "trilinear sensor",
          0x08 => "color sequential linear sensor",
        )
      ), // < SensingMethod

      // FileSource, tag 0xA300
      0xA300 => Array(
        'tagName'     => "FileSource",
        'schema'      => "exif",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x01 => "film scanner",
          0x02 => "reflection print scanner",
          0x03 => "DSC"
        )
      ), // < FileSource

      // SceneType, tag 0xA301
      0xA301 => Array(
        'tagName'     => "SceneType",
        'schema'      => "exif",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x01 => "a directly photographed image"
        )
      ), // < SceneType

      // CFAPattern, tag 0xA302
      0xA302 => Array(
        'tagName'     => "CFAPattern",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < CFAPattern

      // CustomRendered, tag 0xA401
      0xA401 => Array(
        'tagName'     => "CustomRendered",
        'schema'      => "exif",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x00 => "normal process",
          0x01 => "custom process"
        )
      ), // < CustomRendered

      // ExposureMode, tag 0xA402
      0xA402 => Array(
        'tagName'     => "ExposureMode",
        'schema'      => "exif",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x00 => "auto exposure",
          0x01 => "manual exposure",
          0x03 => "auto bracket"
        )
      ), // < ExposureMode

      // Balance, tag 0xA403
      0xA403 => Array(
        'tagName'     => "Balance",
        'schema'      => "exif",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x00 => "auto white balance",
          0x01 => "manual white balance"
        )
      ), // < Balance

      // DigitalZoomRatio, tag 0xA404
      0xA404 => Array(
        'tagName'     => "DigitalZoomRatio",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < DigitalZoomRatio


      // FocalLengthIn35mmFilm, tag 0xA405
      0xA405 => Array(
        'tagName'     => "FocalLengthIn35mmFilm",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => true
      ), // < FocalLengthIn35mmFilm

      // SceneCaptureType, tag 0xA406
      0xA406 => Array(
        'tagName'     => "SceneCaptureType",
        'schema'      => "exif",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x00 => "standard",
          0x01 => "Landscape",
          0x02 => "portrait",
          0x03 => "night scene"
        )
      ), // < SceneCaptureType

      // GainControl, tag 0xA407
      0xA407 => Array(
        'tagName'     => "GainControl",
        'schema'      => "exif",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x00 => "none",
          0x01 => "low gain up",
          0x02 => "high gain up",
          0x03 => "low gain down",
          0x04 => "high gain down"
        )
      ), // < GainControl

      // Contrast, tag 0xA408
      0xA408 => Array(
        'tagName'     => "Contrast",
        'schema'      => "exif",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x00 => "normal",
          0x01 => "low",
          0x02 => "high"
        )
      ), // < Contrast

      // Saturation, tag 0xA409
      0xA409 => Array(
        'tagName'     => "Saturation",
        'schema'      => "exif",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x00 => "normal",
          0x01 => "low",
          0x02 => "high"
        )
      ), // < Saturation

      // Sharpness, tag 0xA40A
      0xA40A => Array(
        'tagName'     => "Sharpness",
        'schema'      => "exif",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x00 => "normal",
          0x01 => "low",
          0x02 => "high"
        )
      ), // < Sharpness

      // DeviceSettingDescription, tag 0xA40B
      0xA40B => Array(
        'tagName'     => "DeviceSettingDescription",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < DeviceSettingDescription

      // SubjectDistanceRange, tag 0xA40C
      0xA40C => Array(
        'tagName'     => "SubjectDistanceRange",
        'schema'      => "exif",
        'translatable'=> true,
        'combiTag'    => 0,
        'implemented' => true,
        'tagValues'   => Array(
          0x00 => "Unknown",
          0x01 => "macro",
          0x02 => "close",
          0x03 => "distant"
        )
      ), // < SubjectDistanceRange

      // ImageUniqueID, tag 0xA420
      0xA420 => Array(
        'tagName'     => "ImageUniqueID",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < ImageUniqueID


      // Gamma, tag 0xA500
      0xA500 => Array(
        'tagName'     => "Gamma",
        'schema'      => "exif",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < Gamma

      // PrintIM, tag 0xC4A5
      0xC4A5 => Array(
        'tagName'     => "PrintIM",
        'schema'      => "tiff",
        'translatable'=> false,
        'combiTag'    => 0,
        'implemented' => false
      ), // < ImageUniqueID

    );

    function __destruct()
    {
      parent::__destruct();
    }
  }


?>
