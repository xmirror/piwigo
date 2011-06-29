<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
global $lang;

$lang['cf_plugin_name'] = 'İletişim Formu';
$lang['contact_form_debug'] = 'Debug bilgisini gör';

// ==================================================================
// Default values if not configured
$lang['contact_form_title'] = 'İletişim formu';
$lang['contact_form'] = 'İletişim';
$lang['contact_form_link'] = 'İletişim Site yöneticisi';

// ==================================================================
// Redirect page
$lang['contact_redirect_title'] = 'Mesajın durumunu gönder';

// ==================================================================
// Menü bloğu
$lang['cf_from_name'] = 'İsminiz';
$lang['cf_from_mail'] = 'E-posta adresiniz';
$lang['cf_subject'] = 'Konu';
$lang['cf_message'] = 'Mesaj';
$lang['cf_submit'] = 'Gönder';
$lang['title_send_mail'] = '';

// ==================================================================
// Mesajlar
$lang['cf_from_name_error'] = 'Lütfen isminizi girin';
$lang['cf_mail_format_error'] = $lang['e-posta şöyle olmalıdır xxx@yyy.eee (örnek : jack@altern.org)'];
$lang['cf_subject_error'] = 'Lütfen konuyu girin';
$lang['cf_message_error'] = 'Lütfen mesajınızı girin';
$lang['cf_error_sending_mail'] = 'Mesajın gönderilmesinde sorun oluştu';
$lang['cf_sending_mail_successful'] = 'Mesajınız başarılı bir şekilde gönderildi.';
$lang['cf_form_error'] = 'Geçersiz bilgi';
$lang['cf_no_unlink'] = 'Fonksiyon \'unlink\' ulaşılamaz...';
$lang['cf_unlink_errors'] = 'Dosyada hata oluştu';
$lang['cf_config_saved'] = 'Değişiklikler başarılı ile kaydedildi.';
$lang['cf_config_saved_with_errors'] = 'Değişikler hatalar ile kaydedildi';
$lang['cf_length_not_integer'] = 'Boyut değeri tam sayı olmalı';
$lang['cf_delay_not_integer'] = 'Geçikme değeri tam sayı olmalı';
$lang['cf_link_error'] = 'Değişkenler boşluk içeremez';
$lang['cf_hide'] = 'Gizle';

// ==================================================================
// Yönetici Sayfası
$lang['cf_validate'] = 'Gönder';
// Ayarlar  bölümü
$lang['cf_tab_config'] = 'Ayarlar';
$lang['cf_config'] = 'Ayarlar';
$lang['cf_config_desc'] = 'Eklenti ayarları';
$lang['cf_label_config'] = 'Genel ayarlar';
$lang['cf_label_mail'] = 'E-posta ayarları';
$lang['cf_menu_link'] = 'Menüye link ekle';
$lang['cf_guest_allowed'] = 'Ziyaretciler formu görebilir';
$lang['cf_mail_prefix'] = 'Gelen postaya eklenecek ön ek';
$lang['cf_separator'] = 'Character(s) used to define a separation bar in the e-mail in text format';
$lang['cf_separator_length'] = 'Mesaj alanın genişliği';
$lang['cf_mandatory_name'] = 'Zorunlu isim';
$lang['cf_mandatory_mail'] = 'E-postanın zorunluluğu';
$lang['cf_redirect_delay'] = 'Geribildirimde geçikme süresi';
$lang['cf_label_link'] = 'Link yönetimi (dışardan menü)';
$lang['cf_define_link'] = 'Adresi belirt';
$lang['cf_link'] = 'Name of the template variable containing the HTML link to the contact form';
// E-posta  bölümü
$lang['cf_tab_emails'] = 'E-postalar';
$lang['cf_emails'] = 'E-postalar';
$lang['cf_emails_desc'] = 'Hedef e-posta yönetimi';
$lang['cf_active'] = 'Etkin e-posta';
$lang['cf_no_mail'] = 'Mevcut e-posta adresi yok';
$lang['cf_refresh'] = 'E-posta listesini tekrar oluştur';
?>
