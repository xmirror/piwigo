<table class="littlefont">
  {foreach from=$datas item=data}
  <tr>
    <td style="width:35%;min-width:340px;">{$data.tagId}</td>
    <td>{$data.label}</td>
    <th style="width:15%;">{$data.numOfRules}</th>
    <td width="40px">
      <img src="{$themeconf.admin_icon_dir}/edit_s.png"
           class="button" alt="{'g003_edit'|@translate}"
           title="{'g003_edit'|@translate}"
           onclick='udm.editMetadata({$data.numId});'/>
      <img src="{$themeconf.admin_icon_dir}/delete.png"
           class="button"
           alt="{'g003_delete'|@translate}"
           title="{'g003_delete'|@translate}"
           onclick='udm.deleteMetadata({$data.numId});'/>
    </td>
  </tr>
  {/foreach}
</table>
