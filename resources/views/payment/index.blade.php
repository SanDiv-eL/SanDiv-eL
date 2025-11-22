<x-app-layout>
    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('payment.process', $order) }}" method="POST" id="paymentForm">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Payment Method Selection -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="p-4 sm:p-6 border-b border-gray-100">
                                <h3 class="text-base sm:text-lg font-semibold text-gray-900">Pilih Metode Pembayaran</h3>
                                <p class="text-xs sm:text-sm text-gray-500 mt-1">Pilih metode pembayaran yang Anda inginkan</p>
                            </div>
                            
                            <div class="p-4 sm:p-6 space-y-3 sm:space-y-4">
                                <!-- QRIS -->
                                <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-indigo-500 transition-all duration-200 group">
                                    <input type="radio" name="payment_method" value="qris" class="peer sr-only" required>
                                    <div class="flex items-center flex-1">
                                        <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-indigo-50 group-hover:bg-indigo-100 transition-colors">
                                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-semibold text-gray-900">QRIS</p>
                                            <p class="text-xs text-gray-500">Pindai kode QR dengan e-wallet apa pun</p>
                                        </div>
                                    </div>
                                    <div class="peer-checked:opacity-100 opacity-0 transition-opacity">
                                        <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute inset-0 border-2 border-indigo-600 rounded-xl peer-checked:block hidden"></div>
                                </label>

                                <!-- Bank Transfer -->
                                <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-indigo-500 transition-all duration-200 group">
                                    <input type="radio" name="payment_method" value="bank_transfer" class="peer sr-only">
                                    <div class="flex items-center flex-1">
                                        <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-indigo-50 group-hover:bg-indigo-100 transition-colors">
                                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-semibold text-gray-900">Transfer Bank</p>
                                            <p class="text-xs text-gray-500">BCA, Mandiri, BNI, BRI</p>
                                        </div>
                                    </div>
                                    <div class="peer-checked:opacity-100 opacity-0 transition-opacity">
                                        <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute inset-0 border-2 border-indigo-600 rounded-xl peer-checked:block hidden"></div>
                                </label>

                                <!-- E-Wallet -->
                                <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-xl cursor-pointer hover:border-indigo-500 transition-all duration-200 group">
                                    <input type="radio" name="payment_method" value="e_wallet" class="peer sr-only">
                                    <div class="flex items-center flex-1">
                                        <div class="flex items-center justify-center w-12 h-12 rounded-lg bg-indigo-50 group-hover:bg-indigo-100 transition-colors">
                                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-semibold text-gray-900">E-Wallet</p>
                                            <p class="text-xs text-gray-500">GoPay, OVO, Dana, ShopeePay</p>
                                        </div>
                                    </div>
                                    <div class="peer-checked:opacity-100 opacity-0 transition-opacity">
                                        <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute inset-0 border-2 border-indigo-600 rounded-xl peer-checked:block hidden"></div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
                            <div class="p-6 border-b border-gray-100">
                                <h3 class="text-lg font-semibold text-gray-900">Ringkasan Pesanan</h3>
                            </div>
                            
                            <div class="p-6">
                                <div class="space-y-3 mb-6">
                                    @foreach($order->items as $item)
                                        <div class="flex justify-between gap-3 text-sm">
                                            <div class="flex-1 min-w-0">
                                                <p class="font-medium text-gray-900 truncate">{{ $item->product->name }}</p>
                                                <p class="text-xs text-gray-500">Qty: {{ $item->quantity }}</p>
                                            </div>
                                            <p class="font-medium text-gray-900 text-right whitespace-nowrap flex-shrink-0">{{ formatRupiah($item->price * $item->quantity) }}</p>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="border-t border-gray-200 pt-4 mb-6">
                                    <div class="flex flex-col gap-2">
                                        <p class="text-sm font-semibold text-gray-600">Total</p>
                                        <p class="text-xl sm:text-2xl font-bold text-indigo-600 break-words">{{ formatRupiah($order->total_price) }}</p>
                                    </div>
                                </div>

                                <button type="submit" id="payButton" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-150 shadow-md hover:shadow-lg">
                                    <span id="buttonText">Proses Pembayaran</span>
                                    <svg id="buttonSpinner" class="hidden animate-spin ml-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </button>

                                <p class="text-xs text-gray-500 text-center mt-4">
                                    🔒 Proses pembayaran aman
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            const button = document.getElementById('payButton');
            const buttonText = document.getElementById('buttonText');
            const buttonSpinner = document.getElementById('buttonSpinner');
            
            button.disabled = true;
            button.classList.add('opacity-75', 'cursor-not-allowed');
            buttonText.textContent = 'Memproses...';
            buttonSpinner.classList.remove('hidden');
        });
    </script>
</x-app-layout>
