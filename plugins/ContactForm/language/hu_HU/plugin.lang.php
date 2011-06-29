<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
global $lang;

$lang['cf_plugin_name'] = 'Kapcsolati űrlap';
$lang['contact_form_debug'] = 'Hibakeresési adatok megjelenítése';

// ==================================================================
// Default values if not configured
$lang['contact_form_title'] = 'Kapcsolati űrlap';
$lang['contact_form'] = 'Kapcsolat';
$lang['contact_form_link'] = 'Webmester kapcsolat';

// ==================================================================
// Redirect page
$lang['contact_redirect_title'] = 'Üzenet küldés állapot';

// ==================================================================
// Menubar block
$lang['cf_from_name'] = 'Neved';
$lang['cf_from_mail'] = 'E-mail címed';
$lang['cf_subject'] = 'Tárgy';
$lang['cf_message'] = 'Üzeneted';
$lang['cf_submit'] = 'Küldés';
$lang['title_send_mail'] = 'Üzenet az oldalról';

// ==================================================================
// Messages
$lang['cf_from_name_error'] = 'Írj be egy nevet';
$lang['cf_mail_format_error'] = $lang['mail address must be like xxx@yyy.eee (example : jack@altern.org)'];
$lang['cf_subject_error'] = 'Írd be a levél tárgyát';
$lang['cf_message_error'] = 'Írd be az üzeneted';
$lang['cf_error_sending_mail'] = 'Hiba történt a levél küldése közben';
$lang['cf_sending_mail_successful'] = 'A levelet sikeresen elküldtük';
$lang['cf_form_error'] = 'Érvénytelen adat';
$lang['cf_no_unlink'] = 'Csatolás megszűntetése \'unlink\' lehetőség nem elérhető...';
$lang['cf_unlink_errors'] = 'Hiba történt a fájl törlésekor';
$lang['cf_config_saved'] = 'A beállítások mentése sikeres';
$lang['cf_config_saved_with_errors'] = 'Hiba történt a beállítások mentésekor';
$lang['cf_length_not_integer'] = 'A méretnek egész számnak kell lennie';
$lang['cf_delay_not_integer'] = 'Az időnek egész számnak kell lennie';
$lang['cf_link_error'] = 'A változó nem tartalmazhat szóközt';
$lang['cf_hide'] = 'Vissza';

// ==================================================================
// Admin page
$lang['cf_validate'] = 'Küldés';
// Configuration tab
$lang['cf_tab_config'] = 'Beállítások';
$lang['cf_config'] = 'Beállítások';
$lang['cf_config_desc'] = 'Bővítmény alap konfigurációja';
$lang['cf_label_config'] = 'Általános beállítások';
$lang['cf_label_mail'] = 'E-mail beállítások';
$lang['cf_menu_link'] = 'Kapcsolat elem hozzáadása a menühöz';
$lang['cf_guest_allowed'] = 'Vendégek is használhatják az űrlapot ';
$lang['cf_mail_prefix'] = 'A levél tárgyának előtagja';
$lang['cf_separator'] = 'Szöveg formátumú e-mail esetén az elválasztó sávhoz használt karakter';
$lang['cf_separator_length'] = 'Elválasztó sáv hossza';
$lang['cf_mandatory_name'] = 'Név kötelező';
$lang['cf_mandatory_mail'] = 'E-mail cím kötelező';
$lang['cf_redirect_delay'] = 'Átirányítás késleltetésének ideje';
// Emails tab
$lang['cf_tab_emails'] = 'E-mail címek';
$lang['cf_emails'] = 'E-mail címek';
$lang['cf_emails_desc'] = 'Cél e-mail címek kezelése';
$lang['cf_active'] = 'Aktív e-mail';
$lang['cf_no_mail'] = 'Nincs e-mail cím';
$lang['cf_refresh'] = 'E-mail címlista frissítése';
?>
