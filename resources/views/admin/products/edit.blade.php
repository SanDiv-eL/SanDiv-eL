<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg sm:text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100">
                <div class="p-4 sm:p-6">
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Product Name</label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" name="name" value="{{ $product->name }}" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">Category</label>
                                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="category_id" name="category_id" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="price">Price (Rp)</label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="price" type="number" step="1" name="price" value="{{ $product->price }}" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="stock">Stock</label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="stock" type="number" name="stock" value="{{ $product->stock }}">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Image URL</label>
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="image" type="url" name="image" value="{{ $product->image }}" placeholder="https://example.com/image.jpg">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description</label>
                                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" rows="4" required>{{ $product->description }}</textarea>
                            </div>
                            
                            <div class="md:col-span-2">
                                <div class="flex justify-between items-center mb-4 border-b pb-2">
                                    <h3 class="text-lg font-bold">Specifications</h3>
                                    <button type="button" onclick="addSpecification()" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm">
                                        + Add Specification
                                    </button>
                                </div>
                                <div id="specifications-container" class="space-y-3">
                                    <!-- Existing specifications will be loaded here -->
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let specIndex = 0;

        function addSpecification(key = '', value = '') {
            const container = document.getElementById('specifications-container');
            const specDiv = document.createElement('div');
            specDiv.className = 'flex gap-2 items-start';
            specDiv.innerHTML = `
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="spec_keys[]" 
                        value="${key}"
                        placeholder="e.g., CPU, RAM, Display" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required>
                </div>
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="spec_values[]" 
                        value="${value}"
                        placeholder="e.g., Intel Core i7, 16GB DDR5" 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required>
                </div>
                <button 
                    type="button" 
                    onclick="this.parentElement.remove()" 
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3 rounded">
                    ×
                </button>
            `;
            container.appendChild(specDiv);
            specIndex++;
        }

        // Load existing specifications
        document.addEventListener('DOMContentLoaded', function() {
            const existingSpecs = @json($product->specifications ?? []);
            
            if (Object.keys(existingSpecs).length > 0) {
                Object.entries(existingSpecs).forEach(([key, value]) => {
                    addSpecification(key, value);
                });
            } else {
                // Add one empty field if no specifications exist
                addSpecification();
            }
        });
    </script>
</x-app-layout>
