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
 * AIPRealse class => display warning if GPC release is not up to date
 *
 * -----------------------------------------------------------------------------
 */


if(!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

include_once('amd_root.class.inc.php');

class AMD_AIPRelease extends AMD_root
{
  public function __construct($prefixeTable, $filelocation)
  {
    parent::__construct($prefixeTable, $filelocation);
    $this->loadConfig();
    $this->initEvents();
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

    $template->set_filename('plugin_admin_content', dirname($this->getFileLocation())."/admin/amd_admin.tpl");

    $pluginInfo=array(
      'AMD_VERSION' => "<i>".$this->getPluginName()."</i> ".l10n('g003_version').AMD_VERSION,
      'PATH' => AMD_PATH
    );

    $template->assign('plugin', $pluginInfo);
    $template->assign('AMD_BODY_PAGE', '<p class="warnings">'.sprintf(l10n('g003_gpc_not_up_to_date'),AMD_GPC_NEEDED, GPC_VERSION).'</p>');
    $template->assign_var_from_handle('ADMIN_CONTENT', 'plugin_admin_content');
  }




} //class


?>
