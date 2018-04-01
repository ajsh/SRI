<?php
$path = getenv("HTTP_SERVER_PATH");

require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/session.php';
require_once $_SERVER["DOCUMENT_ROOT"].$path.'/util/functions.php';
require_once $_SERVER["DOCUMENT_ROOT"].$path.'/security/auth.php';
require_once $_SERVER["DOCUMENT_ROOT"].$path.'/database/db.php';

//PART ID IS 0 (SEQUENCIAL IN DB)

if(isset($_POST['add'])) {	//may remove
	if(isset($_POST['apassword'])){
		if(isAdmin($_SESSION['username'],$_POST['apassword'])){
						// Get username, password, and level from post
			$name 			= sql_sanitize($_POST['name']);
			$serialNum		= sql_sanitize($_POST['serialNum']);
			$storeLoc 		= sql_sanitize($_POST['storeLoc']);
			$priceDay 		= sql_sanitize($_POST['priceDay']);
			$ausername 		= $_SESSION['username'];

			date_default_timezone_set("America/Chicago");
			$addedOn 		= date("Y-m-d H:i:s");

			$where 			= array('username',$ausername);
			$data = getData("userID","users",$where,$GLOBALS['maindb']);
			$addedBy = $data[0]["userID"];

			$capacity = 0;
			if(isset($_POST['capacity'])) $capacity = sql_sanitize($_POST['capacity']);

			if($capacity){
				$capacity = 1;
			}

			$err = "The following field have not been filled in: [";
			$die = FALSE;
			if(strlen($name)<1){
				$err .= ' name ';
				$die = TRUE;
			}
			if(strlen($serialNum)<1){
				$err .= ' serialNum ';
				$die = TRUE;
			}
			if(strlen($storeLoc)<1){
				$err .= ' storeLoc ';
				$die = TRUE;
			}
			if(strlen($priceDay)<1){
				$err .= ' priceDay ';
				$die = TRUE;
			}
			if(strlen($die)) {
				$err .= '] || User NOT Added!';
				die($err);
			}

			$what = $GLOBALS['inventoryFields'];
			$values = array($name,$serialNum,$storeLoc,$capacity,$priceDay,$addedOn,$addedBy);
			insertData($what,"inventory",$values,$GLOBALS['maindb']);

			echo $name." [".$serialNum."]"." added successfully.";
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
						// Get username, password, and level from post
			$serialNum = sql_sanitize($_POST['serialNum']);

						// Add user to database and report
			$err = "The following field have not been filled in: [";
			$die = FALSE;

			if(strlen($serialNum)<1){
				$err .= ' serialNum ';
				$die = TRUE;
			}
			if(strlen($die)) {
				$err .= '] || User NOT Added!';
				die($err);
			}

			$where = array("serialNum",$serialNum);
			removeData("inventory",$where,$GLOBALS['maindb']);

			echo $serialNum." removed successfully.";
		}else{
			echo 'NOT VALID ADMIN AUTH';
		}
	}else{
		echo 'NO ADMIN AUTH';
	}
}

header("Location:/");
?>