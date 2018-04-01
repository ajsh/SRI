<?php 
$path = getenv("HTTP_SERVER_PATH");

	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/database/db.php';
	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/util/functions.php';

	if(isset($_POST['ip'])){
		print("~Got ".$_POST['ip'] . " Inst ID: " . $_POST['instrumentID']);
		assocMachine($_POST['ip'],$_POST['instrumentID']);
	}

	// send_data_to_machine(array('state'=>1),4);

	function send_data_to_machine($data,$instrumentID){
		$inst = getInstrument($instrumentID);
		
		// use key 'http' even if you send the request to https://...
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($data)
		    )
		);

		$url = $inst['address'];

		if(strlen($url)>0){

			if(check_machine_status($instrumentID)){
				$context  = stream_context_create($options);
				$result = @file_get_contents('http://'.$url, false, $context);
				return true;
			}else{
				return false;
			}

		}else return false;
		
	}

	function check_machine_status($instrumentID){
		exec("ping -n 1 ".getInstrument($instrumentID)['address'], $output, $status);
		if(!$status) return true;
		return false;
	}
?>