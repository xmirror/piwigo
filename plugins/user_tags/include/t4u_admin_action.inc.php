<?php
// +-----------------------------------------------------------------------+
// | User Tags  - a plugin for Piwigo                                      |
// +-----------------------------------------------------------------------+
// | Copyright(C) 2010-2011 Nicolas Roudaire        http://www.nikrou.net  |
// +-----------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify  |
// | it under the terms of the GNU General Public License as published by  |
// | the Free Software Foundation                                          |
// |                                                                       |
// | This program is distributed in the hope that it will be useful, but   |
// | WITHOUT ANY WARRANTY; without even the implied warranty of            |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU      |
// | General Public License for more details.                              |
// |                                                                       |
// | You should have received a copy of the GNU General Public License     |
// | along with this program; if not, write to the Free Software           |
// | Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,            |
// | MA 02110-1301 USA.                                                    |
// +-----------------------------------------------------------------------+

if (!defined('PHPWG_ROOT_PATH')) {
  die('Hacking attempt!');
}

if (!empty($_GET['action']) && ($_GET['action']=='add') 
    && isset($_POST['tags']) && $me->getPermission('add')) {
  include_once(PHPWG_ROOT_PATH.'admin/include/functions.php');

  if (empty($_POST['tags'])) {
    $_POST['tags'] = array();
  }
  $tag_ids = __get_tag_ids($_POST['tags']);
  set_tags($tag_ids, $_POST['image_id']);

  if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    header("Content-Type: application/json");
    $message['info'] = l10n('Tags updated');

    echo json_encode($message);
    exit();
  } else {
    redirect(get_root_url().$_POST['referer']);
  }
} elseif (!empty($_GET['action']) && $_GET['action']=='get' && $me->getPermission('add')) {
  $query = '
SELECT
    id AS tag_id,
    name AS tag_name
  FROM '.TAGS_TABLE;

  if (!empty($_GET['q'])) {
    $query .= ' WHERE url_name like \'%'.pwg_db_real_escape_string($_GET['q']).'%\';';
  } else {
    $query .= ';';
  }
  header("Content-Type: application/json");
  echo json_encode(__get_taglist($query));
  exit();
}

/*
 * temporary functions before piwigo 2.3
 * See admin/include/functions.php in piwigo core
 */
function __get_taglist($query) {
  $result = pwg_query($query);

  $taglist = array();
  while ($row = pwg_db_fetch_assoc($result)) {
    $taglist[] = array('name' => $row['tag_name'],
		       'id' => '~~'.$row['tag_id'].'~~'
		       );
  }

  $cmp = create_function('$a,$b', 'return strcasecmp($a[\'name\'], $b[\'name\']);');
  usort($taglist, $cmp);

  return $taglist;
}

function __get_tag_ids($raw_tags) {
  $tag_ids = array();
  $raw_tags = explode(',',$raw_tags);

  foreach ($raw_tags as $raw_tag) {
    if (preg_match('/^~~(\d+)~~$/', $raw_tag, $matches)) {
      $tag_ids[] = $matches[1];
    } else {
      $tag_ids[] = tag_id_from_tag_name($raw_tag);
    }
  }

  return $tag_ids;
}
?>