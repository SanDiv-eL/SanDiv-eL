<x-app-layout>
    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="flex flex-col lg:flex-row gap-6 sm:gap-8">
                    <!-- Shipping Information -->
                    <div class="lg:w-2/3">
                        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100">
                            <div class="p-4 sm:p-6 border-b border-gray-100">
                                <h3 class="text-base sm:text-lg font-medium text-gray-900">Shipping Information</h3>
                            </div>
                            <div class="p-4 sm:p-6 grid grid-cols-1 gap-y-4 sm:gap-y-6 gap-x-4 sm:grid-cols-6">
                                <div class="sm:col-span-6">
                                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                    <div class="mt-1">
                                        <input type="text" name="address" id="address" autocomplete="street-address" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                    <div class="mt-1">
                                        <input type="text" name="city" id="city" autocomplete="address-level2" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="state" class="block text-sm font-medium text-gray-700">State / Province</label>
                                    <div class="mt-1">
                                        <input type="text" name="state" id="state" autocomplete="address-level1" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="zip" class="block text-sm font-medium text-gray-700">ZIP / Postal code</label>
                                    <div class="mt-1">
                                        <input type="text" name="zip" id="zip" autocomplete="postal-code" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                                    </div>
                                </div>
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
                                <ul class="divide-y divide-gray-200 mb-6">
                                    @foreach($cart as $item)
                                        <li class="py-4 flex justify-between gap-3">
                                            <div class="flex flex-col flex-1 min-w-0">
                                                <span class="text-sm font-medium text-gray-900 truncate">{{ $item['name'] }}</span>
                                                <span class="text-xs text-gray-500">Qty: {{ $item['quantity'] }}</span>
                                            </div>
                                            <span class="text-sm font-medium text-gray-900 text-right whitespace-nowrap flex-shrink-0">{{ formatRupiah($item['price'] * $item['quantity']) }}</span>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="border-t border-gray-200 pt-4">
                                    <div class="flex flex-col gap-2">
                                        <dt class="text-sm font-medium text-gray-600">Total</dt>
                                        <dd class="text-xl sm:text-2xl font-bold text-indigo-600 break-words">{{ formatRupiah($total) }}</dd>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <button type="submit" class="w-full flex items-center justify-center px-4 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                        Place Order
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
