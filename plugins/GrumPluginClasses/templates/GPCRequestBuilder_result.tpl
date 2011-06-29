<ul class='rbResultList'>
  {foreach from=$datas item=row}
  <li>
    <table>
      <tr>
        <td>
          <img class="thumbnail" src='{$row.imageThumbnail}'>
        </td>

        <td class="rbResultItemDetail">
          {if $row.imageName!=''}{$row.imageName}<br>{/if}
          {foreach from=$row.imageCategories key=catname item=catdata name=catlist}
<a href="{$catdata.link}">{$catdata.name}</a>{if $smarty.foreach.catlist.last}<br/>{else},&nbsp;{/if}
          {/foreach}
          <hr>
          {foreach from=$row.plugin item=plugin}
          {$plugin}<br>
          {/foreach}
        </td>

      </tr>
    </table>

  </li>
  {/foreach}


</ul>

