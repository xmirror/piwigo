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

if (!empty($_GET['action']) && in_array($_GET['action'], array('add', 'get'))) {
  include_once T4U_PLUGIN_ROOT . "/include/t4u_admin_action.inc.php";
}

include_once T4U_PLUGIN_ROOT . "/include/t4u_content.class.php";

$public_content = new t4u_Content($plugin_config);
add_event_handler('render_element_content', 
		  array($public_content, 'render_element_content'),
		  EVENT_HANDLER_PRIORITY_NEUTRAL,
		  2
		  );
?>