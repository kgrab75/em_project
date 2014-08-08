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





});
