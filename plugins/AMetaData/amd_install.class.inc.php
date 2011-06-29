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
 * AMD_install : classe to manage plugin install
 * ---------------------------------------------------------------------------
 */

  include_once('amd_root.class.inc.php');

  class AMD_install extends AMD_root
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
     * function for installation process
     * return true if install process is ok, otherwise false
     */
    public function install()
    {
      global $user, $lang;

      $this->initConfig();
      $this->loadConfig();
      $this->config['amd_FillDataBaseIgnoreSchemas']=array('exif', 'iptc', 'xmp', 'com');
      $this->config['installed']=AMD_VERSION2;
      $this->config['newInstall']='y';
      $this->saveConfig();

      $tables_def=array(
"CREATE TABLE `".$this->tables['used_tags']."` (
  `numId` int(10) unsigned NOT NULL auto_increment,
  `tagId` varchar(80) NOT NULL default '',
  `translatable` char(1) NOT NULL default 'n',
  `name` varchar(200) NOT NULL default '',
  `numOfImg` int(10) unsigned NOT NULL default '0',
  `translatedName` varchar(200) NOT NULL default '',
  `newFromLastUpdate` char(1) NOT NULL default 'n',
  PRIMARY KEY  (`numId`),
  KEY `by_tag` (`tagId`)
);",
"CREATE TABLE `".$this->tables['images_tags']."` (
  `imageId` mediumint(8) unsigned NOT NULL default '0',
  `numId` int(10) unsigned NOT NULL default '0',
  `value` text,
  `numValue` decimal(10,8) default NULL,
  PRIMARY KEY  USING BTREE (`imageId`,`numId`),
  KEY `byNumId` (`numId`,`value`(35)),
  KEY `byNumId2` (`numId`,`numValue`)
);",
"CREATE TABLE `".$this->tables['images']."` (
  `imageId` MEDIUMINT(8) UNSIGNED NOT NULL,
  `analyzed` CHAR(1)  NOT NULL DEFAULT 'n',
  `nbTags` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY (`imageId`)
);",
"CREATE TABLE `".$this->tables['selected_tags']."` (
  `tagId` VARCHAR(80)  NOT NULL,
  `order` INTEGER UNSIGNED NOT NULL DEFAULT 0,
  `groupId` INTEGER  NOT NULL DEFAULT -1,
  PRIMARY KEY (`tagId`)
);",
"CREATE TABLE `".$this->tables['groups_names']."` (
  `groupId` INTEGER  NOT NULL,
  `lang` CHAR(5)  NOT NULL,
  `name` VARCHAR(80)  NOT NULL,
  PRIMARY KEY (`groupId`, `lang`)
);",
"CREATE TABLE `".$this->tables['groups']."` (
  `groupId` INTEGER  NOT NULL AUTO_INCREMENT,
  `order` INTEGER UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`groupId`)
);",
"CREATE TABLE `".$this->tables['user_tags_label']."` (
  `numId` INTEGER UNSIGNED NOT NULL,
  `lang` CHAR(5)  NOT NULL,
  `label` VARCHAR(200)  NOT NULL,
  PRIMARY KEY (`numId`, `lang`)
);",
"CREATE TABLE `".$this->tables['user_tags_def']."` (
  `numId` int(10) unsigned NOT NULL COMMENT 'Id of the tag',
  `defId` int(10) unsigned NOT NULL default '0' COMMENT 'also used for ordering',
  `parentId` int(10) unsigned NOT NULL default '0' COMMENT 'Id of the parent',
  `order` int(10) unsigned NOT NULL,
  `type` char(1) NOT NULL default 'T' COMMENT 'T = static text ; M = metadata value ; C = condition',
  `value` varchar(200) NOT NULL,
  `conditionType` char(2) NOT NULL default 'E',
  `conditionValue` varchar(200) NOT NULL,
  PRIMARY KEY  (`numId`,`defId`),
  KEY `byTagParentId` USING BTREE (`numId`,`parentId`,`order`),
  KEY `byTagOrder` (`numId`,`order`)
);",
      );


      $tables_def = create_table_add_character_set($tables_def);
      $result=$this->tablef->create($tables_def);
      unset($tables_def);


      $tablesInsert=array(
"INSERT INTO `".$this->tables['groups']."` VALUES(1, 0)",
$this->buildDefaultGroup(),
"INSERT INTO `".$this->tables['selected_tags']."` VALUES
    ('magic.Camera.Make', 0, 1),
    ('magic.Camera.Model', 1, 1),
    ('magic.ShotInfo.Lens', 2, 1),
    ('magic.ShotInfo.Aperture', 3, 1),
    ('magic.ShotInfo.Exposure', 4, 1),
    ('magic.ShotInfo.ISO', 5, 1),
    ('magic.ShotInfo.FocalLength', 6, 1),
    ('magic.ShotInfo.FocalLengthIn35mm', 7, 1),
    ('magic.ShotInfo.Flash.Fired', 8, 1)"
      );
      foreach($tablesInsert as $sql)
      {
        pwg_query($sql);
      }

      GPCCore::register($this->getPluginName(), AMD_VERSION, AMD_GPC_NEEDED);
      return($result);
    }


    /*
        function for uninstall process
    */
    public function uninstall()
    {
      $this->deleteConfig();
      $this->tablef->drop();
      GPCCore::unregister($this->getPluginName());
    }

    public function activate()
    {
      global $template, $user;

      $this->initConfig();
      $this->loadConfig();
      if(method_exists($this, 'loadConfigFromFile'))
      {
        $this->loadConfigFromFile(dirname($this->getFileLocation()).'/activatePlugin.conf.php');
      }

      /*
       * if there is no version information available, assume the previous
       *  installed release of the plugin is 0.4.0
       */
      if(!isset($this->config['installed'])) $this->config['installed']='00.04.00';

      switch($this->config['installed'])
      {
        case '00.04.00':
          $this->config['newInstall']='n';
          $this->updateFrom_000400();
        case '00.05.01':
        case '00.05.02':
          $this->config['newInstall']='n';
          $this->updateFrom_000502();
        case '00.05.03':
          $this->updateFrom_000503();
        default:
          /*
           * default is applied for fresh install, and consist to fill the
           * database with default values
           */
          $this->fillDatabase();
          break;
      }

      $this->config['amd_FillDataBaseExcludeTags']=array();
      $this->config['installed']=AMD_VERSION2; //update the installed release number
      $this->saveConfig();

      GPCCore::register($this->getPluginName(), AMD_VERSION, AMD_GPC_NEEDED);
      GPCRequestBuilder::register('AMetaData', dirname($this->getFileLocation()).'/amd_rb_callback.class.inc.php');
    }


    public function deactivate()
    {
      GPCRequestBuilder::unregister('AMetaData');
    }

    /**
     * update the database from the release 0.4.0
     */
    private function updateFrom_000400()
    {
      /*
       * create new tables & alter existing tables
       */
      $tablesCreate=array(
"CREATE TABLE `".$this->tables['user_tags_label']."` (
  `numId` INTEGER UNSIGNED NOT NULL,
  `lang` CHAR(5)  NOT NULL,
  `label` VARCHAR(200)  NOT NULL,
  PRIMARY KEY (`numId`, `lang`)
);",
"CREATE TABLE `".$this->tables['user_tags_def']."` (
  `numId` int(10) unsigned NOT NULL COMMENT 'Id of the tag',
  `defId` int(10) unsigned NOT NULL default '0' COMMENT 'also used for ordering',
  `parentId` int(10) unsigned NOT NULL default '0' COMMENT 'Id of the parent',
  `order` int(10) unsigned NOT NULL,
  `type` char(1) NOT NULL default 'T' COMMENT 'T = static text ; M = metadata value ; C = condition',
  `value` varchar(200) NOT NULL,
  `conditionType` char(2) NOT NULL default 'E',
  `conditionValue` varchar(200) NOT NULL,
  PRIMARY KEY  (`numId`,`defId`),
  KEY `byTagParentId` USING BTREE (`numId`,`parentId`,`order`),
  KEY `byTagOrder` (`numId`,`order`)
);",
      );
      $tablesUpdate=array(
        $this->tables['images_tags'] => array(
          'byNumId' => "ADD INDEX `byNumId`(`numId`, `value`(35))",
        )
      );

      $tablesDef = create_table_add_character_set($tablesCreate);

      $tablef=new GPCTables(array($this->tables['user_tags_label'], $this->tables['user_tags_def']));

      if(count($tablesCreate)>0) $tablef->create($tablesCreate);
      if(count($tablesUpdate)>0) $tablef->updateTablesFields($tablesUpdate);

      unset($tablesCreate);
      unset($tablesUpdate);
    }

    /**
     * update the database from the release 0.5.2
     */
    private function updateFrom_000502()
    {
      /*
       * alter existing tables
       */
      $tablesUpdate=array(
        $this->tables['used_tags'] => array(
          'newFromLastUpdate' => "ADD COLUMN `newFromLastUpdate` CHAR(1)  NOT NULL DEFAULT 'n' AFTER `translatedName`",
        )
      );

      $tablef=new GPCTables(array($this->tables['used_tags']));

      if(count($tablesUpdate)>0) $tablef->updateTablesFields($tablesUpdate);

      unset($tablesUpdate);
    }

    /**
     * update the database from the release 0.5.3
     */
    private function updateFrom_000503()
    {
      GPCRequestBuilder::unregister('Advanced MetaData');
    }


    /**
     * fill the database with some default value
     */
    private function fillDatabase()
    {
      if($this->config['newInstall']=='y')
      {
        $this->initializeDatabaseContent();
      }
      else
      {
        $this->updateDatabaseContent();
      }
    }

    /**
     * reset and initialize the database content (for a fresh install)
     */
    private function initializeDatabaseContent()
    {
      global $user;

      L10n::setLanguage('en_UK');

      pwg_query("DELETE FROM ".$this->tables['used_tags']);
      pwg_query("DELETE FROM ".$this->tables['images_tags']);
      pwg_query("UPDATE ".$this->tables['images']." SET analyzed='n', nbTags=0;");
      pwg_query("INSERT INTO ".$this->tables['images']."
                  SELECT id, 'n', 0
                    FROM ".IMAGES_TABLE."
                    WHERE id NOT IN (SELECT imageId FROM ".$this->tables['images'].")");
      /*
       * fill the 'used_tags' table with default values
       */
      foreach(AMD_JpegMetaData::getTagList(
                Array('filter' => AMD_JpegMetaData::TAGFILTER_IMPLEMENTED,
                      'xmp' => true,
                      'maker' => true,
                      'iptc' => true,
                      'com' => true)
              ) as $key => $val
             )
      {
        $sql="INSERT INTO ".$this->tables['used_tags']." VALUES('', '".$key."', '".(($val['translatable'])?'y':'n')."', '".$val['name']."', 0, '".addslashes(L10n::get($val['name']))."', 'n');";
        pwg_query($sql);
      }

      /*
       * exclude unauthorized tag with the 'amd_FillDataBaseExcludeTags' option
       */
      if(count($this->config['amd_FillDataBaseExcludeTags']))
      {
        $sql="";
        foreach($this->config['amd_FillDataBaseExcludeTags'] as $key => $tag)
        {
          if($sql!="") $sql.=" OR ";
          $sql.=" tagId LIKE '$tag' ";
        }
        $sql="DELETE FROM ".$this->tables['used_tags']."
              WHERE ".$sql;
        pwg_query($sql);
      }
    }

    /**
     * update the database content (for an update)
     */
    private function updateDatabaseContent()
    {
      global $user;

      L10n::setLanguage('en_UK');

      pwg_query("INSERT INTO ".$this->tables['images']."
                  SELECT id, 'n', 0
                    FROM ".IMAGES_TABLE."
                    WHERE id NOT IN (SELECT imageId FROM ".$this->tables['images'].")");

      $tagList=array();
      $sql="SELECT tagId FROM ".$this->tables['used_tags'];
      $result=pwg_query($sql);
      if($result)
      {
        while($row=pwg_db_fetch_row($result))
        {
          $tagList[$row[0]]='';
        }
      }

      /*
       * fill the 'used_tags' table with default values
       */
      foreach(AMD_JpegMetaData::getTagList(
                Array('filter' => AMD_JpegMetaData::TAGFILTER_IMPLEMENTED,
                      'xmp' => true,
                      'maker' => true,
                      'iptc' => true,
                      'com' => true)
              ) as $key => $val
             )
      {
        if(!array_key_exists($key, $tagList))
        {
          $sql="INSERT IGNORE INTO ".$this->tables['used_tags']." VALUES('', '".$key."', '".(($val['translatable'])?'y':'n')."', '".$val['name']."', 0, '".addslashes(L10n::get($val['name']))."', 'y');";
          pwg_query($sql);
        }
      }

      /*
       * exclude unauthorized tag with the 'amd_FillDataBaseExcludeTags' option
       */
      if(count($this->config['amd_FillDataBaseExcludeTags']))
      {
        $sql="";
        foreach($this->config['amd_FillDataBaseExcludeTags'] as $key => $tag)
        {
          if($sql!="") $sql.=" OR ";
          $sql.=" tagId LIKE '$tag' ";
        }
        $sql="DELETE FROM ".$this->tables['used_tags']."
              WHERE ".$sql;
        pwg_query($sql);
      }
    }


    private function buildDefaultGroup()
    {
      $sql=array();
      $languages=get_languages();
      foreach($languages as $key => $val)
      {
        load_language('plugin.lang', AMD_PATH, array('language' => $key, 'no_fallback'=>true));
        $sql[]="(1, '".$key."', '".l10n('g003_default_group_name')."')";
      }

      //reload default user language
      load_language('plugin.lang', AMD_PATH);
      return("INSERT INTO `".$this->tables['groups_names']."` VALUES ".implode(',', $sql));
    }

  } //class

?>
