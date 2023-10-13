<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use kamruljpi\admintemplate\controllers\ProjectBaseController;

class Tags extends ProjectBaseController
{
	public function __construct() {
		$this->modelName = 'App\Models\Tag';
		$this->formView = 'admintemplate::tags.create';
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
