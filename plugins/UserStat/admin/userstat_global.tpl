

<div class="table">

{if isset($datas.propertiesUsers) and count($datas.propertiesUsers)}

<table class="table2 littlefont" >
  <tr class="throw">
    <td>{'us_property'|@translate}</td>
    <td>{'us_numberOfUsers'|@translate}</td>
  </tr>
  {foreach from=$datas.propertiesUsers key=name item=data}
    {if $data.property == "total" || $data.property == "withMail" || $data.property == "withHD" }
      <tr class="StatTableRow">
        <td>{$data.label}</td>
        <td>{$data.value}</td>
      </tr>
    {/if}
  {/foreach}
</table>
{/if}

</div>


<div class="table">

{if isset($datas.languagesUsers) and count($datas.languagesUsers)}
<table class="table2 littlefont" >
  <tr class="throw">
    <td>{'us_lang'|@translate}</td>
    <td>{'us_numberOfUsers'|@translate}</td>
  </tr>
  {foreach from=$datas.languagesUsers key=name item=data}
    <tr class="StatTableRow">
      <td>{$data.humanReadable}</td>
      <td>{$data.nbUsers}</td>
    </tr>
  {/foreach}
</table>
{/if}

</div>

<div class="table">

{if isset($datas.templatesUsers) and count($datas.templatesUsers)}
<table class="table2 littlefont" >
  <tr class="throw">
    <td>{'us_template'|@translate}</td>
    <td>{'us_numberOfUsers'|@translate}</td>
  </tr>
  {foreach from=$datas.templatesUsers key=name item=data}
    <tr class="StatTableRow">
      <td>{$data.theme}</td>
      <td>{$data.nbUsers}</td>
    </tr>
  {/foreach}
</table>
{/if}

</div>
