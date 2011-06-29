Parent = "#theImage";
function Toggle_bp() {
    cl_visible = !cl_visible;
    if (cl_visible) src = src1;
    else src = src2;
    if (cl_visible) src_info = src3;
    else src_info = src4;

    jQuery('#bp_cla').attr('alt', src_info);
    jQuery('#bp_cla').attr('title', src_info);

    jQuery('#bp_img_cla').get(0).src = src;
    jQuery('#bp_img_cla').attr('alt', src_info);
    jQuery('#bp_img_cla').attr('title', src_info);
    jQuery('#bp_cla').attr('Stitle', src_info);
    jQuery('#bp_cla').attr('Stip', " ");
    jQuery().newResize();

}
nu_img = 0;
tempo=0;

function Wait_pamoorama() {
    if (jQuery("#pamoorama").length) {
        mypanorama = window.myPamoorama;
        if (!mypanorama) {
          tempo = tempo + 1;
          if (tempo > 10) 
          return true;

            setTimeout("Wait_pamoorama()", 500);
            return false;
        }
        if (mypanorama.skipInit == false) {
            setTimeout("Wait_pamoorama()", 500);
            return false;
        }
        info_pamoorama = jQuery("#pamoorama").infos();
        new_width = info_pamoorama.width - (info_pamoorama.borderwidth.left + info_pamoorama.borderwidth.right);
        if (Math.abs(new_width - myPamoorama.options.width) > 10) {
            setTimeout("Wait_pamoorama()", 500);
            return false;
        }

        nopano = true;
        old_window = { width: 0, height: 0 };
        jQuery('#pamoorama').trigger('ON');

    }
}


//==========================================================================
function Wait_Affichage() {
    fade_in = parseInt(fade_in);
    if (!jQuery().newResize()) {
        setTimeout("Wait_Affichage()", 500);
        return
    }
    nu_img++;

    if (fade_in == 0) {
        jQuery(Parent).css({ opacity: "1" });
    } else {
        jQuery(Parent).animate({ opacity: "1" },
                                         fade_in, "swing",
                                         function (i) {
                                             jQuery(Parent).css({ opacity: "1" });
                                             if (DEBUG_autosize == "true") {
                                                 bp1 = jQuery('.debug').get(nu_img);
                                                 if (!bp1) nu_img = 0;
                                                 bp1 = jQuery('.debug').get(nu_img);
                                                 jQuery(bp1).trigger('ON');
                                             }
                                         }
                                       );

    }
    //   if (nu_img > 1) return;



    img_h = jQuery(theImg).height();
    img_w = jQuery(theImg).width();

    jQuery("#src_img_h").val(img_h);
    jQuery("#src_img_w").val(img_w);
    jQuery("#ret_autosize").val(src_img);
    if (typeof Window_Affichage =="undefined" ) {
        Window_Affichage = { height: Zone_Affichage.height,
            width: Zone_Affichage.width
        };
    }
    jQuery("#window_height").val(Window_Affichage.height);
    jQuery("#window_width").val(Window_Affichage.width);
    jQuery("#ret_autosize").trigger('ON', { width: img_w,
        height: img_h,
        theImage: theImg,
        src_img: src_img,
        window_height: Window_Affichage.height,
        window_width: Window_Affichage.width
    });


}

//=====================================================================

List_autosize = new Array();
function Autosize_resize(Obj) {
    if (typeof cl_visible != "undefined") return;


    conf = jQuery(Obj).get(0).conf;
    Obj = jQuery(Obj).get(0).obj;
    myWindow = jQuery("#" + conf.parent).infos();

    if (myWindow.width == 0) myWindow = jQuery(window).infos();
    marge_basse = 0;
    if (conf.MargeBasse)
        marge_basse = jQuery().Get_Val_int(
            conf.MargeBasse
    );
    marge_top = 0;
    if (conf.MargeHaute)
        marge_top = jQuery().Get_Val_int(
            conf.MargeHaute
    );

    info_Obj = jQuery(Obj).infos();
    h1_left = jQuery(Obj).absoluteLeft();
    h1_top = jQuery(Obj).absoluteTop();

    if (h1_top < info_Obj.height)
        h1 = (myWindow.height - h1_top - marge_basse - marge_top);
    else
        h1 = (myWindow.height - marge_basse);


    rap = info_Obj.height / info_Obj.width;
    w2 = parseInt(h1 / rap);

    if (w2 < info_Obj.width)
        marginLeft = info_Obj.left + parseInt((info_Obj.width - w2) / 2) + "px";
    else
        marginLeft = "auto";

    jQuery(Obj).css({ width: "auto", marginTop: marge_top,
        marginLeft: "auto", marginBottom: 0 + "px",
        verticalAlign: "middle", textAlign: "center"
    });
    jQuery(Obj).height(h1);

    //=============================================================
    if (conf.ResizePicture != "true") {

    } else
        imgs = jQuery(Obj).find("img");
    Obj_w = jQuery(Obj).width();
    Obj_h = jQuery(Obj).height();

    jQuery(imgs).each(function (i) {
        img = jQuery(this);

        info_img = { width: conf.width[i], height: conf.height[i] };
        img_rap = conf.rap[i];

        if (info_img.width > Obj_w) h1 = parseInt(Obj_w / img_rap);
        else w2 = parseInt(Obj_h * img_rap);
        if (w2 > 0 && h1 > 0 && img.length > 0) {
            img.height(h1);
            img.width(w2);
        }

    });




}
jQuery.extend(jQuery.expr[':'], {
    // Nom du sélecteur personnalisé
    Autosize: function (a) {
        n1 = a.className;
        // personal_block
        if (n1.match(RegExp("autosize", "gi"))) {
            //   autoresize = "MargeBasse:30px; ResizePicture:false"
            infconf = jQuery(a).attr("autosize");
            n1 = typeof infconf;
            conf = { MargeBasse: 0, NoPicture: false }
            if (n1 == "undefined") {

            } else {
                tableau = infconf.split(";");
                for (var i = 0; i < tableau.length; i++) {
                    tableau2 = tableau[i].split(":");
                    conf[jQuery.trim(tableau2[0])] = jQuery.trim(tableau2[1]);
                }
                imgs = jQuery(a).find("img");
                rap = new Array();
                width = new Array();
                height = new Array();
                jQuery(imgs).each(function (i) {
                    img = jQuery(this);
                    rap.push((img.width() / img.height()));
                    width.push(img.width());
                    height.push(img.height());
                });

                conf['rap'] = rap;
                conf['width'] = width;
                conf['height'] = height;

                List_autosize.push({ obj: a, conf: conf });
                jQuery(a).css({ opacity: 1 });
            }
        }
        //  Css = jQuery(a).getStyles(a);

        return false;

    }
});


function List_autosize_resize(event, ui) {
    if (typeof wait_resize == "undefined") wait_resize = false;
    if (wait_resize == true) return;

    wait_resize = true;
    if (List_autosize.length == 0) return;
    for (i = 0; i < List_autosize.length; i++) {
        Autosize_resize(jQuery(List_autosize[i]));
    }
    wait_resize = false;

}
//==============================================================
jQuery(document).ready(
     function (jQuery) {
       jQuery(':Autosize');

       jQuery(window).unload(function () {
         try {
           if (theImg) {
             jQuery.cookie('img', theImg.src); // créer un cookie avec une valeur
             jQuery.cookie('img_h', jQuery(theImg).height());
             jQuery.cookie('img_w', jQuery(theImg).width());
             jQuery.cookie('window_height', Window_Affichage.height);
             jQuery.cookie('window_width', Window_Affichage.width);
           }
         } catch (r) {

         }

       });



       jQuery(window).load(function () {
         if (typeof img_width == "undefined") {
           if (List_autosize.length == 0) return;
           for (i = 0; i < List_autosize.length; i++) {
             Autosize_resize(jQuery(List_autosize[i]));
           }
           return;
         }


         //=========================================================
         if (typeof (options) == "undefined") {
           options = { imageAutosizeMargin: 0, imageAutosize: false }
         }

         old_img = jQuery.cookie('img');
         old_img_h = jQuery.cookie('img_h');
         old_img_w = jQuery.cookie('img_w');
         old_window_height = jQuery.cookie('window_height');
         old_window_width = jQuery.cookie('window_width');

         //============================================================
         img_init = { height: img_height, width: img_width };  // taille initiale
         img_defaut = { height: scaled_height, width: scaled_width };
         img_reelle = { height: img_height, width: img_width };
         img_finale = { height: 0, width: 0 };

         img_top = "0";
         rapport = -1;
         marges_llgbo = 0;

         //=============================================================
         Type_Img = "";
         theImg = null;
         nopano = false;


         Zone_Affichage = { height: 0, width: 0 };
         //============================================================
         jQuery("#the_page").css({ top: "0px" });

         Info_the_page = jQuery("#the_page").infos();
         info_HeaderBar = jQuery("#imageHeaderBar").infos();

         Parent = "#theImage";

         Zone_Affichage = jQuery(Parent).infos();
         //
         var old_window = { width: 0, height: 0 };

         Bandeau_bas = Info_Description_f(Parent);        
         if (typeof Bandeau_bas == "undefined") {
 
         }
         if (typeof Bandeau_bas != "undefined") Bandeau = Bandeau_bas.top;
         else Bandeau = 0;
         old_window = { width: 0, height: 0 };
         jQuery("#theImage").trigger('ON');

         old_window = { width: 0, height: 0 };
         jQuery().newResize();

         //===================================================================
         /*
         * window .resize
         */
         jQuery(window).resize(
               function (event, ui) {
                 jQuery().newResize();
               });

         //============== initialisation ===================

         var pos;
         var set_p = false;


       }); // window.onload

       /* Extension
       * affiche_debug

       * resize
       * :
       */
       //=========================================================
       old_window = { width: 0, height: 0 };
       jQuery(window).resize(
               function (event, ui) {
                 List_autosize_resize(event, ui);
                 jQuery().newResize();
               });

       jQuery.fn.extend({
         //==========================================================
         Info_description: function (e) {
           return Info_Description_f(e);

         },
         //=============================================================
         onPropertyChange: function (e) {
           return;


         },
         /*
         * recherche la plus grande image (hauteur ou largeur)
         */
         Get_Img_Maxi: function (myobj) {
           return Get_Img_Maxi(myobj);
         },
         //============================================================
         affiche_debug: function (aff_infos) {
           affiche_debug(aff_infos);
         },
         //====================================================
         newResize: function () {
           //
          if (typeof options != undefined)
             if (options.imageAutosize)
               return true; //stripped
           if (DEBUG_autosize == "true") {
             nu_img += 1;

             bp1 = jQuery('.debug').get(nu_img);
             if (!bp1) nu_img = 0;
             bp1 = jQuery('.debug').get(nu_img);

             jQuery(bp1).trigger('ON');
           }
           if (typeof cl_visible == "undefined") return;
           if (!cl_visible == true) { return true; }
           var chk = eval(user_status + "_enabled");
           if (chk == "") { return true; }
           //=================================================================
           var winwidth = jQuery(window).width();
           var winheight = jQuery(window).height();
           n = winwidth - old_window.width;
           if (Math.abs(n) < 1) {
             n = winheight - old_window.height;
             if (Math.abs(n) < 1)
               return true;
           }
           if (Math.abs(n) > 30) nu_img = 0;
           //if (nu_img > 10) return true;
           old_window = jQuery(window).infos();
           //===========================================================================

           jQuery(Parent).width(winwidth);
           jQuery(Parent).height(winheight);

           var Cadre = jQuery(Parent).get(0);
           var info_theImage = jQuery(Cadre).infos();
           //===============  Information cadre ======
           var info_the_page = jQuery("#the_page").infos();
           //=============================================================================

           var info_content = jQuery("#content").infos();
           var info_titrePage = jQuery("#titrePage").infos();
           var info_imageInfoBar = jQuery("#imageInfoBar").infos();
           var info_theHeader = jQuery("#theHeader").infos();

           var Zone_Affichage = jQuery(Parent).infos();
           var info_ToolBar = jQuery("#imageToolBar").infos();
           var marge = 0;
           var marge_right = 0;
           var marge_left = 0;
           if (theme.match(RegExp("simple", "g"))) {
             if (info_ToolBar.width > 0)
               marge = (Zone_Affichage.width - info_ToolBar.width) / 2;
             else if (info_the_page.width > 0)
               marge = (Zone_Affichage.width - info_the_page.width) / 2;

             marge_right = marge;
             marge_left = marge;

             if (info_content.width > 100) {

               marge_left = (info_imageInfoBar.margin.left) + 1;
               marge_right = (marge_left + info_imageInfoBar.margin.right) + 1;
               winwidth = info_content.width;
               marge_right = info_imageInfoBar.width + marge_right;

             }
           } else {
             if (theme.match(RegExp("stripped", "gi"))) {

               marge = (info_the_page.width - info_HeaderBar.width) / 2;
               marge_right = marge + 2;
               marge_left = marge + 2;
             } else if (info_ToolBar.width > 0) {
               marge = (info_the_page.width - info_ToolBar.width) / 2;

               marge_right = marge + info_the_page.left;
               marge_left = marge;

             }
             winwidth = info_the_page.width;
           }



           marge_right += Zone_Affichage.borderwidth.right;
           marge_left += Zone_Affichage.borderwidth.left;
           winwidth -= (marge_right + marge_left);
           //---------------------------------------------
           /*
           jQuery(Parent).width(winwidth); // 1.6.2
           jQuery(Parent).css({ height: "auto" }); //1.6.2
           */
           //  jQuery(Parent).height(Zone_Affichage.height);
           //---------------------------------------------

           if (Type_Img == "pamoorama") {

             mypanorama = window.myPamoorama;
             //============================================================
             if (typeof (mypanorama) == "undefined") return false;
             var myPamoorama = mypanorama;
             if (typeof (myPamoorama.skipInit) == "undefined") return false;
             //

             if (myPamoorama.skipInit == false) {

               return false;
             }

             var info_pamoorama = jQuery("#pamoorama").infos();
             var info_pamoorama_outter = jQuery("#pamoorama_outter").infos();
             var info_pamoorama_inner = jQuery("#pamoorama_inner").infos();
             var info_pamoorama_footer = jQuery("#pamoorama_footer").infos();
             var info_pamoorama_frame = jQuery("#pamoorama_frame").infos();
             theImg = jQuery("#pamoorama");
             obj = theImg.get(0);

           } else {




           }
           //=================================================================


           switch (Type_Img) {
             case "map":
               img_reelle.height = winheight; // info_img.height;
               info_map = jQuery("#mapPicture").infos();
               jQuery("#map").css("left", info_map.width + "px");
               Bandeau_bas.height = 10;

               if (theme.match(RegExp("simple", "g"))) {
                 img_reelle.width = winwidth; //- info_map.width -marge_right;
               } else {
                 img_reelle.width = winwidth - info_map.width - marge_right;
               }


               info_the_page = jQuery("#the_page").infos();
               winwidth = img_reelle.width;

               ;

               break


             case "panorama":
               //  return;

               //the theMainImage ??
               theImg = jQuery("#theMainImage");
               if (theImg.length > 0)
                 theImg = theImg[0];
               else
                 theImg = jQuery().Get_Img_Maxi("#Panorama img[alt]");
               info_theImage = jQuery(theImg).infos();
               info_the_page = jQuery("#the_page").infos();
               jQuery("#theImage").height(info_theImage.height);
               img_finale.height = info_theImage.height;

               break
             case "img":

               if (!theImg) return true;
               if (theme.match(RegExp("luciano", "g"))) {
                 theImg = jQuery("#the_page #theImg");
               }
               info_theImage = jQuery(theImg).infos();
               info_the_page = jQuery("#the_page").infos();


               break
             case "img_autre":
               if (!theImg) {
                 if (DEBUG_autosize == "true") alert("theImg=null");
                 return true;

               }
               info_theImage = jQuery(theImg).infos();
               info_the_page = jQuery("#the_page").infos();


               break
             case "embed":
               //

               info_theImage = info_img;
               info_the_page = jQuery("#the_page").infos();

               if (rapport < 0) {
                 img_height = info_img.height;
                 img_width = info_img.width;

                 img_reelle.height = img_height;
                 img_reelle.width = img_width;

               }

               break
             case "charlie":


               info_theImage = info_img;
               info_the_page = jQuery("#the_page").infos();
               if (rapport < 0) {
                 img_height = parseInt(info_img.height);
                 img_width = parseInt(info_img.width);

                 img_reelle.height = parseInt(info_img.height);
                 img_reelle.width = parseInt(info_img.width);
               }

               break
             case "pamoorama":

               img_reelle = { height: img_height, width: img_width };

               //=========================================================
               img_reelle.height = img_height;
               img_reelle.width = Zone_Affichage.width;


               theImg = myPamoorama.image;
               info_theImage = jQuery("#pamoorama").infos();
               //img_finale.height = info_theImage.height;
               //info_theImage.height = img_reelle.height;

               info_theImage.height = info_theImage.height;

               info_the_page = jQuery("#the_page").infos();

               break


           }
           //================= Vérification taille image ==================
           MinWidth = jQuery(theImg).css("minWidth");
           if (MinWidth == "0px")
             MinWidth = mini_width;
           MinHeight = jQuery(theImg).css("minHeight");
           if (MinHeight == "0px")
             MinHeight = mini_height;

           MaxWidth = jQuery(theImg).css("maxWidth");
           if (MaxWidth == "0px")
             MaxWidth = winwidth;
           MaxHeight = jQuery(theImg).css("maxHeight");
           if (MaxHeight == "0px")
             MaxHeight = mwinheight;

           //=============== Vérification taille minimale  autorizée ======================
           var miniWidth = jQuery(theImg).Get_Val_int(MinWidth, mini_width);
           var miniHeight = jQuery(theImg).Get_Val_int(MinHeight, mini_height);
           if (winwidth < mini_width2) mini_width2 = winwidth;

           var miniWidth2 = jQuery(theImg).Get_Val_int(MinWidth, mini_width2);
           var miniHeight2 = jQuery(theImg).Get_Val_int(MinHeight, mini_height2);


           var maxWidth = jQuery(theImg).Get_Val_int(MaxWidth, winwidth, "0");
           maxHeight = jQuery(theImg).Get_Val_int(MaxHeight, winheight, "0");



           mini_width = parseInt(miniWidth);
           mini_height = parseInt(miniHeight);

           img_reelle.width = parseInt(img_reelle.width);
           // jQuery(Cadre).width(mini_width); 1.6.2


           if (img_reelle.width < mini_width) {
             //jQuery(Cadre).width(mini_width); 1.6.2
             return true;

           }

           img_reelle.height = parseInt(img_reelle.height);
           if (img_reelle.height < parseInt(mini_height))
             return true;
           //==================================================================================
           //---------------------------------------------
           //  jQuery(Parent).width(winwidth);
           //  jQuery(Parent).css({ height: "auto" });
           //  jQuery(Parent).height(Zone_Affichage.height);
           //---------------------------------------------

           if (rapport < 0) {

             img_init.height = parseInt(img_height);
             img_init.width = parseInt(img_width);

             rapport = img_width / img_height;

             if (Type_Img != "map")
               rapport = (img_init.width / img_init.height);
             else
               rapport = 0;

           }


           //=============== Zone d'affichage ============================

           borderW = Zone_Affichage.borderwidth.left;
           borderW += Zone_Affichage.borderwidth.right;


           Zone_Affichage.width = winwidth - borderW;



           var Licence = jQuery(".licencetag");
           info_Licence = jQuery(".licencetag").infos();

           jQuery(Parent + " #theImg IMG").css("marginTop", "0px")
           //========== Correction en fonction du thème =============================
           var correction = 0;
           if (theme.match(RegExp("sobre", "g"))) {

             //   correction = -info_Licence.padding.top;
             if (Type_Img == 'img') {
               if (msie == true) correction = 0;
               else correction = 0;
               correction = 10;
             }

           } else if (theme.match(RegExp("Pure", "g"))) {
             correction += 0; //??
           } else if (theme.match(RegExp("luciano", "g"))) {
             correction = 0; //??

           } else if (theme.match(RegExp("simple", "g"))) {
             correction += 0; //??
           } else if (theme.match(RegExp("gally", "g"))) {
             correction += 0; //??

           }

           //====================================================
           if (options.imageAutosizeMargin > 0) Marge_Basse = options.imageAutosizeMargin;
           else Marge_Basse = parseInt(marge_basse || 0); // hors bandeau
           //==========================================================================
           h = 0;
           Bandeau = 0;

           h = (Zone_Affichage.padding.bottom + Zone_Affichage.padding.top + Zone_Affichage.margin.top + Zone_Affichage.margin.bottom);
           if (typeof Bandeau_t != "undefined") Bandeau = Bandeau_t.img_top;
           Zone_Affichage.height = winheight - Bandeau - Marge_Basse - correction - h;
           //=========================================================================
           if (Zone_Affichage.height < mini_height2)
             Zone_Affichage.height = mini_height2;
           if (Zone_Affichage.width < mini_width2)
             Zone_Affichage.width = mini_width2;
           //=========================================================================
           if (typeof (Bandeau_bas) != "undefined") {            
             Zone_Affichage.height -= (Bandeau_bas.height + Bandeau_bas.marge.top + Bandeau_bas.marge.bottom);
                        } else {
           }

           var Image_height = Zone_Affichage.height;

           //=============================================================
           var height_user = eval(user_status + "_height");
           var reg1 = new RegExp("%", "g");
           if (height_user.match(reg1))
             Image_height = Image_height * parseInt(height_user) / 100;
           else
             Image_height = parseInt(height_user);

           echelle_max = parseFloat(echelle_max, '3');
           var echelle = parseFloat(Image_height / img_reelle.height, 3);

           if (echelle > echelle_max) { echelle = echelle_max; }
           Image_height = parseInt(img_reelle.height * echelle);
           //============================================================

           var Image_width;
           if (rapport > 0)
             Image_width = parseInt(Image_height * rapport);
           else if (Type_Img == "map") {
             Image_width = Zone_Affichage.width - marge_left - marge_right;
           } else {
             Image_width = Zone_Affichage.width;
           }

           //===============================================================
           align_auto = "center";
           if (jQuery("#theImg").css("textAlign"))
             align_auto = jQuery("#theImg").css("textAlign");
           var widthmin = winwidth;

           if (check_auto_w == 'checked="checked"') {
             // if (Type_Img != "pamoorama" && Type_Img != "panorama" ) {
             //==== largeur à atteindre ===
             var width_user = eval(user_status + "_width");
             // Largeur maximale en fonction du statut
             if (width_user.match(reg1))
             // pourcentage
               widthmin = widthmin * parseInt(width_user) / 100;
             else
               widthmin = parseInt(width_user);

             var marges = 0;

             if (typeof (info_img) != "undefined") {
               widthmin -= info_img.borderwidth.left || 0;
               widthmin -= info_img.borderwidth.right || 0;
             }
             widthmin -= marges;
             if (typeof Bandeau_t != "undefined") {
               widthmin -= (Bandeau_t.borderwidth.left + Bandeau_t.borderwidth.left);
               Image_width -= (Bandeau_t.borderwidth.left + Bandeau_t.borderwidth.left);
             } else {

               jQuery().newResize();
             }
             if (Image_width > widthmin) {
               //   Image_width largeur à atteindre
               //  Calcul du rapport d'agrandissement
               var echelle_w = parseFloat((widthmin) / img_reelle.width, 3);
               if (echelle_w > echelle_max) { echelle_w = echelle_max; }
               Image_width = parseInt(img_reelle.width * echelle_w);
               if (rapport > 0)
                 Image_height = parseInt(Image_width / rapport);
             }



           }


           // }
           //===================================================

           img_finale.height = Image_height;
           img_finale.width = Image_width;
           if (theme.match(RegExp("stripped", "gi"))) {
             img_finale.width -= (llgboframe.top * 2);
             if (rapport > 0) img_finale.height = (img_finale.width / rapport);
             else img_finale.height -= (llgboframe.top * 2);

           }
           zoom = echelle;
           if (typeof (llgboframe) != "undefined" && llgboframe.height > 0) {
             //=============LLGBO2 ===========================
             t1 = llgboframe;
             if (!theImg.src) {
               theImg = jQuery("#gbo").find("img").get(0)
               if (!theImg.src) {
                 theImg = jQuery(Parent).find("div").get(0)
               }
             }
             if (theImg.src) {


               wingbo = img_finale.width;
               heightgbo = img_finale.height;
               if (Type_Img == "panorama") {
                 heightgbo = info_theImage.height;
                 img_finale.height = info_theImage.height;
               }

               img_finale.width -= marges_llgbo;
               if (jQuery("#slideshow").infos().width > 0) {
                 img_finale.height -= (marges_llgbo * 1.5);
               } else {
                 img_finale.height -= marges_llgbo
               }


               if (wingbo > winwidth) {
                 jQuery("#gbo").width(winwidth);
                 jQuery("#gbo").height(winheight);
                 jQuery("#gbo").css("width", winwidth + "px");
                 jQuery("#gbo").css("height", winheight + "px");
               }
               else {
                 jQuery("#gbo").width(wingbo);
                 jQuery("#gbo").height(heightgbo);
                 jQuery("#gbo").css("width", wingbo + "px");
                 jQuery("#gbo").css("height", heightgbo + "px");
               }

               a0 = jQuery("area[rel!=up][rel!=prev][rel!=next]");
               a1 = jQuery("area[rel=prev]");
               a2 = jQuery("area[rel=next]");
               a3 = jQuery("area[rel=up]");
               nb_zone = 3;
               if (a1.length == 0) {
                 nb_zone -= 1;
               }
               if (a2.length == 0) {
                 nb_zone -= 1;
               }


               var Largeur_zone = (img_finale.width / nb_zone);
               var Hauteur_zone = (img_finale.height);
               var init_zone = 0;

               if (a1.length > 0) {
                 coord = { x0: init_zone, y0: 0, x1: Largeur_zone, y1: Hauteur_zone };

                 jQuery("area[rel=prev]").attr({ coords: "'" + coord.x0 + "," + coord.y0 + "," + coord.x1 + "," + coord.y1 + "'" });
                 init_zone += Largeur_zone;
               }

               coord = { x0: init_zone, y0: 0, x1: init_zone + Largeur_zone, y1: img_finale.height };

               if (a0.length > 0) {
                 jQuery("area[rel=up]").attr({ coords: "'" + coord.x0 + "," + coord.y0 + "," + coord.x1 + "," + (coord.y1 / 2) + "'" });
                 jQuery(a0).attr({ coords: "'" + coord.x0 + "," + (coord.y1 / 2) + "," + coord.x1 + "," + (coord.y1) + "'" });
               } else {
                 jQuery("area[rel=up]").attr({ coords: "'" + coord.x0 + "," + coord.y0 + "," + coord.x1 + "," + (coord.y1) + "'" });
               }
               init_zone += Largeur_zone;

               if (a2.length > 0) {
                 coord = { x0: init_zone, y0: 0, x1: init_zone + Largeur_zone, y1: img_finale.height };
                 jQuery("area[rel=next]").attr({ coords: "'" + coord.x0 + "," + coord.y0 + "," + coord.x1 + "," + coord.y1 + "'" });
               }
               jQuery("#theImage").height(heightgbo + marges_llgbo / 2);
             }
           }

           //================ Zone affichage =========================


           //  jQuery(Cadre).css("top", "0px");
           jQuery("#standard").css("top", 0 + "px");
           jQuery("#comments").css("top", 0 + "px");
           //========== Image Remise à l'échelle =======================

           img_finale.height = parseInt(img_finale.height);
           img_finale.width = parseInt(img_finale.width);
           //=========================================================================
           if (jQuery("#slideshow").infos().width > 0) {


           } else {

           }
           //=== cadre = theImage
           jQuery(Cadre).css({ marginLeft: "auto" });
           // jQuery(Cadre).width(Zone_Affichage.width);
           jQuery(Cadre).css("width", "auto");

           if (Type_Img == "panorama" || Type_Img == "pamoorama") {
             img_finale.height = info_theImage.height;
             Zone_Affichage.height = img_finale.height;
             jQuery(Cadre).height(Zone_Affichage.height);
           }

           if (typeof (gmaps) != "undefined") {
             Gmap_ = gmaps.maps[0];
             if (Gmap_.sizeMode == 'A') {
               jQuery("#iGMapsIcon").css({ width: old_window.width * 0.8 + "px", height: old_window.height * 0.8 + "px" });

             }
           }
           //============= flv,mov,mpg  ok
           /* wmv nok
           * avi nok
           //===========================================
           */
           if (Type_Img == "charlie") {
             t1 = jQuery("#charlie").infos();

             /**/

             pdf = 0;
             jQuery("#charlie div").each(function (i) {


               p1 = jQuery(this).infos();
               pdf += p1.padding.right + p1.padding.left;
             });
             img_finale.width -= pdf;

             jQuery("#charlie").css({
               width: img_finale.width + pdf,
               height: img_finale.height,
               marginLeft: "auto"
             });



             jQuery("#player").css("width", img_finale.width + "px");
             jQuery("#player").css("height", img_finale.height);

             jQuery("#embedplayer").css("width", img_finale.width);
             jQuery("#embedplayer").css("height", img_finale.height);


             jQuery("object").width(img_finale.width);
             jQuery("object").height(img_finale.height);

             jQuery(Cadre).height(img_finale.height + Bandeau_bas.height); //??
             jQuery(theImg).height(img_finale.height);

             jQuery(Cadre).css("height", "auto");  

           } else if (Type_Img == "panorama") {
             // -----     jQuery(theImg).panorama2(img_finale.height, img_finale.width);
             //  jQuery(theImg).height(img_finale.height);
             //   jQuery(theImg).width(img_finale.width);
             //  n = jQuery.fn.panorama();
             // jQuery("#Panorama div").height(img_finale.height);
             //  class=simple_panorama
             // jQuery("#Panorama div").height(img_finale.height);
             if (typeof asp_options != "undefined")
               n = asp_options;
             n1 = jQuery("#Panorama div").width();
             // asp_options.viewport_width = winwidth;
             //n =n.panorama_animate();
             //jQuery("#panoramaContainer").stop(); ;
             // n = jQuery(theImg).panorama(asp_options);

             //jQuery("#Panorama div").width(asp_options.viewport_width);

             jQuery(".panorama-viewport").css("margin", "auto");

             n = info_imageToolBar;


           } else if (Type_Img == "pamoorama") {



             info_theImage.height = Zone_Affichage.height;
             img_height = myPamoorama.imageHeight
             if (theme.match(RegExp("simple", "g"))) {
               //  marge_right = 2;
             }
             new_width = Zone_Affichage.width - marge_right - marge_left;
             new_width = Zone_Affichage.width - (info_theImage.borderwidth.right + info_theImage.borderwidth.left);
             if (new_width > myPamoorama.imageWidth)
               new_width = myPamoorama.imageWidth;



             Zone_Affichage.height += info_pamoorama_footer.height;
             zoom = info_theImage.height / img_height;
             myPamoorama.options.width = new_width * zoom;
             //  if(msie || safari) jQuery("#pamoorama_inner ").css({ zoom: zoom });
             //====================================================
             jQuery("#pamoorama").css({
               marginLeft: "auto",
               marginRight: "auto",
               //height: Zone_Affichage.height + "px", sinon déclenchement panorama sur la hauteur;
               width: new_width + "px"
             });
             jQuery("#pamoorama").width(new_width);

             //====================================================
             info_pamoorama = jQuery("#pamoorama").infos();
             img_finale.height = info_pamoorama.height - info_pamoorama_footer.height;
             img_finale.width = new_width;

             jQuery("#pamoorama_outter").width(new_width);

             jQuery("#pamoorama_thumb").width(200 / zoom);
             // commenter sinon outter augmente à chaque resize
             //  jQuery("#pamoorama_outter").height(info_pamoorama.height - info_pamoorama_footer.height);
             // pamoorama_frame


             jQuery("#pamoorama_outter").css({ width: new_width + "px" });
             jQuery("#pamoorama_footer").css({ width: new_width + "px" });
             //
             //====================================================
             info_pamoorama = jQuery("#pamoorama").infos();
             info_pamoorama_outter = jQuery("#pamoorama_outter").infos();
             info_pamoorama_inner = jQuery("#pamoorama_inner").infos();
             info_pamoorama_footer = jQuery("#pamoorama_footer").infos();
             info_pamoorama_frame = jQuery("#pamoorama_frame").infos();

             info_frame = jQuery(myPamoorama.frame).infos();

             zoom = img_finale.height / img_height;


           } else if (theImg != null && theImg.src) {
             //--- background ?? ---
             jQuery(theImg).height(img_finale.height);
             jQuery(theImg).width(img_finale.width);
             jQuery(theImg).css({ height: img_finale.height + "px ",
               width: img_finale.width + "px "
             });


           } else {
             //===map ? luciano ===

        // jQuery(Cadre).height(Zone_Affichage.height + Bandeau_bas.height); //??
              //     jQuery(Cadre).height(img_finale.height + Bandeau_bas.height); //??
         jQuery(Cadre).css("height","auto"); //??
             jQuery(theImg).height(img_finale.height);
             jQuery(theImg).width(img_finale.width);
             jQuery(theImg).css({ height: img_finale.height + "px ",
               width: img_finale.width + "px "
             });
             if (theme.match(RegExp("luciano", "g"))) {
               jQuery(Parent + " #theImg IMG").css({ height: img_finale.height + "px ",
                 width: img_finale.width + "px "
               })
             }

           }

           jQuery("#navThumbPrev").css({ overflow: "hidden" });
           jQuery("#navThumbNext").css({ overflow: "hidden" });
           n = typeof inittoolbar;
           if (Type_Img == "map") {
             jQuery("#navThumbNext").css({ display: 'none' });
             jQuery("#navThumbPrev").css({ display: 'none' });
             jQuery("#theImage").css({ marginTop: info_ToolBar.height + "px", marginLeft: "0px",
               width: winwidth + "px",
               height: winheight + "px"
             });
             //mapPicture 
           }
           try {
             if (theme.match(RegExp("gally", "gi"))) {
               if (typeof inittoolbar == "function") {
                 if (typeof (currentTab) == "undefined") inittoolbar();
                 else initializeImageMode("resize");
               } else {
                 tp = gallyPP.getImageProp();
                 if (typeof (GallyPP) == "function")
                   gallyPP = new GallyPP();

                 iph = jQuery("#imageHeaderBar").infos();
                 jQuery("#imageToolBar").css({ top: iph.bottom + "px", position: "absolute" });
                 jQuery("#theImage").width(winwidth);
               }
               //===========================================================================
               if (jQuery("#navThumbPrev").length > 0) {
                 jQuery("#navThumbPrevContainer").css({ left: "0px"
                 });
               }
               if (jQuery("#navThumbNext").length > 0) {
                 jQuery("#navThumbNextContainer").css({ left: "0px"
                 });
               }
               //=============================================================================
               if (!theme.match(RegExp("lapis", "gi"))) {
                 if (typeof initializeImageMode == "function") {
                   initializeImageMode("resize");
                 }

               }

             } else if (theme.match(RegExp("simple", "g"))) {

               jQuery("#imageToolBar").css({ position: "static" });

               info_imageInfoBar = jQuery("#imageInfoBar").infos();
               if (info_imageInfoBar.bottom < info_img.bottom) {
                 //   jQuery("#imageInfoBar").height(info_img.bottom);
               }

             } else {

               //    jQuery("#imageToolBar").css("position", "static");
             }
           } catch (e) {

           }
           //  --- réglage de la hauteur de page en fonction du copyright-----------
           if (typeof (pos_copyright) == "undefined") pos_copyright = jQuery("#copyright").infos();

           if (theme.match(RegExp("stripped", "gi"))) {
             var TitleBox = jQuery("#imageTitleContainer");
             if (TitleBox.length != 0) TitleBox.css("width", img_finale.width + "px");
           } else {
             if (pos_copyright.top > 100) {
               jQuery("#the_page").height(pos_copyright.top);
             }
           }


           /*
           if (!theme.match(RegExp("luciano", "gi"))) {
           jQuery("#linkNext").css({ height: "80px", width: "200px", overflow: "hidden" });
           jQuery("#linkPrev").css({ height: "80px", width: "200px", overflow: "hidden" });
           jQuery(".navThumb img").css({ height: "80px", width: "", overflow: "hidden" });
           }
           */
           info_frame = jQuery(Cadre).infos();
           if (theme.match(RegExp("stripped", "gi"))) {
             pos = "absolute";
             info_theImageBox = jQuery("#theImageAndTitle").infos();
             p1 = jQuery(".randomButtons").infos();
             p2 = jQuery("#imageHeaderBar").infos();
             jQuery("#theImage").width("width", info_theImageBox.width + "px");
             jQuery("#theImageAndTitle").css("position", "relative");
             jQuery("#theImageAndTitle").css({ marginTop: "0px",
               paddingTop: (p1.top) + "px"
             });
             t1 = info_theImageBox.top;
             l1 = info_theImageBox.left;
             // info_theImageBox = jQuery(Parent).infos();

           } else {

             t1 = info_frame.top;
             l1 = info_frame.left;
             info_theImageBox = jQuery(Parent).infos(); //theImage
           }

           info_theImageBox.margin.margin = info_frame.margin.margin;
           info_theImageBox.top = t1;
           info_theImageBox.left = l1;
           //  info_theImageBox.position = "absolute";

           Window_Affichage = info_theImageBox;
           if (DEBUG_autosize == "true") {
             //   jQuery(Cadre).css("border", "solid green");

             jQuery("#Debug5").css({ background: "red",
               position: "absolute",
               border: "green solid 2px",
               textAlign: align_auto,
               margin: "auto",
               top: Window_Affichage.top + "px",
               left: Window_Affichage.left + "px",
               width: Window_Affichage.width + "px",
               height: Window_Affichage.height + "px"
             }); //red
             jQuery("#Debug4").css({ top: info_frame.bottom - info_description.height + "px" }); //green
           }

           Wait_Affichage();

           return true;





           //_____________________________________________________
         } // Resize();


         //======================================================================


       });            // fin extend



     } // function
);


/*
* recherche la plus grande image (hauteur ou largeur)
*/
function Get_Img_Maxi(myobj) {
    var w00 = 0;
    var myImg = null;
    img = jQuery(myobj);

    img = jQuery('img[alt]');

    jQuery(myobj).each(function (i) {
        w0 = img_reelle.width;
        h0 = img_reelle.height;
        if (h0 > w0) w0 = h0;
        if (w0 > w00) {
            if (!this.src.match(RegExp(".png", "g")))
                if (!this.src.match(RegExp(thumbnail, "g"))) {
                    myImg = this;
                    w00 = w0;
                }

        }
    });
    return myImg;
}

//============================================================
/*
*
*/

function Info_entete(Parent) {

    info_imageToolBar = jQuery("#imageToolBar").infos();
    if (typeof (marge_top) != "undefined") return info_imageToolBar;

    if (info_imageToolBar.position == "absolute") {
        jQuery("#imageToolBar").css("position", "relative");
        jQuery("#imageToolBar").css("top", 0 + "px");
    }
    optiontop = 0;


    info_imageInfoBar = jQuery("#imageInfoBar").infos();

    jQuery("#" + "theImgContainer").css("marginTop", "0px");
    info_theImage = jQuery(Parent).infos();
    info_thePicturePage = jQuery("#thePicturePage").infos();


    if (theme.match(RegExp("stripped", "gi"))) {

        info_theImageAndTitle = jQuery("#theImageAndTitle").infos();
        info_theImageBox = jQuery("#theImageBox").infos();

        optiontop = (marges_llgbo / 2) + info_theImageAndTitle.margin.top;

    }

    if (info_theImage.position == "relative") {
        //--- passage relative ==> static ===/
        jQuery(Parent).css("position", "static");
        info_theImage = jQuery(Parent).infos();

    } else {

    }
    if (info_theImage.position == "absolute") {
        //--- passage absolute ==> static ===/
        jQuery(Parent).css("position", "static");
        info_theImage = jQuery(Parent).infos();

    }

    marge_top = Math.ceil(Info_the_page.top +
                                     Info_the_page.borderwidth.top +
                                     info_theImage.borderwidth.top +
                                     info_thePicturePage.margin.top
                                     );

    img_top = Math.ceil(info_theImage.top +
                        info_theImage.borderwidth.top +
                        info_thePicturePage.margin.top + optiontop);
    result = info_imageToolBar;
   // result.width = "20%";
   // result.left = "40%";
    result.marge_top = marge_top;
    result.img_top = img_top;
    //=== Afficher le titre de l'image sur le cadre ===
    llgboh2 = jQuery("#gboh2").infos();
    result.img_top += llgboh2.height;

    return result;

}

/* Récupère les informations sur la description.
*
*/

//====================================================
function Info_Description_f(Parent) {


    jQuery(Parent).css({ display: "block" });
    //====== détection du type d'images ======
    if (jQuery("#charlie").length > 0) {
        Type_Img = "charlie";

    } else if (jQuery("#pamoorama").length) {
        Type_Img = "pamoorama";
    } else if (jQuery(Parent + " embed").length > 0) {
        Type_Img = "embed";
    } else if (jQuery("#map").length) {
        Type_Img = "map";

    } else if (jQuery("#Panorama").length) {
        Type_Img = "panorama";
    } else if (jQuery(Parent).find("img").length > 0) {
        Type_Img = "img";
    } else if (jQuery(Parent + "Box").find("img").length > 0) {
        Type_Img = "img";
        Parent = Parent + "Box";
    } else if (jQuery("img").length > 0) {
        Type_Img = "img_autre";
        return;
    } else {
        return;
    }
    // jQuery(Parent + " p:not(:contains(' ')) ").remove();
    // jQuery(Parent + " p:(:contains('')) ").remove();
    llgboframe = jQuery("#gbo").infos();
    marges_llgbo = 0;

    if (llgboframe.height > 0) {
        ll2 = jQuery("#gbo div:last").infos();
        ll1 = jQuery("#gbo div:first").infos();
        ll2 ="" ;
        jQuery("#gbo div").each(function (i) {

         if (  this.id=="") return ;
ll2=this ;
        });
       ll2 = jQuery(ll2).infos();
        ll1 = ll1.width;
        ll2 = ll2.width - ll2.borderwidth.left - ll2.borderwidth.right;
        marges_llgbo = (ll1 - ll2);

    }

    Bandeau_t = Info_entete(Parent)
    Bandeau = Bandeau_t.img_top;

    info_theImgContainer = jQuery("#" + "theImgContainer").infos();
    info_description = jQuery("#" + "description").infos();
    //=============================================================================
    //   jQuery(Parent + " p").css({ padding: "0px", margin: "0px "    });
    if (theme.match(RegExp("simple", "gi"))) {
        jQuery(Parent).css({ padding: "0px",
            marginLeft: "0px",
            marginRight: "auto",
            marginTop: "0px",
            marginBottom: "0px"

        });
    }


    if (theme.match(RegExp("luciano", "g"))) {
        jQuery("#imageContainer").css({ height: "auto" });
        theImg = jQuery(Parent + " #theImg img");
        info_img = jQuery(theImg).infos();


    } else if (Type_Img == "map") {

        info_map = jQuery("#mapPicture").infos();
        marge_left = info_map.width;

        jQuery("#map").css({ left: marge_left + "px", padding: "0px",
            marginLeft: "0px",
            marginRight: "4px",
            marginTop: "0px",
            marginBottom: "0px",
            position: "relative"
        });

        theImg = jQuery("#map");
        info_img = jQuery(theImg).infos();


      } else if (jQuery("#charlie").length > 0) {
   
     if (jQuery("object").attr("type") == 'application/x-shockwave-flash') {
          jQuery("#charlie").css({
            paddingTop: "0px",
            marginTop: "0px",
            paddingBottom: "30px",
            marginBottom: "0px"
          });
        } else {
          jQuery("#charlie").css({
            paddingTop: "0px",
            marginTop: "0px",
            paddingBottom: "10px",
            marginBottom: "0px"
          });
        }
        theImg = jQuery("#charlie");
        info_img = jQuery(theImg).infos();
 
    } else if (jQuery(Parent + " embed").length > 0) {

        theImg = jQuery(Parent + " embed");
        info_img = jQuery(theImg).infos();



    } else if (Type_Img == "pamoorama") {
        if (!nopano) {
            Wait_pamoorama();
            return info_description;
        }
        theImg = jQuery("#pamoorama");
        info_img = jQuery(theImg).infos();
        info_footer = jQuery("#pamoorama_footer").infos();
        info_img.height = parseInt(img_reelle.height) + parseInt(info_footer.height);

    } else {
        theImg = jQuery(Parent + " img[alt]");

        //theImg = Get_Img_Maxi(theImg);
        //theMainImage
      
        if (!theImg)
            theImg = jQuery(Parent);   // sans img ??
        if (theImg.length > 1)
          {theImg = theImg[0];

          }

        //theImg = Get_Img_Maxi(theImg);  //1.6.2
        //if (!theImg) theImg = jQuery(Parent);   // 1.6.2sans img ??
        info_img = jQuery(theImg).infos();
    }
    //=====================================================================================

    switch (info_img.position) {
        case "relative":
            break;
        case "static":
            break;
        case "absolute":
            break;
        case "":
            break;
        default:
            break;
    }

    info_description.marge = {
        bottom: info_img.padding.bottom + info_img.margin.bottom + info_img.borderwidth.bottom,
        top: info_img.padding.top + info_img.borderwidth.top + info_img.margin.top
    }

    if (llgboframe.height > 0) info_img = llgboframe; // format de l'image+largeur du cadre

    if (theme.match(RegExp("luciano", "g"))) {

        info_theImgContainer = jQuery("#imageContainer").infos();
        info_description.bottom = jQuery("#imageInfo").infos().top;
        info_description.top = info_theImgContainer.bottom;
        Info_slidshowToolBar = jQuery("#slidshowToolBar").infos();

        if (Info_slidshowToolBar.height > 0) {
            correction = (Info_slidshowToolBar.height);
            info_description.top = info_img.bottom;
            info_description.bottom = jQuery("#copyright").infos().top;
        }

        //=========================================================
    } else if (theme.match(RegExp("stripped", "gi"))) {
        //options.imageAutosize
        //options.imageMargin
        if (options.imageAutosizeTitle == false) {
            info_description.top =   info_theImageBox.bottom;

            info_description.bottom =info_HeaderBar.margin.top+ info_description.top +
                                    info_description.borderwidth.top +
                                    info_description.borderwidth.bottom +
                                      options.imageAutosizeMargin*2 +
                                    (marges_llgbo / 2)+4;

        } else {


            info_description.top = info_theImageBox.bottom +
                        jQuery("#content").infos().top +
                        options.imageAutosizeMargin * 2  +
                        (marges_llgbo / 2)
                                ;
            info_description.bottom = jQuery("#tabZone").infos().top +
                        info_theImageAndTitle.margin.top;
           if (msie == true) info_description.bottom -= 4;
        };
        check_desc_v = true;

      } else {
        if (theme.match(RegExp("sobre", "gi"))) {
          info_description.marge.top = -2;
        }
        info_description.bottom = info_theImage.bottom;
        info_description.top = info_img.height + info_theImage.top;
        // info_description.bottom -= info_img.top;
    }
    //

    info_description.height =   info_description.bottom - info_description.top;

    if (check_desc_v == false) {
        info_description.height = 0;
    }

    Debug_pos();

    //cl_visible=false ;
    return info_description;
}

//====================================================
function Debug_info(index, infos, nom) {

    if (infos.height > 0) {

        message = browser.browser + " -- > Info : " + nom + " " + infos.id + "\n" +
                 "Info nodeName: " + infos.nodeName + "\n" +
                 "Info width: " + infos.width + "\n" +
                 "Info height: " + infos.height + "\n" +
                 "Info top: " + infos.top + "\n" +
                 "Info left: " + infos.left + "\n" +
                 "Info position: " + infos.position + "\n";

        myDebug = { id: "Debug" + index, texte: message,
            css: {
                color: "black",
                opacity: "0.5",
                position: "absolute",
                height: infos.height || 100 + "px",
                width: infos.width || 300 + "px",
                left: infos.left || 0 + "px",
                border: "solid 1px green",
                top: infos.top + "px"

            }
        }
        return myDebug;
    } else {
        return null;
    }


}
//====================================================
function Debug_pos() {
    if (DEBUG_autosize == "true") {

        jQuery("[id ^='Debug']").show();
        /*
        Debug2  background-color:yellow
        Debug3 background-color:blue
        Debug4 background-color:green
        Debug5 background-color:red

        */

        affiche_debug({
            Debug1: Debug_info(1, Bandeau_t, "Bandeau_t"),
            Debug4: Debug_info(4, info_description, "info_description"),
            Debug5: Debug_info(5, info_img, "info_img")
        });
    }
}

function affiche_debug(aff_infos) {
    jQuery(jQuery("[id ^='Debug']")).each(function (i) {
        if (aff_infos[this.id]) {
            if (aff_infos[this.id].css) {
                jQuery("#" + this.id).css(aff_infos[this.id].css);
                jQuery("#" + this.id).text(aff_infos[this.id].texte);
            }
        }
    });
    return;

}




jQuery(function () {
  //'gallyInterfaceReady' 

    jQuery('#pamoorama').live('ON', function (e) {
        jQuery(jQuery('.debug').get(1)).trigger('ON');
        Bandeau_bas = Info_Description_f(Parent);
        Bandeau = Bandeau_bas.top;
        old_window = { width: 0, height: 0 };
        Wait_Affichage();
    });

    jQuery(Parent).live('ON', function (e) {
        jQuery(jQuery('.debug').get(1)).trigger('ON');
        Wait_Affichage();
    });

    // Custom Event, ON to turn on a debug.
    jQuery('.debug').live('ON', function (e) {

        jQuery('.debug').trigger('OFF');
        jQuery(this).addClass('debugOn');
    });

    // On Click = debugs On
    jQuery('.debug').live('click', function (e) {

        jQuery(this).trigger('ON');
    });

    // Custom Event, Turn off a debug
    jQuery('.debug').live('OFF', function (e) {

        jQuery(this).removeClass('debugOn');
    });

    // on Double Click, remove the debug from the DOM
    jQuery('.debug').live('dblclick', function () {

        jQuery(this).fadeOut(function () { $(this).remove() });
    });

    // Add another debug to the DOM
    jQuery('#adddebugs').click(function () {
        jQuery('<div></div>')
            .addClass('debug')
            .appendTo('#debugsContainer');
    });
     
    // Add 10 testing debugs to start with
      jQuery(window).load(function () { 
            DEBUG_autosize = (typeof DEBUG_autosize != "undefined") ? DEBUG_autosize : "false";
        if (DEBUG_autosize == "true") {
            for (var i = 0; i < 10; i++) {
                jQuery('#adddebugs').click();
            }
            jQuery(jQuery('.debug').get(8)).click();

          

        }
    }); //on load
});