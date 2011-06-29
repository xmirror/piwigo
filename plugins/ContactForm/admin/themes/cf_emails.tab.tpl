{combine_script id="jquery.ui.tabs"}

<div class="titrePage">
    <h2>{$CF.TITLE}<br>{'cf_emails'|@translate}</h2>
</div>
<h3 style="width: 100%;">{'cf_emails_desc'|@translate}</h3>
<form method="post" action="{$CF.F_ACTION}" id="update" enctype="multipart/form-data">
<table class="table2">
  <tr class="throw">
    <th>{'Username'|@translate}</th>
    <th>{'Email address'|@translate}</th>
    <th>{'cf_active'|@translate}</th>
    <th>{'Webmaster'|@translate}</th>
  </tr>
{foreach from=$CF_EMAILS item=email_item key=email}
  <tr class="{cycle values="row2,row1"}">
    <td>{$email_item.NAME}</td>
    <td>{$email}</td>
    <td style="text-align: center;">
      {assign var=name value='active['|cat:$email|cat:']'}
      {html_radios name=$name options=$CF_OPTIONS selected=$email_item.ACTIVE separator='&nbsp;'}
    </td>
    <td style="text-align: center;">
      <input type="radio" name="webmaster" value="{$email}"{if (1==$email_item.WEBMASTER)} checked="checked"{/if}>
    </td>
  </tr>
{foreachelse}
  <tr class="row2">
    <td colspan="4" style="text-align: center;">
      <div>{'cf_no_mail'|@translate}</div>
    </td>
  </tr>
{/foreach}
  <tr>
    <td colspan="4" style="text-align: center;">
      <div class="cf-refresh"><input class="submit" type="submit" value="{'cf_refresh'|@translate}" name="refresh"></div>
    </td>
  </tr>
</table>
<p><input class="submit" type="submit" value="{'cf_validate'|@translate}" name="submit"></p>
</form>
{footer_script}{literal}
$(document).ready(function() {
    $(".infos").fadeOut(800).fadeIn(1200).fadeOut(400).fadeIn(800).fadeOut(400);
    $(".errors").fadeOut(200).fadeIn(200).fadeOut(300).fadeIn(300).fadeOut(400).fadeIn(400); 
  });
{/literal}{/footer_script}
{$CF_DEBUG}
