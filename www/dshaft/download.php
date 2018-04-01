<?php 
function died($error) {
			// your error code can go here
			echo $error."<br /><br />";
			die();
			}
		$file = 'database/Database/Drilled Shaft Database 6-30-11.accdb';
		if( !isset($_GET["auth_key"]) || trim($_GET["auth_key"])=="" )
		{
			died('You are not authorized to download this file!!!');  
		}
		else
		{
			if (file_exists($file))
			{
				/*$dbc =mysqli_connect('localhost', 'sri', '9Tepad52gawr', 'ccee-sri-doge') or die('Error connecting to MySql server');
				$auth_key = $_GET["auth_key"];
				
				$query = "UPDATE dshaftusertable SET used = 1 WHERE auth_key = '$auth_key' AND used = 0";
				$result = mysqli_query($dbc, $query) or died('Error Querying the database');
				 
				if (mysqli_affected_rows($dbc) == 1) 
				{ */
					header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename='.basename($file));
					header('Content-Transfer-Encoding: binary');	
					header('Expires: 0');
					header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
					header('Pragma: public');
					header('Content-Length: ' . filesize($file));
					ob_clean();
					flush();
					readfile($file);
				/* 	mysqli_close($dbc);
				}
				else
				{
					mysqli_close($dbc);
					died('You are not authorized to download this file!!');  
				} */
			}
			else
			{
				died('Error - Downloading file, Please retry after some time!!!');  
			}
		}
		?>