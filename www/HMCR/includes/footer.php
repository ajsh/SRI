
<?php
    function footer_start($page){
        return '
            <div id="footer">';
    }

    function footer_content($page){
        return '<div class="container">
                    <div class="row">
                        <div class="col-xs-2 col-md-1" style="margin:10px 18px 15px 0">
                            <a href="http://www.iastate.edu/"><img src="image/content/IASTATEmini-logo.png" alt="Iowa State University" class="pull-left" ></a>
                        </div>
                        <div class="col-xs-4 col-md-3">
                            <p>
                                4100 Marston Hall<br>
                                533 Morrill Road<br>
                                Ames, IA 50011<br>
                                (515)-294-5933<br>
                             
                                <a href="mailto:ajshah@iastate.edu">hmcr@iastate.edu</a>
                            </p>
                        </div>

                        <div class="col-xs-6 col-md-3">
                            <p>
                                <a href="https://www.digitalaccess.iastate.edu/">Digital Access & Accessibility</a><br>
                                <a href="http://www.policy.iastate.edu/policy/discrimination">Non-discrimination Policy</a><br>
                                <a href="http://www.policy.iastate.edu/electronicprivacy">Privacy Policy</a>
                                <!--<form method="POST" id="nav_submit" action="includes/page_functions.php">
                                <input name="set_page" value="login" hidden>
                                <a href="javascript:;" onclick="this.parentNode.submit();">Login</a>
                                </form>-->
                                <br>
                                <a href="javascript:;" onclick=set_page("login")>Login</a>

                                <br><br>
                                <p><b>Created By:</b></p>
                                <p>Collin Kauth-Fisher</p>
                                <p>Aayush Shah</p>
                            </p>
                        </div>

                        <div class="col-xs-3 col-md-3">
                            <p>
                                <a href="http://www.policy.iastate.edu/electronicprivacy">Policies</a><br>
                                <a href="http://www.policy.iastate.edu/policy/discrimination">Legal Notices</a><br>
                            </p>
                        </div>

                        <div class="col-xs-6 col-md-3">
                            <h5 style="margin-top:0; padding-top:0;">Follow us on Twitter</h5>
                            <p></p>
                            <a href="https://twitter.com/IASTATE"><img src="image/content/twitter.png"></a>
                            &nbsp;&nbsp;
                            <a href="https://twitter.com/IASTATE"> @IASTATE</a>
                            <p></p>
                        </div>
                    </div> <!-- /row -->

                    <!--<p>
                        <script language="javascript">
                            document.write("Last updated: " + document.lastModified +"");
                        </script>
                    </p>-->

                </div> <!-- /container -->';
    }

    function footer_end($page){
        return ' </div> <!-- /footer -->';
    }  
       
?>