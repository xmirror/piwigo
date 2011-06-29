<?php
/*
Plugin Name: Perso Footer
Version: 2.2.c
Description: Add information in the footer
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=554
Author: ddtddt
Author URI: http://piwigo.org/
*/

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

define('PFT_DIR' , basename(dirname(__FILE__)));
define('PFT_PATH' , PHPWG_PLUGINS_PATH . PFT_DIR . '/');

add_event_handler('get_admin_plugin_menu_links', 'PFT_admin_menu');
function PFT_admin_menu($menu)
{
  array_push($menu, array(
	'NAME' => 'Perso Footer',
    'URL' => get_admin_plugin_menu_link(PFT_PATH . 'admin/admin.php')));
  return $menu;
}

  add_event_handler('loc_end_page_tail', 'pft');


function pft()
 {
   if ((script_basename() != 'admin'))
  {
	global $template;
	
	$PAED = pwg_db_fetch_assoc(pwg_query("SELECT state FROM " . PLUGINS_TABLE . " WHERE id = 'ExtendedDescription';"));
if($PAED['state'] == 'active') add_event_handler('AP_render_content', 'get_user_language_desc');

$query = '
select param,value
	FROM ' . CONFIG_TABLE . '
  WHERE param = "persoFooter"
	;';
$result = pwg_query($query);
$row = mysql_fetch_array($result);
$pat=trigger_event('AP_render_content', $row['value']);
		 if (!empty($pat))
			{
				$template->assign('PERSO_FOOTER2', $pat);
			}
			
	$template->set_filename('PERSO_FOOTER', realpath(PFT_PATH.'persofooter.tpl'));	
	$template->append('footer_elements', $template->parse('PERSO_FOOTER', true));
			
	}
 }
?>