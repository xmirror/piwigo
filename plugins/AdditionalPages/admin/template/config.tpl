{footer_script}{literal}
jQuery().ready( function () {
  jQuery("#show_menu").click( function() {
    if (this.checked) {
      jQuery('#menu_name').show();
    }
    else {
      jQuery('#menu_name').hide();
    }
  });
  jQuery('select[name="lang_desc_select"]').change(function () {
    jQuery('[id^="menu_lang"]').hide();
    jQuery("#menu_lang_"+this.options[this.selectedIndex].value).show();
  });
  jQuery('[id^="menu_lang_"]').keyup(function () {
    arr = jQuery(this).attr("id").split("menu_lang_");
    id = arr[1];
    opt = jQuery('select[name="lang_desc_select"] option[id="opt_'+id+'"]');
    if (this.value != '')
      opt.html(opt.html().replace("\u2718", "\u2714"));
    else
      opt.html(opt.html().replace("\u2714", "\u2718"));
  });
});
{/literal}{/footer_script}

<div class="titrePage">
	<h2>Additional Pages - {'Configuration'|@translate}</h2>
</div>

<form name="apform" method="post" action="" class="properties"  ENCTYPE="multipart/form-data">
<fieldset id="indexDisplayConf">
  <legend>{'ap_perm'|@translate}</legend>
  <ul>
      <li>
      <label>
        <span class="property">{'ap_level_perm'|@translate}</span>
        <input type="checkbox" name="level_perm" id="level_perm" value="on" {if $ap_conf.level_perm}checked="checked"{/if}/>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'ap_user_perm'|@translate}</span>
        <input type="checkbox" name="user_perm" id="user_perm" value="on" {if $ap_conf.user_perm}checked="checked"{/if}/>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'ap_group_perm'|@translate}</span>
        <input type="checkbox" name="group_perm" id="group_perm" value="on" {if $ap_conf.group_perm}checked="checked"{/if}/>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'ap_language_perm'|@translate}</span>
        <input type="checkbox" name="language_perm" id="language_perm" value="on" {if $ap_conf.language_perm}checked="checked"{/if}/>
      </label>
    </li>
  </ul>
</fieldset>

<fieldset id="indexDisplayConf">
  <legend>{'Display'|@translate}</legend>
  <ul>
    <li>
      <label>
        <span class="property">{'ap_show_home'|@translate}</span>
        <input type="checkbox" name="show_home" id="show_home" value="on" {if $ap_conf.show_home}checked="checked"{/if}/>
      </label>
    </li>

    {if !$AMM_INSTALLED}
    <li>
      <label>
        <span class="property">{'ap_show_menu'|@translate}</span>
        <input type="checkbox" name="show_menu" id="show_menu" value="on" {if $SHOW_MENU}checked="checked"{/if}/>
      </label>
    </li>
    {/if}

    <li id="menu_name" {if !$AMM_INSTALLED and !$SHOW_MENU}style="display:none;{/if}">
      <span class="property">{'ap_menu_name'|@translate} :
        <select name="lang_desc_select" style="margin-left:30px;">
          {foreach from=$language item=lang}
            <option value="{$lang.LANGUAGE_CODE}" id="opt_{$lang.LANGUAGE_CODE}">{if empty($lang.VALUE)}&#x2718;{else}&#x2714;{/if} &nbsp;{$lang.LANGUAGE_NAME}</option>
          {/foreach}
        </select>
        {foreach from=$language item=lang}
          <input type="text" size="50" name="menu_lang[{$lang.LANGUAGE_CODE}]" id="menu_lang_{$lang.LANGUAGE_CODE}" value="{$lang.VALUE}" style="{if $lang.LANGUAGE_CODE != 'default'}display:none; {/if}margin-left:10px;">
        {/foreach}
      </span>
    </li>

    {if $AMM_INSTALLED}
    <li style="margin-top:40px;">
      <span class="property"><a href="{$AMM_URI}">{'g002_setmenu_nfo'|@translate}</a></span>
    </li>
    {/if}
  </ul>
</fieldset>
	<p><input class="submit" type="submit" value="{'Submit'|@translate}" name="submit"/></p>
</form>
