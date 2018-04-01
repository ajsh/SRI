<?php
$path = getenv("HTTP_SERVER_PATH");

require_once $_SERVER["DOCUMENT_ROOT"].$path.'/database/db.php';
require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/session.php';


	$thisPage = basename(__FILE__, '.php');
	if($_SESSION['page']!== $thisPage){
		$_SESSION['page'] = $thisPage;
		header("Location:/");
	}else{

		$html = '<h2>Active Invoices</h2>';

		$html .= '
		<b>Invoice info will be listed here...</b>
		<div id="invoiceList"></div>
		';
		
		$invoices = getAllCurrentInvoices();

		$html .= '
		<br><br>
		<b>Users With Invoices Out...</b>
		<div id="invoiceUsers"> <table>';

		$usersDisplayed = array();

		if(is_array($invoices)){
			foreach($invoices as $invoice){
				if(!in_array($invoice['userID'],$usersDisplayed) && $invoice!=NULL){
					array_push($usersDisplayed,$invoice['userID']);
					$html .= "<tr><td><button name='userID' onclick='showInvoice(this.value)' value='".$invoice['userID']."'>".getFullNameOfUser($invoice['userID'])."</button></td></tr>";
				}
			}
		}

		$html .= '</table></div>';

		echo $html;
		// refreshInvoices();
		
	}
?>



