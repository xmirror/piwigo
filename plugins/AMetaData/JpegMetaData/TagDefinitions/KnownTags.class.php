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
 * The KnownTags is a generic class to manage the definition of tags
 *
 * Tags are defined in an array $tags :
 *  - key   => the Tag ID (UShort for exif & Iptc, String for Xmp)
 *  - value => an array with theses properties
 *
 *      Common properties
 *       'tagName'      => String : the official name of the tag (used for
 *                         translation)
 *       'tagValues'    => Array : an array to associate a label for each known
 *                         values
 *       'translatable' => Boolean : set to true if the value can be translated
 *       'implemented'  => Boolean : set to true if the tag needs a specific
 *                         interpretation and is implemented
 *       'schema'       => String : schema associated with the tag
 *                         exif : "tiff", "exif", "gps", "pentax", ...
 *                         xmp : "dc", "exif", "photoshop", ...
 *                         => not yet defined for Iptc....
 *       'tagValues.special' => used on some tags for implementation
 *
 *      Exif like tags
 *       'combiTag'     => Integer : use on some specific tags
 *
 *      Xmp specific properties (==> see XmpTags.class.php for more information)
 *       'iptcTag'      => if the Xmp tag exist in Iptc, the Iptc tag Id
 *       'exifTag'      => if the Xmp tag exist in Exif, the Exif tag Id
 *       'type'         => the type of Xmp data
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 * This class is not declared as an abstract class, but it's not recommanded to
 * create object with it.
 *
 * Derived classes :
 *  - GpsTags      (exif gps tags)
 *  - IfdTag       (exif & tiff tags)
 *  - IptcTag      (iptc tags)
 *  - PentaxTag    (pentax exif tags)
 *  - XmpTag       (xmp tags)
 *
 *
 * This class provides theses public functions :
 *  - getTags
 *  - tagIdExists
 *  - getTagById
 *  - getTagIdByName
 *  - getTagByName
 *  - getLabel
 *
 * -----------------------------------------------------------------------------
 *
 */

  define("KNOWN_TAGS_IMPLEMENTED",      0x01);
  define("KNOWN_TAGS_NOT_IMPLEMENTED",  0x02);
  define("KNOWN_TAGS_ALL", KNOWN_TAGS_NOT_IMPLEMENTED | KNOWN_TAGS_IMPLEMENTED);

  class KnownTags
  {
    protected $label = "";
    protected $tags = Array();

    function __construct()
    {

    }

    function __destruct()
    {
      unset($this->label);
      unset($this->tags);
    }

    /**
     * this function return the $tags array
     *
     * an optional parameter $filter can be given.
     * its an array with the keys :
     *  'implemented' => Integer = KNOWN_TAGS_ALL, KNOWN_TAGS_IMPLEMENTED, KNOWN_TAGS_NOT_IMPLEMENTED
     *                   filter tags with the property 'implemented' and 'known'
     *  'schema'      => String = name of the schema
     *                   filter tags with the schema property
     *
     * @param Array $filter (optional)
     * @return Array : an array of tags properties (see this file header to know
     *                 more about the tag properties)
     */
    public function getTags($filter = Array('implemented' => KNOWN_TAGS_ALL, 'schema' => NULL))
    {
      if(!array_key_exists('implemented', $filter))
      {
        $filter['implemented'] = KNOWN_TAGS_ALL;
      }

      if(!array_key_exists('schema', $filter))
      {
        $filter['schema'] = NULL;
      }


      $returned=Array();
      foreach($this->tags as $key => $val)
      {
        if(( ($val['implemented'] and ($filter['implemented'] & KNOWN_TAGS_IMPLEMENTED)) or
             (!$val['implemented'] and ($filter['implemented'] & KNOWN_TAGS_NOT_IMPLEMENTED)) ) and

             (is_null($filter['schema']) or
             (!is_null($filter['schema']) and $val['schema']==$filter['schema']) )
          )
        {
          $returned[$key]=$val;
        }
      }
      return($returned);
    }

    /**
     * this function returns true if the given ID exists
     *
     * @return Boolean
     */
    public function tagIdExists($id)
    {
      return(array_key_exists($id, $this->tags));
    }

    /**
     * returns a tag, searched by its ID
     * return false if the tag is not found
     *
     * @return Array : see this file header to know more about the tag properties
     */
    public function getTagById($id)
    {
      if(array_key_exists($id, $this->tags))
      {
        return($this->tags[$id]);
      }
      return(false);
    }

    /**
     * returns the tag ID, searched by its name property
     * return false if the tag is not found
     *
     * @return String or UShort
     */
    public function getTagIdByName($name)
    {
      foreach($this->tags as $key => $val)
      {
        if($val['tagName']==$name)
         return($key);
      }
      return(false);
    }

    /**
     * returns a Tag, searched by its name property
     * return false if the tag is not found
     *
     * @return Array : see this file header to know more about the tag properties
     */
    public function getTagByName($name)
    {
      $index=$this->getTagIdByName($name);
      if($index!==false)
        return($this->tags[$index]);
      return(false);
    }

    /**
     * return the label associated with the tag defininition
     * (something like "Exif & Tiff tags" or "Pentax specific tags")
     *
     * @return String
     */
    public function getLabel()
    {
      return($this->label);
    }

  }

?>
