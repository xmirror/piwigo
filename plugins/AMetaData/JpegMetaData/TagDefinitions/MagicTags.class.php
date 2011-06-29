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
 * The MagicTags is the definition of the computed JpegMetadata tags
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 * The MagicTags class is derived from the KnownTags class.
 *
 * ======> See KnownTags.class.php to know more about the tag definitions <=====
 *
 */

  require_once(JPEG_METADATA_DIR."TagDefinitions/KnownTags.class.php");

  /**
   * Define the "magic" JpegMetadata computed tags
   *
   * all tag are defined by a list of metadata
   *
   * all metadata are searched in the given list order by their name : if a
   * given metadata in is not found in the image, the next is searched.
   *
   * in most case, according with the Xmp specification, list are defined in
   * this order :
   *  - exif tags
   *  - iptc tags
   *  - xmp tags
   *
   * In some case, the Xmp metadata are in the first place of the list, because
   * Xmp allows to UTF-8 string and we can consider that if there is exif & xmp
   * data, the localized UTF-8 is most important
   *
   */
  class MagicTags extends KnownTags
  {
    protected $label = "Magic JpegMetadata computed tags";
    protected $tags = Array(

      'Camera.Make' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues'    => Array(
          "{exif.tiff.Make}",
          "{xmp.tiff:Make}",
        )
      ),

      'Camera.Model' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues'    => Array(
          "{exif.tiff.Model}",
          "{xmp.tiff:Model}",
        )
      ),

      'ShotInfo.Aperture' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues'    => Array(
          "{exif.exif.FNumber}",
          "{xmp.exif:FNumber}",
          "{exif.exif.ApertureValue}",
          "{xmp.exif:ApertureValue}",
        )
      ),

      'ShotInfo.Exposure' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues'    => Array(
          "{exif.exif.ExposureTime}",
          "{xmp.exif:ExposureTime}",
          "{exif.exif.ShutterSpeedValue}",
          "{xmp.exif:ShutterSpeedValue}",
        )
      ),

      'ShotInfo.ISO' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues'    => Array(
          "{exif.exif.ISOSpeedRatings}",
          "{xmp.exif:ISOSpeedRatings[values]}",
          "{exif.Pentax.ISO}",
        )
      ),

      'ShotInfo.FocalLength' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues'    => Array(
          "{exif.exif.FocalLength}",
          "{xmp.exif:FocalLength}",
          "{exif.Pentax.FocalLength}",
          "{exif.Canon.CanonCameraInfo.FocalLength}",
        )
      ),

      'ShotInfo.FocalLengthIn35mm' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues'    => Array(
          "{exif.exif.FocalLengthIn35mmFilm}",
          "{xmp.exif:FocalLengthIn35mmFilm}",
        )
      ),

      'ShotInfo.Lens' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues'    => Array(
          "{exif.Pentax.LensType}",
          "{exif.Nikon.LensData}",
          "{exif.Nikon.Lens}",
          "{exif.Canon.CanonCameraSettings.LensType}",
          "{exif.Canon.CanonCameraInfo.LensType}",
          "{xmp.aux:Lens}",
          "{xmp.aux:LensID}", // work with the Xmp LensId is not the best way to
                              // know the lens (all data needed to find the
                              // exact lens are not available in xmp metadata)
        )
      ),

      'ShotInfo.DateTime' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues'    => Array(
          "{exif.exif.DateTimeOriginal}",
          "{exif.exif.DateTimeDigitized}",
          "{xmp.exif:DateTimeOriginal}",
          "{xmp.exif:DateTimeDigitized}",
        )
      ),

      'ShotInfo.Flash.Fired' => Array(
        'implemented'  => true,
        'translatable' => true,
        'tagValues'    => Array(
          "{exif.exif.Flash[detail[0]]}",
          "{xmp.exif:Fired}",
        )
      ),

      'ShotInfo.Flash.RedEyeMode' => Array(
        'implemented'  => true,
        'translatable' => true,
        'tagValues'    => Array(
          "{exif.exif.Flash[detail[4]]}",
          "{xmp.exif:RedEyeMode}",
        )
      ),


      'Image.Width' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues'    => Array(
          "{exif.exif.PixelXDimension}",
          "{exif.tiff.ImageWidth}",
          "{xmp.exif:PixelXDimension}",
          "{xmp.tiff:ImageWidth}",
        )
      ),

      'Image.Height' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues'    => Array(
          "{exif.exif.PixelYDimension}",
          "{exif.tiff.ImageHeight}",
          "{xmp.exif:PixelYDimension}",
          "{xmp.tiff:ImageHeight}",
        )
      ),

      'Image.Dimension' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues' => Array(
          "{magic.Image.Width}x{magic.Image.Height}"
        )
      ),

      'Author.ImageTitle' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues' => Array(
          "{xmp.dc:title}",
          "{exif.tiff.ImageDescription}",
          "{iptc.Object Name}",
        )
      ),

      'Author.Artist' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues' => Array(
          "{xmp.dc:creator[values]}",
          "{exif.tiff.Artist}",
          "{iptc.Writer/Editor[values]}",
        )
      ),

      'Author.Copyright' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues' => Array(
          "{xmp.dc:rights}",
          "{exif.tiff.Copyright}",
          "{iptc.Copyright Notice}"
        )
      ),

      'Author.Comment' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues' => Array(
          "{xmp.dc:description}",
          "{iptc.Caption/Abstract}",
          "{exif.exif.UserComment}",
          "{com.comment}"
        )
      ),

      'Author.Keywords' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues' => Array(
          "{xmp.dc:subject[values]},{iptc.Keywords[values]},{xmp.digiKam:TagsList[values]},{xmp.lr:hierarchicalSubject[values]}"
        )
      ),

      'Processing.PostProcessingSoftware' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues' => Array(
          "{exif.tiff.ProcessingSoftware}",
          "{exif.tiff.Software}",
          "{xmp.tiff:Software}",
          "{xmp.xmp:CreatorTool}",
          "{iptc.Originating Program} {iptc.Program Version}",
        )
      ),

      'Processing.Software' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues' => Array(
          "{exif.tiff.Software}",
          "{xmp.tiff:Software}",
          "{xmp.dc:CreatorTool}",
          "{exif.Canon.CanonFirmwareVersion}",
        )
      ),

      'Processing.OriginalFileName' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues' => Array(
          "{exif.tiff.DocumentName}",
          "{xmp.crs:RawFileName}",
        )
      ),

      'Processing.PostProcessingDateTime' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues' => Array(
          "{exif.tiff.DateTime}",
          "{xmp.xmp:ModifyDate}",
        )
      ),

      'GPS.Altitude' => Array(
        'implemented'  => true,
        'translatable' => true,
        'tagValues' => Array(
          "{exif.gps.GPSAltitudeRef}|{exif.gps.GPSAltitude}m",
          "{xmp.exif:GPSAltitudeRef}|{xmp.exif:GPSAltitude}m",
        )
      ),

      'GPS.Latitude' => Array(
        'implemented'  => true,
        'translatable' => true,
        'tagValues' => Array(
          "{exif.gps.GPSLatitude}| |{exif.gps.GPSLatitudeRef}",
          "{xmp.exif:GPSLatitude}",
        )
      ),

      'GPS.Longitude' => Array(
        'implemented'  => true,
        'translatable' => true,
        'tagValues' => Array(
          "{exif.gps.GPSLongitude}| |{exif.gps.GPSLongitudeRef}",
          "{xmp.exif:GPSLongitude}",
        )
      ),

      'GPS.Localization' => Array(
        'implemented'  => true,
        'translatable' => true,
        'tagValues' => Array(
          "{magic.GPS.Latitude}|, |{magic.GPS.Longitude}"
        )
      ),

      'GPS.LatitudeNum' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues' => Array(
          "{magic.GPS.Latitude}"
        )
      ),

      'GPS.LongitudeNum' => Array(
        'implemented'  => true,
        'translatable' => false,
        'tagValues' => Array(
          "{magic.GPS.Longitude}"
        )
      ),




    );


    function __destruct()
    {
      parent::__destruct();
    }

  }


?>
