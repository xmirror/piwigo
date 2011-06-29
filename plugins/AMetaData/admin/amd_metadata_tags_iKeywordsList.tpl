{literal}
<script type="text/javascript">
  function switchState(tagId)
  {
    $("#"+tagId).get(0).checked=!$("#"+tagId).get(0).checked;
  }
</script>
{/literal}

{if count($datas)>0}
<table class="littlefont listTags {$themeconf.name}" style="width:100%;">
  {foreach from=$datas key=name item=data}
  <tr>
    <td width="15px">
      <input type="checkbox" id="iTagId{$data.id}">
      <input type="hidden" id="iTagValue{$data.id}" value="{$data.value}">
    </td>
    <td style="min-width:325px;" onclick="switchState('iTagId{$data.id}');">{$data.value}</td>
    <td style="width:120px;" onclick="switchState('iTagId{$data.id}');">{$data.nbPictures}</td>
    <td style="width:120px;" onclick="switchState('iTagId{$data.id}');">{'g003_'|cat:$data.tagExists|@translate}</td>
    <td style="width:120px;" onclick="switchState('iTagId{$data.id}');">{if $data.nbPicturesTagged!='0'}{$data.nbPicturesTagged}{/if}</td>
  </tr>
  {/foreach}
</table>
{else}
<br>
{'g003_no_keywords'|@translate}
{/if}
