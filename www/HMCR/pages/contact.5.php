<?php
function content(){
	$html = '
	<div id="maincontent">
		<div class="container">	
			<div class="row">
				<div class="col-md-12">
					<h1 class="text-center">Contact Us</h1>
					<hr>					
			      	<img src="./image/content/engr-building.jpg" alt="Town Engineering" class="img-responsive center-block">
					<br><br>
				</div>
			</div>
			<div class="row" style="text-align: center">
				<div class="col-md-1"></div>
				<div class="col-md-4">
					<h2>OUR LOCATION</h2>

					<p class="lead">
						4100 Marston Hall<br>
						533 Morrill Road<br>
						Ames, IA 50011-2103
					</p>
					
					<h2>CONTACT US</h2>

					<p class="lead">
						 (515)-294-5933<br>
						<a href="mailto:hmcr@iastate.edu">hmcr@iastate.edu</a>
					</p>


				</div>
				<div class="col-md-6">
					<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11855.052068777457!2d-93.6498354!3d42.026816!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6de109406b389784!2sIowa+State+University+College+of+Engineering!5e0!3m2!1sen!2sus!4v1510105298538" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
			</div>
		</div> <!-- end container -->
	</div> <!-- end #maincontent -->';
	return $html;

}
?>