<?php
/* -----------------------------------------------------------------------------
  Plugin     : Grum Plugin Classes - 3
  Author     : Grum
    email    : grum@piwigo.org
    website  : http://photos.grum.fr

    << May the Little SpaceFrog be with you ! >>
  ------------------------------------------------------------------------------
  See main.inc.php for release information

  UserStat_AIM : classe to manage plugin integration into plugin menu

  --------------------------------------------------------------------------- */

if (!defined('PHPWG_ROOT_PATH')) { die('Hacking attempt!'); }

include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/CommonPlugin.class.inc.php');
include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCCss.class.inc.php');

class GPC_AIM extends CommonPlugin
{
  protected $css = null;

  public function __construct($prefixeTable, $filelocation)
  {
    $this->setPluginName("Grum Plugin Classes");
    $this->setPluginNameFiles("gpc");
    parent::__construct($prefixeTable, $filelocation);
    $this->css = new GPCCss(dirname($this->getFileLocation()).'/'.$this->getPluginNameFiles().".css");
  }

  public function __destruct()
  {
    unset($this->css);
    parent::__destruct();
  }

  /*
    initialize events call for the plugin
  */
  function initEvents()
  {
    add_event_handler('get_admin_plugin_menu_links', array(&$this, 'pluginAdminMenu') );
  }



  /* ---------------------------------------------------------------------------
  Function needed for plugin activation
  --------------------------------------------------------------------------- */



} // GPC_AIM class


?>
