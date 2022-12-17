@extends('front.layouts.master')

@section('content')

    {{--  Start  Done--}}
    @if(isset($project))
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
                                <a href="{{route('site.projects')}}">
                        <span class="bold home_span">
                            {{__('messages.projects')}}
                        </span>
                                </a>
                                - {{$project->title}}
                            </h5>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <section class="single_service container">
            <div class="row mt-5 mobile_view_single_service">
                <div class="col-md-12 col-12">
                    <div>
                        {!! $project->description!!}
                    </div>
                </div>
            </div>
            <div class="row mt-5 pc_view_single_service">
                <div class="col-md-12 col-12">
                    <div>
                        {!! $project->description!!}
                    </div>
                </div>
            </div>
        </section>
    @endif
    @if(isset($related) && $related->count() > 0)
        <section class="news_letter mt-5 container projects_container">
            <div class="headline_div mb-5">
                <h1 class="bold ts-0 mt-5">{{__('messages.related-projects')}}</h1>
            </div>

            <div class="row text-center mt-5">
                @foreach($related as $key => $item)
                    <div class="card project_card col-md-3">
                        <div class="face face1">
                            <div class="content">
                                <a href="{{route('site.project', $item->slug)}}" class="project_link">
                                    <span class="stars"></span>
                                    <h2 class="title">{{$item->title}}</h2>
                                    <p class="title">{{$item->summary}}</p>
                                </a>
                            </div>
                        </div>
                        @php
                            $images =explode(',',$item->image);
                            $seo_image =explode('/', $images[0]);
                            //dd($seo_image);
                                //dd($photo);
                        @endphp
                        <div class="face face2"
                             style="background: linear-gradient(0deg, rgba(0,0,0,.3), rgba(0,0,0,.3)), url({{asset($images[0])}});">
                            <h2>{{$item->title}}</h2>
                        </div>
                    </div>
                @endforeach


            </div>
        </section>
    @endif






    {{--  End Done--}}




@endsection




@section('script')

@stop

