<?php

if (!defined('HIPE_PATH')) define('HIPE_PATH' , PHPWG_PLUGINS_PATH.basename(dirname(__FILE__)).'/');

include_once (HIPE_PATH.'include/functions.inc.php');

function plugin_install()
{
  global $conf;
  
// Set plugin parameters
  $default= array();

	$query = '
SELECT param
  FROM '.CONFIG_TABLE.'
WHERE param = "HistoryIPExcluder"
;';
  $count = pwg_db_num_rows(pwg_query($query));
  
  if ($count == 0)
  {
    $q = '
INSERT INTO '.CONFIG_TABLE.' (param,value,comment)
VALUES ("HistoryIPExcluder","","History IP Excluder parameters");
';
      
    pwg_query($q);
  }

// Set plugin config
  $plugin =  HIPE_infos(HIPE_PATH);
  $version = $plugin['version'];

  $default = array (
    'Blacklist' => "0",
    'Version'=> $version,
  );

	$query = '
SELECT param
  FROM '.CONFIG_TABLE.'
WHERE param = "HistoryIPConfig"
;';
  $count = pwg_db_num_rows(pwg_query($query));
  
  if ($count == 0)
  {
    $q = '
INSERT INTO '.CONFIG_TABLE.' (param,value,comment)
VALUES ("HistoryIPConfig","'.addslashes(serialize($default)).'","History IP Excluder options");
';
    pwg_query($q);
  }
}


function plugin_activate()
{
  global $conf;
  
  include_once (HIPE_PATH.'include/dbupgrade.inc.php');
  
/* Check for upgrade from 2.0.0 to 2.0.1 */
/* *************************************** */
	$query = '
SELECT param
  FROM '.CONFIG_TABLE.'
WHERE param = "nbc_HistoryIPExcluder"
;';
  $count = pwg_db_num_rows(pwg_query($query));
  
	if ($count == 1)
	{
  /* upgrade from version 2.0.0 to 2.0.1  */
  /* ************************************ */
		upgrade_200();
	}

	$query = '
SELECT param
  FROM '.CONFIG_TABLE.'
WHERE param = "HistoryIPConfig"
;';
  $count = pwg_db_num_rows(pwg_query($query));

	if ($count == 0)
	{
  /* upgrade from version 2.1.0 to 2.1.1  */
  /* ************************************ */
		upgrade_210();
	}

  /* upgrade from version 2.1.1 to 2.2.0 */
  /* *********************************** */
  $HIPE_Config = unserialize($conf['HistoryIPConfig']);
  if ($HIPE_Config['Version'] == '2.1.1')
  {
    upgrade_211();
  }

  /* Global version number upgrade */
  /* ***************************** */
  global_version_update();
}


function plugin_uninstall()
{
  global $conf;

  if (isset($conf['HistoryIPExcluder']))
  {
    $q = '
DELETE FROM '.CONFIG_TABLE.'
WHERE param="HistoryIPExcluder" LIMIT 1;
';

    pwg_query($q);
  }
  if (isset($conf['HistoryIPConfig']))
  {
    $q = '
DELETE FROM '.CONFIG_TABLE.'
WHERE param="HistoryIPConfig" LIMIT 1;
';

    pwg_query($q);
  }  
}
?>