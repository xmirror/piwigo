{include file='include/tag_selection.inc.tpl'}
{include file='include/datepicker.inc.tpl'}

{footer_script}{literal}
  pwg_initialization_datepicker("#date_creation_day", "#date_creation_month", "#date_creation_year", "#date_creation_linked_date", "#date_creation_action_set");
{/literal}{/footer_script}

{combine_script id='jquery.fcbkcomplete' load='footer' require='jquery' path='themes/default/js/plugins/jquery.fcbkcomplete.js'}

{footer_script require='jquery.fcbkcomplete'}{literal}
jQuery(document).ready(function() {
  jQuery("#tags").fcbkcomplete({
    json_url: "admin.php?fckb_tags=1",
    cache: false,
    filter_case: false,
    filter_hide: true,
    firstselected: true,
    filter_selected: true,
    maxitems: 100,
    newel: true
  });
});
{/literal}{/footer_script}

{footer_script}
var nb_thumbs_page = {$nb_thumbs_page};
var nb_thumbs_set = {$nb_thumbs_set};
var applyOnDetails_pattern = "{'on the %d selected photos'|@translate}";

var selectedMessage_pattern = "{'%d of %d photos selected'|@translate}";
var selectedMessage_none = "{'No photo selected, %d photos in current set'|@translate}";
var selectedMessage_all = "{'All %d photos are selected'|@translate}";
{literal}
function str_repeat(i, m) {
        for (var o = []; m > 0; o[--m] = i);
        return o.join('');
}

function sprintf() {
        var i = 0, a, f = arguments[i++], o = [], m, p, c, x, s = '';
        while (f) {
                if (m = /^[^\x25]+/.exec(f)) {
                        o.push(m[0]);
                }
                else if (m = /^\x25{2}/.exec(f)) {
                        o.push('%');
                }
                else if (m = /^\x25(?:(\d+)\$)?(\+)?(0|'[^$])?(-)?(\d+)?(?:\.(\d+))?([b-fosuxX])/.exec(f)) {
                        if (((a = arguments[m[1] || i++]) == null) || (a == undefined)) {
                                throw('Too few arguments.');
                        }
                        if (/[^s]/.test(m[7]) && (typeof(a) != 'number')) {
                                throw('Expecting number but found ' + typeof(a));
                        }
                        switch (m[7]) {
                                case 'b': a = a.toString(2); break;
                                case 'c': a = String.fromCharCode(a); break;
                                case 'd': a = parseInt(a); break;
                                case 'e': a = m[6] ? a.toExponential(m[6]) : a.toExponential(); break;
                                case 'f': a = m[6] ? parseFloat(a).toFixed(m[6]) : parseFloat(a); break;
                                case 'o': a = a.toString(8); break;
                                case 's': a = ((a = String(a)) && m[6] ? a.substring(0, m[6]) : a); break;
                                case 'u': a = Math.abs(a); break;
                                case 'x': a = a.toString(16); break;
                                case 'X': a = a.toString(16).toUpperCase(); break;
                        }
                        a = (/[def]/.test(m[7]) && m[2] && a >= 0 ? '+'+ a : a);
                        c = m[3] ? m[3] == '0' ? '0' : m[3].charAt(1) : ' ';
                        x = m[5] - String(a).length - s.length;
                        p = m[5] ? str_repeat(c, x) : '';
                        o.push(s + (m[4] ? a + p : p + a));
                }
                else {
                        throw('Huh ?!');
                }
                f = f.substring(m[0].length);
        }
        return o.join('');
}

$(document).ready(function() {
  function checkPermitAction() {
    var nbSelected = 0;
    if ($("input[name=setSelected]").is(':checked')) {
      nbSelected = nb_thumbs_set;
    }
    else {
      $(".thumbnails input[type=checkbox]").each(function() {
         if ($(this).is(':checked')) {
           nbSelected++;
         }
      });
    }

    if (nbSelected == 0) {
      $("#applyActionBlock").hide();
      $("#forbidAction").show();
    }
    else {
      $("#applyActionBlock").show();
      $("#forbidAction").hide();
    }

    $("#applyOnDetails").text(
      sprintf(
        applyOnDetails_pattern,
        nbSelected
      )
    );

    // display the number of currently selected photos in the "Selection" fieldset
    if (nbSelected == 0) {
      $("#selectedMessage").text(
        sprintf(
          selectedMessage_none,
          nb_thumbs_set
        )
      );
    }
    else if (nbSelected == nb_thumbs_set) {
      $("#selectedMessage").text(
        sprintf(
          selectedMessage_all,
          nb_thumbs_set
        )
      );
    }
    else {
      $("#selectedMessage").text(
        sprintf(
          selectedMessage_pattern,
          nbSelected,
          nb_thumbs_set
        )
      );
    }
  }

  $('img.thumbnail').tipTip({
    'delay' : 0,
    'fadeIn' : 200,
    'fadeOut' : 200
  });

  $(".wrap1 label").click(function () {
    $("input[name=setSelected]").attr('checked', false);

    var wrap2 = $(this).children(".wrap2");
    var checkbox = $(this).children("input[type=checkbox]");

    if ($(checkbox).is(':checked')) {
      $(wrap2).addClass("thumbSelected"); 
    }
    else {
      $(wrap2).removeClass('thumbSelected'); 
    }

    checkPermitAction();
  });

  $("#selectAll").click(function () {
    $("input[name=setSelected]").attr('checked', false);
    selectPageThumbnails();
    checkPermitAction();
    return false;
  });

  function selectPageThumbnails() {
    $(".thumbnails label").each(function() {
      var wrap2 = $(this).children(".wrap2");
      var checkbox = $(this).children("input[type=checkbox]");

      $(checkbox).attr('checked', true);
      $(wrap2).addClass("thumbSelected"); 
    });
  }

  $("#selectNone").click(function () {
    $("input[name=setSelected]").attr('checked', false);

    $(".thumbnails label").each(function() {
      var wrap2 = $(this).children(".wrap2");
      var checkbox = $(this).children("input[type=checkbox]");

      $(checkbox).attr('checked', false);
      $(wrap2).removeClass("thumbSelected"); 
    });
    checkPermitAction();
    return false;
  });

  $("#selectInvert").click(function () {
    $("input[name=setSelected]").attr('checked', false);

    $(".thumbnails label").each(function() {
      var wrap2 = $(this).children(".wrap2");
      var checkbox = $(this).children("input[type=checkbox]");

      $(checkbox).attr('checked', !$(checkbox).is(':checked'));

      if ($(checkbox).is(':checked')) {
        $(wrap2).addClass("thumbSelected"); 
      }
      else {
        $(wrap2).removeClass('thumbSelected'); 
      }
    });
    checkPermitAction();
    return false;
  });

  $("#selectSet").click(function () {
    selectPageThumbnails();
    $("input[name=setSelected]").attr('checked', true);
    checkPermitAction();
    return false;
  });

  $("input[name=remove_author]").click(function () {
    if ($(this).is(':checked')) {
      $("input[name=author]").hide();
    }
    else {
      $("input[name=author]").show();
    }
  });

  $("input[name=remove_title]").click(function () {
    if ($(this).is(':checked')) {
      $("input[name=title]").hide();
    }
    else {
      $("input[name=title]").show();
    }
  });

  $("input[name=remove_date_creation]").click(function () {
    if ($(this).is(':checked')) {
      $("#set_date_creation").hide();
    }
    else {
      $("#set_date_creation").show();
    }
  });

  $(".removeFilter").click(function () {
    var filter = $(this).parent('li').attr("id");
    filter_disable(filter);

    return false;
  });

  function filter_enable(filter) {
    /* show the filter*/
    $("#"+filter).show();

    /* check the checkbox to declare we use this filter */
    $("input[type=checkbox][name="+filter+"_use]").attr("checked", true);

    /* forbid to select this filter in the addFilter list */
    $("#addFilter").children("option[value="+filter+"]").attr("disabled", "disabled");
  }

  $("#addFilter").change(function () {
    var filter = $(this).attr("value");
    filter_enable(filter);
    $(this).attr("value", -1);
  });

  function filter_disable(filter) {
    /* hide the filter line */
    $("#"+filter).hide();

    /* uncheck the checkbox to declare we do not use this filter */
    $("input[name="+filter+"_use]").removeAttr("checked");

    /* give the possibility to show it again */
    $("#addFilter").children("option[value="+filter+"]").removeAttr("disabled");
  }

  $("#removeFilters").click(function() {
    $("#filterList li").each(function() {
      var filter = $(this).attr("id");
      filter_disable(filter);
    });
    return false;
  });

  var max_dim = 20;
  $(".thumbnails img").each(function () {
    if ($(this).height() > (max_dim-20))
      max_dim = $(this).height() + 20;
    if ($(this).width() > max_dim)
      max_dim = $(this).width() + 20;
    $("ul.thumbnails span, ul.thumbnails label").css('width', max_dim+'px').css('height', max_dim+'px');
  });

  checkPermitAction()
});
{/literal}{/footer_script}

<div id="batchManagerGlobal">

<h2>{'Regenerate Thumbnails'|@translate}</h2>

  <form action="{$F_ACTION}" method="post">

  <fieldset>
    <legend>{'Filter'|@translate}</legend>

    <ul id="filterList">
      <li id="filter_prefilter" {if !isset($filter.prefilter)}style="display:none"{/if}>
        <a href="#" class="removeFilter" title="{'remove this filter'|@translate}"><span>[x]</span></a>
        <input type="checkbox" name="filter_prefilter_use" class="useFilterCheckbox" {if isset($filter.prefilter)}checked="checked"{/if}>
        {'predefined filter'|@translate}
        <select name="filter_prefilter">
          <option value="caddie" {if $filter.prefilter eq 'caddie'}selected="selected"{/if}>{'caddie'|@translate}</option>
          <option value="last import" {if $filter.prefilter eq 'last import'}selected="selected"{/if}>{'last import'|@translate}</option>
          <option value="with no album" {if $filter.prefilter eq 'with no album'}selected="selected"{/if}>{'with no album'|@translate}</option>
{if $ENABLE_SYNCHRONIZATION}
          <option value="with no virtual album" {if $filter.prefilter eq 'with no virtual album'}selected="selected"{/if}>{'with no virtual album'|@translate}</option>
{/if}
          <option value="with no tag" {if $filter.prefilter eq 'with no tag'}selected="selected"{/if}>{'with no tag'|@translate}</option>
          <option value="duplicates" {if $filter.prefilter eq 'duplicates'}selected="selected"{/if}>{'duplicates'|@translate}</option>
          <option value="all photos" {if $filter.prefilter eq 'all photos'}selected="selected"{/if}>{'All'|@translate}</option>
        </select>
      </li>
      <li id="filter_category" {if !isset($filter.category)}style="display:none"{/if}>
        <a href="#" class="removeFilter" title="remove this filter"><span>[x]</span></a>
        <input type="checkbox" name="filter_category_use" class="useFilterCheckbox" {if isset($filter.category)}checked="checked"{/if}>
        {'album'|@translate}
        <select style="width:400px" name="filter_category" size="1">
          {html_options options=$filter_category_options selected=$filter_category_options_selected}
        </select>
        <label><input type="checkbox" name="filter_category_recursive" {if isset($filter.category_recursive)}checked="checked"{/if}> {'include child albums'|@translate}</label>
      </li>
      <li id="filter_level" {if !isset($filter.level)}style="display:none"{/if}>
        <a href="#" class="removeFilter" title="remove this filter"><span>[x]</span></a>
        <input type="checkbox" name="filter_level_use" class="useFilterCheckbox" {if isset($filter.level)}checked="checked"{/if}>
        {'Who can see these photos?'|@translate}
        <select name="filter_level" size="1">
          {html_options options=$filter_level_options selected=$filter_level_options_selected}
        </select>
      </li>
    </ul>

    <p class="actionButtons" style="">
      <select id="addFilter">
        <option value="-1">{'Add a filter'|@translate}</option>
        <option disabled="disabled">------------------</option>
        <option value="filter_prefilter">{'predefined filter'|@translate}</option>
        <option value="filter_category">{'album'|@translate}</option>
        <option value="filter_level">{'Who can see these photos?'|@translate}</option>
      </select>
<!--      <input id="removeFilters" class="submit" type="submit" value="Remove all filters" name="removeFilters"> -->
      <a id="removeFilters" href="">{'Remove all filters'|@translate}</a>
    </p>

    <p class="actionButtons" id="applyFilterBlock">
      <input id="applyFilter" class="submit" type="submit" value="{'Refresh photo set'|@translate}" name="submitFilter">
    </p>

  </fieldset>

  <fieldset>

    <legend>{'Selection'|@translate}</legend>

  {if !empty($thumbnails)}
  <p id="checkActions">
    {'Select:'|@translate}
{if $nb_thumbs_set > $nb_thumbs_page}
    <a href="#" id="selectAll">{'The whole page'|@translate}</a>,
    <a href="#" id="selectSet">{'The whole set'|@translate}</a>,
{else}
    <a href="#" id="selectAll">{'All'|@translate}</a>,
{/if}
    <a href="#" id="selectNone">{'None'|@translate}</a>,
    <a href="#" id="selectInvert">{'Invert'|@translate}</a>

    <span id="selectedMessage"></span>

    <input type="checkbox" name="setSelected" style="display:none" {if count($selection) == $nb_thumbs_set}checked="checked"{/if}>
  </p>

    <ul class="thumbnails">
      {foreach from=$thumbnails item=thumbnail}
        {if in_array($thumbnail.ID, $selection)}
          {assign var='isSelected' value=true}
        {else}
          {assign var='isSelected' value=false}
        {/if}

      <li><span class="wrap1">
          <label>
            <span class="wrap2{if $isSelected} thumbSelected{/if}">
        {if $thumbnail.LEVEL > 0}
        <em class="levelIndicatorB">{$pwg->l10n($pwg->sprintf('Level %d',$thumbnail.LEVEL))}</em>
        <em class="levelIndicatorF" title="{'Who can see these photos?'|@translate} : ">{$pwg->l10n($pwg->sprintf('Level %d',$thumbnail.LEVEL))}</em>
        {/if}
            <span>
              <img src="{$thumbnail.TN_SRC}"
                 alt="{$thumbnail.FILE}"
                 title="{$thumbnail.TITLE|@escape:'html'}"
                 class="thumbnail">
            </span></span>
            <input type="checkbox" name="selection[]" value="{$thumbnail.ID}" {if $isSelected}checked="checked"{/if}>
          </label>
          </span>
      </li>
      {/foreach}
    </ul>

  {if !empty($navbar) }
  <div style="clear:both;">

    <div style="float:left">
    {include file='navigation_bar.tpl'|@get_extent:'navbar'}
    </div>

    <div style="float:right;margin-top:10px;">{'display'|@translate}
      <a href="{$U_DISPLAY}&amp;display=20">20</a>
      &middot; <a href="{$U_DISPLAY}&amp;display=50">50</a>
      &middot; <a href="{$U_DISPLAY}&amp;display=100">100</a>
      &middot; <a href="{$U_DISPLAY}&amp;display=all">{'all'|@translate}</a>
      {'photos per page'|@translate}
    </div>
  </div>
  {/if}

  {else}
  <div>{'No photo in the current set.'|@translate}</div>
  {/if}
  </fieldset>

  <fieldset id="action">

    <legend>{'Miniaturization parameters'|@translate}</legend>

{if !empty($element_set_global_plugins_actions)}
  {foreach from=$element_set_global_plugins_actions item=action}
    {if $action.ID == 'regenerateThumbnails'}
    <div id="action_{$action.ID}" class="bulkAction">{$action.CONTENT}</div>
    {/if}
  {/foreach}
{/if}

    <p id="applyActionBlock" class="actionButtons">
      <input type="hidden" name="selectAction" value="regenerateThumbnails">
      <input id="applyAction" class="submit" type="submit" value="{'Regenerate Thumbnails'|@translate}" name="submit"> <span id="applyOnDetails"></span></p>
    <p id="forbidAction">{'No photo selected, no action possible.'|@translate}</p>

  </fieldset>

  </form>

</div> <!-- #batchManagerGlobal -->
