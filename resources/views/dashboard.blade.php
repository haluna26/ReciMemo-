<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Top') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex space-x-4">
                <!-- 左側のコンテンツ -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-3/4">
                    <div class="p-6 text-gray-900">
                        {{ __("You're logged in!") }}
                    </div>
                </div>

            <!-- 右側のコンテンツ -->
                <div class="bg-white shaow-sm sm:rounded-lg w-1/4">
                    <div class="p-6">
                    <livewire:shopping-cart />
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
</x-app-layout>
