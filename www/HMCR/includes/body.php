<?php
    function body_start($page){
        return "<body> <div id='main-wrapper'>";
    }

    function body_content($page){
        foreach(scandir("pages") as $filename){
            if(!is_dir($filename)){
                $filename = explode('.',$filename);
                if($filename[0]==$page){
                    require "pages/".implode('.',$filename);
                    if (function_exists('content')){
                        return content();
                    }
                }
            }
        }

        foreach(scandir("pages_hidden") as $filename){
            if(!is_dir($filename)){
                $filename = explode('.',$filename);
                if($filename[0]==$page){
                    require "pages_hidden/".implode('.',$filename);
                    if (function_exists('content')){
                        return content();
                    }
                }
            }
        }

        if($_SESSION['authed']&&isAdmin($_SESSION['username'])){
            foreach(scandir("pages_admin") as $filename){
                if(!is_dir($filename)){
                    $filename = explode('.',$filename);
                    if($filename[0]==$page){
                        require "pages_admin/".implode('.',$filename);
                        if (function_exists('content')){
                            return content();
                        }
                    }
                }
            }
        }
        return "No Content";
    }

    function body_end($page){
        return "</div></body>";
    }

?>