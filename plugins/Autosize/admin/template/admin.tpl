{if PHPWG_VERSION < 2.2 } 
{include file=$AUTOSIZE_PATH_ABS|@cat:'admin/template/header_2_1.tpl'}
{else} 
{include file= $AUTOSIZE_PATH_ABS|@cat:'admin/template/header_2_2.tpl'}
{/if} 
{html_head}
{literal}
<style type="text/css">
.td_autosize {
  width: 25%;
  font-style: italic;  
}
</style>
{/literal}
<script type="text/javascript">
    var src_img = '{$SRC_IMG}';
    var fade_in = '{$fade_in}';

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
 

 
   
{/html_head}

{* $Id: autosize admin.tpl  *}
 <!--- HEAD autosize TPL --->

{literal}
<script type="text/javascript">

jQuery().ready(function(){ 
  jQuery('.cluetip').cluetip({ 
    width: 300,
    splitTitle: '|'    ,
    clickThrough: true
  });
});

</script>
{/literal}
<!--============== assign visible =======================-->	
{assign var="affiche_cde" value="true"}
{if $affiche_cde == "true"}
  {assign var="visible" value="block"}
{else}
  {assign var="visible" value="none"}
{/if}
{if $check_auto_w == true} 
     {assign var="visible_w" value="visible"}
  {else}
     {assign var="visible_w" value="hidden"}
{/if}
<div class="titrePage">
		<h2>{'Autosize'|translate} {'version'|translate} {$cl_version}</h2>
</div>
  <span>{'cl_autosize_Howto'|translate}</span>



<!--============== !DIV ==={$IMG_WIDTH  }=={$IMG_HEIGHT  }======-->	
<table >
  <form action="" method="post" name="form_autosize" id="form_autosize"    >

  <table id="table0" style=" background:none;border:outset;width:90%; z-index:-500 " >
    <fieldset>
  	<legend class="cluetip" title="{'cl_autosize_config_title_1'|@translate}|{'cl_autosize_hlp_line1'|@translate}">{'cl_autosize_config_title_1'|@translate}</legend>
        <td class="td_autosize pluginBox">{'User status'|@translate}</td>
        <td class="td_autosize pluginBox">{'cl_autosize_height'|@translate}</td>
        <td class="td_autosize pluginBox">{'cl_autosize_width'|@translate}
         <input type="checkbox" id="check_auto_w" name="check_auto_w" value="on"  {$check_auto_w}  /></td>
         <td class="td_autosize pluginBox">{'cl_autosize_enabled'|@translate}</td>

        <tr name="webmaster_enabled">
        <td>{'user_status_webmaster'|@translate}</td>
        <td><input name="webmaster_height" id="Text7" type="text"  value ="{$webmaster_height}" /></td>
        <td><input name="webmaster_width" id="webmaster_width" type="text" value="{$webmaster_width}" /></td>
         <td ><input name="webmaster_enabled" id="webmaster_enabled" type="checkbox"  value ="on" {$webmaster_enabled}  /></td>
        </tr>
        <tr name="admin_enabled">
        <td>{'user_status_admin'|@translate}</td>
        <td><input name="admin_height" id="admin_height" type="text"  value ="{$admin_height}" /></td>
        <td ><input name="admin_width" id="admin_width" type="text"  value ="{$admin_width}" /></td>
        <td ><input name="admin_enabled" id="admin_enabled" type="checkbox"  value ="on" {$admin_enabled} /></td>
        </tr>
        <tr name="generic_enabled">
        <td>{'user_status_generic'|@translate}</td>
        <td><input name="generic_height" id="Text1" type="text"  value ="{$generic_height}" /></td>
        <td><input name="generic_width" id="generic_width" type="text"  value ="{$generic_width}" /></td>
        <td ><input name="generic_enabled" id="generic_enabled" type="checkbox"  value ="on" {$generic_enabled} /></td>
        </tr>
        <tr name="guest_enabled">
        <td>{'user_status_guest'|@translate}</td>
        <td><input name="guest_height" id="Text3" type="text"  value ="{$guest_height}" /></td>
        <td><input name="guest_width" id="guest_width" type="text"  value ="{$guest_width}" /></td>
         <td ><input name="guest_enabled" id="guest_enabled" type="checkbox"  value ="on" {$guest_enabled} /></td>
        </tr>
        <tr name="normal_enabled">
        <td>{'user_status_normal'|@translate}</td>
        <td><input name="normal_height" id="Text5" type="text"  value ="{$normal_height}" /></td>
        <td><input name="normal_width" id="normal_width" type="text"  value ="{$normal_width}" /></td>
        <td ><input name="normal_enabled" id="normal_enabled" type="checkbox"  value ="on" {$normal_enabled} /></td>
        </tr>

  </fieldset>

  </table>

<br />
 <table id="table_d" style=" background:none;border:outset;width:90%; z-index:-500 " >
   <fieldset>
  	<legend class="cluetip" title="{'cl_autosize_config_title_2'|@translate}|{'cl_autosize_hlp_line2'|@translate}">{'cl_autosize_config_title_2'|@translate}</legend>

    <!--======== Dimensions HL ===================-->	
    <tr> 
      <td class="cluetip" title="{'cl_autosize_miniheight'|@translate}|{'cl_autosize_hlp_line3'|@translate}" >{'cl_autosize_miniheight'|translate}</td>
      <td ><input name="mini_height" id="mini_height" type="text"  value ="{$MINI_HEIGHT}" /> px 
           </td> 
	 
     <td class="cluetip" title="{'cl_autosize_miniwidth'|translate}|{'cl_autosize_hlp_line3'|@translate}"  > {'cl_autosize_miniwidth'|translate}</td>
   <td  >
    <input name="mini_width"  id="mini_width" type="text" value =  "{$MINI_WIDTH}" /> px
       </tr>
    <!--======== Dimensions HL2 ===================-->	
    <tr> 
      <td class="cluetip" title="{'cl_autosize_miniheight2'|@translate}|{'cl_autosize_hlp_line32'|@translate}" >{'cl_autosize_miniheight2'|translate}</td>
      <td ><input name="mini_height2" id="Text2" type="text"  value ="{$MINI_HEIGHT2}" /> px 
           </td> 
	 
     <td class="cluetip" title="{'cl_autosize_miniwidth2'|translate}|{'cl_autosize_hlp_line32'|@translate}"  > {'cl_autosize_miniwidth2'|translate}</td>
   <td  >
    <input name="mini_width2"  id="Text4" type="text" value =  "{$MINI_WIDTH2}" /> px
       </tr>
   <!--======== Positions  ===================-->	
<tr >
 <td class="cluetip" title="{'cl_autosize_echelle_max'|translate}|{'cl_autosize_hlp_line4'|@translate}" > {'cl_autosize_echelle_max'|translate}</td>
 <td  >
 <input name="echelle_max" id="echelle_max"  type="text" value ="{$ECHELLE_MAX}" /> 
 </td>
 
</tr>

<tr >  
<td class="cluetip" title="{'cl_autosize_marge_basse'|translate}|{'cl_autosize_hlp_line5'|@translate}" > {'cl_autosize_marge_basse'|translate}</td>
<td><input name="marge_basse" id="marge_basse"  type="text" value ="{$MARGE_BASSE}" /> px</td>

</tr>		  
<tr >  
<td class="cluetip" title="{'cl_autosize_fade_in'|translate}|{'cl_autosize_hlp_fade_in'|@translate}" > {'cl_autosize_fade_in'|translate}</td>
<td><input name="fade_in" id="fade_in"  type="text" value ="{$fade_in}" /> </td>

</tr>	
  <!--======================================================================================-->	
     <tr >
	 
	 </tr>


  </fieldset>
 </table>
 <!--=================== Bloc choix =============================-->	 
 <table>
  <tr><td style="visibility:visible">{'cl_autosize_icon_view'|@translate}
         <input type="checkbox" name="check_icon_v" value="on"  {$check_icon_v}  />
  </td>
  <td>{'cl_autosize_desc_view'|@translate}
         <input type="checkbox" name="check_desc_v" value="on"  {$check_desc_v}  />
  </td>
  <td>
  </td>
  
  </tr>
</table>
 
  <table>
  <td><input name="submit" type="submit" value="{'cl_autosize_save'|@translate}" /></td>
</table> 
</form>
 
 </table >                
 
 
