<?php
/*
Plugin Name: History IP Excluder
Version: 2.2.3
Description: Permet l'exclusion d'une IP ou d'une plage d'IP de l'historique et de les blacklister à l'inscription / Excludes one IP or a range of IP from the history and to blacklist them on registration
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=147
Author: Nicco, Eric
Author URI: http://gallery-nicco.no-ip.org - http://www.infernoweb.net
*/

/*
:: HISTORY

1.0.x to 1.6.x		- Plugin only for PWG 1.7.x

2.0.0             - Compliance with Piwigo 2.0.x

2.1.0             - Compliance with Piwigo 2.1.x
                  - Multiple database support
                  - Removing "nbc_" prefix in plugin code and display in piwigo's plugin manager
                  - Displaying the good plugin name and current version in admin panel
                  
2.1.1             - Bug 1792 fixed (Thx to TOnin)
                  - Bug 1511 fixed - New function to blacklist excluded IPs or ranged IPs for registration

2.2.0             - Compliance with Piwigo 2.2.x
                  - Plugin directory renamed from nbc_HistoryIPExcluder to HistoryIPExcluder

2.2.1             - Bug fixed on plugin upgrade from 2.1.x version

2.2.2             - Another bug fixed on plugin upgrade from 2.2.x version

2.2.3             - Improved update mechanism. When no structural update of database is necessary, it sets the correct version number in plugin's configuration

--------------------------------------------------------------------------------
*/

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

if (!defined('HIPE_PATH')) define('HIPE_PATH' , PHPWG_PLUGINS_PATH.basename(dirname(__FILE__)).'/');

include_once (HIPE_PATH.'/include/functions.inc.php');

load_language('plugin.lang', HIPE_PATH);

add_event_handler('get_admin_plugin_menu_links', 'HIPE_admin_menu');

/* Set the administration panel of the plugin */
function HIPE_admin_menu($menu)
{
// +-----------------------------------------------------------------------+
// |                      Getting plugin name                              |
// +-----------------------------------------------------------------------+
  $plugin =  HIPE_infos(HIPE_PATH);
  $name = $plugin['name'];
  
  array_push($menu,
    array(
      'NAME' => $name,
      'URL' => get_root_url().'admin.php?page=plugin-'.basename(HIPE_PATH)
    )
  );
    
  return $menu;
}

// IP exclusion from logs
add_event_handler('pwg_log_allowed', 'HIPE_IP_Filtrer');

function HIPE_IP_Filtrer($do_log)
{
  global $conf;

  $conf_HIPE = explode("," , $conf['HistoryIPExcluder']);

  if (!$do_log)
    return $do_log;
  else
  {
    $IP_Client = explode('.', $_SERVER['REMOTE_ADDR']);
  
    foreach ($conf_HIPE as $Exclusion)
    {
      $IP_Exclude = explode('.', $Exclusion);
  
      if (
        (($IP_Client[0] == $IP_Exclude[0]) or ($IP_Exclude[0] == '%')) and
        (!isset($IP_Exclude[1]) or ($IP_Client[1] == $IP_Exclude[1]) or ($IP_Exclude[1] == '%')) and
        (!isset($IP_Exclude[2]) or ($IP_Client[2] == $IP_Exclude[2]) or ($IP_Exclude[2] == '%')) and
        (!isset($IP_Exclude[3]) or ($IP_Client[3] == $IP_Exclude[3]) or ($IP_Exclude[3] == '%'))
      )
      {
        $do_log = false;
      }    
    }
     
    return $do_log;
  }
}

/* Check users registration */
add_event_handler('register_user_check', 'HIPE_RegistrationCheck', EVENT_HANDLER_PRIORITY_NEUTRAL +2, 2);

function HIPE_RegistrationCheck($err, $user)
{
  global $errors, $conf;
  load_language('plugin.lang', HIPE_PATH);
  
  if (count($err)!=0 ) return $err;
  
  $IP_Client = explode('.', $_SERVER['REMOTE_ADDR']);
  $HIPE_Config = unserialize($conf['HistoryIPConfig']);
  $conf_HIPE = explode("," , $conf['HistoryIPExcluder']);
  
  if (isset($HIPE_Config['Blacklist']) and $HIPE_Config['Blacklist'] == true)
  {
    foreach ($conf_HIPE as $Exclusion)
    {
      $IP_Exclude = explode('.', $Exclusion);
  
      if (
        (($IP_Client[0] == $IP_Exclude[0]) or ($IP_Exclude[0] == '%')) and
        (!isset($IP_Exclude[1]) or ($IP_Client[1] == $IP_Exclude[1]) or ($IP_Exclude[1] == '%')) and
        (!isset($IP_Exclude[2]) or ($IP_Client[2] == $IP_Exclude[2]) or ($IP_Exclude[2] == '%')) and
        (!isset($IP_Exclude[3]) or ($IP_Client[3] == $IP_Exclude[3]) or ($IP_Exclude[3] == '%'))
      )
      {
        $err = l10n('Error_HIPE_BlacklistedIP');
      }
    }
    return $err;
  }
}
?>