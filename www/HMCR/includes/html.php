<?php
	function html_start($page){
		return "<!DOCTYPE html>
			<html lang='en'>";
	}

	function html_end($page){
		return "</html>";
	}

	function javascript_start($page){
        return "<script>";
    }

    function javascript_content($page){    	
        foreach(scandir("pages") as $filename){
            if(!is_dir($filename)){
                $filename = explode('.',$filename);
                if($filename[0]==$page){
                    require_once "pages/".implode('.',$filename);
                    if(function_exists("javascript")) return javascript($page);
                }
            }
        }

        foreach(scandir("pages_hidden") as $filename){
            if(!is_dir($filename)){
                $filename = explode('.',$filename);
                if($filename[0]==$page){
                    require_once "pages_hidden/".implode('.',$filename);
                    if(function_exists("javascript")) return javascript($page);
                }
            }
        }

        if($_SESSION['authed']&&isAdmin($_SESSION['username'])){
            foreach(scandir("pages_admin") as $filename){
                if(!is_dir($filename)){
                    $filename = explode('.',$filename);
                    if($filename[0]==$page){
                        require_once "pages_admin/".implode('.',$filename);
                        if(function_exists("javascript")) return javascript($page);
                    }
                }
            }
        }
    	return "";
    }

    function javascript_end($page){
        return "</script>";
    }


?>