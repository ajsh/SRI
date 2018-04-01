<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>DSHAFT Download Request Form</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="print.css" media="print" />
	<script type="text/javascript" src="validation.js"></script>
	<!--[if IE]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<style type="text/css">

.ok
{
background-color:#EEE9E9;
}
.error
{
background-color:#FBEC5D;
}
</style>
</head>
<body>

		<header>
			<div id="headerlogo"><img src="images/Picture121.png" alt="" height="200" width="1040"/></div>	
			
		</header>
	<nav><!-- top nav -->
		<div class="menu">
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="download_dshaft.html">Download D-Shaft</a>
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
	   
	          
				<form method="post" action="script.php" onsubmit="return validateMyForm(this)">
				 
					<table width="600px" border="0" cellpadding ="5" cellspacing="8">
					<tr>
						<th align="left">Personal Information</th>
					</tr>
					<br/>
					<tr>
						<td> 
							<label for="first_name">First Name* :</label>
						</td>
						<td> 
							<input type ="text" name="first_name" id="strImpfname" maxlength="30" size="30" onblur="check(this)"></input>
						
						<span id="sfname">&nbsp;</span>
						</td>
					</tr>
					<br/>
					<tr>
						<td> 
							<label for="last_name">Last Name* :</label>
						</td>
						<td> 
							<input type ="text" name="last_name" id="strImplname" maxlength="30" size="30" onblur="check(this)"></input>
							<span id="slname"> &nbsp;</span>
						</td>
					</tr>
					<br/>
					<tr>
						<td> 
							<label for="company_name">Company/Organization* :</label>
						</td>
						<td> 
							<input type ="text" name="company_name" maxlength="30" size="30" onblur="check(this)" id="strImpcompany">
							<span id="scompany">     &nbsp;      </span>
						</td>
					</tr>
					</table>
					<table width="600px" border="0" cellpadding ="8" cellspacing="8">
					<tr>
						<th align="left">Address</th>
					</tr>
					<tr>
						<td> <label for="street_name">Street:</label>
						</td>
						<td> <input type ="text" name="street_name" maxlength="75" size="40"> </input>
						</td>
					</tr>

					<tr>
						<td> 
							<label for="city_name">City:</label>
						</td>
						<td> 
							<input type ="text" name="city_name" maxlength="10" size="10" onblur="check(this)" id="strcity"> </input>
							<span id="scity" style="float:right"></span>
						</td>
						<td>
							<label for="state_name">State:</label></td>
						<td>
							<input type ="text" name="state_name" maxlength="2" size="2" id="strstate" onblur="check(this)"> </input>
							<span id="sstate" style="float:right"></span>
						</td>
						<td> 
							<label for="zip_code">Zip:</label>
						</td>
						<td> 
							<input type ="text" name="zip_code" maxlength="5" size="5" onblur="numcheck(this)" id="numzip"> </input>
							<span id="szip" style="float:right"></span>
						</td>
					</tr>
					<tr>
						<td> 
							<label for="email_name">Email* :</label>
						</td>
						<td> 
							<input type ="text" name="email_name" id="email" maxlength="50" size="30" onblur="mailcheck(this)"> </input>
				
							<span id="semail" style="float:right"></span>
						</td>
					</tr>
					<br/>
					<tr>
						<td>
							<label for="phone_number">Phone Number:</label>
						</td>
						<td>
							<input type ="text" name="phone_number" id="numphone" maxlength="10" size="10" onblur="numcheck(this)"> </input>
							<span id="sphone" style="float:right"></span>
						</td>
						<td> 
							<label for="fax_number">Fax:</label>
						</td>
						<td> 
							<input type ="text" name="fax_number" id = "numfax" maxlength="10" size="10"  onblur="numcheck(this)"> </input>
							<span id="sfax" style="float:right"></span>
						</td>
					</tr>	
					<tr>
						<td colspan=3>
							<input type="checkbox" name="retUsr" id="retUsr">  Are you a Returning User?<br/><br/><br/>
						</td>
					</tr>
					</table>
			
					
					<p align="justify">
						<b><u>TERMS AND CONDITIONS:</u></b>
					<br/>
					<br/>
						<p align="justify">
						I certify that the information contained in this form is true and that I have answered all questions to the best of my ability. <br/><br/>
						I agree that I will not reproduce the DSHAFT database in any form or by any means. I agree not to modify, rent, lease, loan, sell, distribute,
						or create derivative works based on DSHAFT in any.<br/><br/>
						<br/>
						
						</p>
					</p>
					<br/> 
					<br/>
					<table align="right" border="0" cellpadding="20" cellspacing="10">
						<tr>
							<td><label for ="signature">Signature:</label></td>
							<td> <input type ="text" name="signature" maxlength="15" size="20" id = "strImpsignature"></td>
						</tr>
						<tr>
							<td><label for ="date">Date (mm/dd/YYYY): </label></td>
							<td> <?php echo date("m/d/Y") . "<br />"; ?> </td>
						</tr>	
					</table>
					<table align="center"><br/><br/><br/><br/>
						
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

						<td align="center"> <label for="security_code">Enter Security Code: </label> 
						<br><br> <img src="CaptchaSecurityImages.php?width=100&height=40&characters=5" />
		                <br><br><input id="security_code" name="security_code" type="text" /><br /> 
						<br>	<input type="submit" name="submit" value="Submit"> </td>
						
						
					</table>
				</form>
				
			

		</article>

		</div>
		
		

	<footer>
		<br />
		<p>Copyright © 2011 Iowa State University - All rights reserved.</p>
	</footer>
<!-- Free template created by http://freehtml5templates.com -->
</body>
</html>
