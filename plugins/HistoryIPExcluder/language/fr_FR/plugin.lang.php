<?php
global $lang;

$lang['HIPE_description'] = 'Ce plugin permet d\'exclure de l\'historique et des statistiques des IP ou plages d\'IP.<br>Son activation bloque l\'enregistrement dans la table *_history des IP spécifiées dans le tableau ci-dessous.';
$lang['HIPE_admin_section1'] = 'IP à exclure';
$lang['HIPE_admin_description1'] = 'Saisissez les IP complètes ou plages d\'IP à exclure (une par ligne) dans le cadre ci-dessous. Pour indiquer une plage d\'IP, utilisez le caractère joker "%".<br>Par exemple : 74.6.2.1 ou 74.6.%<br><br>';
$lang['HIPE_save_config']='Configuration enregistrée.';
$lang['HIPE_CleanHist']='Nettoyer l\'historique';

$lang['HIPE_admin_section2'] = 'Requêtes sur l\'historique';
$lang['HIPE_admin_section3'] = 'Résultat de la requête sur l\'historique';
$lang['HIPE_IPByMember'] = 'IP d\'utilisateurs';
$lang['HIPE_IPByMember_description'] = 'Recherche et affiche les IP d\'utilisateurs inscrits, (tri par IP)';
$lang['HIPE_OnlyGuest'] = 'IP d\'invités seulement';
$lang['HIPE_OnlyGuest_description'] = 'Recherche et affiche uniquement les IP utilisées par des invités, et le nombre de visites associées (tri par nombre de visites par IP)';
$lang['HIPE_IPnoGuest'] = '';
$lang['HIPE_IPnoGuest_description'] = '';

$lang['HIPE_IPForMember'] = 'IP d\'un utilisateur';
$lang['HIPE_IPForMember_description'] = 'Recherche et affiche les IP associées à un utilisateur inscrit (tri par IP)';
$lang['HIPE_MemberForIp'] = 'Utilisateurs d\'une IP';
$lang['HIPE_MemberForIp_description'] = 'Recherche et affiche les utilisateurs attachés à une IP (tri par utilisateur)';

$lang['HIPE_resquet_ok'] = 'Requête exécutée.';
$lang['HIPE_hist_cleaned'] = 'Nettoyage de l\'historique effectué.';

$lang['IP_geolocalisation'] = 'Géolocalisation';

// --------- Starting below: New or revised $lang ---- from version 2.1.0
$lang['HIPE_version'] = ' - Version: ';
// --------- End: New or revised $lang ---- from version 2.1.0

// --------- Starting below: New or revised $lang ---- from version 2.1.1
$lang['HIPE_IPBlacklist_title'] = 'Exclusion à l\'inscription';
$lang['HIPE_IPBlacklisted'] = ' Empêcher l\'inscription à la galerie des IP exclues de l\'historique (Blacklistage)';
$lang['Error_HIPE_BlacklistedIP'] = 'Erreur! Votre IP a été bannie. Vous ne pouvez plus vous inscrire à cette galerie. Contactez l\'administrateur pour de plus amples détails.';
// --------- End: New or revised $lang ---- from version 2.1.1
?>