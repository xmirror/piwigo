<?php
/* -----------------------------------------------------------------------------
  Plugin     : UserStat
  Author     : Grum
    email    : grum@piwigo.org
    website  : http://photos.grum.fr

    << May the Little SpaceFrog be with you ! >>
  ------------------------------------------------------------------------------
  See main.inc.php for release information

  --------------------------------------------------------------------------- */
  include_once('userstat_version.inc.php');
  include_once('userstat_root.class.inc.php');

  class UserStat_install extends UserStat_root
  {
    public function __construct($prefixeTable, $filelocation)
    {
      parent::__construct($prefixeTable, $filelocation);
    }

    /**
     * function for installation process
     *
     * @return Bool : true if install process is ok, otherwise false
     */
    public function install()
    {
      $this->initConfig();
      $this->loadConfig();
      $this->config['installed']=USERSTAT_VERSION2;
      $this->config['newInstall']='y';
      $this->saveConfig();

      GPCCore::register($this->getPluginName(), USERSTAT_VERSION, USERSTAT_GPC_NEEDED);

      return(true);
    }


    /**
     * function for uninstall process
     */
    public function uninstall()
    {
      $this->deleteConfig();
      GPCCore::unregister($this->getPluginName());
    }

    public function activate()
    {
      global $template;

      $this->initConfig();
      $this->loadConfig();

      $this->config['newInstall']='n';
      $this->config['installed']=AMM_VERSION2; //update the installed release number
      $this->saveConfig();

      GPCCore::register($this->getPluginName(), AMM_VERSION, AMM_GPC_NEEDED);
    }

    public function deactivate()
    {
    }

  } //class

?>
