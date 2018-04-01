<?php
$path = getenv("HTTP_SERVER_PATH");

require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/session.php';

	$thisPage = basename(__FILE__, '.php');
	if($_SESSION['page']!== $thisPage){
		$_SESSION['page'] = $thisPage;
		header("Location:/");
	}
?>