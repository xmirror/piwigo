{if not empty($pamoorama)}
  <script  id="pamoorama0.3" src="plugins/paMOOramics/js/pamoorama0.3.js" type="text/jscript"></script>
  <script id="mootools" src="plugins/paMOOramics/js/mootools.js" type="text/jscript"></script>
{else}
{/if}
{combine_script id="conflit_script0" load="header" path = $AUTOSIZE_PATH|@cat:"js/conflit_2.js" require="jquery" }
{* au cas ou jquery non défini  *}



{combine_script id="conflit_script"  path = $AUTOSIZE_PATH|@cat:"js/conflit.js" require="jquery" }
{combine_script id="jquery.cluetip" path = "themes/default/js/plugins/jquery.cluetip.js" require="jquery" }
{combine_script id="autosize.dimensions" path = $AUTOSIZE_PATH|@cat:"js/autosize.dimensions.js" require="jquery"}
{combine_script id="autosize.cookie" path = $AUTOSIZE_PATH|@cat:"js/autosize.cookie.js" require="jquery"}


{combine_script id="conflit_script2" load="async" path = $AUTOSIZE_PATH|@cat:"js/conflit_2.js" require="jquery" }

 
