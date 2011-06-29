<?php

load_language('plugin.lang', MOSTCOMMENTED_PATH);

global $page, $conf;

$page['section'] = 'most_commented';

$forbidden = get_sql_condition_FandF (
    			array ('forbidden_categories' => 'category_id',
        			 'visible_categories' => 'category_id',
        			 'visible_images' => 'image_id'), '', true);

$query = 'SELECT DISTINCT image_id
    FROM ' . IMAGE_CATEGORY_TABLE . '
    WHERE ' .  $forbidden . ';';

$img = array_from_query($query, 'image_id');

if (empty($img)) $img = array(0);

$query = 'SELECT img.id, COUNT(*)
  FROM ' . IMAGES_TABLE . ' AS img
  INNER JOIN ' . COMMENTS_TABLE . ' AS com
  ON com.image_id = img.id
  AND com.validated = "true"
  WHERE img.id IN (' . implode(',', $img) . ')
  GROUP BY img.id
  ORDER BY 2 DESC, img.hit DESC
  LIMIT 0, ' . $conf['top_number'] . ';';

$page = array_merge($page,
    array('title' => '<a href="' . duplicate_index_url() . '">'
         . $conf['top_number'] . ' ' . l10n('most_commented_cat') . '</a>',
        'items' => array_from_query($query, 'id')));


add_event_handler('loc_end_index_thumbnails', 'add_mostcommented_nb_comments');

function add_mostcommented_nb_comments($tpl_thumbnails_var)
{
  global $template, $user;

  // Suppression de l'ordre de trie
  $template->clear_assign('image_orders');

  // Affichage du nombre de commentaires si désactivé pour l'utilisateur
  if (!$user['show_nb_comments'])
  {
    foreach ($tpl_thumbnails_var as $key => $row)
    {
      $query = 'SELECT COUNT(*) AS nb_comments
        FROM '.COMMENTS_TABLE.'
        WHERE image_id = '.$row['ID'].'
        AND validated = "true";';

      list($nb_comments) = mysql_fetch_array(pwg_query($query));

      $tpl_thumbnails_var[$key]['NAME'] = '(' . $nb_comments . ') ' . $tpl_thumbnails_var[$key]['NAME'];
    }
  }

  return $tpl_thumbnails_var;
}
?>