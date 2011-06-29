<?php

if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

function plugin_install()
{
    
	
	$query = 'INSERT INTO ' . CONFIG_TABLE . ' (param,value,comment) VALUES ("persoFooter","","html displayed on the footer page of your galler...");';
    pwg_query($query);

}

function plugin_uninstall()
{
	$q = 'DELETE FROM ' . CONFIG_TABLE . ' WHERE param="persoFooter" LIMIT 1;';
    pwg_query($q);
}


?>