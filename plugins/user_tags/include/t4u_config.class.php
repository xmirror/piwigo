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

class t4u_Config
{
    private 
      $config = array(), 
      $plugin_dir;

  public function __construct($plugin_dir, $plugin_name) {
    $this->plugin_dir = $plugin_dir;
    $this->plugin_name = $plugin_name;

    if (!file_exists($this->get_config_file_dir())) {
      mkgetdir($this->get_config_file_dir());
    }

    if (!file_exists($this->get_config_filename())) {
      $this->save_config();
    }
  }

  public function load_config() {
    $x = file_get_contents($this->get_config_filename());
    if ($x!==false) {
      $c = unserialize($x);
      $this->config = $c;
    }
    $this->setDefaults();
  }

  public function save_config() {
    file_put_contents($this->get_config_filename(), serialize($this->config));
  }

  private function get_config_file_dir() {
    return $GLOBALS['conf']['local_data_dir'].'/plugins/';
  }

  private function get_config_filename() {
    return $this->get_config_file_dir().basename($this->plugin_dir).'.dat';
  }

  public function __set($key, $value) {
    $this->config[$key] = $value;
  }

  public function __get($key) {
    return isset($this->config[$key])?$this->config[$key]:null;
  }

  public function setPermission($permission, $value) {
    $this->config['permissions'][$permission] = $value;
  }

  public function getPermission($permission) {
    return isset($this->config['permissions'][$permission])?$this->config['permissions'][$permission]:null;
  }


  public function hasPermission($permission='add') {
    return 
      (($this->getPermission($permission)!='')
       and is_autorize_status(get_access_type_status($this->getPermission($permission))));
  }

  public function plugin_admin_menu($menu) {
    array_push($menu,
	       array('NAME' => $this->plugin_name,
		     'URL' => get_admin_plugin_menu_link($this->plugin_dir.'/admin.php')		 
		     )
	       );
    return $menu;
  }

  public function get_admin_help($help_content, $page) {
    return load_language('help/'.$page.'.html', 
			 $this->plugin_dir .'/', 
			 array('return'=>true) 
			 );
  }
  
  public function getActionUrl($action, $method='POST') {
    $url = get_root_url().'admin.php?page=plugin';
    $file = basename($this->plugin_dir) . '/' .'admin.php';
    if (strtoupper($method)=='POST') {
	$url .= '&amp;section='.urlencode($file);
	$url .= '&amp;action='.urlencode($action);
    } else {
	$url .= '&section='.$file;
	$url .= '&action='.$action;
    }

    return $url;
  }

  private function setDefaults() {
    include_once $this->plugin_dir.'/include/default_values.inc.php';

    foreach ($default_values as $key => $value) {
      if (empty($this->config[$key])) {
	$this->config[$key] = $value;
      }
    }
  }
}
?>