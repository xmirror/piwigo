{combine_script id="jquery.ui" path="themes/default/js/ui/minified/jquery.ui.core.min.js"}
{combine_script id="jquery.ui.dialog" path="themes/default/js/ui/minified/jquery.ui.dialog.min.js"}
{combine_script id="tagListSelector" path="plugins/AMetaData/js/tagListSelector.js"}

{literal}
<style type='text/css'>
  #mdRulesArea { border-top:1px solid; overflow:auto; }
  .ruleTypeM, .ruleTypeM2 {
    border:1px solid #666666;
    display:inline-block;
    padding:0 2px 0;
  }
  div.ruleTypeM { width:493px; }
  div.ruleTypeM2 { width:400px; }
  div.ruleSelector
  {
    float:left;
    width:150px;
  }
  img.pointer, span.pointer, div.pointer { cursor:pointer; }
  li.valueItems {
    -moz-border-radius:4px 4px 4px 4px;
    border:1px solid #666666;
    margin-bottom:5px;
    padding:4px;
  }

  #iDMCListValues {
    list-style:none;
    margin:8px;
    padding:0;
  }
  #iTagList { list-style-type:none; padding:0px; margin:0px; }
  span.tagName {
    border-right:1px dotted #666666;
    display:inline-block;
    margin-right:2px;
    padding:2px 0 1px;
    width:240px;
  }

  #iTagList li { padding: 0px 2px; }
  #iTagList.clear li:hover { cursor:pointer; color: #D54E21; background:#dbe8f3; }
  #iTagList.roma li:hover { cursor:pointer; background:#303030; }
  #iTagList.selectedroma { background:#303030; }
  #iTagList.selectedclear { background:#dbe8f3; }
</style>

<script type="text/javascript">

/**
 * include this template in a page and use metadataBox.show({options}) to display
 * the dialog box
 *
 * the object is initialized as "AMetaDataDB" by the request builder
 */
dialogChooseMetadataBox = function()
{
  var dialogOptions = {
      id:'',
      eventOk:null,
      cBuilder:null,
      numValues:0,

      values: {
        metaNumId:0,
        metaTagId:'',
        metaTagLabel:'',
        conditionIf:'=',
        listValues:new Array(),
        listDisplay:new Array(),
      },
    };

  /**
   * initialize the dialog box
   */
  var initDialogBox = function()
  {
    $("#iDialogMetadataChoose")
    .dialog(
      {
        autoOpen: false,
        resizable: false,
        width:645,
        height:400,
        modal: true,
        draggable:true,
        dialogClass: 'gcBgTabSheet gcBorder',
        title: '{/literal}{"g003_choose_a_metadata"|@translate}{literal}',
        open: function(event, ui)
        {
        },
        buttons:
        {
          '{/literal}{"g003_ok"|@translate}{literal}':
            function()
            {
              if(checkValidity())
              {
                if(dialogOptions.cBuilder!=null)
                {
                  setCBuilderItem(dialogOptions.id);
                }

                if(dialogOptions.eventOk!=null)
                {
                  dialogOptions.eventOk(dialogOptions.id);
                }
                $(this).dialog('close');
              }
            },
          '{/literal}{"g003_cancel"|@translate}{literal}':
            function()
            {
              $(this).dialog('close');
            }
        }
      }
    );

    // initialize events on the dialog box interface items
    $('#iDMCAddValue').bind('click', function () { addValue(); } );
    $('#iDMCIfValue').bind('change', function () { changeCondition(); } );
    $('#iDMCSelectMeta').bind('click', function () { tls.display("iDMCSelectMeta"); } );
  }

  /**
   * add a value to the value list
   */
  var addValue = function ()
  {
    if($('#iDMCValueS').css("display")=="none")
    {
      rawValue=$('#iDMCValueT').val();
      displayValue=rawValue;
    }
    else
    {
      selectList=$('#iDMCValueS').get(0);
      rawValue=$(selectList.options[selectList.selectedIndex]).attr('rawvalue');
      displayValue=$(selectList.options[selectList.selectedIndex]).attr('displayvalue');
    }

    if(rawValue!='')
    {
      if($('#iDMCListValues li[value="'+rawValue+'"]').length>0)
      {
        alert('{/literal}{"g003_value_already_set"|@translate}{literal}');
      }
      else
      {
        if(dialogOptions.numValues==0)
        {
          if($('#iDMCIfValue').val()=='=' ||
             $('#iDMCIfValue').val()=='%' ||
             $('#iDMCIfValue').val()=='^%' ||
             $('#iDMCIfValue').val()=='$%')
          {
            $('#mdRulesAreaCheckOne').css('display', 'block');
          }
          else
          {
            $('#mdRulesAreaCheckAll').css('display', 'block');
          }
        }

        dialogOptions.numValues++;
        dialogOptions.values.listValues[dialogOptions.numValues]=rawValue;
        dialogOptions.values.listDisplay[dialogOptions.numValues]=displayValue;

        addValueItem(displayValue);
      }
    }
    else
    {
      alert('{/literal}{"g003_please_set_a_value"|@translate}{literal}');
    }
  }

  /**
   *
   */
  var addValueItem = function (value)
  {
    text="<li class='valueItems gcBgPage' id='iDMCListValues_"+dialogOptions.numValues+"' value='"+value+"'>";
    text+="<span>"+value+"</span>";
    text+="<img id='iDMCListValues_Delete"+dialogOptions.numValues+"' {/literal}src='{$themeconf.admin_icon_dir}/delete.png' class='button pointer' alt='{"g003_delete"|@translate}' title='{"g003_delete"|@translate}' style='float:right;' {literal}/></li>";
    $('#iDMCListValues').append(text);

    $('#iDMCListValues_Delete'+dialogOptions.numValues).bind('click',
      { itemId:'iDMCListValues_'+dialogOptions.numValues },
      function (event)
      {
        removeValue(event.data.itemId);
      }
    );
  }

  /**
   * remove the selected value from the list
   */
  var removeValue = function (id)
  {
    $('#'+id).remove();
    dialogOptions.values.listValues.splice(id,1);
    dialogOptions.values.listDisplay.splice(id,1);

    if($('#iDMCListValues').html()=='')
    {
      clearValues();
    }
  }

  /**
   * clear all the selected values from the list
   */
  var clearValues = function ()
  {
    dialogOptions.numValues=0;
    dialogOptions.values.listValues=new Array();
    dialogOptions.values.listDisplay=new Array();
    //dialogOptions.values.metaNumId=0;
    dialogOptions.values.conditionIf='';

    $('#iDMCListValues').html('');
    $('#mdRulesAreaCheckOne').css('display', 'none');
    $('#mdRulesAreaCheckAll').css('display', 'none');
  }

  /**
   * check the validity of the condition
   * return Boolean : true if OK, otherwise false
   */
  var checkValidity = function ()
  {
    if(dialogOptions.values.metaTagId=='' ||
       (dialogOptions.values.listValues.length==0 &&
        !(dialogOptions.values.conditionIf=='E' || dialogOptions.values.conditionIf=='!E')
       )
      )
    {
      return(false);
    }
    return(true);
  }


  /**
   * the show() function display and manage a dialog box to choose a metadata
   * and the kind of test to apply
   *
   * @param options : properties to manage the dialog box
   *                  - id : a string to identify a DOM object ; this parameter
   *                         is given to the callback when the OK button is pushed
   *                  - mode : a string to identify the default mode selected
   *                           values : 'and', 'or', 'not'
   *                  - eventOK : a callback function, with 2 parameters : id of
   *                              the given DOM object and values parameted
   *                  - cBuilder : a criteriaBuilder object
   *                               if set, the dialog box manage automaticaly
   *                               the criteria builder interface
   */
  this.show = function (options)
  {
    showDialog(options);
  }

  /**
   * private function used to show the dialog box
   */
  var showDialog = function(options)
  {
    clearValues();
    $('#iDMCSelectMeta').val('-').html("<span class='ruleContent'><span class='tagName'>&nbsp;</span></span><span style='float:right' class='gcText3'>&dArr;</span>");
    $('#iDMCValueContainer').css('display', 'none');
    $('#iDMCIfValueContainer').css('display', 'none');

    if(options.id!=null)
    {
      dialogOptions.id=options.id;
    }
    else
    {
      dialogOptions.id='';
    }

    if(options.eventOk!=null)
    {
      dialogOptions.eventOk=options.eventOk;
    }

    if(options.cBuilder!=null)
    {
      dialogOptions.cBuilder=options.cBuilder;
      dialogOptions.cBuilder.doAction('setOptions',
        {
          onEdit:function (e) { editCB(e.data); },
          onDelete:function (e) { deleteCB(e.data); },
        }
      );
    }

    if(options.values!=null)
    {
      $('#iDMCIfValue').val(options.values.conditionIf);
      changeMeta(options.values.metaNumId);
      dialogOptions.values=jQuery.extend(dialogOptions.values, options.values);
      $('#iDMCSelectMeta span.ruleContent').html($('#iTagListItem'+dialogOptions.values.metaNumId).html());

      for(i=0;i<dialogOptions.values.listDisplay.length;i++)
      {
        dialogOptions.numValues=i;
        if(dialogOptions.values.listDisplay[i]!=null) addValueItem(dialogOptions.values.listDisplay[i]);
      }
    }

    $("#iDialogMetadataChoose").dialog('open');
  }



  /**
   * manage the 'edit' button from criteria builder interface
   * @param String itemId : the itemId
   */
  var editCB = function (itemId)
  {
    extraData=dialogOptions.cBuilder.doAction('getExtraData', itemId);
    showDialog(
      {
        id:itemId,
        values:
          {
            metaNumId:extraData.param.metaNumId,
            metaTagId:extraData.param.metaTagId,
            metaTagLabel:extraData.param.metaTagLabel,
            conditionIf:extraData.param.conditionIf,
            listValues:extraData.param.listValues,
            listDisplay:extraData.param.listDisplay,
          },
      }
    );
  }

  /**
   * manage the 'delete' button from criteria builder interface
   * @param String itemId : the itemId
   */
  var deleteCB = function (itemId)
  {
    dialogOptions.cBuilder.doAction('delete', itemId);
  }

  /**
   * set the content for the cBuilder item
   */
  var setCBuilderItem = function(id)
  {
    content="<div>";

    if(dialogOptions.values.listValues.length>1 && dialogOptions.values.conditionIf=='=')
    {
     content+="{/literal}{'g003_metadata_equals_all'|@translate}{literal}";
    }
    else if(dialogOptions.values.listValues.length==1 && dialogOptions.values.conditionIf=='=')
    {
     content+="{/literal}{'g003_metadata_equals_one'|@translate}{literal}";
    }
    else if(dialogOptions.values.listValues.length>1 && dialogOptions.values.conditionIf=='!=')
    {
     content+="{/literal}{'g003_metadata_not_equals_all'|@translate}{literal}";
    }
    else if(dialogOptions.values.listValues.length==1 && dialogOptions.values.conditionIf=='!=')
    {
     content+="{/literal}{'g003_metadata_not_equals_one'|@translate}{literal}";
    }
    else if(dialogOptions.values.listValues.length>1 && dialogOptions.values.conditionIf=='%')
    {
     content+="{/literal}{'g003_metadata_like_all'|@translate}{literal}";
    }
    else if(dialogOptions.values.listValues.length==1 && dialogOptions.values.conditionIf=='%')
    {
     content+="{/literal}{'g003_metadata_like_one'|@translate}{literal}";
    }
    else if(dialogOptions.values.listValues.length>1 && dialogOptions.values.conditionIf=='!%')
    {
     content+="{/literal}{'g003_metadata_not_like_all'|@translate}{literal}";
    }
    else if(dialogOptions.values.listValues.length==1 && dialogOptions.values.conditionIf=='!%')
    {
     content+="{/literal}{'g003_metadata_not_like_one'|@translate}{literal}";
    }
    else if(dialogOptions.values.listValues.length>1 && dialogOptions.values.conditionIf=='^%')
    {
     content+="{/literal}{'g003_metadata_begin_all'|@translate}{literal}";
    }
    else if(dialogOptions.values.listValues.length==1 && dialogOptions.values.conditionIf=='^%')
    {
     content+="{/literal}{'g003_metadata_begin_one'|@translate}{literal}";
    }
    else if(dialogOptions.values.listValues.length>1 && dialogOptions.values.conditionIf=='!^%')
    {
     content+="{/literal}{'g003_metadata_not_begin_all'|@translate}{literal}";
    }
    else if(dialogOptions.values.listValues.length==1 && dialogOptions.values.conditionIf=='!^%')
    {
     content+="{/literal}{'g003_metadata_not_begin_one'|@translate}{literal}";
    }
    else if(dialogOptions.values.listValues.length>1 && dialogOptions.values.conditionIf=='$%')
    {
     content+="{/literal}{'g003_metadata_end_all'|@translate}{literal}";
    }
    else if(dialogOptions.values.listValues.length==1 && dialogOptions.values.conditionIf=='$%')
    {
     content+="{/literal}{'g003_metadata_end_one'|@translate}{literal}";
    }
    else if(dialogOptions.values.listValues.length>1 && dialogOptions.values.conditionIf=='!$%')
    {
     content+="{/literal}{'g003_metadata_not_end_all'|@translate}{literal}";
    }
    else if(dialogOptions.values.listValues.length==1 && dialogOptions.values.conditionIf=='!$%')
    {
     content+="{/literal}{'g003_metadata_not_end_one'|@translate}{literal}";
    }
    else if(dialogOptions.values.conditionIf=='E')
    {
     content+="{/literal}{'g003_metadata_exists'|@translate}{literal}";
    }
    else if(dialogOptions.values.conditionIf=='!E')
    {
     content+="{/literal}{'g003_metadata_dont_exists'|@translate}{literal}";
    }

    content=content.replace(/%s/i, '<span style="font-weight:bold;">'+dialogOptions.values.metaTagLabel+'</span> <span style="font-style:italic;">('+dialogOptions.values.metaTagId+')</span>');

    if(dialogOptions.values.listValues.length>0)
    {
      content+='<br><div style="font-style:italic;padding-left:15px;">';
      for(i=0;i<dialogOptions.values.listDisplay.length;i++)
      {
        if(dialogOptions.values.listDisplay[i]!=null)
        {
          content+=dialogOptions.values.listDisplay[i];
          if(i<dialogOptions.values.listDisplay.length-1) content+='<br>';
        }
      }
      content+='</div>';
    }

    content+="</div>";



    if(id=='')
    {
      //no id:add a new item in the list
      dialogOptions.cBuilder.doAction(
        'add',
        content,
        criteriaBuilder.makeExtendedData(
          'AMetaData',
          {
            metaNumId:dialogOptions.values.metaNumId,
            metaTagId:dialogOptions.values.metaTagId,
            metaTagLabel:dialogOptions.values.metaTagLabel,
            conditionIf:dialogOptions.values.conditionIf,
            listValues:dialogOptions.values.listValues,
            listDisplay:dialogOptions.values.listDisplay
          }
        )
      );
    }
    else
    {
      // update item
      dialogOptions.cBuilder.doAction(
        'edit',
        id,
        content,
        criteriaBuilder.makeExtendedData(
          'AMetaData',
          {
            metaNumId:dialogOptions.values.metaNumId,
            metaTagId:dialogOptions.values.metaTagId,
            metaTagLabel:dialogOptions.values.metaTagLabel,
            conditionIf:dialogOptions.values.conditionIf,
            listValues:dialogOptions.values.listValues,
            listDisplay:dialogOptions.values.listDisplay
          }
        )
      );
    }
  }

  /**
   * when the condition type is changed, change input type and erase the defined
   * values
   */
  changeCondition = function ()
  {
    clearValues();

    if($('#iDMCIfValue').val()=='E' ||
       $('#iDMCIfValue').val()=='!E')
    {
      $('#iDMCValueContainer').css('display', 'none');
    }
    else if($('#iDMCIfValue').val()=='=' ||
       $('#iDMCIfValue').val()=='!=')
    {
      $('#iDMCValueT').css('display', 'none');
      $('#iDMCValueS').css('display', 'inline');
      $('#iDMCValueContainer').css('display', 'table-row');
    }
    else
    {
      $('#iDMCValueS').css('display', 'none');
      $('#iDMCValueT').css('display', 'inline');
      $('#iDMCValueContainer').css('display', 'table-row');
    }

    dialogOptions.values.conditionIf=$('#iDMCIfValue').val();
  }

  /**
   * when the metadata is changed, erase the defined values and reload
   * the value list
   */
  changeMeta = function (metaId)
  {
    $('#iDMCIfValueContainer').css('display', 'block');
    $('#iDMCValueContainer').css('display', 'block');

    $('#iDMCListValues').html('');

    $('#iDMCValueT').val('');
    $('#iDMCValueS').html('').css('background', 'url(./plugins/GrumPluginClasses/icons/processing.gif) no-repeat 15px 0');

    changeCondition();

    dialogOptions.values.metaNumId=metaId;
    dialogOptions.values.metaTagId=$('#iDMCSelectMeta span.tagName').text();
    dialogOptions.values.metaTagLabel=$('#iDMCSelectMeta span.tagLabel').text();

    $.ajax(
      {
        type: "POST",
        url: "{/literal}{$datas.urlRequest}{literal}",
        async: true,
        data: { ajaxfct:"admin.tag.getValues", id:metaId },
        success:
          function(msg)
          {
            $('#iDMCValueS').html(msg).css('background', '');
          }
      }
    );
  }


  var tls=new tagListSelector(
    {
      itemId:'iTagList',
      onSelect: changeMeta
    }
  );

  initDialogBox();
}


</script>
{/literal}

<div id="iDialogMetadataChoose" style='display:none;'>

  <table class="formtable">
    <tr>
      <td rowspan=3>{'g003_conditionIf'|@translate}</td>
      <td>
        <div id='iDMCSelectMeta'
             value='-'
             class='ruleTypeM gcTextInput gcBgInput gcBorderInput pointer'>
          <span class='ruleContent'><span class='tagName'>&nbsp;</span></span>
          <span style='float:right' class='gcText3'>&dArr;</span>
        </div>
      </td>
    </tr>

    <tr id='iDMCIfValueContainer' style='display:none;'>
      <td>
        <select id='iDMCIfValue'>
          <option value='E'>{'g003_typeCIfExist'|@translate}</option>
          <!-- <option value='!E'>{'g003_typeCIfNotExist'|@translate}</option> -->
          <option value='='>{'g003_typeCIfEqual'|@translate}</option>
          <option value='!='>{'g003_typeCIfNotEqual'|@translate}</option>
          <option value='%'>{'g003_typeCIfLike'|@translate}</option>
          <option value='!%'>{'g003_typeCIfNotLike'|@translate}</option>
          <option value='^%'>{'g003_typeCIfBeginWith'|@translate}</option>
          <option value='!^%'>{'g003_typeCIfNotBeginWith'|@translate}</option>
          <option value='$%'>{'g003_typeCIfEndWith'|@translate}</option>
          <option value='!$%'>{'g003_typeCIfNotEndWith'|@translate}</option>
        </select>

      </td>
    </tr>

    <tr id='iDMCValueContainer' style='display:none;'>
      <td>

        <input type='text' id='iDMCValueT' value='' maxlength=200 style="width:250px;display:none;">
        <select id='iDMCValueS' style="width:250px;">
        </select>

        <input type='button' value="{'g003_add'|@translate}" id='iDMCAddValue'>
      </td>
    </tr>

  </table>

  <div id='mdRulesArea'>
    <div style='display:none;' id='mdRulesAreaCheckOne'>{'g003_metadata_value_check_one'|@translate}</div>
    <div style='display:none;' id='mdRulesAreaCheckAll'>{'g003_metadata_value_check_all'|@translate}</div>
    <ul id='iDMCListValues'>
    </ul>
  </div>



  <ul style='display:none' id='iTagList' class="{$themeconf.name}">
    {foreach from=$datas.tagList item=tag}
      <li id='iTagListItem{$tag.numId}' value='{$tag.numId}'><span class='tagName'>{$tag.tagId}</span><span class='tagLabel'>{$tag.name}</span></li>
    {/foreach}
  </ul>

</div>


