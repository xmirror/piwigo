/* Copyright (c) 2007 Paul Bakaus (paul.bakaus@googlemail.com) and Brandon Aaron (brandon.aaron@gmail.com || http://brandonaaron.net)
* Dual licensed under the MIT (http://www.opensource.org/licenses/mit-license.php)
* and GPL (http://www.opensource.org/licenses/gpl-license.php) licenses.
*
* $LastChangedDate: 2007-12-20 08:43:48 -0600 (Thu, 20 Dec 2007) $
* $Rev: 4257 $
*
* $LastChangedDate: 2010-10-23 08:43:48 -0600 (Thu, 20 Dec 2007) $
* By cljosse
* Version: 1.2
*
* Requires: jQuery 1.2+
* 
*/
(function (jQuery) {
  jQuery.dimensions = { version: '1.3' };
  /*
  * Interception Height, Width
  */
  jQuery.each(['Height', 'Width'],
        function (i, name) {
          jQuery.fn['inner' + name] = function () {
            if (!this[0]) return;
            var torl = name == 'Height' ? 'Top' : 'Left',
                    borr = name == 'Height' ? 'Bottom' : 'Right';
            return this.is(':visible') ? this[0]['client' + name] : num(this, name.toLowerCase()) + num(this, 'padding' + torl) + num(this, 'padding' + borr);
          };

          jQuery.fn['outer' + name] = function (options) {
            if (!this[0]) return;
            var torl = name == 'Height' ? 'Top' : 'Left',
                    borr = name == 'Height' ? 'Bottom' : 'Right';
            options = options || false;
            options = jQuery.extend({ margin: options });

            var val = this.is(':visible') ? this[0]['offset' + name] :
                    num(this,
                    name.toLowerCase()) +
                    num(this, 'border' + torl + 'Width') +
                    num(this, 'border' + borr + 'Width') +
                    num(this, 'padding' + torl) +
                    num(this, 'padding' + borr)

                    ;
            return val + (options.margin ? (num(this, 'margin' + torl) + num(this, 'margin' + borr)) : 0);
          };
        });
  /*
  *
  */
  jQuery.each(['Left', 'Top'],
    function (i, name) {
      jQuery.fn['scroll' + name] = function (val) {
        if (!this[0]) return;
        return val != undefined ? this.each(function () {
          this == window || this == document ? window.scrollTo(name == 'Left' ? val : $(window)['scrollLeft'](),
        name == 'Top' ? val : $(window)['scrollTop']()) : this['scroll' + name] = val;
        }) : this[0] == window || this[0] == document ? self[(name == 'Left' ? 'pageXOffset' : 'pageYOffset')] || jQuery.boxModel && document.documentElement['scroll' + name] || document.body['scroll' + name] : this[0]['scroll' + name];
      };
      //================================================
      jQuery.fn['absolute' + name] = function (val) {
        if (!this[0]) return;
        a = jQuery(this[0]);
        m = 0;
        while (a.length > 0) {
          val = jQuery(a).infos();
          if (val.position != "absolute") {
            m += name == 'Left' ? val.left : val.top;
            m += name == 'Left' ? val.margin.left : val.margin.top;
            m += name == 'Left' ? val.margin.right : val.margin.bottom;
            m += name == 'Left' ? val.borderwidth.left : val.borderwidth.top;
            //   m += name == 'Left' ? val.borderwidth.right : val.borderwidth.bottom;
            //   m += name == 'Left' ? val.padding.left : val.padding.top;
            //   m += name == 'Left' ? val.padding.right : val.padding.bottom;
            a = jQuery(a).offsetParent();
          } else
            break;

        }
        //306


        return m;


      };


    });
  //=====================================================
  jQuery.fn.extend({

    infos: function () {
      var width = 0, height = 0;
      var elem = jQuery(this).get(0);


      var Left = 0, Top = 0, offset, parentOffset, offsetParent, results;
      var borderwidth = { width: "0 0 0 0",
        top: 0,
        left: 0,
        right: 0,
        bottom: 0
      }
      var padding = { padding: "0 0 0 0",
        top: 0,
        left: 0,
        right: 0,
        bottom: 0
      };
      var margin = { margin: "0 0 0 0",
        top: 0,
        left: 0,
        right: 0,
        bottom: 0
      };
      //=====================================================================
      myposition = "";
      results = {
        position: "",
        top: 0,
        left: 0,
        width: 0,
        height: 0,
        right: 0,
        bottom: 0,
        borderwidth: borderwidth,
        padding: padding,
        margin: margin, id: "", nodeName: ""
      };
      ;
      if (elem) {
        id = ""; nodeName = "";
        if (elem.id) id = elem.id;
        if (elem.nodeName) nodeName = elem.nodeName;


        if (elem == window) {

          myposition = "";
          width = jQuery(elem).width();
          height = jQuery(elem).height();
        } else {

          Css = jQuery(elem).getStyles(elem);
          myposition = Css.position.toString() || "";


          width = jQuery(elem).outerWidth();
          height = jQuery(elem).outerHeight();


          borderwidth.left = jQuery(elem).Get_Val_int(Css.borderLeftWidth, "", "", 'borderLeftWidth');
          borderwidth.right = jQuery(elem).Get_Val_int(Css.borderRightWidth, "", "", 'borderRightWidth');
          borderwidth.top = jQuery(elem).Get_Val_int(Css.borderTopWidth, "", "", 'borderTopWidth');
          borderwidth.bottom = jQuery(elem).Get_Val_int(Css.borderBottomWidth, "", "", 'borderBottomWidth');
          try {
            borderwidth.width = Css.borderWidth;
          } catch (e) {
            borderwidth.width = '"' + borderwidth.left + ' ' + borderwidth.top + ' ' + borderwidth.right + ' ' + borderwidth.bottom + '"';
          }



          margin.left = jQuery(elem).Get_Val_int(Css.marginLeft, "", "", 'marginLeft');
          margin.right = jQuery(elem).Get_Val_int(Css.marginRight, "", "", 'marginRight');
          margin.top = jQuery(elem).Get_Val_int(Css.marginTop, "", "", 'marginTop');
          margin.bottom = jQuery(elem).Get_Val_int(Css.marginBottom, "", "", 'marginBottom');


          try {
            margin.margin = Css.margin;
          } catch (e) {
            margin.margin = '"' + margin.left + ' ' + margin.top + ' ' + margin.right + ' ' + margin.bottom + '"';
          }


          padding.left = jQuery(elem).Get_Val_int(Css.paddingLeft, "", "", 'paddingLeft');
          padding.right = jQuery(elem).Get_Val_int(Css.paddingRight, "", "", 'paddingRight');
          padding.top = jQuery(elem).Get_Val_int(Css.paddingTop, "", "", 'paddingTop');
          padding.bottom = jQuery(elem).Get_Val_int(Css.paddingBottom, "", "", 'paddingBottom');

          try {
            padding.padding = Css.padding;
          } catch (e) {
            padding.padding = '"' + padding.left + ' ' + padding.top + ' ' + padding.right + ' ' + padding.bottom + '"';
          }
        }
        if (elem == window) {
          Cl_Position = { top: 0, left: 0 };
        } else {
          Cl_Position = jQuery(elem).d_position();
        }
        Left = Cl_Position.left;
        Top = Cl_Position.top;

        results = {
          position: myposition,
          top: Top,
          left: Left,
          width: width,
          height: height,
          right: Left + width,
          bottom: Top + height,
          borderwidth: borderwidth,
          margin: margin,
          padding: padding,
          id: id,
          nodeName: nodeName
        };

        return results
      } return results;
    },
    /*
    * Cl_Position de l'object elem
    */
    d_position: function () {
      var left = 0, top = 0, elem = this[0], offset, parentOffset, offsetParent, results;
      l1 = jQuery(elem).css("left");
      if (elem) {
        offsetParent = this.offsetParent();
        offset = this.offset();

        if (offsetParent) {
          if (elem == window) {
            parentOffset = { top: 0, left: 0 };
          } else if (typeof (offsetParent.offset) != "undefined")
            parentOffset = offsetParent.offset();
          else
            parentOffset = { top: 0, left: 0 };

          if (!offset)
            offset = { top: 0, left: 0 };

          offset.top -= num(elem, 'marginTop');
          offset.left -= num(elem, 'marginLeft');

          if (offsetParent.length > 0) {
            parentOffset.top += num(offsetParent, 'borderTopWidth');
            parentOffset.left += num(offsetParent, 'borderLeftWidth');
          } else {
            parentOffset = { top: 0, left: 0 };

          }
        } else {
          parentOffset = { top: 0, left: 0 };
        }

        results = {
          top: Math.ceil(offset.top - parentOffset.top), left: Math.ceil(offset.left - parentOffset.left)
        };
      } return results;
    },
    /*
    * offsetParent
    */
    offsetParent: function () {
      var offsetParent = this[0].offsetParent;
      while (offsetParent && (!/^body|html$/i.test(offsetParent.tagName) && jQuery.css(offsetParent, 'position') == 'static'))
        offsetParent = offsetParent.offsetParent;
      return jQuery(offsetParent);
    },
    // getStyles(Obj) Récupérer la valeur CSS 
    getStyles: function (elt) {
      var element = elt;
      if (window.getComputedStyle) // Mozilla Firefox & cie
      {
        var propriete = window.getComputedStyle(element, null);
      }
      else if (element.currentStyle) // Microsoft Internet Explorer
      {

        var propriete = element.currentStyle;
      }
      return propriete;
    },
    /*
    * Get_val_int
    * params: element,valeur maxi
    * return: valeur entiere
    */

    Get_Val_int: function (myObj, Maxi_val, Mini_val, prop) {
      var val = 0;
      Maxi_val = parseInt(Maxi_val || "0");

      /*
      - numérique suivie de px ou % ou pt ou em, 
      - thin, bordure mince, 
      - medium, bordure moyenne (valeur par défaut), 
      - thick, bordure épaisse, 
      - inherit, hérite de son parent (css2).
      */

      if (!myObj) {
        return Maxi_val;
      }

      if (typeof (myObj) == "string") {
        switch (myObj) {
          case 'thin':
            return 1;
            break;
          case 'medium':
            return 2;
            break;
          case 'thick':
            return 4;
            break;
          case 'inherit':
            break;
          case 'none':
            return Maxi_val;
            break;
          default:
            break;
        }
        el = this.get(0);
        var reg1 = new RegExp("auto", "g")
        if (myObj.match(reg1)) {
          return Maxi_val;
        }
        if (prop)
          myObj = num(el, prop);
        else {
          reg1 = new RegExp("px", "g")
          if (myObj.match(reg1)) {

            myObj = parseInt(myObj);

          } else {
            reg1 = new RegExp("%", "g")
            if (myObj.match(reg1)) {
              val = Math.ceil(myObj * Maxi_val / 100);
              return val;
            }

          }

        }

        if (Mini_val)
          if (myObj < Mini_val) return Maxi_val;


        val = parseInt(myObj);

      } else {
        val = parseInt(myObj);
      }
      if (typeof (val) == "NaN") return Maxi_val;
      return val;
    }
  });
  /*
  *
  */
  function num(el, prop) {
    return parseInt(jQuery.curCSS(el.jquery ? el[0] : el, prop, true)) || 0;
  };

  myjQuery = jQuery;
  my$ = $;

})(jQuery);