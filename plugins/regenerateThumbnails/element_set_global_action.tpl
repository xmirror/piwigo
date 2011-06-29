{combine_script id='jquery.progressBar' path='plugins/regenerateThumbnails/js/jquery.progressbar.min.js' load='footer'}
{combine_script id='jquery.ajaxmanager' path='themes/default/js/plugins/jquery.ajaxmanager.js' load='footer'}

{footer_script require='jquery.progressBar,jquery.ajaxmanager'}
var elements = new Array();
var all_elements = [{','|@implode:$all_elements}];

{literal}
var queuedManager = $.manageAjax.create('queued', { 
	queue: true,  
	cacheResponse: false,
	maxRequests: 3
});

function progress(val, max, success) {
  jQuery('#progressBar').progressBar(val, {
    max: max,
    textFormat: 'fraction',
    boxImage: 'plugins/regenerateThumbnails/images/progressbar.gif',
    barImage: 'plugins/regenerateThumbnails/images/progressbg_orange.gif'
  });
  type = success ? 'regenerateThumbnailsSuccess': 'regenerateThumbnailsError'
  s = jQuery('[name="'+type+'"]').val();
  jQuery('[name="'+type+'"]').val(++s);

  if (val == max)
    jQuery('#applyAction').click();
}

jQuery(document).ready(function() {
  jQuery('#applyAction').click(function() {
    if (jQuery('[name="selectAction"]').val() == 'regenerateThumbnails') {
      if (elements.length != 0)
        return true;

      if (jQuery('input[name="setSelected"]').attr('checked'))
        elements = all_elements;
      else
        jQuery('input[name="selection[]"]').each(function() {
          if (jQuery(this).attr('checked')) {
            elements.push(jQuery(this).val());
          }
        });

      maxwidth = jQuery('input[name="thumb_maxwidth"]').val();
      maxheight = jQuery('input[name="thumb_maxheight"]').val();
      square = jQuery('input[name="square"]').attr('checked');
      progressBar_max = elements.length;
      todo = 0;

      jQuery('#thumb_config').hide();
      jQuery('#applyActionBlock').hide();
      jQuery('select[name="selectAction"]').hide();
      jQuery('#regenerationMsg').show();
      jQuery('#progressBar').progressBar(0, {
        max: progressBar_max,
        textFormat: 'fraction',
        boxImage: 'plugins/regenerateThumbnails/images/progressbar.gif',
        barImage: 'plugins/regenerateThumbnails/images/progressbg_orange.gif'
      });

      for (i=0;i<elements.length;i++) {
        queuedManager.add({
          type: 'GET', 
          url: 'ws.php', 
          data: {
            method: 'pwg.images.regenerateThumbnail',
            maxwidth: maxwidth,
            maxheight: maxheight,
            square: square,
            image_id: elements[i],
            format: 'json'
          },
          dataType: 'json',
          success: ( function(data) { progress(++todo, progressBar_max, data['result']) }),
          error: ( function(data) { progress(++todo, progressBar_max, false) })
        });
      }
      return false;
    }
  });
});
{/literal}{/footer_script}

<table style="margin-left:20px;" id="thumb_config">
{if isset($SQUARE)}
<tr>
  <th><label for="square">{'Square Thumbnails'|@translate}</label></th>
  <td><input type="checkbox" name="square" id="square" {if $SQUARE}checked="checked"{/if}></td>
</tr>
{footer_script require='jquery'}{literal}
jQuery().ready(function(){
  jQuery("input[name^='thumb_max']").keyup(function(){
    if(jQuery("#square").attr("checked")){
      if (this.name == "thumb_maxwidth"){
        jQuery("input[name='thumb_maxheight']").attr("value", this.value);
      }else{
        jQuery("input[name='thumb_maxwidth']").attr("value", this.value);
      }
    }
  });
  jQuery("#square").click(function(){
    if (this.checked)
      jQuery("input[name^='thumb_maxheight']").attr("value", jQuery("input[name^='thumb_maxwidth']").attr("value"));
  });
});
{/literal}{/footer_script}
{else}
<tr><td><input type="checkbox" name="square" id="square" style="display:none;"></td></tr>
{/if}
  <tr>
    <th>{'Maximum Width'|@translate}</th>
    <td><input type="text" name="thumb_maxwidth" value="{$upload_form_settings.thumb_maxwidth}" size="4" maxlength="4"> {'pixels'|@translate}</td>
  </tr>
  <tr>
    <th>{'Maximum Height'|@translate}</th>
    <td><input type="text" name="thumb_maxheight" value="{$upload_form_settings.thumb_maxheight}" size="4" maxlength="4"> {'pixels'|@translate}</td>
  </tr>
  <tr>
    <th>{'Image Quality'|@translate}</th>
    <td><input type="text" name="thumb_quality" value="{$upload_form_settings.thumb_quality}" size="3" maxlength="3"> %</td>
  </tr>
</table>

<div id="regenerationMsg" style="display:none;">{'Thumbnails generation in progress...'|@translate}<br><br>
<span class="progressBar" id="progressBar"></span>
</div>

<input type="hidden" name="regenerateThumbnailsSuccess" value="0">
<input type="hidden" name="regenerateThumbnailsError" value="0">
