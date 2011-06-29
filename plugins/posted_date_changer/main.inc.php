<?php
/*
Plugin Name: Posted Date Changer
Version: 2.2.b
Description: Change the posted date of photos in batch manager.
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=528
Author: P@t
Author URI: http://www.gauchon.com
*/

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

add_event_handler('loc_end_element_set_global', 'change_posted_date');
add_event_handler('element_set_global_action', 'change_posted_date_action', 50, 2);

function change_posted_date()
{
  global $template;

  load_language('plugin.lang', dirname(__FILE__).'/');

  $template->set_filename('change_posted_date', dirname(__FILE__).'/change_posted_date.tpl');

  $day = empty($_POST['date_available_day']) ? date('j') : $_POST['date_available_day'];
  $month = empty($_POST['date_available_month']) ? date('n') : $_POST['date_available_month'];
  $year = empty($_POST['date_available_year']) ? date('Y') : $_POST['date_available_year'];

  $template->assign(array(
    'DATE_AVAILABLE_DAY'  => (int)$day,
    'DATE_AVAILABLE_MONTH'=> (int)$month,
    'DATE_AVAILABLE_YEAR' => (int)$year,
    )
  );

  $template->append('element_set_global_plugins_actions', array(
    'ID' => 'date_available',
    'NAME' => l10n('Change Posted Date'),
    'CONTENT' => $template->parse('change_posted_date', true),
    )
  );
}

function change_posted_date_action($action, $collection)
{
  if ($action == 'date_available')
  {
    $date_available = sprintf(
      '%u-%u-%u',
      $_POST['date_available_year'],
      $_POST['date_available_month'],
      $_POST['date_available_day']
      );

    $datas = array();
    foreach ($collection as $image_id)
    {
      array_push(
        $datas,
        array(
          'id' => $image_id,
          'date_available' => $date_available
          )
        );
    }

    mass_updates(
      IMAGES_TABLE,
      array('primary' => array('id'), 'update' => array('date_available')),
      $datas
      );
  }
}

?>