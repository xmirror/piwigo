{combine_script id="jquery.ui" path="themes/default/js/ui/minified/jquery.ui.core.min.js"}
{combine_script id="jquery.tipTip" path="themes/default/js/plugins/jquery.tipTip.minified.js" }

{literal}
<script type="text/javascript">

  function init()
  {
    loadColorList();
    displayColorListOrder();
    $('.tiptip').tipTip(
      {
        'delay' : 0,
        'fadeIn' : 0,
        'fadeOut' : 0,
        'edgeOffset' : 5,
      }
    );
  }

  function loadColorList()
  {
    order=$('#iSelectOrderColorList').val();

    $("#iListColors").html("<br>{/literal}{'cstat_loading'|@translate}{literal}<br><img src='./plugins/GrumPluginClasses/icons/processing.gif'>");

    $.ajax(
      {
        type: "POST",
        url: "{/literal}{$datas.urlRequest}{literal}",
        async: true,
        data: { ajaxfct:"showStatsGetListColors", orderType:order },
        success:
          function(msg)
          {
            $("#iListColors").html(msg);

            $("#iListColorsNb").html(
              "{/literal}{'cstat_number_of_colors_used'|@translate}{literal}&nbsp;"+$("#iListColors table tr").length
            );
          }
      }
    );
  }

  function sortColorList(by)
  {
    $("#iSelectOrderColorList").val(by);
    displayColorListOrder();
    loadColorList();
  }

  function displayColorListOrder()
  {
    if($("#iSelectOrderColorList").val()=="color")
    {
      $("#iHLTOrderColor").html("&#8593;");
      $("#iHLTOrderNumImages").html("");
      $("#iHLTOrderNumPixels").html("");
    }
    else if($("#iSelectOrderColorList").val()=="img")
    {
      $("#iHLTOrderColor").html("");
      $("#iHLTOrderNumImages").html("&#8593;");
      $("#iHLTOrderNumPixels").html("");
    }
    else if($("#iSelectOrderColorList").val()=="pixel")
    {
      $("#iHLTOrderColor").html("");
      $("#iHLTOrderNumImages").html("");
      $("#iHLTOrderNumPixels").html("&#8593;");
    }
  }


</script>
{/literal}

<h2>{'cstat_statistics'|@translate}</h2>

<form>
  <input type="hidden" id="iSelectOrderColorList" value="{$datas.config_GetListColors_OrderType}"/>
</form>

<table style="width:100%;">
  <tr>
    <td style="min-width:300px;">
      {$datas.colorTable}
    </td>

    <td style="width:8px;"></td>

    <td>

      <table id='iHeaderListColors' class="littlefont">
        <tr>
          <th style="min-width:180px;" colspan="2"><span id="iHLTOrderColor"></span><a onclick="sortColorList('color');">{'cstat_colors'|@translate}</a></th>

          <th width="60px"><span id="iHLTOrderNumImages"></span><a class="tiptip" onclick="sortColorList('img');" title="{'cstat_NumOfImages_help'|@translate}">{'cstat_NumOfImages'|@translate}</a></th>
          <th width="40px">{'cstat_Pct'|@translate}</th>
          <th width="115px">&nbsp;</th>

          <th width="80px"><span id="iHLTOrderNumPixels"></span><a class="tiptip" onclick="sortColorList('pixels');" title="{'cstat_NumOfPixels_help'|@translate}">{'cstat_NumOfPixels'|@translate}</a></th>
          <th width="40px">{'cstat_Pct'|@translate}</th>
          <th width="130px">&nbsp;</th>
        </tr>
      </table>
      <div id='iListColors' class="{$themeconf.name}">
      </div>
      <div id="iListColorsNb"></div>
    </td>
  </tr>

</table>





<script type="text/javascript">
  init();
</script>
