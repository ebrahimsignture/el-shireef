<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfoPill extends Model
{
    use HasFactory;
    protected $table = "ship_pill_info";

    protected $fillable = ['user_id', 'first_name','last_name', 'phone', 'email', 'shipping_id', 'state', 'address1'];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function shipping() {
        return $this->belongsTo('App\Models\Shipping', 'shipping_id', 'id');
    }

}
