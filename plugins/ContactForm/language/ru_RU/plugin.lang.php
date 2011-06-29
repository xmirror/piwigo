<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
global $lang;

$lang['cf_plugin_name'] = 'Контактная информация';
$lang['contact_form_debug'] = 'Показывать отладочные сообщения';

// ==================================================================
// Значения по умолчанию
$lang['contact_form_title'] = 'Контактная информация';
$lang['contact_form'] = 'Контакты';
$lang['contact_form_link'] = 'Contact webmaster';

// ==================================================================
// Страница переадресации
$lang['contact_redirect_title'] = 'Отсылать статус сообщения';

// ==================================================================
// Блок меню
$lang['cf_from_name'] = 'Имя';
$lang['cf_from_mail'] = 'e-mail';
$lang['cf_subject'] = 'Тема';
$lang['cf_message'] = 'Сообщение';
$lang['cf_submit'] = 'Отправить';
$lang['title_send_mail'] = 'Комментарий на странице';

// ==================================================================
// Сообщения
$lang['cf_from_name_error'] = 'Пожалуйста, введите имя';
$lang['cf_mail_format_error'] = $lang['mail address must be like xxx@yyy.eee (example : jack@altern.org)'];
$lang['cf_subject_error'] = 'Пожалуйста, укажите тему сообщения';
$lang['cf_message_error'] = 'Пожалуйста, введите сообщение';
$lang['cf_error_sending_mail'] = 'Ошибка при отправке сообщения';
$lang['cf_sending_mail_successful'] = 'Сообщение успешно отправлено';
$lang['cf_form_error'] = 'Ошибка при подготовке сообщения к отправке';
$lang['cf_no_unlink'] = 'Функция \'unlink\' недоступна...';
$lang['cf_unlink_errors'] = 'Ошибка при удалении файла';
$lang['cf_config_saved'] = 'Настройки успешно сохранены';
$lang['cf_config_saved_with_errors'] = 'Ошибка при сохранении настроек';
$lang['cf_length_not_integer'] = 'Размер должен быть указан как целое число';
$lang['cf_delay_not_integer'] = 'Задержка должна быть указана как целое число';
$lang['cf_link_error'] = 'Значение переменной не может содержать пробелов';
$lang['cf_hide'] = 'Скрыть';

// ==================================================================
// Страница администратора
$lang['cf_validate'] = 'Отправить';
// Вкладка "Настройки"
$lang['cf_tab_config'] = 'Настройки';
$lang['cf_config'] = 'Настройки';
$lang['cf_config_desc'] = 'Настройки модуля';
$lang['cf_label_config'] = 'Основные настройки';
$lang['cf_label_mail'] = 'Настройки e-mail';
$lang['cf_menu_link'] = 'Добавить ссылку в меню';
$lang['cf_guest_allowed'] = 'Показывать форму гостевым пользователям';
$lang['cf_mail_prefix'] = 'Префикс темы email';
$lang['cf_separator'] = 'Символ(ы)-разделители в письме текстового формата';
$lang['cf_separator_length'] = 'Ширина страницы';
$lang['cf_mandatory_name'] = 'Имя обязательно';
$lang['cf_mandatory_mail'] = 'Адрес email обязателен';
$lang['cf_redirect_delay'] = 'Время задержки при перенаправлении';
// Вкладка "E-mail"
$lang['cf_tab_emails'] = 'E-mail';
$lang['cf_emails'] = 'E-mail';
$lang['cf_emails_desc'] = 'Получатели e-mail';
$lang['cf_active'] = 'Активный адрес e-mail';
$lang['cf_no_mail'] = 'Нет доступных адресов e-mail';
$lang['cf_refresh'] = 'Сформировать список адресов e-mail снова';
?>
