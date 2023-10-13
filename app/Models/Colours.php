<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colours extends Model
{
    protected $table = 'colors';

    protected $fillable = ['color'];

    public static function GetObj()
    {
        return new Colours();
    }
}