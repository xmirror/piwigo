<?php

function plugin_install()
{
  $q = pwg_query('SHOW COLUMNS FROM ' . HISTORY_TABLE . ' LIKE "section"');
  $section = mysql_fetch_array($q);
  $type = $section['Type'];

  if (substr_count($type, 'most_commented') == 0)
    $type = strtr($type , array(')' => ',\'most_commented\')'));

  pwg_query('ALTER TABLE ' . HISTORY_TABLE . ' CHANGE section section ' . $type . ' DEFAULT NULL');
}

?>