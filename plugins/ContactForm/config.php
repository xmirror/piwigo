<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
check_status(ACCESS_ADMINISTRATOR);
include_once(PHPWG_ROOT_PATH.'admin/include/tabsheet.class.php');

CF_Log::reset_messages();

$config_tabs[]='config';
$config_tabs[]='emails';

global $template, $page;
// Include language advices
load_language('plugin.lang', CF_PATH);

$cf_plugin = get_plugin_data($plugin_id);
$cf_config = $cf_plugin->get_config();

// Tabs management
if (!isset($_GET['tab'])) {
    $page['tab'] = $config_tabs[0];
} else {
    $page['tab'] = $_GET['tab'];
}

if (!in_array($page['tab'], $config_tabs)) {
    $page['tab'] = $config_tabs[0];
}
$base_admin_url = get_admin_plugin_menu_link(__FILE__);

$tabsheet = new tabsheet();

foreach ($config_tabs as $current_tab) {
    $tab_name = 'cf_tab_'.$current_tab;
    $tabsheet->add($current_tab,
                   l10n($tab_name),
                   $base_admin_url.'&amp;tab='.$current_tab);
}
$tabsheet->select($page['tab']);
$tabsheet->assign();

// Define template file
$template->block_html_head( '',
          '<link rel="stylesheet" type="text/css" '.
          'href="' . CF_INCLUDE . 'contactform.css' . '">',
          $smarty, $repeat);
$admin_css = cf_get_template('contactform_admin.css', CF_AMDIN_TPL, 'admin_');
$template->block_html_head( '',
          '<link rel="stylesheet" type="text/css" '.
          'href="' . $admin_css . '">',
          $smarty, $repeat);
$template->block_html_head( '',
          '<script type="text/javascript" '.
          'src="' . CF_INCLUDE . 'contactform.js' . '">'.
          '</script>',
          $smarty, $repeat);
$template->set_filenames(array(
    'plugin_admin_content' => realpath(cf_get_template('cf_'.
                                                       $page['tab'].
                                                       '.tab.tpl',
                                                       CF_AMDIN_TPL))
  ));

$cf = array(
    'TITLE'     => $cf_plugin->get_title(),
    'F_ACTION'  => '',
  );
$template->assign('CF', $cf);

// Include specific tab
include_once (CF_ADMIN . 'cf_' . $page['tab'] . '.tab.php');

$template->assign_var_from_handle('ADMIN_CONTENT', 'plugin_admin_content');
CF_Log::show_messages();
?>