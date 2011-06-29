/**
 * -----------------------------------------------------------------------------
 * file: ui.inputColorsFB.js
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
                      width:0,
                      height:0,
                      disabled:false,
                      fg:
                        {
                          color:'#ffffff',
                          opacity:1
                        },
                      bg:
                        {
                          color:'#000000',
                          opacity:1
                        },
                      selected:'fg',
                      mode:2, //1 - 2
                      boxSize:0.6,
                      change:null,
                      click:null
                    };

              // if options given, merge it
              // if(opt) $.extend(options, opt); ==> options are set by setters

              $this.data('options', options);


              if(!properties)
              {
                $this.data('properties',
                  {
                    initialized:false
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
                          'class':'ui-inputColorsFB',
                          css:{
                            width:'100%',
                            height:'100%'
                          }
                        }
                    ),
                    fg:$('<div/>',
                      {
                        'class':'ui-inputColorsFB-fg'
                      }
                    ).bind('click.inputColorsFB',
                        function (event)
                        {
                          if(options.mode==2) privateMethods.setSelected($this, 'fg' );
                          if(options.click) $this.trigger('inputColorsFBClick', {target:'fg', color: options.fg} );
                        }
                      ),
                    bg:$('<div/>',
                      {
                        'class':'ui-inputColorsFB-bg'
                      }
                    ).bind('click.inputColorsFB',
                        function (event)
                        {
                          if(options.mode==2) privateMethods.setSelected($this, 'bg' );
                          if(options.click) $this.trigger('inputColorsFBClick', {target:'bg', color: options.bg} );
                        }
                      ),
                    fgopacity:$('<div/>',
                        {
                          'class':'ui-inputColorsFB-fgopacity'
                        }
                    ),
                    bgopacity:$('<div/>',
                        {
                          'class':'ui-inputColorsFB-bgopacity'
                        }
                    )
                  };

                $this
                  .html('')
                  .append(objects.container.append(objects.fgopacity.append(objects.fg)).append(objects.bgopacity.append(objects.bg)));

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
              objects.dot.remove();
              objects.container.unbind().remove();
              $this
                .unbind('.inputColorsFB')
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

      disabled: function (value)
        {
          if(value!=null)
          {
            return(
              this.each(
                function()
                {
                  privateMethods.setDisabled($(this), value);
                }
              )
            );
          }
          else
          {
            var options = this.data('options');

            if(options)
            {
              return(options.disabled);
            }
            else
            {
              return('');
            }
          }
        }, // disabled

      mode: function (value)
        {
          if(value!=null)
          {
            return(
              this.each(
                function()
                {
                  privateMethods.setMode($(this), value, true);
                }
              )
            );
          }
          else
          {
            var options=this.data('options');
            return(options.mode);
          }
        }, // mode

      boxSize: function (value)
        {
          if(value!=null)
          {
            return(
              this.each(
                function()
                {
                  privateMethods.setBoxSize($(this), value, true);
                }
              )
            );
          }
          else
          {
            var options=this.data('options');
            return(options.boxSize);
          }
        }, // boxSize

      width: function (value)
        {
          if(value!=null)
          {
            return(
              this.each(
                function()
                {
                  privateMethods.setWidth($(this), value, true);
                }
              )
            );
          }
          else
          {
            var options=this.data('options');
            return(options.width);
          }
        }, // width

      height: function (value)
        {
          if(value!=null)
          {
            return(
              this.each(
                function()
                {
                  privateMethods.setHeight($(this), value, true);
                }
              )
            );
          }
          else
          {
            var options=this.data('options');
            return(options.height);
          }
        }, // height

      fg: function (value)
        {
          if(value!=null)
          {
            // set selected value
            return(
              this.each(
                function()
                {
                  privateMethods.setFG($(this), value, true);
                }
              )
            );
          }
          else
          {
            // return the selected tags
            var options=this.data('options');
            return(options.fg);
          }
        }, // fg

      bg: function (value)
        {
          if(value!=null)
          {
            // set selected value
            return(
              this.each(
                function()
                {
                  privateMethods.setBG($(this), value, true);
                }
              )
            );
          }
          else
          {
            // return the selected tags
            var options=this.data('options');
            return(options.bg);
          }
        }, // bg

      selected: function (value)
        {
          if(value!=null)
          {
            // set selected value
            return(
              this.each(
                function()
                {
                  privateMethods.setSelected($(this), value);
                }
              )
            );
          }
          else
          {
            // return the selected tags
            var options=this.data('options');
            return(options.selected);
          }
        }, // selected

      isValid: function (value)
        {
          if(value!=null)
          {
            // set selected value
            return(
              this.each(
                function()
                {
                  privateMethods.setIsValid($(this), value);
                }
              )
            );
          }
          else
          {
            // return the selected tags
            var properties=this.data('properties');
            return(properties.isValid);
          }
        }, // isValid

      change: function (value)
        {
          if(value!=null && $.isFunction(value))
          {
            // set selected value
            return(
              this.each(
                function()
                {
                  privateMethods.setEventChange($(this), value);
                }
              )
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
        }, // change

      click: function (value)
        {
          if(value!=null && $.isFunction(value))
          {
            // set selected value
            return(
              this.each(
                function()
                {
                  privateMethods.setEventClick($(this), value);
                }
              )
            );
          }
          else
          {
            // return the selected value
            var options=this.data('options');

            if(options)
            {
              return(options.click);
            }
            else
            {
              return(null);
            }
          }
        } // click

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

          privateMethods.setMode(object, (value.mode!=null)?value.mode:options.mode);
          privateMethods.setBoxSize(object, (value.boxSize!=null)?value.boxSize:options.boxSize);
          privateMethods.setWidth(object, (value.width!=null)?value.width:options.width);
          privateMethods.setHeight(object, (value.height!=null)?value.height:options.height);
          privateMethods.setFG(object, (value.fg!=null)?value.fg:options.fg);
          privateMethods.setBG(object, (value.bg!=null)?value.bg:options.bg);
          privateMethods.setSelected(object, (value.selected!=null)?value.selected:options.selected, true);

          privateMethods.setEventChange(object, (value.change!=null)?value.change:options.change);
          privateMethods.setEventClick(object, (value.click!=null)?value.click:options.click);

          properties.initialized=true;
        },

      setIsValid : function (object, value)
        {
          var objects=object.data('objects'),
              properties=object.data('properties');
/*
          if(properties.isValid!=value && properties.initialized)
          {
            properties.isValid=value;
            if(properties.isValid)
            {
              objects.container.removeClass('ui-error');
              objects.input.removeClass('ui-error');
            }
            else
            {
              objects.container.addClass('ui-error');
              objects.input.addClass('ui-error');
            }
          }
*/
          return(properties.isValid);
        },


      setMode : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              properties=object.data('properties');

          if((!properties.initialized || options.mode!=value) && (value==1 || value==2))
          {
            options.mode=value;
            privateMethods.setSelected(object, 'fg');
            if(options.mode==1)
            {
              objects.bg.css('display', 'none');
              objects.bgopacity.css('display', 'none');
              objects.fgopacity.removeClass('ui-inputColorsFB-selected');
              if(options.click==null) objects.fgopacity.removeClass('ui-inputColorsFB-clickable');
            }
            else
            {
              objects.bg.css('display', 'block');
              objects.bgopacity.css('display', 'block').addClass('ui-inputColorsFB-clickable');
              objects.fgopacity.addClass('ui-inputColorsFB-clickable');
            }
            privateMethods.updateSizes(object);
          }
          return(options.mode);
        },

      setBoxSize : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              properties=object.data('properties');

          if((!properties.initialized || options.boxSize!=value) && (value>0 && value<=1))
          {
            options.boxSize=value;
            privateMethods.updateSizes(object);
          }
          return(options.boxSize);
        },

      setWidth : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              properties=object.data('properties');

          if((!properties.initialized || options.width!=value) && value>0)
          {
            options.width=value;
            privateMethods.updateSizes(object);
          }
          return(options.width);
        },

      setHeight : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              properties=object.data('properties');

          if((!properties.initialized || options.height!=value) && value>0)
          {
            options.height=value;
            privateMethods.updateSizes(object);
          }
          return(options.height);
        },

      setDisabled : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              properties=object.data('properties');

          if((!properties.initialized || options.disabled!=value) && (value==true || value==false))
          {
            options.disabled=value;
            objects.input.attr('disabled', options.disabled);
          }
          return(options.disabled);
        },

      setSelected : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              properties=object.data('properties');

          if((!properties.initialized || options.selected!=value) && (value=='fg' || value=='bg') && options.mode==2)
          {
            options.selected=value;

            if(options.selected=='fg')
            {
              objects.fgopacity.addClass('ui-inputColorsFB-selected');
              objects.bgopacity.removeClass('ui-inputColorsFB-selected');
            }
            else
            {
              objects.fgopacity.removeClass('ui-inputColorsFB-selected');
              objects.bgopacity.addClass('ui-inputColorsFB-selected');
            }
            if(options.change) object.trigger('inputColorsFBChange', options.selected);
          }

          return(options.selected);
        }, //setFG

      setFG : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects');

          if(value.color==null || value.opacity==null)
          {
            return(false);
          }

          options.fg.color=value.color;
          options.fg.opacity=value.opacity;

          objects.fg.css(
            {
              'background':options.fg.color,
              'opacity':options.fg.opacity
            }
          );

          return(true);
        }, //setFG

      setBG : function (object, value, apply)
        {
          var options=object.data('options'),
              objects=object.data('objects');

          if(value.color==null || value.opacity==null)
          {
            return(false);
          }

          options.bg.color=value.color;
          options.bg.opacity=value.opacity;

          objects.bg.css(
            {
              'background':options.bg.color,
              'opacity':options.bg.opacity
            }
          );

          return(true);
        }, //setBG


      setEventChange : function (object, value)
        {
          var options=object.data('options');

          options.change=value;
          object.unbind('inputColorsFBChange');
          if(value) object.bind('inputColorsFBChange', options.change);
          return(options.change);
        },

      setEventClick : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects');

          options.click=value;
          object.unbind('inputColorsFBClick');
          if(value)
          {
            object.bind('inputColorsFBClick', options.click);
            objects.fgopacity.addClass('ui-inputColorsFB-clickable');
          }
          else if(options.mode==1)
          {
            objects.fgopacity.removeClass('ui-inputColorsFB-clickable');
          }
          return(options.click);
        },

      updateSizes : function (object)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              tmpSize=1;

          if(options.mode==2) tmpSize=options.boxSize;



          objects.container.css(
            {
              'width': options.width+'px',
              'height': options.height+'px'
            }
          );
          objects.fgopacity.css(
            {
              'width': (options.width*tmpSize)+'px',
              'height': (options.height*tmpSize)+'px'
            }
          );

          if(options.mode==2)
          {
            objects.bgopacity.css(
              {
                'width': (options.width*options.boxSize)+'px',
                'height': (options.height*options.boxSize)+'px',
                'margin-left': (options.width*(1-options.boxSize))+'px',
                'margin-top': (options.height*(1-options.boxSize))+'px'
              }
            );
          }
        }

    };


    $.fn.inputColorsFB = function(method)
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
        $.error( 'Method ' +  method + ' does not exist on jQuery.inputColorsFB' );
      }
    } // $.fn.inputColorsFB

  }
)(jQuery);


