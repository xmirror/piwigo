
<p>{'This plugin verifies if your comments are spam using the <a href="http://www.akismet.com" target="_blank">akismet online service'|@translate}</a>.</p>

<p>{'Akismet has caught'|@translate} <b>{$AKISMET_SPAM_COMMENTS} {'spam comments'|@translate}</b> {'out of'|@translate} {$AKISMET_CHECKED_COMMENTS} {'comments'|@translate} (<a href="{$AKISMET_RESET_STATS_URL}">{'reset counters'|@translate}</a>).
{if ! empty($AKISMET_API_KEY)}
{'More statistics on'|@translate} <a href="http://{$AKISMET_API_KEY}.web.akismet.com/1.0/user-stats.php?blog={$AKISMET_BLOG_URL|@escape:url}" target="_new">{'akismet site'|@translate}</a>.
{/if}
</p>
<form method="post" class="properties">
<fieldset>
  <legend>{'Akismet configuration'|@translate}</legend>
  <ul>
  
  <li>
  <label>
    {'Akismet API Key:'|@translate}
    <input type="text" size="48" name="akismet_api_key" value="{$AKISMET_API_KEY}" />
  </label>
    <br/>{'Signup for a personal usage key here:'|@translate} <a href="http://akismet.com/personal/" target="_blank">http://akismet.com/personal/</a>.
  </li>
  
  <br/>

  <li>
  <label>
    {'Action when spam is detected:'|@translate}
    <select name="akismet_spam_action">
    	{html_options values='moderate,reject'|@explode output='moderate,reject'|@explode selected=$AKISMET_SPAM_ACTION }
    </select>
  </label>
  </li>

  <p class="bottomButtons">
    <input class="submit" type="submit" value="{'Submit'|@translate}" name="submit" {$TAG_INPUT_ENABLED}/>
  </p>
</fieldset>
</form>
<p><a href="{$AKISMET_TEST_URL}">{'Test your configuration'|@translate}</a>.</p>