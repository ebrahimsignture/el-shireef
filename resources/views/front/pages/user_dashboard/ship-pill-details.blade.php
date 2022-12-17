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
                            - <a href="{{route('site.user.dashboard')}}">
                        <span class="bold home_span">
                            {{__('messages.user.dashboard')}}
                        </span>
                            </a>
                            - {{__('messages.ship.pill.details')}}
                        </h5>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('dashboard-content')
    <div class="user-address">
        <h5>{{__('messages.address.span')}}</h5>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-12 ">
                <div class="card user-ship-pill-details mt-3">
                    <div>
                        <h5 class="card-header">{{__('messages.ship.pill.details')}} <a href="{{route('site.user.ship.pill.details.edit')}}" class="px-5"><i class="fa-solid fa-pen-clip"></i></a></h5>

                    </div>
                    <div class="card-body">
                        <table class="total-info-body">
                            <tbody>
                            <tr class="order-card-title">
                                <th class="title">
                                    <div class="div_span">
                                        <span>{{__('messages.first_name')}}</span>
                                    </div>
                                </th>
                                <th class="content">
                                    <div class="div_span">
                                        <span>{{$details->first_name ? $details->first_name : "..............."}}</span>
                                    </div>
                                </th>
                            </tr>
                            <tr class="order-card-title">
                                <th class="title">
                                    <div class="div_span">
                                        <span>{{__('messages.last_name')}}</span>
                                    </div>
                                </th>
                                <th class="content">
                                    <div class="div_span">
                                        <span>{{$details->last_name ? $details->last_name : "..............."}}</span>
                                    </div>
                                </th>
                            </tr>
                            <tr class="order-card-title">
                                <th class="title">
                                    <div class="div_span"><span>{{__('messages.phone')}}</span>
                                    </div>
                                </th>
                                <th class="content">
                                    <div class="div_span">
                                        <span>{{$details->phone ? $details->phone : "..............."}}</span>
                                    </div>
                                </th>
                            </tr>
                            <tr class="order-card-title">
                                <th class="title">
                                    <div class="div_span">
                                        <span>{{__('messages.form.email')}}</span>
                                    </div>
                                </th>
                                <th class="content">
                                    <div class="div_span">
                                        <span>{{$details->email ? $details->email : "..............."}}</span>
                                    </div>
                                </th>
                            </tr>
                            <tr class="order-card-title">
                                <th class="title">
                                    <div class="div_span">
                                        <span>{{__('messages.city')}}</span>
                                    </div>
                                </th>
                                <th class="content">
                                    <div class="div_span">
                                        <span>{{$details->shipping_id  ? $details->shipping->place . ' - ' . $details->shipping->price . ' EGP' : "..............."}}</span>
                                    </div>
                                </th>
                            </tr>
                            <tr class="order-card-title">
                                <th class="title">
                                    <div class="div_span">
                                        <span>{{__('messages.state')}}</span>
                                    </div>
                                </th>
                                <th class="content">
                                    <div class="div_span">
                                        <span>{{$details->state ? $details->state : "..............."}}</span>
                                    </div>
                                </th>
                            </tr>
                            <tr class="order-card-title">
                                <th class="title">
                                    <div class="div_span">
                                        <span>{{__('messages.form.street')}}</span>
                                    </div>
                                </th>
                                <th class="content">
                                    <div class="div_span">
                                        <span>{{$details->address1 ? $details->address1 : "..............."}}</span>
                                    </div>
                                </th>
                            </tr>




                            <tr>
                                <th colspan="2">
                                    <div class="notes">

                                        <span class="p-0">{{__('messages.shipping.notes')}} : </span>
                                        <span class="p-0">{{__('messages.the.notes.about.shipping')}}</span>
                                    </div>
                                </th>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
