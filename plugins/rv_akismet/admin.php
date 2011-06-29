<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

load_language('plugin.lang', AKIS_PATH);

function test_akismet()
{
  global $page, $conf;
  include_once( dirname(__FILE__).'/akismet.class.php' );
  $akismet = new Akismet(get_absolute_root_url(), $conf['akismet_api_key'], array('referrer'=>'') );
  if( $akismet->errorsExist() )
    $page['errors'] = array_merge($page['errors'], array_values($akismet->getErrors()) );
  else
    $page['infos'][] = 'Akismet is OK';
}

if ( isset($_POST['submit']) and !is_adviser() )
{
  $query = '
UPDATE '.CONFIG_TABLE.'
  SET value="'.$_POST['akismet_api_key'].'"
  WHERE param="akismet_api_key"
  LIMIT 1';
  pwg_query($query);

  $query = '
UPDATE '.CONFIG_TABLE.'
  SET value="'.$_POST['akismet_spam_action'].'"
  WHERE param="akismet_spam_action"
  LIMIT 1';
  pwg_query($query);

  list($conf['akismet_api_key']) = array_from_query('SELECT value FROM '.CONFIG_TABLE.' WHERE param="akismet_api_key"', 'value');
  list($conf['akismet_spam_action']) = array_from_query('SELECT value FROM '.CONFIG_TABLE.' WHERE param="akismet_spam_action"', 'value');
  test_akismet();
}

if ( isset($_GET['test']) )
  test_akismet();
if ( isset($_GET['reset-stats']) )
{
  $conf['akismet_counters']='0/0';
  $query = 'UPDATE '.CONFIG_TABLE.' SET value="'.$conf['akismet_counters'].'" WHERE param="akismet_counters" LIMIT 1';
  pwg_query($query);
}

$template->set_filename('plugin_admin_content', dirname(__FILE__).'/admin.tpl');

$counters = explode('/', $conf['akismet_counters']);
$template->assign(
    array(
      'AKISMET_API_KEY' => $conf['akismet_api_key'],
      'AKISMET_BLOG_URL' => get_absolute_root_url(),
      'AKISMET_TEST_URL' => add_url_params( get_admin_plugin_menu_link(dirname(__FILE__).'/admin.php'), array('test'=>1) ),
      'AKISMET_RESET_STATS_URL' => add_url_params( get_admin_plugin_menu_link(dirname(__FILE__).'/admin.php'), array('reset-stats'=>1) ),
      'AKISMET_SPAM_COMMENTS' => $counters[0],
      'AKISMET_CHECKED_COMMENTS' => $counters[1],
      'AKISMET_SPAM_ACTION' => $conf['akismet_spam_action'],
    )
  );


$template->assign_var_from_handle( 'ADMIN_CONTENT', 'plugin_admin_content');

?>