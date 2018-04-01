<?php
	//User Functions
	function isAdmin($username){
		return getData("admin","users",array("username",$username),"users")[0]['admin'];
	}

	function setSessionID($userID){
		$store = md5($userID+date("mdyhis"));
		modifyData("sessionID","users",$store,array("userID",$userID),$GLOBALS['maindb']);
		return $store;
		}

	function getSessionID($userID){
		$i = getData('sessionID','users',array('userID',$userID),$GLOBALS['maindb']);
		if($i != NULL) return $i[0]['sessionID'];
		return -1;
	}


	//Base Functions
	function insertData($what,$to,$values,$database){
	    // $what = sql_sanitize($what);
	    // $to = sql_sanitize($to);
	    // $values = sql_sanitize($values);
	    // $database = sql_sanitize($database);

		$conn = loginDB($database);
		$sql = "INSERT INTO " . $to . " ("; 

		if(is_array($what)){
			$len = count($what);
			for($i = 0; $i < $len; $i++){
				$sql .= $what[$i];
				if($i < $len-1){
					$sql .= ", ";
				}
			}
		}else $sql .= $what;

		$sql .= ") VALUES (";

		if(is_array($values)){
			$len = count($values);
			for($i = 0; $i < $len; $i++){
				if(is_string($values[$i])){
					$sql .= "'".$values[$i]."'";
				}else{
					$sql .= $values[$i];
				}

				if($i < $len-1){
					$sql .= ", ";
				}
			}
		}else{
			if(is_string($values)){
				$sql .= "'".$values."'";
			}else{
				$sql .= $values;
			}
		}

		$sql .= ")";

	    // echo $sql."<br>";

		if(!$result = $conn->query($sql)){
			die('There was an issue adding that peice of data.');
		}

		close($conn);
	}

	function modifyData($what,$to,$values,$where,$database){
	    // $what = sql_sanitize($what);
	    // $to = sql_sanitize($to);
	    // $values = sql_sanitize($values);
	    // $where = sql_sanitize($where);
	    // $database = sql_sanitize($database);

		$conn = loginDB($database);

		$sql = "UPDATE " . $to . " SET "; 

		if(is_array($what)){
			if(count($what)==count($values)){
				$len = count($what);
				$keys = array_keys($values);
				for($i = 0; $i < $len; $i++){
					$sql .= $what[$i]."=";

					if(is_string($values[$keys[$i]])){
						$sql .= "'".$values[$keys[$i]]."'";
					}else $sql .= $values[$keys[$i]];

					if($i < $len-1){
						$sql.=", ";
					}
				}
			}
		}else{
			if(!is_array($values)){
				$sql.= $what."=";
				if(is_string($values)){
					$sql.= "'".$values."'";
				}else{
					$sql.= $values;
				}
			}else{
				echo 'err: what != values';
				return;
			}
		}

		if(is_array($where)){
			$sql .= " WHERE ".$where[0]."=";
			if(is_string($where[1])){
				$sql .= "'".$where[1]."'";
			}else $sql .= $where[1];
		}

	    // echo $sql;
		$result = $conn->query($sql);
		close($conn);
	}

	function removeData($from,$where,$database){
	    // $from = sql_sanitize($from);
	    // $where = sql_sanitize($where);
	    // $database = sql_sanitize($database);

		$conn = loginDB($database);

		$sql = "DELETE FROM ".$from." ";

		if(is_array($where)){
			$sql .= " WHERE ".$where[0]."="."'".$where[1]."'";

			if(!$result = $conn->query($sql)){
				die('There was an issue removing that peice of data. [' . $conn->error . ']');
			}

		}
		close($conn);
	}

	function getData($what,$from,$where,$database){
	    // $what = sql_sanitize($what);
	    // $from = sql_sanitize($from);
	    // $where = sql_sanitize($where);
	    // $database = sql_sanitize($database);

		$conn = loginDB($database);
		$data = array();

		$sql = "SELECT ";

		if(is_array($what)){
			$len = count($what);
			for($i = 0; $i<$len; $i++){
				$sql .= $what[$i];
				if($i<$len-1){
					$sql .= ",";
				}
				$sql .= " ";
			}
		}else{
			$sql .= $what;
		}

		$sql .= " FROM ".$from;

		if(is_array($where)){
			$sql .= " WHERE ".$where[0]."="."'".$where[1]."'";

		}

		$result = $conn->query($sql);
		if ($result) {
			while($row = fetchData($result)) {
				$tmp = array();
				if(is_array($what)){
					foreach($what as $w){
						array_push($tmp,$row[$w]);
					}
					$tmp = array_combine($what,$tmp);
				}else{
					$wkey = array($what=>$row[$what]);
					$tmp = array_merge($tmp,$wkey);
				}

				array_push($data,$tmp);
			}
		} else {
			return NULL;
		}
		close($conn);
		return $data;
	}

	function loginDB($database){
		$conn = new PDO('sqlite:'.'data/database/'.$database.'.db');
		return $conn;
	}

	function fetchData($result){
		return $result->fetch(PDO::FETCH_BOTH);
	}

	function close($db){
		$db = NULL;
	}
?>