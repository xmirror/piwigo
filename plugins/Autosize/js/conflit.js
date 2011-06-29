//==== cl_conflit  remplace $(... avec jQuery( ====
//===================================================
var detect = navigator.userAgent.toLowerCase();
//   $_SERVER['HTTP_USER_AGENT'] ;
var OS, version;
//==============================================================================
browser = detect_browser();
function detect_browser() {

    mybrowser = {
        browser: "",
        konqueror: false,
        chrome: false,
        safari: false,
        omniWeb: false,
        opera: false,
        firefox: false,
        msie: false,
        netscape: false,
        seamonkey: false
    }
    if (checkIt('konqueror')) { mybrowser.Konqueror = true; lbrowser = "konqueror"; OS = "Linux"; }
    else if (checkIt('seamonkey')) { mybrowser.seamonkey = true; lbrowser = "seamonkey"; }
    else if (checkIt('chrome')) { mybrowser.chrome = true; lbrowser = "chrome"; }
    else if (checkIt('safari')) { mybrowser.safari = true; lbrowser = "safari"; }
    else if (checkIt('omniweb')) { mybrowser.omniweb = true; lbrowser = "omniWeb"; }
    else if (checkIt('opera')) { mybrowser.opera = true; lbrowser = "opera"; }
    else if (checkIt('firefox')) { mybrowser.firefox = true; lbrowser = "firefox"; }

    else if (checkIt('msie')) { mybrowser.msie = true; lbrowser = "msie"; }
    else if (checkIt('compatible')) { mybrowser.NetscapeNavigator = true; lmybrowser.browser = "NetscapeNavigator"; version = detect.charAt(8); }
    else lbrowser = "An unknown browser";
    if (!version) version = detect.charAt(place + thestring.length);
    if (!OS) {
        if (checkIt('linux')) OS = "Linux";
        else if (checkIt('x11')) OS = "Unix";
        else if (checkIt('mac')) OS = "Mac";
        else if (checkIt('win')) OS = "Windows";
        else OS = "an unknown operating system";
    }
    mybrowser.version = version;
    mybrowser.OS = OS;
    mybrowser.browser = lbrowser;
    return mybrowser
};
function checkIt(string) {
    place = detect.indexOf(string) + 1;
    thestring = string;
    return place;
}

/*

*/
konqueror = mybrowser.konqueror || false;
chrome = mybrowser.chrome || false;
safari = mybrowser.safari || false;
omniWeb = mybrowser.omniWeb || false;
opera = mybrowser.opera || false;
firefox = mybrowser.firefox || false;
msie = mybrowser.msie || false;
netscape = mybrowser.netscape || false;
var time_out = 0;
//===================================================
nbpa = 0;
var Fn;
if (typeof MooTools == "undefined" && typeof Prototype == "undefined") {

} else {
  $mootools = $;
}
//====================================================
function conflit(element, nc) {
    //--- cl_conflit
    if (typeof MooTools == "undefined" && typeof Prototype == "undefined") {
        ret_element = jQuery(element);
        return ret_element;
    }
    //====================================================
    if (typeof (element) == "string") {
        if (element.match("^#|.ui|html", "gi")) {
            ret_element = jQuery(element);
            return ret_element;
        }

    }

    var retour = (getStackTrace());
    Fn = retour.fn;
    retour = retour.state;

    var ret_element = "";
    if (retour.match(RegExp("jQuery", "gi"))) {
        ret_element = jQuery(element);
    }
    else if (retour.match(RegExp("rv_gmaps", "gi"))) {
        try {
            ret_element = myjQuery().$Prototype(element);
        }
        catch (e) {

            ret_element = myjQuery().$Prototype(element);

        }
    } else if (retour.match(RegExp("GMaps", "gi"))) {

        ret_element = jQuery(element);
    } else if (retour.match(RegExp("pamooramics", "gi"))) {

        ret_element = jQuery().$Pamoorama(element);

        if (retour.match(RegExp("init_", "gi"))) {

        }


    } else if (retour.match(RegExp("luciano", "gi"))) {


        ret_element = jQuery().$Luciano(element, nc);

    } else if (retour.match(RegExp("jQuery", "gi"))) {
        ret_element = jQuery(element);
    }

    if (ret_element != "")
    return ret_element;

    if (typeof (element) == "string") {
        if (element.match("^#|.ui", "gi")) {
            ret_element = jQuery(element);
            return ret_element;
        }
    } else if (typeof (element) == "function") {
        fn = element.toString();
        if (fn.match("#pwg|open", "gi")) {
            ret_element = jQuery(element);
            return ret_element;
        }
    } else if (element == document) {

    ret_element = jQuery(element);
    return ret_element;


    } else if (element == window) {

        ret_element = jQuery(element);
        return ret_element;


    }
    tp0 = typeof (element);

    ret_element = jQuery(element);
 
    if (typeof DEBUG_autosize == "boolean" && DEBUG_autosize == "true") {
        retour = (getStackTrace());
        alert("element : " + element + " retour : " + retour + "Fonctions:" + Fn);

    }
    return ret_element;
} // conflit(element,nc)
//======================================================
/*
*
*
*/
//======================================================
jQuery(document).ready(
    function (jQuery) {
      jQuery(window).load(function () {
       
        //============================================================
        if (jQuery("#check_auto_w").length > 0) {
          var cl_visible = jQuery("#check_auto_w").get(0).checked;
          if (!cl_visible) {
            jQuery("#table0 :text[name*='_width'] ").hide();
          } else {
            jQuery("#table0 :text[name*='_width']    ").show();
          }
        }
        //==============================================================
        jQuery("input").click(function () {
          if (this.name.match(RegExp("_enabled", "gi"))) {
            sel = "[name*=" + this.name + "]";
            obj = jQuery("tr" + sel);

            if (this.checked)
              obj.css({ backgroundColor: "green", color: "white" });
            else
              obj.css({ backgroundColor: "red", color: "white" });

            return;
          }

          if (this.name != "check_auto_w") return;

          cl_visible = this.checked
          if (!cl_visible) {
            jQuery("#table0 :text[name*='_width'] ").hide();
          } else {
            jQuery("#table0 :text[name*='_width'] ").show();
          }

          return;




        });
        jQuery("#icon_gmaps").bind('click', function () {
          //jQuery("#iGMapsIconContent").dialog("open");
          if (Version_pwg > '2.2.0')
            return;
          jQuery('html,body').stop().scrollTop(0);
          jQuery('html,body').stop().scrollLeft(0);
          jQuery(".ui-widget-overlay").css("opacity", "0.75");

          l1 = (jQuery(window).width() - (jQuery(".gmapsPopup").width())) / 2;
          h1 = (jQuery(window).height() - (jQuery(".gmapsPopup").height())) / 2;

          jQuery(".gmapsPopup").css("left", l1 + "px");
          jQuery(".gmapsPopup").css("top", h1 + "px");
        })
        //=============================================================
        //   jQuery(window).resize();
      });
      //  $ = _$2; ;
    });
//=========================================================
jQuery.fn.extend({
    $: function (el, nc) {
        a = conflit(el, nc);
        return a;
    },
    removeListener: function (B, A) {
  if (this.removeEventListener) { this.removeEventListener(B, A, false); } else {
    this.detachEvent("on" + B, A);
  } return this;
 },
    //---------------- luciano -------------------------------
    $Luciano: function (el, nc) {
        return document.id(el, nc, this.document);
    },
    //=============== PaMOOramics ===========================

    $Pamoorama: function (B) {


        if (!B) {
            if (typeof (B) == "boolean") return null;

        }

        try {
            if (B.htmlElement) {
                return Garbage.collect(B);
            }
        } catch (e) {

        }

        if ([window, document].contains(B)) { return B; }
        var A = $type(B);
        if (A == "string") { B = document.getElementById(B); A = (B) ? "element" : false; }
        if (A != "element") {
            return null;
        }
        if (B.htmlElement) { return Garbage.collect(B); }
        if (["object", "embed"].contains(B.tagName.toLowerCase())) { return B; }
        $extend(B, Element.prototype);
        B.htmlElement = function () { };
        try { return Garbage.collect(B); } catch (e) {
            return;
        }

    },
    //===================================================
    $Prototype: function (element) {
        //======== prototype.js =====================
        if (arguments.length > 1) {
            for (var i = 0, elements = [], length = arguments.length; i < length; i++)
                elements.push($(arguments[i]));
            return elements;
        }
        if (typeof element == "string")
            element = document.getElementById(element);

        return Element.extend(element);

        try {
            new_element = Element.extend(element);
        } catch (e) {
            return new_element;
        }
        return new_element;
    }
    //=========================================================
});    // fin extend



/*
* mootools.js  version: "1.11"
* pamoorama0.3.js
*
* main.js (google maps)
* prototype.js(mootool version: "1.62")
* windows.js
*
*/
function getStackTrace() {
    var callstack = [];
    var isCallstackPopulated = false;
    try {
        i.dont.exist += 0; //doesn't exist- that's the point
    } catch (e) {
        var retcallstack = [];
        var e_message = e.message;
        var e_stack = e.stack;
        var state_ff = "";
        if (e_stack) { //Firefox Opera 3.6
            //=== test fichier source =============
            var lines = e.stack.split("\n");
            for (var i = 0, len = lines.length; i < len; i++) {
                var Src_Match = lines[i];
                if (Src_Match.match(/conflit.js/)) {
                    //
                } else {
                    if (Src_Match.match(/^\s*[A-Za-z0-9\-_\$]+\(/)) {
                        callstack.push(Src_Match); //php?
                    } else {
                        callstack.push(Src_Match);
                    }
                    if (Src_Match.match("GMaps|applyMap|markupMaps|applyMarkers")) {
                        callstack.push("GMaps");
                        isCallstackPopulated = true;
                        break;
                    }
                    if (Src_Match.match("rv_gmaps", "gi")) {
                        callstack.push("rv_gmaps");
                        isCallstackPopulated = true;
                        break;
                    }
                    if (Src_Match.match("paMOOramics")) {
                        isCallstackPopulated = true;
                        callstack.push("paMOOramics");
                        break;
                    }
                    if (Src_Match.match("Luciano", "gi")) {
                        callstack.push("Luciano");
                        isCallstackPopulated = true;
                        break;
                    }
                    if (Src_Match.match("main")) {

                        callstack.push("main");
                        isCallstackPopulated = true;
                        break;
                    }
                    if (Src_Match.match("jQuery", "gi")) {
                        callstack.push("jQuery");
                        isCallstackPopulated = true;

                        break;
                    }
                }
            }
            //callstack.shift();
            state_ff = callstack.join('\n');
            isCallstackPopulated = false;
           }
        if (window.opera && e.message && isCallstackPopulated == false) {
            callstack = [];
            //Opera =================================
            var lines = e.message.split("\n");
            for (var i = 0, len = lines.length; i < len; i++) {
                if (lines[i].match(/^\s*[A-Za-z0-9\-_\$]+\(/)) {
                    var entry = lines[i];
                    //Append next line also since it has the file info
                    if (lines[i + 1]) {
                        entry += " at " + lines[i + 1];
                        i++;
                    }
                    callstack.push(entry);
                    //isCallstackPopulated = true;
                }
            }

        }
        //===== fin Opera======================================
    }
    if (!isCallstackPopulated) { //IE and Safari
        var currentFunction = arguments.callee.caller;
        //next
        callstack = [];
        all_functions = [];
        state = "";
        if (currentFunction == null) {
            return ("");
        }
        states = [];
        var fn1 = currentFunction.toString(); // fonction d'appel local (conflit)

        currentFunction = currentFunction.caller;
        var fn2 = currentFunction.toString(); // fonction d'appel local (conflit)
        currentFunction = currentFunction.caller;
        //$family

        while (currentFunction) {
            var fn = currentFunction.toString();
            all_functions.push(fn);
            var fname = fn.substring(fn.indexOf("function") + 8, fn.indexOf("(")) || " ";
            if (fname != " ") {

                jQuery.noop;
                if (states.length > 0) break;

                // if (fname != " $") callstack.push(fn);
            } if (fname != "") {
                jQuery.noop;
                // if (fname != " $") callstack.push(fn);
            }
            callstack.push(fn);

            if (fn.match(RegExp("jquery|switchmenu|switchTabs|switchInterface|gally|initializeImageMode", "gi"))) {
                states.push('jQuery');
                break;
            }
            if (fn.match(RegExp("dialog..open", "gi"))) {
                states.push('GMaps');
                break;
            }
            if (fn.match(RegExp("GMaps|applyMap|markupMaps|applyMarkers", "gi"))) {
                states.push('GMaps');
                break;
            }
            //======================
            //? bubble
            Expression = new RegExp("\\$", "gi")
            if (fn.match(Expression)) {
                if (fn.match(RegExp("rateForm", "gi"))) {

                    states.push('Luciano');
                    break;
                }
            }
            // "window.fireEvent('domready')"
            Expression = new RegExp("window.fireEvent", "gi")
            if (fn.match(Expression)) {  //luciano
                // "window.fireEvent('domready')"
                Expression = new RegExp("window.fireEvent..domready..", "gi")
                if (fn.match(Expression)) {
                    states.push('Luciano');
                    break;
                }
            }
            if (fn.match(RegExp("(splat|buildFrameWork|photoNext)", "gi"))) {  //luciano

                states.push('Luciano');
                break;
            }
            //======================
            if (fn.match(RegExp("_footer|ie_ready|makeDraggable|droppables", "gi"))) {

                states.push('paMOOramics');
                break;
            }
            //window_1290934905697_top
            if (fn.match(RegExp("window_..|WindowUtilities", "gi"))) {
                states.push('rv_gmaps');
                break;
            }
            if (fn.match(RegExp("that.overlayOpacity", "gi"))) {
                states.push('rv_gmaps');
                break;
            }
            if (fn.match(RegExp("For backward compatibility like win", "gi"))) {
                states.push('rv_gmaps');
                break;
            }
            if (fn.match(RegExp("overlay_modal|HTMLDivElement|constraintPad", "gi"))) {
                states.push('rv_gmaps');
                break;
            }

            if (fn.match(RegExp("__content|__method|observe|responder|stopobserving|fireContentLoadedEvent", "gi"))) {
                states.push('rv_gmaps');
                break;
            }


            if (all_functions.length > 50)
                break;


            currentFunction = currentFunction.caller;
        }

    }
    // state_ff + "|" +
    state = states.join('\n');
    if (state == "") {

      if (typeof DEBUG_autosize == "boolean" && DEBUG_autosize == "true") {
            Fn = all_functions.join('\n');
            try {
                alert(Conflit.name + Conflit.version + "\n Appel non trouvée:" + fn1 + "\n" + Fn + "\n Firefox(retour):" + state_ff);
            } catch (e) {
            }
        }


        state = state_ff;
    }

    Fn = all_functions;
    return { state: state, fn: callstack.join('\n'), fn1: fn2 };
}
//====================================

librairies = new Array;
$_ = $;
function save_framework(page) {
    // theGategoryPage,theRegisterPage
    // thePicturePage
    // si admin.php page = "",theIdentificationPage
    try {
        Conflit = { version: cl_version, name: cl_plugin };
    } catch (e) {

    }
    if (jQuery('#browser').length > 0) {
        jQuery('#browser').val(browser.browser);
  }
    if (typeof (Parent) == "undefined")
        Parent = "#theImage";
  info_image = jQuery(Parent).infos();
  p0 = jQuery(Parent);
  if (p0.length > 0) {
    //======================================================
    if (info_image.position != "static") {
      try {
        if (theme.match("gally", "gi")) {
          if (typeof gallyPP != "undefined") {

          } else if (jQuery.isFunction(inittoolbar)) {
            if (typeof (currentTab) == "undefined") inittoolbar();
            else initializeImageMode("resize");
          };
          //==== compatibilité Gally/LLGBO ===
          jQuery(Parent).css({ position: "static" });
        }
      } catch (e) {
      }

    }
  }

  $_2 = $;
  return
}

(function ($) {
  $(document).ready(function () {
    //=================================================
    if (typeof jQuery.fn.infos != "function") {
      jQuery = myjQuery;
      $ = my$;
    }
  });

})(jQuery);


//--------------------------------------------------------------
$_0 = $;
    function $(element, nc0) {
        if (typeof jQuery.fn.infos != "function")
            if (typeof myjQuery != "undefined")
                jQuery = myjQuery;
        a = conflit(element, nc0);
        return a;
    }
//=== ajout des fonctions jQuery ===
    jQuery.extend($, jQuery);