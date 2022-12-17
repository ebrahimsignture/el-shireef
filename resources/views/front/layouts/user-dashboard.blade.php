@extends('front.layouts.master')



@section('content')
    @yield('top-head-bar')
    <section class="user-dashboard  mb-5" dir="{{General::getDir()}}">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-3 col-sm-12 col-12 ">
                    @include('front.pages.includes.user-side-bar')
                </div>
                <div class="col-md-9 col-sm-12 col-12">
                    @yield('dashboard-content')
                </div>
            </div>
        </div>
    </section>
@stop
