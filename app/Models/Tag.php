<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    public $fillable = [
        'name',
        'slug',
    ];
    public function products() {
        return $this->belongsToMany('App\Product');
    }
}