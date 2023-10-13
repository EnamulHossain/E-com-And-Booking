<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\EService;
use App\Models\Hotel;
use App\Models\Cart;
use App\Models\HotelBooking;
use App\Models\HotelRoom;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Room;
use App\Models\User;
use App\Repositories\BookingRepository;
use App\Repositories\HotelRepository;
use App\Repositories\BookingStatusRepository;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewBooking;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HotelController extends Controller
{
    private $bookingRepository;

    private $hotelRepository;

    private $bookingStatusRepository;

    protected $model;

    protected $data = [];

    protected $basePath = "front.hotel";

    public function __construct(BookingRepository $bookingRepo, HotelRepository $hotelRepository, BookingStatusRepository $bookingStatusRepo)
    {
        $this->model = new Hotel();

        $this->bookingRepository = $bookingRepo;
        $this->hotelRepository = $hotelRepository;
        $this->bookingStatusRepository = $bookingStatusRepo;
    }

    public function index($paginate = true)
    {
        $this->data['carts'] = Cart::where('user_id', optional(auth()->user())->id ?? 0)->get();

        $this->data['recommendedHotels'] = $this->model->where('accepted', 1)
            ->with('hotelReviews')->where('available', 1)->get();

        $this->data['recommendedServices'] = Eservice::where('featured', 1)->get();

        $this->data['featureCategories'] = Category::where('featured', 1)->get();
        $this->data['hotels'] = Hotel::all();
        // dd($this->data);

        return view("{$this->basePath}.index", $this->data);
    }

    public function show($id)
    {
        $this->data['carts'] = Cart::where('user_id', optional(auth()->user())->id ?? 0)->get();
        $this->data['hotel'] = Hotel::find($id);
        $this->data['hotel_rooms'] = HotelRoom::where('hotel_id', $id)->where('available', 1)->get();
        return view("{$this->basePath}.show", $this->data);
    }

    public function all(Request $request) {
        $this->data['carts'] = Cart::where('user_id', optional(auth()->user())->id ?? 0)->get();
        $this->data['hotels'] = Hotel::all();
        return view("{$this->basePath}.allhotel", $this->data);
    }
    public function serviceDetails(Request $request, $id)
    {
        // dd($request,$id);
        $this->data['avaibleDates'] = [];
        $this->data['dates'] = [];

        $this->data['carts'] = Cart::where('user_id', optional(auth()->user())->id ?? 0)->get();

        return view("front.hotel.checkout", $this->data);
    }

    public function checkout(Request $request, $id)
    {
        $this->data['carts'] = Cart::where('user_id', optional(auth()->user())->id ?? 0)->get();

        // $this->data['service'] = Eservice::with('hotel.availabilityHours')
        //     ->where('id', $id)->first();

        $this->data['booking_at'] = $request->booking_date ." ". $request->booking_time;

        $this->data['hotel_id'] = $this->data['service']->hotel_id;

        // $this->data['paymentMethods'] = PaymentMethod::where('enabled', 1)->get();

        return view("front.hotel.checkout", $this->data);
    }

    public function reserve(Request $request) {
        // dd($request);
        $userData = $request->only([
            'firstname', 'lastname', 'address', 'address1', 'city',
            'country', 'postalcode', 'email', 'cellphone', 'password'
        ]);
    
        if (!Auth::check()) {
            // User is not authenticated, create a new user
            $userData['name'] = $userData['firstname'] . ' ' . $userData['lastname'];
            $userData['phone_number'] = $userData['cellphone'];
            $userData['password'] = Hash::make($userData['password']);
    
            $user = User::create($userData);
    
            Auth::login($user);
        }
    
        // Process the reservation data
        $bookingData = [
            'quantity' => 1, 
            'booking_status_id' => 2, 
            'user_id' => Auth::user()->id,
            'booking_at' => Carbon::now(),
            // 'start_at' => 'start_at',
            // 'ends_at' => 'ends_at',
        ];
    
        DB::table('hotel_bookings')->insert($bookingData);
    
        return redirect()->back();
    }

    function getBetweenDates($startDate, $endDate) {
        $rangArray = [];

        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);

        for ($currentDate = $startDate; $currentDate <= $endDate; $currentDate += (86400)) {
            $date = date('Y-m-d', $currentDate);
            $rangArray[] = $date;
        }

        return $rangArray;
    }


    public function placeOrder(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            if(! auth()->check()) {
                return redirect()->route('home.cuslogin');
            }

            $googlePay = json_decode($request['data']['paymentMethodData']['tokenizationData']['token'], true);

            $userId = auth()->user()->id;

            $payment = new Payment();
            $payment->amount = $request->amount;
            $payment->description = "Transaction for Booking #3";
            $payment->user_id = $userId;
            $paymentMethod = PaymentMethod::where('route', 'googlepay')->first();
            if($paymentMethod) {
                $payment->payment_method_id = $paymentMethod->id;
            }
            $payment->payment_status_id = 1;
            $payment->save();



            $input = $request->all();
            $hotel = $this->hotelRepository->find($input['hotel_id']);
            $input['address'] = $hotel->address;
            $taxes = $hotel->taxes;
            $input['hotel'] = $hotel;
            $input['taxes'] = $taxes;
            $input['e_services'] = Eservice::where('id',$id)->get();
            $input['user_id'] = $userId;
            if($payment) {
                $input['payment_id'] = $payment->id;
            }

            $input['booking_status_id'] = $this->bookingStatusRepository->find(1)->id;

            $booking = $this->bookingRepository->create($input);

            if($booking) {
                $transaction = new Transaction();
                $transaction->response = json_encode($googlePay);
                $transaction->order_id = $booking->id;
                $transaction->transaction_id = $googlePay['id'] ?? "";
                $transaction->type = $request['data']['paymentMethodData']['tokenizationData']['type'] ?? 1;
                $transaction->save();
                Notification::send($hotel->users, new NewBooking($booking));

                DB::commit();
                return response(['success' => true, 'url' => route('home.useraccount')]);
            }

            // return redirect()->route('home.useraccount')->withSuccess('Sucessfully booked hotel.');

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            // return redirect()->back()->withError($th->getMessage());
        }
    }
}
