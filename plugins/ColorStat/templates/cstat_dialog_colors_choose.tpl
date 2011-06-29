{combine_script id="jquery.ui" path="themes/default/js/ui/minified/jquery.ui.core.min.js"}
{combine_script id="jquery.ui.dialog" path="themes/default/js/ui/minified/jquery.ui.dialog.min.js"}
{combine_script id="jquery.tipTip" path="themes/default/js/plugins/jquery.tipTip.minified.js"}


{literal}
<script type="text/javascript">

/**
 * include this template in a page and use colorBox.show({options}) to display
 * the dialog box
 *
 */
dialogChooseColorBox = function()
{
  var selectedColors = new Array();
  var dialogColorOptions = {
      colorList:'',
      mode:'and',
      id:'',
      eventOk:null,
      cBuilder:null,
    };

  /**
   * initialize the dialog box
   */
  var initDialogBox = function()
  {
    $('.tiptip').tipTip(
      {
        'delay' : 0,
        'fadeIn' : 0,
        'fadeOut' : 0,
        'edgeOffset' : 5,
      }
    );

    $("#iDialogColorChoose")
    .dialog(
      {
        autoOpen: false,
        resizable: false,
        width:720,
        height:400,
        modal: true,
        draggable:true,
        dialogClass: 'gcBgTabSheet gcBorder',
        title: '{/literal}{"cstat_choose_colors"|@translate}{literal}',
        open: function(event, ui)
        {

        },
        buttons:
        {
          '{/literal}{"cstat_ok"|@translate}{literal}':
            function()
            {
              list='';
              nbColor=$('#iDCCchoosenColors div').length;
              for(i=0;i<nbColor;i++)
              {
                if(list!='') { list+=','; }
                list+=$('#iDCCchoosenColors div').get(i).id.substr(13);
              }

              if($('#iDCCOperatorAnd').get(0).checked)
              {
                mode='and';
              }
              else if($('#iDCCOperatorOr').get(0).checked)
              {
                mode='or';
              }
              else if($('#iDCCOperatorNot').get(0).checked)
              {
                mode='not';
              }

              if(dialogColorOptions.cBuilder!=null)
              {
                setCBuilderItem(dialogColorOptions.id, list, mode);
              }

              if(dialogColorOptions.eventOk!=null)
              {
                dialogColorOptions.eventOk(dialogColorOptions.id, list, mode);
              }

              $(this).dialog('close');
            },
          '{/literal}{"cstat_cancel"|@translate}{literal}':
            function()
            {
              $(this).dialog('close');
            }
        }
      }
    );

    $('#iDCCtableColor td.csSelectable').bind('click', function() { addColorList(this.id.substr(10)); });
  }

  /**
   * remove a color from the choosen colors list
   * event.data : the color top remove
   */
  var removeColorList = function(event)
  {
    $('#iDCCselected_'+event.data).remove();
  }

  /**
   * add a color from the choosen colors list
   */
  var addColorList = function(color)
  {
    if($('#iDCCselected_'+color).get(0)==null)
    {
      $('#iDCCchoosenColors').append("<div id='iDCCselected_"+color+"' class='cellColorChoose' style='background-color:#"+color+";'></div>");
      $('#iDCCselected_'+color).bind('click', color, removeColorList);
    }
    else
    {
      alert("{/literal}{'cstat_color_already_choosen'|@translate}{literal}")
    }
  }


  /**
   * the show() function display and manage a dialog box to choose
   * a set of colors from a color table
   *
   * @param options : properties to manage the dialog box
   *                  - colorList : a string of hex color, separated with a comma
   *                                example: 'ff0000,00ff00,0000ff'
   *                                if set, theses colors are selected when the
   *                                dialog box is open
   *                  - id : a string to identify a DOM object ; this parameter
   *                         is given to the callback when the OK button is pushed
   *                  - mode : a string to identify the default mode selected
   *                           values : 'and', 'or', 'not'
   *                  - eventOK : a callback function, with 2 parameters : id of
   *                              the given DOM object and the color list
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
    if(options.colorList!=null)
    {
      dialogColorOptions.colorList=options.colorList;
    }
    else
    {
      dialogColorOptions.colorList='';
    }

    if(options.mode!=null)
    {
      dialogColorOptions.mode=options.mode;
    }
    else
    {
      dialogColorOptions.mode='and';
    }

    if(options.id!=null)
    {
      dialogColorOptions.id=options.id;
    }
    else
    {
      dialogColorOptions.id='';
    }

    if(options.eventOk!=null)
    {
      dialogColorOptions.eventOk=options.eventOk;
    }

    if(options.cBuilder!=null)
    {
      dialogColorOptions.cBuilder=options.cBuilder;
      dialogColorOptions.cBuilder.doAction('setOptions',
        {
          onEdit:function (e) { editCB(e.data); },
          onDelete:function (e) { deleteCB(e.data); },
        }
      );
    }


    $('#iDCCchoosenColors').html('');

    if(dialogColorOptions.colorList!='')
    {
      selectedColors=dialogColorOptions.colorList.split(',');
      for(i=0;i<selectedColors.length;i++)
      {
        addColorList(selectedColors[i]);
      }
    }
    switch(dialogColorOptions.mode)
    {
      case 'and':
        $('#iDCCOperatorAnd').attr('checked', true);
        break;
      case 'or':
        $('#iDCCOperatorOr').attr('checked', true);
        break;
      case 'not':
        $('#iDCCOperatorNot').attr('checked', true);
        break;
    }
    $("#iDialogColorChoose").dialog('open');
  }



  /**
   * manage the 'edit' button from criteria builder interface
   * @param String itemId : the itemId
   */
  var editCB = function (itemId)
  {
    extraData=dialogColorOptions.cBuilder.doAction('getExtraData', itemId);
    showDialog(
      {
        id:itemId,
        colorList:extraData.param.colors,
        mode:extraData.param.mode,
      }
    );
  }

  /**
   * manage the 'delete' button from criteria builder interface
   * @param String itemId : the itemId
   */
  var deleteCB = function (itemId)
  {
    dialogColorOptions.cBuilder.doAction('delete', itemId);
  }

  /**
   * set the content for the cBuilder item
   */
  var setCBuilderItem = function(id, colorList, mode)
  {
    content="<div>";
    switch(mode)
    {
      case 'and':
        content+="{/literal}{'cstat_operator_and'|@translate}{literal}";
        break;
      case 'or':
        content+="{/literal}{'cstat_operator_or'|@translate}{literal}";
        break;
      case 'not':
        content+="{/literal}{'cstat_operator_not'|@translate}{literal}";
        break;
    }
    content+="</div>";

    content+="<div style='float:left;'>";
    selectedColors=colorList.split(',');
    for(i=0;i<selectedColors.length;i++)
    {
      content+="<div class='cellColorChoose' style='background-color:#"+selectedColors[i]+";'></div>";
    }
    content+="</div>";

    if(id=='')
    {
      //no id:add a new item in the list
      dialogColorOptions.cBuilder.doAction('add', content, criteriaBuilder.makeExtendedData('ColorStat', {mode:mode, colors:colorList} ) );
    }
    else
    {
      // update item
      dialogColorOptions.cBuilder.doAction('edit', id,  content, criteriaBuilder.makeExtendedData('ColorStat', {mode:mode, colors:colorList} ) );
    }
  }

  initDialogBox();
}


</script>
{/literal}

<div id="iDialogColorChoose" style='display:none;'>
  <table style="padding-top:8px;">
    <tr>
      <td style='width:350px;' id='iDCCtableColor'>{$datas.colorTable}</td>
      <td style='padding:12px;'>
        <span>{'cstat_choosen_colors'|@translate}</span>

        <div id='iDCCchoosenColors' style='height:56px;border:1px solid;margin:2px;padding:4px;'>
        </div>

        <div style='text-align:justify;padding:8px;'>
          <label><input type="radio" name="f_operator" id="iDCCOperatorAnd" checked>&nbsp;{'cstat_operator_and'|@translate}</label><br>
          <label><input type="radio" name="f_operator" id="iDCCOperatorOr">&nbsp;{'cstat_operator_or'|@translate}</label><br>
          <label><input type="radio" name="f_operator" id="iDCCOperatorNot">&nbsp;{'cstat_operator_not'|@translate}</label>
        </div>
      </td>
    </tr>
  </table>
</div>


