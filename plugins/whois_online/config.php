<?php

/* Whois online Configuration, Radar and cleaning */

/*
 TODO list:
- User comments… (Delete all comments or partial delete)
- Bots identification (for exclusion maybe a sharing feature with antiaspi to lock user/IP)
- hits level (to suggest a new bot)
- IPV6 Support
- Map
*/

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
if (!defined('IN_ADMIN') or !IN_ADMIN) die('Hacking attempt!');
global $conf, $conf_whois, $lang;
$conf['show_gt'] = true;
load_language('plugin.lang', WHOIS_ONLINE_PATH);

pwg_debug('*********** Whois configuration ***********');

if (!isset($conf_whois['Active'])) $conf_whois = whois_online_conf();
$errors = array();
$infos = array();
add_event_handler('loc_end_admin', 'whois_select_menu' );

// Get Current data
$conf['Whois Online Update'] = false;
whois_online_management();

$template->set_filenames(array(
    'plugin_admin_content' => dirname(__FILE__) . '/config.tpl',
		'double_select' => 'double_select.tpl'
		));

if (!defined('ROOT_URL')) 
define(  'ROOT_URL',  get_root_url().'/' );

$WHOIS_PATH_ABS=str_replace('\\','/',dirname(__FILE__) );
if (!defined('WHOIS_PATH_ABS')) 
define(
  'WHOIS_PATH_ABS',   $WHOIS_PATH_ABS."/"
);
   if (version_compare(PHPWG_VERSION, '2.2', '>=') )  
                $file =WHOIS_PATH_ABS.'template/header_2_2.tpl' ;
        else 
                $file =WHOIS_PATH_ABS.'template/header_2_1.tpl' ;

 $template->set_filenames(array('whois_init_header'=> $file ));
 $template->assign(Array(
	
	'Whois_path' => WHOIS_ONLINE_PATH
  ));

  	$template->concat('plugin_admin_content', $template->parse('whois_init_header', true));


// Tabsheets 
include_once(PHPWG_ROOT_PATH.'admin/include/tabsheet.class.php');
$_url = get_admin_plugin_menu_link(__FILE__);
if (!isset($_GET['tab'])) $page['tab'] = 'config';
else $page['tab'] = $_GET['tab'];  

$tabsheet = new tabsheet();
$tabsheet->add('config', l10n('config'), $_url.'&amp;tab=config');
$tabsheet->add('monitor', l10n('Monitor'), $_url.'&amp;tab=monitor');
$tabsheet->add('report', l10n('Report'), $_url.'&amp;tab=report');
$tabsheet->select($page['tab']);
$tabsheet->assign();
$template->assign('page', $page['tab']);

$sub = ( isset($_POST['submit']) ) ? true : false;

// Check input on config
if ($sub and isset($_POST['from']) and $_POST['from']=='config') {
  if (!is_numeric($_POST['Level']) or $_POST['Level'] < 10 or $_POST['Level'] > 200) 
		array_push($errors, l10n('Error range: '). l10n('Delete level [10-200] (ratio between obsolete and active)'));
  if (!is_numeric($_POST['Limit']) or $_POST['Limit'] < 10 or $_POST['Limit'] > 200) 
		array_push($errors, l10n('Error range: '). l10n('Obsolete limit [20-100] (obsolete data count)'));
	if (!is_numeric($_POST['Radar_limit']) or $_POST['Radar_limit'] < 10 or $_POST['Radar_limit'] > 200) 
		array_push($errors, l10n('Error range: '). l10n('Radar_limit [10-200] (Users with image cluetips on radar page)'));
	if (!is_numeric($_POST['Webmaster_management']) or $_POST['Webmaster_management'] > 2) 
		array_push($errors, l10n('User follow up error'));
	if (!is_numeric($_POST['Administrator_management']) or $_POST['Administrator_management'] > 2) 
		array_push($errors, l10n('User follow up error'));
	$conf_whois = array_merge($conf_whois, Array(
		'Active' => ($_POST['Active']==1) ? true:false,
		'Delete level' => $_POST['Level'],
		'Obsolete limit' => $_POST['Limit'],
		'Radar limit' => $_POST['Radar_limit'],
		'Webmasters' => (int) $_POST['Webmaster_management'],
		'Administrators' => (int) $_POST['Administrator_management'],
		'Add to Plugins menu' => ($_POST['Plugins_menu']==1) ? true:false,
		'Add icon to History' => ($_POST['History_icon']==1) ? true:false,
		'Keep data' => ($_POST['Keep_data']==1) ? true:false,
		'Default display' => ($_POST['Display']==1) ? true:false,
		'Version' => WHOIS_ONLINE_VER,
	));
}

// Submit and Advisor => Thanks
if ( $sub and is_adviser() )
	array_push($infos, l10n('You are Adviser and you are not authorized to change this configuration.'));

	// Submit and not Advisor => Update Config table
if ( $sub and count($errors) == 0 and $_POST['from']=='config' and !is_adviser()) {
	if ( $conf['Whois Online'] != serialize($conf_whois) ) {
		$conf['Whois Online'] = serialize($conf_whois);
		pwg_query('REPLACE INTO ' . CONFIG_TABLE . " (param,value,comment)
    VALUES ('Whois Online','". $conf['Whois Online'] ."','Whois Online configuration');");
		array_push($infos, l10n('Configuration has been saved.'));
	}
}

// Switch users on right side (=> Temporary)
if ( isset($_POST['falsify']) and !is_adviser() 
    and count($errors) == 0 and $_POST['from']=='monitor'
    and isset($_POST['cat_true']) and count($_POST['cat_true']) > 0) {
      pwg_query('UPDATE '.WHOIS_ONLINE_TABLE.'
  SET `permanent` = \'false\'
  WHERE `session_id` IN ("'.implode('","', $_POST['cat_true']).'");');
}
// Switch users on left side (Permanent <=)
if ( isset($_POST['trueify']) and !is_adviser() 
    and count($errors) == 0 and $_POST['from']=='monitor'
    and isset($_POST['cat_false']) and count($_POST['cat_false']) > 0) {
      pwg_query('UPDATE '.WHOIS_ONLINE_TABLE.'
  SET `permanent` = \'true\'
  WHERE `session_id` IN ("'.implode('","', $_POST['cat_false']).'");');
}
// Delete users from > 24 h temporary list
if ( isset($_POST['prs_delete']) and !is_adviser() 
    and count($errors) == 0 and $_POST['from']=='monitor'
    and isset($_POST['prs_remove']) and count($_POST['prs_remove']) > 0) {
     pwg_query('DELETE FROM '.WHOIS_ONLINE_TABLE.'
  WHERE `permanent` = \'false\'
    AND `session_id` IN ("'.implode('","', $_POST['prs_remove']).'");');
}
// Compress it!
if ( isset($_GET['check']) and !is_adviser() ) {
  pwg_query('DELETE FROM ' . WHOIS_ONLINE_TABLE . ' WHERE `last_access` < ' . (time() - (3*24*60*60)) . '
    AND `permanent` = \'false\' AND `IP` <> \'global\';');
  pwg_query('CHECK TABLE '.WHOIS_ONLINE_TABLE);
  pwg_query('OPTIMIZE TABLE '.WHOIS_ONLINE_TABLE);
}
// The whois_online table summary
if (isset($_GET['tab']) and $_GET['tab']=='monitor') {
  $whois_status = mysql_fetch_assoc(pwg_query('SHOW TABLE STATUS LIKE "' . WHOIS_ONLINE_TABLE .'%" ;'));
  $whois_status['table'] = WHOIS_ONLINE_TABLE;
  $whois_status['size'] = ($whois_status['Data_length'] + $whois_status['Index_length']) . ' bytes';
  if ($whois_status['size'] > 1024) $whois_status['size'] = round($whois_status['size'] / 1024, 1) . ' Kb';
  if ($whois_status['size'] > 1024) $whois_status['size'] = round($whois_status['size'] / 1024, 1) . ' Mb';
  $whois_status['spacef'] = $whois_status['Data_free'] . ' bytes';
  if ($whois_status['spacef'] > 1024) $whois_status['spacef'] = round($whois_status['spacef'] / 1024, 1) . ' Kb';
  if ($whois_status['spacef'] > 1024) $whois_status['spacef'] = round($whois_status['spacef'] / 1024, 1) . ' Mb';
	$whois_status['Rows']--;
	$whois_status['url'] = get_admin_plugin_menu_link(WHOIS_ONLINE_PATH.'config.php');
  $template->assign( array( 'WO_status' => $whois_status, ));
}

// The Radar page
if (isset($_GET['tab']) and $_GET['tab']=='monitor') {
	$query_true = 'SELECT `session_id`, `username`
	  FROM '.WHOIS_ONLINE_TABLE.'
	  WHERE `permanent` = \'true\' 
	    AND `user_id`<> ' . $conf['guest_id'] . ' AND `IP` <> \'global\';';
	$result = pwg_query($query_true);
	$tpl = array();
	if (!empty($result))
	{
		while ($row = mysql_fetch_assoc($result))
		{
			$tpl[$row['session_id']] = $row['username'];
		}
	}
	$template->assign( 'category_option_true', $tpl);
	$template->assign( 'category_option_true_selected', array());

	$query_false = 'SELECT `session_id`, `username`, `last_access`
	  FROM '.WHOIS_ONLINE_TABLE.'
	  WHERE `permanent` = \'false\' 
	    AND `user_id`<> ' . $conf['guest_id'] . ' AND `IP` <> \'global\';';
	$result = pwg_query($query_false);
	$tpl = array();
	$del = array();
	$six_ago = time()-360; 			// 6 minutes ago
	if (!empty($result))
	{
		while ($row = mysql_fetch_assoc($result))
		{
			$tpl[$row['session_id']] = $row['username'];
			if ($row['last_access'] < $six_ago) $del[$row['session_id']] = $row['username'];
		}
	}
	$template->assign( 'category_option_false', $tpl);
	$template->assign( 'category_option_false_selected', array());
	$template->assign( 'present_remove', $del);
	$template->assign( 'present_remove_selected', array());
}

// Send data
$template->assign(Array(
	'Whois_version' => WHOIS_ONLINE_VER,
	'Whois_path' => WHOIS_ONLINE_PATH,
	'F_ACTION' => '',
	'L_CAT_OPTIONS_TRUE' => l10n('Permanent users (3 months min)'),
	'L_CAT_OPTIONS_FALSE' => l10n('Temporary users (around 72 hours)'),
));
$template->assign_var_from_handle('DOUBLE_SELECT', 'double_select');

if (count($errors) != 0) $template->assign('errors', $errors);
if (count($infos) != 0) $template->assign('infos', $infos);
if (isset($_GET['tab']) and $_GET['tab']=='report') {
  // Once for all, prepare the stupid History search ... (even if History search will recreate it)
	if (!isset($conf_whois['Search id']) or $conf_whois['Search id'] == 0) {
	  pwg_query('INSERT INTO '.SEARCH_TABLE.'  (rules)
	  VALUES (\''. 
	  'a:1:{s:6:"fields";a:5:{s:10:"date-after";s:10:"2009-09-09";s:11:"date-before";s:10:"2009-09-09";s:5:"types";a:4:{i:0;s:4:"none";i:1;s:7:"picture";i:2;s:4:"high";i:3;s:5:"other";}s:4:"user";s:2:"-1";s:17:"display_thumbnail";s:26:"display_thumbnail_hoverbox";}}'
	  .'\');');
	  $conf_whois['Search id'] = mysql_insert_id();
		$conf['Whois Online'] = serialize($conf_whois);
		pwg_query('REPLACE INTO ' . CONFIG_TABLE . " (param,value,comment)
	  VALUES ('Whois Online','". $conf['Whois Online'] ."','Whois Online configuration');");
	}
	// Get and Set to current date the stupid History search.
	list($serialized_rules) = mysql_fetch_row(pwg_query('SELECT rules FROM '.SEARCH_TABLE.'
	  WHERE id = '.$conf_whois['Search id'].';'));
	$page['search'] = unserialize($serialized_rules);
	$today = date('Y-m-d');
	$page['search']['fields']['date-after'] = $today;
	$page['search']['fields']['date-before'] = $today;
	pwg_query('REPLACE INTO '.SEARCH_TABLE.'  (id, rules)
	  VALUES (' . $conf_whois['Search id'] . ', \''. serialize($page['search']) .'\');');
	// Most members ever online was
	if (!isset($conf_whois['Users']['count']) or $conf_whois['Users']['count'] == 0) {
		$count = mysql_fetch_assoc(pwg_query('SELECT MAX(`'. $conf['user_fields']['id'] .'`) AS `ctr` FROM ' . USERS_TABLE));
		$conf_whois['Users']['count'] = $count['ctr'];
	}
	//$conf_whois['Users']['Date'] = date('Y-m-d H:i',$conf_whois['Users']['When']);
	$template->assign(array(
		'Members' => $conf_whois['Users'],
		'Whois_url' => WHOIS_ONLINE_PATH,
		'Whois_Smarty' => 'file:' . dirname(__FILE__),
	));
  // Include reload.php for first request (Filtering is an intrusive jQuery)
  include_once(WHOIS_ONLINE_PATH.'reload.php');
}

pwg_debug('*********** Whois configuration ended ***********');

$template->assign('Option', array(
		'Active' => ($conf_whois['Active']) ? 1 : 0,
		'Level' => $conf_whois['Delete level'],
		'Limit' => $conf_whois['Obsolete limit'],
		'Radar_limit' => $conf_whois['Radar limit'],
		'Webmasters' => $conf_whois['Webmasters'],
		'Administrators' => $conf_whois['Administrators'],
		'Plugins_menu' => ($conf_whois['Add to Plugins menu']) ? 1 : 0,
		'History_icon' => ($conf_whois['Add icon to History'] or !$conf_whois['Add to Plugins menu']) ? 1 : 0,
		'Keep_data' => ($conf_whois['Keep data']) ? 1 : 0,
		'Display' => ($conf_whois['Default display']) ? 1 : 0,
	) );
$template->assign_var_from_handle('ADMIN_CONTENT', 'plugin_admin_content');

?>