<div class="overlay"></div>

<header>
    {{--    <nav class="navbar navbar-expand-lg upper-nav">--}}
    {{--        <div class="container-fluid">--}}
    {{--            <div class="container" style="max-width: 1574px">--}}
    {{--                <div class="row">--}}
    {{--                    <div class="col-md-2 upper-share-items col-12">--}}
    {{--                        <a href="{{route('site.home')}}" target="_blank"><img--}}
    {{--                                src="{{asset('assets/front/images/fb.png')}}" alt="" style="width: 21px;"></a> &nbsp;--}}
    {{--                        <a href="{{route('site.home')}}" target="_blank"><img--}}
    {{--                                src="{{asset('assets/front/images/twitter.png')}}" alt="" style="width: 21px;"></a>&nbsp;--}}
    {{--                        <a href="{{route('site.home')}}" target="_blank"><img--}}
    {{--                                src="{{asset('assets/front/images/instagram.png')}}" alt="" style="width: 23px;"></a>--}}
    {{--                        <a href="{{route('site.home')}}" target="_blank"><img--}}
    {{--                                src="{{asset('assets/front/images/linkedin.png')}}" alt="" style="width: 21px;"></a>--}}
    {{--                        <a href="{{route('site.home')}}" target="_blank"><img--}}
    {{--                                src="{{asset('assets/front/images/whatsapp.png')}}" alt="" style="width: 21px;"></a>--}}
    {{--                        <a class="mobile_share_item d-none" href="mailto:info@signature.com.eg" target="_blank"><img--}}
    {{--                                src="{{asset('assets/front/images/email.png')}}" alt="mail-icon"--}}
    {{--                                style="width: 22px;"></a>--}}
    {{--                        <li class="nav-item main-nav-item dropdown lang-link mobile_share_item d-none">--}}
    {{--                            <a class="nav-link main-nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"--}}
    {{--                               data-bs-toggle="dropdown" aria-expanded="false">--}}
    {{--                                <img src="{{asset('assets/front/images/telephone.png')}}" alt="phone-icon"--}}
    {{--                                     style="width: 22px;">--}}
    {{--                            </a>--}}

    {{--                            <ul class="dropdown-menu " aria-labelledby="navbarDropdown" id="lang_list">--}}

    {{--                                <li>--}}
    {{--                                    <a class="dropdown-item" href="tel:+201123456789">--}}
    {{--                                        <img src="{{asset('assets/front/images/phone.png')}}" alt="phone"--}}
    {{--                                             style="width: 23px;">&nbsp;<span class="phone_toggle">+201123456789</span>--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                                <li>--}}
    {{--                                    <a class="dropdown-item" href="tel:+201123456789">--}}
    {{--                                        <img src="{{asset('assets/front/images/phone.png')}}" alt="phone"--}}
    {{--                                             style="width: 23px;">&nbsp;<span class="phone_toggle">+201123456789</span>--}}
    {{--                                    </a>--}}
    {{--                                </li>--}}
    {{--                            </ul>--}}
    {{--                        </li>--}}

    {{--                    </div>--}}
    {{--                    <div class="col-md-5 ">--}}
    {{--                    </div>--}}
    {{--                    <div class="col-md-5 upper-contact-items">--}}
    {{--                        <div class=" d-inline-block ">--}}
    {{--                            <a href="mailto:info@signature.com.eg">--}}
    {{--                                <span class="c-white">info@el-shireef.com</span>--}}
    {{--                            </a>--}}
    {{--                            &nbsp;--}}
    {{--                            <span> <img src="{{asset('assets/front/images/email.png')}}" alt="mail-icon"--}}
    {{--                                        style="width: 22px;"></span>--}}
    {{--                            &nbsp;&nbsp;--}}
    {{--                            <a href="tel:+201123456789">--}}
    {{--                                <span class="c-white">+201123456789</span>--}}
    {{--                            </a>--}}
    {{--                            &nbsp;&nbsp;--}}
    {{--                            <a href="tel:+201123456789">--}}
    {{--                                <span class="c-white">+201123456789</span>--}}
    {{--                            </a>--}}
    {{--                            &nbsp;&nbsp;--}}
    {{--                            <span> <img src="{{asset('assets/front/images/telephone.png')}}" alt="phone-icon"--}}
    {{--                                        style="width: 22px;"></span>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </nav>--}}
    <nav class="sidebar2 ">
        <div class="side_bar_2_contact_div_dismiss">
            <div class="side_bar_2_contact_cover_btn_dismiss">
                <div class="spans_container_dismiss">
                    <img src="{{asset('assets/front/images/dismiss.png')}}" alt="dismiss" style="width: 25px">
                </div>
            </div>
        </div>

        <div class="logo">

        </div>

        <div class=" side_bar_touch" style="margin: 3rem 13px 3rem 0!important;">
            <ul class="list-unstyled menu-elements side_bar_2_menu" style="text-align: center; width: 100%">
                <li class="{{Route::currentRouteName() == 'site.home' ? 'active' : ''}}">
                    <a class="scroll-link {{Route::currentRouteName() == 'site.home' ? 'active' : ''}}"
                       href="{{route('site.home')}}" style="padding: 10px 30px;">
                        <i class="fas fa-home"></i> &nbsp;&nbsp;{{__('messages.home')}}
                    </a>
                </li>
                <li>
                    <a class="scroll-link products-side-link"
                       href="{{Route::currentRouteName() === 'site.home' ? '#products_section' : route('site.home').'#products_section'}}"
                       style="padding: 10px 30px;">
                        <i class="fa-solid fa-box"></i> &nbsp;&nbsp;{{__('messages.products')}}
                    </a>
                </li>
                <li>
                    <a class="scroll-link services-side-link"
                       href="{{Route::currentRouteName() === 'site.home' ? '#services_section' : route('site.home').'#services_section'}}"
                       style="padding: 10px 30px;">
                        <i class="fa-solid fa-laptop"></i> &nbsp;&nbsp;{{__('messages.services')}}
                    </a>
                </li>

                <li class="{{Route::currentRouteName() == 'site.projects' || Route::currentRouteName() == 'site.project'  ? 'active' : ''}}">
                    <a class="scroll-link {{Route::currentRouteName() == 'site.projects' || Route::currentRouteName() == 'site.project'  ? 'active' : ''}}"
                       href="{{route('site.projects')}}">
                        <i class="fa-solid fa-diagram-project"></i> &nbsp;&nbsp;{{__('messages.projects')}}</a>
                </li>

                <li class="{{Route::currentRouteName() == 'site.blog' || Route::currentRouteName() == 'site.post'  ? 'active' : ''}}">
                    <a class="scroll-link {{Route::currentRouteName() == 'site.blog' || Route::currentRouteName() == 'site.post'  ? 'active' : ''}}"
                       href="{{route('site.blog')}}">
                        <i class="fa-solid fa-blog"></i> &nbsp;&nbsp;{{__('messages.blog')}}</a>
                </li>

                <li class="{{Route::currentRouteName() == 'site.track' ? 'active' : ''}}">
                    <a class="scroll-link {{Route::currentRouteName() == 'site.track' ? 'active' : ''}}"
                       href="{{route('site.track')}}"><i
                            class="fa-solid fa-truck"></i> &nbsp;&nbsp;{{__('messages.track')}}</a>
                </li>

                <li class="{{Route::currentRouteName() == 'site.about-us' ? 'active' : ''}}">
                    <a class="scroll-link {{Route::currentRouteName() == 'site.about-us' ? 'active' : ''}}"
                       href="{{route('site.about-us')}}"><i
                            class="fa-solid fa-magnifying-glass"></i> &nbsp;&nbsp;{{__('messages.about-us')}}</a>
                </li>
                <li class="{{Route::currentRouteName() == 'site.contact-us' ? 'active' : ''}}">
                    <a class="scroll-link {{Route::currentRouteName() == 'site.contact-us' ? 'active' : ''}}"
                       href="{{route('site.contact-us')}}"><i
                            class="fas fa-envelope"></i> &nbsp;&nbsp;{{__('messages.contact-us')}}</a>
                </li>
            </ul>
        </div>
    </nav>

    <nav class="navbar  navbar-expand-lg navbar-light lower-nav" dir="{{General::getDir()}}">
        <div class="container-fluid">
            <div class="container logo_container">
                <div class="row">
                    <div class="col-md-2 col-sm-6">
                        @if(General::getDir() === "ltr")
                            <a class="sidebar1-open-menu-a" href="javascript:void(0);" role="button">
                                <i class="fas fa-align-right sidebar1-open-menu"></i>
                            </a>
                            <a class="navbar-brand " href="{{route('site.home')}}" style="">
                                <img src="{{asset($settings->logo)}}" alt="El-Shireef" style="">
                            </a>
                        @else
                            <a class="navbar-brand " href="{{route('site.home')}}" style="">
                                <img src="{{asset($settings->logo)}}" alt="El-Shireef" style="">
                            </a>
                            <a class="sidebar1-open-menu-a" href="javascript:void(0);" role="button">
                                <i class="fas fa-align-right sidebar1-open-menu"></i>
                            </a>

                        @endif
                    </div>
                    <div class="collapse navbar-collapse col-md-7 nav-bar-style" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav_list">
                            <li class="nav-item main-nav-item home hov-bg-cl hov-cl {{Route::currentRouteName() === 'site.home' ? 'active-nav-list' : ''}}">
                                <a class="nav-link nav-link-mid  {{Route::currentRouteName() === 'site.home' ? 'now bold' : ''}}"
                                   aria-current="page" href="{{route('site.home')}}">
                                    {{__('messages.home')}}
                                </a>
                            </li>
                            <li class="nav-item main-nav-item projects  hov-bg-cl hov-cl">
                                <a class="nav-link nav-link-mid"
                                   href="{{Route::currentRouteName() === 'site.home' ? '#products_section' : route('site.home').'#products_section'}}">
                                    {{__('messages.products')}}
                                </a>
                            </li>
                            <li class="nav-item main-nav-item projects  hov-bg-cl hov-cl">
                                <a class="nav-link nav-link-mid"
                                   href="{{Route::currentRouteName() === 'site.home' ? '#services_section' : route('site.home').'#services_section'}}">
                                    {{__('messages.services')}}
                                </a>
                            </li>
                            <li class="nav-item main-nav-item blog  hov-bg-cl hov-cl {{Route::currentRouteName() === 'site.projects' || Route::currentRouteName() === 'site.project' ? 'active-nav-list' : ''}}">
                                <a class="nav-link nav-link-mid hov-cl {{Route::currentRouteName() === 'site.projects' || Route::currentRouteName() === 'site.project' ? 'now bold' : ''}}"
                                   href="{{route('site.projects')}}">{{__('messages.projects')}}
                                </a>
                            </li>

                            <li class="nav-item main-nav-item blog  hov-bg-cl hov-cl {{Route::currentRouteName() === 'site.blog' || Route::currentRouteName() === 'site.post' ? 'active-nav-list' : ''}}">
                                <a class="nav-link nav-link-mid hov-cl {{Route::currentRouteName() === 'site.blog' || Route::currentRouteName() === 'site.post' ? 'now bold' : ''}}"
                                   href="{{route('site.blog')}}">
                                    {{__('messages.blog')}}
                                </a>
                            </li>
                            <li class="nav-item main-nav-item team  hov-bg-cl hov-cl {{Route::currentRouteName() === 'site.track'  ? 'active-nav-list' : ''}}">
                                <a class="nav-link nav-link-mid hov-cl {{Route::currentRouteName() === 'site.track' ? 'now bold' : ''}}"
                                   href="{{route('site.track')}}">{{__('messages.track')}}
                                </a>
                            </li>
                            <li class="nav-item main-nav-item about   hov-bg-cl hov-cl {{Route::currentRouteName() === 'site.about-us'  ? 'active-nav-list' : ''}}">
                                <a class="nav-link nav-link-mid {{Route::currentRouteName() === 'site.about-us' ? 'now bold' : ''}}"
                                   href="{{route('site.about-us')}}">{{__('messages.about-us')}}
                                </a>
                            </li>
                            <li class="nav-item main-nav-item about   hov-bg-cl hov-cl  {{Route::currentRouteName() === 'site.contact-us'  ? 'active-nav-list' : ''}}">
                                <a class="nav-link nav-link-mid {{Route::currentRouteName() === 'site.contact-us' ? 'now bold' : ''}}"
                                   href="{{route('site.contact-us')}}">{{__('messages.contact-us')}}
                                </a>
                            </li>
                            <li class="nav-item dropdown lang-link languages-list left-side-of-nav">
                                <a class="nav-link main-nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                   role="button"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    <img class="flag"
                                         src="{{asset('assets/front/images/'.LaravelLocalization::getCurrentLocale().'_flag.png')}}"
                                         alt="">
                                </a>

                                <ul class="dropdown-menu " aria-labelledby="navbarDropdown" id="lang_list">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <li>
                                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                                <img class="flag_icon"
                                                     src="{{asset('assets/front/images/'.$localeCode.'_flag.png')}}"
                                                     alt=""> {{ $properties['native'] }}

                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-2 col-sm-6 shopping-tools-div">
                        <div class="shopping-tools">
                            @if(!backpack_auth()->check())

                            <a class=" nav-link-mid single-icon pc_compare"  href="javascript:void(0);"
                               data-bs-toggle="modal" data-bs-target="#sign">
                                <img src="{{asset('assets/front/images/cart.png')}}" alt="cart-icon"
                                     style="width: 37px">
                                <span class="total-count" id="cart_count">0</span>
                            </a>
                            <a class=" nav-link-mid single-icon pc_compare"  href="javascript:void(0);"
                               data-bs-toggle="modal" data-bs-target="#sign">
                                <img src="{{asset('assets/front/images/heart.png')}}" alt="wish-list-icon"
                                     style="width: 36px">
                                <span class="total-count" id="wishes_count">0</span>
                            </a>
                            <a class=" nav-link-mid single-icon pc_compare" href="javascript:void(0);"
                               data-bs-toggle="modal" data-bs-target="#sign">
                                <img src="{{asset('assets/front/images/user.png')}}" alt="sign-icon"
                                     style="width: 34px">
                            </a>
                            @else

                                <a class=" nav-link-mid single-icon pc_compare" href="{{route('site.cart')}}">
                                    <img src="{{asset('assets/front/images/cart.png')}}" alt="cart-icon"
                                         style="width: 37px">
                                    <span class="total-count" id="cart_count">{{General::cartCount()}}</span>
                                </a>
                                <a class=" nav-link-mid single-icon pc_compare" href="{{route('site.wish')}}">
                                    <img src="{{asset('assets/front/images/heart.png')}}" alt="wish-list-icon"
                                         style="width: 36px">
                                    <span class="total-count" id="wishes_count">{{\App\Models\Wishlist::wishCount()}}</span>
                                </a>
                                @if(backpack_auth()->user()->role === 'admin' || backpack_auth()->user()->role === 'super_admin' )
                                    <a class=" nav-link-mid single-icon pc_compare" href="{{route('backpack.dashboard')}}">
                                        <img src="{{asset('assets/front/images/user.png')}}" alt="sign-icon"
                                             style="width: 34px">
                                    </a>
                                    @else
                                    <a class=" nav-link-mid single-icon pc_compare" href="{{route('site.user.dashboard')}}">
                                        <img src="{{asset('assets/front/images/user.png')}}" alt="sign-icon"
                                             style="width: 34px">
                                    </a>
                                    @endif

                            @endif
                            <a class="nav-link-mid single-icon dropdown-toggle" href="#" id="navbarDropdown"
                               role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="flag"
                                     src="{{asset('assets/front/images/'.LaravelLocalization::getCurrentLocale().'_flag.png')}}"
                                     alt="">
                            </a>

                            <ul class="dropdown-menu " aria-labelledby="navbarDropdown" id="lang_list">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <li>
                                        <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            <img class="flag_icon"
                                                 src="{{asset('assets/front/images/'.$localeCode.'_flag.png')}}"
                                                 alt=""> {{ $properties['native'] }}

                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </nav>

</header>

{{--<!-- Search Modal -->--}}
{{--<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"--}}
{{--     dir="ltr">--}}
{{--    <div class="modal-dialog modal-dialog-centered search-modal" style="max-width: 1000px!important;">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header" style="padding: 10px 1rem;border: none">--}}
{{--                <h5 class="modal-title" id="exampleModalLabel"></h5>--}}
{{--                <a href="javascript:void(0);" data-bs-dismiss="modal" aria-label="Close">--}}
{{--                    <img src="{{asset('assets/front/images/cross.png')}}" alt="close" style="width: 37px"></a>--}}
{{--            </div>--}}
{{--            <div class="modal-body" style="padding: 4px 1rem;">--}}
{{--                <div class="input-group mb-3">--}}
{{--                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#exampleModal"--}}
{{--                       class="search-btn">--}}
{{--                        <img src="{{asset('assets/front/images/search.png')}}" alt="search-icon" style="width: 45px">--}}
{{--                    </a>--}}
{{--                    <input type="text" name="search_keyword" class="form-control search-inp"--}}
{{--                           placeholder="{{__('messages.search_holder')}}" aria-label="Example text with button addon"--}}
{{--                           aria-describedby="button-addon1" style="direction: {{General::getDir()}}">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


