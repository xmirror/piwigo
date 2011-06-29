<?php
/*
Plugin Name: Captcha
Version: 2.2.b
Description: Add captcha to registration form
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=477
Author: P@t
Author URI: http://piwigo.org
*/

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
define('CAPTCHA_PATH' , PHPWG_PLUGINS_PATH . basename(dirname(__FILE__)) . '/');

global $conf;

if (!empty($conf['captcha_publickey']) and !empty($conf['captcha_privatekey']))
{
  if (script_basename() == 'register') include('register.inc.php');
  elseif (isset($_GET['/contact'])) include('contactform.inc.php');
}

if (script_basename() == 'admin')
  add_event_handler('get_admin_plugin_menu_links', 'captcha_plugin_admin_menu' );

function captcha_plugin_admin_menu($menu)
{
	global $page,$conf;

	if ( (empty($conf['captcha_publickey']) or empty($conf['captcha_publickey']))
    and in_array($page['page'], array('intro','plugins_list')) )
	{
		load_language('plugin.lang', CAPTCHA_PATH);
		$page['errors'][] = l10n('You need to define Captcha keys');
	}

	array_push($menu,
			array(
				'NAME' => 'Captcha',
				'URL' => get_root_url().'admin.php?page=plugin-'.basename(dirname(__FILE__))
			)
		);
	return $menu;
}

?>