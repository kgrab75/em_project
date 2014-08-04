$( document ).ready(function() {

    var directionsDisplay;
    var directionsService = new google.maps.DirectionsService();

    function initialize() {
        directionsDisplay = new google.maps.DirectionsRenderer();

        var mapOptions = {
            zoom: 15,
            center: new google.maps.LatLng(48.837731, 2.243580)
        };
        var map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById('directions-panel'));

        var control = document.getElementById('control');
        control.style.display = 'block';
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);
    }

    function calcRoute() {
        // Champ qui permet de rentrer le lieu de départ
        var start = "30 avenue du docteur calmette 92140 clamart";
        // Champ qui permet d'entrer le lieu d'arrivé
        var end = "48.837279, 2.242078";
        var request = {
            origin: start,
            destination: end,
            travelMode: google.maps.TravelMode.DRIVING

        };
        console.log(directionsDisplay);
        directionsService.route(request, function(response, status) {

            if (status == google.maps.DirectionsStatus.OK) {

                directionsDisplay.setDirections(response);

            }
        });
    }


    google.maps.event.addDomListener(window, 'load', initialize);
    calcRoute();



});