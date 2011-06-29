<?php
/* -----------------------------------------------------------------------------
  Plugin     : ColorStat
  Author     : Grum
    email    : grum@piwigo.org
    website  : http://photos.grum.fr

    << May the Little SpaceFrog be with you ! >>
  ------------------------------------------------------------------------------
  See main.inc.php for release information

  CStat_Install : classe to manage plugin install

  --------------------------------------------------------------------------- */

  if(!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

  include_once('cstat_root.class.inc.php');
  include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCTables.class.inc.php');
  include_once(PHPWG_PLUGINS_PATH.'GrumPluginClasses/classes/GPCRequestBuilder.class.inc.php');

  /* CStat class for install process */
  class CStat_Install extends CStat_root
  {
    private $tablef;

    public function __construct($prefixeTable, $filelocation)
    {
      parent::__construct($prefixeTable, $filelocation);
      $this->tablef= new GPCTables($this->tables);
    }

    public function __destruct()
    {
      unset($this->tablef);
      parent::__destruct();
    }

    /*
        function for installation process
        return true if install process is ok, otherwise false
    */
    public function install()
    {
      $this->initConfig();
      $this->loadConfig();
      $this->config['installed']=CSTAT_VERSION2;
      $this->config['newInstall']='y';
      $this->saveConfig();

      $tables_def=array(
"CREATE TABLE `".$this->tables['color_table']."` (
  `color_id` CHAR(6)  NOT NULL DEFAULT 000000,
  `hue` INT UNSIGNED NOT NULL DEFAULT 0,
  `saturation` INT UNSIGNED NOT NULL DEFAULT 0,
  `value` INT UNSIGNED NOT NULL DEFAULT 0,
  `num_images` INT UNSIGNED NOT NULL DEFAULT 0,
  `num_pixels` INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`color_id`),
  INDEX `hue`(`hue`)
)
CHARACTER SET utf8 COLLATE utf8_general_ci",

"CREATE TABLE `".$this->tables['images_colors']."` (
  `image_id` MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT 0,
  `color_id` CHAR(6)  NOT NULL DEFAULT 000000,
  `pct` float unsigned NOT NULL default '0',
  `num_pixels` INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`image_id`, `color_id`),
  KEY `by_color` (`pct`,`color_id`)
)
CHARACTER SET utf8 COLLATE utf8_general_ci",

"CREATE TABLE `".$this->tables['images']."` (
  `image_id` mediumint(8) unsigned NOT NULL,
  `analyzed` char(1) NOT NULL default 'n',
  `num_colors` int(10) unsigned NOT NULL default '0',
  `num_pixels` int(10) unsigned NOT NULL default '0',
  `analyzed_pixels` int(10) unsigned NOT NULL default '0',
  `pps` int(10) unsigned NOT NULL default '0',
  `time` float unsigned NOT NULL default '0',
  `quality` tinyint(4) NOT NULL default '0',
  `colors` char(111) NOT NULL default '',
  `colors_pct` char(111) NOT NULL default '',
  PRIMARY KEY  (`image_id`),
  KEY `by_analyzed` (`analyzed`)
)",
      );

      $result=$this->tablef->create($tables_def);

      GPCCore::register($this->getPluginName(), CSTAT_VERSION, CSTAT_GPC_NEEDED);

      return($result);
    }


    /*
        function for uninstall process
    */
    public function uninstall()
    {
      GPCCore::unregister($this->getPluginName());

      $this->deleteConfig();
      $this->tablef->drop();
      return('');
    }

    public function activate()
    {
      global $template;

      $this->initConfig();
      $this->loadConfig();
      $this->config['installed']=CSTAT_VERSION2;
      $this->saveConfig();

      /*
      pwg_query("DELETE FROM ".$this->tables['color_table']);
      pwg_query("DELETE FROM ".$this->tables['images_colors']);
      pwg_query("UPDATE ".$this->tables['images']."
                  SET analyzed='n',
                      num_colors=0,
                      num_pixels=0,
                      analyzed_pixels=0,
                      pps=0,
                      time=0,
                      quality=0;");
      pwg_query("INSERT INTO ".$this->tables['images']."
                  SELECT id, 'n', 0, 0, 0, 0, 0, 0, '', ''
                    FROM ".IMAGES_TABLE."
                    WHERE id NOT IN (SELECT image_id FROM ".$this->tables['images'].")");
      */

      GPCCore::register($this->getPluginName(), CSTAT_VERSION, CSTAT_GPC_NEEDED);
      GPCRequestBuilder::register($this->getPluginName(), dirname($this->getFileLocation()).'/cstat_rb_callback.class.inc.php');

      return('');
    }

    public function deactivate()
    {
      GPCRequestBuilder::unregister($this->getPluginName());
    }

  } //class

?>
