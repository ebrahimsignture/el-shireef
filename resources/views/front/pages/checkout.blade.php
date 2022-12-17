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
                            - {{__('messages.cart')}} - {{__('messages.checkout')}}
                        </h5>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section class="checkout-page mt-4" dir="{{General::getDir()}}">

        <form method="post" action="{{route('cart.order')}}">
            @csrf
            <div class="pill-form col-md-5 col-12 col-sm-12 d-inline-block">
                <h5 class="card-header mb-3">{{__('messages.pill.details')}}</h5>
                <div class="pill-form-inputs">
                    <div class="m-3">
                        <label for="first_name">{{__('messages.first_name')}} <span class="required">*</span>
                            @if ($errors->has('first_name'))
                                <span class="required">
                                                        <strong>{{ $errors->first('first_name') }}</strong>
                                                    </span>
                            @endif
                        </label>
                        <input type="text" name="first_name" class="form-control"
                               placeholder="{{__('messages.first_name')}}" id="first_name" value="{{$details->first_name }}" required>
                    </div>
                    <div class="m-3">
                        <label for="last_name">{{__('messages.last_name')}} <span class="required">*</span>
                            @if ($errors->has('last_name'))
                                <span class="required">
                                    <strong>{{ $errors->first('last_name') }}</strong>
                                </span>
                            @endif
                        </label>
                        <input type="text" name="last_name" class="form-control"
                               placeholder="{{__('messages.last_name')}}" id="last_name" value="{{$details->last_name }}" required>
                    </div>
                    <div class="m-3">
                        <label for="phone">{{__('messages.form.phone')}} <span class="required">*</span>
                            @if ($errors->has('phone'))
                                <span class="required">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                            @endif
                        </label>
                        <input type="tel" name="phone" class="form-control"
                               placeholder="{{__('messages.phone-pill-holder')}}" id="phone" value="{{$details->phone}}" required>
                    </div>
                    <div class="m-3">
                        <label for="email">{{__('messages.form.email')}}
                            <span>{{__('messages.optional')}}</span>
                            @if ($errors->has('email'))
                                <span class="required">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                            @endif
                        </label>
                        <input type="email" name="email" class="form-control"
                               placeholder="{{__('messages.email.helps')}}" id="email" value="{{$details->email}}" aria-describedby="emailHelp">
                    </div>

                    <div class="m-3 shipping_div">
                        <label for="shipping">
                            {{__('messages.choose.city')}} <span class="required">*</span>
                            <span class="bold" style="font-size: 14px">({{__('messages.every-ship')}})</span>
                        </label>
                        <select name="shipping" class="wide">
                            <option value="">{{__('messages.choose.city')}}</option>
                            @php
                                $ships = \App\Models\Shipping::active()->get();
                            @endphp
                            @foreach($ships as $ship)
                                <option
                                    value="{{$ship->id}}" {{$details->shipping_id === $ship->id ? 'selected' : ''}}>{{$ship->place}}
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$ship->price}} EGP
                                </option>

                            @endforeach

                        </select>
                    </div>
                    <div class="m-3">
                        <label for="state" class="mt-2">{{__('messages.state')}} <span class="required">*</span>
                            @if ($errors->has('state'))
                                <span class="required">
                                                        <strong>{{ $errors->first('state') }}</strong>
                                                    </span>
                            @endif
                        </label>
                        <input type="text" name="state" class="form-control"
                               placeholder="{{__('messages.state')}}" id="state" value="{{$details->state}}" required>
                    </div>
                    <div class="m-3">
                        <label for="street">{{__('messages.street')}} <span class="required">*</span>
                            @if ($errors->has('address1'))
                                <span class="required">
                                                        <strong>{{ $errors->first('address1') }}</strong>
                                                    </span>
                            @endif
                        </label>
                        <input type="text" name="address1" class="form-control"
                               placeholder="{{__('messages.street')}}" id="street" value="{{$details->address1}}" required>
                    </div>
                    <div class="m-3">
                        <label for="order-notes">{{__('messages.order.notes')}} <span>{{__('messages.optional')}}</span></label>
                        <textarea placeholder="{{__('messages.order.notes.holder')}}" class="form-control"
                                  id="order-notes" name="notes"
                                  rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="total-info">
                <div class="card col-md-5 col-sm-12 col-12">
                    <h5 class="card-header">{{__('messages.your.order')}}</h5>
                    <div class="card-body">
                        <table class="total-info-body">
                            <thead class="table-light">
                            <tr>
                                <th class="product_th"><span>{{__('messages.product')}}</span></th>
                                <th class="quantity_th">{{__('messages.quantity')}}</th>
                                <th class="total_th">{{__('messages.total')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(isset($cart_items) && $cart_items->count() > 0)
                                @foreach($cart_items as $item)
                                    <tr id="pill_order_{{$item->id}}">
                                        <td class="name_size"><span>{{$item->product->title}}</span><br>
                                        </td>
                                        <td><span>{{$item->quantity}}</span></td>
                                        <td><span>{{number_format($item->amount, 2)}} EGP</span></td>
                                    </tr>
                                @endforeach
                            @endif




                            <tr class="order-subtotal">
                                <th><span>{{__('messages.total')}}</span></th>
                                <td></td>
                                <td data-title="{{__('messages.total')}}">
                                    <span
                                        id="pill_order_subtot">{{number_format(100, 2)}} EGP</span>
                                </td>
                            </tr>

                            @if($details->shipping_id === null)
                                <tr class="shipping_order">
                                    <th><span>{{__('messages.shipping')}}</span></th>
                                    <td></td>
                                    <td data-title="{{__('messages.shipping')}}">
                                        <span id="ship_cost">........</span>

                                    </td>
                                </tr>

                                <tr class="order-total">
                                    <th><span>{{__('messages.final-total')}}</span></th>
                                    <td></td>
                                    <td data-title="{{__('messages.final-total')}}">
                                        <span id="final_total">........</span>
                                    </td>
                                </tr>
                            @else
                                @php
                                $ship = \App\Models\Shipping::find($details->shipping_id);
                                @endphp
                                <tr class="shipping_order">
                                    <th><span>{{__('messages.shipping')}}</span></th>
                                    <td></td>
                                    <td data-title="{{__('messages.shipping')}}">
                                        <span id="ship_cost">{{$ship->price}}  EGP</span>

                                    </td>
                                </tr>

                                <tr class="order-total">
                                    <th><span>{{__('messages.final-total')}}</span></th>
                                    <td></td>
                                    <td data-title="{{__('messages.final-total')}}">
                                        <span id="final_total">{{number_format($ship->price+ General::totalCartPrice(), 2)}} EGP</span>
                                    </td>
                                </tr>

                            @endif

                            <tr class="shipping_order">
                                <th><span>{{__('messages.payment.method')}}</span></th>
                                <td></td>
                                <td colspan="1" data-title="{{__('messages.payment.method')}}">
                                    <img src="{{asset('assets/front/images/miza.png')}}" alt="payment-img" class="payment-img">
                                    <img src="{{asset('assets/front/images/mastercard.png')}}" alt="payment-img" class="payment-img">
                                    <img src="{{asset('assets/front/images/visa.png')}}" alt="payment-img" class="payment-img">

                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <button class="btn-complete-order"
                                            type="submit">{{__('messages.pay.now')}}</button>
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <div class="d-none backup">
        @php
            $ships = \App\Models\Shipping::active()->get();
        @endphp
        <span id="ship_cost_">.........</span>

        @foreach($ships as $ship)
            <span id="ship_cost_{{$ship->id}}">{{$ship->price}}</span>
        @endforeach
    </div>
    <div style="clear: both"></div>
@stop
@section('script')
    <script>
        $(document).ready(function () {
            let ship = $('div.shipping_div div.nice-select ul.list li');
            ship.on('click', function (e) {
                e.preventDefault();
                let ship_cost = $('#ship_cost');
                let final_total = $('#final_total');
                let id = $(this).data('value');
                if (id === "") {
                    // alert("empty");

                    ship_cost.text("........");
                    final_total.text("........");
                } else {
                    // alert(id);
                    let cost = $('#ship_cost_' + id).text();
                    let pill_order_subtot = $('#pill_order_subtot').text();
                    let splited_subtot = pill_order_subtot.split(".");
                    let edited_subtot = splited_subtot[0].replace(',', '');
                    let final = parseInt(edited_subtot) + parseInt(cost) + ".00 EGP";
                    // alert(cost);
                    // alert(final);

                    ship_cost.text(cost + " EGP");
                    final_total.text(final);
                }

            });
        });
    </script>
@stop
