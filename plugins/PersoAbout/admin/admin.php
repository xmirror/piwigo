<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
global $template, $conf, $user;
include_once(PHPWG_ROOT_PATH .'admin/include/tabsheet.class.php');
load_language('plugin.lang', PPA_PATH);
$my_base_url = get_admin_plugin_menu_link(__FILE__);

// +-----------------------------------------------------------------------+
// | Check Access and exit when user status is not ok                      |
// +-----------------------------------------------------------------------+
check_status(ACCESS_ADMINISTRATOR);

//-------------------------------------------------------- sections definitions

// Gestion des onglets
if (!isset($_GET['tab']))
    $page['tab'] = 'gest';
else
    $page['tab'] = $_GET['tab'];

$tabsheet = new tabsheet();
$tabsheet->add('gest',
               l10n('ppa_tab_gest'),
               $my_base_url.'&amp;tab=gest');
$tabsheet->add('help',
               l10n('ppa_tab_help'),
               $my_base_url.'&amp;tab=help');
$tabsheet->select($page['tab']);
$tabsheet->assign();

// Onglet gest
switch ($page['tab'])
{
  case 'gest':

//charge Perso About
$query = '
select param,value
	FROM ' . CONFIG_TABLE . '
  WHERE param = "persoAbout"
	;';
$result = pwg_query($query);

$row = mysql_fetch_array($result);
    
  $template->assign(
    'gestA',
    array(
      'PPABASE' => $row['value'],
      ));


//insértion de meta dans la table
if (isset($_POST['submitppa']) and !is_adviser())
	{
	$query = '
UPDATE ' . CONFIG_TABLE . '
  SET value= \''.$_POST['perso_about'].'\'
  WHERE param = "persoAbout"
    ;';
$result = pwg_query($query);

  $template->assign(
    'gestA',
    array(
      'PPABASE' => stripslashes($_POST['perso_about']),
      ));

	}

    break;

// Tab help
  case 'help':
$template->assign(
    'gestB',
	array(
	  'meta'=>l10n('meta_name'),
	  ));
	break;
	
} 

$template->set_filenames(array('plugin_admin_content' => dirname(__FILE__) . '/admin.tpl')); 
$template->assign_var_from_handle('ADMIN_CONTENT', 'plugin_admin_content');
?>