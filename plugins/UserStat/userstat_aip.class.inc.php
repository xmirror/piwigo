<?php
/* -----------------------------------------------------------------------------
  Plugin     : UserStat
  Author     : Grum
    email    : grum@piwigo.org
    website  : http://photos.grum.fr

    << May the Little SpaceFrog be with you ! >>
  ------------------------------------------------------------------------------
  See main.inc.php for release information

  AI classe => manage integration in administration interface

  --------------------------------------------------------------------------- */
if (!defined('PHPWG_ROOT_PATH')) { die('Hacking attempt!'); }

include_once('userstat_root.class.inc.php');
include_once(PHPWG_ROOT_PATH.'admin/include/tabsheet.class.php');
include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCAjax.class.inc.php');

class UserStat_AIP extends UserStat_root
{
  protected $tabsheet;

  public function __construct($prefixeTable, $filelocation)
  {
    parent::__construct($prefixeTable, $filelocation);

    $this->loadConfig();
    $this->initEvents();

    $this->tabsheet = new tabsheet();
    $this->tabsheet->add('global_stats',
                          l10n('us_tsGlobal'),
                          $this->getAdminLink().'&amp;fUserStat_tabsheet=global_stats');
    $this->tabsheet->add('users_stats',
                          l10n('us_tsUsers'),
                          $this->getAdminLink().'&amp;fUserStat_tabsheet=users_stats');
  }

  public function __destruct()
  {
    unset($this->tabsheet);
    parent::__destruct();
  }

  /*
    initialize events call for the plugin
  */
  function initEvents()
  {
    add_event_handler('loc_end_page_header', array(&$this->css, 'applyCSS'));
  }



  /* ---------------------------------------------------------------------------
  Public classe functions
  --------------------------------------------------------------------------- */

  /*
    manage plugin integration into piwigo's admin interface
  */
  public function manage()
  {
    global $template;

    $this->returnAjaxContent();

    $template->set_filename('plugin_admin_content', dirname(__FILE__)."/admin/userstat_admin.tpl");

    $this->initRequest();


    if($_REQUEST['fUserStat_tabsheet']=='global_stats')
    {
      $this->displayGlobalStats();
    }
    elseif($_REQUEST['fUserStat_tabsheet']=='users_stats')
    {
      $this->displayUsersStats();
    }

    $this->tabsheet->select($_REQUEST['fUserStat_tabsheet']);
    $this->tabsheet->assign();
    $selected_tab=$this->tabsheet->get_selected();
    $template->assign($this->tabsheet->get_titlename(), "[".$selected_tab['caption']."]");

    $template_plugin["USERSTAT_VERSION"] = "<i>UserStat</i> ".l10n('us_version').USERSTAT_VERSION;
    $template_plugin["USERSTAT_PAGE"] = $_REQUEST['fUserStat_tabsheet'];

    $template->assign('plugin', $template_plugin);
    $template->assign_var_from_handle('ADMIN_CONTENT', 'plugin_admin_content');
  }

  /* ---------------------------------------------------------------------------
  Private classe functions
  --------------------------------------------------------------------------- */

  /*
    return ajax content
  */
  protected function returnAjaxContent()
  {
    global $ajax, $template;

    if(isset($_REQUEST['ajaxfct']))
    {
      //$this->debug("AJAXFCT:".$_REQUEST['ajaxfct']);
      $result="<p class='errors'>An error has occured</p>";
      switch($_REQUEST['ajaxfct'])
      {
        case 'userStat':
          $result=$this->ajaxGetUserStat($_REQUEST['userId']);
          break;
      }
      GPCAjax::returnResult($result);
    }
  }



  private function initRequest()
  {
    //initialise $REQUEST values if not defined
    if(!array_key_exists('fUserStat_tabsheet', $_REQUEST))
    {
      $_REQUEST['fUserStat_tabsheet']='global_stats';
    }
  }


  private function displayGlobalStats()
  {
    global $template;

    $template->set_filename('body_page', dirname(__FILE__)."/admin/userstat_global.tpl");

    $template_datas = array();

    $template_datas["propertiesUsers"] = $this->getNumberOfUsers();
    $template_datas["languagesUsers"] = $this->getLanguagesOfUsers();
    $template_datas["templatesUsers"] = $this->getTemplatesOfUsers();

    $template->assign('datas', $template_datas);
    $template->assign_var_from_handle('USERSTAT_BODY_PAGE', 'body_page');
  }


  private function displayUsersStats()
  {
    global $template;

    $template->set_filename('body_page', dirname(__FILE__)."/admin/userstat_users.tpl");

    $template_datas = array();

    $template_datas["ajaxUrl"] = $this->getAdminLink();
    $template_datas["users"] = $this->getUsersGlobalStats();

    $template->assign('datas', $template_datas);
    $template->assign_var_from_handle('USERSTAT_BODY_PAGE', 'body_page');
  }



  private function makeUserStats($userId)
  {
    $returned=array();
    $userStats=$this->getUserStats($userId);

//$this->format_link($stats[$i]["CatName"], )." / ";

    $catList = "";
    foreach($userStats as $key => $val)
    {
      ($catList=="")?$catList=$val["upperCats"]:$catList.=",".$val["upperCats"];
    }

    $sql="
SELECT name as categoryName,
       id as categoryId,
       '' AS nbRates,
       '' AS maxRate,
       '' AS minRate,
       '' AS avgRate,
       '' AS devRate,
       '' AS nbDaysR,
       '' AS lastDayR,
       '' AS delayR,
       '' AS nbComments,
       '' AS nbDaysC,
       '' AS lastDayC,
       '' AS delayC,
       IF(dir IS NULL, 'N', 'Y') AS physical,
       global_rank,
       uppercats
FROM ".CATEGORIES_TABLE."
WHERE id IN (".$catList.")
ORDER BY global_rank;";

    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_assoc($result))
      {
        $row['indent']=substr_count($row['global_rank'], '.');
        if(array_key_exists($row['categoryId'], $userStats))
        {
          foreach($userStats[$row['categoryId']] as $key => $val)
          {
            $row[$key]=$val;
          }
        }
        $row['categoryName']=$this->format_link($row['categoryName'], PHPWG_ROOT_PATH."index.php?/category/".$row['categoryId']);
        if($row['indent']>0)
        {
          $row['categoryName']=str_repeat("&nbsp;", $row['indent']*5)."+ - - ".$row['categoryName'];
        }
        $returned[]=$row;
      }
    }

    return($returned);
  }


  /*
    format text : <a href="$link">$value</a>
  */
  private function format_link($value, $link)
  {
    return("<a href='$link'>$value</a>");
  }


  /* ---------------------------------------------------------------------------
   * SQL Requests functions
   * ------------------------------------------------------------------------- */

  private function getUserName($userId)
  {
    $sql="SELECT username FROM ".USERS_TABLE." WHERE id = ".$userId;
    $result=pwg_query($sql);
    if($result)
    {
      $row=pwg_db_fetch_assoc($result);
      return($row["username"]);
    }
    return("#".$userId);
  }

  /*
   * returns an array
   *   - "total" : total number of users
   *   - "withmail" : total number with email
   *   - "withoutMail" : total number without email
  */
  private function getNumberOfUsers()
  {
    $returned=Array(
      "total" => 0,
      "withMail" => 0,
      "withoutMail" => 0);

    $sql="SELECT 'total' AS property, count(id) AS counter
          FROM ".USERS_TABLE."
          GROUP BY property
          UNION
          SELECT IF(mail_address is null, 'withoutMail', 'withMail') AS property, COUNT(IF(mail_address is null, 'withoutMail', 'withMail')) AS counter
          FROM ".USERS_TABLE."
          GROUP BY property
          UNION
          SELECT IF(enabled_high != true, 'withoutHD', 'withHD') AS property, count(IF(enabled_high != true , 'withoutHD', 'withHD')) AS counter
          FROM ".USER_INFOS_TABLE."
          GROUP BY property
          ";
    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_row($result))
      {
        $returned[]=Array(
          "property" => $row[0],
          "value" => $row[1],
          "label" => l10n("us_".$row[0])
        );
      }
    }
    return($returned);
  }

  /*
   * returns an array of used languages
   * each row is an array :
   *  "nbUsers" : number of users using the language
   *  "language" : language used
  */
  private function getLanguagesOfUsers()
  {
    $returned = array();
    $list = get_languages();

    $sql="SELECT count(user_id) as nbUsers, language FROM ".USER_INFOS_TABLE." GROUP BY language ORDER BY nbUsers DESC";
    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_assoc($result))
      {
        $row["humanReadable"]=$list[$row["language"]];
        $returned[]=$row;
      }
    }
    return($returned);
  }

  /*
   * returns an array of used templates/themes
   * each row is an array :
   *  "nbUsers"  : number of users using the language
   *  "template" : template/theme used
  */
  private function getTemplatesOfUsers()
  {
    $returned = array();

    $sql="SELECT count(user_id) as nbUsers, theme FROM ".USER_INFOS_TABLE." GROUP BY theme ORDER BY nbUsers DESC";
    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_assoc($result))
      {
        $returned[]=$row;
      }
    }
    return($returned);
  }

  /*
   * returns an array of users stats properties (global stats)
   * each row is an array :
   *  "name"       : the user name
   *  "id"         : the user id
   *  "nbRates"    : number of rates made by the user
   *  "maxRate"    : highest rate made by the user
   *  "minRate"    : lowest rate made by the user
   *  "avgRate"    : average rate made by th user
   *  "devRate"    : deviation rate made by the user
   *  "nbDaysR"    : number of days where the user made a rate
   *  "lastDayR"   : last date when a user made a rate
   *  "delayR"     : delay (in days) between the first and the last rate
   *  "nbComments" : number of comment post by the user
   *  "nbDaysC"    : number of days where the user post a comment
   *  "lastDayC"   : last date when a user post a comment
   *  "delayC"     : delay (in days) between the first and the last posted comment
  */
  private function getUsersGlobalStats()
  {
    $returned=array();

    $sql="
SELECT name,
       id,
       MAX(nbRates) AS nbRates,
       MAX(maxRate) AS maxRate,
       MAX(minRate) AS minRate,
       MAX(avgRate) AS avgRate,
       MAX(devRate) AS devRate,
       MAX(lastDayR) AS lastDayR,
       MAX(delayR) AS delayR,
       MAX(nbComments) AS nbComments,
       MAX(lastDayC) AS lastDayC,
       MAX(delayC) AS delayC
FROM (
      SELECT  username AS name,
              user_id AS id,
              COUNT(element_id) AS nbRates,
              MAX(rate) AS maxRate,
              MIN(rate) AS minRate,
              ROUND(AVG(rate), 2) AS avgRate,
              ROUND(STDDEV(rate), 2) AS devRate,
              MAX(rt.date) AS lastDayR,
              DATEDIFF(CURDATE(), MAX(rt.date)) AS delayR,
              '' AS nbComments,
              '' AS lastDayC,
              '' AS delayC
      FROM ".RATE_TABLE." as rt
            JOIN ".USERS_TABLE." ut ON ut.id = rt.user_id
      GROUP BY user_id
      UNION
      SELECT author AS name,
          ut.id AS id,
          '' AS nbRates,
          '' AS maxRate,
          '' AS minRate,
          '' AS avgRate,
          '' AS devRate,
          '' AS lastDayR,
          '' AS delayR,
          COUNT(ct.id) AS nbComments,
          MAX(DATE(date)) AS lastDayC,
          DATEDIFF(CURDATE(), MAX(date)) AS delayC
      FROM ".COMMENTS_TABLE." as ct
           JOIN ".USERS_TABLE." ut ON ut.username = ct.author
      GROUP BY author
     ) AS t1
GROUP BY id;";


    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_assoc($result))
      {
        $returned[]=$row;
      }
    }

    return($returned);
  }


  /*
   * returns an array of user stats properties
   *
   * parameters :
   *  $userId : the user id
   *
   * each row is an array :
   *  "categoryId" : the category id
   *  "catName"    : the categery name
   *  "physical"   : "Y" if the category is physical, "N" if it's a virtual category
   *  "nbRates"    : number of rates made by the user
   *  "maxRate"    : highest rate made by the user
   *  "minRate"    : lowest rate made by the user
   *  "avgRate"    : average rate made by th user
   *  "devRate"    : deviation rate made by the user
   *  "nbDaysR"    : number of days where the user made a rate
   *  "lastDayR"   : last date when a user made a rate
   *  "delayR"     : delay (in days) between the first and the last rate
   *  "nbComments" : number of comment post by the user
   *  "nbDaysC"    : number of days where the user post a comment
   *  "lastDayC"   : last date when a user post a comment
   *  "delayC"     : delay (in days) between the first and the last posted comment
  */
  private function getUserStats($userId)
  {
    $returned=array();

    $sql="
SELECT t1.name AS name,
       MAX(t1.id) AS id,
       MAX(nbRates) AS nbRates,
       MAX(maxRate) AS maxRate,
       MAX(minRate) AS minRate,
       MAX(avgRate) AS avgRate,
       MAX(devRate) AS devRate,
       MAX(lastDayR) AS lastDayR,
       MAX(delayR) AS delayR,
       MAX(nbComments) AS nbComments,
       MAX(lastDayC) AS lastDayC,
       MAX(delayC) AS delayC,
       category_id as categoryId,
       uppercats AS upperCats
FROM (
      SELECT username AS name,
             user_id AS id,
             COUNT(element_id) as nbRates,
             MAX(rate) AS maxRate,
             MIN(rate) AS minRate,
             ROUND(AVG(rate),2) AS avgRate,
             ROUND(STDDEV(rate),2) AS devRate,
             MAX(rt.date) AS lastDayR,
             DATEDIFF(CURDATE(), MAX(rt.date)) AS delayR,
             '' AS nbComments,
             '' AS lastDayC,
             '' AS delayC,
             category_id
      FROM ".RATE_TABLE." AS rt
           JOIN ".USERS_TABLE." AS ut ON ut.id = rt.user_id
                LEFT OUTER JOIN ".IMAGE_CATEGORY_TABLE." AS ict ON ict.image_id = rt.element_id
      WHERE ut.id = ".$userId."
      GROUP BY id, category_id
      UNION
      SELECT author AS name,
             ut2.id AS id,
             '' AS nbRates,
             '' AS maxRate,
             '' AS minRate,
             '' AS avgRate,
             '' AS devRate,
             '' AS lastDayR,
             '' AS delayR,
             COUNT(ct2.id) AS nbComments,
             MAX(DATE(date)) AS lastDayC,
             DATEDIFF(CURDATE(), MAX(date)) AS delayC,
             category_id
      FROM ".COMMENTS_TABLE." AS ct2
           JOIN ".USERS_TABLE." AS ut2 ON ut2.username = ct2.author
                LEFT OUTER JOIN ".IMAGE_CATEGORY_TABLE." AS ict2 ON ict2.image_id = ct2.image_id
      WHERE ut2.id = ".$userId."
      GROUP BY id
     ) AS t1
       LEFT OUTER JOIN ".CATEGORIES_TABLE." AS ct ON t1.category_id = ct.id
GROUP BY t1.id, category_id";

    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_assoc($result))
      {
        $returned[$row['categoryId']]=$row;
      }
    }

    return($returned);
  }




  /* ---------------------------------------------------------------------------
   * AJAX functions
   * ------------------------------------------------------------------------- */

  private function ajaxGetUserStat($userId)
  {
    $local_tpl = new Template(USERSTAT_PATH."admin/", "");
    $local_tpl->set_filename('body_page',
                  dirname($this->getFileLocation()).'/admin/userstat_userstat.tpl');

    $template_datas["list"] = $this->makeUserStats($userId);
    $template_datas["userName"] = $this->getUserName($userId);

    $local_tpl->assign('datas', $template_datas);
    return($local_tpl->parse('body_page', true));
  }


} // UserStat_AI class


?>
