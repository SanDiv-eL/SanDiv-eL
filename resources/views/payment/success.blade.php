<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight">
            {{ __('Payment Successful') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Success Icon -->
                <div class="p-6 sm:p-8 text-center border-b border-gray-100">
                    <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-green-100 mb-3 sm:mb-4">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-2">Payment Successful!</h3>
                    <p class="text-sm sm:text-base text-gray-600">Your order has been confirmed and is being processed.</p>
                </div>

                <!-- Order Details -->
                <div class="p-4 sm:p-8">
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Order Details</h4>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Order Number</span>
                                <span class="text-sm font-medium text-gray-900">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Order Date</span>
                                <span class="text-sm font-medium text-gray-900">{{ $order->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Payment Method</span>
                                <span class="text-sm font-medium text-gray-900">
                                    @if($order->payment_method === 'qris')
                                        QRIS
                                    @elseif($order->payment_method === 'bank_transfer')
                                        Bank Transfer
                                    @elseif($order->payment_method === 'e_wallet')
                                        E-Wallet
                                    @else
                                        -
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Payment Status</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Paid
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Order Status</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Processing
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Items -->
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Items Ordered</h4>
                        <div class="space-y-3">
                            @foreach($order->items as $item)
                                <div class="flex justify-between items-center py-3 border-b border-gray-200 last:border-0">
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $item->product->name }}</p>
                                        <p class="text-xs text-gray-500">Quantity: {{ $item->quantity }}</p>
                                    </div>
                                    <p class="text-sm font-medium text-gray-900">{{ formatRupiah($item->price * $item->quantity) }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="border-t border-gray-200 pt-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-base font-semibold text-gray-900">Total Paid</span>
                            <span class="text-2xl font-bold text-indigo-600">{{ formatRupiah($order->total_price) }}</span>
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <div class="mb-8">
                        <h4 class="text-sm font-semibold text-gray-900 mb-2">Shipping Address</h4>
                        <p class="text-sm text-gray-600">{{ $order->shipping_address }}</p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('user.orders') }}" class="flex-1 inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-150 shadow-md hover:shadow-lg">
                            View My Orders
                        </a>
                        <a href="{{ route('products.index') }}" class="flex-1 inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-150">
                            Continue Shopping
                        </a>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50 border-t border-blue-100 p-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-blue-700">
                                A confirmation email has been sent to your registered email address. You can track your order status in "My Orders" section.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
