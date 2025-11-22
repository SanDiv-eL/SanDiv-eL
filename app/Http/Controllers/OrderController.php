<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if(empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }
        
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
        ]);

        $cart = session()->get('cart');
        if(!$cart) {
            return redirect()->back()->with('error', 'Cart is empty');
        }

        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Combine address fields
        $shippingAddress = $request->address . ', ' . $request->city . ', ' . $request->state . ' ' . $request->zip;

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $total,
            'shipping_address' => $shippingAddress,
            'status' => 'pending',
            'payment_status' => 'unpaid'
        ]);

        foreach($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        session()->forget('cart');

        return redirect()->route('payment.show', $order)->with('success', 'Order created! Please complete payment.');
    }
}
