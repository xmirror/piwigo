{combine_script id="jquery.ui" path="themes/default/js/ui/minified/jquery.ui.core.min.js"}
{combine_script id="jquery.ui.dialog" path="themes/default/js/ui/minified/jquery.ui.dialog.min.js"}

{combine_script id="gpc.external.interface" path="plugins/GrumPluginClasses/js/external/interface/interface.js" require="jquery.ui"}
{combine_script id="gpc.external.inestedsortable" path="plugins/GrumPluginClasses/js/external/inestedsortable.pack.js" require="gpc.external.interface"}
{combine_script id="tagListSelector" path="plugins/AMetaData/js/tagListSelector.js" require="jquery"}


{literal}
<script type="text/javascript">


  function userDefManage ()
  {
    var options = {
      numId:'',
      newRuleId:1,
      optimalHeight:0,
    }

    /**
     * initialize the page
     */
    this.init = function ()
    {
      computedHeight=$(window).height()-100;
      $('#iDialogEdit')
        .dialog(
          {
            autoOpen:false,
            width:900,
            height:computedHeight,
            modal: true,
            dialogClass: 'gcBgTabSheet gcBorder',
            title: '{/literal}{"g003_personnal_metadata"|@translate}{literal}',
            buttons:
              {
                '{/literal}{"g003_ok"|@translate}{literal}':
                  function()
                  {
                    if(checkValidity()) doUpdate();
                  },
                '{/literal}{"g003_cancel"|@translate}{literal}':
                  function()
                  {
                    $('#iDialogEdit').dialog("close");
                  }
              }
          }
        );

      $('#iBDTagId').bind('keyup focusout', function (event)
        {
          if(!checkTagIdValidity($(this).val()))
          {
            $(this).addClass('error');
          }
          else
          {
            $(this).removeClass('error');
          }
        }
      );


      loadList();
    }

    /**
     * open the dialog box to edit the metadata properties
     *
     * @param String id : if set to '' => open dialogbox in 'add' mode
     *                    otherwise edit the given metadata
     */
    this.editMetadata = function (id)
    {
      options.numId=id;
      updateDialog('');

      $('#iDialogEdit')
        .bind('dialogopen', function ()
          {
            if(options.numId!='')
            {
              displayProcessing(true);

              $.ajax(
                {
                  type: "POST",
                  url: "{/literal}{$datas.urlRequest}{literal}",
                  async: true,
                  data: { ajaxfct:"admin.userDefined.getTag", id:options.numId },
                  success:
                    function(msg)
                    {
                      updateDialog(msg);
                      displayProcessing(false);
                    }
                }
              );
            }

            options.optimalHeight=$('#iDialogEdit').height()-$('#mdRulesArea').position().top;
            $('#mdRulesArea').css('height', options.optimalHeight+'px' );
          }
        )
        .dialog("open");
    }

    /**
     * delete a metadata
     *
     * @param String id : id of the metadata to delete
     */
    this.deleteMetadata = function (id)
    {
      $('#iDialogDelete')
        .html('<br>{/literal}{"g003_pleaseConfirmMetadataDelete"|@translate}{literal}')
        .dialog(
          {
            autoOpen:true,
            modal: true,
            dialogClass: 'gcBgTabSheet gcBorder',
            title: '{/literal}{"g003_deleteMetadata"|@translate}{literal}',
            buttons:
              {
                '{/literal}{"g003_delete"|@translate}{literal}':
                  function()
                  {
                    $(this).html("<br><img src='./plugins/GrumPluginClasses/icons/processing.gif'>");
                    $.ajax(
                      {
                        type: "POST",
                        url: "{/literal}{$datas.urlRequest}{literal}",
                        async: true,
                        data: { ajaxfct:"admin.userDefined.deleteTag", id:id },
                        success:
                          function(msg)
                          {
                            $('#iDialogDelete').dialog("destroy");
                            loadList();
                          }
                      }
                    );
                  },
                '{/literal}{"g003_cancel"|@translate}{literal}':
                  function()
                  {
                    $('#iDialogDelete').dialog("destroy");
                  }
              }
          }
        );
    }

    /**
     * update values of the dialog box
     *
     * @param String items : json string ; if empty assume to reset all fields
     *                       with blank
     */
    var updateDialog = function (items)
    {
      if(items=='')
      {
        options.newRuleId=1;
        $('#iBDNumId').val('');
        $('#iBDTagId').val('');
        $('#iBDLabel').val('');
        $('#iBDRules').html('');
      }
      else
      {
        tmp=$.parseJSON(items);

        options.newRuleId=tmp.lastDefId+1;
        $('#iBDNumId').val(tmp.numId);
        $('#iBDTagId').val(tmp.tagId);
        $('#iBDLabel').val(tmp.label);
        $('#iBDRules').html('');
        for(i=0;i<tmp.rules.length;i++)
        {
          addRule(tmp.rules[i]);
        }
      }
    }

    /**
     * reload the user defined metadata list
     */
    var loadList = function ()
    {
      $('#iListTags').html("<br>{/literal}{'g003_loading'|@translate}{literal}<br><img src='./plugins/GrumPluginClasses/icons/processing.gif'>");

      $.ajax(
        {
          type: "POST",
          url: "{/literal}{$datas.urlRequest}{literal}",
          async: true,
          data: { ajaxfct:"admin.userDefined.getList" },
          success:
            function(msg)
            {
              $("#iListTags").html(msg);
            }
        }
      );
    }

    /**
     * check the validity of a given tagId
     *  a valid tagId only contains chars : A-Z0-9.
     *  a valid tagId can't start or finish with a dot, and a dot can't repeat
     *  "machin.truc.much" => ok
     *  ".machin.truc"     => ko
     *  "machin.truc."     => ko
     *  "machin..truc"     => ko
     *
     * @param String tagId : the tagId
     * @return Boolean : true if ok, otherwise false
     */
    var checkTagIdValidity = function (tagId)
    {
      re=/^(?:[a-z0-9]+\.)*[a-z0-9]+$/i;
      if(re.exec(tagId)==null) return(false);
      return(true);
    }

    /**
     * this function make the groups&items ready to be sorted & grouped
     */
    var applyNested = function ()
    {
      $('#iBDRules').NestedSortableDestroy();
      $('#iBDRules').NestedSortable(
        {
          accept: 'rmSortable',
          noNestingClass: 'rmItem',
          opacity: 0.8,
          helperclass: 'helper',
          serializeRegExp:/.*/i,
          autoScroll: true,
          handle: '.rmSortHandle',
          ghosting:false,
          nestingPxSpace:5,

          onChange: function(serialized)
            {
              $('#mdRulesArea li.rmSortable').each(
                function ()
                {
                  checkSubRules(this.id);
                }
              );
              checkDialogHeight();
            },
          onHover: function (draggedItem)
            {
              $('#mdRulesArea').scrollTop($('#sortHelper').position().top);
            }
        }
      );
    }

    /**
     * create a rule item and add it to the rulesArea
     *
     * the given object properties have the structure of a user_tags_def record
     *  - itemId
     *  - parentId
     *  - numId
     *  - type
     *  - value
     *  - ifType
     *  - ifValue
     *  - elseId
     *  - order
     *
     * @param Object properties : an object with rules properties
     */
    this.addRule = function (properties)
    {
      addRule(properties);
    }
    var addRule = function (properties)
    {
      if(properties.defId==null)
      {
        properties={
          defId:options.newRuleId++,
          parentId:0,
          numId:options.numId,
          type:'T',
          value:'',
          conditionType:'E',
          conditionValue:'',
          order:-1
        }
      }

      if(properties.parentId==0)
      {
        $('#iBDRules').append($('#iBDModel').html().split('ZZZZZ').join(properties.defId));
      }
      else
      {
        $('#iBDSubRulesNum'+properties.parentId).append($('#iBDModel').html().split('ZZZZZ').join(properties.defId));
      }

      $('#iBDRuleType'+properties.defId).val(properties.type).change();
      switch(properties.type)
      {
        case 'T':
          $('#iBDRuleTypeT'+properties.defId).val(properties.value);
          break;
        case 'M':
          $('#iBDRuleTypeM'+properties.defId).attr('value', properties.value);
          $('#iBDRuleTypeM'+properties.defId+' span.ruleContent').html($('#iTagListItem'+properties.value).html());
          break;
        case 'C':
          $('#iBDRuleTypeCM'+properties.defId).attr('value', properties.value);
          $('#iBDRuleTypeCM'+properties.defId+' span.ruleContent').html($('#iTagListItem'+properties.value).html());
          $('#iBDRuleTypeCIf'+properties.defId).val(properties.conditionType).change();
          $('#iBDRuleTypeCIfValue'+properties.defId).val(properties.conditionValue);
          break;
      }
      applyNested();
      checkDialogHeight();
    }

    /**
     *
     */
    this.deleteRule = function (id)
    {
      $('#iBDRuleNum'+id).remove();
      $('#mdRulesArea li.rmSortable').each(
        function ()
        {
          checkSubRules(this.id);
        }
      );
      checkDialogHeight();
    }

    /**
     *
     */
    this.changeRuleType = function (id)
    {
      if($('#iBDRuleType'+id).val()=='T')
      {
        $('#iBDRuleNum'+id).addClass('rmItem');
        $('#iBDRuleTypeT'+id).css('display', 'inline');
        $('#iBDRuleTypeM'+id).css('display', 'none');
        $('#iBDRuleTypeC'+id).css('display', 'none');
      }
      else if($('#iBDRuleType'+id).val()=='M')
      {
        $('#iBDRuleNum'+id).addClass('rmItem');
        $('#iBDRuleTypeT'+id).css('display', 'none');
        $('#iBDRuleTypeM'+id).css('display', 'inline-block');
        $('#iBDRuleTypeC'+id).css('display', 'none');
      }
      else if($('#iBDRuleType'+id).val()=='C')
      {
        $('#iBDRuleNum'+id).removeClass('rmItem');
        $('#iBDRuleTypeT'+id).css('display', 'none');
        $('#iBDRuleTypeM'+id).css('display', 'none');
        $('#iBDRuleTypeC'+id).css('display', 'inline-block');
      }
      checkDialogHeight();
    }

    /**
     * display/hide the 'ifValue' property
     */
    this.changeRuleTypeCIf = function (id)
    {
      value=$('#iBDRuleTypeCIf'+id).val();
      if(value=='E' || value =='!E')
      {
        $('#iBDRuleTypeCIfValue'+id).css('display', 'none');
      }
      else
      {
        $('#iBDRuleTypeCIfValue'+id).css('display', 'inline');
      }
      checkDialogHeight();
    }

    /**
     * check if there is subrules affected to the item (conditionned by the 'condition' type)
     * if subrules are present, disable the selector
     */
    var checkSubRules = function (parentId)
    {
      value=$('#'+parentId).attr('value');

      if($('#iBDRuleType'+value).val()=='C' && $('#iBDSubRulesNum'+value+' li').length>0)
      {
        $('#iBDRuleType'+value).get(0).disabled=true;
      }
      else
      {
        $('#iBDRuleType'+value).get(0).disabled=false;
      }
    }

    /**
     * check if it necessary to calculate the height of the dialogbox
     */
    var checkDialogHeight = function()
    {
      if($('#iBDRules').height() < options.optimalHeight &&
         $('#mdRulesArea').get(0).scrollHeight > options.optimalHeight)
      {
        $('#iDialogEdit').height(options.optimalHeight+$('#mdRulesArea').get(0).offsetTop);
        $('#mdRulesArea').height(options.optimalHeight);
      }
      else if($('#mdRulesArea').get(0).scrollHeight > options.optimalHeight)
      {
        $('#iDialogEdit').height($('#mdRulesArea').get(0).scrollHeight+$('#mdRulesArea').get(0).offsetTop);
        $('#mdRulesArea').height($('#mdRulesArea').get(0).scrollHeight);
      }
    }

    /**
     * check for the validity of the metadata settings
     */
    var checkValidity = function ()
    {
      $('.error').removeClass('error');

      ok=true;

      if(checkTagIdValidity($('#iBDTagId').val())==false)
      {
        $('#iBDTagId').addClass('error');
        alert('{/literal}{"g003_invalidId"|@translate}{literal}');
        ok=false;
      }

      if($('#iBDRules li').length==0)
      {
        $('#iBDRules').addClass('error');
        alert('{/literal}{"g003_oneRuleIsNeeded"|@translate}{literal}');
        ok=false;
      }
      else
      {
        $('#iBDRules li').each(
          function ()
          {
            value=$(this).attr('value');
            switch($('#iBDRuleType'+value).val())
            {
              case 'T':
                if($('#iBDRuleTypeT'+value).val()=='')
                {
                  $('#iBDRuleTypeT'+value).addClass('error');
                  alert('{/literal}{"g003_textRuleInvalid"|@translate}{literal}');
                  ok=false;
                }
                break;
              case 'M':
                if($('#iBDRuleTypeM'+value).attr('value')=='-')
                {
                  $('#iBDRuleTypeM'+value).addClass('error');
                  alert('{/literal}{"g003_metadataRuleInvalid"|@translate}{literal}');
                  ok=false;
                }
                break;
              case 'C':
                if($('#iBDRuleTypeCM'+value).attr('value')=='-')
                {
                  $('#iBDRuleTypeCM'+value).addClass('error');
                  alert('{/literal}{"g003_conditionMdRuleInvalid"|@translate}{literal}');
                  ok=false;
                }

                if($('#iBDSubRulesNum'+value+' li').length==0)
                {
                  $('#iBDSubRulesNum'+value).addClass('error');
                  alert('{/literal}{"g003_conditionRulesRuleInvalid"|@translate}{literal}');
                  ok=false;
                }
                break;
            }
          }
        );
      }
      return(ok);
    }

    /**
     * send metadata update to the server, and close the dialog box if everything
     * is ok
     */
    var doUpdate = function ()
    {
      displayProcessing(true);

      // build datas
      properties = {
        tagId:$('#iBDTagId').val(),
        name:$('#iBDLabel').val(),
        rules: [ ]
      }

      order=1;
      $('#iBDRules li').each(
        function ()
        {
          defId=$(this).attr('value');
          type=$('#iBDRuleType'+defId).val();
          switch(type)
          {
            case 'T':
              value=$('#iBDRuleTypeT'+defId).val();
              conditionType='';
              conditionValue='';
              break;
            case 'M':
              value=$('#iBDRuleTypeM'+defId).attr('value');
              conditionType='';
              conditionValue='';
              break;
            case 'C':
              value=$('#iBDRuleTypeCM'+defId).attr('value');
              conditionType=$('#iBDRuleTypeCIf'+defId).val();
              conditionValue=$('#iBDRuleTypeCIfValue'+defId).val();
              break;
          }

          properties.rules.push(
            {
              defId:defId,
              parentId:$(this).parent().parent().attr('value'),
              type:type,
              value:value,
              conditionType:conditionType,
              conditionValue:conditionValue,
              order:order
            }
          );

          order++;
        }
      );

      $.ajax(
        {
          type: "POST",
          url: "{/literal}{$datas.urlRequest}{literal}",
          async: true,
          data: { ajaxfct:"admin.userDefined.setTag", id:options.numId, properties:properties },
          success:
            function(msg)
            {
              displayProcessing(false);

              re=/^\d+,\d+$/;
              if(re.exec(msg)!=null)
              {
                // result Ok ! => close the dialog box and reload the list
                $('#iDialogEdit').dialog("close");
                loadList();
              }
              else
              {
                returned=msg.split('!');
                $('#'+returned[0]).addClass('error');
                alert(returned[1]);
              }
            }
        }
      );
    }

    /**
     * display or hide the processing flower
     */
    var displayProcessing = function (visible)
    {
      if(visible)
      {
        $('#iBDProcessing').css("display", "block");
      }
      else
      {
        $('#iBDProcessing').css("display", "none");
      }
    }

    this.init();
  }


</script>
{/literal}


<h2>{'g003_personnal_metadata'|@translate}</h2>

<div class='helps'>
  <p>{'g003_personnal_page_help'|@translate}</p>
</div>

<div class='addMetadata'>
  <a onclick="udm.editMetadata('');">{'g003_add_a_new_md'|@translate}</a>
</div>

<table id='iHeaderListTags' class="littlefont">
  <tr>
    <th style="width:35%;min-width:340px;">{'g003_TagId'|@translate}</th>
    <th>{'g003_TagLabel'|@translate}</th>
    <th style="width:15%;">{'g003_num_of_rules'|@translate}</th>
    <th width="40px">&nbsp;</th>
  </tr>
</table>
<div id='iListTags' class="{$themeconf.name}">
</div>
<div id="iListTagsNb"></div>

<div id="iDialogDelete">
</div>

<div id="iDialogEdit">
  <div id='iBDProcessing' style="display:none;position:absolute;width:100%;height:100%;background:#000000;opacity:0.75">
      <img src="plugins/GrumPluginClasses/icons/processing.gif" style="margin-top:100px;">
  </div>

  <form>
    <table class='formtable'>
      <tr>
        <td>{'g003_metadatId'|@translate}</td>
        <td>
          <input type='text' id='iBDTagId' maxlength=200 size=60 value=''>
          <input type='hidden' id='iBDNumId' value=''>
        </td>
      </tr>
      <tr>
        <td>{'g003_TagLabel'|@translate}</td>
        <td>
          <input type='text' id='iBDLabel' maxlength=200 size=60 value=''>
          <!--<select id='iBDLang' disabled>
            <option value='fr_FR'>Français</option>
          </select>-->
        </td>
      </tr>
      <tr>
        <td>{'g003_rules'|@translate}</td>
        <td>
          <a onclick='udm.addRule({ldelim}{rdelim});'>{'g003_add_a_rule'|@translate}</a>
        </td>
      </tr>
    </table>

    <div id='mdRulesArea' value='0'>
      <ul id='iBDRules'>
      </ul>
    </div>

  </form>
</div>


<ul style='display:none' id='iBDModel'>
  <li id='iBDRuleNumZZZZZ' class='groupItems gcBgPage rmSortable rmItem' value='ZZZZZ'>
    <img onclick='udm.deleteRule("ZZZZZ");' src='{$themeconf.admin_icon_dir}/delete.png' class='button pointer' alt='{"g003_delete"|@translate}' title='{"g003_delete"|@translate}' style='float:right;'/>
    <div class='rmContent'>

      <div class='ruleSelector'>
        <img src='{$themeconf.admin_icon_dir}/cat_move.png' class='rmSortHandle button drag_button' alt='{"Drag to re-order"|@translate}' title='{"Drag to re-order"|@translate}'/>


        <select id='iBDRuleTypeZZZZZ' onchange='udm.changeRuleType("ZZZZZ");'>
          <option value='T'>{'g003_typeText'|@translate}</option>
          <option value='M'>{'g003_typeMetadata'|@translate}</option>
          <option value='C'>{'g003_typeCondition'|@translate}</option>
        </select>
      </div>

      <div class='ruleProperties'>
        <input type='text' id='iBDRuleTypeTZZZZZ' value='' maxlength=200 size=60>

        <div id='iBDRuleTypeMZZZZZ'
             style='display:none;'
             value='-'
             class='ruleTypeM gcTextInput gcBgInput gcBorderInput pointer'
             onclick='tls.display("iBDRuleTypeMZZZZZ");'>
          <span class='ruleContent'><span class='tagName'>&nbsp;</span></span>
          <span style='float:right' class='gcText3'>&dArr;</span>
        </div>

        <div id='iBDRuleTypeCZZZZZ' style='display:none;'>
          <table>
            <tr>
              <td style='vertical-align:top;'>{'g003_conditionIf'|@translate}</td>
              <td>
                <div id='iBDRuleTypeCMZZZZZ'
                     value='-'
                     style='display:inline-block'
                     class='ruleTypeM2 gcTextInput gcBgInput gcBorderInput pointer'
                     onclick='tls.display("iBDRuleTypeCMZZZZZ");'>
                  <span class='ruleContent'>
                    <span class='tagName'>&nbsp;</span>
                  </span>
                  <span style='float:right' class='gcText3'>&dArr;</span>
                </div>
                <br>
                <div style='display:inline-block;margin-top:2px;'>
                  <select id='iBDRuleTypeCIfZZZZZ' onchange='udm.changeRuleTypeCIf("ZZZZZ");'>
                    <option value='E'>{'g003_typeCIfExist'|@translate}</option>
                    <option value='!E'>{'g003_typeCIfNotExist'|@translate}</option>
                    <option value='='>{'g003_typeCIfEqual'|@translate}</option>
                    <option value='!='>{'g003_typeCIfNotEqual'|@translate}</option>
                    <option value='%'>{'g003_typeCIfLike'|@translate}</option>
                    <option value='!%'>{'g003_typeCIfNotLike'|@translate}</option>
                    <option value='^%'>{'g003_typeCIfBeginWith'|@translate}</option>
                    <option value='!^%'>{'g003_typeCIfNotBeginWith'|@translate}</option>
                    <option value='$%'>{'g003_typeCIfEndWith'|@translate}</option>
                    <option value='!$%'>{'g003_typeCIfNotEndWith'|@translate}</option>                  </select>
                  <input type='text' id='iBDRuleTypeCIfValueZZZZZ' value='' maxlength=200 size=26 style='display:none;'>
                </div>
              </td>
            </tr>
          </table>
        </div>

      </div>
    </div>

    <ul class='subRules' id='iBDSubRulesNumZZZZZ'></ul>
  </li>
</ul>

<ul style='display:none' id='iTagList' class="{$themeconf.name}">
  {foreach from=$datas.tagList item=tag}
    <li id='iTagListItem{$tag.numId}' value='{$tag.numId}'><span class='tagName'>{$tag.tagId}</span><span>{$tag.name}</span></li>
  {/foreach}
</ul>

{literal}
<script type="text/javascript">
  var udm=new userDefManage();
  var tls=new tagListSelector({itemId:'iTagList'});
</script>
{/literal}
