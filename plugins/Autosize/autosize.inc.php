<?php
// +-----------------------------------------------------------------------+
// | Piwigo - a PHP based picture gallery                                  |
// | Autosize                                                              |
// +-----------------------------------------------------------------------+
// | Copyright(C) 2010      cljosse                                        |
// +-----------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify  |
// | it under the terms of the GNU General Public License as published by  |
// | the Free Software Foundation                                          |
// |                                                                       |
// | This program is distributed in the hope that it will be useful, but   |
// | WITHOUT ANY WARRANTY; without even the implied warranty of            |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU      |
// | General Public License for more details.                              |
// |                                                                       |
// | You should have received a copy of the GNU General Public License     |
// | along with this program; if not, write to the Free Software           |
// | Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, |
// | USA.                                                                  |
// +-----------------------------------------------------------------------+
class autosize_controler {
 //============================================================
 /*
  *  cl_autosize_script_1
 */
 static public function cl_autosize_script_1()
	{
		global  $template,$user,$conf,$picture ,$page, $cl_plugin ;
 
  header ('X-UA-Compatible: n=7')  ;
   header ('X-UA-Compatible: IE=Edge')  ;
  if(isset($page['body_id']) &&	$page['body_id'] == 'theAdminPage' ) return ;

    if ('kardon' == $user['theme'] and isset($_GET['slideshow'])) return ;
     
    $ma_page=isset($page['body_id'])?$page['body_id']:"" ;
    if ($ma_page=='thePiwiShackControllerPage') return ;


    if (PHPWG_VERSION < 2.2 ) 
      $file =AUTOSIZE_PATH_ABS.'template/header_2_1.tpl' ;
    else 
      $file =AUTOSIZE_PATH_ABS.'template/header_2_2.tpl' ;
    $template->set_filenames(array('autosize_init_header'=> $file ));
    $template->set_filenames(array('autosize_init'=>AUTOSIZE_PATH_ABS. "template/conflit.tpl" ) );
//=================================================================================================
$DEBUG_autosize = isset($_POST['cl_debug_conflit']) ? $_POST['cl_debug_conflit'] : "false" ;
$DEBUG_autosize = isset($_GET['cl_debug_conflit']) ? $_GET['cl_debug_conflit'] : $DEBUG_autosize ;
$DEBUG_autosize = isset($conf['cl_debug_conflit']) ? $conf['cl_debug_conflit'] : $DEBUG_autosize ; 
//=================================================================================================

    $autosize_parametres =	 cl_autosize_Get_Options() ;			
    $theme=$user['theme'];
    $template->assign(
      array(   
        'autosize_parametres' => $autosize_parametres ,
        'cl_plugins' => $cl_plugin ,
        'cl_version' => $cl_plugin['version'] ,
        'name' => $cl_plugin['name'] ,
        'pamoorama' =>  isset($PAMOORAMICS_PATH)?"true":"false",                						 
        'theme' => $theme  ,
        'DEBUG_autosize' =>  $DEBUG_autosize ,
        'AUTOSIZE_PATH' => str_replace("../","",AUTOSIZE_PATH)  ,
        'AUTOSIZE_PATH_ABS' => AUTOSIZE_PATH_ABS,
        'Version_pwg' => PHPWG_VERSION
         )
    );
 	 	$template->concat('cl_conflit_init', $template->parse('autosize_init_header', true));
		return $template->parse( 'autosize_init', false);
	}// function cl_autosize_script_1
 //===========================================================
 /*
  * cl_autosize_script_2(admin)
 */
 static public function cl_autosize_script_2()
 {
	   global  $template,$user,$conf,$picture ,$page, $cl_plugin,$known_script ;
   if ('kardon' == $user['theme'] and isset($_GET['slideshow'])) return ;

			$AUTOSIZE_PATH = dirname(__FILE__).'/';
//=================================================================================================
$DEBUG_autosize = isset($_POST['cl_debug_conflit']) ? $_POST['cl_debug_conflit'] : "false" ;
$DEBUG_autosize = isset($_GET['cl_debug_conflit']) ? $_GET['cl_debug_conflit'] : $DEBUG_autosize ;
$DEBUG_autosize = isset($conf['cl_debug_conflit']) ? $conf['cl_debug_conflit'] : $DEBUG_autosize ; 
//=================================================================================================


			$ma_page=isset($page['body_id'])?$page['body_id']:"" ;
			$theme=$user['theme'];
 			if ($ma_page=='thePiwiShackControllerPage') return ;
			
			$template->assign(
  					array(
					'cl_version' => $cl_plugin['version'] ,
					'name' => $cl_plugin['name'] ,
					'ma_page' =>	$ma_page,
					
					'theme' => $theme  ,
					'DEBUG_autosize' => $DEBUG_autosize   ,
					'AUTOSIZE_PATH' => AUTOSIZE_PATH
					)
						);
						 
			$autoscript="<script type='text/javascript'>
			/* cl_autosize_script_2 */
			if (typeof (save_framework) == 'function')
			   save_framework('".$ma_page."');
			</script>";
          
            $autoscript .="<input id='ret_autosize'  type='hidden' value='' />";
            $autoscript .="<input id='src_img_h'  type='hidden' value='' />";
            $autoscript .="<input id='src_img_w'   type='hidden' value='' />";
            $autoscript .="<input id='window_height'  type='hidden' value='' />";
            $autoscript .="<input id='window_width'   type='hidden' value='' />";
             $autoscript .='<div id="Debug6"  align=center style="display:none"></div>';
		$template->append('footer_elements',$autoscript);  
		return ; 
 }// function cl_autosize_script_2

	//================================================================
	/*
	* cl_autosize_admin
	*/
	static public function cl_autosize_admin($menu)
		{
		global  $lang ;
		array_push($menu, array('NAME' => 'Autosize',
		'URL' => get_admin_plugin_menu_link(AUTOSIZE_PATH . 'admin/admin_autosize.php')));
		return $menu;
	} //function cl_autosize_admin

    //===============================================================
	/*
	*
	*/	
	static public function cl_autosize_affiche()
	{
		global $user, $picture, $template,$page,$known_script;
		global $content, $element_info;   
		global $infos_message,$erreur_message;
		global  $conf,$lang ,$user,$userdata;
 if ('kardon' == $user['theme'] and isset($_GET['slideshow'])) return ;
		load_language('plugin.lang', AUTOSIZE_PATH);
		$AUTOSIZE_PATH = dirname(__FILE__).'/';
		 if (isset( $page['body_id']) && $page['body_id']=='thePicturePage'  ) {
			if ( isset($picture['current'])){	
				$autosize_parametres = cl_autosize_Get_Options();
				include (AUTOSIZE_PATH."include/affiche.php"); 

       if (PHPWG_VERSION < 2.2 ) 
                $file =AUTOSIZE_PATH_ABS.'template/picture_2_1.tpl' ;
        else 
                $file =AUTOSIZE_PATH_ABS.'template/picture_2_2.tpl' ;



        $template->set_filenames(array('autosize_content_header'=> $file ));  
        $template->concat('autosize_content', $template->parse('autosize_content_header', true));   
                        
        $template->set_filenames(array('autosize_init_header'=> $file ));
                           		
				if($autosize_parametres->check_icon_v == 'on'){				 
						$template->assign('cl_autosize_button', 
						array(	'cl_autosize_info' => 'cl_autosize_info' ,
								    'cl_autosize_info_2' => 'cl_autosize_info_2' ,    
								    'URL' => $_SERVER['REQUEST_URI'] ,
								    'ICON2' => AUTOSIZE_PATH . 'icons/button-maximize.png',
								    'ICON' => AUTOSIZE_PATH . 'icons/button-minimize.png'
								)

							); 
					$template->set_filenames(array('cl_bp' => $AUTOSIZE_PATH. 'template/picture.tpl'));
					$template->concat('PLUGIN_PICTURE_ACTIONS', $template->parse('cl_bp', true));
				}
				 $template->set_filenames(
						array('autosize_content'=> $AUTOSIZE_PATH.'template/autosize.tpl')
					);
			$template->concat('autosize_content', $template->parse('autosize_content_header', true));		
      if(isset($conf['go_up_down']) && ($conf['go_up_down']==true) ){
        $template->set_filenames(array('mes_script' => realpath(AUTOSIZE_PATH).'/template/mes_scripts.tpl') );
        $template->func_combine_script(array('id'=>'my_script_2',
        'path'=> AUTOSIZE_PATH.'/js/JScript.js',
        'require' => 'jquery'),
        $template->smarty);
        $template->assign(array( 
                          'MY_FOOTER_PATH' =>AUTOSIZE_PATH
                          ));
					
        $template->parse('mes_script');
      }      
        
        
        
        return $template->parse( 'autosize_content', false);
     				  }
		}

	} //public function cl_autosize_affiche
	//===============================================================
		/*
	*
	*/
	static public function cl_autosize_aff_infos_plus()
		{
		 global $template,$infos_message,$erreur_message, $user ;
		 global  $conf,$lang ;
	
		 //==============================================================
		  if (isset($erreur_message))
				{	
				if ($erreur_message <> "")
					{
						$erreur_message=str_replace("\n",'<br />',$erreur_message) ;
   						$template->assign('errors',$erreur_message);
						$erreur_message="";
					}
  				}
		  if (isset($infos_message))
				{	
		
				if ($infos_message <> "")
					{
						$infos_message=str_replace("\n",'<br />',$infos_message) ;
   						$template->assign('infos',$infos_message);
						$infos_message="";
					}
  				}
				//=============================================================
		return;		 
		
		} // function cl_autosize_aff_infos_plus
	//===============================================================
	/*
	 *
	*/
	static public function cl_ajuste_data($content){
		global  $template,$user,$conf,$picture ;
		$AUTOSIZE_PATH = realpath(AUTOSIZE_PATH .'/');
		$userdata=$user;
		$fields = array( 'maxwidth', 'maxheight' );
	 
		$ThePicture = $template->get_template_vars('current'); 
		$data = array();
	 return $content;

		$data['maxwidth'] = '1200';
		$data['maxheight'] ='250';
		$data['user_id'] = $userdata['id'];
		foreach ($fields as $field)
		{
			if (isset($_POST[$field]))
			{
				$data[$field] = $_POST[$field];
			}
		}
	
		if($data['maxwidth'] != "" )
			{
			$picture['current']['scaled_width']=$data['maxwidth'];
			$picture['current']['scaled_height']=$data['maxheight'];
			mass_updates(USER_INFOS_TABLE,
					array('primary' => array('user_id'), 'update' => $fields),
					array($data));	
			}
		 
			return $content;										 
		 }

} // class


	/*
	*
	*/
 function cl_autosize_Get_Options()
  {
		global $conf,$autosize_parametres; 
  		$autosize_parametres =  unserialize($conf['cl_autosize']);
		$autosize_parametres =  cl_autosize_Set_Options();
		return $autosize_parametres;
  }
	/*
	*
	*/
function cl_autosize_Set_Options()
  {

  global $autosize_parametres;
//=============================================================================
$my_para=$autosize_parametres;

$my_para->query =(isset($_POST['query'])) ? $_POST['query'] : ((isset($my_para->query )) ? $my_para->query : 'Qt' ) ;
$my_para->type=(isset($_POST['type']))? $_POST['type']: ((isset($my_para->type)) ? $my_para->type:  'Ty') ;

$my_para->webmaster_height =(isset($_POST['webmaster_height'])) ? $_POST['webmaster_height'] : ((isset($my_para->webmaster_height )) ? $my_para->webmaster_height : '100%' ) ;
$my_para->webmaster_width=(isset($_POST['webmaster_width']))? $_POST['webmaster_width']: ((isset($my_para->webmaster_width)) ? $my_para->webmaster_width:  '100%') ;

$my_para->admin_height =(isset($_POST['admin_height'])) ? $_POST['admin_height'] : ((isset($my_para->admin_height )) ? $my_para->admin_height : '100%' ) ;
$my_para->admin_width=(isset($_POST['admin_width']))? $_POST['admin_width']: ((isset($my_para->admin_width)) ? $my_para->admin_width:  '100%') ;

$my_para->generic_height =(isset($_POST['generic_height'])) ? $_POST['generic_height'] : ((isset($my_para->generic_height )) ? $my_para->generic_height : '100%' ) ;
$my_para->generic_width=(isset($_POST['generic_width']))? $_POST['generic_width']: ((isset($my_para->generic_width)) ? $my_para->generic_width:  '100%') ;

$my_para->guest_height =(isset($_POST['guest_height'])) ? $_POST['guest_height'] : ((isset($my_para->guest_height )) ? $my_para->guest_height : '100%' ) ;
$my_para->guest_width=(isset($_POST['guest_width']))? $_POST['guest_width']: ((isset($my_para->guest_width)) ? $my_para->guest_width:  '100%') ;

$my_para->normal_height =(isset($_POST['normal_height'])) ? $_POST['normal_height'] : ((isset($my_para->normal_height )) ? $my_para->normal_height : '100%' ) ;
$my_para->normal_width=(isset($_POST['normal_width']))? $_POST['normal_width']: ((isset($my_para->normal_width)) ? $my_para->normal_width:  '100%') ;


$my_para->mini_height =(isset($_POST['mini_height'])) ? $_POST['mini_height'] : ((isset($my_para->mini_height )) ? $my_para->mini_height : '150' ) ;
$my_para->mini_width=(isset($_POST['mini_width']))? $_POST['mini_width']: ((isset($my_para->mini_width)) ? $my_para->mini_width:  '300') ;

$my_para->mini_height2 =(isset($_POST['mini_height2'])) ? $_POST['mini_height2'] : ((isset($my_para->mini_height2 )) ? $my_para->mini_height2 : '150' ) ;
$my_para->mini_width2=(isset($_POST['mini_width2']))? $_POST['mini_width2']: ((isset($my_para->mini_width2)) ? $my_para->mini_width2:  '300') ;

$my_para->echelle_max=(isset($_POST['echelle_max']))? $_POST['echelle_max'] : ((isset($my_para->echelle_max)) ? $my_para->echelle_max :  '1.0'); 
$my_para->marge_basse=(isset($_POST['marge_basse']))? $_POST['marge_basse']: ((isset($my_para->marge_basse)) ? $my_para->marge_basse :  '0');
$my_para->fade_in=(isset($_POST['fade_in']))? $_POST['fade_in']: ((isset($my_para->fade_in)) ? $my_para->fade_in :  '0');

//===============================================================================	

if ( isset($_POST['submit'] ) && $_POST['submit'] == l10n('cl_autosize_save') )  {  
		$my_para->check_desc_v = isset($_POST['check_desc_v']) ? $_POST['check_desc_v'] : "off" ;
		$my_para->check_icon_v = isset($_POST['check_icon_v']) ? $_POST['check_icon_v'] : "off" ;
 		$my_para->check_auto_w = isset($_POST['check_auto_w']) ? $_POST['check_auto_w'] : "off" ;

		$my_para->webmaster_enabled = isset($_POST['webmaster_enabled']) ? $_POST['webmaster_enabled'] : "off" ;
		$my_para->admin_enabled = isset($_POST['admin_enabled']) ? $_POST['admin_enabled'] : "off" ;
		$my_para->generic_enabled = isset($_POST['generic_enabled']) ? $_POST['generic_enabled'] : "off" ;
		$my_para->guest_enabled = isset($_POST['guest_enabled']) ? $_POST['guest_enabled'] : "off" ;
		$my_para->normal_enabled = isset($_POST['normal_enabled']) ? $_POST['normal_enabled'] : "off" ;

	 }else{
		$my_para->check_desc_v = isset($_POST['check_desc_v']) ? $_POST['check_desc_v'] : ( ( isset($my_para->check_desc_v) ) ? $my_para->check_desc_v :   'off') ;  
		$my_para->check_icon_v = isset($_POST['check_icon_v']) ? $_POST['check_icon_v'] : ( ( isset($my_para->check_icon_v) ) ? $my_para->check_icon_v :   'off') ;  
		$my_para->check_auto_w = isset($_POST['check_auto_w']) ? $_POST['check_auto_w'] : ( ( isset($my_para->check_auto_w) ) ? $my_para->check_auto_w :   'off') ;  


$my_para->webmaster_enabled = isset($_POST['webmaster_enabled']) ? $_POST['webmaster_enabled'] : ( ( isset($my_para->webmaster_enabled) ) ? $my_para->webmaster_enabled :   'on') ;  
$my_para->admin_enabled  = isset($_POST['admin_enabled ']) ? $_POST['admin_enabled '] : ( ( isset($my_para->admin_enabled ) ) ? $my_para->admin_enabled :   'on') ;  
$my_para->generic_enabled = isset($_POST['generic_enabled']) ? $_POST['generic_enabled'] : ( ( isset($my_para->generic_enabled) ) ? $my_para->generic_enabled :   'on') ;  
$my_para->guest_enabled = isset($_POST['guest_enabled']) ? $_POST['guest_enabled'] : ( ( isset($my_para->guest_enabled) ) ? $my_para->guest_enabled :   'on') ;
$my_para->normal_enabled = isset($_POST['normal_enabled']) ? $_POST['normal_enabled'] : ( ( isset($my_para->normal_enabled) ) ? $my_para->normal_enabled :   'on') ;  


   }

return $my_para;
}
	/*
	*
	*/
function cl_autosize_sauve_options_inf()
{
global $options,$infos_message,$conf,$autosize_parametres  ;
$infos_message .=l10n("cl_autosize_save_config")."<br>";
 $autosize_parametres=cl_autosize_Set_Options();

 if ( isset($autosize_parametres) )
 	{
 
		$query = '
    		UPDATE '.CONFIG_TABLE.'
    		SET value="'.addslashes(serialize($autosize_parametres)).'"
    		WHERE param = "cl_autosize"
    		LIMIT 1';
 			pwg_query($query);
	  }
	 
 }

 function auto_memo_var($variables)
{
  ob_start();
  echo '<pre>';
  print_r($variables);
  echo '</pre>';
  $m= ob_get_contents();
  ob_end_clean();
  return $m;		
}
    

?>