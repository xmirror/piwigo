<?php

global $lang,$conf;

$conf_UAM = unserialize($conf['UserAdvManager']);


/* UserManager Tab */
$lang['UAM_Registration_Date'] = 'Data d\'iscrizione';


/* Mailing */
$lang['UAM_infos_mail %s'] = '%s, di seguito i vostri dati per accedere alla galleria :';
$lang['UAM_User: %s'] = 'Utente : %s';
$lang['UAM_Password: %s'] = 'Password : %s';
$lang['UAM_Link: %s'] = 'Cliccare su questo link per confermare la vostra iscrizzione : %s';


/* Email confirmation page */
$lang['UAM_title_confirm_mail'] = 'Conferma della vostra iscrizzione';
$lang['UAM_confirm_mail_page_title'] = 'Conferma l\'iscrizzione';


/* Errors and Warnings */
$lang['UAM_audit_ok'] = 'Audit OK';
$lang['UAM_Err_audit_username_char'] = '<b>Questo conto utente utilizza uno o più caratteri vietati :</b> ';
$lang['UAM_Err_audit_email_forbidden'] = '<b>Questo conto utente usa un dominio d\'Email proibito :</b> ';
$lang['UAM_Err_audit_advise'] = '<b>Dovete eseguire delle correzioni per rispettare le nuove impostazzioni che avete attivato.<br> Utilizzare un programma per la gestione della base dati per correggere i conti utente direttamente nella tabella ###_USERS';
$lang['UAM_reg_err_login2'] = 'Il nome utente non deve contenere i caratteri seguenti : ';
$lang['UAM_reg_err_login5'] = 'Il tuo provider di posta usa dominio d\'email proibito. I domini preibiti sono i seguenti : ';
$lang['UAM_empty_pwd'] = '[password vuota]';
$lang['UAM_no_update_pwd'] = '[profilo aggiornato senza modifica della password]';
$lang['UAM_No_validation_for_Guest'] = 'Il conto "Guest" non è soggetto a convalida';
$lang['UAM_No_validation_for_default_user'] = 'Il conto di default non è soggetto a convalida';
$lang['UAM_No_validation_for_Webmaster'] = 'Il conto del "Webmaster" non è soggetto a convalida';
$lang['UAM_No_validation_for_your_account'] = 'Il vostro conto amminstratore non è soggetto a convalida';


/* Processing messages */
$lang['UAM_%d_Mail_With_Key'] = '%d messaggio con il rinnovo della chiave è stato inviato';
$lang['UAM_%d_Mails_With_Key'] = '%d messaggi con il rinnovo della chiave sono stati inviati';
$lang['UAM_%d_Reminder_Sent'] = '%d email di rilancio è stata inviata';
$lang['UAM_%d_Reminders_Sent'] = '%d email di rilancio sono state inviate';
$lang['UAM_%d_Validated_User'] = '%d utente convalidato manualmente';
$lang['UAM_%d_Validated_Users'] = '%d utenti convalidati manualmente';


/* Action button names */
$lang['UAM_Delete_selected'] = 'Cancellare';
$lang['UAM_Mail_without_key'] = 'Email di rilancio senza chiave';
$lang['UAM_Mail_with_key'] = 'Email di rilancio con chiave';




// --------- Starting below: New or revised $lang ---- from version 2.12.0 and 2.12.1
/* Global Configuration Tab */
$lang['UAM_PasswordTest'] = 'Calcolo del punteggio';
/* Ghost Tracker Tab */
$lang['UAM_Tab_GhostTracker'] = 'GhostTracker';
$lang['UAM_Reminder'] = 'Email di rilancio';
$lang['UAM_Reminder_Sent_OK'] = 'SÌ';
$lang['UAM_Reminder_Sent_NOK'] = 'NO';
/* Errors and Warnings */
$lang['UAM_save_config'] ='Configurazione salvata';
$lang['UAM_reg_err_login3'] = 'Sicurezza : La password è obbligatoria!';
$lang['UAM_reg_err_login4_%s'] = 'Sicurezza : un sistema di controllo calcola un punteggio basandosi sulla complessità della password scelta. La complessità della password è troppo bassa (punteggio = %s). Si prega di scegliere una nuova password più sicura seguendo queste regole : <br>
- Utilizzare delle lettere e dei numeri<br>
- Usare delle maiuscole e delle minuscole<br>
- Aumentare la lunghezza (numero di caratteri)<br>
Il punteggio minimo richiesto dall\'amministratore per la password è di : ';
$lang['UAM_No_reminder_for_Guest'] = 'Il conto utente "Guest" non è soggetto a ricevere dei promemoria dal GhostTracker';
$lang['UAM_No_reminder_for_default_user'] = 'Il conto utente di default non è soggetto a ricevere dei promemoria dal GhostTracker';
$lang['UAM_No_reminder_for_Webmaster'] = 'Il conto utente "Webmaster" non è soggetto a ricevere dei promemoria dal GhostTracker';
$lang['UAM_No_reminder_for_your_account'] = 'Il vostro conto amministratore non è soggetto a ricevere dei promemoria dal GhostTracker';
/* Action button names */
$lang['UAM_audit'] = 'Audit delle impostazioni';
$lang['UAM_submit'] = 'Salvare le impostazioni';
// --------- End: New or revised $lang ---- from version 2.12.0 and 2.12.1


// --------- Starting below: New or revised $lang ---- from version 2.12.2
/* Errors and Warnings */
$lang['UAM_GhostTracker_Init_OK'] = 'Inizzializzazione GhostTracker eseguita!';
/* Action button names */
$lang['UAM_GT_Reset'] = 'Reset del GhostTracker';
// --------- End: New or revised $lang ---- from version 2.12.2


// --------- Starting below: New or revised $lang ---- from version 2.12.8
/* Errors and Warnings */
$lang['UAM_mail_exclusionlist_error'] = 'Attenzione! Avete inserito una nuova riga all\'inizio dell\'elenco d\'esclusione email (indicato in rosso qui sotto). Anche se questa nuova riga non è visibile, la sua presenza potrebbe causare delle disfunzioni del plugin. Si prega di cancellare la riga vuota';
// --------- End: New or revised $lang ---- from version 2.12.8


// --------- Starting below: New or revised $lang ---- from version 2.13.0
/* UserList Tab */
$lang['UAM_UserList_Title'] = 'Monitoraggio degli utenti registrati';
$lang['UAM_Tab_UserList'] = 'Monitoraggio degli utenti';
// --------- End: New or revised $lang ---- from version 2.13.0


// --------- Starting below: New or revised $lang ---- from version 2.13.4
/* Global Configuration Tab */
$lang['UAM_Title_Tab'] = 'UserAdvManager - Versione : ';
$lang['UAM_SubTitle1'] = 'Configurazione del plugin';
$lang['UAM_Tab_Global'] = 'Configurazione';
$lang['UAM_Title1'] = 'Impostare le restrizioni per le registrazioni';
$lang['UAM_Title2'] = 'Impostare le conferme e validazioni per l\'iscrizione';
$lang['UAM_Title3'] = 'Impostare le registrazioni seguite e altre opzioni';
$lang['UAM_Title4'] = 'Suggerimenti ed esempi d\'utilizzo';
$lang['UAM_No_Casse'] = 'Nome utente : Sensibile alle maiusc/minusc';
$lang['UAM_Username_Char'] = 'Nome utente : Esclusione di certi caratteri';
$lang['UAM_Username_Char_true'] = ' Vietare i caratteri : <br>(usare una virgola per separare ogni carattere)<br><br>';
$lang['UAM_Username_Char_false'] = ' Autorizzare tutti (di default)';
$lang['UAM_Password_Enforced'] = 'Rafforzare il livello di sicurezza delle password';
$lang['UAM_Password_Enforced_true'] = ' Attivare. Punteggio minimo : ';
$lang['UAM_AdminPassword_Enforced'] = 'Applicare agli amministratori';
$lang['UAM_PasswordTest'] = 'Password di prova : ';
$lang['UAM_ScoreTest'] = 'Risultato : ';
$lang['UAM_MailExclusion'] = 'Esclusione dei domini d\'email';
$lang['UAM_MailExclusion_true'] = ' Escludi i seguenti domini : <br>(utilizzare una virgola per separare ogni dominio)';

$lang['UAM_Mail_Info'] = 'Email d\'informazione per l\'utente :';
$lang['UAM_MailInfo_Text'] = ' Personalizzare il testo dell\'email :';
$lang['UAM_Confirm_Mail'] = 'Conferma dell\'iscrizione :';
$lang['UAM_ConfirmMail_Text'] = ' Personalizzare il testo dell\'email di conferma :';
$lang['UAM_Confirm_Group'] = 'Gruppi di convalida<br>(------- per non assegnare nessun gruppo)';
$lang['UAM_Confirm_Status'] = 'Convalida Statuti<br>(invia ------- per mantenere il valore di default di Piwigo)';
$lang['UAM_Confirm_grpstat_notice'] = 'ATTENZIONE : Si consiglia di utilizzare o il gruppo o lo statuto di convalida ma non entrambi simultaneamente';
$lang['UAM_No_Confirm_Group'] = 'Gruppo per gli utenti che non hanno convalidato la loro iscrizione<br>';
$lang['UAM_Validated_Group'] = 'Gruppo per gli utenti che hanno convalidato la loro iscrizione<br>';
$lang['UAM_No_Confirm_Status'] = 'Stato per gli utenti che non hanno convalidato la loro iscrizione<br>';
$lang['UAM_Validated_Status'] = 'Stato per gli utenti che hanno convalidato la loro iscrizione<br>';
$lang['UAM_ValidationLimit_Info'] = 'Termine per la validazione dell\'iscrizione limitato';
$lang['UAM_ConfirmMail_TimeOut_true'] = ' Attivare. Numero di giorni per la scadenza : ';
$lang['UAM_ConfirmMail_Remail'] = 'Email di rilancio ai visitatori non convalidati';
$lang['UAM_ConfirmMail_ReMail_Txt1'] = 'Personalizzare l\'email di rilancio <b><u>con</u></b> rigenerazione di una nuova chiave di convalida';
$lang['UAM_ConfirmMail_ReMail_Txt2'] = 'Personalizzare l\'email di rilancio <b><u>senza</u></b> rigenerazione di una nuova chiave di convalida';

$lang['UAM_GhostTracker'] = 'Gestione dei visitatori fantasmi (GhostTracker)';
$lang['UAM_GhostTracker_true'] = ' Attivare. Durata massima di giorni tra due visite : ';
$lang['UAM_GhostTracker_ReminderText'] = 'Testo di rilancio personalizzato';
$lang['UAM_LastVisit'] = ' Tracciamento utenti registrati';

$lang['UAM_Tab_UserManager'] = 'Tracciamento convalide';

/* UserManager Tab */
$lang['UAM_SubTitle3'] = 'Tracciamento convalide';
$lang['UAM_UserManager_Title'] = 'Tracciamento convalide';
/* Ghost Tracker Tab */
$lang['UAM_SubTitle4'] = 'GhostTracker';
$lang['UAM_GT_Init'] = 'Inizializzazione del GhostTracker';
$lang['UAM_GhostTracker_Title'] = 'Gestione degli visitatori fantasmi';
$lang['UAM_GhostTracker_Init'] = 'Se si attiva questa funzione per la prima volta o se viene riattivata dopo un lungo periodo durante il quale dei nuovi visitatori si sono registrati, è necessario inizializzare o azzerare il Tracker Ghost. Questa azione è da effettuarsi solo dopo l\'attivazione o la riattivazione dell\'opzione; Cliccare dunque <u>una sola volta</u> sull\'pulsante di reset sottostante';
/* UserList Tab */
$lang['UAM_SubTitle5'] = 'Informazioni sugli utenti';
/* Mailing */
$lang['UAM_Add of %s'] = 'Profilo creato per %s';
$lang['UAM_Update of %s'] = 'Profilo %s aggiornato';
/* Mailing */
$lang['UAM_Ghost_reminder_of_%s'] = '%s, questa è un\'email di rilancio';
$lang['UAM_Reminder_with_key_of_%s'] = '%s, la vostra chiave di convalida è scaduta';
$lang['UAM_Reminder_without_key_of_%s'] = '%s, la chiave di convalida sta per scadere';
/* Errors and Warnings */
$lang['UAM_Err_GhostTracker_Settings'] = 'Questa pagina è disponibile solo se "GhostTracker" è attivo in "Impostare le registrazioni seguite e altre opzioni"';
$lang['UAM_Err_Userlist_Settings'] = 'Questa pagina è disponibile solo se "Monitoraggio degli utenti registrati" è attivo nella sezione "Impostare le registrazioni seguite e altre opzioni"';
// --------- End: New or revised $lang ---- from version 2.13.4


// --------- Starting below: New or revised $lang ---- from version 2.14.0
$lang['UAM_AdminConfMail'] = 'Conferma dell\'iscrizione per gli amministratori';
// --------- End: New or revised $lang ---- from version 2.14.0


// --------- Starting below: New or revised $lang ---- from version 2.15.0
$lang['UAM_confirmmail_custom_Txt1'] = 'Testo della pagina di conferma - Conferma accettata';
$lang['UAM_confirmmail_custom_Txt2'] = 'Testo della pagina di conferma - Conferma respinta';
$lang['UAM_LastVisit_Date'] = 'Ultima visita';
$lang['UAM_Nb_Days'] = 'Differenza in giorni';
$lang['UAM_Err_UserManager_Settings'] = 'Questa pagina è disponibile solo se "Conferma dell\'iscrizione" è attiva e se un gruppo di visitatori non convalidato è configurato in "Impostare le conferme e validazioni all\'iscrizione"';
// --------- End: New or revised $lang ---- from version 2.15.0


// --------- Starting below: New or revised $lang ---- from version 2.15.1
$lang['UAM_Support_txt'] = 'Il supporto ufficiale per questo plugin viene effettuato esclusivamente sul forum EN di Piwigo :<br>
<a href="http://piwigo.org/forum/viewtopic.php?id=15015" onclick="window.open(this.href);return false;">Forum inglese - http://piwigo.org/forum/viewtopic.php?id=15015</a>
<br><br>
Disponibile anche, il bugtracker del progetto : <a href="http://piwigo.org/bugs/" onclick="window.open(this.href);return false;">http://piwigo.org/bugs/</a>';
// --------- End: New or revised $lang ---- from version 2.15.1


// --------- Starting below: New or revised $lang ---- from version 2.15.4
$lang['UAM_Force_Validation'] = 'Validazione manuale';
$lang['UAM_Confirm_Mail_true'] = ' Attivare - Validazione dal utente';
$lang['UAM_Confirm_Mail_local'] = ' Attivare - Validazione dal amministratore (nessuna chiave di validazione inviata)';
$lang['UAM_RedirToProfile'] = 'Ridirezione verso la pagina di personalizzazione';
// --------- End: New or revised $lang ---- from version 2.15.4


// --------- Starting below: New or revised $lang ---- from version 2.16.0
$lang['UAM_Expired_Group'] = '<b>Gruppo</b> per gli utenti per i quali la registrazione sara scaduta<br>';
$lang['UAM_Expired_Status'] = '<b>Statuto</b> per gli utenti per i quali la registrazione sara scaduta<br>';
$lang['UAM_GTAuto'] = 'Gestione automatica degli utenti fantasmi';
$lang['UAM_GTAutoDel'] = 'Cancellazione automatica dei conti';
$lang['UAM_GTAutoGp'] = 'Cambiamento automatico del gruppo / statuto';
$lang['UAM_GTAutoMail'] = 'Emailing di rilancio automatico per cambiamento gruppo / statuto';
$lang['UAM_Deleted_Account_Redirection_Page'] = 'Accesso negato - Account cancellato!';
$lang['UAM_title_redir_page'] = 'Accesso negato per causa di account cancellato!';
$lang['UAM_Error_GTAutoMail_cannot_be_set_without_ConfirmMail'] = 'Errore di coerenza nella configurazione prescelta :
<br><br>
"Parametraggio monitoraggio degli iscritti e altre opzioni > Gestione degli utenti fantasmi (Ghost Tracker) > Gestione automatica degli utenti fantasmi > Email automatica su cambiamento di gruppo / statuto" non può essere attivato se "Parametraggio delle conferme e validazione d\'iscrizione > Conferma d\'iscrizione - Conferma dal utente" non è stata perattivata
<br><br>
Per garantire la coerenza, l\'opzione "Email automatica su cambiamento del gruppo / statuto" è stata automaticamente riposizionata a "disattivato"
<br><br>';
$lang['UAM_Demotion of %s'] = 'Retrocessione di %s';
$lang['UAM_AdminValidationMail_Text'] = 'Notifica della validazione d\'iscrizione manuale';
$lang['UAM_Validation of %s'] = 'Validazione di %s';
// --------- End: New or revised $lang ---- from version 2.16.0


// --------- Starting below: New or revised $lang ---- from version 2.20.0
$lang['UAM_CustomPasswRetr'] = 'Personalizzare il contenuto della email per password persa';
/*TODO*/$lang['UAM_USRAuto'] = 'Automatic management of unvalidated users';
/*TODO*/$lang['UAM_USRAutoDel'] = 'Custom message on deleted account';
/*TODO*/$lang['UAM_USRAutoMail'] = 'Automated email reminder';
$lang['UAM_Disable'] = ' Disattivare (di default)';
$lang['UAM_Enable'] = ' Attivare ';
/*TODO*/$lang['UAM_Tips1'] = 'Information of non-validated registration with UAM and PWG_Stuffs';
/*TODO*/$lang['UAM_Tips1_txt'] = '
          <ul>
            <li>
            Goals: Inform the visitor that the registration is awaiting approval by displaying a personal block on the home page of the gallery, and this, as registration is not approved.<br><br>
            <b>Nota : Nel funzionamento standard, l\'utente "Guest" vede solo le categorie pubbliche, senza messaggio d\'informazione.</b>
            </li><br><br>
            <li>
Prerequisiti :<br>
- Una galleria con tutte o alcune categorie private, visibili solo agli utenti registrati<br>
- Almeno i 2 gruppi d\'utenti Piwigo seguenti : "Attesa", senza alcuna autorizzazione sulle categorie private, e "Convalidati" con tutte le autorizzazioni per le categorie private<br>
- Il plugin NBC_UAM<br>
- Il plugin PWG Stuffs, per l\'aggiunta di un modulo speciale UAM<br>
- In opzione, il plugin Extended Description per il supporto multi-lingue<br>
            </li><br><br>
            <li>
Tappe :<br><br>
A. Nel plugin NBC_UAM :
              <ol>
                <li>Attivare la conferma dell\'iscrizione</li>
                <li>Attivare modulo PWG Stuffs</li>
                <li>Inserire un testo personalizzato che sarà inviato con l\'Email di conferma dell\'iscrizione. Se il plugin Extended Description è installato ed attivato, i tag di lingua possono essere utilizzati</li>
                <li>Selezionare il gruppo "Attesa" sotto la voce "Per gli utenti che non hanno convalidato la loro iscrizione"</li>
                <li>Selezionare il gruppo "Convalidati" sotto la voce "Per gli utenti che hanno convalidato la loro iscrizione"</li>
                <li>Salvare le impostazzioni</li>
              </ol>
<br>
B. Nel plugin PWG Stuffs :
              <ol>
                <li>Vai alla scheda "Aggiungere un nuovo modulo"</li>
                <li>Scegliere "UAM Module"</li>
                <li>Configurare il modulo, indicandone il titolo (ad esempio, "in attesa di convalida dell\'iscrizione"), la descrizione, ed in fine selezionando solo il gruppo "Attesa" nell\'elenco dei gruppi ammessi</li>
                <li>Completare il contenuto del modulo con il testo da visualizzare per gli utenti non convalidati. Come NBC_UAM, i tag di lingua possono essere utilizzati se il plugin Extended Description è installato ed attivato</li>
                <li>Selezzionare "Visualizzare il modulo nella homepage del sito"</li>
                <li>Salvare le impostazzioni</li>
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
Prerequisiti :<br>
- Una galleria con tutte o alcune categorie private, visibili solo agli utenti registrati<br>
- Almeno i 2 gruppi d\'utenti Piwigo seguenti : "Attesa", senza alcuna autorizzazione sulle categorie private, e "Convalidati" con tutte le autorizzazioni per le categorie private<br>
- Il plugin NBC_UAM<br>
- Additional Pages plugin for adding and managing an additional page to replace the default index page of the gallery<br>
- In opzione, il plugin Extended Description per il supporto multi-lingue<br>
            </li><br><br>
            <li>
Tappe :<br><br>
A. Nel plugin NBC_UAM :
              <ol>
                <li>Attivare la conferma dell\'iscrizione</li>
                <li>Inserire un testo personalizzato che sarà inviato con l\'Email di conferma dell\'iscrizione. Se il plugin Extended Description è installato ed attivato, i tag di lingua possono essere utilizzati</li>
                <li>Selezionare il gruppo "Attesa" sotto la voce "Per gli utenti che non hanno convalidato la loro iscrizione"</li>
                <li>Selezionare il gruppo "Convalidati" sotto la voce "Per gli utenti che hanno convalidato la loro iscrizione"</li>
                <li>Salvare le impostazzioni</li>
              </ol>
<br>
B. Nel plugin Additional Pages :<br>
                <b>NOTE : The management of access rights for groups on Additional Pages must be turned on (see plugin configuration settings).</b>
                <br>
              <ol>
                <li>Add a new page with at least the following parameters :</li>
                <ul>
                  <li>Page name : The name you wish to give to the additional page (ie: Registration not validated)</li>
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
$lang['UAM_Stuffs_Title'] = 'Modulo UAM';
/*TODO*/$lang['UAM_Stuffs_Desc'] = 'Adds an information block for unvalidated users';
$lang['UAM_Stuffs'] = 'modulo PWG Stuffs';
// --------- End: New or revised $lang ---- from version 2.20.0


// --------- Starting below: New or revised $lang ---- from version 2.20.3
/*TODO*/$lang['UAM_DumpTxt'] = 'Backup your configuration';
/*TODO*/$lang['UAM_Dump_Download'] = 'To download the backup file, please check this box:';
/*TODO*/$lang['UAM_Save'] = 'Run backup';
/*TODO*/$lang['UAM_Dump_OK'] = 'Backup file created successfully';
/*TODO*/$lang['UAM_Dump_NOK'] = 'Error: Unable to create backup file !';
// --------- End: New or revised $lang ---- from version 2.20.3


// --------- Starting below: New or revised $lang ---- from version 2.20.4
$lang['UAM_HidePassw'] = 'Password in chiaro nelle email d\'informazione';
// --------- End: New or revised $lang ---- from version 2.20.4


// --------- Starting below: New or revised $lang ---- from version 2.20.11
/*TODO*/$lang['UAM_Error_Using_illegal_flag'] = 'Syntax error ! The [Kdays] AutoText flag is used as the "Termine per la validazione dell\'iscrizione limitato" option was not activated. Please activate the option or correct the text field(s) colored in red.';
// --------- End: New or revised $lang ---- from version 2.20.11
?>