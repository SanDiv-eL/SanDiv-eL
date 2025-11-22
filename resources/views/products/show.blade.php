<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 p-4 sm:p-8">
                    <!-- Product Image -->
                    <div class="bg-gray-200 rounded-xl overflow-hidden">
                        <img src="{{ $product->image && Str::startsWith($product->image, 'http') ? $product->image : 'https://placehold.co/600x400?text=' . urlencode($product->name) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-auto object-cover"
                             onerror="this.onerror=null; this.src='https://placehold.co/600x400?text=No+Image';">
                    </div>

                    <!-- Product Details -->
                    <div class="flex flex-col">
                        <div class="flex-1">
                            <p class="text-xs sm:text-sm font-medium text-indigo-600 mb-2">
                                {{ $product->category->name ?? 'Computer' }}
                            </p>
                            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-3 sm:mb-4">{{ $product->name }}</h1>
                            <p class="text-sm sm:text-base text-gray-600 mb-4 sm:mb-6 leading-relaxed">{{ $product->description }}</p>

                            <!-- Price -->
                            <div class="mb-4 sm:mb-6">
                                <p class="text-3xl sm:text-4xl font-bold text-gray-900">{{ formatRupiah($product->price) }}</p>
                                <p class="text-xs sm:text-sm text-gray-500 mt-1">
                                    @if($product->stock > 0)
                                        <span class="text-green-600 font-medium">In Stock ({{ $product->stock }} available)</span>
                                    @else
                                        <span class="text-red-600 font-medium">Out of Stock</span>
                                    @endif
                                </p>
                            </div>

                            <!-- Specifications -->
                            @if($product->specifications)
                                <div class="mb-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Specifications</h3>
                                    <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                                        @foreach($product->specifications as $key => $value)
                                            <div class="flex justify-between py-2 border-b border-gray-200 last:border-0">
                                                <span class="text-gray-600 font-medium">{{ $key }}</span>
                                                <span class="text-gray-900">{{ $value }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Add to Cart Section -->
                        @auth
                            @if($product->stock > 0)
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    
                                    <!-- Quantity Selector -->
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                                        <div class="flex items-center space-x-2 sm:space-x-3">
                                            <button type="button" onclick="decrementQuantity()" class="inline-flex items-center justify-center w-12 h-12 sm:w-10 sm:h-10 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 hover:border-gray-400 transition-colors touch-manipulation">
                                                <svg class="w-5 h-5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                                </svg>
                                            </button>
                                            
                                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" 
                                                   class="w-20 sm:w-20 text-center border border-gray-300 rounded-lg py-3 sm:py-2 px-3 text-base sm:text-base text-gray-900 font-semibold focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                                   readonly>
                                            
                                            <button type="button" onclick="incrementQuantity()" class="inline-flex items-center justify-center w-12 h-12 sm:w-10 sm:h-10 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 hover:border-gray-400 transition-colors touch-manipulation">
                                                <svg class="w-5 h-5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                </svg>
                                            </button>
                                            
                                            <span class="text-xs sm:text-sm text-gray-500 ml-2">
                                                (Max: {{ $product->stock }})
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-4 sm:py-3 border border-transparent text-base font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-150 shadow-md hover:shadow-lg touch-manipulation">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <button disabled class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gray-400 cursor-not-allowed">
                                    Out of Stock
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-150 shadow-md hover:shadow-lg">
                                Login to Purchase
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const maxStock = {{ $product->stock }};
        
        function incrementQuantity() {
            const input = document.getElementById('quantity');
            const currentValue = parseInt(input.value);
            if (currentValue < maxStock) {
                input.value = currentValue + 1;
            }
        }
        
        function decrementQuantity() {
            const input = document.getElementById('quantity');
            const currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        }
    </script>
</x-app-layout>
