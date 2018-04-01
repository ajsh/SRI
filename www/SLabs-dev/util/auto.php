<?php
	$path = getenv("HTTP_SERVER_PATH");

	require_once $_SERVER['DOCUMENT_ROOT'].$path."/database/db.php";
	require_once $_SERVER['DOCUMENT_ROOT'].$path."/init/globals.php";
	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/pages/parts/data/invoice.php';

	date_default_timezone_set('America/Chicago');

	$test_data = getData(array("testID","dateExpires","active"),"test_list","",$GLOBALS['testsdb']);
	$cart_data = getData(array("cartID","dateExpires","active"),"cart_list","",$GLOBALS['cartsdb']);
	$data = array();

	$userTrackPrefix = "usr_";

	//Cart Expiration
	foreach($cart_data as $cart){
		if($cart['active']){
			if((strtotime($cart['dateExpires'])-strtotime(date("M d, Y")))<=0) modifyData("active","cart_list",0,array("cartID",$cart['cartID']),$GLOBALS['cartsdb']);
		}
	}

	//Get Test Stuff
	for($i = 0; $i < count($test_data); $i++){
		$dataKeys = array_keys($data); 
		if(($test_data[$i]['dateExpires'] != NULL) && (date("M d, Y") == $test_data[$i]['dateExpires'])){

			$user = getUserFromTest($test_data[$i]['testID']);

			if(!in_array($userTrackPrefix.$user['userID'],$dataKeys)){
				$key  = $userTrackPrefix.$user['userID'];
				$add  = array($key=>array("user"=>$user,"data"=>array($test_data[$i]['testID'])));
				$data = array_merge($data, $add);
			}else{
				array_push($data[$userTrackPrefix.$user['userID']]['data'],$test_data[$i]['testID']);
			}
		}
	}

	var_dump($data);

	//do generate stuff here

?>