<?php
/*
 * -----------------------------------------------------------------------------
 * Plugin Name: UserStat
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
 * UserStat_install : classe to manage plugin install
 * ---------------------------------------------------------------------------
 */

if (!defined('PHPWG_ROOT_PATH')) { die('Hacking attempt!'); }

include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/CommonPlugin.class.inc.php');
include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCCss.class.inc.php');

class UserStat_root extends CommonPlugin
{
  protected $css;   //the css object

  public function __construct($prefixeTable, $filelocation)
  {
    $this->setPluginName("UserStat");
    $this->setPluginNameFiles("userstat");
    parent::__construct($prefixeTable, $filelocation);
    $this->css = new GPCCss(dirname($this->getFileLocation()).'/'.$this->getPluginNameFiles().".css");
  }

  public function __destruct()
  {
    unset($this->css);
    parent::__destruct();
  }

  /* ---------------------------------------------------------------------------
  common AIP & PIP functions
  --------------------------------------------------------------------------- */

  /* this function initialize var $config with default values */
  /*
    initialization of config properties
  */
  function initConfig()
  {
    $this->config=array(
    );
  }

}



?>
