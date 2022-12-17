<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    use HasTranslations;

    protected $fillable=['title','description','image','type','service_id','post_id','product_id','project_id','url','status','is_featured'];

    protected $translatable = ['title','description'];

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

    public function service() {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
    public function project() {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
    public function post() {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function scopeOrdered($q)
    {
        return $q->orderBy('lft', 'ASC');
    }

}
