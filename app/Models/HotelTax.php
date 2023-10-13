<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class HotelTax extends Pivot
{
    public $table = 'hotel_taxes';
    public $timestamps = false;
}
