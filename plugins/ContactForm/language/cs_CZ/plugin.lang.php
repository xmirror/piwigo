<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
global $lang;

$lang['cf_plugin_name'] = 'Kontaktní formulář';
$lang['contact_form_debug'] = 'Zobrazí případně chyby k odladění';

// ==================================================================
// Default values if not configured
$lang['contact_form_title'] = 'Kontaktní formulář';
$lang['contact_form'] = 'Kontakt';
$lang['contact_form_link'] = 'Kontakt správce webu';

// ==================================================================
// Redirect page
$lang['contact_redirect_title'] = 'Stav odesílané zprávy';

// ==================================================================
// Menubar block
$lang['cf_from_name'] = 'Vaše jméno';
$lang['cf_from_mail'] = 'Váš e-mail';
$lang['cf_subject'] = 'Předmět';
$lang['cf_message'] = 'Zpráva';
$lang['cf_submit'] = 'Odeslat';
$lang['title_send_mail'] = 'Komentář na webu';

// ==================================================================
// Messages
$lang['cf_from_name_error'] = 'Prosím zadejte Vaše jméno';
$lang['cf_mail_format_error'] = $lang['mail address must be like xxx@yyy.eee (example : jack@altern.org)'];
$lang['cf_subject_error'] = 'Prosím zadejte předmět zprávy';
$lang['cf_message_error'] = 'Prosím zadejte zprávu';
$lang['cf_error_sending_mail'] = 'Nastala chyba při odeslání zprávy';
$lang['cf_sending_mail_successful'] = 'E-mail odeslán';
$lang['cf_form_error'] = 'Nesprávná data';
$lang['cf_no_unlink'] = 'Funkce \'unlink\' není k dispozici...';
$lang['cf_unlink_errors'] = 'Chyba nastala při mazání souboru';
$lang['cf_config_saved'] = 'Konfigurace uložena';
$lang['cf_config_saved_with_errors'] = 'Konfigurace uložena s chybami';
$lang['cf_length_not_integer'] = 'Velikost musí být celé číslo';
$lang['cf_delay_not_integer'] = 'Zpoždění musí být celé číslo';
$lang['cf_link_error'] = 'Proměnná ne\může obsahovat mezery';
$lang['cf_hide'] = 'Skrýt';

// ==================================================================
// Admin page
$lang['cf_validate'] = 'Potvrdit';
// Configuration tab
$lang['cf_tab_config'] = 'Konfigurace';
$lang['cf_config'] = 'Konfigurace';
$lang['cf_config_desc'] = 'Hlavní konfigurace pluginu';
$lang['cf_label_config'] = 'Hlavní konfigurace';
$lang['cf_label_mail'] = 'E-mail konfigurace';
$lang['cf_menu_link'] = 'Vložit odkaz do menu';
$lang['cf_guest_allowed'] = 'Povol návštěvníkům vidět formulář';
$lang['cf_mail_prefix'] = 'Prefix pro předmět zpráv';
$lang['cf_separator'] = 'Znak(y) sloužící k definování oddělení polí v e-mailu v textovém formátu';
$lang['cf_separator_length'] = 'Velikost pole';
$lang['cf_mandatory_name'] = 'Jméno je povinné';
$lang['cf_mandatory_mail'] = 'E-mail addresa je povinná';
$lang['cf_redirect_delay'] = 'Zpoždění přesměrování';
// Emails tab
$lang['cf_tab_emails'] = 'E-maily';
$lang['cf_emails'] = 'E-maily';
$lang['cf_emails_desc'] = 'Řízení cílové destinace e-mailů ';
$lang['cf_active'] = 'Aktivuj e-mail';
$lang['cf_no_mail'] = 'Žádná mail adresa k dispozici';
$lang['cf_refresh'] = 'Regenerate e-mail list address';
?>
