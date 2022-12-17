<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;



class Productcategory extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use Sluggable, SluggableScopeHelpers;
    use HasTranslations;

    protected $fillable = ['title', 'slug','description', 'summary', 'is_featured', 'image', 'status','is_parent', 'parent_id', 'added_by'];

    protected  $translatable = ['title', 'summary', 'description'];

    public $timestamps = true;
    public function scopeSelection($q) {
        return $q->select(['title','slug','description','summary','parent_id','image','status']);
    }
    public function scopeActive($q) {
        return $q->where('status', 'active');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }




    // Get All Categories Main and Sub
    public static function getAllCategory()
    {
        return Productcategory::orderBy('id', 'DESC')->get();
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'cat_id', 'id')->where('status', 'active');
    }

    public static function getProductByCat($slug)
    {
        return Productcategory::with('products')->where('slug', $slug)->first();
    }



}
