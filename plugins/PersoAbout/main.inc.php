<?php
/*
Plugin Name: Perso About
Version: 2.1.e
Description: Add bloc perso on about page
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=480
Author: ddtddt
Author URI: http://piwigo.org/
*/

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

define('PPA_DIR' , basename(dirname(__FILE__)));
define('PPA_PATH' , PHPWG_PLUGINS_PATH . PPA_DIR . '/');

add_event_handler('get_admin_plugin_menu_links', 'PA_admin_menu');
function PA_admin_menu($menu)
{
  array_push($menu, array(
	'NAME' => 'Perso About',
    'URL' => get_admin_plugin_menu_link(PPA_PATH . 'admin/admin.php')));
  return $menu;
}

 if (script_basename() == 'about')
	{
  add_event_handler('loc_end_page_header', 'ppa');
	}

function ppa()
 {
	global $template;
	$template->set_prefilter('about', 'ppaT');
	
	$PAED = pwg_db_fetch_assoc(pwg_query("SELECT state FROM " . PLUGINS_TABLE . " WHERE id = 'ExtendedDescription';"));
if($PAED['state'] == 'active') add_event_handler('AP_render_content', 'get_user_language_desc');

$query = '
select param,value
	FROM ' . CONFIG_TABLE . '
  WHERE param = "persoAbout"
	;';
$result = pwg_query($query);
$row = mysql_fetch_array($result);
$pat=trigger_event('AP_render_content', $row['value']);
		 if (!empty($pat))
			{
				$template->assign('PERSO_ABOUT', $pat);
			}
	
 }

function ppaT($content, &$smarty)
 {
 
  $search = '#<div id="piwigoAbout">#';
      
  $replacement = '<div id="piwigoAbout"><div id="persoabout">{$PERSO_ABOUT}</div>';

  return preg_replace($search, $replacement, $content);
}
?>