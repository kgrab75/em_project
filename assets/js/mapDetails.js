$( document ).ready(function() {

    var jsonData = JSON.parse(xpJson);
    console.log(jsonData);
    var transportType = jsonData.transport;

    var rendererOptions = {

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
        map = new google.maps.Map(document.getElementById('mapDetails'), mapOptions);
        directionsDisplay.setMap(map);
        //DETAILS ITINERAIRE
        directionsDisplay.setPanel(document.getElementById('directionsPanel'));

        google.maps.event.addListener(directionsDisplay, 'directions_changed', function() {
            computeTotalDistance(directionsDisplay.getDirections());
        });

        calcRoute();

    }

    function calcRoute() {

        var request = {
            origin: jsonData.start,
            destination: jsonData.arrival,
            //waypoints:[{location: 'Cachan'}, {location: 'Broken Hill, NSW'}],
            travelMode: google.maps.TravelMode[transportType]
        };
        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);

            }

        });
    }

    function computeTotalDistance(result, response) {
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
        var GES = total * 69.81;

        if(GES < 1000) {
            GES = Math.round(GES*100)/100;
            document.getElementById('totalGES').innerHTML = GES + ' g';
        } else {
            GES = GES /1000;
            GES = Math.round(GES*100)/100;
            document.getElementById('totalGES').innerHTML = GES + ' kg';
        }
        document.getElementById('totalKm').innerHTML = total + ' km';

        document.getElementById('duration').innerHTML = myroute.legs[0].duration.text;

    }

    google.maps.event.addDomListener(window, 'load', initialize);


});