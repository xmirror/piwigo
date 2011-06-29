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
 * -----------------------------------------------------------------------------
*/

if (!defined('PHPWG_ROOT_PATH')) { die('Hacking attempt!'); }

global $prefixeTable, $template;

load_language('plugin.lang', AMD_PATH);

$main_plugin_object = get_plugin_data($plugin_id);





if(CommonPlugin::checkGPCRelease(3,2,0))
{
  $config=Array();
  GPCCore::loadConfig('amd', $config);


  if(!isset($config['installed'])) $config['installed']='00.04.00';
  if($config['installed']!=AMD_VERSION2)
  {
    /* the plugin was updated without being deactivated
     * deactivate + activate the plugin to process the database upgrade
     */
    include(AMD_PATH."amd_install.class.inc.php");
    $amd=new AMD_install($prefixeTable, dirname(__FILE__));
    $amd->deactivate();
    $amd->activate();
    $template->delete_compiled_templates();
    $config['newInstall']='n';
  }

  /*
   * if the plugin is newly installed, display a special configuration page
   * otherwise, display normal page
   */
  if($config['newInstall']=='n')
  {
    include(AMD_PATH."amd_aip.class.inc.php");
    $plugin_ai = new AMD_AIP($prefixeTable, $main_plugin_object->getFileLocation());}
  else
  {
    include(AMD_PATH."amd_aip_install.class.inc.php");
    $plugin_ai = new AMD_AIPInstall($prefixeTable, $main_plugin_object->getFileLocation());
  }
}
else
{
  /*
   * plugin was upgraded, but GPC was not
   * display a page to inform user to upgrade GPC
   */
  include(AMD_PATH."amd_aip_release.class.inc.php");
  $plugin_ai = new AMD_AIPRelease($prefixeTable, $main_plugin_object->getFileLocation());
}

$plugin_ai->manage();




?>
