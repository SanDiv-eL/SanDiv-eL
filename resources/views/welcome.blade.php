<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-indigo-50 via-white to-purple-50 overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-6 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="text-center lg:text-left">
                        <!-- Badge -->
                        <div class="inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 rounded-full bg-indigo-100 text-indigo-700 text-xs sm:text-sm font-medium mb-4 sm:mb-6 animate-fade-in-down">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1.5 sm:mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            Trusted by 10,000+ customers
                        </div>

                        <h1 class="text-3xl tracking-tight font-extrabold text-gray-900 sm:text-4xl md:text-5xl lg:text-6xl animate-fade-in">
                            <span class="block">Upgrade your</span>
                            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">digital life</span>
                        </h1>
                        <p class="mt-3 text-sm sm:text-base text-gray-600 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0 animate-fade-in-up">
                            Discover the latest high-performance laptops and desktops for work, gaming, and creativity. Premium quality, unbeatable prices.
                        </p>
                        
                        <div class="mt-6 sm:mt-8 sm:mt-10 flex flex-col sm:flex-row sm:justify-center lg:justify-start gap-3 sm:gap-4 animate-fade-in-up">
                            <a href="{{ route('products.index') }}" class="group relative inline-flex items-center justify-center px-6 py-3 sm:px-8 sm:py-4 text-base sm:text-lg font-medium text-white bg-indigo-600 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                <span class="absolute inset-0 w-full h-full bg-gradient-to-br from-indigo-600 to-purple-600"></span>
                                <span class="relative flex items-center">
                                    Shop Now
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </span>
                            </a>
                            <a href="#featured" class="inline-flex items-center justify-center px-6 py-3 sm:px-8 sm:py-4 text-base sm:text-lg font-medium text-indigo-700 bg-white border-2 border-indigo-200 rounded-xl hover:border-indigo-300 hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-200">
                                View Products
                            </a>
                        </div>

                        <!-- Trust Indicators -->
                        <div class="mt-8 sm:mt-12 grid grid-cols-3 gap-3 sm:gap-4 lg:gap-8">
                            <div class="text-center">
                                <div class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">10K+</div>
                                <div class="text-xs sm:text-sm text-gray-500 mt-1">Happy Customers</div>
                            </div>
                            <div class="text-center">
                                <div class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">500+</div>
                                <div class="text-xs sm:text-sm text-gray-500 mt-1">Products</div>
                            </div>
                            <div class="text-center">
                                <div class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900">24/7</div>
                                <div class="text-xs sm:text-sm text-gray-500 mt-1">Support</div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        
        <!-- Decorative background elements -->
        <div class="hidden lg:block absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="hidden lg:block absolute bottom-0 left-0 -mb-20 -ml-20 w-96 h-96 bg-indigo-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
    </div>

    <!-- Featured Products Section -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Best Sellers</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Featured Products
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Hand-picked selection of our top-rated computers.
                </p>
            </div>

            <div id="featured" class="mt-12 grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($featuredProducts as $product)
                    <div class="group bg-white rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col transform hover:-translate-y-2">
                        <div class="relative pb-48 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                            <!-- Stock Badge -->
                            @if($product->stock > 0)
                                <span class="absolute top-3 left-3 z-10 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-500 text-white shadow-lg">
                                    In Stock
                                </span>
                            @else
                                <span class="absolute top-3 left-3 z-10 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-500 text-white shadow-lg">
                                    Out of Stock
                                </span>
                            @endif
                            
                            <img class="absolute inset-0 h-full w-full object-cover transform group-hover:scale-110 transition-transform duration-500" 
                                 src="{{ $product->image && Str::startsWith($product->image, 'http') ? $product->image : 'https://placehold.co/400x300?text=' . urlencode($product->name) }}" 
                                 alt="{{ $product->name }}" 
                                 onerror="this.onerror=null; this.src='https://placehold.co/400x300?text=No+Image';">
                            
                            <!-- Quick View Overlay -->
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                                <a href="{{ route('products.show', $product->slug) }}" class="opacity-0 group-hover:opacity-100 transform scale-90 group-hover:scale-100 transition-all duration-300 inline-flex items-center px-4 py-2 bg-white rounded-lg shadow-lg text-sm font-medium text-gray-900 hover:bg-gray-50">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Quick View
                                </a>
                            </div>
                        </div>
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex-1">
                                <p class="text-xs font-semibold text-indigo-600 uppercase tracking-wide mb-2">
                                    {{ $product->category->name ?? 'Computer' }}
                                </p>
                                <a href="{{ route('products.show', $product->slug) }}" class="block group-hover:text-indigo-600 transition-colors">
                                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">{{ $product->name }}</h3>
                                    <p class="text-sm text-gray-500 line-clamp-2 mb-4">{{ $product->description }}</p>
                                </a>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex-1 min-w-0 mr-3">
                                    <p class="text-lg font-bold text-gray-900 truncate">{{ formatRupiah($product->price) }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Free shipping</p>
                                </div>
                                <a href="{{ route('products.show', $product->slug) }}" class="inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 transition-colors duration-150 shadow-sm hover:shadow-md flex-shrink-0">
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-12 text-center">
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50 border-indigo-200 shadow-sm transition duration-150 ease-in-out">
                    View All Products
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div class="text-center">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white mx-auto">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Quality Guaranteed</h3>
                    <p class="mt-2 text-base text-gray-500">Every machine is rigorously tested for peak performance.</p>
                </div>
                <div class="text-center">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white mx-auto">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">Fast Shipping</h3>
                    <p class="mt-2 text-base text-gray-500">Free expedited shipping on all orders over $1000.</p>
                </div>
                <div class="text-center">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white mx-auto">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="mt-6 text-lg font-medium text-gray-900">24/7 Support</h3>
                    <p class="mt-2 text-base text-gray-500">Our expert team is here to help you anytime.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
