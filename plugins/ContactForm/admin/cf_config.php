<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
check_status(ACCESS_ADMINISTRATOR);

global $template, $page;
// Include language advices
load_language('plugin.lang', CF_PATH);

$cf_plugin = get_plugin_data($plugin_id);
$cf_config = $cf_plugin->get_config();

if (isset($_POST['submit'])) {
  global $page;
  // Allow guest
  $new_value = false;
  if (isset($_POST['cf_guest_allowed'])) {
      if ('1' == $_POST['cf_guest_allowed']) {
          $new_value = true;
      }
  }
  $cf_config->set_value(CF_CFG_ALLOW_GUEST, $new_value);

  // Mandatory name
  $new_value = false;
  if (isset($_POST['cf_mandatory_name'])) {
      if ('1' == $_POST['cf_mandatory_name']) {
          $new_value = true;
      }
  }
  $cf_config->set_value(CF_CFG_NAME_MANDATORY, $new_value);
  
  // Mandatory mail
  $new_value = false;
  if (isset($_POST['cf_mandatory_mail'])) {
      if ('1' == $_POST['cf_mandatory_mail']) {
          $new_value = true;
      }
  }
  $cf_config->set_value(CF_CFG_MAIL_MANDATORY, $new_value);
  
  // Prefix
  $new_value = '';
  if (isset($_POST['cf_mail_prefix'])) {
    $new_value = trim(stripslashes($_POST['cf_mail_prefix']));
    $cf_config->set_value(CF_CFG_SUBJECT_PREFIX, $new_value);
  }

  // Separator
  $new_value = '';
  if (isset($_POST['cf_separator'])) {
    $new_value = trim(stripslashes($_POST['cf_separator']));
    $cf_config->set_value(CF_CFG_SEPARATOR, $new_value);
  }
  if (isset($_POST['cf_separator_length'])) {
    $new_value = trim(stripslashes($_POST['cf_separator_length']));
    if (ctype_digit($new_value)) {
      $cf_config->set_value(CF_CFG_SEPARATOR_LEN, $new_value);
    } else {
      array_push($page['errors'], l10n('cf_length_not_integer'));
    }
  }
  
  // Redirect delay
  if (isset($_POST['cf_redirect_delay'])) {
    $new_value = trim(stripslashes($_POST['cf_redirect_delay']));
    if (ctype_digit($new_value)) {
      $cf_config->set_value(CF_CFG_REDIRECT_DELAY, $new_value);
    } else {
      array_push($page['errors'], l10n('cf_delay_not_integer'));
    }
  }
  
  // Save config
  $cf_config->save_config();
  $saved = $cf_config->save_config();
  if ($saved) {
      array_push($page['infos'], l10n('cf_config_saved'));
  } else {
      array_push($page['errors'], l10n('cf_config_saved_with_errors'));
  }
  
}

// Define template file
$template->set_filenames(array(
    'plugin_admin_content' => realpath(cf_get_template('cf_config.tpl',
                                                       CF_AMDIN_TPL))
  ));

$cf = array(
    'TITLE'     => $cf_plugin->get_title(),
    'F_ACTION'  => '',
  );

$config_values = array(
    'GUEST'             => $cf_config->get_value(CF_CFG_ALLOW_GUEST)?
                              CF_CHECKED:'',
    'NEED_NAME'         => $cf_config->get_value(CF_CFG_NAME_MANDATORY)?
                              CF_CHECKED:'',
    'NEED_MAIL'         => $cf_config->get_value(CF_CFG_MAIL_MANDATORY)?
                              CF_CHECKED:'',
    'PREFIX'            => $cf_config->get_value(CF_CFG_SUBJECT_PREFIX),
    'SEPARATOR'         => $cf_config->get_value(CF_CFG_SEPARATOR),
    'SEPARATOR_LENGTH'  => $cf_config->get_value(CF_CFG_SEPARATOR_LEN),
    'REDIRECT_DELAY'    => $cf_config->get_value(CF_CFG_REDIRECT_DELAY),
  );
$template->assign('CF', $cf);  
$template->assign('CF_CONFIG', $config_values);  
$template->assign_var_from_handle('ADMIN_CONTENT', 'plugin_admin_content');
?>