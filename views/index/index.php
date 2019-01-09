<?php
//require '../../libs/Libs.php';
require '../../libs/Session.php';
require '../../libs/Hash.php';
require '../../functions/index_model.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <title>Login | Nearest Location Finder</title>
        <meta name="keywords" content="botany, contact, maps, responsive, bootstrap, free template, fluid layout, templatemo, html css" />
        <meta name="description" content="Botany Template, Contact, Maps, responsive page with bootstrap" />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/templatemo_style.css" rel="stylesheet" type="text/css">

        <!-- HTML 5 shim for IE backwards compatibility -->
        <!-- [if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
        </script>
        <![endif]-->
        <!-- 
        Credits
        Equal Height Columns http://www.hongkiat.com/blog/css-equal-height/ -->
    </head>
    <body class="templatemo_garden_bg">
        <div id="main_container">
            <div class="container " id="contact">
                <div class="row col-wrap templatemo_garden_bg">			 
                    <div id="left_container" class="col col-md-3 col-sm-12">
                        <h6 style="color: #fff;text-transform: capitalize">
                           Nearest Location Finder
                        </h6>
                    </div>			  	
                    <div id="right_container" class="col col-md-9 col-sm-12">
                        <div class="row"><div class="col col-md-12"><h3 style="text-align: center;color: rgba(255,255, 255, 0.7);">LOGIN</h3></div></div>

                        <form role="form" action="#" method="post" id="login-form">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group left-inner-addon">
                                        <span class="glyphicon glyphicon-user"></span>
                                        <input name="te" type="text" class="form-control" id="input_name" placeholder="Username or Email">
                                    </div>
                                    <div class="form-group left-inner-addon">
                                        <span class="glyphicon glyphicon-lock"></span>
                                        <input name="tp" type="password" class="form-control" id="input_pass" placeholder="Password">
                                    </div>
                                    <div class="form-group left-inner-addon">
                                        <button class="btn btn-theme btn-block" type="submit" id="admin_login"><i class="glyphicon glyphicon-log-in"></i> SIGN IN</button> 
                                    </div>
                                    <input name="coming_from" type="hidden" value="i"/>
                                    <div class="col-sm-12">
                                        <div id="err-login"></div>
                                    </div>
                                </div> 
                            </div> <!-- row -->
                        </form>


                    </div>
                    <div style="clear: both">

                    </div>
                    <div id="left_container"  class="col-sm-12" style="position: fixed; bottom: 0;width: 100%">
                        <a href="register.php">Register</a>
                    </div>
                </div>


            </div>		
        </div>
    </body>
    <script src='js/jquery2.1.3.min.js'></script>
    <script type='text/javascript' src='js/login.js'></script>
</html>