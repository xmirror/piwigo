{combine_script id="jquery.ui" path="themes/default/js/ui/minified/jquery.ui.core.min.js"}
{combine_script id="jquery.ui.slider" path="themes/default/js/ui/minified/jquery.ui.slider.min.js"}


{literal}
<style>
 .ui-slider {
    width:600px;
    height:10px;
    border-width:1px;
    border-style:solid;
    margin-right:5px;
    padding-right:14px;
  }
 .ui-slider-handle {
    width:12px;
    height:12px;
    position:relative;
    top:-2px;
    border-width:1px;
    border-style:solid;
    display:block;
  }
</style>
<script type="text/javascript">

  function displayConfig(tabsheet)
  {
    switch(tabsheet)
    {
      case 'database':
        $('#iDisplayConfigDatabase').css('display', 'block');
        $('#iDisplayConfigStatSearch').css('display', 'none');
        $('#iDisplayConfigDisplay').css('display', 'none');
        break;
      case 'statsearch':
        $('#iDisplayConfigDatabase').css('display', 'none');
        $('#iDisplayConfigStatSearch').css('display', 'block');
        $('#iDisplayConfigDisplay').css('display', 'none');
        break;
      case 'display':
        $('#iDisplayConfigDatabase').css('display', 'none');
        $('#iDisplayConfigStatSearch').css('display', 'none');
        $('#iDisplayConfigDisplay').css('display', 'block');
        break;
    }
  }

  function init()
  {
    formatPct({/literal}{$datas.minPct}{literal});
    $("#icstat_stat_minPct_slider").slider(
      {
        min:0.25,
        max:60,
        step:0.25,
        value:{/literal}{$datas.minPct}{literal},
        slide: function(event, ui) { formatPct(ui.value); }
      });
    $("#icstat_stat_minPct_slider a").addClass('gcBgInput');

    formatPx({/literal}{$datas.colorSize}{literal});
    $("#icstat_display_colorSize_slider").slider(
      {
        min:5,
        max:25,
        step:1,
        value:{/literal}{$datas.colorSize}{literal},
        slide: function(event, ui) { formatPx(ui.value); }
      });
    $("#icstat_display_colorSize_slider a").addClass('gcBgInput');

    showColors();
    qi.calculateTimes();
    displayConfig('database');
  }

  function formatPx(px)
  {
    $("#icstat_display_colorSize").val(px);
    $("#icstat_display_colorSize_display").html(px+"px");
  }

  function formatPct(pct)
  {
    $("#icstat_stat_minPct").val(pct);
    $("#icstat_stat_minPct_display").html(pct.toFixed(2)+"%");
  }

  function showColors()
  {
    if($('#idisplay_gallery_showColorsCBox').get(0).checked)
    {
      $('#idisplay_gallery_showColors').val('y');
      $('#icstat_display_colorSize_area').css('display', 'block');
    }
    else
    {
      $('#idisplay_gallery_showColors').val('n');
      $('#icstat_display_colorSize_area').css('display', 'none');
    }
  }


  qualityInterface = function(optionsToSet)
  {
    var qualityValues = [{/literal}{$datas.qualityHighest}, {$datas.qualityHigh}, {$datas.qualityNormal}, {$datas.qualityLow}, {$datas.qualityLowest}{literal}];
    var qualityKeys   = ['highest', 'hight', 'normal', 'low', 'lowest'];

    var options = jQuery.extend(
      {
        pps:0,
      },
      optionsToSet);


    this.calculateTimes = function ()
    {
      _calculateTimes();
    }

    var _calculateTimes = function ()
    {
      values=new Array();

      for(i=0;i<qualityValues.length;i++)
      {
        if(options.pps==0)
        {
          values[i]=Array('-', '-');
        }
        else
        {
          values[i]=Array(
            (qualityValues[i]/options.pps).toFixed(2)+'s',
            formatTime({/literal}{$datas.nbPictures}{literal}*qualityValues[i]/options.pps)
          );
        }
      }

      $('#iEstimatedHighest').html(values[0][0]);
      $('#iEstimatedHighestAll').html(values[0][1]);

      $('#iEstimatedHigh').html(values[1][0]);
      $('#iEstimatedHighAll').html(values[1][1]);

      $('#iEstimatedNormal').html(values[2][0]);
      $('#iEstimatedNormalAll').html(values[2][1]);

      $('#iEstimatedLow').html(values[3][0]);
      $('#iEstimatedLowAll').html(values[3][1]);

      $('#iEstimatedLowest').html(values[4][0]);
      $('#iEstimatedLowestAll').html(values[4][1]);
    }



    this.doRequest = function ()
    {
      displayBench(true);
      $.ajax(
        {
          type: "POST",
          url: "{/literal}{$datas.urlRequest}{literal}",
          async: true,
          data: { ajaxfct:"doPpsBench", quality:2 },
          success: function(msg)
            {
              options.pps=msg;
              _calculateTimes();
              displayBench(false);
            },
         }
      );
    }

    var formatTime = function (eTime)
    {
      var seconds=(eTime%60).toFixed(2);
      var minutes=((eTime-seconds)/60).toFixed(0);
      var returned=seconds+"s";
      if(minutes>0) returned=minutes+"m"+returned;
      return(returned);
    }

    var displayBench = function (processing)
    {
      if(processing)
      {
        $('#iBenchBtn').css('display', 'none');
        $('#iBenchWait').css('display', 'block');
      }
      else
      {
        $('#iBenchBtn').css('display', 'block');
        $('#iBenchWait').css('display', 'none');
      }
    }
  }

  var qi=new qualityInterface({pps:{/literal}{$datas.pps}{literal}});

</script>
{/literal}

{$configTabsheet}

<h2>{'cstat_config_plugin'|@translate}</h2>

<form id="iConfig" method="post" action="" class="general">

  <div id='iDisplayConfigDatabase' style='display:none;'>

    <fieldset>
      <legend>{'cstat_bench'|@translate}</legend>
      <div>{'cstat_do_benchmark'|@translate}</div>
      <br>
      <div id='iBenchBtn'>
        <input type="button" onclick="qi.doRequest();" value="{'cstat_do_bench'|@translate}">
      </div>
      <div id='iBenchWait' style='display:none;text-align:center;'>
        <img src='./plugins/GrumPluginClasses/icons/processing.gif'>
      </div>
    </fieldset>

    <fieldset>
      <legend>{'cstat_quality_of_analyze'|@translate}</legend>

      <table class="formtable table2">
        <tr class='throw'>
          <td>{'cstat_quality_level'|@translate}</td>
          <td>{'cstat_estimated_time_one_picture'|@translate}</td>
          <td>{'cstat_estimated_time_all_pictures'|@translate}</td>
        </tr>
        <tr>
          <td>
            <label><input type="radio" name="f_analyze_ppsQuality" value="{$datas.qualityHighest}" {if $datas.quality==$datas.qualityHighest}checked{/if}>&nbsp;{'cstat_quality_highest'|@translate}</label>
          </td>
          <td class='estimatedTime'>
            <span id='iEstimatedHighest'>-</span>
          </td>
          <td class='estimatedTime'>
            <span id='iEstimatedHighestAll'>-</span>
          </td>
        </tr>
        <tr>
          <td>
            <label><input type="radio" name="f_analyze_ppsQuality" value="{$datas.qualityHigh}" {if $datas.quality==$datas.qualityHigh}checked{/if}>&nbsp;{'cstat_quality_high'|@translate}</label>
          </td>
          <td class='estimatedTime'>
            <span id='iEstimatedHigh'>-</span>
          </td>
          <td class='estimatedTime'>
            <span id='iEstimatedHighAll'>-</span>
          </td>
        </tr>
        <tr>
          <td>
            <label><input type="radio" name="f_analyze_ppsQuality" value="{$datas.qualityNormal}" {if $datas.quality==$datas.qualityNormal}checked{/if}>&nbsp;{'cstat_quality_normal'|@translate}</label>
          </td>
          <td class='estimatedTime'>
            <span id='iEstimatedNormal'>-</span>
          </td>
          <td class='estimatedTime'>
            <span id='iEstimatedNormalAll'>-</span>
          </td>
        </tr>
        <tr>
          <td>
            <label><input type="radio" name="f_analyze_ppsQuality" value="{$datas.qualityLow}" {if $datas.quality==$datas.qualityLow}checked{/if}>&nbsp;{'cstat_quality_low'|@translate}</label>
          </td>
          <td class='estimatedTime'>
            <span id='iEstimatedLow'>-</span>
          </td>
          <td class='estimatedTime'>
            <span id='iEstimatedLowAll'>-</span>
          </td>
        </tr>
        <tr>
          <td>
            <label><input type="radio" name="f_analyze_ppsQuality" value="{$datas.qualityLowest}" {if $datas.quality==$datas.qualityLowest}checked{/if}>&nbsp;{'cstat_quality_lowest'|@translate}</label>
          </td>
          <td class='estimatedTime'>
            <span id='iEstimatedLowest'>-</span>
          </td>
          <td class='estimatedTime'>
            <span id='iEstimatedLowestAll'>-</span>
          </td>
        </tr>
      </table>





    </fieldset>
  </div>

  <div id='iDisplayConfigStatSearch'  style='display:none;'>
    <fieldset>
      <legend>{'cstat_significant_colors'|@translate}</legend>

      <table class="formtable">
        <tr>
          <td colspan="2">{'cstat_percent_min_significant'|@translate}</td>
        </tr>
        <tr>
          <td>
            <input type="hidden" name="f_stat_minPct" id="icstat_stat_minPct" value="{$datas.minPct}">
            <div id="icstat_stat_minPct_slider" class="gcBgInput gcBorderInput"></div>
          </td>
          <td width="90px">
            <div id="icstat_stat_minPct_display"></div>
          </td>
        </tr>
      </table>
    </fieldset>
  </div>

  <div id='iDisplayConfigDisplay'  style='display:none;'>
    <fieldset>
      <legend>{'cstat_gallery_display_colors'|@translate}</legend>

      <label>
        <input type="checkbox" id='idisplay_gallery_showColorsCBox' onclick="showColors();" {if $datas.showColors=='y'}checked{/if} >
        {'cstat_display_colors_on_image'|@translate}
        <input type="hidden" id='idisplay_gallery_showColors' name='f_display_gallery_showColors' value='{$datas.showColors}'>
      </label>

      <div id='icstat_display_colorSize_area'>
        <br>
        <table class="formtable">
          <tr>
            <td colspan="2">{'cstat_color_size'|@translate}</td>
          </tr>
          <tr>
            <td>
              <input type="hidden" name="f_display_gallery_colorSize" id="icstat_display_colorSize" value="{$datas.colorSize}">
              <div id="icstat_display_colorSize_slider" class="gcBgInput gcBorderInput"></div>
            </td>
            <td width="90px">
              <div id="icstat_display_colorSize_display"></div>
            </td>
          </tr>
        </table>
      </div>

    </fieldset>
  </div>

  <input type="submit" value="{'cstat_apply'|@translate}" name="submit_save_config" style="margin-left:1em;" >

</form>


<script type="text/javascript">
  init();
</script>
