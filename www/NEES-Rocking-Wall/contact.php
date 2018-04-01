<?php
/*
if(isset($_POST['email']))
{
// Here is the email to information
$email_to="vikesh@iastate.edu";
$email_subject="Nees Rocking Wall Project Queries";
$email_from="J Design In Motion";
}
//error Code

function died($error)
{
echo " we are sorry, but there were error(s) found with the form you submitted.";
echo "these errors appear below.<br/><br/>";
echo $error. "<br/><br/>";
echo "please go back and fix the errors.<br/>";
die();
}
//validation

if(!isset($_POST['name']) ||
!isset($_POST['email']) ||
!isset($_POST['comments']))
{
died('we are sorry but there appears to be a problem with the form you submitted.');
}

$name= $_POST['name'];
$email= $_POST['email'];
$comments= $_POST['comments'];
$error_message="";
$email_exp='/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z](2,4)$/';

if(!preg_match($email_exp,$email))
{
$error_message .='The Email address you entered does not appear to be valid';
}
$string_exp="/^[A-Za-z.'-]+$/";

if(!preg_match($string_exp, $name))
{
$error_message .='The Name you entered does not appear to be valid';
}
if(strlen($comments) < 2){
$error_message .='The comments you entered does not appear to be valid';
}
if(strlen($error_message) > 0)
{
died($error_message);

}
$email_message="Form Details below. \n\n";

function clean_string($string)
{
$bad = array("content-type", "bcc:","to:","cc:","href");
return str_replace($bad, "", $string);
$email_message .="Name:" . clean_string($name) . "\n";
$email_message .="Email:" . clean_string($email) . "\n";
$email_message .="Comments:" . clean_string($comments) . "\n";
}
//create email headers_list
$headers = 'From: ' .$email_From. "\r\n". 'Reply-To:' . $email. "\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
?>
<!-- success message  goes here-->
<!--Thank you for contacting us. We will be in touch with you shortly. <br/>
please click<a href="form.html"> </a> to go back to the form. -->
<?php
$message = "Line 1\r\nLine 2\r\nLine 3";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70, "\r\n");

// Send
if(
mail('caffeinated@example.com', 'My Subject', $message))
echo "Mail Sent";
else
echo"Mail not sent";
?>
