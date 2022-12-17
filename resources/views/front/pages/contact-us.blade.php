@extends('front.layouts.master')

@section('meta')
    <meta name="csrf-token" content="{{csrf_token()}}">
@stop
@section('styles')
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
                            - {{__('messages.contact-us')}}
                        </h5>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section class="contact-us mt-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 col-12">
                    <h1>{{__('messages.happy')}}</h1>
                </div>

            </div>
            <div class="row mt-5" dir="{{General::getDir()}}">
                <div class="col-md-6 col-sm-6 col-xs-6 col-12 contact-methods">
                    <div class="mb-3">
                        <p class="mb-3">{{__('messages.contact-article')}}</p>
                    </div>
                    <div class="mt-2">
                        <ul>
                            @php
                                $settings = \App\Models\Setting::first();
                            @endphp
                            <li>
                                <a href="{{$settings->facebook}}" target="_blank">
{{--                                    <i class="fa-brands fa-facebook-square"></i>--}}
                                    <img class="fb_img" src="{{asset('assets/front/images/fb.png')}}" alt="fb-icon">
                                    <span> {{__('messages.fb')}}</span>
                                </a>
                            </li>
                            <li><a href="{{$settings->instagram}}" target="_blank">
{{--                                    <i class="fa-brands fa-instagram"></i> --}}
                                    <img class="fb_img" src="{{asset('assets/front/images/instagram.png')}}" alt="instagram-icon">
                                    <span> {{__('messages.insta')}}</span>
                                </a>
                            </li>
                            <li><a href="mailto:{{$settings->email}}">
                                    <img class="fb_img" src="{{asset('assets/front/images/email.png')}}" alt="mail-icon">
                                    <span> {{__('messages.mail')}}</span></a>
                            </li>
                            <li><a href="tel:{{$settings->phone}}">
                                    <img class="fb_img" src="{{asset('assets/front/images/phone.png')}}" alt="phone-icon">
                                    <span> {{__('messages.phone')}} </span></a>
                            </li>
                            <li><a href="{{$settings->whatsapp}}" target="_blank">
                                    <img class="fb_img" src="{{asset('assets/front/images/whatsapp.png')}}" alt="whats-icon">
                                    <span> {{__('messages.whats')}} </span></a>
                            </li>
                            <li><a href="{{$settings->behance}}" target="_blank">
                                    <img class="fb_img" src="{{asset('assets/front/images/behance.png')}}" alt="whats-icon">
                                    <span> {{__('messages.behance')}} </span></a>
                            </li>
                            <li><a href="{{$settings->twitter}}" target="_blank">
                                    <img class="fb_img" src="{{asset('assets/front/images/twitter.png')}}" alt="whats-icon">
                                    <span> {{__('messages.twitter')}} </span></a>
                            </li>
                            <li><a href="{{$settings->location}}" target="_blank">
                                    <img class="fb_img" src="{{asset('assets/front/images/location.png')}}" alt="whats-icon">
                                    <span> {{$settings->address}} </span></a>
                            </li>

                        </ul>
                    </div>

                </div>
                <div class="col-md-6 col-sm-6 col-xs-6 col-12">
                    <form action="{{route('send.contact.us')}}" method="post" class="p-4">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control"
                                   placeholder="{{__('messages.form.name')}}" id="name">
                            @if ($errors->has('name'))
                                <span class="required">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control"
                                   placeholder="{{__('messages.form.email')}}" id="email" aria-describedby="emailHelp">
                            @if ($errors->has('email'))
                                <span class="required">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <input type="tel" name="phone" class="form-control"
                                   placeholder="{{__('messages.form.phone')}}" id="phone">
                            @if ($errors->has('phone'))
                                <span class="required">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="reason">{{__('messages.form.reason.choose')}}</label>
                            <select name="reason" class="wide">
                                <option value="">{{__('messages.form.reason.choose')}}</option>
                                <option value="explain">{{__('messages.form.reason.explain')}}</option>
                                <option value="exchange">{{__('messages.form.reason.exchange')}}</option>
                                <option value="return">{{__('messages.form.reason.return')}}</option>
                                <option value="hurry">{{__('messages.form.reason.hurry')}}</option>
                                <option value="other">{{__('messages.form.reason.other')}}</option>
                            </select>
                            @if ($errors->has('reason'))
                                <span class="required">
                                <strong>{{ $errors->first('reason') }}</strong>
                            </span>
                            @endif
                        </div>
                        <input type="hidden" value="" name="reason" id="reason">
                        <div class="mb-3">
                            <input type="hidden" name="order_no" class="form-control"
                                   placeholder="{{__('messages.contact.orderNo')}}" id="noOrder">
                            @if ($errors->has('order_no'))
                                <span class="required">
                                <strong>{{ $errors->first('order_no') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <textarea placeholder="{{__('messages.form.message')}}" class="form-control" id="message"
                                      rows="3" name="message"></textarea>
                            @if ($errors->has('message'))
                                <span class="required">
                                <strong>{{ $errors->first('message') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="input-group mb-3">
                            <input type="submit" value="{{__('messages.send')}}" class="btn_submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@stop
@section('script')
    <script>

        $(document).ready(function () {
            let inp = $('#reason');

            let option1 = $(".contact-us div.nice-select ul.list li[data-value|='exchange']");
            let val1 = option1.data('value');
            option1.on('click', function (e) {
                e.preventDefault();
                inp.val(val1);
                $('#noOrder').attr('type', 'text');
            });

            let option2 = $(".contact-us div.nice-select ul.list li[data-value|='return']");
            let val2 = option2.data('value');
            option2.on('click', function (e) {
                e.preventDefault();
                inp.val(val2);
                $('#noOrder').attr('type', 'text');
            });

            let option3 = $(".contact-us div.nice-select ul.list li[data-value|='hurry']");
            let val3 = option3.data('value');
            option3.on('click', function (e) {
                e.preventDefault();
                inp.val(val3);
                $('#noOrder').attr('type', 'text');
            });

            let option4 = $(".contact-us div.nice-select ul.list li[data-value|='explain']");
            let val4 = option4.data('value');
            option4.on('click', function (e) {
                e.preventDefault();
                inp.val(val4);
                $('#noOrder').attr('type', 'hidden');
            });

            let option5 = $(".contact-us div.nice-select ul.list li[data-value|='other']");
            let val5 = option5.data('value');
            option5.on('click', function (e) {
                e.preventDefault();
                inp.val(val5);
                $('#noOrder').attr('type', 'hidden');
            });
            let option0 = $(".contact-us div.nice-select ul.list li[data-value|='']");
            let val0 = option0.data('value');
            option0.on('click', function (e) {
                e.preventDefault();
                inp.val(val0);
                $('#noOrder').attr('type', 'hidden');
            });


        });


    </script>
@stop
