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
                            - {{__('messages.blog')}}
                        </h5>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @if(isset($posts) && $posts->count() > 0)
        <section class="news_letter mt-5 container">
            <div class="news_paper">
                @foreach($posts as $key => $item)
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
                                        <h5>{{__('messages.el-shireef')}}</h5>
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


































{{--<section class="service lazy-bg-loaded">--}}
{{--    <div class="container-fluid">--}}
{{--        <div class="title">--}}
{{--            <h1>خدمات تقنية</h1>--}}
{{--            <p>تسعى تقنية دائماً لتوفير الخدمات المميزة والباقات المرنة لتلائم أغلب الخدمات المستخدمة لتقنية المعلومات وبأسعار تنافسية للغاية ، من مواقع أو متاجر أو تطبيقات أو أنظمة برمجية , الآن ابدأ بتنمية أعمالك وانطلق بتواجدك الحقيقي والفعال عبر الانترنت</p>--}}
{{--        </div>--}}
{{--        <ul class="nav nav-tabs">--}}
{{--            <li class=""><a data-toggle="tab" href="#tab6" aria-expanded="false">استضافة المواقع</a>--}}
{{--            </li>--}}
{{--            <li class=""><a data-toggle="tab" href="#tab5" aria-expanded="false">السيرفرات الخاصة</a>--}}
{{--            </li>--}}
{{--            <li class=""><a data-toggle="tab" href="#tab7" aria-expanded="false">سيرفرات VPS</a>--}}
{{--            </li>--}}
{{--            <li class="active"><a data-toggle="tab" href="#tab1" aria-expanded="true">تصميم المواقع</a>--}}
{{--            </li>--}}
{{--            <li><a data-toggle="tab" href="#tab8">التجارة الالكترونية</a>--}}
{{--            </li>--}}
{{--            <li><a data-toggle="tab" href="#tab2">تطبيقات الجوال</a>--}}
{{--            </li>--}}
{{--            <li><a data-toggle="tab" href="#tab3">التسويق الالكترونى</a>--}}
{{--            </li>--}}
{{--            <li><a data-toggle="tab" href="#tab4">الهوية البصرية</a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--        <div class="tab-content">--}}
{{--            <div class="tab-pane fade active in" id="tab1" style="transition: opacity .7s ease-in-out;">--}}
{{--                <div class="service_content">--}}
{{--                    <img class="main_img" src="{{asset('assets/front/images/img1.jpg')}}">--}}
{{--                    <div class="service_text">--}}
{{--                        <img class="service_icon" data-src="{{asset('assets/front/images/icon1.png')}}" src="{{asset('assets/front/images/icon1.png')}}" alt="">--}}
{{--                        <h1>خدمات تصميم مواقع احترافية</h1>--}}
{{--                        <p>فن الإتصالات البصرية هو المعنى الحقيقي لتحقيق أفكارك وبلورتها إلى حقيقة رائعة وهو مايقوم به مصممينا في تقنية بناء على طلب العميل ويتعاونون على تنفيذ معطياته بمنتهى الدقة من أجل رسم أفكاركم في صورة موقع يتميز بالروعة والجمال</p> <a class="btn" href="web-design/index.html">المزيد</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="tab8" style="transition: opacity .7s ease-in-out;">--}}
{{--                <div class="service_content">--}}
{{--                    <img class="main_img" src="{{asset('assets/front/images/img1.jpg')}}">--}}
{{--                    <div class="service_text">--}}
{{--                        <img class="lazy service_icon" data-src="{{asset('assets/front/images/icon1.png')}}">--}}
{{--                        <h1>خدمات المتاجر والتجارة الالكترونية</h1>--}}
{{--                        <p>هي الثورة الإقتصادية في الألفية الجديدة والتي تضمن الوصول لأكبر شريحة من المستهدفين لمنتجاتك في مدن ومناطق مختلفة قد تصل إلى أنحاء العالم , والتي تستطيع من خلالها تحقيق الأرباح الكبيرة من خلال مبيعات الإنترنت والتي أصبحت أكبر سوق للأرباح العالمية</p> <a class="btn" href="e-commerce-eg/index.html">المزيد</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="tab2" style="transition: opacity .7s ease-in-out;">--}}
{{--                <div class="service_content">--}}
{{--                    <img class="main_img" src="{{asset('assets/front/images/img1.jpg')}}">--}}
{{--                    <div class="service_text">--}}
{{--                        <img class="lazy service_icon" data-src="{{asset('assets/front/images/icon1.png')}}">--}}
{{--                        <h1>خدمات تصميم وبرمجة تطبيقات الجوال</h1>--}}
{{--                        <p>طبقا للأحصائية الأخيرة لعدد مستخدمي الانترنت عن طريق الهواتف الذكية والتي وصلت لأكثر من 4 مليار شخص حول العالم , فان هذا الرقم يؤكد على الأهمية الكبيرة لوجود تطبيق مخصص للجوال لموقعك أو شركتك أو متجرك أو مشروعك الإلكتروني من خلال منصتي ( الاندرويد و ابل ios )</p> <a class="btn" href="apps/index.html">المزيد</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="tab3" style="transition: opacity .7s ease-in-out;">--}}
{{--                <div class="service_content">--}}
{{--                    <img class="main_img" src="{{asset('assets/front/images/img1.jpg')}}">--}}
{{--                    <div class="service_text">--}}
{{--                        <img class="lazy service_icon" data-src="{{asset('assets/front/images/icon1.png')}}">--}}
{{--                        <h1>خدمات الاعلانات والتسويق الالكتروني</h1>--}}
{{--                        <p>في ظل التطور التكنولوجي الرهيب أصبح من السهل زيادة الدخل والأرباح وفتح أسواق عمل جديدة وتسويق المشاريع والخدمات والمنتجات بأقل التكاليف وذلك من خلال الدعاية و التسويق الالكتروني تقدم تقنية هذه العملية باحترافية عالية لنضمن لك النتائج المفيدة بإذن الله</p> <a class="btn" href="digital-marketing/index.html">المزيد</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="tab4" style="transition: opacity .7s ease-in-out;">--}}
{{--                <div class="service_content">--}}
{{--                    <img class="main_img" src="{{asset('assets/front/images/img1.jpg')}}">--}}
{{--                    <div class="service_text">--}}
{{--                        <img class="lazy service_icon" data-src="{{asset('assets/front/images/icon1.png')}}">--}}
{{--                        <h1>خدمة تصميم الهوية البصرية الإحترافية</h1>--}}
{{--                        <p>يعد تصميم الهوية البصرية من أهم العناصر التي تعكس رؤية المؤسسات والشركات وسبب رئيسي في شق طريقها في سوق العمل بالشكل الإحترافي , فالهوية البصرية المميزة من أهم عوامل نجاح ترويج الشركات أو المؤسسات ومنتجاتها وخدماتها وتلعب الهوية البصرية دوراً هاماً جداً في التسويق للمنشأة وإظهارها بالشكل الأمثل الذي يعود عليها بالنتائج الإيجابية</p> <a class="btn" href="web-design/index.html">المزيد</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="tab5" style="transition: opacity .7s ease-in-out;">--}}
{{--                <div class="service_content">--}}
{{--                    <img class="main_img" src="{{asset('assets/front/images/img1.jpg')}}">--}}
{{--                    <div class="service_text">--}}
{{--                        <img class="service_icon" data-src="{{asset('assets/front/images/icon1.png')}}" src="{{asset('assets/front/images/icon1.png')}}">--}}
{{--                        <h1>خدمات السيرفرات الخاصة المدارة</h1>--}}
{{--                        <p>عندما يكون هدفك الأول هو الإرتقاء بموقعك وجعله ضمن مصاف المواقع الكبرى إقليمياً وعالمياً فإن البحث عن سيرفر بمواصفات جيدة هي مهمة أساسية , وفي تقنية نوفر لك الخدمة الأفضل والقيمة المميزة والإدارة المتكاملة على مدار الساعة .</p> <a class="btn" href="servers-managed/index.html">المزيد</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="tab6" style="transition: opacity .7s ease-in-out;">--}}
{{--                <div class="service_content">--}}
{{--                    <img class="main_img" src="{{asset('assets/front/images/img1.jpg')}}">--}}
{{--                    <div class="service_text">--}}
{{--                        <img class="service_icon" data-src="{{asset('assets/front/images/icon1.png')}}" src="{{asset('assets/front/images/icon1.png')}}">--}}
{{--                        <h1>خدمات استضافة المواقع المميزة</h1>--}}
{{--                        <p>أولى سطور قصص النجاح الالكتروني وخطوتك الأولى لبدأ مشروعك الخاص و التسويق له الكترونيا بأقل تكلفة وبدون أي خبرة سابقة ولا معرفة بمراقبة وإدارة الخوادم , ونحن في تقنية نوفر عدة خطط تتناسب مع جميع فئات المواقع الصغيرة والمبتدأه</p> <a class="btn" href="sharedhosting/index.html">المزيد</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="tab7" style="transition: opacity .7s ease-in-out;">--}}
{{--                <div class="service_content">--}}
{{--                    <img class="main_img" src="{{asset('assets/front/images/img1.jpg')}}">--}}
{{--                    <div class="service_text">--}}
{{--                        <img class="service_icon" data-src="{{asset('assets/front/images/icon1.png')}}" src="{{asset('assets/front/images/icon1.png')}}">--}}
{{--                        <h1>خدمات سيرفرات VPS المدارة</h1>--}}
{{--                        <p>اذا كنت تبحث عن الاستقلالية لموقعك وسرعة الإرتقاء بخدماته وضمان أفضل سرعة للتصفح وللارشفة وبأفضل سعر , فان اختيارك لسيرفرات VPS من تقنية هو الحل الأمثل مع خدمات الإعداد والإدارة المتكاملة على مدار الساعة</p> <a class="btn" href="vps-managed/index.html">المزيد</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</section>--}}
