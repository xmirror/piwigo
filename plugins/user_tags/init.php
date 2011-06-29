<?php
// +-----------------------------------------------------------------------+
// | User Tags  - a plugin for Piwigo                                      |
// +-----------------------------------------------------------------------+
// | Copyright(C) 2010-2011 Nicolas Roudaire        http://www.nikrou.net  |
// +-----------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify  |
// | it under the terms of the GNU General Public License as published by  |
// | the Free Software Foundation                                          |
// |                                                                       |
// | This program is distributed in the hope that it will be useful, but   |
// | WITHOUT ANY WARRANTY; without even the implied warranty of            |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU      |
// | General Public License for more details.                              |
// |                                                                       |
// | You should have received a copy of the GNU General Public License     |
// | along with this program; if not, write to the Free Software           |
// | Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,            |
// | MA 02110-1301 USA.                                                    |
// +-----------------------------------------------------------------------+

if (!defined('PHPWG_ROOT_PATH')) {
  die('Hacking attempt!');
}

define('T4U_PLUGIN_ROOT', dirname(__FILE__));

include_once T4U_PLUGIN_ROOT . "/include/constants.inc.php";
include_once T4U_PLUGIN_ROOT . "/include/t4u_config.class.php";

$plugin_config = new t4u_Config(T4U_PLUGIN_ROOT, T4U_PLUGIN_NAME);
$plugin_config->load_config();

if (defined('IN_ADMIN')) { 
  add_event_handler('get_admin_plugin_menu_links', 
		    array($plugin_config, 'plugin_admin_menu')
		    ); 
  add_event_handler('get_popup_help_content', 
		    array($plugin_config, 'get_admin_help'),
		    EVENT_HANDLER_PRIORITY_NEUTRAL,
		    2
		    );
} else {
  include_once T4U_PLUGIN_ROOT . '/public.php';
}

set_plugin_data($plugin['id'], $plugin_config);
?>