<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;

class Service extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use Sluggable,SluggableScopeHelpers;
    use HasTranslations;

    protected $fillable=['title','slug','description','short_des','servicecategory_id','status','image','is_featured'];

    protected $translatable = ['title','description', 'short_des'];

    public function category() {
        return $this->belongsTo(Servicecategory::class, 'servicecategory_id', 'id');
    }

    public function tags(){
        return $this->belongsToMany('App\Models\Tag','tags_services','service_id', 'tag_id','id', 'id');
    }

    public function orders() {
        return $this->belongsToMany(Order::class, 'orders_services', 'service_id', 'order_id');
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
                'source' => 'title'
            ]
        ];
    }

}
