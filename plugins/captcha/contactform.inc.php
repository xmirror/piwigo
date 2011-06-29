<?php

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

include(CAPTCHA_PATH.'recaptchalib.php');
add_event_handler('display_contactform', 'add_captcha');
add_event_handler('check_contactform_params', 'check_captcha');

function add_captcha()
{
  global $template, $conf;

  if (!is_a_guest()) return;

  $template->set_prefilter('cf_form', 'captcha_prefilter');
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
  $search = '
      <tr>
        <td class="contact-form-left">&nbsp;</td>
        <td class="contact-form-right"><input class="submit" type="submit" value="{\'cf_submit\'|@translate}"></td>
      </tr>';
  return str_replace($search, '<tr><td></td><td class="contact-form-right">{$CAPTCHA}</td></tr>'."\n".$search, $content);
}

function check_captcha($infos)
{
  global $conf;

  if (!is_a_guest()) return $infos;

  $resp = recaptcha_check_answer(
    $conf['captcha_privatekey'],
    $_SERVER["REMOTE_ADDR"],
    $_POST["recaptcha_challenge_field"],
    $_POST["recaptcha_response_field"]
  );

  if (!$resp->is_valid)
  {
    load_language('plugin.lang', CAPTCHA_PATH);
    array_push($infos['errors'], l10n('Invalid Captcha'));
    set_plugin_data('captcha', $resp->error);
  }

  return $infos;
}

?>