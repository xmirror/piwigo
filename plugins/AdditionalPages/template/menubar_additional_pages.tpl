<dt>{$block->get_title()}</dt>
  <dd>
    <ul>
    {foreach from=$block->data item=data}
      <li>
        <a href="{$data.URL}">{$data.LABEL}</a>
      </li>
    {/foreach}
    </ul>
  </dd>
