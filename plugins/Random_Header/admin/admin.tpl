<div class="titrePage"><h2>Random Header {$RH_VERSION}</h2></div>
<p>{'rh_description'|@translate}</p>
<p><i>{'rh_aide'|@translate}</i></p>
<form method="post" action="" class="properties">
  
  
<div id="themesContent">
{if $rh_vierge!=0}
	<fieldset>
		<legend>{'rh_active_conf'|@translate}</legend>
		
		<div class="themeBoxes">
		{foreach from=$rhthemes item=i}
			{if $i.CATSELECTED!=0}
				{include file="$RH_confpanel"}
			{/if}
		{/foreach}
		</div> <!-- themeBoxes -->
	</fieldset>
{/if}	

	<fieldset>
		<legend>{'rh_inactive_conf'|@translate} : </legend>
		
		<div class="themeBoxes">
		{foreach from=$rhthemes item=i}
			{if $i.CATSELECTED==0}
				{include file="$RH_confpanel"}
			{/if}
		{/foreach}
		</div> <!-- themeBoxes -->
	</fieldset>
	
</div> <!-- themesContent -->
 
<div id="fade" class="black_overlay"></div> 
 
<div style="text-align:center;clear:left"><input class="submit" type="submit" value="{'rh_submit'|@translate}" name="submit" ></div>
</form>