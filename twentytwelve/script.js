

jQuery(document).ready(function($){

    $('.main-slider').slick({
        speed: 500,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
		autoplay: true,
		autoplaySpeed: 5000,
    });


    $('.actuals').slick({
        speed: 500,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
               {
              breakpoint: 992,
              settings: {
                slidesToShow: 2
              }
            },
            {
              breakpoint: 767,
              settings: {
                slidesToShow: 1
              }
            }
        ]
    });
	
	$('.author-slider').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    infinite: true,
	dots: true,
	arrows: true,
    prevArrow: '<button type="button" class="slick-prev">Previous</button>',
    nextArrow: '<button type="button" class="slick-next">Next</button>',
	speed: 400,
	});



});