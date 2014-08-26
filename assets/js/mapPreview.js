$( document ).ready(function() {

    var departValue, arriveeValue, transportType;

   $("#submitValue").on("click", function(){
       // Affichage de la map
       $("#mapRoute").show();

       // Mise à jour du bouton
       $("#submitValue").empty();
       $("#submitValue").removeClass("btn-primary");
       $("#submitValue").addClass("btn-success");
       $("#submitValue").html("Mettre à jour votre expérience");
       departValue  = $("input[name=depart]").val();
       arriveeValue  = $("input[name=arrivee]").val();
       transportType  = $("input[name=transportType]:checked").val();

       var titreContent = $("input[name=titre]").val();
       $("#titreInput").html(titreContent);
       var detailContent = $("textarea[name=description]").val();
       $("#descriptionInput").html(detailContent);



    // AFFICHAGE DE LA CARTE GOOGLE MAP


       var rendererOptions = {
           //draggable: true
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
               origin: departValue,
               destination: arriveeValue,
               //waypoints:[{location: 'addresse/coordonnées1'}, {location: 'addresse/coordonnées2'}],
               travelMode: google.maps.TravelMode[transportType]

           };


           function scrollMap(ele) {

               $(window).scrollTop(ele.offset().top).scrollLeft(ele.offset().left);
           }


           directionsService.route(request, function(response, status) {
               if (status == google.maps.DirectionsStatus.OK) {
                   directionsDisplay.setDirections(response);
                   $("#mapError").empty();
                   $('#submitXp').removeClass("disabled");
                   scrollMap($("input[name=okForm]"));

                   console.log(response);


               } else {
                   // Si l'itinéraire ne peut pas être chargé

                   var errorContent =  "<div class='alert alert-danger  col-sm-offset-2 col-sm-10'><p><b>Malheureusement, nous n'avons pas réussi à créer un itinéraire pour votre expérience.</b></p>";
                   errorContent     += "<p>Afin de régler ce problème, nous vous invitons à vérifier vos points de départ et d'arrivée : </p> ";
                   errorContent     += "<ul>";
                   errorContent     += "<li><b>Pour les coordonnées GPS :</b> vérifier le format de ces dernières (ex : 41.850033, -87.6500523)</li>";
                   errorContent     += "<li><b>Pour les adresses :</b> vérifier l'orthographe de ces dernières et renseigner l'adresse la plus complète pour une meilleure localisation</li>";
                   errorContent     += "</ul>";

                   errorContent     += "</div>";

                   $("#mapError").empty();
                   $("#mapError").html(errorContent);

                   $('#submitXp').addClass("disabled");
                   scrollMap($("#mapError"));


               }
           });
       }

       function computeTotalDistance(result) {
           var total = 0;
           var myroute = result.routes[0];
           for (var i = 0; i < myroute.legs.length; i++) {
               total += myroute.legs[i].distance.value;
           }

            // VALEUR POUR RECUPERATION DANS LE FORMULAIRE
           var totalM = total;
           var tempsMin = Math.round(myroute.legs[0].duration.value / 60);
           var gesG = total * 0.06981;

           function setHidden(){
               $("input[name=ges]").val(gesG);
               $("input[name=duree]").val(tempsMin);
               $("input[name=distance]").val(totalM);
               var start1 = myroute.legs[0].start_location.k;
               var start2 = myroute.legs[0].start_location.B;
               $("input[name=start]").val(start1 + ", " +start2);
               var end1 = myroute.legs[0].end_location.k;
               var end2 = myroute.legs[0].end_location.B;
               $("input[name=end]").val(end1 + ", " +end2);
           }

           setHidden();




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
           document.getElementById('totalKm').innerHTML = myroute.legs[0].distance.text;

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

       }

       //google.maps.event.addDomListener(window, 'load', initialize);
       initialize();


    // FIN DE LA PARTIE GOOGLE MAPS



       return false;
   });


    // Fonction pour checker si les champs sont vides en jquery
    function checkInput(id, div, nameInput){
        $(id).blur(function()
        {

            if ($(id).val() == ''){
                $(div).html("<p class='text-danger'>Veuillez saisir " + nameInput +"</p>");
                $(id).parent().addClass("has-error");
            } else {
                $(div).empty();
                $(id).parent().removeClass("has-error");
            }

        });
    }

    checkInput("input[name=email]", "#mailError", "votre adresse email" );
    checkInput("input[name=title]", "#titleError", "le titre de votre éco-action" );
    checkInput("input[name=depart]", "#departError", "votre départ" );
    checkInput("input[name=arrivee]", "#arriveeError", "votre arrivée" );
    checkInput("textarea[name=description]", "#descriptionError", "une description pour votre éco-action" );

    // Check du nombre d'input et textarea vide
    $("#participation-form input, #participation-form textarea").blur( function(){

        var count = $('#participation-form input, #participation-form textarea').filter(function(){
            return !$(this).val();
        }).length;

        console.log(count);


        if(count < 6 ){
            $("#submitValue").removeClass("disabled");
            $(".infoSubmit").empty();
        } else {
            $("#submitValue").addClass("disabled");
        }

    });




});