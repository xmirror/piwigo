<?php

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

$block['CONTENT'] = $datas;

// Extended description
if (function_exists('get_extended_desc'))
{
  $block['CONTENT'] = get_extended_desc($block['CONTENT']);
}
else
{
  $block['CONTENT'] = get_user_language_desc($block['CONTENT']);
}

$block['TEMPLATE'] = 'stuffs_personal.tpl';

?>