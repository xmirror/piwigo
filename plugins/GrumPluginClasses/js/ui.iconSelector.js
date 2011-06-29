/**
 * -----------------------------------------------------------------------------
 * file: ui.iconSelector.js
 * file version: 1.0.0
 * date: 2010-10-10
 *
 * A jQuery plugin provided by the piwigo's plugin "GrumPluginClasses"
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
 *  Options         Type                 Default value
 *  - images        Array<String>        []
 *      Define the list at initialization
 *        $(".selector").iconSelector({images:['url1', 'url2', ..., 'urlN']});
 *
 *      Set/get the images list after initialisation
 *        $(".selector").iconSelector('images', ['url1', 'url2', ..., 'urlN']);
 *        $(".selector").iconSelector('images');
 *
 *  - numCols       Integer              1
 *  - numRows       Integer              8
 *      Define the number of cols/rows displayed
 *      If number of icon is greater than numCols*numRows, a scrollbar allows to
 *      scroll on the list
 *        $(".selector").iconSelector({numCols:4, numRows:4});
 *
 *      Set/get the numCols/numRows after initialisation
 *        $(".selector").iconSelector('numCols', 4);
 *        $(".selector").iconSelector('numCols');
 *
 *  - cellWidth     Integer              32
 *  - cellHeight    Integer              32
 *      Define the width/height of cells in the list
 *      If number of icon is greater than numCols*numRows, a scrollbar allows to
 *      scroll on the list
 *        $(".selector").iconSelector({cellWidth:40, cellHeight:20});
 *
 *      Set/get the cellWidth/cellHeight after initialisation
 *        $(".selector").iconSelector('cellHeight', 20);
 *        $(".selector").iconSelector('cellHeight');
 *
 *  - value         String               (first value of image list)
 *      Define the current selected image
 *      can also take special values ':first' or ':last'
 *        $(".selector").iconSelector({value:'urlX'});
 *
 *      Set/get the selected icon after initialisation
 *        $(".selector").iconSelector('value', 'urlX');
 *        $(".selector").iconSelector('value');
 *
 *
 *  Events
 *  - popup
 *      Triggered when the selection list is opened/closed
 *      One parameter is given (selection list is visible or not)
 *        $(".selector").iconSelector({popup: function (event, visible) { ... } } );
 *
 *      To bind on the event :
 *        $(".selector").bind('iconSelectorPopup', function (event, visible) { ... } );
 *
 *  - change
 *      Triggered when the selected in has changed
 *      One parameter is given (the selected value)
 *        $(".selector").iconSelector({change: function (event, value) { ... } } );
 *
 *      To bind on the event :
 *        $(".selector").bind('iconSelectorChange', function (event, value) { ... } );
 *
 *
 *  Styles
 *  .ui-icon-selector               : CSS class for the main object
 *  .ui-icon-selector-list          : CSS class for the icon list container
 *  .ui-icon-selector-icon          : CSS class for icons
 *  .ui-icon-selector-selected-icon : CSS class for the selected icon
 *
 *
 * :: HISTORY ::
 *
 * | release | date       |
 * | 1.0.0   | 2010/10/10 | first release
 * |         |            |
 * |         |            |
 * |         |            |
 * |         |            |
 * |         |            |
 * |         |            |
 *
 */



(
  function($)
  {
    /*
     * plugin 'public' functions
     */
    var publicMethods =
    {
      init : function (opt)
        {
          return this.each(function()
            {
              // default values for the plugin
              var $this=$(this),
                  data = $this.data('options'),
                  objects = $this.data('objects'),
                  properties = $this.data('properties'),
                  options =
                    {
                      images:[],
                      numCols:1,
                      numRows:8,
                      cellWidth:32,
                      cellHeight:32,
                      popup:null,
                      change:null
                    };

              // if options given, merge it
              if(opt) $.extend(options, opt);

              $this.data('options', options);

              if(!properties)
              {
                $this.data('properties',
                  {
                    index:-1,
                    initialized:false,
                    selectorVisible:false
                  }
                );
                properties=$this.data('properties');
              }

              if(!objects)
              {
                objects =
                  {
                    container:$('<div/>',
                        {
                          'class':' ui-icon-selector '
                        }
                    ).bind('click.iconSelector',
                        function ()
                        {
                          privateMethods.displaySelector($this, !$this.data('properties').selectorVisible);
                        }
                      ),
                    listContainer:$('<div/>',
                        {
                          html: "",
                          'class':' ui-icon-selector-list ',
                          css: {
                            overflow:"auto",
                            width:'0px',
                            height:'0px',
                            display:'none',
                            position:'absolute'
                          }
                        }
                    ).bind('mouseleave.iconSelector',
                        function ()
                        {
                          privateMethods.displaySelector($this, false);
                        }
                      ),
                    list:$('<ul/>',
                      {
                        css: {
                          listStyle:'none',
                          padding:'0px',
                          margin:'0px'
                        }
                      }
                    )
                  };

                $this
                  .html('')
                  .append(objects.container)
                  .append(objects.listContainer.append(objects.list));


                $this.data('objects', objects);
              }

              privateMethods.setImages($this, options.images);
              privateMethods.setCellWidth($this, options.cellWidth);
              privateMethods.setCellHeight($this, options.cellHeight);
              privateMethods.setNumCols($this, options.numCols);
              privateMethods.setNumRows($this, options.numRows);
              privateMethods.setEventPopup($this, options.popup);
              privateMethods.setEventChange($this, options.change);
              if(options.images.length>0) privateMethods.setValue($this, options.images[0]);

              properties.initialized=true;
            }
          );
        }, // init
      destroy : function ()
        {
          return this.each(
            function()
            {
              // default values for the plugin
              var $this=$(this),
                  objects = $this.data('objects');
              objects.container.unbind().remove();
              objects.list.children().unbind();
              objects.listContainer.remove();
              $this
                .unbind('.iconSelector')
                .css(
                  {
                    width:'',
                    height:'',
                    backgroundImage:''
                  }
                );
            }
          );
        }, // destroy
      images : function (list)
        {
          if(list)
          {
            // set images list values
            return this.each(function()
              {
                privateMethods.setImages($(this), list);
              }
            );
          }
          else
          {
            // return images list values
            var options = this.data('options');

            if(options)
            {
              return(options.images);
            }
            else
            {
              return([]);
            }
          }
        }, // images
      numCols: function (value)
        {
          if(value)
          {
            // set numCols values
            return this.each(function()
              {
                privateMethods.setCols($(this), value);
              }
            );
          }
          else
          {
            // return images list values
            var options = this.data('options');

            if(options)
            {
              return(options.numCols);
            }
            else
            {
              return(0);
            }
          }
        }, // numCols
      numRows: function (value)
        {
          if(value)
          {
            // set numRows values
            return this.each(function()
              {
                privateMethods.setRows($(this), value);
              }
            );
          }
          else
          {
            // return images list values
            var options = this.data('options');

            if(options)
            {
              return(options.numRows);
            }
            else
            {
              return(0);
            }
          }
        }, // numRows
      cellWidth: function (value)
        {
          if(value)
          {
            // set cell width values
            return this.each(function()
              {
                privateMethods.setCellWidth($(this), value);
              }
            );
          }
          else
          {
            // return images list values
            var options = this.data('options');

            if(options)
            {
              return(options.cellWidth);
            }
            else
            {
              return(0);
            }
          }
        }, // cellWidth
      cellHeight: function (value)
        {
          if(value)
          {
            // set cell width values
            return this.each(function()
              {
                privateMethods.setCellHeight($(this), value);
              }
            );
          }
          else
          {
            // return images list values
            var options = this.data('options');

            if(options)
            {
              return(options.cellHeight);
            }
            else
            {
              return(0);
            }
          }
        }, // cellHeight
      value: function (value)
        {
          if(value)
          {
            // set selected value
            return this.each(function()
              {
                privateMethods.setValue($(this), value);
              }
            );
          }
          else
          {
            // return the selected value
            var options=this.data('options'),
                properties=this.data('properties');

            if(options && properties && properties.index>-1 && properties.index<options.images.length)
            {
              return(options.images[properties.index]);
            }
            else
            {
              return('');
            }
          }
        }, // value
      popup: function (value)
        {
          if(value && $.isFunction(value))
          {
            // set selected value
            return this.each(function()
              {
                privateMethods.setEventPopup($(this), value);
              }
            );
          }
          else
          {
            // return the selected value
            var options=this.data('options');

            if(options)
            {
              return(options.popup);
            }
            else
            {
              return(null);
            }
          }
        }, // popup
      change: function (value)
        {
          if(value && $.isFunction(value))
          {
            // set selected value
            return this.each(function()
              {
                privateMethods.setEventChange($(this), value);
              }
            );
          }
          else
          {
            // return the selected value
            var options=this.data('options');

            if(options)
            {
              return(options.change);
            }
            else
            {
              return(null);
            }
          }
        } // popup

    }; // methods


    /*
     * plugin 'private' methods
     */
    var privateMethods =
    {
      updateListArea : function (object)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              icon=objects.list.children().first(),
              width=icon.outerWidth()*options.numCols,
              height=icon.outerHeight()*options.numRows;

          objects.listContainer.css(
            {
              width:width+'px',
              height:height+'px'
            }
          );

          delta = width-objects.listContainer.get(0).clientWidth;
          // adjust size if scrollbars are present
          if(delta>0)
          {
            objects.listContainer.css('width', (width+delta)+'px');
          }
        },
      setImages : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              properties=object.data('properties');
          options.images=value;

          objects.list.children().unbind();
          objects.list.html('');
          for(var i=0;i<options.images.length;i++)
          {
            liClass=' ui-icon-selector-icon ';
            if(i==properties.index)
            {
              liClass+=' ui-icon-selector-selected-icon ';
            }
            objects.list.append(
              $('<li indexValue="'+i+'" class="'+liClass+'" style="display:inline-block;width:'+options.cellWidth+'px;height:'+options.cellHeight+'px;background-image:url('+options.images[i]+');"></li>')
                .bind('click',
                  {object:object},
                  function (event)
                  {
                    privateMethods.setValueByIndex(event.data.object, $(this).attr('indexValue'), true);
                    privateMethods.displaySelector(event.data.object, false);
                  }
                )
            );
          }

          return(options.images);
        },
      setNumCols : function (object, value)
        {
          var options=object.data('options'),
              properties=object.data('properties');
          if((!properties.initialized || options.numCols!=value) && value>0)
          {
            options.numCols=value;
          }
          return(options.numCols);
        },
      setNumRows : function (object, value)
        {
          var options=object.data('options'),
              properties=object.data('properties');
          if((!properties.initialized || options.numRows!=value) && value>0)
          {
            options.numRows=value;
          }
          return(options.numRows);
        },
      setCellWidth : function (object, value)
        {
          var options=object.data('options'),
              properties=object.data('properties'),
              objects=object.data('objects');
          if((!properties.initialized || options.cellWidth!=value) && value>=0)
          {
            options.cellWidth=value;
            objects.container.css('width', value+'px');
          }
          return(options.cellWidth);
        },
      setCellHeight : function (object, value)
        {
          var options=object.data('options'),
              properties=object.data('properties'),
              objects=object.data('objects');
          if((!properties.initialized || options.cellHeight!=value) && value>=0)
          {
            options.cellHeight=value;
            objects.container.css('height', value+'px');
          }
          return(options.cellHeight);
        },
      setValue : function (object, value)
        {
          var options=object.data('options'),
              properties=object.data('properties'),
              index=-1;

          switch(value)
          {
            case ':first':
              if(options.images.length>0) index=0;
              break;
            case ':last':
              index=options.images.length-1;
              break;
            default:
              index=$.inArray(value, options.images);
              break;
          }

          if((!properties.initialized || properties.index!=index) && index>-1)
          {
            privateMethods.setValueByIndex(object, index, false);
          }
          return(options.images[properties.index]);
        },
      setValueByIndex : function (object, value, trigger)
        {
          var options=object.data('options'),
              properties=object.data('properties'),
              objects=object.data('objects');
          if((!properties.initialized || properties.index!=value) && value>-1 && value<options.images.length)
          {
            objects.list.children('.ui-icon-selector-selected-icon').removeClass('ui-icon-selector-selected-icon');
            objects.list.children('[indexValue="'+value+'"]').addClass('ui-icon-selector-selected-icon');
            properties.index=value;
            objects.container.css('background-image', 'url('+options.images[properties.index]+')');
            if(trigger && options.change) object.trigger('iconSelectorChange', [properties.index]);
          }
          return(options.images[properties.index]);
        },
      displaySelector : function (object, value)
        {
          var options=object.data('options'),
              properties=object.data('properties'),
              objects=object.data('objects');
          if(properties.selectorVisible!=value)
          {
            properties.selectorVisible=value;

            if(properties.selectorVisible)
            {
              objects.listContainer
                .css('display', 'block')
                .scrollTop(objects.listContainer.scrollTop()+objects.list.children('[indexValue="'+properties.index+'"]').position().top);
              privateMethods.updateListArea(object);
            }
            else
            {
              objects.listContainer.css('display', 'none');
            }
            if(options.popup) object.trigger('iconSelectorPopup', [properties.selectorVisible]);
          }
          return(properties.selectorVisible);
        },
      setEventPopup : function (object, value)
        {
          var options=object.data('options');
          options.popup=value;
          object.unbind('iconSelectorPopup');
          if(value) object.bind('iconSelectorPopup', options.popup);
          return(options.popup);
        },
      setEventChange : function (object, value)
        {
          var options=object.data('options');
          options.change=value;
          object.unbind('iconSelectorChange');
          if(value) object.bind('iconSelectorChange', options.change);
          return(options.change);
        }
    };


    $.fn.iconSelector = function(method)
    {
      if(publicMethods[method])
      {
        return publicMethods[method].apply( this, Array.prototype.slice.call( arguments, 1 ));
      }
      else if(typeof method === 'object' || ! method)
      {
        return publicMethods.init.apply(this, arguments);
      }
      else
      {
        $.error( 'Method ' +  method + ' does not exist on jQuery.iconSelector' );
      }
    } // $.fn.iconSelector

  }
)(jQuery);


