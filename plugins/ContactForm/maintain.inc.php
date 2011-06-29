<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
if (!defined('IN_ADMIN') or !IN_ADMIN) die('Hacking attempt!');

if (!defined('CF_PATH')) {
  define('CF_PATH',     PHPWG_PLUGINS_PATH.basename(dirname(__FILE__)).'/');
}
if (!defined('CF_ROOT')) {
  define('CF_ROOT',     dirname(__FILE__).'/');
}

function plugin_install($plugin_id, $version, &$errors) {
  include_once(CF_PATH . 'include/cf_common.inc.php');
  // Include language advices
  load_language('plugin.lang', CF_PATH);
  update_config($plugin_id, CF_CFG_DB_FACTORY);
}

function plugin_activate($plugin_id, $version, &$errors) {
  update_config($plugin_id);
}

function plugin_deactivate($plugin_id) {
  // Nothing special
}

function plugin_uninstall($plugin_id) {
  include_once(CF_PATH . 'include/cf_common.inc.php');
  $uninstall = CF_Config::uninstall($plugin_id);
}

function update_config($plugin_id, $db_comment=null) {
  include_once(CF_PATH . 'include/cf_common.inc.php');
  $clean = cf_clean_obsolete_files(CF_OBSOLETE);
  if (null != $db_comment) {
    $cf_config_default[CF_CFG_COMMENT] = $db_comment;
  }
  $install = CF_Config::install($plugin_id);
}
?>
