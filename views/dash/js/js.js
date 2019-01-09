/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var address = new Array();

/*
    * Get the json file from Google Geo
    */
function Convert_LatLng_To_Address(lat, lng, callback) {
    var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + lat + "," + lng + "&sensor=false";
            
    $.getJSON(url, function (json) {

        Create_Address(json, callback,lng,lat);
    });     
}

/*
    * Create an address out of the json 
    */
function Create_Address(json, callback,lng,lat) {
    if (!check_status(json)) // If the json file's status is not ok, then return
        return 0;
    address['country'] = google_getCountry(json);
    address['province'] = google_getProvince(json);
    address['city'] = google_getCity(json);
    address['street'] = google_getStreet(json);
    address['postal_code'] = google_getPostalCode(json);
    address['country_code'] = google_getCountryCode(json);
    address['formatted_address'] = google_getAddress(json);
    address['lat']=lat;
    address['lng']=lng;
    callback();
}

/* 
    * Check if the json data from Google Geo is valid 
    */
function check_status(json) {
    if (json["status"] == "OK") return true;
    return false;
}   

/*
    * Given Google Geocode json, return the value in the specified element of the array
    */

function google_getCountry(json) {
    return Find_Long_Name_Given_Type("country", json["results"][0]["address_components"], false);
}
function google_getProvince(json) {
    return Find_Long_Name_Given_Type("administrative_area_level_1", json["results"][0]["address_components"], true);
}
function google_getCity(json) {
    return Find_Long_Name_Given_Type("locality", json["results"][0]["address_components"], false);
}
function google_getStreet(json) {
    return Find_Long_Name_Given_Type("street_number", json["results"][0]["address_components"], false) + ' ' + Find_Long_Name_Given_Type("route", json["results"][0]["address_components"], false);
}
function google_getPostalCode(json) {
    return Find_Long_Name_Given_Type("postal_code", json["results"][0]["address_components"], false);
}
function google_getCountryCode(json) {
    return Find_Long_Name_Given_Type("country", json["results"][0]["address_components"], true);
}
function google_getAddress(json) {
    return json["results"][0]["formatted_address"];
}   

/*
    * Searching in Google Geo json, return the long name given the type. 
    * (if short_name is true, return short name)
    */

function Find_Long_Name_Given_Type(t, a, short_name) {
    var key;
    for (key in a ) {
        if ((a[key]["types"]).indexOf(t) != -1) {
            if (short_name) 
                return a[key]["short_name"];
            return a[key]["long_name"];
        }
    }
}   



getLocation();
var x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    Convert_LatLng_To_Address(position.coords.latitude,position.coords.longitude,function(){
       // console.log(position.coords.latitude,position.coords.longitude)
       // console.log( address);
    })	
}

$(function(){
    $(document).on("click","#location_fetch",function(){
        getLocation();
        $("#autocomplete").val(address.formatted_address);
    }); 
   
})

function initialize() {
    var mapProp = {
        center: new google.maps.LatLng(6.59667, 3.33618),
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.HYBRID
    };
    var ids = 'autocomplete';
    //    for (var i = 0; i <= 5; i++) {
    ids = 'autocomplete'
    //    var map = new google.maps.Map(document.getElementById("map-canvas"), mapProp);
    var addr = (document.getElementById(ids));
    autocomplete = new google.maps.places.Autocomplete(addr, {
        types: ['geocode']
    });
    //    }
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        //      var newPos = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
        GetLocation(place.geometry.location.lat(), place.geometry.location.lng());

    });


}


$(function () {
    google.maps.event.addDomListener(window, 'load', initialize);
    $(document).on("click", ".autocomplete", function () {
        if ($(this).attr("id") === "autocomplete" && $(this).hasClass("set")) {
            return;
        }

        $(".autocomplete").removeAttr("id").removeClass("set");
        $(this).attr("id", "autocomplete").addClass("set");
        initialize();
    });
})
$(function () {
   
    
})

