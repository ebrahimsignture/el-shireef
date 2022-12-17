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
                            - {{__('messages.service_order')}}
                        </h5>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @if(Session::has('error'))
        <div class="container">
            <button type="text" class="btn btn-lg btn-block btn-danger mb-2 mt-5" id="type-error" style="width: 100%;">
                {{Session::get('error')}}
            </button>
        </div>
    @endif
    @if(Session::has('success'))
        <div class="container">
            <button type="text" class="btn btn-lg btn-block btn-success mb-2 mt-5" id="type-error" style="width: 100%;">
                {{Session::get('success')}}
            </button>
        </div>

    @endif
    <section class="jobs_section mt-5 container" dir="{{General::getDir()}}">
        <form action="{{route('site.place.order')}}" class="apply_form pb-5" method="post"
              enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <div class="col-md-2"></div>
                <label for="full_name" class="col-md-2 col-sm-2 col-form-label">{{__('messages.full-name')}}</label>
                <div class="col-md-8 col-sm-10" style="margin: auto">
                    <input type="text" class="form-control" id="full_name" placeholder="{{__('messages.full-name')}}" name="name"
                           value="{{old('name')}}" required>
                    @error('name')
                    <span class="text-danger" role="alert">
                                {{$message}}
                            </span>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-md-2"></div>
                <label for="email" class="col-md-2 col-sm-2 col-form-label">{{__('messages.form.email')}}  </label>
                <div class="col-md-8 col-sm-10" style="margin: auto">
                    <input type="email" class="form-control" id="email" placeholder="{{__('messages.form.email')}} "
                           name="email" value="{{old('email')}}" required>
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-md-2"></div>
                <label for="phone" class="col-md-2 col-sm-2 col-form-label">{{__('messages.form.phone')}}     </label>
                <div class="col-md-8 col-sm-10" style="margin: auto">
                    <input type="text" class="form-control" id="phone" placeholder="{{__('messages.phone-pill-holder')}}" name="phone"
                           value="{{old('phone')}}" required>
                    @error('phone')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>



            <div class="mb-3 row">
                <div class="col-md-2"></div>
                <label for="hear_about_job" class="col-md-2 col-sm-2 col-form-label">{{__('messages.choose_service')}} </label>
                <div class="col-md-8 col-sm-10" style="margin: auto">

                    @php
                        $services = \App\Models\Service::active()->get();
                    @endphp
                    @foreach($services as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{$item->id}}" id="{{$item->slug}}" name="services[]">
                            <label class="form-check-label" for="{{$item->slug}}">
                                {{$item->title}}
                            </label>
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-md-2"></div>
                <label for="details" class="col-md-2 col-sm-2 col-form-label">{{__('messages.order.details') }}<br>{{__('messages.optional')}}</label>
                <div class="col-md-8 col-sm-10" style="margin: auto">
                            <textarea class="form-control" id="details" name="details" style="height: 200px"></textarea>
                    @error('details')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row" dir="rtl">
                <div class="col-auto submit-btn-div col-12 col-sm-12" >
                    <button type="submit" class="btn_submit my-3">{{__('messages.order_now')}}</button>
                </div>
            </div>


        </form>
    </section>
    {{--  End Done--}}

@endsection


@section('styles')
@stop



@section('script')

@stop

