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
 * The GenericReader is a generic class providing methods for tags management
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 * This class is not declared as an abstract class, but it's not recommanded to
 * create object with it.
 *
 *
 * Derived classes :
 *  - IfdReader         (for exif tags)
 *  - GpsReader         (for exif GPS tags, in fact derived from IfdReader)
 *  - MakerNotesReader  (for maker notes tags, in fact derived from IfdReader)
 *  - PentaxReader      (for Pentax exif tags, in fact derived from MakerNotesReader)
 *  - IptcReader        (for iptc tags)
 *  - XmpReader         (for xmp tags)
 *
 *
 * This class provides theses public functions :
 *  - getNbTags
 *  - getTag
 *  - getTags
 *  - getTagIndexById
 *  - getTagById
 *  - getTagByName
 *
 * -----------------------------------------------------------------------------
 */

  require_once(JPEG_METADATA_DIR."Common/Data.class.php");


  class GenericReader
  {
    protected $nbEntries = 0;
    protected $entries = Array();
    protected $headerSize = 0;

    protected $data = null;

    protected $tagDef = null; // $tagDef must be a KnownTags (or derived) object

    /**
     * the constructor needs data to parse ; given data must be a String
     *
     * @param String $data : data to parse
     */
    function __construct($data)
    {
      $this->initializeTagDef();
      $this->data=new Data($data);
    }

    function __destruct()
    {
      unset($this->tagDef);
      unset($this->data);
      unset($this->entries);
    }

    public function toString()
    {
      $returned="NbEntries: ".sprintf("%02d", $this->nbEntries);
      return($returned);
    }

    /**
     * returns the number of tags for the structure
     *
     * @return Integer
     */
    public function getNbTags()
    {
      return($this->nbEntries);
    }

    /**
     * returns a Tag object from a sequential index
     * return null if index is out of range
     *
     * @return Tag
     */
    public function getTag($index)
    {
      if($index>=0 and $index<=count($this->entries))
        return($this->entries[$index]);
      else
        return(null);
    }

    /**
     * returns an array of Tag objects
     *
     * @return Tag[]
     */
    public function getTags()
    {
      return($this->entries);
    }

    /**
     * returns the index of the given Tag, searched with the tag Id
     * returns -1 if there is no tag with this tagId
     *
     * @param String or Integer $tagId : the tag id of the searched tag
     * @return Integer
     */
    public function getTagIndexById($tagId)
    {
      for($i=0;$i<count($this->entries);$i++)
      {
        if($this->entries[$i] instanceof IfdEntryReader)
        {
          if($this->entries[$i]->getTagId()==$tagId)
          {
            return($i);
          }
        }
        elseif($this->entries[$i] instanceof Tag)
        {
          if($this->entries[$i]->getId()==$tagId)
          {
            return($i);
          }
        }
      }
      return(-1);
    }

    /**
     * returns a Tag object, tag is searched with the tag Id
     * returns null if there is no tag with this tagId
     *
     * @param String or Integer $tagId : the tag id of the searched tag
     * @return Integer
     */
    public function getTagById($tagId)
    {
      $i=$this->getTagIndexById($tagId);
      if($i>=0)
      {
        return($this->entries[$i]);
      }
      return(null);
    }

    /**
     * returns the first Tag object found, tag is searched with the tag name
     * returns null if there is no tag with this tagId
     *
     * @param String $name : the name of the searched tag
     * @return Integer
     */
    public function getTagByName($name)
    {
      for($i=0;$i<count($this->entries);$i++)
      {
        if($this->entries[$i] instanceof IfdEntryReader)
        {
          if($this->entries[$i]->getTag()->getName()==$name)
          {
            return($this->entries[$i]->getTag());
          }
        }
        elseif($this->entries[$i] instanceof Tag)
        {
          if($this->entries[$i]->getName()==$name)
          {
            return($this->entries[$i]);
          }
        }
      }
      return(null);
    }

    /**
     * must be overrided by derived class
     * this function is called in the constructor to initialiaze the tags
     * definitions (tagDef is instanciation of a KnownTag derived class)
     */
    protected function initializeTagDef()
    {
    }


    /**
     * skip header, if any
     * (used by maker sub IFD classes)
     *
     * @param ULong $headerSize (optional) : size of header to skip
     */
    protected function skipHeader($headerSize=0)
    {
      $this->data->seek($headerSize);
    }


  }




?>
