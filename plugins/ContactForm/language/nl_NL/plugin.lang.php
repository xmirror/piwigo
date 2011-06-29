<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
global $lang;

$lang['cf_plugin_name'] = 'Contact Formulier';
$lang['contact_form_debug'] = 'Toon debug informatie';

// ==================================================================
// Default values if not configured
$lang['contact_form_title'] = 'Contact formulier';
$lang['contact_form'] = 'Contact';
$lang['contact_form_link'] = 'Contact webmaster';

// ==================================================================
// Redirect page
$lang['contact_redirect_title'] = 'Verzonden bericht status';

// ==================================================================
// Menubar block
$lang['cf_from_name'] = 'Je naam';
$lang['cf_from_mail'] = 'Je e-mail';
$lang['cf_subject'] = 'Onderwerp';
$lang['cf_message'] = 'Bericht';
$lang['cf_submit'] = 'Verstuur';
$lang['title_send_mail'] = 'Een commentaar op de site';

// ==================================================================
// Messages
$lang['cf_from_name_error'] = 'Vul een naam in';
$lang['cf_mail_format_error'] = $lang['mail address must be like xxx@yyy.eee (example : jack@altern.org)'];
$lang['cf_subject_error'] = 'Vul een onderwerp in';
$lang['cf_message_error'] = 'Vul een berichttekst in ';
$lang['cf_error_sending_mail'] = 'Fout tijdens versturen van e-mail';
$lang['cf_sending_mail_successful'] = 'E-mail succesvol verzonden';
$lang['cf_form_error'] = 'Onjuiste gegevens';
$lang['cf_no_unlink'] = 'Functie \'unlink\' nie beschikbaar...';
$lang['cf_unlink_errors'] = 'Fout opgetreden tijdens verwijderen van bestand';
$lang['cf_config_saved'] = 'Configuratie successvol opgeslagen';
$lang['cf_config_saved_with_errors'] = 'Configuratie opgeslagen met fouten';
$lang['cf_length_not_integer'] = 'grootte moet een geheel getal zijn';
$lang['cf_delay_not_integer'] = 'Vertraging moet een geheel getal zijn';
$lang['cf_link_error'] = 'Variabele kan geen spaties bevatten';
$lang['cf_hide'] = 'Verberg';

// ==================================================================
// Admin page
$lang['cf_validate'] = 'Verzenden';
// Configuration tab
$lang['cf_tab_config'] = 'Configuratie';
$lang['cf_config'] = 'Configuratie';
$lang['cf_config_desc'] = 'Plugin hoofd configuratie';
$lang['cf_label_config'] = 'Algemene configuratie';
$lang['cf_label_mail'] = 'E-mail configuratie';
$lang['cf_menu_link'] = 'Voeg link aan menu toe';
$lang['cf_guest_allowed'] = 'Sta gasten toe om het formulier te zien';
$lang['cf_mail_prefix'] = 'Voorvoegsel van het email onderwerp';
$lang['cf_separator'] = 'Teken(s) gebruikt voor de scheidingsbalk in de e-mail, in tekst formaat';
$lang['cf_separator_length'] = 'Grote van de balk';
$lang['cf_mandatory_name'] = 'Naam is verplicht';
$lang['cf_mandatory_mail'] = 'E-mail adres is verplicht';
$lang['cf_redirect_delay'] = 'wachttijd voor opnieuw versturen';
// Emails tab
$lang['cf_tab_emails'] = 'E-mails';
$lang['cf_emails'] = 'E-mails';
$lang['cf_emails_desc'] = 'Bestemming van e-mail beheer';
$lang['cf_active'] = 'Actieve e-mail';
$lang['cf_no_mail'] = 'Geen e-mail adres beschikbaar';
$lang['cf_refresh'] = 'Regenereer e-mail lijst adres';
?>
