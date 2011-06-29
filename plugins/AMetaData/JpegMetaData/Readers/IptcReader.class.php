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
 * The IptcReader class is the dedicated class to read IPTC from the APP13
 * segment
 *
 * The APP13 segment (the 'photoshop' segment) contain 8BIM blocks.
 * The IPTC are stored inside the specific 0x0404 block. If there is more than
 * one 8BIM 0x0404 block, the IptcReader reads all blocks and merge IPTC tags.
 *
 * =======> See HeightBIMReader.class.php to know more about 8BIM blocks <======
 *
 * -----------------------------------------------------------------------------
 *
 * .. Notes ..
 *
 * The IptcReader class is derived from the GenericReader class.
 *
 * ======> See GenericReader.class.php to know more about common methods <======
 *
 * This class provides theses public functions :
 *  - optimizeDateTime
 *
 * -----------------------------------------------------------------------------
 */

  require_once(JPEG_METADATA_DIR."Common/Data.class.php");
  require_once(JPEG_METADATA_DIR."Readers/HeightBIMReader.class.php");
  require_once(JPEG_METADATA_DIR."TagDefinitions/IptcTags.class.php");


  class IptcReader extends GenericReader
  {
    const HEADER_1 = "Photoshop 3.0\x00";
    const HEADER_2 = "Adobe_Photoshop2.5:\x00";
    protected $schema = Schemas::IPTC;

    private $header = "";

    /**
     * The constructor needs, like the ancestor, the datas to be parsed
     *
     * @param String $data
     */
    function __construct($data)
    {
      parent::__construct($data);

      /*
       * read the header
       * if header is a valid header, read entries
       */
      if($this->readHeader())
      {
        $this->initializeEntries();
      }
    }

    function __destruct()
    {
      parent::__destruct();
    }


    public function toString()
    {
      $returned="IPTC ; NbEntries: ".sprintf("%02d", $this->nbEntries);
      return($returned);
    }

    /**
     * All IPTC Date & Time are separated into distinct tags
     * this function complete "date" tags with the associated "time" tags, and
     * delete the "time" tags
     *
     * Example :
     *  0x146 "Date Sent" = 2009/12/24 => tag value : 2009/12/24 00:00:00
     *  0x150 "Time Sent" = 19:43:28   => tag value : 0001/01/01 19:43:28
     *
     * Optimize Date merge date & time => tag value : 2009/12/24 19:43:28
     *
     */
    public function optimizeDateTime()
    {
      $assoc=Array(
        Array(0x0146, 0x0150),
        Array(0x021E, 0x0223),
        Array(0x0225, 0x0226),
        Array(0x0237, 0x023C),
        Array(0x023E, 0x023F),
      );

      foreach($assoc as $val)
      {
        $tagD=$this->getTagIndexById($val[0]);
        $tagT=$this->getTagIndexById($val[1]);

        if($tagD>-1 and $tagT>-1)
        {
          /*
           * can't use the timestamp function because not compatible with php < 5.3
           */
          if($this->entries[$tagD]->getLabel() instanceof DateTime and
             $this->entries[$tagT]->getLabel() instanceof DateTime)
          {
            $this->entries[$tagD]->getLabel()->setTime(
              (int)$this->entries[$tagT]->getLabel()->format("H"),
              (int)$this->entries[$tagT]->getLabel()->format("i"),
              (int)$this->entries[$tagT]->getLabel()->format("s")
            );
          }
          array_splice($this->entries, $tagT, 1);
        }
        unset($tagD);
        unset($tagT);
      }
    }


    /**
     * initialize the definition for IPTC tags
     */
    protected function initializeTagDef()
    {
      $this->tagDef = new IptcTags();
    }

    /**
     * read the header of the APP13 segment, and try to determinate wich kind of
     * data are stored
     *
     * at now, only "Photoshop 3.0" data structure is known
     * the "Adobe_Photoshop2.5" data structure is not recognized yet
     *
     * @return Boolean : true if the header is known
     */
    private function readHeader()
    {
      $this->data->seek();
      $header=$this->data->readASCII(strlen(self::HEADER_1));
      if($header==self::HEADER_1)
      {
        $this->header=$header;
        return(true);
      }

      $this->data->seek();
      $header=$this->data->readASCII(strlen(self::HEADER_2));
      if($header==self::HEADER_2)
      {
        $this->header=$header;
        /*
         * structure from an HEADER_2 is not known....
         */
        return(false);
      }

      return(false);
    }

    /**
     * reads all the 8BIM blocks of the segment. If the 8BIM block is an IPTC
     * block, read all the IPTC entries and set the Tag properties
     *
     * An entry is a Tag object
     *
     * Add the entry to the entries array
     *
     */
    protected function initializeEntries()
    {
      $blocks=explode("8BIM", $this->data->readASCII());
      foreach($blocks as $key=> $val)
      {
        $block=new HeightBIMReader("8BIM".$val);
        if($block->isValid())
        {
          /* merge entries from all 8BIM blocks */
          $this->entries=array_merge($this->entries, $block->getTags());
        }
        unset($block);
      }
      unset($blocks);


      /* for each entries, convert value to human readable tag value
       *
       * repeatable values are stored in arrays
       *
       * for Subject Reference tags (0x020C), made derived tags (0x020Cnn)
       */
      $repeatableTags=array();
      foreach($this->entries as $key => $tag)
      {
        $this->setTagProperties($tag);

        $list=array();

        if($tag->getId()==0x020C)
        {
          $tmpValues=explode(':', $tag->getValue());
          $tmpLabels=explode(':', $tag->getLabel());

          $list=array(
            array(
              'id' => 0x020C,
              'value' => $tag->getValue(),
              'label' => $tag->getLabel(),
            ),
            array(
              'id' => 0x020C00,
              'value' => isset($tmpValues[0])?$tmpValues[0]:'',
              'label' => isset($tmpLabels[0])?$tmpLabels[0]:'',
            ),
            array(
              'id' => 0x020C01,
              'value' => isset($tmpValues[1])?$tmpValues[1]:'',
              'label' => isset($tmpLabels[1])?$tmpLabels[1]:'',
            ),
            array(
              'id' => 0x020C02,
              'value' => isset($tmpValues[2])?$tmpValues[2]:'',
              'label' => isset($tmpLabels[2])?$tmpLabels[2]:'',
            ),
            array(
              'id' => 0x020C03,
              'value' => isset($tmpValues[3])?$tmpValues[3]:'',
              'label' => isset($tmpLabels[3])?$tmpLabels[3]:'',
            ),
            array(
              'id' => 0x020C04,
              'value' => isset($tmpValues[4])?$tmpValues[4]:'',
              'label' => isset($tmpLabels[4])?$tmpLabels[4]:'',
            )
          );
        }
        else
        {
          $list=array(
            array(
              'id' => $tag->getId(),
              'value' => $tag->getValue(),
              'label' => $tag->getLabel(),
            )
          );
        }


        foreach($list as $tagItem)
        {
          $tagDef=$this->tagDef->getTagById($tagItem['id']);

          if($tagDef['repeatable'])
          {
            if(!array_key_exists($tagItem['id'], $repeatableTags))
            {
              $repeatableTags[$tagItem['id']]=new Tag(
                $tagItem['id'],
                array($tagItem['value']),
                $tagDef['tagName'],
                array($tagItem['label']),
                "",
                $tag->isKnown(),
                $tagDef['implemented'],
                $tagDef['translatable'],
                $tag->getSchema()
              );
            }
            else
            {
              $repeatableTags[$tagItem['id']]->setValue(array_merge($repeatableTags[$tagItem['id']]->getValue(), array($tagItem['value'])));
              $repeatableTags[$tagItem['id']]->setLabel(array_merge($repeatableTags[$tagItem['id']]->getLabel(), array($tagItem['label'])));
            }
          }
          unset($tagDef);
        }
        unset($tagId);
      }
      foreach($repeatableTags as $key => $tag)
      {
        /*
         * IPTC 'keywords' is stored like XMP 'xmp.dc:subject' (as a 'seq')
         */
        $repeatableTags[$key]->setValue(
          array(
            'type' => 'seq',
            'values' => $repeatableTags[$key]->getValue()
          )
        );

        $repeatableTags[$key]->setLabel(
          array(
            'type' => 'seq',
            'values' => $repeatableTags[$key]->getLabel()
          )
        );
        $this->entries[]=$repeatableTags[$key];
        unset($repeatableTags[$key]);
      }
      unset($repeatableTags);
    }

    /**
     * Interprets the tag values into 'human readable values'
     *
     * @param Tag $entry
     */
    private function setTagProperties($tag)
    {
      /*
       * if the given tag id is defined, analyzing its values
       */
      if($this->tagDef->tagIdExists($tag->getId()))
      {
        $tagProperties=$this->tagDef->getTagById($tag->getId());

        $tag->setKnown(true);
        $tag->setName($tagProperties['tagName']);
        $tag->setImplemented($tagProperties['implemented']);
        $tag->setTranslatable($tagProperties['translatable']);
        $tag->setSchema($this->schema);

        /*
         * if there is values defined for the tag, analyze it
         */
        if(array_key_exists('tagValues', $tagProperties))
        {
          if(array_key_exists($tag->getValue(), $tagProperties['tagValues']))
          {
            $tag->setLabel($tagProperties['tagValues'][$tag->getValue()]);
          }
          else
          {
            $tag->setLabel("[unknow value 0x".sprintf("%04x", $tag->getValue())."]");
          }
        }
        else
        {
          /*
           * there is no values defined for the tag, analyzing it with dedicated
           * function
           */
          $tag->setLabel($this->processSpecialTag($tag->getId(), $tag->getValue(), 0, 0));
        }
      }
    }

    /**
     * this function can be overrided to process special tags
     */
    protected function processSpecialTag($tagId, $values, $type, $valuesOffset=0)
    {
      switch($tagId)
      {
        /*
         * Tags managed
         */
        case 0x0105: // 2:05  - Destination
        case 0x011E: // 1:30  - Service Identifier
        case 0x0128: // 1:40  - Envelope Number
        case 0x0132: // 1:50  - Product I.D.
        case 0x0205: // 2:05  - Title
        case 0x0207: // 2:07  - Edit Status
        case 0x020C: // 2:12 - Subject Reference
        case 0x020F: // 2:15  - Category
        case 0x0214: // 2:20  - Supplemental Category
        case 0x0216: // 2:22  - Fixture Identifier
        case 0x0219: // 2:25  - Keywords
        case 0x021A: // 2:25  - Content Location Code
        case 0x021B: // 2:25  - Content Location Name
        case 0x0228: // 2:40  - Special Instructions
        case 0x0241: // 2:65  - Originating Program
        case 0x0246: // 2:70  - Program Version
        case 0x0250: // 2:80  - By-line
        case 0x0255: // 2:80  - By-line Title
        case 0x025A: // 2:90  - City
        case 0x025C: // 2:92  - Sublocation
        case 0x025F: // 2:95  - Province/State
        case 0x0264: // 2:100 - Country Code
        case 0x0265: // 2:101 - Country
        case 0x0267: // 2:103 - Original Transmission Reference
        case 0x0269: // 2:105 - Headline
        case 0x026E: // 2:110 - credit
        case 0x0273: // 2:115 - source
        case 0x0274: // 2:116 - Copyright Notice
        case 0x0276: // 2:118 - Contact
        case 0x0278: // 2:120 - Description
        case 0x027A: // 2:122 - Writer/Editor
        case 0x0287: // 2:150 - Language Identifier
          $returned=utf8_encode($values);
          break;
        case 0x0114: // 1:20  - File Format
          $tag=$this->tagDef->getTagById(0x0114);
          $tmpValue=ConvertData::toUShort($values, BYTE_ORDER_BIG_ENDIAN);
          if(array_key_exists($tmpValue, $tag['tagValues.special']))
          {
            $returned=$tag['tagValues.special'][$tmpValue];
          }
          else
          {
            $returned='Unknown file format : '.ConvertData::toHexDump($tmpValue, ByteType::USHORT);
          }
          unset($tag);
          break;
        case 0x0203: // 2:03  - Object Type Reference
        case 0x0204: // 2:04  - Intellectual Genre
          $returned=explode(":", $values);
          break;
        case 0x0146: // 1:70  - Date Sent
        case 0x021E: // 2:30  - Release Date
        case 0x0225: // 2:37  - Expiration Date
        case 0x0237: // 2:55  - Date Created
        case 0x023E: // 2:62  - Digital Creation Date
          $returned=ConvertData::toDateTime($values);
          break;
        case 0x0150: // 1:80  - Time Sent
        case 0x0223: // 2:35  - Release Time
        case 0x0226: // 2:38  - Expiration Time
        case 0x023C: // 2:60  - Time Created
        case 0x023F: // 2:63  - Digital Creation Time
          $returned=ConvertData::toDateTime("00010101T".$values);
          break;
        /*
         * Tags not managed
         */
        default:
          $returned="Not yet implemented;".ConvertData::toHexDump($tagId, ByteType::USHORT)." => ".ConvertData::toHexDump($values, $type, 64)." [$values]";
          break;
      }
      return($returned);
    }
  }




?>
