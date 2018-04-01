
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

<header>
<div class="col-md-12">
    <strong><center>Accelerated Bridge Construction (ABC) - Substructure</center></strong></div></header>

<nav class = "navbar navbar-default"> 
 
  <div class = "container">
    <!--<div class ="navbar-header">-->
    <div class = "navbar-header">
    <button type ="button"
    class ="navbar-toggle collapsed"
    data-toggle = "collapse" 
    data-target="#collapsemenu">
    <span class ="icon-bar"></span>
    <span class ="icon-bar"></span>
    <span class ="icon-bar"></span>
    </button>
  <!--</div>-->
</div>
    
        <div class="collapse navbar-collapse" id ="collapsemenu">
  
 
      
     <ul class = "nav navbar-nav">
     <li><a href = "index.html">Home</a></li>
     <li><a href = "Connections- Introduction.html">Connections</a></li>
      <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Experiments</a>
          <ul class="dropdown-menu">
            <li><a href="Experiment.html">Heading</a></li>
            <!--li><a href="#">1</a></li-->
          </ul>
          </li>
      <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Guidelines</a>
      <ul class="dropdown-menu">
            <li><a href="Guidelines.html">Socket Connection between Precast Column and Precast Foundation <br>Completed by Corrugated Metal Pipe (CMP) and Grout </a></li>
            <!--li><a href="">1</a></li-->
          </ul>
          </li>
      <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Products</a>
         <ul class="dropdown-menu"> 
            <li><a href="Grout New.html">Grout</a></li>
            <li><a href="Special Reinforcement.html">Special Reinforcement</a></li>
         </ul>
      </li>
      <li><a href = "SPONSORS.html">Sponsors</a></li>
      <li><a href = "Contact Us.html">Contact Us</a></li>

      </ul>

  </div>

</div>

</nav>
<div class="col-sm-8 col-sm-offset-1">
<div class="Grout">
<strong>SUBMIT PRODUCT</strong>
</div>


<form  action="Submit Product2.php" method="POST" enctype="multipart/form-data" data-toggle="validator">
<div class="color1  ">
CONTACT INFORMATION
</div>

    <div class="form-group row">
  <label for="Fname" class="col-xs-2 col-form-label" style="text-align:right;">First Name</label>
  <div class="col-xs-5">
    <input class="form-control" type="text" placeholder="First name" value="<?php echo $Fname; ?>" name="Fname" required="">
  </div>
</div>

    <div class="form-group row">
  <label for="Lname" class="col-xs-2 col-form-label" style="text-align:right;">Last Name</label>
  <div class="col-xs-5">
    <input class="form-control" type="text" placeholder="Last name" value="<?php echo $Lname; ?>" name="Lname" required="">
  </div>
</div>


   <div class="form-group row">
  <label for="Affiliation" class="col-xs-2 col-form-label" style="text-align:right;">Affiliation</label>
  <div class="col-xs-5">
    <input class="form-control" type="text" placeholder="Affiliation" value="<?php echo $Affiliation; ?>" name="Affiliation" required="">
  </div>
</div>

   <div class="form-group row">
  <label for="JobTitle" class="col-xs-2 col-form-label" style="text-align:right;">Job Title</label>
  <div class="col-xs-5">
    <input class="form-control" type="text" placeholder="JobTitle" value="<?php echo $JobTitle; ?>" name="JobTitle" required="">
  </div>
</div>


     <div class="form-group row">
  <label for="Email" class="col-xs-2 col-form-label" style="text-align:right;">Email Address</label>
  <div class="col-xs-5">
    <input class="form-control" type="text" placeholder="Email" value="<?php echo $Email; ?>" name="Email" required="">
  </div>
</div>

     <div class="form-group row">
  <label for="ContactNumber" class="col-xs-2 col-form-label" style="text-align:right;">Contact Number</label>
  <div class="col-xs-5">
    <input class="form-control" type="text" placeholder="ContactNumber" value="<?php echo $ContactNumber; ?>" name="ContactNumber" required="">
  </div>
</div>
<div class="color1  ">
PRODUCT TYPE
</div>

<div class="form-group row">
  <label for="Product Type" class="col-xs-2 col-form-label" style="text-align:right;">Product Type</label>
  <div class="col-xs-5">

 <div class="radio">
  <label><input type="radio" name="Product_type" value="Grout">Grout</label>
</div>
<div class="radio">
  <label><input type="radio" name="Product_type" value="Reinforcing Bar Coupler">Reinforcing Bar Coupler</label>
</div>
<div class="radio">
  <label><input type="radio" name="Product_type" value="End Anchorage">End Anchorage</label>
</div>
<div class="radio">
  <label><input type="radio" name="Product_type" value="Other">Other</label> <input class="form-control" name="Product" type="text">
</div>
 </div>
</div>

<div class="color1  ">
PRODUCT INFORMATION
</div>


    <div class="form-group row">
  <label for="Product_Name" class="col-xs-2 col-form-label" style="text-align:right;">Product Name</label>
  <div class="col-xs-5">
    <input class="form-control" type="text" value="<?php echo $Product_Name; ?>" name="Product_Name" required="">
  </div>
</div>
 <div class="form-group row">
  <label for="Manufacturer" class="col-xs-2 col-form-label" style="text-align:right;">Manufacturer</label>
  <div class="col-xs-5">
    <input class="form-control" type="text" value="<?php echo $Manufacturer; ?>" name = "Manufacturer" required="">
  </div>
</div>



 <div class="form-group row">
  <label for="Features" class="col-xs-2 col-form-label" style="text-align:right;">Features</label>
  <div class="col-xs-5">
    <textarea class="form-control" type="text" value="Features" name="Features"></textarea>
  </div>
  <input name="my-file" type="file" class="file" required=""> 
</div>


 <div class="form-group row">
  <label for="Certificates" class="col-xs-2 col-form-label" style="text-align:right;">Certificates</label>
  <div class="col-xs-5">
    <textarea class="form-control" type="text" value="Certificates" name ="Certificates"></textarea>

  </div>
<input name="my-file2" type="file" class="file" required=""> 
</div>

<div class="form-group row">
  <label for="Data_Sheet" class="col-xs-2 col-form-label" style="text-align:right;">Data Sheet</label>
  <div class="col-xs-5">
    <textarea class="form-control" type="text" value="Data_Sheet" name="Data_Sheet"></textarea>

  </div>
<input name="my-file3" type="file" class="file" required=""> 
</div><br>
<center><input name="submit" type="submit" text="submit" value="submit" required=""><!--button type="button" class="btn btn-default">Submit</button--></center>
<br>
  </form>
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>

<div class="navbar-fixed-bottom">
<center>
<ol class="breadcrumb col-sm-12 hidden-xs ">
  <li><a href="index.html">Home</a></li>
  <li><a href="Connections- Introduction.html">Connections</a></li>
  <li><a href="Experiment.html">Experiments</a></li>
  <li><a href="Guidelines.html">Guidelines</a></li>
  <li><a href="Grout New.html">Products</a></li>
  <li><a href="SPONSORS.html">Sponsors</a></li>
  <li><a href="Contact Us.html">Contact Us</a></li>
</ol>
</center>
</div>
</footer>
</body>
</html>