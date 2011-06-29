<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
global $lang;

$lang['cf_plugin_name'] = 'Contact Form';
$lang['contact_form_debug'] = 'Fijación de las informaciones de debug';

// ==================================================================
// Default values if not configured
$lang['contact_form_title'] = 'Formulario de contacto';
$lang['contact_form'] = 'Contactar';
$lang['contact_form_link'] = 'Contactar webmestre';

// ==================================================================
// Redirect page
$lang['contact_redirect_title'] = 'Estatuto del envío del mensaje';

// ==================================================================
// Menubar block
$lang['cf_from_name'] = 'Su nombre';
$lang['cf_from_mail'] = 'Su e-mail';
$lang['cf_subject'] = 'Sujeto';
$lang['cf_message'] = 'Mensaje';
$lang['cf_submit'] = 'Enviar';

// ==================================================================
// Messages
$lang['cf_from_name_error'] = 'Por favor, entre un nombre';
$lang['cf_mail_format_error'] = $lang['mail address must be like xxx@yyy.eee (example : jack@altern.org)'];
$lang['cf_subject_error'] = 'Por favor, entre un sujeto';
$lang['cf_message_error'] = 'Por favor, entre un mensaje';
$lang['cf_error_sending_mail'] = 'Error en el momento del envío del e-mail';
$lang['cf_sending_mail_successful'] = 'E-mail enviado con éxito';
$lang['cf_form_error'] = 'Datos incorrectos';
$lang['cf_no_unlink'] = 'La función \'unlink \' no está disponible';
$lang['cf_unlink_errors'] = 'Errores se efectuaron en el momento de la supresión de ficheros';
$lang['cf_config_saved'] = 'Configuración salvada con éxito';
$lang['cf_config_saved_with_errors'] = 'Configuración salvada pero con errores';
$lang['cf_length_not_integer'] = 'La talla debe ser un entero';
$lang['cf_delay_not_integer'] = 'El plazo debe ser un entero';
$lang['cf_link_error'] = 'La variable no puede contener de espacios';
$lang['cf_hide'] = 'Enmascarar';

// ==================================================================
// Admin page
$lang['cf_validate'] = 'Validar';
// Configuration tab
$lang['cf_tab_config'] = 'Configuración';
$lang['cf_config'] = 'Configuración';
$lang['cf_config_desc'] = 'Configuración principal del plugin';
$lang['cf_label_config'] = 'Configuración general';
$lang['cf_label_mail'] = 'Configuración del e-mail';
$lang['cf_menu_link'] = 'Añadir el lazo en el menú';
$lang['cf_guest_allowed'] = 'Autorizar a los invitados a tener el formulario';
$lang['cf_mail_prefix'] = 'Prefijo del sujeto del e-mail enviado';
$lang['cf_separator'] = 'Carácter utilizado para definir una barra de separación en el e-mail al tamaño texto';
$lang['cf_separator_length'] = 'Talla de la barra de separación';
$lang['cf_mandatory_name'] = 'Presencia del nombre obligatorio';
$lang['cf_mandatory_mail'] = 'Presencia del e-mail obligatorio';
$lang['cf_redirect_delay'] = 'Plazo de pausa del redirection';
// Emails tab
$lang['cf_tab_emails'] = 'E-mail';
$lang['cf_emails'] = 'E-mail';
$lang['cf_emails_desc'] = 'Gestión de los e-mails de destino';
$lang['cf_active'] = 'E-mail activo';
$lang['cf_no_mail'] = 'Ningún correo electrónico disponible';
$lang['cf_refresh'] = 'Regenerar la lista de las direcciones';
?>
