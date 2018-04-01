<?php
$path = getenv("HTTP_SERVER_PATH");
require $_SERVER["DOCUMENT_ROOT"].$path.'/init/session.php';
require $_SERVER["DOCUMENT_ROOT"].$path.'/init/globals.php';
require $_SERVER["DOCUMENT_ROOT"].$path.'/database/db.php';


function getNav($page){
	global $path;
    $theme = new Site\Theme();
    if($_SESSION['authed'] == getSessionID($_SESSION['userID'])){
        foreach($GLOBALS['pages'] as $p){
            $uri = "javascript:;";
            if($p!=$_SESSION['page']){
                $uri = $path.'/pages/parts/data/'.$p.'.php';
            }
            $theme->setOptions(array(
                'navbar_menu' => array(
                    array(
                        'label' => $p, //Name of MENU TAB
                        'uri'=>$uri,
                    ),

                ), [ $reset = true]));
        }

        if($_SESSION['admin']){
			foreach($GLOBALS['adminPages'] as $p){
                $uri = "javascript:;";
                if($p!=$_SESSION['page']){
                    $uri = $path.'/pages/parts/data/'.$p.'.php';
                }   
                $theme->setOptions(array(
                    'navbar_menu' => array(
                        array(
                            'label' => $p,
                            'uri'=>$uri,
                        ),
                    ),[ $reset = true])
                );
			}			
		}

		$theme->setOptions(array(
                'navbar_menu' => array(
                    array(
                        'label' => "logout", //Name of MENU TAB
                        'uri'=>$path."/security/logout.php",
                    ),

                ), [ $reset = true]));
	}
    else if($page == 'new user'){
        $theme->setOptions(array(
            'navbar_menu' => array(
                array(
                    'label' => "Login Page", //Name of MENU TAB
                    'uri'=>$path."/pages/parts/data/login.php",
                ),
            ), [ $reset = true]));
    }
    $theme->drawHeader();
}
?>