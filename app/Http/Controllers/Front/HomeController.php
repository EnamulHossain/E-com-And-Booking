<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\EService;
use App\Models\Slide;
use App\Models\Wishlist;
use App\Models\Order;
use App\Models\Salon;
use App\Models\Booking;
use App\Models\OrderProduct;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Room;
use App\ShippingRules;
use WebToPay;
use Auth;
use CreateProductReviewsTable;
use Illuminate\Support\Facades\DB;
use WebToPayException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use kamruljpi\admintemplate\controllers\ProjectBaseController;

class HomeController extends ProjectBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->modelName = 'App\Models\ProductCategory';
        $this->formView = 'admintemplate::productcategories.create';
        $this->pageTitle = 'Product Category';
        $this->createBtnShow = false;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($paginate = true)
    {
        $carts = Cart::where('user_id', self::getUserID())->get();
        $sliders = Slide::all();
        $newProducts = Product::orderBy('id', 'desc')->get();
        $featureProducts = Product::where('featured', 1)->get();
        $featureCategories = Category::where('featured', 1)->get();
        $recommendedServices = Eservice::where('featured', 1)->get();
        return view('front.home', compact('newProducts', 'featureProducts', 'featureCategories', 'recommendedServices', 'sliders', 'carts'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function wishlist()
    {
        $carts = Cart::where('user_id', self::getUserID())->get();
        $wishlist = Wishlist::where('user_id', self::getUserID())->get();
        return view('front.wishlist', compact('carts', 'wishlist'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function cart()
    {
        $carts = Cart::where('user_id', self::getUserID())->get();
        return view('front.cart', compact('carts'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        $userId = auth()->id();
        $carts = Cart::where('user_id', $userId)->get();
        $addresses = Address::where('user_id', $userId)->get();
        $shipping = ShippingRules::all();
        return view('front.checkout', compact('carts', 'addresses','shipping'));
    } 
    public function addressinfo($id)
    {
        log("OKKKKKK");
    }



    public function payment(Request $request)
    {
        try {
            DB::beginTransaction();
            if(! auth()->check()) {
                return redirect()->route('home.cuslogin');
            }
            $googlePay = json_decode($request['data']['paymentMethodData']['tokenizationData']['token'], true);
            $userId = auth()->user()->id;
            $order = new Order;
            $order->user_id = auth()->user()->id;
            $order->amount = $request->amount;
            $order->discount = 0;
            $order->status = 1;
            if ($order->save()) {
                $payment = new Payment();
                $payment->amount = $request->amount;
                $payment->description = "Transaction for product";
                $payment->user_id = $userId;
                $paymentMethod = PaymentMethod::where('route', 'googlepay')->first();
                if($paymentMethod) {
                    $payment->payment_method_id = $paymentMethod->id;
                }
                $payment->payment_status_id = 1;
                $payment->save();
                return response(['success' => true, 'url' => 'success']);
            } else {
                return response(['success' => 'false']);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return redirect()->back()->withError($th->getMessage());
        }
    }

    public function placeOrder(Request $request)
    {     
        if (auth()->check()) {
            $add_new_address = $request->input('add_new_address');
            if ($add_new_address) {
                $address = new Address();
                $address->address = $add_new_address;
                $address->user_id = auth()->id();
                $address->save();
            } else {
                $order = new Order();
                $order->user_id = auth()->id();
                $order->billing_email = auth()->user()->email;
                $order->billing_name = auth()->user()->name;
                $order->billing_phone = auth()->user()->phone_number;
                $order->billing_address = $request->input('address');
                $order->save();

                if($order){
                    OrderProduct::create([
                    'product_id' => $request->input('product_id'),
                    'order_id' => $order->id,
                    'quantity' => $request->input('quantity'),
                    ]);
                }
            }
        } else {
            $name = $request->input('first_name') . ' ' . $request->input('last_name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $password = $request->input('password');
            $address = $request->input('address');
            // $apartment = $request->input('apartment_suite_unit_etc_optional');
            // $town_or_city = $request->input('town_or_city');
            // $postcode_or_zip = $request->input('postcode_or_zip');
            // $state_or_county = $request->input('state_or_county');


            // Create a new user
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->phone_number = $phone;
            $user->password = bcrypt($password);
            $user->save();

            // Create an address for the user
            $user->addresses()->create([
                'address' => $address,
                'user_id' => $user->id,
            ]);

            // Log in the newly created user
            auth()->login($user);
        }
        return redirect()->back();
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        $carts = Cart::where('user_id', self::getUserID())->get();
        return view('front.contact', compact('carts'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function cuslogin()
    {
        $carts = Cart::where('user_id', self::getUserID())->get();
        return view('front.cuslogin', compact('carts'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function customerReset()
    {
        $carts = Cart::where('user_id', self::getUserID())->get();
        $token = Str::random(64);
        return view('front.customerreset', compact('carts', 'token'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function cusRegestration()
    {
        $carts = Cart::where('user_id', self::getUserID())->get();
        $token = Str::random(64);
        return view('front.cusregestration', compact('carts', 'token'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function productdetails($id = '')
    {
        $product = Product::where('id', $id)->first();
        // $productReviews = DB::table('product_reviews')->where('product_id', $id)->get();
        $productReviews = DB::table('product_reviews')
            ->join('users', 'product_reviews.user_id', '=', 'users.id')
            ->select('product_reviews.*', 'users.name as name')
            ->where('product_reviews.product_id', $id)
            ->get();
        // dd($productReviews);
        $carts = Cart::where('user_id', self::getUserID())->get();
        // $colors = ['red', 'blue', 'black']; 
        $colors = $product->colors;
        if(!empty($colors)){
            $colors = str_replace(["[", "]"], "", $colors);
            $colors = @explode(",", $colors);
            if (count($colors) > 0 ) {
                $clrs = [];
                foreach($colors as $clr){
                    $c = str_replace('"', '', $clr);
                    $clrs[] = trim($c);
                }
                $colors = $clrs;
            }
        }
       
        return view('front.productdetails', compact('carts', 'product','productReviews', 'colors'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function cusregistration()
    {
        $carts = Cart::where('user_id', self::getUserID())->get();
        return view('front.cusregistration', compact('carts'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function shop(Request $request)
    {
        $query = Product::query();
        $carts = Cart::where('user_id', self::getUserID())->get();
        $categories = ProductCategory::all();

         // Price filtering logic
            $minPrice = $request->input('min_price');
            $maxPrice = $request->input('max_price');
            if ($minPrice !== null && $maxPrice !== null) {
                $query->whereBetween('offer_price', [$minPrice, $maxPrice]);
            }

        // Category filtering logic
        $selectedCategories = $request->input('category', []);
        if (!empty($selectedCategories)) {
            $query->whereIn('category_id', $selectedCategories);
        }

        // Sorting logic
        $sortBy = $request->input('sort_by', 'position');
        if ($sortBy === 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($sortBy === 'name_desc') {
            $query->orderBy('name', 'desc');
        } elseif ($sortBy === 'price_asc') {
            $query->orderBy('offer_price', 'asc');
        } elseif ($sortBy === 'price_desc') {
            $query->orderBy('offer_price', 'desc');
        }

        // Pagination logic
        $perPage = $request->input('show_per_page', 20);
        $newProducts = $query->paginate($perPage)->appends(request()->query());
        return view('front.shop', compact('carts', 'newProducts','categories','selectedCategories','sortBy','minPrice','maxPrice'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function useraccount()
    {
        $carts = Cart::where('user_id', self::getUserID())->get();
        $address = Address::where('user_id', self::getUserID())->get();
        $wishlist = Wishlist::where('user_id', self::getUserID())->get();
        $order = Order::where('user_id', self::getUserID())->where('status', '!=', 'returned')->get();
        $returnOrder = Order::where('user_id', self::getUserID())->where('status', 'returned')->get();

        $bookings = Booking::where('user_id', self::getUserID())
                ->orderBy('created_at', 'desc')
                ->get();

        return view('front.useraccount',compact('carts', 'wishlist', 'order', 'returnOrder', 'address', 'bookings'));
    }

    public function review(Request $request) {

        $user_id = auth()->id();
        $order_id = $request->input('order_id');
        $product_id = $request->input('product_id');

        // Check if the user has already reviewed the product for the given order
        $existingReview = DB::table('product_reviews')
            ->where('user_id', $user_id)
            ->where('order_id', $order_id)
            ->where('product_id', $product_id)
            ->first();

        if ($existingReview) {
            // If a review already exists, update it
            DB::table('product_reviews')
                ->where('user_id', $user_id)
                ->where('order_id', $order_id)
                ->where('product_id', $product_id)
                ->update([
                    'review' => $request->input('review'),
                    'rate' => $request->input('rate'),
                ]);
        } else {
            // If no review exists, insert a new review
            $reviewData = [
                'review' => $request->input('review'),
                'rate' => $request->input('rate'),
                'order_id' => $order_id,
                'product_id' => $product_id,
                'user_id' => $user_id,
            ];
            DB::table('product_reviews')->insert($reviewData);
        }

        // return response()->json(['message' => 'Review stored successfully'], 201);
        return redirect()->back();
    }

    public function storewishlist(Request $request)
    {
        $wishlist = Wishlist::where('user_id', self::getUserID())->where('product_id', $request->id)->first();
        if ($wishlist == null) {
            $wishlist = new Wishlist;
            $wishlist->user_id = self::getUserID();
            $wishlist->product_id = $request->id;
            $wishlist->save();
        }
        return response()->json($wishlist);
    }

    public function storecart(Request $request)
    { 
        $products = [];
        if(self::getUserID() == 0){
            return response()->json($products);
        }
        $prd = Product::where('id', $request->id)->first();
        $cart = Cart::where('user_id', self::getUserID())->where('product_id', $request->id)->first();
        if ($cart == null) {
            $cart = new Cart;
            $cart->user_id = self::getUserID();
            $cart->new_price = $prd->offer_price;
            $cart->product_id = $request->id;
            $cart->quantity = $request->quantity;
            $cart->save();
        }
        $carts = Cart::where('user_id', self::getUserID())->get();
        if(isset($carts) && !empty($carts)) {
            $i = 0;
            foreach ($carts as $crt) {
                $products[$i]['id'] = $crt->product->id;
                $products[$i]['cart_id'] = $crt->id;
                $products[$i]['name'] = $crt->product->name;
                $products[$i]['url'] = route('home.productdetails', ['id' => $crt->product->id]);
                if (isset($crt->product->offer_price) && !empty($crt->product->offer_price)){
                    $products[$i]['price'] = $crt->product->offer_price;
                }else{
                    $products[$i]['price'] = $crt->product->price;
                }
                $products[$i]['image'] = url($crt->product->getFirstMediaUrl('image'));
                $products[$i]['checkout'] = route('home.checkout');
                $i++;
            }
        }
        return response()->json($products);
    }
    public function hotelstorecart(Request $request)
    {
        $products = [];
        if(self::getUserID() == 0){
            return response()->json($products);
        }
        $prd = Room::where('id', $request->id)->first();
        $cart = Cart::where('user_id', self::getUserID())->where('hotel_id', $request->id)->first();
        if ($cart == null) {
            $cart = new Cart;
            $cart->user_id = self::getUserID();
            $cart->new_price = $prd->offer_price;
            $cart->product_id = $request->id;
            $cart->save();
        }
        $carts = Cart::where('user_id', self::getUserID())->get();
        if(isset($carts) && !empty($carts)) {
            $i = 0;
            foreach ($carts as $crt) {
                $products[$i]['id'] = $crt->product->id;
                $products[$i]['cart_id'] = $crt->id;
                $products[$i]['name'] = $crt->product->name;
                $products[$i]['url'] = route('home.productdetails', ['id' => $crt->product->id]);
                if (isset($crt->product->offer_price) && !empty($crt->product->offer_price)){
                    $products[$i]['price'] = $crt->product->offer_price;
                }else{
                    $products[$i]['price'] = $crt->product->price;
                }
                $products[$i]['image'] = url($crt->product->getFirstMediaUrl('image'));
                $products[$i]['checkout'] = route('home.checkout');
                $i++;
            }
        }
        return response()->json($products);
    }

    // TODO: Need to change as dynamic 
    public function underconstruction()
    {
        $carts = Cart::where('user_id', self::getUserID())->get();
        return view('front.underconstruction', compact('carts'));
    }
    // TODO: Need to change as dynamic 
    public function allcategory()
    {
        $allCategories = Category::where('parent_id', 0)->orwhere('parent_id', null)->get();
        $carts = Cart::where('user_id', self::getUserID())->get();
        return view('front.allcategory', compact('carts', 'allCategories'));
    }
    // TODO: Need to change as dynamic 
    public function allservices($id = '')
    {
        $categoryName = '';
        $categoryDescription = '';
        $allServices = '';
        if ($id == '') {
            $allServices = Eservice::all();
        }else{
            $category = Category::where('id', $id)->first();
            if (isset($category->eServices)) {
                $allServices = $category->eServices;
            }
            $categoryName = $category->name;
            $categoryDescription = $category->description;
        }
        $carts = Cart::where('user_id', self::getUserID())->get();
        return view('front.allservices', compact('carts', 'allServices', 'categoryName', 'categoryDescription'));
    }
    public static function getUserID(){
        if (!Auth::check()) {
            return 0;
        }
        return auth()->user()->id;
    }
    public function removeFromCart(Request $request)
    {
        Cart::where('id', $request->id)->delete();
        $products = [];
        $carts = Cart::where('user_id', self::getUserID())->get();
        if(isset($carts) && !empty($carts)) {
            $i = 0;
            foreach ($carts as $crt) {
                $products[$i]['id'] = $crt->product->id;
                $products[$i]['cart_id'] = $crt->id;
                $products[$i]['name'] = $crt->product->name;
                $products[$i]['url'] = route('home.productdetails', ['id' => $crt->product->id]);
                if (isset($crt->product->offer_price) && !empty($crt->product->offer_price)){
                    $products[$i]['price'] = $crt->product->offer_price;
                }else{
                    $products[$i]['price'] = $crt->product->price;
                }
                $products[$i]['image'] = url($crt->product->getFirstMediaUrl('image'));
                $products[$i]['checkout'] = route('home.checkout');
                $i++;
            }
        }
        return response()->json($products);
    }
    public function removeFromWishlist(Request $request)
    {
        Wishlist::destroy($request->id);
    }

    public function servicedetails($id = '')
    {
        $service = Eservice::where('id', $id)->first();
        $carts = Cart::where('user_id', self::getUserID())->get();
        return view('front.servicedetails', compact('carts', 'service'));
    }
    
    public function storeServicecart(Request $request)
    {
        $prd = Eservice::where('id', $request->id)->first();
        $cart = Cart::where('user_id', self::getUserID())->where('product_id', $request->id)->first();
       
        if ($cart == null) {
            $cart = new Cart;
            $cart->user_id = self::getUserID();
            $cart->new_price = $prd->offer_price;
            $cart->product_id = $request->id;
            $cart->save();
        }
        return view('front.home');
    }

    public function storeCusAddress(Request $request)
    {
        $address = Address::where('user_id', self::getUserID())->first();
        
        $address = new Address;
        $address->user_id = self::getUserID();
        $address->address = $request->address;
        $address->save();
        
        return view('front.useraccount');
    }

    public function updateUserAccount(Request $request)
    {
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        
        // return view('front.useraccount');
        return redirect()->route('home.useraccount');
    }

    public function updateUserPassword(Request $request)
    {
        $user = auth()->user();
        if ($request->new_password != null && ($request->new_password == $request->confirm_password)) {
            $user->password = Hash::make($request->new_password);
        }
        $user->save();
        
        // return view('front.useraccount');
        return redirect()->route('home.useraccount');
    }
    public function singlesaloon()
    {
        $carts = Cart::where('user_id', self::getUserID())->get();
        return view('front.singlesaloon', compact('carts'));
    }
    
    public function saloon()
    {
        $carts = Cart::where('user_id', self::getUserID())->get();
        $recommendedSaloons = Salon::where('accepted', 1)->where('available', 1)->get();
        $recommendedServices = Eservice::where('featured', 1)->get();
        $featureCategories = Category::where('featured', 1)->get();
        return view('front.saloon', compact('carts', 'recommendedSaloons',  'recommendedServices', 'featureCategories'));
    }

    public function setLanguage(Request $request)
    {
        $locale = $request->lang;

        if($locale) {
            app()->setLocale($locale);
            session()->put('locale', $locale);
        }

        return back();
    }
    public function addrressdelete($id)
    {
        $address = Address::find($id);

        if (!$address) {
            return back()->with('error', 'Address not found.');
        }

        $address->delete();

        return back()->with('success', 'Address deleted successfully.');
        }
}
