<?php
$path = getenv("HTTP_SERVER_PATH");
require_once $_SERVER["DOCUMENT_ROOT"].$path.'/database/db.php';	
require_once $_SERVER["DOCUMENT_ROOT"].$path.'/security/auth.php';	

function sql_sanitize($sCode) {
	$conn = loginDB($GLOBALS['maindb']);
	if ( function_exists( "mysqli_real_escape_string" )){ // If PHP version > 4.3.0
		if(is_array($sCode)){
			for($i = 0; $i < count($sCode); $i++){
				$sCode[$i] = mysqli_real_escape_string($conn, stripslashes($sCode[$i]));
			}
		}else $sCode = mysqli_real_escape_string($conn, stripslashes($sCode)); // Escape the MySQL string.
	} else { // If PHP version < 4.3.0
		if(is_array($sCode)){
			for($i = 0; $i < count($sCode); $i++){
				$sCode[$i] = $sCode = addslashes(stripslashes($sCode[$i])); 
			}
		}else $sCode = addslashes(stripslashes($sCode)); // Precede sensitive characters with a slash
	}
		return $sCode; // Return the sanitized code
	}

function getCurrentDate(){
	date_default_timezone_set("America/Chicago");
	return date("Y-m-d H:i:s");
}


function in_array_all($needle,$haystack){
	if(is_array($needle)){
		echo "needle: ";
		var_dump($needle);
		echo "<br>";
		foreach($haystack as $haybale){
			var_dump($haybale);
			echo "<br>";
			echo $needle==$haybale;
			if($needle===$haybale) return TRUE;
		}
	}else{
		return in_array($needle,$haystack);
	}

	return FALSE;
}

?>