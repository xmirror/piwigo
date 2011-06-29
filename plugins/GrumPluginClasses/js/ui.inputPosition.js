/**
 * -----------------------------------------------------------------------------
 * file: ui.inputPosition.js
 * file version: 1.0.0
 * date: 2010-11-05
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
                      disabled:false,
                      width:0,
                      height:0,
                      values:['center', 'corners', 'sides'],
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
                    isValid:true,
                    radioH:0,
                    radioW:0
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
                          'class':'ui-inputPosition',
                          css:{
                            width:'100%'
                          }
                        }
                    ),
                    radios:
                      {
                        corners:[],
                        sides:[],
                        center:[]
                      }
                  };

                var name=$this.get(0).id,
                    values=['TL', 'TR', 'BR', 'BL'];

                for(var i=0;i<values.length;i++)
                {
                  objects.radios.corners.push(
                    $('<input>',
                        {
                          type:'radio',
                          id:name+values[i],
                          name:'ip_'+name,
                          value:values[i],
                          group:'corners'
                        }
                    ).appendTo(objects.container)
                  );
                }

                values=['T', 'L', 'B', 'R'];
                for(var i=0;i<values.length;i++)
                {
                  objects.radios.sides.push(
                    $('<input>',
                        {
                          type:'radio',
                          id:name+values[i],
                          name:'ip_'+name,
                          value:values[i],
                          group:'sides'
                        }
                    ).appendTo(objects.container)
                  )
                }

                values=['C'];
                for(var i=0;i<values.length;i++)
                {
                  objects.radios.center.push(
                    $('<input>',
                        {
                          type:'radio',
                          id:name+values[i],
                          name:'ip_'+name,
                          value:values[i],
                          group:'center'
                        }
                    ).appendTo(objects.container)
                  )
                }

                objects.container.find('input').bind('click',
                  function (event)
                  {
                    privateMethods.setValue($this, $(this).attr('value'), false);
                  }
                );

                $this
                  .html('')
                  .append(objects.container);

                properties.radioW=objects.container.find('input').first().outerWidth()/2;
                properties.radioH=objects.container.find('input').first().outerHeight()/2;
                $this.css('padding', properties.radioH+'px '+properties.radioW+'px');

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
              objects.input.unbind().remove();
              objects.container.unbind().remove();
              $this
                .unbind('.inputPosition')
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
          return this.each(function()
            {
              privateMethods.setOptions($(this), value);
            }
          );
        }, // options

      disabled: function (value)
        {
          if(value!=null)
          {
            return this.each(function()
              {
                privateMethods.setDisabled($(this), value);
              }
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

      width: function (value)
        {
          if(value!=null)
          {
            return this.each(function()
              {
                privateMethods.setWidth($(this), value);
              }
            );
          }
          else
          {
            var options = this.data('options');

            if(options)
            {
              return(options.width);
            }
            else
            {
              return('');
            }
          }
        }, // width

      height: function (value)
        {
          if(value!=null)
          {
            return this.each(function()
              {
                privateMethods.setHeight($(this), value);
              }
            );
          }
          else
          {
            var options = this.data('options');

            if(options)
            {
              return(options.height);
            }
            else
            {
              return('');
            }
          }
        }, // width

      values: function (value)
        {
          if(value!=null)
          {
            return this.each(function()
              {
                privateMethods.setValues($(this), value);
              }
            );
          }
          else
          {
            var options = this.data('options');

            if(options)
            {
              return(options.values);
            }
            else
            {
              return('');
            }
          }
        }, // values

      value: function (value)
        {
          if(value!=null)
          {
            // set selected value
            return this.each(function()
              {
                privateMethods.setValue($(this), value, true);
              }
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
            return this.each(function()
              {
                privateMethods.setIsValid($(this), value);
              }
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

          privateMethods.setValues(object, (value.values!=null)?value.values:options.values);
          privateMethods.setHeight(object, (value.height!=null)?value.height:options.height, true);
          privateMethods.setWidth(object, (value.width!=null)?value.width:options.width, true);
          privateMethods.setValue(object, (value.value!=null)?value.value:options.value, true);
          privateMethods.setDisabled(object, (value.disabled!=null)?value.disabled:options.disabled);

          privateMethods.setEventChange(object, (value.change!=null)?value.change:options.change);

          properties.initialized=true;
        },

      setIsValid : function (object, value)
        {
          var objects=object.data('objects'),
              properties=object.data('properties');

          if(properties.isValid!=value)
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
          var options=object.data('options'),
              properties=object.data('properties');

          if((!properties.initialized || options.disabled!=value) && (value==true || value==false))
          {
            options.disabled=value;

          }
          return(options.disabled);
        },

      setHeight : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              properties=object.data('properties');

          if((!properties.initialized || options.height!=value) && value>=0)
          {
            if(value==0)
            {
              options.height=value;
              objects.container.css('height', '100%');
            }
            else
            {
              options.height=value;
              objects.container.css('height', options.height+'px');
            }
          }
          privateMethods.setRadioPosition(object);
          return(options.height);
        }, //setHeight

      setWidth : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              properties=object.data('properties');

          if((!properties.initialized || options.width!=value) && value>=0)
          {
            if(value==0)
            {
              options.width=value;
              objects.container.css('width', '100%');
            }
            else
            {
              options.width=value;
              objects.container.css('width', options.width+'px');
            }
            privateMethods.setRadioPosition(object);
          }
          return(options.width);
        }, //setWidth

      setValues : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects');

          if(!$.isArray(value)) value=[value];

          options.values=[];

          object.find('input').hide();

          for(var i=0;i<value.length;i++)
          {
            if(value[i]=='center' || value[i]=='corners' || value[i]=='sides')
            {
              options.values.push(value[i]);
              object.find('input[group='+value[i]+']').show();
            }
          }

          return(true);
        }, //setValue


      setValue : function (object, value, apply)
        {
          var options=object.data('options'),
              properties=object.data('properties'),
              objects=object.data('objects');

          if(!(($.inArray('center', options.values)>-1 && value=='C') ||
               ($.inArray('corners', options.values)>-1 && (value=='TL' || value=='TR' || value=='BR' || value=='BL')) ||
               ($.inArray('sides', options.values)>-1 && (value=='L' || value=='R' || value=='B' || value=='T'))
              )
            ) return(false);

          properties.value=value;

          if(apply)
          {
            switch(properties.value)
            {
              case 'TL':
                objects.radios.corners[0].attr('checked', true);
                break;
              case 'TR':
                objects.radios.corners[1].attr('checked', true);
                break;
              case 'BR':
                objects.radios.corners[2].attr('checked', true);
                break;
              case 'BL':
                objects.radios.corners[3].attr('checked', true);
                break;
              case 'T':
                objects.radios.sides[0].attr('checked', true);
                break;
              case 'L':
                objects.radios.sides[1].attr('checked', true);
                break;
              case 'B':
                objects.radios.sides[2].attr('checked', true);
                break;
              case 'R':
                objects.radios.sides[3].attr('checked', true);
                break;
              case 'C':
                objects.radios.center[0].attr('checked', true);
                break;
            }
          }

          if(options.change) object.trigger('inputPositionChange', properties.value);

          return(true);
        }, //setValue

      setEventChange : function (object, value)
        {
          var options=object.data('options');

          options.change=value;
          object.unbind('inputPositionChange');
          if(value) object.bind('inputPositionChange', options.change);
          return(options.change);
        },

      setRadioPosition : function (object)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              properties=object.data('properties');

          if($.inArray('center', options.values)>-1)
          {
            objects.radios.center[0].css(
              {
                'margin-left':(options.width/2-properties.radioW)+'px',
                'margin-top':(options.height/2-properties.radioH)+'px'
              }
            );
          }
          if($.inArray('corners', options.values)>-1)
          {
            for(var i=0;i<objects.radios.corners.length;i++)
            {
              switch(objects.radios.corners[i].attr('value'))
              {
                case 'TL':
                  objects.radios.corners[i].css(
                    {
                      'margin-left':'-'+properties.radioW+'px',
                      'margin-top':'-'+properties.radioH+'px'
                    }
                  );
                  break;
                case 'TR':
                  objects.radios.corners[i].css(
                    {
                      'margin-left':(options.width-properties.radioW)+'px',
                      'margin-top':'-'+properties.radioH+'px'
                    }
                  );
                  break;
                case 'BR':
                  objects.radios.corners[i].css(
                    {
                      'margin-left':(options.width-properties.radioW)+'px',
                      'margin-top':(options.height-properties.radioH)+'px'
                    }
                  );
                  break;
                case 'BL':
                  objects.radios.corners[i].css(
                    {
                      'margin-left':'-'+properties.radioW+'px',
                      'margin-top':(options.height-properties.radioH)+'px'
                    }
                  );
                  break;
              }
            }
          }
          if($.inArray('sides', options.values)>-1)
          {
            w=objects.radios.sides[0].width();
            h=objects.radios.sides[0].height();

            for(var i=0;i<objects.radios.sides.length;i++)
            {
              switch(objects.radios.sides[i].attr('value'))
              {
                case 'L':
                  objects.radios.sides[i].css(
                    {
                      'margin-left':'-'+properties.radioW+'px',
                      'margin-top':(options.height/2-properties.radioH)+'px'
                    }
                  );
                  break;
                case 'T':
                  objects.radios.sides[i].css(
                    {
                      'margin-left':(options.width/2-properties.radioW)+'px',
                      'margin-top':'-'+properties.radioH+'px'
                    }
                  );
                  break;
                case 'R':
                  objects.radios.sides[i].css(
                    {
                      'margin-left':(options.width-properties.radioW)+'px',
                      'margin-top':(options.height/2-properties.radioH)+'px'
                    }
                  );
                  break;
                case 'B':
                  objects.radios.sides[i].css(
                    {
                      'margin-left':(options.width/2-properties.radioW)+'px',
                      'margin-top':(options.height-properties.radioH)+'px'
                    }
                  );
                  break;
              }
            }
          }
        }

    };

    $.fn.inputPosition = function(method)
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
        $.error( 'Method ' +  method + ' does not exist on jQuery.inputPosition' );
      }
    } // $.fn.inputPosition

  }
)(jQuery);


