<div class="titrePage">
  <h2>Captcha</h2>
</div>

<form method="post" class="properties">
<fieldset>
  <legend>{'Captcha Configuration'|@translate}</legend>
  <ul>
  
  <li>
  <label>
    {'Public Key'|@translate}:
    <input type="text" size="52" name="captcha_publickey" value="{$CAPTCHA_PUBLICKEY}" />
  </label>
  </li>
  <li>
  <label>
    {'Private Key'|@translate}:
    <input type="text" size="52" name="captcha_privatekey" value="{$CAPTCHA_PRIVATEKEY}" />
  </label>
  </li>
  <li>
  <label>
    {'Interface theme'|@translate}:
    {html_options name=captcha_theme values=$captcha_theme_options output=$captcha_theme_options selected=$captcha_theme_selected}
  </label>
  </li>
  <li>
    <br/><a href="{$reCAPTCHA_URL}" target="_blank">{'Signup for personal usage keys'|@translate}</a>
  </li>

  <p class="bottomButtons">
    <input class="submit" type="submit" value="{'Submit'|@translate}" name="submit" {$TAG_INPUT_ENABLED}/>
  </p>
</fieldset>
</form>