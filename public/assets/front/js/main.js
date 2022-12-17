
let option = {
    animation: true,
    delay: 3000,
};

function Toasty() {
    let toastHTMLElement = document.getElementById('notify');
    let toastElement = new bootstrap.Toast(toastHTMLElement, option);
    toastElement.show();
}


function ToastySuccess() {
    let toastHTMLElement2 = document.getElementById('success');
    let toastElement2 = new bootstrap.Toast(toastHTMLElement2, option);
    toastElement2.show();
}

function ToastyError() {
    let toastHTMLElement1 = document.getElementById('error');
    let toastElement1 = new bootstrap.Toast(toastHTMLElement1, option);
    toastElement1.show();
}

function ToastyAuthError() {
    let toastHTMLElement3 = document.getElementById('error-auth');
    let toastElement3 = new bootstrap.Toast(toastHTMLElement3, option);
    toastElement3.show();
    $(document).ready(function () {
        $('#sign').modal('show');
    });
}


$(document).ready(function () {
    $('select').niceSelect();
    $('#team_work_carousel').owlCarousel({
        loop:true,
        margin:50,
        nav:false,
        responsiveClass:true,
        // center:true,
        // items:2,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        smartSpeed: 600,

        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

    if ($(".odometer").length) {
        $(".odometer").appear(function (e) {
            var odo = $(".odometer");
            odo.each(function () {
                var countNumber = $(this).attr("data-count");
                $(this).html(countNumber);
            });
        });
    }


    // plus inside Product Details & Cart Page
    $(".product-details-quantity #button-new-plus").on('click', function () {
        let inputName = $(this).data("field");
        // alert(inputName);
        $('.new_minus_' + inputName).attr("disabled", false);
        let oldInputQuant = $("#" + inputName);
        let max = oldInputQuant.attr('max');
        let newInputQuant = parseInt(oldInputQuant.val()) + 1;
        // alert (max);
        if (max <= oldInputQuant.val()) {
            oldInputQuant.val(max);
        } else {
            oldInputQuant.val(newInputQuant);
        }
        // alert(newInputQuant);
    });

//  Minus inside Product Details & Cart Page
    $(".product-details-quantity #button-new-minus").on('click', function () {
        let inputName = $(this).data("field");
        let oldInputQuant = $("#" + inputName);
        let newInputQuant = parseInt(oldInputQuant.val()) - 1;

        if (oldInputQuant.val() <= 1) {
            oldInputQuant.val(1);
        } else {
            oldInputQuant.val(newInputQuant);
        }
    });

    $(window).scroll(function () {
        if ($(document).scrollTop() > 100) {
            $('.lower-nav').addClass('fixed-top');
            $('nav.lower-nav').css('background', '#fff');

        } else {

            $('.lower-nav').removeClass('fixed-top');
            $('nav.lower-nav').css('background', 'transparent');


        }
    });


    /* Start Services Section */

    if ($(window).width() > 960) {



        $('.services-btn').hover(function () {
            // let gif = $(this).find('img.services_png');
            // if (gif.hasClass('not-active')) {
            //     $(this).find('img.services_gif').removeClass('not-active');
            // }
            $('.services-menu').addClass('show');

        }, function () {
            // $(this).find('img.services_gif').addClass('not-active');
            $('.services-menu').removeClass('show');
        });

        $('.service_btn').hover(function () {
            $(this).css({
                'color' : '#fff',
            });
        }, function () {
            $(this).css({
                'color' : '#fff',
            });
        });

        $('.service_card').hover(function () {
            $(this).css({
                'border': '2px #000 solid',
                'transition': '50ms',
            });
            let target = $(this).data('target');
            // alert(target);
            $('#' + target).css({
                'bottom': '0',
                'transition': '500ms',
            });
            let overlay = $(this).find('div.overlay_card_service');
            overlay.css({
                'background' : 'rgba(0,0,0,.05)',
                'transition' : '300ms',
            })
        }, function () {
            let target = $(this).data('target');

            $(this).css({
                'border': '1px solid rgba(0, 0, 0, 0.325)',
                'transition': '50ms',
            });
            $('#' + target).css({
                'bottom': '-100px',
                'transition': '500ms',
            });
            let overlay = $(this).find('div.overlay_card_service');
            overlay.css({
                'background' : 'rgba(0,0,0,0)',
                'transition' : '300ms',
            })
        });
        // $('.single_service').find('iframe').height(360);

        // let external_section = $('.external_page');

        // window.setTimeout(function () {
        //     external_section.find('.services-gif').remove();
        //     external_section.find('.services-png').removeClass('not-active')
        // }, 3000);


    } else {
        $('.side_bar_contact_div_dismiss').css({
            'top' : '50px',
            'left' : '10px',
        });
        $('.sidebar1 .logo').css({
            'padding' : '37px 0 15px 20px',
        });
        $('.top_part div').css('height', '67px');
        $('.side_bar_touch').removeClass('m-5');
        $('.side_bar_touch').css({
            'margin' : '1rem 20px',
        });
        $('.service_btn').css({
            'bottom': '0',
            'transition': '500ms',
        });

        $('div.post').removeClass('wow');

        $('.single_service').find('iframe').height(215);

        $('#otherServices').slideUp();

        $('.services_sidebar_2_btn').on('click', function () {
            $('#otherServices').slideToggle();
        });


    }


    if ($(window).width() < 575) {
        $('.service_card').css('height', '382');
        let height = $('.service_card').height() + 30;

        // alert(height);
        let services_div_height = height*3;
        // alert(services_div_height);
        $('.services_row').height(services_div_height);
        $('.services_see_more').on('click', function () {
            if ($('.services_row').height() < 1300) {
                $('.services_row').height(services_div_height*2);
                $('.services_see_more').hide();
            }
        });
        $('#clients_section_section').css('height', '55');

        $('#team_work_section').css('height', '100');
        $('.head_of_review').css('margin-bottom','0');

    } else if ($(window).width() < 750 && $(window).width() > 575) {
        $('.service_card').css('height', '363');
        let height = $('.service_card').height() + 30;

        // alert(height);
        let services_div_height = height*3;
        // alert(services_div_height);
        $('.services_row').height(services_div_height);
        $('.services_see_more').on('click', function () {
            if ($('.services_row').height() < 1300) {
                $('.services_row').height(services_div_height*2);
                $('.services_see_more').hide();
            }
        });
        $('#clients_section_section').css('height', '55');

        $('#team_work_section').css('height', '100');
        $('.head_of_review').css('margin-bottom','0');


    }






    /* End Services Section */


    /* Start Clients Carousel */
    let $owl_1 = $('#carousel_clients');
    $owl_1.owlCarousel({

        items: 4,
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayHoverPause: false,
        autoplayTimeout: 3000,
        autoplaySpeed: 5000,
        responsiveClass: true,
        responsive: {
            0: {
                items: 3,
                nav: true
            },
            480: {
                items: 3,
                nav: true
            },
            767: {
                items: 3,
                nav: true
            },
            992: {
                items: 6,
                nav: true
            },
            1200: {
                items: 6,
                nav: true
            }
        }
    });

    // $('.client_card').hover(function () {
    //     let $overlay = $(this).find('.overlay_card');
    //     $overlay.css({
    //         'display': 'block'
    //     });
    // }, function () {
    //     let $overlay = $(this).find('.overlay_card');
    //     $overlay.css({
    //         'display': 'none'
    //     });
    // });
    /* End Clients Carousel */

    /* Start Side Bar 1 */
    $('.side_bar_contact_div_dismiss, .overlay, .side_bar_2_contact_div_dismiss, .internal, .services-side-link, .products-side-link').on('click', function () {
        $('.sidebar1').removeClass('active');
        $('.sidebar2').removeClass('side_bar_2_active');
        $('.overlay').removeClass('active');
        $('.side_bar_contact_div_dismiss').css({
            'display': 'none'
        });
        $('.side_bar_2_contact_div_dismiss').css({
            'display': 'none'
        });

    });

    $('.sidebar1-open-menu-a').on('click', function (e) {
        e.preventDefault();
        $('.sidebar2').addClass('side_bar_2_active');
        $('.overlay').addClass('active');
        $('.side_bar_2_contact_div_dismiss').css({
            'display': 'block'
        });
    });
    $('.side_bar_list').on('click', function (e) {
        e.preventDefault();
        $('.sidebar2').addClass('side_bar_2_active');
        $('.overlay').addClass('active');
        $('.side_bar_2_contact_div_dismiss').css({
            'display': 'block'
        });
    });
    /* End Side Bar 1 */


});



/* Start Mouse Cursor */

/* End Mouse Cursor */

