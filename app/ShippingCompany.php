<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ShippingCompany extends Model
{

    protected $fillable = ['name', 'description', 'phone', 'status'];

    // public function shippingRules()
    // {
    //     return $this->hasMany(ShippingRule::class, 'shipping_companies_id');
    // }

    protected $table = 'shipping_companies';

    // Define the inverse many-to-many relationship with ShippingRules
    public function shippingRules()
    {
        return $this->belongsToMany(ShippingRules::class, 'shipping_rule_shipping_company', 'shipping_company_id', 'shipping_rule_id');
    }
}
