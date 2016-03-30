function initialize() {
    var myLatLng = new google.maps.LatLng(43.5477427, 7.0300728);
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
                rotateControl: true,
            }
            var map = new google.maps.Map(document.getElementById("google-map"), mapOptions);
    
    var marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      title: GLOBALS.texts.googleMap.title
  });

}

$(document).ready(function() {

    if($('#google-map').length) {
        console.log("fieznkl");
        google.maps.event.addDomListener(window, 'load', initialize);
    }
});