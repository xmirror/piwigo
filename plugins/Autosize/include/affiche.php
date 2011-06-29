<?php  
$visible=(isset($visible))?$visible:false;
$img_width=isset($picture['current']['width'])?$picture['current']['width']:480;
$img_height=isset($picture['current']['height'])?$picture['current']['height']:320;

$img_scaled_width=isset($picture['current']['scaled_width'])?$picture['current']['scaled_width']:480;
$img_scaled_height=isset($picture['current']['scaled_height'])?$picture['current']['scaled_height']:320;

$cl_version=isset($cl_version)?$cl_version:"";
$cl_plugin=isset($cl_plugin)?$cl_plugin:"";
$cl_visible=isset($conf['cl_auto']) ? $conf['cl_auto'] : 'true' ; 
//=================================================================================================
$DEBUG_autosize = isset($_POST['cl_debug_conflit']) ? $_POST['cl_debug_conflit'] : "false" ;
$DEBUG_autosize = isset($_GET['cl_debug_conflit']) ? $_GET['cl_debug_conflit'] : $DEBUG_autosize ;
$DEBUG_autosize = isset($conf['cl_debug_conflit']) ? $conf['cl_debug_conflit'] : $DEBUG_autosize ; 
//=================================================================================================
  $my_path = AUTOSIZE_PATH_ABS;
  $theme=$user['theme'];
  $user_status = $user['status'] ;

                   $template->assign( array( 
                   'AUTOSIZE_PATH_ABS' => AUTOSIZE_PATH_ABS,
                   'ROOT_URL' => ROOT_URL,
                   'AUTOSIZE_PATH' => AUTOSIZE_PATH,
											)
									);	
                 
  
                              	
  	$template->assign(
  					array(
            'DEBUG_autosize' =>  $DEBUG_autosize   ,
            'cl_visible' =>  $cl_visible,
            'cl_version' => $cl_version,
            'cl_plugin' => $cl_plugin,

            'fade_in' => $autosize_parametres->fade_in,
            'thumbnail' => $conf['prefix_thumbnail'],
            'visible' => $visible,

            'theme' => $theme,
            'SCALED_WIDTH' => $img_scaled_width,
            'SCALED_HEIGHT' => $img_scaled_height,                    
            'IMG_WIDTH' 	=> $img_width,
            'IMG_HEIGHT'	=> $img_height,
                    
            'MINI_HEIGHT' => $autosize_parametres->mini_height,
            'MINI_WIDTH' 	=> $autosize_parametres->mini_width,
            'MINI_HEIGHT2' => $autosize_parametres->mini_height2,
            'MINI_WIDTH2' 	=> $autosize_parametres->mini_width2,

            'MARGE_BASSE' => $autosize_parametres->marge_basse,
            'ECHELLE_MAX' => $autosize_parametres->echelle_max,

            'check_auto_w' => ($autosize_parametres->check_auto_w == 'on') ? 'checked="checked"'  : '' ,
            'check_icon_v' => ($autosize_parametres->check_icon_v == 'on') ? 'checked="checked"'  : '' ,
            'check_desc_v' => ($autosize_parametres->check_desc_v == 'on') ? 'checked="checked"'  : '' ,

            'webmaster_width' => $autosize_parametres->webmaster_width,
            'webmaster_height' => $autosize_parametres->webmaster_height,
            'webmaster_enabled' => ($autosize_parametres->webmaster_enabled == 'on') ? 'checked="checked"'  : '' ,

            'admin_width' => $autosize_parametres->admin_width,
            'admin_height' => $autosize_parametres->admin_height,
            'admin_enabled' => ($autosize_parametres->admin_enabled == 'on') ? 'checked="checked"'  : '' ,

            'generic_width' => $autosize_parametres->generic_width,
            'generic_height' => $autosize_parametres->generic_height,
            'generic_enabled' => ($autosize_parametres->generic_enabled == 'on') ? 'checked="checked"'  : '' ,

            'guest_width' => $autosize_parametres->guest_width,
            'guest_height' => $autosize_parametres->guest_height,
            'guest_enabled' => ($autosize_parametres->guest_enabled == 'on') ? 'checked="checked"'  : '' ,
				 
            'normal_width' => $autosize_parametres->normal_width,
            'normal_height' => $autosize_parametres->normal_height,
            'normal_enabled' => ($autosize_parametres->normal_enabled == 'on') ? 'checked="checked"'  : '' ,

            'user_status'   => get_user_status($user_status)  
					
				 )
				);	

			    
 //unset($_POST);
?>