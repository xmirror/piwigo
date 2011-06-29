<?php
/*
Plugin Name: Most Commented
Version: 2.2.a
Description: Add a "Most Commented" link in "Specials" menu.
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=145
Author: P@t
Author URI: http://www.gauchon.com
*/

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

define('MOSTCOMMENTED_PATH' , PHPWG_PLUGINS_PATH . basename(dirname(__FILE__)) . '/');

function add_link_mostcommented($menu_ref_arr)
{
  global $conf;

  $menu = & $menu_ref_arr[0];
  $position = (isset($conf['mostcommented_position']) and is_numeric($conf['mostcommented_position'])) ? $conf['mostcommented_position'] : 3;
  
  if (($block = $menu->get_block('mbSpecials')) != null )
  {
    load_language('plugin.lang', MOSTCOMMENTED_PATH);

    array_splice($block->data, $position-1, 0, array('most_commented' =>
      array(
        'URL' => make_index_url(array('section' => 'most_commented')),
        'TITLE' => l10n('most_commented_cat_hint'),
        'NAME' => l10n('most_commented_cat')
        )
      )
    );
  }
}

function section_init_most_commented()
{
  global $tokens;
  if (in_array('most_commented', $tokens))
    include(MOSTCOMMENTED_PATH . 'most_commented.php');
}

add_event_handler('blockmanager_apply' , 'add_link_mostcommented');
add_event_handler('loc_end_section_init', 'section_init_most_commented');

?>