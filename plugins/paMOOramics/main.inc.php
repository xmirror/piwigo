<?php
/*
Plugin Name: paMOOramics
Version: 2.2
Description: Display panoramics images using pamoorama script by silvertab (powered by mootools)
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=213
Author: repie38
Author URI: 
*/

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
define('PAMOORAMICS_PATH' , PHPWG_PLUGINS_PATH . basename(dirname(__FILE__)) . '/');


class paMOOramics
{
	function paMOOramics_menu($menu)
	    {
	        array_push($menu,
	            array(
	                'NAME' => 'paMOOramics',
	                'URL' => get_root_url().'admin.php?page=plugin-'.basename(dirname(__FILE__))
	            )
	        );
	        return $menu;
	    }


	var $my_config;
	    function load_config()
	    {
	        $x = @file_get_contents( dirname(__FILE__).'/data.dat' );
	        if ($x!==false)
	        {
	            $c = unserialize($x);
	            $this->my_config = $c;
	        }

	        if ( !isset($this->my_config)
	            or empty($this->my_config['paMOOramics_ratio']) )
	        {
	            //default values

	            $this->my_config['paMOOramics_mode'] = 'moderatio';
	            $this->my_config['paMOOramics_name'] = 'paMOOramics';
	            $this->my_config['paMOOramics_ratio'] = 2;
	            $this->my_config['paMOOramics_border'] = 2;
				$this->my_config['paMOOramics_bordercolor'] = '#FFFFFF';
	            $this->my_config['paMOOramics_width'] = 650;
	            $this->my_config['paMOOramics_activateSlider'] = 'true';
	            $this->my_config['paMOOramics_footercolor'] = '#000000';
	            $this->my_config['paMOOramics_captioncolor'] = '#FFFFFF';
	            $this->my_config['paMOOramics_enableAutoscroll'] = 'true';
	            $this->my_config['paMOOramics_autoscrollSpeed'] = 10000;
	            $this->my_config['paMOOramics_autoscrollOnLoad'] = 'false';
				$this->my_config['paMOOramics_displayfooter'] = '';
				$this->my_config['pamooramics_Slideshow_displayfooter']= 'display:none;';
	            $this->save_config();
	        }
	    }
	    function save_config()
	    {
	        $file = fopen( dirname(__FILE__).'/data.dat', 'w' );
	        fwrite($file, serialize($this->my_config) );
	        fclose( $file );
	    }



	function paMOOramics_load ($content) {
		global $template,$picture,$page;

		if (isset($picture['current']['scaled_width']) && isset($picture['current']['scaled_height'])) {
			$current_ratio=$picture['current']['scaled_width']/$picture['current']['scaled_height'];
		}

		if ((isset($current_ratio))&&(empty($content))) {
			if  (($this->my_config['paMOOramics_mode']=='modename' && stristr($picture['current']['name'],$this->my_config['paMOOramics_name']))
				or
				($current_ratio >= ($this->my_config['paMOOramics_ratio']) && $this->my_config['paMOOramics_mode']=='moderatio')
				) {

					$template->append('head_elements',
					   '<script src="plugins/paMOOramics/js/mootools.js" type="text/javascript" charset="utf-8"></script>
						<script src="plugins/paMOOramics/js/pamoorama0.3.js" type="text/javascript" charset="utf-8"></script>');

					$template->set_filenames(
							array('pamooramics_content'=> dirname(__FILE__).'/picture_content.tpl')
						);
					$template->assign( array(
					   'SRC_IMG' 				=> $picture['current']['image_url'],
					   'ALT_IMG' 				=> htmlspecialchars($picture['current']['name'], ENT_QUOTES),
					   'WIDTH_IMG' 				=> $picture['current']['scaled_width'],
					   'HEIGHT_IMG' 			=> $picture['current']['scaled_height'],
					   'PANO_BORDER' 			=> $this->my_config['paMOOramics_border'],
					   'PANO_BORDERCOLOR' 		=> $this->my_config['paMOOramics_bordercolor'],
					   'PANO_WIDTH' 			=> $this->my_config['paMOOramics_width'],
					   'PANO_FOOTERCOLOR' 		=> $this->my_config['paMOOramics_footercolor'],
					   'PANO_CAPTIONCOLOR' 		=> $this->my_config['paMOOramics_captioncolor'],));

					$slideshow_paMOOramics_activateSlider	= $this->my_config['paMOOramics_activateSlider'];
					$slideshow_paMOOramics_enableAutoscroll	= $this->my_config['paMOOramics_enableAutoscroll'];
					$slideshow_paMOOramics_autoscrollSpeed	= $this->my_config['paMOOramics_autoscrollSpeed'];
					$slideshow_paMOOramics_autoscrollOnLoad	= $this->my_config['paMOOramics_autoscrollOnLoad'];


					 if ( !$page['slideshow'] ){
						if (isset($picture['current']['high_url'])){
							$uuid = uniqid(rand());
							$template->assign('high', array(
									'U_HIGH' => $picture['current']['high_url'] ,
									'UUID'   => $uuid,      ));
						}
						$display_footer=$this->my_config['paMOOramics_displayfooter'];
					}

					else {
						$slideshow_params = decode_slideshow_params($_GET['slideshow']);
						$slideshow_paMOOramics_activateSlider	= 'true';
						$slideshow_paMOOramics_enableAutoscroll	= 'true';
						$slideshow_paMOOramics_autoscrollSpeed	= ($slideshow_params['period']-0.5)*1000;
						$slideshow_paMOOramics_autoscrollOnLoad	= 'true';
						$display_footer=$this->my_config['pamooramics_Slideshow_displayfooter'];
					}

					$template->assign( array(
						'PANO_ACTIVATESLIDER'		=> $slideshow_paMOOramics_activateSlider,
						'PANO_ENABLEAUTOSCROLL' 	=> $slideshow_paMOOramics_enableAutoscroll,
						'PANO_AUTOSCROLLSPEED' 		=> $slideshow_paMOOramics_autoscrollSpeed,
						'PANO_AUTOSCROLLONLOAD' 	=> $slideshow_paMOOramics_autoscrollOnLoad,
						'PANO_DISPLAYFOOTER'     	=> $display_footer,));

					load_language('plugin.lang', PAMOORAMICS_PATH);

					return $template->parse( 'pamooramics_content', true);

			}
			else {
				return $content;
			}
		}
		else {
			return $content;
		}



	}



}

$obj = new paMOOramics();
$obj->load_config();


add_event_handler('get_admin_plugin_menu_links', array(&$obj, 'paMOOramics_menu') );
set_plugin_data($plugin['id'], $obj);

add_event_handler('render_element_content', array(&$obj, 'paMOOramics_load'),41,2);




?>
