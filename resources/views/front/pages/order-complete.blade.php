@extends('front.layouts.master')



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
                            - @if( Route::currentRouteName() == 'site.track-result'  )
                                {{__('messages.order-result')}}

                            @else
                                {{__('messages.order_complete')}}
                            @endif

                        </h5>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section class="order-completed-page">
        @if(isset($order))
            @if( Route::currentRouteName() == 'site.track-result'  )
                <div class="thank-note" dir="{{General::getDir()}}">
                    <span>{{__('messages.track.note.1') }} &nbsp;<span
                            class="bold">{{ $order->order_number }}  &nbsp;</span> {{__('messages.track.note.2') }}   &nbsp;<span
                            class="bold">{{\General::dateHandler($order->created_at) }} </span> &nbsp;{{ __('messages.track.note.3')}} &nbsp; <span
                            class="status {{$order->status}}">{{__('messages.'.$order->status)}}</span></span>
                </div>

            @else


                @if(Session::has('success'))

                    <div class="thank-note" dir="{{General::getDir()}}">
                        <span>{{Session::get('success')}}</span>
                    </div>
                @endif
            @endif


            <div class="order-details">
                <div class="card order-details-card col-sm-12 col-12 d-inline-block">
                    <h5 class="card-header">{{__('messages.order.details')}}</h5>
                    <div class="card-body" dir="{{General::getDir()}}">
                        <table class="total-info-body">
                            <tbody>
                            <tr>
                                <th>
                                    <span>{{__('messages.form.orderNo')}} :</span>
                                </th>
                                <th>
                                    <span class="info-cell">{{$order->order_number}}</span>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <span>{{__('messages.date')}} : </span>
                                </th>
                                <th>
                                    <span>{{\General::dateHandler($order->created_at)}}  </span>
                                </th>
                            </tr>
                            <tr class="order-card-title">
                                <th class="title"><span>{{__('messages.product')}}</span></th>
                                <th class="content">
                                    <span>{{__('messages.total')}}</span>
                                </th>
                            </tr>
                            @foreach($order->cart_info as $item)
                                <tr>
                                    <th class="title">
                                        <span dir="ltr">{{$item->product->title}} x {{$item->quantity}} </span>
                                    </th>
                                    <th class="content">
                                        <span>{{number_format($item->amount,2)}} EGP</span>
                                    </th>
                                </tr>
                            @endforeach

                            <tr class="order-card-title">
                                <th class="title">
                                    <span>{{__('messages.total')}} </span>

                                </th>
                                <th class="content">
                                    <span>{{number_format($order->sub_total,2)}} EGP</span>
                                </th>
                            </tr>
                            <tr>
                                <th class="title">
                                    <span>{{__('messages.shipping')}} </span>

                                </th>
                                <th class="content">
                                    <span>{{number_format($order->shipping->price,2)}} EGP</span>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <span>{{__('messages.payment.method')}} : </span>
                                </th>
                                <th>
                                    <img src="{{asset('assets/front/images/miza.png')}}" alt="payment-img" class="payment-img">
                                    <img src="{{asset('assets/front/images/mastercard.png')}}" alt="payment-img" class="payment-img">
                                    <img src="{{asset('assets/front/images/visa.png')}}" alt="payment-img" class="payment-img">
                                </th>

                            </tr>
                            <tr class="order-card-title">
                                <th class="title">
                                    <span>{{__('messages.final-total')}} </span>

                                </th>
                                <th class="content">
                                    <span>{{number_format($order->total_amount,2)}} EGP</span>
                                </th>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card  col-sm-12 col-12 d-inline-block ship-pill-details">
                    <h5 class="card-header">{{__('messages.ship.pill.details')}}</h5>
                    <div class="card-body"  dir="{{General::getDir()}}">
                        <table class="total-info-body">
                            <tbody>
                            <tr>
                                <th colspan="1"><span>{{__('messages.first_name')}}</span></th>
                                <th colspan="2">
                                    <span>{{$order->first_name}}</span>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="1"><span>{{__('messages.last_name')}}</span></th>
                                <th colspan="2">
                                    <span>{{$order->last_name}}</span>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="1">
                                    <span>{{__('messages.phone')}} </span>
                                </th>
                                <th colspan="2">
                                    <span>{{$order->phone}}</span>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="1">
                                    <span>{{__('messages.form.email')}}</span>
                                </th>
                                <th colspan="2">
                                    <span>{{$order->email}}</span>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="1">
                                    <span>{{__('messages.city')}} </span>

                                </th>
                                <th colspan="2">
                                    <span>{{$order->shipping->place}}</span>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="1">
                                    <span>{{__('messages.state')}} </span>

                                </th>
                                <th colspan="2">
                                    <span>{{$order->state}}</span>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="1">
                                    <span>{{__('messages.form.street')}} </span>

                                </th>
                                <th colspan="2">
                                    <span>{{$order->address1}}</span>
                                </th>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        @else
            <div class="order-details">
                <h4>
                    {{__('messages.empty.track')}}
                </h4>
            </div>
        @endif
    </section>
    <div style="clear: both"></div>
@stop
@section('script')

@stop
