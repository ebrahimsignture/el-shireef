<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use Sluggable,SluggableScopeHelpers;
    use HasTranslations;

    protected $fillable=['title','slug','article','summary','blogcategory_id','status','image','video','is_featured'];

    protected $translatable = ['title','article', 'summary'];

    public function category() {
        return $this->belongsTo(Blogcategory::class, 'blogcategory_id', 'id');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag','tags_posts','post_id', 'tag_id','id', 'id');
    }


    public function getImageAttribute($val) {
        if ($val !== null) {
            $val = str_ireplace('[', '', $val);
            $val = str_ireplace(']', '', $val);
            $val = str_ireplace('\\\\', '/', $val);
            $val = str_ireplace('"', '', $val);
            return $val;
        }
        return null;
    }


    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }

    public function scopeOrdered($q)
    {
        return $q->orderBy('lft', 'ASC');
    }
    public function scopeFeatured($q)
    {
        return $q->where('is_featured', 'featured');
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
