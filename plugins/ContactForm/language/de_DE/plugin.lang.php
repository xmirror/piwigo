<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
global $lang;

$lang['cf_plugin_name'] = 'Kontaktformular';
$lang['contact_form_debug'] = 'Anzeige von Debug-Informationen';

// ==================================================================
// Default values if not configured
$lang['contact_form_title'] = 'Kontaktformular';
$lang['contact_form'] = 'Kontaktieren';
$lang['contact_form_link'] = 'Den Webmaster kontaktieren';

// ==================================================================
// Redirect page
$lang['contact_redirect_title'] = 'Status der Nachricht';

// ==================================================================
// Menubar block
$lang['cf_from_name'] = 'Ihr Name';
$lang['cf_from_mail'] = 'Ihre E-Mail';
$lang['cf_subject'] = 'Betreff';
$lang['cf_message'] = 'Mitteilung';
$lang['cf_submit'] = 'senden';

// ==================================================================
// Messages
$lang['cf_from_name_error'] = 'Bitte fügen Sie Ihren Namen ein';
$lang['cf_mail_format_error'] = $lang['mail address must be like xxx@yyy.eee (example : jack@altern.org)'];
$lang['cf_subject_error'] = 'Bitte fügen Sie den Betreff ein';
$lang['cf_message_error'] = 'Bitte fügen Sie eine Mitteilung hinzu';
$lang['cf_error_sending_mail'] = 'Es ist ein Fehler beim Versand der E-Mail aufgetreten'; 
$lang['cf_sending_mail_successful'] = 'Die E-Mail wurde erfolgreich versendet';
$lang['cf_form_error'] = 'Ungültige Daten'; 
$lang['cf_no_unlink'] = 'Die Funktion \'unlink\' ist nicht verfügbar...';
$lang['cf_unlink_errors'] = 'Es ist ein Fehler während der Löschung der Datei entstanden';
$lang['cf_config_saved'] = 'Die Konfiguration wurde erfolgreich gespeichert werden';
$lang['cf_config_saved_with_errors'] = 'Die Konfiguration wurde mit Fehlern gespeichert';
$lang['cf_length_not_integer'] = 'Die Grössen müssen Integer zahlen sein';
$lang['cf_delay_not_integer'] = 'Die Verzögerung muss eine Integer zahl sein';
$lang['cf_link_error'] = 'Die Variabel darf keine Lehrzeichen enthalten';
$lang['cf_hide'] = 'Verstecken';

// ==================================================================
// Admin page
$lang['cf_validate'] = 'Einstellung speichern';
// Configuration tab
$lang['cf_tab_config'] = 'Konfiguration';
$lang['cf_config'] = 'Konfiguration';
$lang['cf_config_desc'] = 'Hauptkonfiguration des Plug-in\'s';
$lang['cf_label_config'] = 'Algemeine Konfiguration';
$lang['cf_label_mail'] = 'E-mail Konfiguration';
$lang['cf_menu_link'] = 'Füge einen Link im Menü hinzu';
$lang['cf_guest_allowed'] = 'Erlaube den Gästen die Benutzung des Kontaktformulars';
$lang['cf_mail_prefix'] = 'Präfix des Betreffs der gesendeten E-Mail';
$lang['cf_separator'] = 'Benutzter Charakter, welcher eine Trennleiste in der E-Mail im Textformat definiert';
$lang['cf_separator_length'] = 'Grösse der Trennleiste';
$lang['cf_mandatory_name'] = 'Der Name ist obligatorisch';
$lang['cf_mandatory_mail'] = 'Die E-Mail ist obligatorisch';
$lang['cf_redirect_delay'] = 'Wartezeit bis zur Weiterleitung (s) ';
// Emails tab
$lang['cf_tab_emails'] = 'E-Mails';
$lang['cf_emails'] = 'E-Mails';
$lang['cf_emails_desc'] = 'Verwaltung des E-Mail Bestimmungsortes';
$lang['cf_active'] = 'Aktive E-Mail';
$lang['cf_no_mail'] = 'Keine E-Mail Adresse verfügbar';
$lang['cf_refresh'] = 'Regeneriere die E-Mail Adressenliste';
?>
