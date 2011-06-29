<?php

global $prefixeTable, $conf;
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
if (!defined('IN_ADMIN') or !IN_ADMIN) die('Hacking attempt!');
if (!defined('WHOIS_ONLINE_TABLE')) define('WHOIS_ONLINE_TABLE', $prefixeTable.'whois_online');

function plugin_activate()
{
	global $user,$conf;
	$query = "CREATE TABLE IF NOT EXISTS ". WHOIS_ONLINE_TABLE ." (
  `IP` varchar(39) NOT NULL DEFAULT '',
  `hidden_IP` enum('true','false') NOT NULL DEFAULT 'false',
  `session_id` varchar(40) NOT NULL,
  `user_id` smallint(5) NOT NULL DEFAULT '0',
  `username` varchar(100) character set utf8 collate utf8_bin NOT NULL DEFAULT '',
  `lang` char(2) character set utf8 collate utf8_bin NOT NULL DEFAULT 'en',
  `country` VARCHAR( 255 ) NOT NULL DEFAULT '',
  `user_agent` VARCHAR( 160 ) NOT NULL DEFAULT '',
  `any_previous` VARCHAR( 255 ) NOT NULL DEFAULT '',
  `same_previous` VARCHAR( 255 ) NOT NULL DEFAULT '',
  `permanent` enum('true','false') NOT NULL DEFAULT 'false',
  `last_access` varchar(12) NOT NULL DEFAULT '',
  `last_elm_ids` varchar(75) NOT NULL DEFAULT '',
  `last_cat_ids` varchar(75) NOT NULL DEFAULT '',
  `last_tag_ids` varchar(75) NOT NULL DEFAULT '',
  `last_sch_ids` varchar(75) NOT NULL DEFAULT '',
  `first_access_date` varchar(45) NOT NULL DEFAULT '',
  `last_dates` varchar(110) character set utf8 collate utf8_bin NOT NULL DEFAULT '',
  `elm_hits` int(10) unsigned NOT NULL DEFAULT '0',
  `pag_hits` int(10) unsigned NOT NULL DEFAULT '0',
  `db_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`session_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
";
	$result = pwg_query($query);
	pwg_query('ALTER TABLE '. WHOIS_ONLINE_TABLE .' CHANGE `lang` `lang` CHAR( 5 ) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT \'en\'');
	if (!isset($conf['Whois Online'])) {
		$conf['Whois Online'] = serialize(Array());
		pwg_query('REPLACE INTO ' . CONFIG_TABLE . " (param,value,comment)
		VALUES ('Whois Online','". $conf['Whois Online'] ."','Whois Online configuration');");
	}
	if (isset($conf_whois['Keep data']) and !$conf_whois['Keep data']) {
		pwg_query('DELETE FROM ' . WHOIS_ONLINE_TABLE);
	}
	list($hits) = mysql_fetch_row(pwg_query('SELECT SUM(hit) FROM '.IMAGES_TABLE.';'));
	$pags = floor($hits * 1.69); /* estimate : 1.69 is a frequent ratio between images hits and pages hits */
	pwg_query('INSERT IGNORE INTO ' . WHOIS_ONLINE_TABLE . ' (`IP`, `hidden_IP`, `session_id`, `user_id`,`username`,`lang`,`permanent`,`last_access`,
	`last_elm_ids`, `last_cat_ids`, `last_tag_ids`, `last_sch_ids`,
	`first_access_date`, `last_dates`, `elm_hits`, `pag_hits`)
		VALUES (\'global\', \'true\',\'global\', 0, \'Administrator\', \'--\', \'true\', \''
		. time() .'\', \''. implode(' ',array_fill(0, 12, 0))
		. '\', \''. implode(' ',array_fill(0, 14, 0))
		. '\', \''. implode(' ',array_fill(0, 14, 0))
		. '\', \''. implode(' ',array_fill(0, 14, 0))
		. '\', \'' 
		. date('Y-m-d') . '\', \'\', \'' 
		. $hits . '\', \'' . $pags . '\');');
}

function plugin_deactivate()
{
	global $conf;
	if (isset($conf['Whois Online'])) $conf_whois = unserialize($conf['Whois Online']);
	if (isset($conf_whois['Keep data']) and !$conf_whois['Keep data']) 
		pwg_query('DROP TABLE IF EXISTS ' . WHOIS_ONLINE_TABLE);
}

function plugin_uninstall()
{
	global $conf;
	if (isset($conf['Whois Online'])) $conf_whois = unserialize($conf['Whois Online']);
	if (isset($conf_whois['Keep data']) and !$conf_whois['Keep data']) {
		pwg_query('DELETE FROM ' . CONFIG_TABLE . ' WHERE param = ' . "'Whois Online'");
		pwg_query('DROP TABLE IF EXISTS ' . WHOIS_ONLINE_TABLE);
		unset($conf['Whois Online']);
	}
}
?>