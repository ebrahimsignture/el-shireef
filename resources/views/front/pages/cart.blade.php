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
                            - {{__('messages.cart')}}
                        </h5>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section class="cart-page mt-4">
        <div class="cart-items">
            <table class="table cart-table table-hover">
                <thead class="table-light">
                <tr>
                    <th scope="col">{{__('messages.product')}}</th>
                    <th scope="col">{{__('messages.price')}}</th>
                    <th scope="col">{{__('messages.quantity')}}</th>
                    <th scope="col">{{__('messages.total')}}</th>
                </tr>
                </thead>
                <tbody>

                @if(isset($cart_items) && $cart_items->count() > 0)
                    <form action="{{route('cart.update.items')}}" method="post">
                        @csrf
                    @foreach($cart_items as $k => $item)
                        <tr class="tr_{{$item->id}}">
                            <td class="info-td">
                                <div class="d-inline-block cart-item-info">
                                    <a href="javascript:void(0);" class="delete_cart_item" data-bs-item="{{$item->id}}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>

                                    @php
                                        $photo=explode(',',$item->product->image);
                                        //dd($photo);
                                    @endphp
                                    <img src="{{asset($photo[0])}}" alt="added_product" width="85"
                                         height="85">
                                    <a href="{{route('site.product.details', $item->product->slug)}}"><span>{{$item->product->title}}</span></a>
                                </div>
                            </td>

                            @php
                                $after_discount=($item->product->price-(($item->product->price*$item->product->discount)/100));
                            @endphp

                            <td class="money"><div class="money_amount"><span>{{number_format($after_discount,2)}} EGP </span></div></td>
                            <td>
                                <div class="row product-details-quantity main_page_quantity">
                                    <input type="hidden" name="cart_ids[]" value="{{$item->id}}">
                                    <div class="input-group mt-4">
                                        <button class="btn btn-outline-secondary new-plus"
                                                data-field="{{$item->id}}"
                                                type="button" id="button-new-plus">+
                                        </button>

                                        {{--                            max value = size stock quantity--}}
                                        <input type="number" min="1" max="{{General::getQuantity($item->product->id)}}"
                                               class="form-control quantity_product_details"
                                               name="quantity[]" id="{{$item->id}}" value="{{$item->quantity}}" readonly>
                                        {{--                            if quantity = 1 disable minus--}}
                                        <button class="btn btn-outline-secondary new-minus new_minus_{{$item->id}}"
                                                data-field="{{$item->id}}"
                                                type="button" id="button-new-minus" {{$item->quantity > 1 ? '' : 'disabled'}}>-
                                        </button>
                                    </div>
                                </div>

                            </td>
                            <td class="money"><div class="main_page_subtotal "><span class="updated_sub_{{$item->id}}">{{number_format($item->amount, 2)}} EGP </span></div></td>
                        </tr>
                    @endforeach

                @else
                    <tr>
                        <td colspan="6">
                            <p class="bold" style="font-size: 22px">{{__('messages.empty.cart')}}</p>
                        </td>
                    </tr>
                @endif

                </tbody>
            </table>

        </div>
        <div class="update-div">
            <div class="update col-md-5 col-sm-12 col-12 d-inline-block">
                <button class="btn-update" type="submit" disabled>{{__('messages.cart.update')}}</button>
            </div>
            </form>
            <div class="coupon col-md-5 col-sm-12 col-12 ">

            </div>


        </div>
        <div style="clear: both"></div>
        <div class="total-info">
            <div class="card col-md-5 col-sm-12 col-12">
                <h5 class="card-header">{{__('messages.cart.total')}}</h5>
                <div class="card-body">
                    <table class="total-info-body">
                        <tbody>
                        <tr class="cart-subtotal">
                            <th>
                                <span style="padding-left: 20px">{{__('messages.total')}}</span>
                            </th>
                            <td data-title="{{__('messages.total')}}" class="bold">
                                <span id="main_cart_sub">  {{number_format(General::totalCartPrice(), 2)}} EGP </span>
                            </td>

                        </tr>

                        <tr>
                            <th colspan="3">
                                <a class="btn-complete-order"
                                   type="button" href="{{route('site.checkout')}}">{{__('messages.complete.order')}}</a>
                            </th>
                        </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <div style="clear: both"></div>
@stop
@section('script')
    <script>
        $(document).ready(function () {
            $(".new-plus").on('click', function () {
                $('.btn-update').attr("disabled", false);
            });


            $(".new-minus").on('click', function () {
                $('.btn-update').attr("disabled", false);

            });

            $('.btn-update').on('click', function (e) {
                e.preventDefault();
                let cart_ids = $('input[name="cart_ids[]"]').map(function(){
                    return this.value;
                }).get();

                let quantity = $('input[name="quantity[]"]').map(function(){
                    return this.value;
                }).get();
                // console.log(quantity);

                $.ajax({
                    url: "/{{LaravelLocalization::getCurrentLocale()}}/cart-update",
                    // url: "/cart-update",
                    data: {
                        _token: "{{csrf_token()}}",
                        cart_ids : cart_ids,
                        quantity : quantity,
                        @if(backpack_auth()->check())
                        user_id: "{{backpack_auth()->user()->id}}"
                        @endif
                    },
                    type: "post",
                    success: function(response) {
                        if (typeof (response) != 'object') {
                            response = $.parseJSON(response)
                        }
                        console.log(response);
                        let notify_msg = $('#notify_msg');
                        let cart_count = $('#cart_count');
                        let main_cart_sub = $('#main_cart_sub');
                        let short_cart_sub = $('#sub_tot');

                        if (response.status === 2) {
                            let msg = response.msg;
                            if (response.msg) {
                                notify_msg.text(msg);
                                notify_msg.removeClass('alert-danger');
                                notify_msg.addClass('alert-success');
                                Toasty();
                            }
                            if(response.data) {
                                let newCount = response.data['newCount'];
                                let newSubtotal = response.data['newSubtotal'];
                                let news = response.data['news'];

                                cart_count.text(newCount);
                                main_cart_sub.text(newSubtotal + ".00 EGP");

                                $.each(news,function (key, value) {
                                    let updated_sub = $('.updated_sub_'+value.id);
                                    let cart_price = $('.cart_price_'+value.id);
                                    updated_sub.text(value.amount+ ".00 EGP");
                                    cart_price.text(value.amount+ ".00 EGP");
                                });

                            }
                        } else if (response.status === 0) {
                            let msg = response.msg;
                            if (response.msg) {
                                notify_msg.text(msg);
                                notify_msg.removeClass('alert-success');
                                notify_msg.addClass('alert-danger');
                                $('#sign').modal('show');
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

            $('.delete_cart_item').on('click', function (e) {
                let target = $(this).data('bs-item');
                let url = "/{{LaravelLocalization::getCurrentLocale()}}/cart-delete/" + target;
                // let url = "/cart-delete/" + target;

                e.preventDefault();
                $.ajax({
                    url: url,
                    data: {
                        id: target
                    },
                    // cache: false,
                    type: "get",
                    success: function (response) {
                        if (typeof (response) != 'object') {
                            response = $.parseJSON(response)
                        }
                        console.log(response);
                        let notify_msg = $('#notify_msg');
                        let cart_count = parseInt($('#cart_count').text());
                        let added_products = $('.added_products');

                        if (response.status === 0) {
                            let msg = response.msg;
                            if (response.msg) {
                                notify_msg.text(msg);
                                notify_msg.removeClass('alert-success');
                                notify_msg.addClass('alert-danger');
                                $('#sign').modal('show');
                                // Toasty();
                            }
                        } else if (response.status === 1) {
                            let msg = response.msg;
                            let cartCount = $('#cart_count');
                            let newCount = response.data['count'];
                            let id = response.data['id'];
                            let itemDiv = $('#cart_' + id);
                            let mainPageCart = $('.tr_' + id);
                            let subtotal = $('#sub_tot');
                            let newSub = response.data['subtotal'];
                            let main_cart_sub = $('#main_cart_sub');
                            let pill_order_item = $('tr#pill_order_' + id);
                            let pill_order_subtot = $('#pill_order_subtot');

                            if (response.msg) {
                                notify_msg.text(msg);
                                notify_msg.removeClass('alert-danger');
                                notify_msg.addClass('alert-success');
                                Toasty();

                                cartCount.text(newCount);
                                subtotal.text(newSub + ".00 EGP");
                                main_cart_sub.text(newSub + ".00 EGP");
                                pill_order_subtot.text(newSub + ".00 EGP");

                                itemDiv.remove();
                                mainPageCart.remove();
                                pill_order_item.remove();

                                if (parseInt(newCount) < 1) {
                                    $('.cart-table tbody').append(
                                        "<tr>" +
                                        "<td colspan='6'>" +
                                        "<p class='bold' style='font-size: 22px'>{{__('messages.empty.cart')}}</p>" +
                                        "</td>" +
                                        "</tr>"
                                    );
                                }

                                // $('#delete_confirm').modal('hide');


                            }
                        } else if (response.status === 2) {
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
                // });
            });
        });
    </script>
@stop
