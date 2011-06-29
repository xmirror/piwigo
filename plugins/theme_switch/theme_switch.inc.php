<?php
// +-----------------------------------------------------------------------+
// | Piwigo - a PHP based picture gallery                                  |
// | Theme switch plugin                                                   |
// +-----------------------------------------------------------------------+
// | Copyright(C) 2010      Pavel Budka               http://budkovi.ic.cz |
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
// | Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, |
// | USA.                                                                  |
// +-----------------------------------------------------------------------+
if (!defined('THEME_SWITCH_PATH'))
define('THEME_SWITCH_PATH' , PHPWG_PLUGINS_PATH . basename(dirname(__FILE__)) . '/');

include_once(PHPWG_ROOT_PATH.'admin/include/themes.class.php');

class theme_controler {
static public function _switch()
{
  global $user, $template, $conf;

  load_language('plugin.lang', dirname(__FILE__).'/');

  if (!defined('PHPWG_ROOT_PATH')) { die('Hacking attempt!'); }
  $same = $user['theme'];
  if ( isset( $_GET['theme']) ) 
  {
    if ( !empty($_GET['theme']) and
      file_exists( PHPWG_ROOT_PATH.'themes/'.$_GET['theme']) )
    {
      if (is_a_guest() or is_generic())
        setcookie( 'pwg_theme_switch', $_GET['theme'],
          time()+60*60*24*30, cookie_path() );
      else
      {
        $query = 'UPDATE '.USER_INFOS_TABLE.'
        SET theme = \''.$_GET['theme'].'\'
        WHERE user_id = '.$user['id'].'
        ;';
        pwg_query($query);
      }
      $user['theme'] = $_GET['theme'];
    }
  }
  else
  // Users have $user['template']/$user['theme'] 
  // Guest or generic members will use their cookied $user['template']/$user['theme'] !
  if ((is_a_guest() or is_generic())
    and isset( $_COOKIE['pwg_theme_switch'] ) )
  {
    $user['theme'] = $_COOKIE['pwg_theme_switch'];
  }
} // function _switch()

static public function _installed_themes()
// id, name, screenshot  
{
$themes = new themes();
$themes->sort_fs_themes();
$db_themes = $themes->get_db_themes();
$db_theme_ids = array();
foreach ($db_themes as $db_theme)
{
  array_push($db_theme_ids, $db_theme['id']);
}

$active_themes = array();


foreach ($themes->fs_themes as $theme_id => $fs_theme)
{
  if (in_array($theme_id, $db_theme_ids))
      array_push($active_themes, $fs_theme);
}

return $active_themes;
} // function  _installed_themes()


static public function _flags()
// Lets user choose from icons 
// Only themes which have gif icon provided in icons plugin directory will be provided to users.
// Gif file name must be the same as theme's name and must be stored in sub directory named according to template's name.  
{
  global $user, $template, $conf, $lang;
  
  $available_theme = get_pwg_themes();

  $url_starting = get_query_string_diff(array('theme'));
  
  foreach ( theme_controler::_installed_themes() as $theme ) {
    $qlc_img =  $theme['screenshot']; // $conf['themes_dir'].'/'.$theme_id.'/'.'screenshot.png';
         
    if (file_exists($qlc_img)) {
      
      $qlc_url = str_replace(array('=&amp;','?&amp;'),array('&amp;','?'),
                 add_url_params( $url_starting, array( 'theme' => $theme['id'] )));
      if (isset($lang['theme']))
        $qlc_alt = $lang['theme'].' '.ucwords( $theme['name'] );
      else
        $qlc_alt = ucwords( $theme['name'] );
      $qlc_title =  $qlc_alt;
      $qlc = array ( 
        'url' => $qlc_url,
        'alt' => $qlc_alt,
        'img' => $qlc_img,
        );
      if ( $theme['id'] !== $user['theme'])
        $lsw['flags'][$theme['id']] = $qlc ;
      else $lsw['Active'] = $qlc;
      }
  } 
    
  $template->set_filename('theme_flags', dirname(__FILE__) . '/flags.tpl');
  $lsw['side'] = ceil(sqrt(count($available_theme)));
  $template->assign(array(
    'theme_switch'=> $lsw,
    'THEME_SWITCH_PATH' => THEME_SWITCH_PATH,
  ));
  $flags = $template->parse('theme_flags',true);
  $template->clear_assign('theme_switch');
  $template->concat( 'PLUGIN_INDEX_ACTIONS', $flags);
} // function _flags()


static public function _select()
// Lets user choose using select control 
// All available themes will be provided to users. 
{
  global $user, $template, $lang;
  
  $available_theme = get_pwg_themes();
  $url_starting = get_query_string_diff(array('theme'));
  $options='<li class="selector">'
   .$lang['theme'].
    '&nbsp;<select onchange="javasript:window.location=this.value">';
  foreach ( theme_controler::_installed_themes() as $theme )
  {
    $qlc_url = str_replace(array('=&amp;','?&amp;'),array('&amp;','?'),
      add_url_params( $url_starting, array( 'theme' => $theme['id']  ) ));
    
    if ( $theme['id'] == $user['theme'] )
      $tmp='" selected="selected">';
    else
      $tmp='">';
    $options=$options.'
    <option label="'.$theme['name'].'" value="'.$qlc_url.$tmp.$theme['name'].'</option>';
  }
  $options=$options.'
  </select></li>';
  $template->concat( 'PLUGIN_INDEX_ACTIONS',$options);
} //  function _select() 

static public function _theme_admin($menu)
// adds menu options for future configuration 
{
//  load_language('plugin.lang', dirname(__FILE__).'/');
  array_push($menu, array('NAME' => 'Theme Switch',
    'URL' => get_admin_plugin_menu_link(THEME_SWITCH_PATH.'admin/admin.php')));
  return $menu;
} // function _theme_admin()

} // class theme_controler

  /* {html_head} usage function */
  /* See flags.tpl for example (due no catenation available) */
if (!function_exists('Componant_exists')) {
  function Componant_exists($path, $file)
    { return file_exists( $path . $file); }
}

?>
