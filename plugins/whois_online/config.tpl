<div class="titrePage">
	<h2>Whois Online</h2>
</div>
 
<form method="post" action="{$F_ACTION}" class="Whois_Online properties {$themeconf.name}">

{if $page == 'config'}
<fieldset>
	<legend>{'Options'|@translate}</legend>

	<ul>
		<li>
			<span class="property">{'Active capture'|@translate}</span>
			<input type="radio" value="1" name="Active" {if ($Option.Active==1)} checked="checked" {/if}/>{'Yes'|@translate}
			<input type="radio" value="0" name="Active" {if ($Option.Active==0)} checked="checked" {/if}/>{'No'|@translate}
		</li>
		<li>
			<span class="property">{'Delete level [10-200] (ratio between obsolete and active)'|@translate}</span>
			<input type="text" id="Level" maxlength="3" size="8" name="Level" value="{$Option.Level}" />
		</li>
		<li>
			<span class="property">{'Obsolete limit [20-100] (obsolete data count)'|@translate}</span>
			<input type="text" id="Limit" maxlength="3" size="8" name="Limit" value="{$Option.Limit}" />
		</li>
		<li>
			<span class="property">{'Add link to Plugins menu'|@translate}</span>
			<input type="radio" value="1" name="Plugins_menu" {if ($Option.Plugins_menu==1)} checked="checked" {/if}/>{'Yes'|@translate}
			<input type="radio" value="0" name="Plugins_menu" {if ($Option.Plugins_menu==0)} checked="checked" {/if}/>{'No'|@translate}
		</li>
		<li>
			<span class="property">{'Add icon to History'|@translate}</span>
			<input type="radio" value="1" name="History_icon" {if ($Option.History_icon==1)} checked="checked" {/if}/>{'Yes'|@translate}
			<input type="radio" value="0" name="History_icon" {if ($Option.History_icon==0)} checked="checked" {/if}/>{'No'|@translate}
		</li>
		<li>
			<span class="property">{'Keep data even if plugin is deactivated/uninstall'|@translate}</span>
			<input type="radio" value="1" name="Keep_data" {if ($Option.Keep_data==1)} checked="checked" {/if}/>{'Yes'|@translate}
			<input type="radio" value="0" name="Keep_data" {if ($Option.Keep_data==0)} checked="checked" {/if}/>{'No'|@translate}
		</li>
		<li>
			<span class="property" title="{'Advanced users: template vars are available in all cases and might be included in your extensions'|@translate}" >{'Default display'|@translate}</span>
			<input type="radio" value="1" name="Display" {if ($Option.Display==1)} checked="checked" {/if}/>{'Yes'|@translate}
			<input type="radio" value="0" name="Display" {if ($Option.Display==0)} checked="checked" {/if}/>{'No'|@translate}
		</li>
		<li>
			<span class="property" title="{'Users with image cluetips [10-200]'|@translate}" >{'Radar limit'|@translate}</span>
			<input type="text" maxlength="2" size="8" id="Radar_limit" name="Radar_limit" value="{$Option.Radar_limit}"  title="{'Default %s'|@translate|@sprintf:'25'}"/>
		</li>
		<li>
			<span class="property" title="{'Default as anybody'|@translate}" >{'Webmasters management:'|@translate}</span>
			<input type="radio" value="0" name="Webmaster_management" {if ($Option.Webmasters==0)} checked="checked" {/if}/>{'Exclude'|@translate}
			<input type="radio" value="1" name="Webmaster_management" {if ($Option.Webmasters==1)} checked="checked" {/if}/>{'Hidden'|@translate}
			<input type="radio" value="2" name="Webmaster_management" {if ($Option.Webmasters==2)} checked="checked" {/if}/>{'As anybody'|@translate}
		</li>
		<li>
			<span class="property" title="{'Default as anybody'|@translate}" >{'Administrators management:'|@translate}</span>
			<input type="radio" value="0" name="Administrator_management" {if ($Option.Administrators==0)} checked="checked" {/if}/>{'Exclude'|@translate}
			<input type="radio" value="1" name="Administrator_management" {if ($Option.Administrators==1)} checked="checked" {/if}/>{'Hidden'|@translate}
			<input type="radio" value="2" name="Administrator_management" {if ($Option.Administrators==2)} checked="checked" {/if}/>{'As anybody'|@translate}
		</li>

	</ul>
	<input type="submit" value="{'Submit'|@translate}" name="submit" class="submit"/>
	<div><input type="hidden" name="from" value="config" /></div>
</fieldset>
{/if}

{if $page == 'monitor'}

<fieldset>
	<legend>{'Your `%s` table summary'|@translate|@sprintf:$WO_status.table}</legend>
	<p>
		{if ($WO_status.spacef > 0)}<a href="{$WO_status.url}&amp;tab=monitor&amp;check">{'Compress it!'|@translate}</a>
		{' => Delete old guests access (over 3 days), and optimize table and index.'|@translate}<br />{/if}
      <table class="table1">
				<tr class="row2"><td style="padding:7px; width: 45%">{'Space used: %s'|@translate|@sprintf:$WO_status.size}</td>
				<td style="padding:7px; width: 45%">{'Unused allocated space: <strong>%s</strong>'|@translate|@sprintf:$WO_status.spacef}</td></tr>
				<tr class="row2"><td>{'Traced sessions: %s'|@translate|@sprintf:$WO_status.Rows}</td>
				<td>{'Altered/created since: %s'|@translate|@sprintf:$WO_status.Create_time}</td></tr>
			</table>
		</p>
</fieldset>


<fieldset>
	<legend>{'Permanence/Durability of user monitoring'|@translate}</legend>
    {$DOUBLE_SELECT}
		<div><input type="hidden" name="from" value="monitor" /></div>
</fieldset>
<fieldset>
	<legend>{'Clearing'|@translate}</legend>
	<p>{'Clear temporary users (minimal delay is 6 minutes). To clean any permanent users, switch them before in the right list above.'|@translate}</p>
      <select class="CleaningList" name="prs_remove[]" multiple="multiple">
        {html_options options=$present_remove selected=$present_remove_selected}
      </select>
      <p><input class="submit" type="submit" value="{'Delete'|@translate}" name="prs_delete" style="font-size:15px;" {$TAG_INPUT_ENABLED}/></p>
		<div><input type="hidden" name="from" value="monitor" /></div>
</fieldset>
{literal}
<script type="text/javascript">// <![CDATA[
  jQuery().ready(function(){
    // Resize possible for double select list
    jQuery("select.CleaningList").resizable({
      handles: "n",
      animate: true,
      animateDuration: "slow",
      animateEasing: "swing",
      preventDefault: true,
      preserveCursor: true,
      autoHide: true,
      ghost: true
    });
  });
// ]]>
</script>
{/literal}
{/if}


{if $page == 'report'}
<fieldset>
	<legend>{'Members summary'|@translate}</legend>
<p>{'Registration counter: %s'|@translate|sprintf:$Members.count} - {'Most members ever online was %s on %s'|@Whois_most:$Members.max:$Members.When:'Y-m-d H:i'}</p> 
</fieldset>
{if !empty($search_results) }
<fieldset>
	<legend>{'Available filters'|@translate}</legend>
	<p>
		<a href="{$Whois_url}reload.php?req=members"		class="load"	id="members" title="{'Monitored members'|@translate}">{'Members'|@translate}</a> - 
		<a href="{$Whois_url}reload.php?req=guest"			class="load"	id="guest" title="{'Captured guests'|@translate}">{'Guests'|@translate}</a> - 
		<a href="{$Whois_url}reload.php?req=less_24"		class="load"	id="less_24" title="{'Last 24h accesses'|@translate}">{'Recents (less 24h)'|@translate}</a> - 
		<a href="{$Whois_url}reload.php?req=over_24"		class="load"	id="over_24" title="{'More than 24h accesses'|@translate}">{'More than 24h'|@translate}</a> - 
		<a href="{$Whois_url}reload.php?req=pics"				class="load"	id="pics" title="{'Pictures accesses'|@translate}">{'On pictures'|@translate}</a> - 
		<a href="{$Whois_url}reload.php?req=no_pic"			class="load"	id="no_pic" title="{'No picture accesses'|@translate}">{'Categories only'|@translate}</a> - 
		<a href="{$Whois_url}reload.php?req=no_country"	class="load"	id="no_country" title="{'Unidentifed countries'|@translate}">{'No country'|@translate}</a> - 
		<a href="{$Whois_url}reload.php?req=single"			class="load"	id="single" title="{'Only one day accesses'|@translate}">{'One day'|@translate}</a> - 
		<a href="{$Whois_url}reload.php?req=multi"			class="load"	id="multi" title="{'Several days accesses or over midnight'|@translate}">{'Several days'|@translate}</a> - 
		<a href="{$Whois_url}reload.php?req=IPs"				class="load"	id="IPs" title="{'Several identified IPs (Only the first one is kept)'|@translate}">{'Several IPs'|@translate}</a> 
	</p>
</fieldset>

<fieldset>
	<legend>{'User access details'|@translate}</legend><!-- {$Whois_Smarty}/report.tpl -->
<div id="reloadable">
{include file="`$Whois_Smarty`/report.tpl"}
</div>
</fieldset>
{else}
{'No data available'|@translate}
{/if}

{html_head}
{literal}
<script type="text/javascript">// <![CDATA[
jQuery(document).ready(function () {  
  jQuery("a.load")
  .click(function() {
  jQuery("#reloadable").load(this.href);
    return false;
  });
});
// ]]>
</script>
{/literal}
{/html_head}

{/if}
</form>

{html_head}
<link rel="stylesheet" type="text/css" href="{$Whois_path|@cat:'online.css'}"> 
{/html_head}
{*known_script id="jquery" src=$ROOT_URL|@cat:"themes/default/js/jquery.packed.js"*}
{*known_script id="jquery.ui" src=$ROOT_URL|@cat:"themes/default/js/ui/packed/ui.core.packed.js"*}
{*known_script id="jquery.cluetip" src=$ROOT_URL|@cat:"themes/default/js/plugins/jquery.cluetip.packed.js"*}
{* known_script id="jquery.tablesorter" src=$Whois_path|@cat:"jquery/tablesorter/jquery.tablesorter.min.js" *}