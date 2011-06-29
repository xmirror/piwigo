<?php
global $prefixeTable;
if (!defined('CL_AUTOSIZE_TABLE')) define('CL_AUTOSIZE_TABLE', $prefixeTable.'cl_autosize');
		$path = AUTOSIZE_PATH;
          $plg_data = implode( '', file($path.'main.inc.php') );
          if ( preg_match("|Plugin Name: (.*)|", $plg_data, $val) )
          {
            $conflit_plugin['name'] = trim( $val[1] );
          }
          if (preg_match("|Version: (.*)|", $plg_data, $val))
          {
            $conflit_plugin['version'] = trim($val[1]);
          }
          if ( preg_match("|Plugin URI: (.*)|", $plg_data, $val) )
          {
            $conflit_plugin['uri'] = trim($val[1]);
          }
          if ($desc = load_language('description.txt', $path.'/', array('return' => true)))
          {
            $conflit_plugin['description'] = trim($desc);
          }
          elseif ( preg_match("|Description: (.*)|", $plg_data, $val) )
          {
            $conflit_plugin['description'] = trim($val[1]);
          }
          if ( preg_match("|Author: (.*)|", $plg_data, $val) )
          {
            $conflit_plugin['author'] = trim($val[1]);
          }
          if ( preg_match("|Author URI: (.*)|", $plg_data, $val) )
          {
            $conflit_plugin['author uri'] = trim($val[1]);
          }
          if (!empty($conflit_plugin['uri']) and strpos($conflit_plugin['uri'] , 'extension_view.php?eid='))
          {
            list( , $extension) = explode('extension_view.php?eid=', $conflit_plugin['uri']);
            if (is_numeric($extension)) $conflit_plugin['extension'] = $extension;
          }
          // IMPORTANT SECURITY !
          $conflit_plugin = array_map('htmlspecialchars', $conflit_plugin);

global $cl_plugin, $cl_version;
 $cl_version = $conflit_plugin['version'] ;
 $cl_plugin  = $conflit_plugin;
 
?>