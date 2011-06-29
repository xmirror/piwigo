<?php

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

include_once(PHPWG_ROOT_PATH.'admin/include/functions.php');
include_once(PHPWG_ROOT_PATH.'admin/include/tabsheet.class.php');

// +-----------------------------------------------------------------------+
// | Check Access and exit when user status is not ok                      |
// +-----------------------------------------------------------------------+

check_status(ACCESS_ADMINISTRATOR);

check_input_parameter('selection', $_POST, true, PATTERN_ID);

// +-----------------------------------------------------------------------+
// |                      initialize current set                           |
// +-----------------------------------------------------------------------+

if (isset($_POST['submitFilter']))
{
  // echo '<pre>'; print_r($_POST); echo '</pre>';

  $_SESSION['bulk_manager_filter'] = array();

  if (isset($_POST['filter_prefilter_use']))
  {
    $prefilters = array('caddie', 'last import', 'with no album', 'with no tag', 'with no virtual album', 'duplicates', 'all photos');
    if (in_array($_POST['filter_prefilter'], $prefilters))
    {
      $_SESSION['bulk_manager_filter']['prefilter'] = $_POST['filter_prefilter'];
    }
  }

  if (isset($_POST['filter_category_use']))
  {
    $_SESSION['bulk_manager_filter']['category'] = $_POST['filter_category'];

    if (isset($_POST['filter_category_recursive']))
    {
      $_SESSION['bulk_manager_filter']['category_recursive'] = true;
    }
  }

  if (isset($_POST['filter_level_use']))
  {
    if (in_array($_POST['filter_level'], $conf['available_permission_levels']))
    {
      $_SESSION['bulk_manager_filter']['level'] = $_POST['filter_level'];
    }
  }
}

if (isset($_GET['cat']))
{
  if ('caddie' == $_GET['cat'])
  {
    $_SESSION['bulk_manager_filter'] = array(
      'prefilter' => 'caddie'
      );
  }

  if ('recent' == $_GET['cat'])
  {
    $_SESSION['bulk_manager_filter'] = array(
      'prefilter' => 'last import'
      );
  }

  if (is_numeric($_GET['cat']))
  {
    $_SESSION['bulk_manager_filter'] = array(
      'category' => $_GET['cat']
      );
  }
}

if (!isset($_SESSION['bulk_manager_filter']))
{
  $_SESSION['bulk_manager_filter'] = array(
    'prefilter' => 'caddie'
    );
}

// echo '<pre>'; print_r($_SESSION['bulk_manager_filter']); echo '</pre>';

// depending on the current filter (in session), we find the appropriate
// photos
$filter_sets = array();
if (isset($_SESSION['bulk_manager_filter']['prefilter']))
{
  if ('caddie' == $_SESSION['bulk_manager_filter']['prefilter'])
  {
    $query = '
SELECT element_id
  FROM '.CADDIE_TABLE.'
  WHERE user_id = '.$user['id'].'
;';
    array_push(
      $filter_sets,
      array_from_query($query, 'element_id')
      );
  }

  if ('last import'== $_SESSION['bulk_manager_filter']['prefilter'])
  {
    $query = '
SELECT MAX(date_available) AS date
  FROM '.IMAGES_TABLE.'
;';
    $row = pwg_db_fetch_assoc(pwg_query($query));
    if (!empty($row['date']))
    {
      $query = '
SELECT id
  FROM '.IMAGES_TABLE.'
  WHERE date_available BETWEEN '.pwg_db_get_recent_period_expression(1, $row['date']).' AND \''.$row['date'].'\'
;';
      array_push(
        $filter_sets,
        array_from_query($query, 'id')
        );
    }
  }

  if ('with no virtual album' == $_SESSION['bulk_manager_filter']['prefilter'])
  {
    // we are searching elements not linked to any virtual category
    $query = '
 SELECT id
   FROM '.IMAGES_TABLE.'
 ;';
    $all_elements = array_from_query($query, 'id');

    $query = '
 SELECT id
   FROM '.CATEGORIES_TABLE.'
   WHERE dir IS NULL
 ;';
    $virtual_categories = array_from_query($query, 'id');
    if (!empty($virtual_categories))
    {
      $query = '
 SELECT DISTINCT(image_id)
   FROM '.IMAGE_CATEGORY_TABLE.'
   WHERE category_id IN ('.implode(',', $virtual_categories).')
 ;';
      $linked_to_virtual = array_from_query($query, 'image_id');
    }

    array_push(
      $filter_sets,
      array_diff($all_elements, $linked_to_virtual)
      );
  }

  if ('with no album' == $_SESSION['bulk_manager_filter']['prefilter'])
  {
    $query = '
SELECT
    id
  FROM '.IMAGES_TABLE.'
    LEFT JOIN '.IMAGE_CATEGORY_TABLE.' ON id = image_id
  WHERE category_id is null
;';
    array_push(
      $filter_sets,
      array_from_query($query, 'id')
      );
  }

  if ('with no tag' == $_SESSION['bulk_manager_filter']['prefilter'])
  {
    $query = '
SELECT
    id
  FROM '.IMAGES_TABLE.'
    LEFT JOIN '.IMAGE_TAG_TABLE.' ON id = image_id
  WHERE tag_id is null
;';
    array_push(
      $filter_sets,
      array_from_query($query, 'id')
      );
  }


  if ('duplicates' == $_SESSION['bulk_manager_filter']['prefilter'])
  {
    // we could use the group_concat MySQL function to retrieve the list of
    // image_ids but it would not be compatible with PostgreSQL, so let's
    // perform 2 queries instead. We hope there are not too many duplicates.

    $query = '
SELECT file
  FROM '.IMAGES_TABLE.'
  GROUP BY file
  HAVING COUNT(*) > 1
;';
    $duplicate_files = array_from_query($query, 'file');

    $query = '
SELECT id
  FROM '.IMAGES_TABLE.'
  WHERE file IN (\''.implode("','", $duplicate_files).'\')
;';

    array_push(
      $filter_sets,
      array_from_query($query, 'id')
      );
  }

  if ('all photos' == $_SESSION['bulk_manager_filter']['prefilter'])
  {
    $query = '
SELECT id
  FROM '.IMAGES_TABLE.'
;';

    array_push(
      $filter_sets,
      array_from_query($query, 'id')
      );
  }
}

if (isset($_SESSION['bulk_manager_filter']['category']))
{
  $categories = array();

  if (isset($_SESSION['bulk_manager_filter']['category_recursive']))
  {
    $categories = get_subcat_ids(array($_SESSION['bulk_manager_filter']['category']));
  }
  else
  {
    $categories = array($_SESSION['bulk_manager_filter']['category']);
  }

  $query = '
 SELECT DISTINCT(image_id)
   FROM '.IMAGE_CATEGORY_TABLE.'
   WHERE category_id IN ('.implode(',', $categories).')
 ;';
  array_push(
    $filter_sets,
    array_from_query($query, 'image_id')
    );
}

if (isset($_SESSION['bulk_manager_filter']['level']))
{
  $query = '
SELECT id
  FROM '.IMAGES_TABLE.'
  WHERE level >= '.$_SESSION['bulk_manager_filter']['level'].'
;';
  array_push(
    $filter_sets,
    array_from_query($query, 'id')
    );
}

$current_set = array_shift($filter_sets);
foreach ($filter_sets as $set)
{
  $current_set = array_intersect($current_set, $set);
}
$page['cat_elements_id'] = $current_set;

// +-----------------------------------------------------------------------+
// |                       first element to display                        |
// +-----------------------------------------------------------------------+

// $page['start'] contains the number of the first element in its
// category. For exampe, $page['start'] = 12 means we must show elements #12
// and $page['nb_images'] next elements

if (!isset($_GET['start'])
    or !is_numeric($_GET['start'])
    or $_GET['start'] < 0
    or (isset($_GET['display']) and 'all' == $_GET['display']))
{
  $page['start'] = 0;
}
else
{
  $page['start'] = $_GET['start'];
}

$template->assign('element_set_global_action_tpl', dirname(__FILE__).'\element_set_global_action.tpl');
$template->set_extent(dirname(__FILE__).'/regenerate_thumbnails.tpl', 'batch_manager_global');
include(PHPWG_ROOT_PATH.'admin/batch_manager_global.php');

?>