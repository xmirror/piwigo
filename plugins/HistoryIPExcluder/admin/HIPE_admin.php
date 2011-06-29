<?php

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

load_language('plugin.lang', HIPE_PATH);

// +-----------------------------------------------------------------------+
// |                      Getting plugin version                           |
// +-----------------------------------------------------------------------+
$plugin =  HIPE_infos(HIPE_PATH);
$version = $plugin['version'];
$name = $plugin['name'];


$ip_geolocalisation1 = '<a href="http://www.geoiptool.com/fr/?IP=';
$ip_geolocalisation2 = '" title="Geo IP localisation" target="_blank"><img src="'.HIPE_PATH.'/geoip.ico" class="button" alt="'.l10n('IP_geolocalisation').'"></a>';

$ip_ripe1 = '<a href="http://www.ripe.net/whois?form_type=simple&amp;full_query_string=&amp;searchtext=';
$ip_ripe2 = '+&amp;do_search=Search" title="Ripe Whois" target="_blank">';
$ip_ripe3 = '</a>';



if ( isset($_POST['submit']) and !is_adviser() )
{
  $v = $_POST['HIPE_IPs_Excluded'];
  $v = str_replace( "\r\n", ",", $v );
  $v = str_replace( ",,", ",", $v );

  $conf['HistoryIPExcluder'] = stripslashes($v);

  $query = '
    UPDATE '.CONFIG_TABLE.'
    SET value="'.$conf['HistoryIPExcluder'].'"
    WHERE param="HistoryIPExcluder"
    LIMIT 1';
  pwg_query($query);

  if (!isset($_POST['HIPE_chkb'])) $_POST['HIPE_chkb'] = '0';
  $newconf_HIPE = array(
    'Blacklist' => $_POST['HIPE_chkb'],
    'Version'   => $version,
  );
  
  $conf['HistoryIPConfig'] = serialize($newconf_HIPE);

  $query = '
    UPDATE '.CONFIG_TABLE.'
    SET value="'.addslashes($conf['HistoryIPConfig']).'"
    WHERE param="HistoryIPConfig"
    LIMIT 1';
  pwg_query($query);

  // information message
  array_push($page['infos'], l10n('HIPE_save_config'));
}
elseif ( isset($_POST['CleanHist']) )
{
  $conf_HIPE = explode("," , $conf['HistoryIPExcluder']);

  foreach ( $conf_HIPE as $Exclusion )
  {
    $query = '
      delete FROM '.HISTORY_TABLE.' where
      IP like \''.$Exclusion.'\';';
    pwg_query($query);
   }


  $query = '
    truncate '.HISTORY_SUMMARY_TABLE.';';
  pwg_query($query);

  $query = '
    UPDATE '.HISTORY_TABLE.'
    SET summarized = \'false\';';
  pwg_query($query);

  // information message
  array_push($page['infos'], l10n('HIPE_hist_cleaned'));
}
elseif ( isset($_POST['HIPE_IPByMember']) )
{
  $template->assign(
    array(
      'HIPE_DESCRIPTION2' => l10n('HIPE_IPByMember_description'),
    )
  );

  $query = '
    select distinct h.ip, u.username
    from '.HISTORY_TABLE.' as h
    inner join '.USERS_TABLE.' as u on u.id = h.user_id
    where h.user_id <> 2
    order by h.ip
  ;';
  
  $subresult = pwg_query($query);

  while ($subrow = pwg_db_fetch_assoc($subresult))
  {
    $template->append(
      'resultat',
      array(
        'HIPE_RESULTAT1' => $ip_geolocalisation1.$subrow['ip'].$ip_geolocalisation2.' '.$ip_ripe1.$subrow['ip'].$ip_ripe2.$subrow['ip'].$ip_ripe3,
        'HIPE_RESULTAT2' => $subrow['username'],
      )
    );    
  }

  // information message
  array_push($page['infos'], l10n('HIPE_resquet_ok'));
}
elseif ( isset($_POST['HIPE_OnlyGuest']) )
{
  $template->assign(
    array(
      'HIPE_DESCRIPTION2' => l10n('HIPE_OnlyGuest_description'),
    )
  );

  $query1 = '
    select distinct h.ip
    from '.HISTORY_TABLE.' as h
    where h.user_id <> 2
  ;';
  
  $IPsMember = array_from_query($query1, 'ip');

  $query = '
    select h.ip, count(h.ip) as nbreIP
    from '.HISTORY_TABLE.' as h
    where h.ip not in (\''.implode('\',\'', $IPsMember).'\')
    group by h.ip
    order by nbreIP desc
  ;';
  
  $subresult = pwg_query($query);

  while ($subrow = pwg_db_fetch_assoc($subresult))
  {
    $template->append(
      'resultat',
      array(
        'HIPE_RESULTAT1' => $ip_geolocalisation1.$subrow['ip'].$ip_geolocalisation2.' '.$ip_ripe1.$subrow['ip'].$ip_ripe2.$subrow['ip'].$ip_ripe3,
        'HIPE_RESULTAT2' => $subrow['nbreIP'],
      )
    );    
  }

  // information message
  array_push($page['infos'], l10n('HIPE_resquet_ok'));
}
elseif ( isset($_POST['HIPE_IPForMember']) and isset($_POST['HIPE_input']))
{
  $template->assign(
    array(
      'HIPE_DESCRIPTION2' => l10n('HIPE_IPForMember_description'),
    )
  );

  $query = '
    select h.ip, u.username
    from '.HISTORY_TABLE.' as h 
    inner join '.USERS_TABLE.' as u on u.id = h.user_id
    where u.username like \''.$_POST['HIPE_input'].'\'
    group by h.ip
    order by h.ip
  ;';
  
  $subresult = pwg_query($query);

  while ($subrow = pwg_db_fetch_assoc($subresult))
  {
    $template->append(
      'resultat',
      array(
        'HIPE_RESULTAT1' => $subrow['username'],
        'HIPE_RESULTAT2' => $ip_geolocalisation1.$subrow['ip'].$ip_geolocalisation2.' '.$ip_ripe1.$subrow['ip'].$ip_ripe2.$subrow['ip'].$ip_ripe3,
      )
    );    
  }

  // information message
  array_push($page['infos'], l10n('HIPE_resquet_ok'));
}
elseif ( isset($_POST['HIPE_MemberForIp']) and isset($_POST['HIPE_input']))
{
  $template->append(
    array(
      'HIPE_DESCRIPTION2' => l10n('HIPE_MemberForIp_description'),
    )
  );

  $query = '
    select h.ip, u.username
    from '.HISTORY_TABLE.' as h 
    inner join '.USERS_TABLE.' as u on u.id = h.user_id
    where h.ip like \''.$_POST['HIPE_input'].'\'
    group by u.username
    order by u.username
  ;';
  
  $subresult = pwg_query($query);

  while ($subrow = pwg_db_fetch_assoc($subresult))
  {
    $template->assign(
      'resultat',
      array(
        'HIPE_RESULTAT1' => $ip_geolocalisation1.$subrow['ip'].$ip_geolocalisation2.' '.$ip_ripe1.$subrow['ip'].$ip_ripe2.$subrow['ip'].$ip_ripe3,
        'HIPE_RESULTAT2' => $subrow['username'],
      )
    );    
  }

  // information message
  array_push($page['infos'], l10n('HIPE_resquet_ok'));
}

$conf_HIPE = explode("," , $conf['HistoryIPExcluder']);
$HIPE_Config = unserialize($conf['HistoryIPConfig']);

$template->assign(
  array(
    'HIPE_VERSION' => $version,
    'HIPE_NAME'    => $name,
    'HIPE_PATH'    => HIPE_PATH,
    'IPs_EXCLUDED' => implode("\n", $conf_HIPE),
  )
);

  if ($HIPE_Config['Blacklist'] == 1) $template->assign(array('HIPE_IPBlacklisted' => 'checked="checked"'));

  $template->set_filename('plugin_admin_content', dirname(__FILE__) . '/HIPE_admin.tpl');
  $template->assign_var_from_handle('ADMIN_CONTENT', 'plugin_admin_content');

?>