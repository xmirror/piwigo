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
 * manage all the ajax requests
 * -----------------------------------------------------------------------------
 */

  define('PHPWG_ROOT_PATH',dirname(dirname(dirname(__FILE__))).'/');

  /*
   * set ajax module in admin mode if request is used for admin interface
   */
  if(!isset($_REQUEST['ajaxfct'])) $_REQUEST['ajaxfct']='';
  if(preg_match('/^admin\./i', $_REQUEST['ajaxfct']))
  {
    define('IN_ADMIN', true);
  }

  // the common.inc.php file loads all the main.inc.php plugins files
  include_once(PHPWG_ROOT_PATH.'include/common.inc.php' );
  include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCAjax.class.inc.php');
  include_once('amd_root.class.inc.php');

  load_language('plugin.lang', AMD_PATH);


  class AMD_ajax extends AMD_root
  {
    private $tagSeparators=array(
      'xmp.digiKam:TagsList' => '/',
      'xmp.lr:hierarchicalSubject' => '|'
    );

    /**
     * constructor
     */
    public function __construct($prefixeTable, $filelocation)
    {
      parent::__construct($prefixeTable, $filelocation);
      $this->loadConfig();
      $this->checkRequest();
      $this->returnAjaxContent();
    }

    /**
     * check the $_REQUEST values and set default values
     *
     */
    protected function checkRequest()
    {
      global $user;

      if(!isset($_REQUEST['ajaxfct'])) $_REQUEST['ajaxfct']='';

      // check if asked function is valid
      if(!(
           $_REQUEST['ajaxfct']=='admin.makeStats.getList' or
           $_REQUEST['ajaxfct']=='admin.makeStats.doAnalyze' or
           $_REQUEST['ajaxfct']=='admin.makeStats.consolidate' or
           $_REQUEST['ajaxfct']=='admin.showStats.getListTags' or
           $_REQUEST['ajaxfct']=='admin.showStats.getListImages' or
           $_REQUEST['ajaxfct']=='admin.updateTag.select' or
           $_REQUEST['ajaxfct']=='admin.config.setOption' or
           $_REQUEST['ajaxfct']=='admin.group.getList' or
           $_REQUEST['ajaxfct']=='admin.group.delete' or
           $_REQUEST['ajaxfct']=='admin.group.getNames' or
           $_REQUEST['ajaxfct']=='admin.group.setNames' or
           $_REQUEST['ajaxfct']=='admin.group.setOrder' or
           $_REQUEST['ajaxfct']=='admin.group.getTagList' or
           $_REQUEST['ajaxfct']=='admin.group.setTagList' or
           $_REQUEST['ajaxfct']=='admin.group.getOrderedTagList' or
           $_REQUEST['ajaxfct']=='admin.group.setOrderedTagList' or
           $_REQUEST['ajaxfct']=='admin.userDefined.getList' or
           $_REQUEST['ajaxfct']=='admin.userDefined.getTag' or
           $_REQUEST['ajaxfct']=='admin.userDefined.setTag' or
           $_REQUEST['ajaxfct']=='admin.userDefined.deleteTag' or
           $_REQUEST['ajaxfct']=='admin.tag.getValues' or
           $_REQUEST['ajaxfct']=='admin.tags.getKeywords' or
           $_REQUEST['ajaxfct']=='admin.tags.convertKeywords' or

           $_REQUEST['ajaxfct']=='public.makeStats.doPictureAnalyze')) $_REQUEST['ajaxfct']='';

      if(preg_match('/^admin\./i', $_REQUEST['ajaxfct']) and !is_admin()) $_REQUEST['ajaxfct']='';

      if($_REQUEST['ajaxfct']!='')
      {
        /*
         * check admin.makeStats.getList values
         */
        if($_REQUEST['ajaxfct']=="admin.makeStats.getList")
        {
          if(!isset($_REQUEST['selectMode'])) $_REQUEST['selectMode']="caddieAdd";

          if(!($_REQUEST['selectMode']=="notAnalyzed" or
               $_REQUEST['selectMode']=="caddieAdd" or
               $_REQUEST['selectMode']=="caddieReplace" or
               $_REQUEST['selectMode']=="analyzed" or
               $_REQUEST['selectMode']=="randomList" or
               $_REQUEST['selectMode']=="all")) $_REQUEST['selectMode']="caddieAdd";

          if($_REQUEST['selectMode']=="randomList" and
              (!isset($_REQUEST['numOfRandomItems']) or
               $_REQUEST['numOfRandomItems']<=0 or
               preg_match('/^\d+$/', $_REQUEST['numOfRandomItems'])==0
              )
            ) $_REQUEST['ajaxfct']='';


          if(!isset($_REQUEST['numOfItems'])) $_REQUEST['numOfItems']=25;

          if(!isset($_REQUEST['ignoreOptions'])) $_REQUEST['ignoreOptions']=array();
        }

        /*
         * check admin.makeStats.doAnalyze values
         */
        if($_REQUEST['ajaxfct']=="admin.makeStats.doAnalyze")
        {
          if(!isset($_REQUEST['imagesList'])) $_REQUEST['imagesList']="";
        }

        /*
         * check admin.makeStats.consolidate values
         */
        if($_REQUEST['ajaxfct']=="admin.makeStats.consolidate")
        {
          if(!isset($_REQUEST['step'])) $_REQUEST['step']="*";
        }

        /*
         * check admin.showStats.getListTags values
         */
        if($_REQUEST['ajaxfct']=="admin.showStats.getListTags")
        {
          if(!isset($_REQUEST['orderType'])) $_REQUEST['orderType']="tag";

          if(!($_REQUEST['orderType']=="tag" or
               $_REQUEST['orderType']=="label" or
               $_REQUEST['orderType']=="num")) $_REQUEST['orderType']="tag";

          if(!isset($_REQUEST['filterType'])) $_REQUEST['filterType']="";

          if(!($_REQUEST['filterType']=="" or
               ($_REQUEST['filterType']=="magic" and !in_array('magic', $this->config['amd_FillDataBaseExcludeFilters'])) or
               $_REQUEST['filterType']=="userDefined" or
               ($_REQUEST['filterType']=="exif" and !in_array('exif', $this->config['amd_FillDataBaseExcludeFilters'])) or
               ($_REQUEST['filterType']=="exif.maker.Canon" and !in_array('maker', $this->config['amd_FillDataBaseExcludeFilters'])) or
               ($_REQUEST['filterType']=="exif.maker.Nikon" and !in_array('maker', $this->config['amd_FillDataBaseExcludeFilters'])) or
               ($_REQUEST['filterType']=="exif.maker.Pentax" and !in_array('maker', $this->config['amd_FillDataBaseExcludeFilters'])) or
               ($_REQUEST['filterType']=="xmp" and !in_array('xmp', $this->config['amd_FillDataBaseExcludeFilters'])) or
               ($_REQUEST['filterType']=="iptc"  and !in_array('iptc', $this->config['amd_FillDataBaseExcludeFilters'])) or
               ($_REQUEST['filterType']=="com"  and !in_array('com', $this->config['amd_FillDataBaseExcludeFilters']))
               )) $_REQUEST['filterType']="";

          if(!isset($_REQUEST['excludeUnusedTag'])) $_REQUEST['excludeUnusedTag']="n";

          if(!($_REQUEST['excludeUnusedTag']=="y" or
               $_REQUEST['excludeUnusedTag']=="n" )) $_REQUEST['excludeUnusedTag']="n";

          if(!isset($_REQUEST['selectedTagOnly'])) $_REQUEST['selectedTagOnly']="n";

          if(!($_REQUEST['selectedTagOnly']=="y" or
               $_REQUEST['selectedTagOnly']=="n" )) $_REQUEST['selectedTagOnly']="n";
        }

        /*
         * check admin.showStats.getListImages values
         */
        if($_REQUEST['ajaxfct']=="admin.showStats.getListImages")
        {
          if(!isset($_REQUEST['orderType'])) $_REQUEST['orderType']="num";

          if(!($_REQUEST['orderType']=="value" or
               $_REQUEST['orderType']=="num")) $_REQUEST['orderType']="num";

          if(!isset($_REQUEST['tagId'])) $_REQUEST['tagId']="*";
        }

        /*
         * check admin.updateTag.select values
         */
        if($_REQUEST['ajaxfct']=="admin.updateTag.select")
        {
          if(!isset($_REQUEST['numId'])) $_REQUEST['numId']="";

          if(!isset($_REQUEST['tagSelected'])) $_REQUEST['tagSelected']="";
        }

        /*
         * check admin.config.setOption values
         */
        if($_REQUEST['ajaxfct']=="admin.config.setOption")
        {
          if(!isset($_REQUEST['id'])) $_REQUEST['ajaxfct']='';
          if(!isset($_REQUEST['value'])) $_REQUEST['ajaxfct']='';
        }

        /*
         * check admin.group.delete values
         */
        if($_REQUEST['ajaxfct']=="admin.group.delete" and !isset($_REQUEST['id']))
        {
          $_REQUEST['id']="";
        }

        /*
         * check admin.groupSetOrder values
         */
        if($_REQUEST['ajaxfct']=="admin.group.setOrder" and !isset($_REQUEST['listGroup']))
        {
          $_REQUEST['listGroup']="";
        }

        /*
         * check admin.group.getNames values
         */
        if($_REQUEST['ajaxfct']=="admin.group.getNames" and !isset($_REQUEST['id']))
        {
          $_REQUEST['id']="";
        }

        /*
         * check admin.group.setNames values
         */
        if($_REQUEST['ajaxfct']=="admin.group.setNames")
        {
          if(!isset($_REQUEST['listNames'])) $_REQUEST['listNames']="";

          if(!isset($_REQUEST['id'])) $_REQUEST['id']="";
        }

        /*
         * check admin.group.getTagList values
         */
        if($_REQUEST['ajaxfct']=="admin.group.getTagList" and !isset($_REQUEST['id']))
        {
          $_REQUEST['id']="";
        }

        /*
         * check admin.group.setTagList values
         */
        if($_REQUEST['ajaxfct']=="admin.group.setTagList")
        {
          if(!isset($_REQUEST['id'])) $_REQUEST['id']="";

          if(!isset($_REQUEST['listTag'])) $_REQUEST['listTag']="";
        }

        /*
         * check admin.group.getOrderedTagList values
         */
        if($_REQUEST['ajaxfct']=="admin.group.getOrderedTagList" and !isset($_REQUEST['id']))
        {
          $_REQUEST['id']="";
        }

        /*
         * check admin.group.setOrderedTagList values
         */
        if($_REQUEST['ajaxfct']=="admin.group.setOrderedTagList")
        {
          if(!isset($_REQUEST['id'])) $_REQUEST['id']="";

          if(!isset($_REQUEST['listTag'])) $_REQUEST['listTag']="";
        }

        /*
         * check admin.userDefined.getTag values
         */
        if($_REQUEST['ajaxfct']=="admin.userDefined.getTag" and !isset($_REQUEST['id']))
        {
          $_REQUEST['id']="";
        }

        /*
         * check admin.userDefined.setTag values
         */
        if($_REQUEST['ajaxfct']=="admin.userDefined.setTag")
        {
          if(!isset($_REQUEST['id'])) $_REQUEST['id']="";
          if($_REQUEST['id']!='' and !preg_match('/\d+/', $_REQUEST['id'])) $_REQUEST['id']="";

          if(!isset($_REQUEST['properties']) or
              (isset($_REQUEST['properties']) and
               !(isset($_REQUEST['properties']['name']) and
                 isset($_REQUEST['properties']['rules']) and
                 isset($_REQUEST['properties']['tagId'])
                )
              )
            ) $_REQUEST['ajaxfct']='';

          if(isset($_REQUEST['properties']['rules']))
          {
            foreach($_REQUEST['properties']['rules'] as $val)
            {
              if(!(isset($val['order']) and
                   isset($val['value']) and
                   isset($val['parentId']) and
                   isset($val['type']) and
                   isset($val['defId']))) $_REQUEST['ajaxfct']='';
            }
          }
        }

        /*
         * check admin.userDefined.deleteTag values
         */
        if($_REQUEST['ajaxfct']=="admin.userDefined.deleteTag" and !isset($_REQUEST['id']))
        {
          $_REQUEST['id']="";
        }


        /*
         * check admin.tag.getValues values
         */
        if($_REQUEST['ajaxfct']=="admin.tag.getValues" and !isset($_REQUEST['id']))
        {
          $_REQUEST['ajaxfct']='';
        }

        /*
         * check admin.tags.convertKeywords values
         */
        if($_REQUEST['ajaxfct']=="admin.tags.convertKeywords")
        {
          if(!isset($_REQUEST['keywords'])) $_REQUEST['keywords']=array();
          if(!is_array($_REQUEST['keywords'])) $_REQUEST['keywords']=array();
          if(count($_REQUEST['keywords'])==0) $_REQUEST['ajaxfct']='';
        }





        /*
         * check public.makeStats.doPictureAnalyze values
         */
        if($_REQUEST['ajaxfct']=="public.makeStats.doPictureAnalyze")
        {
          if(!isset($_REQUEST['id'])) $_REQUEST['id']="0";
        }
      }
    }


    /**
     * return ajax content
     */
    protected function returnAjaxContent()
    {
      $result="<p class='errors'>An error has occured</p>";
      switch($_REQUEST['ajaxfct'])
      {
        case 'admin.makeStats.getList':
          $result=$this->ajax_amd_admin_makeStatsGetList($_REQUEST['selectMode'], $_REQUEST['numOfItems'], $_REQUEST['ignoreOptions'], $_REQUEST['numOfRandomItems']);
          break;
        case 'admin.makeStats.doAnalyze':
          $result=$this->ajax_amd_admin_makeStatsDoAnalyze($_REQUEST['imagesList']);
          break;
        case 'admin.makeStats.consolidate':
          $result=$this->ajax_amd_admin_makeStatsConsolidate();
          break;
        case 'admin.showStats.getListTags':
          $result=$this->ajax_amd_admin_showStatsGetListTags($_REQUEST['orderType'], $_REQUEST['filterType'], $_REQUEST['excludeUnusedTag'], $_REQUEST['selectedTagOnly']);
          break;
        case 'admin.showStats.getListImages':
          $result=$this->ajax_amd_admin_showStatsGetListImages($_REQUEST['tagId'], $_REQUEST['orderType']);
          break;
        case 'admin.updateTag.select':
          $result=$this->ajax_amd_admin_updateTagSelect($_REQUEST['numId'], $_REQUEST['tagSelected']);
          break;
        case 'admin.config.setOption':
          $result=$this->ajax_amd_admin_configSetOption($_REQUEST['id'], $_REQUEST['value']);
          break;
        case 'admin.group.getList':
          $result=$this->ajax_amd_admin_groupGetList();
          break;
        case 'admin.group.delete':
          $result=$this->ajax_amd_admin_groupDelete($_REQUEST['id']);
          break;
        case 'admin.group.getNames':
          $result=$this->ajax_amd_admin_groupGetNames($_REQUEST['id']);
          break;
        case 'admin.group.setNames':
          $result=$this->ajax_amd_admin_groupSetNames($_REQUEST['id'], $_REQUEST['listNames']);
          break;
        case 'admin.group.setOrder':
          $result=$this->ajax_amd_admin_groupSetOrder($_REQUEST['listGroup']);
          break;
        case 'admin.group.getTagList':
          $result=$this->ajax_amd_admin_groupGetTagList($_REQUEST['id']);
          break;
        case 'admin.group.setTagList':
          $result=$this->ajax_amd_admin_groupSetTagList($_REQUEST['id'], $_REQUEST['listTag']);
          break;
        case 'admin.group.getOrderedTagList':
          $result=$this->ajax_amd_admin_groupGetOrderedTagList($_REQUEST['id']);
          break;
        case 'admin.group.setOrderedTagList':
          $result=$this->ajax_amd_admin_groupSetOrderedTagList($_REQUEST['id'], $_REQUEST['listTag']);
          break;
        case 'admin.userDefined.getList':
          $result=$this->ajax_amd_admin_userDefinedGetList();
          break;
        case 'admin.userDefined.getTag':
          $result=$this->ajax_amd_admin_userDefinedGetTag($_REQUEST['id']);
          break;
        case 'admin.userDefined.setTag':
          $result=$this->ajax_amd_admin_userDefinedSetTag($_REQUEST['id'], $_REQUEST['properties']);
          break;
        case 'admin.userDefined.deleteTag':
          $result=$this->ajax_amd_admin_userDefinedDeleteTag($_REQUEST['id']);
          break;
        case 'admin.tag.getValues':
          $result=$this->ajax_amd_admin_tagGetValues($_REQUEST['id']);
          break;
        case 'admin.tags.getKeywords':
          $result=$this->ajax_amd_admin_tagsGetKeywords();
          break;
        case 'admin.tags.convertKeywords':
          $result=$this->ajax_amd_admin_tagsConvertKeywords($_REQUEST['keywords']);
          break;


        case 'public.makeStats.doPictureAnalyze':
          $result=$this->ajax_amd_public_makeStatsDoPictureAnalyze($_REQUEST['id']);
          break;
      }
      GPCAjax::returnResult($result);
    }

    /*------------------------------------------------------------------------*
     *
     * PUBLIC FUNCTIONS
     *
     *----------------------------------------------------------------------- */
    private function ajax_amd_public_makeStatsDoPictureAnalyze($imageId)
    {
      if($imageId==0)
      {
        // get a randomly picture...
        $sql="SELECT pai.imageId, pi.path, pi.has_high
              FROM ".$this->tables['images']." pai
                LEFT JOIN ".IMAGES_TABLE." pi ON pai.imageId=pi.id
              WHERE analyzed='n'
              ORDER BY RAND() LIMIT 1;";
      }
      else
      {
        $sql="SELECT path, id AS imageId
              FROM ".IMAGES_TABLE."
              WHERE id='$imageId';";
      }

      $result=pwg_query($sql);
      if($result)
      {
        $path=dirname(dirname(dirname(__FILE__)));
        while($row=pwg_db_fetch_assoc($result))
        {
          $imageId=$row['imageId'];
          if($row['has_high']==='true' and $this->config['amd_UseMetaFromHD']=='y')
          {
            $filename=$path."/".dirname($row['path'])."/pwg_high/".basename($row['path']);
          }
          else
          {
            $filename=$path."/".$row['path'];
          }
        }

        $this->analyzeImageFile($filename, $imageId);
        $this->makeStatsConsolidation();

        return("Analyze of image #$imageId is a success !");
      }

      return("Try to analyze image #$imageId failed...");

    }



    /*------------------------------------------------------------------------*
     *
     * ADMIN FUNCTIONS
     *
     *----------------------------------------------------------------------- */

    /**
     * return a list of picture Id
     *
     * picture id are separated with a space " "
     * picture id are grouped in blocks of 'amd_NumberOfItemsPerRequest' items and
     * are separated with a semi-colon ";"
     *
     * client side just have to split blocks, and transmit it to the server
     *
     * There is two mode to determine the pictures being analyzed :
     *  - "all"         : analyze all the images
     *  - "notAnalyzed" : analyze only the images not yet analyzed
     *
     * @param String $mode
     * @param Integer $nbOfItems : number of items per request
     * @param
     * @param Integer $numOfRandomItems : number of random items (used if $mode=='randomList')
     * @return String : list of image id to be analyzed, separated with a space
     *                      "23 78 4523 5670"
     */
    private function ajax_amd_admin_makeStatsGetList($mode, $nbOfItems, $ignoreSchemas, $numOfRandomItems)
    {
      global $user;

      $returned="";
      $this->config['amd_FillDataBaseIgnoreSchemas']=$ignoreSchemas;
      $this->config['amd_NumberOfItemsPerRequest']=$nbOfItems;
      $this->saveConfig();

      $sql="SELECT ait.imageId FROM ".$this->tables['images']." ait";
      if($mode=='notAnalyzed' or $mode=='randomList' )
      {
        $sql.=" WHERE ait.analyzed='n'";
      }
      elseif($mode=='caddieAdd' or $mode=='caddieReplace')
      {
        $sql.=" LEFT JOIN ".CADDIE_TABLE." ct ON ait.imageId = ct.element_id
              WHERE ct.user_id = ".$user['id']." ";

        if($mode=='caddieAdd') $sql.=" AND ait.analyzed='n'";
      }
      elseif($mode=='analyzed')
      {
        $sql.=" WHERE ait.analyzed='y'";

        pwg_query("UPDATE ".$this->tables['images']." SET nbTags=0 WHERE analyzed='y';");
        pwg_query("UPDATE ".$this->tables['used_tags']." SET numOfImg=0");
        pwg_query("DELETE FROM ".$this->tables['images_tags']);
      }

      if($mode=='all' or $mode=='caddieReplace')
      {
        pwg_query("UPDATE ".$this->tables['images']." SET analyzed='n', nbTags=0");
        pwg_query("UPDATE ".$this->tables['used_tags']." SET numOfImg=0");
        pwg_query("DELETE FROM ".$this->tables['images_tags']);
      }

      if($mode=='randomList')
      {
        $sql.=" ORDER BY RAND() LIMIT 0, $numOfRandomItems;";
      }

      $result=pwg_query($sql);
      if($result)
      {
        $i=0;
        while($row=pwg_db_fetch_row($result))
        {
          $returned.=$row[0];
          $i++;
          if($i>=$nbOfItems)
          {
            $returned.=";";
            $i=0;
          }
          else
          {
            $returned.=" ";
          }
        }
      }
      return(trim($returned).";");
    }


    /**
     * extract metadata from images
     *
     * @param String $imageList : list of image id to be analyzed, separated with
     *                            a space
     *                                "23 78 4523 5670"
     * @return String : list of the analyzed pictures, with number of tags found
     *                  for each picture
     *                    "23=0;78=66;4523=33;5670=91;"
     */
    private function ajax_amd_admin_makeStatsDoAnalyze($imagesList)
    {
      $list=explode(" ", trim($imagesList));

      $returned="";

      if(count($list)>0 and trim($imagesList)!='')
      {
        // $path = path of piwigo's on the server filesystem
        $path=dirname(dirname(dirname(__FILE__)));

        $sql="SELECT id, path, has_high FROM ".IMAGES_TABLE." WHERE id IN (".implode(", ", $list).")";
        $result=pwg_query($sql);
        if($result)
        {
          while($row=pwg_db_fetch_assoc($result))
          {
            /*
             * in some case (in a combination of some pictures), when there is too
             * much pictures to analyze in the same request, a fatal error occurs
             * with the message : "Allowed memory size of XXXXX bytes exhausted"
             *
             *
             * tracking memory leak is not easy... :-(
             *
             */
            //echo "analyzing:".$row['id']."\n";
            //$mem1=memory_get_usage();
            //echo "memory before analyze:".$mem1."\n";
            if($row['has_high']==='true' and $this->config['amd_UseMetaFromHD']=='y')
            {
              $returned.=$this->analyzeImageFile($path."/".dirname($row['path'])."/pwg_high/".basename($row['path']), $row['id']);
            }
            else
            {
              $returned.=$this->analyzeImageFile($path."/".$row['path'], $row['id']);
            }
            //echo $returned."\n";
            //$mem2=memory_get_usage();
            //echo "memory after analyze:".$mem2." (".($mem2-$mem1).")\n";
          }
        }
      }
      return($returned);
    }

    /**
     * do some consolidation on database to optimize other requests
     *
     */
    private function ajax_amd_admin_makeStatsConsolidate()
    {
      $this->makeStatsConsolidation();
    }

    /**
     * return a formatted <table> (using the template "amd_stat_show_iListTags")
     * of used tag with, for each tag, the number and the percentage of pictures
     * where the tag was found
     *
     * @param String $orderType : order for the list (by tag 'tag' or by number of
     *                            pictures 'num')
     * @param String $filterType : filter for the list ('exif', 'xmp', 'iptc', 'com' or '')
     * @return String
     */
    private function ajax_amd_admin_showStatsGetListTags($orderType, $filterType, $excludeUnusedTag, $selectedTagOnly)
    {
      global $template;

      $this->config['amd_GetListTags_OrderType'] = $orderType;
      $this->config['amd_GetListTags_FilterType'] = $filterType;
      $this->config['amd_GetListTags_ExcludeUnusedTag'] = $excludeUnusedTag;
      $this->config['amd_GetListTags_SelectedTagOnly'] = $selectedTagOnly;
      $this->saveConfig();

      $local_tpl = new Template(AMD_PATH."admin/", "");
      $local_tpl->set_filename('body_page',
                    dirname($this->getFileLocation()).'/admin/amd_metadata_select_iListTags.tpl');

      $numOfPictures=$this->getNumOfPictures();

      $datas=array();
      $sql="SELECT ut.numId, ut.tagId, ut.translatable, ut.name, ut.numOfImg, if(st.tagId IS NULL, 'n', 'y') as checked, ut.translatedName
              FROM ".$this->tables['used_tags']." ut
                LEFT JOIN ".$this->tables['selected_tags']." st
                  ON st.tagId = ut.tagId ";
      $where="";

      if($filterType!='')
      {
        if($filterType=='exif')
        {
          $where.=" WHERE ut.tagId LIKE 'exif.tiff.%'
                      OR ut.tagId LIKE 'exif.exif.%'
                      OR ut.tagId LIKE 'exif.gps.%'  ";
        }
        else
        {
          $where.=" WHERE ut.tagId LIKE '".$filterType.".%' ";
        }
      }

      if($excludeUnusedTag=='y')
      {
        ($where=="")?$where=" WHERE ":$where.=" AND ";
        $where.=" ut.numOfImg > 0 ";
      }

      if($selectedTagOnly=='y')
      {
        ($where=="")?$where=" WHERE ":$where.=" AND ";
        $where.=" st.tagId IS NOT NULL ";
      }

      $sql.=$where;

      switch($orderType)
      {
        case 'tag':
          $sql.=" ORDER BY tagId ASC";
          break;
        case 'num':
          $sql.=" ORDER BY numOfImg DESC, tagId ASC";
          break;
        case 'label':
          $sql.=" ORDER BY translatedName ASC, tagId ASC";
          break;
      }

      $result=pwg_query($sql);
      if($result)
      {
        while($row=pwg_db_fetch_assoc($result))
        {
          $datas[]=array(
            "numId" => $row['numId'],
            "tagId" => $row['tagId'],
            "label" => L10n::get($row['name']),
            "nb"    => $row['numOfImg'],
            "pct"   => ($numOfPictures!=0)?sprintf("%.2f", 100*$row['numOfImg']/$numOfPictures):"0",
            "tagChecked" => ($row['checked']=='y')?"checked":""
          );
        }
      }

      $local_tpl->assign('themeconf', Array('name' => $template->get_themeconf('name')));
      $local_tpl->assign('datas', $datas);

      return($local_tpl->parse('body_page', true));
    }


    /*
     *
     *
     */
    private function ajax_amd_admin_showStatsGetListImages($tagId, $orderType)
    {
      global $template;

      $this->config['amd_GetListImages_OrderType'] = $orderType;
      $this->saveConfig();

      $local_tpl = new Template(AMD_PATH."admin/", "");
      $local_tpl->set_filename('body_page',
                    dirname($this->getFileLocation()).'/admin/amd_metadata_select_iListImages.tpl');



      $datas=array();
      $sql="SELECT ut.translatable, ut.numOfImg, COUNT(it.imageId) AS Nb, it.value
              FROM ".$this->tables['used_tags']." ut
                LEFT JOIN ".$this->tables['images_tags']." it
                ON ut.numId = it.numId
              WHERE ut.tagId = '".$tagId."'
                AND it.value IS NOT NULL
              GROUP BY it.value
              ORDER BY ";
      switch($orderType)
      {
        case 'value':
          $sql.="it.value ASC";
          break;
        case 'num':
          $sql.="Nb DESC";
          break;
      }

      $result=pwg_query($sql);
      if($result)
      {
        while($row=pwg_db_fetch_assoc($result))
        {
          $datas[]=array(
            "value" => AMD_root::prepareValueForDisplay($row['value'], ($row['translatable']=='y'), ", "),
            "nb"    => $row['Nb'],
            "pct"   => ($row['numOfImg']!=0)?sprintf("%.2f", 100*$row['Nb']/$row['numOfImg']):"-"
          );
        }
      }

      if(count($datas)>0)
      {
        $local_tpl->assign('themeconf', Array('name' => $template->get_themeconf('name')));
        $local_tpl->assign('datas', $datas);
        return($local_tpl->parse('body_page', true));
      }
      else
      {
        return("<div style='width:100%;text-align:center;padding-top:20px;'>".l10n('g003_selected_tag_isnot_linked_with_any_picture')."</div>");
      }
    }


    /*
     *
     *
     */
    private function ajax_amd_admin_updateTagSelect($numId, $selected)
    {
      if($selected=='y')
      {
        $sql="SELECT ut.tagId FROM ".$this->tables['selected_tags']." st
                LEFT JOIN ".$this->tables['used_tags']." ut
                  ON ut.tagID = st.tagId
                WHERE ut.numId = $numId;";
        $result=pwg_query($sql);
        if($result)
        {
          if(pwg_db_num_rows($result)==0)
          {
            $sql="INSERT INTO ".$this->tables['selected_tags']."
                    SELECT ut.tagId, 0, -1
                    FROM ".$this->tables['used_tags']." ut
                      LEFT JOIN ".$this->tables['selected_tags']." st
                        ON ut.tagID = st.tagId
                    WHERE ut.numId = $numId;";
            pwg_query($sql);
          }
        }
      }
      elseif($selected=='n')
      {
        $sql="DELETE FROM ".$this->tables['selected_tags']."
                USING ".$this->tables['used_tags']." ut
                  LEFT JOIN ".$this->tables['selected_tags']."
                    ON ut.tagID = ".$this->tables['selected_tags'].".tagId
                WHERE ut.numId = $numId;";
        pwg_query($sql);
      }

    }


    /**
     * this function return the list of tags :
     *  - associated with the group
     *  - not associated with a group
     * the list is used to make tags selection
     *
     * @param String $id      : Id of the current group
     * @return String : an HTML formatted list with checkbox
     */
    private function ajax_amd_admin_groupGetTagList($id)
    {
      global $template;

      if($id!="")
      {
        $sql="SELECT st.tagId, st.groupId, ut.name, ut.numId
              FROM ".$this->tables['selected_tags']." st
                LEFT JOIN ".$this->tables['used_tags']." ut
                  ON st.tagId = ut.tagId
              ORDER BY tagId";
        $result=pwg_query($sql);
        if($result)
        {
          $datas=Array();
          while($row=pwg_db_fetch_assoc($result))
          {
            if($row['groupId']==$id)
            {
              $state="checked";
            }
            elseif($row['groupId']==-1)
            {
              $state="";
            }
            else
            {
              $state="n/a";
            }

            if($state!="n/a")
              $datas[]=Array(
                'tagId' => $row['tagId'],
                'name'  => L10n::get($row['name']),
                'state' => $state,
                'numId' => $row['numId']
              );
          }

          if(count($datas)>0)
          {
            $local_tpl = new Template(AMD_PATH."admin/", "");
            $local_tpl->set_filename('body_page',
                          dirname($this->getFileLocation()).'/admin/amd_metadata_display_groupListTagSelect.tpl');
            $local_tpl->assign('themeconf', Array('name' => $template->get_themeconf('name')));
            $local_tpl->assign('datas', $datas);
            return($local_tpl->parse('body_page', true));
          }
          else
          {
            return(l10n("g003_no_tag_can_be_selected"));
          }
        }
      }
      else
      {
        return(l10n("g003_invalid_group_id"));
      }
    }


    /**
     * this function associate tags to a group
     *
     * @param String $id      : Id of group
     * @param String $listTag : list of selected tags, items are separated by a
     *                          semi-colon ";" char
     */
    private function ajax_amd_admin_groupSetTagList($id, $listTag)
    {
      if($id!="")
      {
        $sql="UPDATE ".$this->tables['selected_tags']."
              SET groupId = -1
              WHERE groupId = $id;";
        pwg_query($sql);

        if($listTag!="")
        {
          $sql="UPDATE ".$this->tables['selected_tags']." st, ".$this->tables['used_tags']." ut
                SET st.groupId = $id
                WHERE st.tagId = ut.tagId
                  AND ut.numId IN ($listTag);";
          pwg_query($sql);
        }
      }
      else
      {
        return("KO");
      }
    }


    /**
     * this function returns an ordered list of tags associated with a group
     *
     * @param String $id        : the group Id
     * @return String : an HTML formatted list
     */
    private function ajax_amd_admin_groupGetOrderedTagList($id)
    {
      global $template;
      if($id!="")
      {
        $numOfPictures=$this->getNumOfPictures();

        $sql="SELECT st.tagId, ut.name, ut.numId, ut.numOfImg
              FROM ".$this->tables['selected_tags']." st
                LEFT JOIN ".$this->tables['used_tags']." ut
                  ON st.tagId = ut.tagId
              WHERE st.groupId = $id
              ORDER BY st.order ASC, st.tagId ASC";
        $result=pwg_query($sql);
        if($result)
        {
          $datas=Array();
          while($row=pwg_db_fetch_assoc($result))
          {
            $datas[]=Array(
              'tagId' => $row['tagId'],
              'name'  => L10n::get($row['name']),
              'numId' => $row['numId'],
              'nbItems' => ($this->config['amd_InterfaceMode']=='advanced')?$row['numOfImg']:'',
              'pct'   => ($this->config['amd_InterfaceMode']=='advanced')?(($numOfPictures==0)?"0":sprintf("%.2f", 100*$row['numOfImg']/$numOfPictures)):''
            );
          }

          if(count($datas)>0)
          {
            $template->set_filename('list_page',
                          dirname($this->getFileLocation()).'/admin/amd_metadata_display_groupListTagOrder.tpl');
            $template->assign('datas', $datas);
            $template->assign('group', $id);
            return($template->parse('list_page', true));
          }
          else
          {
            return(l10n("g003_no_tag_can_be_selected"));
          }
        }
      }
      else
      {
        return(l10n("g003_invalid_group_id"));
      }
    }


    /**
     * this function update the tags order inside a group
     *
     * @param String $id        : the group Id
     * @param String $listGroup : the ordered list of tags, items are separated
     *                            by a semi-colon ";" char
     */
    private function ajax_amd_admin_groupSetOrderedTagList($id, $listTag)
    {
      $tags=explode(';', $listTag);
      if($id!="" and count($tags)>0)
      {
        /*
         * by default, all items are set with order equals -1 (if list is not
         * complete, forgotten items are sorted in head)
         */
        pwg_query("UPDATE ".$this->tables['selected_tags']." st
                    SET st.order = -1
                    WHERE st.groupId = $id;");

        foreach($tags as $key=>$val)
        {
          $sql="UPDATE ".$this->tables['selected_tags']." st, ".$this->tables['used_tags']." ut
                SET st.order = $key
                WHERE st.groupId = $id
                  AND st.tagId = ut.tagId
                  AND ut.numId = $val;";
          $result=pwg_query($sql);
        }
      }
    }



    /**
     * this function update the groups order
     *
     * @param String $listGroup : the ordered list of groups, items are separated
     *                            by a semi-colon ";" char
     */
    private function ajax_amd_admin_groupSetOrder($listGroup)
    {
      $groups=explode(";",$listGroup);
      if(count($groups)>0)
      {
        /*
         * by default, all items are set with order equals -1 (if list is not
         * complete, forgotten items are sorted in head)
         */
        pwg_query("UPDATE ".$this->tables['groups']." g SET g.order = -1;");

        foreach($groups as $key=>$val)
        {
          $sql="UPDATE ".$this->tables['groups']." g
                SET g.order = $key
                WHERE g.groupId = $val;";
          $result=pwg_query($sql);
        }
      }
    }

    /**
     * this function is used to create a new group ($groupId = "") or update the
     * group name (names are given in all langs in a list)
     *
     * @param String $groupId : the groupId to update, or "" to create a new groupId
     * @param String $listNames : name of the group, in all language given as a
     *                            list ; each lang is separated by a carraige
     *                            return "\n" char, each items is defined as
     *                            lang=value
     *                              en_UK=the name group
     *                              fr_FR=le nom du groupe
     */
    private function ajax_amd_admin_groupSetNames($groupId, $listNames)
    {
      $names=explode("\n", $listNames);
      if($groupId=="" and count($names)>0)
      {
        $sql="INSERT INTO ".$this->tables['groups']." VALUES('', 9999)";
        $result=pwg_query($sql);
        $groupId=pwg_db_insert_id();
      }

      if(is_numeric($groupId) and count($names)>0)
      {
        $sql="DELETE FROM ".$this->tables['groups_names']."
              WHERE groupId = $groupId;";
        pwg_query($sql);


        $sql="";
        foreach($names as $val)
        {
          $tmp=explode("=", $val);
          if($sql!="") $sql.=", ";
          $sql.=" ($groupId, '".$tmp[0]."', '".$tmp[1]."')";
        }
        $sql="INSERT INTO ".$this->tables['groups_names']." VALUES ".$sql;
        pwg_query($sql);
      }
    }

    /**
     * this function returns an html form, allowing to manage the group
     *
     * @param String $groupId : the groupId to manage, or "" to return a creation
     *                          form
     * @return String : the form
     */
    private function ajax_amd_admin_groupGetNames($groupId)
    {
      global $user;

      $local_tpl = new Template(AMD_PATH."admin/", "");
      $local_tpl->set_filename('body_page',
                    dirname($this->getFileLocation()).'/admin/amd_metadata_display_groupEdit.tpl');

      $datasLang=array(
        'language_list' => Array(),
        'lang_selected' => $user['language'],
        'fromlang' => substr($user['language'],0,2),
        'default' => ''
      );

      $langs=get_languages();
      foreach($langs as $key => $val)
      {
        $datasLang['language_list'][$key] = Array(
          'langName' => str_replace("\n", "", $val),
          'name' => ""
        );
      }

      if($groupId!="")
      {
        $sql="SELECT lang, name FROM ".$this->tables['groups_names']."
              WHERE groupId = $groupId;";
        $result=pwg_query($sql);
        if($result)
        {
          while($row=pwg_db_fetch_assoc($result))
          {
            if(array_key_exists($row['lang'], $datasLang['language_list']))
            {
              $datasLang['language_list'][$row['lang']]['name']=htmlentities($row['name'], ENT_QUOTES, 'UTF-8');
              if($user['language']==$row['lang'])
              {
                $datasLang['default']=$datasLang['language_list'][$row['lang']]['name'];
              }
            }
          }
        }
      }

      $local_tpl->assign('datasLang', $datasLang);

      return($local_tpl->parse('body_page', true));
    }


    /**
     * this function returns an html form, allowing to manage the group
     *
     * @param String $groupId : the groupId to manage, or "" to return a creation
     *                          form
     * @return String : the form
     */
    private function ajax_amd_admin_groupGetList()
    {
      global $user, $template;

      //$local_tpl = new Template(AMD_PATH."admin/", "");
      $template->set_filename('group_list',
                    dirname($this->getFileLocation()).'/admin/amd_metadata_display_groupList.tpl');


      $datas=array(
        'groups' => Array(),
      );

      $sql="SELECT g.groupId, gn.name
            FROM ".$this->tables['groups']." g
              LEFT JOIN ".$this->tables['groups_names']." gn
                ON g.groupId = gn.groupId
            WHERE gn.lang = '".$user['language']."'
            ORDER BY g.order;";
      $result=pwg_query($sql);
      if($result)
      {
        while($row=pwg_db_fetch_assoc($result))
        {
          $datas['groups'][]=Array(
            'id' => $row['groupId'],
            'name' => htmlentities($row['name'], ENT_QUOTES, "UTF-8")
          );
        }
      }

      $template->assign('datas', $datas);
      return($template->parse('group_list', true));
    }


    /**
     * delete the group
     * associated tag returns in the available tag list
     *
     * @param String $groupId : the groupId to delete
     */
    private function ajax_amd_admin_groupDelete($groupId)
    {
      if($groupId!="")
      {
        $sql="DELETE FROM ".$this->tables['groups']."
              WHERE groupId = $groupId;";
        pwg_query($sql);

        $sql="DELETE FROM ".$this->tables['groups_names']."
              WHERE groupId = $groupId;";
        pwg_query($sql);

        $sql="UPDATE ".$this->tables['selected_tags']."
              SET groupId = -1
              WHERE groupId = $groupId;";
        pwg_query($sql);
      }
    }


    /**
     * return the list of userDefined tag
     *
     * @return String : an HTML list ready to use
     */
    private function ajax_amd_admin_userDefinedGetList()
    {
      global $user, $template;

      //$local_tpl = new Template(AMD_PATH."admin/", "");
      $template->set_filename('userDefList',
                    dirname($this->getFileLocation()).'/admin/amd_metadata_personnal_iListTags.tpl');

      $datas=array();

      $sql="SELECT aut.numId, aut.tagId, aut.translatedName, COUNT(autd.defId) AS numOfRules
            FROM ".$this->tables['used_tags']." aut
              LEFT JOIN ".$this->tables['user_tags_def']." autd ON aut.numId=autd.numId
            WHERE aut.tagId LIKE 'userDefined.%'
            GROUP BY aut.numId
            ORDER BY aut.tagId;";
      $result=pwg_query($sql);
      if($result)
      {
        while($row=pwg_db_fetch_assoc($result))
        {
          $datas[]=Array(
            'numId' => $row['numId'],
            'tagId' => $row['tagId'],
            'label' => htmlspecialchars($row['translatedName'], ENT_QUOTES, "UTF-8"),
            'numOfRules' => $row['numOfRules']
          );
        }
      }

      $template->assign('datas', $datas);
      return($template->parse('userDefList', true));
    }

    /**
     * returns a userDefined tag
     *
     * @param String $id :
     * @return String :
     */
    private function ajax_amd_admin_userDefinedGetTag($id)
    {
      $returned=array(
        'numId' => 0,
        'tagId' => '',
        'label' => '',
        'rules' => Array(),
        'lastDefId' => 1,
      );

      $sql="SELECT aut.numId, aut.tagId, aut.name, MAX(autd.defId) AS lastDefId
            FROM ".$this->tables['used_tags']." aut
              LEFT JOIN ".$this->tables['user_tags_def']." autd ON autd.numId=aut.numId
            WHERE aut.numId='$id'
            GROUP BY aut.numId";
      $result=pwg_query($sql);
      if($result)
      {
        while($row=pwg_db_fetch_assoc($result))
        {
          $returned['numId']=$row['numId'];
          $returned['tagId']=$row['tagId'];
          $returned['label']=$row['name'];
          $returned['lastDefId']=$row['lastDefId'];
        }

        $sql="SELECT numId, defId, parentId, `order`, type, value, conditionType, conditionValue
              FROM ".$this->tables['user_tags_def']."
              WHERE numId='$id'
              ORDER BY numId, `order`";
        $result=pwg_query($sql);
        if($result)
        {
          while($row=pwg_db_fetch_assoc($result))
          {
            $returned['rules'][]=$row;
          }
        }
      }

      return(json_encode($returned));
    }


    /**
     * set a userDefined tag
     *
     * @param String $id :
     * @param Array $properties :
     * @return String : ok or ko
     */
    private function ajax_amd_admin_userDefinedSetTag($id, $properties)
    {
      global $user;

      $currentTagId='';

      if(!preg_match('/^userDefined\./', $properties['tagId']))
      {
        $properties['tagId']='userDefined.'.$properties['tagId'];
      }

      $sql="SELECT numId, tagId FROM ".$this->tables['used_tags']."
            WHERE tagId='".$properties['tagId']."';";
      $result=pwg_query($sql);
      if($result)
      {
        while($row=pwg_db_fetch_assoc($result))
        {
          if($row['numId']!=$id)
          {
            return('iBDTagId!'.l10n('g003_tagIdAlreadyExist'));
          }
          $currentTagId=$row['tagId'];
        }
      }

      /*
       * to set a user defined tag
       *  1/ if it's a new user tag, create the tag into the used_tags table to
       *     get a new numId for the tag
       *  2/ delete all properties into the user_tags_def
       *  3/ insert the properties
       */
      if($id=='')
      {
        // add a new metadata
        $sql="INSERT INTO ".$this->tables['used_tags']."
              VALUES ('', '".$properties['tagId']."', 'n', '".$properties['name']."', 0, '".$properties['name']."', 'n')";
        $result=pwg_query($sql);
        $id=pwg_db_insert_id();

        /*
         * multilanguage management will be coded later....
        $sql="INSERT INTO ".$this->tables['user_tags_label']."
              VALUES ('$id', '".$user['language']."', '".$properties['name']."');";
        $result=pwg_query($sql);
        */

        if($this->config['amd_InterfaceMode']=='basic')
        {
          $sql="INSERT INTO ".$this->tables['selected_tags']." VALUES ('".$properties['tagId']."', 0, -1);";
          pwg_query($sql);
        }
      }
      else
      {
        //update an existing metadata
        $sql="UPDATE ".$this->tables['used_tags']."
              SET tagId='".$properties['tagId']."',
                  name='".$properties['name']."',
                  translatedName='".$properties['name']."'
              WHERE numId='$id';";
        $result=pwg_query($sql);

        $sql="DELETE FROM ".$this->tables['user_tags_def']."
              WHERE numId='$id';";
        $result=pwg_query($sql);

        $sql="DELETE FROM ".$this->tables['images_tags']."
              WHERE numId='$id';";
        $result=pwg_query($sql);

        if($currentTagId!='' and $currentTagId!=$properties['tagId'])
        {
          $sql="UPDATE ".$this->tables['selected_tags']."
                SET tagId='".$properties['tagId']."'
                WHERE tagId='$currentTagId'";
          $result=pwg_query($sql);
        }
      }

      $inserts=array();
      foreach($properties['rules'] as $rule)
      {
        //print_r($rule['value']);
        $inserts[]="('$id', '".$rule['defId']."', '".$rule['parentId']."', '".$rule['order']."', '".$rule['type']."', '".$rule['value']."', '".$rule['conditionType']."', '".$rule['conditionValue']."')";
      }
      $sql="INSERT INTO ".$this->tables['user_tags_def']."
            VALUES ".implode(',', $inserts);
      $result=pwg_query($sql);

      if($this->config['amd_InterfaceMode']=='advanced')
      {
        $nbImg=$this->buildUserDefinedTags($id);
      }
      else
      {
        $nbImg=0;
      }

      $this->makeStatsConsolidation();

      return($id.','.$nbImg);
    }


    /**
     * delete a userDefined tag
     *
     * @param String $id :
     * @return String : ok or ko
     */
    private function ajax_amd_admin_userDefinedDeleteTag($id)
    {
      $tagId='';
      $sql="SELECT tagId
            FROM ".$this->tables['used_tags']."
            WHERE numId='$id';";
      $result=pwg_query($sql);
      if($result)
      {
        while($row=pwg_db_fetch_assoc($result))
        {
          $tagId=$row['tagId'];
        }
      }

      if($tagId!='')
      {
        $sql="DELETE FROM ".$this->tables['selected_tags']."
              WHERE tagId='$tagId';";
        $result=pwg_query($sql);
      }

      $sql="DELETE FROM ".$this->tables['used_tags']."
            WHERE numId='$id';";
      $result=pwg_query($sql);

      $sql="DELETE FROM ".$this->tables['user_tags_label']."
            WHERE numId='$id';";
      $result=pwg_query($sql);

      $sql="DELETE FROM ".$this->tables['user_tags_def']."
            WHERE numId='$id';";
      $result=pwg_query($sql);

      $sql="DELETE FROM ".$this->tables['images_tags']."
            WHERE numId='$id';";
      $result=pwg_query($sql);
    }


    /**
     * return the known values for a given tag id
     *
     * @param String $id : a tag numId
     * @return String : an HTML list ready to use
     */
    private function ajax_amd_admin_tagGetValues($numId)
    {
      $returned="";

      $sql="SELECT DISTINCT pait.value, COUNT(pait.imageId) AS nbImg, paut.translatable
            FROM ".$this->tables['images_tags']." pait
              LEFT JOIN ".$this->tables['used_tags']." paut
                ON pait.numId=paut.numId
            WHERE pait.numId = '$numId'
            GROUP BY pait.value
            ORDER BY pait.value";
      $result=pwg_query($sql);
      if($result)
      {
        while($row=pwg_db_fetch_assoc($result))
        {
          $value=htmlspecialchars(AMD_root::prepareValueForDisplay($row['value'], ($row['translatable']=='y'), ", "), ENT_QUOTES);
          $returned.="<option displayvalue='$value' rawvalue='".$row['value']."'>$value (".$row['nbImg']." ".l10n('images').")</option>";
        }
      }
      return($returned);
    }


    /**
     * return an html list of found keywords in the images_tags table
     *
     * @return String : html formatted list
     */
    private function ajax_amd_admin_tagsGetKeywords()
    {
      global $template;

      $returned=array();
      $keywordsList=array();
      $sql="SELECT DISTINCT pait.value, pait.imageId, paut.numId, paut.tagId
            FROM (".$this->tables['images_tags']." pait
              JOIN ".$this->tables['used_tags']." paut ON pait.numId = paut.numId)

            WHERE (paut.tagId = 'xmp.dc:subject' OR
                   paut.tagId = 'xmp.digiKam:TagsList' OR
                   paut.tagId = 'xmp.lr:hierarchicalSubject' OR
                   paut.tagId = 'iptc.Keywords' OR
                   paut.tagId = 'magic.Author.Keywords');";
      $result=pwg_query($sql);
      if($result)
      {
        while($row=pwg_db_fetch_assoc($result))
        {
          if(preg_match('/^a:\d+:{/', $row['value']))
          {
            /*
             *  if value is a serialized string, unserialize and process it
             */
            $tmp=unserialize($row['value']);
            if(!isset($tmp['values'])) $tmp=array('values'=>$tmp);
            foreach($tmp['values'] as $val)
            {
              if($row['tagId']=='xmp.digiKam:TagsList' or $row['tagId']=='xmp.lr:hierarchicalSubject')
              {
                $list=explode($this->tagSeparators[$row['tagId']], $val);
                foreach($list as $subTag)
                {
                  $keywordsList[]="('".mysql_escape_string(trim($subTag))."', ".$row['imageId'].")";
                }
              }
              else
              {
                $keywordsList[]="('".mysql_escape_string($val)."', ".$row['imageId'].")";
              }
            }
          }
          else
          {
            $keywordsList[]="('".mysql_escape_string($row['value'])."', ".$row['imageId'].")";
          }
        }

        if(count($keywordsList)>0)
        {
          $sql="CREATE TEMPORARY TABLE amd_temp_tags (
                  `value` CHAR(255) default '',
                  `imageId` mediumint(8) unsigned NOT NULL default '0',
                  PRIMARY KEY  USING BTREE (`value`,`imageId`)
                ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
          if(pwg_query($sql))
          {
            $sql="INSERT IGNORE INTO amd_temp_tags
              VALUES ".implode(',', $keywordsList);
            if(pwg_query($sql))
            {
              $sql="SELECT att.value AS value,
                      COUNT(DISTINCT att.imageId) AS nbPictures,
                      IF(ptt.name IS NULL, 'n', 'y') AS tagExists,
                      COUNT(DISTINCT pit.image_id) AS nbPicturesTagged
                    FROM (amd_temp_tags att LEFT JOIN ".TAGS_TABLE."  ptt ON att.value = ptt.name)
                      LEFT JOIN ".IMAGE_TAG_TABLE." pit ON pit.tag_id = ptt.id
                    GROUP BY att.value
                    HAVING nbPicturesTagged < nbPictures
                    ORDER BY att.value";
              $result=pwg_query($sql);
              if($result)
              {
                $i=0;
                while($row=pwg_db_fetch_assoc($result))
                {
                  $row['id']=$i;
                  $returned[]=$row;
                  $i++;
                }
              }
            }
          }
        }
      }

      $template->set_filename('keywordsList',
                    dirname($this->getFileLocation()).'/admin/amd_metadata_tags_iKeywordsList.tpl');

      $template->assign('datas', $returned);
      return($template->parse('keywordsList', true));
    }


    /**
     * convert given keywords into tags, and associate them to pictures
     *
     * @param Array $keywords : an array of strings
     * @return String : ok or ko
     */
    private function ajax_amd_admin_tagsConvertKeywords($keywords)
    {
      global $template;

      $returned='ko';

      /*
       * 1/ build a temp table with all couple of keywords/imageId
       */
      $keywordsList=array();
      $sql="SELECT DISTINCT pait.value, pait.imageId, paut.numId, paut.tagId
            FROM (".$this->tables['images_tags']." pait
              JOIN ".$this->tables['used_tags']." paut ON pait.numId = paut.numId)

            WHERE (paut.tagId = 'xmp.dc:subject' OR
                   paut.tagId = 'xmp.digiKam:TagsList' OR
                   paut.tagId = 'xmp.lr:hierarchicalSubject' OR
                   paut.tagId = 'iptc.Keywords' OR
                   paut.tagId = 'magic.Author.Keywords');";
      $result=pwg_query($sql);
      if($result)
      {
        while($row=pwg_db_fetch_assoc($result))
        {
          if(preg_match('/^a:\d+:{/', $row['value']))
          {
            /*
             *  if value is a serialized string, unserialize and process it
             */
            $tmp=unserialize($row['value']);
            if(!isset($tmp['values'])) $tmp=array('values'=>$tmp);
            foreach($tmp['values'] as $val)
            {
              if($row['tagId']=='xmp.digiKam:TagsList' or $row['tagId']=='xmp.lr:hierarchicalSubject')
              {
                $list=explode($this->tagSeparators[$row['tagId']], $val);
                foreach($list as $subTag)
                {
                  $keywordsList[]="('".mysql_escape_string(trim($subTag))."', ".$row['imageId'].")";
                }
              }
              else
              {
                $keywordsList[]="('".mysql_escape_string($val)."', ".$row['imageId'].")";
              }
            }
          }
          else
          {
            $keywordsList[]="('".mysql_escape_string($row['value'])."', ".$row['imageId'].")";
          }
        }
        $sql="CREATE TEMPORARY TABLE amd_temp_tags (
                `value` CHAR(255) default '',
                `imageId` mediumint(8) unsigned NOT NULL default '0',
                PRIMARY KEY  USING BTREE (`value`,`imageId`)
              ) CHARACTER SET utf8 COLLATE utf8_general_ci;";
        if(pwg_query($sql))
        {
          $sql="INSERT IGNORE INTO amd_temp_tags
            VALUES ".implode(',', $keywordsList);
          if(pwg_query($sql))
          {
            foreach($keywords as $key => $val)
            {
              $keywords[$key]="(att.value LIKE '".mysql_escape_string($val)."')";
            }
            /*
             * 2/ join temp table with piwigo tags table, found the keywords
             *    that don't have a corresponding tag
             */
            $sql="SELECT DISTINCT att.value
                  FROM amd_temp_tags att LEFT JOIN ".TAGS_TABLE." ptt ON att.value = ptt.name
                  WHERE ptt.id IS NULL
                    AND (".implode(' OR ', $keywords).") ";
            $result=pwg_query($sql);
            if($result)
            {
              $sql=array();
              while($row=pwg_db_fetch_assoc($result))
              {
                $sql[]="('', '".mysql_escape_string($row['value'])."', '".mysql_escape_string(str2url($row['value']))."')";
              }
              if(count($sql)>0)
              {
                $sql="INSERT INTO ".TAGS_TABLE." VALUES ".implode(',', $sql);
                pwg_query($sql);
              }
            }

            /*
             * 3/ join temp table with piwigo tags table, associate piwigo tagId
             *    to the keywords (at this step, all keyword can be associated
             *    with a piwigo tagId)
             */
            $sql="INSERT IGNORE INTO ".IMAGE_TAG_TABLE."
                    SELECT DISTINCT att.imageId, ptt.id
                    FROM amd_temp_tags att LEFT JOIN ".TAGS_TABLE." ptt ON att.value = ptt.name
                    WHERE ".implode(' OR ', $keywords);
            $result=pwg_query($sql);
            $returned='ok';
          }
        }
      }
      return($returned);
    }


    /**
     * set value(s) for option(s)
     *
     * @param Array or String $ids : a string or an array of string (id)
     * @param Array or String $values : a string or an array of string
     * @return String : ok or ko
     */
    private function ajax_amd_admin_configSetOption($ids, $values)
    {
      if(is_array($ids) and is_array($values) and count($ids)==count($values))
      {
        foreach($ids as $key=>$id)
        {
          if(isset($id, $this->config))
          {
            $this->config[$id]=$values[$key];
          }
        }
        $this->saveConfig();
        return('ok');
      }
      elseif(is_string($ids) and is_string($values))
      {
        if(isset($ids, $this->config))
        {
          $this->config[$ids]=$values;
        }
        $this->saveConfig();
        return('ok');
      }

      return('ko');
    }


  } //class


  $returned=new AMD_ajax($prefixeTable, __FILE__);
?>
