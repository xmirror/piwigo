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

$lang['Grum Plugin Classes is not installed'] = '<b>Grum Plugin Classes</b> plugin is not installed';

$lang['amd_title_page'] = 'Metadata advanced management';
$lang['g003_version'] = 'v';

$lang['g003_error_invalid_ajax_call'] = "Invalid function call!";

$lang['g003_metadata'] = "Metadata";
$lang['g003_database'] = "Repository";
$lang['g003_status'] = "Status";
$lang['g003_show'] = "Browse";

$lang['g003_numberOfAnalyzedPictures'] = "%d images have been analyzed and %d metada have been found";
$lang['g003_numberOfNotAnalyzedPictures'] = "%d images have not been analyzed";
$lang['g003_analyze_not_analyzed_pictures'] = "The analysis focuses on the images that have never been analyzed, and adds to the existing repository";
$lang['g003_analyze_all_pictures'] = "The analysis includes all the images in the gallery, and replaces the current repository";
$lang['g003_analyze_caddie_add_pictures'] = "The analysis focuses on the images in the caddie, and adds to the existing repository";
$lang['g003_analyze_caddie_replace_pictures'] = "The analysis focuses on the images in the caddie, and replaces the current repository";
$lang['g003_analyze'] = "Analyze";
$lang['g003_update_metadata'] = "Update metadata repository";
$lang['g003_status_of_database'] = "Repository status";
$lang['g003_updating_metadata'] = "Repository update";
$lang['g003_analyze_in_progress'] = "Analyze in progress...";
$lang['g003_analyze_is_finished'] = "Analyze completed";
$lang['g003_loading'] = "Loading...";
$lang['g003_numberOfPicturesWithoutTags'] = "%d images have no metadata";
$lang['g003_no_items_selected'] = "No metadata is selected";
$lang['g003_selected_tag_isnot_linked_with_any_picture'] = "The selected metadata is not linked to any image";
$lang['g003_TagId'] = "Metadata";
$lang['g003_TagLabel'] = "Name";
$lang['g003_NumOfImage'] = "Images";
$lang['g003_Pct'] = "%";
$lang['g003_select'] = "Selection";
$lang['g003_display'] = "Display";
$lang['g003_order'] = "Order by";
$lang['g003_filter'] = "Filter";
$lang['g003_tagOrder'] = "Metadata";
$lang['g003_numOrder'] = "Image number";
$lang['g003_valueOrder'] = "Value";
$lang['g003_no_filter'] = "No filter";
$lang['g003_magic_filter'] = "Magic (calculated metada)";
$lang['g003_exclude_unused_tags'] = "Exclude unused metadata";
$lang['g003_Value'] = "Value";
$lang['g003_selected_tags_only'] = "Return selected metadata only";

$lang['g003_select_metadata'] = "Metadata selection";
$lang['g003_display_management'] = "Metadata display management";
$lang['g003_number_of_filtered_metadata'] = "Metadata number:";
$lang['g003_number_of_distinct_values'] = "Number of distinct values:";

$lang['g003_click_to_edit_group'] = "Click to edit properties of the metadata group";
$lang['g003_click_to_delete_group'] = "Click to remove the metadata group";
$lang['g003_click_to_manage_group'] = "Click to manage elements of the metadata group";
$lang['g003_click_to_manage_list'] = "Click to add/remove metadata";
$lang['g003_add_a_group'] = "Add a group of metadata";
$lang['g003_adding_a_group'] = "Adding a group of metadata";
$lang['g003_editing_a_group'] = "Editing a group of metadata";
$lang['g003_deleting_a_group'] = "Removing a group of metadata";
$lang['g003_new_group'] = "New metadata group";
$lang['g003_name'] = "Name";
$lang['g003_add_delete_tags'] = "Add/remove metadata";
$lang['g003_confirm_group_delete'] = "Are you sure you want to delete the %s metadata group?";
$lang['g003_default_group_name'] = "Shooting conditions";

$lang['g003_ok'] = "Ok";
$lang['g003_cancel'] = "Cancel";
$lang['g003_yes'] = "Yes";
$lang['g003_no'] = "No";


$lang['g003_invalid_group_id'] = "Invalid metadata group Id";
$lang['g003_no_tag_can_be_selected'] = "No metadata available";


$lang['g003_warning_on_analyze_3'] = "The repository is gradually fed each time a page of the gallery is visited. Thus the time required for its complete making depends from:";
$lang['g003_warning_on_analyze_3a'] = "the number of pictures in the gallery";
$lang['g003_warning_on_analyze_3b'] = "the number of pictures displayed every day";
$lang['g003_warning_on_analyze_5'] = "In order to get a complete repository quickly, a more complete analyze of the gallery is possible:";
$lang['g003_warning_on_analyze_0'] = "Warning!";
$lang['g003_warning_on_analyze_1'] = "Building the repository with the direct analysis process might be long (up to several minutes of treatment) and resource-consuming for the server, depending on the number of photos selected for analysis.";
$lang['g003_warning_on_analyze_2'] = "This type of use may be penalized by some hosts.";



$lang['g003_metadata_detail'] = "Possible values for the metadata";

$lang['g003_help'] = "Help on metadata";
$lang['g003_help_tab_exif'] = "Exif";
$lang['g003_help_tab_iptc'] = "IPTC";
$lang['g003_help_tab_xmp'] = "XMP";
$lang['g003_help_tab_magic'] = "Magic";
$lang['g003_help_exif'] = "EXIF Metadata is information stored in the image file by the camera at shooting.


The information there are mainly technical:
[ul]
[li]equipment used (camera model, maker)[/li]
[li]shooting conditions (aperture, exposure time, focal length)[/li]
[li]time of the shooting (date, time)[/li]
[li]geographic location (GPS coordinates)[/li]
[li]information on the photo format (size, resolution, compression)[/li]
[/ul]

EXIF metadata is standardized ([url]http://www.exif.org/Exif2-2.PDF[/url]), but :
[ul]
[li]This standard established by the [url=http://www.jeita.or.jp]JEITA[/url] (Japan Electronics and Information Technology Industries Association) has no longer changed since 2002[/li]
[li]each metadata defined in the standard is optional, so not all cameras feed all metadata[/li]
[li]a [i]MakerNote[/i] metadata exists as an open field used by manufacturers to store information missing from the specifications (eg, lenses references); this data are specific to each manufacturer, sometimes for each camera. The plugin knows how to render some of this information for [b]Pentax[/b], [b]Canon[/b] and [b] Nikon [/b] cameras.[/li]
[/ul]";

$lang['g003_help_iptc'] = "IPTC Metadata consists of information the photographer can record in the image with an appropriate software.

Information there is mainly oriented towards the professional world:
[ul]
[li]photographer references (name, contact)[/li]
[li]information on the Copyright[/li]
[li]description of the picture (title, description, reviews, tags)[/li]
[li]various information related to the professional world[/li]
[/ul]

IPTC metadata is standardized ([url]http://www.iptc.org[/url]).
This standard has been established by a consortium of major news agencies in the world, the [i]International Press Telecommunications Council [/i] (IPTC).
[li] information on the format of the photo (size, resolution, compression)";
$lang['g003_help_xmp'] = "XMP metadata are essentially EXIF and IPTC metadata that have been stored image file using XML format.

XMP metadata provide more flexibility:
[ul]
[li]information can be stored in several different languages[/li]
[li]usage of the Unicode character set allows (mainly) to use non-Latin characters[/li]
[li]XML facilitates the interpretation and exchange of information[/li]
[/ul]

XMP metadata is standardized ([url]http://www.metadataworkinggroup.org/specs[/url]).
The standard advises to use preferably the EXIF and IPTC metadata, if present.

EXIF & IPTC metadata conversion to XMP metadata is usually done with a photo editing software.

As XMP model is poorer than EXIF, this conversion will result in information loss in the picture. Usually the lost information is not too important for most users; however, the standard recommends that the software recording XMP metadata retain the original metadata: unfortunately, that is not always the case.";
$lang['g003_help_magic'] = "The same information can be stored within a photo in multiple formats:
[ul]
[li]it may exist in every format[/li]
[li]it may be present in one format but not in another one[/li]
[/ul]

For example, the aperture may be present in 4 different metadata:
[ul]
[li][b]exif.exif.FNumber[/b][/li]
[li][b]exif.exif.ApertureValue[/b][/li]
[li][b]xmp.exif:ApertureValue[/b][/li]
[li][b]xmp.exif:FNumber[/b][/li]
[/ul]

To facilitate the rendering of information that may be scattered, the plugin provides a small group of the most used metadata, and takes on the analyze of those present in the picture to return the most relevant information.
These are called [b]Magic[/ b] metadata.

Thus, the [b]magic.ShotInfo.Aperture[/b] metadata returns:
[ul]
[li]if present in the photo, the value of the [b]exif.exif.FNumber[/b] metadata, otherwise [/li]
[li]if present in the photo, the value of the [b]xmp.exif: FNumber[/b]metadata, otherwise [/li]
[li]if present in the photo, the value of the [b]exif.exif.ApertureValue[/b] metadata, otherwise [/ li]
[li]if present in the photo, the value of the [b]xmp.exif: ApertureValue[/b] metadata.[/li]
[/ul]";


/** ----------------------------------------------------------------------------
 * new keys from releases 0.5.0/0.5.1
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
 * removed keys from releases 0.5.0/0.5.1
 */
//$lang['g003_warning_on_analyze_4a']
//$lang['g003_warning_on_analyze_4b']



/** ----------------------------------------------------------------------------
 * new keys from releases 0.5.3
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
