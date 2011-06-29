<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
global $lang;

$lang['cf_plugin_name'] = 'Kontaktforma';
$lang['contact_form_debug'] = 'Atkļūdošanas informācijas attējojumsn';

// ==================================================================
// Vērtības pēc noklusējuma, ja nav veiktas izmaiņas
$lang['contact_form_title'] = 'Kontaktforma';
$lang['contact_form'] = 'Kontaktēt';
$lang['contact_form_link'] = 'Kontaktēt ar webmāsteru';

// ==================================================================
// Pāradresē lapu
$lang['contact_redirect_title'] = 'Sūta pziņojuma statusu';

// ==================================================================
// Izvēlnes bloks
$lang['cf_from_name'] = 'Jūsu vārds';
$lang['cf_from_mail'] = 'Jūsu e-pasts';
$lang['cf_subject'] = 'Temats';
$lang['cf_message'] = 'Ziņojums';
$lang['cf_submit'] = 'Sūtīt';
$lang['title_send_mail'] = 'Komentārs web lapā';

// ==================================================================
// Messages
$lang['cf_from_name_error'] = 'Lūdzu ievadiet vārdu';
$lang['cf_mail_format_error'] = $lang['mail address must be like xxx@yyy.eee (example : jack@altern.org)'];
$lang['cf_subject_error'] = 'Lūdzu ievadiet tematu';
$lang['cf_message_error'] = 'Lūdzu ievadiet ziņojumu';
$lang['cf_error_sending_mail'] = 'Kļūda sūtot e-pastu';
$lang['cf_sending_mail_successful'] = 'E-pasts nosūtīts veiksmīgi';
$lang['cf_form_error'] = 'Kļūdaini dati';
$lang['cf_no_unlink'] = 'Funkcija \'unlink\' nav pieejama...';
$lang['cf_unlink_errors'] = 'Kļūda dzēšot failu';
$lang['cf_config_saved'] = 'Konfigurācija veiksmīgi saglabāta';
$lang['cf_config_saved_with_errors'] = 'Konfigurācija saglabāta ar kļūdām';
$lang['cf_length_not_integer'] = 'Izmēram jābūt veselam skaitlim (integer)';
$lang['cf_delay_not_integer'] = 'Kavējuma laikam jābūt veselam skaitlim';
$lang['cf_link_error'] = 'Mainīgais nedrīkst saturēt tukšumus (spaces)';
$lang['cf_hide'] = 'Paslēpt';

// ==================================================================
// Admin page
$lang['cf_validate'] = 'Apstiprināt';
// Konfigurācijas iezīme (tab)
$lang['cf_tab_config'] = 'Konfigurācija';
$lang['cf_config'] = 'Konfigurācija';
$lang['cf_config_desc'] = 'Spraudnis (plugin) galvenā konfigurācija';
$lang['cf_label_config'] = 'Vispārējā konfigurācija';
$lang['cf_label_mail'] = 'E-pasta konfigurācija';
$lang['cf_menu_link'] = 'Pievienot saiti izvēlnē';
$lang['cf_guest_allowed'] = 'Atļaut viesiem redzēt formu';
$lang['cf_mail_prefix'] = 'Aizsūtītā e-pasta tēmas prefikss';
$lang['cf_separator'] = 'Simbols(i), kas lietoti, lai definētu  atdalītājjoslu e-pastā teksta formā';
$lang['cf_separator_length'] = 'Joslas izmērs';
$lang['cf_mandatory_name'] = 'Vārds ir obligāts';
$lang['cf_mandatory_mail'] = 'E-pasta adrese ir obligāta';
$lang['cf_redirect_delay'] = 'Pāradresācijas kavējuma laiks';
// Epasta iezīme (tab)
$lang['cf_tab_emails'] = 'E-pasti';
$lang['cf_emails'] = 'E-pasti';
$lang['cf_emails_desc'] = 'e-pastu galamērķu pārvaldība';
$lang['cf_active'] = 'Aktīvs e-pasts';
$lang['cf_no_mail'] = 'Nav pieejama e-pasta adrese';
$lang['cf_refresh'] = 'Atjaunot e-pasta saraksta adresi';
?>
