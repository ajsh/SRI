<?php
require_once 'parts/head.php';
require_once 'parts/body.php';

function printPage($page){
	echo '<!DOCTYPE html><html>';
	printHead($page);
	printBody($page);
	echo '</html>';
}
?>