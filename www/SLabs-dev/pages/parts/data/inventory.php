<?php
$path = getenv("HTTP_SERVER_PATH");

	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/session.php';

	$thisPage = basename(__FILE__, '.php');
	if($_SESSION['page']!== $thisPage){
		$_SESSION['page'] = $thisPage;
		header("Location:/");
	}else{

	$html = '
		<button id="toggleaddpart">Add Part</button>
		<button id="toggleremovepart">Remove Part</button>

		<div id="addpart">
			<form method = "post" action = "'.$path.'/util/partReg.php">
				<table width = "250" border = "0" cellspacing = "1" cellpadding = "2">
					<tr>
						<td>Part Name</td>
						<td><input name = "name" type = "text" id = "name"></td>
					</tr>
					<tr>
						<td>Serial Number</td>
						<td><input name = "serialNum" type = "text" id = "serialNum"></td>
					</tr>
					<tr>
						<td>Storage Location</td>
						<td><input name = "storeLoc" type = "text" id = "storeLoc"></td>
					</tr>
					<tr>
						<td>Price (Per Day)</td>
						<td><input name = "priceDay" type = "text" id ="priceDay"></td>
					</tr>
					<tr>
						<td>Admin Password</td>
						<td><input name = "apassword" type = "password" id ="apassword"></td>
					</tr>
					<tr>
						<td>Check If Software</td>
						<td><input type="checkbox" name="type" value="false"></td>
					</tr>
					<tr>
						<td width = "100"> </td>
						<td>
							<input name = "add" type = "submit" id = "add" value = "Add" value="1">
						</td>
					</tr>
				</table>
			</form>
			<table width="600">
				<form action="'.$path.'util/upload.php" method="post" enctype="multipart/form-data">

					<tr>
						<td width="20%">Select file (CSV)</td>
						<td width="80%"><input type="file" name="file" id="file" /></td>
					</tr>

					<tr>
						<td>Submit</td>
						<td><input type="submit" name="submit" /></td>
					</tr>

				</form>
			</table>
		</div>
		<div id="removepart" hidden>
			<form method = "post" action = "'.$path.'/util/partReg.php">
				<table width = "250" border = "0" cellspacing = "1" cellpadding = "2">
					<tr>
						<td>Serial Number</td>
						<td><input name = "serialNum" type = "text" id = "serialNum"></td>
					</tr>
					<tr>
						<td>Admin Password</td>
						<td><input name = "apassword" type = "password" id ="apassword"></td>
					</tr>
					<tr>
						<td width = "100"> </td>
						<td>
							<input name = "remove" type = "submit" id = "remove" value = "Remove" value="1">
						</td>
					</tr>
				</table>
			</form>
		</div>';

	echo $html;
	}
?>