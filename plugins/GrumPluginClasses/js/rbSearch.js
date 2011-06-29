/**
 * -----------------------------------------------------------------------------
 * file: criteriaBuilderSearch.js
 * file version: 1.1.1
 * date: 2011-05-15
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
 * used to manage the requestBuilder search interface
 *
 * :: HISTORY ::
 *
 * | release | date       |
 * | 1.0.0   | 2010/04/27 | * start to coding
 * |         |            |
 * | 1.1.0   | 2010/10/21 | * change ajax methods
 * |         |            |
 * |         |            | * fix bug : if there is no criteria, don't send
 * |         |            |   request
 * |         |            |
 * | 1.1.1   | 2011/05/15 | * fix some incompatibilities with IE7
 * |         |            |
 * |         |            |
 * |         |            |
 * |         |            |
 *
 */

  var cb=null;

  var interfaceManager = function(optionsToSet)
  {
    var pn=null,
        requestNumber=0,
        options =
          {
            requestCriterionsVisible:'',
            requestCriterionsHidden:'',
            requestResult:'',
            requestResultContent:'',
            requestResultNfo:'',
            requestResultPagesNavigator:'',
            requestResultRequestNumber:0,
            onPageChange:null,
            numberPerPage:30
          };

    /**
     *
     */
    this.doAction = function(fct)
    {
      switch(fct)
      {
        case 'queryResult':
          /* function 'queryResult' : when query is executed, prepare the interface
           */
          if(arguments.length==3)
          {
            displayQueryResult(arguments[1], arguments[2]);
          }
          break;
        case 'queryPage':
          /* function 'queryPage' : display returned page
           */
          if(arguments.length==3)
          {
            displayQueryPage(arguments[1], arguments[2]);
          }
          break;
        case 'show':
          /* function 'show' : show/hide the query/result
           */
          if(arguments.length==2)
          {
            show(arguments[1]);
          }
          break;
        case 'setOptions':
          /* function 'setOptions' : allows to set options after the object was
           *                         created
           */
          if(arguments.length==2)
          {
            setOptions(arguments[1]);
          }
          break;
        case 'fillCaddie':
          /* function 'fillCaddie' : allows to fill the caddie with the search result
           *
           */
          if(arguments.length==2)
          {
            fillCaddie(arguments[1], this.getRequestNumber());
          }
          break;
      }
    };

    /**
     * returns the current request number
     */
    this.getRequestNumber = function ()
    {
      return(requestNumber);
    };

    /**
     * returns the number of items per page
     */
    this.getNumberPerPage = function ()
    {
      return(options.numberPerPage);
    };

    /**
     * this function show/hide the different panels
     *  'buildQuery'  : hide the result panel and display the panel to build query
     *  'resultQuery' : hide the panel to build query and display the result panel
     */
    var show = function(mode)
    {
      switch(mode)
      {
        case 'buildQuery':
          $('.'+options.requestCriterionsVisible).css('display', 'block');
          $('.'+options.requestCriterionsHidden).css('display', 'none');
          $('.'+options.requestResult).css('display', 'none');
          break;
        case 'resultQuery':
          $('#iResultQueryContent').html("<br><img class='waitingResult' src='./plugins/GrumPluginClasses/icons/processing.gif'>");
          $('.'+options.requestCriterionsVisible).css('display', 'none');
          $('.'+options.requestCriterionsHidden).css('display', 'block');
          $('.'+options.requestResult).css('display', 'block');
          break;
      }
    },

    /**
     * this function display the number of items found and prepare the page
     * navigator
     *
     * @param String nfo : 2 information separated with a semi-colon ';'
     *                      requestNumber;numberOfItems
     */
    displayQueryResult = function (isSuccess, nfo)
    {
      if(isSuccess)
      {
        nfo=nfo.split(';');

        requestNumber=nfo[0];
        $('#iResultQueryNfo').html(nfo[1]);
        pn.doAction('setOptions', { numberItem:nfo[1], defaultPage:1 } );
        show('resultQuery');
      }
      else
      {
        //$('#'+options.requestResultContent).html("");
        show('buildQuery');
        alert(requestBuilderOptions.textSomethingWrong);
      }
    },


    /**
     * this function display the number of items found and prepare the page
     * navigator
     *
     * @param String nfo : 2 information separated with a semi-colon ';'
     *                      requestNumber;numberOfItems
     */
    displayQueryPage = function (isSuccess, nfo)
    {
      if(isSuccess)
      {
        $('#iResultQueryContent').html(nfo);
      }
      else
      {
        alert(requestBuilderOptions.textSomethingWrong);
      }
    },


    /**
     *
     * @param Object optionsToSet : set the given options
     */
    setOptions = function(optionsToSet)
    {
      if(typeof optionsToSet=='object')
      {
        options = jQuery.extend(options, optionsToSet);
      }
    },

    /**
     * initialize the object
     */
    init = function (optionsToSet)
    {
      setOptions(optionsToSet);

      pn = new pagesNavigator(options.requestResultPagesNavigator,
        {
          itemPerPage:options.numberPerPage,
          displayNumPage:9,
          classActive:'pnActive',
          classInactive:'pnInactive',
          onPageChange: function (page)
            {
              if(options.onPageChange!=null && jQuery.isFunction(options.onPageChange))
              {
                options.onPageChange(requestNumber, page, options.numberPerPage);
              }
            }
        }
      );

      requestNumber=options.requestResultRequestNumber;
    },

    /**
     * fill the caddie with the search results
     * @param String mode : 'add' or 'fill'
     */
    fillCaddie = function (mode, requestNumber)
    {
      $('#iMenuCaddieImg').css('display', 'inline-block');
      $('#iMenuCaddieItems ul').css('display', 'none');

      $.ajax(
        {
          type: "POST",
          url: "plugins/GrumPluginClasses/gpc_ajax.php",
          async: true,
          data: { ajaxfct:"admin.rbuilder.fillCaddie", fillMode:mode, requestNumber:requestNumber },
          success:
            function(msg)
            {
              $('#iMenuCaddieImg').css('display', 'none');
              $('#iMenuCaddieItems ul').css('display', 'block');
              alert(requestBuilderOptions.textCaddieUpdated);
            },
          error:
            function(msg)
            {
              $('#iMenuCaddieImg').css('display', 'none');
              $('#iMenuCaddieItems ul').css('display', 'block');
              alert(requestBuilderOptions.textSomethingWrong);
            }
        }
      );
    };

    init(optionsToSet);
  };


  function init()
  {
    im = new interfaceManager(
      {
        requestCriterionsVisible:'cRequestCriterions',
        requestCriterionsHidden:'cModifyRequest',
        requestResult:'cResultQuery',
        requestResultContent:'iResultQueryContent',
        requestResultNfo:'iResultQueryNfo',
        requestResultPagesNavigator:'iPagesNavigator'
      }
    );

    requestBuilderOptions.classGroup='gcBorderInput gcTextInput';
    requestBuilderOptions.classItem='gcBgInput gcTextInput';
    requestBuilderOptions.classOperator='cbOperator cbOperatorBg gcLinkHover';
    requestBuilderOptions.onRequestSuccess = function (msg) { im.doAction('queryResult', true, msg); cb.doAction('getPage', im.getRequestNumber(), 1, im.getNumberPerPage()); };
    requestBuilderOptions.onRequestError = function (msg) { im.doAction('queryResult', false, msg); };
    requestBuilderOptions.onGetPageSuccess = function (msg) { im.doAction('queryPage', true, msg); };
    requestBuilderOptions.onGetPageError = function (msg) { im.doAction('queryPage', false, msg); };

    cb = new criteriaBuilder('iListSelectedCriterions', requestBuilderOptions);

    im.doAction('setOptions',
      {
        onPageChange:
          function (requestNumber, page, numberPerPage)
          {
            $('#iResultQueryContent').html("<br><img class='waitingResult' src='./plugins/GrumPluginClasses/icons/processing.gif'>");
            cb.doAction('getPage', requestNumber, page, numberPerPage);
          }
      }
    );
  }
