<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
check_status(ACCESS_ADMINISTRATOR);

$cf_emails = $cf_config->get_value(CF_CFG_ADMIN_MAILS);
$save = false;
if (isset($_POST['refresh'])) {
  $cf_emails = cf_get_admins_contacts();
  
  $cf_config->set_value(CF_CFG_ADMIN_MAILS, $cf_emails);
  $save = true;
}
if (isset($_POST['submit'])) {
  $webmaster = trim(stripslashes($_POST['webmaster']));
  if (isset($_POST['active']) and (is_array($_POST['active']))) {
    foreach($_POST['active'] as $email => $active) {
      $email = trim(stripslashes($email));
      $active = (1 == $active)?1:0;
      $cf_emails[$email]['ACTIVE'] = $active;
      if (0 == strcmp($webmaster, $email)) {
        $cf_emails[$email]['WEBMASTER'] = 1;
      } else {
        $cf_emails[$email]['WEBMASTER'] = 0;
      }
    }
    $cf_config->set_value(CF_CFG_ADMIN_MAILS, $cf_emails);
    $save = true;
  }
}
if ($save) {
  // Save config
  $cf_config->save_config();
  $saved = $cf_config->save_config();
  if ($saved) {
    CF_Log::add_message(l10n('cf_config_saved'));
  } else {
    CF_Log::add_error(l10n('cf_config_saved_with_errors'));
  }
}
$template->assign('CF_OPTIONS', array(
    '1' => l10n('Yes'),
    '0' => l10n('No'),
   ));
$template->assign('CF_EMAILS', $cf_emails);
?>