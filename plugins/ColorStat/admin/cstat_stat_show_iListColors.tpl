<table class="littlefont" style="width:100%;" id="iListColorsTable">
  {foreach from=$datas key=name item=data}
  <tr>

    <td style="width:40px;background-color:#{$data.color_id};">&nbsp;</td>
    <td class="colorFont">#{$data.color_id}</td>

    <td width="60px">{$data.num_images}</td>
    <td width="40px">{$data.pct_images}</td>
    <td width="110px">
      <div class="pctBar{$themeconf.name}" style="width:{$data.pct_images}px;"></div>
    </td>

    <td width="80px">{$data.num_pixels}</td>
    <td width="40px">{$data.pct_pixels}</td>
    <td width="110px">
      <div class="pctBar{$themeconf.name}" style="width:{$data.pct_pixels}px;"></div>
    </td>

  </tr>
  {/foreach}
</table>

