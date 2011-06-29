{literal}
<script type="text/javascript">

  var globalTagId;

  function init()
  {
    computedWidth=$("#content").get(0).clientWidth;
    computedHeight=$("#content").get(0).clientHeight;
    $("#dialogViewDetail")
    .dialog(
      {
        autoOpen: false,
        resizable: false,
        width:computedWidth,
        height:computedHeight,
        modal: true,
        draggable:true,
        dialogClass: 'gcBgTabSheet gcBorder',
        title: '{/literal}{"g003_metadata_detail"|@translate}{literal}',
        open: function(event, ui)
        {
          bH=$("div.ui-dialog-buttonpane").get(0).clientHeight;
          $("#dialogViewDetail").css('height', (this.clientHeight-bH)+"px");
          $("#iListImages").css('height', (this.clientHeight-bH-$("#iListImagesNb").get(0).clientHeight-$("#iHeaderListImages").get(0).clientHeight)+"px");
        },
        buttons:
        {
          '{/literal}{"g003_ok"|@translate}{literal}':
            function()
            {
              $(this).dialog('close');
            }
        }
      }
    );
  }

  function loadTagList()
  {
    order=$('#iSelectOrderTagList').val();
    filter=$("#iSelectFilterTagList").val();
    unusedTag=($("#iExcludeUnusedTagList").get(0).checked)?"y":"n";
    selectedOnly=($("#iSelectedTagOnly").get(0).checked)?"y":"n";

    displayTagListOrder();

    $("#iListTags").html("<br>{/literal}{'g003_loading'|@translate}{literal}<br><img src='./plugins/GrumPluginClasses/icons/processing.gif'>");

    $.ajax(
      {
        type: "POST",
        url: "{/literal}{$datas.urlRequest}{literal}",
        async: true,
        data: { ajaxfct:"admin.showStats.getListTags", orderType:order, filterType:filter, excludeUnusedTag:unusedTag, selectedTagOnly:selectedOnly },
        success:
          function(msg)
          {
            $("#iListTags").html(msg);

            $("#iListTagsNb").html(
              "{/literal}{'g003_number_of_filtered_metadata'|@translate}{literal} "+$("#iListTags table tr").length
            );

            //onclick="updateTagSelect('iNumId{$data.numId}', '')"
            $("input.cbiListTags")
              .bind('click',
                function(event)
                {
                  event.stopPropagation();
                  updateTagSelect($(this).get(0).id, '');
                }
              );

            $("a.cbiListTags")
              .bind('click',
                function(event)
                {
                  event.stopPropagation();
                  loadTagDetail($(this).get(0).id.substr(7));
                }
              );
          }
      }
    );

  }

  function loadTagDetail(tag)
  {
    $("#dialogViewDetail").dialog('open');

    globalTagId=tag;
    order=$('#iSelectOrderImageList').val();
    $("#iListImages").html("<br>{/literal}{'g003_loading'|@translate}{literal}<br><img src='./plugins/GrumPluginClasses/icons/processing.gif'>");
    $("#iHeaderListImagesTagName").html("["+tag+"]");

    $.ajax(
      {
        type: "POST",
        url: "{/literal}{$datas.urlRequest}{literal}",
        async: true,
        data: { ajaxfct:"admin.showStats.getListImages", orderType:order, tagId:tag,  },
        success:
          function(msg)
          {
            $("#iListImages").html(msg);
            $("#iListImagesNb").html(
              "{/literal}{'g003_number_of_distinct_values'|@translate}{literal} "+$("#iListImages table tr").length
            );
          }
      }
    );
  }

  function updateTagSelect(numId, mode)
  {

    if(mode=='switch')
    {
      $("#"+numId).get(0).checked=!$("#"+numId).get(0).checked;
    }

    selected=($("#"+numId).get(0).checked)?"y":"n";

    $("#iListImages").html(
      $.ajax({
        type: "POST",
        url: "{/literal}{$datas.urlRequest}{literal}",
        async: false,
        data: { ajaxfct:"admin.updateTag.select", tagSelected:selected, numId:numId.substr(6) }
       }).responseText
    );

  }

  function sortTagList(by)
  {
    $("#iSelectOrderTagList").val(by);
    displayTagListOrder();
    loadTagList();
  }

  function sortTagDetail(by, tag)
  {
    $("#iSelectOrderImageList").val(by);
    displayTagDetailOrder();
    loadTagDetail(tag);
  }

  function displayTagListOrder()
  {
    if($("#iSelectOrderTagList").val()=="tag")
    {
      $("#iHLTOrderTag").html("&#8593;");
      $("#iHLTOrderLabel").html("");
      $("#iHLTOrderNum").html("");
    }
    else if($("#iSelectOrderTagList").val()=="num")
    {
      $("#iHLTOrderTag").html("");
      $("#iHLTOrderLabel").html("");
      $("#iHLTOrderNum").html("&#8593;");
    }
    else
    {
      // by label
      /* not fully implemented
      $("#iHLTOrderTag").html("");
      $("#iHLTOrderLabel").html("&#8593;");
      $("#iHLTOrderNum").html("");
      */
    }
  }

  function displayTagDetailOrder()
  {
    if($("#iSelectOrderImageList").val()=="value")
    {
      $("#iHLIOrderValue").html("&#8593;");
      $("#iHLIOrderNum").html("");
    }
    else
    {
      $("#iHLIOrderValue").html("");
      $("#iHLIOrderNum").html("&#8593;");
    }
  }


</script>
{/literal}


<h2>{'g003_select_metadata'|@translate}</h2>

<div class='helps'>
  <p>{'g003_select_page_help'|@translate}</p>
</div>

<form>
  <input type="hidden" id="iSelectOrderTagList" value="{$datas.config_GetListTags_OrderType}"/>

  <label>{'g003_filter'|@translate}
    <select id="iSelectFilterTagList" onchange="loadTagList();">
      <option value="" {if $datas.config_GetListTags_FilterType==""}selected{/if}>{'g003_no_filter'|@translate}</option>
      {if !in_array('magic', $amdConfig.amd_FillDataBaseExcludeFilters)}
      <option value="magic" {if $datas.config_GetListTags_FilterType=="magic"}selected{/if}>{'g003_magic_filter'|@translate}</option>
      {/if}
      <option value="userDefined" {if $datas.config_GetListTags_FilterType=="userDefined"}selected{/if}>{'g003_userDefined_filter'|@translate}</option>

      {if !in_array('exif', $amdConfig.amd_FillDataBaseExcludeFilters)}
      <option value="exif" {if $datas.config_GetListTags_FilterType=="exif"}selected{/if}>Exif</option>
      {/if}
      {if !in_array('exif.maker', $amdConfig.amd_FillDataBaseExcludeFilters)}
      <option value="exif.maker.Canon" {if $datas.config_GetListTags_FilterType=="exif.maker.Canon"}selected{/if}>Exif [Canon]</option>
      <option value="exif.maker.Nikon" {if $datas.config_GetListTags_FilterType=="exif.maker.Nikon"}selected{/if}>Exif [Nikon]</option>
      <option value="exif.maker.Pentax" {if $datas.config_GetListTags_FilterType=="exif.maker.Pentax"}selected{/if}>Exif [Pentax]</option>
      {/if}
      {if !in_array('xmp', $amdConfig.amd_FillDataBaseExcludeFilters)}
      <option value="xmp" {if $datas.config_GetListTags_FilterType=="xmp"}selected{/if}>Xmp</option>
      {/if}
      {if !in_array('iptc', $amdConfig.amd_FillDataBaseExcludeFilters)}
      <option value="iptc" {if $datas.config_GetListTags_FilterType=="iptc"}selected{/if}>Iptc</option>
      {/if}
      {if !in_array('com', $amdConfig.amd_FillDataBaseExcludeFilters)}
      <option value="com" {if $datas.config_GetListTags_FilterType=="com"}selected{/if}>Com</option>
      {/if}
    </select>
  </label>

  <label>
    <input type="checkbox" id="iExcludeUnusedTagList" onchange="loadTagList();"  {if $datas.config_GetListTags_ExcludeUnusedTag=="y"}checked{/if}>&nbsp;{'g003_exclude_unused_tags'|@translate}
  </label>

  <label>
    <input type="checkbox" id="iSelectedTagOnly" onchange="loadTagList();" {if $datas.config_GetListTags_SelectedTagOnly=="y"}checked{/if}>&nbsp;{'g003_selected_tags_only'|@translate}
  </label>

</form>

<table id='iHeaderListTags' class="littlefont">
  <tr>
    <th style="width:35%;min-width:340px;"><span id="iHLTOrderTag"></span><a onclick="sortTagList('tag');">{'g003_TagId'|@translate}</a></th>
    {* <th><span id="iHLTOrderLabel"></span><a onclick="sortTagList('label');">{'g003_TagLabel'|@translate}</a></th> *}
    <th>{'g003_TagLabel'|@translate}</th>
    <th width="80px"><span id="iHLTOrderNum"></span><a onclick="sortTagList('num');">{'g003_NumOfImage'|@translate}</a></th>
    <th width="40px">{'g003_Pct'|@translate}</th>
    <th width="110px">&nbsp;</th>
  </tr>
</table>
<div id='iListTags' class="{$themeconf.name}">
</div>
<div id="iListTagsNb"></div>


<div id="dialogViewDetail">
  <form>
    <input type="hidden" id="iSelectOrderImageList" value="{$datas.config_GetListImages_OrderType}"/>
  </form>

  <table id='iHeaderListImages' class="littlefont">
    <tr>
      <th><span id="iHLIOrderValue"></span><a onclick="sortTagDetail('value', globalTagId);">{'g003_Value'|@translate}</a>&nbsp;<span id="iHeaderListImagesTagName"></span></th>
      <th width="80px"><span id="iHLIOrderNum"></span><a onclick="sortTagDetail('num', globalTagId);">{'g003_NumOfImage'|@translate}</a></th>
      <th width="40px">{'g003_Pct'|@translate}</th>
      <th width="110px">&nbsp;</th>
    </tr>
  </table>

  <div id='iListImages' class="{$themeconf.name}">
    <div style="width:100%;text-align:center;padding-top:20px;">{'g003_no_items_selected'|@translate}</div>
  </div>
  <div id="iListImagesNb"></div>
</div>


<script type="text/javascript">
  init();
  loadTagList();
  displayTagDetailOrder();
</script>
