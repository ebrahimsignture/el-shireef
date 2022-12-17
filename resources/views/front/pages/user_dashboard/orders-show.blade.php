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
                            -
                            <a href="{{route('site.user.dashboard')}}">
                                <span class="bold home_span">
                                    {{__('messages.user.dashboard')}}
                                </span>
                            </a>
                            -
                            <a href="{{route('site.user.productsOrders')}}">
                                <span class="bold home_span">
                                    {{__('messages.product-orders')}}
                                </span>
                            </a>
                            - {{$order->order_number}}
                        </h5>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('dashboard-content')
    <div class="user-order">
        <div class="thank-note" style="font-size: 17px;">
                    <span>{{__('messages.track.note.1') }} &nbsp;<span
                            class="bold">{{ $order->order_number }}  &nbsp;</span> {{__('messages.track.note.2') }}   &nbsp;<span
                            class="bold">{{\General::dateHandler($order->created_at) }} </span> &nbsp;{{ __('messages.track.note.3')}} &nbsp; <span
                            class="status {{$order->status}}">{{__('messages.'.$order->status)}}</span></span>
        </div>


        <div class="row mt-4">

            <div class="card user-order-details col-md-12 col-sm-12 col-12">
                <div>
                    <h5 class="card-header">{{__('messages.order.details')}}</h5>
                </div>
                <div class="card-body">
                    <table class="total-info-body">
                        <tbody>
                        <tr class="order-card-title">
                            <th class="title">
                                <div class="div_span">
                                    <span>{{__('messages.form.orderNo')}}</span>
                                </div>
                            </th>
                            <th class="content">
                                <div class="div_span">
                                    <span>{{$order->order_number}}</span>
                                </div>
                            </th>
                        </tr>
                        <tr class="order-card-title">
                            <th class="title">
                                <div class="div_span">
                                    <span>{{__('messages.date')}}</span>
                                </div>
                            </th>
                            <th class="content">
                                <div class="div_span">
                                    <span>{{\General::dateHandler($order->created_at)}}</span>
                                </div>
                            </th>
                        </tr>
                        <tr class="order-card-title bg-special">
                            <th class="title">
                                <div class="div_span">
                                    <span>{{__('messages.product')}}</span>
                                </div>
                            </th>
                            <th class="content">
                                <div class="div_span">
                                    <span>{{__('messages.total')}}</span>
                                </div>
                            </th>
                        </tr>
                        @foreach($order->cart_info as $item)
                            <tr>
                                <th class="title">
                                    <div class="div_span">
                                        <span dir="ltr">{{$item->product->title}} x {{$item->quantity}} </span>

                                    </div>
                                </th>
                                <th class="content">
                                    <div class="div_span">
                                        <span>{{number_format($item->amount,2)}} EGP</span>
                                    </div>
                                </th>
                            </tr>
                        @endforeach

                        <tr class="order-card-title bg-special">
                            <th class="title">
                                <div class="div_span">
                                    <span>{{__('messages.total')}} </span>
                                </div>
                            </th>
                            <th class="content">
                                <div class="div_span">
                                    <span>{{number_format($order->sub_total,2)}} EGP</span>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th class="title">
                                <div class="div_span">
                                    <span>{{__('messages.shipping')}} </span>
                                </div>

                            </th>
                            <th class="content">
                                <div class="div_span">
                                    <span>{{number_format($order->shipping->price,2)}} EGP</span>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <div class="div_span">
                                    <span>{{__('messages.payment.method')}} </span>
                                </div>
                            </th>
                            <th>
                                <div class="div_span">
                                    <span>
                                        <img src="{{asset('assets/front/images/miza.png')}}" alt="payment-img" class="payment-img">
                                        <img src="{{asset('assets/front/images/mastercard.png')}}" alt="payment-img" class="payment-img">
                                        <img src="{{asset('assets/front/images/visa.png')}}" alt="payment-img" class="payment-img">
                                    </span>
                                </div>
                            </th>

                        </tr>
                        <tr class="order-card-title bg-special">
                            <th class="title">
                                <div class="div_span">
                                    <span>{{__('messages.final-total')}} </span>
                                </div>

                            </th>
                            <th class="content">
                                <div class="div_span">
                                    <span>{{number_format($order->total_amount,2)}} EGP</span>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="2">
                                <div class="notes">
                                    <span class="p-0">{{__('messages.note')}} : </span>
                                    <span class="p-0">{{__('messages.check.order')}}</span>
                                </div>
                            </th>

                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>


            <div class="card col-md-12 col-sm-12 col-12 user-ship-pill-details mt-3">
                <div>
                    <h5 class="card-header">{{__('messages.ship.pill.details')}}</h5>
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
                                    <span>{{$order->first_name}}</span>
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
                                    <span>{{$order->last_name}}</span>
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
                                    <span>{{$order->phone}}</span>
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
                                    <span>{{$order->email}}</span>
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
                                    <span>{{$order->shipping->place }}</span>
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
                                    <span>{{$order->state}}</span>
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
                                    <span>{{$order->address1}}</span>
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
@stop
