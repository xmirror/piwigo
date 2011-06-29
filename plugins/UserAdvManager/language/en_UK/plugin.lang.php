<?php

global $lang,$conf;

$conf_UAM = unserialize($conf['UserAdvManager']);


/* UserManager Tab */
$lang['UAM_Registration_Date'] = 'Registration date';


/* Mailing */
$lang['UAM_infos_mail %s'] = '%s, please find here your information to log in the gallery :';
$lang['UAM_User: %s'] = 'User : %s';
$lang['UAM_Password: %s'] = 'Password: %s';
$lang['UAM_Link: %s'] = 'Please, click on this link to confirm your registration : %s';


/* Email confirmation page */
$lang['UAM_title_confirm_mail'] = 'Validate your registration';
$lang['UAM_confirm_mail_page_title'] = 'Validate your registration';


/* Errors and Warnings */
$lang['UAM_audit_ok'] = 'Audit OK';
$lang['UAM_Err_audit_username_char'] = '<b>This account uses one or more forbidden characters :</b> ';
$lang['UAM_Err_audit_email_forbidden'] = '<b>This account uses a forbidden email provider :</b> ';
$lang['UAM_Err_audit_advise'] = '<b>you have to perform corrections to comply with new rules that you have activated.<br>Use a database management utility to correct user accounts directly in the table ###_USERS';
$lang['UAM_reg_err_login2'] = 'Username does not have to match the following characters: ';
$lang['UAM_reg_err_login5'] = 'Your email provider is banned for registration. Banned email providers are: ';
$lang['UAM_empty_pwd'] = '[empty password]';
$lang['UAM_no_update_pwd'] = '[profile updated without password changed]';
$lang['UAM_No_validation_for_Guest'] = 'The "Guest" account is not subject to validation';
$lang['UAM_No_validation_for_default_user'] = 'The default account is not subject to validation';
$lang['UAM_No_validation_for_Webmaster'] = 'The "Webmaster" account is not subject to validation';
$lang['UAM_No_validation_for_your_account'] = 'Your personnal admin account is not subject to validation';


/* Processing messages */
$lang['UAM_%d_Mail_With_Key'] = '%d message with key renewal was sent';
$lang['UAM_%d_Mails_With_Key'] = '%d messages with key renewal were sent';
$lang['UAM_%d_Reminder_Sent'] = '%d reminder message was sent';
$lang['UAM_%d_Reminders_Sent'] = '%d reminder messages were sent';
$lang['UAM_%d_Validated_User'] = '%d User validated manually';
$lang['UAM_%d_Validated_Users'] = '%d Users validated manually';


/* Action button names */
$lang['UAM_Delete_selected'] = 'Delete';
$lang['UAM_Mail_without_key'] = 'Reminder without key';
$lang['UAM_Mail_with_key'] = 'Reminder with key';




// --------- Starting below: New or revised $lang ---- from version 2.12.0 and 2.12.1
/* Global Configuration Tab */
$lang['UAM_PasswordTest'] = 'Score calculation';
/* Ghost Tracker Tab */
$lang['UAM_Tab_GhostTracker'] = 'Ghost Tracker';
$lang['UAM_Reminder'] = 'Email reminder';
$lang['UAM_Reminder_Sent_OK'] = 'YES';
$lang['UAM_Reminder_Sent_NOK'] = 'NO';
/* Errors and Warnings */
$lang['UAM_save_config'] ='Configuration saved.';
$lang['UAM_reg_err_login3'] = 'Security : Password is mandatory !';
$lang['UAM_reg_err_login4_%s'] = 'Security : A control system calculates a score on the chosen passwords complexity. The complexity of your password is too low (score = %s). Please, choose a new password more secure by following these rules:<br>
- Use letters and numbers<br>
- Use lowercase and uppercase<br>
- Increase its length (number of characters)<br>
The minimum passwords score required by the administrator is: ';
$lang['UAM_No_reminder_for_Guest'] = 'The "Guest" account is not subject to receive reminders from GhostTracker';
$lang['UAM_No_reminder_for_default_user'] = 'The default account is not subject to receive reminders from GhostTracker';
$lang['UAM_No_reminder_for_Webmaster'] = 'The "Webmaster" account is not subject to receive reminders from GhostTracker';
$lang['UAM_No_reminder_for_your_account'] = 'You personnal admin account is not subject to receive reminders from GhostTracker';
/* Action button names */
$lang['UAM_audit'] = 'Audit settings';
$lang['UAM_submit'] = 'Save settings';
// --------- End: New or revised $lang ---- from version 2.12.0 and 2.12.1


// --------- Starting below: New or revised $lang ---- from version 2.12.2
/* Errors and Warnings */
$lang['UAM_GhostTracker_Init_OK'] = 'Ghost Tracker reset done !';
/* Action button names */
$lang['UAM_GT_Reset'] = 'Reset Ghost Tracker';
// --------- End: New or revised $lang ---- from version 2.12.2


// --------- Starting below: New or revised $lang ---- from version 2.12.8
/* Errors and Warnings */
$lang['UAM_mail_exclusionlist_error'] = 'Warning! You have entered a new line (CR-LF) at the begining of email exclusion list (shown in red below). Although this new line is not visible, it is still present and may cause malfunction of the plugin. Please re-type in your exclusion list in a manner that does not begin with a newline.';
// --------- End: New or revised $lang ---- from version 2.12.8


// --------- Starting below: New or revised $lang ---- from version 2.13.0
/* UserList Tab */
$lang['UAM_UserList_Title'] = 'Monitoring registered users';
// --------- End: New or revised $lang ---- from version 2.13.0


// --------- Starting below: New or revised $lang ---- from version 2.13.4
/* Global Configuration Tab */
$lang['UAM_Title_Tab'] = 'UserAdvManager - Version : ';
$lang['UAM_SubTitle1'] = 'Plugin configuration';
$lang['UAM_Tab_Global'] = 'Configuration';
$lang['UAM_Title1'] = 'Setting restrictions for registrations';
$lang['UAM_Title2'] = 'Setting confirmations and validations of registration';
$lang['UAM_Title3'] = 'Setting the followed registrations and other options';
$lang['UAM_Title4'] = 'Tips and examples of use';
$lang['UAM_No_Casse'] = 'Usernames: Case sensitivity';
$lang['UAM_Username_Char'] = 'Usernames: Exclusion of characters';
$lang['UAM_Username_Char_true'] = ' Banning characters:<br>(Use a comma to separate each character)<br><br>';
$lang['UAM_Username_Char_false'] = ' Permit all (default)';
$lang['UAM_Password_Enforced'] = 'Strengthening the security level of passwords';
$lang['UAM_Password_Enforced_true'] = ' Enable. Minimum Score: ';
$lang['UAM_AdminPassword_Enforced'] = 'Applying to administrators';
$lang['UAM_PasswordTest'] = 'Password test: ';
$lang['UAM_ScoreTest'] = 'Result: ';
$lang['UAM_MailExclusion'] = 'Email domains exclusion';
$lang['UAM_MailExclusion_true'] = ' Exclude the following domains:<br>(Use a comma to separate each domain)';

$lang['UAM_Mail_Info'] = 'Information email to user:';
$lang['UAM_MailInfo_Text'] = ' Customizing the information email:';
$lang['UAM_Confirm_Mail'] = 'Confirmation of registration:';
$lang['UAM_ConfirmMail_Text'] = ' Customizing the confirmation email:';
$lang['UAM_Confirm_grpstat_notice'] = 'Caution: It is advisable to use either the group or the validation statutes and not both simultaneously.';
$lang['UAM_Confirm_Group'] = 'Validation Groups<br>(leave ------- to not affect group)';
$lang['UAM_Confirm_Status'] = 'Validation Statutes<br>(leave ------- to keep the Piwigo\'s default)';
$lang['UAM_No_Confirm_Group'] = 'Group for users who have not validated their registration<br>';
$lang['UAM_Validated_Group'] = 'Group for users who have validated their registration<br>';
$lang['UAM_No_Confirm_Status'] = 'Status for users who have not validated their registration<br>';
$lang['UAM_Validated_Status'] = 'Status for users who have validated their registration<br>';
$lang['UAM_ValidationLimit_Info'] = 'Deadline for registration validation limited';
$lang['UAM_ConfirmMail_TimeOut_true'] = ' Enable. Number of days until expiration: ';
$lang['UAM_ConfirmMail_Remail'] = 'Remind unvalidated users';
$lang['UAM_ConfirmMail_ReMail_Txt1'] = 'Customizing the reminder message <b><u>with</u></b> new regeneration of key validation.';
$lang['UAM_ConfirmMail_ReMail_Txt2'] = 'Customizing the reminder message <b><u>without</u></b> regeneration of key validation.';

$lang['UAM_GhostTracker'] = 'Ghost visitors management (Ghost Tracker)';
$lang['UAM_GhostTracker_true'] = ' Enable. Maximum period in days between two visits: ';
$lang['UAM_GhostTracker_ReminderText'] = 'Customizing Ghost Tracker\'s reminder message';
$lang['UAM_LastVisit'] = ' Tracking registered users';

$lang['UAM_Tab_UserManager'] = 'Tracking validations';

/* UserManager Tab */
$lang['UAM_SubTitle3'] = 'Tracking validations';
$lang['UAM_UserManager_Title'] = 'Tracking validations';
/* Ghost Tracker Tab */
$lang['UAM_SubTitle4'] = 'Ghost Tracker';
$lang['UAM_GT_Init'] = 'Initializing Ghost Tracker';
$lang['UAM_GhostTracker_Title'] = 'Ghost visitors management';
$lang['UAM_GhostTracker_Init'] = 'If you enable this feature for the first time or you have reactivated after a long period off during which new visitors are registered, you must initialize or reset the Ghost Tracker. This action is done only after activation or reactivation of the option. Please click <u>once</u> the reset button below.';
/* UserList Tab */
$lang['UAM_SubTitle5'] = 'Tracking users';
$lang['UAM_Tab_UserList'] = 'Tracking users';
/* Mailing */
$lang['UAM_Add of %s'] = 'Profile created for %s';
$lang['UAM_Update of %s'] = 'Profile %s updated';

/* Mailing */
$lang['UAM_Ghost_reminder_of_%s'] = '%s, this is a reminder email';
$lang['UAM_Reminder_with_key_of_%s'] = '%s, your validation key has been renewed';
$lang['UAM_Reminder_without_key_of_%s'] = '%s, your validation key will expire';
/* Errors and Warnings */
$lang['UAM_Err_GhostTracker_Settings'] = 'This page is available only if "Ghost Tracker" is active in "Setting the registrations followed and other options".';
$lang['UAM_Err_Userlist_Settings'] = 'This page is available only if "Monitoring registered users" is active in the "Setting the registrations followed and other options".';
// --------- End: New or revised $lang ---- from version 2.13.4


// --------- Starting below: New or revised $lang ---- from version 2.14.0
$lang['UAM_AdminConfMail'] = 'Confirmation of registration for admins';
// --------- End: New or revised $lang ---- from version 2.14.0


// --------- Starting below: New or revised $lang ---- from version 2.15.0
$lang['UAM_confirmmail_custom_Txt1'] = 'Text of the confirmation page - Confirmation accepted';
$lang['UAM_confirmmail_custom_Txt2'] = 'Text of the confirmation page - Confirmation rejected';
$lang['UAM_LastVisit_Date'] = 'Last visit';
$lang['UAM_Nb_Days'] = 'Difference in days';
$lang['UAM_Err_UserManager_Settings'] = 'This page is available only if "Confirmation of registration" is active and if a group of visitors not validated is configured in "Setting confirmations and validations of registration".';
// --------- End: New or revised $lang ---- from version 2.15.0


// --------- Starting below: New or revised $lang ---- from version 2.15.1
$lang['UAM_Support_txt'] = 'The official support on this plugin is only on these Piwigo forum topic:<br>
<a href="http://piwigo.org/forum/viewtopic.php?id=15015" onclick="window.open(this.href);return false;">English forum - http://piwigo.org/forum/viewtopic.php?id=15015</a><br><br>
Also available, the project\'s bugtracker: <a href="http://piwigo.org/bugs/" onclick="window.open(this.href);return false;">http://piwigo.org/bugs/</a>';
// --------- End: New or revised $lang ---- from version 2.15.1


// --------- Starting below: New or revised $lang ---- from version 2.15.4
$lang['UAM_Force_Validation'] = 'Manual validation';
$lang['UAM_Confirm_Mail_true'] = ' Enable - Validation by user';
$lang['UAM_Confirm_Mail_local'] = ' Enable - Validation by admin (no validation key sent)';
$lang['UAM_RedirToProfile'] = 'Redirect to "Customization" page';
// --------- End: New or revised $lang ---- from version 2.15.4


// --------- Starting below: New or revised $lang ---- from version 2.16.0
$lang['UAM_Expired_Group'] = '<b>Group</b> for user\'s registration has expired<br>';
$lang['UAM_Expired_Status'] = '<b>Status</b> for user\'s registration has expired<br>';
$lang['UAM_GTAuto'] = 'Automatic management of ghosts users';
$lang['UAM_GTAutoDel'] = 'Automatic deletion of accounts';
$lang['UAM_GTAutoGp'] = 'Automatic change of group / status';
$lang['UAM_GTAutoMail'] = 'Automatically sending an email when changing group / status';
$lang['UAM_Deleted_Account_Redirection_Page'] = 'Access denied - Account destroyed!';
$lang['UAM_title_redir_page'] = 'Access denied for having an account destroyed!';
$lang['UAM_Error_GTAutoMail_cannot_be_set_without_ConfirmMail'] = 'Consistency error in the configuration chosen:
<br><br>
"Setting the followed registrations and other options > Ghost visitors management (Ghost Tracker) > Automatic management of ghosts users > Automatically sending an email when changing group / status" can not be activated if "Setting confirmations and validations of registration > Confirmation of registration - Validation by user" is not enabled at first.
<br><br>
To ensure consistency, the option "Automatically sending an email when changing group / status" was automatically repositioned "disabled".
<br><br>';
$lang['UAM_Demotion of %s'] = 'Demotion of %s';
$lang['UAM_AdminValidationMail_Text'] = 'Notification of manual registration validation';
$lang['UAM_Validation of %s'] = 'Validation of %s';
// --------- End: New or revised $lang ---- from version 2.16.0


// --------- Starting below: New or revised $lang ---- from version 2.20.0
$lang['UAM_CustomPasswRetr'] = 'Customize lost password email content';
$lang['UAM_USRAuto'] = 'Automatic management of unvalidated users';
$lang['UAM_USRAutoDel'] = 'Custom message on deleted account';
$lang['UAM_USRAutoMail'] = 'Automated email reminder';
$lang['UAM_Disable'] = ' Disable (default)';
$lang['UAM_Enable'] = ' Enable ';
$lang['UAM_Tips1'] = 'Information of non-validated registration with UAM and PWG_Stuffs';
$lang['UAM_Tips1_txt'] = '
          <ul>
            <li>
            Goals: Inform the visitor that the registration is awaiting approval by displaying a personal block on the home page of the gallery, and this, as registration is not approved.
            <br><br>
            <b>Recall: In standard operation, the "Guest" only sees the public categories, without information message.</b>
            </li><br><br>
            <li>
Prerequisite:<br>
- A gallery with all or some private categories, visible only by registered users<br>
- At least 2 following Piwigo\'s users groups: "Waiting," without permission on private categories, and "Validated" with all the permissions on the private categories<br>
- UAM plugin<br>
- PWG Stuffs plugin, for adding a special UAM module<br>
- Optionally, the plugin Extended Description to support multi-languages<br>
            </li><br><br>
            <li>
Stages:<br><br>
A. In plugin UAM:
              <ol>
                <li>Enable registration confirmation</li>
                <li>Enable PWG Stuffs module option</li>
                <li>Enter text for additional explanation which will be attached to mail registration confirmation. If the plugin Extended Description is activated, the language tags can be used</li>
                <li>Select the "Waiting" group under "For users who have not validated their registration"</li>
                <li>Select the "Validated" group under "For users who have validated their registration"</li>
                <li>Save the plugin configuration</li>
              </ol>
<br>
B. In plugin PWG Stuffs :
              <ol>
                <li>Go to tab "Add a new module"</li>
                <li>Choose "UAM Module"</li>
                <li>Configure the module, indicating the title (eg "Registration pending validation") and its description, and only check "Waiting" in the list of groups allowed</li>
                <li>Complete content of the module with the message information to be displayed to users not validated. As UAM, languages markup may be used if the plugin is enabled Extended Description</li>
                <li>Check "Display the module on the homepage of the site"</li>
                <li>Validate the configuration of the module</li>
              </ol>
            </li>
          </ul>';
$lang['UAM_Tips2'] = 'Information of non-validated registration with UAM and Additional Pages';
$lang['UAM_Tips2_txt'] = '
          <ul>
            <li>
            Goals: Inform the visitor that the registration is awaiting validation by posting an additional page replacing the standard index page gallery at each of these connections, and this, as registration is not approved.
            <br><br>
            Advantages over the method with PWG_Stuffs: Allow formatting information and displaying the information immediately upon registration of visitors.
            </li><br><br>
            <li>
Prerequisite:<br>
- A gallery with all or some private categories, visible only by registered users<br>
- At least 2 following Piwigo\'s users groups: "Waiting," without permission on private categories, and "Validated" with all the permissions on the private categories<br>
- UAM plugin<br>
- Additional Pages plugin for adding and managing an additional page to replace the default index page of the gallery<br>
- Optionally, the plugin Extended Description to support multi-languages<br>
            </li><br><br>
            <li>
Stages:<br><br>
A. In plugin UAM:
              <ol>
                <li>Enable registration confirmation</li>
                <li>Enter text for additional explanation which will be attached to mail registration confirmation. If the plugin Extended Description is activated, the language tags can be used</li>
                <li>Select the "Waiting" group under "For users who have not validated their registration"</li>
                <li>Select the "Validated" group under "For users who have validated their registration"</li>
                <li>Save the plugin configuration</li>
              </ol>
<br>
B. In plugin Additional Pages:<br>
                <b>NOTE : The management of access rights for groups on Additional Pages must be turned on (see plugin configuration settings).</b>
                <br>
              <ol>
                <li>Add a new page with at least the following parameters:</li>
                <ul>
                  <li>Page name: The name you wish to give to the additional page (ie: Registration not validated)</li>
                  <li>Set as homepage checked</li>
                  <li>Groups allowed: Check the box corresponding to the group "Waiting" configured in UAM</li>
                  <li>Content: The text you want to use for visitors.</li>
                </ul>
                <br>
                <li>And that\'s it! Only visitors registered and whose registration has not been validated will see this additional index page.</li>
              </ol>
            </li>
          </ul>';
$lang['UAM_No_Ghosts'] = 'No ghosts visitors for the moment';
$lang['UAM_No_Userlist'] = 'No visitors to list for the moment';
$lang['UAM_No_Usermanager'] = 'No unvalidated registers to list for the moment';
$lang['UAM_Stuffs_Title'] = 'UAM block';
$lang['UAM_Stuffs_Desc'] = 'Adds an information block for unvalidated users';
$lang['UAM_Stuffs'] = 'PWG Stuffs block';
// --------- End: New or revised $lang ---- from version 2.20.0


// --------- Starting below: New or revised $lang ---- from version 2.20.3
$lang['UAM_DumpTxt'] = 'Backup your configuration';
$lang['UAM_Dump_Download'] = 'To download the backup file, please check this box:';
$lang['UAM_Save'] = 'Run backup';
$lang['UAM_Dump_OK'] = 'Backup file created successfully';
$lang['UAM_Dump_NOK'] = 'Error: Unable to create backup file !';
// --------- End: New or revised $lang ---- from version 2.20.3


// --------- Starting below: New or revised $lang ---- from version 2.20.4
$lang['UAM_HidePassw'] = 'Password in clear text in the information email';
// --------- End: New or revised $lang ---- from version 2.20.4


// --------- Starting below: New or revised $lang ---- from version 2.20.11
$lang['UAM_Error_Using_illegal_flag'] = 'Syntax error ! The [Kdays] AutoText flag is used as the "Deadline for registration validation limited" option was not activated. Please activate the option or correct the text field(s) colored in red.';
// --------- End: New or revised $lang ---- from version 2.20.11
?>