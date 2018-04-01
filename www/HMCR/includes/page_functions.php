<?php
	require_once "session.php";

	if(isset($_POST['set_page'])){
		foreach(scandir("../pages") as $filename){
            if(!is_dir($filename)){
            	$filename = explode('.',$filename);
                $filename = str_replace(" ","",$filename);
                if($filename[0]==$_POST['set_page']){
                	$_SESSION['page'] = $_POST['set_page'];
                	break;
                }
            }
        }

        foreach(scandir("../pages_hidden") as $filename){
            if(!is_dir($filename)){
                $filename = explode('.',$filename);
                $filename = str_replace(" ","",$filename);
                if($filename[0]==$_POST['set_page']){
                    $_SESSION['page'] = $_POST['set_page'];
                    break;
                }
            }
        }

        if($_SESSION['authed']&&isAdmin($_SESSION['username'])){
            foreach(scandir("../pages_admin") as $filename){
                if(!is_dir($filename)){
                    $filename = explode('.',$filename);
                    $filename = str_replace(" ","",$filename);
                    if($filename[0]==$_POST['set_page']){
                        $_SESSION['page'] = $_POST['set_page'];
                        break;
                    }
                }
            }
        }
	    header("Location:/");
    }
?>