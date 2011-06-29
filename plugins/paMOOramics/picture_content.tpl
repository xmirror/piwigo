{html_head}
<style type="text/css">
#pamoorama {ldelim}
  margin: 0 auto;
  border: {$PANO_BORDER}px solid {$PANO_BORDERCOLOR};
  overflow:hidden;
}
#pamoorama_footer {ldelim}{$PANO_DISPLAYFOOTER}}
</style>
{/html_head}
<div id="pamoorama" alt="{$SRC_IMG}"></div>
<script type="text/javascript" charset="utf-8">
	window.addEvent('domready', init);
	function init(){ldelim}
		myPamoorama = new pamoorama('pamoorama',{ldelim} activateSlider: 	{$PANO_ACTIVATESLIDER},
						  width: 			{$PANO_WIDTH},
						  footercolor: 		'{$PANO_FOOTERCOLOR}',
						  captioncolor: 	'{$PANO_CAPTIONCOLOR}',
						  caption: 			'{$ALT_IMG}',
						  enableAutoscroll: {$PANO_ENABLEAUTOSCROLL},
						  autoscrollSpeed:	{$PANO_AUTOSCROLLSPEED},
						  autoscrollOnLoad:	{$PANO_AUTOSCROLLONLOAD},
						  startAutoscroll:	'{'pamooramics_startAutoscroll'|@translate}',
						  stopAutoscroll:	'{'pamooramics_stopAutoscroll'|@translate}',
						  loadingMessage: 	'{'pamooramics_loading'|@translate}',
						  clickMessage:		'{'pamooramics_clickMessage'|@translate}',
						  dragMessage:		'{'pamooramics_dragMessage'|@translate}'
		});
	}
</script>

{if isset($high) }
<a href="javascript:phpWGOpenWindow('{$high.U_HIGH}','{$high.UUID}','scrollbars=yes,toolbar=no,status=no,resizable=yes')">
  <p>{'pamooramics_picture_high'|@translate}</p></a>

{/if}