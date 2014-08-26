$( document ).ready(function() {
/*
    var jsonData = JSON.parse(xpJson);
    console.log(jsonData);
    console.log(jsonData.length);

    var i = 0;
    var GES, transport, dureeHM, distance, content;

    var transportType = jsonData[i].transport;
    var difficulty = jsonData[i].difficulty;
    var titre = jsonData[i].titre;
    var description = jsonData[i].description;
    var id = jsonData[i].id;

    var rendererOptions = {
        // Suppression des marker par défaut
        suppressMarkers: true

    };

    var france = new google.maps.LatLng(46.658333, 2.510119);
    var map;
    var mapOptions = {
        center: france, zoom: 3,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);

    var directionsService = new google.maps.DirectionsService();





    while (i < jsonData.length) {

        if(jsonData[0].transport == "DRIVING"){

        }

        if(jsonData[0].transport == "WALKING"){
            transport = "Marche à pied";
        } if(jsonData[0].transport == "WALKING"){
            transport = "Marche à pied";
        } if(jsonData[0].transport == "TRANSIT"){
            transport = "Transport en commun";
        } if(jsonData[0].transport == "BICYCLING"){
            transport = "Vélo";
        } if(jsonData[0].transport == "DRIVING"){
            transport = "Covoiturage";
        }




        var start = jsonData[i].start;
        var parseStart = start.split(", ");

        var start = jsonData[i].arrival;
        var parseEnd = start.split(", ");

        var location1 = new google.maps.LatLng(parseStart[0] , parseStart[1]);
        var location2 = new google.maps.LatLng(parseEnd[0], parseEnd[1]);

        var idDiv = "xp" + i;

        content = "";
        content += "<div class='' id='" + idDiv +"'>";

        content     += "<a class='head' href=''><h3 class='h3Bloc panel-heading'><span class='badgeRight'> - </span></h3></a>";

        content         += "<div class='content-area col-sm-12'>";

        content             += "<p></p>";

        content             += "<div class='clear'></div>";
        content             += "<div class='col-sm-12 bg-secondary infosParcours'>";

        content             += "<div class='col-sm-3 text-center'><p></p></div>";
        content             += "<div class='col-sm-3 text-center'><p><i class='fa fa-clock-o'></i> </p></div>";
        content             += "<div class='col-sm-3 text-center'><p><i class='fa fa-location-arrow'></i> </p></div>";
        content             += "<div class='col-sm-3 text-center'><p><i class='fa fa-signal'></i> </p></div>";

        content             += "</div>";
        content         += "</div>";
        content     += "</div>";
        content += "</div>";
        content += "<div class='clear'></div>";


        $("#xpContent").append(content);
        console.log(i);


        google.maps.event.addDomListener(window, 'load', initialize);

        i++;
    }



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
                total = response.routes[0].legs[0].distance.value;
                var myroute = response.routes[0];


                // TOTAL MIS AU FORMAT KM
                total = Math.round(total / 1000.0);
                GES = total * 69.81;

                if(GES < 1000) {
                    GES = Math.round(GES*100)/100;
                    //document.getElementById('totalGES').innerHTML = GES + ' g';
                    console.log("GES : " +  GES + ' g');
                } else {
                    GES = GES /1000;
                    GES = Math.round(GES*100)/100;
                    //document.getElementById('totalGES').innerHTML = GES + ' kg';
                    console.log("GES : " +  GES + ' kg');
                }
                //document.getElementById('totalKm').innerHTML = myroute.legs[0].distance.text;
                console.log("Total KM : " +  myroute.legs[0].distance.text);
                distance =  response.routes[0].legs[0].distance.text;
                distance =  distance + "";

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

                //document.getElementById('duration').innerHTML = dureeHM;
                console.log(dureeHM);


                console.log(response.routes[0].legs[0]);
            }


        });


    }





*/

        var dataLast = JSON.parse(xpJson);
        console.log(dataLast);



    // *********** FONCTIONS GOOGLE MAPS ***********


        var directionsService = new google.maps.DirectionsService();
        var num, map, data, i;
        var requestArray = [], renderArray = [];

        var loop = 0;
        var contentLoop="{";



        var locations = [];

        for(i = 0; i < dataLast.length; i++){

            var start = dataLast[i].start;
            var splitStart = start.split(", ");
            var end = dataLast[i].arrival;
            var splitEnd = end.split(", ");

            locations.push([dataLast[i].titre, splitStart[0], splitStart[1], splitEnd[0], splitEnd[1], dataLast[i].id]);

        }

        while (loop < dataLast.length) {
            //console.log(dataLast[loop].titre);

            contentLoop += '"'+dataLast[loop].titre+'":';
            contentLoop+= '["'+dataLast[loop].start+'" , "'+dataLast[loop].arrival+'"]';
            //contentLoop+= '["'+dataLast[loop].start+'" , "'+dataLast[loop].arrival+'" , "'+dataLast[loop].transport+'" , "'+dataLast[loop].id+'"]';
            if(loop<dataLast.length-1){
                contentLoop += ",";
            }else {
                contentLoop += "}";
            }
            loop++;
        }

        var jsonArray = JSON.parse(contentLoop);


        // 16 Standard Colours for navigation polylines
        var colourArray = ['#33A0D4', 'grey', 'fuchsia', 'black', 'white', 'lime', 'maroon', 'purple', 'aqua', 'red', 'green', 'silver', 'olive', 'blue', 'yellow', 'teal'];

        // Let's make an array of requests which will become individual polylines on the map.
        function generateRequests(){
            console.log("generateRequest");

            requestArray = [];
            var num = 0;
            for (var route in jsonArray){

                // This now deals with one of the people / routes

                // Somewhere to store the wayoints
                var waypts = [];

                // 'start' and 'finish' will be the routes origin and destination
                var start, finish;

                // lastpoint is used to ensure that duplicate waypoints are stripped
                var lastpoint;

                data = jsonArray[route];

                for (var waypoint = 0; waypoint < data.length; waypoint++) {
                    if (data[waypoint] === lastpoint){
                        // Duplicate of of the last waypoint - don't bother
                        continue;
                    }

                    // Prepare the lastpoint for the next loop
                    lastpoint = data[waypoint]

                    // Add this to waypoint to the array for making the request
                    waypts.push({
                        location: data[waypoint],
                        stopover: true
                    });
                }

                // Grab the first waypoint for the 'start' location
                start = (waypts.shift()).location;
                // Grab the last waypoint for use as a 'finish' location
                finish = waypts.pop();
                if(finish === undefined){
                    // Unless there was no finish location for some reason?
                    finish = start;
                } else {
                    finish = finish.location;
                }

                // Let's create the Google Maps request object
                var request = {
                    origin: start,
                    destination: finish,
                    waypoints: waypts,
                    //travelMode: google.maps.TravelMode[dataLast[num].transport]
                    travelMode: google.maps.TravelMode.DRIVING
                };

                // and save it in our requestArray
                requestArray.push({"route": route, "request": request});
                //console.log(request);

                num++;

            }

            processRequests();

        }

        function processRequests(){
            console.log("processRequest");

            // Counter to track request submission and process one at a time;
            var i = 0;


            // Used to submit the request 'i'
            function submitRequest(){
                directionsService.route(requestArray[i].request, directionResults);
            }

            // Used as callback for the above request for current 'i'
            function directionResults(result, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    console.log(result);

                    console.log(i);



                    // ********************* CONTENT LISTE ******************************

                    var distance = result.routes[0].legs[0].distance.text;

                    var transport = dataLast[i].transport;
                    var difficulty = dataLast[i].difficulty;
                    var transportClass;

                    if(transport == "WALKING") {
                        transport = "Marche à pied";
                        transportClass = "apied";
                    }
                    if(transport == "TRANSIT") {
                        transport = "Transports";
                        transportClass = "transports";
                    }
                    if(transport == "DRIVING") {
                        transport = "Covoiturage";
                        transportClass = "covoiturage";
                    }
                    if(transport == "BICYCLING") {
                        transport = "Vélo";
                        transportClass = "velo";
                    }

                    var id = dataLast[i].id;

                    var titre = dataLast[i].titre;
                    if(titre.length > 60) titre = titre.substring(0,60) + " ...";

                    var description = dataLast[i].description;
                    if(description.length > 255) description = description.substring(0,255) + " ... <a href='" + url + "experience/" + id + "'>Lire la suite</a>";

                    // DUREE

                    //FORMULE CONVERSION DUREE (format 1h10m)
                    var dureeTotal =  result.routes[0].legs[0].duration.value;
                    dureeTotal =  dureeTotal/60;
                    dureeTotal = Math.floor(dureeTotal);
                    var dureeM = dureeTotal%60;
                    var dureeH = dureeTotal/60;
                    var duree;
                    dureeH = Math.floor(dureeH);
                    if(dureeH > 0) {
                        if(dureeM < 10){
                            duree = duree +  'h0' + dureeM;
                        } else {
                            duree = duree +  'h' + dureeM;
                        }
                    } else {
                        duree =  dureeM + 'm';
                    }
/*
                    var total = result.routes[0].legs[0].distance.value
                    total = total / 1000.0;

                    var GES = total * 69.81;

                    if(GES < 1000) {
                        GES = Math.round(GES*100)/100;
                        GES = GES + ' g';
                    } else {
                        GES = GES /1000;
                        GES = Math.round(GES*100)/100;
                        GES = GES + ' kg';
                    }

*/

                    var content = "";
                    content += "<div class='" + transportClass + " " +difficulty.toLowerCase() + "'>";

                    content     += "<a class='head' href='" + url + "experience/" + id +"'><h3 class='h3Bloc panel-heading'>" + titre.ucfirst() + /*"<span class='badgeRight'> - " +  GES + "</span>*/"</h3></a>";

                    content         += "<div class='content-area col-sm-12'>";

                    content             += "<p>" + description.ucfirst() + "</p>";

                    content             += "<div class='clear'></div>";
                    content             += "<div class='col-sm-12 bg-secondary infosParcours'>";

                    content             += "<div class='col-sm-3 text-center'><p>" + transport + "</p></div>";
                    content             += "<div class='col-sm-3 text-center'><p><i class='fa fa-clock-o'></i> " + duree + "</p></div>";
                    content             += "<div class='col-sm-3 text-center'><p><i class='fa fa-location-arrow'></i> " + distance + "</p></div>";
                    content             += "<div class='col-sm-3 text-center'><p><i class='fa fa-signal'></i> " + difficulty + "</p></div>";

                    content             += "</div>";
                    content         += "</div>";
                    content     += "</div>";
                    content += "</div>";
                    content += "<div class='clear'></div>";

                    $("#xpContent").append(content);

                    nextRequest();
                    console.log("nextRequest2");
                }


            }

            function nextRequest(){
                console.log("nextRequest");
                // Increase the counter
                i++;
                // Make sure we are still waiting for a request
                if(i >= requestArray.length){
                    // No more to do
                    return;
                }
                // Submit another request
                submitRequest();
            }

            // This request is just to kick start the whole process
            submitRequest();
        }

        // Called Onload
        function init() {
            console.log("init");
            // Start the request making
            generateRequests();



        }




        // Get the ball rolling and trigger our init() on 'load'
        google.maps.event.addDomListener(window, 'load', init);

        // *********** FIN FONCTIONS GOOGLE MAPS ***********







});

