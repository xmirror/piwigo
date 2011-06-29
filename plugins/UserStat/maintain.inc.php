<?php
/* -----------------------------------------------------------------------------
  Plugin     : UserStat
  Author     : Grum
    email    : grum@piwigo.org
    website  : http://photos.grum.fr

    << May the Little SpaceFrog be with you ! >>
  ------------------------------------------------------------------------------
  See main.inc.php for release information

  --------------------------------------------------------------------------- */
//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', true);

include_once('userstat_version.inc.php'); // => Don't forget to update this file !!

defined('USERSTAT_DIR') || define('USERSTAT_DIR' , basename(dirname(__FILE__)));
defined('USERSTAT_PATH') || define('USERSTAT_PATH' , PHPWG_PLUGINS_PATH . USERSTAT_DIR . '/');
include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCCore.class.inc.php');

global $gpcInstalled, $lang; //needed for plugin manager compatibility

/* -----------------------------------------------------------------------------
 * UserStat needs the Grum Plugin Classes
 * -------------------------------------------------------------------------- */
$gpcInstalled=false;
if(file_exists(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/CommonPlugin.class.inc.php'))
{
  @include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/CommonPlugin.class.inc.php');
  // need GPC release greater or equal than USERSTAT_GPC_NEEDED
  if(CommonPlugin::checkGPCRelease(USERSTAT_GPC_NEEDED))
  {
    @include_once("userstat_install.class.inc.php");
    $gpcInstalled=true;
  }
}

function gpcMsgError(&$errors)
{
  $msg=sprintf(l10n('To install this plugin, you need to install Grum Plugin Classes %s before'), USERSTAT_GPC_NEEDED);
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



load_language('plugin.lang', USERSTAT_PATH);

function plugin_install($plugin_id, $plugin_version, &$errors)
{
  global $prefixeTable, $gpcInstalled;
  if($gpcInstalled)
  {
    $obj=new UserStat_install($prefixeTable, __FILE__);
    $result=$obj->install();
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
    $obj=new UserStat_install($prefixeTable, __FILE__);
    $result=$obj->activate();
  }
}

function plugin_deactivate($plugin_id)
{
  global $prefixeTable, $gpcInstalled;

  if($gpcInstalled)
  {
    $obj=new UserStat_install($prefixeTable, __FILE__);
    $obj->deactivate();
  }
}

function plugin_uninstall($plugin_id)
{
  global $prefixeTable, $gpcInstalled;
  if($gpcInstalled)
  {
    $obj=new UserStat_install($prefixeTable, __FILE__);
    $result=$obj->uninstall();
  }
  else
  {
    gpcMsgError($errors);
  }
}


?>
