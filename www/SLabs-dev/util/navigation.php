<?php
$path = getenv("HTTP_SERVER_PATH");

require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/session.php';
require_once $_SERVER["DOCUMENT_ROOT"].$path.'/init/globals.php';


if(isset($_SESSION['pgo'])){
    if(!$_SESSION['authed']||$_SESSION['authed']!=getSessionID($_SESSION['userID'])){
        $_SESSION['page'] = "login";
    }else{
        if(isPage($_SESSION['pgo'],$GLOBALS['allPages'])){
            if(isPage($_SESSION['pgo'],$GLOBALS['adminPages'])){
                if($_SESSION['admin']){
                    $_SESSION['page'] = $_SESSION['pgo'];
                }
            }else{
                $_SESSION['page'] = $_SESSION['pgo'];
                $_SESSION['pco']=$_SESSION['pgo'];
            }
        }
    }
}
header("Location:/");

	function isPage($page,$pages){
		foreach($pages as $p){
			if($page===$p) return TRUE;
		}
		return FALSE;
	}

?>