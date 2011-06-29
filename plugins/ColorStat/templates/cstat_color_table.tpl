<table {if $data.id!=''}id="{$data.id}"{/if} {if $data.class!=''}class="{$data.class}"{/if} >
  {foreach from=$data.colorTable item=row}
  <tr>
    {foreach from=$row item=col}
    <td id="cellColor_{$col.color}" style="width:{$data.size}px;height:{$data.size}px;background-color:#{$col.color};{if $col.num!=''}cursor:pointer;{/if}" class="tiptip {if $col.num!=''}csSelectable{/if}"
        title="<table><tr style='vertical-align:middle;'><td><div style='display:inline-block;width:18px;height:18px;background-color:#{$col.color};'></div></td><td style='display:inline-block;'>{'cstat_color'|@translate}&nbsp;#{$col.color}{if $col.num!=''}&nbsp;:&nbsp;{$col.num}&nbsp;{'cstat_images'|@translate}{/if}{if $col.pct!=''} {$data.br} {'cstat_surface'|@translate}&nbsp;{$col.pct}%{/if}</td></tr></table>">
    </td>
    {/foreach}
  </tr>
  {/foreach}
</table>
