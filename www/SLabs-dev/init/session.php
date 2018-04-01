<?php
if(session_status() != PHP_SESSION_ACTIVE){
	session_start();
}

if(!isset($_SESSION['page'])){
	$_SESSION['page'] = "home";
}

//User Information
if(!isset($_SESSION['firstname'])){
	$_SESSION['firstname'] = NULL;
}

if(!isset($_SESSION['lastname'])){
	$_SESSION['lastname'] = NULL;
}

if(!isset($_SESSION['username'])){
	$_SESSION['username'] = NULL;
}

if(!isset($_SESSION['userID'])){
	$_SESSION['userID'] = NULL;
}

if(!isset($_SESSION['cartID'])){
	$_SESSION['cartID'] = NULL;
}




//Security Information
if(!isset($_SESSION['authed'])){
	$_SESSION['authed'] = FALSE;
}

if(!isset($_SESSION['admin'])){
	$_SESSION['admin'] = FALSE;
}

if(!isset($_SESSION['timeIN'])){
	$_SESSION['timeIN'] = 0;
}
?>