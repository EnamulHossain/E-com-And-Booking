<?php

namespace App;

use App\Models\Address;
use Illuminate\Database\Eloquent\Model;

class ShippingRules extends Model
{
    protected $fillable = ['shipping_companies_id', 'address_id', 'price_for_location'];

    // protected $casts = [
    //     'shipping_companies_id' => 'array',
    //     'address_id' => 'array',
    // ];

    protected $table = 'shipping_rules';

    // Define the many-to-many relationship with ShippingCompany
    public function shippingCompanies()
    {
        return $this->belongsToMany(ShippingCompany::class, 'shipping_rule_shipping_company', 'shipping_rule_id', 'shipping_company_id');
    }

    // Define the many-to-many relationship with Address
    public function addresses()
    {
        return $this->belongsToMany(Address::class, 'shipping_rule_address', 'shipping_rule_id', 'address_id');
    }
}
