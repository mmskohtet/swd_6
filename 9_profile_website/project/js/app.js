$(document).ready(function () {

    let screenHeight = $(window).height();
    console.log(screenHeight);


    $(window).scroll(function () {
        let currentPosition = $(this).scrollTop();
        console.log(currentPosition);
        if(currentPosition > screenHeight-100){
            $(".site-nav").addClass("site-nav-scroll");
        }else{
            $(".site-nav").removeClass("site-nav-scroll");

        }
    });

    $(".navbar-toggler").click(function () {
        let result = $(".navbar-collapse").hasClass("show");
        console.log(result);

        if(result){

            $(".menu-icon").removeClass("fa-close").addClass("fa-bars");



        }else{

            $(".menu-icon").removeClass("fa-bars").addClass("fa-close");


        }

    });


});