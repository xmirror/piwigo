-- -------------------------------------------------------
-- Create piwigo_user_confirm_mail table
-- ------------------------------------------------------

DROP TABLE IF EXISTS piwigo_user_confirm_mail;

CREATE TABLE `piwigo_user_confirm_mail` (
  `id` varchar(50) NOT NULL default '',
  `user_id` smallint(5) NOT NULL default '0',
  `mail_address` varchar(255) default NULL,
  `status` enum('webmaster','admin','normal','generic','guest') default NULL,
  `date_check` datetime default NULL,
  `reminder` enum('true','false') default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO piwigo_user_confirm_mail VALUES ('m4E871r751WcjnGN', '4', 'tunrua@yahoo.com', 'normal', '2011-06-25 20:14:05', 'false');


-- -------------------------------------------------------
-- Create piwigo_user_lastvisit_check table
-- ------------------------------------------------------

DROP TABLE IF EXISTS piwigo_user_lastvisit_check;

CREATE TABLE `piwigo_user_lastvisit_check` (
  `user_id` smallint(5) NOT NULL default '0',
  `lastvisit` datetime default NULL,
  `reminder` enum('true','false') default NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



-- -------------------------------------------------------
-- Insert UAM configuration in piwigo_config
-- ------------------------------------------------------

INSERT INTO piwigo_config VALUES ('UserAdvManager', 'a:35:{i:0;s:4:\"true\";i:1;s:4:\"true\";i:2;s:2:\"-1\";i:3;s:2:\"-1\";i:4;s:2:\"-1\";i:5;s:5:\"false\";i:6;s:0:\"\";i:7;s:2:\"-1\";i:8;s:0:\"\";i:9;s:0:\"\";i:10;s:5:\"false\";i:11;s:0:\"\";i:12;s:5:\"false\";i:13;s:3:\"100\";i:14;s:5:\"false\";i:15;s:5:\"false\";i:16;s:2:\"10\";i:17;s:420:\"Hello [username].\r\n	\r\nThis is a reminder because a very long time passed since your last visit on our gallery [mygallery]. If you do not want anymore to use your access account, please let us know by replying to this email. Your account will be deleted.\r\n\r\nOn receipt of this message and no new visit within 15 days, we would be obliged to automatically delete your account.\r\n\r\nBest regards,\r\n\r\nThe admin of the gallery.\";i:18;s:5:\"false\";i:19;s:5:\"false\";i:20;s:5:\"false\";i:21;s:5:\"false\";i:22;s:5:\"false\";i:23;s:115:\"Sorry [username], your account has been deleted due to a too long time passed since your last visit at [mygallery].\";i:24;s:177:\"Sorry [username], your account has been deprecated due to a too long time passed since your last visit at [mygallery]. Please, use the following link to revalidate your account.\";i:25;s:2:\"-1\";i:26;s:2:\"-1\";i:27;s:208:\"Thank you for registering at [mygallery]. Your account has been manually validated by _admin_. You may now log in at _link_to_site_ and make any appropriate changes to your profile. Welcome to _name_of_site_!\";i:28;s:5:\"false\";i:29;s:100:\"You have requested a password reset on our gallery. Please, find below your new connection settings.\";i:30;s:5:\"false\";i:31;s:115:\"Sorry [username], your account has been deleted due to a too long time passed since your last visit at [mygallery].\";i:32;s:5:\"false\";i:33;s:5:\"false\";i:34;s:5:\"false\";}', 'UAM parameters');
INSERT INTO piwigo_config VALUES ('UserAdvManager_ConfirmMail', 'a:7:{i:0;s:5:\"false\";i:1;s:1:\"5\";i:2;s:385:\"Hello [username].\r\n		\r\nThis is a reminder message because you registered on our gallery [mygallery] but you do not validate your registration and your validation key has expired. To still allow you to access to our gallery, your validation period has been reset. You have again 5 days to validate your registration.\r\n\r\nNote: After this period, your account will be permanently deleted.\";i:3;s:5:\"false\";i:4;s:412:\"Hello [username].\r\n\r\nThis is a reminder message because you registered on our gallery [mygallery] but you do not validate your registration and your validation key will expire. To allow you access to our gallery, you have 2 days to confirm your registration by clicking on the link in the message you should have received when you registered.\r\n\r\nNote: After this period, your account will be permanently deleted.\";i:5;s:86:\"You have confirmed that you are human and may now use [mygallery]! Welcome [username]!\";i:6;s:137:\"Your activation key is incorrect or expired or you have already validated your account, please contact the webmaster to fix this problem.\";}', 'UAM ConfirmMail parameters');
INSERT INTO piwigo_config VALUES ('UserAdvManager_Redir', '0', 'UAM Redirections');
INSERT INTO piwigo_config VALUES ('UserAdvManager_Version', '2.20.11', 'UAM version check');
