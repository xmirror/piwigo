<?php
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');
global $lang;

$lang['cf_plugin_name'] = 'Contact Form';
$lang['contact_form_debug'] = 'Affichage des informations de debug';

// ==================================================================
// Default values if not configured
$lang['contact_form_title'] = 'Formulaire de contact';
$lang['contact_form'] = 'Formulaire de contact';
$lang['contact_form_link'] = 'Contacter le webmestre';

// ==================================================================
// Redirect page
$lang['contact_redirect_title'] = 'Statut de l\'envoi du message';

// ==================================================================
// Menubar block
$lang['cf_from_name'] = 'Votre nom';
$lang['cf_from_mail'] = 'Votre e-mail';
$lang['cf_subject'] = 'Sujet';
$lang['cf_message'] = 'Message';
$lang['cf_submit'] = 'Envoyer';
$lang['title_send_mail'] = 'Un commentaire sur le site';

// ==================================================================
// Messages
$lang['cf_from_name_error'] = 'Veuillez entrer un nom';
$lang['cf_mail_format_error'] = $lang['mail address must be like xxx@yyy.eee (example : jack@altern.org)'];
$lang['cf_subject_error'] = 'Veuillez entrer un sujet';
$lang['cf_message_error'] = 'Veuillez entrer un message';
$lang['cf_error_sending_mail'] = 'Erreur lors de l\'envoi de l\'e-mail';
$lang['cf_sending_mail_successful'] = 'E-mail envoyé avec succès';
$lang['cf_form_error'] = 'Données incorrectes';
$lang['cf_no_unlink'] = 'La fonction \'unlink\' n\'est pas disponible';
$lang['cf_unlink_errors'] = 'Des erreurs ont eu lieu lors de la suppression de fichiers';
$lang['cf_config_saved'] = 'Configuration sauvée avec succès';
$lang['cf_config_saved_with_errors'] = 'Configuration sauvée mais avec des erreurs';
$lang['cf_length_not_integer'] = 'La taille doit être un entier';
$lang['cf_delay_not_integer'] = 'Le délai doit être un entier';
$lang['cf_link_error'] = 'La variable ne peut pas contenir d\'espaces';
$lang['cf_hide'] = 'Masquer';

// ==================================================================
// Admin page
$lang['cf_validate'] = 'Valider';
// Configuration tab
$lang['cf_tab_config'] = 'Configuration';
$lang['cf_config'] = 'Configuration';
$lang['cf_config_desc'] = 'Configuration principale du plugin';
$lang['cf_label_config'] = 'Configuration générale';
$lang['cf_label_mail'] = 'Configuration de l\'e-mail';
$lang['cf_menu_link'] = 'Ajouter le lien dans le menu';
$lang['cf_guest_allowed'] = 'Autoriser les invités à avoir le formulaire';
$lang['cf_mail_prefix'] = 'Préfixe du sujet de l\'e-mail envoyé';
$lang['cf_separator'] = 'Caractère(s) utilisé(s) pour définir une barre de séparation dans l\'e-mail au format texte';
$lang['cf_separator_length'] = 'Taille de la barre de séparation';
$lang['cf_mandatory_name'] = 'Présence du nom obligatoire';
$lang['cf_mandatory_mail'] = 'Présence de l\'e-mail obligatoire';
$lang['cf_redirect_delay'] = 'Délai de pause de la redirection';
// Emails tab
$lang['cf_tab_emails'] = 'E-mails';
$lang['cf_emails'] = 'E-mails';
$lang['cf_emails_desc'] = 'Gestion des e-mails de destination';
$lang['cf_active'] = 'E-mail actif';
$lang['cf_no_mail'] = 'Aucune adresse e-mail disponible';
$lang['cf_refresh'] = 'Regénérer la liste des adresses';
?>
