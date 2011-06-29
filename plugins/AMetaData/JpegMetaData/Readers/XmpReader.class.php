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
 * The XmpReader class is the dedicated class to read XMP from the APP1 segment
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 * The XmpReader class is derived from the GenericReader class.
 *
 * ======> See GenericReader.class.php to know more about common methods <======
 *
 * -----------------------------------------------------------------------------
 */

  require_once(JPEG_METADATA_DIR."Common/Data.class.php");
  require_once(JPEG_METADATA_DIR."Common/XmlData.class.php");
  require_once(JPEG_METADATA_DIR."Readers/GenericReader.class.php");
  require_once(JPEG_METADATA_DIR."TagDefinitions/XmpTags.class.php");

  class XmpReader extends GenericReader
  {
    protected $schema = Schemas::XMP;

    private $xmlData = NULL;

    private $xmpTag2Exif = NULL;

    /**
     * The constructor needs, like the ancestor, the datas to be parsed
     *
     * @param String $data
     */
    function __construct($data)
    {
      /**
       * XML data are given from an APP1 segement.
       *
       * The XMP header ends with a \x00 char, so XML data can be extracted
       * after the \x00 char
       *
       */
      $this->data=explode("\x00", $data);
      if(count($this->data)>1)
      {
        $this->data=$this->data[1];
      }
      else
      {
        $this->data="";
      }

      parent::__construct($this->data);

      $this->xmpTag2Exif = new XmpTag2Exif("", 0, 0);

      $this->xmlData = new XmlData($this->data->readASCII(-1,0));
      $this->tagDef = new XmpTags();

      $this->loadTags();

      $this->isValid = $this->xmlData->isValid();
      $this->isLoaded = $this->xmlData->isLoaded();

    }

    function __destruct()
    {
      unset($this->xmlData);
      unset($this->xmpTag2Exif);
      parent::__destruct();
    }

    public function toString()
    {
      $returned=$this->data->readASCII(-1,0);
      return($returned);
    }

    /**
     * This function load tags from the xml tree
     */
    private function loadTags()
    {
      if($this->xmlData->hasNodes())
      {
        $this->processNode($this->xmlData->getFirstNode());
      }
    }

    /**
     * this function analyze the node properties
     *  - attributes are converted in Tag through a call to the addTag function
     *  - childs are processed by a specific call to the processChildNode
     *    function
     *  - next node is processed by a recursive call
     *
     * @param XmlNode $node
     */
    private function processNode($node)
    {
      if(!is_null($node))
      {
        $node->setName($this->processNodeName($node->getName()));

        foreach($node->getAttributes() as $key => $val)
        {
          $val['name']=$this->processNodeName($val['name']);
          $this->addTag($val['name'], $val['value']);
        }

        if(!is_null($node->getValue()))
        {
          $this->addTag($node->getName(), $node->getValue());
        }

        if($node->hasChilds())
        {
          $this->processChildNode($node);
        }

        $this->processNode($node->getNextNode());
      }
    }


    /**
     * 'xap' schemas have to be interpreted as a 'xmp' schemas
     * so, this function rename all 'xap' nodes in 'xmp' nodes
     *
     * @param String $nodeName
     */
    private function processNodeName($nodeName)
    {
      $name=preg_replace(Array("/^(xap:)/", "/^(xapMM:)/"), Array("xmp:", "xmpMM:"), $nodeName);

      return($name);
    }


    /**
     * childs node are 'seq', 'alt' or 'bag' type and needs a specific
     * interpretation
     *
     * this function process this kind of data, and add it in the Tag entries
     *
     * if child node is not a special a specific node, process it as a normal
     * node
     *
     * @param XmlNode $node
     */
    private function processChildNode($node)
    {
      switch($node->getName())
      {
        /*
         * child must be 'rdf:Seq', 'rdf:Bag' or 'rdf:Alt'
         */
        case "dc:contributor" : // bag
        case "dc:creator" : // seq
        case "dc:date" : // seq
        case "dc:description" : // alt
        case "dc:language" : // bag
        case "dc:publisher" : // bag
        case "dc:relation" : // bag
        case "dc:rights" : // alt
        case "dc:subject" : // bag
        case "dc:title" : // alt
        case "dc:Type" : // bag
        case "xmp:Advisory" : // bag
        case "xmp:Identifier" : // bag
        case "xmp:Thumbnails" : // alt
        case "xmpRights:Owner" : // bag
        case "xmpRights:UsageTerms" : // alt
        case "xmpMM:History" : // seq
        case "xmpMM:Versions" : // seq
        case "xmpBJ:JobRef" : // bag
        case "xmpTPg:Fonts" : // bag
        case "xmpTPg:Colorants" : // seq
        case "xmpTPg:PlateNames" : // seq
        case "photoshop:SupplementalCategories" : // bag
        case "crs:ToneCurve" : // seq
        case "tiff:BitsPerSample" : // seq
        case "tiff:YCbCrSubSampling" : // seq
        case "tiff:TransferFunction" : // seq
        case "tiff:WhitePoint" : // seq
        case "tiff:PrimaryChromaticities" : // seq
        case "tiff:YCbCrCoefficients" : // seq
        case "tiff:ReferenceBlackWhite" : // seq
        case "tiff:ImageDescription" : // alt
        case "tiff:Copyright" : // alt
        case "exif:ComponentsConfiguration" : // seq
        case "exif:UserComment" : // alt
        case "exif:ISOSpeedRatings" : // seq
        case "exif:SubjectArea" : // seq
        case "exif:SubjectLocation" : // seq
        case "Iptc4xmpCore:Scene": //bag
        case "Iptc4xmpCore:SubjectCode": //bag
        case "digiKam:TagsList": //seq
        case "lr:hierarchicalSubject": //bag
          $child=$node->getFirstChild();
          switch($child->getName())
          {
            case "rdf:Seq":
              $type="seq";
              break;
            case "rdf:Bag":
              $type="bag";
              break;
            case "rdf:Alt":
              $type="alt";
              break;
            default:
              $type="n/a";
              break;
          }
          if($type=="seq" or $type=="bag" or $type=="alt")
          {
            $value=Array('type' => $type, 'values' => Array());
            $childNode=$child->getFirstChild();
            while(!is_null($childNode))
            {
              if($childNode->getName() == "rdf:li")
              {
                if($type=="alt")
                {
                  $attributes=$childNode->getAttributes();
                  if(count($attributes)>0)
                  {
                    $attributes=$attributes[0];
                  }
                  else
                  {
                    $attributes="n/a";
                  }
                  $value['values'][]=Array('type' => $attributes, 'value' => $childNode->getValue());
                }
                else
                {
                  $value['values'][]=$childNode->getValue();
                }
              }
              $childNode=$childNode->getNextNode();
            }
            $this->addTag($node->getName(), $value);
          }
          unset($child);
          break;
        default:
          $this->processNode($node->getFirstChild());
          break;
      }
    }

    /**
     * add a Tag to the entries.
     * name and value are needed, the function made the rest (interpret the
     * value into a 'human readable' value)
     *
     * @param String $name : the name of the tag
     * @param $value       : can be of any type
     */
    private function addTag($name, $value)
    {
      $tag=new Tag($name, $value, $name);

      if($this->tagDef->tagIdExists($name))
      {
        $tagProperties=$this->tagDef->getTagById($name);

        $tag->setKnown(true);
        $tag->setImplemented($tagProperties['implemented']);
        $tag->setTranslatable($tagProperties['translatable']);
        $tag->setSchema($this->schema);

        if(array_key_exists('name', $tagProperties))
        {
          $tag->setName($tagProperties['name']);
        }

        /*
         * if there is values defined for the tag, analyze it
         */
        if(array_key_exists('tagValues', $tagProperties))
        {
          if(array_key_exists($value, $tagProperties['tagValues']))
          {
            $tag->setLabel($tagProperties['tagValues'][$value]);
          }
          else
          {
            $tag->setLabel("[unknown value '".$value."']");
          }
        }
        else
        {
          /*
           * there is no values defined for the tag, analyzing it with dedicated
           * function
           */
          if(array_key_exists('exifTag', $tagProperties))
          {
            $tag->setLabel($this->xmp2Exif($name, $tagProperties['exifTag'], $value));
          }
          else
          {
            $tag->setLabel($this->processSpecialTag($name, $value));
          }

        }
        unset($tagProperties);
      }

      $this->entries[]=$tag;
      unset($tag);
    }

    /**
     * this function do the interpretation of specials tags
     *
     * the function return the interpreted value for the tag
     *
     * @param $name              : the name of the tag
     * @param $value             : 'raw' value to be interpreted
     */
    private function processSpecialTag($name, $value)
    {
      /*
       * Note : exif & tiff values are not processed in this function
       */
      switch($name)
      {
        case "x:xmptk":
        case "aux:Lens":
        case "aux:Firmware":
        case "aux:SerialNumber":
        case "dc:coverage":
        case "dc:format":
        case "dc:identifier":
        case "dc:relation":
        case "dc:source":
        case "dc:title":
        case "dc:CreatorTool":
        case "xmp:BaseURL":
        case "xmp:CreatorTool":
        case "xmp:Label":
        case "xmp:Nickname":
        case "xmp:Rating:":
        case "xmpRights:Certificate":
        case "xmpRights:Marked":
        case "xmpRights:UsageTerms":
        case "xmpRights:WebStatement":
        case "xmpMM:DocumentID":
        case "xmpMM:InstanceID":
        case "xmpMM:Manager":
        case "xmpMM:ManageTo":
        case "xmpMM:ManageUI":
        case "xmpMM:ManagerVariant":
        case "xmpMM:RenditionParams":
        case "xmpMM:VersionID":
        case "xmpMM:LastURL":
        case "photoshop:AuthorsPosition":
        case "photoshop:CaptionWriter":
        case "photoshop:Category":
        case "photoshop:City":
        case "photoshop:Country":
        case "photoshop:Credit":
        case "photoshop:Headline":
        case "photoshop:Instructions":
        case "photoshop:Source":
        case "photoshop:State":
        case "photoshop:TransmissionReference":
        case "photoshop:ICCProfile":
        case "crs:AutoBrightness":
        case "crs:AutoContrast":
        case "crs:AutoExposure":
        case "crs:AutoShadows":
        case "crs:BlueHue":
        case "crs:BlueSaturation":
        case "crs:Brightness":
        case "crs:CameraProfile":
        case "crs:ChromaticAberrationB":
        case "crs:ChromaticAberrationR":
        case "crs:ColorNoiseReduction":
        case "crs:Contrast":
        case "crs:CropTop":
        case "crs:CropLeft":
        case "crs:CropBottom":
        case "crs:CropRight":
        case "crs:CropAngle":
        case "crs:CropWidth":
        case "crs:CropHeight":
        case "crs:Exposure":
        case "crs:GreenHue":
        case "crs:GreenSaturation":
        case "crs:HasCrop":
        case "crs:HasSettings":
        case "crs:LuminanceSmoothing":
        case "crs:RawFileName":
        case "crs:RedHue":
        case "crs:RedSaturation":
        case "crs:Saturation":
        case "crs:Shadows":
        case "crs:ShadowTint":
        case "crs:Sharpness":
        case "crs:Temperature":
        case "crs:Tint":
        case "crs:Version":
        case "crs:VignetteAmount":
        case "crs:VignetteMidpoint":
        case "Iptc4xmpCore:CountryCode":
        case "Iptc4xmpCore:Location":
        case "Iptc4xmpCore:CiEmailWork":
        case "Iptc4xmpCore:CiUrlWork":
        case "Iptc4xmpCore:CiTelWork":
        case "Iptc4xmpCore:CiAdrExtadr":
        case "Iptc4xmpCore:CiAdrPcode":
        case "Iptc4xmpCore:CiAdrCity":
        case "Iptc4xmpCore:CiAdrCtry":
          $returned=$value;
          break;
        case "Iptc4xmpCore:IntellectualGenre":
          $returned=explode(":", $value);
          break;
        case "exif:GPSLatitude":
        case "exif:GPSLongitude":
        case "exif:GPSDestLatitude":
        case "exif:GPSDestLongitude":
          $returned=Array('coord' => "", 'card'=>"");
          preg_match_all('/(\d{1,3}),(\d{1,2})(?:\.(\d*)){0,1}(N|S|E|W)/', $value, $result);
          $returned['coord']=$result[1][0]."° ".$result[2][0]."' ";
          if(trim($result[3][0])!="")
          {
            $returned['coord'].= round(("0.".$result[3][0])*60,2)."\"";
          }
          switch($result[4][0])
          {
            case "N":
              $returned['card']="North";
              break;
            case "S":
              $returned['card']="South";
              break;
            case "E":
              $returned['card']="East";
              break;
            case "W":
              $returned['card']="West";
              break;
          }
          $type=ByteType::UNDEFINED;
          break;
        case "xmp:CreateDate":
        case "xmp:ModifyDate":
        case "xmp:MetadataDate":
        case "tiff:DateTime":
        case "photoshop:DateCreated":
        case "Iptc4xmpCore:DateCreated":
          $returned=ConvertData::toDateTime($value);
          break;
        case "dc:contributor" : // bag
        case "dc:creator" : // seq
        case "dc:date" : // seq
        case "dc:description" : // alt
        case "dc:language" : // bag
        case "dc:publisher" : // bag
        case "dc:relation" : // bag
        case "dc:rights" : // alt
        case "dc:subject" : // bag
        case "dc:title" : // alt
        case "dc:Type" : // bag
        case "xmp:Advisory" : // bag
        case "xmp:Identifier" : // bag
        case "xmp:Thumbnails" : // alt
        case "xmpRights:Owner" : // bag
        case "xmpRights:UsageTerms" : // alt
        case "xmpMM:History" : // seq
        case "xmpMM:Versions" : // seq
        case "xmpBJ:JobRef" : // bag
        case "xmpTPg:Fonts" : // bag
        case "xmpTPg:Colorants" : // seq
        case "xmpTPg:PlateNames" : // seq
        case "photoshop:SupplementalCategories" : // bag
        case "crs:ToneCurve" : // seq
        case "tiff:BitsPerSample" : // seq
        case "tiff:YCbCrSubSampling" : // seq
        case "tiff:TransferFunction" : // seq
        case "tiff:WhitePoint" : // seq
        case "tiff:PrimaryChromaticities" : // seq
        case "tiff:YCbCrCoefficients" : // seq
        case "tiff:ReferenceBlackWhite" : // seq
        case "tiff:ImageDescription" : // alt
        case "tiff:Copyright" : // alt
        case "exif:ComponentsConfiguration" : // seq
        case "exif:UserComment" : // alt
        case "exif:ISOSpeedRatings" : // seq
        case "exif:SubjectArea" : // seq
        case "exif:SubjectLocation" : // seq
        case "digiKam:TagsList": //seq
        case "lr:hierarchicalSubject": //seq
          $returned=$value;
          break;
        case "Iptc4xmpCore:Scene": //bag
          $tag=$this->tagDef->getTagById('Iptc4xmpCore:Scene');
          $returned=$value;
          foreach($returned['values'] as $key=>$val)
          {
            if(array_key_exists($val, $tag['tagValues.special']))
              $returned['values'][$key]=$tag['tagValues.special'][$val];
          }
          unset($tag);
          break;
        case "Iptc4xmpCore:SubjectCode": //bag
          $returned=$value;
          foreach($returned['values'] as $key=>$val)
          {
            $tmp=explode(":", $val);

            $returned['values'][$key]=Array();

            if(count($tmp)>=1)
              $returned['values'][$key]['IPR']=$tmp[0];

            if(count($tmp)>=2)
              $returned['values'][$key]['subjectCode']=$tmp[1];

            if(count($tmp)>=3)
              $returned['values'][$key]['subjectName']=$tmp[2];

            if(count($tmp)>=4)
              $returned['values'][$key]['subjectMatterName']=$tmp[3];

            if(count($tmp)>=5)
              $returned['values'][$key]['subjectDetailName']=$tmp[4];

            unset($tmp);
          }
          break;
        default:
          $returned="Not yet implemented; $name";
          break;
      }
      return($returned);
    }

    /**
     * this function convert the value from XMP 'exif' or XMP 'tiff' data by
     * using an instance of a XmpTag2Exif object (using exif tag object allows
     * not coding the same things twice)
     */
    private function xmp2Exif($tagName, $exifTag, $xmpValue)
    {
      switch($tagName)
      {
        /* integers */
        case "tiff:ImageWidth":
        case "tiff:ImageLength":
        case "tiff:PhotometricInterpretation":
        case "tiff:Orientation":
        case "tiff:SamplesPerPixel":
        case "tiff:PlanarConfiguration":
        case "tiff:YCbCrSubSampling":
        case "tiff:YCbCrPositioning":
        case "tiff:ResolutionUnit":
        case "exif:ColorSpace":
        case "exif:PixelXDimension":
        case "exif:PixelYDimension":
        case "exif:MeteringMode":
        case "exif:LightSource":
        case "exif:FlashEnergy":
        case "exif:FocalPlaneResolutionUnit":
        case "exif:SensingMethod":
        case "exif:FileSource":
        case "exif:SceneType":
        case "exif:CustomRendered":
        case "exif:ExposureMode":
        case "exif:Balance":
        case "exif:FocalLengthIn35mmFilm":
        case "exif:SceneCaptureType":
        case "exif:GainControl":
        case "exif:Contrast":
        case "exif:Saturation":
        case "exif:Sharpness":
        case "exif:SubjectDistanceRange":
        case "exif:GPSAltitudeRef":
        case "exif:GPSDifferential":
          $returned=(int)$xmpValue;
          $type=ByteType::ULONG;
          break;
        /* specials */
        case "tiff:BitsPerSample":
        case "tiff:Compression":
        case "tiff:TransferFunction":
        case "tiff:WhitePoint":
        case "tiff:PrimaryChromaticities":
        case "tiff:YCbCrCoefficients":
        case "tiff:ReferenceBlackWhite":
        case "exif:ComponentsConfiguration":
        case "exif:ExposureProgram":
        case "exif:ISOSpeedRatings":
        case "exif:OECF":
        case "exif:Flash":
        case "exif:SubjectArea":
        case "exif:SpatialFrequencyResponse":
        case "exif:SubjectLocation":
        case "exif:CFAPattern":
        case "exif:DeviceSettingDescription":
          $returned=$xmpValue;
          $type=ByteType::UNDEFINED;
          break;
        /* rational */
        case "tiff:XResolution":
        case "tiff:YResolution":
        case "exif:CompressedBitsPerPixel":
        case "exif:ExposureTime":
        case "exif:FNumber":
        case "exif:ShutterSpeedValue":
        case "exif:ApertureValue":
        case "exif:BrightnessValue":
        case "exif:ExposureBiasValue":
        case "exif:MaxApertureValue":
        case "exif:SubjectDistance":
        case "exif:FocalLength":
        case "exif:FocalPlaneXResolution":
        case "exif:FocalPlaneYResolution":
        case "exif:ExposureIndex":
        case "exif:DigitalZoomRatio":
        case "exif:GPSAltitude":
        case "exif:GPSDOP":
        case "exif:GPSSpeed":
        case "exif:GPSTrack":
        case "exif:GPSImgDirection":
        case "exif:GPSDestBearing":
        case "exif:GPSDestDistance":
          $computed=explode("/", $xmpValue);
          $returned=Array((int)$computed[0], (int)$computed[1]);
          $type=ByteType::URATIONAL;
          unset($computed);
          break;
        /* dates & texts */
        case "tiff:DateTime":
        case "tiff:ImageDescription":
        case "tiff:Make":
        case "tiff:Model":
        case "tiff:Software":
        case "tiff:Artist":
        case "tiff:Copyright":
        case "exif:ExifVersion":
        case "exif:FlashpixVersion":
        case "exif:UserComment":
        case "exif:RelatedSoundFile":
        case "exif:DateTimeOriginal":
        case "exif:DateTimeDigitized":
        case "exif:SpectralSensitivity":
        case "exif:ImageUniqueID":
        case "exif:GPSVersionID":
        case "exif:GPSTimeStamp":
        case "exif:GPSSatellites":
        case "exif:GPSStatus":
        case "exif:GPSMeasureMode":
        case "exif:GPSSpeedRef":
        case "exif:GPSTrackRef":
        case "exif:GPSImgDirectionRef":
        case "exif:GPSMapDatum":
        case "exif:GPSDestBearingRef":
        case "exif:GPSDestDistanceRef":
        case "exif:GPSProcessingMethod":
        case "exif:GPSAreaInformation":
          $returned=$xmpValue;
          $type=ByteType::ASCII;
          break;
        default:
          $returned="Unknown tag: $tagName => $xmpValue";
          break;
      }
      if(is_array($returned))
      {
        if(array_key_exists('type', $returned))
        {
          if($returned['type']=='alt')
          {
          }
          else
          {
            foreach($returned['values'] as $key => $val)
            {
              $returned['values'][$key]['value']=$this->xmpTag2Exif->convert($exifTag, $val['value'], $type);
            }
          }
        }
        else
        {
          return($this->xmpTag2Exif->convert($exifTag, $returned, $type));
        }
      }
      return($returned);
    }

  }

  /**
   * The XmpTag2Exif is derived from the IfdReader class
   *
   * This function provides the public function 'convert', allowing to convert
   * 'exif' datas in 'human readable' values
   *
   */
  class XmpTag2Exif extends IfdReader
  {
    public function convert($exifTag, $value, $type)
    {
      return($this->processSpecialTag($exifTag, $value, $type));
    }
  }

?>
