
{literal}
<script type="text/javascript">

  function submitForm()
  {
    $('#btSubmit').css('display', 'none');
    $('#iImgWait').css('display', 'block');

    if($('#iInterfaceModeB').get(0).checked)
    {
      interfaceMode='basic';
    }
    else
    {
      interfaceMode='advanced';
    }

    $.ajax(
      {
        type: "POST",
        url: "{/literal}{$urlRequest}{literal}",
        async: true,
        data: { ajaxfct:"admin.install.chooseInterface", interfaceMode:interfaceMode },
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
    <legend>{'g003_step_1'|@translate}</legend>

    <p>{$help.Step1}</p>

    <ul style='list-style:none;'>

    <li>
      <label><input type="radio" name="f_interfaceMode" id="iInterfaceModeB" value="basic" checked> {'g003_basic_mode'|@translate}</label><br>
      {$help.g003_basic_mode_help}<br>&nbsp;
    </li>
    <li>
      <label><input type="radio" name="f_interfaceMode" id="iInterfaceModeA" value="advanced"> {'g003_advanced_mode'|@translate}</label><br>
      {$help.g003_advanced_mode_help}
    </li>
    </ul>


  </fieldset>

  <input id='btSubmit' type="button" onclick='submitForm();'  value="{'g003_validate'|@translate}">
  <img id='iImgWait' src='./plugins/GrumPluginClasses/icons/processing.gif' style='display:none;margin-left:40px;'>

</form>


