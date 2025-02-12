<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('レシピ一覧') }}
        </h2>
    </x-slot>

<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex space-x-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-3/4">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul>
                        @foreach ($recipes as $recipe)
                            <li>
                                <h2 class='title'>
                                    <a href="/recipes/{{ $recipe->id }}">{{ $recipe->title }}</a>
                                </h2>
                            <p>満足度:{{ $recipe->value }}/5, 難易度:{{ $recipe->level }}/5</p>
                            <p class="text-gray-500">満足度:材料：{{ $recipe->ingredients }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
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