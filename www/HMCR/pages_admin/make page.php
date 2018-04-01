<?php
	function content(){
		$html = '
		<div id="maincontent">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1 class="text-center">Make New Page</h1>
						<hr>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<form method="post" action="/">
							<input type="text" name="title">
							<input type="text" name="subtitle">
							
						</form>
					</div>
				</div>
			</div>
		</div>
		';
		return $html;
	}
?>