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
                <h2>Add Tools to Your Projects</h2>";
            $html .= selectProject();
            $html .= "</tr>

            <tr>";
            $html .= displaySelectInstrument();
            $html .= "</tr>

            <tr>";
            $html .= displayCurrentCart();
            $html .= "</tr>
        </table>";
        echo $html;
    }

    function selectProject(){
        $projects = getProjects($_SESSION['userID']);
        //Project Selection
        $html = "<table>";
        $html .="<tr><td>
            	<label>Your Projects: </label>
            	<select id='projects'  onchange=load_project(this.value)>
            	<option disabled selected>Choose Project</option>";

        if(is_array($projects)){
            foreach($projects as $item){
                $html .= "<option value=".$item['projectID'].">".$item['name']."</option>";
            }
        }

        $html .="</select>
        	</td>";

        //Test Selection

        $html.="<td>
        	<label>Your Tests: </label>
        	<select id='tests'   onchange=load_test(this.value)>
        		<option disabled selected>Select Project</option>
        	</select>
        	</td>";

        //Cart Selection
        $html.="<td>
        	<label>Your Carts: </label>
        	<select  id='carts'  onchange=load_cart(this.value)>
        		<option disabled selected>Select Test</option>
        	</select>
      		</td></tr>

       	</table>
        <div style='height:25px;padding:0;'>
            <p id='addition_warning'></p>
        </div>
        ";

        return $html;
    }


    function displaySelectInstrument(){
        return'<div id="select_instrument">
                <h2>Search for Tool</h2>
                <input type="text" name="inst_search" id="tool_search" onkeyup="retrieve_instrument(this.value)">
                <div id="tool_search_results"></div>

            </div>
            ';
    }

    function displayCurrentCart(){
        return "<div id='current_cart'></div>";
    }
?>