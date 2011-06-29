<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

load_language('plugin.lang', CAPTCHA_PATH);
include(CAPTCHA_PATH.'recaptchalib.php');

if ( isset($_POST['submit']) and !is_adviser() )
{
  foreach (array('captcha_publickey', 'captcha_privatekey', 'captcha_theme') as $field)
  {
    $conf[$field] = trim($_POST[$field]);

    $query = '
UPDATE '.CONFIG_TABLE.'
  SET value="'.$conf[$field].'"
  WHERE param="'.$field.'"
  LIMIT 1';
    pwg_query($query);
  }

  array_push($page['infos'], l10n('Information data registered in database'));
}

$template->set_filename('plugin_admin_content', dirname(__FILE__).'/admin.tpl');

$template->assign(array(
  'CAPTCHA_PUBLICKEY' => $conf['captcha_publickey'],
  'CAPTCHA_PRIVATEKEY' => $conf['captcha_privatekey'],
  'reCAPTCHA_URL' => recaptcha_get_signup_url(urlencode($_SERVER['SERVER_NAME']), 'Piwigo'),
  'captcha_theme_options' => array('red', 'white', 'blackglass'),
  'captcha_theme_selected' => $conf['captcha_theme'],
  )
);


$template->assign_var_from_handle( 'ADMIN_CONTENT', 'plugin_admin_content');

?>