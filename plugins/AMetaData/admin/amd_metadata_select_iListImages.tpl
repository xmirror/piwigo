<table class="littlefont">
  {foreach from=$datas key=name item=data}
  <tr>
    <td>{$data.value}</td>
    <td width="80px">{$data.nb}</td>
    <td width="40px">{$data.pct}</td>
    <td width="110px">
      <div class="pctBar{$themeconf.name}" style="width:{$data.pct}px;"></div>
    </td>

  </tr>
  {/foreach}
</table>
