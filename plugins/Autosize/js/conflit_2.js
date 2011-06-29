
  //=== ajout des fonctions jQuery ===
if (typeof MooTools == "undefined" && typeof Prototype == "undefined") {
    $mootools = window.$;
  } else {
    if (typeof jQuery != 'undefined') {
      if (typeof $mootools != 'undefined') {
        if (typeof (gmaps) != "undefined") {
        }
        if (jQuery.fn.$) $ = jQuery.fn.$;
        jQuery.extend($, $mootools);
        jQuery.extend($, jQuery.fn);
      } else {
        if (jQuery.fn.$) $ = jQuery.fn.$;
        jQuery.extend($, jQuery);
      }
    }
  }