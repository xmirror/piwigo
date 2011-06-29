<?php
/*
 * --:: Exif Maker Notes Analyzer ::--------------------------------------------
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
 * The Tag class is used to manage properties of a tag (all type of tags : exif,
 * xmp and iptc)
 *
 * A tag have different properties :
 *
 *  - tagId             : the tag id (typically, an integer for Exif & IPTC, a
 *                        string for XMP)
 *  - tagName           : a 'human readable' name for the tag, in most case it's
 *                        the official name defined in specifications
 *  - tagNote           : free to set note about a tag
 *  - tagValue          : the 'raw' value of the tag, not interpreted ; can be
 *                        of any type
 *  - valueLabel        : the interpreted value of the tag ; in most case it's a
 *                        String, but can be an Integer, a Float or an Array
 *  - tagIsKnown        : indicates if the tag is a known tag or not
 *  - tagIsImplemented  : indicates if the interpretation of the tag is
 *                        implemented or not
 *  - tagIsTranslatable : indicates if the interpreted value for the tag is
 *                        translatable
 *  - schema            : the schema associated with the tag ('exif', 'iptc', 'xmp', 'magic')
 *
 * This class provides theses public functions :
 *  - getId
 *  - getName
 *  - getValue
 *  - getLabel
 *  - getNote
 *  - getSchema
 *  - isKnown
 *  - isImplemented
 *  - isTranslatable
 *  - setId
 *  - setName
 *  - setValue
 *  - setLabel
 *  - setNote
 *  - setSchema
 *  - setKnown
 *  - setImplemented
 *  - setTranslatable
 *
 * -----------------------------------------------------------------------------
 */

  class Tag
  {
    private $tagId = 0;
    private $tagName = "unknown tag";
    private $tagNote = "";
    private $tagValue = 0;
    private $valueLabel = "not decoded";
    private $tagIsKnown = false;
    private $tagIsImplemented = false;
    private $tagIsTranslatable = false;
    private $tagSchema = "";

    /**
     * All parameters for the Tag constructor are optional
     *
     * @param $tagId (optional)                     : the tag Id ; can be
     *                                                Integer or String
     * @param $tagValue (optional)                  : the value of the tag ; can
     *                                                be of any type
     * @param String $tagName (optional)            : the 'human readable' name
     *                                                for the tag
     * @param $valueLabel (optional)                : the 'human readable' value
     *                                                for the tag
     * @param String $tagNote (optional)            : an optional information
     *                                                about the tag
     * @param Boolean $tagIsKnown (optional)        : determine if the tag is a
     *                                                known tag or not
     * @param Boolean $tagIsImplemented (optional)  : determine if the tag is an
     *                                                implemented tag or not
     * @param Boolean $tagIstranslatable (optional) : determine if the tag value
     *                                                can be translated or not
     * @param String $schema (optional)             : schema associated with to
     *                                                the tag
     */
    function __construct($tagId=0xffff, $tagValue=0, $tagName="", $valueLabel="", $tagNote="", $tagIsKnown=false, $tagIsImplemented=false, $tagIsTranslatable=false, $schema="")
    {
      $this->tagId = $tagId;
      $this->tagValue = $tagValue;
      if($tagName!="") $this->tagName = $tagName;
      if($valueLabel!="") $this->valueLabel = $valueLabel;
      if($tagNote!="") $this->tagNote = $tagNote;
      $this->tagIsKnown=$tagIsKnown;
      $this->tagIsImplemented=$tagIsImplemented;
      $this->tagIsTranslatable=$tagIsTranslatable;
      $this->tagSchema = $schema;
    }

    function __destruct()
    {
      unset($this->tagId);
      unset($this->tagName);
      unset($this->tagNote);
      unset($this->tagValue);
      unset($this->valueLabel);
      unset($this->tagIsKnown);
      unset($this->tagIsImplemented);
      unset($this->tagIsTranslatable);
      unset($this->tagSchema);
    }

    /**
     * returns the Tag Id
     *
     * @return Can be an integer (typically for exif and iptc tags) or a string
     *         (typically for xmp tags)
     */
    public function getId()
    {
      return($this->tagId);
    }

    /**
     * returns the 'human readable' tag name
     *
     * @return String
     */
    public function getName()
    {
      return($this->tagName);
    }

    /**
     * returns the value of the tag
     *
     * @return can be of any type
     */
    public function getValue()
    {
      return($this->tagValue);
    }

    /**
     * returns the 'human readable' value of the tag
     *
     * @return String, Array or DateTime object
     */
    public function getLabel()
    {
      return($this->valueLabel);
    }

    /**
     * returns true if the tag is a known tag
     *
     * @return Boolean
     */
    public function isKnown()
    {
      return($this->tagIsKnown);
    }

    /**
     * returns true if the tag is implemented or not
     *
     * @return Boolean
     */
    public function isImplemented()
    {
      return($this->tagIsImplemented);
    }

    /**
     * returns the note associated with the tag
     *
     * @return String
     */
    public function getNote()
    {
      return($this->tagNote);
    }

    /**
     * returns the schema associated to the tag
     *
     * @return String
     */
    public function getSchema()
    {
      return($this->tagSchema);
    }

    /**
     * returns true if the tag value can be translated
     *
     * @return Boolean
     */
    public function isTranslatable()
    {
      return($this->tagIsTranslatable);
    }

    /**
     * set the Id for the tag
     *
     * @param String or Integer $value : the tag Id
     * @return the tag Id
     */
    public function setId($value)
    {
      $this->tagId=$value;
      return($this->tagId);
    }

    /**
     * set the name for the tag
     *
     * @param String $value : the tag name
     * @return String : the tag name
     */
    public function setName($value)
    {
      $this->tagName=$value;
      return($this->tagName);
    }

    /**
     * set the value for the tag
     *
     * @param $value : can ba of any type
     * @return : the tag value
     */
    public function setValue($value)
    {
      $this->tagValue=$value;
      return($this->tagValue);
    }

    /**
     * set the 'human readable value' for the tag
     *
     * @param String or Integer or DateTime $value : the tag value
     * @return : the tag label
     */
    public function setLabel($value)
    {
      $this->valueLabel=$value;
      return($this->valueLabel);
    }

    /**
     * set if the tag is known
     *
     * @param Boolean $value
     * @return Boolean
     */
    public function setKnown($value)
    {
      $this->tagIsKnown=($value===true)?true:false;
      return($this->tagIsKnown);
    }

    /**
     * set if the tag is implemented
     *
     * @param Boolean $value
     * @return Boolean
     */
    public function setImplemented($value)
    {
      $this->tagIsImplemented=($value===true)?true:false;
      return($this->tagIsImplemented);
    }

    /**
     * set a note for the tag
     *
     * @param String $value
     * @return String
     */
    public function setNote($value)
    {
      $this->tagNote=$value;
      return($this->tagNote);
    }

    /**
     * set a schema to the tag
     *
     * @param String $value
     * @return String
     */
    public function setSchema($value)
    {
      $this->tagSchema=$value;
      return($this->tagSchema);
    }


    /**
     * set if the tag value is translatable
     *
     * @param Boolean $value
     * @return Boolean
     */
    public function setTranslatable($value)
    {
      $this->tagIsTranslatable=($value===true)?true:false;
      return($this->tagIsTranslatable);
    }

    public function toString($mode="all")
    {
      $returned="";

      if($mode=="all")
        if(is_string($this->tagId))
          $returned.="tag: ".str_replace(" ", "&nbsp;", sprintf("%-34s", $this->tagId))." ;
                      schema: ".str_replace(" ", "&nbsp;", sprintf("%-5s", $this->tagSchema))." ; ";
        else
          $returned.="tag: 0x".sprintf("%04x", $this->tagId)." ; ";

      $returned.="name: ".str_replace(" ", "&nbsp;", sprintf("%-34s", $this->tagName))." ; ";

      if($mode=="all")
      {
        if(is_array($this->tagValue))
          $returned.=str_replace(" ", "&nbsp;", sprintf("%-23s", "value: Array[".count($this->tagValue)."]"))."; ";
        elseif(is_string($this->tagValue))
        {
          if(strlen($this->tagValue)>25)
            $returned.="value: ".str_replace(" ", "&nbsp;", sprintf("%-25s", substr($this->tagValue,0,22)."..."))." ; ";
          else
            $returned.="value: ".str_replace(" ", "&nbsp;", sprintf("%-25s", $this->tagValue))." ; ";

        }
        else
          $returned.="value: 0x".sprintf("%08x", $this->tagValue).str_replace(" ", "&nbsp;", "               ")." ; ";
      }

      $returned.="label: ";
      if(is_array($this->valueLabel))
      {
        $returned.=print_r($this->valueLabel, true);
      }
      elseif(is_object($this->valueLabel))
      {
        $returned.="Object[".get_class($this->valueLabel)."]";
        if($this->valueLabel instanceof DateTime)
        {
          $returned.=$this->valueLabel->format('d/m/Y H:i:s');
        }
      }
      else
      {
        $returned.=$this->valueLabel;
      }


      return($returned);
    }

  }

 ?>
