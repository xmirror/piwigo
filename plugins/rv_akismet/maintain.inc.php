<?php
function plugin_install()
{
  $q = '
INSERT INTO '.CONFIG_TABLE.' (param,value,comment)
  VALUES
  ("akismet_api_key","","Akismet online service API key")
;';
  pwg_query($q);
  $q = '
INSERT INTO '.CONFIG_TABLE.' (param,value,comment)
  VALUES
  ("akismet_spam_action","moderate","Action when akismet detects spam")
;';
  pwg_query($q);
  $q = '
INSERT INTO '.CONFIG_TABLE.' (param,value,comment)
  VALUES
  ("akismet_counters","0/0","Akismet counters")
;';
  pwg_query($q);
}


function plugin_uninstall()
{
  foreach (array('akismet_api_key','akismet_spam_action','akismet_counters') as $param)
  {
    $q = '
DELETE FROM '.CONFIG_TABLE.' WHERE param="'.$param.'" LIMIT 1';
    pwg_query( $q );
  }
}

?>