{get_combined_scripts load='header'}
{combine_script id="jquery" load="header" path = "themes/default/js/jquery.min.js"}
{combine_script id="jquery.cluetip" path = "themes/default/js/plugins/jquery.cluetip.js" require="jquery" }
{combine_script id="conflit_script" path = $AUTOSIZE_PATH|@cat:"js/conflit.js" require="jquery"}
{combine_script id="dimensions" path = $AUTOSIZE_PATH|@cat:"js/autosize.dimensions.js" require="jquery"}

