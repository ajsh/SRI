<?php
$path = getenv("HTTP_SERVER_PATH");
require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/session.php';
require_once $_SERVER["DOCUMENT_ROOT"].$path.'/util/functions.php';
require_once $_SERVER["DOCUMENT_ROOT"].$path.'/security/auth.php';
require_once $_SERVER["DOCUMENT_ROOT"].$path.'/database/db.php';	

if(isset($_POST['add'])) {	//may remove
	if(isset($_POST['apassword'])){
		if(isAdmin($_SESSION['username'],$_POST['apassword'])){
						// Get username, password, and level from post
			$firstname 		= sql_sanitize($_POST['firstname']);
			$lastname		= sql_sanitize($_POST['lastname']);
			$username 		= sql_sanitize($_POST['username']);
			$password 		= sql_sanitize($_POST['password']);
			$department 	= sql_sanitize($_POST['department']);
			$contactEmail 	= sql_sanitize($_POST['contactEmail']);
			$ausername 		= $_SESSION['username'];

			date_default_timezone_set("America/Chicago");
			$addedOn 		= date("Y-m-d H:i:s");

			$where 			= array('username',$ausername);
			$data = getData("userID","users",$where,$GLOBALS['maindb']);
			$addedBy = $data[0]["userID"];

			$admin = 0;
			if(isset($_POST['admin'])) $admin = sql_sanitize($_POST['admin']);

			$finalPassword = password_hash($password, PASSWORD_DEFAULT);

			if($admin){
				$admin = 1;
			}
						// Add user to database and report
			$err = "The following field have not been filled in: [";
			$die = FALSE;
			if(strlen($firstname)<1){
				$err .= ' firstname ';
				$die = TRUE;
			}
			if(strlen($lastname)<1){
				$err .= ' lastname ';
				$die = TRUE;
			}
			if(strlen($username)<1){
				$err .= ' username ';
				$die = TRUE;
			}
			if(strlen($password)<1){
				$err .= ' password ';
				$die = TRUE;
			}
			if(strlen($department)<1){
				$err .= ' department ';
				$die = TRUE;
			}
			if(strlen($contactEmail)<1){
				$err .= ' contactEmail ';
				$die = TRUE;
			}
			if(strlen($ausername)<1){
				$err .= ' AdminUsername ';
				$die = TRUE;
			}
			if(strlen($die)) {
				$err .= '] || User NOT Added!';
				die($err);
			}

			$what = $GLOBALS['userFields'];
			$values = array($firstname,$lastname,$username,$finalPassword,$department,$contactEmail,$addedOn,$addedBy, $admin);
			insertData($what,"users",$values,$GLOBALS['maindb']);

			echo $username." added successfully.";
		}else{
			echo 'NOT VALID ADMIN AUTH';
		}
	}else{
		echo 'NO ADMIN AUTH';
	}
}

if(isset($_POST['remove'])){
	if(isset($_POST['apassword'])){
		if(isAdmin($_SESSION['username'],$_POST['apassword'])){
			if(!empty($_POST['username'])){
				echo "array";
				foreach($_POST['username'] as $u){
					removeUser($u);
				}
			}
		}else{
			echo 'NOT VALID ADMIN AUTH';
		}
	}else{
		echo 'NO ADMIN AUTH';
	}
}

function removeUser($username){
	$username = sql_sanitize($username);

	$err = "The following field have not been filled in: [";
	$die = FALSE;

	if(strlen($username)<1){
		$err .= ' username ';
		$die = TRUE;
	}
	if(strlen($die)) {
		$err .= '] || User NOT Added!';
		die($err);
	}

	$where = array("username",$username);
	removeData("users",$where,$GLOBALS['maindb']);

	echo $username." removed successfully.";
}

header("Location:/");
?>