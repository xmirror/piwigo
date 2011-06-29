{footer_script}{literal}
  pwg_initialization_datepicker("#date_available_day", "#date_available_month", "#date_available_year", "#date_available_linked_date", "#date_available_action_set");
{/literal}{/footer_script}

<div id="set_date_available">
    <select id="date_available_day" name="date_available_day">
       <option value="0">--</option>
      {section name=day start=1 loop=32}
        <option value="{$smarty.section.day.index}" {if $smarty.section.day.index==$DATE_AVAILABLE_DAY}selected="selected"{/if}>{$smarty.section.day.index}</option>
      {/section}
    </select>
    <select id="date_available_month" name="date_available_month">
      {html_options options=$month_list selected=$DATE_AVAILABLE_MONTH}
    </select>
    <input id="date_available_year"
           name="date_available_year"
           type="text"
           size="4"
           maxlength="4"
           value="{$DATE_AVAILABLE_YEAR}">
    <input id="date_available_linked_date" name="date_available_linked_date" type="hidden" size="10" disabled="disabled">
</div>