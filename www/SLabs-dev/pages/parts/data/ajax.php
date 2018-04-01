<?php
$path = getenv("HTTP_SERVER_PATH");

	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/session.php';
	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/globals.php';
	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/database/db.php';
	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/util/machine_tools.php';

	date_default_timezone_set('America/Chicago');


	if(isset($_POST['project_id'])){
		$state  = $_POST['project_id'];
		$find	= getTest($state);

		$html = "<option disabled selected>Choose Test</option>";

		foreach($find as $row)
		{	
		    $html .= "<option data-tokens=".$row['name']." value=".$row['testID'].">".$row['name']."</option>";
		}
		echo $html;
		exit;
	}

	if(isset($_POST['test_id'])){
		$state = $_POST['test_id'];
		$find= getCartID($state);

		$html = "<option disabled selected>Choose Cart</option>";

		foreach($find as $row)
		{
		$html .= "<option data-tokens=".$row['name']." value=".$row['cartID'].">".$row['name']."</option>";
		}
		echo $html;
		exit;
	}

	if(isset($_POST['add_new_form'])){
		$issues = array();
		$post = $_POST['add_new_form'];

		$mode = 0;
		if($post['type']=='t') $mode = 1;
		if($post['type']=='c') $mode = 2;

		$html = '<h3>Add New</h3>
			<form method = "post" id="addProjectForm" action = "'.$path.'/pages/parts/data/ajax.php">
				<input value="'.$mode.'" name="mode" hidden>
			';

		$project_details = '<input name="projectName" type="text" onkeyup="check_project_name(this.value,0,this.id)" id="projectName" required>';

		$test_details 	 = '<input name="testName" type="text" onkeyup="check_project_name(this.value,1,this.id)" id="testName" required>';

			if($post['type']=='t'||$post['type']=='c'){
				if($post['project']!=NULL){
					$project_details = '
						<input name="projectName" value="'.$post['project'].'" hidden>
						<input value="'.getProjectName($post['project']).'" disabled>
					';
				}else array_push($issues,"Project");
			}

			if($post['type']=='c'){
				if($post['test']!=NULL){
					$test_details = '
						<input name="testName" value="'.$post['test'].'" hidden>
						<input value="'.getTestName($post['test']).'" disabled>
					';
				}else array_push($issues,"Test");
			}
			
			if(count($issues)){
				$html = "
					<h3>Hmmm.. Something's Off</h3>
					<p>Please make sure you have selected a valid [";
				
				for($i = 0; $i < count($issues);$i++){
					$html .= $issues[$i];
					if($i<count($issues)-1) $html.= ", ";
				}

				$html .= "].</p>";
			}else{
				$html .='
				<table style="width:75%" border="0" cellspacing="1">
					<th>
						<td>Name</td>
						<td>Time</td>
					</th>
					<tr>
						<td>Project Name</td>
						<td>'.$project_details.' <p id="warning_projectName"></p></td>'.
						(($post['type'] == 'p') ? '<td><input type="number" name="project_duration" style="width:50px" min=1 value=1> Months </td>' : "<td>Expires: ".getProjectExpire($post['project'])."</td>").'
					</tr>
					<tr>
						<td>Test Name</td>
						<td>'.$test_details.'<p id="warning_testName"></p></td>
						<td><p>Invoice is generated every '.(($GLOBALS['invoiceLength']>1)?($GLOBALS['invoiceLength'].' months'):"month.").' <br>(From when first created)</p></td>
					</tr>
					<tr>
						<td>Cart Name</td>
						<td><input name="cartName" onkeyup="check_project_name(this.value,2,this.id)" type="text" id="cartName" required><p id="warning_cartName"></p></td>
						<td>Cart will become un-changable '.(($GLOBALS['cartLength']>1)?($GLOBALS['cartLength'].' weeks'):($GLOBALS['cartLength']." week")).' after its creation. After this point, it will be included in the invoice in the event of a cancelation or auto invoice generation.
					</tr>
					<tr>
						<td>
							<button id="add_new" name="add_project" form="addProjectForm" type="submit" id="add">Add</button>
						</td>
					</tr>
				</table>';
				
				$html .= '</form>
					<button onclick=clear_element(\'add_to_workload\') class="wd-button--primary">Close</button>';
			}
		echo $html;
		exit;
	}

	if(isset($_POST['checkNewData'])){
		$post = $_POST['checkNewData'];

		$names = array();

		if(is_array($projects = getProjects($_SESSION['userID']))){
			foreach($projects as $project){
				array_push($names,str_replace(' ', '',strtolower($project['name'])));
				if(is_array($tests = getTest($project['projectID']))){
					foreach($tests as $test){
						array_push($names,str_replace(' ', '',strtolower($test['name'])));
						if(is_array($carts = getCarts($test['testID']))){
							foreach($carts as $cart){
								array_push($names, str_replace(' ', '',strtolower($cart['name'])));
							}
						}
					}
				}
			}
		}
		if(in_array(str_replace(' ', '',strtolower($post['name'])), $names)){
			if(!$post['type']) echo "Project Name Exists..";

			else if ($post['type'] == 1) echo "Test Name Exists..";

			else if ($post['type'] == 2) echo "Cart Name Exists..";
			
		}

		exit;
	}

	if(isset($_POST['add_project'])){
		$project 		  = $projectID = $_POST['projectName'];
		$test 	 		  = $testID 	 = $_POST['testName'];
		$cart 	 		  = $_POST['cartName'];

		$date 	 = date("M d, Y");

		$timeString = "+".$_POST['project_duration']." month";
		$project_duration = date('M d, Y', strtotime(date("M d, Y", strtotime($date)).$timeString));
		
		$timeString = "+1 month";
		$test_duration = date('M d, Y', strtotime(date("M d, Y", strtotime($date)).$timeString));

		$timeString = "+1 week";		
		$cart_duration = date('M d, Y', strtotime(date("M d, Y", strtotime($date)).$timeString));

		
		$ui 	 = $_SESSION['userID'];

		if($_POST['mode']==0){
			$projectID  = getMaxID('projectID','project_list',$GLOBALS['projectsdb'])+1;
		}
		if($_POST['mode']==0||$_POST['mode']==1){
			$testID   = getMaxID('testID','test_list',$GLOBALS['testsdb'])+1;
			echo $testID;
		}

		$data = array(
			'project'=>array(
				'what'=>array("name","userID","dateCreated","date_expires"),
				'values'=>array($project,$ui,$date,$project_duration),
				'to'=>"project_list",
				'db'=>$GLOBALS['projectsdb']
				),
			'test'=>array(
				'what'=>array("name","projectID","dateCreated","dateExpires"),
				'values'=>array($test,$projectID,$date,$test_duration),
				'to'=>"test_list",
				'db'=>$GLOBALS['testsdb']
				),
			'cart'=>array(
				'what'=>array("name","testID","dateCreated","dateExpires"),
				'values'=>array($cart,$testID,$date,$cart_duration),
				'to'=>"cart_list",
				'db'=>$GLOBALS['cartsdb']
				)
			);

		$cartID = getMaxID('cartID','cart_list',$GLOBALS['cartsdb'])+1;

		if($_POST['mode'] == 0){
			insertData($data['project']['what'],$data['project']['to'],$data['project']['values'],$data['project']['db']);
			
			insertData($data['test']['what'],$data['test']['to'],$data['test']['values'],$data['test']['db']);

			insertData($data['cart']['what'],$data['cart']['to'],$data['cart']['values'],$data['cart']['db']);
		}

		if($_POST['mode'] == 1){
			insertData($data['test']['what'],$data['test']['to'],$data['test']['values'],$data['test']['db']);

			insertData($data['cart']['what'],$data['cart']['to'],$data['cart']['values'],$data['cart']['db']);
		}

		if($_POST['mode'] == 2){
			insertData($data['cart']['what'],$data['cart']['to'],$data['cart']['values'],$data['cart']['db']);
		}
		
		$what = array("instrumentID","usage_count","usage_time","in_use","last_start_time");
		$types = array("integer","INTEGER DEFAULT 1","TEXT DEFAULT '0 days:0 hours:0 minutes:0 seconds'","INTEGER DEFAULT 0","TEXT");

		makeTable(($GLOBALS['cartTablePrefix'].$cartID),$what,$types,$GLOBALS['cartsdb']);
	}

	if(isset($_POST['show_project'])){
		$post 		= $_POST['show_project'];
		$project 	= $post['project'];
		$test 	 	= $post['test'];
		$cart 	 	= $post['cart'];	

		$html  = "<table><tr>";

		$html .= "<td><h2><strong>Project: </strong>".getProjectName($project)."</h2></td>";
		$html .= "<td><h2><strong>Test: </strong>".getTestName($test)."</h2></td>";
		$html .= "<td><h2><strong>Cart: </strong>".getCartName($cart)."</h2></td></tr>";
		$html .= "</table>";

		$html .= "<h4><strong>Instruments in ".getCartName($cart)."</strong></h4>
				  <table style='width:50%'>";

		$cart = getCart($cart);
		$html .= "<tr><th>Name</th><th>Usage</th></tr>";
		foreach($cart as $instrument){
			$html .= "<tr><td>".getInstrumentName($instrument['instrumentID'])."</td><td>";
			if(getInstrument($instrument['instrumentID'])['type']==0) $html .= ($instrument['usage_count']>1)?($instrument['usage_count']." Units"):($instrument['usage_count']." Unit");
			else {
				$time = explode(':',$instrument['usage_time']);
				$time_parts = array();
				foreach($time as $part){
					$split = explode(' ', $part);
					$time_parts = array_merge($time_parts,array($split[1]=>$split[0]));
				}

				$other = false;
				if($time_parts['days']>0){
					$html .= ($time_parts['days']==1)?(" ".$time_parts['days']." day "):(" ".$time_parts['days']." days ");
					$other = true;
				}
				if($time_parts['hours']>0){
					$html .= ($time_parts['hours']==1)?(" ".$time_parts['hours']." hour "):(" ".$time_parts['hours']." hours ");
					$other = true;
				}
				if($time_parts['minutes']>0||!$other){
					$html .= ($time_parts['minutes']==1)?(" ".$time_parts['minutes']." minute "):(" ".$time_parts['minutes']." minutes ");
				}
				if($time_parts['seconds']>0){
					$html .= ($time_parts['seconds']==1)?(" ".$time_parts['seconds']." second "):(" ".$time_parts['seconds']." seconds ");
				}
			}
			$html .= "</td></tr>";
		}

		$html .= "</table>";
		

		$html .= "<button onclick=clear_element('selected_project') class='wd-button--primary'>Close</button>";

		echo $html;
		exit;
	}

	if(isset($_POST['add_instrument'])){
		$post = $_POST['add_instrument'];

		$where = array("instrumentID",$post['instrumentID']);
		if(getData("instrumentID",($GLOBALS['cartTablePrefix'].$post['cartID']),$where,$GLOBALS['cartsdb']) == NULL){
			$what = array("instrumentID","usage_count");
			$values = array($post['instrumentID'],$post['amount']);
			insertData($what,($GLOBALS['cartTablePrefix'].$post['cartID']),$values,$GLOBALS['cartsdb']);

			$instrument = getInstrument($post['instrumentID']);
			
			if(isset($instrument['count'])){
				modifyData("count","instruments",($instrument['count']-$post['amount']),$where,$GLOBALS['instrumentsdb']);
			}
			
		}
		exit;
	}

	if(isset($_POST['remove_instrument'])){
		$post = $_POST['remove_instrument'];
			
		$where = array("instrumentID",$post['instrumentID']);
		$instrument = getData("usage_count",("cart_".$post['cartID']),$where,$GLOBALS['cartsdb'])[0];

		$count = getInstrument($post['instrumentID'])['count'];
		$where = array("instrumentID",$post['instrumentID']);
		modifyData("count","instruments",($count+$instrument['usage_count']),$where,$GLOBALS['instrumentsdb']);

		
		removeData(($GLOBALS['cartTablePrefix'].$post['cartID']),$where,$GLOBALS['cartsdb']);

		exit;
	}
 
	if(isset($_POST['show_cart'])){
		
		$cart = getCart($_POST['show_cart']);

		$active = FALSE;
		$name = "";
			foreach(getAllCarts() as $c) 
				if($_POST['show_cart']==$c['cartID']){
					$active = $c['active'];
					$name = $c['name'];
				}

		$html = "
			<h2>Current Cart</h2>
			<p><strong>Cart Name:</strong> ".$name."</p>
			".((!$active)?("<p><b>Cart is finalized and un-changable.</b></p>"):(""))."
			<button id='refresh_cart' onclick=update_current_cart()>Refresh Cart</button>
			<table>
			<tr><th>Name</th><th>Usage</th>".(($active)?("<th>Cart</th>"):(""))."</tr>
			";
		foreach($cart as $inst){
			
			$html .= "<tr><td>".getInstrumentName($inst['instrumentID'])."</td><td>[";
			$where = array("instrumentID",$inst['instrumentID']);
			if(getInstrument($inst['instrumentID'])['type']==0){
				$amount = getData("usage_count",("cart_".$_POST['show_cart']),$where,$GLOBALS['cartsdb'])[0]['usage_count'];
				$html .= ($amount == 1)?(" ".$amount." Unit "):(" ".$amount." Units ");
			}else{
				$time = getData("usage_time",("cart_".$_POST['show_cart']),$where,$GLOBALS['cartsdb'])[0]['usage_time'];
				$time = explode(':',$time);
				$time_parts = array();
				foreach($time as $part){
					$split = explode(' ', $part);
					$time_parts = array_merge($time_parts,array($split[1]=>$split[0]));
				}

				$other = false;
				if($time_parts['days']>0){
					$html .= ($time_parts['days']==1)?(" ".$time_parts['days']." day "):(" ".$time_parts['days']." days ");
					$other = true;
				}
				if($time_parts['hours']>0){
					$html .= ($time_parts['hours']==1)?(" ".$time_parts['hours']." hour "):(" ".$time_parts['hours']." hours ");
					$other = true;
				}
				if($time_parts['minutes']>0||!$other){
					$html .= ($time_parts['minutes']==1)?(" ".$time_parts['minutes']." minute "):(" ".$time_parts['minutes']." minutes ");
				}
				if($time_parts['seconds']>0){
					$html .= ($time_parts['seconds']==1)?(" ".$time_parts['seconds']." second "):(" ".$time_parts['seconds']." seconds ");
				}
			}

			$html .= "]</td>";
			if($active) $html .= "<td><button onclick=remove_instrument(".$inst['instrumentID'].")>Remove</button></td>";
			$html .= "</tr>";
		}

		echo $html."</table>";
		exit;
	}

	if(isset($_POST['display_cart_lab'])){
		
		$cartName = getCartName($_POST['display_cart_lab']['cartID']);
		$cart = getCart($_POST['display_cart_lab']['cartID']);

		$html = "
			<h2>Selected Cart</h2>
			<p><strong>Cart Name:</strong> ".$cartName."</p>
			<button id='refresh_cart' onclick=get_cart(".$_POST['display_cart_lab']['cartID'].")>Refresh Cart</button>
			<table style='min-width:65%;max-width:80%'>
			<tr><th>Name</th><th>Usage</th><th>Functionality</th></tr>
			";
		foreach($cart as $inst){
			$html .= "<tr><td>".getInstrumentName($inst['instrumentID'])."</td><td>(";
			$where = array("instrumentID",$inst['instrumentID']);
			if(getInstrument($inst['instrumentID'])['type']==0){
				$amount = getData("usage_count",("cart_".$_POST['display_cart_lab']['cartID']),$where,$GLOBALS['cartsdb'])[0]['usage_count'];
				$html .= ($amount == 1)?(" ".$amount." Unit "):(" ".$amount." Units ");
			}else{
				$time = getData("usage_time",("cart_".$_POST['display_cart_lab']['cartID']),$where,$GLOBALS['cartsdb'])[0]['usage_time'];
				$time = explode(':',$time);
				$time_parts = array();
				foreach($time as $part){
					$split = explode(' ', $part);
					$time_parts = array_merge($time_parts,array($split[1]=>$split[0]));
				}
				$other = false;
				if($time_parts['days']>0){
					$html .= ($time_parts['days']==1)?(" ".$time_parts['days']." day "):(" ".$time_parts['days']." days ");
					$other = true;
				}
				if($time_parts['hours']>0){
					$html .= ($time_parts['hours']==1)?(" ".$time_parts['hours']." hour "):(" ".$time_parts['hours']." hours ");
					$other = true;
				}
				if($time_parts['minutes']>0||!$other){
					$html .= ($time_parts['minutes']==1)?(" ".$time_parts['minutes']." minute "):(" ".$time_parts['minutes']." minutes ");
				}
				if($time_parts['seconds']>0){
					$html .= ($time_parts['seconds']==1)?(" ".$time_parts['seconds']." second "):(" ".$time_parts['seconds']." seconds ");
				}
			}

			$html .= ")</td>";

			$i = getInstrument($inst['instrumentID']);
			if($i['type']==1){
				$html .= "<td><button style='min-width:60px' id='toggle_switch_".$inst['instrumentID'].
				"' onclick=toggle_instrument_use(".$_POST['display_cart_lab']['cartID'].','.$inst['instrumentID'].")".
				(!($i['connection'])?(" disabled"):(($i['in_use']==1)?(($inst['in_use']==0)?(" disabled"):("")):(""))).">".
				(!($i['connection'])?("Error"): (($i['in_use']==1)?(($inst['in_use']==1)?("Stop"):("In Use")):(($inst['in_use']==0)?("Start"):("Stop"))))."</button> ".
				(($inst['in_use']==1)?(" <b>[Running]</b> "):("")).
				((!$i['connection'])?("Please contact supervisor to resolve problem."):(($i['in_use']==1)?(($inst['in_use']==1)?("Click to enable/disable tool and start/stop timer."):("Please wait for other user to finish.")):("Click to enable/disable tool and start/stop timer.")))."</td>";
								
			}
			
			$html .= "</tr>";
		}

		echo $html."</table>";
		exit;
	}

	if(isset($_POST['toggle_instrument'])){
		$cart = getCart($_POST['toggle_instrument']['cartID']);
		
		foreach($cart as $inst){
			if($_POST['toggle_instrument']['instrumentID']==$inst['instrumentID']){
				$i = getInstrument($inst['instrumentID']);
				if($i['connection']){
					if($i['in_use']==1&&$inst['in_use']==0) break;
					if($inst['in_use']==1){
						$elapsed_use = date_diff(date_create(date("M d, Y H:i:s")),date_create($inst['last_start_time']));
						
						$time = $elapsed_use->format("%d days:%h hours:%i minutes:%s seconds");
						$time = explode(':',$time);
						$time_parts_new = array();
						foreach($time as $part){
							$split = explode(' ', $part);
							$time_parts_new = array_merge($time_parts_new,array($split[1]=>$split[0]));
						}

						$stored_time = $inst['usage_time'];
						$stored_time = explode(':',$stored_time);
						$time_parts_old = array();
						foreach($stored_time as $part){
							$split = explode(' ', $part);
							$time_parts_old = array_merge($time_parts_old,array($split[1]=>$split[0]));
						}
						
						$old_keys = array_keys($time_parts_old);
						$new_keys = array_keys($time_parts_new);


						for($i = count($new_keys)-1; $i >= 0; $i--){
							if($old_keys[$i]==$new_keys[$i]){
								$time_parts_old[$old_keys[$i]] = $time_parts_old[$old_keys[$i]]+$time_parts_new[$new_keys[$i]];
							}
						}

						if($time_parts_old['seconds']>59){
							$time_parts_old['minutes'] += round($time_parts_old['seconds']/60);
							$time_parts_old['seconds'] = $time_parts_old['seconds']%60;
						}
						if($time_parts_old['minutes']>59){
							$time_parts_old['hours'] += round($time_parts_old['minutes']/60);
							$time_parts_old['minutes'] = $time_parts_old['minutes']%60;
						}
						if($time_parts_old['hours']>23){
							$time_parts_old['days'] += round($time_parts_old['hours']/24);
							$time_parts_old['hours'] = $time_parts_old['hours']%24;
						}


						$new_date = "";

						for($i = 0; $i < count($time_parts_old);$i++){
							$new_date .= $time_parts_old[$old_keys[$i]]." ".$old_keys[$i];
							if($i<count($time_parts_old)-1) $new_date .= ':';
						}

						if(check_machine_status($inst['instrumentID'])){
							if(send_data_to_machine(array('state'=>'0'),$inst['instrumentID'])){
								modifyData("usage_time",($GLOBALS['cartTablePrefix'].$_POST['toggle_instrument']['cartID']),$new_date,array('instrumentID',$_POST['toggle_instrument']['instrumentID']),$GLOBALS['cartsdb']);
								modifyData("in_use",($GLOBALS['cartTablePrefix'].$_POST['toggle_instrument']['cartID']),0,array('instrumentID',$_POST['toggle_instrument']['instrumentID']),$GLOBALS['cartsdb']);
								modifyData("in_use","instruments",0,array('instrumentID',$_POST['toggle_instrument']['instrumentID']),$GLOBALS['instrumentsdb']);
							}
						}else{
							modifyData("connection","instruments",0,array('instrumentID',$_POST['instrumentID']),$GLOBALS['instrumentsdb']);
						}
					}else if($inst['in_use']==0){
						if(check_machine_status($inst['instrumentID'])){
							if(send_data_to_machine(array('state'=>'1'),$inst['instrumentID'])){
								modifyData("last_start_time",($GLOBALS['cartTablePrefix'].$_POST['toggle_instrument']['cartID']),date("M d, Y H:i:s"),array('instrumentID',$_POST['toggle_instrument']['instrumentID']),$GLOBALS['cartsdb']);
								modifyData("in_use",($GLOBALS['cartTablePrefix'].$_POST['toggle_instrument']['cartID']),1,array('instrumentID',$_POST['toggle_instrument']['instrumentID']),$GLOBALS['cartsdb']);
								modifyData("in_use","instruments",1,array('instrumentID',$_POST['toggle_instrument']['instrumentID']),$GLOBALS['instrumentsdb']);

							}
						}else{
							modifyData("connection","instruments",0,array('instrumentID',$_POST['toggle_instrument']['instrumentID']),$GLOBALS['instrumentsdb']);
						}	
					}
				}else{
					echo "Connection Issue[ Name: " . $i['name']." ID: ".$inst['instrumentID']."]";
				}
				break;
			}
		}

		exit;
	}

	header("Location:/");
?>