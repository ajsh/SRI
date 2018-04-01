<?php
	if(session_status() != PHP_SESSION_ACTIVE){
		session_start();
	}
	
	if(!isset($_SESSION['page'])){
		$_SESSION['page'] = "home";
	}

	if(!isset($_SESSION['authed'])){
		$_SESSION['authed'] = "";
	}
?>