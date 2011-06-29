jQuery(document).ready(
function (jQuery) {
  stb = jQuery('#scrolltobottom');
  stt = jQuery('#scrolltotop');
  stt.css('opacity', 1 )
  //===================================================================	  		
  jQuery(window).resize(function (event, ui) {
    if (typeof (event) == 'undefined') return;
    scrollBottom = jQuery(window).scrollTop();
  });
  //===================================================================	    		
  jQuery(window).scroll(function () {
    if (scrollBottom < 500) {
      if (stt.css('opacity') > 0) {
        stt.stop().fadeTo(1000, 0);
        stt.css("display", "none");
      } else {
        if (stt.css('opacity') == 0) {
          stt.stop().fadeTo(1000, 1);
          stt.css("display", "block");
        }
      }
    }

    if (scrollBottom < 500) {
      if (stb.css('opacity') == 0) {
        stb.stop().fadeTo(1000, 1);
        stb.css("display", "block");

      }
    } else {
      if (stb.css('opacity') > 0) {
        stb.stop().fadeTo(1000, 0);
        stb.css("display", "none");

      }
    }

  });

  jQuery('#scrolltobottom a').click(function () {
    pos = jQuery('body').outerHeight();
    jQuery('html, body').animate({
      scrollTop: pos + 'px'
    }, 1000, function () {
      scrollBottom = jQuery(window).scrollTop();
      if (stb.css('opacity') > 0) {
        stb.stop().fadeTo(1000, 0);
        stb.css("display", "none");
        stt.stop().fadeTo(1000, 1);
        stt.css("display", "block");
      }
    });
  });

  jQuery('#scrolltotop a').click(function () {

    pos = 0;
    jQuery('html, body').animate({
      scrollTop: pos + 'px'
    }, 1000, function () {
      st = false;
     // scrollBottom = jQuery(window).scrollTop();
      if (stb.css('opacity') > 0) {
        stt.stop().fadeTo(1000, 0);
        stt.css("display", "none");
        stb.stop().fadeTo(1000, 1);
        stb.css("display", "block");
      }
      scrollBottom = jQuery(window).scrollTop();
    });
  });


  function gotoPos(pos) {
    jQuery('html, body').animate({ scrollTop: jQuery('body').outerHeight() + 'px' },
     600, function () {


     });


    return false;
  }
  //===================================================================	  
  jQuery(window).resize();
  jQuery(window).scroll();


}); 
//=========================================================

