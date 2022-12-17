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
                            - {{__('messages.reset')}}
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
                        <li class="nav-item active"><a class="nav-link active" href="javascript:void(0)" data-toggle="tab"><strong>{{ trans('backpack::base.step') }} 1.</strong> {{ trans('backpack::base.confirm_email') }}</a></li>
                        <li class="nav-item"><a class="nav-link disabled text-muted"><strong>{{ trans('backpack::base.step') }} 2.</strong> {{ trans('backpack::base.choose_new_password') }}</a></li>
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
                                <form class="col-md-12 p-t-10" role="form" method="POST" action="{{ route('backpack.auth.password.email') }}">
                                    {!! csrf_field() !!}

                                    <div class="form-group">
                                        <label class="control-label" for="email">{{ trans('backpack::base.email_address') }}</label>

                                        <div>
                                            <input style="padding: 0.5rem 0.75rem;" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ old('email') }}">

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group mt-3 mb-3">
                                        <div>
                                            <button type="submit" class="btn btn-primary send-link">
                                                {{ trans('backpack::base.send_reset_link') }}
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
