<?php
/* -----------------------------------------------------------------------------
  class name: GCPRequestBuilder
  class version  : 1.1.6
  plugin version : 3.5.1
  date           : 2011-05-15

  ------------------------------------------------------------------------------
  Author     : Grum
    email    : grum@piwigo.org
    website  : http://photos.grum.com
    PWG user : http://forum.phpwebgallery.net/profile.php?id=3706

    << May the Little SpaceFrog be with you ! >>
  ------------------------------------------------------------------------------
  *
  * theses classes provides base functions to manage search pictures in the
  * database
  *
  *
  * HOW TO USE IT ?
  * ===============
  *
  * when installing the plugin, you have to register the usage of the request
  * builder
  *
  * 1/ Create a RBCallback class
  *  - extends the GPCSearchCallback class ; the name of the extended class must
  *    be "RBCallBack%" => replace the "%" by the plugin name
  *     for example : 'ThePlugin' => 'RBCallBackThePlugin'
  *
  * 2/ In the plugin 'maintain.inc.php' file :
  *  - function plugin_install, add :
  *       GPCRequestBuilder::register('plugin name', 'path to the RBCallback classe');
  *          for example : GPCRequestBuilder::register('ThePlugin', $piwigo_path.'plugins/ThePlugin/rbcallback_file_name.php');
  *
  *
  *  - function plugin_uninstall, add :
  *       GPCRequestBuilder::unregister('plugin name');
  *          for example : GPCRequestBuilder::unregister('ThePlugin');
  *
  * 3/ In the plugin code, put somewhere
  *     GPCRequestBuilder::loadJSandCSS();
  *     => this will load specific JS and CSS in the page, by adding url in the
  *        the header, so try to put this where you're used to prepare the header
  *
  * 4/ to display the request builder, just add the returned string in the html
  *    page
  *       $stringForTheTemplate=GPCRequestBuilder::displaySearchPage();
  *
  *
  *
  * HOW DOES THE REQUEST BUILDER WORKS ?
  * ====================================
  *
  * the request builder works in 2 steps :
  *  - first step  : build a cache, to associate all image id corresponding to
  *                  the search criterion
  *                  the cache is an association of request ID/image id
  *  - second step : use the cache to retrieve images informations
  *
  ------------------------------------------------------------------------------
  :: HISTORY

| release | date       |
| 1.0.0   | 2010/04/30 | * start coding
|         |            |
| 1.1.0   | 2010/09/08 | * add functionnalities to manage complex requests
|         |            |
| 1.1.1   | 2010/10/14 | * fix bug on the buildGroupRequest function
|         |            |   . adding 'DISTINCT' keyword to the SQL requests
|         |            |
|         |            | * ajax management moved into the gpc_ajax.php file
|         |            |
|         |            | * fix bug on user level access to picture
|         |            |
| 1.1.2   | 2010/11/01 | * mantis bug:1984
|         |            |   . RBuilder returns an error message when one picture
|         |            |     have multiple categories
|         |            |
| 1.1.3   | 2011/01/31 | * mantis bug:2156
|         |            |   . undefined variable on RBuilder screens
|         |            |
| 1.1.4   | 2011/01/31 | * mantis bug:2167
|         |            |
| 1.1.5   | 2011/04/10 | * Compatibility with piwigo 2.2
|         |            |
| 1.1.6   | 2011/05/15 | * mantis bug:2302
|         |            |   . Request builder user interface don't work
|         |            |
|         |            |
|         |            |
|         |            |

  --------------------------------------------------------------------------- */

if(!defined('GPC_DIR')) define('GPC_DIR' , baseName(dirname(dirname(__FILE__))));
if(!defined('GPC_PATH')) define('GPC_PATH' , PHPWG_PLUGINS_PATH . GPC_DIR . '/');

include_once('GPCTables.class.inc.php');

/**
 *
 * Preparing the temporary table => doCache()
 * ------------------------------------------
 * To prepare the cache, the request builder use the following functions :
 *  - getImageId
 *  - getFrom
 *  - getWhere
 *  - getHaving
 *
 * Preparing the cache table => doCache()
 * --------------------------------------
 * To prepare the cache, the request builder use the following functions :
 *  => the getFilter function is used to prepare the filter for the getPage()
 *     function ; not used to build the cache
 *
 * Retrieving the results => getPage()
 * -----------------------------------
 * To retrieve the image informations, the request builder uses the following
 * functions :
 *  - getSelect
 *  - getFrom
 *  - getJoin
 *  - getFilter (in fact, the result of this function is stored by the doCache()
 *               function while the cache is builded, but it is used only when
 *               retrieving the results for multirecord tables)
 *  - formatData
 *
 *
 * Example
 * -------
 * Consider the table "tableA" like this
 *
 *  - (*) imageId
 *  - (*) localId
 *  -     att1
 *  -     att2
 *  The primary key is the 'imageId'+'localId' attributes
 *    => for one imageId, you can have ZERO or more than ONE record
 *       when you register the class, you have to set the $multiRecord parameter
 *       to 'y'
 *
 *  gatImageId returns      : "tableA.imageId"
 *  getSelect returns       : "tableA.att1, tableA.att2"
 *  getFrom returns         : "tableA"
 *  getWhere returns        : "tableA.localId= xxxx AND tableA.att1 = zzzz"
 *  getJoin returns         : "tableA.imageId = pit.id"
 *  getFilter returns       : "tableA.localId= xxxx"
 *
 *  Examples :
 *   - plugin AdvancedMetadata use getFilter
 *   - plugin AdvancedSearchEngine, module ASETag use getHaving and getWhere
 */
class GPCSearchCallback {

  /**
   * the getImageId returns the name of the image id attribute
   * return String
   */
  static public function getImageId()
  {
    return("");
  }

  /**
   * the getSelect function must return an attribute list separated with a comma
   *
   * "att1, att2, att3, att4"
   *
   * you can specifie tables names and aliases
   *
   * "table1.att1 AS alias1, table1.att2 AS alias2, table2.att3 AS alias3"
   */
  static public function getSelect($param="")
  {
    return("");
  }

  /**
   * the getFrom function must return a tables list separated with a comma
   *
   * "table1, (table2 left join table3 on table2.key = table3.key), table4"
   */
  static public function getFrom($param="")
  {
    return("");
  }

  /**
   * the getWhere function must return a ready to use where clause
   *
   * "(att1 = value0 OR att2 = value1) AND att4 LIKE value2 "
   */
  static public function getWhere($param="")
  {
    return("");
  }


  /**
   * the getHaving function return a ready to user HAVING clause
   *
   * " FIND_IN_SET(value0, GROUP_CONCAT(DISTINCT att1 SEPARATOR ',')) AND
   *   FIND_IN_SET(value0, GROUP_CONCAT(DISTINCT att1 SEPARATOR ',')) "
   *
   */
  static public function getHaving($param="")
  {
    return("");
  }


  /**
   * the getJoin function must return a ready to use sql statement allowing to
   * join the IMAGES table (key : pit.id) with given conditions
   *
   * "att3 = pit.id "
   */
  static public function getJoin($param="")
  {
    return("");
  }


  /**
   * the getFilter function must return a ready to use where clause
   * this where clause is used to filter the cache when the used tables can
   * return more than one result
   *
   * the filter can be empty, can be equal to the where clause, or can be equal
   * to a sub part of the where clause
   *
   * in most case, return "" is the best solution
   *
   */
  static public function getFilter($param="")
  {
    //return(self::getWhere($param));
    return("");
  }


  /**
   * this function is called by the request builder, allowing to display plugin
   * data with a specific format
   *
   * @param Array $attributes : array of ('attribute_name' => 'attribute_value')
   * @return String : HTML formatted value
   */
  static public function formatData($attributes)
  {
    return(print_r($attributes, true));
  }


  /**
   * this function is called by the request builder to make the search page, and
   * must return the HTML & JS code of the dialogbox used to select criterion
   *
   * Notes :
   *  - the dialogbox is a JS object with a public method 'show'
   *  - when the method show is called, one parameter is given by the request
   *    builder ; the parameter is an object defined as this :
   *      {
   *        cBuilder: an instance of the criteriaBuilder object used in the page,
   *      }
   *
   *
   *
   *
   * @param String $mode : can take 'admin' or 'public' values, allowing to
   *                       return different interface if needed
   * @return String : HTML formatted value
   */
  static public function getInterfaceContent($mode='admin')
  {
    return("");
  }

  /**
   * this function returns the label displayed in the criterion menu
   *
   * @return String : label displayed in the criterions menu
   */
  static public function getInterfaceLabel()
  {
    return(l10n('gpc_rb_unknown_interface'));
  }

  /**
   * this function returns the name of the dialog box class
   *
   * @return String : name of the dialogbox class
   */
  static public function getInterfaceDBClass()
  {
    return('');
  }


}


//load_language('rbuilder.lang', GPC_PATH);


class GPCRequestBuilder {

  static public $pluginName = 'GPCRequestBuilder';
  static public $version = '1.1.4';

  static private $tables = Array();
  static protected $tGlobalId=0;

  /**
   * register a plugin using GPCRequestBuilder
   *
   * @param String $pluginName : the plugin name
   * @param String $fileName : the php filename where the callback function can
   *                           be found
   * @return Boolean : true if registering is Ok, otherwise false
   */
  static public function register($plugin, $fileName)
  {
    $config=Array();
    if(!GPCCore::loadConfig(self::$pluginName, $config))
    {
      $config['registered']=array();
    }

    $config['registered'][$plugin]=Array(
      'name' => $plugin,
      'fileName' => $fileName,
      'date' => date("Y-m-d H:i:s"),
      'version' => self::$version
    );
    return(GPCCore::saveConfig(self::$pluginName, $config));
  }

  /**
   * unregister a plugin using GPCRequestBuilder
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
    if(GPCCore::loadConfig(self::$pluginName, $config))
    {
      if(array_key_exists('registered', $config))
      {
        if(array_key_exists($plugin, $config['registered']))
        {
          unset($config['registered'][$plugin]);
          return(GPCCore::saveConfig(self::$pluginName, $config));
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
    if(GPCCore::loadConfig(self::$pluginName, $config))
    {
      if(array_key_exists('registered', $config))
      {
        return($config['registered']);
      }
    }
    return(Array());
  }


  /**
   * initialise the class
   *
   * @param String $prefixeTable : the piwigo prefixe used on tables name
   * @param String $pluginNameFile : the plugin name used for tables name
   */
  static public function init($prefixeTable, $pluginNameFile)
  {
    $list=Array('request', 'result_cache', 'temp');

    for($i=0;$i<count($list);$i++)
    {
      self::$tables[$list[$i]]=$prefixeTable.$pluginNameFile.'_'.$list[$i];
    }
  }

  /**
   * create the tables needed by RequestBuilder (used during the gpc process install)
   */
  static public function createTables()
  {
    $tablesDef=array(
"CREATE TABLE `".self::$tables['request']."` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `num_items` int(10) unsigned NOT NULL default '0',
  `execution_time` float unsigned NOT NULL default '0',
  `connected_plugin` char(255) NOT NULL,
  `filter` text NOT NULL,
  `parameters` text NOT NULL,
  PRIMARY KEY  (`id`)
)
CHARACTER SET utf8 COLLATE utf8_general_ci",

"CREATE TABLE `".self::$tables['result_cache']."` (
  `id` int(10) unsigned NOT NULL,
  `image_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`,`image_id`)
)
CHARACTER SET utf8 COLLATE utf8_general_ci",

"CREATE TABLE `".self::$tables['temp']."` (
  `requestId` char(30) NOT NULL,
  `imageId` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY  (`requestId`,`imageId`)
)
CHARACTER SET utf8 COLLATE utf8_general_ci",
  );

    $tablef= new GPCTables(self::$tables);
    $tablef->create($tablesDef);

    return(true);
  }

  /**
   * update the tables needed by RequestBuilder (used during the gpc process
   * activation)
   */
  static public function updateTables($pluginPreviousRelease)
  {
    $tablef=new GPCTables(array(self::$tables['temp']));

    switch($pluginPreviousRelease)
    {
      case '03.01.00':
        $tablesCreate=array();
        $tablesUpdate=array();

        $tablesCreate[]=
"CREATE TABLE `".self::$tables['temp']."` (
  `requestId` char(30) NOT NULL,
  `imageId` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY  (`requestId`,`imageId`)
)
CHARACTER SET utf8 COLLATE utf8_general_ci";

        $tablesUpdate[self::$tables['request']]['filter']=
"ADD COLUMN  `filter` text NOT NULL default '' ";



        $tablef->create($tablesCreate);
        $tablef->updateTablesFields($tablesUpdate);
        // no break ! need to be updated like the next release
        // break;
      case '03.01.01':
      case '03.02.00':
      case '03.02.01':
      case '03.03.00':
      case '03.03.01':
        $tablesUpdate=array();

        $tablesUpdate[self::$tables['request']]['parameters']=
"ADD COLUMN `parameters` TEXT NOT NULL AFTER `filter`";

        $tablef->updateTablesFields($tablesUpdate);
        // no break ! need to be updated like the next release
        // break;
    }

    return(true);
  }

  /**
   * delete the tables needed by RequestBuilder
   */
  static public function deleteTables()
  {
    $tablef= new GPCTables(self::$tables);
    $tablef->drop();
    return(true);
  }


  /**
   * delete the config
   */
  static public function deleteConfig()
  {
    GPCCore::deleteConfig(self::$pluginName);
  }

  /**
   * this function add and handler on the 'loc_end_page_header' to add request
   * builder JS script & specific CSS on the page
   *
   * use it when the displayed page need an access to the criteriaBuilder GUI
   *
   */
  static public function loadJSandCSS()
  {
    load_language('rbuilder.lang', GPC_PATH);
    add_event_handler('loc_begin_page_header', array('GPCRequestBuilder', 'insertJSandCSSFiles'), 9);
  }


  /**
   * insert JS a CSS file in header
   *
   * the function is declared public because it used by the 'loc_begin_page_header'
   * event callback
   *
   * DO NOT USE IT DIRECTLY
   *
   */
  static public function insertJSandCSSFiles()
  {
    global $template;


    $baseName=basename(dirname(dirname(__FILE__))).'/css/';
    $template->append('head_elements', '<link href="plugins/'.$baseName.'rbuilder.css" type="text/css" rel="stylesheet"/>');
    if(defined('IN_ADMIN')) $template->append('head_elements', '<link href="plugins/'.$baseName.'rbuilder_'.$template->get_themeconf('name').'.css" type="text/css" rel="stylesheet"/>');


    $baseName=basename(dirname(dirname(__FILE__))).'/js/';
    GPCCore::addHeaderJS('jquery', 'themes/default/js/jquery.min.js');
    GPCCore::addHeaderJS('gpc.external.inestedsortable', 'plugins/'.$baseName.'external/iNestedSortablePack'.GPCCore::getMinified().'.js', array('jquery', 'jquery.ui'));
    GPCCore::addHeaderJS('gpc.rbCriteriaBuilder', 'plugins/'.$baseName.'rbCriteriaBuilder'.GPCCore::getMinified().'.js', array('gpc.external.inestedsortable'));

    $template->append('head_elements',
"<script type=\"text/javascript\">
  requestBuilderOptions = {
    textAND:\"".l10n('gpc_rb_textAND')."\",
    textOR:\"".l10n('gpc_rb_textOR')."\",
    textNoCriteria:\"".l10n('There is no criteria ! At least, one criteria is required to do search...')."\",
    textSomethingWrong:\"".l10n('gpc_something_is_wrong_on_the_server_side')."\",
    textCaddieUpdated:\"".l10n('gpc_the_caddie_is_updated')."\",
    helpEdit:\"".l10n('gpc_help_edit_criteria')."\",
    helpDelete:\"".l10n('gpc_help_delete_criteria')."\",
    helpMove:\"".l10n('gpc_help_move_criteria')."\",
    helpSwitchCondition:\"".l10n('gpc_help_switch_condition')."\",
    ajaxUrl:'plugins/GrumPluginClasses/gpc_ajax.php',
  }
</script>");
  }


  /**
   * execute request from the ajax call
   *
   * @return String : a ready to use HTML code
   */
  static public function executeRequest($ajaxfct)
  {
    $result='';
    switch($ajaxfct)
    {
      case 'public.rbuilder.searchExecute':
        $result=self::doCache();
        break;
      case 'public.rbuilder.searchGetPage':
        $result=self::getPage($_REQUEST['requestNumber'], $_REQUEST['page'], $_REQUEST['numPerPage']);
        break;
    }
    return($result);
  }


  /**
   * clear the cache table
   *
   * @param Boolean $clearAll : if set to true, clear all records without
   *                            checking timestamp
   */
  static public function clearCache($clearAll=false)
  {
    if($clearAll)
    {
      $sql="DELETE FROM ".self::$tables['result_cache'];
    }
    else
    {
      $sql="DELETE pgrc FROM ".self::$tables['result_cache']." pgrc
              LEFT JOIN ".self::$tables['request']." pgr
                ON pgrc.id = pgr.id
              WHERE pgr.date < '".date('Y-m-d H:i:s', strtotime("-2 hour"))."'";
    }
    pwg_query($sql);
  }

  /**
   * prepare the temporary table used for multirecord requests
   *
   * @param Integer $requestNumber : id of request
   * @return String : name of the request key temporary table
   */
  static private function prepareTempTable($requestNumber)
  {
    //$tableName=call_user_func(Array('RBCallBack'.$plugin, 'getFrom'));
    //$imageIdName=call_user_func(Array('RBCallBack'.$plugin, 'getImageId'));

    $tempClauses=array();
    foreach($_REQUEST['extraData'] as $key => $extraData)
    {
      $tempClauses[$key]=array(
        'plugin' => $extraData['owner'],
        'where' => call_user_func(Array('RBCallBack'.$extraData['owner'], 'getWhere'), $extraData['param']),
        'having' => call_user_func(Array('RBCallBack'.$extraData['owner'], 'getHaving'), $extraData['param']),
      );
    }

    $sql="INSERT INTO ".self::$tables['temp']." ".self::buildGroupRequest($_REQUEST[$_REQUEST['requestName']], $tempClauses, $_REQUEST['operator'], ' AND ', $requestNumber);
//echo $sql;
    $result=pwg_query($sql);

    return($requestNumber);
  }

  /**
   * clear the temporary table used for multirecord requests
   *
   * @param Array $requestNumber : the requestNumber to delete
   */
  static private function clearTempTable($requestNumber)
  {
    $sql="DELETE FROM ".self::$tables['temp']." WHERE requestId = '$requestNumber';";
    pwg_query($sql);
  }


  /**
   * execute a query, and place result in cache
   *
   *
   * @return String : queryNumber;numberOfItems
   */
  static private function doCache()
  {
    global $user;

    self::clearCache();

    $registeredPlugin=self::getRegistered();
    $requestNumber=self::getNewRequest($user['id']);

    $build=Array(
      'SELECT' => 'pit.id',
      'FROM' => '',
      'WHERE' => 'pit.level <= '.$user['level'],
      'GROUPBY' => '',
      'FILTER' => ''
    );
    $tmpBuild=Array(
      'FROM' => Array(
        '('.IMAGES_TABLE.' pit LEFT JOIN '.IMAGE_CATEGORY_TABLE.' pic ON pit.id = pic.image_id)' /*JOIN IMAGES & IMAGE_CATEGORY tables*/
       .'   JOIN '.USER_CACHE_CATEGORIES_TABLE.' pucc ON pucc.cat_id=pic.category_id',  /* IMAGE_CATEGORY & USER_CACHE_CATEGORIES_TABLE tables*/

      ),
      'WHERE' => Array(),
      'JOIN' => Array(999=>'pucc.user_id='.$user['id']),
      'GROUPBY' => Array(
        'pit.id'
      ),
      'FILTER' => Array(),
    );

    /* build data request for plugins
     *
     * Array('Plugin1' =>
     *          Array(
     *            criteriaNumber1 => pluginParam1,
     *            criteriaNumber2 => pluginParam2,
     *            criteriaNumberN => pluginParamN
     *          ),
     *       'Plugin2' =>
     *          Array(
     *            criteriaNumber1 => pluginParam1,
     *            criteriaNumber2 => pluginParam2,
     *            criteriaNumberN => pluginParamN
     *          )
     * )
     *
     */
    $pluginNeeded=Array();
    $pluginList=Array();
    $tempName=Array();
    foreach($_REQUEST['extraData'] as $key => $val)
    {
      $pluginNeeded[$val['owner']][$key]=$_REQUEST['extraData'][$key]['param'];
      $pluginList[$val['owner']]=$val['owner'];
    }

    /* for each plugin, include the rb callback class file */
    foreach($pluginList as $val)
    {
      if(file_exists($registeredPlugin[$val]['fileName']))
      {
        include_once($registeredPlugin[$val]['fileName']);
      }
    }

    /* prepare the temp table for the request */
    self::prepareTempTable($requestNumber);
    $tmpBuild['FROM'][]=self::$tables['temp'];
    $tmpBuild['JOIN'][]=self::$tables['temp'].".requestId = '".$requestNumber."'
                        AND ".self::$tables['temp'].".imageId = pit.id";

    /* for each needed plugin, prepare the filter */
    foreach($pluginNeeded as $key => $val)
    {
      foreach($val as $itemNumber => $param)
      {
        $tmpFilter=call_user_func(Array('RBCallBack'.$key, 'getFilter'), $param);

        if(trim($tmpFilter)!="") $tmpBuild['FILTER'][$key][]='('.$tmpFilter.')';
      }
    }


    /* build FROM
     *
     */
    $build['FROM']=implode(',', $tmpBuild['FROM']);
    unset($tmpBuild['FROM']);

    /* build WHERE
     */
    self::cleanArray($tmpBuild['WHERE']);
    if(count($tmpBuild['WHERE'])>0)
    {
      $build['WHERE']=' ('.self::buildGroup($_REQUEST[$_REQUEST['requestName']], $tmpBuild['WHERE'], $_REQUEST['operator'], ' AND ').') ';
    }
    unset($tmpBuild['WHERE']);


    /* build FILTER
     */
    self::cleanArray($tmpBuild['FILTER']);
    if(count($tmpBuild['FILTER'])>0)
    {
      $tmp=array();
      foreach($tmpBuild['FILTER'] as $key=>$val)
      {
        $tmp[$key]='('.implode(' OR ', $val).')';
      }
      $build['FILTER']=' ('.implode(' AND ', $tmp).') ';
    }
    unset($tmpBuild['FILTER']);


    /* for each plugin, adds jointure with the IMAGE table
     */
    self::cleanArray($tmpBuild['JOIN']);
    if(count($tmpBuild['JOIN'])>0)
    {
      if($build['WHERE']!='') $build['WHERE'].=' AND ';
      $build['WHERE'].=' ('.implode(' AND ', $tmpBuild['JOIN']).') ';
    }
    unset($tmpBuild['JOIN']);

    self::cleanArray($tmpBuild['GROUPBY']);
    if(count($tmpBuild['GROUPBY'])>0)
    {
      $build['GROUPBY'].=' '.implode(', ', $tmpBuild['GROUPBY']).' ';
    }
    unset($tmpBuild['GROUPBY']);



    $sql=' FROM '.$build['FROM'];
    if($build['WHERE']!='')
    {
      $sql.=' WHERE '.$build['WHERE'];
    }
    if($build['GROUPBY']!='')
    {
      $sql.=' GROUP BY '.$build['GROUPBY'];
    }

    $sql.=" ORDER BY pit.id ";

    $sql="INSERT INTO ".self::$tables['result_cache']." (SELECT DISTINCT $requestNumber, ".$build['SELECT']." $sql)";

//echo $sql;
    $returned="0;0";

    $result=pwg_query($sql);
    if($result)
    {
      $numberItems=pwg_db_changes($result);
      self::updateRequest($requestNumber, $numberItems, 0, implode(',', $pluginList), $build['FILTER'], $_REQUEST['extraData']);

      $returned="$requestNumber;".$numberItems;
    }

    self::clearTempTable($requestNumber);

    return($returned);
  }

  /**
   * return a page content. use the cache table to find request result
   *
   * @param Integer $requestNumber : the request number (from cache table)
   * @param Integer $pageNumber : the page to be returned
   * @param Integer $numPerPage : the number of items returned on a page
   * @param String $mode : if mode = 'count', the function returns the number of
   *                       rows ; otherwise, returns rows in a html string
   * @return String : formatted HTML code
   */
  static private function getPage($requestNumber, $pageNumber, $numPerPage)
  {
    global $conf, $user;
    $request=self::getRequest($requestNumber);

    if($request===false)
    {
      return("KO");
    }

    $limitFrom=$numPerPage*($pageNumber-1);

    $pluginNeeded=explode(',', $request['connected_plugin']);
    $registeredPlugin=self::getRegistered();

    $build=Array(
      'SELECT' => '',
      'FROM' => '',
      'WHERE' => '',
      'GROUPBY' => '',
    );
    $tmpBuild=Array(
      'SELECT' => Array(
        'RB_PIT' => "pit.id AS imageId, pit.name AS imageName, pit.path AS imagePath", // from the piwigo's image table
        'RB_PIC' => "GROUP_CONCAT( pic.category_id SEPARATOR ',') AS imageCategoriesId",     // from the piwigo's image_category table
        'RB_PCT' => "GROUP_CONCAT( CASE WHEN pct.name IS NULL THEN '' ELSE pct.name END SEPARATOR '#sep#') AS imageCategoriesNames,
                     GROUP_CONCAT( CASE WHEN pct.permalink IS NULL THEN '' ELSE pct.permalink END SEPARATOR '#sep#') AS imageCategoriesPLink,
                     GROUP_CONCAT( CASE WHEN pct.dir IS NULL THEN 'V' ELSE 'P' END) AS imageCategoriesDir",   //from the piwigo's categories table
      ),
      'FROM' => Array(
        // join rb result_cache table with piwigo's images table, joined with the piwigo's image_category table, joined with the categories table
        'RB' => "(((".self::$tables['result_cache']." pgrc
                  RIGHT JOIN ".IMAGES_TABLE." pit
                  ON pgrc.image_id = pit.id)
                    RIGHT JOIN ".IMAGE_CATEGORY_TABLE." pic
                    ON pit.id = pic.image_id)
                       RIGHT JOIN ".CATEGORIES_TABLE." pct
                       ON pct.id = pic.category_id)
                          RIGHT JOIN ".USER_CACHE_CATEGORIES_TABLE." pucc
                          ON pucc.cat_id = pic.category_id",
      ),
      'WHERE' => Array(
        'RB' => "pgrc.id=".$requestNumber." AND pucc.user_id=".$user['id'],
        ),
      'JOIN' => Array(),
      'GROUPBY' => Array(
        'RB' => "pit.id"
      )
    );


    $extraData=array();
    foreach($request['parameters'] as $data)
    {
      $extraData[$data['owner']]=$data['param'];
    }

    /* for each needed plugin :
     *  - include the file
     *  - call the static public function getFrom, getJoin, getSelect
     */
    foreach($pluginNeeded as $key => $val)
    {
      if(array_key_exists($val, $registeredPlugin))
      {
        if(file_exists($registeredPlugin[$val]['fileName']))
        {
          include_once($registeredPlugin[$val]['fileName']);

          $tmp=explode(',', call_user_func(Array('RBCallBack'.$val, 'getSelect'), $extraData[$val]));
          foreach($tmp as $key2=>$val2)
          {
            $tmp[$key2]=self::groupConcatAlias($val2, '#sep#');
          }
          $tmpBuild['SELECT'][$val]=implode(',', $tmp);
          $tmpBuild['FROM'][$val]=call_user_func(Array('RBCallBack'.$val, 'getFrom'), $extraData[$val]);
          $tmpBuild['JOIN'][$val]=call_user_func(Array('RBCallBack'.$val, 'getJoin'), $extraData[$val]);
        }
      }
    }

    /* build SELECT
     *
     */
    $build['SELECT']=implode(',', $tmpBuild['SELECT']);

    /* build FROM
     *
     */
    $build['FROM']=implode(',', $tmpBuild['FROM']);
    unset($tmpBuild['FROM']);


    /* build WHERE
     */
    if($request['filter']!='') $tmpBuild['WHERE'][]=$request['filter'];
    $build['WHERE']=implode(' AND ', $tmpBuild['WHERE']);
    unset($tmpBuild['WHERE']);

    /* for each plugin, adds jointure with the IMAGE table
     */
    self::cleanArray($tmpBuild['JOIN']);
    if(count($tmpBuild['JOIN'])>0)
    {
      $build['WHERE'].=' AND ('.implode(' AND ', $tmpBuild['JOIN']).') ';
    }
    unset($tmpBuild['JOIN']);

    self::cleanArray($tmpBuild['GROUPBY']);
    if(count($tmpBuild['GROUPBY'])>0)
    {
      $build['GROUPBY'].=' '.implode(', ', $tmpBuild['GROUPBY']).' ';
    }
    unset($tmpBuild['GROUPBY']);


    $imagesList=Array();

    $sql='SELECT DISTINCT '.$build['SELECT']
        .' FROM '.$build['FROM']
        .' WHERE '.$build['WHERE']
        .' GROUP BY '.$build['GROUPBY'];

    $sql.=' ORDER BY pit.id '
         .' LIMIT '.$limitFrom.', '.$numPerPage;

//echo $sql;
    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_assoc($result))
      {
        // affect standard datas
        $datas['imageThumbnail']=dirname($row['imagePath'])."/".$conf['dir_thumbnail']."/".$conf['prefix_thumbnail'].basename($row['imagePath']);
        $datas['imageId']=$row['imageId'];
        $datas['imagePath']=$row['imagePath'];
        $datas['imageName']=$row['imageName'];

        $datas['imageCategoriesId']=explode(',', $row['imageCategoriesId']);
        $datas['imageCategoriesNames']=explode('#sep#', $row['imageCategoriesNames']);
        $datas['imageCategoriesPLink']=explode('#sep#', $row['imageCategoriesPLink']);
        $datas['imageCategoriesDir']=explode(',', $row['imageCategoriesDir']);

        $datas['imageCategories']=Array();
        for($i=0;$i<count($datas['imageCategoriesId']);$i++)
        {
          $datas['imageCategories'][]=array(
            'id' => $datas['imageCategoriesId'][$i],
            'name' => $datas['imageCategoriesNames'][$i],
            'dirType' => $datas['imageCategoriesDir'][$i],
            'pLinks' => $datas['imageCategoriesPLink'][$i],
            'link'=> make_picture_url(
                        array(
                          'image_id' => $datas['imageId'],
                          'category' => array
                            (
                              'id' => $datas['imageCategoriesId'][$i],
                              'name' => $datas['imageCategoriesNames'][$i],
                              'permalink' => $datas['imageCategoriesPLink'][$i]
                            )
                        )
                      )
          );
        }

        /* affect datas for each plugin
         *
         * each plugin have to format the data in an HTML code
         *
         * so, for each plugin :
         *  - look the attributes given in the SELECT clause
         *  - for each attributes, associate the returned value of the record
         *  - affect in datas an index equals to the plugin pluginName, with returned HTML code ; HTML code is get from a formatData function
         *
         * Example :
         *  plugin ColorStart provide 2 attributes 'csColors' and 'csColorsPct'
         *
         *  we affect to the $attributes var :
         *  $attributes['csColors'] = $row['csColors'];
         *  $attributes['csColorsPct'] = $row['csColorsPct'];
         *
         *  call the ColorStat RB callback formatData with the $attributes => the function return a HTML code ready to use in the template
         *
         *  affect $datas['ColorStat'] = $the_returned_html_code;
         *
         *
         */
        foreach($tmpBuild['SELECT'] as $key => $val)
        {
          if($key!='RB_PIT' && $key!='RB_PIC' && $key!='RB_PCT')
          {
            $tmp=explode(',', $val);

            $attributes=Array();

            foreach($tmp as $key2 => $val2)
            {
              $name=self::getAttribute($val2);
              $attributes[$name]=$row[$name];
            }

            $datas['plugin'][$key]=call_user_func(Array('RBCallBack'.$key, 'formatData'), $attributes);

            unset($tmp);
            unset($attributes);
          }
        }
        $imagesList[]=$datas;
        unset($datas);
      }
    }

    return(self::toHtml($imagesList));
    //return("get page : $requestNumber, $pageNumber, $numPerPage<br>$debug<br>$sql");
  }

  /**
   * remove all empty value from an array
   * @param Array a$array : the array to clean
   */
  static private function cleanArray(&$array)
  {
    foreach($array as $key => $val)
    {
      if(is_array($val))
      {
        self::cleanArray($val);
        if(count($val)==0) unset($array[$key]);
      }
      elseif(trim($val)=='') unset($array[$key]);
    }
  }

  /**
   * returns the alias for an attribute
   *
   *  item1                          => returns item1
   *  table1.item1                   => returns item1
   *  table1.item1 AS alias1         => returns alias1
   *  item1 AS alias1                => returns alias1
   *  GROUP_CONCAT( .... ) AS alias1 => returns alias1
   *
   * @param String $var : value to examine
   * @return String : the attribute name
   */
  static private function getAttribute($val)
  {
    preg_match('/(?:GROUP_CONCAT\(.*\)|(?:[A-Z0-9_]*)\.)?([A-Z0-9_]*)(?:\s+AS\s+([A-Z0-9_]*))?/i', trim($val), $result);
    if(array_key_exists(2, $result))
    {
      return($result[2]);
    }
    elseif(array_key_exists(1, $result))
    {
      return($result[1]);
    }
    else
    {
      return($val);
    }
  }


  /**
   * returns a a sql statement GROUP_CONCAT for an alias
   *
   *  item1                  => returns GROUP_CONCAT(item1 SEPARATOR $sep) AS item1
   *  table1.item1           => returns GROUP_CONCAT(table1.item1 SEPARATOR $sep) AS item1
   *  table1.item1 AS alias1 => returns GROUP_CONCAT(table1.item1 SEPARATOR $sep) AS alias1
   *  item1 AS alias1        => returns GROUP_CONCAT(item1 SEPARATOR $sep) AS alias1
   *
   * @param String $val : value to examine
   * @param String $sep : the separator
   * @return String : the attribute name
   */
  static private function groupConcatAlias($val, $sep=',')
  {
    /*
     * table1.item1 AS alias1
     *
     * $result[3] = alias1
     * $result[2] = item1
     * $result[1] = table1.item1
     */
    preg_match('/((?:(?:[A-Z0-9_]*)\.)?([A-Z0-9_]*))(?:\s+AS\s+([A-Z0-9_]*))?/i', trim($val), $result);
    if(array_key_exists(3, $result))
    {
      return("GROUP_CONCAT(DISTINCT ".$result[1]." SEPARATOR '$sep') AS ".$result[3]);
    }
    elseif(array_key_exists(2, $result))
    {
      return("GROUP_CONCAT(DISTINCT ".$result[1]." SEPARATOR '$sep') AS ".$result[2]);
    }
    else
    {
      return("GROUP_CONCAT(DISTINCT $val SEPARATOR '$sep') AS ".$val);
    }
  }


  /**
   * get a new request number and create it in the request table
   *
   * @param Integer $userId : id of the user
   * @return Integer : the new request number, -1 if something wrong appened
   */
  static private function getNewRequest($userId)
  {
    $sql="INSERT INTO ".self::$tables['request']." VALUES('', '$userId', '".date('Y-m-d H:i:s')."', 0, 0, '', '', '')";
    $result=pwg_query($sql);
    if($result)
    {
      return(pwg_db_insert_id());
    }
    return(-1);
  }

  /**
   * update request properties
   *
   * @param Integer $request_id : the id of request to update
   * @param Integer $numItems : number of items found in the request
   * @param Float $executionTime : time in second to execute the request
   * @param String $pluginList : list of used plugins
   * @param String $parameters : parameters given for the request
   * @return Boolean : true if request was updated, otherwise false
   */
  static private function updateRequest($requestId, $numItems, $executionTime, $pluginList, $additionalFilter, $parameters)
  {
    $sql="UPDATE ".self::$tables['request']."
            SET num_items = $numItems,
                execution_time = $executionTime,
                connected_plugin = '$pluginList',
                filter = '".mysql_escape_string($additionalFilter)."',
                parameters = '".serialize($parameters)."'
            WHERE id = $requestId";
    $result=pwg_query($sql);
    if($result)
    {
      return(true);
    }
    return(false);
  }

  /**
   * returns request properties
   *
   * @param Integer $request_id : the id of request to update
   * @return Array : properties for request, false if request doesn't exist
   */
  static private function getRequest($requestId)
  {
    $returned=false;
    $sql="SELECT user_id, date, num_items, execution_time, connected_plugin, filter, parameters
          FROM ".self::$tables['request']."
          WHERE id = $requestId";
    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_assoc($result))
      {
        if($row['parameters']!='') $row['parameters']=unserialize($row['parameters']);
        $returned=$row;
      }
    }
    return($returned);
  }


  /**
   * internal function used by the executeRequest function for single record
   * requests
   *
   * this function is called recursively
   *
   * @param Array $groupContent :
   * @param Array $items :
   * @return String : a where clause
   */
  static private function buildGroup($groupContent, $items, $groups, $operator)
  {
    $returned=Array();
    foreach($groupContent as $key => $val)
    {
      if(strpos($val['id'], 'iCbGroup')!==false)
      {
        preg_match('/[0-9]*$/i', $val['id'], $groupNumber);
        $returned[]=self::buildGroup($val['children'], $items, $groups, $groups[$groupNumber[0]]);
      }
      else
      {
        preg_match('/[0-9]*$/i', $val['id'], $itemNumber);
        $returned[]=" (".$items[$itemNumber[0]].") ";
      }
    }
    return('('.implode($operator, $returned).')');
  }


  /**
   * internal function used by the executeRequest function for multi records
   * requests
   *
   * this function is called recursively
   *
   * @param Array $groupContent :
   * @param Array $clausesItems : array with 'where' and 'having' conditions (and 'plugin' for the plugin)
   * @param Array $groups : operators of each group
   * @param String $operator : 'OR' or 'AND', according with the current group operator
   * @param String $requestNumber : the request number
   * @return String : part of a SQL request
   */
  static private function buildGroupRequest($groupContent, $clausesItems, $groups, $operator, $requestNumber)
  {
    $returnedS='';
    $returned=Array();
    foreach($groupContent as $key => $val)
    {
      if(strpos($val['id'], 'iCbGroup')!==false)
      {
        preg_match('/[0-9]*$/i', $val['id'], $groupNumber);

        $groupValue=self::buildGroupRequest($val['children'], $clausesItems, $groups, $groups[$groupNumber[0]], $requestNumber);

        if($groupValue!='')
          $returned[]=array(
            'mode'  => 'group',
            'value' => $groupValue
          );
      }
      else
      {
        preg_match('/[0-9]*$/i', $val['id'], $itemNumber);

        $returned[]=array(
          'mode'  => 'item',
          'plugin' => $clausesItems[$itemNumber[0]]['plugin'],
          'valueWhere' => ($clausesItems[$itemNumber[0]]['where']!='')?" (".$clausesItems[$itemNumber[0]]['where'].") ":'',
          'valueHaving' => ($clausesItems[$itemNumber[0]]['having'])?" (".$clausesItems[$itemNumber[0]]['having'].") ":'',
        );
      }
    }

    if(count($returned)>0)
    {
      if(strtolower(trim($operator))=='and')
      {
        $tId=0;
        foreach($returned as $key=>$val)
        {
          if($tId>0) $returnedS.=" JOIN ";

          if($val['mode']=='item')
          {
            $returnedS.="(SELECT DISTINCT ".call_user_func(Array('RBCallBack'.$val['plugin'], 'getImageId'))." AS imageId
                          FROM ".call_user_func(Array('RBCallBack'.$val['plugin'], 'getFrom'));
            if($val['valueWhere']!='') $returnedS.=" WHERE ".$val['valueWhere'];
            if($val['valueHaving']!='')
              $returnedS.=" GROUP BY imageId
                            HAVING ".$val['valueHaving'];
            $returnedS.=") t".self::$tGlobalId." ";
          }
          else
          {
            $returnedS.="(".$val['value'].") t".self::$tGlobalId." ";
          }

          if($tId>0) $returnedS.=" ON t".(self::$tGlobalId-1).".imageId = t".self::$tGlobalId.".imageId ";
          $tId++;
          self::$tGlobalId++;
        }
        $returnedS="SELECT DISTINCT '$requestNumber', t".(self::$tGlobalId-$tId).".imageId FROM ".$returnedS;
      }
      else
      {
        foreach($returned as $key=>$val)
        {
          if($returnedS!='') $returnedS.=" UNION DISTINCT ";

          if($val['mode']=='item')
          {
            $returnedS.="SELECT DISTINCT '$requestNumber', t".self::$tGlobalId.".imageId
                          FROM (SELECT ".call_user_func(Array('RBCallBack'.$val['plugin'], 'getImageId'))." AS imageId
                                FROM ".call_user_func(Array('RBCallBack'.$val['plugin'], 'getFrom'));
            if($val['valueWhere']!='') $returnedS.=" WHERE ".$val['valueWhere'];
            if($val['valueHaving']!='')
              $returnedS.=" GROUP BY imageId
                            HAVING ".$val['valueHaving'];
            $returnedS.=") t".self::$tGlobalId." ";
          }
          else
          {
            $returnedS.="SELECT DISTINCT '$requestNumber', t".self::$tGlobalId.".imageId FROM (".$val['value'].") t".self::$tGlobalId;
          }

          self::$tGlobalId++;
        }
      }
    }

    return($returnedS);
  }


  /**
   * convert a list of images to HTML
   *
   * @param Array $imagesList : list of images id & associated datas
   * @return String : list formatted into HTML code
   */
  static protected function toHtml($imagesList)
  {
    global $template;

    $template->set_filename('result_items',
                dirname(dirname(__FILE__)).'/templates/GPCRequestBuilder_result.tpl');



    $template->assign('datas', $imagesList);

    return($template->parse('result_items', true));
  }


  /**
   * returns allowed (or not allowed) categories for a user
   *
   * used the USER_CACHE_TABLE if possible
   *
   * @param Integer $userId : a valid user Id
   * @return String : IN(...), NOT IN(...) or nothing if there is no restriction
   *                  for the user
   */
  public function getUserCategories($userId)
  {
/*
    $returned='';
    if($user['forbidden_categories']!='')
    {
      $returned=Array(
        'JOIN' => 'AND ('.IMAGE_CATEGORY.'.category_id NOT IN ('.$user['forbidden_categories'].') ) ',
        'FROM' => IMAGE_CATEGORY
      );


    }
    *
    *
    */
  }


  /**
   * display search page
   *
   * @param Array $filter : an array of string ; each item is the name of a
   *                        registered plugin
   *                        if no parameters are given, no filter is applied
   *                        otherwise only plugin wich name is given are
   *                        accessible
   */
  static public function displaySearchPage($filter=array())
  {
    global $template, $lang;

    if(is_string($filter)) $filter=array($filter);
    $filter=array_flip($filter);

    GPCCore::addHeaderJS('jquery.ui', 'themes/default/js/ui/minified/jquery.ui.core.packed.js');
    GPCCore::addHeaderJS('jquery.ui.dialog', 'themes/default/js/ui/minified/jquery.ui.dialog.packed.js');
    GPCCore::addHeaderJS('gpc.pagesNavigator', 'plugins/GrumPluginClasses/js/pagesNavigator'.GPCCore::getMinified().'.js');
    GPCCore::addHeaderJS('gpc.rbSearch', 'plugins/GrumPluginClasses/js/rbSearch'.GPCCore::getMinified().'.js');


    $template->set_filename('gpc_search_page',
                dirname(dirname(__FILE__)).'/templates/GPCRequestBuilder_search.tpl');

    $registeredPlugin=self::getRegistered();
    $dialogBox=Array();
    foreach($registeredPlugin as $key=>$val)
    {
      if(array_key_exists($key, $registeredPlugin) and
         (count($filter)==0 or array_key_exists($key, $filter)))
      {
        if(file_exists($registeredPlugin[$key]['fileName']))
        {
          include_once($registeredPlugin[$key]['fileName']);

          $dialogBox[]=Array(
            'handle' => $val['name'].'DB',
            'dialogBoxClass' => call_user_func(Array('RBCallBack'.$key, 'getInterfaceDBClass')),
            'label' => call_user_func(Array('RBCallBack'.$key, 'getInterfaceLabel')),
            'content' => call_user_func(Array('RBCallBack'.$key, 'getInterfaceContent')),
          );
        }
      }
    }

    $datas=Array(
      'dialogBox' => $dialogBox,
      'themeName' => defined('IN_ADMIN')?$template->get_themeconf('name'):'',
    );

    $template->assign('datas', $datas);

    return($template->parse('gpc_search_page', true));
  } //displaySearchPage

}


?>
