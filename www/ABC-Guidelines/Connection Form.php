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


<form  action="Connection Form 2.php" method="POST" enctype="multipart/form-data" data-toggle="validator">
<div class="color1 col-sm-offset-1">
CONNECTION DETAIL
</div>

</div>
 <div class="form-group row " >
  <label for="Connect1" class="col-xs-2 col-form-label" style="text-align:right;">Elements Connected </label>
  <div class="col-xs-5">
    <input class="form-control" type="text" name = "Connect1"><br>
    <input class="form-control" type="text" name = "Connect2">
    (e.g. Precast Column, CIP Pile Cap)

  </div>
</div>

<div class="form-group row">
  <label for="Description" class="col-xs-2 col-form-label" style="text-align:right;">Connections Description</label>
  <div class="col-xs-5">
    <textarea class="form-control" type="text" value="Description" name="Description"></textarea>
  </div>
  </div>
 <div class="form-group row">
  <label for="Data Sheet" class="col-xs-2 col-form-label" style="text-align:right;">Documents illustrating Connection detail</label><input name="input-2" type="file" class="file"> 
 
  </div>


<div class="form-group row">
  <label for="Product Type" class="col-xs-2 col-form-label" style="text-align:right;">Recent Usage</label>
  <div class="col-xs-5">

 <div class="radio">
  <label><input type="radio" name = "Product_type" value="Used in practical project">Only Conceptual</label>
</div>
<div class="radio">
  <label><input type="radio" name = "Product_type" value="Validated be experimental test">Validated by large scale testing</label>
</div>
<div class="radio">
  <label><input type="radio" name = "Product_type" value="Connection Concepts">Used in demomstration projects(s)</label>
</div>
<div class="radio">
  <label><input type="radio" name = "Product_type" value="Other">Other</label> <input class="form-control" type="text" value="" name ="PType">
</div>
 </div>
</div>

<div class="color1 col-sm-offset-1">
ADDITIONAL INFORMATION
</div>

<div class="form-group row">
  <label for="Contact Name" class="col-xs-2 col-form-label" style="text-align:right;">Design Recommendation</label>
  <div class="col-xs-5">
    <textarea class="form-control" type="text" value="Design Recommendation" name="Design_Recommendation"></textarea><input name="input-3" type="file" class="file" required=""> 
  </div>
</div>

<div class="color1 col-sm-offset-1">
SCORE
</div>
 <div class="form-group row">
  <label for="Organization" class="col-xs-2 col-form-label" style="text-align:right;">Structural performance</label>
  <div class="col-xs-1">
    <input class="form-control" type="text" value="" name="Structural_performance">
  </div>
  /5 (0 have significant issue, 5 same/better when compared to conventional CIP method)
</div>
   <div class="form-group.required row">
  <label for="Organization" class="col-xs-2 col-form-label" style="text-align:right;">Constructability</label>
  <div class="col-xs-1">
    <input class="form-control" type="text" value="" name="Constructability">
  </div>
  /5 (0 difficult, 5 easily)
</div>
   <div class="form-group row">
  <label for="Organization" class="col-xs-2 col-form-label" style="text-align:right;">Speed of construction</label>
  <div class="col-xs-1">
    <input class="form-control" type="text" value="" name="Speed_of_construction">
  </div>
  /5  (0 very slow, 5 very fast)
</div>
   <div class="form-group row">
  <label for="Organization" class="col-xs-2 col-form-label" style="text-align:right;">Cost</label>
  <div class="col-xs-1">
    <input class="form-control" type="text" value="" name="Cost">
  </div>
  /5 (0 very expensive, 5 cost effective when compared to conventional CIP method)
</div>

<div class="color1 col-sm-offset-1">
CONTACT INFORMATION
</div>

    <div class="form-group row">
  <label for="Organization" class="col-xs-2 col-form-label" style="text-align:right;">Organization</label>
  <div class="col-xs-5">
    <input class="form-control" type="text" value="e.g. Iowa State University" name="Organization" required="">
  </div>
</div>
 <div class="form-group row">
  <label for="Contact Name" class="col-xs-2 col-form-label" style="text-align:right;">Contact Name</label>
  <div class="required col-xs-5">
    <input class="form-control" type="text" value="e.g. John Doe" name="Contact_Name" >
  </div>
  </div>
  
 
   <div class="form-group row">
  <label for="JobTitle" class="col-xs-2 col-form-label" style="text-align:right;">Job Title</label>
  <div class="col-xs-5">
    <input class="form-control" type="text" placeholder="JobTitle" value="<?php echo $JobTitle; ?>" name="JobTitle">
  </div>
</div>

   <div class="form-group row">
  <label for="Affiliation" class="col-xs-2 col-form-label" style="text-align:right;">Affiliation</label>
  <div class="col-xs-5">
    <input class="form-control" type="text" placeholder="Affiliation" value="<?php echo $Affiliation; ?>" name="Affiliation">
  </div>
</div>
</div>
 <div class="form-group row">
  <label for="Contact Name" class="col-xs-2 col-form-label" style="text-align:right;">Phone Number</label>
  <div class="col-xs-5">
    <input class="form-control" type="text" value="(XXX)-XXX-XXXX" name="Number">
  </div>
</div>
 <div class="form-group row">
  <label for="Contact Name" class="col-xs-2 col-form-label" style="text-align:right;">Email</label>
  <div class="col-xs-5">
    <input class="form-control" type="text" value="John_Doe@gmail.com" name="Email" required="">
  </div>
</div>

<center><input name="submit" type="submit" text="submit" value="submit"><!--button type="button" class="btn btn-default">Submit</button--></center>
<br>


  </form>

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