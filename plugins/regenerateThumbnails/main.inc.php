<?php
/*
Plugin Name: Thumbnails Regeneration
Version: 2.2.f
Description: Regenerate gallery's thumbnails.
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=525
Author: P@t
Author URI: http://www.gauchon.com
*/

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
define('REGENERATE_THUMBNAILS_PATH' , PHPWG_PLUGINS_PATH . basename(dirname(__FILE__)) . '/');

add_event_handler('loc_begin_admin', 'rg_add_thumbnails_tab');
add_event_handler('loc_begin_element_set_global', 'rg_element_set_global_add_action');
add_event_handler('ws_add_methods', 'add_regenerate_thumbnails_method');

function rg_add_thumbnails_tab()
{
  global $page;

  if (isset($_GET['page']) and in_array($_GET['page'], array('thumbnail', 'plugin-regenerateThumbnails')))
  {
    load_language('plugin.lang', REGENERATE_THUMBNAILS_PATH);
    include_once(PHPWG_ROOT_PATH.'admin/include/tabsheet.class.php');

    if ($_GET['page'] == 'plugin-regenerateThumbnails')
      $page['tab'] = 'regenerateThumbnails';
    else
      $page['tab'] = 'thumbnail';

    $tabsheet = new tabsheet();
    $tabsheet->add('thumbnail', l10n('Thumbnail creation'), get_root_url().'admin.php?page=thumbnail');
    $tabsheet->add('regenerateThumbnails', l10n('Regenerate Thumbnails'), get_root_url().'admin.php?page=plugin-'.basename(dirname(__FILE__)));
    $tabsheet->select($page['tab']);
    $tabsheet->assign();
  }
}

function rg_element_set_global_add_action()
{
  include(REGENERATE_THUMBNAILS_PATH.'element_set_global_action.php');
}

function add_regenerate_thumbnails_method($arr)
{
  include_once(REGENERATE_THUMBNAILS_PATH.'ws_functions.inc.php');
}

?>