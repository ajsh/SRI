<?php
$path = getenv("HTTP_SERVER_PATH");

	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/globals.php';

	$html = '
		<div id="addpart">
			<form method = "post" action = "">
				<table width = "250" border = "0" cellspacing = "1" cellpadding = "2">
					<tr>
					    <th colspan="3"><h4>PLAN A TEST:</h4></th>
					    
					</tr>
					<tr>
						<td colspan="3">Project Title : <input name = "name" type = "text" id = "prjTitle"></td>
						
					</tr>
					<tr>
						<td colspan="3">Account Number : <input name = "serialNum" type = "text" id = "accNum"></td>
					</tr>
					<tr>
					<form method = "post" action = '.$path.'"/util/instSearch.php">
					    <td colspan="3"><div class="row">
	                        <div class=".col-md-6">
	                            <div class="panel panel-default">
	                            <div class="bs-example">
	                            <input type="text" name="instName" id="instName" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Search Instrument">  
	                            <input name = "add" type = "submit" id = "add" value ="Add" value="1">

	                            </div>
	                            </div>
	                         </div></div>
	                    </td></form>
					</tr>
				</table>
			
			</form>
		<div id="dispInst">
			<form method = "post" action = "">';

		$html .= '<div id="usersTable">';

			$what = array("name", "storeLoc", "capacity", "priceDay", "addedOn", "addedBy");
			$where =array('name',$_POST['instName']);
			$inst = getData($what, "inventory",$where,$GLOBALS['maindb']);

			$html .= '<table cellspacing = "1">';
			if(is_array($inst)) {
			    foreach ($inst as $disp) {
			        $html .= '<tr>';
			        $html .= '<td><input type="checkbox" name="username[]" value="' . $disp[1] . '">';
			        $html .= ' ' . $disp[0] . ' ' . $disp[1] . ' ' . $disp[2] . ' ' . $disp[3] . '</td>';

			        $html .= '</tr>';
			    }
			}
				$html .='</table></div>';


				$html .= '<br><br>';
				$html .= '<table>
						<tr>
							<td>Admin Password</td>
							<td><input name = "apassword" type = "password" id ="apassword" required></td>
						</tr>
					</table>

					<input name = "remove" type = "submit" id = "remove" value = "Remove" value="1">
				</form>
			</div>
			

			<table width="600">
				<form action="instruments.php" method="post" enctype="multipart/form-data">

					<tr>
						<td><input type="submit" name="submit" /></td>
					</tr>

				</form>
			</table>
		</div>';
	echo $html;
?>


