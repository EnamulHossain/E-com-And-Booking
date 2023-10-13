<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';

    public $fillable = [
        'name',
        'slug',
        'is_active',
    ];
    // public function products() {
    //     return $this->hasMany('App\Product');
    // }
}
