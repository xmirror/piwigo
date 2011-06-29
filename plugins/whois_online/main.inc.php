<?php
// +-----------------------------------------------------------------------+
// | Piwigo - a PHP based picture gallery                                  |
// +-----------------------------------------------------------------------+
// | Copyright(C) 2008-2009 Piwigo Team                  http://piwigo.org |
// | Copyright(C) 2003-2008 Piwigo team           http://phpwebgallery.net |
// | Copyright(C) 2002-2003 Pierrick LE GALL   http://le-gall.net/pierrick |
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
Plugin Name: Whois online
Version: 2.2.3
Description: Who is online?
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=279
Author: Piwigo team
Author URI: http://www.vdigital.org
*/

global $prefixeTable, $conf;
// $conf['debug_l10n'] = true;
if (!defined('WHOIS_ONLINE_TABLE')) define('WHOIS_ONLINE_TABLE', $prefixeTable.'whois_online');

define('WHOIS_ONLINE_DIR' , basename(dirname(__FILE__)));
define('WHOIS_ONLINE_PATH' , PHPWG_PLUGINS_PATH . WHOIS_ONLINE_DIR . '/');


include_once(WHOIS_ONLINE_PATH.'online.php');
/* History:  WHOIS_ONLINE_PATH.'Changelog.txt.php' */
?>