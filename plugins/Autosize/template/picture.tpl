 <style type="text/css">
         #bp_cla {ldelim}
  cursor:pointer;
}

     </style>
 <a onclick = "Toggle_bp()"  id="bp_cla" 
    title="{'cl_autosize_info_2'|@translate}"
    alt="{'cl_autosize_info_2'|@translate}" />
    <img class="button" id="bp_img_cla" alt="{'cl_autosize_info_2'|@translate}"  src="{$cl_autosize_button.ICON}"  complete="complete"/>
  </a>

 <script language=javascript type="text/javascript">
  

 {if $ASP.width}
 var asp_options ={ldelim} };

    var w = $("#imageToolBar").width();
	if (w === null) {ldelim} w = $("#theImage").width(); }
	if (w < {$ASP.min_viewport_width}) {ldelim} w = .75 * $("#theImage").width(); }
	var m = w;
	w = w * ( Math.min( Math.max({$ASP.viewport_width} / 100, .5) , 1 ));
	w = Math.round(Math.min( {$ASP.max_viewport_width} , Math.max( {$ASP.min_viewport_width}, w) ));
	var s = (100 - {$ASP.speed}) * 2000;
	var p = Math.round(Math.min(Math.max({$ASP.width} * ( {$ASP.start_position} / 100 ), 0), {$ASP.width}));
	if ({$ASP.width} > w) {ldelim}
		$("#theImage img").eq(0).removeAttr("style").attr({ldelim}width:{$ASP.width},height:{$ASP.height}}).addClass("simple_panorama");
		asp_options = {ldelim}
					 viewport_width: w,
					 speed: s,
					 direction: '{$ASP.direction}',
					 control_display: '{$ASP.control_display}',
					 start_position : p,
					 auto_start : {$ASP.auto_start},
					 mode_360 : {$ASP.mode_360},
					 loop_180 : {$ASP.loop_180}
			 };
		//$("#theImage img.simple_panorama").panorama(asp_options);
	};
 
  {/if}

 var src1="{$cl_autosize_button.ICON}";
 var src2="{$cl_autosize_button.ICON2}";
 var src3="{'cl_autosize_info_2'|@translate}";
 var src4 = "{'cl_autosize_info'|@translate}";
 </script> 