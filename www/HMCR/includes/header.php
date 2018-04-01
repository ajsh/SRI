
<?php
function header_start($page){}

function header_content($page){
    $html = '
        <div id="masthead">
            <div class="container">
                <div class="row">
                    <div class="col-md-12" align="left">
                        <a href="javascript:;" onclick=set_page("home")><img title="HomepageHeader" alt="HRCM" src="image/content/IASTATE-logo.png" class="img-responsive" style="float:left; display: inline; "></a>
                    </div>
                </div>
            </div>
        </div>


        <div id="navmenu">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group btn-group-justified" role="group">
                            <!--<form method="POST" id="nav_submit" action="includes/page_functions.php" hidden></form>-->';
    $pages = array();
    $files = scandir("pages");
    $max   = 0;
    for($i = 0; $i < count($files); $i++){
        if(!is_dir($files[$i])){
            $file = explode('.', basename($files[$i],".php"));
            if(count($file) == 2 && !in_array($file, $pages)){
                if(in_array($file[1],array_keys($pages))) die("ERROR [Page Enumeration][Same Index]: ".$file[0]." and ".$pages[$file[1]]);

                $add = array($file[1]=>$file[0]);
                if(intval($file[1])>$max) $max = intval($file[1]);
                $pages += $add;
            }
        }
    }

    for($i = 0; $i <= $max; $i++){
        if(in_array($i,array_keys($pages))){
            $html .= '<div class="btn-group" role="group">
                            <button class="btn btn-default';
            if($page==str_replace(" ","",$pages[$i])) $html .= ' active';
            $html .= '" onclick=set_page("'.str_replace(" ","",$pages[$i]).'")>'.ucwords($pages[$i]).'</button></div>';
        }
    }

    $html .= '             
                        </div>
                    </div>
                </div>
            </div><!-- end container -->
        </div><!-- end navmenu --> ';

    return $html;

}

function header_end($page){}
?>
