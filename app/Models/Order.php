<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = ['name', 'email','phone','whats_app','details','status','user_id'];


    public function services() {
        return $this->belongsToMany(Service::class, 'orders_services', 'order_id', 'service_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

//    public function getStatusAttribute($val) {
//        if ($val === '1') {
//            return 'New';
//        }
//        if ($val === '2') {
//            return 'Responded';
//        }
//        if ($val === '3') {
//            return 'Interviewed';
//        }
//        if ($val === '4') {
//            return 'in progress';
//        }
//        if ($val === '5') {
//            return 'Delivered';
//        }
//        return 'error';
//    }


}
