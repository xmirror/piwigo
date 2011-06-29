{if not empty($contact_form_debug)}
  <div>{'cf_plugin_name'|@translate} - {'contact_form_debug'|@translate}</div>
  <ul>
  {foreach from=$contact_form_debug item=dbgelt key=dbgkey}
    <li style="list-style: none;">KEY={$dbgkey}
    <ul style="margin: 0px; padding-top:0px;">
    
    {foreach from=$dbgelt item=dbgval}
    <li><pre>{$dbgval}</pre></li>
    {/foreach}
    </ul>
    </li>
  {/foreach}
  </ul>
{/if}
