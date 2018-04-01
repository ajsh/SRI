<?php
$path = ROOT.getenv("HTTP_SERVER_PATH");

function printHead($page){
	global $path;
    $theme = new Site\Theme('Page title');
    $theme->setOption('site_title',$page);
	echo '
	 <head>        
	 	<!--JS-->
	 	<script type="text/javascript" src="'.$path.'/slabs/js/jquery.min.js"></script>
	 	<script type="text/javascript" src="'.$path.'/slabs/js/slabs.js"></script>
      <script type="text/javascript" src="'.$path.'/slabs/js/slabs.data.js"></script>

	 	<!--CSS-->
	 	<link rel="stylesheet" type="text/css" href="'.$path.'/slabs/css/slabs.css">
	 </head>
	 ';
}
?>