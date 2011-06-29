
{foreach from=$datas.dialogBox item=dialogBox}
  {$dialogBox.content}
{/foreach}

{if is_admin()}
<div id='iRBCaddieNfo'></div>
{/if}

<form id='iRBCriteriaForm'>
  <fieldset>
    <legend>{'gpc_rb_search_criterion'|@translate}</legend>

    <div id='iRequestCriterions' class='cRequestCriterions'>
      <div style='width:100%;min-height:250px;margin-bottom:8px;'>
        <ul id='iListSelectedCriterions'>
        </ul>
      </div>

      <div id='iMenuCriterions' >
        <div id='iMenuCTitle' class='gcLink gcBgInput cbButtons'>
          <div id='iMenuCText'>{'gpc_rb_add_criterions'|@translate}&nbsp;&dArr;</div>
          <div id='iMenuCItems'>
            <ul class='gcBgInput'>
              {foreach from=$datas.dialogBox item=dialogBox}
                <li class='gcBgInput'><a onclick="{$dialogBox.handle}.show({literal}{cBuilder:cb}{/literal});">{$dialogBox.label}</a></li>
              {/foreach}
            </ul>
          </div>
        </div>
      </div>

      <div class='gcBgInput cbButtons'>{literal}<a onclick="cb.doAction('clear');">{/literal}{'gpc_rb_clear_criterions'|@translate}</a></div>
    </div>
    <div class='cModifyRequest' style='display:none;'>
      <div class='gcBgInput cbButtons'>{literal}<a onclick="im.doAction('show', 'buildQuery');">{/literal}{'gpc_rb_do_modify_request'|@translate}</a></div>
    </div>

  </fieldset>

  <input type="button" class='cRequestCriterions' onclick="cb.doAction('send');" value="{'gpc_rb_search'|@translate}">
</form>


<fieldset id='iResultQuery' style='display:none;' class='cResultQuery'>
  <legend>{'gpc_rb_result_query'|@translate}</legend>

  <div id='iResultQueryContent' style='width:100%;min-height:250px;max-height:450px;overflow:auto;margin-bottom:8px;'></div>

  <div class='gcBgInput gcTextInput'>
    <div id='iPagesNavigator' style='float:right;'></div>
    <div style='text-align:left;padding:4px;'>
      {'gpc_rb_number_of_item_found'|@translate}&nbsp;:&nbsp;<span id='iResultQueryNfo'></span>

      {if is_admin()}
      <div id='iMenuCaddie' style='display:inline-block;'>
        <div id='iMenuCaddieBar'>
          <div id='iMenuCaddieText' class='gcLink gcBgInput'>{'gpc_manage_caddie'|@translate}&dArr;
          <div id='iMenuCaddieImg' style='display:none;width:16px;height:16px;background:url(./plugins/GrumPluginClasses/icons/processing.gif) no-repeat 0 0 transparent;'>&nbsp;</div>
          <div id='iMenuCaddieItems'>
            <ul class='gcBgInput'>
              <li class='gcBgInput'><a onclick="im.doAction('fillCaddie', 'add');">{'gpc_add_caddie'|@translate}</a></li>
              <li class='gcBgInput'><a onclick="im.doAction('fillCaddie', 'replace');">{'gpc_replace_caddie'|@translate}</a></li>
            </ul>
          </div>
        </div>
      </div>
      {/if}

    </div>
  </div>
</fieldset>


<script type="text/javascript">
  {foreach from=$datas.dialogBox item=dialogBox}
  var {$dialogBox.handle}=new {$dialogBox.dialogBoxClass}();
  {/foreach}

  $('.ui-dialog').css('overflow', 'visible');

  init();
</script>
