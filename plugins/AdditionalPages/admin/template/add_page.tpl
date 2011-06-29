{footer_script require='jquery'}{literal}
jQuery().ready( function () {
  jQuery('#title').focusout(function () {
    if (jQuery('#permalink').val() == '' && auto_permalink)
      jQuery.post("plugins/AdditionalPages/admin/ajax.php", { str: this.value }, function(data) {
        jQuery('#permalink').val(data);
        auto_permalink = false;
      });
  });
});
var auto_permalink = true;
{/literal}{/footer_script}
{html_head}{literal}
<style type="text/css">
#mainConf { margin:0; }
.groups { margin-top:15px; }
.groups input { margin-right:5px; }
.groups label { margin-right:10px; display: inline-block; overflow: hidden; white-space: nowrap; line-height:1.3em;}
.groups div { float:right; width:74%; line-height:1.3em;}
</style>
{/literal}{/html_head}

<div class="titrePage">
	<h2>{$AP_TITLE}</h2>
</div>
<form method="post" action="" class="properties" id="configContent" ENCTYPE="multipart/form-data">
<fieldset id="mainConf">
  <legend></legend>
	<ul>
    <li>
      <span class="property">
        <label for="title">{'ap_page_name'|@translate}</label>
      </span>
      <input type="text" size="60" maxlength="255" value="{if isset($NAME)}{$NAME}{/if}" name="title" id="title"/>
    </li>

    <li>
      <span class="property">
        <label for="permalink">{'Permalink'|@translate}</label>
      </span>
      <input type="text" size="60" value="{if isset($PERMALINK)}{$PERMALINK}{/if}" name="permalink" id="permalink"/>
    </li>

    {if isset($lang)}
    <li>
      <span class="property">
        <label for="lang">{'ap_page_lang'|@translate}</label>
      </span>
      {html_options name=lang id=lang options=$lang selected=$selected_lang}
    </li>
    {/if}

    <li style="margin-top:15px;">
      <span class="property">
        <label for="homepage">{'ap_set_as_homepage'|@translate}</label>
      </span>
      <input type="checkbox" name="homepage" id="homepage" {if isset($HOMEPAGE) and $HOMEPAGE}checked="checked"{/if}/>
      <i>{'ap_homepage_tip'|@translate}</i>
    </li>

    <li>
      <span class="property">
        <label for="standalone">{'ap_standalone_page'|@translate}</label>
      </span>
      <input type="checkbox" name="standalone" id="standalone" {if isset($STANDALONE) and $STANDALONE}checked="checked"{/if}/>
      <i>{'ap_standalone_tip'|@translate}</i>
    </li>

    {if isset($level_perm)}
    <li style="margin-top:15px;">
      <span class="property">
        <label for="privacy">{'Privacy level'|@translate}</label>
      </span>
      <select name="level" size="1">{html_options options=$level_perm selected=$level_selected id=privacy}</select>
    </li>
    {/if}

    {if isset($users)}
    <li class="groups" style="margin-top:15px;">
      <span class="property">
        <label for="users">{'ap_authorized_users'|@translate}</label>
      </span>
      {html_checkboxes options=$users selected=$selected_users name=users}
    </li>
    {/if}

    {if isset($groups)}
    <li class="groups" style="margin-top:15px;">
      <span class="property">
        <label for="groups">{'ap_authorized_group'|@translate}</label>
      </span>
      <div>{html_checkboxes options=$groups selected=$selected_groups name=groups}</div>
    </li>
    <li class="groups">
      <div>
        <a href="#" onClick="jQuery('input[name^=\'groups\']').attr('checked', 'checked');return false;">{'ap_select_all'|@translate}</a> /
        <a href="#" onClick="jQuery('input[name^=\'groups\']').attr('checked', '');return false;">{'ap_unselect_all'|@translate}</a> &nbsp; 
        <i>{'ap_guest'|@translate}</i>
      </div>
    </li>
    {/if}
</ul>
</fieldset>
<table style="width:95%;">
		<tr>
			<td colspan="2" align="center"><br>
				<b>{'ap_page_content'|@translate}</b><br>
				<textarea name="ap_content" id="ap_content" rows="30" cols="50" style="width:100%;">{if isset($CONTENT)}{$CONTENT}{/if}</textarea>
      </td>
		</tr>

		<tr>
		<td colspan="2" align="center"><br>
		<input class="submit" type="submit" value="{'ap_save'|@translate}" name="save">
		{if isset($delete)}
		<input class="submit" type="submit" value="{'ap_delete'|@translate}" name="delete" onclick="return confirm('{'Are you sure?'|@translate}');"/>
		{/if}
		</tr>
</table>
</form>
