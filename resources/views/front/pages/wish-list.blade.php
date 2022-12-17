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
                            - {{__('messages.wish')}}
                        </h5>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <section class="wish-list mt-4 container">

        <div class="wish-list-items">
            @if(isset($wishes) && $wishes->count() > 0)

                @foreach($wishes as $item)
                    <div class="card card_1 col-md-3  d-inline-block mb-3 wish-card" id="div_{{$item->id}}">
                        @if($item->product->discount > 0)

                            <div class="discount-patch"><span>-{{$item->product->discount}}%</span></div>
                        @endif
                        <a href="{{route('site.product.details', $item->product->slug)}}">

                            <img
                                src="{{asset($item->product->cover)}}"
                                class="card-img-top" alt="product_image">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><a
                                    href="{{route('site.product.details', $item->product->slug)}}">{{$item->product->title}}</a>
                            </h5>
                            @php
                                $after_discount=($item->product->price-(($item->product->price*$item->product->discount)/100));

                            @endphp
                            @if($item->product->discount > 0)
                                <p class="card-text product_price" dir="ltr">
                                    <span class="block1-content-more txt-m-104 cl9 p-t-21 trans-04"
                                          style="text-decoration: line-through">{{number_format($item->product->price,1)}} EGP</span>
                                    <span class="after-discount">{{number_format($after_discount,1)}} EGP</span>

                                </p>
                            @else
                                <p class="card-text" dir="ltr">
                                    <span class="after-discount">{{number_format($item->product->price,1)}} </span>
                                </p>
                            @endif
                            <button class="btn btn-danger delete-btn wish_delete_btn mt-3"
                                    data-container="div_{{$item->id}}" data-bs-target="{{$item->id}}"><i
                                    class="fa-solid fa-trash-can"></i> &nbsp;&nbsp;&nbsp;{{__('messages.delete')}}
                            </button>
                        </div>
                    </div>

                @endforeach
            @else
                <div class="empty-list ">
                    <h2>
                        {{__('messages.empty.wishlist')}}
                    </h2>
                </div>
            @endif
        </div>
    </section>
@stop

@section('script')
    <script>
        $(document).ready(function () {
            $('.wish_delete_btn').on('click', function () {
                let id = $(this).data('bs-target');
                let cardDiv = $(this).data('container');
                $.ajax({
                    url: "/{{LaravelLocalization::getCurrentLocale()}}" + "/delete-wish/" + id,
                    // url: "/delete-wish/" + id,
                    data: {
                        _token: "{{csrf_token()}}",
                        id: id,
                        @if(backpack_auth()->check())
                        user_id: "{{backpack_auth()->user()->id}}"
                        @endif
                    },
                    type: "POST",
                    success: function (response) {
                        if (typeof (response) != 'object') {
                            response = $.parseJSON(response)
                        }
                        console.log(response);
                        let notify_msg = $('#notify_msg');
                        let wishes_count = parseInt($('#wishes_count').text());
                        if (response.status) {
                            let msg = response.msg;
                            if (response.msg) {
                                // alert('test');
                                notify_msg.text(msg);
                                notify_msg.removeClass('alert-danger');
                                notify_msg.addClass('alert-success');
                                let newCount = wishes_count - 1;
                                $('#wishes_count').text(newCount);
                                $('#' + cardDiv).remove();
                                Toasty();
                            }
                        } else {
                            let msg = response.msg;
                            if (response.msg) {
                                notify_msg.text(msg);
                                notify_msg.removeClass('alert-success');
                                notify_msg.addClass('alert-danger');
                                Toasty();
                            }
                        }
                    }
                });
            });
        });


    </script>

@stop
