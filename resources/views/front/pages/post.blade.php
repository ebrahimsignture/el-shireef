@extends('front.layouts.master')

@section('content')

    {{--  Start  Done--}}
    @if(isset($post))
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
                                <a href="{{route('site.blog')}}">
                        <span class="bold home_span">
                            {{__('messages.blog')}}
                        </span>
                                </a>
                                 - {{$post->title}}
                            </h5>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <section class="single_service container mb-5">
            @php
                $images =explode(',',$post->image);
                $videos = explode('mostafa',$post->video);
                $media = array_merge($images, $videos);
                //dd($media);
            @endphp
            <div class="row mt-3 mobile_view_single_service">
                <div class="col-md-6 col-12">
                    <img src="{{asset($images[0])}}" alt="{{$post->title}}" style="width: 100%;border-radius: 10px">
                </div>
                <div class="col-md-6 col-12 article_div">
                    <div>
                        {!! $post->article!!}
                    </div>
                </div>
            </div>
            <div class="row mt-5 pc_view_single_service">
                <div class="col-md-6 col-12">
                    <div>
                        {!! $post->article!!}
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <img src="{{asset($images[0])}}" alt="{{$post->title}}" style="width: 100%;border-radius: 10px">
                </div>

            </div>
{{--            <div class="row">--}}
{{--                @foreach($media as $key => $item)--}}
{{--                    @if(str_contains($item, 'uploads') === true)--}}
{{--                        <div class="col-md-4 col-12 mt-3" style="margin: auto">--}}
{{--                            <img src="{{asset($item)}}" alt="" style="width: 100%;border-radius: 10px">--}}
{{--                        </div>--}}
{{--                    @else--}}
{{--                        <div class="col-md-6 col-12 mt-3" style="margin: auto">--}}
{{--                            {!! $item !!}--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            </div>--}}
        </section>
    @endif
    @if(isset($related) && $related->count() > 0)
        <section class="news_letter mt-5 container">
            <div class="headline_div mt-5 mb-5">
                <h3 class="bold ts-0 mt-5">{{__('messages.related-posts')}}</h3>
            </div>

            <div class="news_paper">
                @foreach($related as $key => $item)
                    <div class="card">
                        <a href="{{route('site.post', $item->slug)}}">
                            <div class="card__header">
                                @php
                                    $images =explode(',',$item->image);
                                    //dd($seo_image);
                                        //dd($photo);
                                @endphp
                                <img src="{{asset($images[0])}}" alt="{{$item->title}}" class="card__image"
                                     width="100%">
                            </div>
                            <div class="card__body">
                                <span class="tag tag-blue">{{$item->category->title}}</span>
                                <h4 class="bold">{{$item->title}}</h4>
                                <p>{{$item->summary}}</p>
                            </div>
                            <div class="card__footer" dir="{{General::getDir()}}">
                                <div class="user">
                                    <img src="{{asset('assets/front/images/avatar.png')}}" alt="publisher-image" class="user__image">
                                    <div class="user__info">
                                        <h5 class="bold">{{__('messages.el-shireef')}}</h5>
                                        <small>{{Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    @endif





    {{--  End Done--}}




@endsection




@section('script')

@stop

