<?php
/* -----------------------------------------------------------------------------
  Plugin     : ColorStat
  Author     : Grum
    email    : grum@piwigo.org
    website  : http://photos.grum.fr

    << May the Little SpaceFrog be with you ! >>
  ------------------------------------------------------------------------------
  See main.inc.php for release information

  CStat_PIP : classe to manage plugin public pages

  --------------------------------------------------------------------------- */

include_once('cstat_root.class.inc.php');
//include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCPublicIntegration.class.inc.php');

class CStat_PIP extends CStat_root
{
  protected $section_page;

  public function __construct($prefixeTable, $filelocation)
  {
    parent::__construct($prefixeTable, $filelocation);
    $this->loadConfig();

    $this->initEvents();
    $this->load_lang();
  }

  public function __destruct()
  {
    unset($section_page);
    parent::__destruct();
  }

  /**
   * load language file
   */
  public function load_lang()
  {
    global $lang;

    load_language('plugin.lang', CSTAT_PATH);
  }

  /**
   * initialize events call for the plugin
   */
  public function initEvents()
  {
    parent::initEvents();

    if($this->config['display_gallery_showColors']=='y')
    {
      add_event_handler('loc_begin_picture', array(&$this, 'addColors'));
    }
  }



  /* -------------------------------------------------------------------------
    FUNCTIONS TO MANAGE COLORS DISPLAY
  ------------------------------------------------------------------------- */
  public function addColors()
  {
    global $page, $template;

    $colors=CStat_functions::getImageColors($page['image_id']);


    if(count($colors['colors'])>0)
    {
      $metadata=$template->get_template_vars('metadata');

      $tmp=Array();

      for($i=0;$i<count($colors['colors']);$i++)
      {
        $tmp[$colors['colors'][$i]]['pct']=$colors['colors_pct'][$i];
      }

      $colorsNfo=Array(
        'TITLE' => l10n('cstat_colors'),
        'lines' => Array(
          l10n('cstat_colors_on_image') => CStat_functions::htmlColorList($tmp, 8, 25, "", "color1px", "/"),
        )
      );

      $metadata[]=$colorsNfo;

      $template->assign('metadata', $metadata);
    }
  }



  /* ---------------------------------------------------------------------------
    ajax functions
  --------------------------------------------------------------------------- */

} //class

?>
