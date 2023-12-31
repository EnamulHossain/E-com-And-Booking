<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCoupon extends Model
{
    
    protected $table = 'product_coupons';

    public static function findByCode($code) {
        return self::where('code', $code)->first();
    }

    public function discount($total) {
        if($this->type == 'fixed') {
            return $this->value;
        } else if($this->type == 'percent') {
            return ($this->percent_off / 100) * $total;
        } else {
            return 0;
        }
    }
}