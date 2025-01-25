<x-app-layout>
<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
    <h1 class="name">編集画面</h1>
    <div class="content">
        <form action="/recipes/{{ $recipe->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="content__name">
                    <div class='content__name'>
                    <h2>レシピ名</h2>
                </label>
            <input type='text' name='recipe[name]' value="{{ $recipe->name }}" class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <p class="name__error" style="color:red">{{ $errors->first('recipe.name') }}</p>
                    </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="content__value">
                    <div class='content__value'>
                    満足度
                </label>
            <input type='integer' name='recipe[value]' value="{{ $recipe->value }}" class="border-2 border-gray-400 rounded-md h-5 w-10">/5
            <p class="value__error" style="color:red">{{ $errors->first('recipe.value') }}</p>
                    </div>
            </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="content__level">
                <div class='content__level'>
                難易度
            </label>
            <input type='integer' name='recipe[level]' value="{{ $recipe->level }}" class="border-2 border-gray-400 rounded-md h-5 w-10">/5
            <p class="level__error" style="color:red">{{ $errors->first('recipe.level') }}</p>
                </div>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="content__food">
                <div class='content__food'>
                <h2>材料</h2>
            </label>
            <textarea name='recipe[food]' class="w-2/5" rows="7">{{ $recipe->food }}</textarea>
            <p class="food__error" style="color:red">{{ $errors->first('recipe.food') }}</p>
                </div>
        </div>
        <div class='content__method'>
            <h2>つくり方</h2>
            <textarea name='recipe[method]'>{{ $recipe->method }}</textarea>
            <p class="method__error" style="color:red">{{ $errors->first('recipe.method') }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="memo">
                <div class='content__memo'>
                <h2>メモ</h2>
            </label>
            <textarea name='recipe[memo]' class="w-2/5" rows="7">{{ $recipe->memo }}</textarea>
                </div>
        </div>
        <input type="submit" value="保存" class="submit bg-blue-700 font-semibold text-white py-1 px-2 rounded inline-block text-center cursor-pointer hover:bg-green-500 border">
        </form>
</x-app-layout>