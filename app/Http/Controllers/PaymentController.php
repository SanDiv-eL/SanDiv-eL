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

        return redirect()->route('payment.success', $order)->with('success', 'Pembayaran berhasil diverifikasi!');
    }

    private function generatePaymentDetails($order)
    {
        $details = [];

        switch ($order->payment_method) {
            case 'qris':
                // Get static QRIS from environment
                $staticQRIS = env('QRIS_STATIC_DATA');
                
                // Fallback to hardcoded QRIS if not in environment
                if (empty($staticQRIS)) {
                    $staticQRIS = 'XXXXXXXXXXXXXXXX';
                }
                
                // Generate dynamic QRIS with transaction amount and order ID
                $dynamicQRIS = \App\Helpers\QRISHelper::generateDynamicQRIS(
                    $staticQRIS,
                    $order->total_price,
                    'ORDER-' . $order->id
                );
                
                // Get merchant info for display
                $merchantInfo = \App\Helpers\QRISHelper::getMerchantInfo($staticQRIS);
                
                $details = [
                    'type' => 'QRIS',
                    'qris_data' => $dynamicQRIS, // Raw QRIS string for client-side generation
                    'merchant_name' => $merchantInfo['merchant_name'],
                    'merchant_city' => $merchantInfo['merchant_city'],
                    'amount' => formatRupiah($order->total_price),
                    'order_id' => 'ORDER-' . $order->id,
                    'instructions' => [
                        'Buka aplikasi mobile banking atau e-wallet Anda',
                        'Pilih "Scan QR" atau "QRIS"',
                        'Pindai kode QR di atas',
                        'Nominal pembayaran sudah otomatis terisi: ' . formatRupiah($order->total_price),
                        'Verifikasi dan selesaikan pembayaran',
                    ],
                ];
                break;

            case 'bank_transfer':
                $details = [
                    'type' => 'Transfer Bank',
                    'bank_name' => 'Bank Mandiri',
                    'account_number' => '1234567890' . str_pad($order->id, 6, '0', STR_PAD_LEFT),
                    'account_name' => 'SanDiv.ID',
                    'instructions' => [
                        'Transfer ke nomor virtual account di atas',
                        'Jumlah harus sama persis: ' . formatRupiah($order->total_price),
                        'Pembayaran akan diverifikasi secara otomatis',
                        'Virtual account berlaku selama 24 jam',
                    ],
                ];
                break;

            case 'e_wallet':
                $details = [
                    'type' => 'E-Wallet',
                    'wallet_type' => 'GoPay / OVO / Dana',
                    'phone_number' => '0812-3456-' . str_pad($order->id, 4, '0', STR_PAD_LEFT),
                    'instructions' => [
                        'Buka aplikasi e-wallet Anda (GoPay/OVO/Dana)',
                        'Pilih "Transfer" atau "Kirim Uang"',
                        'Masukkan nomor telepon di atas',
                        'Masukkan jumlah: ' . formatRupiah($order->total_price),
                        'Selesaikan transfer',
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
