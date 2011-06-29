<?php
/*
 * -----------------------------------------------------------------------------
 * Plugin Name: Advanced MetaData
 * -----------------------------------------------------------------------------
 * Author     : Grum
 *   email    : grum@piwigo.org
 *   website  : http://photos.grum.fr
 *   PWG user : http://forum.piwigo.org/profile.php?id=3706
 *
 *   << May the Little SpaceFrog be with you ! >>
 *
 * -----------------------------------------------------------------------------
 *
 * See main.inc.php for release information
 *
 * RBCallBackAMetadata classe => used for the request builder
 *
 * -----------------------------------------------------------------------------
 */
  global $user;

  if(!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

  //include_once('')
  include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCRequestBuilder.class.inc.php');

  load_language('plugin.lang', AMD_PATH);


  if(isset($user['language']))
  {
    L10n::setLanguage($user['language']);
  }

class RBCallBackAMetaData extends GPCSearchCallback {

  /**
   * the getImageId returns the name of the image id attribute
   * return String
   */
  static public function getImageId()
  {
    return("pait.imageId");
  }

  /**
   * the getSelect function must return an attribute list separated with a comma
   *
   * "att1, att2, att3, att4"
   */
  static public function getSelect($param="")
  {
    return(" pait.value AS amdValue, paut.name AS amdName ");
  }

  /**
   * the getFrom function must return a tables list separated with a comma
   *
   * "table1, (table2 left join table3 on table2.key = table3.key), table4"
   */
  static public function getFrom($param="")
  {
    global $prefixeTable;

    return($prefixeTable."amd_images_tags pait
                            LEFT JOIN ".$prefixeTable."amd_used_tags paut
                            ON pait.numId = paut.numId ");
  }

  /**
   * the getWhere function must return a ready to use where clause
   *
   * "(att1 = value0 OR att2 = value1) AND att4 LIKE value2 "
   */
  static public function getWhere($param="")
  {
    switch($param['conditionIf'])
    {
      case 'E':
        $returned="pait.numId = ".$param['metaNumId'];
        break;
      case '!E':
        $returned="pait.numId = ".$param['metaNumId'];
        break;
      case '=':
        $returned="pait.numId = ".$param['metaNumId']." AND ";

        $tmp=array();
        foreach($param['listValues'] as $key=>$val)
        {
          $tmp[]="pait.value = '".$val."'";
        }
        $returned.="(".implode(' OR ', $tmp).")";
        break;
      case '!=':
        $returned="pait.numId = ".$param['metaNumId']." AND NOT ";

        $tmp=array();
        foreach($param['listValues'] as $key=>$val)
        {
          $tmp[]="pait.value = '".$val."'";
        }
        $returned.="(".implode(' OR ', $tmp).")";
        break;
      case '%':
        $returned="pait.numId = ".$param['metaNumId']." AND ";

        $tmp=array();
        foreach($param['listValues'] as $key=>$val)
        {
          $tmp[]="pait.value LIKE '%".$val."%'";
        }
        $returned.="(".implode(' OR ', $tmp).")";
        break;
      case '!%':
        $returned="pait.numId = ".$param['metaNumId']." AND NOT ";

        $tmp=array();
        foreach($param['listValues'] as $key=>$val)
        {
          $tmp[]="pait.value LIKE '%".$val."%'";
        }
        $returned.="(".implode(' OR ', $tmp).")";
        break;
      case '^%':
        $returned="pait.numId = ".$param['metaNumId']." AND ";

        $tmp=array();
        foreach($param['listValues'] as $key=>$val)
        {
          $tmp[]="pait.value LIKE '".$val."%'";
        }
        $returned.="(".implode(' OR ', $tmp).")";
        break;
      case '!^%':
        $returned="pait.numId = ".$param['metaNumId']." AND NOT ";

        $tmp=array();
        foreach($param['listValues'] as $key=>$val)
        {
          $tmp[]="pait.value LIKE '".$val."%'";
        }
        $returned.="(".implode(' OR ', $tmp).")";
        break;
      case '$%':
        $returned="pait.numId = ".$param['metaNumId']." AND ";

        $tmp=array();
        foreach($param['listValues'] as $key=>$val)
        {
          $tmp[]="pait.value LIKE '%".$val."'";
        }
        $returned.="(".implode(' OR ', $tmp).")";
        break;
      case '!$%':
        $returned="pait.numId = ".$param['metaNumId']." AND NOT ";

        $tmp=array();
        foreach($param['listValues'] as $key=>$val)
        {
          $tmp[]="pait.value LIKE '%".$val."'";
        }
        $returned.="(".implode(' OR ', $tmp).")";
        break;
    }

    return($returned);
  }

  /**
   * the getJoin function must return a ready to use where allowing to join the
   * IMAGES table (key : id) with given conditions
   *
   * "att3 = pit.id "
   */
  static public function getJoin($param="")
  {
    return("pit.id = pait.imageId");
  }


  /**
   * the getFilter function must return a ready to use where clause
   * this where clause is used to filter the cache when the used tables can
   * return more than one result
   *
   * the filter is equal to the where clause, or is equal to a part of the where
   * clause
   *
   */
  static public function getFilter($param="")
  {
    return("pait.numId = ".$param['metaNumId']);
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
    /* attributes is an array :
     *    Array(
     *      'amdValue' => 'value1#sep#value2#...#sep#valueN'
     *      'amdTagId' => 'tagId1#sep#tagId2#...#sep#tagIdN'
     *    );
     */
    $returned='';

    $values=explode('#sep#', $attributes['amdValue']);
    $tagIds=explode('#sep#', $attributes['amdName']);

    foreach($tagIds as $key => $val)
    {
      if($returned!='') $returned.='<br>';

      $returned.="<span style='font-weight:bold;'>".L10n::get($val)."</span>&nbsp;:&nbsp;".L10n::get($values[$key]);
    }

    return($returned);
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
   *        eventOK : a callback function, called when the OK button is pushed
   *        id:
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
    return(AMD_functions::dialogBoxMetadata());
  }

  /**
   * this function returns the label displayed in the criterion menu
   *
   * @return String : label displayed in the criterions menu
   */
  static public function getInterfaceLabel()
  {
    return(l10n('g003_add_metadata'));
  }

  /**
   * this function returns the name of the dialog box class
   *
   * @return String : name of the dialogbox class
   */
  static public function getInterfaceDBClass()
  {
    return('dialogChooseMetadataBox');
  }

}

?>
