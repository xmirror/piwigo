<table class="littlefont">
  {foreach from=$datas key=name item=data}
  <tr onclick="updateTagSelect('iNumId{$data.numId}', 'switch');">
    <td style="width:35%;min-width:340px;">
      <a id="iNumIdA{$data.tagId}" class="cbiListTags" >[&nbsp;?&nbsp;]</a>&nbsp;
      <input type="checkbox" id="iNumId{$data.numId}" class="cbiListTags" {$data.tagChecked}>&nbsp;{$data.tagId}
    </td>
    <td>{$data.label}</td>
    <td width="80px">{$data.nb}</td>
    <td width="40px">{$data.pct}</td>
    <td width="110px">
      <div class="pctBar{$themeconf.name}" style="width:{$data.pct}px;"></div>
    </td>
  </tr>
  {/foreach}
</table>
