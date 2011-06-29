<?php
// +-----------------------------------------------------------------------+
// | Piwigo - a PHP based picture gallery                                  |
// +-----------------------------------------------------------------------+
// | Copyright(C) 2008-2009 Piwigo Team                  http://piwigo.org |
// | Copyright(C) 2003-2008 PhpWebGallery Team    http://phpwebgallery.net |
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

 if (!defined('AUTOSIZE_PATH')) 
define(
  'AUTOSIZE_PATH', PHPWG_PLUGINS_PATH.basename(dirname(__FILE__)).'/'
);
 
function plugin_install()
{
 global $conf;

  if (!isset($conf['cl_autosize']))
  {
    
  $q = '
    INSERT INTO '.CONFIG_TABLE.' (param, value, comment)
    VALUES ("cl_autosize","","Parametres du plugin Autosize")
  ;';
  pwg_query($q);
  }
 
 
}



function plugin_uninstall()
{
  global $conf;
  if (isset($conf['cl_autosize']))
  {
    $q = '
      DELETE FROM '.CONFIG_TABLE.'
      WHERE param="cl_autosize"
    ;';
    pwg_query($q);
    }
	 $query = 'DROP TABLE IF EXISTS  '.CL_AUTOSIZE_TABLE.';';
    pwg_query( $query);
 }

?>