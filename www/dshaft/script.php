<?php 
session_start();
function died($error) {
			// your error code can go here
			echo "The following errors were found in the form that you submitted <br/>";
			echo $error."<br /><br />";
			echo "Please go back and fix these errors.<br /><br />";
			echo "
					<footer>
					<br />
					<p>Copyright © 2011 Iowa State University - All rights reserved</p>
					</footer>
					</body>
					</html>";
			die();
			}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="print.css" media="print" />
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

<title>Request Status!</title>
</head>

<body>
<header>
			<div id="headerlogo"><img src="images/Picture121.png" alt="" height="200" width="1040"/></div>
		</header>

	<nav><!-- top nav -->
		<div class="menu">
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="download_dshaft.html">Download Shaft</a></li>
			    <!--ul-->
   					<li><a href="design_guide.html">Design Guide</a></li>
   					
   				<!--/ul-->
  			</li>
				<li><a href="publications.html">Publications</a>
				</li>
				<li><a href="tac_members.html">TAC Members</a></li>
				<li><a href="project_team.html">Project Team</a></li>
				<li><a href="contact.html">Contact</a></li>
			</ul>
		</div>
	</nav><!-- end of top nav -->
<div id="contents">
<article class="articlecontent">
	    <?php
		$website="http://sri.cce.iastate.edu/dshaft";
		
		
		// validation expected data exists
		if( isset($_POST['submit'])) {
			if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] ) ) {
				// Insert your code for processing the form here, e.g emailing the submission, entering it into a database. 
				unset($_SESSION['security_code']);
			} 
			else 
			{
				// Insert your code for showing an error message here
				died("Invalid Security Characters Entered");
			}
		}
		if( !isset($_POST["first_name"]) || trim($_POST["first_name"])=="" )
		{
			died('Your First Name is Incorrect!!');  
		}
	
		if( !isset($_POST["last_name"]) || trim($_POST["last_name"])=="" )
		{
		
			died('Your Last Name is Incorrect!!');  
		}

		if( !isset($_POST["company_name"]) || trim($_POST["company_name"])=="" )
		{
			died('Your Company Name is Incorrect!!');  
		}
		
		if( !isset($_POST["email_name"]) || trim($_POST["email_name"])=="" )
		{
			died('Your Email ID is Incorrect!!');  
		}
		
//		if( !isset($_POST["phone_number"]) || trim($_POST["phone_number"])=="" )
//		{
//			died('Your phone number is Incorrect!!');  
//		}
	//
	
		if(isset($_POST["email_name"])) {
		
		
		// EDIT THE 2 LINES BELOW AS REQUIRED
		$email_to = $_POST["email_name"];
		$email_subject = "Your download link is given below";
	    $email_from = "no-reply@iastate.edu";
		$first_name = trim($_POST["first_name"]); // required
		$last_name = trim($_POST["last_name"]); // required
		$company_name = trim($_POST["company_name"]); // required
		$street_name = trim($_POST["street_name"]); // not required
		$city_name = trim($_POST["city_name"]); // not required
		$email_name = trim($_POST["email_name"]); // required 
		$state_name = trim($_POST["state_name"]); // not required
		$phone_number = trim($_POST["phone_number"]); // required
		$fax_number = trim($_POST["fax_number"]); // not required
		$ret_Usr  = trim($_POST["retUsr"]); // not required
		
		$error_message = "";
		$email_exp = "^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$";
		if(!eregi($email_exp,$email_name)) {
			$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
		}
		$string_exp = "^[a-z .'-]+$";
		if(!eregi($string_exp,$first_name)) {
			$error_message .= 'The First Name you entered does not appear to be valid.<br />';
		}
		if(!eregi($string_exp,$last_name)) {
			$error_message .= 'The Last Name you entered does not appear to be valid.<br />';
		}
		if(!eregi($string_exp,$company_name)) {
			$error_message .= 'The company Name you entered does not appear to be valid.<br />';
		}

		if(strlen($error_message) > 0) {
			died($error_message);
		}
		
     
		function clean_string($string) {
			$bad = array("content-type","bcc:","to:","cc:","href");
			return str_replace($bad,"",$string);
		}
        $auth_key = uniqid (rand());
		require_once("class.phpmailer.php");
		$mail = new PHPMailer();
		//$mail->PluginDir = ?./?;
		//$mail->IsSMTP();
		//$mail->Port = 465;
		//$mail->Host = "mailhub.iastate.edu";
		$mail->IsSendmail();
		$mail->IsHTML(true); // if you are going to send HTML formatted emails
		//$mail->Mailer = 'mailhub.iastate.edu';
		//$mail->SMTPSecure = 'ssl';

		//$mail->SMTPAuth = true;
		//$mail->Username = "noreplylrfd@gmail.com";
		//$mail->Password = "lrfdcivil#567";

		//$mail->SingleTo = true; // if you want to send mail to the users individually so that no recipients can see that who has got the same email.

		$mail->From = "vikesh@iastate.edu";
		$mail->FromName = "DSHAFT IASTATE";

		$mail->addAddress($email_name);
		
		$mail->Subject = "D-Shaft Database Download Link";
	

		
		
		$email_message = " Your registration was <b>successful!</b> Please verify the details below and click on the link to download the file <br><br>";
		$email_message .= "First Name: ".clean_string($first_name)."<br><br>";
		$email_message .= "Last Name: ".clean_string($last_name)."<br><br>";
		$email_message .= "Email: ".clean_string($email_name)."<br><br>";
		$email_message .= "Telephone: ".clean_string($phone_number)."<br><br>";
		$email_message .= "Please copy paste the given link below in the address bar of the browser to download your copy<br>";
        $email_message .= "Download Link: ".$website."/download.php?auth_key=".clean_string($auth_key)."<br><br>";
		$email_message .= "<i>Note:Please disable any popup blockers that you may have installed. This link works only <b>once</b>. Please re-register again to download, if you fail to download (due to pop up blockers or otherwise) or download gets interrupted inbetween <br/><br/>";
		$email_message .= "<i>Do not reply to this mail as the mail address is not monitored</i><br/><br/>";
		$email_message .= "<i>Thank you<br></i>";
		$mail->Body = $email_message;
		 
		if ($ret_Usr)
			$retUsr = 1;
		else
			$retUsr = 0;

		$cvsData = $first_name . "," . $last_name  . "," . $company_name . "," . $street_name . "," . $city_name . "," . $email_name . "," . $state_name . "," . $phone_number . "," .$fax_number . "," . $ret_Usr ."\n";
		$fp = fopen(ROOT . '/data/dshaftdata.csv',"a+");
		fwrite($fp,$cvsData); // Write information to the file
		fclose($fp); // Close the file
		//$dbc =mysqli_connect('localhost', 'sri', '9Tepad52gawr', 'ccee-sri-doge') or die('Error connecting to MySql server');
		//$query = "INSERT INTO dshaftusertable(first_name, last_name, company_name, street_name, city_name,email_id, phone_number, fax_number, auth_key, used, retUsr) values('$first_name','$last_name','$company_name','$street_name','$city_name','$email_name','$phone_number','$fax_number','$auth_key', 0, '$retUsr')";
		//mysqli_query($dbc,$query) or die('Error Querying the database');
		try {
			$result = $mail->Send();
		} catch (phpmailerException $e) {
		  echo $e->errorMessage(); //error messages from PHPMailer
		}

		if(!$result)
			echo "Error registering! Please check back later! Sorry for the incovenience!!";
		else
			echo "<br>Your form has been successfully submitted. <br><br>
			The download link has been sent to your mail. <br><br> Incase you have not received an e-mail please check in your spam/junk box<br/><br/>
			<i>Thank you for Visiting Us!</i><br>";
		//mysqli_close($dbc);
	} 
	
	?>
</article>
	</div>
		<br/><br/>

	<footer>
		<br /><br/>
		<p>Copyright © 2011 Iowa State University - All rights reserved.</p>
	</footer>

</body>
</html>
