<?php

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

global $prefixeTable, $conf;

$query = 'SHOW FULL COLUMNS FROM ' . $prefixeTable . 'additionalpages;';
$result = array_from_query($query, 'Collation');
if (strpos($result[4], 'utf8') === false)
{
  $query = 'ALTER TABLE ' . $prefixeTable . 'additionalpages
MODIFY COLUMN lang varchar(255) CHARACTER SET utf8 NOT NULL,
MODIFY COLUMN title varchar(255) CHARACTER SET utf8 NOT NULL,
MODIFY COLUMN text longtext CHARACTER SET utf8 NOT NULL,
DEFAULT CHARACTER SET utf8;';

  pwg_query($query);
}

if ($conf['AP'] === false)
{
  load_conf_from_db('param = "additional_pages"');
  $old_conf = explode ("," , $conf['additional_pages']);

  $query = '
ALTER TABLE ' . $prefixeTable . 'additionalpages
CHANGE `id` `id` SMALLINT( 5 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `pos` `pos` SMALLINT( 5 ) NULL DEFAULT NULL ,
CHANGE `lang` `lang` VARCHAR( 255 ) NULL DEFAULT NULL ,
CHANGE `text` `content` LONGTEXT NOT NULL ,
ADD `users` VARCHAR( 255 ) NULL DEFAULT NULL ,
ADD `groups` VARCHAR( 255 ) NULL DEFAULT NULL ,
ADD `permalink` VARCHAR( 64 ) NULL DEFAULT NULL ,
ADD `standalone` ENUM( "true", "false" ) NOT NULL DEFAULT "false";';
  pwg_query($query);

  $query = '
SELECT id, pos, title, lang
FROM '.$prefixeTable.'additionalpages
ORDER BY pos ASC
;';
  $result = pwg_query($query);
  while ($row = pwg_db_fetch_assoc($result))
  {
    $title = $row['title'];
    $authorized_users = 'NULL';
    $authorized_groups = 'NULL';

    if ($old_conf[7] == 'on' and strpos($title , '/user_id='))
    {
      $array = explode('/user_id=' , $title);
      $title = $array[0];
      $authorized_users = !empty($array[1]) ? '"'.$array[1].'"' : '"admin"';
    }
    if ($old_conf[6] == 'on' and strpos($title , '/group_id='))
    {
      $array = explode('/group_id=' , $title);
      $title = $array[0];
      $authorized_groups = !empty($array[1]) ? '"'.$array[1].'"' : 'NULL';
    }

    $position = $row['pos'];
    if ($row['pos'] === '0')
      $position = '-1000';
    elseif (empty($row['pos']))
      $position = '0';

    $language = $row['lang'] != 'ALL' ? '"'.$row['lang'].'"' : 'NULL';

    $query = '
UPDATE '.$prefixeTable.'additionalpages
SET title = "'.pwg_db_real_escape_string($title).'",
    pos = '.$position.',
    lang = '.$language.',
    users = '.$authorized_users.',
    groups = '.$authorized_groups.'
WHERE id = '.$row['id'].'
;';
    pwg_query($query);
  }

  if ($old_conf[1] == 'off')
  {
    $mb_conf = @unserialize($conf['blk_menubar']);
    if (!isset($mb_conf['mbAdditionalPages']))
    {
      $last = @abs(end($mb_conf));
      $mb_conf['mbAdditionalPages'] = $last + 50;
    }
    $mb_conf['mbAdditionalPages'] = -1 * abs($mb_conf['mbAdditionalPages']);
    conf_update_param('blk_menubar', pwg_db_real_escape_string(serialize($mb_conf)));
  }

  $new_conf = array(
    'show_home' => @($old_conf[2] == 'on'),
    'group_perm' => @($old_conf[6] == 'on'),
    'user_perm' => @($old_conf[7] == 'on'),
    'homepage' => null,
    );

  $languages = explode('/', $old_conf[0]);
  $new_conf['languages'] = array();
  foreach($languages as $language)
  {
    $array = explode(':', $language);
    if (!isset($array[1])) $new_conf['languages']['default'] = $array[0];
    else $new_conf['languages'][$array[0]] = $array[1];
  }

  $conf['AP'] = $new_conf;

  conf_update_param('additional_pages', pwg_db_real_escape_string(serialize($new_conf)));
}

if (!isset($conf['AP']['level_perm']))
{
  $query = '
ALTER TABLE ' . $prefixeTable . 'additionalpages
ADD `level` TINYINT( 3 ) UNSIGNED NOT NULL DEFAULT "0" AFTER `groups`
;';
  pwg_query($query);

  $query = '
UPDATE ' . $prefixeTable . 'additionalpages
SET users = CONCAT( users, ",admin,webmaster" )
WHERE users IS NOT NULL
;';
  pwg_query($query);

  $conf['AP']['level_perm'] = false;

  conf_update_param('additional_pages', pwg_db_real_escape_string(serialize($conf['AP'])));
}

if (!isset($conf['AP']['language_perm']))
{
  $query = '
SELECT id
FROM '.$prefixeTable.'additionalpages
WHERE lang IS NOT NULL
;';
  $ids = array_from_query($query, 'id');

  $conf['AP']['language_perm'] = !empty($ids);

  conf_update_param('additional_pages', pwg_db_real_escape_string(serialize($conf['AP'])));  
}

?>