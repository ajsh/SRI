<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/Base.css">
  <link rel="stylesheet" href="css/bootstrap-social.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Josefin+Slab">
  <title>ABC Guidelines</title>
</head>
<body>
 <?php
$target_Path = "../../data/ABC-Guidelines/Features/";
$target_Path = $target_Path.basename( $_FILES['my-file']['name'] );
move_uploaded_file( $_FILES['my-file']['tmp_name'], $target_Path );

$target_Path = "../../data/ABC-Guidelines/Certificates/";
$target_Path = $target_Path.basename( $_FILES['my-file2']['name'] );
move_uploaded_file( $_FILES['my-file2']['tmp_name'], $target_Path );

$target_Path = "../../data/ABC-Guidelines/Datasheet/";
$target_Path = $target_Path.basename( $_FILES['my-file3']['name'] );
move_uploaded_file( $_FILES['my-file3']['tmp_name'], $target_Path );

$website="http://sri.cce.iastate.edu/ABC-Guidelines";
$Product_Name="";
 $Manufacturer="";
 $content="";
 $Email="";
 $Product_Type="";
 $Product="";
 $Features = "";
 $Certificates ="";
 $Data_Sheet="";
 $Fname ="";
 $Lname="";
 $Affiliation="";
 $JobTitle="";
 $ContactNumber="";


if(isset($_POST["Product_Name"]))
{
$Product_Name= $_POST["Product_Name"];
//echo "$FirstName";
} 
?>
<br>
<?php
if(isset($_POST["Manufacturer"]))
{
$Manufacturer= $_POST["Manufacturer"];
}
if(isset($_POST["Email"]))
{
$Email= $_POST["Email"];
}
if(isset($_POST["Product"]))
{
$Product= $_POST["Product"];

}

if(isset($_POST["Product_type"]))
{
    if($_POST["Product_type"] == "Other")
    {
       $Product_type ="Other" . " : " ."$Product";

       //$Product_type= "Other" + "$Product" ;
       echo("$Product_type");
       
    }
    else
    {
      $Product_type = $_POST["Product_type"];
    }
   
/*
 $Product_Type[] = $_POST["Product_type"];
  $N = count($Product_Type[]);
 
    echo("You selected $N product type(s): ");
    //$Product_Type= $_POST["Product_type"];
    for($i=0; $i<$N; $i++)
    {
      echo($Product_Type[$i] . " ");
    }
echo $_POST["Product_type"];*/

}
if(isset($_POST["Product"]))
{
$Product= $_POST["Product"];
}
if(isset($_POST["Fname"]))
{
$Fname= $_POST["Fname"];
}
if(isset($_POST["Lname"]))
{
$Lname= $_POST["Lname"];
}
if(isset($_POST["Affiliation"]))
{
$Affiliation= $_POST["Affiliation"];
}
if(isset($_POST["JobTitle"]))
{
$JobTitle= $_POST["JobTitle"];
}
if(isset($_POST["ContactNumber"]))
{
$ContactNumber= $_POST["ContactNumber"];
}
if(isset($_POST["Features"]))
{
$Features= $_POST["Features"];
}
if(isset($_POST["Certificates"]))
{
$Certificates= $_POST["Certificates"];
}
if(isset($_POST["Data_Sheet"]))
{
$Data_Sheet= $_POST["Data_Sheet"];
}


echo "Thank you for the submission.";




//require_once('../class.phpmailer.php');

//$mail= new PHPMailer(); // defaults to using php "mail()"
    $email_from = "$Email";
    $email_subject = "New Product Submission";
    $email_body = "New Product Details:\n";
    $email_body .= "First Name : $Fname\n";
    $email_body .= "Last Name : $Lname\n";
    $email_body .= "Affiliation : $Affiliation\n";
    $email_body .= "Job Title : $JobTitle\n";
    $email_body .= "Contact Number : $ContactNumber\n";
    $email_body .= "Product Name : $Product_Name\n";
    $email_body .= "Manufacturer : $Manufacturer\n";
    $email_body .= "Product Type : $Product_type\n";
    $email_body .= "Features : $Features\n";
    $email_body .= "Certificates : $Certificates\n";
    $email_body .= "Datasheet : $Data_Sheet\n"; 
    $to = "mridulav@iastate.edu";
    $headers = "From : $Email \r\n";
if(mail($to, $email_subject, $email_body, $headers))
{  ?>

      <?php
}

?>

</body>
</html>