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
 * AMD_install : classe to manage plugin install
 * ---------------------------------------------------------------------------
 */

if (!defined('PHPWG_ROOT_PATH')) { die('Hacking attempt!'); }

include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/CommonPlugin.class.inc.php');
include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCCss.class.inc.php');
include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCRequestBuilder.class.inc.php');

include_once('amd_jpegmetadata.class.inc.php');
include_once(JPEG_METADATA_DIR."Common/L10n.class.php");
include_once(JPEG_METADATA_DIR."TagDefinitions/XmpTags.class.php");

class AMD_root extends CommonPlugin
{
  protected $css;   //the css object
  protected $jpegMD;

  public function __construct($prefixeTable, $filelocation)
  {
    global $user;
    $this->setPluginName("Advanced MetaData");
    $this->setPluginNameFiles("amd");
    parent::__construct($prefixeTable, $filelocation);

    $tableList=array(
      'used_tags',
      'images_tags',
      'images',
      'selected_tags',
      'groups_names',
      'groups',
      'user_tags_label',
      'user_tags_def',
      'tags_values');
    $this->setTablesList($tableList);

    $this->css = new GPCCss(dirname($this->getFileLocation()).'/'.$this->getPluginNameFiles().".css");
    $this->jpegMD=new AMD_JpegMetaData();

    if(isset($user['language']))
    {
      L10n::setLanguage($user['language']);
    }
  }

  public function __destruct()
  {
    unset($this->jpegMD);
    unset($this->css);
    //parent::__destruct();
  }

  /* ---------------------------------------------------------------------------
  common AIP & PIP functions
  --------------------------------------------------------------------------- */

  /* this function initialize var $config with default values */
  public function initConfig()
  {
    $this->config=array(
      // options set by the plugin interface - don't modify them manually
      'amd_GetListTags_OrderType' => "tag",
      'amd_GetListTags_FilterType' => "magic",
      'amd_GetListTags_ExcludeUnusedTag' => "y",
      'amd_GetListTags_SelectedTagOnly' => "n",
      'amd_GetListImages_OrderType' => "value",
      'amd_AllPicturesAreAnalyzed' => "n",
      'amd_FillDataBaseContinuously' => "y",
      'amd_FillDataBaseIgnoreSchemas' => array(),
      'amd_UseMetaFromHD' => "y",
      'amd_InterfaceMode' => "advanced",    // 'advanced' or 'basic'

      // theses options can be set manually
      'amd_NumberOfItemsPerRequest' => 25,
      'amd_DisplayWarningsMessageStatus' => "y",
      'amd_DisplayWarningsMessageUpdate' => "y",
      'amd_FillDataBaseExcludeTags' => array(),
      'amd_FillDataBaseExcludeFilters' => array(),
    );
    /*
     * ==> amd_FillDataBaseExcludeTags : array of tagId
     *     the listed tag are completely excluded by the plugin, as they don't
     *     exist
     *     for each tagId you can use generic char as the LIKE sql operator
     *      array('xmp.%', 'exif.maker.%')
     *        -> exclude all XMP and EXIF MAKER tags
     *
     * ==> amd_FillDataBaseExcludeFilters : array of filterValue
     *     if you exclude all the xmp tag you probably want to exclude everything
     *     displaying 'xmp'
     *     array('exif.maker',
     *           'exif',
     *           'iptc',
     *           'xmp',
     *           'magic',
     *           'com')
     *
     * ==> amd_DisplayWarningsMessageStatus : 'y' or 'n'
     *     amd_DisplayWarningsMessageUpdate
     *     you can disable warnings messages displayed on the database status&update
     *     page
     */
  }

  public function loadConfig()
  {
    parent::loadConfig();
  }

  public function initEvents()
  {
    parent::initEvents();
  }

  public function getAdminLink($mode='')
  {
    if($mode=='ajax')
    {
      return('plugins/'.basename(dirname($this->getFileLocation())).'/amd_ajax.php');
    }
    else
    {
      return(parent::getAdminLink());
    }
  }

  /**
   *
   */
  protected function configForTemplate()
  {
    global $template;

    $template->assign('amdConfig', $this->config);
  }

  /**
   * returns the number of pictures analyzed
   *
   * @return Integer
   */
  protected function getNumOfPictures()
  {
    $numOfPictures=0;
    $sql="SELECT COUNT(imageId) FROM ".$this->tables['images']."
            WHERE analyzed='y';";
    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_row($result))
      {
        $numOfPictures=$row[0];
      }
    }
    return($numOfPictures);
  }


  /**
   * this function randomly choose a picture in the list of pictures not
   * analyzed, and analyze it
   *
   */
  public function doRandomAnalyze()
  {
    $sql="SELECT tai.imageId, ti.path, ti.has_high FROM ".$this->tables['images']." tai
            LEFT JOIN ".IMAGES_TABLE." ti ON tai.imageId = ti.id
          WHERE tai.analyzed = 'n'
          ORDER BY RAND() LIMIT 1;";
    $result=pwg_query($sql);
    if($result)
    {
      // $path = path of piwigo's on the server filesystem
      $path=dirname(dirname(dirname(__FILE__)));

      while($row=pwg_db_fetch_assoc($result))
      {
        if($row['has_high']==='true' and $this->config['amd_UseMetaFromHD']=='y')
        {
          $this->analyzeImageFile($path."/".dirname($row['path'])."/pwg_high/".basename($row['path']), $row['imageId']);
        }
        else
        {
          $this->analyzeImageFile($path."/".$row['path'], $row['imageId']);
        }
      }

      $this->makeStatsConsolidation();
    }
  }


  /**
   * this function analyze tags from a picture, and insert the result into the
   * database
   *
   * NOTE : only implemented tags are analyzed and stored
   *
   * @param String $fileName : filename of picture to analyze
   * @param Integer $imageId : id of image in piwigo's database
   * @param Boolean $loaded  : default = false
   *                            WARNING
   *                            if $loaded is set to TRUE, the function assume
   *                            that the metadata have been alreay loaded
   *                            do not use the TRUE value if you are not sure
   *                            of the consequences
   */
  protected function analyzeImageFile($fileName, $imageId, $loaded=false)
  {
    $schemas=array_flip($this->config['amd_FillDataBaseIgnoreSchemas']);
    /*
     * the JpegMetaData object is instancied in the constructor
     */
    if(!$loaded)
    {
      $this->jpegMD->load(
        $fileName,
        Array(
          'filter' => AMD_JpegMetaData::TAGFILTER_IMPLEMENTED,
          'optimizeIptcDateTime' => true,
          'exif' => !isset($schemas['exif']),
          'iptc' => !isset($schemas['iptc']),
          'xmp' => !isset($schemas['xmp']),
          'magic' => !isset($schemas['magic']),
          'com' => !isset($schemas['com']),
        )
      );
    }

    //$sqlInsert="";
    $massInsert=array();
    $nbTags=0;
    foreach($this->jpegMD->getTags() as $key => $val)
    {
      $value=$val->getLabel();

      if($val->isTranslatable())
        $translatable="y";
      else
        $translatable="n";

      if($value instanceof DateTime)
      {
        $value=$value->format("Y-m-d H:i:s");
      }
      elseif(is_array($value))
      {
        /*
         * array values are stored in a serialized string
         */
        $value=serialize($value);
      }

      $sql="SELECT numId FROM ".$this->tables['used_tags']." WHERE tagId = '$key'";

      $result=pwg_query($sql);
      if($result)
      {
        $numId=-1;
        while($row=pwg_db_fetch_assoc($result))
        {
          $numId=$row['numId'];
        }

        if($numId>0)
        {
          $nbTags++;
          //if($sqlInsert!="") $sqlInsert.=", ";
          //$sqlInsert.="($imageId, '$numId', '".addslashes($value)."')";
          $massInsert[]="('$imageId', '$numId', '".mysql_escape_string($value)."') ";
        }
      }
    }

    if(count($massInsert)>0)
    {
      $sql="REPLACE INTO ".$this->tables['images_tags']." (imageId, numId, value) VALUES ".implode(", ", $massInsert).";";
      pwg_query($sql);
    }
    //mass_inserts($this->tables['images_tags'], array('imageId', 'numId', 'value'), $massInsert);

    $sql="UPDATE ".$this->tables['images']."
            SET analyzed = 'y', nbTags=".$nbTags."
            WHERE imageId=$imageId;";
    pwg_query($sql);

    unset($massInsert);

    return("$imageId=$nbTags;");
  }


  /**
   * returns the userDefined tag for one image (without searching in the
   * database)
   *
   * @param Array $numId : array of userDefined numId to get
   * @param Array $values : array of existing tag for the images
   * @return Array : associated array of numId=>value
   */
  protected function pictureGetUserDefinedTags($listId, $values)
  {
    if(count($listId)==0 or count($values)==0) return(array());

    $listIds=implode(',', $listId);
    $rules=array();
    $returned=array();

    $sql="SELECT numId, defId, parentId, `order`, `type`, value, conditionType, conditionValue
          FROM ".$this->tables['user_tags_def']."
          WHERE numId IN ($listIds)
          ORDER BY numId, parentId, `order`;";
    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_assoc($result))
      {
        $rules[$row['numId']][$row['parentId']][$row['defId']]=$row;
      }
    }

    foreach($listId as $numId)
    {
      $returned[$numId]=$this->buildUserDefinedTagConditionRule(0, $values, $rules[$numId]);
    }

    return($returned);
  }

  /**
   *
   * @param String $id : id of the metadata to build
   */
  protected function buildUserDefinedTags($id)
  {
    $num=0;
    $sql="SELECT GROUP_CONCAT(DISTINCT value ORDER BY value SEPARATOR ',')
          FROM ".$this->tables['user_tags_def']."
          WHERE `type`='C' or `type`='M'
            AND numId='$id'";
    $result=pwg_query($sql);
    if($result)
    {
      // get the list of tags used to build the user defined tag
      $list='';
      while($row=pwg_db_fetch_row($result))
      {
        $list=$row[0];
      }

      $sql="(SELECT ait.imageId, ait.numId, ait.value
             FROM ".$this->tables['images_tags']." ait
             WHERE ait.numId IN ($list)
            )
            UNION
            (SELECT pai.imageId, 0, ''
            FROM ".$this->tables['images']." pai)
            ORDER BY imageId, numId";
      $result=pwg_query($sql);
      if($result)
      {
        //build a list of properties for each image
        $images=array();
        while($row=pwg_db_fetch_assoc($result))
        {
          if(!array_key_exists($row['imageId'], $images))
          {
            $images[$row['imageId']]=array();
          }
          $images[$row['imageId']][$row['numId']]=$row['value'];
        }

        //load the rules
        $sql="SELECT defId, parentId, `order`, `type`, value, conditionType, conditionValue
              FROM ".$this->tables['user_tags_def']."
              WHERE numId='$id'
              ORDER BY parentId, `order`;";
        $result=pwg_query($sql);
        if($result)
        {
          $rules=array();
          while($row=pwg_db_fetch_assoc($result))
          {
            $rules[$row['parentId']][$row['defId']]=$row;
          }

          $inserts=array();
          // calculate tag values for each image
          foreach($images as $key=>$val)
          {
            $buildValue=$this->buildUserDefinedTag($key, $val, $id, $rules);

            if(!is_null($buildValue['value']))
            {
              $buildValue['value']=addslashes($buildValue['value']);
              $inserts[]=$buildValue;
              $num++;
            }
          }

          mass_inserts($this->tables['images_tags'], array('imageId', 'numId', 'value'), $inserts);
        }
      }
    }
    return($num);
  }


  /**
   * build the userDefined tag for an image
   *
   * @param String $imageId : id of the image
   * @param Array $values : array of existing tag for the images
   * @param String $numId : id of the metadata to build
   * @param Array $rules  : rules to apply to build the metadata
   */
  protected function buildUserDefinedTag($imageId, $values, $numId, $rules)
  {
    $returned=array(
      'imageId' => $imageId,
      'numId' => $numId,
      'value' => $this->buildUserDefinedTagConditionRule(0, $values, $rules)
    );

    return($returned);
  }


  /**
   * build the userDefined tag for an image
   *
   * @param String $imageId : id of the image
   * @param Array $values : array of existing tag for the images
   * @param String $numId : id of the metadata to build
   * @param Array $rules  : rules to apply to build the metadata
   */
  protected function buildUserDefinedTagConditionRule($parentId, $values, $rules)
  {
    $null=true;
    $returned='';
    foreach($rules[$parentId] as $rule)
    {
      switch($rule['type'])
      {
        case 'T':
          $returned.=$rule['value'];
          $null=false;
          break;
        case 'M':
          if(isset($values[$rule['value']]))
          {
            $returned.=$values[$rule['value']];
            $null=false;
          }
          break;
        case 'C':
          $ok=false;
          switch($rule['conditionType'])
          {
            case 'E':
              if(isset($values[$rule['value']])) $ok=true;
              break;
            case '!E':
              if(!isset($values[$rule['value']])) $ok=true;
              break;
            case '=':
              if(isset($values[$rule['value']]) and
                 $values[$rule['value']]==$rule['conditionValue']) $ok=true;
              break;
            case '!=':
              if(isset($values[$rule['value']]) and
                 $values[$rule['value']]!=$rule['conditionValue']) $ok=true;
              break;
            case '%':
              if(isset($values[$rule['value']]) and
                 preg_match('/'.$rule['conditionValue'].'/i', $values[$rule['value']])) $ok=true;
              break;
            case '!%':
              if(isset($values[$rule['value']]) and
                 !preg_match('/'.$rule['conditionValue'].'/i', $values[$rule['value']])) $ok=true;
              break;
            case '^%':
              if(isset($values[$rule['value']]) and
                 preg_match('/^'.$rule['conditionValue'].'/i', $values[$rule['value']])) $ok=true;
              break;
            case '!^%':
              if(isset($values[$rule['value']]) and
                 !preg_match('/^'.$rule['conditionValue'].'/i', $values[$rule['value']])) $ok=true;
              break;
            case '$%':
              if(isset($values[$rule['value']]) and
                 preg_match('/'.$rule['conditionValue'].'$/i', $values[$rule['value']])) $ok=true;
              break;
            case '!$%':
              if(isset($values[$rule['value']]) and
                 !preg_match('/'.$rule['conditionValue'].'$/i', $values[$rule['value']])) $ok=true;
              break;
          }
          if($ok)
          {
            $subRule=$this->buildUserDefinedTagConditionRule($rule['defId'], $values, $rules);
            if(!is_null($subRule))
            {
              $null=false;
              $returned.=$subRule;
            }
          }
          break;
      }
    }
    if($null)
    {
      return(null);
    }
    return($returned);
  }




  /**
   * do some consolidations on database to optimize other requests
   *
   */
  protected function makeStatsConsolidation()
  {
    // reset numbers
    $sql="UPDATE ".$this->tables['used_tags']." ut
          SET ut.numOfImg = 0;";
    pwg_query($sql);

    $sql="UPDATE ".$this->tables['images']." pai
          SET pai.nbTags = 0;";
    pwg_query($sql);


    // count number of images per tag
    $sql="UPDATE ".$this->tables['used_tags']." ut,
            (SELECT COUNT(DISTINCT imageId) AS nb, numId
              FROM ".$this->tables['images_tags']."
              GROUP BY numId) nb
          SET ut.numOfImg = nb.nb
          WHERE ut.numId = nb.numId;";
    pwg_query($sql);

    //count number of tags per images
    $sql="UPDATE ".$this->tables['images']." pai,
            (SELECT COUNT(DISTINCT numId) AS nb, imageId
              FROM ".$this->tables['images_tags']."
              GROUP BY imageId) nb
          SET pai.nbTags = nb.nb
          WHERE pai.imageId = nb.imageId;";
    pwg_query($sql);


    $sql="SELECT COUNT(imageId) AS nb
          FROM ".$this->tables['images']."
          WHERE analyzed = 'n';";
    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_assoc($result))
      {
        $this->config['amd_AllPicturesAreAnalyzed']=($row['nb']==0)?'y':'n';
      }

    }

    $sql="UPDATE ".$this->tables['used_tags']." ut
          SET ut.newFromLastUpdate = 'n'
          WHERE ut.newFromLastUpdate = 'y';";
    pwg_query($sql);

    $this->saveConfig();
  }

  /**
   * This function :
   *  - convert arrays (stored as a serialized string) into human readable string
   *  - translate value in user language (if value is translatable)
   *
   * @param String $value         : value to prepare
   * @param Boolean $translatable : set to tru if the value can be translated in
   *                                the user language
   * @param String $separator     : separator for arrays items
   * @return String               : the value prepared
   */
  static public function prepareValueForDisplay($value, $translatable=true, $separator=", ")
  {
    global $user;

    if(preg_match('/^a:\d+:\{.*\}$/is', $value))
    {
      // $value is a serialized array
      $tmp=unserialize($value);

      if(count($tmp)==0)
      {
        return(L10n::get("Unknown"));
      }

      if(array_key_exists("computed", $tmp) and array_key_exists("detail", $tmp))
      {
        /* keys 'computed' and 'detail' are present
         *
         * assume this is the 'exif.exif.Flash' metadata and return the computed
         * value only
         */
        return(L10n::get($tmp['computed']));
      }
      elseif(array_key_exists("type", $tmp) and array_key_exists("values", $tmp))
      {
        /* keys 'computed' and 'detail' are present
         *
         * assume this is an Xmp 'ALT', 'BAG' or 'SEQ' metadata and return the
         * values only
         */
        if($tmp['type']=='alt')
        {
          /* 'ALT' structure
           *
           * ==> assuming the structure is used only for multi language values
           *
           * Array(
           *    'type'   => 'ALT'
           *    'values' =>
           *        Array(
           *            Array(
           *                'type'  => Array(
           *                            'name'  =>'xml:lang',
           *                            'value' => ''           // language code
           *                           )
           *               'value' => ''         //value in the defined language
           *            ),
           *
           *            Array(
           *                // data2
           *            ),
           *
           *        )
           * )
           */
          $tmp=XmpTags::getAltValue($tmp, $user['language']);
          if(trim($tmp)=="") $tmp="(".L10n::get("not defined").")";

          return($tmp);
        }
        else
        {
          /* 'SEQ' or 'BAG' structure
           *
           *  Array(
           *    'type'   => 'XXX',
           *    'values' => Array(val1, val2, .., valN)
           *  )
           */
          $tmp=$tmp['values'];

          if(trim(implode("", $tmp))=="")
          {
            return("(".L10n::get("not defined").")");
          }
        }
      }


      foreach($tmp as $key=>$val)
      {
        if(is_array($val))
        {
          if($translatable)
          {
            foreach($val as $key2=>$val2)
            {
              $tmp[$key][$key2]=L10n::get($val2);
            }
            if(count($val)>0)
            {
              $tmp[$key]="[".implode($separator, $val)."]";
            }
            else
            {
              unset($tmp[$key]);
            }
          }
        }
        else
        {
          if($translatable)
          {
            $tmp[$key]=L10n::get($val);
          }
        }
      }
      return(implode($separator, $tmp));
    }
    elseif(preg_match('/\d{1,3}°\s\d{1,2}\'\s(\d{1,2}\.{0,1}\d{0,2}){0,1}.,\s(north|south|east|west)$/i', $value))
    {
      /* \d{1,3}°\s\d{1,2}\'\s(\d{1,2}\.{0,1}\d{0,2}){0,1}.
       *
       * keys 'coord' and 'card' are present
       *
       * assume this is a GPS coordinate
       */
        return(preg_replace(
          Array('/, north$/i', '/, south$/i', '/, east$/i', '/, west$/i'),
          Array(" ".L10n::get("North"), " ".L10n::get("South"), " ".L10n::get("East"), " ".L10n::get("West")),
          $value)
        );
    }
    else
    {
      if(trim($value)=="")
      {
        return("(".L10n::get("not defined").")");
      }

      if(strpos($value, "|")>0)
      {
        $value=explode("|", $value);
        if($translatable)
        {
          foreach($value as $key=>$val)
          {
            $value[$key]=L10n::get($val);
          }
        }
        return(implode("", $value));
      }

      if($translatable)
      {
        return(L10n::get($value));
      }
      return($value);
    }
  }


} // amd_root  class



Class AMD_functions {
  /**
   *  return all HTML&JS code necessary to display a dialogbox to choose
   *  a metadata
   */
  static public function dialogBoxMetadata()
  {
    global $template, $prefixeTable;

    $tables=array(
        'used_tags' => $prefixeTable.'amd_used_tags',
        'selected_tags' => $prefixeTable.'amd_selected_tags',
    );

    $template->set_filename('metadata_choose',
                  dirname(__FILE__).'/templates/amd_dialog_metadata_choose.tpl');

    $datas=array(
      'urlRequest' => 'plugins/'.basename(dirname(__FILE__)).'/amd_ajax.php',
      'tagList' => array(),
    );

    /*
     * build tagList
     */
    $sql="SELECT ut.name, ut.numId, ut.tagId
          FROM ".$tables['used_tags']." ut
            JOIN ".$tables['selected_tags']." st ON st.tagId = ut.tagId
          ORDER BY tagId";
    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_assoc($result))
      {
        $datas['tagList'][]=Array(
          'tagId' => $row['tagId'],
          'name'  => L10n::get($row['name']),
          'numId' => $row['numId']
        );
      }
    }

    $template->assign('datas', $datas);
    unset($data);

    return($template->parse('metadata_choose', true));
  }
}



?>
