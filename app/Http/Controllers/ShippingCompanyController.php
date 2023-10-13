<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingCompanyRequest;
use App\ShippingCompany;
use Illuminate\Http\Request;

class ShippingCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = ShippingCompany::query();

        if (!empty($search)) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        $shippingCompanies = $query->paginate(10);

        return view('shipping.index', compact('shippingCompanies', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("shipping.create_edit");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shippingCompany = ShippingCompany::find($id);

        if (!$shippingCompany) {
            return redirect()->route('shipping.index')->with('error', 'Shipping company not found.');
        }

        return view('shipping.create_edit', compact('shippingCompany'));
    }


    public function store(ShippingCompanyRequest $request)
    {
        ShippingCompany::create($request->all());

        return redirect()->route('shipping.index')
            ->with('success', 'Shipping company created successfully.');
    }

    public function update(ShippingCompanyRequest $request, $id) // Accept the shipping company ID as a parameter
    {
        $shippingCompany = ShippingCompany::find($id); // Find the shipping company by its ID

        if (!$shippingCompany) {
            return redirect()->route('shipping.index')->with('error', 'Shipping company not found.');
        }

        $shippingCompany->update($request->all()); // Update the shipping company with the request data

        return redirect()->route('shipping.index')->with('success', 'Shipping company updated successfully.');
    }
    public function destroy($id) // Accept the shipping company ID as a parameter
    {
        $shippingCompany = ShippingCompany::find($id); // Find the shipping company by its ID

        if (!$shippingCompany) {
            return redirect()->route('shipping.index')->with('error', 'Shipping company not found.');
        }

        $shippingCompany->delete(); // Delete the shipping company

        return redirect()->route('shipping.index')->with('success', 'Shipping company deleted successfully.');
    }
}
