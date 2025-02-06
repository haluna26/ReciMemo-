<x-app-layout>
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
    <h1 class="title">
        {{ $recipe->title }}
    </h1>
    <div class="content">
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
            <p>{{ $recipe->url }}</p>
            <p>{{ $recipe->image }}</p>
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
    <!-- <div class="edit bg-green-700 font-semibold text-white py-2 px-4 rounded"><a href="/recipes/{{ $recipe->id }}/edit">編集</a></div> -->
    <div class="edit bg-green-400 text-white font-bold rounded px-2 py-1 inline-block text-center cursor-pointer hover:bg-green-500 border border-green-700"
  role="button" onclick="handleEdit()"><a href="/recipes/{{ $recipe->id }}/edit">編集</a></div>

    <div class="footer">
        <a href="/recipes">戻る</a>
    </div>
                </div>
            </div>
        </div>
</div>
    <script>
        function deletePost(id) {
             'use strict'

            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                 document.getElementById(`form_${id}`).submit();
                }
            }
    </script>
</x-app-layout>
