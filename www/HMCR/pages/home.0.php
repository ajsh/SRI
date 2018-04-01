<?php

function content(){
    $html = '
    <div class="container-fluid">
        <hr>
        <div class="row">
            <div id="riskCarousel" class="carousel slide" data-ride="carousel"><!-- Begin riskCarousel -->
                <!-- Indicators -->
                <!--<ol class="carousel-indicators">
                    <li data-target="#riskCarousel" data-slide-to="0" class=""></li>
                    <li data-target="#riskCarousel" data-slide-to="1" class=""></li>
                    <li data-target="#riskCarousel" data-slide-to="2" class="active"></li>
                    <li data-target="#riskCarousel" data-slide-to="3" class=""></li>
                </ol>-->
                <div class="carousel-inner" role="listbox"><!-- BEGIN Wrapper for slides -->';

    $image_file_path='image/content/home-carousel';
    $images = glob($image_file_path."/*");

    $active = false;
    foreach($images as $image){
        $html .= '<div class="item '.((!$active)?("active"):("")).'">
                        <img src="';
        $active = true;
        $html .= $image;
        $html .=        '" class="img-responsive center-block" style="height:400px">
                        <div class="img-responsive carousel-caption">
                            <p><em>Evalutation & Response</em><br>'.
                                strtoupper(explode(".",basename($image))[0])
                            .'</p>
                        </div>
                    </div>';
    }

    $html .= '
                </div><!-- END Wrapper for slides -->
                <!-- Controls -->
                <a class="left carousel-control" href="http://risk.ou.edu/index.html#riskCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="http://risk.ou.edu/index.html#riskCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div><!-- End riskCarousel -->
            
        </div> <!-- end row -->
    </div> <!-- end container -->


    <br>

    <style>
        #home-lead div.well ul li {margin-top:16px};
    </style>

    <div id="home-lead">
        <div class="container">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">

                    <div class="well" style="font-size:.9em;">
                        <div class="row" id="whatsnew">
                            <style>
                                div#whatsnew strong {color:#666;}
                                div#whatsnew ul.lead1 li ul li {margin-top:2px; margin-bottom:4px;}
                            </style>
                            <h2 style="margin-left:20px; text-align:center">About HMCR at Iowa State</h2>
                            <div class="col-md-6">
                                <ul class="lead1">

                                    <li>
                                        <strong>Goals</strong>
                                        <ul>
                                            <li>Formalize HMCR Program</li>
                                            <li>Bring together faculty and students working together in HMCR Areas
                                                <ul>
                                                    <li>Risk Assesment</li>
                                                    <li>Hazard Mitigation</li>
                                                    <li>Enviroment Damage</li>
                                                    <li>Condition Assesment</li>
                                                    <li>Smart Structures</li>
                                                    <li>Decision Sciences</li>
                                                    <li>Community Resilience</li>
                                                </ul>
                                            </li>
                                            <li>Strengthen cross-campus partnerships through seed funds as an incentive to foster deep and lasting research collaboration.</li>
                                        </ul>
                                    </li>

                                    <li>
                                        <strong>Components</strong>
                                        <ul>
                                            <li>Align the HMCR program with CoE priorities.</li>
                                            <li>Bringing together faculty in political, sociological and economic dimensions.</li>
                                            <li>Establish interdisciplinary academic program (Minor, Certificate, and/or Masters program)</li>
                                            <li>Potential new faculty members specifically for the program as needed.</li>
                                            <li>Incorporate talents and expertise of the donor as consultant or advisor.</li>
                                            <li>Secure grants from NIST, FEMA, NSF, and Homeland Security</li>
                                            <li>Provide seed funding and grad research scholarships for faculty and students working in HMCR as result of CoE leadership encouragement.</li>
                                        </ul>
                                    </li>

                                </ul><!-- end ul.lead1 -->
                            </div><!-- col-md-5 -->

                        </div><!-- end row-->

                    </div>

                    <p class="lead text-justify">
                        



                        
                    </p>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div> <!-- end container -->
    </div> <!-- end home-lead -->

    <div id="pullouts">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center">Risk Institute capacities...</h2>
                    <br><br>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-xs-4">
                            <img src="image/content/icon-weather.png" class="img-responsive center-block" alt="xxxxxxx"><br>
                            <p>Analyze the relationship between real and perceived changes in weather and climate</p>
                        </div>
                        <div class="col-xs-4">
                            <img src="image/content/icon-bigdata.png" class="img-responsive center-block" alt="xxxxxxx"><br>
                            Use big data, social media, and machine learning to follow and analyze public conversations about risk
                        </div>
                        <div class="col-xs-4">
                            <img src="image/content/icon-security.png" class="img-responsive center-block" alt="xxxxxxx"><br>
                            Examine public views on national security issues like nuclear deterrence, terrorism, and the use of drones
                        </div>
                    </div>

                    <br><br>
                    <div class="row">
                        <div class="col-xs-4">
                            <img src="image/content/icon-decisionmaking.png" class="img-responsive center-block" alt="xxxxxxx"><br>
                            Measure decision-making skills
                        </div>
                        <div class="col-xs-4">
                            <img src="image/content/icon-energy.png" class="img-responsive center-block" alt="xxxxxxx"><br>
                            Analyze public perceptions of the risks and benefits of varying energy sources
                        </div>
                        <div class="col-xs-4">
                            <img src="image/content/icon-roads.png" class="img-responsive center-block" alt="xxxxxxx"><br>
                            Simulate the impacts of extreme events such as storm surges and earthquakes on infrastructure like bridges, roads, and levees
                        </div>
                    </div>

                    <br><br>
                    <div class="row">
                        <div class="col-xs-4">
                            <img src="image/content/icon-infrastructure.png" class="img-responsive center-block" alt="xxxxxxx"><br>
                            Find innovative ways to design and construct resilient infrastructure in areas of extreme events, taking into consideration the changing climate
                        </div>
                        <div class="col-xs-4">
                            <img src="image/content/icon-water.png" class="img-responsive center-block" alt="xxxxxxx"><br>
                            Study community preparation for, responsiveness to, and recovery from extreme weather and water events
                        </div>
                        <div class="col-xs-4"></div>
                    </div>

                </div> <!-- end col-md-12 -->
            </div> <!-- end row -->
        </div> <!-- end container -->
    </div> <!-- end #pullouts -->';

    return $html;
    }

    function javascript($page){
        return "$('#riskCarousel').carousel({ interval: 7000 });";
    }
?>