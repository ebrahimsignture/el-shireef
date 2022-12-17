<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Traits\GlobalTrait;
use App\Models\Product;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    use GlobalTrait;

    public $settings;

    public function __construct()
    {
        $this->settings = $this->getAllSettings();
    }

    public function productDetails($slug)
    {
//        $slug = 'product-1-6';
        $product_details = Product::getProductBySlug($slug);
//         return$product_details;
        if ($product_details) {
            SEOMeta::setTitle($product_details->title . ' - ' . $this->settings['title']);
            SEOMeta::setDescription($product_details->summary);

            SEOMeta::addMeta('product:published_time', $product_details->created_at->toW3CString(), 'property');
            SEOMeta::addMeta('product:section-title', $product_details->category->title, 'property');
            SEOMeta::addMeta('product:section-description', $product_details->category->description, 'property');
            foreach ($product_details->tags as $tag) {
                SEOMeta::addKeyword($tag->title);
            }

            OpenGraph::setDescription($product_details->summary);
            OpenGraph::setTitle($product_details->title . ' - ' . $this->settings['title']);
            OpenGraph::setUrl(route('site.product.details', $product_details->slug));
            OpenGraph::addProperty('type', 'product');
            OpenGraph::addProperty('locale', 'en_GB');
            OpenGraph::addProperty('locale:alternate', ['ar-AE']);
            $photos = explode(',', $product_details->image);
            foreach ($photos as $key => $item) {
                OpenGraph::addImage(asset($item));
            }

            JsonLd::setTitle($product_details->title . ' - ' . $this->settings['title']);
            JsonLd::setDescription($product_details->summary);
            JsonLd::setType('Product');
            foreach ($photos as $key => $item) {
                JsonLd::addImage(asset($item));
            }
            SEOMeta::addMeta('contact:facebook', $this->settings['facebook'], 'facebook_url');
            SEOMeta::addMeta('contact:instagram', $this->settings['instagram'], 'instagram_url');
            SEOMeta::addMeta('contact:email', $this->settings['email'], 'email_url');
            SEOMeta::addMeta('contact:phone', $this->settings['phone'], 'phone');

            OpenGraph::addProperty('contact:facebook', $this->settings['facebook']);
            OpenGraph::addProperty('contact:instagram', $this->settings['instagram']);
            OpenGraph::addProperty('contact:email', $this->settings['email']);
            OpenGraph::addProperty('contact:phone', $this->settings['phone']);

            $related = Product::active()->where('cat_id', $product_details->cat_id)->where('id', '!=', $product_details->id)->get();
//return $related;
            return view('front.pages.product-details')->with(['product_details' => $product_details, 'related' => $related]);
        }

        return redirect()->route('site.home')->with(['error' => __('messages.error-msg')]);
    }
}
