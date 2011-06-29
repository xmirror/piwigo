<?php
/*
Plugin Name: AutoSize
Version: 1.6.7
Description: Ajuste l'affichage des photos en fonction de la hauteur de la fenetre de navigation
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=448
Author: cljosse
Author URI:http://cljosse.free.fr
*/

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
if (!defined('AUTOSIZE_PATH')) 
define(  'AUTOSIZE_PATH',   PHPWG_PLUGINS_PATH.basename(dirname(__FILE__)).'/' );
if (!defined('ROOT_URL')) 
define(  'ROOT_URL',  get_root_url().'/' );
 
if (!defined('AUTOSIZE_PATH_ABS')) 
define(
  'AUTOSIZE_PATH_ABS',  realpath(AUTOSIZE_PATH)."/"
);




//==================================================================
	include(AUTOSIZE_PATH."include/constants.php"); 	   
	include_once(AUTOSIZE_PATH.'autosize.inc.php');
//==================================================================
global $page;
if (!isset( $page['start'])) {
 $page['start']=0;
 }
$autosize_controler = new autosize_controler();
add_event_handler('get_admin_plugin_menu_links', array(&$autosize_controler,'cl_autosize_admin')  );

add_event_handler('loc_after_page_header', array(&$autosize_controler, 'cl_autosize_script_1'),  EVENT_HANDLER_PRIORITY_NEUTRAL+20  ,  2);	
add_event_handler('loc_after_page_header', array(&$autosize_controler, 'cl_autosize_affiche'), EVENT_HANDLER_PRIORITY_NEUTRAL+21  );

add_event_handler('loc_end_page_tail',array(&$autosize_controler, 'cl_autosize_script_2'),  EVENT_HANDLER_PRIORITY_NEUTRAL );
?>