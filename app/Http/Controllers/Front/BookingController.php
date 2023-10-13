<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EService;
use App\Models\Salon;
use App\Models\Cart;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    protected $data = [];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $this->data['booking'] = Booking::with('bookingStatus')
                ->where('user_id', optional(auth()->user())->id ?? 0)
                ->findOrFail($id);
        $this->data['carts'] = Cart::where('user_id', optional(auth()->user())->id ?? 0)->get();

        return view('front.booking.show', $this->data);
    }

    public function review() {
        dd('OK');
    }
}