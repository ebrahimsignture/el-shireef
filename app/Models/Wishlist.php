<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['user_id', 'product_id', 'cart_id', 'price', 'amount', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public static function wishCount()
    {
        if (backpack_auth()->check())
            return Wishlist::where('user_id', backpack_auth()->user()->id)->count();
        return 0;
    }
}
