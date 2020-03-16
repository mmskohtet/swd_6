
let links = [];
$(".nav-items").each(function (x) {
    let c = {tag:$(this).attr("href"),position:$($(this).attr("href")).offset().top};
    links.push(c);
});
console.log(links);


$(window).scroll(function () {
    let currentPosition = $(this).scrollTop();


    if(currentPosition > 1000){
        $(".scrollToTop").fadeIn(1000);
    }else{
        $(".scrollToTop").fadeOut(1000);
    }



    links.map(function (el,index) {
        if(currentPosition+300 >= el.position){
            $(".nav-items").removeClass("active");
            $(`.nav-items[href='${el.tag}']`).addClass("active");
        }
    })


});


$(".nav-items").click(
    function () {
        $(".nav-items").removeClass("active");
        $(this).addClass("active");
    }
);

$(".scrollToTop").click(function () {
    $("html").animate({
        scrollTop:0
    },500)

});


$(".mobile-menu").click(function () {
    $(".nav-link").slideToggle(500);
});