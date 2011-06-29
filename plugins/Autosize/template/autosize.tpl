 {* $Id: autosize/template/autosize.tpl  *}
{html_head} <!-- autosize/template/autosize.tpl  -->
 <script type="text/javascript">
    var src_img = '{$SRC_IMG}';
    var fade_in = '{$fade_in}';
    var cl_visible = "{$cl_visible}" =="true";
    var thumbnail = '{$thumbnail}';
    var scaled_width =  '{$SCALED_WIDTH}'; // valeur par defaut
    var scaled_height = '{$SCALED_HEIGHT}'; // valeur par defaut
    var img_width='{$IMG_WIDTH }';
    var img_height = '{ $IMG_HEIGHT }';

    var marge_basse='{ $MARGE_BASSE }';
    var echelle_max='{ $ECHELLE_MAX }';
    var mini_width='{ $MINI_WIDTH   }';
    var mini_height = '{ $MINI_HEIGHT   }';
    var mini_width2 = '{ $MINI_WIDTH2 }';
    var mini_height2 = '{ $MINI_HEIGHT2 }';

    var webmaster_width='{$webmaster_width   }';
    var webmaster_height = '{ $webmaster_height   }';
    var webmaster_enabled = '{ $webmaster_enabled   }';

    var admin_width='{ $admin_width   }';
    var admin_height = '{ $admin_height   }';
    var admin_enabled = '{ $admin_enabled   }';

    var generic_width='{ $generic_width   }';
    var generic_height = '{ $generic_height   }';
    var generic_enabled = '{ $generic_enabled   }';

    var guest_width='{ $guest_width   }';
    var guest_height = '{$guest_height}';
    var guest_enabled = '{ $guest_enabled   }';

    var normal_width='{$normal_width}';
    var normal_height = '{$normal_height}';
    var normal_enabled = '{ $normal_enabled   }';

    var user_status='{$user_status}';
   
    var check_auto_w = '{$check_auto_w}';
     
    var check_desc_v = ('{$check_desc_v}' == 'checked="checked"') ? true : false; 
 </script>

<link href="{$AUTOSIZE_PATH}css/autosize.css" rel="stylesheet" type="text/css" />
 <!--  << autosize/template/autosize.tpl   --> 

<script type="text/javascript">
       var visible = '{$visible}';
   </script>
{if $DEBUG_autosize == "true"}
  {assign var="visible" value="block"}
<!---  autosize/template/autosize.tpl  body --->
<style type="text/css">
    {literal}
.debug {
    display: inline-block; 
    width: 45px; 
    height: 45px; 
    background-color: black; 
    margin: 2px; 
}
.debugOn {
    background-color: yellow; 
    border: solid 1px black;
    width: 43px; 
    height: 43px; 
}

.jssource {font-size:.8em;color:#000; }
pre {font-size:.9em;background-color:#ffc;overflow-x:auto; padding: 5px;}
pre em {color:#009;}
pre b {color:#900;}
pre strong {color:#099;}
pre i,
pre i *{color:#090;}

</style>


<div id="Debug0"  align=center style="color:black;z-index:2000;position:absolute; background-color:Beige; top:0px;left:0px;width:800px;margin:auto;"></div>
<div id="Debug1"  align=center style="color:black;z-index:2000;position:absolute; background-color:Beige; top:0px;left:0px;width:800px;margin:auto;"></div>
<div id="Debug2"  align=center style="color:black;z-index:2000;position:absolute; background-color:yellow; top:0px;left:0px;width:800px;margin:auto;"></div>
<div id="Debug3"  align=center style="color:black;z-index:2000;position:absolute; background-color:blue; top:0px;left:0px;width:800px;margin:auto;"></div>
<div id="Debug4"  align=center style="color:black;z-index:2000;position:absolute; background-color:green; top:0px;left:0px;width:800px;margin:auto;"></div>
<div id="Debug5"  align=center style="color:black;z-index:2000;position:absolute; background-color:red; top:100px;left:0px;width:300px;margin:auto;"></div>
 
<p><button id="adddebugs">Add a debug</button></p>

<div id="debugsContainer"><div class="debug"></div></div>
    {/literal}
    {else}
  {assign var="visible" value="none"} 
  {/if}

  {/html_head}
  <!--  << autosize/template/autosize.tpl body  -->
