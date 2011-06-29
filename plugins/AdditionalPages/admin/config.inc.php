<?php

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

$mb_conf = @unserialize($conf['blk_menubar']);

// Enregistrement de la configuration
if (isset($_POST['submit']))
{
  if (!$conf['AP']['user_perm'] and isset($_POST['user_perm']))
  {
    pwg_query('UPDATE '.ADD_PAGES_TABLE.' SET users = "guest,generic,normal,admin,webmaster";');
  }
  if ($conf['AP']['user_perm'] and !isset($_POST['user_perm']))
  {
    pwg_query('UPDATE '.ADD_PAGES_TABLE.' SET users = NULL;');
  }
  if ($conf['AP']['level_perm'] and !isset($_POST['level_perm']))
  {
    pwg_query('UPDATE '.ADD_PAGES_TABLE.' SET level = 0;');
  }
  if ($conf['AP']['group_perm'] and !isset($_POST['group_perm']))
  {
    pwg_query('UPDATE '.ADD_PAGES_TABLE.' SET groups = NULL;');
  }
  if ($conf['AP']['language_perm'] and !isset($_POST['language_perm']))
  {
    pwg_query('UPDATE '.ADD_PAGES_TABLE.' SET lang = NULL;');
  }

  $params = array('show_home', 'group_perm', 'user_perm', 'level_perm', 'language_perm');

  foreach ($params as $param)
  {
    $conf['AP'][$param] = isset($_POST[$param]);
  }

  $conf['AP']['languages'] = array();
	foreach($_POST['menu_lang'] as $language_code => $name)
  {
		if (!empty($name))
      $conf['AP']['languages'][$language_code] = $name;
	}

  conf_update_param('additional_pages', pwg_db_real_escape_string(serialize($conf['AP'])));

  if (!defined('AMM_VERSION') or version_compare(AMM_VERSION, '3.0.0', '<'))
  {
    if (isset($_POST['show_menu']) xor (!isset($mb_conf['mbAdditionalPages']) or $mb_conf['mbAdditionalPages'] > 0))
    {
      if (!isset($mb_conf['mbAdditionalPages']))
      {
        $last = @abs(end($mb_conf));
        $mb_conf['mbAdditionalPages'] = $last + 50;
      }
      $mb_conf['mbAdditionalPages'] = (isset($_POST['show_menu']) ? +1 : -1) * abs($mb_conf['mbAdditionalPages']);
      conf_update_param('blk_menubar', pwg_db_real_escape_string(serialize($mb_conf)));
    }
  }

  array_push($page['infos'], l10n('ap_conf_saved'));
}

// Gestion des langues pour le bloc menu
$template->append('language', array(
  'LANGUAGE_NAME' => l10n('Default'),
  'LANGUAGE_CODE' => 'default',
  'VALUE' => @$conf['AP']['languages']['default'],
  )
);
foreach (get_languages() as $language_code => $language_name)
{
	$template->append('language', array(
    'LANGUAGE_NAME' => $language_name,
    'LANGUAGE_CODE' => $language_code,
    'VALUE' => isset($conf['AP']['languages'][$language_code]) ? $conf['AP']['languages'][$language_code] : '',
    )
  );
}

// Parametrage du template
$template->assign(array(
  'ap_conf' => $conf['AP'],
  'SHOW_MENU' => (!isset($mb_conf['mbAdditionalPages']) or $mb_conf['mbAdditionalPages'] > 0),
  'AMM_INSTALLED' => (defined('AMM_VERSION') and version_compare(AMM_VERSION, '3.0.0', '>=')),
  )
);

if (defined('AMM_VERSION') and version_compare(AMM_VERSION, '3.0.0', '>='))
{
  load_language('plugin.lang', AMM_PATH);
  $template->assign('AMM_URI', get_admin_plugin_menu_link(AMM_PATH.'admin/plugin_admin.php'));
}

$template->set_filenames(array('plugin_admin_content' => dirname(__FILE__) . '/template/config.tpl'));
$template->assign_var_from_handle('ADMIN_CONTENT', 'plugin_admin_content');

?>