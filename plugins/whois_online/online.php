<?php

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
global $conf, $conf_whois, $prefixeTable;
		$path = WHOIS_ONLINE_PATH;
          $plg_data = implode( '', file($path.'main.inc.php') );
           if (preg_match("|Version: (.*)|", $plg_data, $val))
          {
            $Whois_online_ver = trim($val[1]);
          }     
      
define('WHOIS_ONLINE_VER', $Whois_online_ver); 
include_once(WHOIS_ONLINE_PATH.'include/wo_functions.inc.php');

define('ONLINE_LEVEL', (100+$conf_whois['Delete level'])/100);
define('ONLINE_LIMIT', $conf_whois['Obsolete limit']);



 


/* Admin menus are always available */
add_event_handler('get_admin_plugin_menu_links', 'whois_add_icon' );
/* On Active */
if ($conf_whois['Active']) {
	$conf['Whois Online Update'] = true;
	add_event_handler('loc_begin_picture', 'whois_online_management');
	add_event_handler('loc_begin_index', 'whois_online_management');
	add_event_handler('register_user', 'whois_online_register');
	if ($conf_whois['Default display'] or (defined('IN_ADMIN') and IN_ADMIN))  
		add_event_handler('loc_begin_page_tail', 'whois_default_display' );
}


/*
		Main process: Analyze, set new values and prepare displayed values.
		
		Update on parameter...
*/
function whois_online_management()
{
	global $user, $conf, $conf_whois, $template, $page, $lang, $lang_info;
	load_language('plugin.lang', WHOIS_ONLINE_PATH);
	srand((float)time());

  pwg_debug('*********** start Online_management ***********');
	if (!isset($conf_whois['Active'])) $conf_whois = whois_online_conf();

	$online = whois_online_get_data();

	$global = $online[0];
	unset($online[0]);
	$sid = session_id();
	
	// Step 1 - Find the User and/or IP/session_id
	foreach ($online as $key => $record) {
		// 1st case: Same IP and same member (Proxy guests are viewed as one)
		if ($record['IP'] == $_SERVER['REMOTE_ADDR']
			and $record['username'] == $user['username'] ) {
				$visit = $record;
				$v = $key;
				break;
		}
		// 2nd case: Same session and user (No doubt)
		if ($record['session_id'] == $sid
			and $record['username'] == $user['username'] ) {
				$visit = $record; // Maybe a guest
				if (!is_a_guest()) $visit['hidden_IP'] = 'true'; // Maybe Proxy or hidden IP
				//$visit['IP'] = $_SERVER['REMOTE_ADDR']; 
				$v = $key;
				break;
		}
		// 3rd and last case: Same user_id
		if ($record['user_id'] == $user['id'] and !is_a_guest()) { // new IP and new session
				$visit = $record;
				$visit['hidden_IP'] = 'true'; /* Or Generic user or the user is using several connections */
				//$visit['IP'] = $_SERVER['REMOTE_ADDR']; 
				$v = $key;
				break;
		}
	}

	// Step 2 - Assume a new comer
	if ( !isset($visit) ) {
		$ctry = '_' . strtoupper( substr(@$_SERVER["HTTP_ACCEPT_LANGUAGE"],6,2) );
		$visit = Array( 
			'IP' => $_SERVER['REMOTE_ADDR'], // First known IP (Is that one true?)
			'hidden_IP' => 'false', // supposed a fixed IP
			'session_id' => $sid,
			'user_id' => $user['id'],
			'username' => $user['username'],
			'delay' => 0,
			'lang' => substr($lang_info['code'],0,2) . $ctry,
			'permanent' => 'false', // False: delete after 72 Hours / True: delete after 90 days
			'last_access' => time(), // Last access by this user
			'elm_ids' => array_fill(0, 10, 0), // 10 last minutes + Last reference minute
			'cat_ids' => array_fill(0, 12, 0), // 12 ranges (of 5 minutes) + ref
			'tag_ids' => array_fill(0, 24, 0), // 24 hours + ref
			'sch_ids' => array_fill(0, 14, 0), // 14 days + ref
			'date' => date('Y-m-d'), // Futur usage
			'elm_hits' => 0, 'pag_hits' => 0, // elements hits and pages hits by this user
			'first_access_date' => date('Y-m-d'), // First access by this user
			'dates' => Array(), // 5 last access dates
		);
		$online[] = $visit;
		$v = count($online);
	}

	// Step 3 - Monitor this access
	$base = script_basename();
	// Picture page
	if (isset($page['image_id']) and $base == 'picture') {
		whois_online_track($visit['elm_ids'], $page['image_id'],$visit['dates']);
		if (isset($page['tags']))
		whois_online_track($visit['tag_ids'], $page['image_id'],$visit['dates']);
		if (isset($page['search']))
		whois_online_track($visit['sch_ids'], $page['image_id'],$visit['dates']);
		$visit['elm_hits']++;
		$global['elm_hits']++;
	}
	// Category page
	if (isset($page['category']['id']) and $base == 'index')
		whois_online_track($visit['cat_ids'], $page['category']['id'],$visit['dates']);
	// Page index
	if (!isset($page['category']['id']) and !isset($page['image_id']))
		whois_online_track($visit['cat_ids'], '' ,$visit['dates']);
	$visit['pag_hits']++;
	$global['pag_hits']++;

	// Step 4 - Identify current range
	$current = floor(time() / 60); 			// minutes for Unix time origin
	$minute = $current % 10; 						// (0-9) current minute
	$five = floor($current / 5); 	// (0-11) last 5 minutes range
	$hour = floor($current / 60); 	// (0-11) last hours
	$day = floor($current / 1440); // (0-13) last days
	if (isset($global['elm_ids'][10])) $old = $global['elm_ids'][10]; // previous minute (last one, or maybe 60 minutes ago or more).
	else $old = $current; /* Only the first time or prevent wrong changes */

	// Step 5 - Hits by range
	if ($current != $old) {
		$global['elm_ids'][11] = $global['elm_ids'][$minute];
		$raz = min($current-$old, 10);
	// 5.1 - $global['elm_ids'] ( hits by minute range )
		for ($i=0;$i<$raz;$i++) {
			$global['elm_ids'][($minute+10-$i)%10] = 0;
		}
	// 5.2 - $global['cat_ids'] ( hits by 5 minutes range )
		if (isset($global['cat_ids'][12])) $oldfive = $global['cat_ids'][12];
		else $oldfive = floor($old / 5);
		$raz = min($five - $oldfive, 12);
		for ($i=0;$i<$raz;$i++) {
			$global['cat_ids'][($five+12-$i)%12] = 0; // Reset in backside
		}
	// 5.3 - $global['tag_ids'] (hits by hours )
		if (count($global['tag_ids'])<25) $global['tag_ids'] = array_fill(0, 24, 0);
		if (isset($global['tag_ids'][24])) $oldhour = $global['tag_ids'][24];
		else $oldhour = floor($old / 60);
		$raz = min($hour - $oldhour, 24);
		for ($i=0;$i<$raz;$i++) {
			$global['tag_ids'][($hour+24-$i)%24] = 0; // Reset in backside
		}
	// 5.4 - $global['sch_ids'] ( hits by days )
		if (isset($global['sch_ids'][14])) $oldday = $global['sch_ids'][14];
		else $oldday = floor($old / 1440);
		$raz = min($day - $oldday, 14);
		for ($i=0;$i<$raz;$i++) {
			$global['sch_ids'][($day+14-$i)%14] = 0; // Reset in backside
		}
	}
	$global['elm_ids'][$minute]++;
	$global['cat_ids'][$five%12]++;
	$global['tag_ids'][$hour%12]++;
	$global['sch_ids'][$day%14]++;
  // !!! WARNING  !!! WARNING !!! WARNING !!! WARNING !!!
	$global['elm_ids'][10] = $current; // reference minute has changed
	$global['cat_ids'][12] = $five;
	$global['tag_ids'][24] = $hour;
	$global['sch_ids'][14] = $day;
  // !!! WARNING  !!! WARNING !!! WARNING !!! WARNING !!!

	// 5.5 - Add in previous
  if (!isset($global['any_previous'])) {
		pwg_query('ALTER TABLE ' . WHOIS_ONLINE_TABLE . 
			' ADD `same_previous` VARCHAR( 255 ) NOT NULL DEFAULT \'\'  AFTER `country`;');
		pwg_query('ALTER TABLE ' . WHOIS_ONLINE_TABLE . 
			' ADD `any_previous` VARCHAR( 255 ) NOT NULL DEFAULT \'\'  AFTER `country`;');
		pwg_query('ALTER TABLE ' . WHOIS_ONLINE_TABLE . 
			' ADD `user_agent` VARCHAR( 160 ) NOT NULL DEFAULT \'\'  AFTER `country`;');
	}

	$antiaspi = array(
    'diff' => '20 pages in 00:00:10' , // Banned for 20 access in 10 seconds or less
    'same' => '15 pages in 00:00:30' , // Banned for 15 access on the same page in 30 seconds or less
    'banned during' => '23:59:59' ,    // Banned time hh:mm:ss or any valid MySQL datetime expression 'YYYY-MM-DD HH:MM:SS'
    'only guest' => true ,             // True, registred members won't be banned
    'only picture' => false ,          // True, Check only on picture pages
    'allowed ip' => array()            // Allowed IP array (Bots, or your fixed IP)
  );
  if (isset($conf['antiaspi'])) $antiaspi = array_merge($antiaspi, $conf['antiaspi']);

	// For AntiAspi follow ANY PREVIOUS access
	$access = '0:';
	list($max_any, $maxtext) = explode(' pages in ', $antiaspi['diff']);
	$maxtime = whois_online_duration($maxtext);
	$prev='';
	$previous = (isset($visit['any_previous'])) ? explode(' ', $visit['any_previous']):Array();
	foreach ($previous as $v) {
		$old = explode(':', $v);
		$old[0] += $visit['delay']; 
		if ($old[0]<$maxtime) $prev .= $old[0].': ';
	}
	$prev = $access . ' ' . $prev;
	$prev = substr($prev, 0, -2);
	$visit['any_previous'] = $prev;
	// For AntiAspi follow ANY SAME PICTURE access
	$access = '0:';
	$same_elem = (isset($page['image_id'])) ? $page['image_id']:'0';
	list($max_same, $maxtext) = explode(' pages in ', $antiaspi['same']);
	$maxtime = whois_online_duration($maxtext);
	$access .= $same_elem . ':';
	$prev='';
	$previous = (isset($visit['same_previous'])) ? explode(' ', $visit['same_previous']):Array();
	foreach ($previous as $v) {
		$old = explode(':', $v);
		$old[0] += $visit['delay'];
		if ($old[0]<$maxtime and $old[1]==$same_elem) $prev .= $old[0].':'.$old[1].': ';
	}
	$prev = $access . ' ' . $prev;
	$prev = substr($prev, 0, -2);
	$visit['same_previous'] = $prev;
	
	// Check limits of $visit['any_previous'] and $visit['same_previous'] 
	// by 256 characters
	// by $max_any and by $max_same
	while (strlen($visit['any_previous'])>256) {
	  $previous = explode(' ',$visit['any_previous']);
		$oldest = array_pop($previous);
		$visit['any_previous'] = implode(' ', $previous);
	}
	$ctr_any = count(explode(' ',$visit['any_previous']));
	while (strlen($visit['same_previous'])>256) {
	  $previous = explode(' ',$visit['same_previous']);
		$oldest = array_pop($previous);
		$visit['same_previous'] = implode(' ', $previous);
	}
	$ctr_same = count(explode(' ',$visit['same_previous']));
	
	$visit['user_agent'] = substr($_SERVER['HTTP_USER_AGENT'],0,160);
	$Vip =& $visit['IP'];
	$visit['Allowed_SE'] = false;
  if (!empty($antiaspi['allowed ip']))
  {
    $allowed_ips = str_replace(array('.', '%'), array('\.', '.*?'), $antiaspi['allowed ip']);
    foreach ($allowed_ips as $ip)
    {
      if (preg_match("#" . $ip . "#", $Vip)) { $visit['Allowed_SE'] = true; break; }
    }
  }
	
	// Step 6 - Update (on Conf_Update and trace) and send trace to determine global tracing or not
	$dtrace = 0;
	if ($user['status'] == 'admin') $dtrace += $conf_whois['Administrators'];
	elseif ($user['status'] == 'webmaster') $dtrace += $conf_whois['Webmasters'];
	else $dtrace = 2;
	if ($conf['Whois Online Update'] and $dtrace > 0) whois_online_update($global, $visit, $dtrace);

	// Step 7 - Find your recent visits (These image_ids are presumely authorized)
	$my_ids = $visit['elm_ids'];
	sort($my_ids);
	unset($my_ids[0]);
	$url_visited = (count($my_ids)>0) ? make_index_url(array('list' => $my_ids)).'&amp;review':'';

	// Step 8 - Guest count and Member list
	$h24 = 0; $h1 = 0; $guest = 0;
	$list = array();
	$elm = array(); $excl = array(); // Get images_ids from all and from the current visitor
	foreach ($online as $k => $monit)
	{
		if ($user['id']==$monit['user_id']) $excl = $monit['elm_ids'];
		else $elm = array_merge($elm, $monit['elm_ids']);
		if ($monit['delay'] <= (24*3600)) $h24++;
		if ($monit['delay'] <= 3600) $h1++;
		// Less than 5 minutes: users are considered as still online...
		if ($monit['delay'] <= 300) {
			if ($monit['user_id'] == $conf['guest_id']) $guest++;
			else $list[] = $monit['username'];
		}
	}
	// The first (and current) access are not recorded in $online
	// As visitor you are not expecting your access to be already counted: Ok that the case
	// but you are expecting to see you as a member in the member list if you are: and there it is
	if ($visit['user_id'] != $conf['guest_id'] ) $list[] = $visit['username'];
	$list = array_unique($list);
	
	if (count($list) > $conf_whois['Users']['max']) {
		$conf_whois['Users']['max'] = count($list);
		$conf_whois['Users']['When'] = time();
		$conf['Whois Online'] = serialize($conf_whois);
		pwg_query('REPLACE INTO ' . CONFIG_TABLE . " (param,value,comment)
    VALUES ('Whois Online','". $conf['Whois Online'] ."','Whois Online configuration');");
	}

	// Step 9 - Review pictures viewed by others (all images except yours)
	$elm = array_diff( array_unique($elm), $excl );
	shuffle($elm);
	$elm = array_slice($elm,0,($conf['top_number']+50));
	sort($elm);
	array_shift($elm);
	$elm[] = 0; // Check if authorized pictures
	$query = 'SELECT DISTINCT(image_id)
  FROM '.IMAGE_CATEGORY_TABLE.'
    INNER JOIN '.IMAGES_TABLE.' ON id = image_id
  WHERE image_id IN ('.implode(',', $elm ).')
    '.get_sql_condition_FandF(
      array(
          'forbidden_categories' => 'category_id',
          'visible_categories' => 'category_id',
          'visible_images' => 'id'
        ), "\n  AND") . ';';
	$ids = array_from_query($query, 'image_id');
	shuffle($ids);
	$ids = array_slice($ids, 0, $conf['top_number']); // Keep some
	$url_someothers = (isset($ids[0])) ? make_index_url(array('list' => $ids)).'&amp;others':'';

	// Random page title change
	$url_type = pwg_get_session_var('whois_url_type', ''); /* previous review or others */
	$list_ids = pwg_get_session_var('whois_list_ids', ''); /* previous list/xx,yy,zz, ... */
	$list_section = (isset($page['section']) and $page['section'] == 'list') ? true:false;
	$same_ids = (isset($page['list']) and $page['list'] == $list_ids) ? true:false;
	if ($list_section and isset($_GET['review'])) {
		$url_type = 'Whois_review';
		$same_ids = true;
	}
	if ($list_section and isset($_GET['others'])) {
		$url_type = 'Whois_others';
		$same_ids = true;
	}
	if ($list_section and $same_ids and isset($page['list'])) $list_ids = $page['list'];
	else $url_type = ''; // Not the same list
	pwg_set_session_var('whois_list_ids', $list_ids);
	pwg_set_session_var('whois_url_type', $url_type);
	if ($url_type != '' and $list_section)
  $page['title'] = '<a href="'.duplicate_index_url(array('start'=>0)).'">'
                    .l10n($url_type).'</a>';

	
	// Step 10 - Prepare data to display
	$yesterday = ($day+13) % 14;
	$template->assign('Whois', array(
		'Total' => $global['pag_hits'],
		'Image' => $global['elm_hits'],
		'Other' => ($global['pag_hits']-$global['elm_hits']),
		'Current_minute' => $global['elm_ids'][$minute],
		'Previous_minute' => $global['elm_ids'][($minute+9) % 10],
		'Current_5mins' => $global['elm_ids'][$minute]
									+ $global['elm_ids'][($minute+9) % 10]
									+ $global['elm_ids'][($minute+8) % 10]
									+ $global['elm_ids'][($minute+7) % 10]
									+ $global['elm_ids'][($minute+6) % 10],
		'Current_10mins' => array_sum(array_slice($global['elm_ids'],0,10)),
		'Current_hour' => array_sum(array_slice($global['cat_ids'],0,12)),
		'Current_24h' => array_sum(array_slice($global['tag_ids'],0,24)),
		'Yesterday' => $global['sch_ids'][$yesterday],
		'Users_Last_day' => $h24,
		'Users_Last_hour' => $h1,
		'Guests' => $guest,
		'Online' => $list,
		'Review_url' => $url_someothers,
		'Their_ids' => $ids,
		'Seen_url' => $url_visited,
		'My_ids' => $my_ids,
		'Slideshow' => isset($_GET['slideshow']) ? true:false,
	));
	$template->assign('Online', $global );

	pwg_debug('end Online_management');
}
?>