<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
<title>Sign up > Hexcrete Tower Project </title>
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
<p class="clear"></p>
</div>
	<div id="contents">
	<h2 align="center">Sign up here to learn about this technology</h2>
		<article class="articlecontent">
	   
	          
				<form method="post" action="script.php" onsubmit="return validateMyForm(this)">
				 
					<table width="800px" border="0" cellpadding ="5" cellspacing="8">
					<tr>
						<th align="left"><b>Personal Information</b></th>
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
					<table width="800px" border="0" cellpadding ="8" cellspacing="8">
					<tr>
						<th align="left"><b>Address</b></th>
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
						<!--td> 
							<label for="zip_code">Zip:</label>
						</td>
						<td> 
							<input type ="text" name="zip_code" maxlength="5" size="5" onblur="numcheck(this)" id="numzip"> </input>
							<span id="szip" style="float:right"></span>
						</td-->
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
					</table>
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

						<td align="left"> <label for="security_code">Enter Security Code: </label> 
						<br><br> <img src="CaptchaSecurityImages.php?width=100&height=40&characters=5" />
		                <br><br><input id="security_code" name="security_code" type="text" /><br /> 
						<br>	<input type="submit" name="submit" value="Submit"> </td>
						
						
					</table>
				</form>
				
			

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
