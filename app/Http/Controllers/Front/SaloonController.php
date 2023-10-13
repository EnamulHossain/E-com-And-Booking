<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\EService;
use App\Models\Salon;
use App\Models\Cart;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\AvailabilityHour;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use App\Models\Address;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Repositories\BookingRepository;
use App\Repositories\SalonRepository;
use App\Repositories\BookingStatusRepository;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewBooking;
use App\Transaction;

class SaloonController extends Controller
{
    private $bookingRepository;

    private $salonRepository;

    private $bookingStatusRepository;
    
    protected $model;

    protected $data = [];

    protected $basePath = "front.saloon";

    public function __construct(BookingRepository $bookingRepo, SalonRepository $salonRepository, BookingStatusRepository $bookingStatusRepo)
    {
        $this->model = new Salon();

        $this->bookingRepository = $bookingRepo;
        $this->salonRepository = $salonRepository;
        $this->bookingStatusRepository = $bookingStatusRepo;
    }

    public function index($paginate = true)
    {
        $this->data['carts'] = Cart::where('user_id', optional(auth()->user())->id ?? 0)->get();

        $this->data['recommendedSaloons'] = $this->model->where('accepted', 1)
            ->with('salonReviews')->where('available', 1)->get();

        $this->data['recommendedServices'] = Eservice::where('featured', 1)->get();

        $this->data['featureCategories'] = Category::where('featured', 1)->get();

        return view("{$this->basePath}.index", $this->data);
    }

    public function all()
    {
        $this->data['carts'] = Cart::where('user_id', optional(auth()->user())->id ?? 0)->get();

        $this->data['allsaloon'] = $this->model->where('accepted', 1)
            ->with('salonReviews')->where('available', 1)->get();

        return view("{$this->basePath}.allsaloon", $this->data);
    }

    public function show($id)
    {
        $this->data['carts'] = Cart::where('user_id', (optional(auth()->user())->id ?? 0))->get();

        $this->data['saloon'] = $this->model->where('accepted', 1)
                                    ->with(["address", 'galleries',
                                        'eServices' => function($query) {
                                            $query->where('enable_booking', 1);
                                        }])
                                    ->where('available', 1)
                                    ->where('id', $id)
                                    ->first();
        // $dates = $this->getBetweenDates('2022-07-01', '2022-07-09');
        $salonreview = DB::table('salon_reviews')
        ->join('users', 'salon_reviews.user_id', '=', 'users.id')
        ->select('salon_reviews.id', 'salon_reviews.review', 'salon_reviews.rate', 'salon_reviews.booking_id',
            'salon_reviews.salon_id', 'salon_reviews.user_id', 'users.name as name')
        ->where('salon_reviews.salon_id', $id)
        ->get();
        $this->data['salonreview'] = $salonreview;
        return view("{$this->basePath}.show", $this->data);
    }

    public function serviceDetails(Request $request, $id)
    {
        $this->data['avaibleDates'] = [];
        $this->data['dates'] = [];
        // $this->data['picture'] = Eservice::where('id', $id)->get();
        $this->data['carts'] = Cart::where('user_id', optional(auth()->user())->id ?? 0)->get();
        $this->data['service'] = Eservice::with('salon.availabilityHours')->where('id', $id)->first();

        if(isset($this->data['service']['salon']['availabilityHours'])) {
            $availabilityHours = $this->data['service']['salon']['availabilityHours'];

            // print_r("<pre>");
            // print_r($availabilityHours->toArray());die();

            foreach ($availabilityHours as $key => $value) {
                $this->data['avaibleDates']['weekDay'][] = $value->day;
                $this->data['avaibleDates']['times'][$value->day][] = $value->start_at;
            }
        }

        $period = CarbonPeriod::create(now()->format('Y-m-d'), now()->format('Y').'-12-31');

        foreach ($period as $date) {
            $this->data['dates'][] = [
                'date' => $date->format('Y-m-d'),
                'weekDay' => strtolower($date->format('l')),
                'day' => $date->format('d'),
            ];
        }
        return view("front.service.show", $this->data);
    }

    public function checkout(Request $request, $id)
    {
        $this->data['carts'] = Cart::where('user_id', optional(auth()->user())->id ?? 0)->get();

        $this->data['service'] = Eservice::with('salon.availabilityHours')
                ->where('id', $id)->first();

        $this->data['booking_at'] = $request->booking_date ." ". $request->booking_time;

        $this->data['salon_id'] = $this->data['service']->salon_id;

        // $this->data['paymentMethods'] = PaymentMethod::where('enabled', 1)->get();

        return view("front.service.checkout", $this->data);
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
            $salon = $this->salonRepository->find($input['salon_id']);
            $input['address'] = $salon->address;
            $taxes = $salon->taxes;
            $input['salon'] = $salon;
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
                Notification::send($salon->users, new NewBooking($booking));

                DB::commit();
                return response(['success' => true, 'url' => route('home.useraccount')]);
            }

            return redirect()->route('home.useraccount')->withSuccess('Sucessfully booked salon.');
            
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return redirect()->back()->withError($th->getMessage());
        }
    }
}
