<?php
function akismet_user_comment_check($action, $comment)
{
  global $conf;
  if ('reject'==$action or $conf['akismet_spam_action']==$action)
    return $action; // already rejecting
  if ( empty($conf['akismet_api_key']) )
    return $action; // need to config it
  /*if ( !is_a_guest() )
    return $action;*/

  include_once( dirname(__FILE__).'/akismet.class.php' );

  set_make_full_url();
  $url = duplicate_picture_url( array('image_id'=>$comment['image_id']) );
  unset_make_full_url();
  $aki_comm = array(
    'author' => $comment['author'],
    'body' => $comment['content'],
    'permalink' => $url,
    'referrer' => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '',
  );

  $akismet = new Akismet(get_absolute_root_url(), $conf['akismet_api_key'], $aki_comm);

  if( !$akismet->errorsExist() )
  {
    $counters = explode('/', $conf['akismet_counters']);
    if ( $akismet->isSpam() )
    {
      $action = $conf['akismet_spam_action'];
      if ('reject'!=$action) set_status_header(403);
      $counters[0]++;
    }
    $counters[1]++;
    $conf['akismet_counters'] = implode('/', $counters);
    $query = 'UPDATE '.CONFIG_TABLE.' SET value="'.$conf['akismet_counters'].'" WHERE param="akismet_counters" LIMIT 1';
    pwg_query($query);
  }
  elseif (is_admin())
    var_export( $akismet->getErrors() );

  return $action;
}

?>