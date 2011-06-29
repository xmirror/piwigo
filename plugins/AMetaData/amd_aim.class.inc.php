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
 * AMD_AIM : classe to manage plugin integration into plugin menu
 *
 * -----------------------------------------------------------------------------
 */

if (!defined('PHPWG_ROOT_PATH')) { die('Hacking attempt!'); }

include_once('amd_root.class.inc.php');

class AMD_AIM extends AMD_root
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

} // amd_aim  class


?>
