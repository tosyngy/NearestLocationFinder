<!DOCTYPE html>
<?php
//require '../../libs/Libs.php';
//$cat = $this->loc; 
?>

<?php
require '../../libs/Session.php';
require '../../libs/Hash.php';
require '../../functions/index_model.php';
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <title>Category | Nearest Location Finder</title>
        <meta name="keywords" content="botany, contact, maps, responsive, bootstrap, free template, fluid layout, templatemo, html css" />
        <meta name="description" content="Botany Template, Contact, Maps, responsive page with bootstrap" />
        <link href="../index/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="../index/css/templatemo_style.css" rel="stylesheet" type="text/css">

        <!-- HTML 5 shim for IE backwards compatibility -->
        <!-- [if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
        </script>
        <![endif]-->
        <!-- 
        Credits
        Equal Height Columns http://www.hongkiat.com/blog/css-equal-height/ -->
    </head>
    <body class="templatemo_garden_bg" id="suggestion">
        <div id="main_container">
            <div class="container " id="contact">
                <div class="row col-wrap templatemo_garden_bg">			 
                    <div id="left_container" class="col col-md-3 col-sm-12">
                        <h6 style="color: #fff">Nearest Location Finder</h6>
                    </div>			  	
                    <div id="right_container" class="col col-md-9 col-sm-12" style="padding-bottom: 50px">
                        <input name="autocomplete" type="hidden" class="form-control autocomplete" id="autocomplete"  placeholder="From where" />

                        <form role="form" action="#" method="post">
                            <div class="row" style=" margin-bottom: 10px">
                                <div class="row">
                                    <div class="col col-md-12" style="text-align: center;"><h3 style="color: rgba(255,255, 255, 0.7);text-transform: capitalize"><?php echo $cat; ?></h3>
                                        <h3>  <small style="color: #fff">please select your location category below</small></h3>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="col-md-5"  id="list_place"style="background-color: #fff;padding: 10px">

                                    </div> 
                                </div> <!-- row -->
                            </div>
                        </form>
                    </div>


                </div>		
            </div>
        </div>
        <div style="clear: both">

        </div>
        <div id="left_container"  class="col-sm-12" style="position: fixed; bottom: 0;width: 100%">
            <a href="category.php">Back</a>  | <a  id="logout" href="?logout=2">logout</a>
        </div>
        <datalist id="range">
            <?php
            for ($i = 0; $i < 50; $i++) {

                echo "<option value='" . ($i * 10) . "'>" . ($i * 10) . " km</option>";
            }
            ?>

        </datalist>
    </body>
    <div id="infosearch" place="<?php $_GET['place']; ?>" range="<?php echo $_GET['range']; ?>" lat="<?php echo $_GET['lat']; ?>" lng="<?php echo $_GET['lng']; ?>">

    </div>


    <div class="overlay_all" style="display: block">
        <div class="overlay_body">
            <span class="close close_red">X</span>
            <div class="map_div">
                <div class="map" id="map" style="height: 100%;width: 100%">

                </div>  
            </div>
            <div class="detail_div">
                <div class="detail" id="detail">

                </div> 
            </div>
            <div class="path_div" style="">
                <div class="path"  id="dir_path"style="">

                </div>  
            </div>
        </div>
    </div>

    <script src='../index/js/jquery2.1.3.min.js'></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhd9ZWMQ3dTPiYVlTQbLCUqH5sAl-WJeA&v=3.exp&signed_in=false&libraries=places"></script>
    <script src="../index/js/google_address.js"></script>
    <script type='text/javascript' src='js/js.js'></script>
     <script type='text/javascript' src='../index/js/logging.js'></script>
</html>




