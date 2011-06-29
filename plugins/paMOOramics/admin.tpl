<div class="titrePage">
  <h2>paMOOramics</h2>
</div>
<p>


{'pamooramics_description'|@translate} :<br />
<a href="http://www.silverscripting.com/pamoorama/index.php">PAMOORAMA</a> ({'pamooramics_by'|@translate} SilverTab)
{'pamooramics_and'|@translate} <a href="http://www.mootools.net/">MOOTOOLS</A><br/>

<br/>


</p>
<form method="post" action="{$TESTPLUGIN_F_ACTION}" class="general">
 <fieldset id="paMOOfieldset">
  <legend>{'pamooramics_admin_form_legend'|@translate}</legend>
  <div id="colorpicker"></div>
  <table id="paMOOtable">
   <tr>
    <td class="paMOOlabel">{'pamooramics_use_name'|@translate}</td>
    <td><input type="radio" id="paMOOramics_mode" name="paMOOramics_mode" value="modename" {$PAMOORAMICS_USENAME} /></td>
   </tr>
   <tr>
    <td class="paMOOlabel">{'pamooramics_name'|@translate}</td>
    <td><input type="text" class="paMOOfield" name="paMOOramics_name" value="{$PAMOORAMICS_NAME}" width="200px;"/></td>
   </tr>
  <tr>
    <td class="paMOOlabel">{'pamooramics_use_ratio'|@translate}</td>
    <td><input type="radio" id="paMOOramics_mode" name="paMOOramics_mode"  value="moderatio" {$PAMOORAMICS_USERATIO} /></td>
   </tr>
   <tr>
    <td class="paMOOlabel">{'pamooramics_ratio'|@translate}</td>
    <td><input type="text" class="paMOOfield" name="paMOOramics_ratio" value="{$PAMOORAMICS_RATIO}" /></td>
   </tr>

   <tr>
    <td class="paMOOlabel">{'pamooramics_width'|@translate}</td>
    <td><input type="text" name="paMOOramics_width" class="paMOOfield" value="{$PAMOORAMICS_WIDTH}" /> px</td>
   </tr>

   <tr>
    <td class="paMOOlabel">{'pamooramics_border_size'|@translate}</td>
    <td><input type="text" name="paMOOramics_border" class="paMOOfield" value="{$PAMOORAMICS_BORDER}" /> px</td>
   </tr>

   <tr>
    <td class="paMOOlabel">{'pamooramics_border_color'|@translate}</td>
    <td><input type="text" name="paMOOramics_bordercolor" id="paMOOramics_bordercolor" class="paMOOfield colorwell" value="{$PAMOORAMICS_BORDERCOLOR}" /></td>
   </tr>

   <tr>
    <td class="paMOOlabel">{'pamooramics_footer_color'|@translate}</td>
    <td><input type="text" name="paMOOramics_footercolor" id="paMOOramics_footercolor" class="paMOOfield colorwell" value="{$PAMOORAMICS_FOOTERCOLOR}" /></td>
   </tr>

   <tr>
    <td class="paMOOlabel">{'pamooramics_caption_color'|@translate}</td>
    <td><input type="text" name="paMOOramics_captioncolor" id="paMOOramics_captioncolor" class="paMOOfield colorwell" value="{$PAMOORAMICS_CAPTIONCOLOR}" /></td>
   </tr>


   <tr>
    <td class="paMOOlabel">{'pamooramics_autoscroll_speed'|@translate}</td>
    <td><input type="text" name="paMOOramics_autoscrollSpeed" class="paMOOfield" value="{$PAMOORAMICS_AUTOSCROLLSPEED}" /> ms</td>
   </tr>

   <tr>
    <td class="paMOOlabel">{'pamooramics_activateslider'|@translate}</td>
    <td><input type="checkbox" name="paMOOramics_activateSlider" id="paMOOramics_activateSlider" {$PAMOORAMICS_ACTIVATESLIDER} /></td>
   </tr>

   <tr>
    <td class="paMOOlabel">{'pamooramics_enable_autoscroll'|@translate}</td>
    <td><input type="checkbox" name="paMOOramics_enableAutoscroll" id="paMOOramics_enableAutoscroll" onClick="Pamooscript()" {$PAMOORAMICS_ENABLEAUTOSCROLL} /></td>
   </tr>

   <tr>
    <td class="paMOOlabel">{'pamooramics_autoscroll_onload'|@translate}</td>
    <td><input type="checkbox" id="paMOOramics_autoscrollOnLoad" name="paMOOramics_autoscrollOnLoad" {$PAMOORAMICS_AUTOSCROLLONLOAD} /></td>
   </tr>

   <tr>
       <td class="paMOOlabel">{'pamooramics_displayfooter'|@translate}</td>
       <td><input type="checkbox" id="paMOOramics_displayfooter" name="paMOOramics_displayfooter" onClick="if (this.checked) {ldelim}document.getElementById('paMOOramics_activateSlider').checked=true;}" {$PAMOORAMICS_DISPLAYFOOTER} /></td>
   </tr>
   <tr>
   		<td class="paMOOlabel">{'pamooramics_Slideshow_displayfooter'|@translate}</td>
     	<td><input type="checkbox" name="pamooramics_Slideshow_displayfooter" id="pamooramics_Slideshow_displayfooter" {$PAMOORAMICS_SLIDE_DISPLAYFOOTER} /></td>
   </tr>
  </table>
 </fieldset>








 <p><input type="submit" value="{'pamooramics_save_config'|@translate}" name="submit" /></p>
</form>

<script type="text/javascript" charset="utf-8">
 $(document).ready(function() {ldelim}
     var f = $.farbtastic('#colorpicker');
     var selected;
     $('.colorwell')
       .each(function () {ldelim} f.linkTo(this);  })
       .focus(function() {ldelim}
       	f.linkTo(this);

       });
  });
function Pamooscript(){ldelim}
  	if (!document.getElementById("paMOOramics_enableAutoscroll").checked) {ldelim}
  		document.getElementById("paMOOramics_autoscrollOnLoad").disabled=true;
  		document.getElementById("paMOOramics_autoscrollOnLoad").checked=false;
  	}
  	else {ldelim}
  		document.getElementById("paMOOramics_autoscrollOnLoad").disabled=false;
  	}
}

</script>
