<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontOrderRequest;
use App\Http\Traits\GlobalTrait;
use App\Models\Order;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServicesController extends Controller
{
    use GlobalTrait;

    public $settings;

    public function __construct()
    {
        $this->settings = $this->getAllSettings();
    }

    public function order() {
        SEOMeta::setTitle(__('messages.service-order') . ' - ' . $this->settings['title']);
        OpenGraph::setTitle(__('messages.contact-us') . ' - ' . $this->settings['title']);
        JsonLd::setTitle(__('messages.contact-us') . ' - ' . $this->settings['title']);

        \General::seoPlace();
        return view('front.pages.service-order');
    }
    public function placeOrder(FrontOrderRequest $request) {
//        return $request;
        try {
            DB::beginTransaction();
            $order = Order::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
//                'whats_app' => $request->whats_app,
                'details' => $request->details,
                'user_id' => backpack_auth()->user()->id,
            ]);
            $order->services()->attach($request->services);
            DB::commit();
            return redirect()->route('site.service-order')->with(['success' => __('messages.order-submitted')]);

        } catch (\Exception $x) {
            return redirect()->route('site.service-order')->with(['error' => __('messages.error-msg')]);
        }
    }
}
