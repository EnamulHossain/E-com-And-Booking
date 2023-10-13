<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use kamruljpi\admintemplate\controllers\ProjectBaseController;

class OrderedProductsController extends ProjectBaseController
{
	public function __construct() {
		$this->modelName = 'App\Models\Order';
		$this->pageTitle = 'ordered';
		$this->createBtnShow = false;
		$this->listRoute = 'orderedproduct.index';
		$this->editBtnShow = true;
		$this->editRoute = 'orderedproduct.edit';
		$this->deleteBtnShow = false;
		$this->statusRoute = true;
	
		$this->tableLists = array(
            'id' => array(
                'title' => 'serial',
                'align' => 'center',
                'class' => 'fixed-width-xs',
            ),
            'billing_email' => array(
                'title' => 'Email',
            ),'billing_name' => array(
                'title' => 'Name',
            ),'billing_phone' => array(
                'title' => 'Phone',
            ),'billing_address' => array(
                'title' => 'address',
            ),'billing_city' => array(
                'title' => 'city',
            ),'billing_discount' => array(
                'title' => 'discount',
            ),'billing_total' => array(
                'title' => 'total',
            ),'payment_gateway' => array(
                'title' => 'payment_gatway',
            ),
        );

	}

    public function edit($id)
    { 
        $this->init();
        $orderedProduct = Order::find($id);
        // dd($orderedProduct);
        return view('OrderedProduct.edit', compact('orderedProduct'));
    }

    public function update(Request $request, $id) {  
        // dd($id);
        $this->init();
        $orderedProduct = Order::find($id);
        $orderedProduct->update([
            'status' => $request->input('status'),
        ]);
        return redirect()->route($this->listRoute)->with('success', 'Ordered product updated successfully.');
    }
}
