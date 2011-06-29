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

if(!defined('CSTAT_DIR')) define('CSTAT_DIR' , basename(dirname(__FILE__)));
if(!defined('CSTAT_PATH')) define('CSTAT_PATH' , PHPWG_PLUGINS_PATH . CSTAT_DIR . '/');

//ini_set('error_reporting', E_ALL);
//ini_set('display_errors', true);

include_once('cstat_version.inc.php'); // => Don't forget to update this file !!

global $gpcInstalled, $lang; //needed for plugin manager compatibility

/*
 * -----------------------------------------------------------------------------
 * ColorStat needs the Grum Plugin Classes
 * -----------------------------------------------------------------------------
 */
$gpcInstalled=false;
if(file_exists(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/CommonPlugin.class.inc.php'))
{
  include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/CommonPlugin.class.inc.php');
  // need GPC release greater or equal than CSTAT_GPC_NEEDED
  if(CommonPlugin::checkGPCRelease(CSTAT_GPC_NEEDED))
  {
    include_once('cstat_install.class.inc.php');
    $gpcInstalled=true;
  }
}

function gpcMsgError(&$errors)
{
  $msg=sprintf(l10n('To install this plugin, you need to install Grum Plugin Classes %s before'), CSTAT_GPC_NEEDED);
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




load_language('plugin.lang', CSTAT_PATH);


function plugin_install($plugin_id, $plugin_version, &$errors)
{
  global $prefixeTable, $gpcInstalled;

  if($gpcInstalled)
  {
    $cstat = new CStat_Install($prefixeTable, __FILE__);
    if(!$cstat->install())
    {
      array_push($errors, "error");
    }
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
    $cstat = new CStat_Install($prefixeTable, __FILE__);
    $result=$cstat->activate();
    if($result===false or $result!='')
    {
      if(is_string($result))
      {
        array_push($errors, $result);
      }
      else
      {
        array_push($errors, "");
      }
    }
  }
  else
  {
    gpcMsgError($errors);
  }
}

function plugin_deactivate($plugin_id)
{
  global $prefixeTable, $gpcInstalled;

  if($gpcInstalled)
  {
    $cstat = new CStat_Install($prefixeTable, __FILE__);
    $cstat->deactivate();
  }
}

function plugin_uninstall($plugin_id)
{
  global $prefixeTable, $gpcInstalled;

  if($gpcInstalled)
  {
    $cstat = new CStat_Install($prefixeTable, __FILE__);
    $cstat->uninstall();
  }
  else
  {
    gpcMsgError($errors);
  }
}


?>
