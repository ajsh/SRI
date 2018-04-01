<?php
$path = getenv("HTTP_SERVER_PATH");

	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/database/db.php';
	
	if(isset($_POST['s'])&&$_POST['s']['search']){
		$post=$_POST['s'];

        $active = FALSE;
        $name = "";
            foreach(getAllCarts() as $c) 
                if($post['cartID']==$c['cartID']){
                    $active = $c['active'];
                    $name = $c['name'];
                }

        if(!$active){
            echo "<p><b>This cart has been finalized (no longer editable).<b></p>";
        }else{

    		$post['search']=strtolower($post['search']);
    		$html = "<div id='tsr'>";

    		$conn = loginDB($GLOBALS['instrumentsdb']);

    		// $sql = "SELECT * FROM instruments WHERE name LIKE '".$post['search']."%'"; //used for specifics
    		$sql = "SELECT * FROM instruments WHERE instr(name,'".$post['search']."')"; //more general

    		$result = $conn->query($sql);
    		if ($result) {
    			$html .= "<table id='tool_result_table'>";
    			$pass = FALSE;
        		while($row = fetchData($result)) {
        			$html .= "<tr><td>".$row['name']."</td>";
        			if(!isInCart($row['instrumentID'],$post['cartID'])){
        				$html .= "<td>";

        				if(!$row['type']){
        					if($row['count']>0){
        						$html .= "<select id='amount_".$row['instrumentID']."' name='amount'>";
    		    				for($i = 1; $i <= $row['count']; $i++){
    		    					$html .= "<option value='".$i."'>".$i."</option>";
    		    				}
    	    					$html .= "</select>"; 
    	    					$html .= "</td>";
        						$html .= "<td><button onclick=add_instrument(".$row['instrumentID'].")>Add</button></td>";
        					}else{
        						$html .= "Not in Stock";
        					}
        				}else{
        					$html .= "<input value='0' id='amount_".$row['instrumentID']."' hidden> Time Usage";
        					$html .= "</td>";
        					$html .= "<td><button onclick=add_instrument(".$row['instrumentID'].")>Add</button></td>";
        				}   

        				
        			}else{
        				$html .= "<td><button disabled>In Cart</button></td>";
        			}

        			$html .= "</tr>";
        			$pass = TRUE;
        		}
        		$html.="</table></div>";
        		if($pass) echo $html;
        		else echo "Nothing Found.";
        	} else {
        		echo "Nothing Found.";
        	}
          	close($conn);
        }
        exit;
	}
?>
