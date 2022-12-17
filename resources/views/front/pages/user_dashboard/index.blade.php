@extends('front.layouts.user-dashboard')

@section('top-head-bar')
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
                            - {{__('messages.user.dashboard')}}
                        </h5>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('dashboard-content')

    <div class="user-hi mt-4">
        <h5>
            {{__('messages.hi')}}
            <span class="bold">
                {{$user->first_name}}
            </span>
            ({{__('messages.not')}}
            <span class="bold">
                {{$user->first_name . ' ' . __('messages.qm')}}
            </span>
            <a href="{{route('backpack.auth.logout')}}">{{__('messages.logout')}}</a>)
        </h5>
        <p>
            {{__('messages.dash.explain.1')}}
            <a href="{{route('site.user.productsOrders')}}">
                {{__('messages.product-orders')}}
            </a>
            ,
            <a href="{{route('site.user.serviceOrders')}}">
                {{__('messages.service-orders')}}
            </a>
            ,
            <a href="{{route('site.user.ship.pill.details')}}">
                {{__('messages.manage.pill.ship')}}
            </a>
            {{__('messages.dash.explain.2')}}
            <a href="{{route('site.user.personal.info.edit')}}">
                {{__('messages.edit.info')}}
            </a>
        </p>
    </div>
@stop
