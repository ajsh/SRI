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
					<p>Copyright � 2011 Iowa State University - All rights reserved</p>
					</footer>
					</body>
					</html>";
			die();
			}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Request Status! > Hexcrete Tower Project </title>
<meta name="keywords" content="Hexcrete-tower-project, Wind-energy, Sri Sritharan">
<meta name="description" content="title: Hexcrete-tower-project, name: Wind Energy, Designer: Vikesh Reddy Nallamilli"> 
<meta http-equiv="content-type" content="text/html"; charset=UTF-8">
<style media="all" type="text/css">@import "base2.css";</style>
<style media="all" type="text/css">@import "common/mast/main.css";</style>
<script src="scripts/js-image-slider.js" type="text/javascript"></script>
<script type="text/javascript" src="common/base.js"></script>
<script type="text/javascript" src="scripts/prototype.lite.js"></script>
<script type="text/javascript" src="scripts/moo.fx.js"></script>
<script type="text/javascript" src="scripts/moo.fx.pack.js"></script>
<script type="text/javascript" src="scripts/moo.dom.js"></script>
<script type="text/javascript" src="scripts/slideshow.js"></script>
<link rel="shortcut icon" href="images/favicon.ico" type="image/vnd.microsoft.icon" />
<script type="text/javascript">

function date_time(id)
{
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        h = date.getHours();
        if(h<10)
        {
                h = "0"+h;
        }
        m = date.getMinutes();
        if(m<10)
        {
                m = "0"+m;
        }
        s = date.getSeconds();
        if(s<10)
        {
                s = "0"+s;
        }
        result = ''+days[day]+' '+months[month]+' '+d+' '+year+' '+h+':'+m+':'+s;
        document.getElementById(id).innerHTML = result;
        setTimeout('date_time("'+id+'");','1000');
        return true;
}
</script>
<!-- slide show -->
<style media="all" type="text/css">
	
	
	#display {
		margin: 7px 0 0 10px;
	}

	
	#sliderFrame, #sliderFrame div {
    box-sizing: content-box;
}
#sliderFrame 
{
		position:relative;
		width: 295px;
		height: 145px;
		float: left;
		margin-right: 20px;
}

#slider{
    width:290px;height:145px;/* Must be the same size as the slider images */
}
#slider div.navBulletsWrapper div 
{
    width:11px; height:11px;
    font-size:0;color:White;/*hide the index number in the bullet element*/
    background:transparent url(bullet.png) no-repeat 0 0;
    display:inline-block; *display:inline; zoom:1;
    overflow:hidden;cursor:pointer;
    margin:0 6px;/* set distance between each bullet*/
}
	
	#description {
		color: #666;
		text-align:center;
		padding: 9px 0 5px 0;
		font-size: 11px;
	}
	
	.btnlnk {
		border: 0;
		margin: 0;
		padding: 5px 0 0 0;
</style>

<script type="text/javascript">
window.onload = function() {
	var slideshow = new fx.SlideShow('slideContainer', {duration: 2000, interval: 8000});
	slideshow.start();
};
  $(window).load(function() {
    $('.flexslider').flexslider({slideshow: false});

  });

</script>

</head>
<body class="cs0">



<div id="content">

<div id="sitewrap">

<div id="maincontentwrap">
<div id="siteheader">
</div>


<div id="navwrap1">
<div id="mainnav">
<ul>

<li><a href="index.htm" class="selected"><i>Home</i></a></li>
<li><a href="summary.htm"><i>Summary</i></a></li>
<li><a href="hexcretetower.htm"><i>Hexcrete Tower</i></a></li>
<li><a href="experiments.htm"><i>Experiments</i></a></li>
<li><a href="personnel.htm"><i>Personnel</i></a></li>
<li><a href="publications.htm"><i>Publications</i></a></li>
<li><a href="sponsors.htm"><i>Sponsors</i></a></li>
<li><a href="contact.htm"><i>Contact</i></a></li>
<li><a><i><span id="date_time"></i></span>
<script type="text/javascript">window.onload = date_time('date_time');</script></a></li>
<!-- QUICK LINK PLACEHOLDER -->

</ul>
</div>
</div>
<!-- 
<div id="navwrap2">
<div id="subnav">

<ul>

<li><a href="#">Calendar</a></li>
<li><a href="#">Announcements</a></li>
</ul>

</div>
</div>
-->


<!-- BEGIN #maincontent -->

<div id="pagehead">

	
	<div id="sliderFrame" style="width: 916px !important;height:300px !important;margin-bottom:20px;">
        <div id="slider" style="width: 916px !important;height:300px !important;">
		<img src="images/slide4.png" class="slide" width="916" height="250" alt="" />
		<img src="images/slide1.png" width="916" height="250" class="slide" alt="" />
		<img src="images/slide2.png" width="916" height="250" class="slide" alt="" />
		<img src="images/slide3.png" width="916" height="250" class="slide" alt="" />
        </div>
    </div>
    
  
<div style="text-align:justify;font-size:14px;width: 916px !important;"><i>This project facilitates widespread deployment of the Hexcrete technology for tall wind turbine towers with a hub height of at least 120 m (394 ft). Using modularized high strength concrete and ultra-high strength concrete (UHPC) components, the new technology eliminates the transportation and logistics constraints associated with construction of taller wind turbine towers.</i><br><br></div>
<a href="summary.htm" title="Learn more about this project" class="btnlnk"><img src="images/rm.png" alt="Learn more about this project" id="btn-more" class="btnlnk" /></a>

 <!-- <a href="#" class="parent">MainNav1</a> / <a href="#">SubNav1 </a> -->
<p class="clear"></p>
</div>
<div id="contents">
<article class="articlecontent">
	    <?php
		$website="http://sri.cce.iastate.edu/hexcrete";
		
		
		// validation expected data exists
		if( isset($_POST['submit'])) {
			if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] ) ) {
				// Insert your code for processing the form here, e.g emailing the submission, entering it into a database. 
				unset($_SESSION['security_code']);
			} 
			else 
			{
				// Insert your code for showing an error message here
				died("&nbsp&nbsp&nbsp&nbspInvalid Security Characters Entered");
			}
		}
		if( !isset($_POST["first_name"]) || trim($_POST["first_name"])=="" )
		{
			died('&nbsp&nbsp&nbsp&nbspYour First Name is Incorrect!!');  
		}
	
		if( !isset($_POST["last_name"]) || trim($_POST["last_name"])=="" )
		{
		
			died('&nbsp&nbsp&nbsp&nbspYour Last Name is Incorrect!!');  
		}

		if( !isset($_POST["company_name"]) || trim($_POST["company_name"])=="" )
		{
			died('&nbsp&nbsp&nbsp&nbspYour Company Name is Incorrect!!');  
		}
		
		if( !isset($_POST["email_name"]) || trim($_POST["email_name"])=="" )
		{
			died('&nbsp&nbsp&nbsp&nbspYour Email ID is Incorrect!!');  
		}
		
//		if( !isset($_POST["phone_number"]) || trim($_POST["phone_number"])=="" )
//		{
//			died('Your phone number is Incorrect!!');  
//		}
	//
	
		if(isset($_POST["email_name"])) {
		
		
		// EDIT THE 2 LINES BELOW AS REQUIRED
		$email_to = $_POST["email_name"];
		$email_subject = "Hexcrete Tower Project Subscription";
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
		
		$error_message = "";
		$email_exp = "^[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$";
		if(!eregi($email_exp,$email_name)) {
			$error_message .= '&nbsp&nbsp&nbsp&nbspThe Email Address you entered does not appear to be valid.<br />';
		}
		$string_exp = "^[a-z .'-]+$";
		if(!eregi($string_exp,$first_name)) {
			$error_message .= '&nbsp&nbsp&nbsp&nbspThe First Name you entered does not appear to be valid.<br />';
		}
		if(!eregi($string_exp,$last_name)) {
			$error_message .= '&nbsp&nbsp&nbsp&nbspThe Last Name you entered does not appear to be valid.<br />';
		}
		if(!eregi($string_exp,$company_name)) {
			$error_message .= '&nbsp&nbsp&nbsp&nbspThe company Name you entered does not appear to be valid.<br />';
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
		$mail->FromName = "HEXCRETE IASTATE";

		$mail->addAddress($email_name);
		
		$mail->Subject = "Hexcrete Tower Project Subscription ";
	

		
		
		$email_message = " Your registration was <b>successful!</b> Please verify the details below if they are correct. We will keep you posted with latest information on upcoming workshops.  <br><br>";
		$email_message .= "First Name: ".clean_string($first_name)."<br><br>";
		$email_message .= "Last Name: ".clean_string($last_name)."<br><br>";
		$email_message .= "Email: ".clean_string($email_name)."<br><br>";
		$email_message .= "Telephone: ".clean_string($phone_number)."<br><br>";
		$email_message .= "<i>Do not reply to this mail as the mail address is not monitored</i><br/><br/>";
		$email_message .= "<i>Thank you<br></i>";
		$mail->Body = $email_message;

		$cvsData = $first_name . "," . $last_name  . "," . $company_name . "," . $street_name . "," . $city_name . "," . $email_name . "," . $state_name . "," . $phone_number . "," .$fax_number . "\n";
		$fp = fopen(ROOT . '/data/hexcretedata.csv',"a+");
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
			echo "&nbsp&nbsp&nbsp&nbspError registering! Please check back later! Sorry for the inconvenience!!";
		else
			echo "<br>&nbsp&nbsp&nbsp&nbspYour form has been successfully submitted. <br><br>
			&nbsp&nbsp&nbsp&nbspA confirmation message has been sent to your mail. <br><br> &nbsp&nbsp&nbsp&nbspIncase you have not received an e-mail please check in your spam/junk box<br/><br/>
			<i>&nbsp&nbsp&nbsp&nbspThank you for Visiting Us!</i><br>";
		//mysqli_close($dbc);
	} 
	
	?>
</article>
	</div>


 <div class="clear"></div>
        <div id="footer">
          <a href="index.htm">Home</a> | <span><a href=
          "Summary.htm">Summary</a></span> | <span><a href=
          "hexcretetower.htm">Hexcrete Tower</a></span> | <span><a href=
          "experiments.htm">Experiments</a></span> | <span><a href=
          "personnel.htm">Personnel</a></span> |  <span><a href=
          "publications.htm">Publications</a></span> |<span><a href=
          "sponsors.htm">Sponsors</a></span> | <span><a href=
		  "contact.htm">Contact</a></span>
        </div>
</div>
</div>
</div>
		

</body>
</html>
