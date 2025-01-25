<x-app-layout>
    <h1>レシピの作成</h1>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="/recipes" method="POST" method="POST">
                    @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                <div class="name">
                                <h2>レシピ名</h2>
                                    </label>
                                    <input type="text" name="recipe[name]" placeholder="レシピ名" value="{{ old('recipe.name') }}" class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <p class="name__error" style="color:red">{{ $errors->first('recipe.name') }}</p>
                                    <!-- input~ならタグ内にvalue="{{ old('recipe.name') }}" -->
                                </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="value">
                                <div class="value">
                                    満足度
                                    </label>
                                    <input type="integer" name="recipe[value]" value="{{ old('recipe.value') }}" class="border-2 border-gray-400 rounded-md h-5 w-10"/>/5
                                </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="level">
                                <div class="level">
                                    難易度
                                    </label>
                                    <input type="integer" name="recipe[level]" value="{{ old('recipe.level') }}" class="border-2 border-gray-400 rounded-md h-5 w-10"/>/5
                                </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="food">
                                <div class="food">
                                    <h2>材料</h2>
                                    </label>
                                    <textarea name="recipe[food]" placeholder="食材" class="w-2/5" rows="7">{{ old('recipe.food') }}</textarea>
                                    <p class="food__error" style="color:red">{{ $errors->first('recipe.food') }}</p>
                                    <!-- textareaならタグとタグの間に{{ old('recipe.food') }} -->
                                </div>
                        </div>
                                <div class="method">
                                    <h2>つくり方</h2>
                                    <textarea name="recipe[method]" placeholder="URL、写真、手入力、コピペなど">{{ old('recipe.method') }}</textarea>
                                    <p class="method__error" style="color:red">{{ $errors->first('recipe.method') }}</p>
                                </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="memo">
                                <div class="memo">
                                    <h2>メモ</h2>
                                    </label>
                                    <textarea name="recipe[memo]" placeholder="ご自由にどうぞ" class="w-2/5" rows="5">{{ old('recipe.memo') }}</textarea>
                                </div>
                         </div>
                                @csrf
                                <input type="submit" value="保存" class="submit bg-blue-700 font-semibold text-white py-1 px-2 rounded inline-block text-center cursor-pointer hover:bg-green-500 border">
                            </form>
                            <div class="footer">
                                 <a href="/">戻る</a>
                            </div>
            </div>
        </div>
    </div>
</x-app-layout>




