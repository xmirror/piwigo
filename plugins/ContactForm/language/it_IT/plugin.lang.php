<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
global $lang;

$lang['cf_plugin_name'] = 'Contact Form';
$lang['contact_form_debug'] = 'Visualizzare le informazioni di debug';

// ==================================================================
// Default values if not configured
$lang['contact_form_title'] = 'Formulario di contatto';
$lang['contact_form'] = 'Contattare';
$lang['contact_form_link'] = 'Contattare il webmaster';

// ==================================================================
// Redirect page
$lang['contact_redirect_title'] = 'Stato d\'invio messaggio';

// ==================================================================
// Menubar block
$lang['cf_from_name'] = 'Il vostro nome';
$lang['cf_from_mail'] = 'La vostra E-mail';
$lang['cf_subject'] = 'Soggetto';
$lang['cf_message'] = 'Messaggio';
$lang['cf_submit'] = 'Inviare';

// ==================================================================
// Messages
$lang['cf_from_name_error'] = 'Entrare un nome';
$lang['cf_mail_format_error'] = $lang['mail address must be like xxx@yyy.eee (example : jack@altern.org)'];
$lang['cf_subject_error'] = 'Entrare un soggetto';
$lang['cf_message_error'] = 'Entrare un messaggio';
$lang['cf_error_sending_mail'] = 'Errore durante l\'invio dell\'E-mail'; 
$lang['cf_sending_mail_successful'] = 'Invio dell\'E-mail riuscito';
$lang['cf_form_error'] = 'Dati errati'; 
$lang['cf_no_unlink'] = 'La funzione \'unlink\' non è disponibile';
$lang['cf_unlink_errors'] = 'Errori durante la sopressione dei file';
$lang['cf_config_saved'] = 'Configurazione salvata con successo';
$lang['cf_config_saved_with_errors'] = 'Configurazione salvata con errori';
$lang['cf_length_not_integer'] = 'Le dimensioni devono essere un numero intero';
$lang['cf_delay_not_integer'] = 'Il limite deve essere un numero intero';
$lang['cf_link_error'] = 'La variabile non può contenere degli spazi';
$lang['cf_hide'] = 'Nascondere';

// ==================================================================
// Admin page
$lang['cf_validate'] = 'Confermare';
// Configuration tab
$lang['cf_tab_config'] = 'Configurazione';
$lang['cf_config'] = 'Configurazione';
$lang['cf_config_desc'] = 'Configurazione principale del plugin';
$lang['cf_label_config'] = 'Configurazione generale';
$lang['cf_label_mail'] = 'Configurazione dell\'E-mail';
$lang['cf_menu_link'] = 'Aggiungere un link nel menu';
$lang['cf_guest_allowed'] = 'Autorizzare gli ospiti ad accedere al formulario';
$lang['cf_mail_prefix'] = 'Prefisso dell\'E-mail inviata';
$lang['cf_separator'] = 'Carattere(i) usato(i) per definire una barra di separazione nella E-mail al formato testo';
$lang['cf_separator_length'] = 'Dimenzioni della barra di separazione';
$lang['cf_mandatory_name'] = 'Nome obbligatorio';
$lang['cf_mandatory_mail'] = 'E-mail obbligatoria';
$lang['cf_redirect_delay'] = 'Limite d\'attesa ';
// Emails tab
$lang['cf_tab_emails'] = 'E-mails';
$lang['cf_emails'] = 'E-mails';
$lang['cf_emails_desc'] = 'Gestione delle e-mail di destinazione';
$lang['cf_active'] = 'E-mail attiva';
$lang['cf_no_mail'] = 'Nessun\'indirizzo e-mail disponibile';
$lang['cf_refresh'] = 'Rigenerare la lista degli indirizzi';
?>
