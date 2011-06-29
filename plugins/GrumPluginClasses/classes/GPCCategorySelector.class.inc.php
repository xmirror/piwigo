<?php
/**
 * -----------------------------------------------------------------------------
 * class name     : GPCCategorySelector
 * class version  : 1.0.1
 * plugin version : 3.3.3
 * date           : 2010-10-20
 * -----------------------------------------------------------------------------
 * author: grum at piwigo.org
 * << May the Little SpaceFrog be with you >>
 * -----------------------------------------------------------------------------
 *
 * :: HISTORY
 *
| release | date       |
| 1.0.0   | 2010/10/09 | * create class
|         |            |
| 1.0.1   | 2010/10/20 | * fix bug on the private select methods
|         |            |
|         |            |
|         |            |
|         |            |
|         |            |
|         |            |
 *
 *
 * -----------------------------------------------------------------------------
 *
 *  this class provides methods to easily insert a hierarchical categories
 *  selector in the HTML pages
 *
 * -----------------------------------------------------------------------------
 *
 * Const
 *  - GPCCategorySelector::FILTER_ALL
 *  - GPCCategorySelector::FILTER_ACCESSIBLE
 *  - GPCCategorySelector::FILTER_PUBLIC
 *  there is no filter 'private only' or 'not accessible only' because these
 *  kind of categories are probably sub categories of 'public' categories
 *
 *
 * Methods
 *  - public __construct($options)
 *  - public __destruct()
 *  - public setFilter($filter)
 *  - public getFilter()
 *  - public setGalleryRoot($galleryRoot)
 *  - public getGalleryRoot()
 *  - public getCategoryList()
 *
 *
 * -----------------------------------------------------------------------------
 *
 */


class GPCCategorySelector
{
  const FILTER_ALL            = 'all';         // no filter, all categories are listed
  const FILTER_ACCESSIBLE     = 'accessible'; // only accessible categories are listed (public + private with some access right)
  const FILTER_PUBLIC         = 'public';     // only public categories are listed

  const USER_MODE_ADMIN       = 'admin';      // returns result without user acces right applied (admin can see everything...)
  const USER_MODE_PUBLIC      = 'public';     // returns result with user acces right applied


  private $options=array(
    'filter'      => self::FILTER_ACCESSIBLE,
    'galleryRoot' => true,
    'tree'        => false,
    'userMode'    => self::USER_MODE_PUBLIC,
  );


  /**
   * constructor for the object
   *
   * all options are facultative
   *
   * @param Array $options : an array with the options
   *               String 'filter'      : can take one the defined FILTER values
   *               Bool   'galleryRoot' : if set to true, the category list
   *                                      contain at root, an item with id = 0
   *                                      and named 'all the gallery'
   *               Bool   'tree'        : if set to true, the category list
   *                                      is returned as a tree, otherwise result
   *                                      is returned as a flat array
   *               String 'userMode'    : 'admin' returns result without user
   *                                      right access applied ; 'public' returns
   *                                      result with user right acces applied
   */
  public function __construct($options=array())
  {
    if(isset($options['filter'])) $this->setFilter($options['filter']);
    if(isset($options['galleryRoot'])) $this->setGalleryRoot($options['galleryRoot']);
    if(isset($options['tree'])) $this->setTree($options['tree']);
    if(isset($options['userMode'])) $this->setUserMode($options['userMode']);
  }

  /**
   * destructor dor the object
   */
  public function __destruct()
  {
    unset($this->options);
  }

  /**
   * set the filter value to apply on the categories
   *
   * @param String $filer : the filter value
   * @return String : the filter value
   */
  public function setFilter($filter)
  {
    if($filter==self::FILTER_ALL or
       $filter==self::FILTER_ACCESSIBLE or
       $filter==self::FILTER_PUBLIC) $this->options['filter']=$filter;

    if($this->options['userMode']==self::USER_MODE_PUBLIC and
       !($this->options['filter']==self::FILTER_ACCESSIBLE or $this->options['filter']==self::FILTER_PUBLIC)) $this->options['filter']==self::FILTER_ACCESSIBLE;

    return($this->options['filter']);
  }

  /**
   * get the filter value affected on the categories
   *
   * @return String : the filter
   */
  public function getFilter()
  {
    return($this->options['filter']);
  }


  /**
   * set to true to add a root item named 'all the gallery'
   * id for this item will be equal to 0
   *
   * @param Bool $galleryRoot :
   * @return Bool :
   */
  public function setGalleryRoot($galleryRoot)
  {
    if(is_bool($galleryRoot)) $this->options['galleryRoot']=$galleryRoot;
    return($this->options['galleryRoot']);
  }


  /**
   * get if a root item named 'all the gallery' is present or not
   *
   * @return Bool :
   */
  public function getGalleryRoot()
  {
    return($this->options['galleryRoot']);
  }


  /**
   * get if the result have to be returned as a tree or as a flat array
   *
   * @return Bool :
   */
  public function getTree()
  {
    return($this->options['tree']);
  }


  /**
   * set if the result have to be returned as a tree or as a flat array
   *
   * @param Bool $tree :
   * @return Bool :
   */
  public function setTree($tree)
  {
    if(is_bool($tree)) $this->options['tree']=$tree;
    return($this->options['tree']);
  }




  /**
   * returns the user mode currently applied
   *
   * @return String :
   */
  public function getUserMode()
  {
    return($this->options['userMode']);
  }


  /**
   * set the user mode to apply
   *
   * @param String $userMode :
   * @return String :
   */
  public function setUserMode($userMode)
  {
    if($userMode==self::USER_MODE_ADMIN || $userMode==self::USER_MODE_PUBLIC) $this->options['userMode']=$userMode;

    if($this->options['userMode']==self::USER_MODE_PUBLIC and
       !($this->options['filter']==self::FILTER_ACCESSIBLE or $this->options['filter']==self::FILTER_PUBLIC)) $this->options['filter']==self::FILTER_ACCESSIBLE;
    return($this->options['userMode']);
  }



  /**
   * build an ordered category list
   * returns an array, each item is an array like :
   *  'id'     => the category Id
   *  'name'   => the category name
   *  'level'  => the category level
   *  'status' => the category status (0='private', 1='public')
   *  'childs' => the category have childs ? (true or false in flat mode, childs
   *                in tree mode)
   *
   * @return Array : the list
   */
  public function getCategoryList()
  {
    global $user;

    $returned=array();

    if($this->options['galleryRoot'])
    {
      $startLevel=1;
    }
    else
    {
      $startLevel=0;
    }

    $sql="SELECT DISTINCT pct.id, pct.name, pct.global_rank AS rank, pct.status
          FROM ".CATEGORIES_TABLE." pct ";

    switch($this->options['filter'])
    {
      case self::FILTER_PUBLIC :
        $sql.=" WHERE pct.status = 'public' ";
        break;
      case self::FILTER_ACCESSIBLE :
        if(!is_admin())
        {
          $sql.=" JOIN ".USER_CACHE_CATEGORIES_TABLE." pucc
                  ON (pucc.cat_id = pct.id) AND pucc.user_id='".$user['id']."' ";
        }
        else
        {
          $sql.=" JOIN (
                    SELECT DISTINCT pgat.cat_id AS catId FROM ".GROUP_ACCESS_TABLE." pgat
                    UNION DISTINCT
                    SELECT DISTINCT puat.cat_id AS catId FROM ".USER_ACCESS_TABLE." puat
                    UNION DISTINCT
                    SELECT DISTINCT pct2.id AS catId FROM ".CATEGORIES_TABLE." pct2 WHERE pct2.status='public'
                       ) pat
                  ON pat.catId = pct.id ";
        }

        break;
    }
    $sql.="ORDER BY global_rank;";

    $result=pwg_query($sql);
    if($result)
    {
      while($row=pwg_db_fetch_assoc($result))
      {
        $row['level']=$startLevel+substr_count($row['rank'], '.');

        /* rank is in formated without leading zero, giving bad order
         *  1
         *  1.10
         *  1.11
         *  1.2
         *  1.3
         *  ....
         *
         *  this loop cp,vert all sub rank in four 0 format, allowing to order
         *  categories easily
         *  0001
         *  0001.0010
         *  0001.0011
         *  0001.0002
         *  0001.0003
         */
        $row['rank']=explode('.', $row['rank']);
        foreach($row['rank'] as $key=>$rank)
        {
          $row['rank'][$key]=str_pad($rank, 4, '0', STR_PAD_LEFT);
        }
        $row['rank']=implode('.', $row['rank']);

        $returned[]=$row;
      }
    }

    if($this->options['galleryRoot'])
    {
      $returned[]=array(
        'id'     => 0,
        'name'   => l10n('All the gallery'),
        'rank'   => '0000',
        'level'  => 0,
        'status' => 'public',
        'childs'  => null
      );
    }

    usort($returned, array(&$this, 'compareCat'));

    if($this->options['tree'])
    {
      $index=0;
      $returned=$this->buildSubLevel($returned, $index);
    }
    else
    {
      //check if cats have childs & remove rank (enlight the response)
      $prevLevel=-1;
      for($i=count($returned)-1;$i>=0;$i--)
      {
        unset($returned[$i]['rank']);
        if($returned[$i]['status']=='private')
        {
          $returned[$i]['status']='0';
        }
        else
        {
          $returned[$i]['status']='1';
        }

        if($returned[$i]['level']>=$prevLevel)
        {
          $returned[$i]['childs']=false;
        }
        else
        {
          $returned[$i]['childs']=true;
        }
        $prevLevel=$returned[$i]['level'];
      }
    }

    return($returned);
  }

  /**
   * used for sort comparison
   * defined as public, but don't use it directly
   *
   * this function compare two categorie with their rank value
   */
  public function compareCat($catA, $catB)
  {
    if($catA['rank'] == $catB['rank'])
    {
      return(0);
    }
    return( ($catA['rank'] < $catB['rank'])?-1:1 );
  }


  /**
   * used to convert a flat array in a leveled array
   */
  private function buildSubLevel(&$list, &$currentIndex)
  {
    $returned=array();

    $localIndex=$currentIndex;
    $list[$localIndex]['childs']=array();
    // reduce size of returned data
    unset($list[$currentIndex]['rank']);
    if($list[$currentIndex]['status']=='private')
    {
      $list[$currentIndex]['status']='0';
    }
    else
    {
      $list[$currentIndex]['status']='1';
    }
    $currentIndex++;


    while($currentIndex<count($list))
    {
      if($list[$currentIndex]['level']>$list[$localIndex]['level'])
      {
        $list[$localIndex]['childs']=$this->buildSubLevel($list, $currentIndex);
      }
      else if($list[$currentIndex]['level']==$list[$localIndex]['level'])
      {
        $returned[]=$list[$localIndex];

        $localIndex=$currentIndex;
        $list[$currentIndex]['childs']=array();

        // reduce size of returned data
        unset($list[$currentIndex]['rank']);
        if($list[$currentIndex]['status']=='private')
        {
          $list[$currentIndex]['status']='0';
        }
        else
        {
          $list[$currentIndex]['status']='1';
        }

        $currentIndex++;
      }
      else
      {
        $returned[]=$list[$localIndex];
        return($returned);
      }
    }
    $returned[]=$list[$localIndex];

    return($returned);
  }

}
/*

*/
