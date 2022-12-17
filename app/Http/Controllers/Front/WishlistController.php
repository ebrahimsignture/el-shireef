<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Traits\GlobalTrait;
use App\Models\Product;
use App\Models\Wishlist;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class WishlistController extends Controller
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
            return redirect()->to(route('site.home'))->with(['error' => __('messages.auth-warning')]);

        }
        $wishes = Wishlist::where('user_id', backpack_auth()->user()->id)->get();
        SEOMeta::setTitle(__('messages.wish') . ' - ' . $this->settings['title']);
        OpenGraph::setTitle(__('messages.wish') . ' - ' . $this->settings['title']);
        JsonLd::setTitle(__('messages.wish') . ' - ' . $this->settings['title']);
        \General::seoCommon();

        return view('front.pages.wish-list', compact('wishes'));
    }

    public function addToWish(Request $request)
    {

        if (!backpack_auth()->check()) {
            return response()->json(['status' => 0, 'msg' => __('messages.auth-warning'), 'data' => null]);
        }

        if (empty($request->slug)) {
            return response()->json(['status' => 2, 'msg' => __('messages.empty-warning'), 'data' => null]);
        }
        $product = Product::where('slug', $request->slug)->first();
        // return $product;
        if (empty($product)) {
            return response()->json(['status' => 2, 'msg' => __('messages.empty-warning'), 'data' => null]);
        }

        //where('cart_id', null)->

        $already_wishlist = Wishlist::where('user_id', backpack_auth()->user()->id)->where('product_id', $product->id)->first();
        // return $already_wishlist;
        if ($already_wishlist) {
            return response()->json(['status' => 3, 'msg' => __('messages.already-wishlist'), 'data' => null]);

        } else {


            $wishlist = new Wishlist;
            $wishlist->user_id = backpack_auth()->user()->id;
            $wishlist->product_id = $product->id;
            $wishlist->price = ($product->price - ($product->price * $product->discount) / 100);
            $wishlist->quantity = 1;
            $wishlist->amount = $wishlist->price * $wishlist->quantity;
            if ($wishlist->product->stock < $wishlist->quantity || $wishlist->product->stock <= 0) return back()->with('error', 'Stock not sufficient!.');
            $wishlist->save();


        }
        return response()->json(['status' => 1, 'msg' => __('messages.success-wishlist'), 'data' => null]);
    }

    public function destroyWish(Request $request)
    {
        if (!backpack_auth()->check()) {
            return response()->json(['status' => false, 'msg' => __('messages.auth-warning'), 'data' => null]);

        } else {
            $wishlist = Wishlist::find($request->id);
            if ($wishlist) {
                $wishlist->delete();
                return response()->json(['status' => true, 'msg' => __('messages.success.delete'), 'data' => null]);
            } else {
                return response()->json(['status' => false, 'msg' => __('messages.empty-warning'), 'data' => null]);

            }
        }
    }
}
