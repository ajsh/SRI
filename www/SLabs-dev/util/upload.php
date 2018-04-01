<?php
$path = getenv("HTTP_SERVER_PATH");

require_once $_SERVER["DOCUMENT_ROOT"].$path.'/database/db.php';
require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/globals.php';
require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/session.php';
require_once $_SERVER["DOCUMENT_ROOT"].$path.'/util/functions.php';	


$csv = array_map('str_getcsv', file($_FILES['file']['tmp_name']));


if(checkHeaders($csv[0],$GLOBALS['inventoryFields'])){
	// print2dArray($csv);
	array_splice($csv,0,1);
	// echo "<br>";
	// print2dArray($csv);

	$tmp;
	// printArray($GLOBALS['inventoryFields']);
	foreach($csv as $row){
		$tmp = $row;	

		array_push($tmp,getCurrentDate());
		array_push($tmp,getUserData("userID"));

		// printArray($tmp);
		
		insertData($GLOBALS['inventoryFields'],"inventory",$tmp,$GLOBALS['maindb']);
	}
}

//MAKE FULLY MODULAR SO THAT WHEN THE HEADERS ARE CHECKED THEY COULD BE IN ANY ORDER
//AND THEN HAVE IT REORDER THE DATA FOR THE CORRECT INPUT (either in insert statement or variable wise)

function checkHeaders($data,$against){
	for($i = 0; $i<sizeof($data)-2;$i++){
		if($data[$i]!==$against[$i]) return FALSE;
	}
	return TRUE;
}

function print2dArray($arr){
	foreach($arr as $row){
		foreach($row as $col){
			echo $col . " ";
		}
		echo "<br>";
	}
}

function printArray($arr){
	foreach($arr as $col){
			echo $col . " ";
		}
	echo "<br>";
}
header("Location:/");
?>