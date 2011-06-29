<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
global $lang;

$lang['cf_plugin_name'] = 'Formularz kontaktu';
$lang['contact_form_debug'] = 'Wyświetl informacje śledzące proces';

// ==================================================================
// Default values if not configured
$lang['contact_form_title'] = 'Formularz kontaktu';
$lang['contact_form'] = 'Kontakt';
$lang['contact_form_link'] = 'Kontakt do webmastera';

// ==================================================================
// Redirect page
$lang['contact_redirect_title'] = 'Wyślij status wiadomości';

// ==================================================================
// Menubar block
$lang['cf_from_name'] = 'Twoje nazwisko';
$lang['cf_from_mail'] = 'Twój e-mail';
$lang['cf_subject'] = 'Temat';
$lang['cf_message'] = 'Wiadomość';
$lang['cf_submit'] = 'Wyślij';

// ==================================================================
// Messages
$lang['cf_from_name_error'] = 'Proszę podać nazwisko';
$lang['cf_mail_format_error'] = $lang['mail address must be like xxx@yyy.eee (example : jack@altern.org)'];
$lang['cf_subject_error'] = 'Proszę podać temat';
$lang['cf_message_error'] = 'Proszę wpisać wiadomość';
$lang['cf_error_sending_mail'] = 'Błąd podczas wysyłania wiadomości';
$lang['cf_sending_mail_successful'] = 'Wiadomość wysłana poprawnie';
$lang['cf_form_error'] = 'Nieprawidłowe dane';
$lang['cf_no_unlink'] = 'Funkcja \'unlink\' niedostępna...';
$lang['cf_unlink_errors'] = 'Wystąpił błąd podczas kasowania pliku';
$lang['cf_config_saved'] = 'Konfiguracja zapisana poprawnie';
$lang['cf_config_saved_with_errors'] = 'Konfiguracja zapisana z błędami';
$lang['cf_length_not_integer'] = 'Rozmiar musi być liczbą';
$lang['cf_delay_not_integer'] = 'Opóźnienie musi być liczbą';
$lang['cf_link_error'] = 'Zmienna nie może zawierać spacji';
$lang['cf_hide'] = 'Ukryj';

// ==================================================================
// Admin page
$lang['cf_validate'] = 'Potwierdź';
// Configuration tab
$lang['cf_tab_config'] = 'Konfiguracja';
$lang['cf_config'] = 'Konfiguracja';
$lang['cf_config_desc'] = 'Konfiguracja podstawowa wtyczki';
$lang['cf_label_config'] = 'Konfiguracja ogólna';
$lang['cf_label_mail'] = 'Konfiguracja e-mail';
$lang['cf_menu_link'] = 'Dodaj link do menu';
$lang['cf_guest_allowed'] = 'Zezwalaj gościom na wysyłanie formularza';
$lang['cf_mail_prefix'] = 'Przedrostek tematu wysłanej wiadomości e-mail';
$lang['cf_separator'] = 'Znak separatora w formacie tekstowym wiadomości e-mail';
$lang['cf_separator_length'] = 'Wielkość menubar';
$lang['cf_mandatory_name'] = 'Nazwisko jest wymagane';
$lang['cf_mandatory_mail'] = 'Adres e-mail address is wymagany';
$lang['cf_redirect_delay'] = 'Wstrzymaj opóźnienie przekierowania';
// Emails tab
$lang['cf_tab_emails'] = 'Adresy';
$lang['cf_emails'] = 'Adresy';
$lang['cf_emails_desc'] = 'Zarządzanie adresami e-mail do kontaktu';
$lang['cf_active'] = 'Aktywny e-mail';
$lang['cf_no_mail'] = 'Brak dostępnych adresów e-mail';
$lang['cf_refresh'] = 'Ponowne tworzenie listy adresów e-mail';
// translated by emcek
?>
