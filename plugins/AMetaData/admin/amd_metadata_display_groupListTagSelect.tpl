{literal}
<script type="text/javascript">
  function switchState(tagId)
  {
    $("#"+tagId).get(0).checked=!$("#"+tagId).get(0).checked;
  }
</script>
{/literal}


<table class="littlefont listTags {$themeconf.name}" style="width:100%;">
  {foreach from=$datas key=name item=data}
  <tr>
    <td width="30px"><input type="checkbox" id="iTagId{$data.numId}" {$data.state}></td>
    <td onclick="switchState('iTagId{$data.numId}');">{$data.tagId}</td>
    <td onclick="switchState('iTagId{$data.numId}');">{$data.name}</td>
  </tr>
  {/foreach}
</table>
