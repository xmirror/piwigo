<?php
/*
 * -----------------------------------------------------------------------------
 * Plugin Name: Advanced MetaData
 * -----------------------------------------------------------------------------
 * Author     : Grum
 *   email    : grum@piwigo.org
 *   website  : http://photos.grum.fr
 *   PWG user : http://forum.piwigo.org/profile.php?id=3706
 *
 *   << May the Little SpaceFrog be with you ! >>
 *
 * -----------------------------------------------------------------------------
 *
 * See main.inc.php for release information
 *
 * This file contains the AMD_JpegMetaData class, overriding the JpegMetaData
 * class
 *
 * See the JpegMetaData class to obtain more information about the provided
 * functions
 *
 * -----------------------------------------------------------------------------
 */

  include_once('JpegMetaData/JpegMetaData.class.php');

  class AMD_JpegMetaData extends JpegMetaData
  {
    static public function getTagList($options=Array())
    {
      $returned=parent::getTagList($options);

      $returned['magic.GPS.GoogleMaps']=Array(
        'implemented' => true,
        'translatable' => true,
        'name' => "magic.GPS.GoogleMaps"
      );

      ksort($returned);
      return($returned);
    }


    function __construct($file = "", $options = Array())
    {
      parent::__construct($file, $options);
    }

    function __destruct()
    {
      parent::__destruct();
    }

    /**
     * MagicTags are build with this function
     */
    protected function processMagicTags()
    {
      parent::processMagicTags();
      // process tag "magic.GPS.GoogleMaps"
      if(array_key_exists("magic.GPS.LatitudeNum", $this->tags) and
         array_key_exists("magic.GPS.LongitudeNum", $this->tags))
      {
        $tag=new Tag("magic.GPS.GoogleMaps",0,"magic.GPS.GoogleMaps");

        $tag->setValue("http://maps.google.com/maps?oe=UTF8&ll=".trim($this->tags['magic.GPS.LatitudeNum']->getLabel()).",".trim($this->tags['magic.GPS.LongitudeNum']->getLabel())."&t=k&z=15");
        $tag->setLabel("<a href='http://maps.google.com/maps?oe=UTF8&ll=".trim($this->tags['magic.GPS.LatitudeNum']->getValue()).",".trim($this->tags['magic.GPS.LongitudeNum']->getValue())."&t=k&z=15'>|".$this->tags['magic.GPS.Localization']->getLabel()."|</a>");
        $tag->setKnown(true);
        $tag->setImplemented(true);
        $tag->setTranslatable(true);

        $this->tags["magic.GPS.GoogleMaps"]=$tag;

        unset($tag);
      }
    }

  } // class AMD_JpegMetaData

?>
