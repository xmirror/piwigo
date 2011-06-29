<!--- $MY_ENTETE_PATH Mes_SCRIPTS Header--->
{html_head}

<!--- Mes_SCRIPTS body --->

  {literal}
<style type="text/css" media="screen">
#scrolltotop { position:fixed; top:100px;right:10px; z-index:1000; opacity:0; }
#scrolltotop a { {/literal} 
  background-color:transparent;
  background-image: url("{$MY_FOOTER_PATH}images/top.png");
  background-position:left top; background-repeat:no-repeat; 
  display:block;
  height:100px; text-indent:-9999px; width:50px; border:0; 
  {literal}
  } 

#scrolltobottom { position:fixed; bottom:100px;right:10px; z-index:1000; opacity:0; }
#scrolltobottom a { {/literal} 
  background-color:transparent;
  background-image: url("{$MY_FOOTER_PATH}images/bottom.png");
  background-position:left top; background-repeat:no-repeat; 
  display:block;
  height:100px; text-indent:-9999px; width:50px; border:0; 
  {literal}
  } 
</style>
 {/literal}  
{/html_head}
<div id="scrolltobottom"><a title="Revenir en bas de la page" href="#"></a></div>
<div id="scrolltotop" ><a title="Revenir en haut de la page" href="#"></a></div>
{literal}
{/literal}
 
<!---Fin Mes SCRIPTS --->