$( document ).ready(function() {

var rendererOptions = {
    draggable: true
};
var directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);;
var directionsService = new google.maps.DirectionsService();
var map;

var france = new google.maps.LatLng(46.658333, 2.510119);

function initialize() {

    var mapOptions = {
        zoom: 7,
        center: france
    };
    map = new google.maps.Map(document.getElementById('mapPreview'), mapOptions);
    directionsDisplay.setMap(map);
    //DETAILS ITINERAIRE
    //directionsDisplay.setPanel(document.getElementById('directionsPanel'));

    google.maps.event.addListener(directionsDisplay, 'directions_changed', function() {
        computeTotalDistance(directionsDisplay.getDirections());
    });

    calcRoute();
}

function calcRoute() {

    var request = {
        origin: 'Paris',
        destination: 'Clamart',
        //waypoints:[{location: 'Cachan'}, {location: 'Broken Hill, NSW'}],
        travelMode: google.maps.TravelMode.DRIVING
    };
    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);

            //DUREE DU PARCOURS
            var duration = response.routes[0].legs[0].duration.text;
            document.getElementById('duration').innerHTML = duration;
        }
    });
}

function computeTotalDistance(result) {
    var total = 0;
    var myroute = result.routes[0];
    for (var i = 0; i < myroute.legs.length; i++) {
        total += myroute.legs[i].distance.value;
    }

    // CALCUL GES
    //var GES = 0.06981 kg;
    //var GES =  70 g;

    // TOTAL MIS AU FORMAT KM
    total = total / 1000.0;
    var GES = total * 70;
    document.getElementById('totalKm').innerHTML = total + ' km';
    document.getElementById('totalGES').innerHTML = GES + ' g';
}

google.maps.event.addDomListener(window, 'load', initialize);


});