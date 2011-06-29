<?php
/*
Plugin Name: Additional Pages
Version: 2.2.b
Description: Add additional pages in menubar.
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=153
Author: P@t
Author URI: http://www.gauchon.com
*/

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

global $prefixeTable, $conf;

define('AP_DIR' , basename(dirname(__FILE__)));
define('AP_PATH' , PHPWG_PLUGINS_PATH . AP_DIR . '/');
define('ADD_PAGES_TABLE' , $prefixeTable . 'additionalpages');

$conf['AP'] = @unserialize($conf['additional_pages']);

// Need upgrade?
if (!isset($conf['AP']['language_perm']))
  include(AP_PATH.'admin/upgrade.inc.php');

// Unset $conf['random_index_redirect'] if homepage is defined
if (!empty($conf['random_index_redirect']) and !is_null($conf['AP']['homepage']))
{
  $conf['ap_random_index_redirect'] = $conf['random_index_redirect'];
  $conf['random_index_redirect'] = array();
}

// Admin menu
function additional_pages_admin_menu($menu)
{
    array_push($menu, array(
      'NAME' => 'Additional Pages',
      'URL' => get_root_url().'admin.php?page=plugin-'.AP_DIR,
      )
    );
    return $menu;
}

// Section init
function section_init_additional_page()
{
  global $tokens, $conf, $page;

  if (defined('EXTENDED_DESC_PATH'))
  {
    add_event_handler('AP_render_content', 'get_extended_desc');
    add_event_handler('AP_render_title', 'get_user_language_desc');
  }

  $page['ap_homepage'] = (count($tokens) == 1 and empty($tokens[0]));

  if (($tokens[0] == 'page' and !empty($tokens[1])) or ($page['ap_homepage'] and !is_null($conf['AP']['homepage'])))
    include(AP_PATH . 'additional_page.php');

  if ($tokens[0] == 'additional_page' and !empty($tokens[1]))
    redirect(make_index_url(array('section'=>'page')).'/'.$tokens[1]);
}

// Menubar
function register_ap_menubar_blocks($menu_ref_arr)
{
  global $conf, $user;

  $menu = & $menu_ref_arr[0];
  if ($menu->get_id() != 'menubar') return;

  $conf['AP']['block_title'] = isset($conf['AP']['languages'][$user['language']]) ?
    $conf['AP']['languages'][$user['language']] : @$conf['AP']['languages']['default'];

  if (empty($conf['AP']['block_title']))
    $conf['AP']['block_title'] = 'Additional Pages';

  $menu->register_block( new RegisteredBlock( 'mbAdditionalPages', $conf['AP']['block_title'], 'Additional Pages'));
}

function ap_apply($menu_ref_arr)
{
  global $template, $conf, $user;

  $menu = & $menu_ref_arr[0];
  
  if ( ($block = $menu->get_block( 'mbAdditionalPages' ) ) != null )
  {
    $query = 'SELECT DISTINCT id, title, permalink
FROM ' . ADD_PAGES_TABLE . '
LEFT JOIN ' . USER_GROUP_TABLE . '
  ON user_id = '.$user['id'].'
WHERE (lang IS NULL OR lang = "'.$user['language'].'")
  AND (users IS NULL OR users LIKE "%'.$user['status'].'%")
  AND (groups IS NULL OR groups REGEXP CONCAT("(^|,)",group_id,"(,|$)"))
  AND level <= '.$user['level'].'
  AND pos >= 0
ORDER BY pos ASC
;';
    $result = pwg_query($query);
    $data = array();
    while ($row = pwg_db_fetch_assoc($result))
    {
      $url = make_index_url(array('section'=>'page')).'/'.(isset($row['permalink']) ? $row['permalink'] : $row['id']);
      array_push($data, array('URL' => $url, 'LABEL' => trigger_event('AP_render_title', $row['title'])));
    }

    if (!empty($data))
    {
      $template->set_template_dir(AP_PATH.'template/');
      $block->set_title($conf['AP']['block_title']);
      $block->template = 'menubar_additional_pages.tpl';
      $block->data = $data;
    }
  }
}

add_event_handler('get_admin_plugin_menu_links', 'additional_pages_admin_menu');
add_event_handler('loc_end_section_init', 'section_init_additional_page');
add_event_handler('blockmanager_register_blocks', 'register_ap_menubar_blocks');
add_event_handler('blockmanager_apply', 'ap_apply');

?>