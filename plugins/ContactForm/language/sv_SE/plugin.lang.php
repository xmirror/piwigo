<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
global $lang;

$lang['cf_plugin_name'] = 'Kontakt Formulär';
$lang['contact_form_debug'] = 'Visning av felsökningsinformation';

// ==================================================================
// Default values if not configured
$lang['contact_form_title'] = 'Kontakt formulär';
$lang['contact_form'] = 'Kontakt';
$lang['contact_form_link'] = 'Kontakta webmaster';

// ==================================================================
// Redirect page
$lang['contact_redirect_title'] = 'Skicka meddelande status';

// ==================================================================
// Menubar block
$lang['cf_from_name'] = 'Ditt Namn';
$lang['cf_from_mail'] = 'Din E-Post';
$lang['cf_subject'] = 'Ämne';
$lang['cf_message'] = 'Meddelande';
$lang['cf_submit'] = 'skicka';
$lang['title_send_mail'] = 'En kommentar på sajten';

// ==================================================================
// Messages
$lang['cf_from_name_error'] = 'Ange ett namn';
$lang['cf_mail_format_error'] = $lang['mail address must be like xxx@yyy.eee (example : jack@altern.org)'];
$lang['cf_subject_error'] = 'Ange ett ämnet';
$lang['cf_message_error'] = 'Skriv ett meddelande';
$lang['cf_error_sending_mail'] = 'Fel vid sändning av e-post';
$lang['cf_sending_mail_successful'] = 'E-post skickats';
$lang['cf_form_error'] = 'Ogiltiga data';
$lang['cf_no_unlink'] = 'Funktion \'unlink\' inte tillgänglig...';
$lang['cf_unlink_errors'] = 'Fel inträffade vid borttagning av filer';
$lang['cf_config_saved'] = 'Konfiguration sparats';
$lang['cf_config_saved_with_errors'] = 'Konfiguration sparats med fel!';
$lang['cf_length_not_integer'] = 'Storleken måste vara ett heltal';
$lang['cf_delay_not_integer'] = 'Fördröjningen måste vara ett heltal';
$lang['cf_link_error'] = 'Variabel kan inte  innehålla mellanslag';
$lang['cf_hide'] = 'Gömma';

// ==================================================================
// Admin page
$lang['cf_validate'] = 'Skicka';
// Configuration tab
$lang['cf_tab_config'] = 'Konfiguration';
$lang['cf_config'] = 'Konfiguration';
$lang['cf_config_desc'] = 'Allmänna konfiguration för plugg-in';
$lang['cf_label_config'] = 'Allmän konfiguration';
$lang['cf_label_mail'] = 'E-post konfiguration';
$lang['cf_menu_link'] = 'Lägg länken i menyn';
$lang['cf_guest_allowed'] = 'Tillåt gäster att komma till formuläret';
$lang['cf_mail_prefix'] = 'Prefix av skickade e-postmeddelandet';
$lang['cf_separator'] = 'Tecken (er) som används för att definiera en separation bar i e-post i textformat';
$lang['cf_separator_length'] = 'Storlek på "baren"';
$lang['cf_mandatory_name'] = 'Namn är obligatorisk';
$lang['cf_mandatory_mail'] = 'E-postadressen är obligatorisk';
$lang['cf_redirect_delay'] = 'Fördröjning av omdirigering';
// Emails tab
$lang['cf_tab_emails'] = 'E-post';
$lang['cf_emails'] = 'E-post';
$lang['cf_emails_desc'] = 'Destination e-post hantering';
$lang['cf_active'] = 'Aktiv e-post';
$lang['cf_no_mail'] = 'Ingen e-postadress tillgänglig';
$lang['cf_refresh'] = 'generera ny e-post lista';
?>
