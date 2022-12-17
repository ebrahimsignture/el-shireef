<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory,HasTranslations;

    protected $fillable=['title','type','short_des','location','description','image','privacy','address','phone','email','logo','about_us_image','facebook','twitter','linkedin','behance','instagram','whatsapp'];

    protected $translatable = ['title','description','short_des','type', 'privacy', 'address'];

    public function tags(){
        return $this->belongsToMany('App\Models\Tag','tags_settings','setting_id', 'tag_id','id', 'id');
    }

//    protected $translatable = ['short_des','description','address','type'];
}
