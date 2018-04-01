<?php
function getFooter($page){
    $theme = new Site\Theme();

    $theme->setOption('footer_created_by',[
        'names' =>[
            'Collin Kauth-Fisher',
            'Aayush Jayprakash Shah',
            'Dr. Sri Sritharan'
            ],
        'emails' => [
            'ckauth97@iastate.edu',
            'ajshah@iastate.edu',
            'sri@iastate.edu'],
        'time'=>"Spring 2017",
        [$reset = true]]);
    $theme->drawFooter();

}
?>