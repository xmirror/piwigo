<?php /*
Plugin Name: RV Menu Tree
Version: 2.2.a
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=238
Description: Replaces the categories in the menu bar with a nicer one (javascript).
Author: rvelices
Author URI: http://www.modusoptimus.com
*/

add_event_handler('get_categories_menu_sql_where', 'rv_mt_get_categories_menu_sql_where', EVENT_HANDLER_PRIORITY_NEUTRAL, 3 );

function rv_mt_get_categories_menu_sql_where($where, $expand, $filter)
{
	add_event_handler('blockmanager_apply', 'rv_mt_menubar_categories');

	if ($expand or $filter)
		return $where;

	global $page;
	if ( !isset($page['category']) )
		$where = 'id_uppercat IS NULL OR uppercats REGEXP \'^[0-9]+,[0-9]+$\'';
	else
	{
		$where = 'id_uppercat is NULL
  OR uppercats LIKE "'.$page['category']['upper_names'][0]['id'].',%"
  OR uppercats REGEXP \'^[0-9]+,[0-9]+$\'';
	}
	return $where;
}

function rv_mt_menubar_categories($menu_ref_arr)
{
	$menu = & $menu_ref_arr[0];

	if (($block = $menu->get_block('mbCategories')) != null)
	{
		global $template, $page;

		$rvmt_base_name  = basename(dirname(__FILE__));
		$template->set_template_dir(PHPWG_ROOT_PATH.'plugins/'.$rvmt_base_name.'/template/');
		$template->assign(array(
			'RVMT_BASE_NAME' => $rvmt_base_name,
			'RVMT_UPPER_IDS' => isset($page['category']['uppercats']) ? array_flip( explode(',', $page['category']['uppercats'])) : null,
			)
		);
		$block->template = 'rv_menutree_categories.tpl';
	}
}
?>