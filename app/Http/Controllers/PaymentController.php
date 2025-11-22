<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    public function show(Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this order');
        }

        // Check if already paid
        if ($order->payment_status === 'paid') {
            return redirect()->route('user.orders')->with('info', 'This order has already been paid');
        }

        return view('payment.index', compact('order'));
    }

    public function process(Request $request, Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this order');
        }

        // Validate payment method
        $request->validate([
            'payment_method' => 'required|in:qris,bank_transfer,e_wallet',
        ]);

        // Update order with payment method (but keep as unpaid)
        $order->update([
            'payment_method' => $request->payment_method,
        ]);

        // Redirect to waiting payment page
        return redirect()->route('payment.waiting', $order);
    }

    public function waiting(Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this order');
        }

        // Check if already paid
        if ($order->payment_status === 'paid') {
            return redirect()->route('payment.success', $order);
        }

        // Generate payment details based on method
        $paymentDetails = $this->generatePaymentDetails($order);

        return view('payment.waiting', compact('order', 'paymentDetails'));
    }

    public function checkStatus(Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this order');
        }

        // Check if already paid to prevent double stock reduction
        if ($order->payment_status === 'paid') {
            return redirect()->route('payment.success', $order);
        }

        // Simulate payment verification (in real app, this would check with payment gateway)
        // For demo, we'll just mark as paid
        $order->update([
            'payment_status' => 'paid',
            'status' => 'processing',
        ]);

        // Reduce stock for each product in the order
        foreach ($order->items as $item) {
            $product = $item->product;
            
            // Check if product still exists and has enough stock
            if ($product && $product->stock >= $item->quantity) {
                $product->decrement('stock', $item->quantity);
            }
        }

        // Clear cart after successful payment
        session()->forget('cart');

        return redirect()->route('payment.success', $order)->with('success', 'Payment verified successfully!');
    }

    private function generatePaymentDetails($order)
    {
        $details = [];

        switch ($order->payment_method) {
            case 'qris':
                $details = [
                    'type' => 'QRIS',
                    'qr_code' => 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode('QRIS_DEMO_' . $order->id),
                    'instructions' => [
                        'Open your mobile banking or e-wallet app',
                        'Select "Scan QR" or "QRIS"',
                        'Scan the QR code above',
                        'Verify the payment amount',
                        'Complete the payment',
                    ],
                ];
                break;

            case 'bank_transfer':
                $details = [
                    'type' => 'Bank Transfer',
                    'bank_name' => 'Bank Mandiri',
                    'account_number' => '1234567890' . str_pad($order->id, 6, '0', STR_PAD_LEFT),
                    'account_name' => 'SanDiv El',
                    'instructions' => [
                        'Transfer to the virtual account number above',
                        'Amount must match exactly: ' . formatRupiah($order->total_price),
                        'Payment will be verified automatically',
                        'Virtual account is valid for 24 hours',
                    ],
                ];
                break;

            case 'e_wallet':
                $details = [
                    'type' => 'E-Wallet',
                    'wallet_type' => 'GoPay / OVO / Dana',
                    'phone_number' => '0812-3456-' . str_pad($order->id, 4, '0', STR_PAD_LEFT),
                    'instructions' => [
                        'Open your e-wallet app (GoPay/OVO/Dana)',
                        'Select "Transfer" or "Send Money"',
                        'Enter the phone number above',
                        'Enter amount: ' . formatRupiah($order->total_price),
                        'Complete the transfer',
                    ],
                ];
                break;
        }

        return $details;
    }

    public function success(Order $order)
    {
        // Ensure user owns this order
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this order');
        }

        return view('payment.success', compact('order'));
    }
}
