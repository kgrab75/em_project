$( document ).ready(function() {
    console.log(jsonData);
    var dataLast = jsonData;
    console.log(dataLast);


// *********** FONCTIONS GOOGLE MAPS ***********


// Initialise some variables
    var directionsService = new google.maps.DirectionsService();
    var num, map, data, i;
    var requestArray = [], renderArray = [];

    var loop = 0;
    var contentLoop="{";


    var dataSort = [{titre: 'titre', transport:'transport' , id:'id' , ges:'GES', total:0}];
    var obj;

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



    // Let's make an array of requests which will become individual polylines on the map.
    function generateRequests(){


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
            var transporType = dataLast[num].transport;
            // Let's create the Google Maps request object
            var request = {
                origin: start,
                destination: finish,
                waypoints: waypts,
                //travelMode: google.maps.TravelMode[transporType]
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


        // Counter to track request submission and process one at a time;
        var i = 0;


        // Used to submit the request 'i'
        function submitRequest(){
            directionsService.route(requestArray[i].request, directionResults);


        }

        // Used as callback for the above request for current 'i'
        function directionResults(result, status) {
            if (status == google.maps.DirectionsStatus.OK) {



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
                if(titre.length > 45) titre = titre.substring(0,50) + " ...";

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

                var total = result.routes[0].legs[0].distance.value
                total = total / 1000.0;

                var GES = total * 69.81;

                if(GES < 1000) {
                    GES = Math.round(GES*100)/100;
                    GES = GES + ' g';
                } else {
                    GES = GES /1000;
                    GES = Math.round(GES*1000)/1000;
                    GES = GES + ' kg';
                }

                var detailDistance = result.routes[0].legs[0].distance.value;

                obj = {titre:titre, transport:transport, id:id, ges:GES, total:detailDistance, description:description, duree:duree, distance:distance, difficulty:difficulty};
                var i2 = 1;
                dataSort.push(obj);




                if(i == dataLast.length - 1){

                    /*function sortGES(key1, key2){
                        return key1.ges < key2.ges;

                    }*/

                    function sortGES(a,b) {
                        if (a.total < b.total)
                            return 1;
                        if (a.total > b.total)
                            return -1;
                        return 0;
                    }
                    dataSort.sort( sortGES );


                    console.log(dataSort);



                    function contentTop (){


                        if(i2 == 1) {
                            j = i + 1;

                            var contentBest = "";
                            contentBest += "<div class=''>";

                            contentBest     += "<a class='head' href='" + url + "experience/" + dataSort[0].id +"'><h3 class='h3Bloc panel-heading'>" + dataSort[0].titre.ucfirst() + "<span class='badgeRight'> - " +  dataSort[0].ges + "</span></h3></a>";

                            contentBest         += "<div class='content-area col-sm-12'>";

                            contentBest             += "<p>" + dataSort[0].description.ucfirst() + "</p>";

                            contentBest             += "<div class='clear'></div>";
                            contentBest             += "<div class='col-sm-12 bg-secondary infosParcours'>";

                            contentBest             += "<div class='col-sm-3 text-center'><p>" + dataSort[0].transport + "</p></div>";
                            contentBest             += "<div class='col-sm-3 text-center'><p><i class='fa fa-clock-o'></i> " + dataSort[0].duree + "</p></div>";
                            contentBest             += "<div class='col-sm-3 text-center'><p><i class='fa fa-location-arrow'></i> " + dataSort[0].distance + "</p></div>";
                            contentBest             += "<div class='col-sm-3 text-center'><p><i class='fa fa-signal'></i> " + dataSort[0].difficulty + "</p></div>";

                            contentBest             += "</div>";
                            contentBest         += "</div>";
                            contentBest     += "</div>";
                            contentBest += "</div>";
                            contentBest += "<div class='clear'></div>";

                            $("#bestEcoactor").append(contentBest);

                        }


                        while(i2 < dataLast.length) {
                            //console.log(i2);
                            //console.log(dataSort[i2]);


                            j = i2 + 1;
                            var  content10 = '<tr>';
                            content10 += "<td class='text-center'>" + j + "</td>";
                            content10 += "<td class=''><a href='" + url + "experience/" + dataSort[i2].id + "'>"+ dataSort[i2].titre.ucfirst() + "</a></td>";
                            content10 += "<td class='text-center'>" + dataSort[i2].ges + "</td>";
                            content10 += "<td class=' text-center'>" + dataSort[i2].transport + "</td>";
                            content10 += "<td class='text-center'><a href='" + url + "experience/" + dataSort[i2].id + "' class='btn btn-primary' role='button'><i class='fa fa-search'></i></a></td>";
                            content10 += "</tr>";


                            $("#best10").append(content10);

                            i2++;
                        }





                    }

                    contentTop();

                }


                nextRequest();

            }


        }

        function nextRequest(){


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

        // Start the request making
        generateRequests();






    }




    // Get the ball rolling and trigger our init() on 'load'
    google.maps.event.addDomListener(window, 'load', init);

    // *********** FIN FONCTIONS GOOGLE MAPS ***********


    var arr = [
        {name:'Code 18', age:28, city:'Montréal'},
        {name:'Gandalf', age:1000, city:'Middle-Earth'},
        {name:'Elvis', age:42, city:'Memphis'},
        {name:'Barack Obama', age:48, city:'Chicago'},
        {name:'Ronald McDonald', age:47, city:'San Bernardino'}
    ];

    console.log(arr);



    var j;
/*
            j = i + 2;
            var  content10 = '<tr>';
            content10 += "<td class='text-center'>" + i1 + "</td>";
            content10 += "<td class=''><a href='" + url + "experience/" + id + "'>"+ titre.ucfirst() + "</a></td>";
            content10 += "<td class='text-center'>" + GES + "</td>";
            content10 += "<td class=' text-center'>" + transport + "</td>";
            content10 += "<td class='text-center'><a href='" + url + "experience/" + id + "' class='btn btn-primary' role='button'><i class='fa fa-search'></i></a></td>";
            content10 += "</tr>";


            $("#best10").append(content10);

    */


});

