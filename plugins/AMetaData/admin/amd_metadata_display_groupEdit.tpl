{literal}
<script type="text/javascript">
  function change_lang()
  {
    selectedLang=$("#iLang").get(0).options[$("#iLang").get(0).selectedIndex].value;
    $("#iEditGroupName").val($("#iName_"+selectedLang).val());
  }

  function apply_change()
  {
    selectedLang=$("#iLang").get(0).options[$("#iLang").get(0).selectedIndex].value;
    $("#iName_"+selectedLang).val($("#iEditGroupName").val());
  }
</script>
{/literal}


<form class='dialogForm'>
  <label>{'g003_name'|@translate}&nbsp;
    <input type='text' id='iEditGroupName' onkeyup='apply_change();' value="{$datasLang.default}">
  </label>&nbsp;

    {if isset($datasLang.language_list) and count($datasLang.language_list)}
      {foreach from=$datasLang.language_list key=name item=language_row}
        <input type='hidden' id='iName_{$name}' value='{$language_row.name}' size=60 maxlength =80>
      {/foreach}
    {/if}

    <select id='iLang' onchange='change_lang();'>
    {if isset($datasLang.language_list) and count($datasLang.language_list)}
      {foreach from=$datasLang.language_list key=name item=language_row}
        <option value='{$name}' {if $datasLang.lang_selected==$name}selected{/if}>{$language_row.langName}</option>
      {/foreach}
    {/if}
    </select>
</form>
