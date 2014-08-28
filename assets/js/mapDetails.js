$( document ).ready(function() {

    var jsonData = JSON.parse(xpJson);
    console.log(jsonData.transport);
    var transportType = jsonData.transport;

    var rendererOptions = {
        // Suppression des marker par défaut
        suppressMarkers: true

    };

    var imgD = 'assets/images/markerD.png';
    var imgA = 'assets/images/markerA.png';
    var infowindow = new google.maps.InfoWindow(), i;

    var directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);


    var directionsService = new google.maps.DirectionsService();
    var map, map2;

    var france = new google.maps.LatLng(46.658333, 2.510119);


    var start = jsonData.start;
    var parseStart = start.split(", ");

    var start = jsonData.arrival;
    var parseEnd = start.split(", ");

    var location1 = new google.maps.LatLng(parseStart[0] , parseStart[1]);
    var location2 = new google.maps.LatLng(parseEnd[0], parseEnd[1]);

    var map;
    var mapOptions = {
        center: france, zoom: 3,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };


    function initialize() {
        map = new google.maps.Map(document.getElementById("mapDetails"), mapOptions);
        directionsService = new google.maps.DirectionsService();

        // ITINERAIRES EN VOITURE
        directionsDisplay = new google.maps.DirectionsRenderer({
            suppressMarkers: true,
            polylineOptions:{strokeColor:'#a0becd', strokeWeight : 6, strokeOpacity : 1, zIndex: 1 }
        });
        directionsDisplay.setMap(map);

        var request = {
            origin: location1,
            destination: location2,
            travelMode: google.maps.DirectionsTravelMode.DRIVING
        };
        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            }


            // INSERTION DES DONNEES
            var myroute = response.routes[0];

            if(jsonData.transport !== "DRIVING") {
                document.getElementById('carDistance').innerHTML = " Trajet voiture : " +  myroute.legs[0].distance.text;
            }

            var total = response.routes[0].legs[0].distance.value;

            // TOTAL MIS AU FORMAT KM
            total = Math.round(total / 1000.0);
            var GES = total * 69.81;

            if(GES < 1000) {
                GES = Math.round(GES*100)/100;
                document.getElementById('totalGES').innerHTML = GES + ' g';
            } else {
                GES = GES /1000;
                GES = Math.round(GES*100)/100;
                document.getElementById('totalGES').innerHTML = GES + ' kg';
            }


            var tempsMin = Math.round(myroute.legs[0].duration.value / 60);

            var dureeH = Math.floor(tempsMin / 60);
            var dureeM = tempsMin % 60;

            if(dureeH !==0){
                if(dureeM < 10){
                    dureeHM = dureeH + "h0" + dureeM ;
                }else {
                    dureeHM = dureeH + "h" + dureeM ;
                }

            } else {
                dureeHM = dureeM + "m";
            }
            if(jsonData.transport !== "DRIVING") {
                document.getElementById('carDuree').innerHTML = " Trajet voiture : " + dureeHM;
            }
            console.log(response.routes[0].legs[0]);
        });



        // ITINERAIRES VIA MODE DE TRANSPORT ENREGISTRE
        directionsDisplay2 = new google.maps.DirectionsRenderer({
            suppressMarkers: true,
            polylineOptions:{strokeColor:'#33a0d4', strokeWeight : 7, zIndex: 10}
        });
        directionsDisplay2.setMap(map);

        var request = {
            origin: location1,
            destination: location2,
            travelMode: google.maps.DirectionsTravelMode[transportType]
        };
        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay2.setDirections(response);
                // INSERTION DES DONNEES
                var myroute = response.routes[0];

                var tempsMin = Math.round(myroute.legs[0].duration.value / 60);

                var dureeH = Math.floor(tempsMin / 60);
                var dureeM = tempsMin % 60;

                if(dureeH !==0){
                    if(dureeM < 10){
                        dureeHM = dureeH + "h0" + dureeM ;
                    }else {
                        dureeHM = dureeH + "h" + dureeM ;
                    }

                } else {
                    dureeHM = dureeM + "m";
                }

                document.getElementById('duration').innerHTML = dureeHM;
                document.getElementById('totalKm').innerHTML = myroute.legs[0].distance.text;

                console.log(response.routes[0].legs[0]);
            }
        });

        //DETAILS ITINERAIRE
        directionsDisplay2.setPanel(document.getElementById('directionsPanel'));


        // MARKERS

        markerStart = new google.maps.Marker({
            position: new google.maps.LatLng(parseStart[0] , parseStart[1]),
            icon:imgD,
            title:jsonData.titre,
            map: map
        });
        google.maps.event.addListener(markerStart, 'click', (function() {
            return function() {
                infowindow.setContent("<b>Départ</b>");
                infowindow.open(map, markerStart);
            }
        })(markerStart, i));


        var start = jsonData.arrival;
        var parseEnd = start.split(", ");

        markerEnd = new google.maps.Marker({
            position: new google.maps.LatLng(parseEnd[0], parseEnd[1]),
            icon:imgA,
            title:jsonData.titre,
            map: map
        });
        google.maps.event.addListener(markerEnd, 'click', (function() {
            return function() {
                infowindow.setContent("<b>Arrivée</b>");
                infowindow.open(map, markerEnd);
            }
        })(markerEnd, i));
    }
    google.maps.event.addDomListener(window, 'load', initialize);



});