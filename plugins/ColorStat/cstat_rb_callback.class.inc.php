<?php
/* -----------------------------------------------------------------------------
  Plugin     : ColorStat
  Author     : Grum
    email    : grum@piwigo.org
    website  : http://photos.grum.fr

    << May the Little SpaceFrog be with you ! >>
  ------------------------------------------------------------------------------
  See main.inc.php for release information


  --------------------------------------------------------------------------- */

  if(!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

  //include_once('')
  include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCRequestBuilder.class.inc.php');

load_language('plugin.lang', CSTAT_PATH);

class RBCallBackColorStat extends GPCSearchCallback {

  /**
   * the getImageId returns the name of the image id attribute
   * return String
   */
  static public function getImageId()
  {
    return("pci.image_id");
  }

  /**
   * the getSelect function must return an attribute list separated with a comma
   *
   * "att1, att2, att3, att4"
   */
  static public function getSelect($param="")
  {
    return("pci.colors AS csColors, pci.colors_pct AS csColorsPct");
  }

  /**
   * the getFrom function must return a tables list separated with a comma
   *
   * "table1, (table2 left join table3 on table2.key = table3.key), table4"
   */
  static public function getFrom($param="")
  {
    global $prefixeTable;

    return($prefixeTable."cstat_images pci");
  }

  /**
   * the getWhere function must return a ready to use where clause
   *
   * "(att1 = value0 OR att2 = value1) AND att4 LIKE value2 "
   */
  static public function getWhere($param="")
  {
    $returned='';

    $not=false;
    if($param['mode']=='not')
    {
      $param['mode']='or';
      $not=true;
    }

    $colors=explode(',', $param['colors']);
    if(count($colors)>0)
    {
      foreach($colors as $key=>$val)
      {
        if($returned!='') $returned.=" ".$param['mode']." ";
        $returned.=" pci.analyzed='y' AND pci.colors LIKE '%".trim($val)."%'";
      }
    }

    if($not) $returned=' NOT('.$returned.') ';

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
    return("pci.image_id = pit.id");
  }


  /**
   * the getFilter function must return a ready to use where clause
   * this where clause is used to filter the cache when the used tables can
   * return more than one result
   *
   * the filter can be empty, can be equal to the where clause, or can be equal
   * to a sub part of the where clause
   *
   */
  static public function getFilter($param="")
  {
    return(self::getWhere($param));
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
     *      'csColors' => 'color1,color2,color3,...,colorN',
     *      'csColorsPct' => 'pct1,pct2,pct3,...,pctN'
     *    );
     */
    $colors=explode(',', $attributes['csColors']);
    $pct=explode(',', $attributes['csColorsPct']);

    $colorList=Array();
    $i=0;
    foreach($colors as $key => $val)
    {
      $colorList[$val]=$pct[$i];
      $i++;
    }
    return(self::htmlColorList($colorList, 16, 15,"","color1px"));
  }


  /**
   * return HTML code for a given colors list
   *
   *
   * @param Array $colors : list of colors
   * @param Int $size     : size for colorbox in the HTML table
   * @return String : HTML code
   */
  static private function htmlColorList($colorList, $split=8, $size=5, $id="", $class="")
  {
    global $template;

    $template->set_filename('color_table_page',
                  dirname(__FILE__).'/templates/cstat_color_table.tpl');

    $colors=Array();

    $row=0;
    $num=0;
    foreach($colorList as $key => $val)
    {
      $colors[$row][]=Array('color' => $key, 'pct' => $val, 'num' => "");
      $num++;
      if($num==$split)
      {
        $num=0;
        $row++;
      }
    }

    $data=array(
      'colorTable' => $colors,
      'size' => $size,
      'id' => $id,
      'class' => $class,
      'br' => '<br>',
    );

    $template->assign('data', $data);
    unset($data);

    return($template->parse('color_table_page', true));
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
    return(CStat_functions::dialogBoxColor());
  }

  /**
   * this function returns the label displayed in the criterion menu
   *
   * @return String : label displayed in the criterions menu
   */
  static public function getInterfaceLabel()
  {
    return(l10n('cstat_add_colors'));
  }

  /**
   * this function returns the name of the dialog box class
   *
   * @return String : name of the dialogbox class
   */
  static public function getInterfaceDBClass()
  {
    return('dialogChooseColorBox');
  }

}

?>
