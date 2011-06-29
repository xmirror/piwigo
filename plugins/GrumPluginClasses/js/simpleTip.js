/**
 * -----------------------------------------------------------------------------
 * file: simpleTip.js
 * file version: 1.0.1
 * date: 2010-12-23
 *
 * JS file provided by the piwigo's plugin "GrumPluginClasses"
 *
 * -----------------------------------------------------------------------------
 * Author     : Grum
 *   email    : grum@piwigo.com
 *   website  : http://photos.grum.fr
 *   PWG user : http://forum.phpwebgallery.net/profile.php?id=3706
 *
 *   << May the Little SpaceFrog be with you ! >>
 * -----------------------------------------------------------------------------
 *
 * Why simpleTip ?
 * I have tried the jQuery plugins 'tiptip' and 'qTip'
 *  - 'tiptip' is a good solution, but bugged
 *  - 'qTip' is excellent but too many options for my needs (and sometimes,
 *    I have some 'not initialized value' error)
 * I need something simple and light...
 *
 * constructor : myST = new simpleTip();
 *
 *
 *
 * :: HISTORY ::
 *
 * | release | date       |
 * | 1.0.0   | 2010-07-10 | start to coding
 * |         |            |
 * | 1.0.1   | 2010-12-23 | fix minor bugs
 * |         |            |
 * |         |            |
 * |         |            |
 * |         |            |
 *
 */

/**
 * tipItem is an object to define tooltip properties
 *
 * - content : content for the tooltip
 * - index   : index of the simpleTip object
 * - options : object with theses properties
 *              * targetPos : position of the tooltip relative to the target
 *              * tipPos    : position of the tooltip relative to the target
 *                            can take values : top-left,    top-middle,    top-right
 *                                              middle-left, middle-middle, middle-right
 *                                              bottom-left, bottom-middle, bottom-right
 *              * drawArrow : draw an arrow (true) or not (false)
 *              * offsetX   : apply an offset to the tooltip position X
 *              * offsetY   : apply an offset to the tooltip position Y
 *              * classes   : additionnal classes
 *
 */
function tipItem(item, index, options)
{
  this.item=item;
  this.content=item.title;
  this.index=index;
  this.options=jQuery.extend(
    {
      targetPos:'bottom-middle',
      tipPos:'top-middle',
      drawArrow:false,
      offsetX:0,
      offsetY:0,
      classes:'',
      arrowImgDir: '',
      arrowWidth: 12,
      arrowHeight: 12
    },
    options
  );
}


function simpleTip()
{
  var items = new Array(),
      itemIndexInc = 0,
      options={
          name:''
        };

  if(arguments.length>=1)
  {
    options.name=arguments[0];
  }

  /**
   * action
   *  - add   ("add", item, [options])
   *  - remove ("remove", item)
   *  - clear ("clear")
   */
  this.doAction = function(fct)
  {
    switch(fct)
    {
      case 'add':
        if(arguments.length==2)
        {
          add(arguments[1], { } );
        }
        else
        {
          add(arguments[1], arguments[2]);
        }
        break;
      case 'remove':
        if(arguments.length==2)
        {
          remove(arguments[1]);
        }
        break;
      case 'clear':
        clear();
        break;
      case 'hide':
        hide();
        break;
      case 'show':
        show();
        break;
      case 'prepare':
        if(arguments.length==4)
        {
          prepare(arguments[1], arguments[2], arguments[3]);
        }
        break;
    }
  };

  var add = function (item, options)
  {
    index=getIndex(item);

    if(index==-1 & item.title!='')
    {
      // process only items not already processed

      tip=new tipItem(item, itemIndexInc, options);

      $(item)
        .attr(
          {
           title: '',
           simpleTip: tip.index
          }
        )
        .bind('mouseover', {index:tip.index}, function (event)
          {
            prepare($(this).offset().left, $(this).offset().top, $(this).innerWidth(), $(this).innerHeight(), event.data.index );
            show();
          }
        )
        .bind('mouseout', function (event)
          {
            hide();
          }
        );

      items.push(tip);
      itemIndexInc++;
    }

  };


  var remove = function (item)
  {
    index=getIndex(item);

    if(index!=-1)
    {
      $(item)
        .attr(
          {
           title: items[index].content,
           simpleTip: ''
          }
        )
        .unbind('mouseover')
        .unbind('mouseout');

      items[index].item=null;
      items.splice(index,1);
    }
  };


  var clear = function ()
  {
    hide();

    while(items.length>0)
    {
      if(items[0].item!=null)
      {
        $(items[0].item)
          .attr(
            {
             title: items[0].content,
             simpleTip: ''
            }
          )
          .unbind('mouseover')
          .unbind('mouseout');
        items[0].item=null;
      }
      items.shift();
    }
    itemIndexInc=0;
  };


  var getIndex = function(item)
  {
    searched=$(item).attr('simpleTip');

    for(i=0;i<items.length;i++)
    {
      if(items[i].index==searched) return(i);
    }
    return(-1);
  };

  /**
   * prepare the tooltip
   *
   * @param Float posX : position X of the target
   * @param Float posY : position Y of the target
   * @param Float width  : width of the target
   * @param Float height : height of the target
   * @param String index : index of the target item
   */
  var prepare = function (posX, posY, width, height, index)
  {
    //itemIndex=getIndex(getFromIndex(index));
    itemIndex=index;
    arrowX=0;
    arrowY=0;

    $('#iSimpleTipContent'+options.name).html(items[itemIndex].content);

    $('#iSimpleTip'+options.name)
      .css(
        {
          left: '-1500px',
          top:  '-1500px',
          display: 'block'
        }
      );

    switch(items[itemIndex].options.targetPos)
    {
      case 'top-left':
        x=posX;
        y=posY;
        break;

      case 'top-middle':
        x=posX+width/2;
        y=posY;
        break;

      case 'top-right':
        x=posX+width;
        y=posY;
        break;

      case 'middle-left':
        x=posX;
        y=posY+height/2;
        break;

      case 'middle-middle':
        x=posX+width/2;
        y=posY+height/2;
        break;

      case 'middle-right':
        x=posX+width;
        y=posY+height/2;
        break;

      case 'bottom-left':
        x=posX;
        y=posY+height;
        break;

      case 'bottom-middle':
        x=posX+width/2;
        y=posY+height;
        break;

      case 'bottom-right':
        x=posX+width;
        y=posY+height;
        break;
    }


    stWidth=$('#iSimpleTipContent'+options.name).outerWidth();
    stHeight=$('#iSimpleTipContent'+options.name).outerHeight();
    stWidthI=$('#iSimpleTipContent'+options.name).innerWidth();
    stHeightI=$('#iSimpleTipContent'+options.name).innerHeight();
    bwX=(stWidth-stWidthI)/2;
    bwY=(stHeight-stHeightI)/2;
    arrowModel='';

    switch(items[itemIndex].options.tipPos)
    {
      case 'top-left':
        //nothing to do
        x+=items[itemIndex].options.offsetX;
        y+=items[itemIndex].options.offsetY;
        arrowX=-bwX;
        arrowY=-items[itemIndex].options.arrowHeight+bwY;
        arrowModel='up';
        break;

      case 'top-middle':
        x-=stWidth/2;
        y+=items[itemIndex].options.offsetY;
        arrowX=(stWidthI-items[itemIndex].options.arrowWidth)/2;
        arrowY=-items[itemIndex].options.arrowHeight+bwY;
        arrowModel='up';
        break;

      case 'top-right':
        x-=stWidth+items[itemIndex].options.offsetX;
        y+=items[itemIndex].options.offsetY;
        arrowX=stWidthI-items[itemIndex].options.arrowWidth+bwX;
        arrowY=-items[itemIndex].options.arrowHeight+bwY;
        arrowModel='up';
        break;

      case 'middle-left':
        x+=items[itemIndex].options.offsetX;
        y-=stHeight/2;
        arrowX=-items[itemIndex].options.arrowWidth+bwX;
        arrowY=(stHeightI-items[itemIndex].options.arrowHeight)/2+bwY;
        arrowModel='left';
        break;

      case 'middle-middle':
        x-=stWidth/2;
        y-=stHeight/2;
        break;

      case 'middle-right':
        x-=stWidth+items[itemIndex].options.offsetX;
        y-=stHeight/2;
        arrowX=stWidthI+bwX;
        arrowY=(stHeightI-items[itemIndex].options.arrowHeight)/2+bwY;
        arrowModel='right';
        break;

      case 'bottom-left':
        x+=items[itemIndex].options.offsetX;
        y-=stHeight+items[itemIndex].options.offsetY;
        arrowX=-bwX;
        arrowY=stHeightI+bwY;
        arrowModel='down';
        break;

      case 'bottom-middle':
        x-=stWidth/2;
        y-=stHeight+items[itemIndex].options.offsetY;
        arrowX=(stWidthI-items[itemIndex].options.arrowWidth)/2+bwX;
        arrowY=stHeightI+bwY;
        arrowModel='down';
        break;

      case 'bottom-right':
        x-=stWidth+items[itemIndex].options.offsetX;
        y-=stHeight+items[itemIndex].options.offsetY;
        arrowX=stWidthI-items[itemIndex].options.arrowWidth+bwX;
        arrowY=stHeightI+bwY;
        arrowModel='down';
        break;
    }

    if(items[itemIndex].options.drawArrow & arrowModel!='')
    {
      $('#iSimpleTipArrow'+options.name).css(
        {
          display: 'block',
          background: 'url("'+items[itemIndex].options.arrowImgDir+'/arrow_'+arrowModel+'.png") no-repeat scroll 0 0 transparent',
          marginLeft: arrowX+'px',
          marginTop: arrowY+'px',
          width: items[itemIndex].options.arrowWidth+'px',
          height: items[itemIndex].options.arrowHeight+'px'
        }
      );
    }
    else
    {
      $('#iSimpleTipArrow'+options.name).css('display', 'none');
    }


    $('#iSimpleTip'+options.name)
      .css(
        {
          left: x+'px',
          top:  y+'px',
          display: 'none'
        }
      )
      .removeClass()
      .addClass(items[itemIndex].options.classes);

  };

  var show = function ()
  {
    $('#iSimpleTip'+options.name).css('display', 'block');
  };

  var hide = function ()
  {
    $('#iSimpleTip'+options.name).css('display', 'none');
  };


  var init = function ()
  {
    if($('#iSimpleTip'+options.name).length==0)
    {
      text="<div id='iSimpleTip"+options.name+"' style='z-index:15000;display:none;position:absolute;left:0px;top:0px;'><div id='iSimpleTipShadow"+options.name+"' style='position:absolute;width:100%;height:100%;background:#000000;opacity:0.4;filter:alpha(opacity:40);display:block;z-index:-1;margin-left:2px;margin-top:2px;'></div><div id='iSimpleTipArrow"+options.name+"' style='position:absolute;'></div><div id='iSimpleTipContent"+options.name+"'></div></div>";
      $('body').append(text);
    }
  };


  init();
}
