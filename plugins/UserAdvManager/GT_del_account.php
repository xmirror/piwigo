<?php
//----------------------------------------------------------- include
define('PHPWG_ROOT_PATH','./../../');

include_once( PHPWG_ROOT_PATH.'include/common.inc.php' );

include_once (UAM_PATH.'include/constants.php');
include_once (UAM_PATH.'include/functions.inc.php');

$title= l10n('UAM_Deleted_Account_Redirection_Page');
$page['body_id'] = 'theAboutPage';
include(PHPWG_ROOT_PATH.'include/page_header.php');

@include(PHPWG_ROOT_PATH.'template/'.$user['template'].
  '/theme/'.$user['theme'].'/themeconf.inc.php');


global $user, $lang, $conf, $errors;
  

$conf_UAM = unserialize($conf['UserAdvManager']);

if (isset($conf_UAM[23]) and $conf_UAM[23] <> '')
{
  // Management of Extension flags ([mygallery], [myurl]) - [username] flag can't be used here
  $patterns[] = '#\[mygallery\]#i';
  $replacements[] = $conf['gallery_title'];
  $patterns[] = '#\[myurl\]#i';
  $replacements[] = $conf['gallery_url'];

  if (function_exists('get_user_language_desc'))
  {
    $custom_text = get_user_language_desc(preg_replace($patterns, $replacements, $conf_UAM[23]));
  }
  else $custom_text = l10n(preg_replace($patterns, $replacements, $conf_UAM[23]));
}
    
$template->assign(
  array(
    'GALLERY_URL'          => make_index_url(),
    'CUSTOM_REDIR_MSG'     => $custom_text,
  )
);

if (isset($lang['Theme: '.$user['theme']]))
{
  $template->assign(
  	'THEME_ABOUT',l10n('Theme: '.$user['theme'])
  );
}

$template->set_filenames(
  array(
  	'UAM_RedirPage'=>dirname(__FILE__).'/template/del_account.tpl',
	)
);

$template->pparse('UAM_RedirPage');
include(PHPWG_ROOT_PATH.'include/page_tail.php');
?>