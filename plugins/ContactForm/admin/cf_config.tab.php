<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
check_status(ACCESS_ADMINISTRATOR);


if (isset($_POST['submit'])) {

  // Menu link
  $new_value = false;
  if (isset($_POST['cf_menu_link'])) {
    if ('1' == $_POST['cf_menu_link']) {
      $new_value = true;
    }
  }
  $cf_config->set_value(CF_CFG_MENU_LINK, $new_value);
  
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
      CF_Log::add_error(l10n('cf_length_not_integer'));
    }
  }
  
  // Redirect delay
  if (isset($_POST['cf_redirect_delay'])) {
    $new_value = trim(stripslashes($_POST['cf_redirect_delay']));
    if (ctype_digit($new_value)) {
      $cf_config->set_value(CF_CFG_REDIRECT_DELAY, $new_value);
    } else {
      CF_Log::add_error(l10n('cf_delay_not_integer'));
    }
  }
  
  // Save config
  $cf_config->save_config();
  $saved = $cf_config->save_config();
  if ($saved) {
    CF_Log::add_message(l10n('cf_config_saved'));
  } else {
    CF_Log::add_error(l10n('cf_config_saved_with_errors'));
  }
  
}

$config_values = array(
    'MENU_LINK'         => $cf_config->get_value(CF_CFG_MENU_LINK)?
                              CF_CHECKED:'',
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

$template->assign('CF_CONFIG', $config_values);  

?>