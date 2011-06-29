/**
 * -----------------------------------------------------------------------------
 * file: ui.inputRadio.js
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
          return this.each(
            function()
            {
              // default values for the plugin
              var $this=$(this),
                  data = $this.data('options'),
                  objects = $this.data('objects'),
                  properties = $this.data('properties'),
                  options =
                    {
                      disabled:[],
                      hidden:[],
                      value:'',
                      change:null
                    };

              // if options given, merge it
              // if(opt) $.extend(options, opt); ==> options are set by setters

              $this.data('options', options);

              if(!properties)
              {
                $this.data('properties',
                  {
                    initialized:false,
                    value:'',
                    isValid:true
                  }
                );
                properties=$this.data('properties');
              }

              if(!objects)
              {
                objects =
                  {
                    radio:[]
                  };

                $this.data('objects', objects);
              }

              $this.find('input[type=radio]').each(
                function (index, item)
                {
                  objects.radio.push($(item));
                  $(item).attr('name', 'ir_'+$this.get(0).id).bind('click',
                    function (event)
                    {
                      privateMethods.setValue($this, $(this).attr('value'), false);
                    }
                  );
                }
              );

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
              for(var i=0;i<objects.radio.length;i++)
              {
                objects.radio.unbind();
              }
              objects.container.unbind().remove();
              $this
                .unbind('.inputRadio')
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
            return(privateMethods.getDisabled($(this)));
          }
        }, // disabled

      hidden: function (value)
        {
          if(value!=null)
          {
            return(
              this.each(
                function()
                {
                  privateMethods.setHidden($(this), value);
                }
              )
            );
          }
          else
          {
            return(privateMethods.getHidden($(this)));
          }
        }, // disabled

      value: function (value)
        {
          if(value!=null)
          {
            // set selected value
            return(
              this.each(
                function()
                {
                  privateMethods.setValue($(this), value, true);
                }
              )
            );
          }
          else
          {
            // return the selected tags
            var properties=this.data('properties');
            return(properties.value);
          }
        }, // value

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
        } // change

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

          privateMethods.setDisabled(object, (value.disabled!=null)?value.disabled:options.disabled);
          privateMethods.setHidden(object, (value.hidden!=null)?value.hidden:options.hidden);
          privateMethods.setValue(object, (value.value!=null)?value.value:options.value, true);

          privateMethods.setEventChange(object, (value.change!=null)?value.change:options.change);

          properties.initialized=true;
        },

      setIsValid : function (object, value)
        {
          var objects=object.data('objects'),
              properties=object.data('properties');

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
          return(properties.isValid);
        },

      setDisabled : function (object, value)
        {
          var objects=object.data('objects'),
              index=-1;

          if(!$.isArray(value)) value=[value];

          for(var i=0;i<objects.radio.length;i++)
          {
            index=$.inArray(objects.radio[i].attr('value'), value);
            objects.radio[i].attr('disabled', (index>-1));
          }
          return(privateMethods.getDisabled(object));
        },

      getDisabled : function (object)
        {
          var objects=object.data('objects'),
              returned=[];

          for(var i=0;i<objects.radio.length;i++)
          {
            if(objects.radio[i].attr('disabled')) returned.push(objects.radio[i].attr('value'));
          }
          return(returned);
        },


      setHidden : function (object, value)
        {
          var objects=object.data('objects');

          if(!$.isArray(value)) value=[value];

          for(var i=0;i<objects.radio.length;i++)
          {
            if($.inArray(objects.radio[i].attr('value'), value)>-1)
            {
              if(objects.radio[i].parent().attr('nodeName')=='LABEL')
              {
                objects.radio[i].parent().hide();
              }
              else
              {
                objects.radio[i].hide();
              }
            }
            else
            {
              if(objects.radio[i].parent().attr('nodeName')=='LABEL')
              {
                objects.radio[i].parent().show();
              }
              else
              {
                objects.radio[i].show();
              }
            }
          }
          return(privateMethods.getHidden(object));
        },

      getHidden : function (object)
        {
          var objects=object.data('objects'),
              returned=[];

          for(var i=0;i<objects.radio.length;i++)
          {
            if(objects.radio[i].css('display')=='none') returned.push(objects.radio[i].attr('value'));
          }
          return(returned);
        },

      setValue : function (object, value, apply)
        {
          var options=object.data('options'),
              properties=object.data('properties'),
              objects=object.data('objects'),
              index=privateMethods.findRadioByVal(object, value);

          if(index==-1) return(false);

          properties.value=value;

          if(apply)
          {
            objects.radio[index].attr('checked', true);
          }

          if(options.change) object.trigger('inputRadioChange', properties.value);

          return(true);
        }, //setValue

      setEventChange : function (object, value)
        {
          var options=object.data('options');

          options.change=value;
          object.unbind('inputRadioChange');
          if(value) object.bind('inputRadioChange', options.change);
          return(options.change);
        },

      findRadioByVal : function (object, value)
        {
          var objects=object.data('objects');

          for(var i=0;i<objects.radio.length;i++)
          {
            if(objects.radio[i].attr('value')==value) return(i);
          }
          return(-1);
        }

    };


    $.fn.inputRadio = function(method)
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
        $.error( 'Method ' +  method + ' does not exist on jQuery.inputRadio' );
      }
    } // $.fn.inputRadio

  }
)(jQuery);


