<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- フレックスボックスによる左右配置 -->
            <div class="flex space-x-4 w-full justify-between">
                <div class="bg-white shadow-sm sm:rounded-lg w-3/4 p-6">
                    <div class="border-b border-gray-200">
                        <div class="content">
                            <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                
                                <!-- レシピ名 -->
                                <div class="mb-4">
                                    <label for="content__title" class="block text-gray-700 text-sm font-bold mb-2">レシピ名</label>
                                    <input type="text" name="recipe[title]" value="{{ old('recipe.title', $recipe->title) }}" class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <p class="title__error" style="color:red">{{ $errors->first('recipe.title') }}</p>
                                </div>
                                
                                <!-- カテゴリー -->
                                <div class="mb-4">
                                    <div class="category">
                                        <label for="category" class="block text-gray-700 text-sm font-bold mb-2">カテゴリー</label>
                                        <select id="category" name="recipe[category_id]" class="border-2 border-gray-400 rounded-md p-2">
                                            <option value="">(選択する)</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('recipe.category_id', $recipe->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- 満足度と難易度 -->
                                <div class="flex w-full gap-x-0">
                                    <div class="mb-4 flex-grow">
                                        <label for="content__value" class="block text-gray-700 text-sm font-bold mb-2">満足度</label>
                                        <select id="value" name="recipe[value]" class="border-2 border-gray-400 rounded-md p-2">
                                            <option value="" {{ old('recipe.value', $recipe->value) == '' ? 'selected' : '' }}>選択してください</option>
                                            <option value="1" {{ old('recipe.value', $recipe->value) == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('recipe.value', $recipe->value) == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('recipe.value', $recipe->value) == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('recipe.value', $recipe->value) == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ old('recipe.value', $recipe->value) == '5' ? 'selected' : '' }}>5</option>
                                        </select>
                                        /5
                                        <p class="value__error" style="color:red">{{ $errors->first('recipe.value') }}</p>
                                    </div>
                                    <div class="mb-4 flex-grow">
                                        <label for="content__level" class="block text-gray-700 text-sm font-bold mb-2">難易度</label>
                                        <select id="level" name="recipe[level]" class="border-2 border-gray-400 rounded-md p-2">
                                            <option value="" {{ old('recipe.level', $recipe->level) == '' ? 'selected' : '' }}>選択してください</option>
                                            <option value="1" {{ old('recipe.level', $recipe->level) == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('recipe.level', $recipe->level) == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('recipe.level', $recipe->level) == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('recipe.level', $recipe->level) == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ old('recipe.level', $recipe->level) == '5' ? 'selected' : '' }}>5</option>
                                        </select>
                                        /5
                                        <p class="level__error" style="color:red">{{ $errors->first('recipe.level') }}</p>
                                    </div>
                                </div>
                                
                                <!-- 材料 -->
                                <div class="mb-4">
                                    <label for="content__ingredients" class="block text-gray-700 text-sm font-bold mb-2">材料</label>
                                    <textarea name="recipe[ingredients]" class="w-3/5" rows="7">{{ old('recipe.ingredients', $recipe->ingredients) }}</textarea>
                                    <p class="ingredients__error" style="color:red">{{ $errors->first('recipe.ingredients') }}</p>
                                </div>
                                
                                <!-- つくり方（モーダル利用） -->
                                <div class="mb-4">
                                    <label for="content__method" class="block text-gray-700 text-sm font-bold mb-2">つくり方</label>
                                    
                                    <!-- モーダル用バックグラウンド -->
                                    <div class="js-gray-cover hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 cursor-pointer"></div>
                                    
                                    <!-- 各モーダルボタンと既存データの表示 -->
                                    <div class="flex space-x-4">
                                        <!-- URL -->
                                        <div>
                                            <div class="js-url-btn modal-btn px-2 py-1 bg-stone-950 text-lg text-white rounded-full hover:bg-stone-500 cursor-pointer">
                                                URL
                                            </div>
                                            <div class="mt-2">
                                                @if(old('recipe.url', $recipe->url))
                                                    <p class="text-gray-700">{{ old('recipe.url', $recipe->url) }}</p>
                                                @else
                                                    <p class="text-gray-500">登録されたURLはありません</p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <!-- 説明 -->
                                        <div>
                                            <div class="js-explanation-btn modal-btn px-2 py-1 bg-stone-950 text-lg text-white rounded-full hover:bg-stone-500 cursor-pointer">
                                                説明
                                            </div>
                                            <div class="mt-2">
                                                @if(old('recipe.description', $recipe->description))
                                                    <p class="text-gray-700">{{ old('recipe.description', $recipe->description) }}</p>
                                                @else
                                                    <p class="text-gray-500">登録された説明はありません</p>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <!-- 画像 -->
                                        <div>
                                            <div class="js-image-btn modal-btn px-2 py-1 bg-stone-950 text-lg text-white rounded-full hover:bg-stone-500 cursor-pointer">
                                                画像
                                            </div>
                                            <div class="mt-2">
                                                @php
                                                    // $recipe->image はキャストによって配列になっている
                                                    $images = $recipe->image ?? [];
                                                @endphp

                                                @if(count($images) > 0)
                                                    <div class="grid grid-cols-2 gap-2">
                                                        @foreach($images as $image)
                                                            <img src="{{ asset('storage/' . $image) }}" class="w-32 h-32 object-cover rounded-md">
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <p class="text-gray-500">登録された画像はありません</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- URL入力モーダル -->
                                    <div class="modal-container">
                                        <div class="js-url-content js-modal-content fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden">
                                            <div class="bg-white p-6 rounded-lg max-w-lg w-full">
                                                <label for="url">URL</label>
                                                <input type="text" id="url" name="recipe[url]" value="{{ old('recipe.url', $recipe->url) }}" class="border border-gray-300 rounded w-full p-2">
                                                <div class="flex gap-2 mt-2">
                                                    <button type="button" id="add-url-id" class="bg-blue-500 text-white px-4 py-2 rounded">追加</button>
                                                    <button type="button" class="close-modal bg-gray-500 text-white px-4 py-2 rounded">閉じる</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- 説明入力モーダル -->
                                    <div class="modal-container">
                                        <div id="descriptionModal" class="js-explanation-content js-modal-content fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden">
                                            <div class="relative bg-white p-6 rounded-lg max-w-3xl w-full max-h-[90vh] overflow-y-auto">
                                                <div class="mb-4">
                                                    <label for="description">説明入力</label>
                                                    <textarea id="recipe_description_input" name="recipe[description]" class="border border-gray-300 rounded w-full p-2 h-[470px]" maxlength="1000" rows="8">{{ old('recipe.description', $recipe->description) }}</textarea>
                                                </div>
                                                <div class="flex justify-end space-x-2 mt-4">
                                                    <div id="add-instructions-id" class="bg-blue-500 text-white px-4 py-2 rounded">追加</div>
                                                    <div class="close-modal bg-gray-500 text-white px-4 py-2 rounded">閉じる</div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- 画像選択モーダル -->
                                    <div class="modal-container">
                                        <div class="js-image-content js-modal-content fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden">
                                            <div class="bg-white p-6 rounded-lg max-w-md w-full">
                                                <label for="image">画像選択</label>
                                                <input type="file" id="image-upload" name="recipe[images][]" multiple class="border border-gray-300 rounded w-full"/>
                                                <div class="flex gap-2 mt-2">
                                                    <button type="button" id="add-images-id" class="bg-blue-500 text-white px-4 py-2 rounded">追加</button>
                                                    <button type="button" class="close-modal bg-gray-500 text-white px-4 py-2 rounded">閉じる</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <!-- メモ -->
                                <div class="mb-4">
                                    <label for="instructions" class="block text-gray-700 text-sm font-bold mb-2">メモ</label>
                                    <textarea name="recipe[instructions]" class="w-3/5" rows="5">{{ old('recipe.instructions', $recipe->instructions) }}</textarea>
                                </div>
                                
                                <button type="submit" class="bg-blue-500 text-white p-2 rounded">保存</button>
                            </form>
                            
                            <!-- モーダル用スクリプト -->
                            <script>
                                // モーダル要素のキャッシュ
                                const modalContent = document.querySelectorAll(".js-modal-content");
                                const modalOpenedBackGround = document.querySelector(".js-gray-cover");

                                // すべてのモーダルを閉じる関数
                                function closeModal() {
                                    modalOpenedBackGround.classList.add("hidden");
                                    modalContent.forEach((modal) => {
                                        modal.classList.add("hidden");
                                    });
                                }

                                // バックグラウンドクリックでモーダルを閉じる
                                modalOpenedBackGround.addEventListener("click", closeModal);

                                // モーダル内のクリックがバックグラウンドに伝播しないようにする
                                modalContent.forEach((modal) => {
                                    modal.addEventListener("click", (e) => {
                                        e.stopPropagation();
                                    });
                                });

                                // クローズボタンにイベントリスナーを追加
                                document.querySelectorAll('.close-modal').forEach((btn) => {
                                    btn.addEventListener('click', closeModal);
                                });

                                // モーダルのトグルを設定する汎用関数
                                const setupModalToggle = (buttonSelector, modalSelector) => {
                                    const button = document.querySelector(buttonSelector);
                                    const modal = document.querySelector(modalSelector);
                                    if (button && modal) {
                                        button.addEventListener("click", () => {
                                            modalOpenedBackGround.classList.remove("hidden");
                                            modal.classList.remove("hidden");
                                        });
                                    } else {
                                        console.log("エラー: ボタンまたはモーダルが見つかりません");
                                    }
                                };

                                // URL、画像、説明用モーダルのトグル設定
                                setupModalToggle('.js-url-btn', '.js-url-content');
                                setupModalToggle('.js-image-btn', '.js-image-content');
                                setupModalToggle('.js-explanation-btn', '.js-explanation-content');
                            </script>
                        </div>    
                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg w-1/4">
                    <div class="p-6">
                        <livewire:shopping-cart />
                    </div>
                </div> 
               
            </div>
        </div>
    </div>
</x-app-layout>