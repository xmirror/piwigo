<?php

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

if (!isset($edited_page))
{
  $page_title = l10n('ap_create');

  $edited_page = array(
    'id'         => 0,
    'title'      => '',
    'permalink'  => '',
    'lang'       => 'ALL',
    'homepage'   => false,
    'standalone' => false,
    'level'      => 0,
    'users'      => array('guest', 'generic', 'normal', 'admin', 'webmaster'),
    'groups'     => array(),
    'content'    => '',
  );
}

// Submit form
if (isset($_POST['save']))
{
  if (empty($_POST['title']))
  {
    array_push($page['errors'], l10n('ap_no_name'));
  }
  if (!empty($_POST['permalink']))
  {
    $permalink = trim($_POST['permalink'], ' /');
    $permalink = str_replace(array(' ', '/'), '_',$permalink);

    $query ='
SELECT id FROM '.ADD_PAGES_TABLE.'
WHERE permalink = "'.$permalink.'"
  AND id <> '.$edited_page['id'].'
;';
    $ids = array_from_query($query, 'id');
    if (!empty($ids))
    {
      array_push($page['errors'], sprintf(l10n('ap_permalink_already_used'), $permalink, $ids[0]));
    }
    $permalink = '"'.$permalink.'"';
  }
  else
  {
    $permalink = 'NULL';
  }

  $language = (empty($_POST['lang']) or $_POST['lang'] == 'ALL') ? 'NULL' : '"'.$_POST['lang'].'"';
  $group_access = !empty($_POST['groups']) ? '"'.implode(',', $_POST['groups']).'"' : 'NULL';
  $standalone = isset($_POST['standalone']) ? '"true"' : '"false"';

  $user_access = 'NULL';
  if ($conf['AP']['user_perm'])
  {
    $user_access = !empty($_POST['users']) ? '"'.implode(',', $_POST['users']).'"' : '""';
  }

  $level_access = !empty($_POST['level']) ? $_POST['level'] : 0;

  if (empty($page['errors']))
  {
    if ($page['tab'] == 'edit_page')
    {
      $query = '
UPDATE '.ADD_PAGES_TABLE.'
SET lang = '.$language.',
  title = "'.$_POST['title'].'",
  content = "'.$_POST['ap_content'].'",
  users = '.$user_access.',
  groups = '.$group_access.',
  level = '.$level_access.',
  permalink = '.$permalink.',
  standalone = '.$standalone.'
WHERE id = '.$edited_page['id'] .'
;';
      pwg_query($query);
    }
    else
    {
      $query = 'SELECT MAX(ABS(pos)) AS pos FROM ' . ADD_PAGES_TABLE . ';';
      list($position) = array_from_query($query, 'pos');

      $query = '
INSERT INTO '.ADD_PAGES_TABLE.' ( pos , lang , title , content , users , groups , level , permalink, standalone)
VALUES (
  '.($position+1).',
  '.$language.',
  "'.$_POST['title'].'",
  "'.$_POST['ap_content'].'",
  '.$user_access.',
  '.$group_access.',
  '.$level_access.',
  '.$permalink.',
  '.$standalone.'
);';
      pwg_query($query);
      $edited_page['id'] = pwg_db_insert_id(ADD_PAGES_TABLE, 'id');
    }

    // Homepage
    if (isset($_POST['homepage']) xor $conf['AP']['homepage'] == $edited_page['id'])
    {
      $conf['AP']['homepage'] = isset($_POST['homepage']) ? $edited_page['id'] : null;
      conf_update_param('additional_pages', pwg_db_real_escape_string(serialize($conf['AP'])));
    }

    // Backup file
    mkgetdir($conf['local_data_dir'], MKGETDIR_DEFAULT&~MKGETDIR_DIE_ON_ERROR);
    mkgetdir($conf['local_data_dir'].'/additional_pages_backup', MKGETDIR_PROTECT_HTACCESS&~MKGETDIR_DIE_ON_ERROR);
    $sav_file = @fopen($conf['local_data_dir'].'/additional_pages_backup/' . $edited_page['id'] . '.txt', "w");
    @fwrite($sav_file, "Title: ".stripslashes($_POST['title'])."\nPermalink: ".stripslashes($_POST['permalink'])."\n\n".stripslashes($_POST['ap_content']));
    @fclose($sav_file);

    // Redirect to admin pannel or additional page
    if (isset($_GET['redirect']))
    {
      redirect(make_index_url(array('section'=>'page')).'/'.$edited_page['id']);
    }
    redirect($my_base_url.'&page_saved=');
  }

  $edited_page['title'] = stripslashes($_POST['title']);
  $edited_page['permalink'] = stripslashes($_POST['permalink']);
  $edited_page['content'] = stripslashes($_POST['ap_content']);
  $edited_page['lang'] = !empty($_POST['lang']) ? $_POST['lang'] : 'ALL';
  $edited_page['groups'] = !empty($_POST['groups']) ? $_POST['groups'] : array();
  $edited_page['users'] = !empty($_POST['users']) ? $_POST['users'] :  array();
  $edited_page['level'] = !empty($_POST['level']) ? $_POST['level'] :  0;
  $edited_page['homepage'] = isset($_POST['homepage']);
  $edited_page['standalone'] = isset($_POST['standalone']);
}

// Language options
if ($conf['AP']['language_perm'])
{
  $languages = get_languages();
  $options = array('ALL' => l10n('ap_all_lang'));
  foreach ($languages as $language_code => $language_name)
  {
    $options[$language_code] = $language_name;
  }
  $template->assign(array(
    'lang' => $options,
    'selected_lang' => $edited_page['lang'],
    )
  );
}

// Groups options
if ($conf['AP']['group_perm'])
{
	$query = 'SELECT id, name FROM '.GROUPS_TABLE.' ORDER BY name ASC;';
  $result = pwg_query($query);
  $groups = array();
  while ($row = pwg_db_fetch_assoc($result))
  {
    $groups[$row['id']] = $row['name'];
  }
  $template->assign(array(
    'groups' => $groups,
    'selected_groups' => $edited_page['groups'],
    )
  );
}

// Users options
if ($conf['AP']['user_perm'])
{
  $users_id = array('guest', 'generic', 'normal', 'admin', 'webmaster');
  $users = array();
  foreach ($users_id as $id)
  {
    $users[$id] = l10n('user_status_'.$id);
  }
  $template->assign(array(
    'users' => $users,
    'selected_users' => $edited_page['users'],
    )
  );
}

// User level options
if ($conf['AP']['level_perm'])
{
  foreach ($conf['available_permission_levels'] as $level)
  {
    $level_options[$level] = l10n(sprintf('Level %d', $level));
  }
  $template->assign(array(
    'level_perm' => $level_options,
    'level_selected' => $edited_page['level']
    )
  );
}

// template output
$template->assign(array(
  'AP_TITLE' => $page_title,
  'NAME' => htmlspecialchars($edited_page['title']),
  'PERMALINK' => htmlspecialchars($edited_page['permalink']),
  'HOMEPAGE' => $edited_page['homepage'],
  'STANDALONE' => $edited_page['standalone'],
  'CONTENT' => htmlspecialchars($edited_page['content'])
  )
);

$template->set_filename('plugin_admin_content', dirname(__FILE__) . '/template/add_page.tpl');
$template->assign_var_from_handle('ADMIN_CONTENT', 'plugin_admin_content');

?>