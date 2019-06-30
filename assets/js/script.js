/********************************SCROLL TO TOP JS*************************************/


$(function() {
    $(".scroll").click(function() {
        $("html").animate({
            scrollTop: $("body").offset().top
        }, "1000");
        return false
    })
})


/********************************SEARCH BAR EXTEND JS*************************************/


$('.search-icon').click(function() {
    $('.search').toggleClass('expanded');
});


/********************************MENU BAR JS*************************************/


function myFunction() {
    var x = document.getElementById("mytopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}