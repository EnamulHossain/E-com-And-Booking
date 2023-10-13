<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = ['user_id', 'billing_email', 'billing_name', 'billing_address', 'billing_city',
                            'billing_province', 'billing_postalcode', 'billing_phone', 'billing_name_on_card',
                            'billing_discount', 'billing_discount_code', 'billing_subtotal', 'billing_tax',
                            'billing_total', 'error'];
    public $withJoin = [
        'orderproduct',
    ];

    public function orderproduct()
    {
        return $this->belongsTo(OrderProduct::class, 'order_id');
    }
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function products() {
        // adding another field on the collection when accessing the order's products
        return $this->belongsToMany('App\Product')->withPivot('quantity');
    }
}