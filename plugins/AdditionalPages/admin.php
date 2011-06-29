<?php

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
load_language('plugin.lang', AP_PATH);

global $conf, $template;

include_once(PHPWG_ROOT_PATH.'admin/include/tabsheet.class.php');
$my_base_url = get_root_url().'admin.php?page=plugin-'.AP_DIR;

$query = 'SELECT id
FROM ' . ADD_PAGES_TABLE . '
LIMIT 1
;';
$page_exist = array_from_query($query, 'id');

$page['tab'] = isset($_GET['tab']) ? $_GET['tab'] : 'manage';

if (!$page_exist and $page['tab'] == 'manage')
{
  redirect($my_base_url.'&amp;tab=add_page');
}

include(AP_PATH.'admin/'.$page['tab'].'.inc.php');

$tabsheet = new tabsheet();
if ($page_exist)
{
  $tabsheet->add('manage', l10n('Manage'), $my_base_url.'-manage');
}
$tabsheet->add('add_page', l10n('ap_add_page'), $my_base_url.'-add_page');
$tabsheet->add('config', l10n('Configuration'), $my_base_url.'-config');
if ($page['tab'] == 'edit_page')
{
  $tabsheet->add('edit_page', l10n('ap_edit_page'), $my_base_url.'-edit_page&amp;edit='.$_GET['edit']);
}
$tabsheet->select($page['tab']);
$tabsheet->assign();

?>