<?php

/* -----------------------------------------------------------------------------
  class name     : GPCCore
  class version  : 1.4.0
  plugin version : 3.5.0
  date           : 2011-04-10
  ------------------------------------------------------------------------------
  author: grum at piwigo.org
  << May the Little SpaceFrog be with you >>
  ------------------------------------------------------------------------------

  :: HISTORY

| release | date       |
| 1.0.0   | 2010/03/30 | * Update class & function names
|         |            |
| 1.1.0   | 2010/03/30 | * add the BBtoHTML function
|         |            |
| 1.2.0   | 2010/07/28 | * add the loadConfigFromFile function
|         |            |
| 1.3.0   | 2010/10/13 | * add the addHeaderCSS, addHeaderJS functions
|         |            |
| 1.3.1   | 2010/10/20 | * applyHeaderItems functions implemented with an
|         |            |   higher priority on the 'loc_begin_page_header' event
|         |            |
|         |            | * implement the getUserLanguageDesc() function, using
|         |            |   extended description function if present
|         |            |
|         |            | * implement the getPiwigoSystemPath() function
|         |            |
|         |            | * implement the rmDir() function
|         |            |
| 1.3.2   | 2011/01/28 | * implement the addUI() function
|         |            |
|         |            | * implement getMinified() & setMinifiedState() functions
|         |            |
| 1.3.3   | 2011/02/01 | * fix bug on loadConfig() function
|         |            |
|         |            | * update deleteConfig() function (allow to be used to
|         |            |   delete the GPCCore config)
|         |            |
|         |            | * mantis bug:2167
|         |            |
| 1.3.4   | 2011/02/02 | * mantis bug:2170
|         |            |   . File path for RBuilder registered plugins is corrupted
|         |            |
|         |            | * mantis bug:2178
|         |            |   . RBuilder register function don't work
|         |            |
|         |            | * mantis bug:2179
|         |            |   . JS file loaded in wrong order made incompatibility
|         |            |     with Lightbox, GMaps & ASE plugins (and probably other)
|         |            |
| 1.4.0   | 2011/04/10 | * Updated for piwigo 2.2
|         |            |
|         |            |
|         |            |

  ------------------------------------------------------------------------------
    no constructor, only static function are provided
    - static function loadConfig
    - static function loadConfigFromFile
    - static function saveConfig
    - static function deleteConfig
    - static function getRegistered
    - static function getModulesInfos
    - static function register
    - static function unregister
    - static function BBtoHTML
    - static function addHeaderCSS
    - static function addHeaderJS
    - static function addUI
    - static function getMinified
    - static function setMinifiedState
    - static function getUserLanguageDesc
    - static function getPiwigoSystemPath
    - static function formatOctet
    - static function rmDir
   ---------------------------------------------------------------------- */



class GPCCore
{
  static private $piwigoSystemPath;
  static private $minified='.min';

  static public $pluginName = "GPCCore";
  static protected $headerItems = array(
    'css' => array(),
    'js'  => array()
  );

  static public function init()
  {
    self::$piwigoSystemPath=dirname(dirname(dirname(dirname(__FILE__))));
  }

  /* ---------------------------------------------------------------------------
   * grum plugin classes informations functions
   * -------------------------------------------------------------------------*/
  static public function getModulesInfos()
  {
    return(
      Array(
        Array('name' => "CommonPlugin", 'version' => "2.2.0"),
        Array('name' => "GPCAjax", 'version' => "3.0.0"),
        Array('name' => "GPCCategorySelector", 'version' => "1.0.1"),
        Array('name' => "GPCCore", 'version' => "1.4.0"),
        Array('name' => "GPCCss", 'version' => "3.1.0"),
        Array('name' => "GPCPagesNavigation", 'version' => "2.0.0"),
        Array('name' => "GPCPublicIntegration", 'version' => "2.0.0"),
        Array('name' => "GPCRequestBuilder", 'version' => "1.1.2"),
        Array('name' => "GPCTables", 'version' => "1.5.0"),
        Array('name' => "GPCTabSheet", 'version' => "1.1.1"),
        Array('name' => "GPCTranslate", 'version' => "2.1.1"),
        Array('name' => "GPCUsersGroups", 'version' => "2.1.0")
      )
    );
  }


  /* ---------------------------------------------------------------------------
   * register oriented functions
   * -------------------------------------------------------------------------*/

  /**
   * register a plugin using GPC
   *
   * @param String $pluginName : the plugin name
   * @param String $release : the plugin version like "2.0.0"
   * @param String $GPCNeed : the minimal version of GPC needed by the plugin to
   *                          work
   * @return Boolean : true if registering is Ok, otherwise false
   */
  static public function register($plugin, $release, $GPCneeded)
  {
    $config=Array();
    if(!self::loadConfig(self::$pluginName, $config))
    {
      $config['registered']=array();
    }

    $config['registered'][$plugin]=Array(
      'name' => $plugin,
      'release' => $release,
      'needed' => $GPCneeded,
      'date' => date("Y-m-d"),
    );
    return(self::saveConfig(self::$pluginName, $config));
  }

  /**
   * unregister a plugin using GPC
   *
   * assume that if the plugin was not registerd before, unregistering returns
   * a true value
   *
   * @param String $pluginName : the plugin name
   * @return Boolean : true if registering is Ok, otherwise false
   */
  static public function unregister($plugin)
  {
    $config=Array();
    if(self::loadConfig(self::$pluginName, $config))
    {
      if(array_key_exists('registered', $config))
      {
        if(array_key_exists($plugin, $config['registered']))
        {
          unset($config['registered'][$plugin]);
          return(self::saveConfig(self::$pluginName, $config));
        }
      }
    }
    // assume if the plugin was not registered before, unregistering it is OK
    return(true);
  }

  /**
   * @return Array : list of registered plugins
   */
  static public function getRegistered()
  {
    $config=Array();
    if(self::loadConfig(self::$pluginName, $config))
    {
      if(array_key_exists('registered', $config))
      {
        return($config['registered']);
      }
    }
    return(Array());
  }



  /* ---------------------------------------------------------------------------
   * config oriented functions
   * -------------------------------------------------------------------------*/

  /**
   *  load config from CONFIG_TABLE into an array
   *
   * @param String $pluginName : the plugin name, must contain only alphanumerical
   *                             character
   * @param Array $config : array, initialized or not with default values ; the
   *                        config values are loaded in this value
   * @return Boolean : true if config is loaded, otherwise false
   */
  static public function loadConfig($pluginName, &$config=Array())
  {
    global $conf;

    if(!isset($conf[$pluginName.'_config']))
    {
      return(false);
    }

    $configValues = unserialize($conf[$pluginName.'_config']);
    reset($configValues);
    while (list($key, $val) = each($configValues))
    {
      if(is_array($val))
      {
        foreach($val as $key2 => $val2)
        {
          $config[$key][$key2]=$val2;
        }
      }
      else
      {
        $config[$key] =$val;
      }
    }

    $conf[$pluginName.'_config']=serialize($config);

    return(true);
  }

  /**
   *  load config from a file into an array
   *
   *  note : the config file is a PHP file one var $conf used as an array,
   *  like the piwigo $conf var
   *
   * @param String $fileName : the file name
   * @param Array $config : array, initialized or not with default values ; the
   *                        config values are loaded in this value
   * @return Boolean : true if config is loaded, otherwise false
   */
  static public function loadConfigFromFile($fileName, &$config=Array())
  {
    $conf=array();

    if(!is_array($config) or !file_exists($fileName))
    {
      return(false);
    }

    include_once($fileName);

    foreach($conf as $key=>$val)
    {
      $config[$key]=$val;
    }
    return(true);
  }


  /**
   * save var $my_config into CONFIG_TABLE
   *
   * @param String $pluginName : the plugin name, must contain only alphanumerical
   *                             character
   * @param Array $config : array of configuration values
   * @return Boolean : true if config is saved, otherwise false
   */
  static public function saveConfig($pluginName, $config)
  {
    global $conf;

    $sql="REPLACE INTO ".CONFIG_TABLE."
           VALUES('".$pluginName."_config', '"
           .pwg_db_real_escape_string(serialize($config))."', '')";
    $result=pwg_query($sql);
    if($result)
    {
      $conf[$pluginName.'_config']=serialize($config);
      return true;
    }
    else
    {
      return false;
    }
  }

  /**
   * delete config from CONFIG_TABLE
   *
   * @param String $pluginName : the plugin name, must contain only alphanumerical
   *                             character ; if empty, assume GPCCore config
   * @return Boolean : true if config is deleted, otherwise false
   */
  static public function deleteConfig($pluginName='')
  {
    if($pluginName=='') $pluginName=self::$pluginName;
    $sql="DELETE FROM ".CONFIG_TABLE."
          WHERE param='".$pluginName."_config'";
    $result=pwg_query($sql);
    if($result)
    { return true; }
    else
    { return false; }
  }


  /**
   * convert (light) BB tag to HTML tag
   *
   * all BB codes are not recognized, only :
   *  - [ul] [/ul]
   *  - [li] [/li]
   *  - [b] [/b]
   *  - [i] [/i]
   *  - [url] [/url]
   *  - carriage return is replaced by a <br>
   *
   * @param String $text : text to convert
   * @return String : BB to HTML text
   */
  static public function BBtoHTML($text)
  {
    $patterns = Array(
      '/\[li\](.*?)\[\/li\]\n*/im',
      '/\[b\](.*?)\[\/b\]/ism',
      '/\[i\](.*?)\[\/i\]/ism',
      '/\[p\](.*?)\[\/p\]/ism',
      '/\[url\]([\w]+?:\/\/[^ \"\n\r\t<]*?)\[\/url\]/ism',
      '/\[url=([\w]+?:\/\/[^ \"\n\r\t<]*?)\](.*?)\[\/url\]/ism',
      '/\n{0,1}\[ul\]\n{0,1}/im',
      '/\n{0,1}\[\/ul\]\n{0,1}/im',
      '/\n{0,1}\[ol\]\n{0,1}/im',
      '/\n{0,1}\[\/ol\]\n{0,1}/im',
      '/\n/im',
    );
    $replacements = Array(
      '<li>\1</li>',
      '<b>\1</b>',
      '<i>\1</i>',
      '<p>\1</p>',
      '<a href="\1">\1</a>',
      '<a href="\1">\2</a>',
      '<ul>',
      '</ul>',
      '<ol>',
      '</ol>',
      '<br>',
    );

    return(preg_replace($patterns, $replacements, $text));
  }

  /**
   * used to add a css file in the header
   *
   * @param String $id : a unique id for the file
   * @param String $file : the css file
   */
  static public function addHeaderCSS($id, $file, $order=0)
  {
    global $template;

    if(!array_key_exists($file, self::$headerItems['css']))
    {
      self::$headerItems['css'][$id]=$file;
      $template->func_combine_css(array('path'=>$file, 'order'=>$order), $template->smarty);
    }
  }
  static public function addHeaderJS($id, $file, $require=array())
  {
    global $template;

    if(!array_key_exists($file, self::$headerItems['js']))
    {
      self::$headerItems['js'][$id]=$file;
      $template->scriptLoader->add($id, 'header', $require, $file, 0);
    }
  }

  /**
   * add a ui component ; css & js dependencies are managed
   *
   * @param Array $list : possibles values are
   *                        - inputCheckbox
   *                        - inputColorPicker
   *                        - inputColorsFB
   *                        - inputConsole
   *                        - inputDotArea
   *                        - inputList
   *                        - inputNum
   *                        - inputPosition
   *                        - inputRadio
   *                        - inputStatusBar
   *                        - inputText
   *                        - categorySelector
   */
  static public function addUI($list)
  {
    global $template;

    if(is_string($list)) $list=explode(',', $list);
    if(!is_array($list)) return(false);

    if(defined('IN_ADMIN'))
    {
      $themeFile=GPC_PATH.'css/%s_'.$template->get_themeconf('name').'.css';
    }
    else
    {
      $themeFile='themes/'.$template->get_themeconf('name').'/css/GPC%s.css';
    }

    foreach($list as $ui)
    {
      switch($ui)
      {
        case 'googleTranslate':
          self::addHeaderJS('google.jsapi', 'http://www.google.com/jsapi');
          self::addHeaderJS('gpc.googleTranslate', 'plugins/GrumPluginClasses/js/google_translate'.self::$minified.'.js', array('jquery', 'google.jsapi'));
        case 'categorySelector':
          self::addHeaderCSS('gpc.categorySelector', GPC_PATH.'css/categorySelector.css');
          self::addHeaderCSS('gpc.categorySelectorT', sprintf($themeFile, 'categorySelector'));
          self::addHeaderJS('gpc.categorySelector', GPC_PATH.'js/ui.categorySelector'.self::$minified.'.js', array('jquery'));
          break;
        case 'inputCheckbox':
          self::addHeaderCSS('gpc.inputCheckbox', GPC_PATH.'css/inputCheckbox.css');
          self::addHeaderJS('gpc.inputCheckbox', GPC_PATH.'js/ui.inputCheckbox'.self::$minified.'.js', array('jquery'));
          break;
        case 'inputColorPicker':
          self::addHeaderCSS('gpc.inputText', GPC_PATH.'css/inputText.css');
          self::addHeaderCSS('gpc.inputNum', GPC_PATH.'css/inputNum.css');
          self::addHeaderCSS('gpc.inputColorsFB', GPC_PATH.'css/inputColorsFB.css');
          self::addHeaderCSS('gpc.inputDotArea', GPC_PATH.'css/inputDotArea.css');
          self::addHeaderCSS('gpc.inputColorPicker', GPC_PATH.'css/inputColorPicker.css');
          self::addHeaderCSS('gpc.inputTextT', sprintf($themeFile, 'inputText'));
          self::addHeaderCSS('gpc.inputNumT', sprintf($themeFile, 'inputNum'));
          self::addHeaderCSS('gpc.inputColorsFBT', sprintf($themeFile, 'inputColorsFB'));
          self::addHeaderCSS('gpc.inputDotAreaT', sprintf($themeFile, 'inputDotArea'));
          self::addHeaderCSS('gpc.inputColorPickerT', sprintf($themeFile, 'inputColorPicker'));
          self::addHeaderJS('jquery.ui', 'themes/default/js/ui/minified/jquery.ui.core.min.js', array('jquery'));
          self::addHeaderJS('jquery.ui.slider', 'themes/default/js/ui/minified/jquery.ui.slider.min.js', array('jquery.ui'));
          self::addHeaderJS('jquery.ui.draggable', 'themes/default/js/ui/minified/jquery.ui.draggable.min.js', array('jquery.ui'));
          self::addHeaderJS('jquery.ui.dialog', 'themes/default/js/ui/minified/jquery.ui.slider.dialog.js', array('jquery.ui'));
          self::addHeaderJS('gpc.inputText', GPC_PATH.'js/ui.inputText'.self::$minified.'.js', array('jquery'));
          self::addHeaderJS('gpc.inputNum', GPC_PATH.'js/ui.inputNum'.self::$minified.'.js', array('jquery'));
          self::addHeaderJS('gpc.inputColorsFB', GPC_PATH.'js/ui.inputColorsFB'.self::$minified.'.js', array('jquery'));
          self::addHeaderJS('gpc.inputDotArea', GPC_PATH.'js/ui.inputDotArea'.self::$minified.'.js', array('jquery'));
          self::addHeaderJS('gpc.inputColorPicker', GPC_PATH.'js/ui.inputColorPicker'.self::$minified.'.js', array('jquery.ui.slider','gpc.inputText','gpc.inputNum','gpc.inputColorsFB','gpc.inputDotArea'));
          break;
        case 'inputColorsFB':
          self::addHeaderCSS('gpc.inputColorsFB', GPC_PATH.'css/inputColorsFB.css');
          self::addHeaderCSS('gpc.inputColorsFBT', sprintf($themeFile, 'inputColorsFB'));
          self::addHeaderJS('gpc.inputColorsFB', GPC_PATH.'js/ui.inputColorsFB'.self::$minified.'.js', array('jquery'));
          break;
        case 'inputConsole':
          self::addHeaderCSS('gpc.inputConsole', GPC_PATH.'css/inputConsole.css');
          self::addHeaderCSS('gpc.inputConsoleT', sprintf($themeFile, 'inputConsole'));
          self::addHeaderJS('gpc.inputConsole', GPC_PATH.'js/ui.inputConsole'.self::$minified.'.js', array('jquery'));
          break;
        case 'inputDotArea':
          self::addHeaderCSS('gpc.inputDotArea', GPC_PATH.'css/inputDotArea.css');
          self::addHeaderCSS('gpc.inputDotAreaT', sprintf($themeFile, 'inputDotArea'));
          self::addHeaderJS('gpc.inputDotArea', GPC_PATH.'js/ui.inputDotArea'.self::$minified.'.js', array('jquery'));
          break;
        case 'inputList':
          self::addHeaderCSS('gpc.inputList', GPC_PATH.'css/inputList.css');
          self::addHeaderCSS('gpc.inputListT', sprintf($themeFile, 'inputList'));
          self::addHeaderJS('gpc.inputList', GPC_PATH.'js/ui.inputList'.self::$minified.'.js', array('jquery'));
          break;
        case 'inputNum':
          self::addHeaderCSS('gpc.inputNum', GPC_PATH.'css/inputNum.css');
          self::addHeaderCSS('gpc.inputNumT', sprintf($themeFile, 'inputNum'));
          self::addHeaderJS('jquery.ui', 'themes/default/js/ui/minified/jquery.ui.core.min.js', array('jquery'));
          self::addHeaderJS('jquery.ui.slider', 'themes/default/js/ui/minified/jquery.ui.slider.min.js', array('jquery.ui'));
          self::addHeaderJS('gpc.inputNum', GPC_PATH.'js/ui.inputNum'.self::$minified.'.js', array('jquery','jquery.ui.slider'));
          break;
        case 'inputPosition':
          self::addHeaderCSS('gpc.inputPosition', GPC_PATH.'css/inputPosition.css');
          self::addHeaderCSS('gpc.inputPositionT', sprintf($themeFile, 'inputPosition'));
          self::addHeaderJS('gpc.inputPosition', GPC_PATH.'js/ui.inputPosition'.self::$minified.'.js', array('jquery'));
          break;
        case 'inputRadio':
          self::addHeaderJS('gpc.inputRadio', GPC_PATH.'js/ui.inputRadio'.self::$minified.'.js', array('jquery'));
          break;
        case 'inputStatusBar':
          self::addHeaderCSS('gpc.inputStatusBar', GPC_PATH.'css/inputStatusBar.css');
          self::addHeaderCSS('gpc.inputStatusBarT', sprintf($themeFile, 'inputStatusBar'));
          self::addHeaderJS('gpc.inputStatusBar', GPC_PATH.'js/ui.inputStatusBar'.self::$minified.'.js', array('jquery'));
          break;
        case 'inputText':
          self::addHeaderCSS('gpc.inputText', GPC_PATH.'css/inputText.css');
          self::addHeaderCSS('gpc.inputTextT', sprintf($themeFile, 'inputText'));
          self::addHeaderJS('gpc.inputText', GPC_PATH.'js/ui.inputText'.self::$minified.'.js', array('jquery'));
          break;
      }
    }
  }

  /**
   * return the minified value
   *
   * @return String
   */
  static public function getMinified()
  {
    return(self::$minified);
  }

  /**
   * set the minified state
   *
   * @param Bool $state
   * @return Bool
   */
  static public function setMinifiedState($state)
  {
    if($state)
    {
      self::$minified='.min';
    }
    else
    {
      self::$minified='';
    }
    return(self::$minified!='');
  }


  /**
   * use the extended description get_user_language_desc() function if exist
   * otherwise returns the value
   *
   * @param String $value : value to translate
   * @return String : translated value
   */
  static public function getUserLanguageDesc($value)
  {
    if(function_exists('get_user_language_desc'))
    {
      return(get_user_language_desc($value));
    }
    else
    {
      return($value);
    }
  }


  /**
   * remove a path recursively
   *
   * @param String $directory : directory to remove
   * @param Bool $removePath : if set to true, remove the path himself, if set
   *                           to false, remove only file & sub-directories
   * @return Bool : true if directory was succesfully removed, otherwise false
   */
  static public function rmDir($directory, $removePath=true)
  {
    $directory=rtrim($directory, '\/').'/';
    $returned=true;
    if(file_exists($directory) and is_dir($directory) and $directory!='./' and $directory!='../')
    {
      $dhandle=scandir($directory);
      foreach($dhandle as $file)
      {
        if($file!='.' and $file!='..' )
        {
          if(is_dir($directory.$file))
          {
            $returned=self::rmDir($directory.$file, true) & $returned;
          }
          else
          {
            $returned=unlink($directory.$file) & $returned;
          }
        }
      }
      if($returned and $removePath) $returned=rmdir($directory);
    }
    return($returned);
  }


  /**
   * returns the piwigo system path
   * @return String
   */
  static public function getPiwigoSystemPath()
  {
    return(self::$piwigoSystemPath);
  }


 /**
  * formats a file size into a human readable size
  *
  * @param String $format : "A"  : auto
  *                         "Ai" : auto (io)
  *                         "O"  : o
  *                         "K"  : Ko
  *                         "M"  : Mo
  *                         "G"  : Go
  *                         "Ki" : Kio
  *                         "Mi" : Mio
  *                         "Gi" : Gio
  * @param String $thsep : thousand separator
  * @param Integer $prec : number of decimals
  * @param Bool $visible : display or not the unit
  * @return String : a formatted file size
  */
 static public function formatOctet($octets, $format="Ai", $thsep="", $prec=2, $visible=true)
 {
  if($format=="Ai")
  {
   if($octets<1024)
   { $format="O"; }
   elseif($octets<1024000)
   { $format="Ki"; }
   elseif($octets<1024000000)
   { $format="Mi"; }
   else
   { $format="Gi"; }
  }
  elseif($format=="A")
  {
   if($octets<1000)
   { $format="O"; }
   elseif($octets<1000000)
   { $format="Ki"; }
   elseif($octets<1000000000)
   { $format="Mi"; }
   else
   { $format="Gi"; }
  }

  switch($format)
  {
   case "O":
    $unit="o"; $div=1;
    break;
   case "K":
    $unit="Ko"; $div=1000;
    break;
   case "M":
    $unit="Mo"; $div=1000000;
    break;
   case "G":
    $unit="Go"; $div=1000000000;
    break;
   case "Ki":
    $unit="Kio"; $div=1024;
    break;
   case "Mi":
    $unit="Mio"; $div=1024000;
    break;
   case "Gi":
    $unit="Gio"; $div=1024000000;
    break;
  }

  $returned=number_format($octets/$div, $prec, '.', $thsep);
  if($visible) $returned.=' '.$unit;
  return($returned);
 } //function formatOctet


} //class

//add_event_handler('loc_begin_page_header', array('GPCCore', 'applyHeaderItems'), 10);

GPCCore::init();

?>
