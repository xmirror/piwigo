<?php
{* BEGIN of themeconf.inc.tpl
  
  ************** Warning **************
  This is not a real php but a real template.
  Do NOT change any line/character below without a strong Team advice.
   
*}
$themeconf = array(
  'template' => '{$main.newtpl}',
  'theme' => '{$main.newtheme}',
  'template_dir' => 'template/{$main.newtpl}',
  'icon_dir' => 'template/{$main.newtpl}/icon',
  'admin_icon_dir' => 'template/{$main.newtpl}/icon/admin',
  'mime_icon_dir' => 'template/{$main.newtpl}/icon/mimetypes/',
  'local_head' => '<!-- coming soon -->',
);
if ( !isset($lang['Theme: {$main.newtheme}']) )

  /* LocalFiles Editor can help you for translation in local.lang.php
     After next "=", following text could be translated.
     4 lines below could copied in local.lang.php for local translation */ 
  {* 
      Not these ones but those produced by  "Swift Theme Creator" 
  *}
  
  $lang['Theme: {$main.newtheme}'] = 
  'Current page are displayed via {$main.newtheme} theme based on ' .
  '{$main.newtpl} template, a theme generated by the ' . 
  '"Swift Theme Creator" plugin.';
  
{* END of themeconf.inc.tpl.php *}
?>