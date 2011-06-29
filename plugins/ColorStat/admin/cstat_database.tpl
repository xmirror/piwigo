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
    getStatus();
  }

  function getStatus()
  {
    data=$.ajax(
      {
        type: "POST",
        url: "{/literal}{$datas.urlRequest}{literal}",
        async: false,
        data: { ajaxfct:"updateDatabaseGetStatus" }
      }
    ).responseText;

    list=data.split(";");
    $("#ianalyzestatus").html("<ul><li>"+list[0]+"</li><li>"+list[1]+"</li><li>"+list[2]+"</li></ul>");
  }


  function doAnalyze()
  {
    mode="all";
    modeLabel="";

    if($("#ianalyze_action0").get(0).checked)
    {
      mode="notAnalyzed";
      modeLabel="{/literal}{'cstat_analyze_not_analyzed_pictures'|@translate}{literal}";
    }
    else if($("#ianalyze_action1").get(0).checked)
    {
      mode="all";
      modeLabel="{/literal}{'cstat_analyze_all_pictures'|@translate}{literal}";
    }
    else if($("#ianalyze_action2").get(0).checked)
    {
      mode="caddieAdd";
      modeLabel="{/literal}{'cstat_analyze_caddie_add_pictures'|@translate}{literal}";
    }
    else if($("#ianalyze_action3").get(0).checked)
    {
      mode="caddieReplace";
      modeLabel="{/literal}{'cstat_analyze_caddie_replace_pictures'|@translate}{literal}";
    }


    doAnalyzeDialog="<br><form id='iDialogProgress' class='formtable'>"+
      "<div id='iprogressbar_contener' class='gcBorderInput'>"+
      "<span id='iprogressbar_bg' class='gcBgInput' style='width:0%;'>&nbsp;</span>"+
      "<span id='iprogressbar_fg' class='gcLink'>0%</span>"+
      "</div><p>{/literal}{'cstat_analyze_in_progress'|@translate}{literal}"+
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
        title: '{/literal}{"cstat_updating_database"|@translate}{literal}&nbsp;('+modeLabel+')',
      }
    ).html(doAnalyzeDialog);

    NumberOfItemsPerRequest=$("#iNumberOfItemsPerRequest").val();

    $.ajax(
      {
        type: "POST",
        url: "{/literal}{$datas.urlRequest}{literal}",
        async: true,
        data: { ajaxfct:"updateDatabaseGetList", selectMode:mode, numOfItems:NumberOfItemsPerRequest },
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
      $.ajax(
      {
        type: "POST",
        url: "{/literal}{$datas.urlRequest}{literal}",
        async: true,
        data: { ajaxfct:"updateDatabaseDoAnalyze", imagesList:processAnalyze.lists[processAnalyze.step] },
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
        data: { ajaxfct:"updateDatabaseConsolidation" }
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
          title: '{/literal}{"cstat_updating_database"|@translate}{literal}',
          dialogClass: 'gcBgTabSheet gcBorder',
          open: function(event, ui)
          {
            bH=$("div.ui-dialog-buttonpane").get(0).clientHeight;
            $("#dialog").css('height', (this.clientHeight-bH)+"px");
          },
          buttons:
          {
            '{/literal}{"cstat_ok"|@translate}{literal}':
              function()
              {
                $(this).dialog('destroy').html("").get(0).removeAttribute('style');
              }
          }
        }
      )
      .html("<br>{/literal}{'cstat_analyze_is_finished'|@translate}{literal}&nbsp;("+displayTime(timeElapsed/1000)+")");

      getStatus();
    }
  }



</script>
{/literal}

<h2>{'cstat_status_of_database'|@translate}</h2>

<div id="dialog"></div>


<div id="ianalyzestatus">
  <ul>
    <li>{'cstat_loading'|@translate}</li>
    <li>{'cstat_loading'|@translate}</li>
    <li>{'cstat_loading'|@translate}</li>
  </ul>
</div>


<div id='ianalyzearea'>
  <fieldset>
    <legend>{'cstat_update_color_database'|@translate}</legend>
      <form class="formtable">
        <div class="nfo">
          <p>{'cstat_need_to_analyze'|@translate}</p>
        </div>

        <label>
          <input type="radio" value="caddieAdd" name="fAMD_analyze_action" id="ianalyze_action2" checked>&nbsp;
          {'cstat_analyze_caddie_add_pictures'|@translate}
        </label><br>

        <label>
          <input type="radio" value="caddieReplace" name="fAMD_analyze_action" id="ianalyze_action3">&nbsp;
          {'cstat_analyze_caddie_replace_pictures'|@translate}
        </label><br>


        <label>
          <input type="radio" value="notAnalayzed" name="fAMD_analyze_action" id="ianalyze_action0">&nbsp;
          {'cstat_analyze_not_analyzed_pictures'|@translate}
        </label><br>

        <label>
          <input type="radio" value="all" name="fAMD_analyze_action" id="ianalyze_action1">&nbsp;
          {'cstat_analyze_all_pictures'|@translate}
        </label><br>

        <div class="warning">
          <p style="font-weight:bold; font-size:+2;">{'cstat_warning_on_analyze_0'|@translate}</p>
          <p>{'cstat_warning_on_analyze_1'|@translate}</p>
          <p  style="font-weight:bold;">{'cstat_warning_on_analyze_2'|@translate}</p>
        </div>


        <br>
        <input type="hidden" id="iNumberOfItemsPerRequest" value="{$datas.numberOfItemsPerRequest}">
        <!--
        {'cstat_setting_nb_items_per_request'|@translate}&nbsp;
        <div id="iamd_nb_item_per_request_slider"></div>
        <div id="iamd_nb_item_per_request_display"></div>
        <br><br>
        -->

        <input type="button" value="{'cstat_analyze'|@translate}" onclick="doAnalyze();">

      </form>
  </fieldset>

</div>




<script type="text/javascript">
  init();
</script>
