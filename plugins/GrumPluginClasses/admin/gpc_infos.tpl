
<h3>{'List of shared modules'|@translate}</h3>
<div class="table">

  <table class="table2 littlefont" >
    <tr class="throw">
      <td>{'Module'|@translate}</td>
      <td>{'Version'|@translate}</td>
    </tr>
    {foreach from=$datas.modules key=name item=data name=plugins_loop}
      <tr class="StatTableRow {if $smarty.foreach.plugins_loop.index is odd}row1{else}row2{/if}">
        <td>{$data.name}</td>
        <td>{$data.version}</td>
      </tr>
    {/foreach}
  </table>

</div>


<h3>{'List of installed plugins using Grum Plugin Classes'|@translate}</h3>
<div class="table">

  <table class="table2 littlefont" >
    <tr class="throw">
      <td>{'Plugin'|@translate}</td>
      <td>{'Version'|@translate}</td>
      <td>{'GPC required'|@translate}</td>
      <td>{'Installed'|@translate}</td>
    </tr>

    {foreach from=$datas.plugins key=name item=data name=plugins_loop}
      <tr class="StatTableRow {if $smarty.foreach.plugins_loop.index is odd}row1{else}row2{/if}">
        <td>{$data.name}</td>
        <td>{$data.release}</td>
        <td>{$data.needed}</td>
        <td>{$data.date}</td>
      </tr>
    {/foreach}

  </table>

</div>
