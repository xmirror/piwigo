<?php
/*
Plugin Name: Grum Plugins Classes.3
Version: 3.5.1
Description: Collection de classes partagées entre mes plugins (existants, ou à venir) / Partaged classes between my plugins (actuals or futures)
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=199
Author: grum@piwigo.org
Author URI: http://photos.grum.fr/
*/

/*
--------------------------------------------------------------------------------
  Author     : Grum
    email    : grum@piwigo.org
    website  : http://photos.grum.fr

    << May the Little SpaceFrog be with you ! >>
--------------------------------------------------------------------------------

:: HISTORY

| release | date       |
| 2.0.0   | 2008/07/20 | * convert classes for piwigo 2.0
|         |            |
| 2.0.1   | 2008/12/28 | * convert classe tables.class.inc to php5
|         |            |
| 2.0.2   | 2009/04/26 | * add setOptions/getOptions for GPCPagesNavigation class
|         |            | * add option to set first/prev/next/last textes
|         |            |
| 2.0.3   | 2009/07/24 | * modify common_plugin class config loader (r2.0.1)
|         |            |
| 2.0.4   | 2009/11/29 | * modify users class
|         |            |
| 3.0.0   | 2010/03/28 | * Uses piwigo pwg_db_* functions instead of mysql_* functions
|         |            | * update classes & functions names
|         |            | * include the JpegMetaData class
|         |            |
| 3.0.1   | 2010/04/11 | * little bug on the template (call of an undefined var)
|         |            | * Add new languages
|         |            |   . es_ES
|         |            |   . hu_HU
|         |            |   . it_IT
|         |            |
| 3.1.0   | 2010/04/24 | * add the GPCTabSheet class
|         |            | * add the GPCRequestBuilder class
|         |            | * add the pageNavigator.js
|         |            | * update the GPCCore class
|         |            | * Add new languages
|         |            |   . nl_NL
|         |            |   . de_DE
|         |            |
| 3.1.1   | 2010/05/18 | * fix bug in the install process (CommonPlugin not
|         |            |   included)
|         |            |
| 3.2.0   | 2010/09/12 | * Enhance GPCTabSheet functionnalities
|         |            |   - possibility to choose tab classes
|         |            | * Add the simpleTip.js
|         |            | * Enhance GPCRequestBuilder functionnalities
|         |            |   - now abble to manage complex request with multi-record
|         |            |   - result can be stored in the caddie
|         |            |
| 3.2.1   | 2010/10/09 | * Enhance GPCTabSheet functionnalities
|         |            |   - add 'id' attribute for tabs (<li> items)
|         |            |
|         |            | * Fix JS & CSS bug with IE8
|         |            |
| 3.3.0   | 2010/10/13 | * Add the jQuery plugins
|         |            |   . ui.iconSelector.js + ui.iconSelector.packed.js
|         |            |   . ui.categorySelector.js + ui.categorySelector.packed.js
|         |            |
|         |            | * Pack JS scripts
|         |            |   . pagesNavigator.packed.js
|         |            |   . criteriaBuilder.packed.js
|         |            |   . simpleTip.packed.js
|         |            |
|         |            | * Adding GPCCategorySelector class
|         |            |
| 3.3.1   | ---- -- -- | * nothing changed, the 3.3.1 package was built to
|         |            |   replace a wrong file
|         |            |
| 3.3.2   | 2010/10/20 | * Fix mantis bug:1945
|         |            |   . categorySelector : category list is empty
|         |            |
|         |            | * Fix many bugs on request builder and improve the css
|         |            |   and templates
|         |            |
|         |            | * Add the jQuery plugins
|         |            |   . ui.tagSelector.js + ui.tagSelector.packed.js
|         |            |
|         |            | * Externalize and pack JS scripts
|         |            |   . rbSearch.js + rbSearch.packed.js
|         |            |
|         |            | * Rename js script
|         |            |   . criteriaBuilder.js => rbCriteriaBuilder.js
|         |            |
| 3.3.3   | 2010/10/20 | * Enhance GPCPublicIntegration functionnalities
|         |            |   . add the 'pageIsSection()' function
|         |            |
|         |            | * mantis bug:1960
|         |            |   . Ajax function *.tagSelector.get don't work with
|         |            |     uppercase
|         |            |
|         |            | * mantis bug:1971
|         |            |   . optimization for RBuilder loading language management
|         |            |
| 3.4.0   | 2011/01/28 | * mantis bug:1984
|         |            |   . RBuilder returns an error message when one picture
|         |            |     have multiple categories
|         |            |
|         |            | * fix bug:2109
|         |            |   . Incompatibility with IE8 (rbuilder)
|         |            |
|         |            | * Fix bug on simpleTip.js (script release 1.0.1)
|         |            |
|         |            | * GPCCore, GPCTranslate, GPCUsersGroups classes updated
|         |            |
|         |            | * add jQuery plugin pack & associated css files
|         |            |   . inputText
|         |            |   . inputList
|         |            |   . inputRadio
|         |            |   . inputCheckbox
|         |            |   . inputColorPicker
|         |            |   . inputColorsFB
|         |            |   . inputConsole
|         |            |   . inputDotArea
|         |            |   . inputNum
|         |            |   . inputPosition
|         |            |   . inputStatusBar
|         |            |
|         |            | * update categorySelector jQuery plugin
|         |            |
|         |            | * minify js scripts (larger size than packed files but
|         |            |   better performance)
|         |            |
| 3.4.1   | 2011/01/31 | * mantis bug:2156
|         |            |   . undefined variable on RBuilder screens
|         |            |
| 3.4.2   | 2011/01/31 | * mantis bug:2162
|         |            |   . Personalised blocks : when adding a new block,
|         |            |     previous title & content are not reseted  (AMM bug
|         |            |     due to inputText.js ui component)
|         |            |
| 3.4.3   | 2011/02/01 | * mantis bug:2167
|         |            |   . RBuilder and GPCore not correctly initialized on
|         |            |     fresh install
|         |            |
| 3.4.4   | 2011/02/02 | * mantis bug:2170
|         |            |   . File path for RBuilder registered plugins is corrupted
|         |            |
|         |            | * mantis bug:2178
|         |            |   . RBuilder register function don't work
|         |            |
|         |            | * mantis bug:2179
|         |            |   . JS file loaded in wrong order made incompatibility
|         |            |     with Lightbox, GMaps & ASE plugins (and probably other)
|         |            |
|         |            | * add language pt_PT (thanks to translator)
|         |            |
| 3.5.0   | 2011/04/10 | * mantis bug:2149
|         |            |   . Compatibility with piwigo 2.2
|         |            |
| 3.5.1   | 2011/05/15 | * mantis bug:2302
|         |            |   . Request builder interface don't work
|         |            |
|         |            |
|         |            |
|         |            |
|         |            |
|         |            | ===== Don't forget to update the plugin version ! =====
|         |            |
|         |            |
|         |            |
|         |            |
|         |            |
|         |            |
|         |            |


:: TO DO

:: WHAT ? WHY ?
This plugin doesn't do anything itself. It just provide classes for others plugins.

Classes version for this package
    CommonPlugin.class.php
    GPCAjax.class.php
    GPCCategorySelector.class.inc.php
    GPCCore.class.php
    GPCCss.class.php
    GPCPagesNavigation.class.php
    GPCPublicIntegration.class.php
    GPCRequestBuilder.class.php
    GPCTables.class.php -v1.5
    GPCTabSheet.class.inc.php
    GPCTranslate.class.inc.php + google_translate.js
    GPCUsersGroups.class.inc.php


See each file to know more about them
--------------------------------------------------------------------------------
*/

if(!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

if(!defined('GPC_DIR')) define('GPC_DIR' , basename(dirname(__FILE__)));
if(!defined('GPC_PATH')) define('GPC_PATH' , PHPWG_PLUGINS_PATH . GPC_DIR . '/');


include_once('gpc_version.inc.php'); // => Don't forget to update this file !!
include_once(GPC_PATH.'classes/GPCCore.class.inc.php');

global $prefixeTable;



$config=Array();
GPCCore::loadConfig('gpc', $config);

if(!isset($config['installed'])) $config['installed']='03.01.00';
if($config['installed']!=GPC_VERSION2)
{
  /* the plugin was updated without being deactivated
   * deactivate + activate the plugin to process the database upgrade
   */
  include(GPC_PATH."gpc_install.class.inc.php");
  $gpc=new GPC_Install($prefixeTable, __FILE__);
  $gpc->deactivate();
  $gpc->activate();
}


if(defined('IN_ADMIN'))
{
  //GPC admin interface is loaded and active only if in admin page
  include_once("gpc_aim.class.inc.php");

  $obj = new GPC_AIM($prefixeTable, __FILE__);
  $obj->initEvents();
  set_plugin_data($plugin['id'], $obj);
}

?>
