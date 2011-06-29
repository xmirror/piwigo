<?php
/*
Plugin Name: Random Header
Version: 2.2
Description: Random Header allow you to show in the header a random picture from the choosen categorie, as a normal image, or as a background
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=188
Author: repie38
Author URI: 
*/

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
DEFINE('RH_VERSION','v2.2');
define('RH_PATH' , PHPWG_PLUGINS_PATH . basename(dirname(__FILE__)) . '/');

class RandomHeader
{
	var $rh_config;
	
	function load_config()
    { 
		global $conf;
		$this->rh_config = unserialize($conf['Random_Header']);
		foreach (get_pwg_themes() as $pwg_templateID => $pwg_template) {
        	
			if (empty($this->rh_config[$pwg_templateID]['selected_cat']))  {

				$this->rh_config[$pwg_templateID]['selected_cat'] = '0';
            	$this->rh_config[$pwg_templateID]['active_on_picture']='off';
				$this->rh_config[$pwg_templateID]['head_css']='';
				$this->rh_config[$pwg_templateID]['img_css']='';
				$this->rh_config[$pwg_templateID]['mode_background']='off';
				$this->rh_config[$pwg_templateID]['concat_before'] ='off' ;
				$this->rh_config[$pwg_templateID]['concat_after'] ='off' ;
				$this->rh_config[$pwg_templateID]['root_link'] ='off' ;

            	$this->save_config();
        	}
			if (!isset($this->rh_config[$pwg_templateID]['root_link'])) $this->rh_config[$pwg_templateID]['root_link']='off';

		}
	}
	
    function save_config()
	{
		$query = '
					UPDATE '.CONFIG_TABLE.'
					SET value = "'.addslashes(serialize($this->rh_config)).'"
					WHERE param = "Random_Header"
					;';
		pwg_query($query);
		
		load_conf_from_db();
	}
	
	function plugin_admin_menu($menu)
	{
		array_push($menu,array(
				'NAME' => 'Random Header',
				'URL'  =>  get_root_url().'admin.php?page=plugin-'.basename(dirname(__FILE__))));
		return $menu;
	}
	
	function randombanner(){
		global $page;
		global $template;
		global $conf;
		global $user;
		
		$usertheme=$user['theme'] ;
		
		if (isset($this->rh_config[$usertheme])){
		if ( !defined('IN_ADMIN') && isset($page['body_id']) && ($page['body_id']!='thePicturePage' || $this->rh_config[$usertheme]['active_on_picture']=='on') ) {

			$result = pwg_query('SELECT '.IMAGES_TABLE.'.path  FROM '.IMAGES_TABLE.' , '.IMAGE_CATEGORY_TABLE.' WHERE '.IMAGES_TABLE.'.`id` = '.IMAGE_CATEGORY_TABLE.'.`image_id` AND '.IMAGE_CATEGORY_TABLE.'.category_id = ' . $this->rh_config[$usertheme]['selected_cat'] . ' ORDER BY RAND() LIMIT 0,1');
			if (mysql_num_rows($result) > 0) {
				$toto = mysql_fetch_row($result);

				if ($this->rh_config[$usertheme]['mode_background']=='on') {
					$template->append('head_elements','<style type="text/css">#theHeader{background: url('.$toto[0].') no-repeat;'. $this->rh_config[$usertheme]['head_css'] .'}</style>');
				}
				else {
					if ($this->rh_config[$usertheme]['img_css']!='' || $this->rh_config[$usertheme]['head_css']!='')
						$template->append('head_elements','<style type="text/css">#theHeader{'. $this->rh_config[$usertheme]['head_css'] .'}#theHeader #RandomImage{'. $this->rh_config[$usertheme]['img_css'] .'}</style>');
					$page['page_banner'] = ($this->rh_config[$usertheme]['concat_before']=='on') ? $conf['page_banner'] : '';
					$page['page_banner'].= ($this->rh_config[$usertheme]['root_link']=='on') ? '<a href="'.PHPWG_ROOT_PATH.'" title="'.l10n('Home').'">'	: '';
					$page['page_banner'].= '<img id="RandomImage" src="'.$toto[0].'">';
					$page['page_banner'].= ($this->rh_config[$usertheme]['root_link']=='on') ? '</a>'	: '';
					$page['page_banner'].= ($this->rh_config[$usertheme]['concat_after']=='on') ? $conf['page_banner'] : '';
				}
			}
		}}
	}

}

$obj = new RandomHeader();
$obj->load_config();
add_event_handler('loc_begin_page_header', array(&$obj, 'randombanner') );
add_event_handler('get_admin_plugin_menu_links', array(&$obj, 'plugin_admin_menu') );
set_plugin_data($plugin['id'], $obj)


?>