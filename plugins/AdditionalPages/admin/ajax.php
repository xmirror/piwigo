<?php

define('PHPWG_ROOT_PATH','../../../');
include_once(PHPWG_ROOT_PATH.'include/common.inc.php');

if (!isset($_POST['str'])) die;

echo trim(str2url($_POST['str']), '_');

?>