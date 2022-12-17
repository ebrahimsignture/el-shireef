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
                            - {{__('messages.product-orders')}}
                        </h5>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('dashboard-content')
    <div class="user-orders">

        <table class="table table-hover orders-table">
            <thead class="table-light">
            <tr>
                <th scope="col">{{__('messages.form.orderNo')}}</th>
                <th scope="col">{{__('messages.date')}}</th>
                <th scope="col">{{__('messages.status')}}</th>
                <th scope="col">{{__('messages.final-total')}}</th>
                <th scope="col">{{__('messages.options')}}</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($orders) && $orders->count() > 0)
                @foreach($orders as $order)
            <tr>
                <td>
                    <a href="{{route('site.user.orders.show', $order->id)}}" ><span class="bold">{{$order->order_number}}</span></a>
                </td>
                <td>
                    <span>{{\General::dateHandler($order->created_at)}}</span>
                </td>
                <td>
                    <span>{{__('messages.'. $order->status)}}</span>
                </td>
                <td>
                    <span>{{number_format($order->total_amount,2)}} EGP</span>
                </td>
                <td>
                    <a href="{{route('site.user.orders.show', $order->id)}}" class="btn btn-primary">{{__('messages.details')}}</a>
                </td>
            </tr>
            @endforeach
            @endif



            </tbody>
        </table>

    </div>
@stop
