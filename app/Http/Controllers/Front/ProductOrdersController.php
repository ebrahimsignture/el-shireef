<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckOutRequest;
use App\Http\Traits\GlobalTrait;
use App\Models\Cart;
use App\Models\Productorder;
use App\Models\Shipping;
use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class ProductOrdersController extends Controller
{
    use GlobalTrait;

    public $settings;

    public function __construct()
    {
        $this->settings = $this->getAllSettings();
    }

    public function store(CheckOutRequest $request)
    {
//        return $request;

//        return $request->all();

        if (empty(Cart::where('user_id', backpack_user()->id)->where('order_id', null)->first())) {
            request()->session()->flash('error', 'Cart is Empty !');
            return back();
        }

        $order = new Productorder();
        $order_data = $request->all();
        $order_data['notes'] = $request->notes;
        $order_data['order_number'] = 'ELS-' . strtoupper(Str::random(10));
        $order_data['user_id'] = backpack_user()->id;
        $order_data['shipping_id'] = $request->shipping;
        $shipping = Shipping::where('id', $order_data['shipping_id'])->pluck('price');
        // return session('coupon')['value'];
        $order_data['sub_total'] = \General::totalCartPrice();
        $order_data['quantity'] = \General::cartCount();
        if (session('coupon')) {
            $order_data['coupon'] = session('coupon')['value'];
        }
        if ($request->shipping) {
            if (session('coupon')) {
                $order_data['total_amount'] = \General::totalCartPrice() + $shipping[0] - session('coupon')['value'];
            } else {
                $order_data['total_amount'] = \General::totalCartPrice() + $shipping[0];
            }
        } else {
            if (session('coupon')) {
                $order_data['total_amount'] = \General::totalCartPrice() - session('coupon')['value'];
            } else {
                $order_data['total_amount'] = \General::totalCartPrice();
            }
        }
//         return $order_data;
        $order_data['status'] = "new";
        if (request('payment_method') == 'paypal') {
            $order_data['payment_method'] = 'paypal';
            $order_data['payment_status'] = 'paid';
        } else {
            $order_data['payment_method'] = 'cod';
            $order_data['payment_status'] = 'Unpaid';
        }
        $order->fill($order_data);
        $status = $order->save();


        if (request('payment_method') == 'paypal') {
            return redirect()->route('payment')->with(['id' => $order->id]);
        } else {
            session()->forget('cart');
            session()->forget('coupon');
        }
//        return $order;
        Cart::where('user_id', backpack_user()->id)->where('order_id', null)->update(['order_id' => $order->id]);
        $new_order = Productorder::with('cart_info', 'shipping', 'user')->find($order->id);
        if ($new_order)
            return redirect()->route('site.order-complete', encrypt($new_order->id))->with(['success' => __('messages.order-submitted')]);
        return redirect()->route('site.home')->with(['error' => __('messages.empty-warning')]);
    }

    public function doneOrder($order_id)
    {
        $order = Productorder::with('cart_info', 'shipping', 'user')->find(decrypt($order_id));
//        return$order;
        SEOMeta::setTitle(__('messages.checkout') . ' - ' . $this->settings['title']);
        OpenGraph::setTitle(__('messages.checkout') . ' - ' . $this->settings['title']);
        JsonLd::setTitle(__('messages.checkout') . ' - ' . $this->settings['title']);
        \General::seoCommon();

        return view('front.pages.order-complete', compact('order'));
    }


    public function trackOrder()
    {
        SEOMeta::setTitle(__('messages.track') . ' - ' . $this->settings['title']);
        OpenGraph::setTitle(__('messages.track') . ' - ' . $this->settings['title']);
        JsonLd::setTitle(__('messages.track') . ' - ' . $this->settings['title']);
        \General::seoCommon();

        return view('front.pages.track-order');
    }

    public function trackResult(Request $request)
    {
        $order = Productorder::with('cart_info', 'shipping', 'user')->where('order_number', $request->order_number)->where('email', $request->bill_email)->first();
        if ($order) {
            SEOMeta::setTitle(__('messages.track') . ' - ' . $this->settings['title']);
            OpenGraph::setTitle(__('messages.track') . ' - ' . $this->settings['title']);
            JsonLd::setTitle(__('messages.track') . ' - ' . $this->settings['title']);
            \General::seoCommon();

            return view('front.pages.order-complete', compact('order'));
        } else {
            return redirect()->back()->with(['error' => __('messages.empty.track')]);
        }
    }

}
