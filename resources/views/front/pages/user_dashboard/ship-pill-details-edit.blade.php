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
                            <a href="{{route('site.user.ship.pill.details')}}">
                                <span class="bold home_span">
                                    {{__('messages.ship.pill.details')}}
                                </span>
                            </a>
                            - {{__('messages.edit')}}
                        </h5>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('dashboard-content')
    <div class="ship-pill-details-edit bg-light">
            <form class="" method="post" action="{{route('site.user.ship.pill.details.update')}}">
                @csrf
                <div class="pill-form col-md-12 col-12 col-sm-12 ">
                    <h5 class="card-header mb-3 p-3">{{__('messages.ship.pill.details')}}</h5>
                    <div class="pill-form-inputs px-3">
                        <div class="row my-1">
                            <div class="col-md-12 col-12 col-sm-12">
                                <label for="first_name">{{__('messages.first_name')}}</label>
                                <input type="text" name="first_name" class="form-control py-2"
                                       placeholder="{{__('messages.first_name')}}" id="first_name"
                                value="{{$details->first_name}}">
                                @if ($errors->has('first_name'))
                                    <span class="required">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-md-12 col-12 col-sm-12">
                                <label for="last_name">{{__('messages.last_name')}}</label>
                                <input type="text" name="last_name" class="form-control py-2"
                                       placeholder="{{__('messages.last_name')}}" id="last_name"
                                value="{{$details->last_name}}">
                                @if ($errors->has('last_name'))
                                    <span class="required">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12 col-sm-12 my-1">
                                <label for="phone">{{__('messages.form.phone')}} </label>
                                <input type="text" name="phone" class="form-control py-2"
                                       placeholder="{{__('messages.phone-pill-holder')}}" id="phone"
                                       value="{{$details->phone}}">
                                @if ($errors->has('phone'))
                                    <span class="required">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 col-12 col-sm-12 my-1">
                                <label for="email">{{__('messages.form.email')}} <span>{{__('messages.optional')}}</span></label>
                                <input type="email" name="email" class="form-control py-2"
                                       placeholder="{{__('messages.form.email')}}" id="email" aria-describedby="emailHelp"
                                       value="{{$details->email}}">
                                @if ($errors->has('email'))
                                    <span class="required">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-12 col-sm-12 my-1">
                                <label for="shipping_id">
                                    {{__('messages.c.s.c')}}
                                </label>
                                <select name="shipping_id" id="shipping_id" class="wide">
                                    <option value="">{{__('messages.choose.city')}}</option>
                                    @php
                                        $ships = \App\Models\Shipping::active()->get();
                                    @endphp
                                    @foreach($ships as $ship)
                                        <option
                                            value="{{$ship->id}}" {{$details->shipping_id === $ship->id ? 'selected' : ''}}>{{$ship->place}}
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$ship->price}} EGP
                                        </option>

                                    @endforeach

                                </select>
                                @if ($errors->has('shipping_id'))
                                    <span class="required">
                                        <strong>{{ $errors->first('shipping_id') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <div class="col-md-4 col-12 col-sm-12 my-1">
                                <label for="state">{{__('messages.state')}} </label>
                                <input type="text" name="state" class="form-control"
                                       placeholder="{{__('messages.state')}}" id="state" value="{{$details->state}}">
                                @if ($errors->has('state'))
                                    <span class="required">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 col-12 col-sm-12 my-1">
                                <label for="address1">{{__('messages.street')}} </label>
                                <input type="text" name="address1" class="form-control"
                                       placeholder="{{__('messages.street')}}" id="address1" value="{{$details->address1}}">
                                @if ($errors->has('address1'))
                                    <span class="required">
                                        <strong>{{ $errors->first('address1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row  my-2">
                            <div class="col-md-12 col-12 col-sm-12 py-3">
                                <button class="btn btn-primary" type="submit">{{__('messages.save')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    {{--                        <div class="col-md-6">--}}
    {{--                            <div class="form-group">--}}
    {{--                                <label for="projectinput1">--}}
    {{--                                </label>--}}
    {{--                                <input type="text" id="name"--}}
    {{--                                       class="form-control"--}}
    {{--                                       placeholder=" ادخل عنوان الإعلان بالعربية "--}}
    {{--                                       value="{{old('title_ar')}}"--}}
    {{--                                       name="title_ar">--}}
    {{--                                @error("title_ar")--}}
    {{--                                <span class="text-danger">{{$message}}</span>--}}
    {{--                                @enderror--}}
    {{--                            </div>--}}
    {{--                        </div>--}}

@stop
