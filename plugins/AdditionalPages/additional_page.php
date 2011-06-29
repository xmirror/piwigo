<?php

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

function check_random_index_redirect()
{
  global $conf;

  if (!empty($conf['ap_random_index_redirect']))
  {
    $random_index_redirect = array();
    foreach ($conf['ap_random_index_redirect'] as $random_url => $random_url_condition)
    {
      if (empty($random_url_condition) or eval($random_url_condition))
      {
        $random_index_redirect[] = $random_url;
      }
    }
    if (!empty($random_index_redirect))
    {
      redirect($random_index_redirect[mt_rand(0, count($random_index_redirect)-1)]);
    }
  }
  return true;
}

global $template, $user;

$identifier = $page['ap_homepage'] ? $conf['AP']['homepage'] : $tokens[1];

// Retrieve page data
$query = 'SELECT id, title, lang, content, users, groups, level, permalink, standalone
FROM ' . ADD_PAGES_TABLE . '
';
$query .= is_numeric($identifier) ?
  'WHERE id = '.$identifier.';' :
  'WHERE permalink = "'.$identifier.'";';

$row = pwg_db_fetch_assoc(pwg_query($query));

// Page not found
if (empty($row))
{
  if ($page['ap_homepage']) return;
  page_not_found('Requested page does not exist');
}

// Redirect with permalink if exist
if (is_numeric($identifier) and !empty($row['permalink']) and !$page['ap_homepage'])
{
  redirect(make_index_url(array('section'=>'page')).'/'.$row['permalink']);
}

// Access controls
if (!is_admin() or (!is_admin() xor $page['ap_homepage']))
{
  // authorized language
  if (!empty($row['lang']) and $row['lang'] != $user['language'])
  {
    if ($page['ap_homepage'] and check_random_index_redirect()) return;
    page_forbidden(l10n('You are not authorized to access the requested page'), make_index_url());
  }

  // authorized level
  if ($user['level'] < $row['level'])
  {
    if ($page['ap_homepage'] and check_random_index_redirect()) return;
    page_forbidden(l10n('You are not authorized to access the requested page'), make_index_url());
  }

  // authorized users
  if (isset($row['users']))
  {
    $authorized_users = explode(',', $row['users']);
    if (!in_array($user['status'], $authorized_users))
    {
      if ($page['ap_homepage'] and check_random_index_redirect()) return;
      page_forbidden(l10n('You are not authorized to access the requested page'), make_index_url());
    }
  }

  // authorized groups
  if (!empty($row['groups']))
  {
    $query = 'SELECT group_id
FROM ' . USER_GROUP_TABLE . '
WHERE user_id = ' . $user['id'] . '
  AND group_id IN (' . $row['groups'] . ')
;';
    $groups = array_from_query($query, 'group_id');
    if (empty($groups))
    {
      if ($page['ap_homepage'] and check_random_index_redirect()) return;
      page_forbidden(l10n('You are not authorized to access the requested page'), make_index_url());
    }
  }
}

// Display standalone page
if ($row['standalone'] == 'true')
{
  echo $row['content'];
  exit;
}

// Page initilization
$page['section'] = 'additional_page';

$page['additional_page'] = array(
  'id' => $row['id'],
  'permalink' => @$row['permalink'],
  'title' => trigger_event('AP_render_title', $row['title']),
  'content' => trigger_event('AP_render_content', $row['content']),
);

add_event_handler('loc_end_index', 'ap_set_index');

function ap_set_index()
{
  global $template, $page, $conf;

  $template->assign(array(
    'TITLE' => $page['additional_page']['title'],
    'PLUGIN_INDEX_CONTENT_BEGIN' => $page['additional_page']['content'],
    )
  );

  if ($conf['AP']['show_home'] and !$page['ap_homepage'])
  {
    $template->assign('PLUGIN_INDEX_ACTIONS' , '
      <li><a href="'.make_index_url().'" title="' . l10n('return to homepage') . '">
        <img src="' . $template->get_themeconf('icon_dir') . '/home.png" class="button" alt="' . l10n('home') . '"/></a>
      </li>');
  }
  if (is_admin())
  {
    $template->assign('U_EDIT', get_root_url().'admin.php?page=plugin-'.AP_DIR.'-edit_page&amp;edit='.$page['additional_page']['id'].'&amp;redirect=true');
  }
  $template->clear_assign(array('U_MODE_POSTED', 'U_MODE_CREATED'));
}

?>