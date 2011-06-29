/**
 * -----------------------------------------------------------------------------
 * file: pagesNavigator.js
 * file version: 1.0.0
 * date: 2010-05-02
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
 * constructor : myPN = new pagesNavigator(containerId [, options]);
 *
 *  - containerId : the Id of the DOM element where the criteria will be added
 *  - options : an object with this properties :
 *          . numberItem:0,
 *          . itemPerPage:25,
 *          . defaultPage:0,
 *          . displayNumPage:7,
 *          . displayFirst:true,
 *          . displayLast:true,
 *          . displayPrevious:true,
 *          . displayNext:true,
 *          . textFirst:'&lt;&lt;',
 *          . textLast:'&gt;&gt;',
 *          . textPrevious:'&lt;',
 *          . textNext:'&gt;',
 *          . textMore:'...',
 *          . onPageChange:null,
 *          . classActive:'',
 *          . classInactive:'',
 *
 *
 * :: HISTORY ::
 *
 * | release | date       |
 * | 1.0.0   | 2010/05/02 | start to coding
 * |         |            |
 * |         |            |
 * |         |            |
 * |         |            |
 * |         |            |
 * |         |            |
 *
 */



function pagesNavigator(container)
{
  var itemsId = {
          first:'iNavFirst',
          last:'iNavLast',
          previous:'iNavPrevious',
          next:'iNavNext',
          pageNumber:'iNavPage',
          morePrevious:'iNavPrevMore',
          moreNext:'iNavNextMore',
          container:container,
        },
      pages = {
          num:0,
          current:1,
        },
      options = {
        numberItem:0,
        itemPerPage:25,
        defaultPage:0,
        displayNumPage:7,
        displayFirst:true,
        displayLast:true,
        displayPrevious:true,
        displayNext:true,
        hideMode:'1,<', // "1": hide nav if only 1 page to display, "<": hide nav First, Previous, Next & Last if num of page < displayNumPage
        textFirst:'&lt;&lt;',
        textLast:'&gt;&gt;',
        textPrevious:'&lt;',
        textNext:'&gt;',
        textMore:'...',
        onPageChange:null,
        classActive:'',
        classInactive:'',
        classDisabled:'',
      };


  /**
   *
   */
  this.doAction = function(fct)
  {
    switch(fct)
    {
      case 'setOptions':
        /* function 'setOptions' : allows to set options after the object was
         * created
         */
        if(arguments.length==2)
        {
          setOptions(arguments[1]);
        }
        break;
    }
  };

  /**
   * calculate the number of page
   *
   * @param Integer numItems : number of item to manage
   * @param Integer numPerPage : number of item to display per page
   * @return Integer : number of page
   */
  var calcNumPages=function(numItems, numPerPage)
  {
    return(Math.ceil(numItems/numPerPage));
  };

  /**
   *
   * @param Object optionsToSet : set the given options
   */
  var setOptions = function(optionsToSet)
  {
    if(typeof optionsToSet=='object')
    {
      options = jQuery.extend(options, optionsToSet);

      if(options.numberItem<=0) options.numberItem=0;
      if(options.itemPerPage<=0) options.itemPerPage=25;
      if(options.displayNumPage<=2) options.displayNumPage=8;

      pages.num=calcNumPages(options.numberItem, options.itemPerPage);

      if(options.defaultPage>0 && options.defaultPage<=pages.num) pages.current=options.defaultPage;
      build();
    }
  };

  /**
   * build the page navigator and affect it in the container
   *
   */
  var build = function()
  {
    re=/1/;
    if( (re.exec(options.hideMode)==null)==false && pages.num==1)
    {
      $('#'+itemsId.container).html('');
      return('');
    }

    var content="<ul id='"+container+"PageNavigator'>";

    styleLI=" list-style:none;float:left; ";
    re=/</;
    if( (re.exec(options.hideMode)==null)==false && pages.num<=options.displayNumPage)
    {
      hideFPNL='display:none;';
    }
    else
    {
      hideFPNL='';
    }


    pnClass="class='cPnInactive "+options.classInactive+"'";

    if(options.displayFirst) content+="<li style='"+styleLI+hideFPNL+"' id='"+itemsId.first+"' "+pnClass+">"+options.textFirst+"</li>";
    if(options.displayPrevious) content+="<li style='"+styleLI+hideFPNL+"' id='"+itemsId.previous+"' "+pnClass+">"+options.textPrevious+"</li>";
    content+="<li style='"+styleLI+"display:none;' id='"+itemsId.morePrevious+"' class='cPnDisabled "+options.classDisabled+"'>"+options.textMore+"</li>";

    for(i=1;i<=pages.num;i++)
    {
      content+="<li style='"+styleLI+"display:none;' id='"+itemsId.pageNumber+i+"' "+pnClass+">"+i+"</li>";
    }

    content+="<li style='"+styleLI+";display:none;' id='"+itemsId.moreNext+"' class='cPnDisabled "+options.classDisabled+"'>"+options.textMore+"</li>";
    if(options.displayNext) content+="<li style='"+styleLI+hideFPNL+"' id='"+itemsId.next+"' "+pnClass+">"+options.textNext+"</li>";
    if(options.displayLast) content+="<li style='"+styleLI+hideFPNL+"' id='"+itemsId.last+"' "+pnClass+">"+options.textLast+"</li>";

    content+="</ul>";

    $('#'+itemsId.container).css('visibility', 'hidden').html(content);
    $('.cPnInactive').bind('click', onChangePage);

    displayNav();

    $('#'+itemsId.container).css('visibility', 'visible');
  };


  var displayNav = function()
  {
    // -1 for the current page
    prev=Math.ceil((options.displayNumPage-1)/2);
    if(pages.current-prev<=0)
    {
      prev=pages.current-1;
    }
    next=options.displayNumPage-1-prev;

    if(pages.current+next>=pages.num)
    {
      prev+=(pages.current+next-pages.num);
      next=pages.num-pages.current;
    }

    prev=pages.current-prev;
    next=pages.current+next;

    if(prev>1)
    {
      $('#'+itemsId.morePrevious).css('display', 'block');
    }
    else
    {
      $('#'+itemsId.morePrevious).css('display', 'none');
    }

    if(next<pages.num)
    {
      $('#'+itemsId.moreNext).css('display', 'block');
    }
    else
    {
      $('#'+itemsId.moreNext).css('display', 'none');
    }

    $('#'+itemsId.container+' ul li').each(
      function ()
      {
        id=-1;
        if(!(this.id==itemsId.first ||
             this.id==itemsId.previous ||
             this.id==itemsId.next ||
             this.id==itemsId.last ||
             this.id==itemsId.morePrevious ||
             this.id==itemsId.moreNext))
        {
          re=/[0-9]*$/i;
          id=re.exec(this.id)[0];


          if(id>=prev && id <=next)
          {
            $(this).css('display', 'block');
          }
          else
          {
            $(this).css('display', 'none');
          }

          if(id==pages.current)
          {
            $(this).addClass('cPnActive '+options.classActive).removeClass('cPnInactive '+options.classInactive);
          }
          else
          {
            $(this).addClass('cPnInactive '+options.classInactive).removeClass('cPnActive '+options.classActive);
          }
        }



        if( ((this.id==itemsId.first || this.id==itemsId.previous) && pages.current==1) ||
            ((this.id==itemsId.last || this.id==itemsId.next) && pages.current==pages.num) ||
            (this.id==itemsId.morePrevious || this.id==itemsId.moreNext ) )
        {
          $(this).addClass('cPnDisabled '+options.classDisabled).removeClass('cPnInactive '+options.classInactive);
        }
        else
        {
          $(this).addClass('cPnInactive '+options.classInactive).removeClass('cPnDisabled '+options.classDisabled);
        }
      }
    );

  };


  /**
   * this function is called every time a page is changed
   *  - manage the navigation bar
   *  - if defined, execute the callback function
   */
  var onChangePage = function (event)
  {
    //event.target.id : the clicked item
    if(event.target.id==itemsId.first)
    {
      pages.current=1;
    }
    else if(event.target.id==itemsId.previous)
    {
      pages.current--;
    }
    else if(event.target.id==itemsId.next)
    {
      pages.current++;
    }
    else if(event.target.id==itemsId.last)
    {
      pages.current=pages.num;
    }
    else
    {
      re=/[0-9]*$/i;
      page=re.exec(event.target.id)[0];

      if(page==pages.current) return(false);

      pages.current=eval(page);
    }

    if(pages.current<=0) pages.current=1;
    if(pages.current>=pages.num) pages.current=pages.num;

    displayNav();
    if(options.onPageChange!=null && jQuery.isFunction(options.onPageChange)) options.onPageChange(pages.current);
  };

  if(arguments.length==2)
  {
    setOptions(arguments[1]);
  }

}
