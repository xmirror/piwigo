<?php
/* -----------------------------------------------------------------------------
  Plugin     : Grum Plugin Classes - 3
  Author     : Grum
    email    : grum@piwigo.org
    website  : http://photos.grum.fr

    << May the Little SpaceFrog be with you ! >>
  ------------------------------------------------------------------------------
  See main.inc.php for release information

  AI classe => manage integration in administration interface

  --------------------------------------------------------------------------- */
if (!defined('PHPWG_ROOT_PATH')) { die('Hacking attempt!'); }

include_once('gpc_aim.class.inc.php');
include_once(PHPWG_ROOT_PATH.'admin/include/tabsheet.class.php');
include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCCore.class.inc.php');

class GPC_AIP extends GPC_AIM
{
  protected $tabsheet;

  public function __construct($prefixeTable, $filelocation)
  {
    parent::__construct($prefixeTable, $filelocation);

    $this->loadConfig();
    $this->initEvents();

    $this->tabsheet = new tabsheet();
    $this->tabsheet->add('infos',
                          l10n('Infos'),
                          '');
  }

  public function __destruct()
  {
    parent::__destruct();
  }

  /*
    initialize events call for the plugin
  */
  function initEvents()
  {
    add_event_handler('loc_end_page_header', array(&$this->css, 'applyCSS'));
  }


  /* ---------------------------------------------------------------------------
  Public classe functions
  --------------------------------------------------------------------------- */

  /*
    manage plugin integration into piwigo's admin interface
  */
  public function manage()
  {
    global $template;

    $template->set_filename('plugin_admin_content', dirname(__FILE__)."/admin/gpc_admin.tpl");

    $this->displayStats();

    $this->tabsheet->select('infos');
    $this->tabsheet->assign();
    $selected_tab=$this->tabsheet->get_selected();
    $template->assign($this->tabsheet->get_titlename(), "[".$selected_tab['caption']."]");

    $template_plugin["GPC_VERSION"] = "<i>".$this->getPluginName()."</i> ".l10n('version').GPC_VERSION;

    $template->assign('plugin', $template_plugin);
    $template->assign_var_from_handle('ADMIN_CONTENT', 'plugin_admin_content');
  }

  /* ---------------------------------------------------------------------------
  Private classe functions
  --------------------------------------------------------------------------- */


  private function displayStats()
  {
    global $template;

    $template->set_filename('body_page', dirname(__FILE__)."/admin/gpc_infos.tpl");

    $template_datas = array();

    $template_datas['modules']=GPCCore::getModulesInfos();
    $template_datas['plugins']=GPCCore::getRegistered();

    $template->assign('datas', $template_datas);
    $template->assign_var_from_handle('GPC_BODY_PAGE', 'body_page');
  }

  /* ---------------------------------------------------------------------------
   * AJAX functions
   * ------------------------------------------------------------------------- */

} // GPC_AIP class


?>
