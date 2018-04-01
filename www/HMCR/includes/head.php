<?php
    function head_start($page){
        return "<head>";
    }

    function head_content($page){
        return '
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 

    <title>'.ucwords($page).'</title>
    
    <link rel="icon" type="image/ico" href="/favicon.ico">

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet"> 
    
    <!-- CSS -->
    <link href="css/css.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" media="all" href="css/ou-global-header.css">
    
    <!-- JS -->
    <script language="javascript" type="text/javascript" src="js/jquery.min.js"></script>
    <script language="javascript" type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script language="javascript" type="text/javascript" src="js/javascript.js"></script>


     <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->';
    }
    
    function head_end(){
        return "</head>";
    } 

?>
