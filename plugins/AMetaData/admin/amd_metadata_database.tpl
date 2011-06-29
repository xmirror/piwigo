{combine_script id="jquery.ui" path="themes/default/js/ui/minified/jquery.ui.core.min.js"}
{combine_script id="jquery.ui.dialog" path="themes/default/js/ui/minified/jquery.ui.dialog.min.js"}

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
    /*$("#iamd_nb_item_per_request_slider").slider(
      {
        min:5,
        max:150,
        steps:29,
        startValue:{/literal}{$datas.NumberOfItemsPerRequest}{literal},
        slide: function(event, ui) { formatNbItemPerRequest(ui.value); }
      }
    );*/
    getStatus();
  }

  function formatNbItemPerRequest(nbItems)
  {
    $("#iamd_NumberOfItemsPerRequest").val(nbItems);
    $("#iamd_nb_item_per_request_display").html(nbItems);
  }

  function getStatus()
  {
    $.ajax(
      {
        type: "POST",
        url: "{/literal}{$datas.urlRequest}{literal}",
        async: true,
        data: { ajaxfct:"admin.makeStats.getStatus" },
        success: function (msg) {
          list=msg.split(";");
          $("#ianalyzestatus").html("<ul><li>"+list[0]+"</li><li>"+list[1]+"</li><li>"+list[2]+"</li></ul>");
        }
      }
    );
  }

  function doAnalyze()
  {
    mode="all";
    modeLabel="";

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


    doAnalyzeDialog="<br><form id='iDialogProgress' class='formtable'>"+
      "<div id='iprogressbar_contener' class='gcBorderInput'>"+
      "<span id='iprogressbar_bg' class='gcBgInput' style='width:0%;'>&nbsp;</span>"+
      "<span id='iprogressbar_fg' class='gcLink'>0%</span>"+
      "</div><p>{/literal}{'g003_analyze_in_progress'|@translate}{literal}"+
      "<br><img src='./plugins/GrumPluginClasses/icons/processing.gif'>"
      "</p></form>";

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
        data: { ajaxfct:"admin.makeStats.getList", selectMode:mode, numOfItems:NumberOfItemsPerRequest },
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

      getStatus();
    }
  }



</script>
{/literal}

<h2>{'g003_status_of_database'|@translate}</h2>

<div id="dialog"></div>


<div id="ianalyzestatus">
  <ul>
    <li>{'g003_loading'|@translate}</li>
    <li>{'g003_loading'|@translate}</li>
    <li>{'g003_loading'|@translate}</li>
  </ul>
</div>

<div class="nfo">
  <ul>
    <li>{'g003_warning_on_analyze_4a'|@translate}</li>
    <li>{'g003_warning_on_analyze_4b'|@translate}</li>
  </ul>
</div>


<div id='ianalyzearea'>
  <fieldset>
    <legend>{'g003_update_metadata'|@translate}</legend>
      <form class="formtable">
        <div class="nfo">
          <p>{'g003_warning_on_analyze_3'|@translate}</p>
          <ul>
            <li>{'g003_warning_on_analyze_3a'|@translate}</li>
            <li>{'g003_warning_on_analyze_3b'|@translate}</li>
          </ul>

          <p>{'g003_warning_on_analyze_5'|@translate}</p>
        </div>

        <label>
          <input type="radio" value="caddieAdd" name="fAMD_analyze_action" id="ianalyze_action2" checked>&nbsp;
          {'g003_analyze_caddie_add_pictures'|@translate}
        </label><br>

        <label>
          <input type="radio" value="caddieReplace" name="fAMD_analyze_action" id="ianalyze_action3">&nbsp;
          {'g003_analyze_caddie_replace_pictures'|@translate}
        </label><br>


        <label>
          <input type="radio" value="notAnalayzed" name="fAMD_analyze_action" id="ianalyze_action0">&nbsp;
          {'g003_analyze_not_analyzed_pictures'|@translate}
        </label><br>

        <label>
          <input type="radio" value="all" name="fAMD_analyze_action" id="ianalyze_action1">&nbsp;
          {'g003_analyze_all_pictures'|@translate}
        </label><br>

        <div class="warning">
          <p style="font-weight:bold; font-size:+2;">{'g003_warning_on_analyze_0'|@translate}</p>
          <p>{'g003_warning_on_analyze_1'|@translate}</p>
          <p  style="font-weight:bold;">{'g003_warning_on_analyze_2'|@translate}</p>
        </div>


        <br>
        <input type="hidden" id="iamd_NumberOfItemsPerRequest" value="{$datas.NumberOfItemsPerRequest}">
        <!--
        {'g003_setting_nb_items_per_request'|@translate}&nbsp;
        <div id="iamd_nb_item_per_request_slider"></div>
        <div id="iamd_nb_item_per_request_display"></div>
        <br><br>
        -->

        <input type="button" value="{'g003_analyze'|@translate}" onclick="doAnalyze();">

      </form>
  </fieldset>

</div>




<script type="text/javascript">
  init();
</script>
