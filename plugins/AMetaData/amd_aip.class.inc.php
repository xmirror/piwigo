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
 * AIP classe => manage integration in administration interface
 *
 * -----------------------------------------------------------------------------
 */

if (!defined('PHPWG_ROOT_PATH')) { die('Hacking attempt!'); }

include_once('amd_root.class.inc.php');
include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCTabSheet.class.inc.php');
include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCAjax.class.inc.php');
include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/genericjs.class.inc.php');


class AMD_AIP extends AMD_root
{
  protected $tabsheet;

  /**
   *
   * constructor needs the prefix of piwigo's tables and the location of plugin
   *
   * @param String $prefixeTable
   * @param String $filelocation
   */
  public function __construct($prefixeTable, $filelocation)
  {
    parent::__construct($prefixeTable, $filelocation);

    $this->loadConfig();
    $this->configForTemplate();
    $this->initEvents();

    $this->tabsheet = new tabsheet();

    if($this->config['amd_InterfaceMode']=='basic')
    {
      $this->tabsheet->add('metadata',
                            l10n('g003_metadata'),
                            $this->getAdminLink().'&amp;fAMD_tabsheet=metadata');
      $this->tabsheet->add('help',
                            l10n('g003_help'),
                            $this->getAdminLink().'&amp;fAMD_tabsheet=help');
    }
    else
    {
      $this->tabsheet->add('database',
                            l10n('g003_database'),
                            $this->getAdminLink().'&amp;fAMD_tabsheet=database');
      $this->tabsheet->add('metadata',
                            l10n('g003_metadata'),
                            $this->getAdminLink().'&amp;fAMD_tabsheet=metadata');
      $this->tabsheet->add('search',
                            l10n('g003_search'),
                            $this->getAdminLink().'&amp;fAMD_tabsheet=search');
      $this->tabsheet->add('tags',
                            l10n('g003_tags'),
                            $this->getAdminLink().'&amp;fAMD_tabsheet=tags');
      $this->tabsheet->add('help',
                            l10n('g003_help'),
                            $this->getAdminLink().'&amp;fAMD_tabsheet=help');
    }
  }

  public function __destruct()
  {
    unset($this->tabsheet);
    unset($this->ajax);
    parent::__destruct();
  }


  /*
   * ---------------------------------------------------------------------------
   * Public classe functions
   * ---------------------------------------------------------------------------
   */


  /**
   * manage the plugin integration into piwigo's admin interface
   */
  public function manage()
  {
    global $template, $page;

    $this->initRequest();

    $template->set_filename('plugin_admin_content', dirname(__FILE__)."/admin/amd_admin.tpl");

    $this->tabsheet->select($_REQUEST['fAMD_tabsheet']);
    $this->tabsheet->assign();
    $selected_tab=$this->tabsheet->get_selected();
    $template->assign($this->tabsheet->get_titlename(), "[".$selected_tab['caption']."]");

    $pluginInfo=array(
      'AMD_VERSION' => "<i>".$this->getPluginName()."</i> ".l10n('g003_version').AMD_VERSION,
      'AMD_PAGE' => $_REQUEST['fAMD_tabsheet'],
      'PATH' => AMD_PATH
    );

    $template->assign('plugin', $pluginInfo);

    switch($_REQUEST['fAMD_tabsheet'])
    {
      case 'help':
        $this->displayHelp();
        break;
      case 'database':
        $this->displayDatabase($_REQUEST['fAMD_page']);
        break;
      case 'metadata':
        $this->displayMetaData($_REQUEST['fAMD_page']);
        break;
      case 'search':
        $this->displaySearch($_REQUEST['fAMD_page']);
        break;
      case 'tags':
        $this->displayTags();
        break;
    }

    $template->assign_var_from_handle('ADMIN_CONTENT', 'plugin_admin_content');
  }

  /**
   * initialize events call for the plugin
   *
   * don't inherits from its parent => it's normal
   */
  public function initEvents()
  {
    if(isset($_REQUEST['fAMD_tabsheet']) and $_REQUEST['fAMD_tabsheet']=='search')
    {
      // load request builder JS only on the search page
      GPCRequestBuilder::loadJSandCSS();
    }

    add_event_handler('loc_end_page_header', array(&$this->css, 'applyCSS'));
    GPCCss::applyGpcCss();
  }

  /**
   * ---------------------------------------------------------------------------
   * Private & protected functions
   * ---------------------------------------------------------------------------
   */

  /**
   * if empty, initialize the $_REQUEST var
   *
   * if not empty, check validity for the request values
   *
   */
  private function initRequest()
  {
    //initialise $REQUEST values if not defined

    if(!isset($_REQUEST['fAMD_tabsheet']))
    {
      if($this->getNumOfPictures()==0 and $this->config['amd_InterfaceMode']=='advanced')
      {
        $_REQUEST['fAMD_tabsheet']="database";
        $_REQUEST['fAMD_page']="state";
      }
      else
      {
        $_REQUEST['fAMD_tabsheet']="metadata";
        $_REQUEST['fAMD_page']="select";
      }
    }

    if(!($_REQUEST['fAMD_tabsheet']=="metadata" or
         $_REQUEST['fAMD_tabsheet']=="help" or
         $_REQUEST['fAMD_tabsheet']=="database" or
         $_REQUEST['fAMD_tabsheet']=="search" or
         $_REQUEST['fAMD_tabsheet']=="tags")
         or
         $this->config['amd_InterfaceMode']=='basic' and
         (
           $_REQUEST['fAMD_tabsheet']=="database" or
           $_REQUEST['fAMD_tabsheet']=="search" or
           $_REQUEST['fAMD_tabsheet']=="tags"
         )
      )
    {
      $_REQUEST['fAMD_tabsheet']="metadata";
    }

    /*
     * metadata tabsheet
     */
    if($_REQUEST['fAMD_tabsheet']=="metadata")
    {
      if(!isset($_REQUEST['fAMD_page']))
      {
        if($this->config['amd_InterfaceMode']=='basic')
        {
          $_REQUEST['fAMD_page']="display";
        }
        else
        {
          $_REQUEST['fAMD_page']="select";
        }
      }

      if(!($_REQUEST['fAMD_page']=="personnal" or
           $_REQUEST['fAMD_page']=="select" or
           $_REQUEST['fAMD_page']=="display")
           or
           $this->config['amd_InterfaceMode']=='basic' and
           (
             $_REQUEST['fAMD_page']=="select"
           )
        )
      {
        if($this->config['amd_InterfaceMode']=='basic')
        {
          $_REQUEST['fAMD_page']="display";
        }
        else
        {
          $_REQUEST['fAMD_page']="select";
        }
      }
    }

    /*
     * help tabsheet
     */
    if($_REQUEST['fAMD_tabsheet']=="help")
    {
      if(!isset($_REQUEST['fAMD_page'])) $_REQUEST['fAMD_page']="exif";

      if(!($_REQUEST['fAMD_page']=="exif" or
           $_REQUEST['fAMD_page']=="iptc" or
           $_REQUEST['fAMD_page']=="xmp" or
           $_REQUEST['fAMD_page']=="magic")) $_REQUEST['fAMD_page']="exif";
    }

    /*
     * search tabsheet
     */
    if($_REQUEST['fAMD_tabsheet']=="search")
    {
      if(!isset($_REQUEST['fAMD_page'])) $_REQUEST['fAMD_page']="search";

      if(!($_REQUEST['fAMD_page']=="config" or
           $_REQUEST['fAMD_page']=="search")) $_REQUEST['fAMD_page']="search";
    }

    /*
     * database tabsheet
     */
    if($_REQUEST['fAMD_tabsheet']=="database")
    {
      if(!isset($_REQUEST['fAMD_page'])) $_REQUEST['fAMD_page']="state";

      if(!($_REQUEST['fAMD_page']=="state" or
           $_REQUEST['fAMD_page']=="update")) $_REQUEST['fAMD_page']="state";
    }


  } //init_request


  /**
   * manage adviser profile
   *
   * @return Boolean : true if user is adviser, otherwise false (and push a
   *                   message in the error list)
   */
  protected function adviser_abort()
  {
    if(is_adviser())
    {
      $this->display_result(l10n("g003_adviser_not_allowed"), false);
      return(true);
    }
    return(false);
  }




  /**
   * display and manage the search page
   */
  protected function displaySearch()
  {
    global $template, $lang;

    $template->set_filename('body_page',
                dirname($this->getFileLocation()).'/admin/amd_metadata_search.tpl');

    $template->assign('amd_search_page', GPCRequestBuilder::displaySearchPage('AMetaData'));

    $template->assign_var_from_handle('AMD_BODY_PAGE', 'body_page');
  }




  /**
   * display and manage the metadata page
   * the page have three tabsheet :
   *  - personnal tag management, to build personnal tags
   *  - select tag management, to manage tags to be selected on the galerie
   *  - display tag management, to choose how the tags are displayed
   *
   * @param String $tab : the selected tab on the stat page
   */
  protected function displayMetaData($tab)
  {
    global $template, $user;
    $template->set_filename('body_page', dirname(__FILE__).'/admin/amd_metadata.tpl');

    $statTabsheet = new GPCTabSheet('statTabsheet', $this->tabsheet->get_titlename(), 'tabsheet2 gcBorder', 'itab2');
    $statTabsheet->select($tab);
    $statTabsheet->add('personnal',
                          l10n('g003_personnal'),
                          $this->getAdminLink().'&amp;fAMD_tabsheet=metadata&amp;fAMD_page=personnal');
    if($this->config['amd_InterfaceMode']=='advanced')
    {
      $statTabsheet->add('select',
                            l10n('g003_select'),
                            $this->getAdminLink().'&amp;fAMD_tabsheet=metadata&amp;fAMD_page=select');
    }
    $statTabsheet->add('display',
                          l10n('g003_display'),
                          $this->getAdminLink().'&amp;fAMD_tabsheet=metadata&amp;fAMD_page=display');
    $statTabsheet->assign();

    switch($tab)
    {
      case 'select':
        $template->assign('sheetContent', $this->displayMetaDataSelect());
        break;
      case 'display':
        $template->assign('sheetContent', $this->displayMetaDataDisplay());
        break;
      case 'personnal':
        $template->assign('sheetContent', $this->displayMetaDataPersonnal());
        break;
    }

    $template->assign_var_from_handle('AMD_BODY_PAGE', 'body_page');
  }


  /**
   * display and manage the metadata page allowing to build user defined tags
   *
   * @return String : the content of the page
   */
  protected function displayMetaDataPersonnal()
  {
    global $template, $theme, $themes, $themeconf, $lang;

    $template->set_filename('sheet_page',
                  dirname($this->getFileLocation()).'/admin/amd_metadata_personnal.tpl');

    $datas=array(
      'urlRequest' => $this->getAdminLink('ajax'),
      'tagList' => array(),
    );

    /*
     * build tagList
     */
    $sql="SELECT ut.name, ut.numId, ut.tagId
          FROM ".$this->tables['used_tags']." ut
            JOIN ".$this->tables['selected_tags']." st ON st.tagId = ut.tagId
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

    $lang['g003_personnal_page_help']=GPCCore::BBtoHTML($lang['g003_personnal_page_help']);

    $template->assign('datas', $datas);
    return($template->parse('sheet_page', true));
  }


  /**
   * display and manage the metadata page allowing to make tags selection
   *
   * @return String : the content of the page
   */
  protected function displayMetaDataSelect()
  {
    global $template, $theme, $themes, $themeconf, $lang;

    $template->set_filename('sheet_page',
                  dirname($this->getFileLocation()).'/admin/amd_metadata_select.tpl');

    $datas=array(
      'urlRequest' => $this->getAdminLink('ajax'),
      'config_GetListTags_OrderType' => $this->config['amd_GetListTags_OrderType'],
      'config_GetListTags_FilterType' => $this->config['amd_GetListTags_FilterType'],
      'config_GetListTags_ExcludeUnusedTag' => $this->config['amd_GetListTags_ExcludeUnusedTag'],
      'config_GetListTags_SelectedTagOnly' => $this->config['amd_GetListTags_SelectedTagOnly'],
      'config_GetListImages_OrderType' => $this->config['amd_GetListImages_OrderType']
    );

    $lang['g003_select_page_help']=GPCCore::BBtoHTML($lang['g003_select_page_help']);

    $template->assign('datas', $datas);
    return($template->parse('sheet_page', true));
  }


  /**
   * display and manage the metadata page allowing to choose tags order
   *
   * @return String : the content of the page
   */
  protected function displayMetaDataDisplay()
  {
    global $user, $template, $lang;

    //$local_tpl = new Template(AMD_PATH."admin/", "");
    $template->set_filename('sheet_page',
                  dirname($this->getFileLocation()).'/admin/amd_metadata_display.tpl');

    $datas=array(
      'urlRequest' => $this->getAdminLink('ajax'),
      'selectedTags' => Array(),
      'groups' => Array(),
      'tagByGroup' => Array(),
    );

    $sql="SELECT st.tagId, st.order, st.groupId, ut.numId
          FROM ".$this->tables['selected_tags']." st
            LEFT JOIN ".$this->tables['used_tags']." ut
              ON ut.tagId = st.tagId
          ORDER BY st.groupId ASC, st.order ASC, st.tagId ASC";
    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_assoc($result))
      {
        if($row['groupId']==-1)
        {
          $datas['selectedTags'][]=Array(
            'numId' => $row['numId'],
            'tagId' => $row['tagId']
          );
        }
        else
        {
          $datas['tagByGroup'][]=Array(
            'numId' => $row['numId'],
            'tagId' => $row['tagId'],
            'group' => $row['groupId'],
            'order' => $row['order']
          );
        }
      }
    }

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
          'name' => $row['name']
        );
      }
    }

    $lang['g003_display_page_help']=GPCCore::BBtoHTML($lang['g003_display_page_help']);
    $template->assign('datas', $datas);
    return($template->parse('sheet_page', true));
  }


  /**
   * display and manage the database page
   * the page have two tabsheet :
   *  - state, to have general information about the database
   *  - update, to manage database fill-in
   *
   * @param String $tab : the selected tab on the stat page
   */
  protected function displayDatabase($tab)
  {
    global $template, $user;
    $template->set_filename('body_page', dirname(__FILE__).'/admin/amd_metadata.tpl');

    $statTabsheet = new GPCTabSheet('statTabsheet', $this->tabsheet->get_titlename(), 'tabsheet2 gcBorder', 'itab2');
    $statTabsheet->select($tab);
    $statTabsheet->add('state',
                          l10n('g003_state'),
                          $this->getAdminLink().'&amp;fAMD_tabsheet=database&amp;fAMD_page=state');
    $statTabsheet->add('update',
                          l10n('g003_update'),
                          $this->getAdminLink().'&amp;fAMD_tabsheet=database&amp;fAMD_page=update');
    $statTabsheet->assign();

    switch($tab)
    {
      case 'state':
        $template->assign('sheetContent', $this->displayDatabaseStatus());
        break;
      case 'update':
        $template->assign('sheetContent', $this->displayDatabaseDatabase());
        break;
    }

    $template->assign_var_from_handle('AMD_BODY_PAGE', 'body_page');
  }



  /**
   * display the database status
   *
   * @return String : the content of the page
   */
  private function displayDatabaseStatus()
  {
    global $template, $page;

    $template->set_filename('sheet_page', dirname(__FILE__).'/admin/amd_metadata_database_status.tpl');

    $warning2='';
    $sql="SELECT tagId
          FROM ".$this->tables['used_tags']."
          WHERE newFromLastUpdate='y'";
    $result=pwg_query($sql);
    if($result)
    {
      $tmp=array();
      $tagSchema='';
      while($row=pwg_db_fetch_assoc($result))
      {
        if(preg_match('/^([a-z0-9]*)\..*/i', $row['tagId'], $tagSchema))
        {
          if(!in_array($tagSchema[1],$this->config['amd_FillDataBaseIgnoreSchemas'])) $tmp[]=$row['tagId'];
        }
      }
      if(count($tmp)>0)
      {
        $ul='';
        foreach($tmp as $val)
        {
          $ul.='<li>'.$val.'</li>';
        }
        if(count($tmp)>1)
        {
          $warning2=sprintf(GPCCore::BBtoHTML(l10n('g003_databaseWarning2_n')),$ul);
        }
        else
        {
          $warning2=sprintf(GPCCore::BBtoHTML(l10n('g003_databaseWarning2_1')),$ul);
        }
      }
    }


    $datas=array(
      'urlRequest' => $this->getAdminLink('ajax'),
      'warning2' => $warning2,
      'warning1' => GPCCore::BBtoHTML(l10n('g003_databaseWarning1')),
      'nfoMetadata' => Array(
          'exif' => 0,
          'iptc' => 0,
          'magic' => 0,
          'xmp' => 0,
          'com' => 0,
          'userDefined' => 0,
          'numOfPictures' => 0,
          'numOfNotAnalyzedPictures' => 0,
          'numOfPicturesWithoutTag' => 0,
          'nfoSize' => 0,
          'nfoRows' => 0,
          'nfoSizeAndRows' => '',
        )
    );

    $sql="SELECT SUM(numOfImg) AS nb, 'exif' AS `type`
          FROM ".$this->tables['used_tags']."
          WHERE tagId LIKE 'exif.%'
          UNION
          SELECT SUM(numOfImg), 'iptc'
          FROM ".$this->tables['used_tags']."
          WHERE tagId LIKE 'iptc.%'
          UNION
          SELECT SUM(numOfImg), 'magic'
          FROM ".$this->tables['used_tags']."
          WHERE tagId LIKE 'magic.%'
          UNION
          SELECT SUM(numOfImg), 'xmp'
          FROM ".$this->tables['used_tags']."
          WHERE tagId LIKE 'xmp.%'
          UNION
          SELECT SUM(numOfImg), 'com'
          FROM ".$this->tables['used_tags']."
          WHERE tagId LIKE 'com.%'
          UNION
          SELECT SUM(numOfImg), 'userDefined'
          FROM ".$this->tables['used_tags']."
          WHERE tagId LIKE 'userDefined.%'
          UNION
          SELECT COUNT(imageId), 'numOfPictures'
          FROM ".$this->tables['images']."
          WHERE analyzed='y'
          UNION
          SELECT COUNT(imageId), 'numOfNotAnalyzedPictures'
          FROM ".$this->tables['images']."
          WHERE analyzed='n'
          UNION
          SELECT COUNT(imageId), 'numOfPicturesWithoutTag'
          FROM ".$this->tables['images']."
          WHERE nbTags=0";
    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_assoc($result))
      {
        if(!is_null($row['nb']))
        {
          $datas['nfoMetadata'][$row['type']]=$row['nb'];
          if($row['type']=='exif' or
             $row['type']=='iptc' or
             $row['type']=='magic' or
             $row['type']=='xmp' or
             $row['type']=='com' or
             $row['type']=='userDefined') $datas['nfoMetadata']['nfoRows']+=$row['nb'];
        }
      }
    }

    $sql="SHOW TABLE STATUS WHERE name LIKE '".$this->tables['images_tags']."'";
    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_assoc($result))
      {
        $datas['nfoMetadata']['nfoSize']=$row['Data_length']+$row['Index_length'];
      }
    }

    if($datas['nfoMetadata']['nfoSize']<1048576)
    {
      $datas['nfoMetadata']['nfoSize']=sprintf('%.2fKio', $datas['nfoMetadata']['nfoSize']/1024);
    }
    else
    {
      $datas['nfoMetadata']['nfoSize']=sprintf('%.2fMio', $datas['nfoMetadata']['nfoSize']/1048576);
    }
    $datas['nfoMetadata']['nfoSizeAndRows']=sprintf(l10n('g003_sizeAndRows'), $datas['nfoMetadata']['nfoSize'], $datas['nfoMetadata']['nfoRows']);
    $datas['nfoMetadata']['numOfPictures']=sprintf(l10n('g003_numberOfAnalyzedPictures'), $datas['nfoMetadata']['numOfPictures']);
    $datas['nfoMetadata']['numOfNotAnalyzedPictures']=sprintf(l10n('g003_numberOfNotAnalyzedPictures'), $datas['nfoMetadata']['numOfNotAnalyzedPictures']);
    $datas['nfoMetadata']['numOfPicturesWithoutTag']=sprintf(l10n('g003_numberOfPicturesWithoutTags'), $datas['nfoMetadata']['numOfPicturesWithoutTag']);

    $template->assign("datas", $datas);

    return($template->parse('sheet_page', true));
  } // displayDatabaseStatus




  /**
   * display and manage the database page
   *
   * the function automatically update the AMD tables :
   *  - add new pictures in the AMD image table (assuming image is not analyzed
   *    yet)
   *  - remove deleted pictures in the AMD image & image_tags table
   *
   * @return String : the content of the page
   */
  private function displayDatabaseDatabase()
  {
    global $template, $page, $user;

    /*
     * insert new image (from piwigo images table) in the AMD images table, with
     * statut 'not analyzed'
     */
    $sql="INSERT INTO ".$this->tables['images']."
            SELECT id, 'n', 0
              FROM ".IMAGES_TABLE."
              WHERE id NOT IN (SELECT imageId FROM ".$this->tables['images'].")";
    pwg_query($sql);


    /*
     * delete image who are in the AMD images table and not in the piwigo image
     * table
     */
    $sql="DELETE FROM ".$this->tables['images']."
            WHERE imageId NOT IN (SELECT id FROM ".IMAGES_TABLE.")";
    pwg_query($sql);


    /*
     * delete metadata for images that are not in the AMD image table
     */
    $sql="DELETE ait
          FROM ".$this->tables['images_tags']." ait
            JOIN (SELECT DISTINCT imageId FROM ".$this->tables['images_tags']." ) aitd
              ON ait.imageId=aitd.imageId
          WHERE aitd.imageId NOT IN (SELECT id FROM ".IMAGES_TABLE.") ";
    pwg_query($sql);


    $caddieNbPictures=0;
    $sql="SELECT COUNT(element_id) AS nbPictures
          FROM ".CADDIE_TABLE."
          WHERE user_id='".$user['id']."';";
    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_assoc($result))
      {
        $caddieNbPictures=$row['nbPictures'];
      }
    }


    $template->set_filename('sheet_page', dirname(__FILE__).'/admin/amd_metadata_database_database.tpl');

    $datas=array(
      'urlRequest' => $this->getAdminLink('ajax'),
      'NumberOfItemsPerRequest' => $this->config['amd_NumberOfItemsPerRequest'],
      'caddieNbPictures' => ($caddieNbPictures==1)?l10n('g003_1_picture_in_caddie'):sprintf(l10n('g003_n_pictures_in_caddie'), $caddieNbPictures)
    );

    $template->assign("datas", $datas);

    return($template->parse('sheet_page', true));
  } // displayDatabase





  /**
   * display and manage the help page
   *
   * @param String $tab : the selected tab on the help page
   */
  protected function displayHelp()
  {
    global $template, $user, $lang;
    $template->set_filename('body_page', dirname(__FILE__).'/admin/amd_help.tpl');

    $statTabsheet = new GPCTabSheet('statTabsheet', $this->tabsheet->get_titlename(), 'tabsheet2 gcBorder', 'itab2');
    $statTabsheet->add('exif',
                          l10n('g003_help_tab_exif'),
                          '', true, "displayHelp('exif');");
    $statTabsheet->add('iptc',
                          l10n('g003_help_tab_iptc'),
                          '', false, "displayHelp('iptc');");
    $statTabsheet->add('xmp',
                          l10n('g003_help_tab_xmp'),
                          '', false, "displayHelp('xmp');");
    $statTabsheet->add('magic',
                          l10n('g003_help_tab_magic'),
                          '', false, "displayHelp('magic');");
    $statTabsheet->assign();

    $data=Array(
      'sheetContent_exif' => GPCCore::BBtoHTML($lang['g003_help_exif']),
      'sheetContent_xmp' => GPCCore::BBtoHTML($lang['g003_help_xmp']),
      'sheetContent_iptc' => GPCCore::BBtoHTML($lang['g003_help_iptc']),
      'sheetContent_magic' => GPCCore::BBtoHTML($lang['g003_help_magic']),
      'title_exif' => l10n('g003_help_tab_exif'),
      'title_xmp' => l10n('g003_help_tab_xmp'),
      'title_iptc' => l10n('g003_help_tab_iptc'),
      'title_magic' => l10n('g003_help_tab_magic')
    );

    $template->assign('data', $data);

    $template->assign_var_from_handle('AMD_BODY_PAGE', 'body_page');
  }


  /**
   * display and manage the tags page
   *
   */
  protected function displayTags()
  {
    global $template, $user, $lang;
    $template->set_filename('body_page', dirname(__FILE__).'/admin/amd_metadata_tags.tpl');

    $datas=array(
      'urlRequest' => $this->getAdminLink('ajax')
    );

    $lang['g003_tags_page_help']=GPCCore::BBtoHTML($lang['g003_tags_page_help']);

    $template->assign('datas', $datas);

    $template->assign_var_from_handle('AMD_BODY_PAGE', 'body_page');
  }


} // AMD_AIP class


?>
