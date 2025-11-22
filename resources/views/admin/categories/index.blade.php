<x-app-layout>
    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100">
                <!-- Header with Add Button -->
                <div class="p-4 sm:p-6 bg-white border-b border-gray-100">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0">
                        <div>
                            <h3 class="text-lg sm:text-xl font-semibold text-gray-900">Daftar Kategori</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $categories->total() }} kategori total</p>
                        </div>
                        <a href="{{ route('admin.categories.create') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs sm:text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Kategori Baru
                        </a>
                    </div>
                </div>

                <!-- Categories Table -->
                <div class="p-4 sm:p-6">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="py-3 px-4 text-sm font-semibold text-gray-700">ID</th>
                                    <th class="py-3 px-4 text-sm font-semibold text-gray-700">Nama</th>
                                    <th class="py-3 px-4 text-sm font-semibold text-gray-700">Slug</th>
                                    <th class="py-3 px-4 text-sm font-semibold text-gray-700">Deskripsi</th>
                                    <th class="py-3 px-4 text-sm font-semibold text-gray-700">Produk</th>
                                    <th class="py-3 px-4 text-sm font-semibold text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($categories as $category)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-4 px-4 text-sm text-gray-900">{{ $category->id }}</td>
                                        <td class="py-4 px-4 text-sm font-medium text-gray-900">{{ $category->name }}</td>
                                        <td class="py-4 px-4 text-sm text-gray-600">{{ $category->slug }}</td>
                                        <td class="py-4 px-4 text-sm text-gray-600">{{ Str::limit($category->description, 50) }}</td>
                                        <td class="py-4 px-4 text-sm text-gray-600">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                {{ $category->products_count }} produk
                                            </span>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-700 rounded-lg hover:bg-indigo-100 transition-colors text-sm font-medium">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                    Edit
                                                </a>
                                                <button onclick="openDeleteModal({{ $category->id }}, '{{ $category->name }}', {{ $category->products_count }})" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors text-sm font-medium">
                                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 sm:w-96 shadow-lg rounded-2xl bg-white">
            <div class="mt-3">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div class="mt-4 text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Hapus Kategori</h3>
                    <div class="mt-2 px-7 py-3">
                        <p class="text-sm text-gray-500" id="deleteMessage">
                            Apakah Anda yakin ingin menghapus <span id="categoryName" class="font-semibold text-gray-900"></span>?
                        </p>
                    </div>
                    <div class="flex gap-3 px-4 py-3">
                        <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 text-base font-medium rounded-lg hover:bg-gray-200 transition-colors">
                            Batal
                        </button>
                        <form id="deleteForm" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="deleteButton" class="w-full px-4 py-2 bg-red-600 text-white text-base font-medium rounded-lg hover:bg-red-700 transition-colors shadow-sm hover:shadow">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(categoryId, categoryName, productsCount) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('categoryName').textContent = categoryName;
            document.getElementById('deleteForm').action = `/admin/categories/${categoryId}`;
            
            const deleteMessage = document.getElementById('deleteMessage');
            const deleteButton = document.getElementById('deleteButton');
            
            if (productsCount > 0) {
                deleteMessage.innerHTML = `Tidak dapat menghapus <span class="font-semibold text-gray-900">${categoryName}</span> karena memiliki ${productsCount} produk. Silakan pindahkan atau hapus produk terlebih dahulu.`;
                deleteButton.disabled = true;
                deleteButton.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                deleteMessage.innerHTML = `Apakah Anda yakin ingin menghapus <span class="font-semibold text-gray-900">${categoryName}</span>? Tindakan ini tidak dapat dibatalkan.`;
                deleteButton.disabled = false;
                deleteButton.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        document.getElementById('deleteModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
            }
        });
    </script>
</x-app-layout>
