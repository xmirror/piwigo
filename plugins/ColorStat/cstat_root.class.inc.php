<?php
/* -----------------------------------------------------------------------------
  Plugin     : ColorStat
  Author     : Grum
    email    : grum@piwigo.org
    website  : http://photos.grum.fr

    << May the Little SpaceFrog be with you ! >>
  ------------------------------------------------------------------------------
  See main.inc.php for release information

  CStat_root : common classe for admin and public classes

  --------------------------------------------------------------------------- */

  if(!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');


  include_once('cstat_version.inc.php'); // => Don't forget to update this file !!
  include_once('cstat_colorstat.class.inc.php');
  include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/CommonPlugin.class.inc.php');
  include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCCss.class.inc.php');
  include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCAjax.class.inc.php');

  class CStat_root extends CommonPlugin
  {
    static public $pluginName='ColorStat';
    static public $pluginNameFile='cstat';
    static public $pluginTables=array('images', 'color_table', 'images_colors');
    static public $colorTableSize=Array('small' => Array(30,20), 'large' => Array(10,10));

    protected $css;   //the css object

    public function __construct($prefixeTable, $filelocation)
    {
      $this->setPluginName(self::$pluginName);
      $this->setPluginNameFiles(self::$pluginNameFile);
      parent::__construct($prefixeTable, $filelocation);
      $this->section_name=$this->getPluginNameFiles();

      $this->setTablesList(self::$pluginTables);


      $this->css = new GPCCss(dirname($this->getFileLocation()).'/'.$this->getPluginNameFiles().".css");
    }

    public function __destruct()
    {
      unset($this->css);
      parent::__destruct();
    }

    public function initEvents()
    {
      parent::initEvents();
      add_event_handler('blockmanager_register_blocks', array(&$this, 'register_blocks') );
    }

    /*
      menu block management
    */
    public function register_blocks()
    {
    }

    /*
      intialize default values
    */
    public function initConfig()
    {
      //global $user;
      $this->config=array(
        'newInstall' => 'n',
        'analyze_maxTime' => 1,
        'analyze_colorTable' => 'small',
        'analyze_pps' => 0,
        'analyze_ppsQuality' => 7500,
        'analyze_itemPerRequest' => 10,
        'display_gallery_showColors' => 'n',
        'display_gallery_colorSize' => 15,
        'display_stat_orderType' => 'img',
        'stat_minPct' => 1.5,
      );
    }

    /* ---------------------------------------------------------------------------
      ajax functions
    --------------------------------------------------------------------------- */

    /**
     * this function return the number of pixels analyzed per second for an image
     *
     * @param Integer $quality : quality used to analyze the performance
     *                           a quality of 1 is the best quality (process is
     *                           longuer so, analyze is better)
     * @param Boolean $update  : if yes, update the config with the current pps
     * @return Integer : pps
     */
    protected function ajax_cstat_ppsBench($quality, $update)
    {
      ColorStat::getFileColors(
        dirname($this->getFileLocation()).'/image/sample1.png',
        ColorStat::getColorTable(CStat_root::$colorTableSize['small'][0],CStat_root::$colorTableSize['small'][1]),
        Array('quality' => $quality, 'numColors' => 16)
      );

      if($update)
      {
        $this->config['analyze_pps']=ColorStat::$fileColorsStat['pps'];
        $this->saveConfig();
      }

      return(ColorStat::$fileColorsStat['pps']);
    }

  } //class


  class CStat_functions
  {
    static private $tables = Array();
    static private $config = Array();

    /**
     * initialise the class
     *
     * @param String $prefixeTable : the piwigo prefixe used on tables name
     * @param String $pluginNameFile : the plugin name used for tables name
     */
    static public function init($prefixeTable)
    {
      GPCCore::loadConfig(CStat_root::$pluginNameFile, self::$config);
      $list=CStat_root::$pluginTables;

      for($i=0;$i<count($list);$i++)
      {
        self::$tables[$list[$i]]=$prefixeTable.CStat_root::$pluginNameFile.'_'.$list[$i];
      }
    }

    /**
     * return a color table with stat on color
     *
     * @return Array : a color table with statistics on colors
     */
    static public function getColorTableWithStat()
    {
      $generalStats=self::getGeneralStats();

      $colors=Array();
      $sql="SELECT color_id, num_images, num_pixels
            FROM ".self::$tables['color_table']."
            WHERE num_images > 0
            ORDER BY color_id ";
      $result=pwg_query($sql);
      if($result)
      {
        while($row=pwg_db_fetch_assoc($result))
        {
          $colors[$row['color_id']]=Array('num_images' => $row['num_images'], 'num_pixels' => $row['num_pixels']);
        }
      }

      $colorTable=ColorStat::getColorTable(
       CStat_root::$colorTableSize[self::$config['analyze_colorTable']][0],
       CStat_root::$colorTableSize[self::$config['analyze_colorTable']][1]
      );

      foreach($colorTable as $key=>$hue)
      {
        foreach($hue as $key2=>$saturation)
        {
          foreach($saturation as $key3=>$value)
          {
            $rgb=$value->getRGB()->getHexString();
            $colorTable[$key][$key2][$key3]=Array(
              'color' => $rgb,
              'pct'   => '', //(array_key_exists($rgb, $colors))?sprintf("%.2f", round(100*$colors[$rgb]['num_pixels']/$generalStats['pixelsAnalyzedSum'],2)):"",
              'num'   => (array_key_exists($rgb, $colors))?$colors[$rgb]['num_images']:"",
            );
          }
        }
      }

      unset($colors);
      return($colorTable);
    }


    /**
     * return HTML code for a given colorTable
     *
     * @param Array $colorTable : a color table, typically made with the
     *                            ColorStat::getColorTable() function
     * @param Int $size         : size for colorbox in the HTML table
     * @return String : HTML code
     */
    static public function htmlColorTable($colorTable, $size=5, $id="", $class="", $br='<br>')
    {
      global $template;

      $template->set_filename('color_table_page',
                    dirname(__FILE__).'/templates/cstat_color_table.tpl');

      switch(count($colorTable))
      {
        case 12;
          $break=4;
          $size=10;
          break;
        case 15;
          $break=5;
          $size=10;
          break;
        case 18;
          $break=6;
          $size=5;
          break;
        case 20;
          $break=5;
          $size=10;
          break;
        case 24;
          $break=6;
          $size=5;
          break;
        case 30;
          $break=6;
          $size=5;
          break;
        case 36;
          $break=6;
          $size=5;
          break;
        case 45;
          $break=9;
          $size=3;
          break;
      }

      $colors=Array();
      $nbHue=count($colorTable);
      $nbStep=count($colorTable[0]);
      $col=0;
      $row=0;
      foreach($colorTable as $key => $hue)
      {
        $lrow=0;
        foreach($hue as $key2 => $saturation)
        {
          $lcol=0;
          foreach($saturation as $key3 => $value)
          {
            //if(!($col!=0 and $hsv['V']==0) and !($row!=0 and $hsv['S']==0))
            $trow=$lcol+$col*$nbStep;
            $tcol=$lrow+$row*$nbStep;

            if($colorTable[$key][$key2][$key3] instanceof HSV)
            {
              $colors[$tcol][$trow]=Array('color' => $colorTable[$key][$key2][$key3]->getRGB()->getHexString(), 'pct' => "", 'num' => "");
            }
            elseif(is_array($colorTable[$key][$key2][$key3]))
            {
              $colors[$tcol][$trow]=Array(
                'color' => (array_key_exists('color', $colorTable[$key][$key2][$key3]))?$colorTable[$key][$key2][$key3]['color']:"",
                'pct' => (array_key_exists('pct', $colorTable[$key][$key2][$key3]))?$colorTable[$key][$key2][$key3]['pct']:"",
                'num' => (array_key_exists('num', $colorTable[$key][$key2][$key3]))?$colorTable[$key][$key2][$key3]['num']:"",
              );
            }
            else
            {
              $colors[$tcol][$trow]=Array('color' => $colorTable[$key][$key2][$key3], 'pct' => "", 'num' => "");
            }
            $lcol++;
          }
          $lrow++;
        }

        $col++;
        if($col==$break)
        {
          $col=0;
          $row++;
        }
      }

      $data=array(
        'colorTable' => $colors,
        'size' => $size,
        'id' => $id,
        'class' => $class,
        'br' => $br,
      );

      $template->assign('data', $data);
      unset($data);

      return($template->parse('color_table_page', true));
    }

    /**
     * return HTML code for a given colors list
     *
     * @param Array $colors : list of colors
     * @param Int $size     : size for colorbox in the HTML table
     * @return String : HTML code
     */
    static public function htmlColorList($colorList, $split=8, $size=5, $id="", $class="", $br='<br>')
    {
      global $template;

      $template->set_filename('color_table_page',
                    dirname(__FILE__).'/templates/cstat_color_table.tpl');

      $colors=Array();

      $row=0;
      $num=0;
      foreach($colorList as $key => $val)
      {
        $colors[$row][]=Array('color' => $key, 'pct' => $val['pct'], 'num' => "");
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
        'br' => $br,
      );

      $template->assign('data', $data);
      unset($data);

      return($template->parse('color_table_page', true));
    }

    /**
     * returns an array of colors & colors percent of an image
     *
     * @param Integer $imageId : id of the image
     * @return Array('colors' => Array(), 'colors_pct' => Array())
     */
    static public function getImageColors($imageId)
    {
      $returned=Array(
        'colors' => Array(),
        'colors_pct' => Array(),
      );

      $sql="SELECT colors, colors_pct
            FROM ".self::$tables['images']."
            WHERE image_id='".$imageId."'";
      $result=pwg_query($sql);
      if($result)
      {
        while($row=pwg_db_fetch_assoc($result))
        {
          $returned['colors']=explode(',', $row['colors']);
          $returned['colors_pct']=explode(',', $row['colors_pct']);
        }
      }
      return($returned);
    }


    /**
     *  return all HTML&JS code necessary to display a dialogbox to choose
     *  colors
     */
    static public function dialogBoxColor()
    {
      global $template;

      $template->set_filename('colors_choose',
                    dirname(__FILE__).'/templates/cstat_dialog_colors_choose.tpl');

      $colorTable=CStat_functions::getColorTableWithStat();

      $datas=Array(
        'colorTable' => CStat_functions::htmlColorTable(
                          $colorTable,
                          (self::$config['analyze_colorTable']=='small')?16:8,
                          "",
                          "color0px"
                        ),
        //'urlRequest' => $this->getAdminLink(),
      );

      $template->assign('datas', $datas);
      unset($data);

      return($template->parse('colors_choose', true));
    }


    /**
     * returns general stats on the analyzed colors process
     *
     * @return Array : array with keys
     *                  'nbImages',  'timeMax',  'timeMin', 'timeSum',
     *                  'pixelsAnalyzedMax', 'pixelsAnalyzedMin',
     *                  'pixelsAnalyzedAvg', 'pixelsAnalyzedSum', 'totalPixels',
     *                  'ppsMax', 'ppsMin', 'ppsAvg', 'qualityMax',
     *                  'qualityMin', 'qualityAvg'
     */
    static public function getGeneralStats()
    {
      $returned=Array(
        'nbImages' => 0,
        'timeMax' => 0,
        'timeMin' => 0,
        'timeSum' => 0,
        'pixelsAnalyzedMax' => 0,
        'pixelsAnalyzedMin' => 0,
        'pixelsAnalyzedAvg' => 0,
        'pixelsAnalyzedSum' => 0,
        'totalPixels' => 0,
        'ppsMax' => 0,
        'ppsMin' => 0,
        'ppsAvg' => 0,
        'qualityMax' => 0,
        'qualityMin' => 0,
        'qualityAvg' => 0,
      );
      $sql="SELECT COUNT(image_id) AS nbImages,
                   MAX(time) AS timeMax,
                   MIN(time) AS timeMin,
                   SUM(time) AS timeSum,
                   MAX(analyzed_pixels) AS pixelsAnalyzedMax,
                   MIN(analyzed_pixels) AS pixelsAnalyzedMin,
                   AVG(analyzed_pixels) AS pixelsAnalyzedAvg,
                   SUM(analyzed_pixels) AS pixelsAnalyzedSum,
                   SUM(num_pixels) AS totalPixels,
                   MAX(pps) AS ppsMax,
                   MIN(pps) AS ppsMin,
                   AVG(pps) AS ppsAvg,
                   MAX(quality) AS qualityMax,
                   MIN(quality) AS qualityMin,
                   AVG(quality) AS qualityAvg
            FROM ".self::$tables['images']."
            WHERE analyzed='y';";
      $result=pwg_query($sql);
      if($result)
      {
        while($row=pwg_db_fetch_assoc($result))
        {
          $returned=$row;
        }
      }
      return($returned);
    }

  } //CStat_functions

?>
