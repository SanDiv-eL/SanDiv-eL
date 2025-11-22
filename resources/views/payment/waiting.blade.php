<x-app-layout>
    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Payment Status Header -->
                <div class="p-4 sm:p-6 bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0">
                        <div>
                            <h3 class="text-base sm:text-lg font-semibold">Menunggu Pembayaran</h3>
                            <p class="text-xs sm:text-sm text-indigo-100 mt-1">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div class="text-left sm:text-right">
                            <p class="text-xs sm:text-sm text-indigo-100">Total Pembayaran</p>
                            <p class="text-xl sm:text-2xl font-bold">{{ formatRupiah($order->total_price) }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 sm:p-8">
                    <!-- Payment Method Badge -->
                    <div class="mb-6 flex items-center">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                            Metode Pembayaran: {{ $paymentDetails['type'] }}
                        </span>
                    </div>

                    <!-- Payment Instructions based on method -->
                    @if($order->payment_method === 'qris')
                        <!-- QRIS Payment -->
                        <div class="space-y-6">
                            <div class="text-center">
                                <h4 class="text-xl font-bold text-gray-700 border-b pb-2 mb-4">Hasil Pindaian QRIS Dinamis</h4>
                                
                                <!-- Dynamic QRIS Badge -->
                                <div class="mb-4 inline-flex items-center px-4 py-2 rounded-full bg-green-100 border border-green-200">
                                    <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-green-800">QRIS Dynamic - Nominal Otomatis Terisi</span>
                                </div>
                            </div>

                            <!-- Grid Layout: QR Code + Details -->
                            <div class="grid md:grid-cols-2 gap-6 items-center">
                                <!-- QR Code Canvas -->
                                <div class="flex justify-center">
                                    <div class="inline-block p-4 bg-white border-4 border-gray-200 rounded-2xl shadow-lg">
                                        <canvas id="qris-canvas" class="max-w-full"></canvas>
                                    </div>
                                </div>

                                <!-- Payment Details -->
                                <div class="space-y-3 bg-gray-50 p-6 rounded-xl">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Nama Merchant</p>
                                        <p class="text-lg font-semibold text-gray-800 break-words">{{ $paymentDetails['merchant_name'] ?? 'QRIS Merchant' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Nominal Transaksi</p>
                                        <p class="text-2xl font-bold text-indigo-600">{{ formatRupiah($order->total_price) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Kota Merchant</p>
                                        <p class="text-lg font-semibold text-gray-800">{{ $paymentDetails['merchant_city'] ?? '-' }}</p>
                                    </div>
                                    <div class="pt-2 border-t border-gray-200">
                                        <p class="text-sm font-medium text-gray-500">Order ID</p>
                                        <p class="text-base font-mono font-semibold text-gray-800">{{ $paymentDetails['order_id'] ?? 'ORDER-' . $order->id }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Text -->
                            <div class="text-center">
                                <p class="text-sm text-gray-600">
                                    <strong class="text-green-600">✓</strong> Nominal sudah otomatis terisi saat scan<br>
                                    <span class="text-xs text-gray-500">Pindai dengan aplikasi e-wallet: GoPay, OVO, Dana, ShopeePay, LinkAja, dll.</span>
                                </p>
                            </div>
                        </div>

                        <!-- QR Code Generation Script -->
                        <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
                        <script>
                            // Generate QR Code on page load
                            document.addEventListener('DOMContentLoaded', function() {
                                const qrisData = "{{ $paymentDetails['qris_data'] ?? '' }}";
                                const canvas = document.getElementById('qris-canvas');
                                
                                if (qrisData && canvas) {
                                    const qrOptions = {
                                        width: 280,
                                        height: 280,
                                        margin: 2,
                                        errorCorrectionLevel: 'H',
                                        color: {
                                            dark: '#000000',
                                            light: '#FFFFFF'
                                        }
                                    };
                                    
                                    QRCode.toCanvas(canvas, qrisData, qrOptions, function (error) {
                                        if (error) {
                                            console.error('QR Code generation error:', error);
                                            canvas.parentElement.innerHTML = '<p class="text-red-500 text-sm">Error generating QR code</p>';
                                        }
                                    });
                                }
                            });
                        </script>

                    @elseif($order->payment_method === 'bank_transfer')
                        <!-- Bank Transfer Payment -->
                        <div class="mb-8">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Transfer ke Virtual Account</h4>
                            <div class="bg-gray-50 rounded-xl p-6 space-y-4">
                                <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                    <span class="text-sm text-gray-600">Bank</span>
                                    <span class="text-base font-semibold text-gray-900">{{ $paymentDetails['bank_name'] }}</span>
                                </div>
                                <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                    <span class="text-sm text-gray-600">Nomor Virtual Account</span>
                                    <div class="text-right">
                                        <span class="text-lg font-mono font-bold text-gray-900">{{ $paymentDetails['account_number'] }}</span>
                                        <button onclick="copyToClipboard('{{ $paymentDetails['account_number'] }}')" class="ml-2 text-indigo-600 hover:text-indigo-700">
                                            <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Nama Akun</span>
                                    <span class="text-base font-semibold text-gray-900">{{ $paymentDetails['account_name'] }}</span>
                                </div>
                            </div>
                        </div>

                    @elseif($order->payment_method === 'e_wallet')
                        <!-- E-Wallet Payment -->
                        <div class="mb-8">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Transfer ke E-Wallet</h4>
                            <div class="bg-gray-50 rounded-xl p-6 space-y-4">
                                <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                                    <span class="text-sm text-gray-600">E-Wallet</span>
                                    <span class="text-base font-semibold text-gray-900">{{ $paymentDetails['wallet_type'] }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Nomor Telepon</span>
                                    <div class="text-right">
                                        <span class="text-lg font-mono font-bold text-gray-900">{{ $paymentDetails['phone_number'] }}</span>
                                        <button onclick="copyToClipboard('{{ $paymentDetails['phone_number'] }}')" class="ml-2 text-indigo-600 hover:text-indigo-700">
                                            <svg class="w-4 h-4 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Instructions -->
                    <div class="mb-8">
                        <h4 class="text-base font-semibold text-gray-900 mb-3">Instruksi Pembayaran</h4>
                        <ol class="space-y-2">
                            @foreach($paymentDetails['instructions'] as $index => $instruction)
                                <li class="flex items-start">
                                    <span class="flex-shrink-0 w-6 h-6 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center text-xs font-semibold mr-3">{{ $index + 1 }}</span>
                                    <span class="text-sm text-gray-600">{{ $instruction }}</span>
                                </li>
                            @endforeach
                        </ol>
                    </div>

                    <!-- Check Payment Status Button -->
                    <form action="{{ route('payment.checkStatus', $order) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-150 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Saya Sudah Menyelesaikan Pembayaran - Cek Status
                        </button>
                    </form>

                    <p class="text-xs text-gray-500 text-center mt-4">
                        Klik tombol di atas setelah Anda menyelesaikan pembayaran
                    </p>
                </div>

                <!-- Warning Box -->
                <div class="bg-yellow-50 border-t border-yellow-100 p-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                <strong>Penting:</strong> Harap selesaikan pembayaran dalam waktu 24 jam. Detail pembayaran akan kedaluwarsa setelah itu.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed top-4 right-4 z-50 transform translate-x-full transition-transform duration-300 ease-in-out">
        <div class="bg-white rounded-lg shadow-xl border border-gray-200 p-4 flex items-center space-x-3 min-w-[300px]">
            <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium text-gray-900" id="toast-message">Disalin ke clipboard!</p>
            </div>
            <button onclick="hideToast()" class="flex-shrink-0 text-gray-400 hover:text-gray-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>

    <script>
        function showToast(message) {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toast-message');
            toastMessage.textContent = message;
            
            // Show toast
            toast.classList.remove('translate-x-full');
            toast.classList.add('translate-x-0');
            
            // Auto hide after 3 seconds
            setTimeout(() => {
                hideToast();
            }, 3000);
        }

        function hideToast() {
            const toast = document.getElementById('toast');
            toast.classList.remove('translate-x-0');
            toast.classList.add('translate-x-full');
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                showToast('Disalin ke clipboard!');
            }, function(err) {
                console.error('Could not copy text: ', err);
                showToast('Gagal menyalin');
            });
        }
    </script>
</x-app-layout>
