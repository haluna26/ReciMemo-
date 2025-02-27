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
                    <!-- 検索フォーム -->
                    <form action="{{ route('recipes.index') }}" method="GET">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="レシピを検索" class="border-2 border-gray-300 p-2 rounded-md">
                        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded-md">検索</button>
                    </form>
                    @if (!empty($search))
                        <h2 class="text-xl font-bold mt-4">「{{ $search }}」の検索結果</h2>
                    @endif

                    <!-- 検索結果表示 -->
                    @if($recipes->count())
                        @foreach($recipes as $recipe)
                            <div class="p-4 border-b">
                                    <h2 class="title">
                                        <a href="/recipes/{{ $recipe->id }}">{{ $recipe->title }}</a>
                                    </h2>
                                
                                <div class="flex space-x-1 items-center">
                                    <span class="bg-gray-300 text-black px-2 py-1 rounded-md inline-block flex-none text-base">
                                        {{ $recipe->category->name }}
                                    </span>
                                    <span>満足度:{{ $recipe->value }}/5, 難易度:{{ $recipe->level }}/5</span>
                                </div>
                                <p class="text-gray-600">{{ $recipe->ingredients }}</p>
                            </div>
                        @endforeach

                    @else
                        <p class="text-gray-500">該当するレシピが見つかりませんでした。</p>
                    @endif
                                    
                    <!-- <ul>
                        @foreach ($recipes as $recipe)
                            <li>
                                <h2 class='title'>
                                    <a href="/recipes/{{ $recipe->id }}">{{ $recipe->title }}</a>
                                </h2>
                            <p>満足度:{{ $recipe->value }}/5, 難易度:{{ $recipe->level }}/5</p>
                            <p class="text-gray-500">材料：{{ $recipe->ingredients }}</p>
                            </li>
                        @endforeach
                    </ul> -->

                    <!-- ページネーション -->
                    {{ $recipes->links() }}
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
</x-app-layout>