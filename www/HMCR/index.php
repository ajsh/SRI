<?php
	
	foreach(glob("includes/*.php") as $filename){
		if(!is_dir($filename)){
			require_once($filename);
		}
	}

	$page = $_SESSION['page'];

	//Page Begin
	echo html_start($page);

		echo head_start($page);
			echo head_content($page);
		echo head_end($page);

		echo body_start($page);

			echo header_start($page);
				echo header_content($page);
			echo header_end($page);

			echo body_content($page);

		echo body_end($page);

		echo footer_start($page); 
			echo footer_content($page);
		echo footer_end($page);

		echo javascript_start($page);
			echo javascript_content($page);
		echo javascript_end($page);

	echo html_end($page);


?>