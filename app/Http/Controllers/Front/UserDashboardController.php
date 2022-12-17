<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\InfoNameUpdateRequest;
use App\Http\Requests\InfoPasswordUpdateRequest;
use App\Http\Requests\ShipUpdateRequest;
use App\Http\Traits\GlobalTrait;
use App\Models\Order;
use App\Models\Productorder;
use App\Models\User;
use App\Models\UserInfoPill;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Backpack\CRUD\app\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserDashboardController extends Controller
{
    use GlobalTrait;

    public $settings;

    public function __construct()
    {
        $this->settings = $this->getAllSettings();

        $this->middleware('UserAuth');
    }

    public function index()
    {
        $user = backpack_auth()->user();
        // return $user;
        if ($user) {
            SEOMeta::setTitle(__('messages.user.dashboard') . ' - ' . $this->settings['title']);
            OpenGraph::setTitle(__('messages.user.dashboard') . ' - ' . $this->settings['title']);
            JsonLd::setTitle(__('messages.user.dashboard') . ' - ' . $this->settings['title']);
            \General::seoCommon();
            return view('front.pages.user_dashboard.index', compact('user'));

        } else {
            return redirect()->route('site.home')->with(['error' => __('messages.error-msg')]);
        }

    }

    public function serviceOrders()
    {
        $orders = Order::with(['services' => function ($q) {
            $q->select('title');
        }])->where('user_id', backpack_user()->id)->select('id','name', 'created_at', 'status')->orderBy('id', 'desc')->get();
        // return $orders;
        if ($orders) {
            SEOMeta::setTitle(__('messages.user.orders') . ' - ' . $this->settings['title']);
            OpenGraph::setTitle(__('messages.user.orders') . ' - ' . $this->settings['title']);
            JsonLd::setTitle(__('messages.user.orders') . ' - ' . $this->settings['title']);
            \General::seoCommon();
//            return $orders;
            return view('front.pages.user_dashboard.service_orders', compact('orders'));
        } else {
            return redirect()->route('site.home')->with(['error' => __('messages.error-msg')]);
        }
    }

    public function orders()
    {
        $orders = Productorder::where('user_id', backpack_user()->id)->orderBy('id', 'desc')->get();
        // return $orders;
        if ($orders) {
            SEOMeta::setTitle(__('messages.user.orders') . ' - ' . $this->settings['title']);
            OpenGraph::setTitle(__('messages.user.orders') . ' - ' . $this->settings['title']);
            JsonLd::setTitle(__('messages.user.orders') . ' - ' . $this->settings['title']);
            \General::seoCommon();

            return view('front.pages.user_dashboard.orders', compact('orders'));
        } else {
            return redirect()->route('site.home')->with(['error' => __('messages.error-msg')]);
        }
    }

    public function orderShow($order_id)
    {
        $order = Productorder::with('cart_info', 'shipping', 'user')
            ->where('user_id', backpack_user()->id)
            ->where('id', $order_id)
            ->first();
        // return $order;
        if ($order) {
            SEOMeta::setTitle(__('messages.user.orders') . ' - ' . $this->settings['title']);
            OpenGraph::setTitle(__('messages.user.orders') . ' - ' . $this->settings['title']);
            JsonLd::setTitle(__('messages.user.orders') . ' - ' . $this->settings['title']);
            \General::seoCommon();


            return view('front.pages.user_dashboard.orders-show', compact('order'));
        } else {
            return redirect()->route('site.home')->with(['error' => __('messages.error-msg')]);

        }
    }

    public function shipDetails()
    {

        $details = UserInfoPill::with('user', 'shipping')
            ->where('user_id', backpack_auth()->user()->id)
            ->first();
//        return $details->shipping;
        if ($details) {
            SEOMeta::setTitle(__('messages.ship.pill.details') . ' - ' . $this->settings['title']);
            OpenGraph::setTitle(__('messages.ship.pill.details') . ' - ' . $this->settings['title']);
            JsonLd::setTitle(__('messages.ship.pill.details') . ' - ' . $this->settings['title']);
            \General::seoCommon();
            return view('front.pages.user_dashboard.ship-pill-details', compact('details'));
        } else {
            return redirect()->route('site.home')->with(['error' => __('messages.error-msg')]);

        }

    }

    public function shipDetailsEdit()
    {

        $details = UserInfoPill::with('user', 'shipping')
            ->where('user_id', backpack_auth()->user()->id)
            ->first();
//        return $details;
        if ($details) {
            SEOMeta::setTitle(__('messages.ship.pill.details') . ' - ' . $this->settings['title']);
            OpenGraph::setTitle(__('messages.ship.pill.details') . ' - ' . $this->settings['title']);
            JsonLd::setTitle(__('messages.ship.pill.details') . ' - ' . $this->settings['title']);
            \General::seoCommon();
            return view('front.pages.user_dashboard.ship-pill-details-edit', compact('details'));

        } else {
            return redirect()->route('site.home')->with(['error' => __('messages.error-msg')]);

        }

    }

    public function shipDetailsUpdate(ShipUpdateRequest $request)
    {
        $details = UserInfoPill::with('shipping')
            ->where('user_id', backpack_auth()->user()->id)
            ->first();
        $details->phone = $request->phone;
        $details->save();

        $details->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'shipping_id' => $request->shipping_id,
            'state' => $request->state,
            'address1' => $request->address1,
        ]);
        return redirect()->to(route('site.user.ship.pill.details'))->with(['success' => __('messages.success.details.update')]);
    }

    public function personalInfoEdit()
    {
        $user = backpack_auth()->user();
        if ($user) {
            SEOMeta::setTitle(__('messages.personal') . ' - ' . $this->settings['title']);
            OpenGraph::setTitle(__('messages.personal') . ' - ' . $this->settings['title']);
            JsonLd::setTitle(__('messages.personal') . ' - ' . $this->settings['title']);
            \General::seoCommon();

            return view('front.pages.user_dashboard.personal-info', compact('user'));

        } else {
            return redirect()->route('site.home')->with(['error' => __('messages.error-msg')]);

        }
    }

    public function personalInfoNameUpdate(InfoNameUpdateRequest $request)
    {
//        return $request->ip();

        $user = backpack_auth()->user();

        if ($request->email !== $user->email) {
            $check = User::where('email', $request->email)->first();
            if ($check)
                return redirect()->back()->with(['error' => __('messages.email.unique')]);
            $user->update(['email' => $request->email]);
        }
        if (!empty($request->first_name) && !empty($request->last_name))
            $user->update(['first_name' => $request->first_name, 'last_name' => $request->last_name ]);
        return redirect()->back()->with(['success' => __('messages.success.details.update')]);
    }

    public function personalInfoPassUpdate(InfoPasswordUpdateRequest $request)
    {
        $user = backpack_auth()->user();
        $user->password = Hash::make($request->new_password);

        if ($user->save()) {
            return redirect()->back()->with(['success' => __('messages.success.password.update')]);
        } else {
            return redirect()->back()->with(['error' => __('messages.failed-message')]);
        }

    }


}
