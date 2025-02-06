<x-app-layout>
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
        <ul>
            @foreach ($recipes as $recipe)
                <li>
                    <h2 class='title'>
                        <a href="/recipes/{{ $recipe->id }}">{{ $recipe->title }}</a>
                    </h2>
                   <p>満足度:{{ $recipe->value }}/5, 難易度:{{ $recipe->level }}/5</p>
                   <p>満足度:材料：{{ $recipe->ingredients }}</p>
                </li>
            @endforeach
        </ul>
                </div>
            </div>
        </div>
</div>
</x-app-layout>