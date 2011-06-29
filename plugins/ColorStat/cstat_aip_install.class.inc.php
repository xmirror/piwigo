<?php
/* -----------------------------------------------------------------------------
  Plugin     : ColorStat
  Author     : Grum
    email    : grum@piwigo.org
    website  : http://photos.grum.fr

    << May the Little SpaceFrog be with you ! >>
  ------------------------------------------------------------------------------
  See main.inc.php for release information

  --------------------------------------------------------------------------- */

  if(!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

include_once('cstat_root.class.inc.php');
include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCTables.class.inc.php');
include_once(PHPWG_ROOT_PATH.'admin/include/tabsheet.class.php');

class CStat_AIPInstall extends CStat_root
{
  protected $tabsheet;

  public function __construct($prefixeTable, $filelocation)
  {
    parent::__construct($prefixeTable, $filelocation);
    $this->loadConfig();
    $this->initEvents();

    $this->tabsheet = new tabsheet();
    $this->tabsheet->add('install',
                          l10n('cstat_install'),
                          $this->getAdminLink()."&amp;f_tabsheet=install");
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
    add_event_handler('loc_end_page_header', array(&$this->css, 'applyCSS'));
  }

  /*
    display administration page
  */
  public function manage()
  {
    global $template;

    $this->checkRequest();
    $this->returnAjaxContent();

    $template->set_filename('plugin_admin_content', dirname($this->getFileLocation())."/admin/cstat_admin.tpl");

    $this->displayInstallPage();

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
        case 'installProcess':
          $result=$this->ajax_installProcess($_REQUEST['tableSize']);
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
    $_REQUEST['f_tabsheet']='install';

    if(isset($_REQUEST['ajaxfct']))
    {
      if($_REQUEST['ajaxfct']=='installProcess')
      {
        if(!isset($_REQUEST['tableSize'])) $_REQUEST['tableSize']='small';
      }
    }
  }


  /**
   * display config page
   */
  protected function displayInstallPage()
  {
    global $template, $lang;



    $template->set_filename('body_page',
                dirname($this->getFileLocation()).'/admin/cstat_install_page.tpl');

    $smallColorTable=ColorStat::getColorTable(CStat_root::$colorTableSize['small'][0],CStat_root::$colorTableSize['small'][1]);
    $largeColorTable=ColorStat::getColorTable(CStat_root::$colorTableSize['large'][0],CStat_root::$colorTableSize['large'][1]);
    $template->assign('smallTableColor', CStat_functions::htmlColorTable($smallColorTable, 19, '', 'color0px'));
    $template->assign('largeTableColor', CStat_functions::htmlColorTable($largeColorTable, 10, '', 'color0px'));

    $template->assign(
      'smallColorList1',
      CStat_functions::htmlColorList(
        ColorStat::getFileColors(dirname($this->getFileLocation()).'/image/sample1.png', $smallColorTable, Array('quality' => 8, 'numColors' => 16)),
        16, 18, '', 'colorListSample color0px'
      )
    );
    $pps=ColorStat::$fileColorsStat['pps'];

    $template->assign(
      'largeColorList1',
      CStat_functions::htmlColorList(
        ColorStat::getFileColors(dirname($this->getFileLocation()).'/image/sample1.png', $largeColorTable, Array('quality' => 8, 'numColors' => 16)),
        16, 18, '', 'colorListSample color0px'
      )
    );
    $pps+=ColorStat::$fileColorsStat['pps'];

    $template->assign(
      'smallColorList2',
      CStat_functions::htmlColorList(
        ColorStat::getFileColors(dirname($this->getFileLocation()).'/image/sample2.png', $smallColorTable, Array('quality' => 8, 'numColors' => 16)),
        16, 18, '', 'colorListSample color0px'
      )
    );
    $pps+=ColorStat::$fileColorsStat['pps'];

    $template->assign(
      'largeColorList2',
      CStat_functions::htmlColorList(
        ColorStat::getFileColors(dirname($this->getFileLocation()).'/image/sample2.png', $largeColorTable, Array('quality' => 8, 'numColors' => 16)),
        16, 18, '', 'colorListSample color0px'
      )
    );
    $pps+=ColorStat::$fileColorsStat['pps'];

    unset($smallColorTable);
    unset($largeColorTable);

    $this->config['analyze_pps']=round($pps/4,0);
    $this->saveConfig();

    $template->assign('urlRequest', $this->getAdminLink());
    $template->assign('help',
      Array(
        'SmallColorTable' => GPCCore::BBtoHTML(l10n('cstat_help_small_color_table')),
        'LargeColorTable' => GPCCore::BBtoHTML(l10n('cstat_help_large_color_table')),
        'Step1' => GPCCore::BBtoHTML(l10n('cstat_step_1_help')),

      )
    );



    $template->assign_var_from_handle('CSTAT_BODY_PAGE', 'body_page');
  } //displayInstallPage




  /* ---------------------------------------------------------------------------
    function to manage database manipulation
  --------------------------------------------------------------------------- */


  /* ---------------------------------------------------------------------------
    ajax functions
  --------------------------------------------------------------------------- */
  protected function ajax_installProcess($tableSize)
  {
    $this->config['newInstall']='n';
    $this->config['analyze_colorTable']=$tableSize;
    $this->saveConfig();

    $colorTable=ColorStat::getColorTable(CStat_root::$colorTableSize[$tableSize][0],CStat_root::$colorTableSize[$tableSize][1]);

    foreach($colorTable as $key => $hue)
    {
      foreach($hue as $key2 => $saturation)
      {
        foreach($saturation as $key3=>$value)
        {
          $hsv=$value->get();
          $sql.=(($sql=="")?"":", ")."('".$value->getRGB()->getHexString()."',
                 '".$hsv['H']."',
                 '".$hsv['S']."',
                 '".$hsv['V']."',
                 0, 0)";
        }
      }
    }
    $sql="REPLACE INTO ".$this->tables['color_table']."
              VALUES ".$sql;
    pwg_query($sql);
    return("OK");
  }

} //class


?>
