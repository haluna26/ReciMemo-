<x-app-layout>
    <h1 class="name">編集画面</h1>
    <div class="content">
        <form action="/recipes/{{ $recipe->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class='content__name'>
            <h2>レシピ名</h2>
            <input type='text' name='recipe[name]' value="{{ $recipe->name }}">
            <p class="name__error" style="color:red">{{ $errors->first('recipe.name') }}</p>
        </div>
        <div class='content__value'>
            <h2>満足度</h2>
            <input type='integer' name='recipe[value]' value="{{ $recipe->value }}">
        </div>
        <div class='content__level'>
            <h2>難易度</h2>
            <input type='integer' name='recipe[level]' value="{{ $recipe->level }}">
        </div>
        <div class='content__food'>
            <h2>材料</h2>
            <textarea name='recipe[food]'>{{ $recipe->food }}</textarea>
            <p class="food__error" style="color:red">{{ $errors->first('recipe.food') }}</p>
        </div>
        <div class='content__method'>
            <h2>つくり方</h2>
            <textarea name='recipe[method]'>{{ $recipe->method }}</textarea>
            <p class="method__error" style="color:red">{{ $errors->first('recipe.method') }}</p>
        </div>
        <div class='content__memo'>
            <h2>メモ</h2>
            <textarea name='recipe[memo]'>{{ $recipe->memo }}</textarea>
        </div>
        <input type="submit" value="保存"/>
        </form>
</x-app-layout>