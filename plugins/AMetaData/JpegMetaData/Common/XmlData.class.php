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
 * The XmlData class is used to read Xml data in a tree structure
 * The class read the Xml data from a string, and build a tree made with XmlNode
 * objects
 *
 * The XmlNode class is used to manage the nodes properties, like name, value,
 * attributes, ...
 *
 * -----------------------------------------------------------------------------
 *
 * The XmlData class provides theses public functions :
 *  - isValid
 *  - isLoaded
 *  - hasNodes
 *  - getFirstNode
 *  - getLastNode
 *  - setXmlData
 *
 * The XmlNode class provides theses public functions :
 *  - getName
 *  - getLevel
 *  - getValue
 *  - setName
 *  - setValue
 *  - hasAttributes
 *  - getAttributes
 *  - getAttribute
 *  - setAttribute
 *  - delAttribute
 *  - addAttribute
 *  - hasChilds
 *  - getChilds
 *  - addChild
 *  - getFirstChild
 *  - getLastChild
 *  - getPreviousNode
 *  - setPreviousNode
 *  - getNextNode
 *  - setNextNode
 *
 * -----------------------------------------------------------------------------
 */

  class XmlNode
  {
    private $name = "";
    private $attributes = Array();
    private $childs = Array();
    private $level = 0;
    private $previousNode = null;
    private $nextNode = null;
    private $value=NULL;

    /**
     * the XmlNode constructor need a name for the node, and optionally the node
     * level in the tree
     *
     * @param String $name              : node name
     * @param Integer $level (optional) : node level, by default set to zero
     */
    function __construct($name, $level=0)
    {
      $this->name=$name;
      $this->level=$level;
    }

    /**
     * free memory before destroying the object...
     */
    function __destruct()
    {
      $this->previousNode=null;
      $this->nextNode=null;
      unset($this->previousNode);
      unset($this->nextNode);
      unset($this->attributes);
      unset($this->childs);
      unset($this->value);
      unset($this->name);
      unset($this->level);
    }

    /**
     * returns the name of the node
     *
     * @return String
     */
    public function getName()
    {
      return($this->name);
    }

    /**
     * returns the level of the node
     *
     * @return Integer
     */
    public function getLevel()
    {
      return($this->level);
    }

    /**
     * returns the value of the node
     *
     * @return the type depends of the node
     */
    public function getValue()
    {
      return($this->value);
    }

    /**
     * set the name of the node
     *
     * @param String $value : the name of the node
     * @return String
     */
    public function setName($value)
    {
      $this->name = $value;
      return($this->name);
    }

    /**
     * set the value of the node
     *
     * @param $value : the value can be of any type
     */
    public function setValue($value)
    {
      $this->value=$value;
      return($this->value);
    }

    /**
     * return true if the node has attributes
     *
     * @return Boolean
     */
    public function hasAttributes()
    {
      return(count($this->attributes)>0);
    }

    /**
     * return an array of attributes
     *
     * @return Array : key = name of the attribute, value = value for attribute
     */
    public function getAttributes()
    {
      return($this->attributes);
    }

    /**
     * return value for an attribute
     * if the given attribute doesn't exist, return an empty string
     *
     * @param String $name : the attribute name
     * @return String
     */
    public function getAttribute($name)
    {
      if(array_key_exists($name, $this->attributes))
        return($this->attributes[$name]);
      else
        return("");
    }

    /**
     * set the value for an attribute
     * the attribute must exist, otherwise uses the addAttribute function
     *
     * @param String $name : the name of the attribute to set to value
     * @param $value       : the value to set for the attribute
     * @return Boolean : false if the attribute doesn't exist
     */
    public function setAttribute($name, $value)
    {
      if(array_key_exists($name, $this->attributes))
      {
        $this->attributes[$name]=$value;
        return(true);
      }
      else
        return(false);
    }

    /**
     * add an attribute
     * the attribute must exist, otherwise uses the addAttribute function

     * @param String $name : the name of the new attribute
     * @param $value       : the value of the new attribute
     */
    public function addAttribute($name, $value)
    {
      $this->attributes[]=Array(
        'name'  => $name,
        'value' => $value
      );
    }

    /**
     * delete an attribute
     * return true of the attribute has been deleted, otherwise false

     * @param String $name : the name the attribute to delete
     * @return Boolean
     */
    public function delAttribute($name)
    {
      if(array_key_exists($name, $this->attributes))
      {
        unset($this->attributes[$name]);
        return(true);
      }
      else
      {
        return(false);
      }
    }

    /**
     * returns true if the node have childs

     * @return Boolean
     */
    public function hasChilds()
    {
      return(count($this->childs)>0);
    }

    /**
     * returns an array of childs

     * @return Array of XmlNode
     */
    public function getChilds()
    {
      return($this->childs);
    }

    /**
     * add a new child (added as the last child)
     *
     * @param XmlNode $node : the child must be an instanciated XmlNode
     */
    public function addChild(XmlNode $node)
    {
      $this->childs[]=$node;
    }

    /**
     * returns the first child
     *
     * @return XmlNode or null
     */
    public function getFirstChild()
    {
      if($this->hasChilds())
        return($this->childs[0]);
      else
        return(null);
    }

    /**
     * returns the last child
     *
     * @return XmlNode or null
     */
    public function getLastChild()
    {
      if($this->hasChilds())
        return($this->childs[count($this->childs)-1]);
      else
        return(null);
    }

    /**
     * set the previous node
     *
     * @param XmlNode $node : must be an instanciated XmlNode
     * @return XmlNode : the previous node
     */
    public function setPreviousNode(XmlNode $node)
    {
      $this->previousNode = $node;
      return($this->previousNode);
    }

    /**
     * returns the previous node
     *
     * @return XmlNode or null
     */
    public function getPreviousNode()
    {
      return($this->previousNode);
    }

    /**
     * set the next node
     *
     * @param XmlNode $node : must be an instanciated XmlNode
     * @return XmlNode : the next node
     */
    public function setNextNode(XmlNode $node)
    {
      $this->nextNode = $node;
      return($this->nextNode);
    }

    /**
     * returns the next node
     *
     * @return XmlNode or null
     */
    public function getNextNode()
    {
      return($this->nextNode);
    }


  }

  class XmlData
  {
    private $xml = "";
    private $nodes = Array();
    private $isValid = false;
    private $isLoaded = false;

    /**
     * the XmlData constructor needs ans Xml string
     *
     * @param String $xml : an xml structure in a string
     */
    function __construct($xml)
    {
      $this->isValid = $this->setXmlData($xml);
      $this->isLoaded = $this->hasNodes();
    }

    function __destruct()
    {
      unset($this->xml);
      unset($this->isValid);
      unset($this->isLoaded);
      unset($this->nodes);
    }

    /**
     * returns true if the xml is valid
     *
     * @return Boolean
     */
    public function isValid()
    {
      return($this->isValid);
    }

    /**
     * returns true if the xml has been successfully loaded
     *
     * @return Boolean
     */
    public function isLoaded()
    {
      return($this->isLoaded);
    }

    /**
     * returns true if XmlData has nodes
     *
     * @return Boolean
     */
    public function hasNodes()
    {
      return(count($this->nodes)>0);
    }

    /**
     * returns the first node of the XmlData
     *
     * @return XmlNode or null
     */
    public function getFirstNode()
    {
      if(count($this->nodes)>0)
      {
        return($this->nodes[0]);
      }
      else
      {
        return(null);
      }
    }

    /**
     * returns the last node of the XmlData
     *
     * @return XmlNode or null
     */
    public function getLastNode()
    {
      if(count($this->nodes)>0)
      {
        return($this->nodes[count($this->nodes)-1]);
      }
      else
      {
        return(null);
      }
    }

    /**
     * set the xml data
     * return true if the xml is valid and the xml tree is built
     *
     * @param String $xml : an xml structure in a string
     * @return Boolean
     */
    public function setXmlData($xml)
    {
      if(is_string($xml))
      {
        $this->xml=$xml;
        return($this->buildTreeNode());
      }
      return(false);
    }

    /**
     * the xml_parse_info_struct load an XML file into a one dimension array
     * this function build a tree with XmlNode object
     */
    private function buildTreeNode()
    {
      $xmlParser = xml_parser_create();
      xml_parser_set_option($xmlParser, XML_OPTION_CASE_FOLDING, 0);
      xml_parser_set_option($xmlParser, XML_OPTION_SKIP_WHITE, 1);
      $result=xml_parse_into_struct($xmlParser, $this->xml, $values);
      xml_parser_free($xmlParser);
      unset($xmlParser);

      //an error has occured while parsing the xml structure
      if($result===0) return(false);


      $tree=Array();

      for($i=0;$i<count($values);$i++)
      {
        $val=$values[$i];

        switch($val['type'])
        {
          case "open":
          case "complete":
            $node=new XmlNode($val['tag'], $val['level']);

            if(array_key_exists('value', $val))
            {
              $node->setValue($val['value']);
            }

            if(array_key_exists('attributes', $val))
            {
              foreach($val['attributes'] as $itemKey => $itemVal)
              {
                $node->addAttribute($itemKey, $itemVal);
              }
            }

            if(count($tree)>0)
            {
              $parent=$tree[count($tree)-1];
              if($parent->hasChilds())
              {
                $parent->getLastChild()->setNextNode($node);
                $node->setPreviousNode($parent->getLastChild());
              }
              $parent->addChild($node);
            }

            if($val['type']=="open")
            {
              array_push($tree, $node);
            }

            $this->nodes[]=$node;
            break;
          case "close":
            array_pop($tree);
            break;
        }
      }
      unset($values);
      unset($tree);
      return(true);
    }

  }

?>
