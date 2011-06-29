<?php
/* -----------------------------------------------------------------------------
  class name: CommonPlugin
  class version  : 2.2.0
  plugin version : 3.2.0
  date           : 2010-07-28

  ------------------------------------------------------------------------------
  Author     : Grum
    email    : grum@piwigo.org
    website  : http://photos.grum.fr
    PWG user : http://forum.phpwebgallery.net/profile.php?id=3706

    << May the Little SpaceFrog be with you ! >>
  ------------------------------------------------------------------------------

  this class provides base functions to manage a plugin
  public
    ADMINISTRATION RELATED
    - manage()
    - pluginAdminMenu($menu)
    INITIALIZATION RELATED
    - initEvents()
    CONFIG RELATED
    - getFileLocation()
    - getAdminLink()
    - initConfig()
    - loadConfig()
    - loadConfigFromFile()
    - saveConfig()
    - deleteConfig()

  protected
    INITIALIZATION RELATED
    - setTablesList($list)
  ------------------------------------------------------------------------------
  :: HISTORY

| release | date       |
| 2.0.0   | 2008/07/13 | * migrate to piwigo 2.0
|         |            | * use of PHP5 classes possibilities
|         |            |
| 2.0.1   | 2009/07/24 | * config loader : better management for arrays items
|         |            |
| 2.1.0   | 2010/03/28 | * Uses piwigo pwg_db_* functions instead of mysql_*
|         |            |   functions
|         |            | * Update class & function names
|         |            |
| 2.2.0   | 2010/09/18 | * Add the loadConfigFromFile function
|         |            | * Change parameters mode for the checkGPCRelease
|         |            |   function
|         |            |
|         |            |
|         |            |

  --------------------------------------------------------------------------- */

include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/gpc_version.inc.php'); // => Don't forget to update this file !!
include_once('GPCCore.class.inc.php');

class CommonPlugin
{
  private $prefixeTable;  // prefixe for tables names
  private $page_link; //link to admin page
  private $fileLocation; //files plugin location on server
  private $displayResult_ok;
  private $displayResult_ko;
  private $plugin_name;   // used for interface display
  private $plugin_name_files;   // used for files
  private $plugin_admin_file = "plugin_admin";
  private $debug_file;
  protected $tables;   // list of all tables names used by plugin
  public $config;     // array of config parameters


  /**
   * this function return true if class release if greater or equal than needed
   * by the plugin
   *
   * the function can be called :
   *   - with 1 String parameter   : checkGPCRelease("3.2.0")
   *                                 => implemented with the release 3.2.0, this
   *                                    is the new method recommanded to use
   *   - with 3 Integer parameters : checkGPCRelease(3,2,0)
   *                                 => this method is kept for older plugin
   *                                    compatibility but it's not recommanded
   *                                    to use it anymore
   *
   * @param String $neededRelease : the needed release
   * @return Boolean : true if the current release is greater or equal than the
   *                   needed release
   *
   * old calling method :
   * @param Integer $neededRelease : the major release
   * @param Integer $minor :
   * @param Integer $minor2 :
   * @return Boolean;
   */
  static public function checkGPCRelease($neededRelease=0, $minor=0, $minor2=0)
  {
    $currentRelease = explode(".", GPC_VERSION);

    if(is_string($neededRelease))
    {
      $neededRelease=explode('.', $neededRelease);
      $major=$neededRelease[0];
      $minor=$neededRelease[1];
      $minor2=$neededRelease[2];
    }
    else
    {
      $major=$neededRelease;
    }

    if(($currentRelease[0]>$major) ||
       ($currentRelease[0]==$major)&&($currentRelease[1]>$minor) ||
       ($currentRelease[0]==$major)&&($currentRelease[1]==$minor)&&($currentRelease[2]>=$minor2))
    {
      return(true);
    }
    return(false);
  }

  /* constructor allows to initialize $prefixeTable value */
  public function __construct($prefixeTable, $filelocation)
  {
    $this->debug_file=GPCCore::getPiwigoSystemPath()."/_data/debug.txt";

    $this->fileLocation=$filelocation;
    $this->prefixeTable=$prefixeTable;
    $this->page_link="admin.php?page=plugin&section=".basename(dirname($this->getFileLocation()))."/admin/".$this->plugin_admin_file.".php";
    $this->initConfig();
    $this->displayResult_ok="OK";
    $this->displayResult_ko="KO";
  }

  public function __destruct()
  {
    unset($this->prefixeTable);
    unset($this->page_link);
    unset($this->fileLocation);
    unset($this->displayResult_ok);
    unset($this->displayResult_ko);
    unset($this->plugin_name);
    unset($this->plugin_name_files);
    unset($this->tables);
    unset($this->debug_file);
    unset($this->config);
  }

  public function getFileLocation()
  {
    return($this->fileLocation);
  }

  public function getAdminLink()
  {
    return($this->page_link);
  }

  public function setAdminLink($link)
  {
    $this->page_link=$link;
    return($this->page_link);
  }

  public function setPluginName($name)
  {
    $this->plugin_name=$name;
    return($this->plugin_name);
  }

  public function setPluginNameFiles($name)
  {
    $this->plugin_name_files=$name;
    return($this->plugin_name_files);
  }

  public function getPluginName()
  {
    return($this->plugin_name);
  }

  public function getPluginNameFiles()
  {
    return($this->plugin_name_files);
  }

  /* ---------------------------------------------------------------------------
     CONFIGURATION RELATED FUNCTIONS
  --------------------------------------------------------------------------- */

  /* this function initialize var $config with default values */
  public function initConfig()
  {
    $this->config=array();
  }

  /* load config from CONFIG_TABLE into var $my_config */
  public function loadConfig()
  {
    $this->initConfig();
    return(GPCCore::loadConfig($this->plugin_name_files, $this->config));
  }

  /**
   * load config from a file into var $my_config
   *
   * this function don't initialize the default value !
   * if needed, use the loadConfig() function before using it
   *
   * @param String $fileName : name of file to load
   */
  public function loadConfigFromFile($fileName)
  {
    return(GPCCore::loadConfigFromFile($fileName, $this->config));
  }

  /* save var $my_config into CONFIG_TABLE */
  public function saveConfig()
  {
    return(GPCCore::saveConfig($this->plugin_name_files, $this->config));
  }

  /* delete config from CONFIG_TABLE */
  public function deleteConfig()
  {
    return(GPCCore::deleteConfig($this->plugin_name_files));
  }

  /* ---------------------------------------------------------------------------
     PLUGIN INITIALIZATION RELATED FUNCTIONS
  --------------------------------------------------------------------------- */

  /*
      initialize tables list used by the plugin
        $list = array('table1', 'table2')
        $this->tables_list['table1'] = $prefixeTable.$plugin_name.'_table1'
  */
  protected function setTablesList($list)
  {
    for($i=0;$i<count($list);$i++)
    {
      $this->tables[$list[$i]]=$this->prefixeTable.$this->plugin_name_files.'_'.$list[$i];
    }
  }

  /* ---------------------------------------------------------------------------
     ADMINISTRATOR CONSOLE RELATED FUNCTIONS
  --------------------------------------------------------------------------- */

  /* add plugin into administration menu */
  public function pluginAdminMenu($menu)
  {
    array_push($menu,
               array(
                  'NAME' => $this->plugin_name,
                  'URL' => get_admin_plugin_menu_link(dirname($this->getFileLocation()).
                                '/admin/'.$this->plugin_admin_file.'.php')
                   ));
    return $menu;
  }

  /*
    manage plugin integration into piwigo's admin interface

    to be surcharged by child's classes
  */
  public function manage()
  {
  }

  /*
    initialize plugin's events
    to be surcharged by child's classes
  */
  public function initEvents()
  {
  }

  protected function debug($text, $rewrite=false)
  {
    if($rewrite)
    {
      $fhandle=fopen($this->debug_file, "w");
    }
    else
    {
      $fhandle=fopen($this->debug_file, "a");
    }

    if($fhandle)
    {
      fwrite($fhandle, date("Y-m-d h:i:s")." [".$this->plugin_name."] : ".print_r($text,true).chr(10));
      fclose($fhandle);
    }
  }

  /*
    manage infos & errors display
  */
  protected function displayResult($action_msg, $result)
  {
    global $page;

    if($result)
    {
      array_push($page['infos'], $action_msg);
      array_push($page['infos'], $this->displayResult_ok);
    }
    else
    {
      array_push($page['errors'], $action_msg);
      array_push($page['errors'], $this->displayResult_ko);
    }
  }
} //class CommonPlugin

?>
