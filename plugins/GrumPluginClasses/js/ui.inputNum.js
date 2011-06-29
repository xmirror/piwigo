/**
 * -----------------------------------------------------------------------------
 * file: ui.inputNum.js
 * file version: 1.0.0
 * date: 2010-11-02
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
                      numDec:0,
                      minValue:'none',
                      maxValue:'none',
                      stepValue:1,
                      showSlider:'no',
                      disabled:false,
                      textAlign:'right',
                      btInc:'+',
                      btDec:'-',
                      unitValue:'',
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
                    re:/^\d+$/,
                    value:0,
                    factor:1,
                    isSlider:false,
                    isValid:true,
                    mouseIsOver:false,
                    isSliderCurrentlyVisible:false,
                    inputMargins:0
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
                          'class':'ui-inputNum',
                          css:{
                            width:'100%'
                          }
                        }
                    ).bind('click.inputNum',
                        function ()
                        {
                          objects.input.focus();
                        }
                      )
                    .bind('mouseenter',
                        function ()
                        {
                          properties.mouseIsOver=true;
                        }
                      )
                    .bind('mouseleave',
                        function ()
                        {
                          properties.mouseIsOver=false;
                        }
                      ),
                    input:$('<input>',
                      {
                        type:"text",
                        value:''
                      }
                    ).bind('focusout.inputNum',
                        function ()
                        {
                          privateMethods.lostFocus($this);
                        }
                      )
                      .bind('focus.inputNum',
                          function ()
                          {
                            privateMethods.getFocus($this);
                          }
                        )
                      .bind('keydown.inputNum',
                          function (event)
                          {
                            return(privateMethods.keyDown($this, event));
                          }
                        )
                      .bind('keyup.inputNum',
                          function (event)
                          {
                            privateMethods.keyUp($this, event);
                          }
                        ),
                    slider:$('<div/>',
                      {
                        css:{
                          display:'none'
                        }
                      }
                    ),
                    extraContainer:$('<div/>',
                      {
                        'class':'ui-inputNum-extra'
                      }
                    ),
                    unit:$('<div/>',
                        {
                          html: "",
                          'class':'ui-inputNum-unit',
                          css: {
                            display:'none'
                          }
                        }
                    ),
                    btInc:$('<div/>',
                      {
                        'class':'ui-inputNum-btInc',
                        tabindex:0
                      }
                    ).bind('click',
                        function (event)
                        {
                          privateMethods.incValue($this);
                        }
                      )
                     .bind('mousedown', function () { $(this).addClass('ui-inputNum-btInc-active'); } )
                     .bind('mouseup', function () { $(this).removeClass('ui-inputNum-btInc-active'); } ),
                    btDec:$('<div/>',
                      {
                        'class':'ui-inputNum-btDec',
                        tabindex:0
                      }
                    ).bind('click',
                        function (event)
                        {
                          privateMethods.decValue($this);
                        }
                      )
                     .bind('mousedown', function () { $(this).addClass('ui-inputNum-btDec-active'); } )
                     .bind('mouseup', function () { $(this).removeClass('ui-inputNum-btDec-active'); } )
                  };

                $this
                  .html('')
                  .append(objects.container.append(objects.input).append(objects.extraContainer.append(objects.unit).append(objects.btInc).append(objects.btDec)).append(objects.slider));

                properties.inputMargins=objects.input.outerWidth(true)-objects.input.width();


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
              objects.btInc.unbind().remove();
              objects.btDec.unbind().remove();
              objects.container.unbind().remove();
              $this
                .unbind('.inputNum')
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

      showSlider: function (value)
        {
          if(value!=null)
          {
            this.each(function()
              {
                privateMethods.setShowSlider($(this), value);
              }
            );
          }
          else
          {
            var options = this.data('options');

            if(options)
            {
              return(options.showSlider);
            }
            else
            {
              return('');
            }
          }
        }, // showSlider

      minValue: function (value)
        {
          if(value!=null)
          {
            return this.each(function()
              {
                privateMethods.setMinValue($(this), value);
              }
            );
          }
          else
          {
            var options = this.data('options');

            if(options)
            {
              return(options.minValue);
            }
            else
            {
              return('');
            }
          }
        }, // minValue

      maxValue: function (value)
        {
          if(value!=null)
          {
            return this.each(function()
              {
                privateMethods.setMaxValue($(this), value);
              }
            );
          }
          else
          {
            var options = this.data('options');

            if(options)
            {
              return(options.maxValue);
            }
            else
            {
              return('');
            }
          }
        }, // maxValue

      stepValue: function (value)
        {
          if(value!=null)
          {
            return this.each(function()
              {
                privateMethods.setStepValue($(this), value);
              }
            );
          }
          else
          {
            var options = this.data('options');

            if(options)
            {
              return(options.stepValue);
            }
            else
            {
              return('');
            }
          }
        }, // stepValue

      numDec: function (value)
        {
          if(value!=null)
          {
            return this.each(function()
              {
                privateMethods.setNumDec($(this), value);
              }
            );
          }
          else
          {
            var options = this.data('options');

            if(options)
            {
              return(options.numDec);
            }
            else
            {
              return('');
            }
          }
        }, // numDec

      unitValue: function (value)
        {
          if(value!=null)
          {
            return this.each(function()
              {
                privateMethods.setUnitValue($(this), value);
              }
            );
          }
          else
          {
            var options = this.data('options');

            if(options)
            {
              return(options.unitValue);
            }
            else
            {
              return('');
            }
          }
        }, // unitValue

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

      textAlign: function (value)
        {
          if(value!=null)
          {
            return this.each(function()
              {
                privateMethods.setTextAlign($(this), value);
              }
            );
          }
          else
          {
            var options = this.data('options');

            if(options)
            {
              return(options.textAlign);
            }
            else
            {
              return('');
            }
          }
        }, // textAlign

      btInc: function (value)
        {
          if(value!=null)
          {
            return this.each(function()
              {
                privateMethods.setBtInc($(this), value);
              }
            );
          }
          else
          {
            var options = this.data('options');

            if(options)
            {
              return(options.btInc);
            }
            else
            {
              return('');
            }
          }
        }, // btInc

      btDec: function (value)
        {
          if(value!=null)
          {
            return this.each(function()
              {
                privateMethods.setBtDec($(this), value);
              }
            );
          }
          else
          {
            var options = this.data('options');

            if(options)
            {
              return(options.btDec);
            }
            else
            {
              return('');
            }
          }
        }, // btDec


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
      /**
       * return true is given value is a valid numeric value, according to the
       * rules defined by the object
       * @param Object object
       * @param value
       * @return Bool
       */
      isValid : function (object, value)
        {
          var properties=object.data('properties');

          return(properties.re.exec(value))
        },

      /**
       * define the regular expression used to check validity of a numeric value
       * @param Object object
       */
      setRE : function (object)
        {
          var properties=object.data('properties'),
              options=object.data('options'),
              tmpRe="\\d+";

          if(options.numDec>0)
          {
            tmpRe+="(\\.\\d{0,"+options.numDec+"})?";
          }
          tmpRe+="$";

          if(options.minValue=='none' || options.minValue!='none' && options.minValue<0 )
          {
            if(options.maxValue!='none' && options.maxValue<0)
            {
              tmpRe="\\-"+tmpRe;
            }
            else
            {
              tmpRe="(\\-)?"+tmpRe;
            }
          }
          tmpRe="^"+tmpRe;
          properties.re = new RegExp(tmpRe);
        },

      setOptions : function (object, value)
        {
          var properties=object.data('properties'),
              options=object.data('options');

          if(!$.isPlainObject(value)) return(false);

          properties.initialized=false;

          privateMethods.setNumDec(object, (value.numDec!=null)?value.numDec:options.numDec);
          privateMethods.setStepValue(object, (value.stepValue!=null)?value.stepValue:options.stepValue);
          privateMethods.setMinValue(object, (value.minValue!=null)?value.minValue:options.minValue);
          privateMethods.setMaxValue(object, (value.maxValue!=null)?value.maxValue:options.maxValue);
          privateMethods.setValue(object, (value.value!=null)?value.value:options.value, true);

          privateMethods.setUnitValue(object, (value.unitValue!=null)?value.unitValue:options.unitValue);
          privateMethods.setShowSlider(object, (value.showSlider!=null)?value.showSlider:options.showSlider);
          privateMethods.setDisabled(object, (value.disabled!=null)?value.disabled:options.disabled);
          privateMethods.setBtInc(object, (value.btInc!=null)?value.btInc:options.btInc);
          privateMethods.setBtDec(object, (value.btDec!=null)?value.btDec:options.btDec);
          privateMethods.setTextAlign(object, (value.textAlign!=null)?value.textAlign:options.textAlign);

          privateMethods.setEventChange(object, (value.change!=null)?value.change:options.change);

          privateMethods.calculateInputWidth(object);

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

      setNumDec : function (object, value)
        {
          var options=object.data('options'),
              properties=object.data('properties');

          if((!properties.initialized || options.numDec!=value) && value>=0 && value<=15)
          {
            options.numDec=value;
            privateMethods.setRE(object);
            properties.factor=Math.pow(10,options.numDec);
          }
          return(options.numDec);
        },

      setStepValue : function (object, value)
        {
          var options=object.data('options'),
              properties=object.data('properties');

          if((!properties.initialized || options.stepValue!=value) && value>0 && privateMethods.isValid(object, value))
          {
            options.stepValue=value;
          }
          return(options.stepValue);
        },

      setShowSlider : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              properties=object.data('properties');

          if((!properties.initialized || options.showSlider!=value) && (value=='no' || value=='yes' || value=='auto'))
          {
            options.showSlider=value;
            privateMethods.manageSlider(object);
          }
          return(options.showSlider);
        },

      setMinValue : function (object, value)
        {
          var options=object.data('options'),
              properties=object.data('properties');

          if((!properties.initialized || options.minValue!=value) && (value=='none' || privateMethods.isValid(object, value)))
          {
            options.minValue=value;
            if(options.minValue>options.maxValue) options.maxValue=options.minValue;
            privateMethods.setRE(object);
            privateMethods.manageSlider(object);
          }
          return(options.minValue);
        },

      setMaxValue : function (object, value)
        {
          var options=object.data('options'),
              properties=object.data('properties');

          if(
              (!properties.initialized || options.maxValue!=value) &&
              (value=='none' || privateMethods.isValid(object, value) &&
                (options.minValue<=value && options.minValue!='none' || options.minValue=='none')
              )
            )
          {
            options.maxValue=value;
            privateMethods.setRE(object);
            privateMethods.manageSlider(object);
          }
          return(options.maxValue);
        },

      setUnitValue : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              properties=object.data('properties');

          if(!properties.initialized || options.unitValue!=value)
          {
            options.unitValue=value;
            objects.unit.html(options.unitValue).css('display', ($.trim(value)=='')?'none':'');

            privateMethods.calculateInputWidth(object);
          }
          return(options.unitValue);
        },

      setBtInc : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              properties=object.data('properties');

          if(!properties.initialized || options.btInc!=value)
          {
            options.btInc=value;
            objects.btInc.html(options.btInc);
          }
          return(options.btInc);
        },

      setBtDec : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              properties=object.data('properties');

          if(!properties.initialized || options.btDec!=value)
          {
            options.btDec=value;
            objects.btDec.html(options.btDec);
          }
          return(options.btDec);
        },

      setDisabled : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              properties=object.data('properties');

          if((!properties.initialized || options.disabled!=value) && (value==true || value==false))
          {
            options.disabled=value;
            if(options.disabled)
            {
              objects.btDec.attr('disabled', true);
              objects.btInc.attr('disabled', true);
              objects.input.attr('disabled', true);
            }
            else
            {
              objects.input.attr('disabled', false);
              privateMethods.setButtonsState(object);
            }
          }
          return(options.disabled);
        },

      setTextAlign : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              properties=object.data('properties');

          if((!properties.initialized || options.textAlign!=value) && (value=='left' || value=='right'))
          {
            options.textAlign=value;
            objects.input.css('text-align', options.textAlign);
          }
          return(options.textAlign);
        },

      setButtonsState : function (object)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              properties=object.data('properties');

          if(options.minValue!='none' && properties.value - options.stepValue < options.minValue)
          {
            objects.btDec.attr('disabled', true);
          }
          else
          {
            objects.btDec.attr('disabled', false);
          }

          if(options.maxValue!='none' && properties.value + options.stepValue > options.maxValue)
          {
            objects.btInc.attr('disabled', true);
          }
          else
          {
            objects.btInc.attr('disabled', false);
          }
        },

      setValue : function (object, value, apply)
        {
          var options=object.data('options'),
              properties=object.data('properties'),
              objects=object.data('objects');

          if(!privateMethods.isValid(object, value) ||
              (!apply &&
                (options.minValue!='none' && value < options.minValue ||
                 options.maxValue!='none' && value > options.maxValue)
              )
            )
          {
            return(privateMethods.setIsValid(object, false));
          }
          else if(apply)
          {
            if(options.minValue!='none' && value < options.minValue) value=options.minValue;
            if(options.maxValue!='none' && value > options.maxValue) value=options.maxValue;
          }

          privateMethods.setIsValid(object, true);

          properties.value=value;
          privateMethods.setButtonsState(object);

          if(apply) objects.input.val(properties.value.toFixed(options.numDec));

          if(properties.isSlider && properties.isSliderCurrentlyVisible) objects.slider.slider('value', properties.value);

          if(options.change) object.trigger('inputNumChange', properties.value);

          return(true);
        }, //setValue

      getFocus : function (object)
        {
          var objects=object.data('objects'),
              options=object.data('options'),
              properties=object.data('properties');

          if(properties.isSlider && options.showSlider=='auto')
          {
            objects.slider
              .css('display', 'block')
              .css('width', (objects.container.width()-objects.slider.children('.ui-slider-handle').outerWidth(true))+'px')
              .slider('value', properties.value);
            properties.isSliderCurrentlyVisible=true;
          }
        },

      lostFocus : function (object)
        {
          var objects=object.data('objects'),
              options=object.data('options'),
              properties=object.data('properties');

          if(properties.mouseIsOver)
          {
            objects.input.focus();
          }
          else if(properties.isSlider && options.showSlider=='auto')
          {
            objects.slider.css('display', 'none');
            properties.isSliderCurrentlyVisible=false;
          }
        },

      setEventChange : function (object, value)
        {
          var options=object.data('options');

          options.change=value;
          object.unbind('inputNumChange');
          if(value) object.bind('inputNumChange', options.change);
          return(options.change);
        },

      keyUp : function (object, event)
        {
          var properties=object.data('properties'),
              objects=object.data('objects');

          if(!((event.keyCode>=48 && event.keyCode<=57) || //DOM_VK_0 - DOM_VK_9
               (event.keyCode>=96 && event.keyCode<=105) || //DOM_VK_NUMPAD0 - DOM_VK_NUMPAD9
                event.keyCode==190 || //DOT
                event.keyCode==109 || //DOM_VK_SUBTRACT
                event.keyCode==110 || //DOM_VK_DECIMAL
                event.keyCode==8 || //DOM_VK_BACK_SPACE
                event.keyCode==9 || //DOM_VK_TAB
                event.keyCode==12 || //DOM_VK_CLEAR
                event.keyCode==46 //DOM_VK_DELETE
              )
            ) return(false);

          privateMethods.setValue(object, parseFloat(objects.input.val()), false);
        },

      keyDown : function (object, event)
        {
          var properties=object.data('properties'),
              objects=object.data('objects');

          if(!((event.keyCode>=48 && event.keyCode<=57) || //DOM_VK_0 - DOM_VK_9
               (event.keyCode>=96 && event.keyCode<=105) || //DOM_VK_NUMPAD0 - DOM_VK_NUMPAD9
                event.keyCode==190 || //DOT
                event.keyCode==109 || //DOM_VK_SUBTRACT
                event.keyCode==110 || //DOM_VK_DECIMAL
                event.keyCode==8 || //DOM_VK_BACK_SPACE
                event.keyCode==9 || //DOM_VK_TAB
                event.keyCode==12 || //DOM_VK_CLEAR
                event.keyCode==16 || //DOM_VK_SHIFT
                event.keyCode==17 || //DOM_VK_CONTROL
                event.keyCode==18 || //DOM_VK_ALT
                event.keyCode==33 || //DOM_VK_PAGE_UP
                event.keyCode==34 || //DOM_VK_PAGE_DOWN
                event.keyCode==35 || //DOM_VK_END
                event.keyCode==36 || //DOM_VK_HOME
                event.keyCode==37 || //DOM_VK_LEFT
                event.keyCode==38 || //DOM_VK_UP
                event.keyCode==39 || //DOM_VK_RIGHT
                event.keyCode==40 || //DOM_VK_DOWN
                event.keyCode==45 || //DOM_VK_INSERT
                event.keyCode==46 || //DOM_VK_DELETE
                event.keyCode==93  //DOM_VK_CONTEXT_MENU
              )
            ) return(false);
          return(true);
        },

      incValue : function (object)
        {
          var options=object.data('options'),
              properties=object.data('properties');

          nextValue=Math.round(properties.value*properties.factor+options.stepValue*properties.factor)/properties.factor;

          if(options.maxValue=='none' || nextValue <= options.maxValue)
          {
            privateMethods.setValue(object, nextValue, true);
          }
        },

      decValue : function (object)
        {
          var options=object.data('options'),
              properties=object.data('properties');

          nextValue=Math.round(properties.value*properties.factor-options.stepValue*properties.factor)/properties.factor;

          if(options.minValue=='none' || nextValue >= options.minValue)
          {
            privateMethods.setValue(object, nextValue, true);
          }
        },

      manageSlider : function (object)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              properties=object.data('properties');

          if(!properties.isSlider && options.minValue!='none' && options.maxValue!='none' && (options.showSlider=='yes' || options.showSlider=='auto'))
          {
            properties.isSlider=true;
            objects.slider.slider(
              {
                max:options.maxValue,
                min:options.minValue,
                step:options.stepValue,
                value:properties.value,
                slide:function (event, ui)
                  {
                    privateMethods.setValue(object, ui.value, true);
                  }
              }
            );
            objects.slider.children('.ui-slider-handle').bind('focusout', function () { privateMethods.lostFocus(object); } );
            if(options.showSlider=='yes')
            {
              objects.slider
                .css('display', 'block')
                .css('width', (objects.container.width()-objects.slider.children('.ui-slider-handle').outerWidth(true))+'px');
              properties.isSliderCurrentlyVisible=true;
            }
          }
          else if(properties.isSlider && (options.minValue=='none' || options.maxValue=='none' || options.showSlider=='no'))
          {
            properties.isSlider=false;
            properties.isSliderCurrentlyVisible=false;
            objects.slider.slider('destroy');
          }
        },

      calculateInputWidth : function (object)
        {
          var objects=object.data('objects'),
              properties=object.data('properties');          
          
          objects.input.css('width', (objects.container.width()-objects.extraContainer.outerWidth()-properties.inputMargins)+'px');
        }

    };


    $.fn.inputNum = function(method)
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
        $.error( 'Method ' +  method + ' does not exist on jQuery.inputNum' );
      }
    } // $.fn.inputNum

  }
)(jQuery);


