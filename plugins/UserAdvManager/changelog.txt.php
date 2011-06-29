<?php
/*
Plugin Name: UserAdvManager
** Change log **
***************************************
***** Plugin history (branch 2.10)*****
***************************************

-- 2.10.0-beta : Initial beta release for Piwigo compatibility
-- 2.10.1-beta : Small correction on generated path
-- 2.10.2-beta : Bug resolved on register validation page

-- 2.10.3 : Final and fully functional release
						Bug resolved on plugin activation

-- 2.10.4 : Bug fixed on profiles update

-- 2.10.5 : Improved code on profiles update

-- 2.10.6 : Old language packs (iso) deleted (forget from PWG 1.7.x version)

-- 2.10.7 : Bug fixed on user's validation email sending

-- 2.10.8 : ConfirmMail page looks better (Sylvia theme only)
						Improved code for checking author on guest comments

-- 2.10.9 : Bug fixed - Missing english translation
						Bug fixed - Notice on forbidden characters function use
						Bug fixed - Audit on forbidden characters in username didn't work
						Adding of email provider exclusion (like *@hotmail.com) - Warning ! -> Known bug : This feature doesn't work on user profile page. So, already registered users can change their email address to a forbiden one.

-- 2.10.9a : Email provider exclusion is no longer case sensitive

-- 2.10.9b : Bug fixed - Home icon wasn't linked to gallery url in ConfirmMail page. If GALLERY_URL is not set, Home icon gets the pwg root path.

-- 2.10.9c : Bug fixed - If Email provider exclusion is set off, new registered user will have a PHP notice on "Undefined variable: ncsemail"

-- 2.10.9d : Code simplification - need no more ""template"" sub-directory in plugin directory for enhance "back link" icon in ConfirMail.tpl

-- 2.10.9e : Compatibility improvement with PHP 5.3 - Some old functions will be deprecated like :
							ereg replaced by preg_match
							eregi replace by preg_match with "i" moderator
							split replace by preg_split
				
-- 2.10.9f : Compatibility bug fixed when used with DynamicRecentPeriod plugin


***** Plugin history (branch 2.11)***** 

-- 2.11.0 : New tabsheet menu to manage ConfirMail functions (setting a timeout without validation, Cleanup expired user's accounts, Force confirmation, Renew validation key, list unvalidated users,...)
						Beautify plugin's main admin panel
						
-- 2.11.1 : Bug fixed with install and upgrade functions
						Language files correction

-- 2.11.2 : Bug fixed on bad query for unvalidated users display in unvalidated users list
						Bug fixed : Sql syntax error on plugin activation

-- 2.11.3 : On Patricia's request (french forum and bug 1173), the unvalidated users management tab shows users according with the settings of unvalidated group and / or unvalidated status.
						Feature 1172 added : Email providers exclusion list can be set with CR/LF between each entry. The comma seperator (,) is still mandatory.
						Bug 1175 fixed : Bad translation tag in french language file.
						Improvement of unvalidated users management tab (feature 1174)- Expired users are displayed in red color text.

-- 2.11.4 : Bug 1177 fixed : Width of excluded email providers list reset to ancient value (80 col)
						Bug 1179 fixed : Adding a notice in plugin inline documentation for use of validation groups and status. A default group must be set in Piwigo's groups settings and the "Guest" (or another user) must be set as default for status values.
						Bug 1182 fixed : Language tag missing in confirmation email generation 

-- 2.11.5 : Bug 1195 fixed : Registration displays the good title


***************************************
***** Plugin history (branch 2.12)*****
***************************************

-- 2.12.0 : Bug 1206 fixed : All plugin functionnalities work in user's profile page
            Plugin's core code and admin panel refactoring
            Password control and enforcement : A complexity score is computed on user registration. If this score is less than the goal set by admin, the password choosen is rejected.
            Feature 1194 "Ghost Tracker" added : New plugin tab displays users who don't comes back to the gallery since x days. Ability to send email reminders and to delete reminded but "dead" users. It's the reason why this feature is called "Ghost Tracker".

-- 2.12.1 : Rollback on admin panel improvement (it was a bad idea)

-- 2.12.2 : Bug 1221 fixed - Adding of a new funtion to populate the lastvisit table on Ghost Tracker activation
            Bug 1224 fixed - Error in database after plugin activation
            Bug 1225 fixed - "Reminder" status don't change from "false" to "true" after the sent of a reminder email
            Some code beautify (SQL requests and HTML 4 strict for tpl)

-- 2.12.3 : Bug 1226 fixed - "duplicate key error" when lastvisit table is not empty and on using Ghost Tracker init function

-- 2.12.4 : Adding a password field control for SendMail2User - Neighborhood plugin compatibility improvement 
            Bug 1229 fixed - Email was no longer mandatory when plugin was active, even if Piwigo's email madatory option was set. 

-- 2.12.5 : Bug 1233 fixed -  "duplicate key error" when a user wants to register with an existing username. In fact, all standard Piwigo's register controls didn't work when plugin was activated. That fixes this too.
            Adding DE, ES and IT languages. All translations are not finalized and could be improved.
            Adding of description.txt file in language directories.

-- 2.12.6 : Bug 1236 fixed -  Admins was unable to add a new user in the user_list page.
            Beginning of IT translations
            
-- 2.12.7 : Bug 1238 fixed - Simple custom email text wasn't send when Extended Description plugin wasn't set
            Bug 1245 fixed - Semicolons (;) are no longer allowed in text areas (mail info text, ConfirmMail text, reminder text,...). They'll be replaced by dots (.).
            Bug 1248 fixed - Php notice on user registration with a forbidden email domain
            Bug 1250 fixed - Email provider didn't work after the third exclusion in list
            Escaping all special characters typed in login name and recover them


***************************************
***** Plugin history (branch 2.13)*****
***************************************
 
-- 2.13.0 : Bug 1246 fixed - Extended Description tags are working again ! Caution : The language used and saved in database is the one configured by default in the visitor's browser and not the language given by Language Switch.
            Evolution 1239 - New option to add a new tab that shows the number of days since their last visit for each registered user.
            Bug 1257 fixed - If email exclusion list begins with a CR-LF, an informative warning message is displayed (I was unable to delete automatically this CR-LF).
            Bug 1259 fixed - PHP notice on user addition by admin in user_list page.
            Bug 1260 fixed - Username case sensitivity is now fully functionnal in all users entries (user registration and admin panel)
            Evolution 1273 - Adding of reminder field in advanced user management tab. This allows to see if a reminder have already been send.
            Evolution 1292 - Adding of navigation bar in tabs where users are listed (when more than 1 page is needed to display users).
            Code refactory and improvements.
            Translations improvements.

-- 2.13.1 : Bug 1302 fixed - Re-coded double email check on registration.
            Bug 1304 fixed - Adding of plugin version in plugin admin panel title.

-- 2.13.2 : Bug 1308 fixed - Reminder emails have the good translated subject.

-- 2.13.3 : Bug 1309 fixed - Forbidden characters in login name work fine again.
            Bug 1340 fixed - Explanation improvement for option "Nickname is mandatory for comments" 
            Bug 1342 fixed - Calculation between last visit and today is ok and displays the good color in user list.
            Italian language improvement (thx to Rio)

-- 2.13.4 : Add of obsolete files management
            Bug 1303 and 1387 fixed - Due to a bug in Piwigo's 2.0.8 switch_lang() function, the email contents using Extended Description tags wasn't taking user's language in account. A first fix is now set for the current 2.0.8 Piwigo's version and another one is ready to work for the next Piwigo's release.
            Bug 1444 fixed
            Bug 1445 fixed - The plugin's administration panel have been all reviewed and improved with text simplification and display enhancement.
            Bug 1463 fixed
            
            *** Feature temporarily postponed in a later version due to problems with ";" in text fields *** Add compatibility with FCK Editor plugin for email text fields


***************************************
***** Plugin history (branch 2.14)*****
***************************************

-- 2.14.0 : Bug 1308 refixed - Piwigo 2.0.9 fixes the bug on switch_lang() function so the initial UAM fix is no longer needed 
            Evolution 1392 - No more confirmation email for admins profile changing 
            Evolution 1465 - Plugin's configuration data are now serialized in database
            Bug 1466 fixed - The plugin version is correctly displayed on Ghost Tracker tab
            Bug 1468 fixed - Java error (thx to cljosse)
            Evolution 1485 - The admin's can choose if the validation of registration have to be sent to users created by them
            Improving obsolete files cleaning
            Evolution 1488 - When an admin creates an account an information email is always sent to created user
            Code simplification - All variables are changed from "UserAdvManager" to "UAM"

-- 2.14.1 : Bug 1497 fixed - Using users tracker without Ghost Tracker is now OK


***************************************
***** Plugin history (branch 2.15)*****
***************************************

-- 2.15.0 : Plugin compatibility for Piwigo 2.1
            Bug 1467 fixed - FCK Editor's functionnalities are available on registration's confirmation return page customization fields
            Bug 1474 fixed - Messages on registration's confirmation return page (ConfirmMail.tpl) are customizable 
            Bug 1508 fixed - Plugin's name is now UserAdvManager (deletion of "nbc_" in code and PEM)
            Bug 1551 fixed - Database upgrade improvement

-- 2.15.1 : Bug 1571 fixed - Missing translation tag
            Bug 1572 fixed - Fix unable to read resource: "ConfirmMail.tpl"
            Bug 1574 fixed - Beautifying ConfirmMail page
            Bug 1576 fixed - Compatibility with other database systems than MySql like PostgreSql or Sqlite. Using Piwigo's pwg_db_### integrated functions.
            Bug 1586 fixed - Links to official forum topic support and bugtacker were added in plugin's admin page

-- 2.15.2 : Bug 1551 re-fixed - There was some problems remaining with old version upgrades
            Some translations revisited
            Bug 1655 fixed - Navigation bar is usefull again
            
-- 2.15.3 : Quick update to fix a database upgrade issue

-- 2.15.4 : Bug 1310 fixed - UAM tables are now sortable
            Bug 1656 fixed - New register validation mode: Manual validation by admin
            Bug 1687 fixed - Login case sensitivity is no more used in this plugin because already set in Piwigo's core
            Bug 1727 partially fixed - New option to redirect users to profile page after their first login only.
              Known problem: The redirection doesn't work after registration and after confirmation page (if ConfirmMail is enabled)
                             The redirection applies to already registered users including admins, webmaster and generic status.
            Bug 1789 fixed - Escaping double quotes in text fields
            Bug 1790 fixed - Validation tracking tab is set when correct options are set
            Bug 1795 fixed - Fixes rules using email information and/or email of validation

-- 2.15.5 : Bug 1693 fixed - Multi-languages are available for ConfirmMail customization (using Extended Description plugin)
            Bug 1727 fixed - The redirection does not appli to admins, webmaster and generic users.
            Bug 1807 fixed - Textareas are resized according the screen resolution
            Bug 1808 fixed - The Tracking users table is ordered by default on "LastVisit" field (last in at top) 
            Bug 1809 fixed - Addition of a direct link to user's profile in all UAM tables. The link gives a new window
            Bug 1810 partially fixed - Auto login is not performed after visitors have validated their registration but the "home" button changes his link to redirect to identification page when the redirection option is set. Note: The redirection to profile.php doesn't work because I was unable to use the log_user() function on ConfirmMail page. This feature is still under investigation to perform the best way.

-- 2.15.6 : Bug 1819 fixed - Wrong help text on redirection function
            Bug 1821 fixed - Cleanup of old deprecated functions slags (Case sensitivity on logins)
            Bug 1834 fixed - Improving plugin installation and uninstallation process

-- 2.15.7 : Bug 1869 fixed - Compatibility with Adult_Content installation process

-- 2.15.8 : Bug 1935 fixed - Fatal error on ConfirmMail page when Extended Description plugin is not used
            Bug 1936 fixed - Bad home link in ConfirmMail page when gallery URL is not set
            small CSS improvement (thx to Gotcha)

-- 2.15.9 : Bug 2010 fixed - No confirmation email when information email is not set

-- 2.15.10 : Bug 2050 fixed - Compatibility with Captcha


***************************************
***** Plugin history (branch 2.16)*****
***************************************
-- 2.16.0 : Bug 1585 fixed - UAM version is set in database to improve future upgrades
            Bug 2011 fixed - Text fields are no longer locked if related option button is not set and saved. Now this fields and unused options are hidden
            Bug 2046 fixed - Using Piwigo's $conf['insensitive_case_logon'] = true option works again with UAM
            Bug 2053 fixed - Manual validation by admins wasn't working correctly
            Bug 2054 fixed - Add of customized email notification to validated users when admins validate them manually 
            Bug 1430, 1840, 2056 fixed - Automated tasks are available to delete or downgrade ghost users with or without email notification
            Add of Latvian (lv_LV) translation (Thx to Aivars Baldone)

**************************************************************
***** Plugin history (branch 2.20 - Piwigo 2.2 compliant)*****
**************************************************************
-- 2.20.0 : Compliance with Piwigo 2.2
            Bug 1479 fixed - New feature : Add of a dedicated UAM block in PWG Stuffs plugin to inform unvalidated users on their status 
            Bug 1666 fixed - New feature : Customizing "lost password" email
            Bug 2045 fixed - New feature : Special tags insertion in text fields. The tags actually available are [username] (insert current user username),[mygallery] (insert current gallery title), [myurl] (insert gallery url if set in Piwigo's configuration options).
            Bug 2055 fixed - New automated task for unvalidated registers (auto email reminder sent and auto deletion if already reminded).
            Bug 2072 fixed - Remove sort on "difference in days" in user tracking tab
            Bug 2140 fixed - English sentence corrections
            Bug 2186 fixed - JQuery accordion menu when no users are listed in UAM tables
            Bug 2188 fixed - Avoid translation flags conflicts
            Bug 2192 fixed - GT Automated tasks improvement and refactory
            Bug 2203 fixed - [username] special flag is not supported in lost password email customization

-- 2.20.1 : Bug 2254 fixed - Plugin installation crashes when installing from scratch
            Bug 2255 fixed - Error in jQuery path

-- 2.20.2 : Bug 2256 fixed - Error on upgrade from version 2.20.0 to 2.20.1

-- 2.20.3 : Bug 2257 fixed - Improve admin panel display with clear theme
            Bug 2258 fixed - New feature to backup UAM configuration and personnal settings

-- 2.20.4 : Bug 2265 fixed - Add new option to display or not user's password in information email

-- 2.20.5 : Bug 2287 fixed - The UAM block for PWG_Stuffs is correctly displayed (stuffs_module directory was missing)

-- 2.20.6 : Improve database update process
            Bug 2289 fixed - "Password in clear text in the information email" was working in a reverse logic

-- 2.20.7 : Use pwg_db_real_escape_string() instead of addslashes()
            Database upgrade process simplied (using version_compare() and code refactoring)
            Bug 2253 fixed - New feature to allow comments on pictures only for specific users (who belong to a group) when "comments for all" is disabled

-- 2.20.8 : Remove all options related to comments because they are processed in new "Comments Access Manager" plugin.

-- 2.20.9 : Bug fixed on installation from scratch (unable to save config)

-- 2.20.10 : Bug 2324 fixed - New feature : Add [days] autotext flag to insert maximum numbers of days between two visits set in plugin's GhostTracker in GhostTracker reminder email.

-- 2.20.11 : Bug 2336 fixed - New feature : Add [Kdays] autotext flag to insert the number of days until expiration.
*/
?>