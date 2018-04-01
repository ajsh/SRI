<?php
$path = getenv("HTTP_SERVER_PATH");

	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/session.php';
	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/globals.php';
	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/database/db.php';


	$thisPage = basename(__FILE__, '.php');
	if($_SESSION['page']!== $thisPage){
		$_SESSION['page'] = $thisPage;
		header("Location:/");
	}else{
		$html = "<table id='profileLayout'>

	        <tr>
	        	<h2>Current Projects</h2>";
	            $html .= selectProject();
	        $html .= "</tr>

	        <tr>";
	            $html .= displayAddNew();
	        $html .= "</tr>

	        <tr>";
	            $html .= displaySelected();
	        $html .= "</tr>";


			// echo "<tr>";
			// echo "<h2>My Current Invoices</h2>";
			// echo displayInvoices();
			// echo "</tr>";

		$html .= "</table>";
		echo $html;
	}

	function selectProject(){
	    $projects = getProjects($_SESSION['userID']);
		//Project Selection
	    $html = "<table>";
	    $html .="<tr><td>
	        	<label>Your Projects: </label>
	        	<select id='projects'  onchange=load_project(this.value,0)>
	        	<option disabled selected>Choose Project</option>";

		    	if(is_array($projects)){
			        foreach($projects as $item){
			            $html .= "<option value=".$item['projectID'].">".$item['name']."</option>";
			        }
		    	}

	    $html .="</select>
	    	<button class='wd-Button--success' onclick=load_add_new('p') style='margin: 15px' id='probut'><b>+</b></button></td>";
		
		//Test Selection

	    $html.="<td>
	    	<label>Your Tests: </label>
	    	<select id='tests'   onchange=load_test(this.value)>
	    		<option disabled selected>Select Project</option>
	    	</select>
	    	
	    	<button class='wd-Button--success' onclick=load_add_new('t') style='margin: 15px' id='testbut'><b>+</b></button></td>";
		
		//Cart Selection
	    $html.="<td>
	    	<label>Your Carts: </label>
	    	<select  id='carts'  onchange=load_cart(this.value)>
	    		<option disabled selected>Select Test</option>
	    	</select>
	  		<button class='wd-Button--success' onclick=load_add_new('c') style='margin: 15px' id='cartbut'><b>+</b></button></td></tr>

	   	</table>";

	    $html .= "
			<button class='wd-Button--primary' onclick=load_selected_project() name='search' value='Search'>Find Project</button></tr>
		
				";
	    return $html;
	}

	function displayAddNew(){
		return '<div id="add_to_workload"></div>';
	}

	function displaySelected(){
		return '<div id="selected_project"></div>';
	}

	//Support and Display Functions
	function displayInvoices(){
		$invoices = getAllInvoicesByUserID($_SESSION['userID']);

		$html = "<table id='invoiceData'>";

		if(is_array($invoices)){
			for($i = 0; $i < sizeof($invoices[0]); $i++){
				$html .= "<tr><th>Invoice Number: ".$invoices[0][$i]."</th></tr>";
				$html .= "<tr><th>Name</th><th>Price</th></tr>";

				if(is_array($invoices[1][$i])){

					$invoiceData = getInvoiceData($invoices[1][$i]);

					foreach($invoiceData as $row){
						$html .= "<tr>";
						if(is_array($row)){
							foreach($row as $col){
								$html .= "<td>";
								$html .= $col;
								$html .= "</td>";
							}
						}
					  	$html .= "</tr>";
					}
				}	
			}
		}
		$html .= "</table>";
		return $html;
	}
?>