<?php
/*
Plugin Name: Contact Form
Version: 1.2.4
Description: Add a "Contact" item in the Menu block to offer a contact form to users
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=304
Author: Criss, Gotcha
Author URI: http://piwigo.org/
*/

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

define('CF_PATH',     PHPWG_PLUGINS_PATH.basename(dirname(__FILE__)).'/');
define('CF_ROOT',     dirname(__FILE__).'/');
include_once(CF_PATH . 'include/cf_common.inc.php');

$cf_plugin = new CF_Plugin($plugin['id']);
add_event_handler('loc_begin_index',             
                  array(&$cf_plugin, 'loc_begin_index'));
add_event_handler('loc_begin_page_tail',             
                  array(&$cf_plugin, 'loc_begin_page_header'));
add_event_handler('blockmanager_apply',             
                  array(&$cf_plugin, 'blockmanager_apply'));
add_event_handler('loc_end_index',             
                  array(&$cf_plugin, 'loc_end_index'));
add_event_handler('loc_end_page_tail',
                  array(&$cf_plugin, 'loc_end_page_tail'));
if(defined('IN_ADMIN')) {
  add_event_handler('get_admin_plugin_menu_links',
                    array(&$cf_plugin, 'get_admin_plugin_menu_links'));
}
set_plugin_data($plugin['id'], $cf_plugin);
?>