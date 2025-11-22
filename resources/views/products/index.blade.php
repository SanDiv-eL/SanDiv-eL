<x-app-layout>
    <div class="py-6 sm:py-8 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Title -->
            <div class="mb-6">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Semua Produk</h1>
                <p class="text-sm sm:text-base text-gray-600 mt-1">Temukan komputer dan aksesori performa tinggi terkini</p>
            </div>
            <div class="mb-6 bg-white rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6">
                <form method="GET" action="{{ route('products.index') }}" class="flex flex-col md:flex-row gap-4">
                    <!-- Search Bar -->
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition"
                               placeholder="Cari produk...">
                    </div>

                    <!-- Category Filter -->
                    <div class="w-full md:w-48">
                        <select name="category" 
                                class="block w-full py-2.5 px-3 border border-gray-300 bg-white rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-2">
                        <button type="submit" 
                                class="flex-1 md:flex-none inline-flex items-center justify-center px-6 py-2.5 border border-transparent rounded-lg text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition shadow-sm">
                            Filter
                        </button>
                        
                        @if(request('search') || request('category'))
                            <a href="{{ route('products.index') }}" 
                               class="flex-1 md:flex-none inline-flex items-center justify-center px-4 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition"
                               title="Reset Filter">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </a>
                        @endif
                    </div>
                </form>

                <!-- Active Filters Display -->
                @if(request('search') || request('category'))
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="text-sm font-medium text-gray-700">Filter aktif:</span>
                            @if(request('search'))
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                    Cari: "{{ request('search') }}"
                                    <a href="{{ route('products.index', array_filter(['category' => request('category')])) }}" class="ml-2 text-indigo-600 hover:text-indigo-800">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </span>
                            @endif
                            @if(request('category'))
                                @php
                                    $selectedCategory = $categories->find(request('category'));
                                @endphp
                                @if($selectedCategory)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                        Kategori: {{ $selectedCategory->name }}
                                        <a href="{{ route('products.index', array_filter(['search' => request('search')])) }}" class="ml-2 text-indigo-600 hover:text-indigo-800">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                    </span>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Products Grid -->
            @if($products->count() > 0)
                <div class="grid gap-4 sm:gap-6 grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach($products as $product)
                        <div class="group bg-white rounded-xl sm:rounded-2xl shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col transform hover:-translate-y-2">
                            <div class="relative pb-48 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200">
                                <!-- Stock Badge -->
                                @if($product->stock > 0)
                                    <span class="absolute top-2 left-2 sm:top-3 sm:left-3 z-10 inline-flex items-center px-2 py-0.5 sm:px-3 sm:py-1 rounded-full text-xs font-semibold bg-green-500 text-white shadow-lg">
                                        Tersedia
                                    </span>
                                @else
                                    <span class="absolute top-2 left-2 sm:top-3 sm:left-3 z-10 inline-flex items-center px-2 py-0.5 sm:px-3 sm:py-1 rounded-full text-xs font-semibold bg-red-500 text-white shadow-lg">
                                        Stok Habis
                                    </span>
                                @endif
                                
                                <img class="absolute inset-0 h-full w-full object-cover transform group-hover:scale-110 transition-transform duration-500" 
                                     src="{{ $product->image && Str::startsWith($product->image, 'http') ? $product->image : 'https://placehold.co/400x300?text=' . urlencode($product->name) }}" 
                                     alt="{{ $product->name }}" 
                                     onerror="this.onerror=null; this.src='https://placehold.co/400x300?text=No+Image';">
                                
                                <!-- Quick View Overlay -->
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
                            </div>
                            
                            <div class="p-3 sm:p-5 flex-1 flex flex-col">
                                <div class="flex items-center justify-between mb-1 sm:mb-2">
                                    <span class="inline-flex items-center px-2 py-0.5 sm:px-2.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                        {{ $product->category->name }}
                                    </span>
                                </div>
                                
                                <h3 class="text-sm sm:text-lg font-semibold text-gray-900 mb-1 sm:mb-2 line-clamp-2 group-hover:text-indigo-600 transition-colors">
                                    {{ $product->name }}
                                </h3>
                                
                                <div class="flex items-center mb-2">
                                    <x-star-rating :rating="$product->rating" />
                                    <span class="mx-1.5 text-gray-300">|</span>
                                    <span class="text-xs text-gray-500">{{ $product->sold_count }} terjual</span>
                                </div>
                                
                                <p class="text-xs sm:text-sm text-gray-600 mb-2 sm:mb-4 line-clamp-2 flex-1 hidden sm:block">
                                    {{ $product->description }}
                                </p>
                            
                                <div class="mt-auto flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm sm:text-lg font-bold text-gray-900 truncate">{{ formatRupiah($product->price) }}</p>
                                        <p class="text-xs text-gray-500 hidden sm:block">Gratis ongkir</p>
                                    </div>
                                    <a href="{{ route('products.show', $product->slug) }}" class="inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-lg text-indigo-700 bg-indigo-50 hover:bg-indigo-100 transition-colors duration-150 w-full sm:w-auto flex-shrink-0 group-hover:bg-indigo-600 group-hover:text-white">
                                    Lihat Detail
                                    <svg class="w-4 h-4 ml-2 -mr-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <!-- No Results -->
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Produk tidak ditemukan</h3>
                    <p class="mt-1 text-sm text-gray-500">Coba sesuaikan pencarian atau filter Anda untuk menemukan yang Anda cari.</p>
                    <div class="mt-6">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Hapus semua filter
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
