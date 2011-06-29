/**
 * -----------------------------------------------------------------------------
 * file: ui.inputColorPicker.js
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
                      colors:
                        {
                          fg:
                            {
                              color:'#ffffff',
                              opacity:1
                            },
                          bg:
                            {
                              color:'#000000',
                              opacity:1
                            }
                        },
                      alpha:true,
                      texts:
                        {
                          r:'R',
                          g:'G',
                          b:'B',
                          a:'A',
                          color:'#',
                          h:'H',
                          s:'S',
                          v:'V'
                        },
                      mode:2, // 1 (fg) - 2  (fg+bg)
                      selected:'fg',
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
                    refreshing:false
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
                          'class':'ui-inputColorPicker'
                        }
                    ),
                    dotAreaSV:$('<div/>',
                      {
                        'class':'ui-inputColorPicker-dotAreaSV'
                      }
                    ),
                    dotAreaH:$('<div/>',
                      {
                        'class':'ui-inputColorPicker-dotAreaH'
                      }
                    ),
                    inputContainer:$('<table>',
                      {
                        'class':'ui-inputColorPicker-inputContainer'
                      }
                    ),
                    inputCRL:$('<td/>', {'class':'label'} ), // red label
                    inputCRI:$('<td/>', {'class':'input'} ), // red input
                    inputCGL:$('<td/>', {'class':'label'} ),
                    inputCGI:$('<td/>', {'class':'input'} ),
                    inputCBL:$('<td/>', {'class':'label'} ),
                    inputCBI:$('<td/>', {'class':'input'} ),
                    inputCHL:$('<td/>', {'class':'label'} ),
                    inputCHI:$('<td/>', {'class':'input'} ),
                    inputCSL:$('<td/>', {'class':'label'} ),
                    inputCSI:$('<td/>', {'class':'input'} ),
                    inputCVL:$('<td/>', {'class':'label'} ),
                    inputCVI:$('<td/>', {'class':'input'} ),
                    inputCAL:$('<td/>', {'class':'label'} ),
                    inputCAI:$('<td/>', {'class':'input'} ),
                    inputCcolorL:$('<td/>', {'class':'label'} ),
                    inputCcolorI:$('<td/>', {'class':'input'} ),
                    inputCFB:$('<td/>',
                      {
                        colspan:2,
                        rowspan:2
                      }
                    )

                  };

                $this
                  .html('')
                  .append(
                      objects.container
                        .append(objects.dotAreaSV)
                        .append(objects.dotAreaH)
                        .append(objects.inputContainer
                                  .append($('<tr/>').append(objects.inputCRL).append(objects.inputCRI).append(objects.inputCHL).append(objects.inputCHI))
                                  .append($('<tr/>').append(objects.inputCGL).append(objects.inputCGI).append(objects.inputCSL).append(objects.inputCSI))
                                  .append($('<tr/>').append(objects.inputCBL).append(objects.inputCBI).append(objects.inputCVL).append(objects.inputCVI))
                                  .append($('<tr/>').append(objects.inputCAL).append(objects.inputCAI).append(objects.inputCFB))
                                  .append($('<tr/>').append(objects.inputCcolorL).append(objects.inputCcolorI))
                        )
                  );

                objects.dotAreaSV.inputDotArea(
                  {
                    range:
                      {
                        x:[0,100],
                        y:[0,100]
                      },
                    width:132,
                    height:132,
                    change: function (event, value)
                      {
                        privateMethods.computeCurrentColor($this, 'dotAreaSV');
                      }
                  }
                );
                objects.dotAreaH.inputDotArea(
                  {
                    range:
                      {
                        x:false,
                        y:[0,359]
                      },
                    width:20,
                    height:132,
                    change: function (event, value)
                      {
                        privateMethods.computeCurrentColor($this, 'dotAreaH');
                      }
                  }
                );
                objects.inputCRI.inputNum(
                  {
                    minValue:0,
                    maxValue:255,
                    stepValue:1,
                    numDec:0,
                    unitValue:'',
                    btInc:'+',
                    btDec:'-',
                    value:0,
                    showSlider:'auto',
                    change: function (event, value)
                      {
                        privateMethods.computeCurrentColor($this, 'rgbR');
                      }
                  }
                );
                objects.inputCGI.inputNum(
                  {
                    minValue:0,
                    maxValue:255,
                    stepValue:1,
                    numDec:0,
                    unitValue:'',
                    btInc:'+',
                    btDec:'-',
                    value:0,
                    showSlider:'auto',
                    change: function (event, value)
                      {
                        privateMethods.computeCurrentColor($this, 'rgbG');
                      }
                  }
                );
                objects.inputCBI.inputNum(
                  {
                    minValue:0,
                    maxValue:255,
                    stepValue:1,
                    numDec:0,
                    unitValue:'',
                    btInc:'+',
                    btDec:'-',
                    value:0,
                    showSlider:'auto',
                    change: function (event, value)
                      {
                        privateMethods.computeCurrentColor($this, 'rgbB');
                      }
                  }
                );
                objects.inputCAI.inputNum(
                  {
                    minValue:0,
                    maxValue:100,
                    stepValue:1,
                    numDec:0,
                    unitValue:'',
                    btInc:'+',
                    btDec:'-',
                    value:0,
                    showSlider:'auto',
                    change: function (event, value)
                      {
                        privateMethods.computeCurrentColor($this, 'alpha');
                      }
                  }
                );
                objects.inputCHI.inputNum(
                  {
                    minValue:0,
                    maxValue:359,
                    stepValue:1,
                    numDec:0,
                    unitValue:'',
                    btInc:'+',
                    btDec:'-',
                    value:0,
                    showSlider:'auto',
                    change: function (event, value)
                      {
                        privateMethods.computeCurrentColor($this, 'hsvH');
                      }
                  }
                );
                objects.inputCSI.inputNum(
                  {
                    minValue:0,
                    maxValue:100,
                    stepValue:1,
                    numDec:0,
                    unitValue:'',
                    btInc:'+',
                    btDec:'-',
                    value:0,
                    showSlider:'auto',
                    change: function (event, value)
                      {
                        privateMethods.computeCurrentColor($this, 'hsvS');
                      }
                  }
                );
                objects.inputCVI.inputNum(
                  {
                    minValue:0,
                    maxValue:100,
                    stepValue:1,
                    numDec:0,
                    unitValue:'',
                    btInc:'+',
                    btDec:'-',
                    value:0,
                    showSlider:'auto',
                    change: function (event, value)
                      {
                        privateMethods.computeCurrentColor($this, 'hsvV');
                      }
                  }
                );
                objects.inputCcolorI.inputText(
                  {
                    value:'',
                    displayChar:6,
                    maxChar:6,
                    regExp:'/^(?:[a-f0-9]{2}){3}$/i',
                    change: function (event, value)
                      {
                        privateMethods.computeCurrentColor($this, 'color');
                      }
                  }
                );
                objects.inputCFB.inputColorsFB(
                  {
                    width:40,
                    height:40,
                    change: function (event, value)
                      {
                        privateMethods.computeCurrentColor($this, 'fb');
                      }
                  }
                );


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
              objects.dotAreaSV.remove();
              objects.dotAreaH.remove();
              objects.inputCRL.remove();
              objects.inputCRI.remove();
              objects.inputCHL.remove();
              objects.inputCHI.remove();
              objects.inputCGL.remove();
              objects.inputCGI.remove();
              objects.inputCSL.remove();
              objects.inputCSI.remove();
              objects.inputCBL.remove();
              objects.inputCBI.remove();
              objects.inputCVL.remove();
              objects.inputCVI.remove();
              objects.inputCAL.remove();
              objects.inputCAI.remove();
              objects.inputCFB.remove();
              objects.inputCcolorL.remove();
              objects.inputCcolorI.remove();
              objects.inputContainer.remove();
              objects.container.remove();
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

      colors: function (value)
        {
          if(value!=null)
          {
            // set selected value
            return(
              this.each(
                function()
                {
                  privateMethods.setColors($(this), value);
                }
              )
            );
          }
          else
          {
            // return the selected tags
            var options=this.data('options');
            return(options.colors);
          }
        }, // colors

      texts: function (value)
        {
          if(value!=null)
          {
            // set selected value
            return(
              this.each(
                function()
                {
                  privateMethods.setTexts($(this), value, true);
                }
              )
            );
          }
          else
          {
            // return the selected tags
            var options=this.data('options');
            return(options.texts);
          }
        }, // texts

      alpha: function (value)
        {
          if(value!=null)
          {
            // set selected value
            return(
              this.each(
                function()
                {
                  privateMethods.setAlpha($(this), value);
                }
              )
            );
          }
          else
          {
            // return the selected tags
            var options=this.data('options');
            return(options.alpha);
          }
        }, // alpha

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

      mode: function (value)
        {
          if(value!=null)
          {
            // set selected value
            return(
              this.each(
                function()
                {
                  privateMethods.setMode($(this), value);
                }
              )
            );
          }
          else
          {
            // return the selected tags
            var options=this.data('options');
            return(options.mode);
          }
        }, // mode

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

          privateMethods.setMode(object, (value.mode!=null)?value.mode:options.mode);
          privateMethods.setSelected(object, (value.selected!=null)?value.selected:options.selected);
          privateMethods.setColors(object, (value.colors!=null)?value.colors:options.colors);
          privateMethods.setAlpha(object, (value.alpha!=null)?value.alpha:options.alpha);
          privateMethods.setTexts(object, (value.texts!=null)?value.texts:options.texts);

          privateMethods.setEventChange(object, (value.change!=null)?value.change:options.change);

          properties.initialized=true;
        },

      setAlpha : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects');

          if((!properties.initialized || options.alpha!=value) && (value==true || value==false))
          {
            options.alpha=value;

            if(options.alpha)
            {
              objects.inputCAI.css('visibility', 'visible');
              objects.inputCAL.css('visibility', 'visible');
            }
            else
            {
              objects.inputCAI.css('visibility', 'hidden');
              objects.inputCAL.css('visibility', 'hidden');
            }
          }
          return(options.alpha);
        }, //setAlpha

      setMode : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects');

          if((!properties.initialized || options.mode!=value) && (value==1 || value==2))
          {
            options.mode=value;

            objects.inputCFB.inputColorsFB('mode', options.mode);
          }
          return(options.mode);
        }, //setMode


      setSelected : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects');

          if((!properties.initialized || options.selected!=value) && (value=='fg' || value=='bg'))
          {
            options.selected=value;

            objects.inputCFB.inputColorsFB('selected', options.selected);
          }
          return(options.selected);
        }, //setSelected


      setTexts : function (object, value)
        {
          var options=object.data('options'),
              objects=object.data('objects');

          if(value.r!=null)
          {
            options.texts.r=value.r;
            objects.inputCRL.html(options.texts.r);
          }
          if(value.g!=null)
          {
            options.texts.g=value.g;
            objects.inputCGL.html(options.texts.g);
          }
          if(value.b!=null)
          {
            options.texts.b=value.b;
            objects.inputCBL.html(options.texts.b);
          }
          if(value.h!=null)
          {
            options.texts.h=value.h;
            objects.inputCHL.html(options.texts.h);
          }
          if(value.s!=null)
          {
            options.texts.s=value.s;
            objects.inputCSL.html(options.texts.s);
          }
          if(value.v!=null)
          {
            options.texts.v=value.v;
            objects.inputCVL.html(options.texts.v);
          }
          if(value.a!=null)
          {
            options.texts.a=value.a;
            objects.inputCAL.html(options.texts.a);
          }
          if(value.color!=null)
          {
            options.texts.color=value.color;
            objects.inputCcolorL.html(options.texts.color);
          }

          return(options.texts);
        }, //setColors

      /**
       * @param String color : a '#rrggbb' string
       * @param Integer opacity : [0..100] value
       * @param String target : 'fg' or 'bg'
       * @param String from : '' for refreshing all items
       */
      setColor : function (object, color, opacity, target, from)
        {
          var objects=object.data('objects'),
              properties=object.data('properties'),
              options=object.data('options'),
              rgbColor={r:0, g:0, b:0},
              hsvColor={h:0, s:0, v:0},
              svColorHue=0;

          if(properties.refreshing || !(target=='fg' || target=='bg')) return(false);

          properties.refreshing=true;

          rgbColor=privateMethods.strToRGB(color);
          hsvColor=privateMethods.RGBtoHSV(rgbColor);

          if(from=='hsvH') hsvColor.h=objects.inputCHI.inputNum('value');
          if(from=='hsvS') hsvColor.s=objects.inputCSI.inputNum('value');
          if(from=='hsvV') hsvColor.v=objects.inputCVI.inputNum('value');
          if(from=='dotAreaSV')
          {
            sv=objects.dotAreaSV.inputDotArea('values');
            hsvColor.s=100-Math.round(sv.y);
            hsvColor.v=Math.round(sv.x);
          }
          if(from=='dotAreaH') hsvColor.h=360-Math.round(objects.dotAreaH.inputDotArea('values').y);
          svColorHue=hsvColor.h;

          if(from=='' || from=='fb') objects.inputCAI.inputNum('value', opacity);

          if(from!='hsvH' && from!='dotAreaSV' && from!='alpha') objects.dotAreaSV.inputDotArea('values', { x:hsvColor.v, y:100-hsvColor.s } );
          if(from!='dotAreaH' && from!='alpha' && from!='hsvS' && from!='hsvV' && color!='#000000') objects.dotAreaH.inputDotArea('values', { y:360-hsvColor.h } );
          if(from!='rgbR' && from!='rgbG' && from!='rgbB' && from!='alpha')
          {
            objects.inputCRI.inputNum('value', rgbColor.r);
            objects.inputCGI.inputNum('value', rgbColor.g);
            objects.inputCBI.inputNum('value', rgbColor.b);
          }
          if(from!='hsvH' && from!='hsvS' && from!='hsvV' && from!='alpha')
          {
            if(color!='#000000')
            {
              objects.inputCHI.inputNum('value', hsvColor.h);
            }
            else
            {
              svColorHue=objects.inputCHI.inputNum('value');
            }
            objects.inputCSI.inputNum('value', hsvColor.s);
            objects.inputCVI.inputNum('value', hsvColor.v);
          }
          if(from!='color' && from!='alpha') objects.inputCcolorI.inputText('value', color.substr(1));

          if(from!='alpha') objects.dotAreaSV
                              .find('div.ui-inputDotArea')
                              .css('background-color',
                                privateMethods.RGBToStr(privateMethods.HSVtoRGB({h:svColorHue,s:100,v:100}))
                              );

          if(from!='fb') objects.inputCFB.inputColorsFB(target, {color:color, opacity:opacity/100} );

          if(from!='')
          {
            if(target=='fg')
            {
              options.colors.fg.color=color;
              options.colors.fg.opacity=opacity/100;
            }
            else
            {
              options.colors.bg.color=color;
              options.colors.bg.opacity=opacity/100;
            }
          }

          properties.refreshing=false;

          if(options.change) object.trigger('inputColorPickerChange', {target:target, color:{color:color, opacity:opacity/100} } );
        },

      setColors : function (object, value)
        {
          var objects=object.data('objects'),
              options=object.data('options');

          if(value.fg!=null)
          {
            if(value.fg.color!=null) options.colors.fg.color=value.fg.color;
            if(value.fg.opacity!=null) options.colors.fg.opacity=value.fg.opacity;
            if(objects.inputCFB.inputColorsFB('selected')=='fg')
            {
              privateMethods.setColor(object, options.colors.fg.color, Math.round(options.colors.fg.opacity*100), 'fg', '');
            }
            else
            {
              objects.inputCFB.inputColorsFB('fg', options.colors.fg);
            }
          }

          if(value.bg!=null)
          {
            if(value.bg.color!=null) options.colors.bg.color=value.bg.color;
            if(value.bg.opacity!=null) options.colors.bg.opacity=value.bg.opacity;
            if(objects.inputCFB.inputColorsFB('selected')=='bg')
            {
              privateMethods.setColor(object, options.colors.bg.color, Math.round(options.colors.bg.opacity*100), 'bg', '');
            }
            else
            {
              objects.inputCFB.inputColorsFB('bg', options.colors.bg);
            }
          }

          return(options.colors);
        }, //setFG

      setEventChange : function (object, value)
        {
          var options=object.data('options');

          options.change=value;
          object.unbind('inputColorPickerChange');
          if(value) object.bind('inputColorPickerChange', options.change);
          return(options.change);
        },

      computeCurrentColor : function (object, from)
        {
          var options=object.data('options'),
              objects=object.data('objects'),
              properties=object.data('properties'),
              colors={},
              target=objects.inputCFB.inputColorsFB('selected');

          if(properties.refreshing) return(false);

          switch(from)
          {
            case 'dotAreaSV':
            case 'dotAreaH':
              var sv=objects.dotAreaSV.inputDotArea('values');
              colors.color=privateMethods.RGBToStr(
                privateMethods.HSVtoRGB(
                  {
                    h:360-objects.dotAreaH.inputDotArea('values').y,
                    s:100-sv.y,
                    v:sv.x
                  }
                )
              );
              if(target=='fg')
              {
                colors.opacity=Math.round(options.colors.fg.opacity*100);
              }
              else
              {
                colors.opacity=Math.round(options.colors.bg.opacity*100);
              }
              break;
            case 'hsvH':
            case 'hsvS':
            case 'hsvV':
              colors.color=privateMethods.RGBToStr(
                privateMethods.HSVtoRGB(
                  {
                    h:objects.inputCHI.inputNum('value'),
                    s:objects.inputCSI.inputNum('value'),
                    v:objects.inputCVI.inputNum('value')
                  }
                )
              );
              if(target=='fg')
              {
                colors.opacity=Math.round(options.colors.fg.opacity*100);
              }
              else
              {
                colors.opacity=Math.round(options.colors.bg.opacity*100);
              }
              break;
            case 'rgbR':
            case 'rgbG':
            case 'rgbB':
              colors.color=privateMethods.RGBToStr(
                {
                  r:objects.inputCRI.inputNum('value'),
                  g:objects.inputCGI.inputNum('value'),
                  b:objects.inputCBI.inputNum('value')
                }
              );
              if(target=='fg')
              {
                colors.opacity=Math.round(options.colors.fg.opacity*100);
              }
              else
              {
                colors.opacity=Math.round(options.colors.bg.opacity*100);
              }
              break;
            case 'alpha':
              if(target=='fg')
              {
                colors.color=options.colors.fg.color;
              }
              else
              {
                colors.color=options.colors.bg.color;
              }
              colors.opacity=objects.inputCAI.inputNum('value');
              break;
            case 'fb':
              if(target=='fg')
              {
                colors.color=options.colors.fg.color;
                colors.opacity=Math.round(options.colors.fg.opacity*100);
              }
              else
              {
                colors.color=options.colors.bg.color;
                colors.opacity=Math.round(options.colors.bg.opacity*100);
              }
              break;
            case 'color':
              colors.color='#'+objects.inputCcolorI.inputText('value');
              if(target=='fg')
              {
                colors.opacity=Math.round(options.colors.fg.opacity*100);
              }
              else
              {
                colors.opacity=Math.round(options.colors.bg.opacity*100);
              }
              break;
          }

          privateMethods.setColor(object, colors.color, colors.opacity, target, from);
        },

      /**
       * convert a RGB object {r,g,b} to String '#rrggbb'
       * @param Object color : {r,g,b} object
       * @return String
       */
      RGBToStr : function (color)
        {
          var r=color.r.toString(16),
              g=color.g.toString(16),
              b=color.b.toString(16);
          if(r.length<2) r='0'+r;
          if(g.length<2) g='0'+g;
          if(b.length<2) b='0'+b;
          return('#'+r+g+b);
        },

      /**
       * convert a string to RGB object {r,g,b}
       * string can be '#rrggbb' or 'rgb(r,g,b)'
       * @param String color
       * @return Object
       */
      strToRGB : function (color)
        {
          var returned={
                r:0,
                g:0,
                b:0
              },
              re1=/^rgb\((\d){1,3},(\d){1,3},(\d){1,3}\)$/i,
              re2=/^#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})$/i,
              colors=re1.exec(color);

          if(colors!=null)
          {
            returned.r=parseInt(colors[1]);
            returned.g=parseInt(colors[2]);
            returned.b=parseInt(colors[3]);
          }
          else
          {
            colors=re2.exec(color);

            if(colors!=null)
            {
              returned.r=parseInt('0x'+colors[1]);
              returned.g=parseInt('0x'+colors[2]);
              returned.b=parseInt('0x'+colors[3]);
            }
          }
          return(returned);
        },

      /**
       * convert an RGB object {r,g,b} to HSV object {h,s,v}
       * @param Object color : {r,g,b}
       * @return Object
       */
      RGBtoHSV : function (color)
        {
          var returned={
                h:0,
                s:0,
                v:0
          },
          color={
            r:color.r/255,
            g:color.g/255,
            b:color.b/255
          },
          max=Math.max(color.r, color.g, color.b),
          min=Math.min(color.r, color.g, color.b);

          if(max==min)
          {
            returned.h=0;
          }
          else if(max==color.r)
          {
            returned.h=Math.round((60*(color.g-color.b)/(max-min)+360)%360);
          }
          else if(max==color.g)
          {
            returned.h=Math.round((60*(color.b-color.r)/(max-min)+120));
          }
          else if(max==color.b)
          {
            returned.h=Math.round((60*(color.r-color.g)/(max-min)+240));
          }

          returned.s=Math.round(100*(max==0?0:1-min/max));
          returned.v=Math.round(100*max);

          return(returned);
        },

      /**
       * convert an HSV object {h,s,v} to RGB object {r,g,b}
       * @param Object color : {h,s,v}
       * @return Object : {r,g,b}
       */
      HSVtoRGB : function (color)
        {
          var h=Math.floor(Math.abs(color.h/60))%6,
              f=color.h/60-h,
              l=Math.round(2.55*color.v*(1-color.s/100)),
              m=Math.round(2.55*color.v*(1-f*color.s/100)),
              n=Math.round(2.55*color.v*(1-(1-f)*color.s/100)),
              v=Math.round(2.55*color.v);

          switch(h)
          {
            case 0:
              return({r:v, g:n, b:l});
              break;
            case 1:
              return({r:m, g:v, b:l});
              break;
            case 2:
              return({r:l, g:v, b:n});
              break;
            case 3:
              return({r:l, g:m, b:v});
              break;
            case 4:
              return({r:n, g:l, b:v});
              break;
            case 5:
              return({r:v, g:l, b:m});
              break;
          }
          return({r:0, g:0, b:0});
        }
    };


    $.fn.inputColorPicker = function(method)
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
        $.error( 'Method ' +  method + ' does not exist on jQuery.inputColorPicker' );
      }
    } // $.fn.inputColorPicker

  }
)(jQuery);

$.inputDialogColor = function(opt)
{
  var options=
        {
          modal:true,
          mode:2,
          alpha:true,
          colors:
            {
              fg:{ color:'#ffffff', opacity:1 },
              bg:{ color:'#000000', opacity:1 }
            },
          title:'Colors selector',
          texts:null,
          buttons:
            {
              ok:'Ok',
              cancel:'Cancel'
            },
          selected:'fg',
          change:null
        },
      objects=
        {
          dialogBox:$('<div/>'),
          colorPicker:$('<div/>', {'class':'dialogColor'} )
        },

  setOptions = function (opt)
    {
      if(opt.modal==true || opt.modal==false) options.modal=opt.modal;
      if(opt.mode==1 || opt.mode==2) options.mode=opt.mode;
      if(opt.alpha==true || opt.alpha==false) options.alpha=opt.alpha;
      if(opt.colors!=null) options.colors=opt.colors;
      options.texts=opt.texts;
      if(opt.selected=='fg' || opt.selected=='bg') options.selected=opt.selected;
      if(opt.title) options.title=opt.title;
      if(opt.buttons && opt.buttons.ok) options.buttons.ok=opt.buttons.ok;
      if(opt.buttons && opt.buttons.cancel) options.buttons.cancel=opt.buttons.cancel;
      if(opt.change && $.isFunction(opt.change)) options.change=opt.change;
    },

  initDialog = function ()
    {
      var dialogOpt=
          {
            buttons:{},
            width:354,
            closeText:'x',
            dialogClass:'ui-inputDialogColor',
            modal:options.modal,
            resizable:false,
            title:options.title,
            open: null,
            close: function ()
                    {
                      objects.colorPicker.inputColorPicker('destroy').remove();
                      $(this).dialog('destroy');
                    }
          };

      if(options.modal)
      {
        dialogOpt.buttons=
          {
            'ok' : function (event)
                      {
                        if(options.change)
                        {
                          if(options.mode==1)
                          {
                            options.change(event, objects.colorPicker.inputColorPicker('colors').fg );
                          }
                          else
                          {
                            options.change(event, objects.colorPicker.inputColorPicker('colors') );
                          }
                        }
                        $(this).dialog('close');
                      },
            'cancel' : function (event)
                      {
                        $(this).dialog('close');
                      }
          };
        dialogOpt.open= function ()
          {
            objects.colorPicker
              .inputColorPicker(
                {
                  mode:options.mode,
                  alpha:options.alpha,
                  texts:options.texts,
                  colors:options.colors,
                  selected:options.selected
                }
              );
          };
      }
      else
      {
        dialogOpt.open= function ()
          {
            objects.colorPicker
              .inputColorPicker(
                {
                  mode:options.mode,
                  alpha:options.alpha,
                  texts:options.texts,
                  colors:options.colors,
                  change:options.change,
                  selected:options.selected
                }
              );
          };
      }

      objects.dialogBox
        .append(objects.colorPicker)
        .dialog(dialogOpt);
    };

  setOptions(opt);
  initDialog();

} // $.fn.inputDialogColor


