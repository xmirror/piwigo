<?php

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

include(CAPTCHA_PATH.'recaptchalib.php');
add_event_handler('loc_end_page_header', 'add_captcha');
add_event_handler('register_user_check', 'check_captcha');

function add_captcha()
{
  global $template, $conf;

  $template->set_prefilter('register', 'captcha_prefilter');
  $template->set_filename('captcha', realpath(CAPTCHA_PATH.'captcha.tpl'));
  $template->assign(array(
    'CAPTCHA_HTML'  => recaptcha_get_html($conf['captcha_publickey'], get_plugin_data('captcha')),
    'CAPTCHA_THEME' => $conf['captcha_theme'],
    )
  );
  $template->assign_var_from_handle('CAPTCHA', 'captcha');
}

function captcha_prefilter($content, $smarty)
{
  $search = '<p class="bottomButtons">';
  return str_replace($search, '{$CAPTCHA}'."\n".$search, $content);
}

function check_captcha($errors)
{
  global $conf;

  $resp = recaptcha_check_answer(
    $conf['captcha_privatekey'],
    $_SERVER["REMOTE_ADDR"],
    $_POST["recaptcha_challenge_field"],
    $_POST["recaptcha_response_field"]
  );

  if (!$resp->is_valid)
  {
    load_language('plugin.lang', CAPTCHA_PATH);
    array_push($errors, l10n('Invalid Captcha'));
    set_plugin_data('captcha', $resp->error);
  }

  return $errors;
}

?>