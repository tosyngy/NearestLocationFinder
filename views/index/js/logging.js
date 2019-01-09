var address_id=[];

$(function(){
   
   
    $(document).on("click",".cte.loc",function(){
        var lg= $(this).find(".loglatkep").attr("lng");
        var lt=$(this).find(".loglatkep").attr("lat");
        var plc=$(this).find(".placeloc").html();
        var lt2=$("#infosearch").attr("lat");
        var lg2=$("#infosearch").attr("lng");
        
        console.log(lg);
        console.log(lt);
        console.log(lg2);
        console.log(lt);
        
        $(".detail").replaceWith("<div class='detail'>"+plc+"</div>");
     
        init(lt,lg,plc)
        initMapy(lg2, lt2,lg, lt);
       
        //$(".overlay_all").fadeOut();
        $(".overlay_all").css({
            "z-index":"1000"
        });
    //  $(".overlay_all").fadeIn();
    })
    $(document).on("click",".close.close_red",function(){
        // $(".overlay_all").fadeIn();
        $(".overlay_all").css({
            "z-index":"-1000"
        });
    // $(".overlay_all").fadeOut();
    })
    
    $(document).on("click",".locat",function(e){
        var url="suggestlocation.php?place="+$(this).text()+"&range="+$("#ranges").val()+"&lat="+address.lat+"&lng="+ address.lng
        if($("#ranges").val().length==0){
            alert("Supply the range you which to cover"); 
            $("#ranges").select();
            $("#ranges").focus();
            return;
        }
        if(address.lng.length==0){
            alert("Supply your location"); 
            $("#autocomplete").select();
            $("#autocomplete").focus();
            return;
        }
        $(location).attr('href', url);
    })
    //    console.log($("#infosearch").attr("lat"))
    //    console.log($("#infosearch").attr("lng"))
    //    console.log($("#infosearch").attr("range"))
    //    console.log($("#infosearch").attr("place"))
    initMap($("#infosearch").attr("lat"),$("#infosearch").attr("lng"),  $("#infosearch").attr("range"), $("#infosearch").attr("place").replace(" ", "_"));

});






var map;
function initMap( lat, lng,  rad, place) {
    if(rad.length==0){
        rad=500;
    }
    var pyrmont = {
        lat: parseFloat(lat), 
        lng: parseFloat(lng)
    };
    map = new google.maps.Map(document.getElementById('map'), {
        center: pyrmont,
        zoom: 17
    });
    var service = new google.maps.places.PlacesService(map);
    service.nearbySearch({
        location: pyrmont,
        radius: rad,
        type: place
    }, processResults);
}

function processResults(results, status, pagination) {
    if (status !== google.maps.places.PlacesServiceStatus.OK) {
        return;
    } else {
        createMarkers(results);
        
        if (pagination.hasNextPage) {
            var moreButton = document.getElementById('more');
            //  moreButton.disabled = false;
            moreButton.addEventListener('click', function() {
                moreButton.disabled = true;
                pagination.nextPage();
            });
        }
    }
}

function createMarkers(places) {
    var bounds = new google.maps.LatLngBounds();
    var placesList = document.getElementById('places');
    
    for (var i = 0, place; place = places[i]; i++) {
        var image = {
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(25, 25)
        };
        
        
        var service = new google.maps.places.PlacesService(map);
        service.getDetails({
            placeId: place.place_id
        }, function(place, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                var marker = new google.maps.Marker({
                    map: map,
                    position: place.geometry.location
                });
//                 google.maps.event.addListener(marker, 'click', function() {
//                    infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
//                        'Place ID: ' + place.place_id + '<br>' +
//                        place.formatted_address + '</div>');
//                    infowindow.open(map, this);
//                 });
                
                var lat2=place.geometry.location.lat();
                var lng2=place.geometry.location.lng();
                var lat1=$("#infosearch").attr("lat");
                var lng1=$("#infosearch").attr("lng");
                lat2=parseFloat(lat2);
                lng2=parseFloat(lng2);
                var dist= distance(lng1,lat1,lng2,lat2)
                dist=parseInt(dist*100)/100;
                var te= "<div class='form-group cte loc ads'>"
                + "<div class='placeloc'><div class='col-sm-8 col-xs-8'>"
                +place.name
                +"</div>"+
                "<div class='col-sm-4 col-xs-4'>"+dist+"km</div></div>"
                +"<span class='loglatkep' lng='"+lng2+"' lat='"+lat2+"'></span>"
                + "<div style='clear:both'></div>"
                +" <div class='left-inner-addon cte ads' style='border:none'>"
                + " <span class='glyphicon glyphicon-map-marker'></span>"
                + " <div class='col-sm-12 col-xs-12 ' style='margin-left: 40px'>"+place.formatted_address+"</div>"  
                +"</div></div>"; 
                $("#list_place").append(te)
            //                console.log(place)
            //                console.log(place.formatted_address)
            //                console.log(place.name)
              
              
            //     });
            }
        });
        
        
        
        var marker = new google.maps.Marker({
            map: map,
            icon: image,
            title: place.name,
            position: place.geometry.location
        });
        
        //  placesList.innerHTML += '<li>' + place.name + '</li>';
        
        bounds.extend(place.geometry.location);
    }
    map.fitBounds(bounds);
}


function distance(lon1, lat1, lon2, lat2) {
    var R = 6371; // Radius of the earth in km
    var dLat = (lat2-lat1).toRad();  // Javascript functions in radians
    var dLon = (lon2-lon1).toRad(); 
    var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) * 
    Math.sin(dLon/2) * Math.sin(dLon/2); 
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
    var d = R * c; // Distance in km
    return d;
    
}

/** Converts numeric degrees to radians */
if (typeof(Number.prototype.toRad) === "undefined") {
    Number.prototype.toRad = function() {
        return this * Math.PI / 180;
    }
}

window.navigator.geolocation.getCurrentPosition(function(pos) {
    //    console.log(pos); 
    // 
    //    console.log(distance(pos.coords.longitude, pos.coords.latitude, 42.37, 71.03)); 
    });

function toRad(Value) {
    /** Converts numeric degrees to radians */
    return Value * Math.PI / 180;
}


function init(lat,log,content) {
    
    var mapProp = {
        center:new google.maps.LatLng(lat,log),
        zoom:18,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    var map=new google.maps.Map(document.getElementById("map"),mapProp);
    var myCenter=new google.maps.LatLng(lat,log);
    var marker=new google.maps.Marker({
        position:myCenter
    });
    marker.setMap(map);
    var infowindow = new google.maps.InfoWindow({
        content:content
    });

    infowindow.open(map,marker);
 
}
google.maps.event.addDomListener(window, 'load', init);





function initMapy(lg, lt, lg2, lt2) {
    var directionsDisplay = new google.maps.DirectionsRenderer;
    var directionsService = new google.maps.DirectionsService;
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 7,
        center: new google.maps.LatLng(lt2,lg2)
    });
    directionsDisplay.setMap(map);
    $("#dir_path").text("")
    directionsDisplay.setPanel(document.getElementById('dir_path'));
    
    var control = document.getElementById('div_path');
    // control.style.display = 'block';
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);

    calculateAndDisplayRoute(directionsService, directionsDisplay,lg, lt, lg2, lt2);
    
}

function calculateAndDisplayRoute(directionsService, directionsDisplay,lg, lt, lg2, lt2) {
    var start = new google.maps.LatLng(lt,lg);
    var end = new google.maps.LatLng(lt2,lg2);
    directionsService.route({
        origin: start,
        destination: end,
        travelMode: 'DRIVING'
    }, function(response, status) {
        if (status === 'OK') {
            directionsDisplay.setDirections(response);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}