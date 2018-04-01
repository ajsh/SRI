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
$target_Path = "../../data/ABC-Guidelines/Documents illustrating Connection detail/";
$target_Path = $target_Path.basename( $_FILES['input-2']['name'] );
move_uploaded_file( $_FILES['input-2']['tmp_name'], $target_Path );

$target_Path = "../../data/ABC-Guidelines/Design Recommendation/";
$target_Path = $target_Path.basename( $_FILES['input-3']['name'] );
move_uploaded_file( $_FILES['input-3']['tmp_name'], $target_Path );

$website="http://sri.cce.iastate.edu/ABC-Guidelines";


$Connect1 = "";
$Connect2 = "";
$Description ="";
$Product_type = "";
$Design_Recommendation="";
$Structural_performance="";
$Constructability="";
$Speed_of_construction="";
$Cost="";
$Organization="";
$Contact_Name="";
$Number="";
$Email="";
$JobTitle="";
$Affiliation="";

if(isset($_POST["JobTitle"]))
{
$JobTitle= $_POST["JobTitle"];
} 
if(isset($_POST["Affiliation"]))
{
$Affiliation= $_POST["Affiliation"];
} 
if(isset($_POST["Connect1"]))
{
$Connect1= $_POST["Connect1"];
} 
if(isset($_POST["Connect2"]))
{
$Connect2= $_POST["Connect2"];
}
$connect3 = "$Connect1".","."$Connect2"; 
if(isset($_POST["Description"]))
{
$Description= $_POST["Description"];
}
if(isset($_POST["Product_type"]))
{
$Product_type= $_POST["Product_type"];

}
if(isset($_POST["Design_Recommendation"]))
{
$Design_Recommendation= $_POST["Design_Recommendation"];
}

if(isset($_POST["Structural_performance"]))
{
$Structural_performance= $_POST["Structural_performance"];
}
if(isset($_POST["Constructability"]))
{
$Constructability= $_POST["Constructability"];
}
if(isset($_POST["Cost"]))
{
$Cost= $_POST["Cost"];
}
if(isset($_POST["Speed_of_construction"]))
{
$Speed_of_construction= $_POST["Speed_of_construction"];
}
if(isset($_POST["Organization"]))
{
$Organization= $_POST["Organization"];
}
if(isset($_POST["Contact_Name"]))
{
$Contact_Name= $_POST["Contact_Name"];
}
if(isset($_POST["Number"]))
{
$Number= $_POST["Number"];
}
if(isset($_POST["Email"]))
{
$Email= $_POST["Email"];
}
if(isset($_POST["PType"]))
{
$PType= $_POST["PType"];
}


if(isset($_POST["Product_type"]))
{
    if($_POST["Product_type"] == "Other")
    {
       /*$Product_type= "Other" + ;
       echo("$Product_type");*/
       $Product_type ="Other" . " : " ."$PType";

    }
    else
    {
      $Product_type = $_POST["Product_type"];
    }
   

 /*$Product_Type = $_POST["Product_type"];
  $N = count($Product_Type);
 
    echo("You selected $N product type(s): ");
    //$Product_Type= $_POST["Product_type"];
    for($i=0; $i < $N; $i++)
    {
      echo($Product_Type[$i] . " ");
    }
//echo $_POST["Product_type"];*/

}



echo "Thank you for the submission.";




//require_once('../class.phpmailer.php');

//$mail= new PHPMailer(); // defaults to using php "mail()"
    $email_from = "$Email";
    $email_subject = "New Product Submission";
    $email_body = "New Product Details:\n";
    $email_body .= "Components Connected : $connect3\n";
    $email_body .= "Description : $Description\n";
    $email_body .= "Utilizing : $Product_type\n";
    $email_body .= "Design Recommendation : $Design_Recommendation\n";
    $email_body .= "Structural performance : $Structural_performance\n"; 
    $email_body .= "Constructability : $Constructability\n"; 
    $email_body .= "Speed of construction : $Speed_of_construction\n"; 
    $email_body .= "Cost : $Cost\n"; 
    $email_body .= "Organization : $Organization\n"; 
    $email_body .= "Contact Name : $Contact_Name\n";
    $email_body .= "JobTitle : $JobTitle\n";
    $email_body .= "Affiliation : $Affiliation\n";
    $email_body .= "Phone Number : $Number\n"; 
    $email_body .= "Email : $Email\n"; 
    $to = "mridulav@iastate.edu";
    $headers = "From : $Email \r\n";
if(mail($to, $email_subject, $email_body, $headers))
{  ?>

      <?php
}

?>

</body>
</html>