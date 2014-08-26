$( document ).ready(function() {



    function scrollToElement(ele) {

    $(window).scrollTop(ele.offset().top).scrollLeft(ele.offset().left);
    }

    scrollToElement($('#commentForm'));

});