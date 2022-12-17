<footer class="mt-5" style="clear: both">
    <section>
        @php
            $settings = \App\Models\Setting::first();
        @endphp
        <div class="row pt-4">
            <div class="col-md-4 col-12 col-sm-12 web_description">
                <div><img src="{{asset($settings->image)}}" width="110" alt="El-shireef"></div>
                <div class="mt-1">
                    <p>
                        {{$settings->short_des}}
                    </p>
                </div>
            </div>
            <div class="col-md-2 col-6 col-sm-6 p-3">
                <div>
                    <h5 class="mb-3">
                        {{__('messages.footer.important')}}
                    </h5>
                </div>
                <div class="line_2">
                </div>
                <div class="mt-2">
                    <ul class="ul-no-pad">
                        <li><a href="{{route('site.home')}}">{{__('messages.home')}}</a></li>
                        <li><a href="{{Route::currentRouteName() === 'site.home' ? '#products_section' : route('site.home').'#products_section'}}">{{__('messages.products')}}</a></li>
                        <li><a href="{{Route::currentRouteName() === 'site.home' ? '#services_section' : route('site.home').'#services_section'}}">{{__('messages.services')}}</a></li>
                        <li><a href="{{route('site.blog')}}">{{__('messages.blog')}}</a></li>
                        <li><a href="{{route('site.projects')}}">{{__('messages.projects')}}</a></li>
                        <li><a href="{{route('site.track')}}">{{__('messages.track')}}</a></li>
                        <li><a href="{{route('site.privacy.policy')}}">{{__('messages.privacy')}}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-6 col-sm-6 p-3">
                <div>
                    <h5 class="mb-3">{{__('messages.footer.touch')}}
                    </h5>
                </div>
                <div class="line_2">
                </div>
                <div class="mt-1 social_footer_menu ">
                    <ul class="ul-no-pad socialist">
                        <li class="mt-3"><a href="{{$settings->facebook}}"><img class="fb_img"
                                                                                src="{{asset('assets/front/images/fb.png')}}"
                                                                                alt=""></a></li>
                        <li class="mt-3"><a href="{{$settings->twitter}}"><img class="twitter_img"
                                                                               src="{{asset('assets/front/images/twitter.png')}}"
                                                                               alt=""></a></li>

                        <li class="mt-3"><a href="{{$settings->linkedin}}"><img class="linkedin_img"
                                                                                src="{{asset('assets/front/images/linkedin.png')}}"
                                                                                alt=""></a></li>
                        <li class="mt-3"><a href="{{$settings->whatsapp}}"><img class="whats_img"
                                                                                src="{{asset('assets/front/images/whatsapp.png')}}"
                                                                                alt=""></a></li>
                        <li class="mt-3"><a href="{{$settings->address}}"><img class="location_img"
                                                                               src="{{asset('assets/front/images/location.png')}}"
                                                                               alt=""></a></li>
                        <li class="mt-3"><a href="{{$settings->behance}}"><img class="behance_img"
                                                                               src="{{asset('assets/front/images/behance.png')}}"
                                                                               alt=""></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-12 col-sm-12 p-3">
                <div>
                    <h5 class="mb-3">
                        {{__('messages.footer.sub')}}
                    </h5>
                </div>
                <div class="line_2">
                </div>
                <div>
                    <form action="{{route('site.subscribe')}}" method="post" class="mt-3">
                        @csrf
                        <input class="form-control" type="email" placeholder="{{__('messages.email')}}"
                               name="subscription_email" required>
                        <button class="btn btn-primary subscribe_btn">{{__('messages.subscribe')}}</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="last_part text-center">
            <p>{{__('messages.rights')}}</p>
        </div>
    </section>
</footer>


{{--<footer class="mt-5 pc_footer"--}}
{{--        style="clear: both; padding: 0!important; background: ">--}}
{{--    <section>--}}
{{--        @php--}}
{{--            $settings = \App\Models\Setting::first();--}}
{{--        @endphp--}}
{{--        <div class="row pt-4">--}}
{{--            <div class="col-md-3 col-12 col-sm-12 web_description p-3 mt-2">--}}
{{--                <div class="top_part mt-5">--}}
{{--                    <div class="col-md-6 d-inline-block" style="border-left: 2px #fff solid;height: 73px;">--}}
{{--                        <h1>Signature</h1>--}}
{{--                        <p>Digital Marketing & Web Solutions</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-4 d-inline-block">--}}
{{--                        <img src="{{asset($settings->image)}}" alt="logo">--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--                <div class="mt-3">--}}
{{--                    <p>--}}
{{--                        {{$settings->short_des}}--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-1"></div>--}}
{{--            <div class="col-md-3 col-6 col-sm-6 p-3 mt-4 services_footer">--}}
{{--                <div>--}}
{{--                    <h1>--}}
{{--                        {{__('messages.footer.important')}}--}}
{{--                    </h1>--}}
{{--                </div>--}}
{{--                <div class="mt-1 services_footer_menu">--}}
{{--                    <ul style="color: #fff">--}}
{{--                        <li>--}}
{{--                            <a class="" href="{{route('site.home')}}">--}}
{{--                                <span> {{__('messages.home')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a class="" href="{{route('site.projects')}}">--}}
{{--                                <span> {{__('messages.projects')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a class="" href="{{route('site.blog')}}">--}}
{{--                                <span> {{__('messages.blog')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <a class="" href="{{route('site.about-us')}}">--}}
{{--                                <span> {{__('messages.about-us')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a class="" href="{{route('site.rights')}}">--}}
{{--                                <span> {{__('messages.privacy')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                        <li>--}}
{{--                            <a class="footer_contact_btn" href="javascript:void(0)">--}}
{{--                                <span> {{__('messages.contact-us')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-3 col-6 col-sm-6 p-3 mt-4 services_footer">--}}
{{--                <div>--}}
{{--                    <h1 class=""> {{__('messages.services')}}--}}
{{--                    </h1>--}}
{{--                </div>--}}
{{--                <div class="mt-1 services_footer_menu services_menu_line">--}}
{{--                    <ul style="color: #fff">--}}
{{--                        @php--}}
{{--                            $services = \App\Models\Service::active()->get();--}}
{{--                        @endphp--}}
{{--                        @foreach($services as $item)--}}
{{--                            <li>--}}
{{--                                <a class="" href="{{route('site.service', $item->slug)}}">--}}
{{--                                    <span> {{$item->title}}</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}


{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-2 col-6 col-sm-6 p-3 mt-4 services_footer">--}}
{{--                <div>--}}
{{--                    <h1 class=""> {{__('messages.footer.touch')}}--}}
{{--                    </h1>--}}
{{--                </div>--}}
{{--                <div class="mt-4 social_footer_menu">--}}
{{--                    <ul>--}}
{{--                        <li class="mt-3"><a href="{{$settings->facebook}}"><img class="fb_img"--}}
{{--                                                                   src="{{asset('assets/front/images/fb.png')}}"--}}
{{--                                                                   alt=""></a></li>--}}
{{--                        <li class="mt-3"><a href="{{$settings->twitter}}"><img class="twitter_img"--}}
{{--                                                                  src="{{asset('assets/front/images/twitter.png')}}"--}}
{{--                                                                  alt=""></a></li>--}}
{{--                        --}}{{--                                    <li><a href="{{route('site.home')}}"><img src="{{asset('assets/front/images/youtube.gif')}}" alt="" style="width: 57px;"></a></li>--}}
{{--                        <li class="mt-3"><a href="{{$settings->linkedin}}"><img class="linkedin_img"--}}
{{--                                                                   src="{{asset('assets/front/images/linkedin.png')}}"--}}
{{--                                                                   alt=""></a></li>--}}
{{--                        <li class="mt-3"><a href="{{$settings->whatsapp}}"><img class="whats_img"--}}
{{--                                                                   src="{{asset('assets/front/images/whatsapp.png')}}"--}}
{{--                                                                   alt=""></a></li>--}}
{{--                        <li class="mt-3"><a href="{{$settings->address}}"><img class="location_img"--}}
{{--                                                                  src="{{asset('assets/front/images/location.png')}}"--}}
{{--                                                                  alt=""></a></li>--}}
{{--                        <li class="mt-3"><a href="{{$settings->behance}}"><img class="behance_img"--}}
{{--                                                                  src="{{asset('assets/front/images/behance.png')}}"--}}
{{--                                                                  alt=""></a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="last_part text-center">--}}
{{--            <p>{{__('messages.rights')}}</p>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--</footer>--}}
{{--<footer class=" mobile_footer mt-5"--}}
{{--        style="clear: both; padding: 0!important; background-image: url('{{asset('assets/front/images/mobile_footer.png')}}')">--}}
{{--    <section>--}}
{{--        @php--}}
{{--            $settings = \App\Models\Setting::first();--}}
{{--        @endphp--}}
{{--        <div class="row pt-4">--}}
{{--            <div class=" col-12 col-sm-12 web_description p-3 mt-2">--}}
{{--                <div class="top_part mt-5">--}}
{{--                    <div class="col-6 d-inline-block" style="border-left: 2px #fff solid;height: 73px;">--}}
{{--                        <h1>Signature</h1>--}}
{{--                        <p>Digital Marketing & Web Solutions</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-4 d-inline-block">--}}
{{--                        <img src="{{asset($settings->image)}}" alt="logo">--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--                <div class="mt-3">--}}
{{--                    <p>--}}
{{--                        {{$settings->short_des}}--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-12 col-sm-12 p-3 mt-4 services_footer">--}}
{{--                <div>--}}
{{--                    <h1 class=""> {{__('messages.services')}}--}}
{{--                    </h1>--}}
{{--                </div>--}}
{{--                <div class="mt-1 services_footer_menu services_menu_line">--}}
{{--                    <ul style="color: #fff">--}}
{{--                        @php--}}
{{--                            $services = \App\Models\Service::active()->get();--}}
{{--                        @endphp--}}
{{--                        @foreach($services as $item)--}}
{{--                            <li>--}}
{{--                                <a class="" href="{{route('site.service', $item->slug)}}">--}}
{{--                                    <span> {{$item->title}}</span>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-6 col-sm-6 p-3  services_footer ">--}}
{{--                <div>--}}
{{--                    <h1 class="quick_h1">--}}
{{--                        {{__('messages.footer.important')}}--}}
{{--                    </h1>--}}
{{--                </div>--}}
{{--                <div class="mt-1 services_footer_menu ">--}}
{{--                    <ul style="color: #fff">--}}
{{--                        <li>--}}
{{--                            <a class="" href="{{route('site.home')}}">--}}
{{--                                <span> {{__('messages.home')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a class="" href="{{route('site.about-us')}}">--}}
{{--                                <span> {{__('messages.about-us')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a class="" href="{{route('site.blog')}}">--}}
{{--                                <span> {{__('messages.blog')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a class="" href="{{route('site.home')}}">--}}
{{--                                <span> {{__('messages.projects')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a class="" href="{{route('site.rights')}}">--}}
{{--                                <span> {{__('messages.privacy')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li>--}}
{{--                            <a class="footer_contact_btn" href="javascript:void(0)">--}}
{{--                                <span> {{__('messages.contact-us')}}</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-2 col-6 col-sm-6 p-3 services_footer">--}}
{{--                <div>--}}
{{--                    <h1 class="quick_h1"> {{__('messages.footer.touch')}}--}}
{{--                    </h1>--}}
{{--                </div>--}}
{{--                <div class="mt-4 social_footer_menu">--}}

{{--                    <ul>--}}
{{--                        <li><a href="{{$settings->facebook}}"><img class="fb_img"--}}
{{--                                                                  src="{{asset('assets/front/images/fb.png')}}"--}}
{{--                                                                  alt=""></a></li>--}}
{{--                        <li><a href="{{$settings->twitter}}"><img class="twitter_img"--}}
{{--                                                                  src="{{asset('assets/front/images/twitter.png')}}"--}}
{{--                                                                  alt=""></a></li>--}}
{{--                        --}}{{--                                    <li><a href="{{route('site.home')}}"><img src="{{asset('assets/front/images/youtube.gif')}}" alt="" style="width: 57px;"></a></li>--}}
{{--                        <li><a href="{{$settings->linkedin}}"><img class="linkedin_img"--}}
{{--                                                                  src="{{asset('assets/front/images/linkedin.png')}}"--}}
{{--                                                                  alt=""></a></li>--}}
{{--                        <li><a href="{{$settings->whatsapp}}"><img class="whats_img"--}}
{{--                                                                  src="{{asset('assets/front/images/whatsapp.png')}}"--}}
{{--                                                                  alt=""></a></li>--}}
{{--                        <li><a href="{{$settings->address}}"><img class="location_img"--}}
{{--                                                                  src="{{asset('assets/front/images/location.png')}}"--}}
{{--                                                                  alt=""></a></li>--}}
{{--                        <li><a href="{{$settings->behance}}"><img class="behance_img"--}}
{{--                                                                  src="{{asset('assets/front/images/behance.png')}}"--}}
{{--                                                                  alt=""></a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="last_part text-center">--}}
{{--            <p>{{__('messages.rights')}}</p>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--</footer>--}}

{{--<footer class="mt-5" style="clear: both">--}}
{{--    <section>--}}
{{--        @php--}}
{{--            $settings = \App\Models\Setting::first();--}}
{{--        @endphp--}}
{{--        <div class="row pt-4">--}}
{{--            <div class="col-md-4 col-12 col-sm-12 web_description p-3" style="text-align: center">--}}
{{--                <div><img src="{{asset($settings->image)}}" width="90" alt=""></div>--}}
{{--                <div class="mt-1">--}}
{{--                    <p>--}}
{{--                        {{$settings->short_des}}--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-4 col-6 col-sm-6 p-3" style="text-align: center">--}}
{{--                <div>--}}
{{--                    <h5>--}}
{{--                        {{__('messages.footer.important')}}--}}
{{--                    </h5>--}}
{{--                </div>--}}
{{--                <div class="line_2" style="margin: auto;">--}}
{{--                </div>--}}
{{--                <div class="mt-2">--}}
{{--                    <ul>--}}
{{--                        <li><a href="{{route('site.home')}}">{{__('messages.home')}}</a></li>--}}
{{--                        --}}{{----}}{{--                        <li><a href="{{route('site.privacy')}}">سياسة الخصوصية</a></li>--}}
{{--                        --}}{{----}}{{--                        <li><a href="{{route('site.evacuation')}}">اخلاء المسئولية</a></li>--}}
{{--                        --}}{{----}}{{--                        <li><a href="{{route('site.about')}}">{{__('messages.about-us')}}</a></li>--}}
{{--                        --}}{{----}}{{--                        <li><a href="{{route('site.contact')}}">{{__('messages.contact-us')}}</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-4 col-6 col-sm-6 p-3" style="text-align: center">--}}
{{--                <div>--}}
{{--                    <h5>{{__('messages.footer.touch')}}--}}
{{--                    </h5>--}}
{{--                </div>--}}
{{--                <div class="line_2" style="margin: auto;">--}}
{{--                </div>--}}
{{--                <div class="mt-2">--}}
{{--                    <ul>--}}

{{--                        <li><a href="{{$settings->facebook}}"><i class="fa-brands fa-facebook"></i><span> {{__('messages.fb')}}</span></a>--}}
{{--                        </li>--}}
{{--                        <li><a href="{{$settings->instagram}}"><i class="fa-brands fa-instagram"></i><span> {{__('messages.insta')}}</span></a>--}}
{{--                        </li>--}}
{{--                        <li><a href="mailto:{{$settings->email}}"><i class="fa-regular fa-envelope"></i><span> {{__('messages.mail')}}</span></a>--}}
{{--                        </li>--}}
{{--                        <li><a href="tel:{{$settings->phone}}"><i class="fa-solid fa-phone"></i><span> {{__('messages.phone')}} {{$settings->phone}}</span></a>--}}
{{--                        </li>--}}

{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-3 col-12 col-sm-12 p-3">--}}


{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="last_part text-center">--}}
{{--            <p>{{__('messages.rights')}}</p>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--</footer>--}}
