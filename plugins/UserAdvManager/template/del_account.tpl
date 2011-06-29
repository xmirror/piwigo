{html_head}<link rel="stylesheet" type="text/css" href="template/confmail.css">{/html_head}

<div id="content" class="content">
  <div class="titrePage">
    <ul class="categoryActions">
      <li>
        <a href="{$GALLERY_URL}" title="{'return to homepage'|@translate}">
          <img src="{$ROOT_URL}{$themeconf.icon_dir}/home.png" class="button" alt="{'home'|@translate}">
        </a>
      </li>
    </ul>
    <h2 class="confmail">{'UAM_title_redir_page'|@translate}</h2>
  </div>
  <ul>
    <div class="errors">{$CUSTOM_REDIR_MSG}</div>
  </ul>
</div>