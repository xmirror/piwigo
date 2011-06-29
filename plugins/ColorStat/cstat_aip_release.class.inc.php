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
 * AIPRelease class => display warning if GPC release is not up to date
 *
 * -----------------------------------------------------------------------------
 */


if(!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

include_once('cstat_root.class.inc.php');

class CStat_AIPRelease extends CSTAT_root
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

    $template->set_filename('plugin_admin_content', dirname($this->getFileLocation())."/admin/cstat_admin.tpl");

    $pluginInfo=array(
      'CSTAT_VERSION' => "<i>".$this->getPluginName()."</i> ".l10n('g003_version').CSTAT_VERSION,
      'PATH' => CSTAT_PATH
    );

    $template->assign('plugin', $pluginInfo);
    $template->assign('CSTAT_BODY_PAGE', '<p class="warnings">'.sprintf(l10n('cstat_gpc_not_up_to_date'),CSTAT_GPC_NEEDED, GPC_VERSION).'</p>');
    $template->assign_var_from_handle('ADMIN_CONTENT', 'plugin_admin_content');
  }




} //class


?>
