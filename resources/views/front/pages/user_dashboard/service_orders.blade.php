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
                             - {{__('messages.service-orders')}}
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
                <th scope="col">{{__('messages.form.name')}}</th>
                <th scope="col">{{__('messages.services')}}</th>
                <th scope="col">{{__('messages.date')}}</th>
                <th scope="col">{{__('messages.status')}}</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($orders) && $orders->count() > 0)
                @foreach($orders as $order)
            <tr>
                <td>
                    <span>{{$order->name}}</span>
                </td>
                @php
                $services = "";
                foreach ($order->services as $key => $item) {
                    if ($key+1 === $order->services->count()) {
                        $services = $services . $item->title;
                    } else {
                        $services = $services . $item->title . ' , ' ;
                    }
                }
                //dd($services);
                @endphp
                <td>
                    <span>{{$services}}</span>
                </td>
                <td>
                    <span>{{\General::dateHandler($order->created_at)}}</span>
                </td>
                <td>
                    <span class="status {{$order->status}}">{{__('messages.'. $order->status)}}</span>
                </td>
            </tr>
            @endforeach
            @endif



            </tbody>
        </table>

    </div>
@stop
