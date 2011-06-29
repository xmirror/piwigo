/**
 * -----------------------------------------------------------------------------
 * file: ui.inputStatusBar.js
 * file version: 1.0.0
 * date: 2010-11-04
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
 *
 *
 *
 * :: HISTORY ::
 *
 * | release | date       |
 * | 1.0.0   | 2010/11/04 | first release
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
                      items:[]
                    };

              // if options given, merge it
              // if(opt) $.extend(options, opt); ==> options are set by setters

              $this.data('options', options);


              if(!properties)
              {
                $this.data('properties',
                  {
                    initialized:false,
                    id:$this.get(0).id
                  }
                );
                properties=$this.data('properties');
              }

              if(!objects)
              {
                objects =
                  {
                    table:$('<table/>',
                            {
                              'class':'ui-inputStatusBar',
                              css:{
                                width:'100%'
                              }
                            }
                          ),
                    tr:$('<tr/>'),
                    td:[]
                  };

                $this
                  .html('')
                  .append(objects.table.append(objects.tr));
                  /*
                  .bind('resize.inputStatusBar',
                          function ()
                          {
                            privateMethods.setObjectsWidth($this);
                          }
                        );
                  */
                $this.data('objects', objects);
              }

              privateMethods.setOptions($this, opt);
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
              objects.tr.remove();
              objects.table.remove();
              $this
                .unbind('.inputStatusBar')
                .css(
                  {
                    width:'',
                    height:''
                  }
                );
            }
          );
        }, // destroy

      options: function (value)
        {
          return(
            this.each(
              function()
              {
                privateMethods.setOptions($(this), value);
              }
            )
          );
        }, // options

      items: function (fct, value)
        {
          if((fct=='add' || fct=='remove' || fct=='set') && value!=null)
          {
            return(
              this.each(
                function()
                {
                  privateMethods.setItems($(this), fct, value);
                }
              )
            );
          }
          else if(fct=='get' && value!=null)
          {
            var options=this.data('options');
            return(options.items[value]);
          }
          else
          {
            var options=this.data('options');
            return(options.items);
          }
        } // items


    }; // methods


    /*
     * plugin 'private' methods
     */
    var privateMethods =
    {
      setOptions : function (object, value)
        {
          var properties=object.data('properties'),
              options=object.data('options');

          if(!$.isPlainObject(value)) return(false);

          properties.initialized=false;

          privateMethods.setItems(object, 'init', (value.items!=null)?value.items:options.items);

          properties.initialized=true;
        },


      setItems : function (object, fct, value)
        {
          var options=object.data('options'),
              properties=object.data('properties'),
              objects=object.data('objects'),
              index=-1;

          if(value.id==null && !$.isArray(value)) return(false);

          if(value.id!=null) index=privateMethods.findItemById(object, value.id);


          if(fct=='add' && value.id!=null && index==-1)
          {
            if(value.content==null) value.content='&nbsp;';
            if(value.width==null) value.width='';
            if(value.title==null) value.title='';

            var td=$('<td/>',
                      {
                        id:properties.id+value.id,
                        html:value.content,
                        title:value.title,
                        css:{
                          width:value.width
                        }
                      }
                    );
            objects.td.push(
              {
                id:value.id,
                td:td
              }
            );
            objects.tr.append(td);
            options.items.push(value);
          }
          else if(fct=='remove' && value.id!=null && index>-1)
          {
            if(index>-1)
            {
              objects.td[index].td.remove();
              objects.td.splice(index,1);
              options.items.splice(index, 1);
              delete options.items[value.id];
            }
          }
          else if(fct=='set' && value.id!=null && index>-1 && value.content!=null)
          {
            if(value.title==null) value.title='';

            objects.td[index].td.html(value.content).attr('title', value.title);
          }
          else if(fct=='init')
          {
            for(var i in value)
            {
              privateMethods.setItems(object, 'add', value[i]);
            }
          }

          return(true);
        }, //setValue


      findItemById : function (object, id)
        {
          var objects=object.data('objects');

          for(var i=0;i<objects.td.length;i++)
          {
            if(objects.td[i].id==id) return(i);
          }
          return(-1);
        }
    };


    $.fn.inputStatusBar = function(method)
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
        $.error( 'Method ' +  method + ' does not exist on jQuery.inputStatusBar' );
      }
    } // $.fn.inputStatusBar

  }
)(jQuery);


