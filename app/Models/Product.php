<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use BinaryCats\Sku\HasSku;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

//use App\Models\Cart;
class   Product extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory,
        Sluggable, SluggableScopeHelpers,
        HasTranslations;
    use HasSku;


    protected $fillable = ['title', 'slug','cover', 'summary', 'cat_id', 'description', 'price', 'discount', 'status', 'image', 'is_featured', 'condition', 'stock','color','sku'];

    protected $translatable = ['title', 'summary', 'description', 'color'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Productcategory', 'cat_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'tags_products', 'product_id', 'tag_id', 'id', 'id');
    }

    public function getConditionAttribute($val)
    {
        if ($val === "0") {
            return 'Default';
        }
        if ($val === '1') {
            return 'New';
        }
        if ($val === '2') {
            return 'Hot';
        }
        return 'error';
    }

    public function scopeOrdered($q)
    {
        return $q->orderBy('lft', 'ASC');
    }
    public static function getAllProduct()
    {
        return Product::with(['category', 'sizes'])->orderBy('id', 'desc')->paginate(10);
    }

    public function rel_prods()
    {
        return $this->hasMany('App\Models\Product', 'cat_id', 'cat_id')->where('status', 'active')->orderBy('id', 'DESC');
    }

    public function getReview()
    {
        return $this->hasMany('App\Models\ProductReview', 'product_id', 'id')->with('user_info')->where('status', 'active')->orderBy('id', 'DESC');
    }

    public static function getMin()
    {
        return Product::where('status', 'active')->min('price');
    }

    public static function getMax()
    {
        return Product::where('status', 'active')->max('price');
    }

    // We removed getReview from with
    public static function getProductBySlug($slug)
    {
        return Product::with(['category', 'rel_prods'])->whereHas('category', function ($q) {
            $q->active();
        })->where('slug', $slug)->first();
    }

    public static function countActiveProduct()
    {
        $data = Product::where('status', 'active')->count();
        if ($data) {
            return $data;
        }
        return 0;
    }

    public function carts()
    {
        return $this->hasMany(Cart::class)->whereNotNull('order_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class)->whereNotNull('cart_id');
    }

    public function getImageAttribute($val)
    {
        if ($val !== null) {
            $val = str_ireplace('[', '', $val);
            $val = str_ireplace(']', '', $val);
            $val = str_ireplace('\\\\', '/', $val);
            $val = str_ireplace('"', '', $val);
            return $val;
        }
    }

    public function getDiscountAttribute($val)
    {
        if ($val !== null) {
            return number_format($val, 0);
        }
        return 0;
    }




}
