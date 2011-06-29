<?php
/*
Plugin Name: ColorStat
Version: 1.1.0
Description: Allow to make stat on pictures colors
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=393
Author: grum@piwigo.org
Author URI: http://photos.grum.fr
*/

/*
--------------------------------------------------------------------------------
  Author     : Grum
    email    : grum@piwigo.com
    website  : http://photos.grum.fr
    PWG user : http://forum.phpwebgallery.net/profile.php?id=3706

    << May the Little SpaceFrog be with you ! >>
--------------------------------------------------------------------------------

:: HISTORY

| release | date       |
| 0.1.0   | 2010/04/21 | * start to coding
|         |            |
| 1.0.0   | 2010/05/17 | * first release for PEM
|         |            |
| 1.0.1   | 2010/05/20 | * fix bug:1657
|         |            |   . Constant not defined
|         |            |
| 1.0.2   | 2010/09/12 | * mantis bug:1796
|         |            |   . Images color-search broken
|         |            |
|         |            | * mantis bug:1854
|         |            |   . Not analyzed pictures are selected
|         |            |
|         |            | * update the plugin to request builder v 1.1.0
|         |            |
| 1.0.3   | 2010/09/12 | * mantis bug:2074
|         |            |   . No image are analyzed
|         |            |
| 1.1.0   | 2011/04/26 | * mantis bug:2147
|         |            |   . Compatibility with Piwigo 2.2
|         |            |
|         |            |
|         |            |
|         |            |
|         |            |
|         |            |
|         |            |
|         |            |


:: TO DO

--------------------------------------------------------------------------------

:: NFO
  CStat_root : common classe for admin and public classes
  CStat_AIM  : classe to manage plugin integration into plugin menu
  CStat_AIP  : classe to manage plugin admin pages
  CStat_PIP  : classe to manage plugin public pages

--------------------------------------------------------------------------------
*/

// pour faciliter le debug :o)
 //ini_set('error_reporting', E_ALL);
 //ini_set('display_errors', true);

if(!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');


define('CSTAT_DIR' , basename(dirname(__FILE__)));
define('CSTAT_PATH' , PHPWG_PLUGINS_PATH . CSTAT_DIR . '/');

include_once('cstat_version.inc.php'); // => Don't forget to update this file !!

global $prefixeTable;

if(defined('IN_ADMIN'))
{
  //CStat admin interface loaded and active only if in admin page
  include_once("cstat_aim.class.inc.php");
  CStat_functions::init($prefixeTable);
  $obj=new CStat_AIM($prefixeTable, __FILE__);
  $obj->initEvents();
  set_plugin_data($plugin['id'], $obj);
}
else
{
  //CStat public interface loaded and active only if in public page
  include_once("cstat_pip.class.inc.php");
  CStat_functions::init($prefixeTable);
  $obj=new CStat_PIP($prefixeTable, __FILE__);
  set_plugin_data($plugin['id'], $obj);
}



?>
