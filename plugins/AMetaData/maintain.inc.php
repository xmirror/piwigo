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
 */

if (!defined('PHPWG_ROOT_PATH')) { die('Hacking attempt!'); }

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', true);

include_once('amd_version.inc.php'); // => Don't forget to update this file !!


defined('AMD_DIR') || define('AMD_DIR' , basename(dirname(__FILE__)));
defined('AMD_PATH') || define('AMD_PATH' , PHPWG_PLUGINS_PATH . AMD_DIR . '/');
include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCCore.class.inc.php');
include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCTables.class.inc.php');


global $gpcInstalled, $lang; //needed for plugin manager compatibility

/* -----------------------------------------------------------------------------
 * AMD needs the Grum Plugin Classe
 * -------------------------------------------------------------------------- */
$gpcInstalled=false;
if(file_exists(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/CommonPlugin.class.inc.php'))
{
  @include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/CommonPlugin.class.inc.php');
  // need GPC release greater or equal than AMD_GPC_NEEDED
  if(CommonPlugin::checkGPCRelease(AMD_GPC_NEEDED))
  {
    @include_once("amd_install.class.inc.php");
    $gpcInstalled=true;
  }
}

function gpcMsgError(&$errors)
{
  $msg=sprintf(l10n('To install this plugin, you need to install Grum Plugin Classes %s before'), AMD_GPC_NEEDED);
  if(is_array($errors))
  {
    array_push($errors, $msg);
  }
  else
  {
    $errors=Array($msg);
  }
}
// -----------------------------------------------------------------------------



load_language('plugin.lang', AMD_PATH);

function plugin_install($plugin_id, $plugin_version, &$errors)
{
  global $prefixeTable, $gpcInstalled;
  if($gpcInstalled)
  {
    $amd=new AMD_install($prefixeTable, __FILE__);
    $result=$amd->install();
  }
  else
  {
    gpcMsgError($errors);
  }
}

function plugin_activate($plugin_id, $plugin_version, &$errors)
{
  global $prefixeTable, $gpcInstalled;
  if($gpcInstalled)
  {
    $amd=new AMD_install($prefixeTable, __FILE__);
    $result=$amd->activate();
  }
}

function plugin_deactivate($plugin_id)
{
  global $prefixeTable, $gpcInstalled;

  if($gpcInstalled)
  {
    $amd=new AMD_install($prefixeTable, __FILE__);
    $amd->deactivate();
  }
}

function plugin_uninstall($plugin_id)
{
  global $prefixeTable, $gpcInstalled;
  if($gpcInstalled)
  {
    $amd=new AMD_install($prefixeTable, __FILE__);
    $result=$amd->uninstall();
  }
  else
  {
    gpcMsgError($errors);
  }
}



?>
