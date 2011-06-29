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

class t4u_Content
{
  public function __construct($config) {
    $this->plugin_config = &$config;
  }

  public function render_element_content($content, $picture) {
    global $template;

    if (!$this->plugin_config->hasPermission('add')) {
      return false;
    }

    $template->assign('T4U_JS', T4U_JS);
    $template->assign('T4U_CSS', T4U_CSS);
    $template->assign('T4U_IMGS', T4U_IMGS);
    $template->assign('T4U_ADD_SCRIPT', $this->plugin_config->getActionUrl('add', 'GET'));
    $template->assign('T4U_GET_SCRIPT', $this->plugin_config->getActionUrl('get', 'GET'));
    $template->assign('T4U_IMAGE_ID', $picture['id']);
    $template->assign('T4U_REFERER', urlencode($picture['url']));
    $template->assign('T4U_PERMISSION_DELETE', $this->plugin_config->hasPermission('delete'));

    $related_tags = array();
    if (!empty($template->smarty->_tpl_vars['related_tags'])) {
      foreach ($template->smarty->_tpl_vars['related_tags'] as $id => $tag_infos) {
	$related_tags['~~'.$tag_infos['id'].'~~'] = $tag_infos['name']; 
      }
    }
    $template->assign('T4U_RELATED_TAGS', $related_tags);

    $template->set_filename('add_tags', T4U_TEMPLATE.'/add_tags.tpl');
    $template->assign_var_from_handle('PLUGIN_PICTURE_BEFORE', 'add_tags');

    return $content;
  }
}
?>