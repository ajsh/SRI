<?php
$path = getenv("HTTP_SERVER_PATH");

	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/session.php';
	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/database/db.php';


	$thisPage = basename(__FILE__, '.php');
	if($_SESSION['page']!== $thisPage){
		$_SESSION['page'] = $thisPage;
		header("Location:/");
	}else{
		$html = "<h3>Welcome to the Lab Page!</h3>
				<p>Here you can activate the machines you have put in your carts.</p>
				<p>In order to use a machine, first you must select the cart pertaining to the test that you are performing.</p>

		";

		$html .= selectProject();
		$html .= "<script>
			function toggle_instrument_use(cid, iid){
				$('#toggle_switch_'+iid).text('Pending...');
			  var data = {
			      cartID:cid,
			      instrumentID:iid
			    };
			    $.ajax({
			          type: 'post',
			          url: path+'/pages/parts/data/ajax.php',
			          data: {
			              toggle_instrument:data
			          },
			          success: function (response) {
			          	console.log(response);
			          }
			      });

			    var data = {
			      cartID:cid
			    };
			    $.ajax({
			      type: 'post',
			      url: path+'/pages/parts/data/ajax.php',
			      data: {
			        display_cart_lab:data
			      },
			      success: function (response) {
			        $('#cart').html(response);
			      }
			    });
			    get_cart(cid);
			}</script>";
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

	    $html .="</select>";
		
		//Test Selection

	    $html.="<td>
	    	<label>Your Tests: </label>
	    	<select id='tests'   onchange=load_test(this.value)>
	    		<option disabled selected>Select Project</option>
	    	</select>";
		
		//Cart Selection
	    $html.="<td>
	    	<label>Your Carts: </label>
	    	<select  id='carts'  onchange=get_cart(this.value)>
	    		<option disabled selected>Select Test</option>
	    	</select>

	   	</table>

	   	<div id='cart'></div>

	   	";

	    return $html;
	}
?>