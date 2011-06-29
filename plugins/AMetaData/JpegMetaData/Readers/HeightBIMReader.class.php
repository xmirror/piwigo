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
 * The HeightBIMReader class is the class dedicated to read 8BIM block from an
 * APP13 segment
 *
 * An 8BIM block is defined by
 *  4 bytes (ASCII)  : block header equals "8BIM"
 *  2 bytes (UShort) : block type "\x04\x04" for IPTC (other type are not
 *                     managed)
 *  1 byte           : size of a pascal string
 *  n bytes          : name of the 8BIM block - a pascal string (equals \x00 if
 *                     size length equals 0)
 *  4 bytes          : block size
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 * This class provides theses public functions :
 *  - getNbEntries
 *  - getEntries
 *  - isValid
 *  - getSize
 *  - getBlockSize
 *  - getName
 *
 * -----------------------------------------------------------------------------
 *
 * 8BIM definition class (IPTC block)
 *
 * -----------------------------------------------------------------------------
 */

  require_once(JPEG_METADATA_DIR."Common/Tag.class.php");

  class HeightBIMReader
  {
    const HEADER = "8BIM";
    const TYPE_IPTC = 0x0404;

    private $blockSize = 0;
    private $dataSize = 0;
    private $readed = 0;
    private $name = "";

    private $isValid = false;

    private $entries = array();

    private $data = null;

    /**
     * the constructor only needs datas to parse
     *
     * @param String $data
     */
    function __construct($data)
    {
      $this->data = new Data($data, BYTE_ORDER_BIG_ENDIAN);

      $tmp=$this->data->readASCII(4);

      if($tmp==self::HEADER)
      {
        /*
         * header is ok, so try to read the 8BIM datas
         */
        $this->type = $this->data->readUShort();
        $pLength=$this->data->readUByte();


        if($pLength==0)
        {
          // the block doesn't have name
          $this->data->readUByte();
          $this->blockSize=12;
        }
        else
        {
          // the block have a name
          $this->name=$this->data->readASCII($pLength);
          $this->blockSize=11+$pLength;
        }

        $this->dataSize = $this->data->readULong();
        $this->blockSize+=$this->dataSize+1;
        if($this->dataSize>0 and $this->type==self::TYPE_IPTC)
        {
          $this->readEntries();
          $this->isValid=true;
        }
      }
    }

    function __destruct()
    {
      unset($this->entries);
      unset($this->data);
    }

    /**
     * returns the number of tags found in the 8BIM block
     *
     * @return Integer
     */
    public function getNbTags()
    {
      return(count($this->entries));
    }

    /**
     * returns an array of found tags in the 8BIM block
     *
     * @return Tag[]
     */
    public function getTags()
    {
      return($this->entries);
    }

    /**
     * returns true if the 8BIM block is a valid IPTC data block
     *
     * @return Boolean
     */
    public function isValid()
    {
      return($this->isValid);
    }

    /**
     * returns the size of datas in the 8BIM block
     *
     * @return Integer
     */
    public function getSize()
    {
      return($this->dataSize);
    }

    /**
     * returns the size of the 8BIM block
     *
     * @return Integer
     */
    public function getBlockSize()
    {
      return($this->blockSize);
    }

    /**
     * returns the name of the 8BIM block
     *
     * @return String
     */
    public function getName()
    {
      return($this->name);
    }

    /**
     * read IPTC datas from the 8BIM block, instanciate the tags and add it to
     * entries
     *
     * the tag value is not interpreted
     */
    private function readEntries()
    {
      while(($this->readed<$this->dataSize) and ($this->data->readUByte()==0x1C))
      {
        $tagId=$this->data->readUShort();
        $tagLength=$this->data->readUShort();

        if($tagLength>0)
        {
          $tagValue=$this->data->readASCII($tagLength);
        }
        else
        {
          $tagValue="";
        }

        $this->readed+=$tagLength+5; // +5 => 3bytes for tag Id, 2bytes for tag length

        $tag=new Tag($tagId, $tagValue);
        $this->entries[]=$tag;
        unset($tag);
      }
    }

  }


?>
