<div class="titrePage">
  <h2>{'pft_h2'|@translate}</h2>
</div>
<div id="configContent">
{if isset ($gestA)}
	<form method="post" >
	 <fieldset id="mainConf">
			<span class="property">
				<label for="pftperso">{'pft_perso'|@translate}</label>
			</span>
			<textarea rows="5" cols="50" class="description" name="perso_footer" id="perso_footer">{$gestA.PFTBASE}</textarea>
  <p>
    <input class="submit" type="submit" name="submitpft" value="{'Submit'|@translate}">
    <input class="submit" type="reset" name="reset" value="{'Reset'|@translate}">
  </p>
  	</form>
{/if}

{if isset ($gestB)}
	<div class="comment">
		<h3>{'pft_css'|@translate}</h3>
			{'pft_css_help'|@translate}
	</div>
	<br>
	<div class="comment">
		<h3>{'pft_ED'|@translate}</h3>
			{'pft_ED_help'|@translate}
	</div>
{/if}
</div>