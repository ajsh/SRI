<?php
$path = getenv("HTTP_SERVER_PATH");

require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/session.php';

logout();

function logout(){
	if(session_status() != PHP_SESSION_ACTIVE){
		session_start();
	}
	$_SESSION['authed'] = FALSE;
	session_unset(); 
	session_destroy();
	header("Location:/");

}
?>