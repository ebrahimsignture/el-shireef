$(document).ready(function () {
    $('select').niceSelect();






    // $('.lang-link').hover(function () {
    //     $('#lang_list').css('display', 'block');
    // }, function () {
    //     $('#lang_list').css('display', 'none');
    // });
    // $('.lang-link').on('click', function () {
    //         $('#lang_list').css('display', 'block');
    //
    // });


    $('.categories').hover(function () {
        $('.cat-menu').addClass('show');
    }, function () {
        $('.cat-menu').removeClass('show');
    });



    $('.related-products').owlCarousel({
        items: 6,
        center: true,
        nav: true,
        // dots: true,
        loop: true,
        mouseDrag: true,
        touchDrag: true,
        responsiveClass: true,
        autoplay: true,
        autoplayHoverPause: true,
        navText: ["<i class='icofont-bubble-left'></i>", "<i class='icofont-bubble-right'></i>"],
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            480: {
                items: 1,
                nav: true
            },
            767: {
                items: 1,
                nav: true
            },
            992: {
                items: 1,
                nav: true
            },
            1200: {
                items: 1,
                nav: true
            }
        }
    });

    /*
        Sidebar 1, 2
    */
    $('.dismiss, .overlay, .continue-shop').on('click', function () {
        $('.sidebar1').removeClass('active');
        $('.overlay').removeClass('active');
        $('.sidebar2').removeClass('active');
        $('.sidebar3').removeClass('active');

    });

    $('.sidebar1-open-menu').on('click', function (e) {
        e.preventDefault();
        $('.sidebar1').addClass('active');
        $('.overlay').addClass('active');
        $('.sidebar2').removeClass('active');
        // close opened sub-menus
        $('.collapse.show').toggleClass('show');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });

    $('.sidebar2-open-menu').on('click', function (e) {
        e.preventDefault();
        $('.sidebar2').addClass('active');
        $('.overlay').addClass('active');
        $('.sidebar1').removeClass('active');
        // close opened sub-menus
        $('.collapse.show').toggleClass('show');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
    $('.mobile-filter-open-menu').on('click', function (e) {
        e.preventDefault();
        $('.sidebar3').addClass('active');
        $('.overlay').addClass('active');
        $('.sidebar1').removeClass('active');
        $('.sidebar2').removeClass('active');
        // close opened sub-menus
    });


    $('#test').click(function () {
        $('#otherSections').toggle(300);
    });
    // $('.lang-link').hover(function () {
    // }, function () {
    //     $('#lang_list').removeClass('show');
    // });

    /*
	    Wow
	*/
    new WOW().init();


    // see more & See Less   Cats
    $('#see_more_cats_btn').on('click', function () {
        $('#see_more_cats_btn').css({
            'display': 'none'
        });
        $('#cats-filter-form').css({
            'height': 'auto'
        });
    });
    $('#see_less_cats_btn').on('click', function () {
        $('#see_more_cats_btn').css({
            'display': 'inline-block'
        });
        $('#cats-filter-form').css({
            'height': '287px'
        });
    });


    // see more & See Less   Colors
    $('#see_more_colors_btn').on('click', function () {
        $('#see_more_colors_btn').css({
            'display': 'none'
        });
        $('#color-filter-form').css({
            'height': 'auto'
        });
    });
    $('#see_less_colors_btn').on('click', function () {
        $('#see_more_colors_btn').css({
            'display': 'inline-block'
        });
        $('#color-filter-form').css({
            'height': '287px'
        });
    });

    // $("#coupon_btn").click(function(){
    //     $("#coupon_div").toggle(500);
    // });


    // Change Address Pill
    $("#change_address").click(function () {
        $(".address-form").toggle(500);
    });


});


if ($(window).width() > 720) {
    $('.card_1').hover(function () {
        let id = $(this).data("id");
        $('.' + id).css({
            'display': 'block',
        });
    }, function () {
        let id = $(this).data("id");
        $('.' + id).css({
            'display': 'none',
        });
    });



}

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



// Add To Wish List
$('.wish-btn').on('click', function () {
    let slug = $(this).data('bs-target');
    let icon = $(this).find("i");
    let user_id = $('#user_id').val();
    let locale = $('#locale').val();
    let csrf = $('#csrf').val();
    // alert(id);
    $.ajax({
        url: "/" +locale + "/add-to-wish/" + slug,
        data: {
            _token: csrf,
            slug: slug,
            user_id: user_id,

        },
        type: "POST",
        success: function (response) {
            if (typeof (response) != 'object') {
                response = $.parseJSON(response)
            }
            console.log(response);
            let type = $('#notify_type');
            let notify_msg = $('#notify_msg');
            let wishes_count = parseInt($('#wishes_count').text());
            let login = 0;
            if (response.status === 1) {
                let msg = response.msg;
                // alert(data);
                if (response.msg) {
                    notify_msg.text(msg);
                    notify_msg.removeClass('alert-danger');
                    notify_msg.addClass('alert-success');
                    let newCount = wishes_count + 1;
                    icon.removeClass('fa-regular');
                    icon.addClass('fa-solid');
                    $('#wishes_count').text(newCount);

                    Toasty();
                }
            } else if (response.status === 0) {
                let msg = response.msg;
                // alert(data);
                if (response.msg) {
                    // alert(msg);

                    // type.addClass('danger');
                    // type.text('Warning');
                    notify_msg.text(msg);
                    notify_msg.removeClass('alert-success');
                    notify_msg.addClass('alert-danger');
                    $('#sign').modal('show');
                    Toasty();
                }
            } else {
                let msg = response.msg;
                // alert(data);
                if (response.msg) {
                    // alert(msg);

                    // type.addClass('danger');
                    // type.text('Warning');
                    notify_msg.text(msg);
                    notify_msg.removeClass('alert-success');
                    notify_msg.addClass('alert-danger');
                    Toasty();
                }
            }
        }

    });
});








