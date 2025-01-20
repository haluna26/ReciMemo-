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
    <div class="edit"><a href="/recipes/{{ $recipe->id }}/edit">編集</a></div>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
</x-app-layout>
