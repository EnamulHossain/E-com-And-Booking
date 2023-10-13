<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EService;
use App\Models\Salon;
use App\Models\Cart;
use App\Models\Booking;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $data = [];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $this->data['order'] = Order::where('user_id', optional(auth()->user())->id ?? 0)
                ->findOrFail($id);
        $this->data['carts'] = Cart::where('user_id', optional(auth()->user())->id ?? 0)->get();

        return view('front.order.show', $this->data);
    }
    
    public function return($id)
    {
        // Find the order by ID
        $order = Order::find($id);

        if ($order) {
            // Update the status to "returned"
            $order->status = 'returned';
            $order->save();

            // You can add any additional logic here if needed.

            // Redirect back to the page (or any other appropriate action)
            return redirect()->back()->with('success', 'Order returned successfully!');
        } else {
            // If the order with the given ID is not found, handle the error appropriately
            return redirect()->back()->with('error', 'Order not found.');
        }
    }

    public function returnshow($id)
    {
        $this->data['order'] = Order::where('user_id', optional(auth()->user())->id ?? 0)
                ->findOrFail($id);
        $this->data['carts'] = Cart::where('user_id', optional(auth()->user())->id ?? 0)->get();

        return view('front.order.return', $this->data);
    }
}