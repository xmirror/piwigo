<div class="titrePage">
  <h2>{'ppa_h2'|@translate}</h2>
</div>
<div id="configContent">
{if isset ($gestA)}
	<form method="post" >
	 <fieldset id="mainConf">
			<span class="property">
				<label for="ppaperso">{'ppa_perso'|@translate}</label>
			</span>
			<textarea rows="5" cols="50" class="description" name="perso_about" id="perso_about">{$gestA.PPABASE}</textarea>
  <p>
    <input class="submit" type="submit" name="submitppa" value="{'Submit'|@translate}" {$TAG_INPUT_ENABLED}>
    <input class="submit" type="reset" name="reset" value="{'Reset'|@translate}">
  </p>
  	</form>
{/if}

{if isset ($gestB)}
	<div class="comment">
		<h3>{'ppa_css'|@translate}</h3>
			{'ppa_css_help'|@translate}
	</div>
	<br>
	<div class="comment">
		<h3>{'ppa_ED'|@translate}</h3>
			{'ppa_ED_help'|@translate}
	</div>
{/if}
</div>