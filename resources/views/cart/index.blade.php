<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-6 sm:gap-8">
                <!-- Cart Items -->
                <div class="lg:w-2/3">
                    <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100">
                        <div class="p-4 sm:p-6 bg-white border-b border-gray-100">
                            <h3 class="text-base sm:text-lg font-medium text-gray-900">Cart Items</h3>
                        </div>
                        <div class="p-4 sm:p-6">
                            @if(session('cart') && count(session('cart')) > 0)
                                <ul class="divide-y divide-gray-200">
                                    @foreach(session('cart') as $id => $details)
                                        <li class="py-4 sm:py-6 flex flex-col sm:flex-row">
                                            <div class="flex-shrink-0 w-20 h-20 sm:w-24 sm:h-24 border border-gray-200 rounded-md overflow-hidden mb-3 sm:mb-0">
                                                <img src="{{ $details['image'] ?? 'https://via.placeholder.com/150' }}" alt="{{ $details['name'] }}" class="w-full h-full object-center object-cover">
                                            </div>

                                            <div class="sm:ml-4 flex-1 flex flex-col">
                                                <div>
                                                    <div class="flex justify-between text-sm sm:text-base font-medium text-gray-900">
                                                        <h3 class="flex-1 pr-2">
                                                            <a href="{{ route('products.show', \App\Models\Product::find($id)->slug ?? '#') }}">{{ $details['name'] }}</a>
                                                        </h3>
                                                        <p class="ml-2 whitespace-nowrap">{{ formatRupiah($details['price']) }}</p>
                                                    </div>
                                                    <p class="mt-1 text-xs sm:text-sm text-gray-500">{{ \App\Models\Product::find($id)->category->name ?? 'Product' }}</p>
                                                </div>
                                                <div class="flex-1 flex items-end justify-between text-sm mt-3 sm:mt-0">
                                                    <div class="flex items-center border border-gray-300 rounded-md">
                                                        <button onclick="updateQuantity({{ $id }}, {{ $details['quantity'] - 1 }})" class="px-3 py-2 sm:px-3 sm:py-1 text-gray-600 hover:bg-gray-100 rounded-l-md touch-manipulation">-</button>
                                                        <span class="px-3 py-2 sm:px-3 sm:py-1 text-gray-900 font-medium border-l border-r border-gray-300 min-w-[3rem] text-center">{{ $details['quantity'] }}</span>
                                                        <button onclick="updateQuantity({{ $id }}, {{ $details['quantity'] + 1 }})" class="px-3 py-2 sm:px-3 sm:py-1 text-gray-600 hover:bg-gray-100 rounded-r-md touch-manipulation">+</button>
                                                    </div>

                                                    <div class="flex">
                                                        <button onclick="removeFromCart({{ $id }})" type="button" class="font-medium text-sm text-indigo-600 hover:text-indigo-500 transition-colors touch-manipulation py-2">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-center py-8 sm:py-12">
                                    <svg class="mx-auto h-10 w-10 sm:h-12 sm:w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Your cart is empty</h3>
                                    <p class="mt-1 text-xs sm:text-sm text-gray-500">Start adding some items to your cart.</p>
                                    <div class="mt-4 sm:mt-6">
                                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 sm:px-4 sm:py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 touch-manipulation">
                                            Browse Products
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:w-1/3">
                    <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 sticky top-24">
                        <div class="p-6 bg-gray-50 border-b border-gray-100">
                            <h3 class="text-lg font-medium text-gray-900">Order Summary</h3>
                        </div>
                        <div class="p-6">
                            @php
                                $cart = session('cart') ?? [];
                                $subtotal = array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, $cart));
                            @endphp
                            <dl class="space-y-4">
                                <div class="flex items-center justify-between">
                                    <dt class="text-sm text-gray-600">Subtotal</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ formatRupiah($subtotal) }}</dd>
                                </div>
                                <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                    <dt class="text-base font-medium text-gray-900">Order Total</dt>
                                    <dd class="text-base font-bold text-indigo-600">{{ formatRupiah($subtotal) }}</dd>
                                </div>
                            </dl>

                            <div class="mt-6">
                                <a href="{{ route('checkout.index') }}" class="w-full flex items-center justify-center px-4 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors {{ count($cart) == 0 ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                                    Proceed to Checkout
                                </a>
                            </div>
                            <div class="mt-4 text-center">
                                <a href="{{ route('products.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                    or Continue Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateQuantity(id, quantity) {
            if (quantity < 1) {
                if(confirm("Are you sure you want to remove this product?")) {
                    removeFromCart(id);
                }
                return;
            }
            $.ajax({
                url: '{{ route('cart.update') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: id, 
                    quantity: quantity
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }

        function removeFromCart(id) {
            if(confirm("Are you sure you want to remove this product?")) {
                $.ajax({
                    url: '{{ route('cart.remove') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}', 
                        id: id
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        }
    </script>
</x-app-layout>
