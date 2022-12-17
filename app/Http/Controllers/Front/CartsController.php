<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Traits\GlobalTrait;
use App\Models\Cart;
use App\Models\Product;
use App\Models\UserInfoPill;
use App\Models\Wishlist;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use General;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    use GlobalTrait;

    public $settings;

    public function __construct()
    {
        $this->settings = $this->getAllSettings();
    }

    public function index()
    {
        if (!backpack_auth()->check()) {
            return redirect()->to(route('site.home'))->with(['error-auth' => __('messages.auth-warning')]);

        }
        $cart_items = General::getAllProductFromCart();
//        return $cart_items;
        SEOMeta::setTitle(__('messages.cart') . ' - ' . $this->settings['title']);
        OpenGraph::setTitle(__('messages.cart') . ' - ' . $this->settings['title']);
        JsonLd::setTitle(__('messages.cart') . ' - ' . $this->settings['title']);
        \General::seoCommon();

        return view('front.pages.cart', compact('cart_items'));

    }


    public function addToCart(Request $request)
    {
        // Check Auth
        if (!backpack_auth()->check()) {
            return response()->json(['status' => 0, 'msg' => __('messages.auth-warning'), 'data' => null]);
        }
        // Check Cart Item Count < 10
        if (\General::cartCount() >= 10 || \General::cartCount() + $request->quantity > 10) {
            return response()->json(['status' => 1, 'msg' => __('messages.full-cart'), 'data' => null]);
        }
        // Check if Slug Error
        if (empty($request->slug)) {
            return response()->json(['status' => 1, 'msg' => __('messages.empty-warning'), 'data' => null]);
        }
        // Check if Product Exists
        $product = Product::active()->where('slug', $request->slug)->first();
//         return $product;
        if (empty($product)) {
            return response()->json(['status' => 1, 'msg' => __('messages.empty-warning'), 'data' => null]);
        }

        $already_cart = Cart::where('user_id', backpack_user()->id)->where('order_id', null)->where('product_id', $product->id)->first();
//         return $already_cart;
//        return response()->json(['status' => 2, 'msg' => __('messages.outof-stock'), 'data' => $already_cart]);

        if ($already_cart) {
//             dd($already_cart);
            $already_cart->quantity = $already_cart->quantity + $request->quantity;
            $already_cart->price = ($product->price - ($product->price * $product->discount) / 100);
            $already_cart->amount = $already_cart->price * $already_cart->quantity;
            // return $already_cart->quantity;
            if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0 || $already_cart->product->stock === null) {
                return response()->json(['status' => 1, 'msg' => __('messages.outof-stock'), 'data' => null]);
//                    return back()->with('error', 'Stock not sufficient!.');
            } else {
                $already_cart->save();
            }

//            $alreadyItem = Cart::with('product')->find($already_cart->id);
            $cart_new_count = \General::cartCount();
//            $subtotal = General::totalCartPrice();
            return response()->json(['status' => 6, 'msg' => __('messages.success-cart'), 'data' => ['new_count' => $cart_new_count]]);

        } else {
//            dd($request->all());

            $cart = new Cart;
            $cart->user_id = backpack_user()->id;
            $cart->product_id = $product->id;
//            $cart->size = $request->size;
            $cart->price = ($product->price - ($product->price * $product->discount) / 100);
            $cart->quantity = $request->quantity;
            $cart->amount = $cart->price * $cart->quantity;

            if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0 || $cart->product->stock === null) {
                return response()->json(['status' => 1, 'msg' => __('messages.outof-stock'), 'data' => null]);
            } else {
                $cart->save();
            }
            $wishlist = Wishlist::where('user_id', backpack_user()->id)->where('cart_id', null)->update(['cart_id' => $cart->id]);
//            $newItem = Cart::with('product')->find($cart->id);
            $cart_new_count = General::cartCount();
//            $subtotal = General::totalCartPrice();
            return response()->json(['status' => 3, 'msg' => __('messages.success-cart'), 'data' => ['new_count' => $cart_new_count]]);
        }

    }


    public function cartDelete(Request $request, $id)
    {
        if (!backpack_auth()->check()) {
            return response()->json(['status' => 0, 'msg' => __('messages.auth-warning'), 'data' => null]);
        }
        $cart = Cart::where('user_id', backpack_auth()->user()->id)->find($id);
//        if ($cart) {
        $cart->delete();
//            $id = $request->id;
        $cart_new_count = General::cartCount();
        $subtotal = General::totalCartPrice();

        return response()->json(['status' => 1, 'msg' => __('messages.success.delete'), 'data' => ['id' => $id, 'count' => $cart_new_count, 'subtotal' => $subtotal]]);
//        } else {
//            return response()->json(['status' => 2, 'msg' => __('messages.empty-warning'), 'data' => null]);
//        }
    }


    public function cartUpdate(Request $request)
    {


//        return $request;
        if (!backpack_auth()->check()) {
            return response()->json(['status' => 0, 'msg' => __('messages.auth-warning'), 'data' => null]);
        }

        if (array_sum($request->quantity) > 10) {
            return response()->json(['status' => 4, 'msg' => __('messages.full-cart'), 'data' => null]);
        }
        // dd($request->all());
        if ($request->quantity) {
            $data = array();
//            $success = '';
            // return $request->quant;
            foreach ($request->quantity as $k => $quantity) {
//                 return $quantity;
//                 return $k;
                $id = $request->cart_ids[$k];
                // return $id;
                $cart = Cart::with('product')->find($id);
//                 return $cart;
                if ($quantity > 0 && $cart) {
                    $max = General::getQuantity($cart->product->id);
//                     return $max;

                    if ($max < $quantity) {
//                        error out of Stock
                        return response()->json(['status' => 1, 'msg' => __('messages.outof-stock'), 'data' => null]);
                    }
                    $cart->quantity = ($max > $quantity) ? $quantity : $max;
//                     return $cart;

                    if ($max <= 0) continue;
                    $after_price = ($cart->product->price - ($cart->product->price * $cart->product->discount) / 100);
                    $cart->amount = $after_price * $quantity;
                    // return $cart->price;
                    $cart->save();
                    $news[] = ['id' => $cart->id,
                        'amount' => $cart->amount,
                        'quantity' => $cart->quantity
                    ];
                } else {
//                    error warning
                    return response()->json(['status' => 1, 'msg' => __('messages.empty-warning'), 'data' => null]);
                }
            }
//return $data;
//            success updated
            $cart_new_count = General::cartCount();
            $subtotal = General::totalCartPrice();
            return response()->json(['status' => 2, 'msg' => __('messages.success.update'), 'data' => ['news' => $news, 'newCount' => $cart_new_count, 'newSubtotal' => $subtotal]]);
        } else {
//            failed from quantity null
            return response()->json(['status' => 1, 'msg' => __('messages.empty-warning'), 'data' => null]);
        }
    }


    public function checkout(Request $request)
    {
        if (!backpack_auth()->check()) {
            return redirect()->route('backpack.auth.login');
        }
        SEOMeta::setTitle(__('messages.checkout') . ' - ' . $this->settings['title']);
        OpenGraph::setTitle(__('messages.checkout') . ' - ' . $this->settings['title']);
        JsonLd::setTitle(__('messages.checkout') . ' - ' . $this->settings['title']);
        \General::seoCommon();

        $details = UserInfoPill::with('user', 'shipping')
            ->where('user_id', backpack_auth()->user()->id)
            ->first();
        $cart_items = General::getAllProductFromCart();
        if ($cart_items->count() > 0)
            return view('front.pages.checkout', compact('cart_items', 'details'));
        return redirect()->route('site.home')->with(['error' => __('messages.empty.cart')]);
    }
}
