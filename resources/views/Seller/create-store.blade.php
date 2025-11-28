<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Setup Your Store</h2></x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm rounded-lg">
                <form action="{{ route('seller.store_new') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Store Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required />
                    </div>
                    
                    <div class="mb-4">
                        <x-input-label for="about" :value="__('Description')" />
                        <textarea name="about" class="w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="logo" :value="__('Store Logo')" />
                        <input type="file" name="logo" class="block mt-1 w-full" required />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <x-input-label for="phone" :value="__('Phone Number')" />
                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" required />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="city" :value="__('City')" />
                            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" required />
                        </div>
                    </div>
                    <div class="mb-4">
                        <x-input-label for="address" :value="__('Full Address')" />
                        <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" required />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="postal_code" :value="__('Postal Code')" />
                        <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" required />
                    </div>

                    <x-primary-button>{{ __('Register Store') }}</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>