<?php
$path = getenv("HTTP_SERVER_PATH");

	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/session.php';

	$thisPage = basename(__FILE__, '.php');
	if($_SESSION['page']!== $thisPage){
		$_SESSION['page'] = $thisPage;
		header("Location:/");
	}else{

		$html = "
			<h1 style='text-align:center'>".$_SESSION['firstname'].", Welcome to the Laboratory Equipment Portal!</h1>
			";
		$html .= display_account_info();

		$html .= date("",strtotime(date("M d, Y"))-strtotime("Jul 26, 2017"));

		echo $html;
	}

	function display_account_info(){ //Display 3 of each, that are the closest to expiring
        $html = '
		<div id="account info" style="width:400px">
			<h3>Upcoming Expirations</h3>';

        $userID = $_SESSION['userID'];

        //PROJECTS
        $html .= '<h4><b>Projects</b></h4>
                  <table id="close_projects" style="margin-left:25px">
					<tr>
						<td><b>Name</b></td>
						<td><b>Expiration Date</b></td>
					</tr>';

        $projects= findNearestProject(3, $userID);
        if(is_array($projects)) {
            foreach ($projects as $name=>$date) {
                $html .= '<tr>';
                $html .= '<td width="50%">' . $name . '</td>';
                $html .= '<td width="50%">' . date("M d, Y",$date) . '</td>';

                $html .= '</tr>';
            }

        }
        $html .= '</table>';

        $html .= '<h4><b>Tests</b></h4>
                  <table id="close_tests" style="margin-left:25px">
                    <tr>
                        <td><b>Name</b></td>
						<td><b>Expiration Date</b></td>
                    </tr>';

        $tests = findNearestTest(3,$userID);
        if(is_array($tests)) {
            foreach ($tests as $name=>$date) {
                $html .= '<tr>';
                $html .= '<td width="50%">' . $name. '</td>';
                $html .= '<td width="50%">' . date("M d, Y",$date) . '</td>';
                $html .= '</tr>';
            }
        }
        $html .= '</table>';

        $html .= '<h4><b>Carts</b></h4>
                  <table id="close_carts" style="margin-left:25px">
                    <tr>
                        <td><b>Name</b></td>
						<td><b>Expiration Date</b></td>
                    </tr>';

        $carts = findNearestCart(3, $userID);
        if(is_array($carts)) {
            foreach ($carts as $name=> $date) {
                $html .= '<tr>';
                $html .= '<td width="50%">' . $name . '</td>';
                $html .= '<td width="50%">' . date("M d, Y",$date) . '</td>';
                $html .= '</tr>';
            }
        }
        $html .= '</table></div>';

        return $html;
	}

?>