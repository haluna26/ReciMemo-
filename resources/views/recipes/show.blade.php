<x-app-layout>
    <h1 class="name">
        {{ $recipe->name }}
    </h1>
    <div class="content">
        <div class="content__estimation">
            <h3>評価</h3>
            <p>満足度：{{ $recipe->value }}/5</p>
            <p>難易度：{{ $recipe->level }}/5</p>
        </div>
        <div class="content__food">
            <h3>材料</h3>
            <p>{{ $recipe->food }}</p>
        </div>
        <div class="content__method">
            <h3>つくり方</h3>
            <p>{{ $recipe->method }}</p>
        </div>
        <div class="content__memo">
            <h3>メモ</h3>
            <p>{{ $recipe->memo }}</p>
        </div>
    </div>
    <form action="/recipes/{{ $recipe->id }}" id="form_{{ $recipe->id }}" method="post">
         @csrf
         @method('DELETE')
        <button type="button" onclick="deletePost({{ $recipe->id }})">削除</button>
    </form>
    <div class="edit"><a href="/recipes/{{ $recipe->id }}/edit">編集</a></div>
    <div class="footer">
        <a href="/">戻る</a>
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
