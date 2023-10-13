<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'booking_id',
        'order_id',
        'transaction_id',
        'response',
        'status',
        'amount',
        'payment_method',
    ];
}
