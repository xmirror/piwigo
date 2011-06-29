{html_head}
<style type="text/css">
li .bullet {ldelim}padding-left:14px;margin-left:0;background:url({$ROOT_URL}plugins/{$RVMT_BASE_NAME}/img/bpm.gif) no-repeat scroll}
.liOpen .bullet {ldelim}cursor:pointer;background-position:-38px center}
.liClosed .bullet {ldelim}cursor:pointer;background-position:-19px center}
.liBullet .bullet {ldelim}cursor:default;background-position:0 center}
.liClosed ul {ldelim}display:none;}
</style>
{/html_head}
<dt>
  {if isset($U_START_FILTER)}
  <a href="{$U_START_FILTER}" title="{'display only recently posted photos'|@translate}" rel="nofollow"><img src="{$ROOT_URL}{$themeconf.icon_dir}/start_filter.png" class="button" alt="start filter"></a>
  {/if}
  {if isset($U_STOP_FILTER)}
  <a href="{$U_STOP_FILTER}" title="{'return to the display of all photos'|@translate}"><img src="{$ROOT_URL}{$themeconf.icon_dir}/stop_filter.png" class="button" alt="stop filter"></a>
  {/if}
	<a href="{$block->data.U_CATEGORIES}">{'Albums'|@translate}</a>
</dt>
<dd>
{strip}
{assign var='ref_level' value=0}
{foreach from=$block->data.MENU_CATEGORIES item=cat key=key}
	{if $cat.LEVEL > $ref_level}
		<ul{if $ref_level == 0} class=rvTree id=theCategoryMenu{/if}>
	{else}
		</li>
		{'</ul></li>'|@str_repeat:$ref_level-$cat.LEVEL}
	{/if}
	{if $cat.SELECTED}
		{assign var=liclass value='selected '}
	{else}
		{assign var=liclass value=''}
	{/if}
	{if $cat.count_categories > 0}
		{if isset($U_STOP_FILTER) or isset($RVMT_UPPER_IDS[$cat.id])}
			{assign var=liclass value="`$liclass`liOpen"}
		{else}
			{assign var=liclass value="`$liclass`liClosed"}
		{/if}
	{/if}
	<li{if !empty($liclass)} class="{$liclass}"{/if}> <a href="{$cat.URL}"{if $cat.IS_UPPERCAT} rel="up"{/if}>{$cat.NAME}</a>
		{if $cat.count_images > 0}
			<span{if $cat.nb_images <= 0} class=menuInfoCatByChild{/if} title="{$cat.TITLE}"> [{$cat.count_images}] </span>
		{/if}
		{if !empty($cat.icon_ts)}
			<img title="{$cat.icon_ts.TITLE}" src="{$ROOT_URL}{$themeconf.icon_dir}/recent{if $cat.icon_ts.IS_CHILD_DATE}_by_child{/if}.png" alt="(!)">
		{/if}
	{assign var='ref_level' value=$cat.LEVEL}
{/foreach}
{'</li></ul>'|@str_repeat:$ref_level}
{/strip}
{combine_script id='rvmt' load='async' path="plugins/`$RVMT_BASE_NAME`/js/rvtree.min.js"}
{footer_script}
	var _rvTreeAutoQueue = _rvTreeAutoQueue||[];
	_rvTreeAutoQueue.push(  document.getElementById("theCategoryMenu") );
{/footer_script}
	{if isset($block->data.U_UPLOAD)}
	<ul>
		<li>
			<a href="{$block->data.U_UPLOAD}">{'Upload a picture'|@translate}</a>
		</li>
	</ul>
	{/if}
	<p class=totalImages>{$pwg->l10n_dec('%d photo', '%d photos', $block->data.NB_PICTURE)}</p>
</dd>