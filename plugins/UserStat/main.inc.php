<?php
/*
Plugin Name: UserStat
Version: 1.2.0
Description: Statistiques utilisateurs / Users statistics
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=321
Author: grum@piwigo.org
Author URI: http://photos.grum.fr/
*/

/*
--------------------------------------------------------------------------------
  Author     : Grum
    email    : grum@piwigo.org
    website  : http://photos.grum.fr
    PWG user : http://forum.phpwebgallery.net/profile.php?id=3706

    << May the Little SpaceFrog be with you ! >>
--------------------------------------------------------------------------------

:: HISTORY


| release | date       |
| 1.0.0   | 2009/11/15 | * first public release
|         |            |
| 1.1.0   | 2010/03/28 | * compatibility with Piwigo 2.1
|         |            |
| 1.1.1   | 2010/03/28 | * little bug on the template (call of an undefined var)
|         |            | * Add new languages
|         |            |   . es_ES
|         |            |   . hu_HU
|         |            |   . it_IT
|         |            |
| 1.2.0   | 201012     | * mantis feature:2263
|         |            |   . compatibility with Piwigo 2.2
|         |            |
|         |            |
|         |            |



:: TO DO

--------------------------------------------------------------------------------

:: NFO
  UserStat_AIM : classe to manage plugin integration into plugin menu
  UserStat_AIP : classe to manage plugin admin pages

--------------------------------------------------------------------------------
*/

// pour faciliter le debug :o)
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', true);

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

define('USERSTAT_DIR' , basename(dirname(__FILE__)));
define('USERSTAT_PATH' , PHPWG_PLUGINS_PATH . USERSTAT_DIR . '/');

include_once('userstat_version.inc.php'); // => Don't forget to update this file !!

global $prefixeTable;

//UserStat loaded and active only if in admin page
if(basename($_SERVER["PHP_SELF"])=='admin.php')
{
  include_once("userstat_aim.class.inc.php");

  $obj = new UserStat_AIM($prefixeTable, __FILE__);
  $obj->initEvents();
  set_plugin_data($plugin['id'], $obj);
}

?>
