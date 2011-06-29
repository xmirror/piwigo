

/**
 * sorry, tagListSelector is coded like a pork, but I don't have the time to
 * code something better... ^^;
 */
function tagListSelector(optionsToSet)
{
  this.options = {
    itemId:'',
    selectorId:'',
    width:'auto',
    height:'auto',
    maxHeight:250,
    selectedClass:'gcText3',
    selectorClass:'ruleTypeM gcTextInput gcBgInput gcBorderInput',
    selectorItems:'ruleTypeM',
    onSelect:null,
  };

  this.init = function (optionsToSet)
  {
    if(typeof optionsToSet=='object')
    {
      this.options = jQuery.extend(this.options, optionsToSet);
    }

    $('body').append("<div id='iTLSDiv' class='"+this.options.selectorClass+"' style='padding:0px;z-index:5000;overflow:auto;display:none;position:absolute;max-height:"+this.options.maxHeight+"px'></div>");
    $('#iTLSDiv')
      .prepend($('#'+this.options.itemId))
      .bind('mouseleave', function ()
        {
          $('#iTLSDiv').css('display', 'none');
        }
      );
    $('#'+this.options.itemId).css('display', 'block');
    $('#iTLSDiv li').bind('click', this.options, function (event)
      {
        $('#'+event.data.selectorId).attr('value', $(this).attr('value'));
        $('#'+event.data.selectorId+' span.ruleContent').html($(this).html());
        $('#iTLSDiv').css('display', 'none');
        if(event.data.onSelect!=null && jQuery.isFunction(event.data.onSelect)) event.data.onSelect($(this).attr('value'));
      }
    );
  };



  this.display = function (fromId)
  {
    selectedItem=$('#'+fromId).attr('value');

    var top=$('#'+fromId).offset().top+$('#'+fromId).outerHeight()-1,
        left=$('#'+fromId).offset().left,
        width=$('#'+fromId).innerWidth();
    $('#iTLSDiv li').removeClass(this.options.selectedClass);
    $('#iTagListItem'+selectedItem).addClass(this.options.selectedClass);
    $('#iTLSDiv').css(
      {
        top:top+'px',
        left:left+'px',
        width:width+'px',
        display:'block'
      }
    );
    this.options.selectorId=fromId;
  };


  this.init(optionsToSet);
}
