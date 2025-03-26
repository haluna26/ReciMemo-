<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('レシピ作成') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                    <div class="flex space-x-1">
                                        <!-- URL -->
                                        <div>
                                            <div class="js-url-btn modal-btn px-2 py-1 bg-stone-950 text-lg text-white rounded-full hover:bg-stone-500 cursor-pointer">
                                                URL
                                            </div>
                                            <!-- <div class="mt-2">
                                                <p id="url-preview" class="{{ old('recipe.url', $recipe->url) ? 'text-gray-700' : 'text-gray-500' }}">
                                                    {{ old('recipe.url', $recipe->url) ? old('recipe.url', $recipe->url) : '登録されたURLはありません' }}
                                                </p>
                                            </div> -->
                                        </div>
                                        
                                        <!-- 説明 -->
                                        <div>
                                            <div class="js-explanation-btn modal-btn px-2 py-1 bg-stone-950 text-lg text-white rounded-full hover:bg-stone-500 cursor-pointer">
                                                説明
                                            </div>
                                            <div class="mt-2">
                                                <!-- <p id="description-preview" class="{{ old('recipe.description', $recipe->description) ? 'text-gray-700' : 'text-gray-500' }}">
                                                    {{ old('recipe.description', $recipe->description) ? old('recipe.description', $recipe->description) : '登録された説明はありません' }}
                                                </p> -->
                                            </div>
                                        </div>
                                        
                                        <!-- 画像 -->
                                        <div>
                                            <div class="js-image-btn modal-btn px-2 py-1 bg-stone-950 text-lg text-white rounded-full hover:bg-stone-500 cursor-pointer">
                                                画像
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- ボタンと同じ .mb-4 ブロック内、あるいはその直後に配置 -->
                                        <div class="mt-4">
                                            <!-- URL表示 -->
                                            <p id="url-preview" class="{{ old('recipe.url', $recipe->url) ? 'text-gray-700' : 'text-gray-500' }}">
                                                <!-- <a href="{{ $recipe->url }}" target="_blanck" class="text-blue-500">{{ old('recipe.url', $recipe->url) ?: '登録されたURLはありません' }}</a> -->
                                                 @if(old('recipe.url', $recipe->url))
                                                    <a href="{{ old('recipe.url', $recipe->url) }}" target="_blank" class="text-blue-500">
                                                        {{ old('recipe.url', $recipe->url) }}
                                                    </a>
                                                @else
                                                    登録されたURLはありません
                                                @endif
                                            </p>

                                            <!-- 説明表示 -->
                                            <p id="description-preview" class="{{ old('recipe.description', $recipe->description) ? 'text-gray-700' : 'text-gray-500' }}">
                                                {{ old('recipe.description', $recipe->description) ?: '登録された説明はありません' }}
                                            </p>

                                            <!-- 画像表示 -->
                                            <div id="image-preview" class="grid grid-cols-2 gap-1 mt-2">
                                                @php
                                                    $images = json_decode($recipe->image, true) ?? [];
                                                @endphp
                                            
                                                @if (!empty($images) && is_array($images))
                                                    <div class="grid grid-cols-2 gap-2 mt-2">
                                                        @foreach($images as $image)
                                                            <div class="relative">
                                                                <img src="{{ $image }}" class="w-32 h-32 object-cover rounded-md">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <p class="text-gray-500 mt-2">登録された画像はありません</p>
                                                @endif
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
                                                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                                                    画像選択
                                                </label>
                                                <input type="file" id="image-upload" name="recipe[images][]" multiple accept="image/*" class="border border-gray-300 rounded w-full p-2"/>
                                                <div class="flex gap-2 mt-2">
                                                    <button type="button" id="add-images-id" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">追加</button>
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
                                document.addEventListener("DOMContentLoaded", () => {
                                    const modalBg = document.querySelector(".js-gray-cover");
                                    const modals = document.querySelectorAll(".js-modal-content");
                                    
                                    // 全モーダルを閉じる関数
                                    function closeModal() {
                                        modalBg.classList.add("hidden");
                                        modals.forEach(modal => modal.classList.add("hidden"));
                                    }
                                    
                                    // 背景クリックで閉じる
                                    modalBg.addEventListener("click", closeModal);
                                    
                                    // モーダル内クリックで背景への伝播を防止
                                    modals.forEach(modal => {
                                        modal.addEventListener("click", (e) => e.stopPropagation());
                                    });
                                    
                                    // クローズボタンにイベントを追加
                                    document.querySelectorAll('.close-modal').forEach(btn => {
                                        btn.addEventListener("click", closeModal);
                                    });
                                    
                                    // モーダルのトグル関数
                                    function toggleModal(modal, show = true) {
                                        if (!modal) return;
                                        modal.classList.toggle("hidden", !show);
                                        modalBg.classList.toggle("hidden", !show);
                                    }
                                    
                                    // モーダル開閉用ボタン設定
                                    function setupModalToggle(buttonSelector, modalSelector) {
                                        const btn = document.querySelector(buttonSelector);
                                        const modal = document.querySelector(modalSelector);
                                        if (btn && modal) {
                                            btn.addEventListener("click", () => {
                                                modalBg.classList.remove("hidden");
                                                modal.classList.remove("hidden");
                                            });
                                        }
                                    }
                                    
                                    setupModalToggle('.js-url-btn', '.js-url-content');
                                    setupModalToggle('.js-explanation-btn', '#descriptionModal');
                                    setupModalToggle('.js-image-btn', '.js-image-content');
                                    
                                    // 追加ボタンのイベント登録：URL
                                    const addUrlBtn = document.getElementById("add-url-id");
                                    if (addUrlBtn) {
                                        addUrlBtn.addEventListener("click", () => {
                                            // 入力値を取得してプレビュー更新
                                            const urlInput = document.getElementById("url");
                                            const newUrl = urlInput.value.trim();
                                            const urlPreview = document.getElementById("url-preview");
                                            if(urlPreview) {
                                                if(newUrl) {
                                                    urlPreview.textContent = newUrl;
                                                    urlPreview.className = "text-gray-700";
                                                } else {
                                                    urlPreview.textContent = "登録されたURLはありません";
                                                    urlPreview.className = "text-gray-500";
                                                }
                                            }
                                            toggleModal(document.querySelector(".js-url-content"), false);
                                        });
                                    }
                                    
                                    // 追加ボタンのイベント登録：説明
                                    const addInstrBtn = document.getElementById("add-instructions-id");
                                    if (addInstrBtn) {
                                        addInstrBtn.addEventListener("click", () => {
                                            const descInput = document.getElementById("recipe_description_input");
                                            const newDesc = descInput.value.trim();
                                            const descPreview = document.getElementById("description-preview");
                                            if(descPreview) {
                                                if(newDesc) {
                                                    descPreview.textContent = newDesc;
                                                    descPreview.className = "text-gray-700";
                                                } else {
                                                    descPreview.textContent = "登録された説明はありません";
                                                    descPreview.className = "text-gray-500";
                                                }
                                            }
                                            toggleModal(document.querySelector("#descriptionModal"), false);
                                        });
                                    }
                                    
                                    // 追加ボタンのイベント登録：画像
                                    const addImagesBtn = document.getElementById("add-images-id");
                                    if (addImagesBtn) {
                                        addImagesBtn.addEventListener("click", () => {
                                            // ※画像はモーダル内でファイル選択しているので、追加処理はサーバー側に任せるか、もしくはプレビュー更新などを別途実装
                                            toggleModal(document.querySelector(".js-image-content"), false);
                                        });
                                    }

                                    document.getElementById("image-upload").addEventListener("change", function(event) {
                                        const files = event.target.files;
                                        const allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/webp"];

                                        for (let i = 0; i < files.length; i++) {
                                            if (!allowedTypes.includes(files[i].type)) {
                                                alert("画像ファイル（JPG, PNG, GIF, WebP)のみ選択できます。");
                                                event.target.value = ""; //　不正ファイルをクリア
                                                return;
                                            }
                                        }
                                    });
                                });
                            </script>
                        </div>    
                    </div>
                
        </div>
    </div>
</x-app-layout>