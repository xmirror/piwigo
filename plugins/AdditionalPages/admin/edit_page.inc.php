<?php

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

if (!is_numeric($_GET['edit']))
{
  die('Wrong identifier');
}

// Delete
if (isset($_REQUEST['delete']) and isset($_GET['edit']))
{
	pwg_query('DELETE FROM ' . ADD_PAGES_TABLE . ' WHERE id = ' . $_GET['edit'] . ';');
  @unlink($conf['local_data_dir'].'/additional_pages_backup/' . $_GET['edit'] . '.txt');

  if ($conf['AP']['homepage'] == $_GET['edit'])
  {
    $conf['AP']['homepage'] = null;
    conf_update_param('additional_pages', pwg_db_real_escape_string(serialize($conf['AP'])));
  }

  redirect($my_base_url.'&page_deleted=');
}

// Load page data
$query = '
SELECT id , lang , title , content , users , groups , level , permalink, standalone
FROM ' . ADD_PAGES_TABLE . '
WHERE id = '.$_GET['edit'].'
;';
$edited_page = pwg_db_fetch_assoc(pwg_query($query));

$edited_page['users'] = !empty($edited_page['users']) ? explode(',', $edited_page['users']) : array();
$edited_page['groups'] = !empty($edited_page['groups']) ? explode(',', $edited_page['groups']) : array();
$edited_page['homepage'] = $conf['AP']['homepage'] == $edited_page['id'];
$edited_page['standalone'] = $edited_page['standalone'] == 'true';

$template->assign('delete', true);
$page_title = l10n('ap_modify');

include(AP_PATH.'admin/add_page.inc.php');

?>