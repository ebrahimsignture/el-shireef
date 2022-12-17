<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory,
        HasTranslations;

    protected $fillable=['place','price','status'];

    protected $translatable = ['place'];

    public function scopeActive($q) {
        return $q->where('status', 'active');
    }


}
