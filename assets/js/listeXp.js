$( document ).ready(function() {

        console.log(xpJson);

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

