<?php
/* Functions */

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
if (!defined('IN_ADMIN') or !IN_ADMIN) die('Hacking attempt!');


if ( !function_exists('pwg_get_contents') ) {
	function pwg_get_contents($url, $mode='') {

		global $pwg_mode, $pwg_prev_host;
		$timeout = 5; // will be a parameter (only for the socket)

		$host = (strtolower(substr($url,0,7)) == 'http://') ? substr($url,7) : $url;
		$host = (strtolower(substr($host,0,8)) == 'https://') ? substr($host,8) : $host;
		$doc = substr($host, strpos($host, '/'));
		$host = substr($host, 0, strpos($host, '/'));

		if ($pwg_prev_host != $host) $pwg_mode = ''; // What was possible with one website could be different with another
		$pwg_prev_host = $host;
		if (isset($pwg_mode)) $mode = $pwg_mode;
		if ($mode == 'r') $mode = '';
		// $mode = 'ch'; // Forcing a test '' all, 'fs' fsockopen, 'ch' cURL

	// 1 - The simplest solution: file_get_contents
	// Contraint: php.ini
	//      ; Whether to allow the treatment of URLs (like http:// or ftp://) as files.
	//      allow_url_fopen = On
		if ( $mode == '' ) {
		  if ( true === (bool) ini_get('allow_url_fopen') ) { 
				$value = file_get_contents($url);
				if ( $value !== false and substr($value,0,21) != '<!DOCTYPE HTML PUBLIC') {
					return $value;
				}
			}
		}
		if ( $mode == '' ) $mode = 'fs';
		if ( $pwg_mode == '' ) $pwg_mode = 'fs'; // Remind it
	// 2 - Often accepted access: fsockopen
		if ($mode == 'fs') {
			$fs = fsockopen($host, 80, $errno, $errstr, $timeout);
			if ( $fs !== false ) {
				fwrite($fs, 'GET ' . $doc . " HTTP/1.1\r\n");
				fwrite($fs, 'Host: ' . $host . "\r\n");
				fwrite($fs, "Connection: Close\r\n\r\n");
				stream_set_blocking($fs, TRUE);
				stream_set_timeout($fs,$timeout); // Again the $timeout on the get
				$info = stream_get_meta_data($fs);
				$value = '';
				while ((!feof($fs)) && (!$info['timed_out'])) {
								$value .= fgets($fs, 4096);
								$info = stream_get_meta_data($fs);
								flush();
				}
				if ( $info['timed_out'] === false  and substr($value,0,21) != '<!DOCTYPE HTML PUBLIC') return $value;
			}
		}

		if ( $pwg_mode == 'fs' ) $pwg_mode = 'ch'; // Remind it
	// 3 - Sometime another solution: curl_exec
	// See http://fr2.php.net/manual/en/curl.installation.php
	  if (function_exists('curl_init') and $pwg_mode == 'ch') {
			$ch = @curl_init();
			@curl_setopt($ch, CURLOPT_URL, $url);
			@curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			@curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
			@curl_setopt($ch, CURLOPT_HEADER, 1);
			@curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
			@curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$value = @curl_exec($ch);
			$header_length = @curl_getinfo($ch, CURLINFO_HEADER_SIZE);
			$status = @curl_getinfo($ch, CURLINFO_HTTP_CODE);
			@curl_close($value);
			if ($value !== false and $status >= 200 and $status < 400) {
				$value = substr($value, $header_length);
				// echo '<br/>-ch- ('. $value . ') <br/>';
				return $value;
			}
			else $pwg_mode = 'failed'; // Sorry but remind it as well
		}

		// No other solutions
		return false;
	}
}


// Select the correct menu on loc_end_admin
function whois_select_menu() {
	global $conf_whois, $template;
	if ($conf_whois['Add icon to History'] or !$conf_whois['Add to Plugins menu']) 
		$template->assign('ACTIVE_MENU', 4);
	else $template->assign('ACTIVE_MENU', 3);
}

// Template function
function Whois_most($text, $count, $when, $format) {
 return sprintf(l10n($text),$count,date(l10n($format),$when));
}

function whois_country($trace, $bypass = false) {
  if (!isset($trace['country'])) {
			pwg_query('ALTER TABLE ' . WHOIS_ONLINE_TABLE . ' ADD `country` VARCHAR( 254 ) NOT NULL AFTER `lang` ;');
			$trace['country']='';
	}
	$c = array();
	if ($trace['country']!='') $c = @unserialize(htmlspecialchars_decode($trace['country']));
	if (isset($c['Code']) and $c['Code']!='' and $c['Code']!='__') return $c; 
	if ($bypass and isset($c['Code'])) return $c;
    $result = pwg_get_contents ('http://api.hostip.info/get_html.php?ip=' . $trace['IP'], 'r');
	if ( $result !== false ) { 
		$tokens = preg_split("/[:]+/", $result);
		$c = array ('Name' => $tokens[1], 'City' => substr($tokens[3],0,-3));
		if (strpos ($c['Name'], '?') === FALSE) {
			$c['Code'] = substr($c['Name'],-8,2); # " (Private Address) (XX) City"
			$c['Name'] = ucwords ( strtolower( substr($c['Name'],0,-5)));
		}
		else $c = Array('Code' => '__', 'Name' => l10n('Unknown country'), 'City' => 'N/A',);
	}
	if (stripos($c['Name'], 'Squid')!==false or $c['Code'] =='XX') 
		$c = Array('Code' => '__', 'Name' => l10n('Unknown country'), 'City' => 'N/A',);
	$new = htmlspecialchars(serialize($c),ENT_QUOTES,'UTF-8');
	if ($new == $trace['country']) return $c;
	pwg_query('UPDATE ' . WHOIS_ONLINE_TABLE . ' 
      SET `country` = \'' . $new . '\'
    WHERE `session_id` = \'' . $trace['session_id'] . '\';');
  return $c;
}

function whois_flag($trace, &$step, $limit = 10) {
	$flag = WHOIS_ONLINE_PATH . 'flags/' . $trace['Country']['Code'] . '.jpg';
	if (file_exists($flag) and  $trace['Country']['Code'] != '__' ) return $flag;
	if ($trace['Country']['Code'] == '__' ) {
	    $flag = WHOIS_ONLINE_PATH . 'flags/' . substr($trace['lang'],-2, 2) . '.jpg';
		if (file_exists($flag)) return $flag;
		return WHOIS_ONLINE_PATH . 'flags/__.jpg';
	}
	if ( $step > $limit ) return WHOIS_ONLINE_PATH . 'flags/.jpg';
	$f = fopen  ('http://api.hostip.info/flag.php?ip=' . $trace['IP'], 'r');
	$result='';
	while ($l = fgets ($f, 1024)) $result .= $l;
	fclose ($f);
	$f = fopen($flag,"w+");
	fputs($f,$result);
	fclose($f);
	return $flag;
}

/*
  returns (mixed): (string) 'bot agent name'  || (bool) false
  @param (string) HTTP_USER_AGENT
*/
function is_a_bot($agent = '') 
{
  global $conf;
	if ($agent == '') $agent = $_SERVER['HTTP_USER_AGENT'];
	$botlist = array('Teoma', 'alexa', 'froogle', 'Gigabot', 'inktomi',
	'looksmart', 'URL_Spider_SQL', 'Firefly', 'NationalDirectory', 
	'Ask Jeeves', 'TECNOSEEK', 'InfoSeek', 'WebFindBot', 'girafabot',
	'crawler', 'www.galaxy.com', 'Googlebot', 'Scooter', 'Slurp',
	'msnbot', 'appie', 'FAST', 'WebBug', 'Spade', 'ZyBorg', 'rabaz',
	'Baiduspider', 'Feedfetcher-Google', 'TechnoratiSnoop', 'Rankivabot',
	'Mediapartners-Google', 'Sogou web spider', 'WebAlta Crawler');
  if (isset($conf['search_agents']))
	  $botlist = array_merge( $botlist, array_diff( $conf['search_agents'], $botlist ) );
  foreach($botlist as $bot) {
    if (stripos($agent, $bot)!==false) return $bot; 
  }
  return false;
} 
?>