<?php
/* -----------------------------------------------------------------------------
  Plugin     : ColorStat
  Author     : Grum
    email    : grum@piwigo.org
    website  : http://photos.grum.fr

    << May the Little SpaceFrog be with you ! >>
  ------------------------------------------------------------------------------
  See main.inc.php for release information

  CStat_AIP : classe to manage plugin admin pages

  --------------------------------------------------------------------------- */

if(!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

include_once('cstat_root.class.inc.php');
include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCTables.class.inc.php');
include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCTabSheet.class.inc.php');
include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCRequestBuilder.class.inc.php');
include_once(PHPWG_ROOT_PATH.'admin/include/tabsheet.class.php');

class CStat_AIP extends CStat_root
{
  protected $tabsheet;

  public function __construct($prefixeTable, $filelocation)
  {
    parent::__construct($prefixeTable, $filelocation);
    $this->checkRequest();

    $this->loadConfig();
    $this->initEvents();

    $this->tabsheet = new tabsheet();
    $this->tabsheet->add('database',
                          l10n('cstat_database'),
                          $this->getAdminLink()."&amp;f_tabsheet=database");
    $this->tabsheet->add('stat',
                          l10n('cstat_stat'),
                          $this->getAdminLink()."&amp;f_tabsheet=stat");
    $this->tabsheet->add('search',
                          l10n('cstat_search'),
                          $this->getAdminLink()."&amp;f_tabsheet=search");
    $this->tabsheet->add('config',
                          l10n('cstat_config'),
                          $this->getAdminLink()."&amp;f_tabsheet=config");
  }

  public function __destruct()
  {
    unset($this->tabsheet);
    parent::__destruct();
  }

  /*
    initialize events call for the plugin
  */
  public function initEvents()
  {
    parent::initEvents();
    if($_REQUEST['f_tabsheet']=='search')
    {
      // load request builder JS only on the search page
      GPCRequestBuilder::loadJSandCSS();
    }
    add_event_handler('loc_end_page_header', array(&$this->css, 'applyCSS'));
    GPCCss::applyGpcCss();
  }

  /*
    display administration page
  */
  public function manage()
  {
    global $template;

    $this->returnAjaxContent();

    $template->set_filename('plugin_admin_content', dirname(__FILE__)."/admin/cstat_admin.tpl");


    switch($_REQUEST['f_tabsheet'])
    {
      case 'database':
        $this->displayDatabasePage();
        break;
      case 'stat':
        $this->displayStatPage();
        break;
      case 'search':
        $this->displaySearchPage();
        break;
      case 'config':
        $this->displayConfigPage();
        break;
    }

    $this->tabsheet->select($_REQUEST['f_tabsheet']);
    $this->tabsheet->assign();
    $selected_tab=$this->tabsheet->get_selected();
    $template->assign($this->tabsheet->get_titlename(), "[".$selected_tab['caption']."]");

    $template_plugin["CSTAT_VERSION"] = "<i>".$this->getPluginName()."</i> ".l10n('cstat_release').CSTAT_VERSION;

    $template->assign('plugin', $template_plugin);
    $template->assign_var_from_handle('ADMIN_CONTENT', 'plugin_admin_content');
  }


  /*
    return ajax content
  */
  protected function returnAjaxContent()
  {
    global $ajax, $template;

    if(isset($_REQUEST['ajaxfct']))
    {
      //$this->debug("AJAXFCT:".$_REQUEST['ajaxfct']);
      $result="<p class='errors'>An error has occured</p>";
      switch($_REQUEST['ajaxfct'])
      {
        case 'updateDatabaseGetStatus':
          $result=$this->ajax_cstat_updateDatabaseGetStatus();
          break;
        case 'updateDatabaseGetList':
          $result=$this->ajax_cstat_updateDatabaseGetList($_REQUEST['selectMode'], $_REQUEST['numOfItems']);
          break;
        case 'updateDatabaseDoAnalyze':
          $result=$this->ajax_cstat_updateDatabaseDoAnalyze($_REQUEST['imagesList']);
          break;
        case 'updateDatabaseConsolidation':
          $result=$this->ajax_cstat_updateDatabaseConsolidation();
          break;
        case 'showStatsGetListColors':
          $result=$this->ajax_cstat_showStatsGetListColors($_REQUEST['orderType']);
          break;
        case 'doPpsBench':
          $result=$this->ajax_cstat_ppsBench($_REQUEST['quality'], true);
          break;
      }
      GPCAjax::returnResult($result);
    }
  }

  /**
   * check the $_REQUEST values and set default values
   *
   */
  protected function checkRequest()
  {
    if(!isset($_REQUEST['f_tabsheet'])) $_REQUEST['f_tabsheet']='stat';


    if(!($_REQUEST['f_tabsheet']=='database' or
         $_REQUEST['f_tabsheet']=='stat' or
         $_REQUEST['f_tabsheet']=='search' or
         $_REQUEST['f_tabsheet']=='config')) $_REQUEST['f_tabsheet']='stat';


    if(isset($_REQUEST['ajaxfct']))
    {
      if($_REQUEST['ajaxfct']=='updateDatabaseGetList')
      {
        if(!isset($_REQUEST['selectMode'])) $_REQUEST['selectMode']='caddieAdd';
        if(!isset($_REQUEST['numOfItems'])) $_REQUEST['numOfItems']=$this->config['analyze_itemPerRequest'];

        if(!($_REQUEST['selectMode']=='notAnalyzed' or
             $_REQUEST['selectMode']=='all' or
             $_REQUEST['selectMode']=='caddieAdd' or
             $_REQUEST['selectMode']=='caddieReplace')) $_REQUEST['selectMode']='caddieAdd';

        if($_REQUEST['numOfItems'] <=0 or $_REQUEST['numOfItems']>100) $_REQUEST['numOfItems']=10;
      }


      if($_REQUEST['ajaxfct']=='updateDatabaseDoAnalyze')
      {
        if(!isset($_REQUEST['imagesList'])) $_REQUEST['imagesList']='';
      }

      if($_REQUEST['ajaxfct']=='showStatsGetListColors')
      {
        if(!isset($_REQUEST['orderType'])) $_REQUEST['orderType']='img';

        if(!($_REQUEST['orderType']=='color' or
             $_REQUEST['orderType']=='img' or
             $_REQUEST['orderType']=='pixels')) $_REQUEST['orderType']=='img';
      }


      if($_REQUEST['ajaxfct']=='doPpsBench')
      {
        if(!isset($_REQUEST['quality'])) $_REQUEST['quality']=8;
        if($_REQUEST['quality']>50 or $_REQUEST['quality']<1) $_REQUEST['quality']=8;
      }
    }

  }

  /**
   * display the database page
   */
  protected function displayDatabasePage()
  {
    global $template;

    $template->set_filename('body_page',
                dirname($this->getFileLocation()).'/admin/cstat_database.tpl');

    pwg_query("INSERT INTO ".$this->tables['images']."
                SELECT id, 'n', 0, 0, 0, 0, 0, 0, '', ''
                  FROM ".IMAGES_TABLE."
                  WHERE id NOT IN (SELECT image_id FROM ".$this->tables['images'].")");

    $datas=Array(
      'urlRequest' => $this->getAdminLink(),
      'numberOfItemsPerRequest' => $this->config['analyze_itemPerRequest']
    );
    $template->assign('datas', $datas);
    $template->assign_var_from_handle('CSTAT_BODY_PAGE', 'body_page');
  } //displayDatabasePage

  /**
   * display the stat page
   */
  protected function displayStatPage()
  {
    global $template;

    $template->set_filename('body_page',
                dirname($this->getFileLocation()).'/admin/cstat_stat.tpl');

    $colorTable=CStat_functions::getColorTableWithStat();


    $datas=Array(
      //'themeconf' => Array('name' => $template->get_themeconf('name')),
      'colorTable' => CStat_functions::htmlColorTable(
                        $colorTable,
                        ($this->config['analyze_colorTable']=='small')?19:10,
                        "",
                        "color0px",
                        "<br>"
                      ),
      'urlRequest' => $this->getAdminLink(),
      'config_GetListColors_OrderType' => $this->config['display_stat_orderType'],
    );
    $template->assign('datas', $datas);
    $template->assign_var_from_handle('CSTAT_BODY_PAGE', 'body_page');
  } //displayStatPage


  /**
   * display search page
   */
  protected function displaySearchPage()
  {
    global $template, $lang;

    $template->set_filename('body_page',
                dirname($this->getFileLocation()).'/admin/cstat_search.tpl');

    $template->assign('cstat_search_page', GPCRequestBuilder::displaySearchPage($this->getPluginName()));

    $template->assign_var_from_handle('CSTAT_BODY_PAGE', 'body_page');
  } //displaySearchPage


  /**
   * manage display of config page & save config
   */
  protected function displayConfigPage()
  {
    $tmpPct=$this->config['stat_minPct'];

    if(!$this->adviser_abort())
    {
      if(isset($_POST['submit_save_config']))
      {
        foreach($this->config as $key => $val)
        {
          if(isset($_REQUEST['f_'.$key]))
          {
            $this->config[$key] = $_REQUEST['f_'.$key];
          }
        }
        $this->displayResult(l10n('cstat_save_config'), $this->saveConfig());
      }
    }

    if($tmpPct!=$this->config['stat_minPct'])
    {
      $this->updateDatabaseConsolidation();
    }

    $this->displayConfig();
  }

  /**
   * display config page
   */
  protected function displayConfig()
  {
    global $template, $lang;

    $configTabs=new GPCTabSheet('configTabsheet', $this->tabsheet->get_titlename(), 'tabsheet2 gcBorder', 'itab2');
    $configTabs->add('database',
                      l10n('cstat_database'),
                      '', true, "displayConfig('database');");
    $configTabs->add('statsearch',
                      l10n('cstat_stat_and_search'),
                      '', false, "displayConfig('statsearch');");
    $configTabs->add('display',
                      l10n('cstat_gallery_integration'),
                      '', false, "displayConfig('display');");
    $configTabs->assign();

    $template->set_filename('body_page',
                dirname($this->getFileLocation()).'/admin/cstat_config.tpl');

    $nbPictures=0;
    $sql="SELECT COUNT(image_id) FROM ".$this->tables['images'];
    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_row($result))
      {
        $nbPictures=$row[0];
      }
    }


    $datas=Array(
      'nbPictures' => $nbPictures,
      'pps' => $this->config['analyze_pps'],
      'quality' => $this->config['analyze_ppsQuality'],
      'qualityHighest' => 14000,
      'qualityHigh' => 7500,
      'qualityNormal' => 3500,
      'qualityLow' => 1200,
      'qualityLowest' => 600,
      'urlRequest' => $this->getAdminLink(),
      'minPct' => $this->config['stat_minPct'],
      'showColors' => $this->config['display_gallery_showColors'],
      'colorSize' => $this->config['display_gallery_colorSize'],
    );

    $template->assign('datas', $datas);

    $template->assign_var_from_handle('CSTAT_BODY_PAGE', 'body_page');
  } //displayConfig


  /**
   * manage adviser profile
   * return true if user is adviser
   */
  protected function adviser_abort()
  {
    if(is_adviser())
    {
      $this->displayResult(l10n("cstat_adviser_not_allowed"), false);
      return(true);
    }
    return(false);
  }


  /* ---------------------------------------------------------------------------
    function to manage database manipulation
  --------------------------------------------------------------------------- */
  protected function analyzeImageFile($fileName, $imageId, $colorTable)
  {
    // set the picture to the 'try to analyze' statut
    $sql="UPDATE ".$this->tables['images']." SET analyzed='t'
          WHERE image_id=".$imageId.";";
    pwg_query($sql);

    $colors=ColorStat::getFileColors(
      $fileName,
      $colorTable,
      Array(
        'mode' => 'numAnalyzed',
        'numColors' => 24,
        'numAnalyzed' => $this->config['analyze_ppsQuality'],
      )
    );

    if($colors!==false and
       ColorStat::$fileColorsStat['colors']>0 and
       ColorStat::$fileColorsStat['analyzed']>0)
    {
      $sql="UPDATE ".$this->tables['images']."
              SET analyzed='y',
                  num_colors='".ColorStat::$fileColorsStat['colors']."',
                  num_pixels='".ColorStat::$fileColorsStat['pixels']."',
                  analyzed_pixels='".ColorStat::$fileColorsStat['analyzed']."',
                  pps='".ColorStat::$fileColorsStat['pps']."',
                  time='".ColorStat::$fileColorsStat['time']."',
                  quality='".ColorStat::$fileColorsStat['quality']."'
            WHERE image_id=".$imageId.";";
      pwg_query($sql);
      $sql="";
      foreach($colors as $key=>$val)
      {
        /*
         * $key => RGB color #RRGGBB
         * $val => Array (
         *            'hsv' => Array ('H', 'S', 'V')
         *            'num' => integer
         *            'pct' => float
         *          )
         */

        $sql.=(($sql=="")?"":", ")."
              ('".$imageId."', '".$key."', ".$val['pct'].", ".$val['num'].")";
      }
      $sql="REPLACE INTO ".$this->tables['images_colors']."
                VALUES ".$sql;
      pwg_query($sql);

      return($imageId.'='.ColorStat::$fileColorsStat['colors'].';');
    }
    else
    {
      return($imageId.'=KO;');
    }
  }


  /**
   * make consolidation for the color_table :
   *  - count number of images using a color
   *  - count number of pixels of a color
   */
  protected function updateDatabaseConsolidation()
  {
    $sql="UPDATE ".$this->tables['color_table']." cct
          SET cct.num_images=0,
              cct.num_pixels=0;";
    pwg_query($sql);

    $sql="UPDATE ".$this->tables['color_table']." cct,
                 (SELECT color_id,
                         count(image_id) AS num_images,
                         sum(num_pixels) AS num_pixels
                  FROM ".$this->tables['images_colors']."
                  WHERE pct >= ".$this->config['stat_minPct']."
                  GROUP BY color_id) cic
          SET cct.num_images=cic.num_images,
              cct.num_pixels=cic.num_pixels
          WHERE cct.color_id=cic.color_id;";
    pwg_query($sql);

    $sql="UPDATE ".$this->tables['images']." pci
          SET pci.colors = '',
              pci.colors_pct = ''";
    pwg_query($sql);

    $sql="UPDATE ".$this->tables['images']." pci,
          (SELECT image_id,
                  GROUP_CONCAT(color_id ORDER BY pct DESC SEPARATOR ',') AS colors,
                  GROUP_CONCAT(pct ORDER BY pct DESC SEPARATOR ',') AS colors_pct
           FROM ".$this->tables['images_colors']."
           WHERE pct >= ".$this->config['stat_minPct']."
           GROUP BY image_id) pcic
          SET pci.colors = pcic.colors,
              pci.colors_pct = pcic.colors_pct
          WHERE pci.image_id = pcic.image_id;";
    pwg_query($sql);
  }

  /* ---------------------------------------------------------------------------
    ajax functions
  --------------------------------------------------------------------------- */

  /**
   * returns a list of formated string, separated with a semi-colon :
   *  - number of current analyzed pictures
   *  - number of pictures not analyzed + number of picture in error
   *
   * @return String
   */
  private function ajax_cstat_updateDatabaseGetStatus()
  {
    $numOfPictures=0;
    $numOfPicturesNotAnalyzed=0;
    $numOfPicturesInError=0;

    $sql="SELECT COUNT(image_id), analyzed FROM ".$this->tables['images']."
            GROUP BY analyzed;";
    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_row($result))
      {
        switch($row[1])
        {
          case 'n': //no
            $numOfPicturesNotAnalyzed=$row[0];
            break;
          case 'y': //yes
            $numOfPictures=$row[0];
            break;
          case 't': //tried to be analyzed, but not finished
            $numOfPicturesInError=$row[0];
            break;
        }
      }
    }

    return(sprintf(l10n("cstat_numberOfAnalyzedPictures"), $numOfPictures).";".
           sprintf(l10n("cstat_numberOfNotAnalyzedPictures"), $numOfPicturesNotAnalyzed).";".
           sprintf(l10n("cstat_numberOfPicturesInError"), $numOfPicturesInError));
  }


  /**
   * return a list of picture Id
   *
   * picture id are separated with a space " "
   * picture id are grouped in blocks of 'NumberOfItemsPerRequest' items and
   * are separated with a semi-colon ";"
   *
   * client side just have to split blocks, and transmit it to the server
   *
   * There is four mode to determine the pictures being analyzed :
   *  - "all"           : analyze all the images (add & replace)
   *  - "notAnalyzed"   : analyze only the images not yet analyzed (add)
   *  - "caddieAdd"     : analyze all the images of the caddie (add)
   *  - "caddieReplace" : analyze all the images of the caddie (add & replace)
   *
   * @param String $mode
   * @param Integer $nbOfItems : number of items per request
   * @return String : list of image id to be analyzed, separated with a space
   *                      "23 78 4523 5670"
   */
  private function ajax_cstat_updateDatabaseGetList($mode, $nbOfItems)
  {
    global $user;

    $returned="";

    $sql="SELECT cit.image_id FROM ".$this->tables['images']." cit";
    if($mode=="notAnalyzed")
    {
      $sql.=" WHERE cit.analyzed='n'";
    }
    elseif($mode=="caddieAdd" or $mode=="caddieReplace")
    {
      $sql.=" LEFT JOIN ".CADDIE_TABLE." ct ON cit.image_id = ct.element_id
            WHERE ct.user_id = ".$user['id']." ";
      if($mode=="caddieAdd") $sql.=" AND cit.analyzed='n'";
    }

    if($mode=="all" or $mode=="caddieReplace")
    {
      pwg_query("UPDATE ".$this->tables['images']."
                  SET analyzed='n',
                      num_colors=0,
                      num_pixels=0,
                      analyzed_pixels=0,
                      pps=0,
                      time=0,
                      quality=0
                  WHERE analyzed<>'t'");
      pwg_query("DELETE FROM ".$this->tables['images_colors']);
      pwg_query("UPDATE ".$this->tables['color_table']."
                 SET num_pixels=0, num_images=0;");
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
   * @return String : list of the analyzed pictures, with number of colors found
   *                  for each picture
   *                    "23=0;78=66;4523=33;5670=91;"
   */
  private function ajax_cstat_updateDatabaseDoAnalyze($imagesList)
  {
    $list=explode(" ", trim($imagesList));

    $returned="";

    if(count($list)>0 and trim($imagesList)!='')
    {
      // $path = path of piwigo's on the server filesystem
      $path=dirname(dirname(dirname(__FILE__)));

      $sql="SELECT id, path FROM ".IMAGES_TABLE." WHERE id IN (".implode(", ", $list).")";
      $result=pwg_query($sql);
      if($result)
      {
        $colorTable=ColorStat::getColorTable(
          CStat_root::$colorTableSize[$this->config['analyze_colorTable']][0],
          CStat_root::$colorTableSize[$this->config['analyze_colorTable']][1]
        );

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
          $returned.=$this->analyzeImageFile($path."/".$row['path'], $row['id'], $colorTable);
          //echo $returned."\n";
          //$mem2=memory_get_usage();
          //echo "memory after analyze:".$mem2." (".($mem2-$mem1).")\n";
        }
      }
    }
    return($returned);
  }


  /**
   * make consolidation for the color_table :
   *  - count number of images using a color
   *  - count number of pixels of a color
   */
  private function ajax_cstat_updateDatabaseConsolidation()
  {
    $this->updateDatabaseConsolidation();
    return("ok");
  }



  /**
   * return a formatted <table> (using the template "cstat_stat_show_iListColors")
   * of used tag with, for each tag, the number and the percentage of pictures
   * where the tag was found
   *
   * @param String $orderType : order for the list (by color 'color' or by number
   *                            of pictures 'img' or by number of pixels 'pixels')
   * @return String
   */
  private function ajax_cstat_showStatsGetListColors($orderType)
  {
    global $template;

    $this->config['display_stat_orderType'] = $orderType;
    $this->saveConfig();

    $local_tpl = new Template(CSTAT_PATH."admin/", "");
    $local_tpl->set_filename('body_page',
                  dirname($this->getFileLocation()).'/admin/cstat_stat_show_iListColors.tpl');

    $generalStats=CStat_functions::getGeneralStats();

    $sql="SELECT color_id, num_images, num_pixels
          FROM ".$this->tables['color_table']."
          WHERE num_images > 0 ";
    if($orderType=='color')
    {
      $sql.=" ORDER BY hue ASC, saturation ASC, value DESC";
    }
    elseif($orderType=='img')
    {
      $sql.=" ORDER BY num_images DESC, num_pixels DESC ";
    }
    elseif($orderType=='pixels')
    {
      $sql.=" ORDER BY num_pixels DESC, num_images DESC ";
    }

    $datas=Array();
    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_assoc($result))
      {
        $row['pct_images']=sprintf('%.2f', round(100*$row['num_images']/$generalStats['nbImages'],2));
        $row['pct_pixels']=sprintf('%.2f', round(100*$row['num_pixels']/$generalStats['pixelsAnalyzedSum'],2));
        $datas[]=$row;
      }
    }

    $local_tpl->assign('themeconf', Array('name' => $template->get_themeconf('name')));
    $local_tpl->assign('datas', $datas);

    return($local_tpl->parse('body_page', true));
  }

} //class


?>
