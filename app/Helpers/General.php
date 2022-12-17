<?php


use App\Models\Cart;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Service;
use App\Models\Setting;

use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\App;

// use Auth;

function getFolder()
{
    return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
}

class General
{

    public static function getDir()
    {
        if (LaravelLocalization::getCurrentLocale() === 'en') {
            return "ltr";
        } else {
            return "rtl";
        }
    }

    public static function getUserIP()
    {
        // Get real visitor IP behind CloudFlare network

        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') > 0) {
                $addr = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);
                return $id = trim($addr[0]);
            } else {
                return $id = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        } else {
            return $id = $_SERVER['REMOTE_ADDR'];
        }
    }



    /**
     * Start Products Section
     */

    // Cart Count
    public static function cartCount($user_id = '')
    {

        if (backpack_auth()->check()) {
            if ($user_id == "") $user_id = backpack_user()->id;
            return Cart::where('user_id', $user_id)->where('order_id', null)->sum('quantity');
        } else {
            return 0;
        }
    }

    // get All Product From Cart
    public static function getAllProductFromCart($user_id = '')
    {
        if (backpack_auth()->check()) {
            if ($user_id == "") $user_id = backpack_user()->id;
            return Cart::with('product')->where('user_id', $user_id)->where('order_id', null)->get();
        } else {
            return 0;
        }
    }

    // Total amount cart
    public static function totalCartPrice($user_id = '')
    {
        if (backpack_auth()->check()) {
            if ($user_id == "") $user_id = backpack_user()->id;
            return Cart::where('user_id', $user_id)->where('order_id', null)->sum('amount');
        } else {
            return 0;
        }
    }

    public static function wishlistCount($user_id = '')
    {

        if (backpack_auth()->check()) {
            if ($user_id == "") $user_id = backpack_user()->id;
            return Wishlist::where('user_id', $user_id)->where('cart_id', null)->sum('quantity');
        } else {
            return 0;
        }
    }

    public static function getAllProductFromWishlist($user_id = '')
    {
        if (backpack_auth()->check()) {
            if ($user_id == "") $user_id = backpack_user()->id;
            return Wishlist::with('product')->where('user_id', $user_id)->where('cart_id', null)->get();
        } else {
            return 0;
        }
    }

    public static function totalWishlistPrice($user_id = '')
    {
        if (backpack_auth()->check()) {
            if ($user_id == "") $user_id = backpack_user()->id;
            return Wishlist::where('user_id', $user_id)->where('cart_id', null)->sum('amount');
        } else {
            return 0;
        }
    }

    public static function getQuantity($id)
    {
        $product = Product::find($id);
        if ($product)
            return $product->stock;
        return 0;
    }


    /**
     * End Products Section
     */


    /**
     * Start SEO For Pages
     */

    public static function seoContacts()
    {
        $settings = Setting::all()[0];

        SEOMeta::addMeta('contact:facebook', $settings->facebook, 'facebook');
        SEOMeta::addMeta('contact:instagram', $settings->instagram, 'instagram');
        SEOMeta::addMeta('contact:email', $settings->email, 'email');
        SEOMeta::addMeta('contact:phone', $settings->phone, 'phone');
        SEOMeta::addMeta('contact:twitter', $settings->twitter, 'twitter');
        SEOMeta::addMeta('contact:linkedin', $settings->linkedin, 'linkedin');
        SEOMeta::addMeta('contact:behance', $settings->behance, 'behance');
        SEOMeta::addMeta('contact:whatsapp', $settings->whatsapp, 'whatsapp');

        OpenGraph::addProperty('contact:facebook', $settings->facebook);
        OpenGraph::addProperty('contact:instagram', $settings->instagram);
        OpenGraph::addProperty('contact:email', $settings->email);
        OpenGraph::addProperty('contact:phone', $settings->phone);
        OpenGraph::addProperty('contact:twitter', $settings->twitter);
        OpenGraph::addProperty('contact:linkedin', $settings->linkedin);
        OpenGraph::addProperty('contact:behance', $settings->behance);
        OpenGraph::addProperty('contact:whatsapp', $settings->whatsapp);
    }

    public static function seoCommon()
    {
        $settings = Setting::all()[0];
        SEOMeta::setDescription($settings->short_des);
        SEOMeta::setCanonical('https://signature.com.eg');

        OpenGraph::setDescription($settings->short_des);
        OpenGraph::setUrl('https://signature.com.eg');
        OpenGraph::addProperty('type', $settings->type);

        JsonLd::setDescription($settings->short_des);
        JsonLd::addImage(asset($settings->logo));

        General::seoContacts();

        foreach ($settings->tags as $tag) {
            SEOMeta::addKeyword($tag->title);
        }
    }

    public static function seoAbout()
    {
        $settings = Setting::all()[0];
        SEOMeta::setDescription($settings->short_des);
        SEOMeta::setCanonical(route('site.about-us'));

        OpenGraph::setDescription($settings->short_des);
        OpenGraph::setUrl(route('site.about-us'));
        OpenGraph::addProperty('type', $settings->type);

        JsonLd::setDescription($settings->short_des);
        JsonLd::addImage(asset($settings->logo));

        General::seoContacts();

        foreach ($settings->tags as $tag) {
            SEOMeta::addKeyword($tag->title);
        }
    }

    public static function seoJobs()
    {
        $settings = Setting::all()[0];
        SEOMeta::setDescription($settings->short_des);
        SEOMeta::setCanonical(route('site.jobs'));

        OpenGraph::setDescription($settings->short_des);
        OpenGraph::setUrl(route('site.jobs'));
        OpenGraph::addProperty('type', $settings->type);

        JsonLd::setDescription($settings->short_des);
        JsonLd::addImage(asset($settings->logo));

        General::seoContacts();

        foreach ($settings->tags as $tag) {
            SEOMeta::addKeyword($tag->title);
        }
    }

    public static function seoProjects()
    {
        $settings = Setting::all()[0];
        SEOMeta::setDescription($settings->short_des);
        SEOMeta::setCanonical(route('site.projects'));

        OpenGraph::setDescription($settings->short_des);
        OpenGraph::setUrl(route('site.projects'));
        OpenGraph::addProperty('type', 'projects');

        JsonLd::setDescription($settings->short_des);
        JsonLd::addImage(asset($settings->logo));

        General::seoContacts();

        foreach ($settings->tags as $tag) {
            SEOMeta::addKeyword($tag->title);
        }
    }

    public static function seoTeam()
    {
        $settings = Setting::all()[0];
        SEOMeta::setDescription($settings->short_des);
        SEOMeta::setCanonical(route('site.employees'));

        OpenGraph::setDescription($settings->short_des);
        OpenGraph::setUrl(route('site.employees'));
        OpenGraph::addProperty('type', 'employees');

        JsonLd::setDescription($settings->short_des);
        JsonLd::addImage(asset($settings->logo));

        General::seoContacts();

        foreach ($settings->tags as $tag) {
            SEOMeta::addKeyword($tag->title);
        }
    }

    public static function seoBlog()
    {
        $settings = Setting::all()[0];
        SEOMeta::setDescription($settings->short_des);
        SEOMeta::setCanonical(route('site.blog'));

        OpenGraph::setDescription($settings->short_des);
        OpenGraph::setUrl(route('site.blog'));
        OpenGraph::addProperty('type', 'posts');

        JsonLd::setDescription($settings->short_des);
        JsonLd::addImage(asset($settings->logo));

        General::seoContacts();

        foreach ($settings->tags as $tag) {
            SEOMeta::addKeyword($tag->title);
        }
    }

    public static function seoCourse()
    {
        $settings = Setting::all()[0];
        SEOMeta::setDescription($settings->short_des);
        SEOMeta::setCanonical(route('site.courses'));

        OpenGraph::setDescription($settings->short_des);
        OpenGraph::setUrl(route('site.courses'));
        OpenGraph::addProperty('type', 'courses');

        JsonLd::setDescription($settings->short_des);
        JsonLd::addImage(asset($settings->logo));

        General::seoContacts();

        foreach ($settings->tags as $tag) {
            SEOMeta::addKeyword($tag->title);
        }
    }

    /**
     * End SEO For Pages
     */




    /**
     * Start SEO For Single Pages
     */
    public static function singleCourse($slug)
    {

        $course = \App\Models\Course::where('slug', $slug)->first();
        $settings = Setting::all()[0];

        SEOMeta::setTitle($course->title . ' - ' . $settings->slug);
        SEOMeta::setDescription($course->summary);
        SEOMeta::setCanonical(route('site.course', $course->slug));
        SEOMeta::addMeta('course:published_time', $course->created_at->toW3CString(), 'property');
        foreach ($course->tags as $tag) {
            SEOMeta::addKeyword($tag->title);
        }
        $images = explode(',', $course->image);


        OpenGraph::setTitle($course->title . ' - ' . $settings->title);
        OpenGraph::setDescription($course->summary);
        OpenGraph::setUrl(route('site.course', $course->slug));
        OpenGraph::addProperty('type', 'course');
        OpenGraph::addProperty('locale', 'ar-AE');
        OpenGraph::addProperty('locale:alternate', ['ar-AE']);
        foreach ($images as $key => $item) {
            OpenGraph::addImage(asset($item));
        }


        JsonLd::setTitle($course->title . ' - ' . $settings->title);
        JsonLd::setDescription($course->summary);
        foreach ($images as $key => $item) {
            JsonLd::addImage(asset($item));
        }
        JsonLd::setType('course');

        General::seoContacts();

    }

    public static function seoPlace()
    {
        $settings = Setting::all()[0];
        SEOMeta::setDescription($settings->short_des);
        SEOMeta::setCanonical(route('site.place.order'));

        OpenGraph::setDescription($settings->short_des);
        OpenGraph::setUrl(route('site.place.order'));
        OpenGraph::addProperty('type', $settings->type);

        JsonLd::setDescription($settings->short_des);
        JsonLd::addImage(asset($settings->logo));

        General::seoContacts();

        foreach ($settings->tags as $tag) {
            SEOMeta::addKeyword($tag->title);
        }
    }

    public static function singleService($slug)
    {

        $service = Service::where('slug', $slug)->first();
        $settings = Setting::all()[0];

        SEOMeta::setTitle($service->title . ' - ' . $settings->slug);
        SEOMeta::setDescription($service->short_des);
        SEOMeta::setCanonical(route('site.service', $service->slug));
        SEOMeta::addMeta('service:published_time', $service->created_at->toW3CString(), 'property');
        foreach ($service->tags as $tag) {
            SEOMeta::addKeyword($tag->title);
        }


        OpenGraph::setTitle($service->title . ' - ' . $settings->title);
        OpenGraph::setDescription($service->short_des);
        OpenGraph::setUrl(route('site.service', $service->slug));
        OpenGraph::addProperty('type', 'service');
        OpenGraph::addProperty('locale', 'ar-AE');
        OpenGraph::addProperty('locale:alternate', ['ar-AE']);
        OpenGraph::addImage(asset($service->image));


        JsonLd::setTitle($service->title . ' - ' . $settings->title);
        JsonLd::setDescription($service->short_des);
        JsonLd::addImage(asset($service->image));
        JsonLd::setType('service');

        General::seoContacts();

    }

    public static function singlePost($slug)
    {

        $post = \App\Models\Post::where('slug', $slug)->first();
        $settings = Setting::all()[0];

        SEOMeta::setTitle($post->title . ' - ' . $settings->title);
        SEOMeta::setDescription($post->summary);
        SEOMeta::setCanonical(route('site.post', $post->slug));
        SEOMeta::addMeta('article:published_time', $post->created_at->toW3CString(), 'property');
        foreach ($post->tags as $tag) {
            SEOMeta::addKeyword($tag->title);
        }
        $images = explode(',', $post->image);


        OpenGraph::setTitle($post->title . ' - ' . $settings->title);
        OpenGraph::setDescription($post->summary);
        OpenGraph::setUrl(route('site.post', $post->slug));
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'ar-AE');
        OpenGraph::addProperty('locale:alternate', ['ar-AE']);
        foreach ($images as $key => $item) {
            OpenGraph::addImage(asset($item));
        }


        JsonLd::setTitle($post->title . ' - ' . $settings->title);
        JsonLd::setDescription($post->summary);
        foreach ($images as $key => $item) {
            JsonLd::addImage(asset($item));
        }
        JsonLd::setType('article');

        General::seoContacts();

    }

    public static function singleProfile($slug)
    {

        $employee = Employee::where('slug', $slug)->first();
        $settings = Setting::all()[0];

        SEOMeta::setTitle($employee->name . ' - ' . $settings->slug);
        SEOMeta::setDescription($employee->seo_description);
        SEOMeta::setCanonical(route('site.employee', $employee->slug));
        SEOMeta::addMeta('employee:published_time', $employee->created_at->toW3CString(), 'property');
        foreach ($employee->tags as $tag) {
            SEOMeta::addKeyword($tag->title);
        }

        OpenGraph::setTitle($employee->name . ' - ' . $settings->title);
        OpenGraph::setDescription($employee->seo_description);
        OpenGraph::setUrl(route('site.employee', $employee->slug));
        OpenGraph::addProperty('type', 'article');
        OpenGraph::addProperty('locale', 'ar-AE');
        OpenGraph::addProperty('locale:alternate', ['ar-AE']);
        OpenGraph::addImage(asset($employee->image));

        JsonLd::setTitle($employee->name . ' - ' . $settings->title);
        JsonLd::setDescription($employee->seo_description);
        JsonLd::addImage(asset($employee->image));

        JsonLd::setType('employees');

        General::seoContacts();

    }

    public static function singleProject($slug)
    {

        $project = \App\Models\Project::where('slug', $slug)->first();
        $settings = Setting::all()[0];

        SEOMeta::setTitle($project->title . ' - ' . $settings->slug);
        SEOMeta::setDescription($project->summary);
        SEOMeta::setCanonical(route('site.project', $project->slug));
        SEOMeta::addMeta('project:published_time', $project->created_at->toW3CString(), 'property');
        foreach ($project->tags as $tag) {
            SEOMeta::addKeyword($tag->title);
        }
        $images = explode(',', $project->image);


        OpenGraph::setTitle($project->title . ' - ' . $settings->title);
        OpenGraph::setDescription($project->summary);
        OpenGraph::setUrl(route('site.project', $project->slug));
        OpenGraph::addProperty('type', 'project');
        OpenGraph::addProperty('locale', 'ar-AE');
        OpenGraph::addProperty('locale:alternate', ['ar-AE']);
        foreach ($images as $key => $item) {
            OpenGraph::addImage(asset($item));
        }


        JsonLd::setTitle($project->title . ' - ' . $settings->title);
        JsonLd::setDescription($project->summary);
        foreach ($images as $key => $item) {
            JsonLd::addImage(asset($item));
        }
        JsonLd::setType('project');

        General::seoContacts();

    }

    public static function singleJob($slug)
    {

        $job = \App\Models\Job::where('slug', $slug)->first();
        $settings = Setting::all()[0];

        SEOMeta::setTitle($job->title . ' - ' . $settings->slug);
        SEOMeta::setDescription($job->description);
        SEOMeta::setCanonical(route('site.job.apply', $job->slug));
        SEOMeta::addMeta('job:published_time', $job->created_at->toW3CString(), 'property');
        SEOMeta::addMeta('job:location', $job->location, 'property');
        foreach ($job->tags as $tag) {
            SEOMeta::addKeyword($tag->title);
        }
        $images = explode(',', $job->image);


        OpenGraph::setTitle($job->title . ' - ' . $settings->title);
        OpenGraph::setDescription($job->description);
        OpenGraph::setUrl(route('site.job.apply', $job->slug));
        OpenGraph::addProperty('type', 'job');
        OpenGraph::addProperty('locale', 'ar-AE');
        OpenGraph::addProperty('locale:alternate', ['ar-AE']);
        foreach ($images as $key => $item) {
            OpenGraph::addImage(asset($item));
        }


        JsonLd::setTitle($job->title . ' - ' . $settings->title);
        JsonLd::setDescription($job->description);
        foreach ($images as $key => $item) {
            JsonLd::addImage(asset($item));
        }
        JsonLd::setType('job');

        General::seoContacts();

    }

    /**
     * End SEO For Single Pages
     */

    public static function dateHandler($date)
    {
        return \Carbon\Carbon::parse($date)
            ->locale(App::getLocale())->isoFormat(config('backpack.base.default_date_format'));
    }

    public static function dates_month($month, $year)
    {
        $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $dates_month = array();

        for ($i = 1; $i <= $num; $i++) {
            $mktime = mktime(0, 0, 0, $month, $i, $year);
            $date = date("d-M-Y", $mktime);
            $dates_month[$i] = $date;
        }
        return $dates_month;
    }

    public static function getServiceSlugById($id)
    {
        return $slug = \App\Models\Service::find($id)->slug;
    }

    public static function getProjectSlugById($id)
    {
        return $slug = \App\Models\Project::find($id)->slug;
    }

    public static function getPostSlugById($id)
    {
        return $slug = \App\Models\Post::find($id)->slug;
    }

}

?>
