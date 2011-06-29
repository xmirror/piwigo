{combine_script id="jquery.ui" path=$ROOT_URL|@cat:"themes/default/js/ui/minified/jquery.ui.core.min.js"}
{combine_script id="jquery.ui.dialog" path=$ROOT_URL|@cat:"themes/default/js/ui/minified/jquery.ui.dialog.min.js"}

{literal}
<script type="text/javascript">
var processAnalyze = {
      step:0,
      lists:new Array(),
      timeStart:0,
      timeEnd:0
    }

  function init()
  {
    formatNbItemPerRequest({/literal}{$datas.NumberOfItemsPerRequest}{literal});
  }

  function formatNbItemPerRequest(nbItems)
  {
    $("#iamd_NumberOfItemsPerRequest").val(nbItems);
    $("#iamd_nb_item_per_request_display").html(nbItems);
  }

  function doAnalyze()
  {
    var mode="all",
        modeLabel="",
        numOfRandomItems=0,
        doAnalyzeDialog="<br><form id='iDialogProgress' class='formtable'>"+
      "<div id='iprogressbar_contener' class='gcBorderInput'>"+
      "<span id='iprogressbar_bg' class='gcBgInput' style='width:0%;'>&nbsp;</span>"+
      "<span id='iprogressbar_fg' class='gcLink'>0%</span>"+
      "</div><p>{/literal}{'g003_analyze_in_progress'|@translate}{literal}"+
      "<br><img src='./plugins/GrumPluginClasses/icons/processing.gif'>"+
      "</p></form>",
        re=/^\d+$/;


    if($("#ianalyze_action0").get(0).checked)
    {
      mode="notAnalyzed";
      modeLabel="{/literal}{'g003_analyze_not_analyzed_pictures'|@translate}{literal}";
    }
    else if($("#ianalyze_action1").get(0).checked)
    {
      mode="all";
      modeLabel="{/literal}{'g003_analyze_all_pictures'|@translate}{literal}";
    }
    else if($("#ianalyze_action2").get(0).checked)
    {
      mode="caddieAdd";
      modeLabel="{/literal}{'g003_analyze_caddie_add_pictures'|@translate}{literal}";
    }
    else if($("#ianalyze_action3").get(0).checked)
    {
      mode="caddieReplace";
      modeLabel="{/literal}{'g003_analyze_caddie_replace_pictures'|@translate}{literal}";
    }
    else if($("#ianalyze_action4").get(0).checked)
    {
      mode="analyzed";
      modeLabel="{/literal}{'g003_analyze_analyzed_pictures'|@translate}{literal}";
    }
    else if($("#ianalyze_action5").get(0).checked)
    {
      mode="randomList";
      numOfRandomItems=$("#ianalyze_action6").val();
      if(numOfRandomItems<=0 || re.exec(numOfRandomItems)==null)
      {
        alert("{/literal}{'g003_invalid_random_number'|@translate}{literal}");
        return(false);
      }
      modeLabel="{/literal}{'g003_analyze_random_pictures'|@translate|replace:'%s':'"+numOfRandomItems+"'}{literal}";
    }

    ignoreOptions=[];
    if($('#iFillDataBaseIgnore_magic').get(0).checked)
    {
      ignoreOptions.push('magic');
    }
    if($('#iFillDataBaseIgnore_exif').get(0).checked)
    {
      ignoreOptions.push('exif');
    }
    if($('#iFillDataBaseIgnore_iptc').get(0).checked)
    {
      ignoreOptions.push('iptc');
    }
    if($('#iFillDataBaseIgnore_xmp').get(0).checked)
    {
      ignoreOptions.push('xmp');
    }
    if($('#iFillDataBaseIgnore_com').get(0).checked)
    {
      ignoreOptions.push('com');
    }


    $("#dialog")
    .html("")
    .dialog(
      {
        resizable: false,
        width:480,
        height:120,
        modal: true,
        draggable:true,
        dialogClass: 'gcBgTabSheet gcBorder',
        title: '{/literal}{"g003_updating_metadata"|@translate}{literal}&nbsp;('+modeLabel+')',
      }
    ).html(doAnalyzeDialog);

    NumberOfItemsPerRequest=$("#iamd_NumberOfItemsPerRequest").val();

    $.ajax(
      {
        type: "POST",
        url: "{/literal}{$datas.urlRequest}{literal}",
        async: true,
        data:
          {
            ajaxfct:"admin.makeStats.getList",
            selectMode:mode,
            numOfItems:NumberOfItemsPerRequest,
            ignoreOptions:ignoreOptions,
            numOfRandomItems:numOfRandomItems,
          },
        success: function(msg)
          {
            processAnalyze.step=0;
            processAnalyze.lists=msg.split(";");
            processAnalyze.timeStart=new Date();
            doStep_processList();
          },
        error: function()
          {
            alert('error');
          }
      }
    );
  }


  function displayTime(eTime)
  {
    seconds=(eTime%60).toFixed(2);
    minutes=((eTime-seconds)/60).toFixed(0);
    returned=seconds+"s";
    if(minutes>0) returned=minutes+"m"+returned;
    return(returned);
  }

  function doStep_processList()
  {
    if(processAnalyze.step < processAnalyze.lists.length)
    {
      $.ajax({
        type: "POST",
        url: "{/literal}{$datas.urlRequest}{literal}",
        async: true,
        data: { ajaxfct:"admin.makeStats.doAnalyze", imagesList:processAnalyze.lists[processAnalyze.step] },
        success: function(msg)
          {
            processAnalyze.step++;
            doStep_processList();
          },
       });

      pct=100*(processAnalyze.step+1)/processAnalyze.lists.length;
      $("#iprogressbar_bg").css("width", pct+"%");
      $("#iprogressbar_fg").html(Math.round(pct)+"%");
    }
    else
    {
      // list completely processed
      tmp = $.ajax({
        type: "POST",
        url: "{/literal}{$datas.urlRequest}{literal}",
        async: false,
        data: { ajaxfct:"admin.makeStats.consolidate" }
       }).responseText;

      processAnalyze.timeEnd = new Date();
      timeElapsed=processAnalyze.timeEnd.getTime()-processAnalyze.timeStart.getTime();

      $("#dialog")
      .dialog("destroy")
      .html("")
      .get(0).removeAttribute('style');

      $("#dialog")
      .dialog(
        {
          resizable: false,
          width:480,
          height:120,
          modal: true,
          draggable:true,
          dialogClass: 'gcBgTabSheet gcBorder',
          title: '{/literal}{"g003_updating_metadata"|@translate}{literal}',
          dialogClass: 'gcBgTabSheet gcBorder',
          open: function(event, ui)
          {
            bH=$("div.ui-dialog-buttonpane").get(0).clientHeight;
            $("#dialog").css('height', (this.clientHeight-bH)+"px");
          },
          buttons:
          {
            '{/literal}{"g003_ok"|@translate}{literal}':
              function()
              {
                $(this).dialog('destroy').html("").get(0).removeAttribute('style');
              }
          }
        }
      )
      .html("<br>{/literal}{'g003_analyze_is_finished'|@translate}{literal}&nbsp;("+displayTime(timeElapsed/1000)+")");
    }
  }

  function updateFillDatabaseOption()
  {
    $.ajax(
      {
        type: "POST",
        url: "{/literal}{$datas.urlRequest}{literal}",
        async: true,
        data: { ajaxfct:"admin.config.setOption", id:'amd_FillDataBaseContinuously', value:$('#iamd_FillDataBaseContinuously').get(0).checked?'y':'n' },
      }
    );
  }

  function displayAnalyzedOption()
  {
    if($('#iAnalyzeAnalyzed').css('display')=='none')
    {
      $('#iAnalyzeAnalyzed').css('display', 'block');
      $('#ianalyze_action4').get(0).checked=true;
    }
  }



</script>
{/literal}

<h2>{'g003_updating_metadata'|@translate}</h2>

<div id="dialog"></div>

<div id='ianalyzearea'>
  <form class="formtable">
    <fieldset>
      <legend>{'g003_options'|@translate}</legend>
      <label><input onclick='updateFillDatabaseOption();' type="checkbox" id='iamd_FillDataBaseContinuously' {if $amdConfig.amd_FillDataBaseContinuously=='y'}checked{/if}>&nbsp;{'g003_fillDatabaseContinuously'|@translate}</label><br>

      {if !(in_array('exif', $amdConfig.amd_FillDataBaseExcludeFilters) and
            in_array('xmp', $amdConfig.amd_FillDataBaseExcludeFilters) and
            in_array('iptc', $amdConfig.amd_FillDataBaseExcludeFilters) and
            in_array('xmp', $amdConfig.amd_FillDataBaseExcludeFilters) and
            in_array('com', $amdConfig.amd_FillDataBaseExcludeFilters)) }
        <br>
        {'g003_ignoreMetadata'|@translate}<br>
        <table style='margin-left:0px;'>
          <tr style='vertical-align:top;text-align:left;'>
            <td width='150px'>
              {if !in_array('magic', $amdConfig.amd_FillDataBaseExcludeFilters)}
              <label><input onclick='displayAnalyzedOption();' type="checkbox" id='iFillDataBaseIgnore_magic' {if in_array('magic', $amdConfig.amd_FillDataBaseIgnoreSchemas)}checked{/if}>&nbsp;Magic</label><br>
              {/if}
              {if !in_array('exif', $amdConfig.amd_FillDataBaseExcludeFilters)}
              <label><input onclick='displayAnalyzedOption();' type="checkbox" id='iFillDataBaseIgnore_exif' {if in_array('exif', $amdConfig.amd_FillDataBaseIgnoreSchemas)}checked{/if}>&nbsp;EXIF</label><br>
              {/if}
              {if !in_array('iptc', $amdConfig.amd_FillDataBaseExcludeFilters)}
              <label><input onclick='displayAnalyzedOption();' type="checkbox" id='iFillDataBaseIgnore_iptc' {if in_array('iptc', $amdConfig.amd_FillDataBaseIgnoreSchemas)}checked{/if}>&nbsp;IPTC</label><br>
              {/if}
              {if !in_array('xmp', $amdConfig.amd_FillDataBaseExcludeFilters)}
              <label><input onclick='displayAnalyzedOption();' type="checkbox" id='iFillDataBaseIgnore_xmp' {if in_array('xmp', $amdConfig.amd_FillDataBaseIgnoreSchemas)}checked{/if}>&nbsp;XMP</label><br>
              {/if}
              {if !in_array('com', $amdConfig.amd_FillDataBaseExcludeFilters)}
              <label><input onclick='displayAnalyzedOption();' type="checkbox" id='iFillDataBaseIgnore_com' {if in_array('com', $amdConfig.amd_FillDataBaseIgnoreSchemas)}checked{/if}>&nbsp;COM</label>
              {/if}
            </td>
            <td style='border-left:1px dotted;'><br><span style='font-style:italic;margin-left:8px;'>{'g003_fillDatabaseIgnoreWarning'|@translate}</span></td>
          </tr>
        </table>
      {/if}
    </fieldset>

    <fieldset>
      <legend>{'g003_update_metadata'|@translate}</legend>
        <div>
          <div style='display: inline-block; border-right: 1px dotted; margin-right: 4px; padding-right: 8px;'>
            <label>
              <input type="radio" value="caddieAdd" name="fAMD_analyze_action" id="ianalyze_action2" checked>&nbsp;
              {'g003_analyze_caddie_add_pictures'|@translate}&nbsp;
            </label><br>

            <label>
              <input type="radio" value="caddieReplace" name="fAMD_analyze_action" id="ianalyze_action3">&nbsp;
              {'g003_analyze_caddie_replace_pictures'|@translate}&nbsp;
            </label><br>
          </div>
          <span style='font-style: italic; position: relative; top: -12px;'>{$datas.caddieNbPictures}</span>
        </div>

        <label>
          <input type="radio" value="notAnalayzed" name="fAMD_analyze_action" id="ianalyze_action0">&nbsp;
          {'g003_analyze_not_analyzed_pictures'|@translate}
        </label><br>

        <label>
          <input type="radio" value="all" name="fAMD_analyze_action" id="ianalyze_action1">&nbsp;
          {'g003_analyze_all_pictures'|@translate}
        </label><br>



          <input type="radio" value="randomList" name="fAMD_analyze_action" id="ianalyze_action5">&nbsp;
          {'g003_analyze_random_pictures'|@translate|replace:'%s':"<input type='text' size='4' id='ianalyze_action6' value='500' style='display:inline;' onfocus='$(&quot;#ianalyze_action5&quot;).attr(&quot;checked&quot;, true);'>"}
        <br>


        <span id='iAnalyzeAnalyzed' style='display:none;'>
          <label>
            <input type="radio" value="analyzed" name="fAMD_analyze_action" id="ianalyze_action4">&nbsp;
            {'g003_analyze_analyzed_pictures'|@translate}
          </label><br>
        </span>

        {if $amdConfig.amd_DisplayWarningsMessageUpdate=='y'}
          <div class="warnings">
            <p style="font-size: 120%;">{'g003_warning_on_analyze_0'|@translate}</p>
            <p>{'g003_warning_on_analyze_1'|@translate}</p>
            <p>{'g003_warning_on_analyze_2'|@translate}</p>
          </div>
        {/if}

        <br>
        <input type="hidden" id="iamd_NumberOfItemsPerRequest" value="{$datas.NumberOfItemsPerRequest}">
        <!--
        {'g003_setting_nb_items_per_request'|@translate}&nbsp;
        <div id="iamd_nb_item_per_request_slider"></div>
        <div id="iamd_nb_item_per_request_display"></div>
        <br><br>
        -->
        <input type="button" value="{'g003_analyze'|@translate}" onclick="doAnalyze();">
    </fieldset>
  </form>
</div>




<script type="text/javascript">
  init();
</script>
