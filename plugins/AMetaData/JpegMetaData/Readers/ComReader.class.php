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
 * The ComReader class is the dedicated class to read the COM structure
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 *
 * This class provides theses public functions :
 *  - getComment
 *
 * -----------------------------------------------------------------------------
 */

  require_once(JPEG_METADATA_DIR."Common/Data.class.php");
  require_once(JPEG_METADATA_DIR."TagDefinitions/ComTags.class.php");

  class ComReader extends GenericReader
  {
    private $comment;
    /**
     * The constructor need the Com block datas (given as a Data object)
     *
     * @param Data $data :
     */
    function __construct($data)
    {
      parent::__construct($data);
      $this->comment=$this->data->readASCII();
      $this->tagDef = new ComTags();

      $tag=$this->tagDef->getTagById('comment');

      $entry=new Tag();
      $entry->setKnown(true);
      $entry->setName($tag['tagName']);
      $entry->setImplemented($tag['implemented']);
      $entry->setTranslatable($tag['translatable']);
      $entry->setSchema($tag['schema']);
      $entry->setValue($this->comment);
      $entry->setLabel($this->comment);
      $this->entries[]=$entry;
    }

    function __destruct()
    {
      unset($this->comment);
      parent::__destruct();
    }

    /**
     * return the comment value
     *
     * @return String
     */
    public function getComment()
    {
      return($this->comment);
    }

    public function toString()
    {
      $returned="COM block value: ".$this->comment;
      return($returned);
    }
  }


?>
