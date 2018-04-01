<?php
$path = getenv("HTTP_SERVER_PATH");

	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/session.php';
	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/database/db.php';

	$thisPage = basename(__FILE__, '.php');
	if($_SESSION['page']!== $thisPage){
		$_SESSION['page'] = $thisPage;

		header("Location:/");
	}else{
	$html = '
		<button id="toggleadduser">Add User</button>
		<button id="toggleremoveuser">Remove User</button>

		<div id="removeuser">
			<form method = "post" action = "'.$path.'/util/userReg.php">';

				$html .= '<div id="usersTable">';
					$users = getRegisteredUsers();
					$html .= '<table cellspacing = "1">';
					foreach($users as $user){
						$html .= '<tr>';
						$html .= '<td><input type="checkbox" name="username[]" value="'. $user['username'].'">';
						$html .= ' '.$user['firstname'].' '.$user['lastname'].'</td>';

						$html .= '</tr>';
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

		<div id="adduser" hidden>
			<form method = "post" id="addUserForm" action = "'.$path.'/util/userReg.php">
				<table width = "400" border = "0" cellspacing = "1" cellpadding = "2">
					<tr>
						<td>First Name</td>
						<td><input name = "firstname" type = "text" id = "firstname"></td>
					</tr>
					<tr>
						<td>Last Name</td>
						<td><input name = "lastname" type = "text" id = "lastname"></td>
					</tr>
					<tr>
						<td>Username (NetID)</td>
						<td><input name = "username" type = "text" id = "username"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input name = "password" type = "password" id ="password"></td>
					</tr>
					<tr>
						<td>Department</td>
						<td>
							<select name="department" form="addUserForm">';
							foreach($GLOBALS['departments'] as $department){
								$html .= '<option value="'.$department.'">'.$department.'</option>';
							}
					$html .= '</select>
						</td>
					</tr>

					<tr>
						<td>Contact Email</td>
						<td><input name = "contactEmail" type = "text" id ="contactEmail"></td>
					</tr>
					<tr>
						<td>Admin Password</td>
						<td><input name = "apassword" type = "password" id ="apassword" required></td>
					</tr>
					<tr>
						<td>Admin</td>
						<td><input type="checkbox" name="admin" value="false"></td>
					</tr>
					<tr>
						<td width = "100"> </td>
						<td>
							<input name = "add" type = "submit" id = "add" value = "Add" value="1">
						</td>
					</tr>
				</table>
			</form>
		</div>';
		echo $html;
	}
?>