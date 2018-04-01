<?php
$path = getenv("HTTP_SERVER_PATH");
	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/session.php';
	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/globals.php';
	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/database/db.php';
	
	if(isset($_POST['login'])){
		login();
	}else if(isset($_POST['logout'])){
		logout();
	}

	function login(){
		if((isset($_POST['username'])&&isset($_POST['password'])) && (!empty($_POST['username']) && !empty($_POST['password']))){

			$what = array("userID","firstname","lastname","password","admin");
			$where = array("username",$_POST['username']);
			$login = getData($what,"users",$where,$GLOBALS['maindb']);


			if(password_verify($_POST['password'],$login[0]['password'])){
				$_SESSION['authed'] = TRUE;
				if($login[0]['admin']) $_SESSION['admin'] = TRUE;
				
				$_SESSION['username'] 	= $_POST['username'];
				$_SESSION['userID']		= $login[0]["userID"];

				$_SESSION['firstname'] 	= $login[0]['firstname'];
				$_SESSION['lastname']	= $login[0]['lastname'];
				
				$_SESSION['timeIN'] = time();

				$_SESSION['authed'] = setSessionID($_SESSION['userID']);



				$_SESSION['page'] = "home";
				header("Location:/");
				return;
			}
		}
		logout();
	}

	function logout(){
		if(session_status() != PHP_SESSION_ACTIVE){
			session_start();
		}
		$_SESSION['authed'] = FALSE;
		session_unset(); 
		session_destroy();
		header("Location:/");

	}

	function isAdmin($user,$passwd){ //add user check
		if(strlen($user)>1){
			$what = array("username","password");
			$where = array("admin",1);
			$auth = getData($what,"users",$where,$GLOBALS['maindb']);

			foreach($auth as $p){
					if($p['username'] === $user){
						if(password_verify($passwd,$p['password'])){
						return TRUE;
					}
				}
			}
		}
		return FALSE;
	}


?>	