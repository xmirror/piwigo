<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

// Include language advices
load_language('plugin.lang', CF_PATH);

/**
 * Include class file
 * @param $aClassName
 */
function cf_require_class($aClassName) {
  require_once CF_CLASSES .strtolower($aClassName) . '.class.php';
}

include_once(PHPWG_ROOT_PATH . 'include/functions_mail.inc.php');

function cf_switch_to_default_lang() {
  global $switch_lang,$user;
  if (!isset($switch_lang['stack']) or
      !in_array($user['language'], $switch_lang['stack'])) {
    $switch_lang['stack'][] = $user['language'];
  }
  switch_lang_to(get_default_language());
  // Include language advices
  load_language('plugin.lang', CF_PATH);
}
function cf_switch_back_to_user_lang() {
  switch_lang_back();
}
function cf_validate_mail_format($email) {
  $atom   = '[-a-z0-9!#$%&\'*+\\/=?^_`{|}~]';   // before  arobase
  $domain = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)'; // domain name
  $regex  = '/^' . $atom . '+' . '(\.' . $atom . '+)*';
  $regex .= '@' . '(' . $domain . '{1,63}\.)+' . $domain . '{2,63}$/i';
  if ( !preg_match( $regex, $email ) ) {
    return l10n('cf_mail_format_error');
  }
  return null;
}

function cf_get_admins_emails($webmaster_email) {
  global $conf, $user;
  $admins = array();

  $query = '
select
  U.'.$conf['user_fields']['username'].' as username,
  U.'.$conf['user_fields']['email'].' as mail_address
from
  '.USERS_TABLE.' as U,
  '.USER_INFOS_TABLE.' as I
where
  I.user_id =  U.'.$conf['user_fields']['id'].' and
  I.status in (\'webmaster\',  \'admin\') and
  '.$conf['user_fields']['email'].' is not null and
  I.user_id <> '.$user['id'].'
order by
  username
';

  $datas = pwg_query($query);
  if (!empty($datas)) {
    while ($admin = mysql_fetch_array($datas)) {
      if (!empty($admin['mail_address']) and
          (0!=strcasecmp($admin['mail_address'], $webmaster_email))) {
        array_push( $admins,
                    format_email($admin['username'], $admin['mail_address'])
                  );
      }
    }
  }
  return $admins;
}

function cf_get_admins_contacts() {
  global $conf, $user;
  $admins = array();

  $query = '
select
  U.'.$conf['user_fields']['username'].' as username,
  U.'.$conf['user_fields']['email'].' as mail_address
from
  '.USERS_TABLE.' as U,
  '.USER_INFOS_TABLE.' as I
where
  I.user_id =  U.'.$conf['user_fields']['id'].' and
  I.status in (\'webmaster\',  \'admin\') and
  '.$conf['user_fields']['email'].' is not null 
order by
  username
';
  
  $webmaster_mail = get_webmaster_mail_address();
  $datas = pwg_query($query);
  if (!empty($datas)) {
    while ($admin = mysql_fetch_array($datas)) {
      if (!empty($admin['mail_address'])) {
        $name = $admin['username'];
        $webmaster = 0;
        if (0 == strcasecmp($webmaster_mail, $admin['mail_address'])) {
          $name = l10n('Webmaster');
          $webmaster = 1;
        }
        $admins[$admin['mail_address']] = array(
            'NAME'     => $name,
            'EMAILSTR' => format_email($name,
                                       $admin['mail_address']),
            'ACTIVE'   => 1,
            'WEBMASTER'=> $webmaster,
          );
      }
    }
  }
  return $admins;
  
}

/* Return template for user template/theme */
function cf_get_template($file, $dir=CF_TEMPLATE, $prefix='') {
  global $user, $template;

  $theme_file = $dir.
                //$user[$prefix.'template'].'/'.
                $user['theme'].'/'.
                $file;
  $template_file = $dir.
                   //$user[$prefix.'template'].'/'.
                   $file;

  if (file_exists($theme_file))
  {
    return $theme_file;
  }
  else
  {
    return $dir.$file;
  }
}

function contactForm_prefilter($content, &$smarty) {
  $search = '#{if\s+isset\s*\(\s*\$CONTACT_MAIL\s*\)\s*}.*?{/if}#s';
  $replacement = '{if isset($ContactFormLink)}{$ContactFormLink}{/if}';

  return preg_replace($search, $replacement, $content);
}
  
function cf_clean_obsolete_files($obsolete_file_list) {
  if (!file_exists(CF_PATH.$obsolete_file_list)) {
    return TRUE;
  }
  $obsolete = file(CF_PATH.$obsolete_file_list);
  array_push($obsolete, $obsolete_file_list);
  return cf_clean_obsolete_list($obsolete);
}

function cf_clean_obsolete_list($file_list = array(), &$errors = array()) {
  // Include language advices
  load_language('plugin.lang', CF_PATH);
  
  if (!function_exists('unlink')) {
      // No unlink available...
      array_push($errors, l10n('cf_no_unlink'));
      return FALSE;
  }
  $success = TRUE;
  foreach ($file_list as $file) {
    $file = CF_PATH . $file;
    if (file_exists($file)) {
      // Remove obsolete file
      $success &= unlink($file);
    }
  }
  if (!$success) {
      array_push($errors, l10n('cf_unlink_errors'));
  }
  return $success;
}

function cf_format_date($year, $month, $day, $format='%M %D, %Y') {
  $format = str_ireplace('%Y', $year, $format);
  $format = str_ireplace('%M', $month, $format);
  $format = str_ireplace('%D', $day, $format);
  return $format;
}

?>
