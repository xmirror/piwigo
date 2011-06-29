<?php

/* -----------------------------------------------------------------------------

----------------------------------------------------------------------------- */

$lang['Grum Plugin Classes is not installed'] = 'Le plugin <b>Grum Plugin Classes</b> n\'est pas installé';

$lang['cstat_release'] = 'v';
$lang['cstat_ok']='OK';
$lang['cstat_cancel']='Annuler';

$lang['cstat_install'] = 'Installation';
$lang['cstat_step_1'] = 'Choix du référentiel colorimétrique';
$lang['cstat_step_1_help'] = "
L'analyse effectuée par le plugin consiste à, pour chaque couleur trouvée dans une image, effectuer un rapprochement avec une couleur appartenant à une gamme définie.
Avant de pouvoir utiliser le plugin, il est donc nécessaire de sélectionner la gamme sur laquelle travailler.

Deux gammes sont proposées :";
$lang['cstat_small_colortable'] = 'Gamme réduite';
$lang['cstat_large_colortable'] = 'Gamme élargie';
$lang['cstat_help_small_color_table'] = "
Travailler sur une gamme réduite de couleurs augmente la probabilité de référencer des teintes minoritaires. Ceci a pour avantage de permettre d'effectuer des recherches sur des gammes de couleurs plus larges.

En contrepartie, la variation des nuances étant plus réduite, la pertinence des résultats lors de la recherche sur une couleur peut s'avérer étonnante, notamment sur les images peu saturées.";
$lang['cstat_help_large_color_table'] = "
Travailler sur une gamme élargie de couleurs permet de disposer d'un nombre accru de nuances pour une teinte donnée. Ceci a pour avantage de permettre d'affiner les recherches sur une gamme de couleurs plus précise et augmenter ainsi la pertinence des résultats.

En contrepartie, sur une image avec une ou deux teintes majoritairement présentes, la variation des nuances de celles-ci aura pour conséquences de réduire fortement la probabilité de référencer les teintes minoritaires.";
$lang['cstat_sample_color_associated'] = 'Couleurs de la gamme associée :';
$lang['cstat_color'] = 'Couleur';
$lang['cstat_validate'] = 'Valider';


$lang['cstat_database'] = 'Référentiel';
$lang['cstat_loading'] = 'Chargement...';
$lang['cstat_update_color_database']= 'Mettre à jour le référentiel des couleurs';
$lang['cstat_status_of_database']='Etat du référentiel';
$lang['cstat_analyze_not_analyzed_pictures'] = "L'analyse porte sur les images n'ayant jamais été analysées et vient s'ajouter au référentiel actuel";
$lang['cstat_analyze_all_pictures'] = "L'analyse porte sur toutes les images de la galerie et vient remplacer le référentiel actuel";
$lang['cstat_analyze_caddie_add_pictures'] = "L'analyse porte sur les images du panier et vient s'ajouter au référentiel actuel";
$lang['cstat_analyze_caddie_replace_pictures'] = "L'analyse porte sur les images du panier et vient remplacer le référentiel actuel";
$lang['cstat_analyze'] = "Analyser";
$lang['cstat_need_to_analyze'] = "Afin de disposer d'un référentiel de couleur, il est nécessaire de procéder à une analyse directe de la galerie :";
$lang['cstat_warning_on_analyze_0'] = "Attention !";
$lang['cstat_warning_on_analyze_1'] = "L'alimentation du référentiel via le processus d'analyse directe peut s'avérer être long (jusqu'à plusieurs minutes de traitement) et gourmand en ressources sur le serveur en fonction du nombre de photos sélectionnées pour l'analyse.";
$lang['cstat_warning_on_analyze_2'] = "Certains hébergeurs peuvent sanctionner ce type d'usage.";

$lang['cstat_updating_database']="Mise à jour du référentiel";
$lang['cstat_numberOfAnalyzedPictures']="%d images ont fait l'objet d'une analyse";
$lang['cstat_numberOfNotAnalyzedPictures']="%d images n'ont pas fait l'objet d'une analyse";
$lang['cstat_numberOfPicturesInError']="%d images n'ont pas pu être analysées (traitement en erreur)";

$lang['cstat_analyze_in_progress']='Traitement en cours...';
$lang['cstat_analyze_is_finished']='Traitement terminé';

$lang['cstat_stat']='Statistiques';
$lang['cstat_statistics']='Analyses statistiques';
$lang['cstat_number_of_colors_used']='Nombre de couleurs utilisées :';


$lang['cstat_colors']='Couleurs';
$lang['cstat_Pct']='%';
$lang['cstat_NumOfImages']='Nombre d\'images';
$lang['cstat_NumOfPixels']='Nombre de pixels';
$lang['cstat_NumOfImages_help']="Indique le nombre d'images dans lesquelles la couleur est présente.<br>Le pourcentage est relatif au nombre d'images analysées.";
$lang['cstat_NumOfPixels_help']="Indique le nombre de pixels pour lesquels la couleur a été déterminée.<br>Le pourcentage est relatif au nombre de pixels analysés et représente la 'surface' occupée sur l'ensemble des photos.";
$lang['cstat_images']='images';
$lang['cstat_surface']='surface';


$lang['cstat_search']='Recherche';
$lang['cstat_search_by_color']='Effectuer une recherche par couleur';
$lang['cstat_choose_colors']='Sélection de couleurs';
$lang['cstat_choosen_colors']='Couleurs sélectionnées';
$lang['cstat_operator_and']="Toutes les couleurs sélectionnées doivent être présentes dans l'image";
$lang['cstat_operator_or']="Au moins une des couleurs sélectionnées doit être présente dans l'image";
$lang['cstat_operator_not']="Aucune des couleurs sélectionnées ne doit être présente dans l'image";
$lang['cstat_color_already_choosen']='La couleur est déjà sélectionnée dans la liste';
$lang['cstat_add_colors']='Ajouter une sélection de couleurs';


$lang['cstat_config']='Configuration';
$lang['cstat_gallery_integration']='Intégration dans la galerie';
$lang['cstat_apply']='Appliquer';
$lang['cstat_stat_and_search']='Statistiques & Recherches';
$lang['cstat_save_config']='Configuration enregistrée';
$lang['cstat_display_colors_on_image']='Afficher les couleurs associées à l\'image';
$lang['cstat_percent_min_significant']='Présence minimum au sein d\'une image pour qu\'une couleur soit considérée comme pertinente lors d\'une recherche :';
$lang['cstat_config_plugin']='Configuration du plugin';
$lang['cstat_gallery_display_colors'] = 'Affichage des couleurs de l\'image';
$lang['cstat_color_size'] = 'Dimensions';
$lang['cstat_significant_colors'] = 'Pertinence des couleurs';
$lang['cstat_bench'] = 'Mesure des performances';
$lang['cstat_do_bench'] = 'Mesurer';
$lang['cstat_do_benchmark'] = "En fonction des performances du serveur, l'analyse des images de la galerie peut être plus ou moins longue.<br>
Il est possible de régler le plugin afin de privilégier la rapidité de l'analyse au détriment de la qualité, ou inversement, privilégier la qualité de l'analyse au détriment de la rapidité.<br><br>

La mesure des performances reflète les capacités de calcul à un instant donné, lesquelles peuvent varier en fonction de la charge du serveur : le temps estimé des traitements n'est donné qu'à titre indicatif et peu donc varier en fonction des ressources disponibles.
";
$lang['cstat_quality_of_analyze'] = 'Qualité de l\'analyse';
$lang['cstat_quality_level']='Qualité';
$lang['cstat_estimated_time_one_picture']='Temps estimé pour une image';
$lang['cstat_estimated_time_all_pictures']='Temps estimé pour toutes les images';
$lang['cstat_quality_highest']='Très haute';
$lang['cstat_quality_high']='Haute';
$lang['cstat_quality_normal']='Normale';
$lang['cstat_quality_low']='Basse';
$lang['cstat_quality_lowest']='Très basse';

$lang['cstat_colors_on_image']='Couleurs associées à l\'image';

// new keys from release 1.0.2
$lang['cstat_gpc_not_up_to_date']="Il est nécessaire que le plugin <i>Grum Plugin Classes</i> version %s soit installé.
Actuellement, la version %s est installée : merci de procéder à la mise à jour de version du plugin <i>Grum Plugin Classes</i>.";


?>
