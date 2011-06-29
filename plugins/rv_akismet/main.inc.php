<?php /*
Plugin Name: RV Akismet
Version: 2.2.a
Description: Uses Akismet online service to check comments agains spam
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=192
Author: rvelices
Author URI: http://www.modusoptimus.com
*/

define('AKIS_DIR' , basename(dirname(__FILE__)));
define('AKIS_PATH' , PHPWG_PLUGINS_PATH . AKIS_DIR . '/');

add_event_handler('user_comment_check', 'akismet_user_comment_check_wrapper', EVENT_HANDLER_PRIORITY_NEUTRAL+10, 2);

add_event_handler('get_admin_plugin_menu_links', 'akismet_plugin_admin_menu' );

function akismet_plugin_admin_menu($menu)
{
	global $page,$conf;
	if ( empty($conf['akismet_api_key']) and in_array($page['page'], array('intro','plugins_list')) )
	{
		load_language('plugin.lang', AKIS_PATH);
		$page['errors'][] = l10n('You need to define the Akismet api key');
	}
	$admin_url = get_admin_plugin_menu_link(dirname(__FILE__).'/admin.php');
	array_push($menu,
			array(
				'NAME' => 'Akismet',
				'URL' => $admin_url
			)
		);
	return $menu;
}


function akismet_user_comment_check_wrapper($action, $comment)
{
	include_once( dirname(__FILE__).'/check.inc.php' );
	return akismet_user_comment_check($action, $comment);
}
?>