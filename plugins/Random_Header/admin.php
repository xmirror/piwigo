<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

global $template,$conf;
$me = get_plugin_data($plugin_id);
include_once(PHPWG_ROOT_PATH.'admin/include/themes.class.php');

// delete conf for deleted themes (but not for deactivated themes)
foreach ($me->rh_config as $theme_in_rh_conf => $test) {
	if (!file_exists($conf['themes_dir'].'/'.$theme_in_rh_conf.'/'.'themeconf.inc.php')) {
		unset($me->rh_config[$theme_in_rh_conf]);
	}
}
$me->save_config();



$template->set_filenames( array('plugin_admin_content' => dirname(__FILE__).'/admin/admin.tpl') );
$template->assign("RH_VERSION",RH_VERSION);
$template->assign("RH_confpanel",realpath( dirname(__FILE__).'/admin/rh_theme_conf.tpl'));
$template->append('head_elements','<link rel="stylesheet" type="text/css" href="'.RH_PATH.'admin/admin.css" />');
$rhthemes = new themes();
$rh_vierge=0;

foreach (get_pwg_themes() as  $pwg_templateID => $pwg_template) {
	if (isset($_POST['submit'])) {
		$me->rh_config[$pwg_templateID]['selected_cat'] 		= $_POST[$pwg_templateID.'selected_cat'];
		$me->rh_config[$pwg_templateID]['active_on_picture'] 	= (isset( $_POST[$pwg_templateID.'active_on_picture'] )) ? $_POST[$pwg_templateID.'active_on_picture'] : 'off' ; 
		$me->rh_config[$pwg_templateID]['concat_before'] 		= (isset( $_POST[$pwg_templateID.'concat_before'] )) ? $_POST[$pwg_templateID.'concat_before'] : 'off' ; 
		$me->rh_config[$pwg_templateID]['concat_after'] 		= (isset( $_POST[$pwg_templateID.'concat_after'] )) ? $_POST[$pwg_templateID.'concat_after'] : 'off' ; 
		$me->rh_config[$pwg_templateID]['head_css'] 			= $_POST[$pwg_templateID.'head_css']; 
		$me->rh_config[$pwg_templateID]['img_css'] 				= $_POST[$pwg_templateID.'img_css']; 
		$me->rh_config[$pwg_templateID]['mode_background'] 		= (isset( $_POST[$pwg_templateID.'mode_background'] )) ? $_POST[$pwg_templateID.'mode_background'] : 'off' ;
		$me->rh_config[$pwg_templateID]['root_link'] 			= (isset( $_POST[$pwg_templateID.'root_link'] )) ? $_POST[$pwg_templateID.'root_link'] : 'off' ;
		$me->save_config();
		
	}
	
	$rhscreenshot=(file_exists(PHPWG_THEMES_PATH.$pwg_templateID . '/screenshot.png')) ? PHPWG_THEMES_PATH.$pwg_templateID . '/screenshot.png' : PHPWG_ROOT_PATH.'admin/themes/'.$conf['admin_theme'].'/images/missing_screenshot.png';
    $rhthemboxclass=($me->rh_config[$pwg_templateID]['selected_cat']!=0) ? 'themeDefault' : '';      
	$rh_vierge=($me->rh_config[$pwg_templateID]['selected_cat']!=0) ? $rh_vierge+1 : $rh_vierge;
	$template->append('rhthemes', array(
				'CURRENT_THEME_NAME'=> $pwg_template,
				'CURRENT_THEME_ID' 	=> $pwg_templateID,
				'ACTIVE_ON_PICTURE' => ($me->rh_config[$pwg_templateID]['active_on_picture']=='on') ? 'checked' : '',
				'MODE_BACKGROUND' 	=> ($me->rh_config[$pwg_templateID]['mode_background']=='on') ? 'checked' : '',
				'CONCAT_BEFORE' 	=> ($me->rh_config[$pwg_templateID]['concat_before']=='on') ? 'checked' : '',
				'CONCAT_AFTER' 		=> ($me->rh_config[$pwg_templateID]['concat_after']=='on') ? 'checked' : '',
				'ROOT_LINK' 		=> ($me->rh_config[$pwg_templateID]['root_link']=='on') ? 'checked' : '',
				'HEAD_CSS' 			=>  $me->rh_config[$pwg_templateID]['head_css'],
				'IMG_CSS' 			=>  $me->rh_config[$pwg_templateID]['img_css'],
				'CATSELECTED' 		=>  $me->rh_config[$pwg_templateID]['selected_cat'],
				'SCREENSHOT_URL'	=>	$rhscreenshot,
				'THEMEBOXCLASS'		=>	$rhthemboxclass
				));
}
$template->assign('rh_vierge',$rh_vierge);
display_select_cat_wrapper(
	  'SELECT id,name,uppercats,global_rank FROM '.CATEGORIES_TABLE,
	  array(),
	  'categories'
	  );
	  
load_language('plugin.lang', RH_PATH);

  
  
$template->assign_var_from_handle( 'ADMIN_CONTENT', 'plugin_admin_content');
?>