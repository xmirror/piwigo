<?php

/* Database upgrading functions */

// This wil update only current plugin version number in database
function global_version_update()
{
  global $conf;
  
  // Get current plugin version
  $plugin =  HIPE_infos(HIPE_PATH);
  $version = $plugin['version'];

// Update plugin version
  $query = '
SELECT value
  FROM '.CONFIG_TABLE.'
WHERE param = "HistoryIPConfig"
;';
  $result = pwg_query($query);
  
  $conf_HIPE = pwg_db_fetch_assoc($result);
    
  $Newconf_HIPE = unserialize($conf_HIPE['value']);
  
  $Newconf_HIPE['Version'] = $version;
  
  $update_conf = serialize($Newconf_HIPE);

  $query = '
UPDATE '.CONFIG_TABLE.'
SET value="'.addslashes($update_conf).'"
WHERE param="HistoryIPConfig"
LIMIT 1
;';

	pwg_query($query);
}


function upgrade_200()
{
  global $conf;
  
  $q = '
UPDATE '.CONFIG_TABLE.'
SET param = "HistoryIPExcluder"
WHERE param = "nbc_HistoryIPExcluder"
;';
  pwg_query($q);

  $q = '
UPDATE '.CONFIG_TABLE.'
SET comment = "History IP Excluder parameters"
WHERE comment = "Parametres nbc History IP Excluder"
;';
  pwg_query($q);

  upgrade_210();
}

function upgrade_210()
{
  global $conf;
  
  $default = array (
    'Blacklist' => "0",
    'Version'=> "2.1.1",
  );

  $q = '
INSERT INTO '.CONFIG_TABLE.' (param,value,comment)
VALUES ("HistoryIPConfig","'.addslashes(serialize($default)).'","History IP Excluder options");
';
      
  pwg_query($q);
  
  upgrade_211();
}

function upgrade_211()
{
  global $conf;

  // Create new HIPE entry in plugins table 
  $query = '
INSERT INTO '.PLUGINS_TABLE.' (id, state, version)
VALUES ("HistoryIPExcluder","active","2.2.0")
;';
  
  pwg_query($query);

  // Delete old plugin entry in plugins table 
  $query = '
DELETE FROM '.PLUGINS_TABLE.'
WHERE id="nbc_HistoryIPExcluder"
LIMIT 1
;';
  
  pwg_query($query);

  // rename directory
  if (!rename(PHPWG_PLUGINS_PATH.'nbc_HistoryIPExcluder', PHPWG_PLUGINS_PATH.'HistoryIPExcluder'))
  {
    die('Fatal error on plugin upgrade process : Unable to rename directory ! Please, rename manualy the plugin directory name from ../plugins/nbc_HistoryIPExcluder to ../plugins/HistoryIPExcluder.');
  }
}
?>