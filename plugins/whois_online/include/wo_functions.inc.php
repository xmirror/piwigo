<?php
/* Functions */

/* Secure Config */
if (!isset($conf['Whois Online']) or !isset($conf_whois['Active'])) $conf_whois = whois_online_conf();

if (defined('IN_ADMIN') and IN_ADMIN) include_once(WHOIS_ONLINE_PATH.'include/wo_admin_functions.inc.php');

function whois_online_conf()
{
	global $conf;
	$default = array(
	  'Active' => true,
	  'Delete level' => 20,
	  'Radar limit' => 25,
	  'Webmasters' => 2, // Normal
	  'Administrators' => 2,
	  'Obsolete limit' => 20,
		'Default display' => true,
	  'Add to Plugins menu' => false,
	  'Add icon to History' => true,
	  'Keep data' => true,
	  'Search id' => 0,
	  'Users' => Array('max' => 0, 'When' => date('Y-m-d'), 'count' => 0),
	);
	if (!isset($conf['Whois Online'])) $conf['Whois Online'] = serialize(Array());
	$conf_whois = array_merge($default, unserialize($conf['Whois Online']));
	if ((!isset($conf_whois['Version'])) or $conf_whois['Version'] != WHOIS_ONLINE_VER
		or $conf['Whois Online'] != serialize($conf_whois)) {
		$conf_whois['Version'] = WHOIS_ONLINE_VER;
		$conf['Whois Online'] = serialize($conf_whois);
		pwg_query('REPLACE INTO ' . CONFIG_TABLE . " (param,value,comment)
	  VALUES ('Whois Online','". $conf['Whois Online'] ."','Whois Online configuration');");
	}
	return $conf_whois;
}

// Assume the Default display on pages
function whois_default_display() {
	global $template;
	$template->set_filenames(array( 'Whois_display' => dirname(__FILE__).'/../default.tpl'));
	$template->pparse('Whois_display');
}

// New member
function whois_online_register($who) {
	global $conf, $conf_whois;
	$conf_whois['Users']['count'] = $who['id'];
	$conf['Whois Online'] = serialize($conf_whois);
	pwg_query('REPLACE INTO ' . CONFIG_TABLE . " (param,value,comment)
  VALUES ('Whois Online','". $conf['Whois Online'] ."','Whois Online configuration');");
	return;
}

// Read all data
function whois_online_get_data($order='') {
	$remove = "''"; // Nothing to remove ( = an empty session_id)
	$ctr = 0; $Online[0] = '';
	$result = pwg_query('SELECT * FROM ' . WHOIS_ONLINE_TABLE . $order . ';');
	while($row=mysql_fetch_array($result)) {
		$row['delay'] = (int) time() - $row['last_access'];
		$row['elm_ids'] = explode(' ', $row['last_elm_ids']);
		$row['cat_ids'] = explode(' ', $row['last_cat_ids']);
		$row['tag_ids'] = explode(' ', $row['last_tag_ids']);
		$row['sch_ids'] = explode(' ', $row['last_sch_ids']);
		$row['dates'] = explode(' ', $row['last_dates']);
		$ctr++;
		if ( $row['IP'] != 'global' and $row['permanent'] == 'false'
			and $row['delay'] > (float)( 60 * 60 * 24 * 3 )) $remove .= ", '" . $row['session_id'] . "'";
		elseif ($row['IP'] == 'global') $Online[0] = $row;
		else $Online[] = $row;
	}
	// Out of 7 visits: Reduce registered visits for 3 days without access
	if ($remove != "''" and $ctr > (count($Online) * ONLINE_LEVEL)
		and ($ctr-count($Online)) > ONLINE_LIMIT and ($Online[0]['pag_hits']%7)==0) {
		pwg_query('DELETE FROM ' . WHOIS_ONLINE_TABLE . ' WHERE `session_id` IN ('. $remove .')
				AND `permanent` = \'false\' AND `IP` <> \'global\';');
		if (($Online[0]['pag_hits']%13)==0) @pwg_query('OPTIMIZE TABLE ' . WHOIS_ONLINE_TABLE . ';');
	}
	return $Online;
}

// Update global and update/create current session_id
function whois_online_update(&$global, &$dedicated, &$gtrace)
{
	global $user;
	// Rewrite the global record
	if ( $gtrace == 2 ) {
		$query = 'REPLACE INTO ' . WHOIS_ONLINE_TABLE . ' (`IP`, `hidden_IP`, `session_id`,`user_id`,`username`,`lang`,
		`permanent`,`last_access`,`last_elm_ids`, `last_cat_ids`, `last_tag_ids`, `last_sch_ids`,
		`first_access_date`, `last_dates`, `elm_hits`, `pag_hits`)
			VALUES (\'global\', \'true\',\'global\', 0, \''. $global['username'] .'\', \'--\', \'true\', \''
			. time()  .'\',  \''
			. implode(' ',$global['elm_ids']) . '\', \''
			. implode(' ',$global['cat_ids']) . '\', \''
			. implode(' ',$global['tag_ids']) . '\', \''
			. implode(' ',$global['sch_ids']) . '\', \''
			. $global['first_access_date'] . '\', \'\', \''
			. $global['elm_hits'] . '\', \'' . $global['pag_hits'] . '\');';
		pwg_query($query);
	}
	// Write or Rewrite the dedicated record
	$query = 'REPLACE INTO ' . WHOIS_ONLINE_TABLE . ' (`IP`, `hidden_IP`, `session_id`,`user_id`,`username`,`lang`, `user_agent`,
	`any_previous`, `same_previous`, `permanent`,`last_access`,`last_elm_ids`, `last_cat_ids`, `last_tag_ids`, `last_sch_ids`,
	`first_access_date`, `last_dates`, `elm_hits`, `pag_hits`)
		VALUES (\''. $dedicated['IP'] .'\', \''
		. $dedicated['hidden_IP'] .'\', \''. $dedicated['session_id'] .'\', \''
		. $dedicated['user_id'] .'\', \''. $dedicated['username'] .'\', \''
		. $user['language'] .'\', \''
		. $dedicated['user_agent'] .'\', \''
		. $dedicated['any_previous'] .'\', \''
		. $dedicated['same_previous'] .'\', \''
		. $dedicated['permanent'] . '\', \''. time() .'\',  \''
		. implode(' ',$dedicated['elm_ids']) . '\', \''
		. implode(' ',$dedicated['cat_ids']) . '\', \''
		. implode(' ',$dedicated['tag_ids']) . '\', \''
		. implode(' ',$dedicated['sch_ids']) . '\', \''
		. $dedicated['first_access_date'] . '\', \''
		. implode(' ',$dedicated['dates']) . '\', \''
		. $dedicated['elm_hits'] . '\', \''
		. $dedicated['pag_hits'] . '\');';
	pwg_query($query);
}

// Data tracking 
// Parameters:
//  - Array of Ids
//  - New ID
//  - Array of dates
// => Add the ID if needed, Add Today if needed
function whois_online_track(&$key, $id, &$date) {
	if ($id != '') array_unshift($key, $id);
	$key = array_unique($key);
	if (count($key)>10) array_pop($key);
	array_unshift($date, date('Y-m-d'));
	$date = array_unique($date);
	if (count($date)>5) array_pop($date);
	return;
}

// Antiaspi delay conversion in seconds
// delay in "HH:ii:ss" or "d :HH:ii:ss"
// return delay in seconds
function whois_online_duration($date_string)
{
 list($s, $i, $H, $d, $more) = 
   array_merge(array_reverse(
	   explode(" ",str_ireplace(':',' ', $date_string))),
		 array(0,0,0,0,0));
 $t = time();
 return strtotime(sprintf("+%s days %s hours %s minutes %s seconds", 
   $d, $H, $i, $s), $t) - $t;
}

// Add admin links
function whois_add_icon($menu) {
	global $conf_whois, $template;
	$url = get_admin_plugin_menu_link(WHOIS_ONLINE_PATH.'config.php');
	$lnk = ' <a class="external" style="display:inline;" href="' . $url . '">'
		. '<img class="button" src="' . WHOIS_ONLINE_PATH . 'icons/Whois_tuner.png" '
		. ' alt="Whois Online configuration" title="Whois Online configuration" /></a>';
	if (isset($_GET['page']) and ($_GET['page'] == 'stats' or $_GET['page'] == 'history'))
		$h2 = $lnk;
	else $h2 = ''; 
	if ($conf_whois['Add icon to History']) {
		$template->append('footer_elements', '<!-- Whois Icon -->
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery("#menubar li a[href*=\'admin.php?page=stats\']").after(\'' . $lnk . '\').css("display","inline");
	jQuery(".tabsheet li a[href*=\'admin.php?page=configuration&section=history\']").next().remove();
	jQuery("#content .titrePage h2").append(\'' . $h2 . '\');
 
	});
</script>' );
	}
	if ($conf_whois['Add to Plugins menu']) array_push($menu, array(
				'NAME' => 'Whois Online',
				'URL' => $url,
			));
	return $menu;
}

?>