<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seller Dashboard') }} - {{ $store->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Welcome back, {{ Auth::user()->name }}!</h3>
                    <p>Status Toko: <span class="text-green-600 font-bold uppercase">{{ $store->status }}</span></p>
                    
                    <div class="mt-6">
                        <x-primary-button>Manage Products</x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>