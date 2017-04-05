// Google map

//page participate

var initMap = function() {
    var myLatLng = new google.maps.LatLng(43.550404, 7.017419);
    var mapOptions = {
        center: myLatLng,
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.PLAN,
        scrollwheel: false,
        draggable: false,
        panControl: false,
        zoomControl: true,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: true,
        overviewMapControl: true,
        rotateControl: true
    }
    var map = new google.maps.Map(document.getElementById("google-map"), mapOptions);

    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: GLOBALS.texts.googleMap.title
    });

}