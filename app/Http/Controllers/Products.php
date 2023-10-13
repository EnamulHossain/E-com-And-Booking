<?php

namespace App\Http\Controllers;

use App\Colors;
use App\Models\Category;
use App\Models\Colours;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\Tag;
use Illuminate\Http\Request;
use kamruljpi\admintemplate\controllers\ProjectBaseController;
use App\Repositories\ProductRepository;
use App\Repositories\UploadRepository;
class Products extends ProjectBaseController
{
	private $productRepository;
    private $uploadRepository;
	public function __construct(ProductRepository $productRepository, UploadRepository $uploadRepository) {
		$this->modelName = 'App\Models\Product';
		$this->listView = 'products.list';
		$this->formView = 'admintemplate::products.create';
		$this->pageTitle = 'product';
		$this->createBtnShow = false;
		$this->productRepository = $productRepository;
        $this->uploadRepository = $uploadRepository;
		$this->tableLists = array(
			'id' => array(
				'title' => 'id',
				'align' => 'center',
				'class' => 'fixed-width-xs',
			),
			'name' => array(
				'title' => 'product_name',
			),
			'slug' => array(
				'title' => 'slug',
				'align' => 'center',
				'class' => 'fixed-width-xs',
			),
			'details' => array(
				'title' => 'details',
				'align' => 'center',
				'class' => 'fixed-width-xs',
			),
			'price' => array(
				'title' => 'price',
				'align' => 'center',
				'class' => 'fixed-width-xs',
			),
			'featured' => array(
				'title' => 'featured',
				'align' => 'center',
				'class' => 'fixed-width-xs',
			),
			'productcategory!name' => array(
				'title' => 'category_name',
				'align' => 'center',
				'class' => 'fixed-width-xs',
			),
			'offer_price' => array(
				'title' => 'offer_price',
				'align' => 'center',
				'class' => 'fixed-width-xs',
			),
			'offer_start' => array(
				'title' => 'offer_start',
				'align' => 'center',
				'class' => 'fixed-width-xs',
			),
			'offer_end' => array(
				'title' => 'offer_end',
				'align' => 'center',
				'class' => 'fixed-width-xs',
			),
		);
	}

	public function index($paginate = true){
    	$this->init();
        $dataLists = $this->modelObj;
        if(isset($this->withJoin) && count($this->withJoin) > 0) {
            foreach($this->withJoin as $wj) {
                $dataLists = $dataLists->with($wj);
            }
            if($paginate) {
                if(method_exists($this, "pre{$this->modelClassName}list")){
                    $dataLists = $this->{"pre{$this->modelClassName}list"}(['request' => $_GET, 'modelObj'=>$dataLists]);
                }
                $dataLists = $dataLists->paginate($this->postPerPage);
            }else{
                if(method_exists($this, "pre{$this->modelClassName}list")){
                    $dataLists = $this->{"pre{$this->modelClassName}list"}(['request' => $_GET, 'modelObj'=>$dataLists]);
                }
                $dataLists = $dataLists->get();
            }
        }else{
            if($paginate) {
                if(method_exists($this, "pre{$this->modelClassName}list")){
                    $dataLists = $this->{"pre{$this->modelClassName}list"}(['request' => $_GET, 'modelObj'=>$dataLists]);
                }
                $dataLists = $dataLists->paginate($this->postPerPage);
            }else{
                if(method_exists($this, "pre{$this->modelClassName}list")){
                    $dataLists = $this->{"pre{$this->modelClassName}list"}(['request' => $_GET, 'modelObj'=>$dataLists]);
                }
                $dataLists = $dataLists->get();
            }
        }
        if($this->isAjax){
            if(isset($dataLists) && !empty($dataLists)){
                return $this->getApiResponse(200, $dataLists, 'success');
            }else{
                return $this->getApiResponse(301, [], 'error');
            }
        }else{
            if(isset($dataLists) && !empty($dataLists) && count($dataLists) > 0){
                foreach ($dataLists as &$value) {
                    if(isset($value->{$this->statusKey})){
                        $value->{$this->statusKey} = $this->statusHtml($value->{$this->primaryKey},$value->{$this->statusKey});
                    }
                }
            }

			$category = Category::all();

            return view($this->baseView.$this->listView, [
                'createBtnShow' => $this->createBtnShow,
                'editBtnShow' => $this->editBtnShow,
                'deleteBtnShow' => $this->deleteBtnShow,
                'tableLists' => $this->tableLists,
                'isFillable' => $this->isFillable,
                'btnLists' => $this->btnLists,
                'pageTitle' => $this->pageTitle,
                'perRowbtnLists' => $this->perRowbtnLists,
                'fillableLists' => $this->fillableLists,
                'primaryKey' => $this->primaryKey,
                'extraBtns' => $this->extraBtns,
                'createRoute' => $this->createRoute,
                'listRoute' => $this->listRoute,
                'editRoute' => $this->editRoute,
                'deleteRoute' => $this->deleteRoute,
                'statusRoute' => $this->statusRoute,
                'dataTable' => $this->dataTable,
                'modelClassName' => $this->modelClassName,
                'details' => $dataLists,
                'category' => $category,
            ]);
        }
    }
	
	public function getValidation($table = null) {
        $validate = [
        	'name' => 'required:'.$table,
        	'slug' => 'required|unique:'.$table,
        	'details' => 'required:'.$table,
        	'price' => 'required:'.$table,
        	// 'image' => 'required:'.$table,
        	// 'images' => 'required:'.$table,
        	'featured' => 'required:'.$table,
        	'quantity' => 'required:'.$table,
        	'category_id' => 'required|exists:categories,id',
        	'description' => 'required:'.$table,
        ];
        if(isset($_POST['id']) && !empty($_POST['id'])) {
        	$validate['slug'] = 'required|unique:'.$table.',slug,'.$_POST['id'];
        }
        return $validate;
    }
	public function setTemplateData(){
		$this->templateData = [
			'product_categories' => ProductCategory::where('is_active', 1)->get(),
			'colors' => Colours::all(),
		];
	}
	
	public function postproductsave($params = null){
		$this->updateImage($params);
		$this->updateTags($params);
	}

	public function postproductupdate($params = null){
		$this->updateImage($params);
		$this->updateTags($params);
	}

	public function updateImage($params = null){
		$input = $params['request']->all();
		$product = $params['modelObj'];
		
		if(isset($input['id'])) {
			$product = $this->productRepository->findWithoutFail($input['id']);
			$product = $this->productRepository->update($input, $input['id']);
		}
		
		if (isset($input['image']) && $input['image']) {
	        $cacheUpload = $this->uploadRepository->getByUuid($input['image']);
			if(method_exists($cacheUpload, 'getMedia')) {
				$mediaItem = $cacheUpload->getMedia('image')->first();
				$mediaItem->copy($product, 'image');
			}
		}
	}

	public function updateTags($params = null){
		$input = $params['request']->all();
		$product = $params['modelObj'];
		if (!isset($product['id']) && empty($product['id'])){
			return true;
		}
		ProductTag::Where('product_id', $product['id'])->delete();
		$tag = isset($input['tags']) ? $input['tags'] : '';
		if (empty($tag)){
			return true;
		}
		$tags = explode(",", $tag);
		if(!isset($tags) && empty($tags)){
			return true;
		}
		foreach($tags as $tg) {
			$tgObj = Tag::where('name', trim($tg))->orwhere('slug', self::slugify($tg))->first();
			if($tgObj == null){
				$tgObj = new Tag();
				$tgObj->name = trim($tg);
				$tgObj->slug = self::slugify($tg);
				$tgObj->save();
			}
			if (!isset($tgObj->id) && empty($tgObj->id)){
				continue;
			}
			$prdTag = new ProductTag();
			$prdTag->product_id = $product['id'];
			$prdTag->tag_id = $tgObj->id;
			$prdTag->save();
		}
	}

	public function preproductlist($params = null){
		$request = $params['request'];
		$modelObj = $params['modelObj'];
		if(isset($request['name']) && !empty($request['name'])){
			$modelObj = $modelObj->where("name", "LIKE", "%".$request['name']."%");
		}
		
		return $modelObj;
	}
	

	/**
     * Remove Media of Product
     * @param Request $request
     */
    public function preProductsave($params){
		$req = $params['request'];
		$modelObj = $params['modelObj'];
		$color = $req->input("colors");
		$colors = json_encode($color);
		$modelObj->colors = $colors;
		return $modelObj;
	}
	
	public function preProductupdate($params){
		$req = $params['request'];
		$modelObj = $params['modelObj'];
		$color = $req->input("colors");
		$colors = json_encode($color);
		$modelObj->colors = $colors;
		return $modelObj;
	}

    public function removeMedia(Request $request)
    {
        $input = $request->all();
        $product = $this->productRepository->findWithoutFail($input['id']);
        try {
            if ($product->hasMedia($input['collection'])) {
                $product->getFirstMedia($input['collection'])->delete();
            }
        } catch (\League\Flysystem\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
        }
    }

	public static function slugify($text, string $divider = '-')
	{
		$text = preg_replace('~[^\pL\d]+~u', $divider, $text);
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		$text = preg_replace('~[^-\w]+~', '', $text);
		$text = trim($text, $divider);
		$text = preg_replace('~-+~', $divider, $text);
		$text = strtolower($text);
		if (empty($text)) {
			return 'n-a';
		}
		return $text;
	}

}
