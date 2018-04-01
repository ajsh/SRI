<?php
$path = getenv("HTTP_SERVER_PATH");

	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/session.php';
	require_once $_SERVER["DOCUMENT_ROOT"].$path.'/database/db.php';


	$thisPage = basename(__FILE__, '.php');
	if($_SESSION['page']!== $thisPage){
		$_SESSION['page'] = $thisPage;
		header("Location:/");
	}else{
		$result = FALSE;
		$html = "<h1>Create New User</h1>";
		if(isset($_POST['first_name'])){

			$result = add_new_user(
				$_POST['first_name'],
				$_POST['last_name'],
				$_POST['user_name'],
				$_POST['password'],
				$_POST['student_id'],
				$_POST['department'],
				$_POST['account_number']
			);
			if(!$result){
				$html .= "<p style='color:red'>User Added: " . $_POST['user_name']."</p>";
			}else{
				$html .= "<p style='color:red'>User was not added because ";
				for($i = 0; $i < count($result); $i++){
					$html .= $result[$i];
					if($i < count($result)-1){
						$html .= " and ";
					}
				}
				if(count($result)==1) $html .= " is ";
				else $html .= " are ";
				$html .= "already registered under another user.";
			}
		}
		$html .="<div id='new_user_form' style='width:25%'>
				<form action='' method='post'>
					<table style='border-spacing:10px'>
						<tr>
							<td>
								<label>First Name: </label>
							</td>
							<td>";
							if(!$result) $html .= "<input type='text' name='first_name' style='width:225px' required>";
							else $html .= "<input type='text' name='first_name' style='width:225px' value='".$_POST['first_name']."' required>";
		$html .= 			"</td>
						</tr>
						<tr>
							<td>
								<label>Last Name: </label>
							</td>
							<td>";
							if(!$result) $html .= "<input type='text' name='last_name' style='width:225px' required>";
							else $html .= "<input type='text' name='last_name' style='width:225px' value='".$_POST['last_name']."' required>";
		$html .= 			"</td>
						</tr>
						<tr>
							<td>
								<label>Student ID: </label>
							</td>
							<td>";
							if(!$result) $html .= "<input type='number' name='student_id' style='width:225px' maxlength=9 required>";
							else $html .= "<input type='number' name='student_id' style='width:225px' maxlength=9 value='".$_POST['student_id']."' required>";
								
		$html .=			"</td>
						</tr>
						<tr>
							<td>
								<label>Username: </label>
							</td>
							<td>";
							if(!$result) $html .= "<input type='text' name='user_name' style='width:225px' maxlength=8 required>";
							else $html .= "<input type='text' name='user_name' style='width:225px' maxlength=8 value='".$_POST['user_name']."' required>";
								
		$html .=				"<p>(ISU Email)</p>
							</td>
						</tr>
						<tr>
							<td>
								<label>Password: </label>
							</td>
							<td>";
							if(!$result) $html .= "<input type='password' name='password' style='width:225px' required>";
							else $html .= "<input type='password' name='password' style='width:225px' value='".$_POST['password']."' required>";
								
		$html .=			"</td>
						</tr>
						<tr>
							<td>
								<label>Department: </label>
							</td>
							<td>
								<select style='width:225px' name='department'>";
								if(!$result){
									foreach($GLOBALS['departments'] as $department){
										$html .= "<option value='".$department."'>".$department."</option>";
									}
								}else{
									$html .= "<option value='".$_POST['department']."'>".$_POST['department']."</option>";
									foreach($GLOBALS['departments'] as $department){
										if($department !== $_POST['department']){
											$html .= "<option value='".$department."'>".$department."</option>";
										}
									}
								}
		$html .=				"</select>
							</td>
						</tr>
						<tr>
							<td>
								<label>Department Account #: </label>
								
							</td>
							<td>";
							if(!$result) $html .= "<input type='text' name='account_number' style='width:225px' required>";
							else $html .= "<input type='text' name='account_number' style='width:225px' value='".$_POST['account_number']."' required>";
								
		$html .=				"<p>(For Invoice Payment)</p>
							</td>
						</tr>
						<tr>
							<td>
								<input type='submit' name='new_user'>
							</td>
						</tr>
					</table>
				</form>
			</div>
		";

		echo $html;
	}
?>