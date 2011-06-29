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

if (!defined('PHPWG_ROOT_PATH')) { die('Hacking attempt!'); }

global $prefixeTable, $template;
load_language('plugin.lang', CSTAT_PATH);

$main_plugin_object = get_plugin_data($plugin_id);


if(CommonPlugin::checkGPCRelease(3,2,0))
{
  $config=Array();
  GPCCore::loadConfig('cstat', $config);

  if(!isset($config['installed'])) $config['installed']='01.00.01';
  if($config['installed']!=CSTAT_VERSION2)
  {
    /* the plugin was updated without being deactivated
     * deactivate + activate the plugin to process the database upgrade
     */
    include(CSTAT_PATH."cstat_install.class.inc.php");
    $cstat=new CStat_Install($prefixeTable, dirname(__FILE__));
    $cstat->deactivate();
    $cstat->activate();
    $template->delete_compiled_templates();
    $config['newInstall']='n';
  }

  /*
   * if the plugin is newly installed, display a special configuration page
   * otherwise, display normal page
   */
  if($config['newInstall']=='n')
  {
    include(CSTAT_PATH."cstat_aip.class.inc.php");
    $plugin_ai = new CStat_AIP($prefixeTable, $main_plugin_object->getFileLocation());
  }
  else
  {
    include(CSTAT_PATH."cstat_aip_install.class.inc.php");
    $plugin_ai = new CStat_AIPInstall($prefixeTable, $main_plugin_object->getFileLocation());
  }
}
else
{
  /*
   * plugin was upgraded, but GPC was not
   * display a page to inform user to upgrade GPC
   */
  include(CSTAT_PATH."cstat_aip_release.class.inc.php");
  $plugin_ai = new CStat_AIPRelease($prefixeTable, $main_plugin_object->getFileLocation());
}

$plugin_ai->manage();



?>
