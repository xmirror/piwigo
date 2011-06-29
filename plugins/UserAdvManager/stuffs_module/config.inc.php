<?php

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

if (!isset($datas)) $datas = '';

// Enregistrement de la configuration
if (isset($_POST['submit']) and !is_adviser()) {
  $datas = stripslashes($_POST['personal_content']);
}

// Parametrage du template
$template->assign('cat_style', array());
$template->assign(array('PERSONAL_CONTENT' => $datas));

$template->set_filenames(array('module_options' => dirname(__FILE__) . '/config.tpl'));
$template->assign_var_from_handle('MODULE_OPTIONS', 'module_options');

?>