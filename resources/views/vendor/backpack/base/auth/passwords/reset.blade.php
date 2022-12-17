@extends('front.layouts.master')
@section('title')
    {{ trans('backpack::base.reset_password') }}
@stop

@section('styles')
    <style>
        body {background-color: #f1f4f8;}
        .email-confirm .tab-content {
            background-clip: border-box;
            background-color: #fff;
            border: 1px solid #5f6367 !important;
            border-radius: 3px;
            box-shadow: 0 1px 2px 0 rgb(0 0 0 / 5%);
        }
        .email-confirm .tab-pane {
            padding: 1rem;
        }
        .nav-tabs {
            border-bottom: none;
        }
        .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {

            border-top: 1px solid #5f6367 !important;
            border-right: 1px solid #5f6367 !important;
            border-left: 1px solid #5f6367 !important;
        }
        .send-link {width: 100%;padding: 10px 0; background: #569b9e;border: none; }
        .send-link:hover { background: #569b9e;border: none; }
        @if(LaravelLocalization::getCurrentLocale() == 'en')
        .email-confirm .form-group {color: #1b2a4e; text-align: left}
        @else
        .email-confirm .form-group {color: #1b2a4e; text-align: right}
        @endif

    </style>
@stop

<!-- Main Content -->
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
                            - {{__('messages.confirm')}}
                        </h5>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section class="email-confirm mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-9 col-lg-6">
                    <h1 class="text-center mb-5">{{ trans('backpack::base.reset_password') }}</h1>
                    <div class="nav-steps-wrapper">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link disabled text-muted"><strong>{{ trans('backpack::base.step') }} 1.</strong> {{ trans('backpack::base.confirm_email') }}</a></li>
                            <li class="nav-item active"><a class="nav-link active"><strong>{{ trans('backpack::base.step') }} 2.</strong> {{ trans('backpack::base.choose_new_password') }}</a></li>
                        </ul>
                    </div>
                    <div class="nav-tabs-custom">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                @if (session('status'))
                                    <div class="alert alert-success mt-3">
                                        {{ session('status') }}
                                    </div>
                                @else
                                    <form class="col-md-12 p-t-10" role="form" method="POST" action="{{ route('backpack.auth.password.reset') }}">
                                        {!! csrf_field() !!}

                                        <input type="hidden" name="token" value="{{ $token }}">

                                        <div class="form-group mb-3">
                                            <label class="control-label mb-2" for="email">{{ trans('backpack::base.email_address') }}</label>

                                            <div>
                                                <input type="email" placeholder="{{__('messages.email')}}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ $email ?? old('email') }}">

                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="control-label mb-2" for="password">{{ trans('backpack::base.new_password') }}</label>

                                            <div>
                                                <input type="password" placeholder="{{__('messages.new.password')}}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password">

                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="control-label mb-2" for="password_confirmation">{{ trans('backpack::base.confirm_new_password') }}</label>
                                            <div>
                                                <input type="password" placeholder="{{__('messages.confirm.new.password')}}"  class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" id="password_confirmation">

                                                @if ($errors->has('password_confirmation'))
                                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <div>
                                                <button type="submit" class="btn btn-primary send-link">
                                                    {{ trans('backpack::base.change_password') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                                <div class="clearfix"></div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </div>
            </div>
        </div>
    </section>







@endsection
