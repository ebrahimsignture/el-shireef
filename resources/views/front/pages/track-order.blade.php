@extends('front.layouts.master')


@section('meta')
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
                            - {{__('messages.track')}}
                        </h5>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section class="track-order mt-5" dir="{{General::getDir()}}">
        <div class="container">
            <div class="row header">
                <div class="col-md-12 col-sm-12 col-xs-12 col-12">
                    <h1>{{__('messages.track')}}</h1>
                </div>

            </div>
            <div class="row main">
                <div class="col-md-12 col-sm-12 col-xs-12 col-12">
                    <p class="mb-3">{{__('messages.track-article')}}</p>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 col-12">
                    <form action="{{route('site.track-result')}}" method="post">
{{--                    <form action="#" method="post">--}}
                        @csrf
                        <div class="mb-3">
                            <label for="noOrder" class="form-label">{{__('messages.form.orderNo')}}</label>
                            <input type="text" name="order_number" class="form-control" id="noOrder" placeholder="{{__('messages.track.form.instructions.1')}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="bill_email" class="form-label">{{__('messages.track.email')}}</label>
                            <input type="email" name="bill_email" class="form-control" id="bill_email" placeholder="{{__('messages.track.form.instructions.2')}}" required>
                        </div>
                        <div class="mb-3">
                            <div class="col-auto">
                                <button type="submit" class="btn_submit my-3">{{__('messages.track')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@stop
@section('script')
    <script>





    </script>
@stop
