{combine_script id="jquery.ui" path="themes/default/js/ui/minified/jquery.ui.core.min.js"}
{combine_script id="jquery.tipTip" path="themes/default/js/plugins/jquery.tipTip.minified.js" }

{literal}
<script type="text/javascript">
var tableSize='small';

  function init()
  {
    $('.tiptip').tipTip(
      {
        'delay' : 0,
        'fadeIn' : 0,
        'fadeOut' : 0,
        'edgeOffset' : 5,
      }
    );
  }

  function displayTable(size)
  {
    if(size=='small')
    {
      $("#iSmallColorTable").css('display', 'block');
      $("#iLargeColorTable").css('display', 'none');
    }
    else
    {
      $("#iSmallColorTable").css('display', 'none');
      $("#iLargeColorTable").css('display', 'block');
    }
    tableSize=size;
  }

  function submitForm()
  {
    $.ajax(
      {
        type: "POST",
        url: "{/literal}{$urlRequest}{literal}",
        async: true,
        data: { ajaxfct:"installProcess", tableSize:tableSize },
        success:
          function(msg)
          {
            window.location=document.URL; //just reload the page...
          }
      }
    );

  }

</script>
{/literal}

<form id="iSteps" method="post" action="" class="general">

  <fieldset id="iStep1">
    <legend>{'cstat_step_1'|@translate}</legend>

    <p>{$help.Step1}</p>

    <label><input type="radio" onclick="displayTable('small');" name="f_tablesize" name="iTableSizeSmall" value="small" checked> {'cstat_small_colortable'|@translate}</label><br>
    <label><input type="radio" onclick="displayTable('large');" name="f_tablesize" name="iTableSizeLarge" value="large"> {'cstat_large_colortable'|@translate}</label>

    <div id="iSmallColorTable">
      <table>
        <tr>
          <td style="min-width:350px;">{$smallTableColor}</td>

          <td style='padding-left:30px;vertical-align:top;'>
            <p>{$help.SmallColorTable}</p>
            <br>
            <table>
              <tr>
                <td><img src="./plugins/ColorStat/image/sample1.png"></td>
                <td style="width:20px;">&nbsp;</td>
                <td><img src="./plugins/ColorStat/image/sample2.png"></td>
              </tr>

              <tr>
                <td>
                  {'cstat_sample_color_associated'|@translate}
                  {$smallColorList1}
                </td>
                <td style="width:20px;">&nbsp;</td>
                <td>
                  {'cstat_sample_color_associated'|@translate}
                  {$smallColorList2}
                </td>
              </tr>
            </table>

          </td>
        </tr>
      </table>
    </div>

    <div id="iLargeColorTable" style="display:none;">
      <table>
        <tr>
          <td style="min-width:350px;">{$largeTableColor}</td>

          <td style='padding-left:30px;vertical-align:top;'>
            <p>{$help.LargeColorTable}</p>
            <br>
            <table>
              <tr>
                <td><img src="./plugins/ColorStat/image/sample1.png"></td>
                <td style="width:20px;">&nbsp;</td>
                <td><img src="./plugins/ColorStat/image/sample2.png"></td>
              </tr>

              <tr>
                <td>
                  {'cstat_sample_color_associated'|@translate}
                  {$largeColorList1}
                </td>
                <td style="width:20px;">&nbsp;</td>
                <td>
                  {'cstat_sample_color_associated'|@translate}
                  {$largeColorList2}
                </td>
              </tr>
            </table>

          </td>
        </tr>
      </table>
    </div>

  </fieldset>

  <input type="button" onclick='submitForm();'  value="{'cstat_validate'|@translate}">

</form>

<script type="text/javascript">
  init();
</script>

