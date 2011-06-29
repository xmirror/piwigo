<?php
function plugin_install()
{
  global $conf;

  if (!isset($conf['captcha_publickey']))
  {
    $q = 'INSERT INTO '.CONFIG_TABLE.' (param,value,comment) VALUES ("captcha_publickey","","Captcha public key");';
    pwg_query($q);
  }

  if (!isset($conf['captcha_privatekey']))
  {
    $q = 'INSERT INTO '.CONFIG_TABLE.' (param,value,comment) VALUES ("captcha_privatekey","","Captcha private key");';
    pwg_query($q);
  }
  
  if (!isset($conf['captcha_theme']))
  {
    $q = 'INSERT INTO '.CONFIG_TABLE.' (param,value,comment) VALUES ("captcha_theme","red","Captcha theme");';
    pwg_query($q);
  }
}

function plugin_activate($id, $version, &$errors)
{
  global $conf;

  if (!isset($conf['captcha_theme']))
  {
    plugin_install();
  }

  // Check if API is responding
  include(PHPWG_PLUGINS_PATH.basename(dirname(__FILE__)).'/recaptchalib.php');
  $response = _recaptcha_http_post(RECAPTCHA_VERIFY_SERVER, "/recaptcha/api/verify", array ());
  $answers = explode ("\n", $response [1]);

  if ($answers[0] != 'true' and $answers[0] != 'false')
  {
    array_push($errors, l10n('Piwigo can\'t connect to reCaptcha server'));
  }
}


function plugin_uninstall()
{
  foreach (array('captcha_publickey','captcha_privatekey', 'captcha_theme') as $param)
  {
    $q = 'DELETE FROM '.CONFIG_TABLE.' WHERE param="'.$param.'" LIMIT 1';
    pwg_query( $q );
  }
}

?>