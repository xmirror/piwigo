
{include file='include/autosize.inc.tpl'}

<div class="titrePage">
  <h2>{'Piwigo configuration'|@translate} {$TABSHEET_TITLE}</h2>
</div>

{if !isset($default)}
<form method="post" action="{$F_ACTION}" class="properties">
{/if}
<div id="configContent">
{if isset($main)}
<fieldset id="mainConf">
  <legend></legend>
  <ul>
    <li>
      <span class="property">
        <label for="gallery_title">{'Gallery title'|@translate}</label>
      </span>
      <input type="text" maxlength="255" size="50" name="gallery_title" id="gallery_title" value="{$main.CONF_GALLERY_TITLE}">
    </li>

    <li>
      <span class="property">
        <label for="page_banner">{'Page banner'|@translate}</label>
      </span>
      <textarea rows="5" cols="50" class="description" name="page_banner" id="page_banner">{$main.CONF_PAGE_BANNER}</textarea>
    </li>
  </ul>
</fieldset>

<fieldset id="mainConfCheck">
  <legend></legend>
  <ul>
    <li>
      <label>
        <span class="property">{'Allow rating'|@translate}</span>
        <input type="checkbox" name="rate" {if ($main.rate)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Rating by guests'|@translate}</span>
        <input type="checkbox" name="rate_anonymous" {if ($main.rate_anonymous)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Allow user registration'|@translate}</span>
        <input type="checkbox" name="allow_user_registration" {if ($main.allow_user_registration)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Allow user customization'|@translate}</span>
        <input type="checkbox" name="allow_user_customization" {if ($main.allow_user_customization)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Mail address is obligatory for all users'|@translate}</span>
        <input type="checkbox" name="obligatory_user_mail_address" {if ($main.obligatory_user_mail_address)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Email admins when a new user registers'|@translate}</span>
        <input type="checkbox" name="email_admin_on_new_user" {if ($main.email_admin_on_new_user)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      &nbsp;
      <span class="property">
        {'Week starts on'|@translate}
        {html_options name="week_starts_on" options=$main.week_starts_on_options selected=$main.week_starts_on_options_selected}
      </span>
    </li>
    
    <li>
      &nbsp;
      <span class="property">
        {'Default photos order'|@translate}
        
        {foreach from=$main.order_by item=order}
        <span class="filter {if $ORDER_BY_IS_CUSTOM}transparent{/if}">          
          <select name="order_by_field[]" {if $ORDER_BY_IS_CUSTOM}disabled{/if}>
            {html_options options=$main.order_field_options selected=$order.FIELD }
          </select>
          <select name="order_by_direction[]" {if $ORDER_BY_IS_CUSTOM}disabled{/if}>
            {html_options options=$main.order_direction_options selected=$order.DIRECTION }
          </select>  
          <a class="removeFilter">{'delete'|@translate}</a>
        </span>
        {/foreach}
        
        {if !$ORDER_BY_IS_CUSTOM}
          <a class="addFilter">{'Add a criteria'|@translate}</a>
        {else}
          <span class="order_by_is_custom">{'You can\'t define a default photo order because you have a custom setting in your local configuration.'|@translate}</span>
        {/if}
      </span>
    </li>
    
{if !$ORDER_BY_IS_CUSTOM}
{footer_script require='jquery'}
// counters for displaying of addFilter link
fields = {$main.order_by|@count}; max_fields = {$main.order_field_options|@count}; max_fields--;

{literal}
function updateAddFilterLink() {
  if (fields >= max_fields) {
    $('.addFilter').css('display', 'none');
  } else {
    $('.addFilter').css('display', '');
  }
}

function updateRemoveFilterTrigger() {
  $(".removeFilter").click(function () {
    $(this).parent('span.filter').remove();
    fields--;
    updateAddFilterLink();
  });
}

jQuery(document).ready(function () {
  $('.addFilter').click(function() {
    rel = $(this).attr('rel');
    $(this).prev('span.filter').clone().insertBefore($(this));
    $(this).prev('span.filter').children('select[name="order_by_field[]"]').val('');
    $(this).prev('span.filter').children('select[name="order_by_direction[]"]').val('ASC');
    
    fields++;
    updateAddFilterLink();  
    updateRemoveFilterTrigger();
  });
  
  updateRemoveFilterTrigger();
  updateAddFilterLink();
});
{/literal}
{/footer_script}
{/if}
  </ul>
</fieldset>
{/if}

{if isset($history)}
<fieldset id="historyConf">
  <legend></legend>
  <ul>
      <li>
        <label><span class="property">{'Save page visits by guests'|@translate}</span><input type="checkbox" name="history_guest" {if ($history.history_guest)}checked="checked"{/if}></label>
      </li>

      <li>
        <label><span class="property">{'Save page visits by users'|@translate}</span><input type="checkbox" name="log" {if ($history.log)}checked="checked"{/if}></label>
      </li>

      <li>
        <label><span class="property">{'Save page visits by administrators'|@translate}</span><input type="checkbox" name="history_admin" {if ($history.history_admin)}checked="checked"{/if}></label>
      </li>
  </ul>
</fieldset>
{/if}

{if isset($comments)}
<fieldset id="commentsConf">
  <legend></legend>
  <ul>
    <li>
      <label>
        <span class="property">{'Activate comments'|@translate}</span>
        <input type="checkbox" name="activate_comments" id="activate_comments"{if ($comments.activate_comments)}checked="checked"{/if}>
      </label>
    </li>
  </ul>
  
  <ul id="comments_param_warp"{if not ($comments.activate_comments)} style="display:none;"{/if}>
    <li>
      <label>
        <span class="property">{'Comments for all'|@translate}</span>
        <input type="checkbox" name="comments_forall" {if ($comments.comments_forall)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <span class="property">
        <label for="nb_comment_page">{'Number of comments per page'|@translate}</label>
      </span>
      <input type="text" size="3" maxlength="4" name="nb_comment_page" id="nb_comment_page" value="{$comments.NB_COMMENTS_PAGE}">
    </li>
    
    <li>
      <span class="property">{'Default comments order'|@translate}</span>
      <select name="comments_order">
        {html_options options=$comments.comments_order_options selected=$comments.comments_order}
      </select>
    </li>

    <li>
      <label>
        <span class="property">{'Validation'|@translate}</span>
        <input type="checkbox" name="comments_validation" {if ($comments.comments_validation)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Email admins when a valid comment is entered'|@translate}</span>
        <input type="checkbox" name="email_admin_on_comment" {if ($comments.email_admin_on_comment)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Email admins when a comment requires validation'|@translate}</span>
        <input type="checkbox" name="email_admin_on_comment_validation" {if ($comments.email_admin_on_comment_validation)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Allow users to edit their own comments'|@translate}</span>
        <input type="checkbox" name="user_can_edit_comment" {if ($comments.user_can_edit_comment)}checked="checked"{/if}>
      </label>
    </li>
    <li>
      <label>
        <span class="property">{'Allow users to delete their own comments'|@translate}</span>
        <input type="checkbox" name="user_can_delete_comment" {if ($comments.user_can_delete_comment)}checked="checked"{/if}>
      </label>
    </li>
    <li>
      <label>
        <span class="property">{'Email administrators when a comment is modified'|@translate}</span>
        <input type="checkbox" name="email_admin_on_comment_edition" {if ($comments.email_admin_on_comment_edition)}checked="checked"{/if}>
      </label>
    </li>
    <li>
      <label>
        <span class="property">{'Email administrators when a comment is deleted'|@translate}</span>
        <input type="checkbox" name="email_admin_on_comment_deletion" {if ($comments.email_admin_on_comment_deletion)}checked="checked"{/if}>
      </label>
    </li>

  </ul>
</fieldset>
{footer_script}{literal}
jQuery(document).ready(function(){
  jQuery("#activate_comments").change(function(){
    if ($(this).is(':checked')) {
      jQuery("#comments_param_warp").show();
    } else {
      jQuery("#comments_param_warp").hide();
    }
  });
});
{/literal}{/footer_script}
{/if}

</div> <!-- configContent -->

{if isset($sizes)}

{footer_script}{literal}
jQuery(document).ready(function(){
  function toggleResizeFields(prefix) {
    var checkbox = jQuery("#"+prefix+"_resize");
    var needToggle = jQuery("input[name^="+prefix+"_]").not(checkbox).parents('tr');

    if (jQuery(checkbox).is(':checked')) {
      needToggle.show();
    }
    else {
      needToggle.hide();
    }
  }

  toggleResizeFields("original");
  jQuery("#original_resize").click(function () {toggleResizeFields("original")});
});
{/literal}{/footer_script}

<fieldset id="sizesConf">
  <legend>{'Original Size'|@translate}</legend>

  <table>
    <tr>
      <th><label for="original_resize">{'Resize after upload'|@translate}</label></th>
      <td><input type="checkbox" name="original_resize" id="original_resize" {if ($sizes.original_resize)}checked="checked"{/if}></td>
    </tr>
    <tr>
      <th>{'Maximum Width'|@translate}</th>
      <td><input type="text" name="original_resize_maxwidth" value="{$sizes.original_resize_maxwidth}" size="4" maxlength="4"> {'pixels'|@translate}</td>
    </tr>
    <tr>
      <th>{'Maximum Height'|@translate}</th>
      <td><input type="text" name="original_resize_maxheight" value="{$sizes.original_resize_maxheight}" size="4" maxlength="4"> {'pixels'|@translate}</td>
    </tr>
    <tr>
      <th>{'Image Quality'|@translate}</th>
      <td><input type="text" name="original_resize_quality" value="{$sizes.original_resize_quality}" size="3" maxlength="3"> %</td>
    </tr>
  </table>

</fieldset>
{/if}

{if isset($default)}
{$PROFILE_CONTENT}
{/if}

{if isset($display)}
<fieldset id="indexDisplayConf">
  <legend>{'Main Page'|@translate}</legend>
  <ul>
    <li>
      <label>
        <span class="property">{'display only recently posted photos'|@translate|@ucfirst|@string_format:$pwg->l10n('Activate icon "%s"')}</span>
        <input type="checkbox" name="menubar_filter_icon" {if ($display.menubar_filter_icon)}checked="checked"{/if}>
      </label>
    </li>    
    
    <li>
      <label>
        <span class="property">{'Activate icon "new" next to albums and pictures'|@translate}</span>
        <input type="checkbox" name="index_new_icon" {if ($display.index_new_icon)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Sort order'|@translate|@string_format:$pwg->l10n('Activate icon "%s"')}</span>
        <input type="checkbox" name="index_sort_order_input" {if ($display.index_sort_order_input)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'display all photos in all sub-albums'|@translate|@ucfirst|@string_format:$pwg->l10n('Activate icon "%s"')}</span>
        <input type="checkbox" name="index_flat_icon" {if ($display.index_flat_icon)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'display a calendar by posted date'|@translate|@ucfirst|@string_format:$pwg->l10n('Activate icon "%s"')}</span>
        <input type="checkbox" name="index_posted_date_icon" {if ($display.index_posted_date_icon)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'display a calendar by creation date'|@translate|@ucfirst|@string_format:$pwg->l10n('Activate icon "%s"')}</span>
        <input type="checkbox" name="index_created_date_icon" {if ($display.index_created_date_icon)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'slideshow'|@translate|@ucfirst|@string_format:$pwg->l10n('Activate icon "%s"')}</span>
        <input type="checkbox" name="index_slideshow_icon" {if ($display.index_slideshow_icon)}checked="checked"{/if}>
      </label>
    </li>
  </ul>
</fieldset>

<fieldset id="pictureDisplayConf">
  <legend>{'Photo Page'|@translate}</legend>
  <ul>
    <li>
      <label>
        <span class="property">{'slideshow'|@translate|@ucfirst|@string_format:$pwg->l10n('Activate icon "%s"')}</span>
        <input type="checkbox" name="picture_slideshow_icon" {if ($display.picture_slideshow_icon)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Show file metadata'|@translate|@string_format:$pwg->l10n('Activate icon "%s"')}</span>
        <input type="checkbox" name="picture_metadata_icon" {if ($display.picture_metadata_icon)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Download this file'|@translate|@ucfirst|@string_format:$pwg->l10n('Activate icon "%s"')}</span>
        <input type="checkbox" name="picture_download_icon" {if ($display.picture_download_icon)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'add this photo to your favorites'|@translate|@ucfirst|@string_format:$pwg->l10n('Activate icon "%s"')}</span>
        <input type="checkbox" name="picture_favorite_icon" {if ($display.picture_favorite_icon)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Activate Navigation Bar'|@translate}</span>
        <input type="checkbox" name="picture_navigation_icons" {if ($display.picture_navigation_icons)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Activate Navigation Thumbnails'|@translate}</span>
        <input type="checkbox" name="picture_navigation_thumb" {if ($display.picture_navigation_thumb)}checked="checked"{/if}>
      </label>
    </li>
    
    <li>
      <label>
        <span class="property">{'Show menubar'|@translate}</span>
        <input type="checkbox" name="picture_menu" {if ($display.picture_menu)}checked="checked"{/if}>
      </label>
    </li>
  </ul>
</fieldset>

<fieldset id="pictureInfoConf">
  <legend>{'Photo Properties'|@translate}</legend>
  <ul>
    <li>
      <label>
        <span class="property">{'Author'|@translate}</span>
        <input type="checkbox" name="picture_informations[author]" {if ($display.picture_informations.author)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Created on'|@translate}</span>
        <input type="checkbox" name="picture_informations[created_on]" {if ($display.picture_informations.created_on)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Posted on'|@translate}</span>
        <input type="checkbox" name="picture_informations[posted_on]" {if ($display.picture_informations.posted_on)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Dimensions'|@translate}</span>
        <input type="checkbox" name="picture_informations[dimensions]" {if ($display.picture_informations.dimensions)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'File'|@translate}</span>
        <input type="checkbox" name="picture_informations[file]" {if ($display.picture_informations.file)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Filesize'|@translate}</span>
        <input type="checkbox" name="picture_informations[filesize]" {if ($display.picture_informations.filesize)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Tags'|@translate}</span>
        <input type="checkbox" name="picture_informations[tags]" {if ($display.picture_informations.tags)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Albums'|@translate}</span>
        <input type="checkbox" name="picture_informations[categories]" {if ($display.picture_informations.categories)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Visits'|@translate}</span>
        <input type="checkbox" name="picture_informations[visits]" {if ($display.picture_informations.visits)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Rating score'|@translate}</span>
        <input type="checkbox" name="picture_informations[rating_score]" {if ($display.picture_informations.rating_score)}checked="checked"{/if}>
      </label>
    </li>

    <li>
      <label>
        <span class="property">{'Who can see this photo?'|@translate} ({'available for administrators only'|@translate})</span>
        <input type="checkbox" name="picture_informations[privacy_level]" {if ($display.picture_informations.privacy_level)}checked="checked"{/if}>
      </label>
    </li>
  </ul>
</fieldset>
{/if}

{if !isset($default)}
  <p>
    <input class="submit" type="submit" name="submit" value="{'Save Settings'|@translate}">
    <input class="submit" type="reset" name="reset" value="{'Reset'|@translate}">
  </p>
</form>
{/if}
