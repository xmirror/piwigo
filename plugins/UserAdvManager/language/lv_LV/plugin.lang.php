<?php

global $lang,$conf;

$conf_UAM = unserialize($conf['UserAdvManager']);


/* UserManager Tab */
$lang['UAM_Registration_Date'] = 'Reģistrācijas datums';


/* Mailing */
$lang['UAM_infos_mail %s'] = '%s, lūdzu meklējiet šeit savu informāciju, lai ielogotos galerijā :';
$lang['UAM_User: %s'] = 'Lietotājs: %s';
$lang['UAM_Password: %s'] = 'Parole: %s';
$lang['UAM_Link: %s'] = 'Lūdzu, uzklikšķiniet uz šīs saites, lai apstiprinātu savu reģistrāciju : %s';


/* Email confirmation page */
$lang['UAM_title_confirm_mail'] = 'Apstipriniet savu reģistrāciju';
$lang['UAM_confirm_mail_page_title'] = 'Apstipriniet savu reģistrāciju';


/* Errors and Warnings */
$lang['UAM_audit_ok'] = 'Pārbaude OK';
$lang['UAM_Err_audit_username_char'] = '<b>Šinī kontā izmantotas neatļautas rakstzīmes :</b> ';
$lang['UAM_Err_audit_email_forbidden'] = '<b>Šinī kontā izmanots neatļauts e-pasta pakalpojuma sniedzējs :</b> ';
$lang['UAM_Err_audit_advise'] = '<b>Jums ir jāveic korekcijas, lai panāktu atbilstību jaunajiem nosacījumiem, ko esat aktivizējuši.<br> Izmantojiet datu bāzes pārvaldības rīku, lai koriģētu lietotāja kontus tieši tabulā ###_USERS';
$lang['UAM_reg_err_login2'] = 'Lietotājvārdam nav jāsakrīt ar sekojošām rakstzīmēm: ';
$lang['UAM_reg_err_login5'] = 'Jūsu e-pasta pakalpojumu sniedzējam aizliegta reģistrācija. Aizniegtie e-pasta pakalpojumu sniedzēji ir: ';
$lang['UAM_empty_pwd'] = '[tukša parole]';
$lang['UAM_no_update_pwd'] = '[profile atjaunināts neizmainot paroli]';
$lang['UAM_No_validation_for_Guest'] = 'Viesa konts "Guest" nav pārbaudes objekts';
$lang['UAM_No_validation_for_default_user'] = 'Konts pēc noklusēšanas nav pārbaudes objekts';
$lang['UAM_No_validation_for_Webmaster'] = 'Konts "Webmaster" nav pārbaudes objekts';
$lang['UAM_No_validation_for_your_account'] = 'Jūsu personīgais admin konts nav pārbaudes objekts';


/* Processing messages */
$lang['UAM_%d_Mail_With_Key'] = '%d ziņojums ar atslēgas jauninājumu tika nosūtīts';
$lang['UAM_%d_Mails_With_Key'] = '%d ziņojumi ar atslēgas jauninājumu tika nosūtīti';
$lang['UAM_%d_Reminder_Sent'] = '%d atgādinājuma ziņojums tika nosūtīts';
$lang['UAM_%d_Reminders_Sent'] = '%d atgādinājuma ziņojumi tika nosūtīti';
$lang['UAM_%d_Validated_User'] = '%d Lietotājs apstiprināts manuāli';
$lang['UAM_%d_Validated_Users'] = '%d Lietotāji apstiprināti manuāli';


/* Action button names */
$lang['UAM_Delete_selected'] = 'Dzēst';
$lang['UAM_Mail_without_key'] = 'Atgādinājums bez atslēgas';
$lang['UAM_Mail_with_key'] = 'Atgādinājums ar atslēgu';




// --------- Starting below: New or revised $lang ---- from version 2.12.0 and 2.12.1
/* Global Configuration Tab */
$lang['UAM_PasswordTest'] = 'Rezultāta aprēķins';
/* Ghost Tracker Tab */
$lang['UAM_Tab_GhostTracker'] = 'Ghost Tracker (neredzamais izsekotājs)';
$lang['UAM_Reminder'] = 'Atgādinājuma e-pasts';
$lang['UAM_Reminder_Sent_OK'] = 'JĀ';
$lang['UAM_Reminder_Sent_NOK'] = 'NĒ';
/* Errors and Warnings */
$lang['UAM_save_config'] ='Konfigurācija saglabāta.';
$lang['UAM_reg_err_login3'] = 'Drošība : Parole ir obligāta !';
$lang['UAM_reg_err_login4_%s'] = 'Drošība : Kontrolsistēma aprēķina izvēlētās paroles sarežģītības pakāpi. Jūsu paroles sarežģītība ir par zemu (rezultāts = %s). Lūdzu, izveidojiet jaunu, drošāku paroli, sekojot šiem nosacījumiem:<br>
- Lietojiet burtus un ciparus<br>
- Lietojiet apakšējo un augšējo reģistru<br>
- Palieliniet tās garumu (rakstzīmju skaits)<br>
Minimālais, administratora pieprasītais paroles sarežģītības līmenis ir: ';
$lang['UAM_No_reminder_for_Guest'] = 'Konts "Guest" nav atgādinājumu no GhostTracker saņēmējsubjekts';
$lang['UAM_No_reminder_for_default_user'] = 'Konts pēc noklusējumu nav atgādinājumu no GhostTracker saņēmējsubjekts';
$lang['UAM_No_reminder_for_Webmaster'] = 'Konts "Webmaster" nav atgādinājumu no GhostTracker saņēmējsubjekts ';
$lang['UAM_No_reminder_for_your_account'] = 'Jūsu personīgais admin konts nav atgādinājumu no GhostTracker saņēmējsubjekts';
/* Action button names */
$lang['UAM_audit'] = 'Pārbaudes iestatījumi';
$lang['UAM_submit'] = 'Saglabāt iestatījumus';
// --------- End: New or revised $lang ---- from version 2.12.0 and 2.12.1


// --------- Starting below: New or revised $lang ---- from version 2.12.2
/* Errors and Warnings */
$lang['UAM_GhostTracker_Init_OK'] = 'Ghost Tracker atiestatīšana (reset) paveikta !';
/* Action button names */
$lang['UAM_GT_Reset'] = 'Atiestatīt Ghost Tracker';
// --------- End: New or revised $lang ---- from version 2.12.2


// --------- Starting below: New or revised $lang ---- from version 2.12.8
/* Errors and Warnings */
$lang['UAM_mail_exclusionlist_error'] = 'Brīdinājums! Jūs esat ievadījis jaunu rindu (CR-LF) e-pasta izņēmumu saraksta sākumā (parādīts ar sarkanu zemāk). Lai gan šī jaunā rinda nav redzama, tā joprojām eksistē un var būt par iemeslu spraudņa kļūmīgai darbībai. Lūdzu pārrakstiet jūsu izņēmumu sarakstu, lai tas nesāktos ar jaunu tukšu rindu.';
// --------- End: New or revised $lang ---- from version 2.12.8


// --------- Starting below: New or revised $lang ---- from version 2.13.0
/* UserList Tab */
$lang['UAM_UserList_Title'] = 'Re;gistrēto lietotāju Monitorings';
// --------- End: New or revised $lang ---- from version 2.13.0


// --------- Starting below: New or revised $lang ---- from version 2.13.4
/* Global Configuration Tab */
$lang['UAM_Title_Tab'] = 'UserAdvManager - Versija : ';
$lang['UAM_SubTitle1'] = 'Spraudņa konfigurācija';
$lang['UAM_Tab_Global'] = 'Konfigurācija';
$lang['UAM_Title1'] = 'Reģistrācijas ierobežojumu iestatīšana';
$lang['UAM_Title2'] = 'Reģistrācijas apstiprinājumu un pārbaudes iestatīšana';
$lang['UAM_Title3'] = 'Pēcreģistrācijas un citu opciju iestatīšana';
$lang['UAM_Title4'] = 'Lietošanas piemēri un ieteikumi';
$lang['UAM_No_Casse'] = 'Lietotājvārdi: Reģistrjutība';
$lang['UAM_Username_Char'] = 'Lietotājvārdi: Rakstzīmju izslēgšana';
$lang['UAM_Username_Char_true'] = ' Aizliegtās rakstzīmes:<br>(Lietot komatu, atdalot rakstzīmes)<br><br>';
$lang['UAM_Username_Char_false'] = ' Atļaut visas (pēc noklusēšanas)';
$lang['UAM_Password_Enforced'] = 'Paroļu drošības līmeņa stiprināšana';
$lang['UAM_Password_Enforced_true'] = ' Iespējot. Minimālais līmenis: ';
$lang['UAM_AdminPassword_Enforced'] = 'Attiecas uz administratoriem';
$lang['UAM_PasswordTest'] = 'Paroles tests: ';
$lang['UAM_ScoreTest'] = 'Rezultāts: ';
$lang['UAM_MailExclusion'] = 'E-pasta domēnu izslēgšana';
$lang['UAM_MailExclusion_true'] = ' Izslēgt sekojošus domēnus:<br>(Lietojiet komatu, lai atdalītu domēnus)';

$lang['UAM_Mail_Info'] = 'Informācijas sūtīšana lietotājiem ar e-pastu:';
$lang['UAM_MailInfo_Text'] = ' Insormācijas e-pasta pielāgošana:';
$lang['UAM_Confirm_Mail'] = 'Reģistrācijas apstiprināšana:';
$lang['UAM_ConfirmMail_Text'] = ' Apstiprinājuma e-pasta pielāgošana:';
$lang['UAM_Confirm_grpstat_notice'] = 'Brīdinājums: Ieteicams lietot vai nu grupu vai pārbaudes statūtus, bet ne abus vienlaicīgi.';
$lang['UAM_Confirm_Group'] = 'Pārbaudes Grupas <br>(atmest ------- lai neietekmētu grupu)';
$lang['UAM_Confirm_Status'] = 'Pārbaudes statūti<br>(atmest ------- lai saglabātu Piwigo noklusējumu)';
$lang['UAM_No_Confirm_Group'] = 'Grupa priekš reģistrāciju neapstiprinājušajiem lietotājiem<br>';
$lang['UAM_Validated_Group'] = 'Grupa priekš reģistrāciju apstiprinājušajiem lietotājiem <br>';
$lang['UAM_No_Confirm_Status'] = ' Reģistrāciju neapstiprinājušo lietotāju statuss<br>';
$lang['UAM_Validated_Status'] = ' Reģistrāciju apstiprinājušo lietotāju statuss<br>';
$lang['UAM_ValidationLimit_Info'] = 'Reģistrācijas apstiprināšanas limita robežlīnija';
$lang['UAM_ConfirmMail_TimeOut_true'] = ' Iespējot. Dienu skaits līdz termiņa beigām: ';
$lang['UAM_ConfirmMail_Remail'] = 'Atcerēties neakceptētos lietotājus';
$lang['UAM_ConfirmMail_ReMail_Txt1'] = 'Pielāgot atgādinājuma ziņu<b><u>ņemot vērā</u></b> jaunās reģenerācijas atslēgas pārbaudi.';
$lang['UAM_ConfirmMail_ReMail_Txt2'] = 'Pielāgot atgādinājuma ziņu <b><u>bez</u></b> reģenerācijas atslēgas pārbaudes.';

$lang['UAM_GhostTracker'] = 'Ghost (slēpto) apmeklētāju pārvaldība (Ghost Tracker)';
$lang['UAM_GhostTracker_true'] = ' Iespējot. Maksimālais periods dienās starp divām vizītēm: ';
$lang['UAM_GhostTracker_ReminderText'] = 'Ghost Tracker atgadinājuma ziņojuma pielāgošana';
$lang['UAM_LastVisit'] = ' Reģistrēto lietotāju izsekošana';

$lang['UAM_Tab_UserManager'] = 'Apstiprinājumu izsekošana';

/* UserManager Tab */
$lang['UAM_SubTitle3'] = 'Apstiprinājumu izsekošana';
$lang['UAM_UserManager_Title'] = 'Apstiprinājumu izsekošana';
/* Ghost Tracker Tab */
$lang['UAM_SubTitle4'] = 'Ghost Tracker';
$lang['UAM_GT_Init'] = 'Ghost Tracker inicializācija';
$lang['UAM_GhostTracker_Title'] = 'Ghost (slēpto) apmeklētāju pārvaldība';
$lang['UAM_GhostTracker_Init'] = 'Ja grasāties lietot šo iespēju pirmo reizi vai reaktivējat to pēc ilgāka laika, kurā reģistrējušies jauni lietotāji, jums jāinicializē vai jāresetē Ghost Tracker. Šī darbība ir veicama tikai pēc opcijas aktivēšanas vai reaktivēšanas. Lūdzu klikšķiniet <u>vienreiz</u> uz reset pogas zemāk.';
/* UserList Tab */
$lang['UAM_SubTitle5'] = 'Lietotāju izsekošana';
$lang['UAM_Tab_UserList'] = 'Lietotāju izsekošana';
/* Mailing */
$lang['UAM_Add of %s'] = 'Profils izveidos priekš %s';
$lang['UAM_Update of %s'] = 'Profils %s atjaunināts';

/* Mailing */
$lang['UAM_Ghost_reminder_of_%s'] = '%s, šis ir atgādinājuma e-pasts';
$lang['UAM_Reminder_with_key_of_%s'] = '%s, jūsu apstiprināšanas atslēga ir atjaunota';
$lang['UAM_Reminder_without_key_of_%s'] = '%s, jūsu apstiprināšanas atslēgas darbība beigsies';
/* Errors and Warnings */
$lang['UAM_Err_GhostTracker_Settings'] = 'Šī lapa pieejama tikai, ja "Ghost Tracker" ir aktīvs iekš "Setting the registrations followed and other options".';
$lang['UAM_Err_Userlist_Settings'] = 'Šī lapa ir pieejama tikai, ja "Monitoring registered users" ir aktīvs iekš "Setting the registrations followed and other options".';
// --------- End: New or revised $lang ---- from version 2.13.4


// --------- Starting below: New or revised $lang ---- from version 2.14.0
$lang['UAM_AdminConfMail'] = 'Reģistrācijas apstiprināšana administratoriem';
$lang['UAM_Tips1_txt'] = '
<ul>
<li>
             Mērķi:<br>
             - Pēc viņa ienākšanas galerijā: Informēt apmeklētāju, ka viņam jāpiereģistrējas, lai tiktu pie privātiem fotoattēliem<br>
             - Pie reģistrācijas: Ģenerēt tiešsaistes e-pasta apstiprinājumu, informēt jauno lietotāju par to, ka viņš vēl nav apstiprināts un iekļaut viņu gaidīšanas grupā "Waiting"<br>
             - Pie apstiprināšanas: Automātiski pārslēgt no gaidīšanas grupas "Waiting" uz apstiprināto grupu "Validated", kas dod pieeju privātām kategorijām<br><br>
<b>Atgādinājums: Pie standartoperācijām "Guest" (viesis) redz tikai publiskās kategorijas bez informatīvā materiāla.</b>
</li><br><br>
<li>
Priekšnoteikumi:<br>
- Galerija ar visām vai dažām privātajām ketegorijām redzama tikai reģistrētiem lietotājiem<br>
- Vismaz 2 sekojošas Piwigo lietotāju grupas:gaidīšanas grupa  "Waiting," bez tiesībām darboties ar privātām kategorijām un apstiprināto grupa "Validated" ar visām tiesībām darbam ar privātām kategorijām<br>
- UAM spraudnis<br>
- PWG Stuffs spraudnis, moduļa "Personal Block" pievienošanai<br>
- Pēc izvēles (neobligāts), spraudnis Extended Description (paplašināts apraksts), lai nodrošinātu daudzvalodu atbalstu<br>
</li><br><br>
<li>
Posmi:<br><br>
A. UAM spraudnī:
<ol>
<li>Iespējo reģistrācijas apstiprināšanu</li>
<li>Ievada papildinformāciju-skaidrojumu, kas tiks pievienots e-pasta reģistrācijas apstiprinājumam. Gadījumā, ja ir aktivēts spraudnis Extended Description (papildus apraksts), var tikt lietotas valodu iezīmes (tagi)</li>
<li>Izvēlas gaidīšanas grupu "Waiting" sadaļā "Lietotājiem, kas nav apstiprinājuši savu reģistrāciju"</li>
<li>Izvēlas apstiprināto grupu "Validated" sadaļā "Lietotājiem, kas apstiprinājuši savu reģistrāciju"</li>
<li>Saglabā spraudņa konfigurāciju</li>
</ol>
<br>
B. PWG Stuffs spraudnī :
<ol>
<li>Pievieno jauna tipa moduli "Personal block: Rāda bloķētos darbiniekus (piem. redakcionāli)"</li>
<li>Konfigurē moduli, norādot nosaukumu (piem."Registration pending validation") un tā aprakstu, pārbaudot grupu "Waiting"  atļauto grupu sarakstā</li>
<li>Pabeidz moduļa saturu ar informatīvu ziņojumu neapstiprinātajiem lietotājiem.Kā UAM valodas iezīmes var tikt lietotas, ja spraudnī ir iespējota papildus apraksta Extended Description funkcija</li>
<li>Atzīmē "Rādīt moduli vietnes mājas lapā"</li>
<li>Pārbauda moduļa konfigurāciju</li>
</ol>
</li>
</ul>';
// --------- End: New or revised $lang ---- from version 2.14.0


// --------- Starting below: New or revised $lang ---- from version 2.15.0
$lang['UAM_confirmmail_custom_Txt1'] = 'Apstiprinājuma lapas teksts – Apstiprinājums akceptēts';
$lang['UAM_confirmmail_custom_Txt2'] = 'Apstiprinājuma lapas teksts – Apstiprinājums noraidīts';
$lang['UAM_LastVisit_Date'] = 'Pēdējais apciemojums';
$lang['UAM_Nb_Days'] = 'Atšķirība dienās';
$lang['UAM_Err_UserManager_Settings'] = 'Šī lapa piejam tikai, ja "Reģistrācijas apstiprināšana" ir aktīva un neapstiprināto apmeklētāju grupa ir nokonfigurēta sadaļā "Setting confirmations and validations of registration" (reģistrācijas pārbaudes un apstiprinājuma iestatījumi).';
// --------- End: New or revised $lang ---- from version 2.15.0


// --------- Starting below: New or revised $lang ---- from version 2.15.1
$lang['UAM_Support_txt'] = 'Oficiāls šī spraudņa atbalsts ir pieejams tikai Piwigo forumā:<br>
<a href="http://piwigo.org/forum/viewtopic.php?id=15015" onclick="window.open(this.href);return false;">Forums angļu valodā - http://piwigo.org/forum/viewtopic.php?id=15015</a><br><br>
Vēl pieejasms projekta bugtracker: <a href="http://piwigo.org/bugs/" onclick="window.open(this.href);return false;">http://piwigo.org/bugs/</a>';
// --------- End: New or revised $lang ---- from version 2.15.1


// --------- Starting below: New or revised $lang ---- from version 2.15.4
$lang['UAM_Force_Validation'] = 'Manuālā apstiprināšana';
$lang['UAM_Confirm_Mail_true'] = ' Iespējot – Apstiprinājis lietotājs';
$lang['UAM_Confirm_Mail_local'] = ' Iespējot – Apstiprinājis administrators (netika nosūtīta apstiprināšanas atslēga)';
$lang['UAM_RedirToProfile'] = 'Novirzīt uz "Customization" (pielāgošanas) lapu';
// --------- End: New or revised $lang ---- from version 2.15.4


// --------- Starting below: New or revised $lang ---- from version 2.16.0
/* TODO */$lang['UAM_Expired_Group'] = '<b>Group</b> for user\'s registration has expired<br>';
/* TODO */$lang['UAM_Expired_Status'] = '<b>Status</b> for user\'s registration has expired<br>';
/* TODO */$lang['UAM_GTAuto'] = 'Automatic management of ghosts users';
/* TODO */$lang['UAM_GTAutoDel'] = 'Automatic deletion of accounts';
/* TODO */$lang['UAM_GTAutoGp'] = 'Automatic change of group / status';
/* TODO */$lang['UAM_GTAutoMail'] = 'Automatically sending an email when changing group / status';
/* TODO */$lang['UAM_Deleted_Account_Redirection_Page'] = 'Access denied - Account destroyed!';
/* TODO */$lang['UAM_title_redir_page'] = 'Access denied for having an account destroyed!';
/* TODO */$lang['UAM_Error_GTAutoMail_cannot_be_set_without_ConfirmMail'] = 'Consistency error in the configuration chosen:<br><br>
"Setting the followed registrations and other options > Ghost visitors management (Ghost Tracker) > Automatic management of ghosts users > Automatically sending an email when changing group / status" can not be activated if "Setting confirmations and validations of registration > Confirmation of registration - Validation by user" is not enabled at first.<br><br>
To ensure consistency, the option "Automatically sending an email when changing group / status" was automatically repositioned "disabled".<br><br>';
/* TODO */$lang['UAM_Demotion of %s'] = 'Demotion of %s';
/* TODO */$lang['UAM_AdminValidationMail_Text'] = 'Notification of manual registration validation';
/* TODO */$lang['UAM_Validation of %s'] = 'Validation of %s';
// --------- End: New or revised $lang ---- from version 2.16.0


// --------- Starting below: New or revised $lang ---- from version 2.20.0
/* TODO */$lang['UAM_CustomPasswRetr'] = 'Customize lost password email content';
/* TODO */$lang['UAM_USRAuto'] = 'Automatic management of unvalidated users';
/* TODO */$lang['UAM_USRAutoDel'] = 'Custom message on deleted account';
/* TODO */$lang['UAM_USRAutoMail'] = 'Automated email reminder';
$lang['UAM_Disable'] = ' Atspējot (pēc noklusējuma)';
$lang['UAM_Enable'] = ' Iespējot ';
/*TODO*/$lang['UAM_Tips1'] = 'Information of non-validated registration with UAM and PWG_Stuffs';
/*TODO*/$lang['UAM_Tips1_txt'] = '
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
/*TODO*/$lang['UAM_Tips2'] = 'Information of non-validated registration with UAM and Additional Pages';
/*TODO*/$lang['UAM_Tips2_txt'] = '
          <ul>
            <li>
            Goals: Inform the visitor that the registration is awaiting validation by posting an additional page replacing the standard index page gallery at each of these connections, and this, as registration is not approved.
            <br><br>
            Advantages over the method with PWG_Stuffs: Allow formatting information and displaying the information immediately upon registration of visitors.
            </li><br><br>
            <li>
Priekšnoteikumi:<br>
- Galerija ar visām vai dažām privātajām ketegorijām redzama tikai reģistrētiem lietotājiem<br>
- Vismaz 2 sekojošas Piwigo lietotāju grupas:gaidīšanas grupa  "Waiting," bez tiesībām darboties ar privātām kategorijām un apstiprināto grupa "Validated" ar visām tiesībām darbam ar privātām kategorijām<br>
- UAM spraudnis<br>
- Additional Pages plugin for adding and managing an additional page to replace the default index page of the gallery<br>
- Pēc izvēles (neobligāts), spraudnis Extended Description (paplašināts apraksts), lai nodrošinātu daudzvalodu atbalstu<br>
            </li><br><br>
            <li>
Posmi:<br><br>
A. UAM spraudnī:
<ol>
<li>Iespējo reģistrācijas apstiprināšanu</li>
<li>Ievada papildinformāciju-skaidrojumu, kas tiks pievienots e-pasta reģistrācijas apstiprinājumam. Gadījumā, ja ir aktivēts spraudnis Extended Description (papildus apraksts), var tikt lietotas valodu iezīmes (tagi)</li>
<li>Izvēlas gaidīšanas grupu "Waiting" sadaļā "Lietotājiem, kas nav apstiprinājuši savu reģistrāciju"</li>
<li>Izvēlas apstiprināto grupu "Validated" sadaļā "Lietotājiem, kas apstiprinājuši savu reģistrāciju"</li>
<li>Saglabā spraudņa konfigurāciju</li>
</ol>
<br>
B. Additional Pages spraudnī :<br>
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
/*TODO*/$lang['UAM_No_Ghosts'] = 'No ghosts visitors for the moment';
/*TODO*/$lang['UAM_No_Userlist'] = 'No visitors to list for the moment';
/*TODO*/$lang['UAM_No_Usermanager'] = 'No unvalidated registers to list for the moment';
/*TODO*/$lang['UAM_Stuffs_Title'] = 'UAM block';
/*TODO*/$lang['UAM_Stuffs_Desc'] = 'Adds an information block for unvalidated users';
/*TODO*/$lang['UAM_Stuffs'] = 'PWG Stuffs block';
// --------- End: New or revised $lang ---- from version 2.20.0


// --------- Starting below: New or revised $lang ---- from version 2.20.3
/*TODO*/$lang['UAM_DumpTxt'] = 'Backup your configuration';
/*TODO*/$lang['UAM_Dump_Download'] = 'To download the backup file, please check this box:';
/*TODO*/$lang['UAM_Save'] = 'Run backup';
/*TODO*/$lang['UAM_Dump_OK'] = 'Backup file created successfully';
/*TODO*/$lang['UAM_Dump_NOK'] = 'Error: Unable to create backup file !';
// --------- End: New or revised $lang ---- from version 2.20.3


// --------- Starting below: New or revised $lang ---- from version 2.20.4
/*TODO*/$lang['UAM_HidePassw'] = 'Clear password in information email';
// --------- End: New or revised $lang ---- from version 2.20.4


// --------- Starting below: New or revised $lang ---- from version 2.20.11
/*TODO*/$lang['UAM_Error_Using_illegal_flag'] = 'Syntax error ! The [Kdays] AutoText flag is used as the "Reģistrācijas apstiprināšanas limita robežlīnija" option was not activated. Please activate the option or correct the text field(s) colored in red.';
// --------- End: New or revised $lang ---- from version 2.20.11
?>