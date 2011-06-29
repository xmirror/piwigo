{*known_script id="jquery.cluetip" src=$ROOT_URL|@cat:"plugins/whois_online/jquery/cluetip/jquery.cluetip.min.js" *}
<table class="table2" id="detailedStats">
<thead> 
<tr class="throw">
  <th>{'users'|@translate} &nbsp; &nbsp;</th>
  <th class="ns">&nbsp;</th>
  <th>{'First access'|@translate} &nbsp; &nbsp;</th>
  <th>{'Level'|@translate} &nbsp;</th>
  <th class="ns">{'Images (Modify)'|@translate}</th>
  <th>{'Last access'|@translate} &nbsp;</th>
</tr>
</thead> 
<tbody> 
{foreach from=$search_results item=detail name=res_loop}
<tr class="{if $smarty.foreach.res_loop.index is odd}row1{else}row2{/if}">
  <td><a {if isset($detail.url_user)}href="{$detail.url_user}"{else}href="href="{'http:geoiptool'|@translate}{$detail.IP}"{/if} 
        onclick="window.open(this.href); return false;" class="cluetip{if ($detail.guest)} other{/if}" 
		title="{'User:'|@translate} {$detail.username}|
			<table>
				<tr><td class=&#34;right&#34;><b><i>IP:</i></b></td><td colspan=&#34;3&#34;>{$detail.IP} 
				{if ($detail.hidden_IP== 'true')}{'(Multiple IP)'|@translate}{/if}</td></tr>
				{if (substr($detail.user.registration_date,0,4)!='0000')}
				<tr><td class=&#34;right&#34;><b><i>{'Registered since'|@translate}</i></b></td><td colspan=&#34;3&#34;>{$detail.user.registration_date|@substr:0:10}</td></tr>
				{/if}
				<tr><td class=&#34;right&#34;><b><i>User_id</i></b></td><td>{$detail.user_id}</td>
				<td class=&#34;right&#34;><b><i>{'Status'|@translate}</i></b></td><td>{$detail.user.status|@translate|ucfirst} ({$detail.user.status})</td></tr>
			  {*<tr><td class=&#34;right&#34;><b><i>{'language'|@translate}</i></b></td><td>{$detail.Language}</td></tr>*}
				<tr><td class=&#34;right&#34; colspan=&#34;2&#34;>{$detail.Country.Name}</td><td colspan=&#34;2&#34;> / {$detail.Country.City}</td></tr>
				<tr><td colspan=&#34;4&#34;>&nbsp;</td></tr>
				<tr><td class=&#34;right&#34;><b><i>{'Hits since'|@translate}</i></b></td><td colspan=&#34;3&#34;>{$detail.first_access_date}</td></tr>
				<tr><td class=&#34;right&#34;><b><i>{'on pictures'|@translate}</i></b></td><td>{$detail.elm_hits}</td>
				<td class=&#34;right&#34;><b><i>{'on pages'|@translate}</i></b></td><td>{$detail.pag_hits}</td></tr>
			</table>">{$detail.username}</a> 
				<a href="./admin.php?page=profile&amp;user_id={$detail.user_id}" title="{'Profile'|@translate}" 
				onclick="window.open(this.href); return false;">[{$detail.lang}]</a>
	</td>
	<td>
		{if ($detail.user_id == '1')}<a class="external" onclick="window.open(this.href); return false;" href="{'http:hostip'|@translate}" title="{':hostip:title'|@translate}">
			<img src="{$detail.Flag}" alt="{$detail.IP} - {'language'|@translate}: {$detail.Language}" width="24" height="16">
		</a>
		{else}<a class="external" onclick="window.open(this.href); return false;" href="{'http:geoiptool'|@translate}{$detail.IP}" title="{':geoiptool:title'|@translate}">
			<img src="{$detail.Flag}" alt="{$detail.IP} - {'language'|@translate}: {$detail.Language}" width="24" height="16">
		</a>
		{/if}
	</td>
  <td>{$detail.first_access_date} {if ($detail.Bot!==false and $detail.Allowed_SE)}<a class="other" href="#" title="{'Allowed Search engine: '|@translate}{$detail.Bot} - ({$detail.user_agent})"><sub>SE</sub></a>{/if}
	{if ($detail.Bot!==false and !$detail.Allowed_SE and !$detail.Banned_SE)}<a href="#" title="{'Possible Banned Search engine: '|@translate}{$detail.Bot} - ({$detail.user_agent})"><sub>SE</sub></a>{/if}
	{if ($detail.Bot!==false and $detail.Banned_SE)}<a class="external" href="#" title="{'Banned Search engine: '|@translate}{$detail.Bot} - ({$detail.user_agent})"><sub>SE</sub></a>{/if}
	</td>
  <td>
		<a href="./admin.php?page=user_perm&amp;user_id={$detail.user_id}" onclick="window.open(this.href); return false;" title="{'permissions'|@translate}">
		{'Level %d'|@sprintf:$detail.user.level|@translate}</a> ({$detail.user.level})
	</td>
  <td>
	{foreach from=$detail.images key=id item=image name=elm_loop}
		{if ($id > 0)}&nbsp;
			{if (isset($image.path))}
				<a class="cluetip {if $smarty.foreach.res_loop.index is odd}ws1{else}ws2{/if} {$image.ws_level}" 
				  onclick="window.open(this.href); return false;"
				  href="{$image.url_modify}" title="<div style=&#34;text-align:center;&#34;>
				<img src=&#34;{$image.tn_url}&#34;></div>|
					Image ID: {$id} <br />
					{'Privacy level'|@translate}: {'Level %d'|@sprintf:$image.level|@translate} ({$image.level}) <br />
					{if ($image.ws_level=='ws')}{'Image privacy level is higher than the user privacy level (Any change of one of them?)'|@translate} {/if}
					Path: {$image.path}<br />
					<hr>
					Filesize: {$image.filesize} Kb <br />
					Width x Height: {$image.width} x {$image.height} px<br />
					<hr>
					{if (is_null($image.high_filesize))}High Resolution: {if ($image.has_high == 'true')}Yes{else}No{/if}<br />{/if}
					{if (!is_null($image.high_filesize))}High Filesize: {$image.high_filesize} Kb <br />{/if}
					{if (!is_null($image.md5sum))}pLoader (Dynamic upload): Yes <br />{/if}
					Posted on: {$image.date_available} <br />
					{if (!is_null($image.date_creation))}Created on: {$image.date_creation} <br />{/if}
					<hr>
					Hits on: {$image.hit}<br />">{$id}</a>
				{else}<a class="{if $smarty.foreach.res_loop.index is odd}ws1{else}ws2{/if}" 
 				  onclick="window.open(this.href); return false;"
				  href="{$image.url_modify}" title="{$id}{' - Over the radar limit => No level control'|@translate}">{$id}</a>
			{/if}
		{/if}
	{/foreach}
	</td>
  <td>{if (strlen($detail.last_dates) > 10)}<a href="#" class="cluetip"
		title="{'Previous connection dates'|@translate}|
			{$detail.last_dates|@substr:11|@explode:' '|@implode:'<br />'}">{$detail.db_timestamp}</a>{else}{$detail.db_timestamp}{/if}</td>
</tr>
{/foreach}
</tbody> 
</table>
<p><a class="external" href="{'http:hostip'|@translate}" title="{':hostip:title'|@translate}">hostip.info</a>{
 ': provides newcomers\' localization and possibly new country flags, thanks to them.'|@translate}</p>
<p><a class="external" href="{'http:geoiptool'|@translate}" title="{':geoiptool:title'|@translate}">geoiptool.com</a>{
 ': provides IP geolocalization on request (link on flag). Useful for unknown countries.'|@translate}</p>
{literal}
<script type="text/javascript">// <![CDATA[
jQuery(document).ready(function(){
  jQuery("#detailedStats").tablesorter( {sortList: [[5,1]]} );}
);
jQuery().ready(function(){
  jQuery('.cluetip').cluetip({
    width: 300,
    splitTitle: '|',
	clickThrough: true
  });
});
// ]]>
</script>
{/literal}
{if (isset($Case) and $Case > '')}
<style type="text/css">
a#{$Case} {ldelim}  color: #ff3333;  border-bottom: 1px solid #ff3363; outline: 0; }
</style>
{/if}