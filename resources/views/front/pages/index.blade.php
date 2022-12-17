@extends('front.layouts.master')

@section('content')

    {{--/* Start Carousel */--}}
    @if(isset($events) && $events->count() > 0)
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach($events as $key => $item)
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$key}}"
                            class="{{$key === 0 ? 'active' : ''}}"
                            aria-current="true" aria-label="Slide {{$key+1}}"></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach($events as $key => $item)
                    <div class="carousel-item {{$key === 0 ? 'active' : ''}}">
                        @php
                            $image =explode('/', $item->image);
                            $seo_image = end($image);
                            //dd($seo_image);
                        @endphp
                        <img src="{{asset($item->image)}}" class="d-block w-100" alt="{{$seo_image}}">
                        <div class="carousel-caption d-none d-md-block">
                            {{--                    <h5>First slide label</h5>--}}
                            {{--                    <p>Some representative placeholder content for the first slide.</p>--}}
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    @endif
    {{--/* End Carousel */--}}

    @if(isset($products) && $products->count() > 0  && isset($categories) && $categories->count() > 0)
        <section class="mt-5" id="products_section">
            <div class="container text-center ">
                <div class="headline_div gifing_div services_section_head">
                    <h1 class="bold ts-0 ">{{__('messages.our_products')}}</h1>
                </div>
                <div class="m-b-46 text-center products-header" dir="{{General::getDir()}}">
                    <div class="mt-5 dis-inline-block filter-tope-group"
                         style="border: 2px solid #69c1c9;border-radius: 27px;background: #fff">
                        <button class="txt-m-104 cl1 hov2 trans-04 p-rl-27 p-tb-10 how-active1" data-filter="*">
                            {{__('messages.all_products')}}
                        </button>
                        @foreach($categories as $item)
                            <button class="txt-m-104 cl1 hov2 trans-04 p-rl-27 p-tb-10" data-filter=".{{$item->slug}}">
                                {{$item->title}}
                            </button>
                        @endforeach
                    </div>
                </div>
                <div class="row isotope-grid">
                    @foreach($products as $item)
                        <div
                            class="col-sm-6 col-md-2 col-lg-2 p-b-20 isotope-item {{$item->category->slug}} product_card">

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
                                            <span
                                                class="block1-content-more txt-m-104 cl9 p-t-21 trans-04 product_price">
                                                <span style="text-decoration: line-through">{{number_format($item->price,1)}} EGP</span>
                                                <span
                                                    style="color: #000">{{number_format($after_discount,1)}} EGP</span>
                                            </span>
                                        @else
                                            <span class="block1-content-more txt-m-104 cl9 p-t-21 trans-04">
                                        <span style="color: #000">{{number_format($item->price,2)}} EGP</span>
                                    </span>
                                        @endif
                                        <div class="block1-wrap-icon flex-c-m flex-w trans-05">
                                            <a href="{{route('site.product.details', $item->slug)}}"
                                               class="block1-icon flex-c-m wrap-pic-max-w">
                                                <img src="{{asset('assets/front/images/icon-view.png')}}" alt="ICON">
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
        </section>
    @endif

    {{-- Start Clients--}}
    @if(isset($clients)  && $clients->count() > 0)
        <section class="sec-logo clients_new_section mt-5" style="background: #fff">
            <div class="container">
                <div class="flex-w flex-sa-m  bocl13 p-tb-60 clients_div" style="border-color: #e5e5e5;">
                    @foreach($clients as $item)
                        <a href="javascript:void(0)" class="dis-block how2 p-rl-15 m-tb-20 client">
                            <img class="trans-04 client_image" src="{{asset($item->image)}}" alt="IMG">
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    {{-- End Clients--}}

    {{--Start Services Section--}}
    @if(isset($services) && $services->count() > 0)
        <section class="services_section  mt-5 container" id="services_section">
            <div class="headline_div  services_section_head">
                <h3 class="bold mb-4 ts-0 ">{{__('messages.our_services')}}</h3>
                {{--                wow animate__animated animate__bounceInRight--}}
            </div>
            <div class="services">
                <div class="row services_row">
                    @foreach($services as $key => $item)
                        {{--                        {{dd($key)}}--}}
                        <div class="card service_card col-md-4 col-6 wow "
                             data-target="btn_{{$key}}">
                            <div class="overlay_card_service"></div>
                            @php
                                $image =explode('/', $item->image);
                                $seo_image = end($image);
                                //dd($seo_image);
                            @endphp
                            <img src="{{asset($item->image)}}" class="card-img-top" alt="{{$seo_image}}">
                            <div class="card-body">
                                <h4 class="card-title bold">{{$item->title}}</h4>
                                <p class="card-text">{{$item->short_des}}</p>
                            </div>
                            <div style="height: 53px"></div>
                            <a href="{{route('site.service-order')}}" class="btn  service_btn bold"
                               id="btn_{{$key}}" dir="{{General::getDir()}}">{{__('messages.order_now')}} ...</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    {{--End Services Section--}}

    {{--Start Counter Section--}}
    <div class="page-wrapper counter_section m-t-46">
        <section class="funfact-one jarallax" data-jarallax data-speed="0.3" data-imgPosition="50% 50%">
            <img src="{{asset('assets/front/images/bg-fun.webp')}}"
                 class="jarallax-img" alt="counter_background">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-md-6 col-lg-3 col-sm-6 col-sm-6 single_count  wow fadeInLeft"
                         data-wow-duration="1500ms" data-wow-delay="0ms"
                         style="text-align: left">
                        <div class="funfact-one__single funfact-one__single_1">
                            <h3 class="odometer counter_span" data-count="500">00</h3>
                            <p>{{__('messages.team_fun')}}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-sm-6 col-sm-6 single_count  wow fadeInLeft"
                         data-wow-duration="1500ms" data-wow-delay="100ms"
                         style="text-align: center">
                        <div class="funfact-one__single funfact-one__single_2">
                            <h3 class="odometer counter_span" data-count="24">00</h3>
                            <p>{{__('messages.hours_fun')}}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-sm-6 col-sm-6 single_count  wow fadeInLeft"
                         data-wow-duration="1500ms" data-wow-delay="200ms"
                         style="text-align: center">
                        <div class="funfact-one__single funfact-one__single_3">
                            <h3 class="odometer counter_span" data-count="1990">00</h3>
                            <p>{{__('messages.since_fun')}}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-sm-6 col-sm-6 single_count  wow fadeInLeft"
                         data-wow-duration="1500ms" data-wow-delay="300ms"
                         style="text-align: right">
                        <div class="funfact-one__single funfact-one__single_4">
                            <h3 class="odometer counter_span" data-count="3000">00</h3>
                            <p>{{__('messages.satisfied_fun')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{--End Counter Section--}}

    {{--Start Team Section--}}
    @if(isset($team) && $team->count() > 0)
        <section class="news_letter m-t-100 container">
            <div class="team_work_header external_page mb-5">
                <h3 class="bold mb-4 ts-0">{{__('messages.team')}}</h3>
            </div>
            <div class="team_work_section m-t-74">
                @foreach($team as $item)
                    <div class="bg-white rounded shadow-sm team_card col-md-3 col-6 col-sm-6  mb-2">
                        @php
                            $image =explode('/', $item->image);
                            $seo_image = end($image);
                            //dd($seo_image);
                        @endphp
                        <div class="member_image">
                            <img src="{{asset($item->image)}}" alt="{{$seo_image}}">
                        </div>
                        <div class="py-4 px-4 team_card_details">
                            <h5 class="mb-0">{{$item->name}}</h5><span
                                class="small text-uppercase text-muted">{{$item->job_title}}</span>
                            <ul class="social mb-0 list-inline mt-3">
                                @if($item->fb_url !== null)
                                    <li class="list-inline-item">
                                        <a href="{{$item->fb_url}}" class="social-link">
                                            <img src="{{asset('assets/front/images/fb.png')}}" alt="facebook"
                                                 style="width: 27px;">
                                        </a>
                                    </li>
                                @endif

                                @if($item->twitter_url !== null)

                                    <li class="list-inline-item">
                                        <a href="{{$item->twitter_url}}" class="social-link">
                                            <img src="{{asset('assets/front/images/twitter.png')}}" alt="twitter"
                                                 style="width: 27px;">
                                        </a>
                                    </li>
                                @endif

                                @if($item->instagram_url !== null)

                                    <li class="list-inline-item">
                                        <a href="{{$item->instagram_url}}" class="social-link">
                                            <img src="{{asset('assets/front/images/instagram.png')}}"
                                                 alt="instagram"
                                                 style="width: 27px;">
                                        </a>
                                    </li>
                                @endif

                                @if($item->behance_url !== null)

                                    <li class="list-inline-item">
                                        <a href="{{$item->behance_url}}" class="social-link" target="_blank">
                                            <img src="{{asset('assets/front/images/behance.png')}}" alt="behance"
                                                 style="width: 27px;">
                                        </a>
                                    </li>
                                @endif

                                @if($item->web_url !== null)

                                    <li class="list-inline-item">
                                        <a href="{{$item->web_url}}" class="social-link" target="_blank">
                                            <img src="{{asset('assets/front/images/website.png')}}" alt="website"
                                                 style="width: 27px;">
                                        </a>
                                    </li>
                                @endif
                                @if($item->whatsapp_url !== null)

                                    <li class="list-inline-item">
                                        <a href="{{$item->whatsapp_url}}" class="social-link">
                                            <img src="{{asset('assets/front/images/whatsapp.png')}}" alt="whatsapp"
                                                 style="width: 29px;">
                                        </a>
                                    </li>
                                @endif
                                @if($item->youtube_url !== null)

                                    <li class="list-inline-item">
                                        <a href="{{$item->youtube_url}}" class="social-link">
                                            <img src="{{asset('assets/front/images/youtube.png')}}" alt="youtube"
                                                 style="width: 27px;">
                                        </a>
                                    </li>
                                @endif

                                @if($item->linked_url !== null)
                                    <li class="list-inline-item">
                                        <a href="{{$item->linked_url}}" class="social-link" target="_blank">
                                            <img src="{{asset('assets/front/images/linkedin.png')}}" alt="linkedin"
                                                 style="width: 27px;">
                                        </a>
                                    </li>
                                @endif

                            </ul>
                        </div>

                    </div>
                @endforeach
            </div>
        </section>
    @endif
    {{--End Team Section--}}

    {{--Start Posts Section--}}
    @if(isset($posts) && $posts->count() > 0)
        <section class="news_letter container" style="margin-top: 180px">
            <div class="headline_div mb-5 m-t-100">
                <h3 class="bold mb-4 ts-0">{{__('messages.our_blog')}}</h3>
            </div>
            <div class="news_paper">
                @foreach($posts as $key => $item)
                    <div class="card">
                        <a href="{{route('site.post', $item->slug)}}">
                            <div class="card__header">
                                @php
                                    $images =explode(',',$item->image);
                                    //dd($seo_image);
                                        //dd($photo);
                                @endphp
                                <img src="{{asset($images[0])}}" alt="{{$item->title}}" class="card__image"
                                     width="100%">
                            </div>
                            <div class="card__body blog_card_body">
                                <span class="tag tag-blue">{{$item->category->title}}</span>
                                <h4 class="bold">{{$item->title}}</h4>
                                <p>{{$item->summary}}</p>
                            </div>
                            <div class="card__footer" dir="{{General::getDir()}}">
                                <div class="user">
                                    <img src="{{asset('assets/front/images/avatar.png')}}" alt="publisher-image"
                                         class="user__image">
                                    <div class="user__info">
                                        <h5 class="bold">{{__('messages.el-shireef')}}</h5>
                                        <small>{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
    {{--End Posts Section--}}

    {{--Start Projects Section--}}
    @if(isset($projects) && $projects->count() > 0)
        <section class="container projects_container mt-5">
            <div class="headline_div pt-5 gifing_div projects_section_head">
                <h3 class="bold mb-4 ts-0">{{__('messages.our_projects')}}</h3>
            </div>
            <div class="row text-center mt-5">

                @foreach($projects as $item)
                    <div class="card project_card col-md-3">
                        <div class="face face1">
                            <div class="content">
                                <a href="{{route('site.project', $item->slug)}}" class="project_link">
                                    <span class="stars"></span>
                                    <h2 class="title bold">{{$item->title}}</h2>
                                    <p class="title">{{$item->summary}}</p>
                                </a>
                            </div>
                        </div>
                        @php
                            $images =explode(',',$item->image);
                            $seo_image =explode('/', $images[0]);
                            //dd($seo_image);
                                //dd($photo);
                        @endphp
                        <div class="face face2"
                             style="background: linear-gradient(0deg, rgba(0,0,0,.3), rgba(0,0,0,.3)), url({{asset($images[0])}});">
                            <h2 class="bold">{{$item->title}}</h2>
                        </div>
                    </div>
                @endforeach


            </div>
        </section>
    @endif
    {{--End Projects Section--}}
@endsection




@section('script')
    <script>
        $(document).ready(function () {
            let btn_cart = $('.add-to-cart-btn-class');

            @if(backpack_auth()->check())
                // alert(btn_cart.css('cursor'));
                btn_cart.on('click', function () {
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
                            let added_products = $('.added_products');

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
            // alert(btn_cart.css('cursor'));
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


        });
    </script>
@stop

