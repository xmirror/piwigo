<?php
load_language('plugin.lang', PAMOORAMICS_PATH);

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
$me = get_plugin_data($plugin_id);
if ( isset($_POST['submit']) )
{
	$me->my_config['paMOOramics_mode']				= $_POST['paMOOramics_mode'];
	$me->my_config['paMOOramics_use_name'] 			= isset($_POST['paMOOramics_use_name']) ? "true" : "false";
	$me->my_config['paMOOramics_name'] 				= $_POST['paMOOramics_name'];
	$me->my_config['paMOOramics_use_ratio'] 		= isset($_POST['paMOOramics_use_ratio']) ? "true" : "false";
	$me->my_config['paMOOramics_ratio'] 			= $_POST['paMOOramics_ratio'];
	$me->my_config['paMOOramics_width'] 			= $_POST['paMOOramics_width'];
	$me->my_config['paMOOramics_border']			= $_POST['paMOOramics_border'];
	$me->my_config['paMOOramics_bordercolor']		= $_POST['paMOOramics_bordercolor'];
	$me->my_config['paMOOramics_footercolor']		= $_POST['paMOOramics_footercolor'];
	$me->my_config['paMOOramics_captioncolor']		= $_POST['paMOOramics_captioncolor'];
	$me->my_config['paMOOramics_autoscrollSpeed']	= $_POST['paMOOramics_autoscrollSpeed'];
	$me->my_config['paMOOramics_activateSlider'] 	= isset($_POST['paMOOramics_activateSlider']) ? "true" : "false";
	$me->my_config['paMOOramics_enableAutoscroll']	= isset($_POST['paMOOramics_enableAutoscroll']) ? "true" : "false";
	$me->my_config['paMOOramics_autoscrollOnLoad'] 	= isset($_POST['paMOOramics_autoscrollOnLoad']) ? "true" : "false";
	$me->my_config['paMOOramics_displayfooter']		= isset($_POST['paMOOramics_displayfooter']) ? "display:none;" : "";
	$me->my_config['pamooramics_Slideshow_displayfooter']= isset($_POST['pamooramics_Slideshow_displayfooter']) ? "display:none;" : "";
	$me->save_config();

}

global $template;
$template->set_filenames( array('paMOOramics_admin_content' => dirname(__FILE__).'/admin.tpl') );
$template->append('head_elements',
		   '<script type="text/javascript" src="./plugins/paMOOramics/farbtastic/farbtastic.js"></script>
<link rel="stylesheet" type="text/css"
      href="./plugins/paMOOramics/farbtastic/farbtastic.css" />
<link rel="stylesheet" type="text/css"
      href="./plugins/paMOOramics/admin.css" />');

$template->assign('PAMOORAMICS_NAME', 				$me->my_config['paMOOramics_name']);
$template->assign('PAMOORAMICS_RATIO', 				$me->my_config['paMOOramics_ratio']);
$template->assign('PAMOORAMICS_WIDTH', 				$me->my_config['paMOOramics_width']);
$template->assign('PAMOORAMICS_BORDER', 			$me->my_config['paMOOramics_border']);
$template->assign('PAMOORAMICS_BORDERCOLOR', 		$me->my_config['paMOOramics_bordercolor']);
$template->assign('PAMOORAMICS_FOOTERCOLOR', 		$me->my_config['paMOOramics_footercolor']);
$template->assign('PAMOORAMICS_CAPTIONCOLOR', 		$me->my_config['paMOOramics_captioncolor']);
$template->assign('PAMOORAMICS_AUTOSCROLLSPEED', 	$me->my_config['paMOOramics_autoscrollSpeed']);

if ($me->my_config['paMOOramics_activateSlider']=='true')
	$template->assign('PAMOORAMICS_ACTIVATESLIDER','checked');
if ($me->my_config['paMOOramics_enableAutoscroll']=='true')
	$template->assign('PAMOORAMICS_ENABLEAUTOSCROLL','checked');
if ($me->my_config['paMOOramics_autoscrollOnLoad']=='true')
	$template->assign('PAMOORAMICS_AUTOSCROLLONLOAD','checked');
if ($me->my_config['paMOOramics_displayfooter']=='display:none;')
	$template->assign('PAMOORAMICS_DISPLAYFOOTER','checked');
if ($me->my_config['pamooramics_Slideshow_displayfooter']=='display:none;')
	$template->assign('PAMOORAMICS_SLIDE_DISPLAYFOOTER','checked');



if ($me->my_config['paMOOramics_mode']=='modename')
	$template->assign('PAMOORAMICS_USENAME','checked');
if ($me->my_config['paMOOramics_mode']=='moderatio')
	$template->assign('PAMOORAMICS_USERATIO','checked');


$template->assign_var_from_handle( 'ADMIN_CONTENT', 'paMOOramics_admin_content');
?>