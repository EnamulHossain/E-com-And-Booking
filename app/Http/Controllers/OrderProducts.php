<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use Illuminate\Http\Request;
use kamruljpi\admintemplate\controllers\ProjectBaseController;

class OrderProducts extends ProjectBaseController
{
	public function __construct() {
		$this->modelName = 'App\Models\OrderProduct';
		$this->formView = 'admintemplate::orderproducts.create';
		$this->pageTitle = 'order';
		$this->createBtnShow = false;
	}
	public function getValidation($table = null) {
        $validate = [
        	'product_id' => 'required:'.$table,
        	'order_id' => 'required:'.$table,
        	'quantity' => 'required:'.$table,
        ];
        return $validate;
    }
}
