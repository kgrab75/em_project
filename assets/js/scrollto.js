$( document ).ready(function() {



    function scrollToElement(ele) {
    alert("Fonction chargée");
    $(window).scrollTop(ele.offset().top).scrollLeft(ele.offset().left);
    }

    scrollToElement($('#commentForm'));

});