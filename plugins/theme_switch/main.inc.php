<?php
// +-----------------------------------------------------------------------+
// | Piwigo - a PHP based picture gallery                                  |
// | Theme switch plugin                                                   |
// +-----------------------------------------------------------------------+
// | Copyright(C) 2010      Pavel Budka               http://budkovi.ic.cz |
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
// | Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, |
// | USA.                                                                  |
// +-----------------------------------------------------------------------+

/*
Plugin Name: Theme Switch
Version: 2.1.a
Description: Lets logged or unlogged user change appearance of gallery (via switching to different theme) on gallery home page. Based on Language switch. The switch can show theme names or theme icons, depends on configuration. See details in a file main.inc.php.
Plugin URI: http://phpwebgallery.net/ext/extension_view.php?eid=257
Author: Pavel Budka
Author URI: http://budkovi.ic.cz
*/

include_once(PHPWG_PLUGINS_PATH.'theme_switch/theme_switch.inc.php');
$theme_controler = new theme_controler();
add_event_handler('loading_lang', array(&$theme_controler, '_switch'), 5 );

// If you want user to choose from icons then use following handler. 
// Only themes which have screenshot.png icon provided will be provided to users.

add_event_handler('loc_end_index', array(&$theme_controler, '_flags'), 85 );

// If you want user to choose using select control then use following handler.
// All available themes will be provided to users. 

add_event_handler('loc_end_index', array(&$theme_controler, '_select'), 15 );

// this is preparation for future version with configuration 
// add_event_handler('get_admin_plugin_menu_links', array(&$theme_controler,'_theme_admin'));

?>
