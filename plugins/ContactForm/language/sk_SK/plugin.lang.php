<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
global $lang;

$lang['cf_plugin_name'] = 'Kontaktný formulár';
$lang['contact_form_debug'] = 'Zobrazenie opravených informácií';

// ==================================================================
// Default values if not configured
$lang['contact_form_title'] = 'Kontaktný formulár';
$lang['contact_form'] = 'Kontakt';
$lang['contact_form_link'] = 'Kontaktovanie webmastera';

// ==================================================================
// Redirect page
$lang['contact_redirect_title'] = 'Poslať stav správy';

// ==================================================================
// Menubar block
$lang['cf_from_name'] = 'Vaše meno';
$lang['cf_from_mail'] = 'Váš e-mail';
$lang['cf_subject'] = 'Predmet';
$lang['cf_message'] = 'Správa';
$lang['cf_submit'] = 'Poslať';
$lang['title_send_mail'] = 'Komentár na stránku';

// ==================================================================
// Messages
$lang['cf_from_name_error'] = 'Prosím zadajte meno';
$lang['cf_mail_format_error'] = $lang['mail address must be like xxx@yyy.eee (example : jack@altern.org)'];
$lang['cf_subject_error'] = 'Prosím zadajte predmet';
$lang['cf_message_error'] = 'Prosím zadajte správu';
$lang['cf_error_sending_mail'] = 'Chyba počas posielania e-mailu';
$lang['cf_sending_mail_successful'] = 'E-mail bol úspešne odoslaný';
$lang['cf_form_error'] = 'Neplatné údaje';
$lang['cf_no_unlink'] = 'Funkcia \'unlink\' nie je prístupná...';
$lang['cf_unlink_errors'] = 'Vyskytla sa chyba v priebehu mazania súboru';
$lang['cf_config_saved'] = 'Konfigurácia bola úspešne uložená';
$lang['cf_config_saved_with_errors'] = 'Konfigurácia uložená s chybami';
$lang['cf_length_not_integer'] = 'Veľkosť musí byť celé číslo';
$lang['cf_delay_not_integer'] = 'Odklad musí byť celé číslo';
$lang['cf_link_error'] = 'Parameter nesmie obsahovať medzeru';
$lang['cf_hide'] = 'Schovať';

// ==================================================================
// Admin page
$lang['cf_validate'] = 'Doručiť';
// Configuration tab
$lang['cf_tab_config'] = 'Konfigurácia';
$lang['cf_config'] = 'Konfigurácia';
$lang['cf_config_desc'] = 'Konfigurácia pluginu';
$lang['cf_label_config'] = 'Hlavná konfigurácia';
$lang['cf_label_mail'] = 'Konfigurácia e-mailu';
$lang['cf_menu_link'] = 'Pridať link do menu';
$lang['cf_guest_allowed'] = 'Povoliť hosťom vidieť formulár';
$lang['cf_mail_prefix'] = 'Predpona predmetu poslaného e-mailu';
$lang['cf_separator'] = 'Znak(y) použité na definovanie oddelenia stĺpca v maili v textovom formáte';
$lang['cf_separator_length'] = 'Veľkosť stĺpca';
$lang['cf_mandatory_name'] = 'Meno je povinné';
$lang['cf_mandatory_mail'] = 'E-mailová adresa je povinná';
$lang['cf_redirect_delay'] = 'Dĺžka pauzy pri presmerovaní';
// Emails tab
$lang['cf_tab_emails'] = 'E-maily';
$lang['cf_emails'] = 'E-maily';
$lang['cf_emails_desc'] = 'Cieľový manažment e-mailov';
$lang['cf_active'] = 'Actívny e-mail';
$lang['cf_no_mail'] = 'E-mailová adresa nie je dostupná';
$lang['cf_refresh'] = 'Obnoviť zoznam e-mailých adries';
?>
