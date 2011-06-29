{combine_css path="$T4U_CSS/style.css"}
{combine_script id="addtags" require="jquery" path="$T4U_JS/jquery.addtags.js"}

{footer_script require="addtags"}
var related_tags = '';
{foreach from=$T4U_RELATED_TAGS item=tag key=id}
related_tags += '<option value="{$id}">{$tag}</option>';
{/foreach}
var path = new Array();
path['t4u_add_script'] = "{$T4U_ADD_SCRIPT}";
path['t4u_image_id'] = "{$T4U_IMAGE_ID}";
path['t4u_referer'] = "{$T4U_REFERER}";
path['t4u_edit_icon'] = "{$ROOT_URL}{$T4U_IMGS}/edit.png";
path['t4u_get_script'] = "{$T4U_GET_SCRIPT}";

var vocab = new Array();
vocab['click_to_add_tags'] = "{'Click to add tags'|@translate}";
vocab['start_to_type'] = "{'Start to type'|@translate}...";
vocab['update_tags'] = "{'Update tags'|@translate}";
{/footer_script}
