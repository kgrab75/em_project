$( document ).ready(function() {


// SCRIPT RECUPERATION VALEUR SELECT MODE DE TRANSPORT
    $( "select.filterSelect" ).change(function() {
        var filterVal = $( "select.filterSelect option:selected" ).val().toLocaleLowerCase();

        if(filterVal == "" ){
            filterVal = "all";
            $(location).attr('href',"/em_project/experiences/"+filterVal+"/0");
            console.log(filterVal);
        } else {
            $(location).attr('href',"/em_project/experiences/"+filterVal+"/0");
        }
        console.log(filterVal);
    });

  // FONCTION UCFIRST JS
    String.prototype.ucfirst = function()
    {
        return this.charAt(0).toUpperCase() + this.substr(1);
    }


});
