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
                            - {{__('messages.personal')}}
                        </h5>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('dashboard-content')
    <div class="personal-info ">

        <div class="pill-form bg-light col-md-12 col-12 col-sm-12 ">
            <h5 class="card-header mb-3 p-3" style="background: rgba(0,0,0,0.15)">{{__('messages.personal')}}</h5>
            <div class="pill-form-inputs px-3">
                <form method="post" action="{{route('personalInfoNameUpdate')}}">
                    @csrf
                    <div class="row my-2">
                        <div class="col-md-12 col-12 col-sm-12">
                            <label for="first_name">{{__('messages.first_name')}} <span class="required">*</span></label>
                            <input type="text" name="first_name" class="form-control py-2"
                                   placeholder="{{__('messages.first_name')}}" id="name" value="{{$user->first_name}}">
                            @if ($errors->has('first_name'))
                                <span class="required">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-12 col-12 col-sm-12">
                            <label for="last_name">{{__('messages.last_name')}} <span class="required">*</span></label>
                            <input type="text" name="last_name" class="form-control py-2"
                                   placeholder="{{__('messages.last_name')}}" id="name" value="{{$user->last_name}}">
                            <span class="tip">{{__('messages.tip')}}</span>
                            <br>
                            @if ($errors->has('last_name'))
                                <span class="required">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-md-12 col-12 col-sm-12">
                            <label for="email">{{__('messages.form.email')}} <span class="required">*</span></label>
                            <input type="email" name="email" class="form-control py-2"
                                   placeholder="{{__('messages.form.email')}}" id="email" aria-describedby="emailHelp"
                                   value="{{$user->email}}">
                            @if ($errors->has('email'))
                                <span class="required">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="row  my-2">
                        <div class="col-md-12 col-12 col-sm-12 py-3">
                            <button class="btn btn-primary" type="submit">{{__('messages.save')}}</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
        <div class="pill-form bg-light col-md-12 col-12 col-sm-12 mt-4">
            <h5 class="card-header mb-3 p-3" style="background: rgba(0,0,0,0.15)">{{__('messages.change-password')}}</h5>
            <div class="pill-form-inputs px-3">
                <form method="post" action="{{route('personalInfoPassUpdate')}}">
                    @csrf
                    <div class="change-password ">
                        <div class="row  my-2">
                            <div class="col-md-4 col-12 col-sm-12 my-1">
                                <label for="old_password">{{__('messages.old-pass')}} <span class="required">*</span></label>
                                <input type="password" name="old_password" class="form-control"
                                       placeholder="{{__('messages.old-pass')}}" id="old_password">
                                @if ($errors->has('old_password'))
                                    <span class="required">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif
                                {{--                                <span class="tip">{{__('messages.password-tip')}}</span>--}}
                            </div>
                            <div class="col-md-4 col-12 col-sm-12 my-1">
                                <label for="new_password">{{__('messages.new-pass')}} <span class="required">*</span></label>
                                <input type="password" name="new_password" class="form-control"
                                       placeholder="{{__('messages.new-pass')}}" id="new_password">
                                @if ($errors->has('new_password'))
                                    <span class="required">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                                {{--                                <span class="tip">{{__('messages.password-tip')}}</span>--}}

                            </div>
                            <div class="col-md-4 col-12 col-sm-12 my-1">
                                <label for="confirm_pass">{{__('messages.confirm-pass')}} <span class="required">*</span></label>
                                <input type="password" name="confirm_password" class="form-control"
                                       placeholder="{{__('messages.confirm-pass')}}" id="confirm_password">
                                @if ($errors->has('confirm_password'))
                                    <span class="required">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row  my-2">
                        <div class="col-md-12 col-12 col-sm-12 py-3">
                            <button class="btn btn-primary" type="submit">{{__('messages.save')}}</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
@stop
