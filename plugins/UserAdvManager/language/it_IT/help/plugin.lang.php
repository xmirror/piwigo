<?php
global $lang;

$lang['UAM_restricTitle'] = 'Restrizioni per le iscrizzioni';
$lang['UAM_confirmTitle'] = 'Confirmazzione e validazione delle iscrizzioni';
$lang['UAM_confirmTitle_d'] = '
- Generazzione di un\'Email d\'informazione<br>
- Generazzione di un\'Email di conferma d\'iscrizzione<br>
- Inserimento in automatico dei gruppi / statuti<br>
- Limitazzione del termine di convalida dell\'iscrizzione<br>
- Generazzione di un\'Email di rilancio per gli utenti non convalidati<br>
...
';
$lang['UAM_miscTitle'] = 'Monitoraggio degli utenti registrati e altre opzioni';
$lang['UAM_carexcTitle'] = 'Pseudo: Esclusione di caratteri';
$lang['UAM_carexcTitle_d'] = 'Può essere interessante vietare certi caratteri per i pseudo (ad esempio: negare login contenente &quot;@&quot;). Questa opzione permette di escludere i caratteri o sequenza di caratteri, eventi.<br>
NB: L\'opzione può anche escludere parole intere.
<br><br>
<b style=&quot;color: red;&quot;>Attenzione: questa opzione non ha alcun effetto sui pseudo creati prima della sua attivazione.</b>';
$lang['UAM_passwTitle'] = 'Rafforzare il livello di sicurezza delle password';
$lang['UAM_passwTitle_d'] = 'L\'attivazione di questa opzione rende obbligatorio l\'inserimento di una password al momento della registrazione, e richiede la password scelta dal visitatore di incontrare un livello minimo di complessità. Se la soglia non viene raggiunta, il punteggio conseguito e il punteggio minimo da raggiungere sono visualizzate, insieme con raccomandazioni per aumentare il valore di questa partitura.<br><br>
Non vi è prova in campo per misurare la complessità di una password, e può permettersi di avere un\'idea del punteggio per definire personalizzati complessi.<br><br>
Nota: Il punteggio di una password è calcolato sulla base di diversi parametri: la lunghezza, il tipo di caratteri utilizzati (lettere, numeri, lettere maiuscole, minuscole, caratteri speciali). Un punteggio inferiore a 100 è considerata bassa, da 100 a 500, la complessità è nella media, oltre 500, la sicurezza è eccellente.';
$lang['UAM_passwtestTitle'] = 'Prova la complessità di una password';
$lang['UAM_passwtestTitle_d'] = 'Inserisci la password per testare e quindi fare clic su &quot;calcolo del punteggio&quot;, per vedere il risultato.';
$lang['UAM_passwadmTitle'] = 'Applicando agli amministratori';
$lang['UAM_passwadmTitle_d'] = 'Un amministratore può creare un\'pseudo con o senza l\'applicazione della regola della complessità di calcolo.<br><br>
Nota: Se l\'account utente creato vuole cambiare la password e il rafforzamento password per gli utenti è attivo, sarà soggetta alla regola.';
$lang['UAM_mailexcTitle'] = 'L\'esclusione Email domini';
$lang['UAM_infomailTitle'] = 'E-mail informazioni per l\'utente';
$lang['UAM_infomailTitle_d'] = 'Questa opzione consente di automatizzare l\'invio di una e-mail le informazioni a un utente al momento della registrazione o quando cambia la sua password o indirizzo e-mail nel loro profilo.<br><br>
Il contenuto del messaggio inviato è composto da una parte personalizzabile di introdurre una piccola nota di benvenuto e una parte fissa che indica il login, password e indirizzo di posta elettronica dell\'utente.';
$lang['UAM_infotxtTitle'] = 'Personalizzazione e-mail informazioni';
/* TODO */$lang['UAM_confirmtxtTitle'] = 'Customizing the confirmation email';
/* TODO */$lang['UAM_confirmgrpTitle'] = 'Validation Groups';
/* TODO */$lang['UAM_confirmgrpTitle_d'] = '<b style=&quot;color: red;&quot;>WARNING : Using validation groups requires that you have created at least one users group and is defined &quot;by default&quot; in Piwigo\'s user groups management.</b><br><br>
The groups are validated for use in conjunction with the &quot;Confirmation of registration&quot;';
/* TODO */$lang['UAM_confirmstatTitle'] = 'Validation Statutes';
/* TODO */$lang['UAM_confirmstatTitle_d'] = '<b style=&quot;color: red;&quot;>WARNING : The use of status validation requires that you have kept the &quot;Guest&quot; user with default setting (as user template) for new registered. Note you can set any other user as a template for new registered. Please refer to the Piwigo\'s documentation for more details.</b><br><br>
The groups are validated for use in conjunction with the &quot;Confirmation of registration&quot;';
/* TODO */$lang['UAM_validationlimitTitle'] = 'Deadline for registration validation limited';
/* TODO */$lang['UAM_remailTitle'] = 'Remind unvalidated users';
/* TODO */$lang['UAM_remailtxt1Title'] = 'Reminder email with new key generated';
/* TODO */$lang['UAM_remailtxt2Title'] = 'Reminder email without new key generated';
/* TODO */$lang['UAM_ghosttrackerTitle'] = 'Ghost visitors management';
/* TODO */$lang['UAM_gttextTitle'] = 'Ghost Tracker\'s reminder message';
/* TODO */$lang['UAM_lastvisitTitle'] = 'Tracking registered users';
/* TODO */$lang['UAM_lastvisitTitle_d'] = 'This activates a table in the &quot;Tracking users&quot; tab which are registered users listed on the gallery and the date of their last visit and time spent (in days) since their last visit. Monitoring is purely informative for the administrator of the gallery.';
/* TODO */$lang['UAM_tipsTitle'] = 'Tips and Examples';
/* TODO */$lang['UAM_tipsTitle_d'] = 'Tips and various examples of use';
/* TODO */$lang['UAM_userlistTitle'] = 'Tracking users';
/* TODO */$lang['UAM_usermanTitle'] = 'Tracking validations';
/* TODO */$lang['UAM_gtTitle'] = 'Ghost visitors management';


// --------- Starting below: New or revised $lang ---- from version 2.14.0
$lang['UAM_adminconfmailTitle'] = 'Conferma della registrazione per gli amministratori';
$lang['UAM_adminconfmailTitle_d'] = '&Egrave; possibile disattivare la convalida solo per gli account utente creato dall\'amministratore Piwigo tramite l\'interfaccia di gestione di utenti.<br><br>
Attivando questa opzione, la convalida e-mail di registrazione verr&agrave; inviato ad ogni utente creato da admin.<br><br>
Disabilitando questa opzione ((predefinito)), solo le informazioni e-mail viene inviata (se &quot;E-mail informazioni per l\'utente&quot; &egrave; abilitato).';
// --------- End: New or revised $lang ---- from version 2.14.0


// --------- Starting below: New or revised $lang ---- from version 2.15.4
$lang['UAM_restricTitle_d'] = '
- Caratteri vietati nei nomi degli utenti<br>
- Rafforzare il livello di sicurezza delle password<br>
- Esclusione dei domini d\'Email<br>
...
';
/* TODO */$lang['UAM_userlistTitle_d'] = 'This page is for information to the administrator. It displays a list of all users registered on the gallery showing the date and number of days since their last visit. The list is sorted in ascending order of number of days.
<br><br>
<b><u>Only when the Ghost Tracker is active</u></b>, the number of days without a visit appears as the following color code, according to the maximum set in the Ghost Tracker options:
<br>
- <b style=&quot;color: lime;&quot;>Green</b> : When the user has visited the gallery <b style=&quot;color: lime;&quot;><u>less than 50%</u></b> of the maximum indicated in the Ghost Tracker.<br>
- <b style=&quot;color: orange;&quot;>Orange</b> : When the user has visited the gallery <b style=&quot;color: orange;&quot;><u> between 50% and 99% </u></b> of the maximum indicated in the Ghost Tracker.<br>
- <b style=&quot;color: red;&quot;>Red</b> : When the user has visited the gallery <b style=&quot;color: red;&quot;><u>for more than 100%</u></b> of the maximum indicated in the Ghost Tracker. <b><u>In this case, the user must also appear in the Ghost Tracker table.</u></b><br>
<br>
Example :
<br>
The maximum period of Ghost Tracker is configured to 100 days.
<br>
A user will appear in green if he visited the gallery for less than 50 days, in orange if his last visit took place between 50 and 99 days and red for 100 days and above.
<br><br>
<b>NOTE</b>: The list does not display who have not validated their registration (if the option of validating the registration is activated). These users are then managed in a special way in the &quot;Tracking validations&quot; tab.
<br><br>
<b>Table Sorting Function</b>: You can sort the data displayed by clicking on the column headers. Hold the SHIFT key to sort up to 4 simultaneous columns.';
/* TODO */$lang['UAM_usermanTitle_d'] = 'When limiting the deadline for registration is enabled, you will find below the list of users whose validation registration is expected, <b style=&quot;text-decoration: underline;&quot;>whether or not</b> they are in time to validate.<br><br>
The registration date is displayed in green when the user concerned is below the time limit to validate his registration. In this case, the validation key is still valid and we can send an email with or without a new validation key.<br><br>
When the registration date appears in red, the validation period has expired. In this case, you must send an email with regeneration of validation key if you want to enable the user to validate their registration.<br><br>
In all cases, it is possible to manually force the validation.<br><br>
In this view, you can:
<br><br>
- Manually delete accounts <b>(manual drain)</b>
<br>
- Generate email reminder <b>without</b> generating a new key. Warning: Send an email reminder to targeted visitors. This function does not reset the date of registration of targeted visitors and the timeout is still valid.
<br>
- Generate email reminder <b>with</b> generating a new key. Warning : Send an email reminder to targeted visitors. This function also resets the date of registration of targeted visitors which equates to extend the deadline for validation.
<br>
- Submit a registration awaiting validation manually even if the expiry date has passed <b>(forcing validation)</b>.
<br><br>
<b>Table Sorting Function</b>: You can sort the data displayed by clicking on the column headers. Hold the SHIFT key to sort up to 4 simultaneous columns.';
/* TODO */$lang['UAM_gtTitle_d'] = 'When Ghost Tracker is enabled and initialized, you will find below the list of registered visitors who have not returned since x days. &quot;x&quot; is the number of days configured in the General Setup tab. In addition, you will find a column indicating whether an email reminder has been sent to targeted visitors. So, you can see at a glance and treat visitors who have not taken account of the reminder.<br><br>In this view, you can:
<br><br>
- Manually delete accounts <b>(manual drain)</b>
<br>
- Generate email reminder <b>with resetting the last visit date</b>. This allows to give a wildcard to targeted visitors. If the visitor has already received a reminder, nothing prevents to resent a new mail which will reset again, in fact, the last visit date.
<br><br>
<b>Table Sorting Function</b>: You can sort the data displayed by clicking on the column headers. Hold the SHIFT key to sort up to 4 simultaneous columns.';
$lang['UAM_confirmmailTitle'] = 'Conferma della registrazione';
/*TODO*/$lang['UAM_confirmmailTitle_d'] = 'This option allows a user to either confirm registration by clicking on a link received in an email sent upon registration or the administrator to manually activate the registration.<br><br>
In first case, the e-mail is composed of a customizable part to introduce a little welcome note and a fixed part containing the activation link that is generated from a random key that can possibly regenerate through the &quot;Tracking validations&quot; tab.<br><br>
Dans le premier cas, le message envoyé comprend une partie fixe, avec le lien d\'activation généré à partir d\'une clef aléatoire (cette clé peut éventuellement être régénérée via l\'onglet &quot;Suivi des validations&quot;), et une partie personnalisable par un texte d\'accueil.
<br><br>
Questa opzione &egrave; generalmente utilizzato con l\'assegnazione automatica di gruppo e / o statuto. Ad esempio, un utente che non ha convalidato la loro registrazione sar&agrave; ambientato in un gruppo specifico di utenti (con o senza le restrizioni alla galleria), mentre un utente che ha convalidato la sua registrazione &egrave; fissato in un &quot;normale&quot; del gruppo.';
/*TODO*/$lang['UAM_RedirTitle'] = 'Redirect to &quot;Customization&quot; page';
// --------- End: New or revised $lang ---- from version 2.15.4


// --------- Starting below: New or revised $lang ---- from version 2.15.6
/*TODO*/$lang['UAM_RedirTitle_d'] = 'This option automatically redirect a registered user to his customization page only at his first connection to the gallery.<br><br>
Please note: This feature does not apply to all registered users. Those with &quot;admin&quot;, &quot;webmaster&quot; or &quot;generic&quot; status are excluded.';
// --------- End: New or revised $lang ---- from version 2.15.6


// --------- Starting below: New or revised $lang ---- from version 2.16.0
$lang['UAM_confirmmail_custom1'] = 'Testo della pagina di conferma - Conferma accettati';
$lang['UAM_confirmmail_custom2'] = 'Testo della pagina di conferma - Conferma respinto';
/* TODO */$lang['UAM_miscTitle_d'] = '
- Automatic or manual management of ghosts users<br>
- Followed registered users<br>
- Nickname mandatory for guests comments<br>
...
';
/* TODO */$lang['UAM_ghosttrackerTitle_d'] = 'Also called &quot;Ghost Tracker&quot;, when this function is activated, you can manage your visitors depending on the frequency of their visits. 2 operating modes are available:<br><br>
- Manual management : When the time between 2 visits is reached,, the visitor appears in the &quot;Ghost Tracker&quot; table where you will be able to remind visitors via email or delete him.<br><br>
- Automated management : When the period between 2 successive visits is reached, the visitor is automatically deleted or moved into a wait group and/or status. In this second case, an information email can be sent to him.<br><br>
<b style=&quot;color: red;&quot;>Important note : If you enable this feature for the first time or you have reactivated after a long period off during which new visitors are registered, you must initialize or reset the Ghost Tracker (see corresponding instructions on &quot;Ghost Tracker&quot; tab).</b>';
$lang['UAM_mailexcTitle_d'] = 'Per impostazione predefinita, PhpWebGallery accetta tutti gli indirizzi di posta elettronica nel xxx@yyy.zz formato. L\'attivazione di questa opzione consente di escludere determinati domini nel formato: @[nome_dominio].[Domain_extension].<br><br>
Esempi :<br>
@hotmail.com -> esclusi gli indirizzi *@hotmail.com<br>
@hotmail -> escludendo tutti gli indirizzi *@hotmail*';
/* TODO */$lang['UAM_GTAutoTitle'] = 'Automatic management of ghosts users';
/* TODO */$lang['UAM_GTAutoTitle_d'] = 'This option allows to apply rules for automated management of ghosts users.
<br><br>Basic Principle: A user who reaches the maximum time between visits <b><u>and</u></b> has already been notified by email is considered as expired. Then you can apply automated processing rules such as automatic deletion of expired accounts or demotion by restricting access to the gallery (switch automatically to a restricted group and/or status).
<br><br>The triggering of these automation is achieved when connecting users (any user!) to the gallery.';
/* TODO */$lang['UAM_GTAutoDelTitle'] = 'Custom message on deleted account';
/* TODO */$lang['UAM_GTAutoGpTitle'] = 'Automatic change of group / status';
/* TODO */$lang['UAM_GTAutoGpTitle_d'] = 'The automatic change of group or status equivalent to a demotion of the accounts involved and working on the same principle as the group or the status of validation (see &quot;Setting confirmations and validations of registration&quot;). Therefore be to define a group and / or status demoting access to the gallery. If this has already been defined with the use of registration confirmation function, you can use the same group / status.<br><br>
<b style=&quot;color: red;&quot;>Important note :</b> If a ghost user still has not heard from after the time limit and despite the automatic notification by email (if enabled), he\'s automatically deleted from the database.';
/* TODO */$lang['UAM_GTAutoMailTitle'] = 'Automatically sending an email when changing group / status';
/* TODO */$lang['UAM_AdminValidationMail'] = 'Notification of manual registration validation';
// --------- End: New or revised $lang ---- from version 2.16.0


// --------- Starting below: New or revised $lang ---- from version 2.20.0
/* TODO */$lang['UAM_CustomPasswRetrTitle'] = 'Customize lost password email content';
/* TODO */$lang['UAM_validationlimitTitle_d'] = 'This option allows to limit the validity of key validation email sent to new registrants. Visitors who register will have x days of time to validate their registration. After this period the validation link will expire.
<br><br>
This option is used in conjunction with the &quot;Confirmation of registration&quot;
<br><br>
If this option and the option &quot;Remind unvalidated users&quot; are activated, new options will appear below in this section to enable the automation of unvalidated users management.';
/* TODO */$lang['UAM_remailTitle_d'] = 'This option allows you to send a reminder email to users registered but have not validated their registration on time. It therefore works in conjunction with the &quot;Confirmation of registration&quot;
<br><br>
2 types of emails can be sent: With or without regeneration of the validation key. As appropriate, the content of emails can be customized.
<br><br>
Refer to the &quot;Tracking validations&quot; tab.
<br><br>
If this option and the option &quot;Deadline for registration validation limited&quot; are activated, new options will appear below in this section to enable the automation of unvalidated users management.';
/*TODO*/$lang['UAM_USRAutoTitle'] = 'Automatic management of unvalidated users';
/*TODO*/$lang['UAM_USRAutoTitle_d'] = 'Automatic handling of unvalidated visitors is triggered each time you connect to the gallery and works as follows:
<br><br>
- Automatic deletion of accounts not validated in the allotted time without sending automatic email reminder -> &quot;Deadline for registration validation limited&quot; <b><u>enabled</u></b> and &quot;Remind unvalidated users&quot; <b><u>disabled</u></b>.
<br><br>
- Automatically sending a reminder message with a new generation of validation key and automatic deletion of accounts not validated in the time after sending the reminder -> &quot;Deadline for registration validation limited&quot; <b><u>enabled</u></b> et &quot;Remind unvalidated users&quot; <b><u>enabled</u></b>.';
/*TODO*/$lang['UAM_USRAutoDelTitle'] = 'Custom message on deleted account';
/*TODO*/$lang['UAM_USRAutoMailTitle'] = 'Automated email reminder';
/*TODO*/$lang['UAM_USRAutoMailTitle_d'] = 'When activated, this function will automatically send personalized content in &quot;Reminder email with new key generated&quot; to visitors who match criteria.';
$lang['UAM_StuffsTitle'] = 'modulo PWG Stuffs';
/*TODO*/$lang['UAM_StuffsTitle_d'] = 'This enables an additional UAM block in PWG Stuffs plugin (if installed) to inform your visitors who did not validate their registration about their condition.
<br><br>
Please refer to the <b>Tips and Examples of Use</b> at the bottom of this page for details.';
// --------- End: New or revised $lang ---- from version 2.20.0


// --------- Starting below: New or revised $lang ---- from version 2.20.3
/*TODO*/$lang['UAM_DumpTitle'] = 'Backup your configuration';
/*TODO*/$lang['UAM_DumpTitle_d'] = 'This allows you to save the entire configuration of the plugin in a file so you can restore it if something goes wrong (wrong manipulation or before an update, for example). By default, the file is stored in this folder ../plugins/UserAdvManager/include/backup/ and is called &quot;UAM_dbbackup.sql&quot;.
<br><br>
<b style=&quot;color: red;&quot;>Warning: The file is overwritten each backup action!</b>
<br><br>
It can sometimes be useful to retrieve the backup file on your computer. For example: To restore to another database, to outsource or to keep multiple save files. To do this, just check the box to download the file.
<br><br>
The recovery from this interface is not supported. Use tools like phpMyAdmin.';
// --------- End: New or revised $lang ---- from version 2.20.3


// --------- Starting below: New or revised $lang ---- from version 2.20.4
$lang['UAM_HidePasswTitle'] = 'Password in chiaro nelle informazioni e-mail';
/*TODO*/$lang['UAM_HidePasswTitle_d'] = 'Choose here if you want to display the password chosen by the visitor in the information email. If you enable the option, the password will then appear in clear text. If you disable the password will not appear at all.';
// --------- End: New or revised $lang ---- from version 2.20.4


// --------- Starting below: New or revised $lang ---- from version 2.20.11
/*TODO*/$lang['UAM_gttextTitle_d'] = 'Enter the text you want to appear in the email reminder to prompt the user to return to visit your gallery (NB: The text pre-filled with the installation of the plugin is provided as an example).
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.<br>
- <b style=&quot;color: red;&quot;>[days]</b> to insert the maximum numbers of days between two visits.
<br><br>
Per utilizzare più lingue, è possibile utilizzare i tag del plugin Extended Description, se esso è attivo.';
$lang['UAM_confirmtxtTitle_d'] = 'Enter the introductory text that you want to appear in the email confirmation of registration.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.<br>
- <b style=&quot;color: red;&quot;>[Kdays]</b> to insert the number of days limit to validate a registration (&quot;Termine per la validazione dell\'iscrizione limitato;&quot; have to be enabled).
<br><br>
Per utilizzare più lingue, è possibile utilizzare i tag del plugin Extended Description, se esso è attivo.';
/* TODO */$lang['UAM_remailtxt1Title_d'] = 'Enter the introductory text that you want to appear in the reminder email, in addition to the validation key regenerated.
<br><br>
If left blank, the mail reminder will include only the validation link. It is therefore strongly advised to take a little explanatory text. (NB: The text pre-filled with the installation of the plugin is provided as an example).
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.<br>
- <b style=&quot;color: red;&quot;>[Kdays]</b> to insert the number of days limit to validate a registration (&quot;Termine per la validazione dell\'iscrizione limitato;&quot; have to be enabled).
<br><br>
Per utilizzare più lingue, è possibile utilizzare i tag del plugin Extended Description, se esso è attivo.';
/* TODO */$lang['UAM_remailtxt2Title_d'] = 'Enter the introductory text that you want to appear in the reminder email without a validation key regenerated.
<br><br>
If left blank, the mail reminder will be empty. It is therefore strongly advised to take a little explanatory text. (NB: The text pre-filled with the installation of the plugin is provided as an example).
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.<br>
- <b style=&quot;color: red;&quot;>[Kdays]</b> to insert the number of days limit to validate a registration (&quot;Termine per la validazione dell\'iscrizione limitato;&quot; have to be enabled).
<br><br>
Per utilizzare più lingue, è possibile utilizzare i tag del plugin Extended Description, se esso è attivo.';
/*TODO*/$lang['UAM_infotxtTitle_d'] = 'Inserisci il testo introduttivo che si desidera visualizzare nella e-mail informazioni.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
Per utilizzare più lingue, è possibile utilizzare i tag del plugin Extended Description, se esso è attivo.';
/* TODO */$lang['UAM_AdminValidationMail_d'] = 'When an administrator or Webmaster of the gallery manually valid registration pending, a notification email is automatically sent to the user. Enter here the text that appears in this email.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
Per utilizzare più lingue, è possibile utilizzare i tag del plugin Extended Description, se esso è attivo.';
/*TODO*/$lang['UAM_confirmmail_custom1_d'] = 'When the option &quot;Confirmation of registration&quot; is active, this field allows you to customize the <b><u>acceptance text</u></b> on the registration confirmation page displayed when user clicks the confirmation link that was received by email.
<br><br>
After installing the plugin, a standard text is set as an example.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
This field is compatible with the FCK Editor and, for multi-languages, you can use the tags [lang] of the plugin Extended description if it\'s active.';
/*TODO*/$lang['UAM_confirmmail_custom2_d'] = 'When the option &quot;Confirmation of registration&quot; is active, this field allows you to customize the <b><u>rejectance text</u></b> on the registration confirmation page displayed when user clicks the confirmation link that was received by email.
<br><br>
After installing the plugin, a standard text is set as an example.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
This field is compatible with the FCK Editor and, for multi-languages, you can use the tags [lang] of the plugin Extended description if it\'s active.';
/* TODO */$lang['UAM_GTAutoDelTitle_d'] = 'This is only valid when the user whose account has expired itself triggers the deletion mechanism (rare but possible). he\'s then disconnected of the gallery and redirected to a page showing the deletion of his account and, possibly, the reasons for this deletion.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.<br>
<b style=&quot;color: red;&quot;>[username]</b> is not available here because concerned user has been deleted.
<br><br>
Custom text for the redirect page can be entered in this field that is compatible with the FCK Editor and, for multi-languages, you can use the tags [lang] of the plugin Extended description if it\'s active.';
/* TODO */$lang['UAM_GTAutoMailTitle_d'] = 'When an account is expired (group / status change demoting the visitor), an email information can be sent to clarify the reasons for this change and the means to recover the initial access to the gallery.
<br>To do this, a link to revalidation of registration is attached to the email (automatic generation of a new validation key).<b style=&quot;color: red;&quot;>If the user has already been notified, his account is automatically destroyed.</b> 
<br><br>
Enter the custom text that also explain the reasons for the demotion, to accompany the validation link. The custom text is not mandatory but strongly recommended. In fact, your visitors will not appreciate receiving an email containing only a single link without further explanation. ;-)
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[username]</b> to automatically insert the name of the destination user of the email.<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
To use multiple languages, you can use the Extended description plugin\'s tags if it is active.
<br><br>
<b style=&quot;color: red;&quot;>Warning: The use of this function is intimately associated with the confirmation of registration by the user (confirmation by mail) and can not be activated without this option.</b>';
/* TODO */$lang['UAM_CustomPasswRetrTitle_d'] = 'By default, when a user has lost his password and selects the option of recovery, he receives an email containing only his username and his new password.
<br><br>
Here, you can add text of your choice to be inserted <b><u>before</u></b> the standard information.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.
<br><br>
To use multiple languages, you can use the Extended description plugin\'s tags if it is active.';
/*TODO*/$lang['UAM_USRAutoDelTitle_d'] = 'This is only valid when the user whose account has expired itself triggers the deletion mechanism (rare but possible). he\'s then disconnected of the gallery and redirected to a page showing the deletion of his account and, possibly, the reasons for this deletion.
<br><br>
Further customize the content with special inserted tags:<br>
- <b style=&quot;color: red;&quot;>[mygallery]</b> to insert the title of your gallery.<br>
- <b style=&quot;color: red;&quot;>[myurl]</b> to insert your gallery URL if set in Piwigo\'s configuration options.<br>
<b style=&quot;color: red;&quot;>[username]</b> is not available here because concerned user has been deleted.
<br><br>
Custom text for the redirect page can be entered in this field that is compatible with the FCK Editor and, for multi-languages, you can use the tags [lang] of the plugin Extended description if it\'s active.';
// --------- End: New or revised $lang ---- from version 2.20.11
?>