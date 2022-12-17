<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Post;
use App\Models\Setting;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->settings = $settings = Setting::all()[0];

    }

    public function index() {
        SEOMeta::setTitle( __('messages.blog') . ' - ' . $this->settings['title']);
        OpenGraph::setTitle(__('messages.blog') . '  - ' . $this->settings['title']);
        JsonLd::setTitle(__('messages.blog') . ' - ' . $this->settings['title']);

        \General::seoBlog();

        $posts = Post::active()->ordered()->get();
        return view('front.pages.blog', compact('posts'));
    }
    public function show($slug) {

        $post = Post::where('slug', $slug)->first();
        \General::singlePost($slug);

        $related = Post::where('id', '!=' , $post->id)->get();
        $clients = Client::active()->get();

        return view('front.pages.post', compact('post', 'related', 'clients'));
    }
}
