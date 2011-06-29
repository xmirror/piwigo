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
 * The XmpTags is the definition of the XMP tags
 *
 * -----------------------------------------------------------------------------
 */

  require_once(JPEG_METADATA_DIR."TagDefinitions/KnownTags.class.php");
  require_once(JPEG_METADATA_DIR."TagDefinitions/IfdTags.class.php");
  require_once(JPEG_METADATA_DIR."TagDefinitions/GpsTags.class.php");
  require_once(JPEG_METADATA_DIR."TagDefinitions/IptcTags.class.php");

  /**
   * Define the tags for XMP metadata
   */
  class XmpTags extends KnownTags
  {
    /**
     * this function extract from an Xmp Alt structure, the value in the given
     * lang
     *
     * @param Array $tagValues :
     * @param String $lang : the needed lang
     * @return String : the value in the specified lang, or in the default lang
     *                  if there is no specific value for the specified lang
     */
    static public function getAltValue($tagValues, $lang="x-default")
    {
      /*
       * test if the $tagValues is valid, otherwise return the $tagValues as
       * result
       */
      if(!is_array($tagValues)) return($tagValues);
      if(!array_key_exists("type", $tagValues) or
         !array_key_exists("values", $tagValues) )
         return($tagValues);
      if($tagValues['type']!="alt") return($tagValues);

      $returned="";
      foreach($tagValues['values'] as $key => $val)
      {
        if($val['type']['value']==$lang or
           XmpTags::lang($val['type']['value'])==$lang)
        {
          return($val['value']);
        }

        if($val['type']['value']=="x-default")
        {
          $returned=$val['value'];
        }
      }
      return($returned);
    }

    /**
     * this function tries to format the lang Id
     * something like "fr-fr" is returned as "fr_FR"
     */
    static private function lang($lang)
    {
      $result=preg_match("/([a-z]*)([-|_])([a-z]*)/i", $lang, $arr);
      if(is_array($arr) and count($arr))
      {
        return($arr[1]."_".strtoupper($arr[3]));
      }
      else
      {
        return($lang);
      }
    }

    const TYPE_SIMPLE = 0x00;
    const TYPE_SEQ = 0x01;
    const TYPE_BAG = 0x02;
    const TYPE_ALT = 0x03;

    protected $label = "XMP tags";
    protected $tags = Array(
      'xmlns:x' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmlns",
      ),

      'x:xmptk' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "x",
      ),


      'xmlns:rdf' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmlns",
      ),


      'rdf:about' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "rdf",
      ),

      /*
       * Dublin Core schema
       */
      'xmlns:dc' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmlns",
      ),
      'dc:contributor' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_BAG,
        'schema'       => "dc",
      ),
      'dc:coverage' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "dc",
      ),
      'dc:creator' => Array(
        'iptcCreator'  => 0x0250,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SEQ,
        'schema'       => "dc",
      ),
      'dc:date' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SEQ,
        'schema'       => "dc",
      ),
      'dc:description' => Array(
        'iptcTag'      => 0x0278,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_ALT,
        'schema'       => "dc",
      ),
        'dc:format' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "dc",
      ),
      'dc:identifier' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "dc",
      ),
      'dc:language' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_BAG,
        'schema'       => "dc",
      ),
      'dc:publisher' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_BAG,
        'schema'       => "dc",
      ),
      'dc:relation' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_BAG,
        'schema'       => "dc",
      ),
      'dc:rights' => Array(
        'iptcTag'      => 0x0274,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_ALT,
        'schema'       => "dc",
      ),
      'dc:source' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "dc",
      ),
      'dc:subject' => Array(
        'iptcTag'      => 0x0219,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_BAG,
        'schema'       => "dc",
      ),
      'dc:title' => Array(
        'iptcTag'      => 0x0205,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_ALT,
        'schema'       => "dc",
      ),
      'dc:Type' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_BAG,
        'schema'       => "dc",
      ),

      // not present in specification, but found in some files
      'dc:CreatorTool' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "dc",
      ),



      /*
       * XMP Basic schema
       */
      'xmlns:xmp' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmlns",
      ),

      'xmp:Advisory' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_BAG,
        'schema'       => "xmp",
      ),
      'xmp:BaseURL' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmp",
      ),
      'xmp:CreateDate' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmp",
      ),
      'xmp:CreatorTool' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmp",
      ),
      'xmp:Identifier' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_BAG,
        'schema'       => "xmp",
      ),
      'xmp:Label' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmp",
      ),
      'xmp:MetadataDate' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmp",
      ),
      'xmp:ModifyDate' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmp",
      ),
      'xmp:Nickname' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmp",
      ),
      'xmp:Rating' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmp",
      ),
      'xmp:Thumbnails' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_ALT,
        'schema'       => "xmp",
      ),

      /*
       * XMP Rights Management schema
       */
      'xmlns:xmpRights' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmlns",
      ),

      'xmpRights:Certificate' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmpRights",
      ),
      'xmpRights:Marked' => Array(
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmpRights",
      ),
      'xmpRights:Owner' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_BAG,
        'schema'       => "xmpRights",
      ),
      'xmpRights:UsageTerms' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_ALT,
        'schema'       => "xmpRights",
      ),
      'xmpRights:WebStatement' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmpRights",
      ),


      /*
       * XMP Media Management schema
       */
      'xmlns:xmpMM' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmlns",
      ),

/*
 * The DerivedFrom is a ResourceRef structure
 * Not yet implemented
 */
      'xmpMM:DerivedFrom' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmpMM",
      ),

      'xmpMM:DocumentID' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmpMM",
      ),
/*
 * The History is a sequence of ResourceEvent structure
 * Not yet implemented
 */
      'xmpMM:History' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SEQ,
        'schema'       => "xmpMM",
      ),

      'xmpMM:InstanceID' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmpMM",
      ),

/*
 * The ManagedFrom is a ResourceRef structure
 * Not yet implemented
 */
      'xmpMM:ManagedFrom' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmpMM",
      ),
      'xmpMM:Manager' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmpMM",
      ),
      'xmpMM:ManageTo' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmpMM",
      ),
      'xmpMM:ManageUI' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmpMM",
      ),
      'xmpMM:ManagerVariant' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmpMM",
      ),
      'xmpMM:RenditionClass' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmpMM",
      ),
      'xmpMM:RenditionParams' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmpMM",
      ),
      'xmpMM:VersionID' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmpMM",
      ),
/*
 * The Versions is a sequence of Version structure
 * Not yet implemented
 */
      'xmpMM:Versions' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SEQ,
        'schema'       => "xmpMM",
      ),
      'xmpMM:LastURL' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmpMM",
      ),


      /*
       * XMP Basic Job Ticket schema
       */
      'xmlns:xmpBJ' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmlns",
      ),
      'xmpBJ:JobRef' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_BAG,
        'schema'       => "xmpBJ",
      ),


      /*
       * XMP Paged-Text schema
       *
       * No implementation for this tag, assuminf they're not needed for
       * photography
       */
      'xmlns:xmpTPg' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmlns",
      ),

      'xmpTPg:MaxPageSize' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmpTPg",
      ),
      'xmpTPg:NPages' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmpTPg",
      ),
      'xmpTPg:Fonts' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_BAG,
        'schema'       => "xmpTPg",
      ),
      'xmpTPg:Colorants' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SEQ,
        'schema'       => "xmpTPg",
      ),
      'xmpTPg:PlateNames' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SEQ,
        'schema'       => "xmpTPg",
      ),

      /*
       * XMP Dynamic Media schema
       * ==> seems to be dedicated for video's file, so don't try to implement
       *     it at now
       */
      'xmlns:xmpDM' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmlns",
      ),


      /*
       * Photoshop schema
       */
      'xmlns:photoshop' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmlns",
      ),

      'photoshop:AuthorsPosition' => Array(
        'iptcTag'      => 0x0255,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "photoshop",
      ),
      'photoshop:CaptionWriter' => Array(
        'iptcTag'      => 0x027A,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "photoshop",
      ),
      'photoshop:Category' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "photoshop",
      ),
      'photoshop:City' => Array(
        'iptcTag'      => 0x025A,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "photoshop",
      ),
      'photoshop:Country' => Array(
        'iptcTag'      => 0x0265,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "photoshop",
      ),
      'photoshop:Credit' => Array(
        'iptcTag'      => 0x026E,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "photoshop",
      ),
      'photoshop:DateCreated' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "photoshop",
      ),
      'photoshop:Headline' => Array(
        'iptcTag'      => 0x0269,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "photoshop",
      ),
      'photoshop:Instructions' => Array(
        'iptcTag'      => 0x228,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "photoshop",
      ),
      'photoshop:Source' => Array(
        'iptctag'      => 0x0273,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "photoshop",
      ),
      'photoshop:State' => Array(
        'iptcTag'      => 0x25F,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "photoshop",
      ),
      'photoshop:SupplementalCategories' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_BAG,
        'schema'       => "photoshop",
      ),
      'photoshop:TransmissionReference' => Array(
        'iptcTag'      => 0x267,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "photoshop",
      ),
      'photoshop:Urgency' => Array(
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "photoshop",
        'tagValues'    => Array(
           '0' => 'none',
           '1' => 'high+++',
           '2' => 'high++',
           '3' => 'high+',
           '4' => 'high',
           '5' => 'normal',
           '6' => 'low',
           '7' => 'low+',
           '8' => 'low++',
           '9' => 'none',
        ),
      ),
      // not present in specification but found in some files
      'photoshop:ICCProfile' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "photoshop",
      ),
      'photoshop:ColorMode' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "photoshop",
      ),


      /*
       * Camera Raw schema
       */
      'xmlns:crs' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmlns",
      ),
      'crs:AutoBrightness' => Array(
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:AutoContrast' => Array(
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:AutoExposure' => Array(
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:AutoShadows' => Array(
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:BlueHue' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:BlueSaturation' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:Brightness' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:CameraProfile' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:ChromaticAberrationB' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:ChromaticAberrationR' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:ColorNoiseReduction' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:Contrast' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:CropTop' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:CropLeft' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:CropBottom' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:CropRight' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:CropAngle' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:CropWidth' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:CropHeight' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:CropUnits' => Array(
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
        'tagValues'    => Array(
           '0' => "pixels",
           '1' => "inches",
           '2' => "centimeters",
        ),
      ),
      'crs:Exposure' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:GreenHue' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:GreenSaturation' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:HasCrop' => Array(
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:HasSettings' => Array(
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:LuminanceSmoothing' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:RawFileName' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:RedHue' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:RedSaturation' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:Saturation' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:Shadows' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:ShadowTint' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:Sharpness' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:Temperature' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:Tint' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:ToneCurve' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SEQ,
        'schema'       => "crs",
      ),
      'crs:ToneCurveName' => Array(
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
        'tagValues'    => Array(
           'Linear'          => "linear",
           'Medium Contrast' => "Medium Contrast",
           'Strong Contrast' => "Strong Contrast",
           'Custom'          => "Custom",
        ),      ),
      'crs:Version' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:VignetteAmount' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:VignetteMidpoint' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
      ),
      'crs:Balance' => Array(
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
        'tagValues'    => Array(
           'As Shot'     => "As Shot",
           'Auto'        => "Auto",
           'Daylight'    => "Daylight",
           'Cloudy'      => "Cloudy",
           'Shade'       => "Shade",
           'Tungsten'    => "Tungsten",
           'Fluorescent' => "Fluorescent",
           'Flash'       => "Flash",
           'Custom'      => "Custom",
        ),
      ),
      // not present in specifications, but found in some files
      'crs:WhiteBalance' => Array(
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "crs",
        'tagValues'    => Array(
           'As Shot'     => "As Shot",
           'Auto'        => "Auto",
           'Daylight'    => "Daylight",
           'Cloudy'      => "Cloudy",
           'Shade'       => "Shade",
           'Tungsten'    => "Tungsten",
           'Fluorescent' => "Fluorescent",
           'Flash'       => "Flash",
           'Custom'      => "Custom",
        ),
      ),



      /*
       * EXIF Schema for TIFF Properties
       *
       */
      'xmlns:tiff' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmlns",
      ),
      'tiff:ImageWidth' => Array(
        'exifTag'      => 0x0100,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "tiff",
      ),
      'tiff:ImageLength' => Array(
        'exifTag'      => 0x0101,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "tiff",
      ),
      'tiff:BitsPerSample' => Array(
        'exifTag'      => 0x0102,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SEQ,
        'schema'       => "tiff",
      ),
      'tiff:Compression' => Array(
        'exifTag'      => 0x0103,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "tiff",
      ),
      'tiff:PhotometricInterpretation' => Array(
        'exifTag'      => 0x0106,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "tiff",
      ),
      'tiff:Orientation' => Array(
        'exifTag'      => 0x0112,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "tiff",
      ),
      'tiff:SamplesPerPixel' => Array(
        'exifTag'      => 0x0115,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "tiff",
      ),
      'tiff:PlanarConfiguration' => Array(
        'exifTag'      => 0x011C,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "tiff",
      ),
      'tiff:YCbCrSubSampling' => Array(
        'exifTag'      => 0x0212,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SEQ,
        'schema'       => "tiff",
      ),
      'tiff:YCbCrPositioning' => Array(
        'exifTag'      => 0x0213,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "tiff",
      ),
      'tiff:XResolution' => Array(
        'exifTag'      => 0x011A,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "tiff",
      ),
      'tiff:YResolution' => Array(
        'exifTag'      => 0x011B,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "tiff",
      ),
      'tiff:ResolutionUnit' => Array(
        'exifTag'      => 0x0128,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "tiff",
      ),
      'tiff:TransferFunction' => Array(
        'exifTag'      => 0x012D,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SEQ,
        'schema'       => "tiff",
      ),
      'tiff:WhitePoint' => Array(
        'exifTag'      => 0x013E,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SEQ,
        'schema'       => "tiff",
      ),
      'tiff:PrimaryChromaticities' => Array(
        'exifTag'      => 0x013F,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SEQ,
        'schema'       => "tiff",
      ),
      'tiff:YCbCrCoefficients' => Array(
        'exifTag'      => 0x0211,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SEQ,
        'schema'       => "tiff",
      ),
      'tiff:ReferenceBlackWhite' => Array(
        'exifTag'      => 0x0214,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SEQ,
        'schema'       => "tiff",
      ),
      'tiff:DateTime' => Array(
        'exifTag'      => 0x0132,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "tiff",
      ),
      'tiff:ImageDescription' => Array(
        'exifTag'      => 0x010E,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_ALT,
        'schema'       => "tiff",
      ),
      'tiff:Make' => Array(
        'exifTag'      => 0x010F,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "tiff",
      ),
      'tiff:Model' => Array(
        'exifTag'      => 0x0110,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "tiff",
      ),
      'tiff:Software' => Array(
        'exifTag'      => 0x0131,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "tiff",
      ),
      'tiff:Artist' => Array(
        'exifTag'      => 0x013B,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "tiff",
      ),
      'tiff:Copyright' => Array(
        'exifTag'      => 0x9298,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_ALT,
        'schema'       => "tiff",
      ),

      /*
       * EXIF Schema for EXIF-specific Properties
       */
      'xmlns:exif' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmlns",
      ),
      'exif:ExifVersion' => Array(
        'exifTag'      => 0x9000,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:FlashpixVersion' => Array(
        'exifTag'      => 0xA000,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:ColorSpace' => Array(
        'exifTag'      => 0xA001,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:ComponentsConfiguration' => Array(
        'exifTag'      => 0x9101,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SEQ,
        'schema'       => "exif",
      ),
      'exif:CompressedBitsPerPixel' => Array(
        'exifTag'      => 0x9102,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:PixelXDimension' => Array(
        'exifTag'      => 0xA002,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:PixelYDimension' => Array(
        'exifTag'      => 0xA003,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:UserComment' => Array(
        'exifTag'      => 0x9286,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_ALT,
        'schema'       => "exif",
      ),
      'exif:RelatedSoundFile' => Array(
        'exifTag'      => 0xA004,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:DateTimeOriginal' => Array(
        'exifTag'      => 0x9003,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:DateTimeDigitized' => Array(
        'exifTag'      => 0x9004,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:ExposureTime' => Array(
        'exifTag'      => 0x829A,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:FNumber' => Array(
        'exifTag'      => 0x829D,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:ExposureProgram' => Array(
        'exifTag'      => 0x8822,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:SpectralSensitivity' => Array(
        'exifTag'      => 0x8824,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:ISOSpeedRatings' => Array(
        'exifTag'      => 0x8827,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SEQ,
        'schema'       => "exif",
      ),
      'exif:OECF' => Array(
        'exifTag'      => 0x8828,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:ShutterSpeedValue' => Array(
        'exifTag'      => 0x9201,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:ApertureValue' => Array(
        'exifTag'      => 0x9202,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:BrightnessValue' => Array(
        'exifTag'      => 0x9203,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:ExposureBiasValue' => Array(
        'exifTag'      => 0x9204,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:MaxApertureValue' => Array(
        'exifTag'      => 0x9205,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:SubjectDistance' => Array(
        'exifTag'      => 0x9206,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:MeteringMode' => Array(
        'exifTag'      => 0x9207,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:LightSource' => Array(
        'exifTag'      => 0x9208,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
/*
 * The Flash is a sequence of Flash structure
 * Don't use the exif:Flash, but the associated tags :
 *  exif:Fired, exif:Return, exif:Mode, exif:Function, exif:RedEyeMode
 */
      'exif:Flash' => Array(
        'exifTag'      => 0x9209,
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),

      'exif:Fired' => Array(
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
        'tagValues' => Array(
            'False' => "flash did not fire",
            'True'  => "flash fired"
        ),
      ),

      'exif:Return' => Array(
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
        'tagValues' => Array(
            0x00 => "no strobe",
            0x01 => "reserved",
            0x02 => "strobe return light not detected",
            0x03 => "strobe return light detected"
        ),
      ),

      'exif:Mode' => Array(
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
        'tagValues' => Array(
            0x00 => "Unknown",
            0x01 => "compulsory flash firing",
            0x02 => "compulsory flash suppression",
            0x03 => "auto mode"
        ),
      ),

      'exif:Function' => Array(
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
        'tagValues' => Array(
            'False' => "flash function present",
            'True'  => "no flash function"
        ),
      ),

      'exif:RedEyeMode' => Array(
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
        'tagValues' => Array(
            'False' => "no red-eye reduction mode or unknown",
            'True'  => "red-eye reduction supported"
          ),
      ),

      'exif:FocalLength' => Array(
        'exifTag'      => 0x920A,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:SubjectArea' => Array(
        'exifTag'      => 0x9214,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SEQ,
        'schema'       => "exif",
      ),
      'exif:FlashEnergy' => Array(
        'exifTag'      => 0xA20B,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:SpatialFrequencyResponse' => Array(
        'exifTag'      => 0xA20C,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:FocalPlaneXResolution' => Array(
        'exifTag'      => 0xA20E,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:FocalPlaneYResolution' => Array(
        'exifTag'      => 0xA20F,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:FocalPlaneResolutionUnit' => Array(
        'exifTag'      => 0xA210,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:SubjectLocation' => Array(
        'exifTag'      => 0xA214,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SEQ,
        'schema'       => "exif",
      ),
      'exif:ExposureIndex' => Array(
        'exifTag'      => 0xA215,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:SensingMethod' => Array(
        'exifTag'      => 0xA217,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:FileSource' => Array(
        'exifTag'      => 0xA300,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:SceneType' => Array(
        'exifTag'      => 0xA301,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
/*
 * The CFAPattern is a CFAPattern structure
 * Not yet implemented
 */
      'exif:CFAPattern' => Array(
        'exifTag'      => 0xA302,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:CustomRendered' => Array(
        'exifTag'      => 0xA401,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:ExposureMode' => Array(
        'exifTag'      => 0xA402,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:Balance' => Array(
        'exifTag'      => 0xA403,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:WhiteBalance' => Array(
        'exifTag'      => 0xA403,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:DigitalZoomRatio' => Array(
        'exifTag'      => 0xA404,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:FocalLengthIn35mmFilm' => Array(
        'exifTag'      => 0xA405,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:SceneCaptureType' => Array(
        'exifTag'      => 0xA406,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GainControl' => Array(
        'exifTag'      => 0xA407,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:Contrast' => Array(
        'exifTag'      => 0xA408,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:Saturation' => Array(
        'exifTag'      => 0xA409,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:Sharpness' => Array(
        'exifTag'      => 0xA40A,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:DeviceSettingDescription' => Array(
        'exifTag'      => 0xA40B,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:SubjectDistanceRange' => Array(
        'exifTag'      => 0xA40C,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:ImageUniqueID' => Array(
        'exifTag'      => 0xA420,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSVersionID' => Array(
        'gpsTag'       => 0x0000,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSLatitude' => Array(
        'gpsTag'       => 0xFFFF, // combination of tags 0x02 & 0x01
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSLongitude' => Array(
        'gpsTag'       => 0xFFFF, // combination of tags 0x04 & 0x03
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSAltitudeRef' => Array(
        'gpsTag'       => 0x0005,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSAltitude' => Array(
        'gpsTag'       => 0x0006,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSTimeStamp' => Array(
        'gpsTag'       => 0xFFFF, // combination of tags 0x1D & 0x07
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSSatellites' => Array(
        'gpsTag'       => 0x0008,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSStatus' => Array(
        'gpsTag'       => 0x0009,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSMeasureMode' => Array(
        'gpsTag'       => 0x000A,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSDOP' => Array(
        'gpsTag'       => 0x000B,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSSpeedRef' => Array(
        'gpsTag'       => 0x000C,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSSpeed' => Array(
        'gpsTag'       => 0x000D,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSTrackRef' => Array(
        'gpsTag'       => 0x000E,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSTrack' => Array(
        'gpsTag'       => 0x000F,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSImgDirectionRef' => Array(
        'gpsTag'       => 0x0010,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSImgDirection' => Array(
        'gpsTag'       => 0x0011,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSMapDatum' => Array(
        'gpsTag'       => 0x0012,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSDestLatitude' => Array(
        'gpsTag'       => 0xFFFF,  // combination of tags 0x14 & 0x13
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSDestLongitude' => Array(
        'gpsTag'       => 0xFFFF,  // combination of tags 0x16 & 0x15
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSDestBearingRef' => Array(
        'gpsTag'       => 0x0017,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSDestBearing' => Array(
        'gpsTag'       => 0x0018,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSDestDistanceRef' => Array(
        'gpsTag'       => 0x0019,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSDestDistance' => Array(
        'gpsTag'       => 0x001A,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSProcessingMethod' => Array(
        'gpsTag'       => 0x001B,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSAreaInformation' => Array(
        'gpsTag'       => 0x001C,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),
      'exif:GPSDifferential' => Array(
        'gpsTag'       => 0x001E,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "exif",
      ),

      /*
       * EXIF Schema for Additional EXIF Properties
       */
      'xmlns:aux' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmlns",
      ),
      'aux:Firmware' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "aux",
      ),
      'aux:Lens' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "aux",
      ),
      'aux:LensID' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "aux",
      ),
      'aux:LensInfo' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "aux",
      ),
      'aux:SerialNumber' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "aux",
      ),


      /*
       * IPTC Schema
       */
      'xmlns:Iptc4xmpCore' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmlns",
      ),

      'Iptc4xmpCore:CountryCode' => Array(
        'iptcTag'      => 0x0264,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "Iptc4xmpCore",
      ),

      'Iptc4xmpCore:IntellectualGenre' => Array(
        'iptcTag'      => 0x0204,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "Iptc4xmpCore",
      ),

      'Iptc4xmpCore:Scene' => Array(
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_BAG,
        'schema'       => "Iptc4xmpCore",
        'tagValues.special' => Array(
          '012100' => "posing",
          '012000' => "performing",
          '011900' => "action",
          '011800' => "close-up",
          '011700' => "interior view",
          '011600' => "exterior view",
          '011500' => "satellite",
          '011400' => "night scene",
          '011300' => "under-water",
          '011200' => "aerial view",
          '011100' => "panoramic view",
          '011000' => "general view",
          '010800' => "two",
          '010900' => "group",
          '010700' => "couple",
          '010600' => "Single",
          '010400' => "profile",
          '010500' => "rear view",
          '010300' => "full-length",
          '010200' => "half-length",
          '010100' => "headshot",
          '012200' => "symbolic",
          '012300' => "off-beat",
          '012400' => "movie scene",
        )
      ),

      'Iptc4xmpCore:SubjectCode' => Array(
        'iptcTag'      => 0x020C,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_BAG,
        'schema'       => "Iptc4xmpCore",
      ),

      'Iptc4xmpCore:Location' => Array(
        'iptcTag'      => 0x025C,
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "Iptc4xmpCore",
      ),

      'Iptc4xmpCore:DateCreated' => Array(
        'iptcTag'      => 0x0237,
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "Iptc4xmpCore",
      ),

      /*
       * specification says :
       * "The IPTC Extension Licensor fields should be used instead of these
       * Creator's Contact Info fields if you are using IPTC Extension fields.
       * If the creator is also the licensor his or her contact information
       * should be provided in the Licensor fields."
       */
      'Iptc4xmpCore:CreatorContactInfo' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "Iptc4xmpCore",
      ),

      'Iptc4xmpCore:CiEmailWork' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "Iptc4xmpCore",
      ),

      'Iptc4xmpCore:CiUrlWork' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "Iptc4xmpCore",
      ),

      'Iptc4xmpCore:CiTelWork' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "Iptc4xmpCore",
      ),

      'Iptc4xmpCore:CiAdrExtadr' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "Iptc4xmpCore",
      ),

      'Iptc4xmpCore:CiAdrPcode' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "Iptc4xmpCore",
      ),

      'Iptc4xmpCore:CiAdrCity' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "Iptc4xmpCore",
      ),

      'Iptc4xmpCore:CiAdrCtry' => Array(
        'implemented'  => true,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "Iptc4xmpCore",
      ),

      /*
       * Note Schema
       */
      'xmlns:xmpNote' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmlns",
      ),

      'xmpNote:HasExtendedXMP' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmpNote",
      ),


      /*
       * digiKam Schema
       */
      'xmlns:digiKam' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmlns",
      ),

      'digiKam:TagsList' => Array(
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_SEQ,
        'schema'       => "digiKam",
      ),

      /*
       * lr=>lightroom Schema
       */
      'xmlns:lr' => Array(
        'implemented'  => false,
        'translatable' => false,
        'type'         => self::TYPE_SIMPLE,
        'schema'       => "xmlns",
      ),

      'lr:hierarchicalSubject' => Array(
        'implemented'  => true,
        'translatable' => true,
        'type'         => self::TYPE_BAG,
        'schema'       => "lightroom",
      ),

    );

    /**
     * XmpTags needs a specific constructor, allowing to extract exif & iptc
     * properties for some tags
     *
     */
    function __construct()
    {
      parent::__construct();

      $tmpTags=Array(
        'exifTag' => new IfdTags(),
        'gpsTag'  => new GpsTags(),
        'iptcTag' => new IptcTags());
      foreach($this->tags as $key => $val)
      {
        foreach($tmpTags as $schema => $tags)
        {
          if(array_key_exists($schema, $val))
          {
            /*
             * for all the tags from the exif & tiff schema, try to copy properties
             */
            if($val[$schema]!=0xFFFF and $tags->tagIdExists($val[$schema]))
            {
              $tmpTag=$tags->getTagById($val[$schema]);
            }
            else
            {
              $tmpTag=NULL;
            }


            if(!is_null($tmpTag))
            {
              //$this->tags[$key]['tagName'] = $tmpTag['tagName'];

              if(array_key_exists('tagValues', $tmpTag))
              {
                $this->tags[$key]['tagValues'] = $tmpTag['tagValues'];
              }

              if($val['implemented'] and !$tmpTag['implemented'])
              {
                $this->tags[$key]['implemented'] = false;
              }

              unset($tmpTag);
            }
          }
        }
      }
      unset($tmpTags[0]);
      unset($tmpTags[1]);
      unset($tmpTags[2]);
      unset($tmpTags);
    }


    function __destruct()
    {
      parent::__destruct();
    }
  }


?>
