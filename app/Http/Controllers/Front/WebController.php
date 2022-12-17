<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontOrderRequest;
use App\Http\Requests\HomeSubscriptionRequest;
use App\Http\Requests\MessageFrontRequest;
use App\Models\Client;
use App\Models\Event;
use App\Models\Message;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\Productcategory;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Subscription;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function __construct()
    {
        $this->settings = $settings = Setting::all()[0];
    }

    public function index() {
        //Artisan::call('optimize:clear');
        $team = \App\Models\Employee::active()->select('name', 'job_title', 'image', 'youtube_url', 'fb_url', 'linked_url', 'twitter_url', 'instagram_url', 'behance_url', 'whatsapp_url')->ordered()->get();
        $projects = \App\Models\Project::active()->select('summary', 'title', 'image', 'slug')->ordered()->get();
        $services = Service::active()->select('short_des', 'title', 'image', 'slug')->ordered()->get();
        $clients = Client::active()->select('image')->ordered()->get();
        $events = Event::active()->select('image')->get();
        $posts = Post::with(['category' => function($q) {
            $q->select('id','title');
        }])->active()->select('id','title', 'summary', 'image', 'slug', 'created_at', 'blogcategory_id')->featured()->get();
        $products = Product::with('category')->whereHas('category', function ($q) {
            $q->active();
        })->active()->get();
        $categories = Productcategory::active()->get();

        SEOMeta::setTitle(__('messages.home') . ' - ' . $this->settings['title']);
        OpenGraph::setTitle(__('messages.home') . ' - ' . $this->settings['title']);
        JsonLd::setTitle(__('messages.home') . ' - ' . $this->settings['title']);

        \General::seoCommon();
        return view('front.pages.index', compact('events', 'services', 'team', 'projects', 'clients', 'posts', 'products', 'categories'));
    }

    public function about() {
        SEOMeta::setTitle(__('messages.about-us') . ' - ' . $this->settings['title']);
        OpenGraph::setTitle(__('messages.about-us') . ' - ' . $this->settings['title']);
        JsonLd::setTitle(__('messages.about-us') . ' - ' . $this->settings['title']);

        \General::seoAbout();
        return view('front.pages.about');
    }

    public function contact() {
        SEOMeta::setTitle(__('messages.contact-us') . ' - ' . $this->settings['title']);
        OpenGraph::setTitle(__('messages.contact-us') . ' - ' . $this->settings['title']);
        JsonLd::setTitle(__('messages.contact-us') . ' - ' . $this->settings['title']);
        return view('front.pages.contact-us');
    }
    public function storeMessage(MessageFrontRequest $request)
    {
//      return $request;
        $message = Message::create($request->all());
        if ($message)
            return redirect()->back()->with(['success' => __('messages.success-message')]);
        return redirect()->back()->with(['error' => __('messages.failed-message')]);
    }
    public function subscribe(HomeSubscriptionRequest $request)
    {
    //  return $request;
        $subscription = Subscription::create([
            'email' => $request->subscription_email
        ]);
        if ($subscription)
            return redirect()->back()->with(['success' => __('messages.subscribe.success')]);
        return redirect()->back()->with(['error' => __('messages.error-msg')]);
    }

    public function privacy() {

        SEOMeta::setTitle(__('messages.privacy') . ' - ' . $this->settings['title']);
        OpenGraph::setTitle(__('messages.privacy') . ' - ' . $this->settings['title']);
        JsonLd::setTitle(__('messages.privacy') . ' - ' . $this->settings['title']);

        return view('front.pages.privacy-policy');
    }































}
