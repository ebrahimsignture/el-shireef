<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productorder extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $table = "productorders";


    protected $fillable=['user_id','order_number','sub_total','quantity','status','total_amount','first_name','last_name','state','address1','address2','phone','email','payment_method','payment_status','shipping_id','coupon', 'notes'];



    public function cart_info(){
        return $this->hasMany('App\Models\Cart','order_id','id');
    }
    public static function getAllOrder($id){
        return Order::with('cart_info')->find($id);
    }


    public function shipping()
    {
        return $this->belongsTo('App\Models\Shipping' ,'shipping_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }


    public function getPaymentMethodAttribute($val) {
        return $val == 'cod' ? 'Cash on Delivery' : 'Paymob';
    }

}
