<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable=['image','status','is_featured'];

//    protected $translatable = ['name','job_title','description'];

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

}
