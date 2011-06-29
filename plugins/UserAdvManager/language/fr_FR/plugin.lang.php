<?php

global $lang,$conf;

$conf_UAM = unserialize($conf['UserAdvManager']);


/* UserManager Tab */
$lang['UAM_Registration_Date'] = 'Date d\'enregistrement';


/* Mailing */
$lang['UAM_infos_mail %s'] = '%s, voici vos informations pour vous identifier sur la galerie :';
$lang['UAM_User: %s'] = 'Utilisateur : %s';
$lang['UAM_Password: %s'] = 'Mot de passe: %s';
$lang['UAM_Link: %s'] = 'Cliquez sur le lien suivant pour confirmer votre inscription : %s';


/* Email confirmation page */
$lang['UAM_title_confirm_mail'] = 'Confirmation de votre inscription';
$lang['UAM_confirm_mail_page_title'] = 'Confirmation d\'inscription';


/* Errors and Warnings */
$lang['UAM_audit_ok'] = 'Audit OK';
$lang['UAM_Err_audit_username_char'] = '<b>Ce compte contient un ou des caractères interdits :</b> ';
$lang['UAM_Err_audit_email_forbidden'] = '<b>Ce compte contient des domaines de messagerie interdit :</b> ';
$lang['UAM_Err_audit_advise'] = '<b>Vous avez des corrections a faire pour respecter les nouvelles règles que vous avez activées.<br>Utilisez un utilitaire de gestion de base de données pour corriger les comptes utilisateurs directement dans la table ###_USERS si nécessaire.</b><br><br>';
$lang['UAM_reg_err_login2'] = 'le nom utilisateur ne doit pas contenir les caractère suivants : ';
$lang['UAM_reg_err_login5'] = 'L\'adresse email est issue d\'un prestataire interdit. Les prestataires d\'adresses email interdits à l\'inscription sont : ';
$lang['UAM_empty_pwd'] = '[mot de passe vide]';
$lang['UAM_no_update_pwd'] = '[mise à jour du profil sans changement du mot de passe]';
$lang['UAM_No_validation_for_Guest'] = 'Le compte Guest n\'est pas soumis à validation';
$lang['UAM_No_validation_for_default_user'] = 'Le compte par défaut n\'est pas soumis à validation';
$lang['UAM_No_validation_for_Webmaster'] = 'Le compte du Webmaster n\'est pas soumis à validation';
$lang['UAM_No_validation_for_your_account'] = 'Votre compte d\'admin n\'est pas soumis à validation';


/* Processing messages */
$lang['UAM_%d_Mail_With_Key'] = '%d message avec renouvellement de clé a été envoyé';
$lang['UAM_%d_Mails_With_Key'] = '%d messages avec renouvellement de clé ont été envoyés';
$lang['UAM_%d_Reminder_Sent'] = '%d message de rappel a été envoyé';
$lang['UAM_%d_Reminders_Sent'] = '%d messages de rappel ont été envoyés';
$lang['UAM_%d_Validated_User'] = '%d Utilisateur validé manuellement';
$lang['UAM_%d_Validated_Users'] = '%d Utilisateurs validés manuellement';


/* Action button names */
$lang['UAM_Delete_selected'] = 'Supprimer';
$lang['UAM_Mail_without_key'] = 'Rappel sans clé';
$lang['UAM_Mail_with_key'] = 'Rappel avec clé';




// --------- Starting below: New or revised $lang ---- from version 2.12.0 and 2.12.1
/* Global Configuration Tab */
$lang['UAM_PasswordTest'] = 'Calcul du score';
/* Ghost Tracker Tab */
$lang['UAM_Tab_GhostTracker'] = 'Ghost Tracker';
$lang['UAM_Reminder'] = 'Email de rappel';
$lang['UAM_Reminder_Sent_OK'] = 'OUI';
$lang['UAM_Reminder_Sent_NOK'] = 'NON';
/* Errors and Warnings */
$lang['UAM_save_config'] ='Configuration enregistrée.';
$lang['UAM_reg_err_login3'] = 'Sécurité : Le mot de passe est obligatoire !';
$lang['UAM_reg_err_login4_%s'] = 'Sécurité : Un système de contrôle calcule un score de complexité sur les mots de passe choisis. La complexité de votre mot de passe est trop faible (score = %s). Veuillez choisir un nouveau mot de passe plus sûre en respectant les règles suivantes :<br>
- Utiliser des lettres et des chiffres<br>
- Utiliser des minuscules et des majuscules<br>
- Augmenter sa longueur (nombre de caractères)<br>
Le score minimal des mots de passe imposé par l\'administrateur est de : ';
$lang['UAM_No_reminder_for_Guest'] = 'Le compte Guest n\'est pas soumis à recevoir des rappels du GhostTracker';
$lang['UAM_No_reminder_for_default_user'] = 'Le compte par défaut n\'est pas soumis à recevoir des rappels du GhostTracker';
$lang['UAM_No_reminder_for_Webmaster'] = 'Le compte du Webmaster n\'est pas soumis à recevoir des rappels du GhostTracker';
$lang['UAM_No_reminder_for_your_account'] = 'Votre compte d\'admin n\'est pas soumis à recevoir des rappels du GhostTracker';
/* Action button names */
$lang['UAM_audit'] = 'Auditer les paramètres';
$lang['UAM_submit'] = 'Sauvegarder les paramètres';
// --------- End: New or revised $lang ---- from version 2.12.0 and 2.12.1


// --------- Starting below: New or revised $lang ---- from version 2.12.2
/* Errors and Warnings */
$lang['UAM_GhostTracker_Init_OK'] = 'Initialisation Ghost Tracker effectuée !';
/* Action button names */
$lang['UAM_GT_Reset'] = 'Initialisation Ghost Tracker';
// --------- End: New or revised $lang ---- from version 2.12.2


// --------- Starting below: New or revised $lang ---- from version 2.12.8
/* Errors and Warnings */
$lang['UAM_mail_exclusionlist_error'] = 'Attention ! Vous avez saisi un retour à la ligne en début de liste d\'exclusion des domaines de messagerie (affichée en rouge ci-dessous). Bien que ce retour à la ligne ne soit pas visible, il est tout de même présent et est susceptible de provoquer des dysfonctionnements du plugin. Veuillez resaisir votre liste d\'exclusion en veillant à ne pas commencer par un retour à la ligne.';
// --------- End: New or revised $lang ---- from version 2.12.8


// --------- Starting below: New or revised $lang ---- from version 2.13.0
/* UserList Tab */
$lang['UAM_UserList_Title'] = 'Suivi des utilisateurs inscrits';
$lang['UAM_Tab_UserList'] = 'Suivi des utilisateurs';
// --------- End: New or revised $lang ---- from version 2.13.0


// --------- Starting below: New or revised $lang ---- from version 2.13.4
/* Global Configuration Tab */
$lang['UAM_Title_Tab'] = 'UserAdvManager - Version: ';
$lang['UAM_SubTitle1'] = 'Configuration du plugin';
$lang['UAM_Tab_Global'] = 'Configuration';
$lang['UAM_Title1'] = 'Paramétrage des restrictions d\'inscriptions';
$lang['UAM_Title2'] = 'Paramétrage des confirmations et validations d\'inscriptions';
$lang['UAM_Title3'] = 'Paramétrage des suivis des inscrits et autres options';
$lang['UAM_Title4'] = 'Astuces et exemples d\'utilisation';
$lang['UAM_No_Casse'] = 'Noms d\'utilisateurs : Sensibilité à la casse';
$lang['UAM_Username_Char'] = 'Noms d\'utilisateurs : Exclusion de certains caractères';
$lang['UAM_Username_Char_true'] = ' Interdire les caractères:<br>(utiliser une virgule pour séparer chaque caractère du suivant)<br><br>';
$lang['UAM_Username_Char_false'] = ' Tout autoriser (valeur par défaut)';
$lang['UAM_Password_Enforced'] = 'Renforcement de la sécurité des mots de passe';
$lang['UAM_Password_Enforced_true'] = ' Activer. Score minimum: ';
$lang['UAM_AdminPassword_Enforced'] = 'Application aux administrateurs';
$lang['UAM_PasswordTest'] = 'Mot de passe test: ';
$lang['UAM_ScoreTest'] = 'Résultat: ';
$lang['UAM_MailExclusion'] = 'Exclusion des domaines de messagerie';
$lang['UAM_MailExclusion_true'] = ' Exclure les domaines suivants:<br>(utiliser une virgule pour séparer chaque domaine du suivant)';

$lang['UAM_Mail_Info'] = 'Email d\'information à l\'utilisateur:';
$lang['UAM_MailInfo_Text'] = ' Texte d\'accueil personnalisé:';
$lang['UAM_Confirm_Mail'] = 'Confirmation d\'inscription:';
$lang['UAM_ConfirmMail_Text'] = ' Texte d\'accueil personnalisé:';
$lang['UAM_Confirm_Group'] = 'Groupes de validation<br>(------- pour ne pas affecter de groupe)';
$lang['UAM_Confirm_Status'] = 'Statuts de validation<br>(------- pour conserver la valeur par défaut de Piwigo)';
$lang['UAM_Confirm_grpstat_notice'] = 'Attention : Il est conseillé d\'utiliser soit les groupes, soit les statuts de validation et pas les deux simultanément.';
$lang['UAM_No_Confirm_Group'] = 'Pour les utilisateurs n\'ayant pas validé leur inscription<br>';
$lang['UAM_Validated_Group'] = 'Pour les utilisateurs ayant validé leur inscription<br>';
$lang['UAM_No_Confirm_Status'] = 'Pour les utilisateurs n\'ayant pas validé leur inscription<br>';
$lang['UAM_Validated_Status'] = 'Pour les utilisateurs ayant validé leur inscription.<br>';
$lang['UAM_ValidationLimit_Info'] = 'Limitation du délai de validation d\'inscription';
$lang['UAM_ConfirmMail_TimeOut_true'] = ' Activer. Nombre de jours de délai: ';
$lang['UAM_ConfirmMail_Remail'] = 'Mail de rappel aux inscrits non validés';
$lang['UAM_ConfirmMail_ReMail_Txt1'] = 'Texte du message de rappel <b><u>avec</u></b> génération d\'une nouvelle clé de validation.';
$lang['UAM_ConfirmMail_ReMail_Txt2'] = 'Texte du message de rappel <b><u>sans</u></b> génération d\'une nouvelle clé de validation.';

$lang['UAM_GhostTracker'] = 'Gestion des visiteurs fantômes (Ghost Tracker)';
$lang['UAM_GhostTracker_true'] = ' Activer. Nombre de jours maximum entre deux visites: ';
$lang['UAM_GhostTracker_ReminderText'] = 'Texte de rappel personnalisé';
$lang['UAM_LastVisit'] = ' Suivi des utilisateurs inscrits';

$lang['UAM_Tab_UserManager'] = 'Suivi des validations';

/* UserManager Tab */
$lang['UAM_SubTitle3'] = 'Suivi des validations';
$lang['UAM_UserManager_Title'] = 'Suivi des validations';
/* Ghost Tracker Tab */
$lang['UAM_SubTitle4'] = 'Ghost Tracker';
$lang['UAM_GT_Init'] = 'Initialisation du Ghost Tracker';
$lang['UAM_GhostTracker_Title'] = 'Gestion des visiteurs fantômes';
$lang['UAM_GhostTracker_Init'] = 'A première activation de cette fonction, ou à sa réactivation après une longue période pendant laquelle de nouveaux visiteurs se sont inscrits, il convient d\'initialiser ou de réinitialiser le Ghost Tracker. Cette action n\'est à faire qu\'une seule fois après activation ou réactivation de l\'option; à cet effet, cliquez <u>une seule fois</u> sur le bouton d\'initialisation ci-dessous.</b>';
/* UserList Tab */
$lang['UAM_SubTitle5'] = 'Informations sur les utilisateurs';
/* Mailing */
$lang['UAM_Add of %s'] = 'Profil créé pour %s';
$lang['UAM_Update of %s'] = 'Mise à jour du profil de %s';
/* Mailing */
$lang['UAM_Ghost_reminder_of_%s'] = '%s, ceci est un email de rappel.';
$lang['UAM_Reminder_with_key_of_%s'] = '%s, votre clef de validation a expiré';
$lang['UAM_Reminder_without_key_of_%s'] = '%s, votre clef de validation va expirer';
/* Errors and Warnings */
$lang['UAM_Err_GhostTracker_Settings'] = 'Cette page n\'est accessible que si "Gestion des visiteurs fantômes" est actif dans "Paramétrage des suivis des inscrits et autres options".';
$lang['UAM_Err_Userlist_Settings'] = 'Cette page n\'est accessible que si le "Suivi des utilisateurs inscrits" est actif dans "Paramétrage des suivis des inscrits et autres options".';
// --------- End: New or revised $lang ---- from version 2.13.4


// --------- Starting below: New or revised $lang ---- from version 2.14.0
$lang['UAM_AdminConfMail'] = 'Validation d\'inscription pour les admins';
// --------- End: New or revised $lang ---- from version 2.14.0


// --------- Starting below: New or revised $lang ---- from version 2.15.0
$lang['UAM_confirmmail_custom_Txt1'] = 'Texte de la page de confirmation - Confirmation acceptée';
$lang['UAM_confirmmail_custom_Txt2'] = 'Texte de la page de confirmation - Confirmation rejetée';
$lang['UAM_LastVisit_Date'] = 'Dernière visite le';
$lang['UAM_Nb_Days'] = 'Ecart en jours';
$lang['UAM_Err_UserManager_Settings'] = 'Cette page n\'est accessible que si "Confirmation d\'inscription" est actif et si un groupe de visiteurs non validés est configuré dans le "Paramétrage des confirmations et validations d\'inscriptions".';
// --------- End: New or revised $lang ---- from version 2.15.0


// --------- Starting below: New or revised $lang ---- from version 2.15.1
$lang['UAM_Support_txt'] = 'Le support officiel sur ce plugin se fait exclusivement sur ce fil du forum FR de Piwigo:<br>
<a href="http://fr.piwigo.org/forum/viewtopic.php?id=12775" onclick="window.open(this.href);return false;">Forum français - http://fr.piwigo.org/forum/viewtopic.php?id=12775</a>
<br><br>
Egalement disponible, le bugtracker du projet: <a href="http://piwigo.org/bugs/" onclick="window.open(this.href);return false;">http://piwigo.org/bugs/</a>';
// --------- End: New or revised $lang ---- from version 2.15.1


// --------- Starting below: New or revised $lang ---- from version 2.15.4
$lang['UAM_Force_Validation'] = 'Validation manuelle';
$lang['UAM_Confirm_Mail_true'] = ' Activer - Validation par le visiteur';
$lang['UAM_Confirm_Mail_local'] = ' Activer - Validation par l\'administrateur (pas d\'envoi de clé de validation)';
$lang['UAM_RedirToProfile'] = 'Redirection vers la page "Personnalisation"';
// --------- End: New or revised $lang ---- from version 2.15.4


// --------- Starting below: New or revised $lang ---- from version 2.16.0
$lang['UAM_Expired_Group'] = '<b>Groupe</b> pour les utilisateurs dont l\'inscription aura expirée<br>';
$lang['UAM_Expired_Status'] = '<b>Statut</b> pour les utilisateurs dont l\'inscription aura expirée<br>';
$lang['UAM_GTAuto'] = 'Gestion automatique des utilisateurs fantomes';
$lang['UAM_GTAutoDel'] = 'Suppressions automatiques des comptes';
$lang['UAM_GTAutoGp'] = 'Changement automatique de groupe / statut';
$lang['UAM_GTAutoMail'] = 'Email automatique sur changement de groupe / statut';
$lang['UAM_Deleted_Account_Redirection_Page'] = 'Accès refusé - Compte détruit !';
$lang['UAM_title_redir_page'] = 'Accès refusé pour cause de compte détruit !';
$lang['UAM_Error_GTAutoMail_cannot_be_set_without_ConfirmMail'] = 'Erreur de cohérence dans la configuration choisie :
<br><br>
"Paramétrage des suivis des inscrits et autres options > Gestion des visiteurs fantômes (Ghost Tracker) > Gestion automatique des utilisateurs fantomes > Email automatique sur changement de groupe / statut" ne peut pas être activé si "Paramétrage des confirmations et validations d\'inscriptions > Confirmation d\'inscription - Validation par le visiteur" n\'est pas activé au préalable.
<br><br>
Pour garantir la cohérence, l\'option "Email automatique sur changement de groupe / statut" a été automatiquement repositionnée en "désactivé".
<br><br>';
$lang['UAM_Demotion of %s'] = 'Rétrogradation de %s';
$lang['UAM_AdminValidationMail_Text'] = 'Notification de validation d\'inscription manuelle';
$lang['UAM_Validation of %s'] = 'Validation de %s';
// --------- End: New or revised $lang ---- from version 2.16.0


// --------- Starting below: New or revised $lang ---- from version 2.20.0
$lang['UAM_CustomPasswRetr'] = 'Personnaliser le contenu du mail sur mot de passe perdu';
$lang['UAM_USRAuto'] = 'Gestion automatique des visiteurs non validés';
$lang['UAM_USRAutoDel'] = 'Message à la suppressions automatiques des comptes';
$lang['UAM_USRAutoMail'] = 'Message de rappel automatique';
$lang['UAM_Disable'] = ' Désactiver (valeur par défaut)';
$lang['UAM_Enable'] = ' Activer ';
$lang['UAM_Tips1'] = 'Information de non validation d\'inscription avec UAM et PWG_Stuffs';
$lang['UAM_Tips1_txt'] = '
          <ul>
            <li>
            Objectifs : Informer le visiteur que son inscription est en attente de validation en affichant un bloc personnel sur la page d\'accueil de la galerie; et ce, tant que l\'inscription n\'est pas validée.<br><br>
            <b>Rappel: En fonctionnement standard, le "Guest" ne voit que les catégories publiques, sans message d\'information.</b>
            </li><br><br>
            <li>
Pré-requis:<br>
- Une galerie avec tout ou partie des catégories privées, visibles par les seuls utilisateurs inscrits<br>
- Au moins les 2 groupes d\'utilisateurs Piwigo suivants : "Attente", sans aucune permission sur les catégories privées, et "Validés", avec toutes les permissions sur les catégories privées<br>
- Le plugin UAM<br>
- Le plugin PWG Stuffs, pour l\'ajout d\'un module spécial UAM<br>
- En option, le plugin Extended Description, pour le support multi-langues<br>
            </li><br><br>
            <li>
Réalisation:<br><br>
A. Dans le plugin UAM:<br>
              <ol>
                <li>Activer la confirmation d\'inscription</li>
                <li>Activer l\'option "Module PWG Stuffs"</li>
                <li>Saisir un "texte d\'accueil personnalisé" qui sera joint au mail de confirmation d\'inscription. Si le plugin Extended Description est activé, les balises de langues peuvent être utilisées</li>
                <li>Sélectionner le groupe "Attente" à la rubrique "Pour les utilisateurs n\'ayant pas validé leur inscription"</li>
                <li>Sélectionner le groupe "Validés" à la rubrique "Pour les utilisateurs ayant validé leur inscription"</li>
                <li>Enregistrer la configuration du plugin</li>
              </ol>
<br>
B. Dans le plugin PWG Stuffs:<br>
              <ol>
                <li>Aller dans l\'onglet "Ajouter un nouveau bloc"</li>
                <li> Sélectionner "Module UAM"</li>
                <li>Configurer le module, en indiquant son titre (ex : "Inscription en attente de validation") et sa description, et cocher uniquement "Attente" dans la liste des groupes autorisés</li>
                <li>Compléter le contenu du module avec le texte du message d\'information qui sera affiché aux utilisateurs non validés. Comme dans UAM, les balises de langues peuvent être utilisées si le plugin Extended Description est activé</li>
                <li>Cocher "Afficher le module sur la page d\'accueil du site"</li>
                <li>Valider la configuration du module</li>
              </ol>
            </li>
          </ul>';
$lang['UAM_Tips2'] = 'Information de non validation d\'inscription avec UAM et Additional Pages';
$lang['UAM_Tips2_txt'] = '
          <ul>
            <li>
            Objectifs : Informer le visiteur que son inscription est en attente de validation en affichant une page additionnelle remplaçant la page d\'index standard de la galerie à chacune de ces connexions; et ce, tant que l\'inscription n\'est pas validée.
            <br><br>
            Avantages par rapport à la méthode avec PWG_Stuffs : Permettre une information mise en forme et moins austère et afficher immédiatement l\'information dès l\'inscription des visiteurs.
            </li><br><br>
            <li>
Pré-requis:<br>
- Une galerie avec tout ou partie des catégories privées, visibles par les seuls utilisateurs inscrits<br>
- Au moins les 2 groupes d\'utilisateurs Piwigo suivants : "Attente", sans aucune permission sur les catégories privées, et "Validés", avec toutes les permissions sur les catégories privées<br>
- Le plugin UAM<br>
- Le plugin Additional Pages, pour l\'ajout et la gestion d\'une page additionnelle remplaçant la page d\'index par défaut de la galerie<br>
- En option, le plugin Extended Description, pour le support multi-langues<br>
            </li><br><br>
            <li>
Réalisation:<br><br>
A. Dans le plugin UAM:<br>
              <ol>
                <li>Activer la confirmation d\'inscription</li>
                <li>Saisir un "texte d\'accueil personnalisé" qui sera joint au mail de confirmation d\'inscription. Si le plugin Extended Description est activé, les balises de langues peuvent être utilisées</li>
                <li>Sélectionner le groupe "Attente" à la rubrique "Pour les utilisateurs n\'ayant pas validé leur inscription"</li>
                <li>Sélectionner le groupe "Validés" à la rubrique "Pour les utilisateurs ayant validé leur inscription"</li>
                <li>Enregistrer la configuration du plugin</li>
              </ol>
<br>
B. Dans le plugin Additional Pages:<br>
                <b>NOTE : La gestion des droits d\'accès aux pages additionelles pour les groupes doit être activée (voir configuration du plugin Additional Pages).</b>
                <br>
              <ol>
                <li>Ajouter une nouvelle page avec au minimum les paramètres suivants :</li>
                <ul>
                  <li>Nom de la page : Le nom que vous souhaiter donner à la page additionnelle (ex : Inscription non validée)</li>
                  <li>Définir comme page d\'accueil coché</li>
                  <li>Groupes autorisés : Cocher la case correspondante au groupe "Attente" configuré dans UAM</li>
                  <li>Contenu : Le texte que vous souhaitez faire apparaitre aux visiteurs.</li>
                </ul>
                <br>
                <li>Et c\'est tout ! Seuls les visiteurs inscrits et dont l\'inscription n\'a pas été validée verront cette page d\'index additionnelle.</li>
              </ol>
            </li>
          </ul>';
$lang['UAM_No_Ghosts'] = 'Pas de visiteurs fantômes pour l\'instant';
$lang['UAM_No_Userlist'] = 'Pas de suivi de visiteurs pour l\'instant';
$lang['UAM_No_Usermanager'] = 'Pas de validations d\'inscription pour l\'instant';
$lang['UAM_Stuffs_Title'] = 'Module UAM';
$lang['UAM_Stuffs_Desc'] = 'Ajoute un module d\'information des utilisateurs non validés';
$lang['UAM_Stuffs'] = 'Module PWG Stuffs';
// --------- End: New or revised $lang ---- from version 2.20.0


// --------- Starting below: New or revised $lang ---- from version 2.20.3
$lang['UAM_DumpTxt'] = 'Sauvegarde de votre configuration';
$lang['UAM_Dump_Download'] = 'Pour télécharger le fichier de sauvegarde, cochez cette case:';
$lang['UAM_Save'] = 'Exécuter la sauvegarde';
$lang['UAM_Dump_OK'] = 'Fichier de sauvegarde créé avec succès';
$lang['UAM_Dump_NOK'] = 'Erreur : Impossible de créer le fichier de sauvegarde !';
// --------- End: New or revised $lang ---- from version 2.20.3


// --------- Starting below: New or revised $lang ---- from version 2.20.4
$lang['UAM_HidePassw'] = 'Mot de passe en clair dans le mail d\'information';
// --------- End: New or revised $lang ---- from version 2.20.4

// --------- Starting below: New or revised $lang ---- from version 2.20.11
$lang['UAM_Error_Using_illegal_flag'] = 'Erreur de syntaxe ! Le drapeau d\'insertion automatique [Kdays] est utilisé alors que l\'option "Limitation du délai de validation d\'inscription" n\'a pas été activée. Veuillez activer l\'option ou corriger le(s) champ(s) marqué(s) en rouge.';
// --------- End: New or revised $lang ---- from version 2.20.11
?>