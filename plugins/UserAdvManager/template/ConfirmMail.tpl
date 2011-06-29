{html_head}<link rel="stylesheet" type="text/css" href="template/confmail.css">{/html_head}

<div id="content" class="content">
  <div class="titrePage">
    <ul class="categoryActions">
      <li>
    {if $REDIRECT}
        <a href="{$ROOT_URL}identification.php" title="{'return to homepage'|@translate}">
          <img src="{$ROOT_URL}{$themeconf.icon_dir}/home.png" class="button" alt="{'home'|@translate}">
        </a>
    {else}
        <a href="{$GALLERY_URL}" title="{'return to homepage'|@translate}">
          <img src="{$ROOT_URL}{$themeconf.icon_dir}/home.png" class="button" alt="{'home'|@translate}">
        </a>
    {/if}
      </li>
    </ul>
    <h2 class="confmail">{'UAM_title_confirm_mail'|@translate}</h2>
  </div>
  <ul>
  {if $STATUS == true}
    <div class="infos">{$CONFIRM_MAIL_MESSAGE}</div>
  {elseif $STATUS == false}
    <div class="errors">{$CONFIRM_MAIL_MESSAGE}</div>
  {/if}
  </ul>
</div>