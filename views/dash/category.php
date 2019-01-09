<!DOCTYPE html>
<?php
//require '../../libs/Libs.php';
//$cat = $this->loc; 
?>

<?php
require '../../libs/Session.php';
require '../../libs/Hash.php';
require '../../functions/index_model.php';
//        $data=array(
//        "accounting",
//        "airport",
//        "amusement_park",
//        "aquarium",
//        "art_gallery",
//        "atm",
//        "bakery",
//        "bank",
//        "bar",
//        "beauty_salon",
//        "bicycle_store",
//        "book_store",
//        "bowling_alley",
//        "bus_station",
//        "cafe",
//        "campground",
//        "car_dealer",
//        "car_rental",
//        "car_repair",
//        "car_wash",
//        "casino",
//        "cemetery",
//        "church",
//        "city_hall",
//        "clothing_store",
//        "convenience_store",
//        "courthouse",
//        "dentist",
//        "department_store",
//        "doctor",
//        "electrician",
//        "electronics_store",
//        "embassy",
//        "establishment",
//        "finance",
//        "fire_station",
//        "florist",
//        "food",
//        "funeral_home",
//        "furniture_store",
//        "gas_station",
//        "general_contractor",
//        "grocery_or_supermarket",
//        "gym",
//        "hair_care",
//        "hardware_store",
//        "health",
//        "hindu_temple",
//        "home_goods_store",
//        "hospital",
//        "insurance_agency",
//        "jewelry_store",
//        "laundry",
//        "lawyer",
//        "library",
//        "liquor_store",
//        "local_government_office",
//        "locksmith",
//        "lodging",
//        "meal_delivery",
//        "meal_takeaway",
//        "mosque",
//        "movie_rental",
//        "movie_theater",
//        "moving_company",
//        "museum",
//        "night_club",
//        "painter",
//        "park",
//        "parking",
//        "pet_store",
//        "pharmacy",
//        "physiotherapist",
//        "place_of_worship",
//        "plumber",
//        "police",
//        "post_office",
//        "real_estate_agency",
//        "restaurant",
//        "roofing_contractor",
//        "rv_park",
//        "school",
//        "shoe_store",
//        "shopping_mall",
//        "spa",
//        "stadium",
//        "storage",
//        "store",
//        "subway_station",
//        "synagogue",
//        "taxi_stand",
//        "train_station",
//        "transit_station",
//        "travel_agency",
//        "university",
//        "veterinary_care",
//        "zoo",
//        )


$data = array(
    "bank",
    "cafe",
    "church",
    "food",
    "hospital",
    "mosque",
    "night_club",
    "place_of_worship",
    "restaurant",
    "school",
    "store"
        )
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
    <body class="templatemo_garden_bg">
        <div id="main_container">
            <div class="container " id="contact">
                <div class="row col-wrap templatemo_garden_bg">			 
                    <div id="left_container" class="col col-md-3 col-sm-12">
                        <h6 style="color: #fff;text-transform: capitalize">
                            Welcome <?php Session::init();
echo Session::get('usr'); ?>
                            to Nearest Location Finder
                        </h6>
                    </div>			  	
                    <div id="right_container" class="col col-md-9 col-sm-12" style="padding-bottom: 50px">
                        <form role="form" action="#" method="post">
                            <div class="row" style=" margin-bottom: 10px">
                                <div class="col-md-5" style="border: #fff solid thin;padding: 5px">
                                    <div class="row">
                                        <div class="col col-md-12">
                                            <h5 style="color: #fff">
                                                <span class="glyphicon glyphicon-cog">
                                                </span> setting
                                            </h5>
                                        </div>
                                        <div class="row">
                                            <div class="form-group left-inner-addon col-md-6 col-sm-6 col-xs-6">
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                                <input name="ranges" type="text" class="form-control" id="ranges" list="range" placeholder="Range" />
                                            </div>
                                            <div id="location_fetch" class="form-group left-inner-addon col-md-6 col-sm-6 col-xs-6 right" style="font-family: helvetica;text-align: left; height: 45px;font-size: 14px;text-transform: capitalize;padding-right: 0">
                                                <span class="glyphicon glyphicon-map-marker text-success"></span>  
                                                <div style="margin-left: 30px;margin-top: 6px;" class="btn btn-success">My Location</div>  


                                            </div>
                                            <div style="clear: both"></div>
                                            <div class="form-group left-inner-addon col-xs-12">
                                                <span class="glyphicon glyphicon-map-marker"></span>
                                                <input name="autocomplete" type="text" class="form-control autocomplete" id="autocomplete"  placeholder="From where" />
                                            </div>
                                        </div> 
                                    </div> 
                                </div> 

                                <div class="row">
                                    <div class="col col-md-12" style="text-align: center;"><h3 style="color: rgba(255,255, 255, 0.7);">Category</h3>
                                        <h3>  <small style="color: #fff">please select your location category below</small></h3>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="col-md-5" style="background-color: #fff;padding: 10px">
                                        <?php
                                        foreach ($data as $key => $value) {
                                            $val = str_replace('_', ' ', $value);
                                            echo " <div class='form-group left-inner-addon cte cat'>
                                            <span class='glyphicon glyphicon-tags'></span>
                                            <div style='margin-left: 40px' class='locat'>{$val}</div>  
                                        </div>";
                                        }
                                        ?>
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
            <a  id="logout" href="?logout=2">logout</a>
        </div>

        <div class="overlay_all">
            <span class="close close_red">X</span>
            <div class="overlay_body">
                <div class="map_div">
                    <div class="map" id="map">

                    </div>  
                    <div class="map" id="places">

                    </div>  
                    <div class="map" id="more">

                    </div>  
                </div>
                <div class="detail_div">
                    <div class="detail">

                    </div> 
                </div>
                <div class="path_div">
                    <div class="path">

                    </div>  
                </div>
            </div>
        </div>

        <datalist id="range">
            <?php
            for ($i = 0; $i < 50; $i++) {

                echo "<option value='" . ($i * 50) . "'>" . ($i * 50) . " meter</option>";
            }
            ?>

        </datalist>
    </body>
    <script src='../index/js/jquery2.1.3.min.js'></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhd9ZWMQ3dTPiYVlTQbLCUqH5sAl-WJeA&v=3.exp&signed_in=false&libraries=places"></script>
    <script src="../index/js/google_address.js"></script>
    <script type='text/javascript' src='js/js.js'></script>
    <script >
        $("a#logout").click(function(e){
            e.preventDefault();
            $.get("?logout=2",  function (data) {
                var url = "../index/index.php";
                $(location).attr('href', url);

            });
        })    
    </script>
    <script type='text/javascript' src='../index/js/logging.js'></script>
</html>