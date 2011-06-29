<?php

/* -----------------------------------------------------------------------------
  class name: GPCAllowedAccess, GPCGroups, GPCUsers
  class version  : 2.1.0
  plugin version : 3.4.0
  date           : 2010-03-30
  ------------------------------------------------------------------------------
  author: grum at piwog.org
  << May the Little SpaceFrog be with you >>
  ------------------------------------------------------------------------------

   this classes provides base functions to manage users/groups access
  groups and users classes extends GPCAllowedAccess classes

    - constructor GPCAllowedAccess($alloweds = array(), $accessMode='a')
    - constructor groups($alloweds = array(), $accessMode='a')
    - constructor users($alloweds = array(), $accessMode='a')
    - (public) function getList()
    - (public) function setAllowed($id, $allowed)
    - (public) function setAlloweds($idList, $allowed)
    - (public) function getAlloweds()
    - (public) function isAllowed($id)
    - (private) function initList()
 

| release | date       |
| 1.1.0   | 2009/11/29 | * add 'webmaster' status for users
|         |            |
| 2.0.0   | 2010/03/28 | * Uses piwigo pwg_db_* functions instead of mysql_*
|         |            |   functions
|         |            | * update classes & functions names
|         |            |
| 2.1.0   | 2011/01/15 | * remove html function
|         |            |
|         |            | * implement accessMode
|         |            |
|         |            |

   ---------------------------------------------------------------------- */
class GPCAllowedAccess
{
  protected $accessList;
  protected $accessMode='a'; // 'a' : allowed, 'n' : not allowed

  /**
   * constructor initialize default values
   *
   * @param Array $alloweds  : list of items
   *        String $alloweds : list of items (separator : '/')
   *
   * @param String $accessMode : 'a' = access is allowed by default for all values, $allowed param is a list of not allowed values
   *                             'n' = access is not allowed by default for all values, $allowed param is a list of allowed values
   *                             priority is given to the $allowed value
   */
  public function __construct($alloweds = array(), $accessMode='a')
  {
    $this->initList();
    $this->setAlloweds($alloweds, $accessMode=='n');
  }

  public function __destruct()
  {
    unset($this->accessList);
  }

  /**
   * destroy the groups list
   */
  protected function initList()
  {
    $this->accessList=array();
  }

  /**
   * returns list of items (as an array)
   * each array item is an array :
   *  'id'      : (String) id of item
   *  'name'    : (String) name of item
   *  'allowed' : (Bool)   access is allowed or not
   *
   * @return Array
   */
  function getList()
  {
    return($this->accessList);
  }

  /**
   * set allowed value for an item
   *
   * @param String $id : id of item
   * @param Bool $allowed : access allowed or not
   */
  function setAllowed($id, $allowed)
  {
    if(isset($this->accessList[$id]))
    {
      $this->accessList[$id]['allowed']=$allowed;
    }
  }


  /**
   * set alloweds items (can be given as an array or a string with separator '/')
   * according to the
   *
   * @param Array $idList  : list of items to set
   * @param String $idList
   * @param Bool $allowed : access allowed or not
   */
  function setAlloweds($idList, $allowed)
  {
    if(!is_array($idList)) $idList=explode("/", $idList);

    $idList=array_flip($idList);

    foreach($this->accessList as $key => $val)
    {
      if(isset($idList[$key]))
      {
        $this->accessList[$key]['allowed']=$allowed;
      }
      else
      {
        $this->accessList[$key]['allowed']=!$allowed;
      }
    }
  }


  /**
   * return list of alloweds items
   *
   * @return Array
   */
  function getAlloweds()
  {
    $returned=Array();

    foreach($this->accessList as $key => $val)
    {
      if($val['allowed']) $returned[]=$val;
    }
    return($returned);
  }


  /**
   * returns true if is allowed
   *
   * @param String $id : item id
   * @retrun Bool
   */
  function isAllowed($id)
  {
    if(isset($this->accessList[$id]))
    {
      return($this->accessList[$id]['allowed']);
    }
    else
    {
      return($this->accessMode=='a');
    }
  }

} //GPCAllowedAccess








/**
 * ----------------------------------------------------------------------------
 *  this class provides base functions to manage groups access
 *  initList redefined to initialize accessList from database GROUPS
 * ----------------------------------------------------------------------------
 */
class GPCGroups extends GPCAllowedAccess
{
  /**
   * initialize the groups list
   */
  protected  function initList()
  {
    $this->accessList=array();
    $sql="SELECT id, name FROM ".GROUPS_TABLE." ORDER BY name";
    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_assoc($result))
      {
        $this->accessList[$row['id']]=array(
            'id' => $row['id'],
            'name' => $row['name'],
            'allowed' => ($this->accessMode=='a')
          );
      }
    }
  }
}








/**
 * ----------------------------------------------------------------------------
 *  this class provides base functions to manage users access
 *  initList redefined to initialize accessList from piwigo's predefined values
 * ----------------------------------------------------------------------------
 */
class GPCUsers extends GPCAllowedAccess
{
  /**
   * initialize the users list
   */
  protected function initList()
  {
    $usersList = array('guest', 'generic', 'normal', 'webmaster', 'admin');
    $this->accessList=array();
    foreach($usersList as $val)
    {
      $this->accessList[$val]=array(
          'id' => $val,
          'name' => l10n('user_status_'.$val),
          'allowed' => ($this->accessMode=='a')
        );
    }
  }
} //class users



?>
