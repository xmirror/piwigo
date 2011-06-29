<?php
// Reload might be :
// - accessed thru a direct link from admin.php?page=plugin&section=whois_online%2Fconfig.php&tab=report
// - or included directly by admin.php (include_one in reporting part)
// Reload won't work if Whois_Online is deactivated
$included = true;
if (!isset($_url)) {
		define('PHPWG_ROOT_PATH','../../');
		define('IN_ADMIN', true);
		include_once(PHPWG_ROOT_PATH.'include/common.inc.php');
		$conf['show_gt'] = true;
		$included = false;
		load_language('plugin.lang', WHOIS_ONLINE_PATH);
}

// This is MANDATORY to secure your website !
check_status(ACCESS_ADMINISTRATOR);

pwg_debug('*********** Radar reload ***********');
$conf_whois = whois_online_conf();

$sort = ' WHERE `IP` = "global" or ( 1=1 ';

// Filtering on direct link parameters
$case = '';
if (isset($_GET['req'])) {
	$case = $_GET['req'];
	switch($_GET['req']) { 
		case 'members': 
			$sort.= ' AND `user_id` <> "' . $conf['guest_id'] . '"';
			break;
		case 'guest': 
			$sort.= ' AND `user_id` = "' . $conf['guest_id'] . '"';
			break;
		case 'less_24': 
			$sort.= ' AND `last_access` > "' . (time()-(24*3600)) . '"';
			break;
		case 'over_24': 
			$sort.= ' AND `last_access` < "' . (time()-(24*3600)) . '"';
			break;
		case 'pics': 
			$sort.= ' AND `last_elm_ids` > "0 0 0 0 0 0 0 0 0 0"';
			break;
		case 'no_pic': 
			$sort.= ' AND `last_elm_ids` = "0 0 0 0 0 0 0 0 0 0"';
			break;
		case 'country': 
			$sort.= ' AND `country` <> \'' . htmlspecialchars(serialize(Array('Code' => '__', 'Name' => l10n('Unknown country'), 'City' => 'N/A',))) . '\'';
			break;
		case 'no_country': 
			$sort.= ' AND `country` = \'' . htmlspecialchars(serialize(Array('Code' => '__', 'Name' => l10n('Unknown country'), 'City' => 'N/A',))) . '\'';
			break;
		case 'single': 
			$sort.= ' AND LENGTH(`last_dates`) < 12';
			break;
		case 'multi': 
			$sort.= ' AND LENGTH(`last_dates`) > 12';
			break;
		case 'IPs': 
			$sort.= ' AND `hidden_IP` = "true"';
			break;
	} 
}
$sort .= ')
ORDER BY `db_timestamp` DESC;';
$online = whois_online_get_data($sort);
$global = $online[0]; unset($online[0]);
$sid = session_id();

$iflag = 0; // Get the 10 first new flags on included requests ONLY (Duration reasons)

// prefetch to optimize
$local_guest = mysql_fetch_assoc(pwg_query('SELECT * FROM ' . USER_INFOS_TABLE .
	' WHERE user_id = ' . $conf['guest_id'] .';'));
	
$lang_tab = get_languages();
foreach ($lang_tab as $k => $v) $lang_code[substr($k,0,2)] = substr($v,0,strrpos($v,'[')-1);

$bypass = false;
$limit = 20;
$ql = 0; 
$inlist = '0';
foreach ($online as $k => $v) {
  $inlist .= ', ' . implode( ', ', explode(' ',$online[$k]['last_elm_ids']));
	$ql++;
	if ($ql >= $conf_whois['Radar limit']) break;
}
$image = array();
$result = pwg_query('SELECT * FROM ' . IMAGES_TABLE .
	' WHERE id IN (' . $inlist .');');
while ($row = mysql_fetch_assoc($result)) {
	$images[$row['id']] = $row;
	$images[$row['id']]['tn_url'] = get_thumbnail_url($row);
}
foreach ($online as $k => $v) {
  // The stupid History search will be reused instead of created... (even if History search will recreate it)	
    if ($conf['log']) { 
		if ( $conf['history_guest'] or $online[$k]['user_id'] != $conf['guest_id'])
			$online[$k]['url_user'] = 
			PHPWG_ROOT_PATH .'admin.php?page=history&amp;user_id='.$online[$k]['user_id'].'&amp;search_id='.$conf_whois['Search id'];
	}

	$online[$k]['Language'] = (isset($lang_code[$v['lang']])) ? $lang_code[$v['lang']]:l10n('Deleted language');
	$online[$k]['Country'] = whois_country($v, $bypass);
	$iflag++;
	$online[$k]['Flag'] = ($included) ? whois_flag($online[$k], $iflag) : whois_flag($online[$k], $iflag, $limit);
	if (!$included) $online[$k]['Flag'] = substr($online[$k]['Flag'],4);
	if ($iflag > 5) $bypass = true; // Don't search already unknown countries over 5 countries
	if ($v['user_id'] == $conf['guest_id']) { 
		$online[$k]['username'] =  ucwords(l10n('guest'));
		$online[$k]['guest'] =  true;
		$online[$k]['user'] = $local_guest; // Prefetched guest data
	}
	else {
		$online[$k]['user'] = mysql_fetch_assoc(pwg_query('SELECT * FROM ' . USER_INFOS_TABLE .
		 ' WHERE user_id = ' . $v['user_id'] .';'));
		$online[$k]['guest'] =  false;
	}
	// Images queries are limited (no cluetip over $conf_whois['Radar limit'])
	// For performance reasons
	$online[$k]['Bot'] = is_a_bot($online[$k]['user_agent']);
	$online[$k]['last_ids'] = explode(' ',$online[$k]['last_elm_ids']);
	foreach ($online[$k]['last_ids'] as $id) {
			if (isset($images[$id])) {
				$online[$k]['images'][$id] = $images[$id];
				$online[$k]['images'][$id]['ws_level'] = ($images[$id]['level']>$online[$k]['user']['level']) ? 'ws':'';
			}
			$online[$k]['images'][$id]['id'] = $id;
			$online[$k]['images'][$id]['url_modify'] = PHPWG_ROOT_PATH . 'admin.php?page=picture_modify&image_id='.$id;
		}
	}

pwg_debug('*********** Radar reloaded ***********');
$template->assign('search_results', $online);
$template->assign('Case', $case);
// Send reloadable HTML
if ( !$included ) {
	$template->set_filenames(array('reload'=> dirname(__FILE__) . '/report.tpl'));
	$template->pparse('reload');
}

?>