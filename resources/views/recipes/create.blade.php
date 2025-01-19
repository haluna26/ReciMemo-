<x-app-layout>
    <h1>レシピの作成</h1>
    <form action="/recipes" method="POST">
        @csrf
        <div class="name">
            <h2>レシピ名</h2>
            <input type="text" name="recipe[name]" placeholder="レシピ名" value="{{ old('recipe.name') }}"/>
            <p class="name__error" style="color:red">{{ $errors->first('recipe.name') }}</p>
            <!-- input~ならタグ内にvalue="{{ old('recipe.name') }}" -->
        </div>
        <div class="value">
            <h2>満足度</h2>
            <input type="integer" name="recipe[value]" value="{{ old('recipe.value') }}"/>
        </div>
        <div class="level">
            <h2>難易度</h2>
            <input type="integer" name="recipe[level]" value="{{ old('recipe.level') }}"/>
        </div>
        <div class="food">
            <h2>材料</h2>
            <textarea name="recipe[food]" placeholder="食材">{{ old('recipe.food') }}</textarea>
            <p class="food__error" style="color:red">{{ $errors->first('recipe.food') }}</p>
            <!-- textareaならタグとタグの間に{{ old('recipe.food') }} -->
        </div>
        <div class="method">
            <h2>つくり方</h2>
            <textarea name="recipe[method]" placeholder="URL、写真、手入力、コピペなど">{{ old('recipe.method') }}</textarea>
            <p class="method__error" style="color:red">{{ $errors->first('recipe.method') }}</p>
        </div>
        <div class="memo">
            <h2>メモ</h2>
            <textarea name="recipe[memo]" placeholder="ご自由にどうぞ">{{ old('recipe.memo') }}</textarea>
        </div>
        @csrf
        <input type="submit" value="保存"/>
    </form>
    <div class="footer">
        <a href="/">戻る</a>
    </div>
</x-app-layout>




