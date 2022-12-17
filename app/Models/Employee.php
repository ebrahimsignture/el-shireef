<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use Sluggable,SluggableScopeHelpers;
    use HasTranslations;

    protected $fillable=['name','slug','job_title','image','description','seo_description','status','is_featured','fb_url','twitter_url','instagram_url','behance_url','whatsapp_url','youtube_url', 'linked_url', 'parent_id', 'lft', 'rgt','depth'];

    protected $translatable = ['name','job_title','description'];


    public function tags(){
        return $this->belongsToMany('App\Models\Tag','tags_employees','employee_id', 'tag_id','id', 'id');
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
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
