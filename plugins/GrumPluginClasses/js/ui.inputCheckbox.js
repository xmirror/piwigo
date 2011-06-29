/**
 * -----------------------------------------------------------------------------
 * file: ui.inputCheckbox.js
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
                      values:
                        {
                          forced:false,
                          checked:'yes',
                          unchecked:'no'
                        },
                      returnMode:'selected',
                      change:null
                    };

              // if options given, merge it
              // if(opt) $.extend(options, opt); ==> options are set by setters

              $this
                .data('options', options)
                .addClass('ui-inputCheckbox');

              if(!properties)
              {
                $this.data('properties',
                  {
                    initialized:false,
                    isValid:true,
                    checkboxList:null,
                    isCB:true
                  }
                );
                properties=$this.data('properties');
              }

              if($this.get(0).tagName=='INPUT' && $this.get(0).type=='checkbox')
              {
                properties.checkboxList=$this;
              }
              else
              {
                properties.checkboxList=$this.find('input[type=checkbox]');
                properties.isCB=false;
              }

              properties.checkboxList.bind('click.inputCheckbox',
                function (event)
                {
                  privateMethods.setValue($this, $(this).attr('id'), $(this).attr('checked')?options.values.checked:options.values.unchecked,false);
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
              var properties=this.data('properties');
              properties.checkboxList.unbind('.inputCheckbox');
              this.removeClass('ui-inputCheckbox');
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

      values: function (value)
        {
          if(value!=null)
          {
            // set selected value
            return(
              this.each(
                function()
                {
                  privateMethods.setValues($(this), value);
                }
              )
            );
          }
          else
          {
            var options=this.data('options');
            // return the selected tags
            return(options.values);
          }
        }, // value

      value: function (id, value)
        {
          var properties=this.data('properties');

          if(properties.isCB)
          {
            value=id;
            id=$(this).get(0).id;
          }

          if(value!=null || id==':all' || id==':invert' || id==':none')
          {
            // set selected value
            return(
              this.each(
                function()
                {
                  privateMethods.setValue($(this), id, value, true);
                }
              )
            );
          }
          else if(id!=null && id!='')
          {
            var options=this.data('options');
            // return the selected tags
            return($(this).find('#'+id).attr('checked')?options.values.checked:options.values.unchecked);
          }
          else
          {
            var options=this.data('options'),
                returned=[];

            if(options.values.forced)
            {
              $(this).find('input').each(
                function ()
                {
                  returned.push( {id:$(this).attr('id'), value:$(this).attr('checked')?options.values.checked:options.values.unchecked } );
                }
              );
            }
            else
            {
              var filter=(options.returnMode=='selected'?':checked':':not(:checked)');
              $(this).find('input'+filter).each(
                function ()
                {
                  returned.push($(this).attr('value'));
                }
              );
            }

            return(returned);
          }

        }, // value

      returnMode: function (value)
        {
          if(value!=null)
          {
            return this.each(function()
              {
                privateMethods.setReturnMode($(this), value);
              }
            );
          }
          else
          {
            var options = this.data('options');

            if(options)
            {
              return(options.returnMode);
            }
            else
            {
              return('selected');
            }
          }
        }, // returnMode

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

          privateMethods.setReturnMode(object, (value.returnMode!=null)?value.returnMode:options.returnMode);
          privateMethods.setValues(object, (value.values!=null)?value.values:options.values);
          //privateMethods.setValue(object, (value.value!=null)?value.value:options.value, true);

          privateMethods.setEventChange(object, (value.change!=null)?value.change:options.change);

          properties.initialized=true;
        },

      setIsValid : function (object, value)
        {
          var properties=object.data('properties');

          if(properties.isValid!=value && properties.initialized)
          {
            properties.isValid=value;
            if(properties.isValid)
            {
              if(properties.isCB)
              {
                object.parent().removeClass('ui-inputCheckbox ui-error');
              }
              else
              {
                object.removeClass('ui-error');
              }
            }
            else
            {
              if(properties.isCB)
              {
                object.parent().addClass('ui-inputCheckbox ui-error');
              }
              else
              {
                object.addClass('ui-error');
              }
            }
          }
          return(properties.isValid);
        },

      setReturnMode : function (object, value)
        {
          var options=object.data('options'),
              properties=object.data('properties');

          if((!properties.initialized || options.returnMode!=value) && (value=='selected' || value=='notSelected'))
          {
            options.returnMode=value;
          }
          return(options.returnMode);
        },

      setValues : function (object, value)
        {
          var options=object.data('options');

          if(value.forced!=null) options.values.forced=value.forced;
          if(value.checked!=null) options.values.checked=value.checked;
          if(value.unchecked!=null) options.values.unchecked=value.unchecked;

          return(options.values);
        }, //setValue

      setValue : function (object, id, value, apply)
        {
          var options=object.data('options'),
              properties=object.data('properties');

          if(apply)
          {
            if(id==':all' || id==':none' || id==':invert')
            {
              //generic command
              switch(id)
              {
                case ':all':
                  properties.checkboxList.attr('checked', true);
                  break;
                case ':none':
                  properties.checkboxList.attr('checked', false);
                  break;
                case ':invert':
                  properties.checkboxList.each(
                    function ()
                    {
                      $(this).attr('checked', !$(this).attr('checked'));
                    }
                  );
                  break;
              }
            } 
            else if($.isArray(value) && !properties.isCB)
            {
              /* array of values :
               *  ['value1', 'value2', ..., 'valueN']
               * or array of object
               *  [{id:'id1', value:'value1'}, {id:'idN', value:'valueN'}, ..., {id:'idN', value:'valueN'}]
               */
              properties.checkboxList.attr('checked', false);
              
              for(var i=0;i<value.length;i++)
              {
                if(value[i].id!=null && value[i].value!=null)
                {
                  if($('#'+value[i].id).attr('value')==value[i].value) $('#'+value[i].id).attr('checked', true);
                }
                else
                {
                  properties.checkboxList.filter('[value='+value[i]+']').attr('checked', true);
                }
              }
              
            }
            else 
            {
              // a single value
              
              if(options.values.checked==value)
              {
                if(properties.isCB)
                {
                  properties.checkboxList.attr('checked', true);
                }
                else
                {
                  if(id=='')
                  {
                    properties.checkboxList.attr('checked', true); 
                  }
                  else
                  {
                    properties.checkboxList.filter('#'+id).attr('checked', true);
                  }
                }
              }
              else
              {
                if(properties.isCB)
                {
                  properties.checkboxList.attr('checked', false);
                }
                else
                {
                  if(id=='')
                  {
                    properties.checkboxList.attr('checked', false); 
                  }
                  else
                  {
                    properties.checkboxList.filter('#'+id).attr('checked', false);
                  }
                }
              }
            }
          }

          if(options.change) object.trigger('inputCheckboxChange', {id:id, state:value});

          return(true);
        }, //setValue

      setEventChange : function (object, value)
        {
          var options=object.data('options');

          options.change=value;
          object.unbind('inputCheckboxChange');
          if(value) object.bind('inputCheckboxChange', options.change);
          return(options.change);
        }

    };


    $.fn.inputCheckbox = function(method)
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
        $.error( 'Method ' +  method + ' does not exist on jQuery.inputCheckbox' );
      }
    } // $.fn.inputCheckbox

  }
)(jQuery);


