<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wide">Total Sales</div>
                    <div class="mt-2 flex items-baseline">
                        <span class="text-3xl font-bold text-gray-900 dark:text-white">$12,450</span>
                        <span class="ml-2 text-sm font-medium text-green-600">+12%</span>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wide">New Users</div>
                    <div class="mt-2 flex items-baseline">
                        <span class="text-3xl font-bold text-gray-900 dark:text-white">1,234</span>
                        <span class="ml-2 text-sm font-medium text-green-600">+5.4%</span>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100 dark:border-gray-700">
                    <div class="text-gray-500 dark:text-gray-400 text-sm font-medium uppercase tracking-wide">Active Sessions</div>
                    <div class="mt-2 flex items-baseline">
                        <span class="text-3xl font-bold text-gray-900 dark:text-white">456</span>
                        <span class="ml-2 text-sm font-medium text-gray-500">Currently online</span>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>
                    <div class="border-t border-gray-100 dark:border-gray-700 pt-4">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
