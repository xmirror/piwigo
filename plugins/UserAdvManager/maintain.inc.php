<?php

if(!defined('UAM_PATH'))
{
  define('UAM_PATH' , PHPWG_PLUGINS_PATH.basename(dirname(__FILE__)).'/');
}

include_once (UAM_PATH.'include/constants.php');
include_once (UAM_PATH.'include/functions.inc.php');


function plugin_install()
{
	global $conf;
	
  $default1 = array('false','false',-1,-1,-1,'false','',-1,'','','false','','false',100,'false','false',10,'Hello [username].
	
This is a reminder because a very long time passed since your last visit on our gallery [mygallery]. If you do not want anymore to use your access account, please let us know by replying to this email. Your account will be deleted.

On receipt of this message and no new visit within 15 days, we would be obliged to automatically delete your account.

Best regards,

The admin of the gallery.','false','false','false','false','false','Sorry [username], your account has been deleted due to a too long time passed since your last visit at [mygallery].','Sorry [username], your account has been deprecated due to a too long time passed since your last visit at [mygallery]. Please, use the following link to revalidate your account.',-1,-1,'Thank you for registering at [mygallery]. Your account has been manually validated by _admin_. You may now log in at _link_to_site_ and make any appropriate changes to your profile. Welcome to _name_of_site_!','false','You have requested a password reset on our gallery. Please, find below your new connection settings.','false','Sorry, your account has been deleted because you have not validated your registration in requested time. Please, try registration with a valid and non blocked email account.','false','false','false');

	$query = '
SELECT param
  FROM '.CONFIG_TABLE.'
WHERE param = "UserAdvManager"
;';
  $count = pwg_db_num_rows(pwg_query($query));
  
  if ($count == 0)
  {
    $q = '
INSERT INTO '.CONFIG_TABLE.' (param, value, comment)
VALUES ("UserAdvManager","'.pwg_db_real_escape_string(serialize($default1)).'","UAM parameters")
  ;';
    pwg_query($q);
  }


  $default2 = array('false',5,'Hello [username].
		
This is a reminder message because you registered on our gallery [mygallery] but you do not validate your registration and your validation key has expired. To still allow you to access to our gallery, your validation period has been reset. You have again 5 days to validate your registration.

Note: After this period, your account will be permanently deleted.','false','Hello [username].

This is a reminder message because you registered on our gallery [mygallery] but you do not validate your registration and your validation key will expire. To allow you access to our gallery, you have 2 days to confirm your registration by clicking on the link in the message you should have received when you registered.

Note: After this period, your account will be permanently deleted.','You have confirmed that you are human and may now use [mygallery]! Welcome [username]!','Your activation key is incorrect or expired or you have already validated your account, please contact the webmaster to fix this problem.');

	$query = '
SELECT param
  FROM '.CONFIG_TABLE.'
WHERE param = "UserAdvManager_ConfirmMail"
;';
  $count = pwg_db_num_rows(pwg_query($query));
  
  if ($count == 0)
  {
    $q = '
INSERT INTO '.CONFIG_TABLE.' (param, value, comment)
VALUES ("UserAdvManager_ConfirmMail","'.pwg_db_real_escape_string(serialize($default2)).'","UAM ConfirmMail parameters")
  ;';
    pwg_query($q);
  }

	$query = '
SELECT param
  FROM '.CONFIG_TABLE.'
WHERE param = "UserAdvManager_Redir"
;';
  $count = pwg_db_num_rows(pwg_query($query));
  
  if ($count == 0)
  {
    $q = '
INSERT INTO '.CONFIG_TABLE.' (param, value, comment)
VALUES ("UserAdvManager_Redir","0","UAM Redirections")
  ;';
    pwg_query($q);
  }

// Set current plugin version in config table
  $plugin =  PluginInfos(UAM_PATH);
  $version = $plugin['version'];

	$query = '
SELECT param
  FROM '.CONFIG_TABLE.'
WHERE param = "UserAdvManager_Version"
;';
  $count = pwg_db_num_rows(pwg_query($query));
  
  if ($count == 0)
  {
    $q = '
INSERT INTO '.CONFIG_TABLE.' (param, value, comment)
VALUES ("UserAdvManager_Version","'.$version.'","UAM version check")
  ;';
    pwg_query($q);
  }


	$q = "
CREATE TABLE IF NOT EXISTS ".USER_CONFIRM_MAIL_TABLE." (
  id varchar(50) NOT NULL default '',
  user_id smallint(5) NOT NULL default '0',
  mail_address varchar(255) default NULL,
  status enum('webmaster','admin','normal','generic','guest') default NULL,
  date_check datetime default NULL,
  reminder ENUM('true','false') NULL,
PRIMARY KEY  (id)
  )
ENGINE=MyISAM;";
  pwg_query($q);

	$q = "
CREATE TABLE IF NOT EXISTS ".USER_LASTVISIT_TABLE." (
  user_id SMALLINT(5) NOT NULL DEFAULT '0',
  lastvisit DATETIME NULL DEFAULT NULL,
  reminder ENUM('true','false') NULL,
PRIMARY KEY (`user_id`)
  )
ENGINE=MyISAM;";
  pwg_query($q);
}


function plugin_activate()
{
  global $conf;

/* Cleaning obsolete files */
/* *********************** */
  clean_obsolete_files();
  
  include_once (UAM_PATH.'include/upgradedb.inc.php');

/* Check if old version is < 2.15 */
/* ****************************** */
	$query = '
SELECT param
  FROM '.CONFIG_TABLE.'
WHERE param = "nbc_UserAdvManager"
;';
  $count1 = pwg_db_num_rows(pwg_query($query));
  
  $query = '
SELECT *
  FROM '.CONFIG_TABLE.'
WHERE param = "nbc_UserAdvManager_ConfirmMail"
;';
  $count2 = pwg_db_num_rows(pwg_query($query)); 

/* If old params exist an upgrade is needed */
/* **************************************** */
  if ($count1 == 1)
  {
/* Check for upgrade from 2.10 to 2.11 */
/* *********************************** */
    if ($count1 == 1 and $count2 == 0)
    {
    /* upgrade from branch 2.10 to 2.11 */
    /* ******************************** */
      upgrade_210_211();
    }


/* Check for upgrade from 2.11 to 2.12 */
/* *********************************** */
    if (!table_exist(USER_LASTVISIT_TABLE))
    {
    /* upgrade from branch 2.11 to 2.12 */
    /* ******************************** */
  		upgrade_211_212();
    }


/* Check for upgrade from 2.12 to 2.13 */
/* *********************************** */
    $fields = mysql_list_fields($conf['db_base'],USER_CONFIRM_MAIL_TABLE);
    $nb_fields = mysql_num_fields($fields); 

    if ($nb_fields < 6)
    {
    /* upgrade from branch 2.12 to 2.13 */
    /* ******************************** */
      upgrade_212_213();
    }


/* Serializing conf parameters - Available since 2.14.0 */
/* **************************************************** */
    if (unserialize($conf['nbc_UserAdvManager']) === false)
    {
    /* upgrade from branch 2.13 to 2.14 */
    /* ******************************** */
      upgrade_213_214();
    }
    
    /* upgrade from branch 2.14 to 2.15 */
    /* ******************************** */
      upgrade_214_215();
  }

/* Old version is > 2.15 */
/* ********************* */
	$query = '
SELECT param
  FROM '.CONFIG_TABLE.'
WHERE param = "UserAdvManager_Redir"
;';
  $count = pwg_db_num_rows(pwg_query($query));
  
  if ($count == 0)
  {
    upgrade_2153_2154();
  }

/* Check for upgrade from 2.15 to 2.16 */
/* *********************************** */
	$query = '
SELECT param
  FROM '.CONFIG_TABLE.'
WHERE param = "UserAdvManager_Version"
;';
  $count = pwg_db_num_rows(pwg_query($query));
  
  if ($count == 0)
  {
    /* upgrade from branch 2.15 to 2.16 */
    /* ******************************** */
    upgrade_215_2160();
  }

/* Check database upgrade since version 2.16.0 */
  if (isset($conf['UserAdvManager_Version']))
  {
    if (version_compare($conf['UserAdvManager_Version'], '2.20.0') < 0)
    {
    /* upgrade from branch 2.16 to 2.20 */
    /* ******************************** */
      upgrade_216_220();
    }
    
    if (version_compare($conf['UserAdvManager_Version'], '2.20.4') < 0)
    {
    /* upgrade from version 2.20.3 to 2.20.4 */
    /* ************************************* */
      upgrade_2203_2204();
    }
    
    if (version_compare($conf['UserAdvManager_Version'], '2.20.7') < 0)
    {
    /* upgrade from version 2.20.4 to 2.20.7 */
    /* ************************************* */
      upgrade_2204_2207();
    }

    if (version_compare($conf['UserAdvManager_Version'], '2.20.8') < 0)
    {
    /* upgrade from version 2.20.7 to 2.20.8 */
    /* ************************************* */
      upgrade_2207_2208();
    }
  }

  // Update plugin version number in #_config table and check consistency of #_plugins table
  UAM_version_update();

  load_conf_from_db('param like \'UserAdvManager\\_%\'');
}


function plugin_uninstall()
{
  global $conf;

  if (isset($conf['UserAdvManager']))
  {
    $q = '
DELETE FROM '.CONFIG_TABLE.'
WHERE param="UserAdvManager"
;';

    pwg_query($q);
  }

  if (isset($conf['UserAdvManager_ConfirmMail']))
  {
    $q = '
DELETE FROM '.CONFIG_TABLE.'
WHERE param="UserAdvManager_ConfirmMail"
;';

    pwg_query($q);
  }

  if (isset($conf['UserAdvManager_Redir']))
  {
    $q = '
DELETE FROM '.CONFIG_TABLE.'
WHERE param="UserAdvManager_Redir"
;';

    pwg_query($q);
  }

  if (isset($conf['UserAdvManager_Version']))
  {
    $q = '
DELETE FROM '.CONFIG_TABLE.'
WHERE param="UserAdvManager_Version"
;';

    pwg_query($q);
  }

  $q = 'DROP TABLE '.USER_CONFIRM_MAIL_TABLE.';';
  pwg_query( $q );

  $q = 'DROP TABLE '.USER_LASTVISIT_TABLE.';';
  pwg_query( $q );
}
?>