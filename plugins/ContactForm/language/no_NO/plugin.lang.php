<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
global $lang;

$lang['cf_plugin_name'] = 'Kontakt Skjema';
$lang['contact_form_debug'] = 'Vis testkjørings informasjon';

// ==================================================================
// Default values if not configured
$lang['contact_form_title'] = 'Kontakt skjema';
$lang['contact_form'] = 'Kontakt';
$lang['contact_form_link'] = 'Kontakt webmaster';

// ==================================================================
// Redirect page
$lang['contact_redirect_title'] = 'Send beskjed status';

// ==================================================================
// Menubar block
$lang['cf_from_name'] = 'Ditt navn';
$lang['cf_from_mail'] = 'Din e-mail';
$lang['cf_subject'] = 'Emne';
$lang['cf_message'] = 'Beskjed';
$lang['cf_submit'] = 'Send';
$lang['title_send_mail'] = 'En kommentar til siden';

// ==================================================================
// Messages
$lang['cf_from_name_error'] = 'Vennligst fyll inn navn';
$lang['cf_mail_format_error'] = $lang['reg_err_mail_address'];
$lang['cf_subject_error'] = 'Vennligst fyll inn emne';
$lang['cf_message_error'] = 'Vennligst fyll inn en beskjed';
$lang['cf_error_sending_mail'] = 'Feil ved sending av e-mail';
$lang['cf_sending_mail_successful'] = 'E-mail ble sendt';
$lang['cf_form_error'] = 'Invalide data';
$lang['cf_no_unlink'] = 'Funksjonen \'fjern link\' ikke tilgjengelig...';
$lang['cf_unlink_errors'] = 'En feil oppstod ved sletting av filer';
$lang['cf_config_saved'] = 'Konfigurasjon lagret';
$lang['cf_config_saved_with_errors'] = 'Konfigurasjon lagret med feil';
$lang['cf_length_not_integer'] = 'Størrelse må være en variabel';
$lang['cf_delay_not_integer'] = 'Forsinkelse må være en variabel';
$lang['cf_link_error'] = 'Variabler kan\kan ikke inneholde mellomrom';
$lang['cf_hide'] = 'Hide';

// ==================================================================
// Admin page
$lang['cf_validate'] = 'Lagre';
// Configuration tab
$lang['cf_tab_config'] = 'Konfigurasjon';
$lang['cf_config'] = 'Konfigurasjon';
$lang['cf_config_desc'] = 'Pluggin hoved konfigurasjon';
$lang['cf_label_config'] = 'Generell konfigurasjon';
$lang['cf_label_mail'] = 'E-mail konfigurasjon';
$lang['cf_menu_link'] = 'Legg til link i menyen';
$lang['cf_guest_allowed'] = 'La gjester se dette skjemaet';
$lang['cf_mail_prefix'] = 'Prefikset til den sendte e-mail´ens emne';
$lang['cf_separator'] = 'Karakterer brukt til å definere en mellomroms linje i e-mailen i tekst format';
$lang['cf_separator_length'] = 'Størrelse på mellomrommet';
$lang['cf_mandatory_name'] = 'Navn er påkrevd';
$lang['cf_mandatory_mail'] = 'E-mail addresse er påkrevd';
$lang['cf_redirect_delay'] = 'Sett forsinkelsen ved videresending på pause';
// Emails tab
$lang['cf_tab_emails'] = 'E-mailer';
$lang['cf_emails'] = 'E-mail';
$lang['cf_emails_desc'] = 'mål for e-mail behandling';
$lang['cf_active'] = 'Aktive e-mail';
$lang['cf_no_mail'] = 'INgen e-mail addresse tilgjengelig';
$lang['cf_refresh'] = 'Oppdater e-mail adresse liste';
?>
