<div class="cf-button">
<input type="button" value="{'cf_hide'|@translate}" onclick="hide('cf_messages');">
</div>

{footer_script require="jquery"}{literal}
function hide(id) {
  var element = document.getElementById(id);
  if (null != element) {
    element.style.visibility = 'hidden';
    element.style.display = 'none';
  }
}
{/literal}{/footer_script}