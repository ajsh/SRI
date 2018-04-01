<?php
$path = getenv("HTTP_SERVER_PATH");

	require $_SERVER["DOCUMENT_ROOT"].$path.'/init/session.php';

	$path = "/SLabs-dev"; 
	
	if(!$_SESSION['authed'] || $_SESSION['authed']!=getSessionID($_SESSION['userID'])){
		$thisPage = basename(__FILE__, '.php');
		if($_SESSION['page']!== $thisPage){
			$_SESSION['page'] = $thisPage;
			if(!headers_sent()) header("Location:/");
		}else{
			echo "
				<div style='text-align:center'>
					<h1>Welcome to the Login Page!</h1>
					<form action='".$path."/security/auth.php' method='POST'>
						<input type='text' placeholder='Username' name='username'>
						<input type='password' placeholder='Password' name='password'>
						<input type='submit' name='login' value='Login'>
					</form>
					<br>
					<p>Don't have an account?</p>
					<a href='".$path."/pages/parts/data/new%20user.php'>Register</a>
				</div>
				";
		}
	}
?>