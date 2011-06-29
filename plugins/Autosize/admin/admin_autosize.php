<?php
// +-----------------------------------------------------------------------+
// | Piwigo - a PHP based picture gallery                                  |
// +-----------------------------------------------------------------------+
// | Copyright(C) 2008-2009 Piwigo Team                  http://piwigo.org |
// | Copyright(C) 2003-2008 PhpWebGallery Team    http://phpwebgallery.net |
// | Copyright(C) 2002-2003 Pierrick LE GALL   http://le-gall.net/pierrick |
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

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
if (!defined('AUTOSIZE_DIR')) define('AUTOSIZE_DIR' , basename(dirname(__FILE__)));
if (!defined('AUTOSIZE_PATH')) 
define(
  'AUTOSIZE_PATH',
   PHPWG_PLUGINS_PATH.basename(dirname(__FILE__)).'/'
);
if (!defined('ROOT_URL')) 
define(  'ROOT_URL',  get_root_url().'/' );

if (!defined('AUTOSIZE_PATH_ABS')) 
define('AUTOSIZE_PATH_ABS', realpath(AUTOSIZE_PATH)."/");

// +-----------------------------------------------------------------------+
// | Check Access and exit when user status is not ok                      |
// +-----------------------------------------------------------------------+
//check_status(ACCESS_ADMINISTRATOR);
include_once(PHPWG_ROOT_PATH.'admin/include/functions.php');
include_once (PHPWG_ROOT_PATH.'admin/include/tabsheet.class.php');

$my_base_url = get_admin_plugin_menu_link(__FILE__);



$tabsheet = new tabsheet();
$tabsheet->add( 'autosize_admin',
                l10n('admin'),
                $my_base_url.'&amp;tab=autosize_admin'
			   );
 /*	
$tabsheet->add( 'autosize_help',
                l10n('help'),
                $my_base_url.'&amp;tab=autosize_help'
			   );
			   
	*/	   
			   
	if (!isset($_GET['tab']))
	   $page['tab'] = 'autosize_admin';
else
       $page['tab'] = $_GET['tab'];	
	   
	   		   
$tabsheet->select($page['tab']);
$tabsheet->assign();

$page['global'] = array();
$error = array();

global $user, $conf, $errors ;
global $args, $autosizes_message,$erreur_message ;

include_once (AUTOSIZE_PATH.'include/constants.php'); 

$aff_nb=true;

 ; 
include_once(PHPWG_ROOT_PATH.'admin/include/functions.php');
include_once (PHPWG_ROOT_PATH.'admin/include/tabsheet.class.php');


$my_base_url = get_admin_plugin_menu_link(__FILE__);
load_language('plugin.lang', AUTOSIZE_PATH ); 
// *************************************************************************
// |                          Sélection de l'onglet                        |
// *************************************************************************
global $infos_message ;  
global $erreur_message;
global $conf;
global $autosize_parametres;
global $template,$page,$conf ; 
    global $picture;
 
 $visible=true;	
 $path = AUTOSIZE_PATH;
 $autosize_parametres = cl_autosize_Get_Options();
	  
   if (isset($_POST['submit']))  {  
	  if ($_POST['submit'] == l10n('cl_autosize_save'))  {  
	         cl_autosize_sauve_options_inf() ;
		     unset($_POST); 
		 }
	}	
	//=========================================
	if (isset($_POST['img_start']))  {
		 unset($_POST);
		 }
 include (AUTOSIZE_PATH."include/affiche.php"); 	 	 
//================================================================================
$base_url = get_root_url().'admin_autosize.php';
switch ($page['tab'])
 {
  case 'autosize_admin':
    $template->set_filenames(array('plugin_admin_content' => realpath(AUTOSIZE_PATH . 'admin/template/admin.tpl')));
    $template->assign_var_from_handle('ADMIN_CONTENT', 'plugin_admin_content');
    break; 
 
case 'autosize_help': 

 $message="
    <script id='dimensions' src='./plugins/Autosize/js/autosize.dimensions.js'></script>
    <script id='Affiche_script' src='./plugins/Autosize/js/Affiche_script.js'></script>
    <fieldset id='fieldset'>
    <div class='autosize' 
         autosize='MargeBasse:30px;MargeHaute:30px;parent:fieldset;ResizePicture:true'>
        <img src='./plugins/Autosize/images/ECO_050.jpg ' width='100%' />       
    </div>
</fieldset>"; 
    if (isset($_POST['valid']))  {    	$message = empty($_POST['texte']) ? $message : stripslashes($_POST['texte']);
	}	
    //=========================================================================	
   

     $toolbar = 'Full';		//basic 
  		$width = 'auto';
  		$height = 'auto';
  		$areas = array();
  		$areas[]='texte';
		if (!empty($areas)){
  				if (function_exists('set_fckeditor_instance'))
                {  $template->set_prefilter('plugin_admin_content', 'add_remove_button');
    				 set_fckeditor_instance($areas, $toolbar, $width, $height);
                    }
  			}

 $template->set_filenames(array( 'plugin_admin_content' => realpath(AUTOSIZE_PATH . 'admin/template/help.tpl' )));
 $template->assign(
  					array(
   'message' =>  $message  ,
   ));


 $template->assign_var_from_handle('ADMIN_CONTENT', 'plugin_admin_content');
 break; 
  }
       if (!isset($infos_message)){
		  $infos_message = "";
		}  		  
		if  ($infos_message != "")  {
		   array_push($page['infos'],  $infos_message);
		   $infos_message="";
		 }
		if (!isset($erreur_message)){
		  $erreur_message = "";
		} 		 
		if  ($erreur_message != "")  {
	
		  array_push($page['errors'], $erreur_message);
		  $erreur_message="";
	
		 
		 }		 
		 
//================================================================
 

?>