<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use kamruljpi\admintemplate\controllers\ProjectBaseController;

class ProductCategories extends ProjectBaseController
{
	public function __construct() {
		$this->modelName = 'App\Models\ProductCategory';
		$this->formView = 'admintemplate::productcategories.create';
		$this->pageTitle = __('lang.product_category');
		$this->createBtnShow = false;
	}

	public function getValidation($table = null) {
        $validate = [
        	'name' => 'required:'.$table,
        	'slug' => 'required|unique:'.$table,
        ];
        if(isset($_POST['id']) && !empty($_POST['id'])) {
        	$validate['slug'] = 'required|unique:'.$table.',slug,'.$_POST['id'];
        }
        return $validate;
    }
}
