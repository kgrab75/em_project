$( document ).ready(function() {


// SCRIPT RECUPERATION VALEUR SELECT MODE DE TRANSPORT
    $( "select.filterSelect" ).change(function() {
        var filterVal = $( "select.filterSelect option:selected" ).val().toLocaleLowerCase();

        if(filterVal == "" ){
            filterVal = "all";
            $(location).attr('href',"/experiences/"+filterVal+"/0");
            console.log(filterVal);
        } else {
            $(location).attr('href',"/experiences/"+filterVal+"/0");
        }
        console.log(filterVal);
    });

    $( "#adresseType1, #adresseType2" ).change(function() {

        var addresseVal = $('input[name=adresseType]:checked').val()
        console.log(addresseVal) ;

        if(addresseVal == "postal"){

            $htmlField = "" ;
            $htmlField += '<div class="form-group">';

            $htmlField += '<label for="depart" class="col-sm-2">Départ <span class="required">*</span></label>';
            $htmlField += '<div class="col-sm-8">';
            $htmlField += '<input type="text" class="form-control" id="depart" name="depart" placeholder="Adresse départ">';
            $htmlField += '</div>';

            $htmlField += '</div>';

            $htmlField +='<div class="form-group">';

            $htmlField += '<label for="arrivee" class="col-sm-2">Arrivée <span class="required">*</span></label>';
            $htmlField += '<div class="col-sm-8">';
            $htmlField += '<input type="text" class="form-control" id="arrivee" name="arrivee" placeholder="Adresse arrivée">';
            $htmlField += '</div>';

            $htmlField += '</div>';

        }
        if(addresseVal == "gps"){
            $htmlField = "" ;
            $htmlField +='<div class="form-group" id="gps">';
            $htmlField +='<label for="depart" class="col-sm-2">Départ <span class="required">*</span></label>';
            $htmlField +='<div class="col-sm-4">';
            $htmlField +='<input type="text" class="form-control" id="depart" name="depart" placeholder="Coordonnées départ">';
            $htmlField +='</div>';
            $htmlField +='<label for="arrivee" class="col-sm-2">Arrivée <span class="required">*</span></label>';
            $htmlField +='<div class="col-sm-4">';
            $htmlField +='<input type="text" class="form-control" id="arrivee" name="arrivee" placeholder="Coordonnées arrivée">';
            $htmlField +='</div>';
            $htmlField +='</div>';
        }

        $("#donnees").empty();
        $("#donnees").html($htmlField);
    });


});
