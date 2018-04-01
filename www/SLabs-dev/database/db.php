<?php
$path = getenv("HTTP_SERVER_PATH");

require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/globals.php';
require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/session.php';
require_once $_SERVER["DOCUMENT_ROOT"].$path.'/util/functions.php';

//Custom Functions
  
  function assocMachine($ip,$instrumentID){
    $instrument = getInstrument($instrumentID);
    if($ip!=$instrument['address']){
      modifyData('address','instruments',$ip,array('instrumentID',$instrumentID),$GLOBALS['instrumentsdb']);
    }
    var_dump($instrument);
    if($instrument['connection']==0){
        modifyData("connection","instruments",1,array('instrumentID',$instrumentID),$GLOBALS['instrumentsdb']);
    }
  }

  function findNearestProject($num,$userID){
      $projects = getData(array("projectID","name","date_expires"),"project_list",array("userID",$userID),$GLOBALS['projectsdb']);

      $times = array();
      if(is_array($projects)) {
          foreach ($projects as $project) {
              $new = array($project['name']=>strtotime($project['date_expires']));
              $times = array_merge($times, $new);
          }
      }
      asort($times);
      $keys = array_keys($times);
      for($i = $num-1; ($i < count($times)); $i++){
          unset($times[$keys[$i]]);
      }
      return $times;
  }

  function findNearestTest($num,$userID){
      $projects = getProjects($userID);
      $tests = array();
      foreach($projects as $project){
        $tests = array_merge($tests,getData(array("name","dateExpires"),"test_list",array("projectID",$project['projectID']),$GLOBALS['testsdb']));
      }
      

      $times = array();
      if(is_array($tests)) {
          foreach ($tests as $test) {
              $new = array($test['name']=>strtotime($test['dateExpires']));
              $times = array_merge($times, $new);
          }
      }
      asort($times);
      $keys = array_keys($times);
      for($i = $num-1; ($i < count($times)); $i++){
          unset($times[$keys[$i]]);
      }
      return $times;
  }

  function findNearestCart($num, $userID){
    $carts = array();
    foreach(getTests($userID) as $test){
      $carts = array_merge($carts,getData(array("name","dateExpires"),"cart_list",array("testID",$test['testID']),$GLOBALS['cartsdb']));
    }

    $times = array();
    if(is_array($carts)) {
        foreach ($carts as $cart) {
            $new = array($cart['name']=>strtotime($cart['dateExpires']));
            $times = array_merge($times, $new);
          }
    }
    asort($times);
    $keys = array_keys($times);
    for($i = $num-1; ($i < count($times)); $i++){
        unset($times[$keys[$i]]);
    }
    return $times;
  }

  function getProjectExpire($projectID){
    return getData("date_expires","project_list",array("projectID",$projectID),$GLOBALS['projectsdb'])[0]['date_expires'];
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

   //Inventory
  function getInstrument($instrumentID){
    $what = array("name", "instrumentID", "type", "count","address","connection","in_use");
    $where = array("instrumentID",$instrumentID);
    return getData($what, "instruments",$where,$GLOBALS['instrumentsdb'])[0];
  }
  
  function getInstrumentName($instrumentID){
    $where = array("instrumentID",$instrumentID);
    return getData("name","instruments",$where,$GLOBALS['instrumentsdb'])[0]['name'];
  }

  //Users
  function getUserData($get,$userID){
    $where = array('userID',$userID);
    $data = getData($get,"users",$where,$GLOBALS['maindb']);
    if(is_array($get)){
    	return $data[0];
    }else{
    	return $data[0][$get];
  	}
  }

  function getUserFromTest($testID){
    $projectID = getData("projectID","test_list",array("testID",$testID),$GLOBALS['testsdb'])[0]['projectID'];
    $userID = getData("userID","project_list",array("projectID",$projectID),$GLOBALS['projectsdb'])[0]['userID'];
    return getUser($userID);
  }

  function getUser($userID){
    $what = array("userID","firstname","lastname","username","password","department","accountNumber","contactEmail","admin");
    $where = array('userID',$userID);
    return getData($what,"users",$where,$GLOBALS['maindb'])[0];
  }

  function getFullNameOfUser($userID){
    return ucfirst(getUserData('firstname',$userID))." ".ucfirst(getUserData('lastname',$userID));
  }

  function getRegisteredUsers(){
    $what = array("userID","firstname","lastname","username","password","department","contactEmail","admin");
    return getData($what,"users","",$GLOBALS['maindb']);
  }

  function is_registered_id($id){ 
    $where = array("userID",$id);
    return count(getData("userID","users",$where,$GLOBALS['maindb']));
  }

  function is_registered_username($un){
    $where = array("username",$un);
    return count(getData("username","users",$where,$GLOBALS['maindb']));
  }

  function add_new_user($firstName, $lastName, $userName, $password, $studentID, $department, $accountNumber){
    $status = FALSE;
    if(is_registered_id($studentID)){
      $status = array("Student ID");
    }
    if(is_registered_username($userName)){
      if(is_array($status)){
        array_push($status, "Username");
      }else $status = array("Username");
    }
    if(!is_array($status)){
      $what = array("userID","firstname","lastname","username","password","department","contactEmail","addedBy","addedOn", "admin","accountNumber","sessionID");
      $values = array(intval($studentID),$firstName,$lastName,$userName,password_hash($password,PASSWORD_DEFAULT),$department,$userName."@iastate.edu",-1, date("M d, Y"),0,$accountNumber,0);
      insertData($what,"users",$values,$GLOBALS['maindb']);
    }
    return $status;
  }
  //Invoices
  function createInvoice($userID){
    $count = 0;

    $tables = getTableNames($GLOBALS['invoicedb']);
    
    foreach($tables as $table){
     if (strpos($table, $GLOBALS['invoiceTablePrefix']) !== false) {
        $count++;
      }
    }
    
    $name = $GLOBALS['invoiceTablePrefix'].($count);
    makeTable($name,$GLOBALS['invoiceFields'],$GLOBALS['invoiceValues'],$GLOBALS['invoicedb']);
      
    $userdata = array("");
    $what   = array("userID","invoiceID","dateOut","invoicePeriod");
    $period = $GLOBALS['defaultInvoicePeriod'];
    $values = array($userID,$count,getCurrentDate(),$period);
    insertData($what,"invoice_list",$values,$GLOBALS['invoicedb']);
    return $count;
  }

  function destroyInvoice($inoiveID){  //include move to history
  }

  function completeInvoice($userID,$invoiceID){
  }

  function getAllCurrentInvoices(){
    $what   = array("userID","invoiceID","dateOut","invoicePeriod");
    $where  = array("finalized","1");
    
    $data = getData($what,"invoice_list",$where,$GLOBALS['invoicedb']);
         
    return $data;
  }

  function getAllInvoicesByUserID($userID){
    $correlation = getAllCurrentInvoices();
    $data = $indexes = $userInvoices = array();

    if(sizeof($correlation)>0){
      foreach($correlation as $invoice){
        if($invoice['userID']==$userID){

          $tmp = getData($GLOBALS['invoiceFields'],$GLOBALS['invoiceTablePrefix'].$invoice['invoiceID'],"",$GLOBALS["invoicedb"]);
          if($tmp!=null){
            array_push($indexes,$invoice['invoiceID']);
            array_push($userInvoices,$tmp);
          }
        }
      }
      array_push($data,$indexes);
      array_push($data,$userInvoices);

      return $data;
    }
    return NULL;
  }

  function getInvoiceData($invoice){
    $invoiceData = array();

    $what = array("name","priceDay");


    if(is_array($invoice)){
      foreach($invoice as $item){
        $where = array("serialNum",$item['serialNum']);
        $data = getData($what,"inventory",$where,$GLOBALS['maindb']);
        array_push($invoiceData, $data[0]);
      }
    }
    return $invoiceData;
  }

  //CART FUNCTIONS
  function getCart($cartID){   
    $what = array("instrumentID","usage_count","usage_time","in_use","last_start_time"); 
    $data = getData($what,($GLOBALS['cartTablePrefix'].$cartID),"",$GLOBALS['cartsdb']);
    return $data;
  }

  function getCarts($testID){
    $what = array("name","cartID","testID","dateCreated","dateExpires","active");
    $where = array("testID",$testID);
    return getData($what,"cart_list",$where,$GLOBALS['cartsdb']); 
  }

  function getAllCarts(){
    $what = array("name","cartID","testID","dateCreated","dateExpires","active");
    return getData($what,"cart_list","",$GLOBALS['cartsdb']); 
  }

  function isInCart($instrumentID,$cartID){
    $data = getCart($cartID);
    foreach($data as $inst){
      if($inst['instrumentID'] == $instrumentID) return TRUE;
    }
    return FALSE;
  }

  function submitCart(){
    //MAKE CHANGE DATA FUNCTION (MODIFY)
    cartExists();
  }

  function refreshInvoices(){///////?
    $tables   = getTableNames($GLOBALS['invoicedb']);
    $invoices = getData("finalized","invoice_list","",$GLOBALS["invoicedb"]);

    foreach($tables as $table){
      if(strpos($table, $GLOBALS['invoiceTablePrefix']) !== false) {
      
      }
    }
  }

//Project Functions
function getProjects($userID){
    $where=array("userID",$userID);
    $what   = array("name","projectID");

    $correlation = getData($what,"project_list",$where,$GLOBALS['projectsdb']);

    return $correlation;
}

function getProjectName($projectID){
  $where = array("projectID",$projectID);
  if($data = getData("name","project_list",$where,$GLOBALS['projectsdb'])) return $data[0]['name'];
  else return NULL;
}


//Test Functions
function getTest($projectID){
    $where=array("projectID",$projectID);
    $what   = array("name","testID");

    $correlation = getData($what,"test_list",$where,$GLOBALS['testsdb']);

    return $correlation;
}

function getTests($userID){
  $projects = getProjects($userID);
  $tests = array();
  foreach($projects as $project){
    $tests = array_merge($tests,getData(array("name","testID","dateExpires"),"test_list",array("projectID",$project['projectID']),$GLOBALS['testsdb']));
  }
  return $tests;
}

function getTestName($testID){
  $where=array("testID",$testID);
  if($data = getData("name","test_list",$where,$GLOBALS['testsdb'])) return $data[0]['name'];
  else return NULL;
}

//Cart Functions
function getCartID($testID){
    $where=array("testID",$testID);
    $what   = array("name","cartID");

    $correlation = getData($what,"cart_list",$where,$GLOBALS['cartsdb']);

    return $correlation;
}

function getCartName($cartID){
  $where=array("cartID",$cartID);
  if($data = getData("name","cart_list",$where,$GLOBALS['cartsdb'])) return $data[0]['name'];
  else return NULL;
}

//Modular Functions

//Database Fucntions
  function makeTable($table,$columns,$types,$database){
    // $table    = sql_sanitize($table);
    // $columns  = sql_sanitize($columns);
    // $types    = sql_sanitize($types);
    // $database = sql_sanitize($database);

    $conn = loginDB($database);
    $sql = "CREATE TABLE ".$table." (";

    if(is_array($columns)){
      $len = sizeof($columns);
      for($i = 0; $i<$len; $i++){
        $sql .= $columns[$i]." ".$types[$i];
        if($i<$len-1){
          $sql .= ",";
        }
      }
    }else{
      $sql .= $columns." ".$types;
    }


    $sql.=")";
    echo $sql;
    if(!$result = $conn->query($sql)){
      die('There was an issue adding that table.');
    }
    close($conn);
  }

  function removeTable($table,$database){
    // $table = sql_sanitize($table);
    // $database = sql_sanitize($database);

    $conn = loginDB($database);

    $sql = "DROP TABLE ".$table;

    if(!$result = $conn->query($sql)){
      die('There was an issue removing that peice of data.');
    }

    close($conn);
  }

  function getTableNames($database){
    // $database = sql_sanitize($database);

    $conn = loginDB($database);

    $data = array();
    $sql  = "SHOW TABLES FROM ".$database[0];

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        foreach($row as $p){
          array_push($data, $p);
        }
      }
    } else {
      return NULL;
    }

    close($conn);
    return $data;
  }

//Table Functions
  function getMaxId($column,$table,$database){
    // $column   = sql_sanitize($column);
    // $table    = sql_sanitize($table);
    // $database = sql_sanitize($database);

    $conn = loginDB($database);
    $sql = 'SELECT MAX('.$column.') FROM '.$table;
    $result = $conn->query($sql);

    return fetchData($result)[0];
  }

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
    global $path;
    if($GLOBALS['dbtype']){
        $conn = new PDO('sqlite:'.$_SERVER['DOCUMENT_ROOT'].$path.'/database/data/'.$database[0].'.db');
    }else{
      $conn = new mysqli($database[1], $database[2], $database[3],$database[0]);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      } 
    }
    return $conn;
  }

  function fetchData($result){
    if($GLOBALS['dbtype']){
      return $result->fetch(PDO::FETCH_BOTH);
    }else return $result->fetch_assoc();
  }

  function close($db){
    if($GLOBALS['dbtype']){
      $db = NULL;
    }else $db->close();
  }

?>