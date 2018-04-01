<?php
if(!isset($GLOBALS['dbtype'])){
	$GLOBALS['dbtype'] = TRUE;
}

if(!isset($GLOBALS['invoiceLength'])){ //Months
	$GLOBALS['invoiceLength'] = 1;
}

if(!isset($GLOBALS['cartLength'])){  //Weeks
	$GLOBALS['cartLength'] = 1;
}


//Database Information
// NAME,SERVER,USERNAME,PASSWORD
$dbservername = "localhost";
$dbusername   = "slabs-user";
$dbpassword   = "eRbCRZIVHmpUig7X";


if(!isset($GLOBALS['maindb'])){
	$GLOBALS['maindb'] = array(
		"slabs",
		$dbservername,
		$dbusername,
		$dbpassword
	);
}

if(!isset($GLOBALS['projectsdb'])){
	$GLOBALS['projectsdb'] = array(
		"slabs_projects",
		$dbservername,
		$dbusername,
		$dbpassword
	);
}

if(!isset($GLOBALS['testsdb'])){
	$GLOBALS['testsdb'] = array(
		"slabs_tests",
		$dbservername,
		$dbusername,
		$dbpassword
	);
}

if(!isset($GLOBALS['cartsdb'])){
	$GLOBALS['cartsdb'] = array(
		"slabs_carts",
		$dbservername,
		$dbusername,
		$dbpassword
	);
}

if(!isset($GLOBALS['instrumentsdb'])){
	$GLOBALS['instrumentsdb'] = array(
		"slabs_instruments",
		$dbservername,
		$dbusername,
		$dbpassword
	);
}

if(!isset($GLOBALS['invoicedb'])){
	$GLOBALS['invoicedb'] = array(
		"slabs_invoices",
		$dbservername,
		$dbusername,
		$dbpassword
	);
}

if(!isset($GLOBALS['machinesdb'])){
	$GLOBALS['machinesdb'] = array(
		"slabs_machines",
		$dbservername,
		$dbusername,
		$dbpassword
	);
}


//Admin Restricted Pages
if(!isset($GLOBALS['adminPages'])){
	$GLOBALS['adminPages'] = array(
		"invoices",
		// "users",
		"inventory",
		// "history",
		"new user"
		);
}

//Regular User Pages
if(!isset($GLOBALS['pages'])){
	$GLOBALS['pages'] = array(
		"home",
		"my profile",
		"checkout",
		"lab"
	);
}

//All Pages
if(!isset($GLOBALS['allPages'])){
	$GLOBALS['allPages']=array_merge($GLOBALS['pages'],$GLOBALS['adminPages']);
}


//Fields for Certain Tables
if(!isset($GLOBALS['user_fields'])){
	$GLOBALS['user_fields'] = array(
		"firstname",
		"lastname",
		"username",
		"password",
		"department",
		"contact_email"
	);
}


if(!isset($GLOBALS['inventoryFields'])){
	$GLOBALS['inventoryFields'] = array(
		"name",
		"serialNum",
		"capacity",
		"priceDay",
		"addedOn",
		"addedBy"
		);
}

if(!isset($GLOBALS['projectTablePrefix'])) $GLOBALS['projectTablePrefix'] = "proj_";
if(!isset($GLOBALS['testTablePrefix'])) $GLOBALS['testTablePrefix'] = "test_";
if(!isset($GLOBALS['cartTablePrefix'])) $GLOBALS['cartTablePrefix'] = "cart_";



//Other Information
if(!isset($GLOBALS['departments'])){
	$GLOBALS['departments'] = array(
		"Civil Engineering",
		"Construction Engineering",
		"Environmental Engineering",
		"Computer Engineering",
		"Mechanical Engineering",
		"Chemical Engineering",
		"Aerospace Engineering",
		"Computer Science",
		);
}

if(!isset($GLOBALS['sessionTimeout'])){
	$GLOBALS['sessionTimeout'] = 600;
}
?>