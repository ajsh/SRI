<?php
function getBody($page){
	page($page);
}

function page($pagename){
	$path = getenv("HTTP_SERVER_PATH");
	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/pages/parts/data/'.$pagename.'.php';
}

?>