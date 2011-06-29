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

$lang['Grum Plugin Classes is not installed'] = 'El plugin <b>Grum Plugin Classes</b> no esta instalado';

$lang['amd_title_page'] = 'Gestión avanzada de los métadatos';
$lang['g003_version'] = 'v';

$lang['g003_error_invalid_ajax_call'] = "Llamada de función invalida";

$lang['g003_stat'] = "Estadísticas";
$lang['g003_metadata'] = "Métadatos";
$lang['g003_database'] = "Référencial";
$lang['g003_status'] = "Estatuto";
$lang['g003_show'] = "Consultar";

$lang['g003_performances'] = "Rendimiento";
$lang['g003_setting_nb_items_per_request'] = "Numero de imágenes analizadas por demandas";
$lang['g003_apply'] = "Aplicar";

$lang['g003_numberOfAnalyzedPictures'] = "%d imágenes han sido objeto de un análisis y representan %d métadatos";
$lang['g003_numberOfNotAnalyzedPictures'] = "%d imagenes no han sido objecto de un análisis";
$lang['g003_analyze_not_analyzed_pictures'] = "El análisis se centra en las imágenes que nunca han sido analizadas y se añaden al repositorio actual";
$lang['g003_analyze_all_pictures'] = "El análisis se centra en todas las imágenes de la galería y sustituye al repositorio actual";
$lang['g003_analyze_caddie_add_pictures'] = "El análisis se centra en las imágenes de la cesta y se suma a la del repositorio actual";
$lang['g003_analyze_caddie_replace_pictures'] = "El análisis se centra en las imágenes de la cesta y simplemente reemplaza el repositorio actual";
$lang['g003_analyze'] = "Afficher en écriture latineAnalizar";
$lang['g003_update_metadata'] = "Actualizar el repositorio de metadatos";
$lang['g003_status_of_database'] = "Estado del repositorio";
$lang['g003_updating_metadata'] = "Actualización del repositorio";
$lang['g003_analyze_in_progress'] = "En tratamiento...";
$lang['g003_analyze_is_finished'] = "Tratamiento terminado";
$lang['g003_loading'] = "Cargando...";
$lang['g003_numberOfPicturesWithoutTags'] = "%d imágenes no tienen metadatos";
$lang['g003_no_items_selected'] = "Ningún metadatos seleccionados";
$lang['g003_selected_tag_isnot_linked_with_any_picture'] = "Los metadatos seleccionados no están vinculados a ninguna imágenes";
$lang['g003_TagId'] = "Metadatos";
$lang['g003_TagLabel'] = "Nombre";
$lang['g003_NumOfImage'] = "Imágenes";
$lang['g003_Pct'] = "%";
$lang['g003_select'] = "Selección";
$lang['g003_display'] = "Afficher en écriture latineMostrar";
$lang['g003_order'] = "Clasificar por";
$lang['g003_filter'] = "Filtrar";
$lang['g003_tagOrder'] = "Metadatos";
$lang['g003_numOrder'] = "Numero de imágenes";
$lang['g003_valueOrder'] = "Valor";
$lang['g003_no_filter'] = "Ningún filtro";
$lang['g003_magic_filter'] = "Magic (metadatos calculados)";
$lang['g003_exclude_unused_tags'] = "Excluir los metadatos sin utilizar ";
$lang['g003_Value'] = "Valor";
$lang['g003_selected_tags_only'] = "Devolver solo los metadatos seleccionados";

$lang['g003_select_metadata'] = " Selección de metadatos";
$lang['g003_display_management'] = "Gestión de la visualización de metadatos";
$lang['g003_number_of_filtered_metadata'] = "Número de metadatos :";
$lang['g003_number_of_distinct_values'] = "Número de valores distintos :";

$lang['g003_click_to_edit_group'] = "Haga clic para editar las propiedades del grupo de metadatos";
$lang['g003_click_to_delete_group'] = "Haga clic para eliminar el grupo de metadatos";
$lang['g003_click_to_manage_group'] = "Haga clic para administrar los elementos del grupo de metadatos";
$lang['g003_click_to_manage_list'] = "Haga clic para añadir o quitar metadatos";
$lang['g003_add_a_group'] = "Añadir un grupo de metadatos";
$lang['g003_adding_a_group'] = "Adición de un grupo de metadatos";
$lang['g003_editing_a_group'] = "Edición de un grupo de metadatos";
$lang['g003_deleting_a_group'] = "Eliminación de un grupo de metadatos";
$lang['g003_new_group'] = "Nuevo grupo de metadatos";
$lang['g003_name'] = "Nombre";
$lang['g003_add_delete_tags'] = "Agregar o quitar metadatos";
$lang['g003_confirm_group_delete'] = "¿Está seguro que desea eliminar el grupo de metadatos %s ?";
$lang['g003_default_group_name'] = "Condiciones de visualización";

$lang['g003_ok'] = "Ok";
$lang['g003_cancel'] = "Cancelar";
$lang['g003_yes'] = "Si";
$lang['g003_no'] = "No";


$lang['g003_invalid_group_id'] = "Identificador de grupo de metadatos no válido";
$lang['g003_no_tag_can_be_selected'] = "No se dispone de los metadatos";

$lang['g003_warning_on_analyze_0'] = "¡Atención !";
$lang['g003_warning_on_analyze_1'] = "La alimentación del repositorio es un proceso que puede llegar a ser largo (hasta varios minutos de tratamiento) y exige muchos recursos en el servidor en función del número de fotos seleccionadas para el análisis.";
$lang['g003_warning_on_analyze_2'] = "Algunos hospedadores pueden sancionar este tipo de uso.";
$lang['g003_warning_on_analyze_3'] = "Es muy recomendable llenar la canasta con cerca de cincuenta imágenes representativas de la galería de fotos para proceder al tratamiento.";




$lang['g003_help_exif'] = "Los metadatos son información EXIF que se almacena en la imagen por la cámara en el momento del disparo.

Cualquier información que se encuentra allí son de carácter técnico:
[ul]
[li]equipo utilizado (modelo de cámara, fabricante)[/li]
[li]las condiciones de disparo (apertura, tiempo de exposición, la distancia focal)[/li]
[li]el momento de los disparos (fecha, hora)[/li]
[li]la ubicación geográfica (datos GPS)[/li]
[li]información sobre el formato de la foto (tamaño, resolución, compresión)[/li]

La alimentación de los metadatos EXIF está normalizada ([url]http://www.exif.org/Exif2-2.PDF[/url]), sin embargo:
[ul]
[li]Este estándar adoptado por la [url=http://www.jeita.or.jp]JEITA[/url] Japan Electronics and Information Technology Industries Association) ya no cambia desde el 2002 [/li]
[li]Todo metadatos definidos en la norma es opcional: todos los dispositivos no informan sobre todos los metadatos[/li]
[li]hay un metadatos [i]MakerNote[/i], que es un campo abierto utilizados por los fabricantes y en el que se almacena información que no está presente en las condiciones (por ejemplo, las referencias al objetivo) esta información es única a cada empresa, ver cada dispositivo. El plugin puede interpretar parte de esta información para los aparatos [b]Pentax[/b], [b]Canon[/b], [b]Nikon[/b].[/Li]
[/ul]";


$lang['g003_help_iptc']="Los metadatos IPTC son informaciónes que son almacenada en la imagen, por el fotógrafo, con un programa adapdado.

La naturaleza de la información contenida allí es esencialmente orientada hacia el mundo profesional
[ul]
[li]referencias del fotógrafo (nombre, contacto)[/li]
[li]información sobre el derechos de autor[/li]
[li]La descripción de la imagen (título, descripción, comentarios, palabras clave)[/li]
[li]una variedad de información relacionada con el mundo profesionales[/li]
[/ul]

La alimentación de los metadatos IPTC esta normalizada ([url]http://www.iptc.org [/url]).
Esta norma ha sido establecida por un consorcio de agencias de noticias más importantes del mundo, la [i]International Press Telecommunications Council[/i] (abreviado como IPTC).";

$lang['g003_03_help_xmp'] = "Los metadatos XMP son esencialmente EXIF e IPTC almacenados en formato XML.

La ventaja de los metadatos XMP es la provisión de flexibilidad:
[ul]
[li]información se pueden almacenar en varios idiomas [/li]
[li]el uso del conjunto de caracteres Unicode permite (principalmente) utilizar caracteres no latinos[/li]
[li]XML facilita la interpretación y el intercambio de información[/li]
[/ul]

La alimentación de los metadatos XMP está normalizado ([url]http://www.metadataworkinggroup.org/specs[/url]).
Es aconsejado utilizar preferentemente el EXIF e IPTC si están presentes.

La conversión de EXIF e IPTC de metadatos XMP se efectúa con el software de edición de fotos.

El modelo XMP es más pobre que el modelo de EXIF, las consecuencias de esta conversión se traducirá en una pérdida de información en la foto. En general, la pérdida de información no es de gran importancia para la mayoría de los usuarios, sin embargo, la norma recomienda que el software que el almacena los metadatos XMP conserven las informaciónes originales: lamentablemente no es siempre el caso.";

$lang['g003_help_magic '] = "La misma información puede ser almacenada en formatos múltiples dentro de una foto:
[ul]
[li]pueden estar presentes en todos los formatos[/li]
[li]puede estar presente en un formato, pero no en otro [/li]
[/ul]

Ejemplo, la abertura puede estar presente en cuatro diferentes metadatos:
[ul]
[li][b]exif.exif.FNumber[/b][/li]
[li][b]exif.exif.ApertureValue[/b][/li]
[li][b]xmp.exif:aperturevalue[/b][/li]
[li][b]xmp.exif:fnumber[/b][/li]
[/ul]

Para facilitar el retorno de la información que pueda estar disperso, el plugin ofrece una pequeña muestra de los metadatos más ampliamente utilizados y es responsable de analizar la presencia en las fotos, y restaurar la información más relevante.
Estos metadatos se llaman [b]Magic[/b].

Así, el [b]metadatos magic.ShotInfo.Aperture[/b] devuelve:
[ul]
[li]el valor de la metadatos [b]exif.exif.FNumber[/b] si está presente en la foto, de lo contrario[/li]
[li]el valor de la metadatos [b]xmp.exif:fnumber[/b] si está presente en la foto, de lo contrario[/li]
[li]el valor de la metadatos [b]exif.exif.ApertureValue[/b] si está presente en la foto, de lo contrario[/li]
[li]el valor de la metadatos [b]xmp.exif:aperturevalue[/b] si está presente en la foto[/li]
[/ul]";




/** ----------------------------------------------------------------------------
 * new keys from releases 0.5.0/0.5.1
 *
 * need to be translated
 * thanks :)
 */

$lang['g003_y'] = "Yes";
$lang['g003_n'] = "No";

$lang['g003_state'] = "State";
$lang['g003_update'] = "Update";
$lang['g003_personnal'] = "Custom";
$lang['g003_search'] = "Search";

$lang['g003_personnal_metadata'] = "Custom metadata";
$lang['g003_add_a_new_md'] = "Add a new metadata";
$lang['g003_num_of_rules'] = "Number of rules";
$lang['g003_metadatId'] = "Identifier of the metadata";
$lang['g003_rules'] = "Rules";
$lang['g003_add_a_rule'] = "Add a rule";
$lang['g003_typeText'] = "Text";
$lang['g003_typeMetadata'] = "Metadata";
$lang['g003_typeCondition'] = "Condition";
$lang['g003_typeCIfExist'] = "exists";
$lang['g003_typeCIfNotExist'] = "does not exist";
$lang['g003_typeCIfEqual'] = "equals";
$lang['g003_typeCIfNotEqual'] = "is not equal to";
$lang['g003_typeCIfLike'] = "contain";
$lang['g003_typeCIfNotLike'] = "does not contain";
$lang['g003_typeCIfBeginWith'] = "begin with";
$lang['g003_typeCIfNotBeginWith'] = "does not begin with";
$lang['g003_typeCIfEndWith'] = "end with";
$lang['g003_typeCIfNotEndWith'] = "does not end with";
$lang['g003_conditionIf'] = "Test if the metadata";

$lang['g003_invalidId'] = "The identifier of the metadata is not valid";
$lang['g003_oneRuleIsNeeded'] = "There must be at least one rule";
$lang['g003_textRuleInvalid'] = "Rule of type \"Text\": the text must not be empty";
$lang['g003_metadataRuleInvalid'] = "Rule of type \"Metadata\": a metadata must be selected";
$lang['g003_conditionMdRuleInvalid'] = "Rule of type \"Condition\": a metadata must be selected";
$lang['g003_conditionRulesRuleInvalid'] = "Rule of type \"Condition\": there must be at least one rule";

$lang['g003_tagIdAlreadyExist'] = "A metadata with this identifier already exists !";

$lang['g003_pleaseConfirmMetadataDelete'] = "Do you confirm the metadata deletion ?";
$lang['g003_deleteMetadata'] = "Deleting the metadata";
$lang['g003_delete']= "Delete";

$lang['g003_userDefined_filter'] = "Custom metadata";

$lang['g003_informations'] = "Informations";
$lang['g003_databaseInformation'] = "Important information about the repository";
$lang['g003_databaseWarning1']="[p]The repository is built using the metadata contained in images from the gallery as well as metadata calculated by the plugin. Depending on the number of images and the number of metadata to be attached, the repository can be very large.
Before powering up the repository, make sure that the database provided by your host allows this type of use.
[/p][p]It should be noted however that the use of the repository is optional, it is not used for displaying metadata for photos in the gallery.
[/p][p]The filling of the repository is necessary if you wish:[/p]
[ul]
[li]Have statistics on the metadata in your photos (it also help in the selection of metadata)[/li]
[li]Use the search engine[/li]
[/ul]
";
$lang['g003_sizeAndRows'] = "The weight of the repository is %s and it contains %s metadata";
$lang['g003_numberOfAnalyzedPictures'] = "%d images were analyzed";

$lang['g003_options'] = "Options";
$lang['g003_fillDatabaseContinuously'] = "Fill the repository continuously";
$lang['g003_ignoreMetadata'] = "Ignore the following metadata:";

$lang['g003_analyze_analyzed_pictures'] = "The analysis covers only the images that have already been analyzed";
$lang['g003_fillDatabaseIgnoreWarning'] = "To be applied, modifying the parameters of this option requires a new analysis";


$lang['g003_add_metadata'] = "Add a metadata";

$lang['g003_choose_a_metadata'] = "Perform a search on the value of a metadata";
$lang['g003_add'] = "Add";
$lang['g003_metadata_value_check_one'] = "At least one of the following must be true:";
$lang['g003_metadata_value_check_all'] = "All values have to be true:";

$lang['g003_metadata_exists']="Metadata %s is present";
$lang['g003_metadata_dont_exists']="Metadata %s is not present";
$lang['g003_metadata_equals_all']="Metadata %s is present and is equal to the one of the following value:";
$lang['g003_metadata_equals_one']="Metadata %s is present and is equal to:";
$lang['g003_metadata_not_equals_all']="Metadata %s is present and must not be equal to any of the following value:";
$lang['g003_metadata_not_equals_one']="Metadata %s is present and must not be equal to:";
$lang['g003_metadata_like_all']="Metadata %s is present and must contain the one of the following value:";
$lang['g003_metadata_like_one']="Metadata %s is present and must contain:";
$lang['g003_metadata_not_like_all']="Metadata %s is present and must not contain any of the following value:";
$lang['g003_metadata_not_like_one']="Metadata %s is present and must not contain:";
$lang['g003_metadata_begin_all']="Metadata %s is present and must begin with any of the following value:";
$lang['g003_metadata_begin_one']="Metadata %s is present and must begin with:";
$lang['g003_metadata_not_begin_all']="Metadata %s is present and must not begin with any of the following value:";
$lang['g003_metadata_not_begin_one']="Metadata %s is present and must not begin with:";
$lang['g003_metadata_end_all']="Metadata %s is present and must end with any of the following value:";
$lang['g003_metadata_end_one']="Metadata %s is present and must end with:";
$lang['g003_metadata_not_end_all']="Metadata %s is present and must not end with any of the following value:";
$lang['g003_metadata_not_end_one']="Metadata %s is present and must not end with:";

$lang['g003_value_already_set'] = "The value is already defined in the domain of values";
$lang['g003_please_set_a_value'] = "Please, set a value";


$lang['g003_install']="Installation";
$lang['g003_basic_mode']="Basic";
$lang['g003_advanced_mode']="Advanced";
$lang['g003_validate']="OK";
$lang['g003_step_1']="Choice of use of the plugin";
$lang['g003_basic_mode_help']="
The [i]basic[/i] mode is for those who simply want to display the metadata of their photos and offers:[ul]
[li]an interface as simple as possible[/li]
[li]a short list of metadata (about 140, the most common)[/li]
[/ul]";
$lang['g003_advanced_mode_help']="
The [i]advanced[/i] mode is for those who wish to make maximum use of their photos and metadata offers:[ul]
[li]an interface more complex, but complete[/li]
[li]a complete list of metadata (about 540)[/li]
[li]extended functionalities (statistics, search ...)[/li]
[/ul]
The [i]advanced[/i] mode requires to built a repository.";


$lang['g003_tags']="Tags";
$lang['g003_number_of_keywords']="Number of keywords:";
$lang['g003_keyword']="Keyword";
$lang['g003_tag_in_piwigo']="Present in Piwigo";
$lang['g003_num_of_pictures']="Number of photos";
$lang['g003_num_of_pictures_already_tagged']="Number of photos already tagged";
$lang['g003_convert_ok']="The conversion was done correctly";
$lang['g003_convert_keywords_and_apply']="Convert";
$lang['g003_no_keywords']="No keyword that can be converted has been found";


$lang['g003_tags_page_help']="This feature performs an extraction of keywords present in the metadata for your photos and allows you to convert [i]Tags[/i].
The images for which keywords have already been converted and associates do not appear: only the keywords of images for which a conversion and a possible association are proposed.";

$lang['g003_search_page_help']="It is possible to perform various searches on the metadata content, from simple to complex: add criteria, and combine them using drag and drop.";

$lang['g003_personnal_page_help']="You can easily build your own metadata from existing metadata.
[ul]
[li]Add a new metadata[/li]
[li]Fill properties[/li]
[li]Add rules and combine them if necessary by drag'n'drop[/li]
[/ul]";

$lang['g003_select_page_help']="Only metadata selected here are available in other interfaces configuration: this allows to reduce the list of metadata to those that seem most relevant to your use.
The selection is applied immediately (it is not necessary to validate).";


$lang['g003_display_page_help']="The metadata posted with the photo can be sorted and grouped.
By default, only the group [i]".$lang['g003_default_group_name']."[/i] is available, but it is possible to create as many as necessary ([i]IPTC[/i], [i]Geolocation[/i], ...).
[ul]
[li]Create groups of metadata according to your needs[/li]
[li]Add the metadata to display[/li]
[li]Within a group, sort the display order of metadata by drag'n'drop[/li]
[li]Sort the display order of groups by drag'n'drop[/li]
[/ul]
Selection and sorting are applied immediately (it is not necessary to validate).";

$lang['g003_gpc_not_up_to_date']="It is necessary for the plugin that the <i>Grum Plugin Classes</i> version %s is installed.
Currently, version %s is installed: please proceed with the update version of the plugin <i>Grum Plugin Classes</i>.";



/** ----------------------------------------------------------------------------
 * new keys from releases 0.5.3
 *
 *
 * need to be translated
 * thanks :)
 */
$lang['g003_1_picture_in_caddie']="1 picture in caddie";
$lang['g003_n_pictures_in_caddie']="%s pictures in caddie";
$lang['g003_analyze_random_pictures'] = "The analysis focuses on %s images selected randomly among images that have never been analyzed, and adds to the existing repository";
$lang['g003_invalid_random_number']="The number of images to process is not valid";


$lang['g003_database_is_not_up_to_date']="The repository is not up do date !";
$lang['g003_databaseWarning2_1']="[p]A new metadata is available since the last update of the plugin:[/p][ul]%s[/ul]
[p]
To be exploited, it is necessary to update the repository.[/p]";
$lang['g003_databaseWarning2_n']="[p]Some new metadatas are available since the last update of the plugin:[/p][ul]%s[/ul]
[p]
To be exploited, it is necessary to update the repository.[/p]";

// help for metadata translation is given at the beginning of this file

?>
