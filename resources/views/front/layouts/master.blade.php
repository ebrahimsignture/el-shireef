<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
@yield('meta')
{!! SEOMeta::generate() !!}
{!! OpenGraph::generate() !!}
{!! JsonLd::generate() !!}

<!-- Favicon -->

    @php
        $settings = \App\Models\Setting::first();
    @endphp
    <link rel="icon" type="image/png" href="{{asset($settings->logo)}}">    <!-- Web Font -->
    <link href="https://fonts.googleapis.com/css?family=Almarai"/>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/front/css/all.css')}}">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="{{asset('assets/front/css/themify-icons.css')}}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{asset('assets/front/css/nice-select.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('assets/front/css/animate.css')}}">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{asset('assets/front/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/owl.theme.default.min.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">


    @yield('link')


    <link rel="stylesheet" href="{{asset('assets/front/css/gallery.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/util.css')}}">

<!-- My Styles -->
    <link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('assets/front/css/locale_' . LaravelLocalization::getCurrentLocale() . '.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/media-queries.css')}}">
        <link rel="stylesheet" href="{{asset('assets/front/css/media-queries_'  . LaravelLocalization::getCurrentLocale() . '.css')}}">
    @yield('styles')
    <style>
        .out-pages-header {direction: {{General::getDir()}}}
        .shopping-tools {direction: ltr}
    </style>
</head>
<body dir="ltr">

@include('front.pages.includes.header')

<!-- Content -->
<main class="bg-light">

@include('front.pages.includes.alerts.ajax-notify')
@include('front.pages.includes.alerts.success')
@include('front.pages.includes.alerts.errors')
@include('front.pages.includes.alerts.error-auth')

@if(!backpack_auth()->check())

    <!-- Start Modal Sign -->
    <div class="modal fade" id="sign" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <a style="padding: 3px; border-radius: 4px;color: #000;font-size: 18px;font-weight: bold;border: 2.5px solid #061226; position: absolute; top: 15px; right: 20px; z-index: 1000;opacity: .7"
                   type="button" class="btn-close" data-bs-dismiss="modal"
                   aria-label="Close">

                </a>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 .col-xs-12 .col-sm-12 col-12 modal_bg">
                            <img src="{{asset('assets/front/images/bg-sign.png')}}" alt="" style="width: 100%;border-radius: 8px">
                        </div>
                        <div class="col-md-7 .col-xs-12 .col-sm-12 col-12">
                            <nav class="text-center mt-5">
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="register active" data-bs-toggle="tab"
                                            data-bs-target="#nav-register"
                                            type="button" role="tab" aria-controls="nav-register"
                                            aria-selected="true">{{__('messages.register')}}</button>
                                    <button class="login" data-bs-toggle="tab" data-bs-target="#nav-login"
                                            type="button"
                                            role="tab" aria-controls="nav-login"
                                            aria-selected="false">{{__('messages.login')}}</button>
                                </div>
                            </nav>
                            <div class="tab-content mt-4" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-register" role="tabpanel"
                                     aria-labelledby="nav-register-tab" dir="{{General::getDir()}}">
                                    <form action="{{ route('register.post') }}" method="post">
{{--                                    <form action="#" method="post">--}}
                                        @csrf
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa-solid fa-spell-check"></i>
                                            </span>
                                            <input type="text" name="first_name"
                                                   class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}"
                                                   placeholder="{{__('messages.first_name')}}" aria-label="first_name"
                                                   value="{{ old('first_name') }}"
                                                   aria-describedby="basic-addon1" autocomplete="first_name">
                                            @if ($errors->has('first_name'))
                                                <br>
                                                <span class="invalid-feedback">
                                                    <strong>
                                                        {{ $errors->first('first_name') }}
                                                    </strong>
                                                </span>
                                            @endif
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa-solid fa-spell-check"></i>
                                            </span>
                                            <input type="text" name="last_name"
                                                   class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                                   placeholder="{{__('messages.last_name')}}" aria-label="last_name"
                                                   value="{{ old('last_name') }}"
                                                   aria-describedby="basic-addon1" autocomplete="last_name">
                                            @if ($errors->has('last_name'))
                                                <br>
                                                <span class="invalid-feedback">
                                                    <strong>
                                                        {{ $errors->first('last_name') }}
                                                    </strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="fa-solid fa-phone"></i></span>
                                            <input type="text" name="phone"
                                                   class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                   placeholder="{{__('messages.phone')}}" aria-label="phone"
                                                   value="{{ old('phone') }}"
                                                   aria-describedby="basic-addon1" autocomplete="phone">
                                            @if ($errors->has('phone'))
                                                <br>
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa-solid fa-envelope"></i></span>
                                            <input type="email" name="register_email"
                                                   class="form-control {{ $errors->has('register_email') ? ' is-invalid' : '' }}"
                                                   placeholder="{{__('messages.email')}}" aria-label="register_email"
                                                   value="{{ old('register_email') }}"
                                                   aria-describedby="basic-addon1" autocomplete="username">
                                            @if ($errors->has(backpack_authentication_column()))
                                                <br>
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('register_email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa-solid fa-key"></i></span>
                                            <input type="password" name="password"
                                                   class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                   placeholder="{{__('messages.password')}}" id="password"
                                                   autocomplete="current-password">
                                            @if ($errors->has('password'))
                                                <br>
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa-solid fa-key"></i></span>
                                            <input type="password" name="password_confirmation"
                                                   class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                                   placeholder="{{__('messages.confirm.password')}}"
                                                   id="password_confirmation">
                                            @if ($errors->has('password_confirmation'))
                                                <br>
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1"
                                                   id="flexCheckDefault" name="terms_agreed" required>
                                            <label class=" check-lable form-check-label" for="flexCheckDefault">
                                                {{__('messages.agree')}}<a class="terms"
                                                                           href="{{route('site.privacy.policy')}}">{{__('messages.privacy')}}</a>
                                            </label>
                                        </div>
                                        <div class="input-group mt-4">
                                            <input type="submit" value="{{__('messages.register')}}"
                                                   class="btn_submit">
                                        </div>
                                    </form>
                                    <div class="mt-4">

                                        <div class="or">
                                            <span>{{__('messages.or_sign')}}</span>
                                        </div>
                                        <div class="line_through"></div>

                                    </div>
                                    <div class="input-group mt-4 text-center" dir="ltr">
{{--                                        <a class="fb_btn" href="{{route('facebook.login')}}"><i class="fa-brands fa-facebook-square fa-xl"></i>--}}
                                        <a class="fb_btn" href="#"><i class="fa-brands fa-facebook-square fa-xl"></i>
                                            Facebook
                                        </a>
{{--                                        <a class="google_btn" href="{{route('google.login')}}"><i class="fa-brands fa-google-plus-g fa-xl"></i>--}}
                                        <a class="google_btn" href="#"><i class="fa-brands fa-google-plus-g fa-xl"></i>
                                            Google
                                        </a>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="nav-login" role="tabpanel"
                                     aria-labelledby="nav-register-tab" dir="{{General::getDir()}}">
                                    <form action="{{ route('backpack.auth.login') }}" method="post">
{{--                                    <form action="#" method="post">--}}
                                        @csrf
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa-solid fa-envelope"></i></span>
                                            <input type="email" name="email"
                                                   class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   value="{{ old('email') }}" id="email"
                                                   placeholder="{{__('messages.email')}}" aria-label="Email"
                                                   aria-describedby="basic-addon1" autocomplete="username">
                                            @if ($errors->has('email'))
                                                <br>
                                                <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa-solid fa-key"></i></span>
                                            <input type="password" name="password"
                                                   class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                   placeholder="{{__('messages.password')}}" id="inputPasswordLogin"
                                                   autocomplete="current-password">
                                            @if ($errors->has('password'))
                                                <br>
                                                <span class="invalid-feedback">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-check"  dir="ltr">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                   id="remember">
                                            <label class=" check-lable form-check-label" for="remember" style="display: inline-block">
                                                {{__('messages.remember')}}
                                            </label>
                                            <a href="{{ route('backpack.auth.password.reset') }}" class="forget">{{__('messages.forget')}}</a>
{{--                                            <a href="#" class="forget">{{__('messages.forget')}}</a>--}}
                                        </div>
                                        <div class="input-group mt-4">
                                            <input type="submit" value="{{__('messages.login')}}"
                                                   class="btn_submit">
                                        </div>
                                    </form>
                                    <div class="mt-4">

                                        <div class="or">
                                            <span>{{__('messages.or_sign')}}</span>
                                        </div>
                                        <div class="line_through"></div>

                                    </div>
                                    <div class="input-group mt-4 text-center" dir="ltr">
{{--                                        <a class="fb_btn" href="{{route('facebook.login')}}"><i class="fa-brands fa-facebook-square fa-xl"></i>--}}
                                        <button class="fb_btn"><i class="fa-brands fa-facebook-square fa-xl"></i>
                                            Facebook
                                        </button>
{{--                                        <a class="google_btn" href="{{route('google.login')}}"><i class="fa-brands fa-google-plus-g fa-xl"></i>--}}
                                        <a class="google_btn" href="#"><i class="fa-brands fa-google-plus-g fa-xl"></i>
                                            Google
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Sign -->

@endif

    @php
        $settings = \App\Models\Setting::first();
    @endphp


    @yield('content')
    @if(backpack_auth()->check())
        <input type="hidden" value="{{backpack_auth()->user()->id}}" id="user_id">
    @endif
    <input type="hidden" value="{{LaravelLocalization::getCurrentLocale()}}" id="locale">

</main>
<!-- End content -->

@include('front.pages.includes.footer')


{{-- JQuery --}}
<script src="{{asset('assets/front/js/jquery-3.6.0.min.js')}}"></script>

<!-- Bootstrap JS -->
<script src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>


<!-- For Fixed Counter Background JS -->
<script src="{{asset('assets/front/js/jarallax.min.js')}}"></script>

<!-- For Counter Appearing JS -->
<script src="{{asset('assets/front/js/jquery.appear.min.js')}}"></script>

<!-- For Counter Odometer -->
<script src="{{asset('assets/front/js/odometer.min.js')}}"></script>


<!-- Nice Select JS -->
<script src="{{asset('assets/front/js/jquery.nice-select.js')}}"></script>
<!-- Owl Carousel JS -->
<script src="{{asset('assets/front/js/owl.carousel.min.js')}}"></script>

<script src="{{asset('assets/front/js/wow.min.js')}}"></script>
<script>
    new WOW().init();
</script>

<script src="{{asset('assets/front/js/jquery.waypoints.min.js')}}"></script>


<script src="{{asset('assets/front/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('assets/front/js/gallery.js')}}"></script>

{{-- Js Script --}}
<script src="{{asset('assets/front/js/main.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.spans_container_dismiss img').hover(function () {
            $('.spans_container_dismiss img').attr('src', '{{asset('assets/front/images/dismiss_2.png')}}');
        }, function () {
            $('.spans_container_dismiss img').attr('src', '{{asset('assets/front/images/dismiss.png')}}');
        });

        window.setTimeout(function () {
            $('#whats_plugin').slideDown();
            // $('#close_plugins').slideDown();
        }, 4000);


    });



</script>

@yield('script')


@if(Session::has('error-auth'))
    <script>
        ToastyAuthError();
    </script>
@endif
@if(Session::has('error'))
    <script>
        ToastyError();
    </script>
@endif
@if($errors->has('subscription_email'))
    <script>
        ToastyError();
    </script>
@endif
@if(Session::has('success'))
    <script>
        ToastySuccess();
    </script>
@endif
</body>
</html>
