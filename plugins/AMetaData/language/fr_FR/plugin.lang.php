<?php

/*
 * How to translate metadata names and values ?
 *
 * Metadata names and values are not translated with a /language/*.lang.php file
 * but they are stored in a .po and .mo files, respectively localized into
 *  - /JpegMetaData/Locale/xx_XX/Tag.po
 *  - /JpegMetaData/Locale/xx_XX/LC_MESSAGES/Tag.mo
 *
 * More information about GNU gettext l10n system and method to edit the .po & .mo
 * files on wikipedia :
 *  - http://en.wikipedia.org/wiki/GNU_gettext
 *
 */

$lang['Grum Plugin Classes is not installed'] = 'Le plugin <b>Grum Plugin Classes</b> n\'est pas installé';

$lang['amd_title_page'] = 'Gestion avancée des métadonnées';
$lang['g003_version'] = 'v';

$lang['g003_error_invalid_ajax_call'] = "Appel de fonction invalide !";

$lang['g003_metadata'] = "Métadonnées";
$lang['g003_database'] = "Référentiel";
$lang['g003_status'] = "Status";
$lang['g003_show'] = "Consulter";

$lang['g003_numberOfNotAnalyzedPictures'] = "%d images n'ont pas fait l'objet d'une analyse";
$lang['g003_analyze_not_analyzed_pictures'] = "L'analyse porte sur les images n'ayant jamais été analysées et vient s'ajouter au référentiel actuel";
$lang['g003_analyze_all_pictures'] = "L'analyse porte sur toutes les images de la galerie et vient remplacer le référentiel actuel";
$lang['g003_analyze_caddie_add_pictures'] = "L'analyse porte sur les images du panier et vient s'ajouter au référentiel actuel";
$lang['g003_analyze_caddie_replace_pictures'] = "L'analyse porte sur les images du panier et vient remplacer le référentiel actuel";
$lang['g003_analyze'] = "Analyser";
$lang['g003_update_metadata'] = "Mettre à jour le référentiel de métadonnées";
$lang['g003_status_of_database'] = "Etat du référentiel";
$lang['g003_updating_metadata'] = "Mise à jour du référentiel";
$lang['g003_analyze_in_progress'] = "Traitement en cours...";
$lang['g003_analyze_is_finished'] = "Traitement terminé";
$lang['g003_loading'] = "Chargement...";
$lang['g003_numberOfPicturesWithoutTags'] = "%d images ne disposent pas de métadonnées";
$lang['g003_no_items_selected'] = "Aucune métadonnée n'est sélectionnée";
$lang['g003_selected_tag_isnot_linked_with_any_picture'] = "La métadonnée sélectionnée n'est rattachée à aucune image";
$lang['g003_TagId'] = "Métadonnée";
$lang['g003_TagLabel'] = "Nom";
$lang['g003_NumOfImage'] = "Images";
$lang['g003_Pct'] = "%";
$lang['g003_select'] = "Sélection";
$lang['g003_display'] = "Affichage";
$lang['g003_order'] = "Trier par";
$lang['g003_filter'] = "Filtrer";
$lang['g003_tagOrder'] = "Métadonnée";
$lang['g003_numOrder'] = "Nombre d'images";
$lang['g003_valueOrder'] = "Valeur";
$lang['g003_no_filter'] = "Aucun filtre";
$lang['g003_magic_filter'] = "Magic (métadonnées calculées)";
$lang['g003_exclude_unused_tags'] = "Exclure les métadonnées inutilisées";
$lang['g003_Value'] = "Valeur";
$lang['g003_selected_tags_only'] = "Ne restituer que les métadonnées sélectionnées";

$lang['g003_select_metadata'] = "Sélection des métadonnées";
$lang['g003_display_management'] = "Gestion de l'affichage des métadonnées";
$lang['g003_number_of_filtered_metadata'] = "Nombre de métadonnées :";
$lang['g003_number_of_distinct_values'] = "Nombre de valeurs distinctes :";

$lang['g003_click_to_edit_group'] = "Cliquer pour éditer les propriétés du groupe de métadonnées";
$lang['g003_click_to_delete_group'] = "Cliquer pour supprimer le groupe de métadonnées";
$lang['g003_click_to_manage_group'] = "Cliquer pour gérer les éléments du groupe de métadonnées";
$lang['g003_click_to_manage_list'] = "Cliquer pour ajouter/supprimer des métadonnées";
$lang['g003_add_a_group'] = "Ajouter un groupe de métadonnées";
$lang['g003_adding_a_group'] = "Ajout d'un groupe de métadonnées";
$lang['g003_editing_a_group'] = "Edition d'un groupe de métadonnées";
$lang['g003_deleting_a_group'] = "Suppression d'un groupe de métadonnées";
$lang['g003_new_group'] = "Nouveau groupe de métadonnées";
$lang['g003_name'] = "Nom";
$lang['g003_add_delete_tags'] = "Ajouter/Supprimer des métadonnées";
$lang['g003_confirm_group_delete'] = "Etes-vous sur de vouloir supprimer le groupe de métadonnées %s ?";
$lang['g003_default_group_name'] = "Conditions de la prise de vue";

$lang['g003_ok'] = "Ok";
$lang['g003_cancel'] = "Annuler";
$lang['g003_yes'] = "Oui";
$lang['g003_no'] = "Non";


$lang['g003_invalid_group_id'] = "Identifiant de groupe de métadonnées invalide";
$lang['g003_no_tag_can_be_selected'] = "Aucune métadonnée n'est disponible";


$lang['g003_warning_on_analyze_3'] = "Le référentiel s'alimente peu à peu chaque fois qu'une page de la galerie est visitée. La durée nécessaire pour l'alimentation complète du référentiel dépends donc :";
$lang['g003_warning_on_analyze_3a'] = "du nombre de photos dans la galerie";
$lang['g003_warning_on_analyze_3b'] = "du nombre de pages visualisées quotidiennement";

$lang['g003_warning_on_analyze_5'] = "Afin de disposer rapidement d'un référentiel complet, il est possible de procéder à une analyse plus directe de la galerie :";
$lang['g003_warning_on_analyze_0'] = "Attention !";
$lang['g003_warning_on_analyze_1'] = "L'alimentation du référentiel via le processus d'analyse directe peut s'avérer être long (jusqu'à plusieurs minutes de traitement) et gourmand en ressources sur le serveur en fonction du nombre de photos sélectionnées pour l'analyse.";
$lang['g003_warning_on_analyze_2'] = "Certains hébergeurs peuvent sanctionner ce type d'usage.";



$lang['g003_metadata_detail'] = "Domaine de valeurs pour la métadonnée";

$lang['g003_help'] = "Aide sur les métadonnées";
$lang['g003_help_tab_exif'] = "Exif";
$lang['g003_help_tab_iptc'] = "IPTC";
$lang['g003_help_tab_xmp'] = "XMP";
$lang['g003_help_tab_magic'] = "Magic";
$lang['g003_help_exif'] = "Les métadonnées EXIF sont des informations qui sont stockées dans l'image, par l'appareil photo, au moment de la prise de vue.

Les informations que l'on y trouve sont essentiellement techniques :
[ul]
[li]matériel utilisé (modèle de l'appareil, constructeur)[/li]
[li]les conditions de prises de vue (ouverture, temps d'exposition, focale)[/li]
[li]le moment de la prise de vue (date, heure)[/li]
[li]le lieu géographique (données GPS)[/li]
[li]des informations sur le format de la photo (dimensions, résolution, compression)[/li]
[/ul]

L'alimentation des métadonnées EXIF est normalisée ([url]http://www.exif.org/Exif2-2.PDF[/url]), néanmoins :
[ul]
[li]cette norme mise en place par le [url=http://www.jeita.or.jp]JEITA[/url] (Japan Electronics and Information Technology Industries Association) n'évolue plus depuis 2002[/li]
[li]chaque métadonnée définie dans la norme est facultative : tous les appareils ne renseignent donc pas toutes les métadonnées[/li]
[li]il existe une métadonnée [i]MakerNote[/i] qui est un champ libre exploité par les fabriquants et dans laquelle sont stockées des informations non présentes dans les spécifications (par exemple, les références de l'objectif) ; ces informations sont propres à chaque fabricant, voir propre à chaque appareil. Le plugin sait interpréter une partie de ces informations pour les appareils [b]Pentax[/b], [b]Canon[/b] et [b]Nikon[/b].[/li]
[/ul]";

$lang['g003_help_iptc'] = "Les métadonnées IPTC sont des informations qui sont stockées dans l'image, par le photographe, via un logiciel approprié.

La nature des informations que l'on y trouve est essentiellement orientée vers le monde professionnel :
[ul]
[li]les références du photographe (nom, contact)[/li]
[li]les informations relatives au Copyright[/li]
[li]la description de la photo (titre, description, commentaires, mot-clefs)[/li]
[li]des informations diverses relatives au monde professionnel[/li]
[/ul]

L'alimentation des métadonnées IPTC est normalisée ([url]http://www.iptc.org[/url]).
Cette norme a été mise en place par un consortium réunissant les principales agences de presses du monde, L[i]'International Press Telecommunications Council[/i] (abrégé en IPTC).";
$lang['g003_help_xmp'] = "Les métadonnées XMP sont essentiellement des métadonnées EXIF et IPTC qui sont stockées dans l'image au format XML.

L'avantage des métadonnées XMP, c'est l'apport d'une certaine souplesse :
[ul]
[li]les informations peuvent y être stockées en plusieurs langues[/li]
[li]l'emploi du jeu de caractères Unicode permet (principalement) d'utiliser des caractères non latin[/li]
[li]le format XML facilite l'interprétation et l'échange d'information[/li]
[/ul]

L'alimentation des métadonnées XMP est normalisée ([url]http://www.metadataworkinggroup.org/specs[/url]).
La norme conseille d'exploiter de préférence les métadonnées EXIF et IPTC si celles-ci sont présentes.

La conversion des métadonnées EXIF & IPTC en métadonnées XMP s'effectue généralement au moyen de logiciels de retouche photographique.

Le modèle XMP étant plus pauvre que le modèle EXIF, les conséquences de cette conversion se traduisent par une perte d'informations au niveau de la photo. Généralement les informations perdues ne sont pas d'une grande importance pour la plupart des utilisateurs, néanmoins la norme préconise que les logiciels qui enregistrent les métadonnées XMP conservent les métadonnées d'origine : ce n'est malheureusement pas toujours le cas.
";
$lang['g003_help_magic'] = "Une même information peut être stockée sous plusieurs formats au sein d'une photo :
[ul]
[li]elle peut être présente dans tous les formats[/li]
[li]elle peut être présente dans un format mais pas dans un autre[/li]
[/ul]

Par exemple, l'ouverture du diaphragme peut être présente dans 4 métadonnées différentes :
[ul]
[li][b]exif.exif.FNumber[/b][/li]
[li][b]exif.exif.ApertureValue[/b][/li]
[li][b]xmp.exif:ApertureValue[/b][/li]
[li][b]xmp.exif:FNumber[/b][/li]
[/ul]

Afin de faciliter la restitution des informations pouvant être éparpillées, le plugin propose un petit panel des métadonnées les plus usitées et se charge d'en analyser la présence dans les photos, et de restituer l'information la plus pertinente.
Ce sont les métadonnées nommées [b]Magic[/b].

Ainsi, la métadonnée [b]magic.ShotInfo.Aperture[/b] restitue :
[ul]
[li]la valeur de la métadonnée [b]exif.exif.FNumber[/b] si celle-ci est présente dans la photo, sinon[/li]
[li]la valeur de la métadonnée [b]xmp.exif:FNumber[/b] si celle-ci est présente dans la photo, sinon[/li]
[li]la valeur de la métadonnée [b]exif.exif.ApertureValue[/b] si celle-ci est présente dans la photo, sinon[/li]
[li]la valeur de la métadonnée [b]xmp.exif:ApertureValue[/b] si celle-ci est présente dans la photo[/li]
[/ul]";



/** ----------------------------------------------------------------------------
 * new keys from releases 0.5.0/0.5.1
 */

$lang['g003_y'] = "Oui";
$lang['g003_n'] = "Non";

$lang['g003_state'] = "Etat";
$lang['g003_update'] = "Mise à jour";
$lang['g003_personnal'] = "Personnelles";
$lang['g003_search'] = "Recherche";

$lang['g003_personnal_metadata'] = "Métadonnées personnalisées";
$lang['g003_add_a_new_md'] = "Ajouter une nouvelle métadonnée";
$lang['g003_fill_database'] = "Alimente le référentiel";
$lang['g003_num_of_rules'] = "Nombre de règles";
$lang['g003_metadatId'] = "Identifiant de la métadonnée";
$lang['g003_rules'] = "Règles";
$lang['g003_add_a_rule'] = "Ajouter une règle";
$lang['g003_typeText'] = "Texte";
$lang['g003_typeMetadata'] = "Métadonnée";
$lang['g003_typeCondition'] = "Condition";
$lang['g003_typeCIfExist'] = "existe";
$lang['g003_typeCIfNotExist'] = "n'existe pas";
$lang['g003_typeCIfEqual'] = "est égale à";
$lang['g003_typeCIfNotEqual'] = "n'est pas égale à";
$lang['g003_typeCIfLike'] = "contient";
$lang['g003_typeCIfNotLike'] = "ne contient pas";
$lang['g003_typeCIfBeginWith'] = "commence par";
$lang['g003_typeCIfNotBeginWith'] = "ne commence pas par";
$lang['g003_typeCIfEndWith'] = "finit par";
$lang['g003_typeCIfNotEndWith'] = "ne finit pas par";
$lang['g003_conditionIf'] = "Tester si la métadonnée";

$lang['g003_invalidId'] = "L\'identifiant de la métadonnée est invalide";
$lang['g003_oneRuleIsNeeded'] = "Il doit y avoir au moins une règle de gestion";
$lang['g003_textRuleInvalid'] = "Règle de type \"Texte\" : le texte ne doit pas être vide";
$lang['g003_metadataRuleInvalid'] = "Règle de type \"Métadonnée\" : une métadonnée doit être sélectionnée";
$lang['g003_conditionMdRuleInvalid'] = "Règle de type \"Condition\" : une métadonnée doit être sélectionnée";
$lang['g003_conditionRulesRuleInvalid'] = "Règle de type \"Condition\" : il doit y avoir au moins une règle de gestion";

$lang['g003_tagIdAlreadyExist'] = "Une métadonnée avec cet identifiant existe déjà !";

$lang['g003_pleaseConfirmMetadataDelete'] = "Confirmez-vous la suppression de la métadonnée ?";
$lang['g003_deleteMetadata'] = "Suppression de la métadonnée";
$lang['g003_delete']= "Supprimer";

$lang['g003_userDefined_filter'] = "Métadonnées personnalisées";

$lang['g003_informations'] = "Informations";
$lang['g003_databaseInformation'] = "Informations importantes à propos du référentiel";
$lang['g003_databaseWarning1']="[p]Le référentiel est constitué des métadonnées contenues dans les images de la galerie ainsi que de métadonnées calculées par le plugin. En fonction du nombre d'images et du nombre de métadonnées y étant rattachées, le référentiel peut s'avérer être très volumineux.
Avant d'alimenter le référentiel, assurez-vous que la base de données proposée par votre hébergeur permet ce type d'usage.
[/p][p]Il est toutefois à noter que l'usage du référentiel est facultatif, ce dernier n'étant pas exploité pour l'affichage des métadonnées des photos de la galerie.
[/p][p]L'alimentation du référentiel est nécessaire si vous souhaitez :[/p]
[ul]
[li]Disposer de statistiques sur les métadonnées présentes dans vos photos (c'est aussi une aide pour la sélection de métadonnées)[/li]
[li]Disposer du moteur de recherche[/li]
[/ul]
";
$lang['g003_sizeAndRows'] = "Le référentiel fait %s et est constitué de %s métadonnées";
$lang['g003_numberOfAnalyzedPictures'] = "%d images ont fait l'objet d'une analyse";

$lang['g003_options'] = "Options";
$lang['g003_fillDatabaseContinuously'] = "Alimenter le référentiel au fil de l'eau";
$lang['g003_ignoreMetadata'] = "Ignorer les métadonnées suivantes :";

$lang['g003_analyze_analyzed_pictures'] = "L'analyse ne porte que sur les images ayant déjà fait l'objet d'une analyse";
$lang['g003_fillDatabaseIgnoreWarning'] = "Pour être prise en compte, la modification des paramètres de cette option nécessite d'effectuer une analyse";


$lang['g003_add_metadata'] = "Ajouter une métadonnée";

$lang['g003_choose_a_metadata'] = "Recherche sur l\'évaluation d\'une métadonnée";
$lang['g003_add'] = "Ajouter";
$lang['g003_metadata_value_check_one'] = "Au moins une des valeurs suivantes doit être vérifiée :";
$lang['g003_metadata_value_check_all'] = "Toutes les valeurs suivantes doivent être vérifiées :";

$lang['g003_metadata_exists']="La métadonnée %s est présente";
$lang['g003_metadata_dont_exists']="La métadonnée %s n'est pas présente";
$lang['g003_metadata_equals_all']="La métadonnée %s est présente et est égale à l\'une des valeurs suivantes :";
$lang['g003_metadata_equals_one']="La métadonnée %s est présente et est égale à la valeur suivante :";
$lang['g003_metadata_not_equals_all']="La métadonnée %s est présente et n'est égale à aucune des valeurs suivantes :";
$lang['g003_metadata_not_equals_one']="La métadonnée %s est présente et n'est pas égale à la valeur suivante :";
$lang['g003_metadata_like_all']="La métadonnée %s est présente et contient l\'une des valeurs suivantes :";
$lang['g003_metadata_like_one']="La métadonnée %s est présente et contient la valeur suivante :";
$lang['g003_metadata_not_like_all']="La métadonnée %s est présente et ne contient aucune des valeurs suivantes :";
$lang['g003_metadata_not_like_one']="La métadonnée %s est présente et ne contient pas la valeur suivante :";
$lang['g003_metadata_begin_all']="La métadonnée %s est présente et commence par l\'une des valeurs suivantes :";
$lang['g003_metadata_begin_one']="La métadonnée %s est présente et commence par la valeur suivante :";
$lang['g003_metadata_not_begin_all']="La métadonnée %s est présente et ne commence pas par l\'une des valeurs suivantes :";
$lang['g003_metadata_not_begin_one']="La métadonnée %s est présente et ne commence pas par la valeur suivante :";
$lang['g003_metadata_end_all']="La métadonnée %s est présente et finit par l\'une des valeurs suivantes :";
$lang['g003_metadata_end_one']="La métadonnée %s est présente et finit par la valeur suivante :";
$lang['g003_metadata_not_end_all']="La métadonnée %s est présente et ne finit pas par l\'une des valeurs suivantes :";
$lang['g003_metadata_not_end_one']="La métadonnée %s est présente et ne finit pas par la valeur suivante :";

$lang['g003_value_already_set'] = "La valeur est déjà définie dans le domaine de valeurs";
$lang['g003_please_set_a_value'] = "Merci de définir une valeur";


$lang['g003_install']="Installation";
$lang['g003_basic_mode']="Basique";
$lang['g003_advanced_mode']="Avancé";
$lang['g003_validate']="Valider";
$lang['g003_step_1']="Choix du type d'usage du plugin";
$lang['g003_basic_mode_help']="
Le mode [i]basique[/i] s'adresse à ceux qui souhaitent simplement afficher les métadonnées de leurs photos et propose :[ul]
[li]une interface simplifiée au maximum[/li]
[li]une liste réduite de métadonnées (environ 140, dont les plus courantes)[/li]
[/ul]";
$lang['g003_advanced_mode_help']="
Le mode [i]avancé[/i] s'adresse à ceux qui souhaitent exploiter au maximum les métadonnées de leurs photos et propose :[ul]
[li]une interface plus complexe, mais complète[/li]
[li]une liste de métadonnées plus complète (environ 540)[/li]
[li]des fonctionnalités étendues (statistiques, recherche, ...)[/li]
[/ul]
Le mode [i]avancé[/i] nécessite la constitution d'un référentiel.";


$lang['g003_tags']="Tags";
$lang['g003_number_of_keywords']="Nombre de mots-clefs :";
$lang['g003_keyword']="Mot-clef";
$lang['g003_tag_in_piwigo']="Présent dans Piwigo";
$lang['g003_num_of_pictures']="Nombre de photos";
$lang['g003_num_of_pictures_already_tagged']="Nombre de photos déjà taggées";
$lang['g003_convert_ok']="La conversion s'est correctement effectuée";
$lang['g003_convert_keywords_and_apply']="Convertir";
$lang['g003_no_keywords']="Aucun mot-clef susceptible d'être convertit n'a pu être trouvé.";


$lang['g003_tags_page_help']="Cette fonctionnalité effectue une extraction des mots-clefs présents dans les métadonnées de vos photos et vous permet de les convertir en [i]Tags[/i].
Les photos pour lesquelles les mots-clefs ont déjà été convertis et associés n'apparaissent pas : seuls les mots-clefs des photos pour lesquelles une conversion et une association sont possibles sont proposés.";

$lang['g003_search_page_help']="Il est possible d'effectuer diverses recherches sur le contenu des métadonnées, des plus simples au plus complexes : ajoutez des critères, et combinez-les par glisser/déposer.";

$lang['g003_personnal_page_help']="Il est possible de construire très facilement vos propres métadonnées à partir des métadonnées existantes.
[ul]
[li]Ajoutez une nouvelle métadonnée[/li]
[li]Renseignez ses propriétés[/li]
[li]Ajoutez des règles de gestion et combinez-les au besoin par glisser/déposer[/li]
[/ul]";

$lang['g003_select_page_help']="Seules les métadonnées sélectionnées ici sont disponibles dans les autres interfaces de paramétrage : ceci permet de réduire la liste des métadonnées à celles qui vous semblent les plus pertinentes pour votre usage.
La sélection est prise en compte immédiatement (il n'est pas nécessaire de la valider).";


$lang['g003_display_page_help']="Les métadonnées affichées avec la photo peuvent être triées et regroupées.
Par défaut, seul le groupe [i]".$lang['g003_default_group_name']."[/i] est disponible, mais il est possible d'en créer autant que nécessaire ([i]IPTC[/i], [i]Géolocalisation[/i], ...).
[ul]
[li]Créez les groupes de métadonnées selon vos besoins[/li]
[li]Ajoutez-y les métadonnées à afficher[/li]
[li]Au sein d'un groupe, triez l'ordre d'affichage des métadonnées par glisser/déposer[/li]
[li]Triez l'ordre d'affichage des groupes par glisser/déposer[/li]
[/ul]
Sélections&tris sont pris en compte immédiatement (il n'est pas nécessaire de les valider).";

$lang['g003_gpc_not_up_to_date']="Il est nécessaire que le plugin <i>Grum Plugin Classes</i> version %s soit installé.
Actuellement, la version %s est installée : merci de procéder à la mise à jour de version du plugin <i>Grum Plugin Classes</i>.";

/** ----------------------------------------------------------------------------
 * removed keys from releases 0.5.0/0.5.1
 */
//$lang['g003_warning_on_analyze_4a']
//$lang['g003_warning_on_analyze_4b']



/** ----------------------------------------------------------------------------
 * new keys from releases 0.5.3
 */
$lang['g003_1_picture_in_caddie']="1 photo dans le panier";
$lang['g003_n_pictures_in_caddie']="%s photos dans le panier";
$lang['g003_analyze_random_pictures'] = "L'analyse porte sur %s images sélectionnées aléatoirement parmis les images n'ayant jamais été analysées et vient s'ajouter au référentiel actuel";
$lang['g003_invalid_random_number']="Le nombre de photos à traiter est invalide";

$lang['g003_database_is_not_up_to_date']="Le référentiel n'est pas à jour !";
$lang['g003_databaseWarning2_1']="[p]Une nouvelle métadonnée est accessible suite à la dernière mise à jour du plugin :[/p][ul]%s[/ul]
[p]
Pour qu'elle puisse être exploitée, il est nécessaire de procéder à la mise à jour du référentiel.[/p]";
$lang['g003_databaseWarning2_n']="[p]De nouvelles métadonnées sont accessibles suite à la dernière mise à jour du plugin :[/p][ul]%s[/ul]
[p]
Pour qu'elles puissent être exploitées, il est nécessaire de procéder à la mise à jour du référentiel.[/p]";

// help for metadata translation is given at the beginning of this file


?>
