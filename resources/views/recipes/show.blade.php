<x-app-layout>
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex space-x-4 w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-3/4 p-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="title">
                        {{ $recipe->title }}
                    </h1>
                    <div class="content">
                        <div class="content__category">
                            <h3>カテゴリー</h3>
                            <p>{{ $recipe->category->name }}</p>
                        </div>
                        <div class="content__estimation">
                            <h3>評価</h3>
                            <p>満足度：{{ $recipe->value }}/5　難易度：{{ $recipe->level }}/5</p>
                        </div>
                        <div class="content__food">
                            <h3>材料</h3>
                            <p>{{ $recipe->ingredients }}</p>
                        </div>
                        <div class="content__method">
                            <h3>つくり方</h3>
                            <!-- urlが青くなる仕組み -->
                            <a href="{{ $recipe->url }}" class="text-blue-500">{{ $recipe->url }}</a> 

                            @if (!empty($recipe->image) && json_decode($recipe->image))
                                <div class="grid grid-cols-2 gap-2">
                                    @foreach (json_decode($recipe->image) as $image)
                                        <img src="{{ asset('storage/' . $image) }}" alt="レシピ画像" 
                                            class="w-full h-48 object-cover rounded-md cuser-pointer"
                                            onclick="openModal('{{ asset('storage/' . $image) }}')">
                                    @endforeach
                                </div>
                            @endif

                            <!-- モーダル -->
                            <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden">
                                <div class="relative bg-white p-6 rounded-lg max-w-3xl">
                                    <!-- 閉じるボタン -->
                                    <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 text-3xl">&times;</button>
                                    <!-- 画像表示 -->
                                    <img id="modalImage" src="" alt="拡大画像" class="w-full max-h-[80vh] object-contain rounded-lg">
                                </div>
                            </div>


                            <!-- 説明文 -->
                            <p>{{ $recipe->description }}</p>
                        </div>
                        <div class="content__memo">
                            <h3>メモ</h3>
                            <p>{{ $recipe->instructions }}</p>
                        </div>
                    </div>
                    <form action="/recipes/{{ $recipe->id }}" id="form_{{ $recipe->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" class= "bg-red-700 font-semibold text-white py-1 px-2 rounded" onclick="deletePost({{ $recipe->id }})">削除</button>
                    </form>
                    <script>
                    // JavaScript
                    function openModal(imageSrc) {
                    const modal = document.getElementById('imageModal');
                    const modalImage = document.getElementById('modalImage');

                    modalImage.src = imageSrc;
                    modal.classList.remove('hidden');
                    }

                    function closeModal() {
                        document.getElementById('imageModal').classList.add('hidden');
                    }

                    function deletePost(id) {
                        'use strict'

                    if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                        document.getElementById(`form_${id}`).submit();
                        }
                    }
                    </script>
                    <!-- <div class="edit bg-green-700 font-semibold text-white py-2 px-4 rounded"><a href="/recipes/{{ $recipe->id }}/edit">編集</a></div> -->
                    <div class="edit bg-green-400 text-white font-bold rounded px-2 py-1 inline-block text-center cursor-pointer hover:bg-green-500 border border-green-700"
                role="button" onclick="handleEdit()"><a href="/recipes/{{ $recipe->id }}/edit">編集</a></div>

                    <div class="footer">
                        <a href="/recipes">戻る</a>
                    </div>
                </div>
            </div>
            <div class="bg-white shaow-sm sm:rounded-lg w-1/4">
                <div class="p-6">
                    <livewire:shopping-cart />
                </div>
            </div>
        </div>
</div>
@livewireScripts
</x-app-layout>
