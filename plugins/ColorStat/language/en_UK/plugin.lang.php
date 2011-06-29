<?php

$lang['Grum Plugin Classes is not installed'] = 'The plugin <b>Grum Plugin Classes</b> is not installed';

$lang['cstat_release'] = 'v';
$lang['cstat_ok']='OK';

$lang['cstat_install'] = 'Installation';
$lang['cstat_step_1'] = 'Choice of reference color';
$lang['cstat_step_1_help'] = "
The analysis performed by the plugin is to perform, for each color found in an image, a comparison with a color belonging to a defined range.
Before you can use the plugin, it is necessary to select the range on which to work.

Two ranges are offered:";
$lang['cstat_small_colortable'] = 'Narrow range';
$lang['cstat_large_colortable'] = 'Extended range';
$lang['cstat_help_small_color_table'] = "
Working with a limited range of colors increases the probability of reference tones minority. This has the advantage of allowing searches on wider range of colors.

In return, the variation of shades is smaller, the relevance of results when searching on a particular color can be very convincing.";
$lang['cstat_help_large_color_table'] = "
Working on a wide range of colors can have an increased number of grades to a given color. This has the advantage of allowing more precise queries on a range of colors more accurately and thus increase the relevance of results.

In return, an image with one or two shades predominantly present, the variation of the nuances of these consequences will greatly reduce the probability of reference colors minority.";
$lang['cstat_sample_color_associated'] = 'Colors of the associated range:';
$lang['cstat_color'] = 'Color';
$lang['cstat_validate'] = 'Submit';


$lang['cstat_database'] = 'Repository';
$lang['cstat_loading'] = 'Loading...';
$lang['cstat_update_color_database']= 'Update the repository of colors';
$lang['cstat_status_of_database']='State of repository';
$lang['cstat_analyze_not_analyzed_pictures'] = "The analysis focuses on the images that have never been analyzed, and adds to the existing repository";
$lang['cstat_analyze_all_pictures'] = "The analysis includes all the images in the gallery, and replaces the current repository";
$lang['cstat_analyze_caddie_add_pictures'] = "The analysis focuses on the images in the basket, and adds to the existing repository";
$lang['cstat_analyze_caddie_replace_pictures'] = "The analysis focuses on the images in the basket, and replaces the current repository";
$lang['cstat_analyze'] = "Analyze";
$lang['cstat_need_to_analyze'] = "To have a reference color, it is necessary to conduct a direct analysis of the gallery:";
$lang['cstat_warning_on_analyze_0'] = "Warning !";
$lang['cstat_warning_on_analyze_1'] = "Building the repository with the direct analysis process might be long (up to several minutes of treatment) and resource-consuming for the server, depending on the number of photos selected for analysis.";
$lang['cstat_warning_on_analyze_2'] = "This type of use may be penalized by some hosts.";

$lang['cstat_updating_database']="Update repository";
$lang['cstat_numberOfAnalyzedPictures']="%d images have been analyzed";
$lang['cstat_numberOfNotAnalyzedPictures']="%d images have not been analyzed";
$lang['cstat_numberOfPicturesInError']="%d images could not be analyzed (processing error)";

$lang['cstat_analyze_in_progress']="Analyze in progress...";
$lang['cstat_analyze_is_finished']="Analyze completed";

$lang['cstat_stat']='Statistics';
$lang['cstat_statistics']='Statistical analysis';
$lang['cstat_number_of_colors_used']='Number of colors used:';


$lang['cstat_colors']='Colors';
$lang['cstat_Pct']='%';
$lang['cstat_NumOfImages']='Number of images';
$lang['cstat_NumOfPixels']='Number of pixels';
$lang['cstat_NumOfImages_help']="Indicates the number of images in which color is present.<br>The percentage is relative to the number of images analyzed.";
$lang['cstat_NumOfPixels_help']="Indicates the number of pixels for which color has been determined.<br>The percentage is relative to the number of pixels analyzed and represents the 'area' occupied on all photos.";
$lang['cstat_images']='images';
$lang['cstat_surface']='surface';




$lang['cstat_search']='Search';
$lang['cstat_search_by_color']='Search by color';
$lang['cstat_choose_colors']='Panel of colors';
$lang['cstat_choosen_colors']='Selected colors';
$lang['cstat_operator_and']="All selected colors must be present in the pictures";
$lang['cstat_operator_or']="At least one selected colors must be present in the pictures";
$lang['cstat_operator_not']="None of the selected colors should be present in the image";
$lang['cstat_color_already_choosen']='The color is already selected in the list';
$lang['cstat_add_colors']='Add a selection of colors';


$lang['cstat_config']='Configuration';
$lang['cstat_gallery_integration']='Gallery integration';
$lang['cstat_apply']='Apply';
$lang['cstat_stat_and_search']='Statistics & Research';
$lang['cstat_save_config']='Configuration is saved';
$lang['cstat_display_colors_on_image']='View colors associated with the image';
$lang['cstat_percent_min_significant']='Minimum presence in an image to consider a color is relevant in a search:';
$lang['cstat_config_plugin']='Configuring the plugin';
$lang['cstat_gallery_display_colors'] = 'Display colors of image';
$lang['cstat_color_size'] = 'Dimensions';
$lang['cstat_significant_colors'] = 'Relevance colors';
$lang['cstat_bench'] = 'Measuring performance';
$lang['cstat_do_bench'] = 'Measure';
$lang['cstat_do_benchmark'] = "Depending on server performance, analysis of images of the gallery can be more or less long. <br>
It is possible to adjust the plugin to emphasize the speed of analysis at the expense of quality, or conversely, focusing on the quality of analysis at the expense of speed. <br>

The measure reflects performance computing capabilities at a given time, which may vary depending on server load: the estimated time of treatment is indicative only and vary slightly depending on available resources.
";
$lang['cstat_quality_of_analyze'] = 'Quality analysis';
$lang['cstat_quality_level']='Quality';
$lang['cstat_estimated_time_one_picture']='Estimated time for an image';
$lang['cstat_estimated_time_all_pictures']='Estimated time for all images';
$lang['cstat_quality_highest']='Very high';
$lang['cstat_quality_high']='High';
$lang['cstat_quality_normal']='Normal';
$lang['cstat_quality_low']='Low';
$lang['cstat_quality_lowest']='Very low';

$lang['cstat_colors_on_image']='Colors associated with the image';

// new keys from release 1.0.2
$lang['cstat_gpc_not_up_to_date']="Version %s of plugin <i>Grum Plugin Classes</i> is required.
Actually, the version %s is installed : thanks to upgrade the <i>Grum Plugin Classes plugin</i>.";


?>
