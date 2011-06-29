<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
global $lang;

$lang['cf_plugin_name'] = 'نموذج الاتصال';
$lang['contact_form_debug'] = 'عرض تصحيح المعلومات';

// ==================================================================
// Default values if not configured
$lang['contact_form_title'] = 'نموذج الاتصال';
$lang['contact_form'] = 'اتصل بنا';
$lang['contact_form_link'] = 'اتصل بمدير الموقع';

// ==================================================================
// Redirect page
$lang['contact_redirect_title'] = 'ارسل رسالة حالة';

// ==================================================================
// Menubar block
$lang['cf_from_name'] = 'اسمك';
$lang['cf_from_mail'] = 'بريدك الالكتروني';
$lang['cf_subject'] = 'العنوان';
$lang['cf_message'] = 'الرسالة';
$lang['cf_submit'] = 'ارسل';
$lang['title_send_mail'] = 'تعليق على الموقع';

// ==================================================================
// Messages
$lang['cf_from_name_error'] = 'من فضلك ادخل الاسم';
$lang['cf_mail_format_error'] = $lang['mail address must be like xxx@yyy.eee (example : jack@altern.org)'];
$lang['cf_subject_error'] = 'من فضلك ادخل العنوان';
$lang['cf_message_error'] = 'من فضلك ادخل رسالة';
$lang['cf_error_sending_mail'] = 'حدث خطأ أثناء الارسال';
$lang['cf_sending_mail_successful'] = 'تم الارسال بنجاح';
$lang['cf_form_error'] = 'معلومات غير صحيحة';
$lang['cf_no_unlink'] = 'الوظيفة "unlink" غير متوفرة';
$lang['cf_unlink_errors'] = 'خطأ اثناء حذف الملف';
$lang['cf_config_saved'] = 'الاعدادات حفظت بنجاح';
$lang['cf_config_saved_with_errors'] = 'الاعدادات حفظت مع وجود أخطاء';
$lang['cf_length_not_integer'] = 'الحجم يجب ان يكون عدد صحيح';
$lang['cf_delay_not_integer'] = 'التأخير يجب ان يكون عدد صحيح';
$lang['cf_link_error'] = 'المتغير لايمكن ان يحوي مسافات';
$lang['cf_hide'] = 'اخفاء';

// ==================================================================
// Admin page
$lang['cf_validate'] = 'ادخل';
// Configuration tab
$lang['cf_tab_config'] = 'الاعدادات';
$lang['cf_config'] = 'الاعدادات';
$lang['cf_config_desc'] = 'الاعدادت الرئيسة للأداة';
$lang['cf_label_config'] = 'الاعدادات العامة';
$lang['cf_label_mail'] = 'اعدادات البريد الالكتروني';
$lang['cf_menu_link'] = 'اضف رابط في القائمة';
$lang['cf_guest_allowed'] = 'السماح للضيوف برؤية النموذج';
$lang['cf_mail_prefix'] = 'البداية المعرفة للبريد المرسل';
$lang['cf_separator'] = 'احرف التي تستخدم لتحديد شريط الفاصل في تنسيق نص البريد الإلكتروني';
$lang['cf_separator_length'] = 'حجم الشريط';
$lang['cf_mandatory_name'] = 'الاسم اجباري';
$lang['cf_mandatory_mail'] = 'البريد الالكتروني اجباري';
$lang['cf_redirect_delay'] = 'ايقاف مؤقت التأخير في التحويل';
// Emails tab
$lang['cf_tab_emails'] = 'البريد الالكتروني';
$lang['cf_emails'] = 'البريد الالكتروني';
$lang['cf_emails_desc'] = 'تنظيم البريد الالكتروني المستهدفة';
$lang['cf_active'] = 'البريد الالكتروني النشطة';
$lang['cf_no_mail'] = 'لايوجد عنوان بريد الكتروني متاح';
$lang['cf_refresh'] = 'اعادة توليد قوائم البريد الالكتروني';
?>
