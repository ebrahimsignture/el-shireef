<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory,
        Sluggable,
        SluggableScopeHelpers,
        HasTranslations;

    protected $fillable = ['title', 'slug', 'status'];

    protected $translatable = ['title'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'tags_posts', 'tag_id', 'post_id', 'id', 'id');
    }
    public function setting()
    {
        return $this->belongsToMany(Setting::class, 'tags_settings', 'tag_id', 'setting_id', 'id', 'id');
    }
    public function services()
    {
        return $this->belongsToMany(Service::class, 'tags_services', 'tag_id', 'service_id', 'id', 'id');
    }
    public function projects()
    {
        return $this->belongsToMany(Service::class, 'tags_projects', 'tag_id', 'project_id', 'id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'tags_products', 'tag_id', 'product_id', 'id', 'id');
    }

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
}
