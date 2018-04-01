<?php
	
	if(isset($_POST['login'])){
		login();
	}else if(isset($_POST['logout'])){
		logout();
	}

	function login(){
		if((isset($_POST['username'])&&isset($_POST['password'])) && (!empty($_POST['username']) && !empty($_POST['password']))){

			echo password_hash($_POST['password'],PASSWORD_DEFAULT);

			$what = array("firstname","lastname","password","admin");
			$where = array("username",$_POST['username']);
			$login = getData($what,"users",$where,"users");


			if(password_verify($_POST['password'],$login[0]['password'])){
				$_SESSION['authed'] = TRUE;
				if($login[0]['admin']) $_SESSION['admin'] = TRUE;
				
				$_SESSION['username'] 	= $_POST['username'];

				$_SESSION['firstname'] 	= $login[0]['firstname'];
				$_SESSION['lastname']	= $login[0]['lastname'];
				
				$_SESSION['timeIN'] = time();

				$_SESSION['authed'] = setSessionID($_SESSION['userID']);



				$_SESSION['page'] = "home";
				// header("Location:/");
				return;
			}
		}
		logout();
	}

	function logout(){
		if(session_status() != PHP_SESSION_ACTIVE){
			session_start();
		}
		$_SESSION['authed'] = FALSE;
		session_unset(); 
		session_destroy();
		// header("Location:/");

	}

	function content(){
		$html = '
		<div id="maincontent">
			<div class="container">
				<h1 style="text-align:center">Login</h1>
		        <hr>
	        	<div class="row" style="display:block;text-align:center;">
	        		<form action="'.$_SERVER['PHP_SELF'].'" method="post" id="login_form" style="display:inline-block;text-align:center">
	        			<table>
	        			<tr><td><input type="text" name="username" placeholder="Username" style="text-align:center" required></tr></td>
	        			<tr><td><input type="password" name="password" placeholder="Password" style="text-align:center" required></tr></td>
	        			
	        			<tr><td><input type="submit" name="login"></tr></td>
	        			</table>

	        		</form>

	        	</div>
	        </div>
        </div>';

        return $html;
	}
?>