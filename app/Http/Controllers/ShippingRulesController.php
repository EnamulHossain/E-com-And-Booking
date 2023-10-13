<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingRuleRequest;
use App\Http\Requests\ShippingRulesRequest;
use App\Models\Address;
use App\ShippingCompany;
use App\ShippingRules;
use Illuminate\Http\Request;

class ShippingRulesController extends Controller
{
    public function index()
    {
        $shippingRules = ShippingRules::all();
        return view('shippingrules.index', compact('shippingRules'));
    }

    public function create()
    {
        $shippingCompanies = ShippingCompany::all();
        $addresses = Address::all();
        return view('shippingrules.create_edit', compact('shippingCompanies', 'addresses'));
    }

    public function store(Request $request)
    {
        $shippingCompaniesIds = $request->input('shipping_companies_id', []);
        $addressIds = $request->input('address_id', []);
        $priceForLocation = $request->input('price_for_location');
        $shippingRule = new ShippingRules();
        $shippingRule->price_for_location = $priceForLocation;
        $shippingRule->save();
        $shippingRule->shippingCompanies()->attach($shippingCompaniesIds);
        $shippingRule->addresses()->attach($addressIds);
        return redirect()->route('shippingrules.index')->with('success', 'Shipping rule created successfully.');
    }

    public function edit($id)
    {
        $shippingRule = ShippingRules::findOrFail($id);
        $shippingCompanies = ShippingCompany::all();
        $addresses = Address::all();
        return view('shippingrules.create_edit', compact('shippingRule', 'shippingCompanies', 'addresses'));
    }


    public function update(Request $request, ShippingRules $shippingRule)
    {
        $shippingRule->update(['price' => $request->input('price')]);
        $shippingRule->shippingCompanies()->sync($request->input('shipping_companies_id'));
        $shippingRule->addresses()->sync($request->input('address_id'));

        return redirect()->route('shippingrules.index')
            ->with('success', 'Shipping rule updated successfully.');
    }

    public function destroy($id)
    {
        // Find the shipping rule by its ID
        $shippingRule = ShippingRules::find($id);

        if (!$shippingRule) {
            return redirect()->route('shippingrules.index')->with('error', 'Shipping rule not found.');
        }

        // Delete the shipping rule
        $shippingRule->delete();

        return redirect()->route('shippingrules.index')->with('success', 'Shipping rule deleted successfully.');
    }
}
