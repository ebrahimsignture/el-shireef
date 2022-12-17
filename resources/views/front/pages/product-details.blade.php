@extends('front.layouts.master')

@section('link')
    <link rel="stylesheet" href="{{asset('assets/front/css/jquery.exzoom.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/flexslider.css')}}">
@stop

@section('content')

    <div class="page-wrapper out-header m-t-92">
        <section class="out-header-sec jarallax" data-jarallax data-speed="0.3" data-imgPosition="100% 100%">
            <img src="{{asset('assets/front/images/bg-fun.webp')}}"
                 class="jarallax-img" alt="counter_background">
            <div class="container">
                <div class="row no-gutters" style="min-height: 200px; text-align: center">
                    <div class="headline_div out-pages-header">

                        <h5>
                            <a href="{{route('site.home')}}">
                        <span class="bold home_span">
                            {{__('messages.home')}}
                        </span>
                            </a>
                            - {{__('messages.category')}} - {{__('messages.product')}}
                        </h5>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section class="product-details mt-5">
        <div class="container">
            @if(isset($product_details))
                <div class="row">
                    <div class="col-md-6 col-12 col-sm-12 product-gallery-pc p-4 ">
                        <div class="exzoom" id="exzoom">
                            <!-- Images -->
                            <div class="exzoom_img_box">
                                <ul class='exzoom_img_ul'>
                                    @php

                                        $photo = explode(',',$product_details->image);
                                        //dd($photo);
                                    @endphp
                                    @foreach($photo as $key => $item)
                                        <li><img src="{{asset($item)}}" alt="{{$product_details->slug}}"></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="exzoom_nav"></div>
                            <!-- Nav Buttons -->
                        </div>
                    </div>



                    <div class="col-md-6 col-12 col-sm-12 product-info" dir="{{General::getDir()}}">

                        <div class="row mt-4">
                            <h1>
                                <span>{{$product_details->title}}</span>
                            </h1>
                        </div>
                        <div class="row mt-3">
                            @php
                                //$after_discount=($product_details->price-(($product_details->price*$product_details->discount)/100));
                            @endphp

                            <h1 class="product-details-price" dir="ltr">
                                @php
                                    $after_discount=($product_details->price-(($product_details->price*$product_details->discount)/100));
                                @endphp
                                @if($product_details->discount > 0)
                                    <span class="block1-content-more txt-m-104 cl9 p-t-21 trans-04"
                                          style="text-decoration: line-through">{{number_format($product_details->price,2)}} EGP</span>
                                    <span class="after-discount">{{number_format($after_discount,2)}} EGP</span>

                                @else
                                    <p class="card-text" dir="ltr">
                                        <span
                                            class="after-discount">{{number_format($product_details->price,2)}} </span>
                                    </p>
                                @endif

                            </h1>
                        </div>
                        <div class="row py-1 description-list">
                            {!! $product_details->description !!}
                        </div>

                        <div class="row">
                            <p class="count" data-val="{{$product_details->stock}}">
                                <span class="bold">{{__('messages.stock')}} : </span>
                                <span>
                                         {{__('messages.availability-true')}} - ({{$product_details->stock}})
                                </span>
                            </p>
                        </div>
                        <div class="row product-details-quantity" dir="ltr">

                            <div class="input-group mt-3">
                                <button class="btn btn-outline-secondary new-plus" data-field="{{$product_details->id}}"
                                        type="button" id="button-new-plus">+
                                </button>
                                {{--                                                            max value = size stock quantity--}}
                                <input type="number" min="1" max="{{$product_details->stock}}"
                                       class="form-control quantity_product_details"
                                       name="quantity" id="{{$product_details->id}}" value="1" readonly>
                                {{--                                                            if quantity = 1 disable minus--}}
                                <button class="btn btn-outline-secondary new-minus new_minus_{{$product_details->id}}"
                                        data-field="{{$product_details->id}}"
                                        type="button" id="button-new-minus" disabled>-
                                </button>

                            </div>
                        </div>

                        <div class="row add-to-cart">
                            <div class=" mt-3">
                                <a class="btn  add-to-cart-btn  bold" id="add-to-cart-btn"
                                   href="javascript:void(0);" data-bs-target="{{$product_details->slug}}">
                                    {{__('messages.add-cart')}}
                                </a>
                                @if(backpack_auth()->check())
                                <a href="javascript:void(0)" class="btn add-to-wish-btn wish-btn"
                                   data-bs-target="{{$product_details->slug}}"><i
                                        class="{{ \App\Models\Wishlist::where('user_id', backpack_auth()->user()->id)->where('product_id',$product_details->id)->first() ? 'fa-solid' : 'fa-regular' }} fa-heart"></i></a>
                                @else
                                    <a href="javascript:void(0)" class="btn add-to-wish-btn wish-btn"
                                       data-bs-target="{{$product_details->slug}}"><i
                                            class="fa-regular fa-heart"></i></a>
                                @endif
                            </div>
                        </div>
                        <div class="row buy-now">

                            <p class="note_cart mt-3"><span>{{__('messages.cart.note')}}</span></p>

                        </div>
                        <div class="row mt-5 rest-details">
                            <div><span class="bold">{{__('messages.sku')}} : </span>
                                <span>{{$product_details->sku}}</span></div>

                        </div>

                    </div>
                    <div class="col-md-12 col-12 col-sm-12" dir="{{General::getDir()}}">
                        <div class="row more_product_details mt-5">
                            <ul class="nav nav-tabs more_product_details_nav" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                            data-bs-target="#description" type="button" role="tab" aria-controls="home"
                                            aria-selected="true">{{__('messages.description')}}</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="addi-info-tab" data-bs-toggle="tab"
                                            data-bs-target="#addi-info"
                                            type="button" role="tab" aria-controls="addi-info"
                                            aria-selected="false">{{__('messages.addi-info')}}</button>
                                </li>
                            </ul>
                            <div class="tab-content p-3" id="myTabContent">
                                <div class="tab-pane fade show active description-list" id="description" role="tabpanel"
                                     aria-labelledby="description-tab">
                                    {{$product_details->summary}}

                                </div>
                                <div class="tab-pane fade" id="addi-info" role="tabpanel"
                                     aria-labelledby="addi-info-tab">
                                    <div class="col-md-6 col-12 col-sm-12">
                                        <table class="table table-hover addi-info-table">
                                            <tbody>
                                            <tr>
                                                <th>{{__('messages.color')}}</th>
                                                <td>{{ $product_details->color }}
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{--                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>--}}
                            </div>
                        </div>
                        <div class="row related_products text-center mt-5">

                            <h3 class="bold ts-0 mt-5">{{__('messages.related-products')}}</h3>
                            <div class="shop_products mt-4" dir="ltr">
                                @foreach($related as $item)


                                    <div class="col-sm-6 col-md-2 col-lg-2 p-b-20 product_card related_product">

                                        <div class="block1">
                                            <div class="block1-bg wrap-pic-w bo-all-1 bocl12 hov3 trans-04 ">
                                                <div class="discount-patch">
                                                    <span>{{$item->discount}}%</span>
                                                </div>
                                                <img src="{{asset($item->cover)}}" alt="IMG">
                                                <div class="block1-content flex-col-c-m p-b-46 product_info">
                                                    <a href="javascript:void(0);"
                                                       class="txt-m-103 cl3 txt-center  trans-04 js-name-b1">
                                                        {{$item->title}}
                                                    </a>
                                                    @php
                                                        $after_discount=($item->price-(($item->price*$item->discount)/100));
                                                    @endphp
                                                    @if($item->discount > 0)
                                                        <span class="block1-content-more txt-m-104 cl9 p-t-21 trans-04 product_price">
                                                            <span style="text-decoration: line-through">{{number_format($item->price,1)}} EGP</span>
                                                            <span style="color: #000">{{number_format($after_discount,1)}} EGP</span>
                                                        </span>
                                                    @else
                                                        <span class="block1-content-more txt-m-104 cl9 p-t-21 trans-04">
                                                            <span style="color: #000">{{number_format($item->price,2)}} EGP</span>
                                                        </span>
                                                    @endif
                                                    <div class="block1-wrap-icon flex-c-m flex-w trans-05">
                                                        <a href="{{route('site.product.details', $item->slug)}}"
                                                           class="block1-icon flex-c-m wrap-pic-max-w">
                                                            <img src="{{asset('assets/front/images/icon-view.png')}}"
                                                                 alt="ICON">
                                                        </a>
                                                        <a class="block1-icon flex-c-m wrap-pic-max-w js-addcart-b1 add-to-cart-btn-class"
                                                           href="javascript:void(0);" data-bs-target="{{$item->slug}}">
                                                            <img src="{{asset('assets/front/images/icon-cart.png')}}" alt="ICON">
                                                        </a>
                                                        @if(backpack_auth()->check())
                                                            <a href="javascript:void(0);"
                                                               class="block1-icon flex-c-m wrap-pic-max-w js-addwish-b1 wish-btn"
                                                               data-bs-target="{{$item->slug}}">
                                                                <input type="hidden" value="{{csrf_token()}}" id="csrf">
                                                                <img class="heart_wish icon-addwish-b1"
                                                                     src="{{\App\Models\Wishlist::where('user_id', backpack_auth()->user()->id)->where('product_id',$item->id)->first() ? asset('assets/front/images/icon-heart2.png') : asset('assets/front/images/icon-heart.png') }}"
                                                                     alt="ICON">
                                                            </a>
                                                        @else
                                                            <a href="javascript:void(0);"
                                                               class="block1-icon flex-c-m wrap-pic-max-w js-addwish-b1 wish-btn"
                                                               data-bs-target="{{$item->slug}}">
                                                                <input type="hidden" value="{{csrf_token()}}" id="csrf">
                                                                <img class="icon-addwish-b1"
                                                                     src="{{asset('assets/front/images/icon-heart.png')}}"
                                                                     alt="ICON">
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>


            @endif
        </div>

    </section>
@stop

@section('script')
    <script
        src="{{asset('assets/front/js/jquery.exzoom_en.js')}}"></script>
    <script src="{{asset('assets/front/js/jquery.flexslider.js')}}"></script>
    <script>
        $(document).ready(function () {

            let btn_cart = $('#add-to-cart-btn');
            let quick_btn_cart = $('.add-to-cart-btn-class');



            @if(backpack_auth()->check())

            // Quick add to cart
            quick_btn_cart.on('click', function () {
                let slug = $(this).data('bs-target');
                // alert(slug);
                // let size = $("input[name=size]:checked").val();
                let quantity = 1;
                // alert(quantity);

                $.ajax({
                    url: "/{{LaravelLocalization::getCurrentLocale()}}/add-to-cart/" + slug,
                    // url: "/add-to-cart/" + slug,
                    data: {
                        _token: "{{csrf_token()}}",
                        slug: slug,
                        // size: size,
                        quantity: quantity,
                        @if(backpack_auth()->check())
                        user_id: "{{backpack_auth()->user()->id}}"
                        @endif
                    },
                    type: "POST",
                    success: function (response) {
                        if (typeof (response) != 'object') {
                            response = $.parseJSON(response)
                        }
                        // console.log(response);
                        // let type = $('#notify_type');
                        let notify_msg = $('#notify_msg');
                        // let cart_count = parseInt($('#cart_count').text());

                        if (response.status === 3) {
                            let msg = response.msg;
                            // alert(data);
                            if (response.msg) {
                                // alert(msg);
                                // type.addClass('success');

                                notify_msg.text(msg);
                                notify_msg.removeClass('alert-danger');
                                notify_msg.addClass('alert-success');
                                let newCount = response.data['new_count'];
                                // alert(newCount);
                                $('#cart_count').text(newCount);
                                console.log(response);

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
                                $('.modal').modal('show');
                                // let newCount = wishes_count-1;
                                // $('#wishes_count').text(newCount);
                                console.log(response);

                                Toasty();
                            }
                        } else if (response.status === 6) {
                            let msg = response.msg;
                            // alert(data);
                            if (response.msg) {
                                // alert(msg);
                                // type.addClass('success');

                                notify_msg.text(msg);
                                notify_msg.removeClass('alert-danger');
                                notify_msg.addClass('alert-success');
                                let newCount = response.data['new_count'];
                                // alert(newCount);
                                $('#cart_count').text(newCount);

                                console.log(response);

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
                                // let newCount = wishes_count-1;
                                // $('#wishes_count').text(newCount);
                                console.log(response);

                                Toasty();
                            }
                        }
                    }

                });

            });
            //  add to cart
            btn_cart.on('click', function () {
                let slug = $(this).data('bs-target');
                // let size = $("input[name=size]:checked").val();
                let quantity = $("input[name=quantity]").val();
                // alert(quantity);

                $.ajax({
                    url: "/{{LaravelLocalization::getCurrentLocale()}}/add-to-cart/" + slug,
                    // url: "/add-to-cart/" + slug,
                    data: {
                        _token: "{{csrf_token()}}",
                        slug: slug,
                        // size: size,
                        quantity: quantity,
                        @if(backpack_auth()->check())
                        user_id: "{{backpack_auth()->user()->id}}"
                        @endif
                    },
                    type: "POST",
                    success: function (response) {
                        if (typeof (response) != 'object') {
                            response = $.parseJSON(response)
                        }
                        // console.log(response);
                        // let type = $('#notify_type');
                        let notify_msg = $('#notify_msg');
                        // let cart_count = parseInt($('#cart_count').text());

                        if (response.status === 3) {
                            let msg = response.msg;
                            // alert(data);
                            if (response.msg) {
                                // alert(msg);
                                // type.addClass('success');

                                notify_msg.text(msg);
                                notify_msg.removeClass('alert-danger');
                                notify_msg.addClass('alert-success');
                                let newCount = response.data['new_count'];
                                // alert(newCount);
                                $('#cart_count').text(newCount);
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
                                $('.modal').modal('show');
                                // let newCount = wishes_count-1;
                                // $('#wishes_count').text(newCount);
                                Toasty();
                            }
                        } else if (response.status === 6) {
                            let msg = response.msg;
                            // alert(data);
                            if (response.msg) {
                                // alert(msg);
                                // type.addClass('success');

                                notify_msg.text(msg);
                                notify_msg.removeClass('alert-danger');
                                notify_msg.addClass('alert-success');
                                let newCount = response.data['new_count'];
                                // alert(newCount);
                                $('#cart_count').text(newCount);

                                console.log(response);

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
                                // let newCount = wishes_count-1;
                                // $('#wishes_count').text(newCount);
                                Toasty();
                            }
                        }
                    }

                });

            });

            // Add To Wish List
            $('.wish-btn').on('click', function () {
                let slug = $(this).data('bs-target');
                let icon = $(this).find("i");
                let user_id = "{{backpack_auth()->check() ? backpack_auth()->user()->id : ''}}";
                let heart_image = $(this).find(".heart_wish");
                // let locale = $('#locale').val();
                let csrf = $('#csrf').val();
                // alert(id);
                $.ajax({
                    url: "/{{LaravelLocalization::getCurrentLocale()}}/add-to-wish/" + slug,
                    // url: "/add-to-wish/" + slug,
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
                                $('#wishes_count').text(newCount);

                                icon.removeClass('fa-regular');
                                icon.addClass('fa-solid');
                                heart_image.removeClass('icon-addwish-b1');
                                heart_image.addClass('icon-addedwish-b1');
                                heart_image.attr('src', '{{asset('assets/front/images/icon-heart2.png')}}');

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

            @else

            quick_btn_cart.on('click', function () {
                let notify_msg = $('#notify_msg');
                notify_msg.text("{{__('messages.auth-warning')}}");
                notify_msg.removeClass('alert-success');
                notify_msg.addClass('alert-danger');
                $('.modal').modal('show');
                Toasty();
            });
            btn_cart.on('click', function () {
                let notify_msg = $('#notify_msg');
                notify_msg.text("{{__('messages.auth-warning')}}");
                notify_msg.removeClass('alert-success');
                notify_msg.addClass('alert-danger');
                $('.modal').modal('show');
                Toasty();
            });

            // Add To Wish List
            $('.wish-btn').on('click', function () {
                let notify_msg = $('#notify_msg');
                notify_msg.text("{{__('messages.auth-warning')}}");
                notify_msg.removeClass('alert-success');
                notify_msg.addClass('alert-danger');
                $('.modal').modal('show');
                Toasty();
            });
            @endif

            $('#slider').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: "#carousel",
                start: function (slider) {
                    $('body').removeClass('loading');
                }
            });
        });
        $(function () {

            $("#exzoom").exzoom({
                // thumbnail nav options
                "navWidth": 60,
                "navHeight": 60,
                "navItemNum": 5,
                "navItemMargin": 7,
                "navBorder": 1,

                // autoplay
                "autoPlay": false,

                // autoplay interval in milliseconds
                "autoPlayTimeout": 5000
            });

        });


    </script>
@stop
