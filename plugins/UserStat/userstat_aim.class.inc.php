<?php
/* -----------------------------------------------------------------------------
  Plugin     : UserStat
  Author     : Grum
    email    : grum@piwigo.org
    website  : http://photos.grum.fr

    << May the Little SpaceFrog be with you ! >>
  ------------------------------------------------------------------------------
  See main.inc.php for release information

  UserStat_AIM : classe to manage plugin integration into plugin menu

  --------------------------------------------------------------------------- */

if (!defined('PHPWG_ROOT_PATH')) { die('Hacking attempt!'); }

include_once('userstat_root.class.inc.php');
include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCCss.class.inc.php');

class UserStat_AIM extends UserStat_root
{
  function __construct($prefixeTable, $filelocation)
  {
    parent::__construct($prefixeTable, $filelocation);
  }

  /*
    initialize events call for the plugin
  */
  function initEvents()
  {
    parent::initEvents();
    add_event_handler('get_admin_plugin_menu_links', array(&$this, 'pluginAdminMenu') );
  }


} // UserStat_Plugin class


?>
