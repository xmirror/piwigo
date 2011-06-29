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

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

function plugin_install()
{
 global $conf;

  if (!isset($conf['Random_Header']))
  {
  $q = '
    INSERT INTO '.CONFIG_TABLE.' (param, value, comment)
    VALUES ("Random_Header","","Random header configuration")
  ;';
  pwg_query($q);
  } 
  
  // upgrade
    
        $x = file_get_contents( dirname(__FILE__).'/data.dat' );
		
        if ($x!==false) {
        	$query = '
					UPDATE '.CONFIG_TABLE.'
					SET value = "'.addslashes($x).'"
					WHERE param = "Random_Header"
					;';
			if (pwg_query($query)) unlink( dirname(__FILE__).'/data.dat' );
			
		}

    // end upgrade
  
  
}

function plugin_uninstall()
{
  global $conf;
  if (isset($conf['Random_Header']))
  {
    $q = '
      DELETE FROM '.CONFIG_TABLE.'
      WHERE param="Random_Header"
    ;';
    pwg_query($q);
    }
 }

?>