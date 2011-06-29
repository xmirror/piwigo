{if isset($tabsheet) and count($tabsheet)}
<ul {if isset($tabsheet_classes)}class="{$tabsheet_classes}"{/if} {if isset($tabsheet_id)}id="{$tabsheet_id}"{/if} >
{foreach from=$tabsheet key=name item=sheet name=tabs}
  <li {if isset($tabsheet_id)}id="{$tabsheet_id}{$name}"{/if} class="{$tab_classes.normal} {if ($name == $tabsheet_selected)}{$tab_classes.selected}{else}{$tab_classes.unselected}{/if}">
    <a {if $sheet.url!=''}href="{$sheet.url}"{/if} {if $sheet.onClick!=''}onclick="{$sheet.onClick}"{/if} ><span>{$sheet.caption}</span></a>
  </li>
{/foreach}
</ul>

  {if isset($tabsheet_id)}
  {literal}
  <script type="text/javascript">
    $('#{/literal}{$tabsheet_id}{literal} li a').bind('click',
      function ()
      {
        $('#{/literal}{$tabsheet_id}{literal} li').removeClass('{/literal}{$tab_classes.selected}{literal}').addClass('{/literal}{$tab_classes.unselected}{literal}');
        $(this.parentNode).removeClass('{/literal}{$tab_classes.unselected}{literal}').addClass('{/literal}{$tab_classes.selected}{literal}');
      }
    );
  {/literal}
  </script>

  {/if}

{/if}
