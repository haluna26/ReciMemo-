<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('レシピ作成') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- フレックスボックスによる左右配置 -->
            <!-- <div class="flex space-x-4 w-full justify-between"> -->
                <!-- 左側のコンテンツ -->
                <!-- <div class="bg-white shadow-sm sm:rounded-lg w-3/4 p-6"> -->
                    <div class="border-b border-gray-200">
                        <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if(session('error'))
                                <div class="bg-red-500 text-white p-2 rounded mt-4">
                                    {{ session('error') }}
                                </div>
                            @endif
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                    レシピ名
                                </label>
                                <input type="text" id="title" name="recipe[title]" placeholder="レシピ名" value="{{ old('recipe.title') }}" class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <p class="name__error" style="color:red">{{ $errors->first('recipe.title') }}</p>
                            </div>

                            <div class="mb-4">
                                <div class="category">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                                        カテゴリー
                                    </label>
                                    <select id="category_id" name="recipe[category_id]" class="border-2 border-gray-400 rounded-md p-2 w-1/4 py-2 px-3">
                                        <option value="">(選択する)</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="flex w-full gap-x-0">
                                <div class="mb-4 flex-grow">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="value">
                                        満足度
                                    </label>
                                    <select id="value" name="recipe[value]" class="border-2 border-gray-400 rounded-md p-2">
                                        <option value="">選択してください</option>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ old('recipe.value') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    /5
                                    <p class="value__error text-red-500">{{ $errors->first('recipe.value') }}</p>
                                </div>
                                <div class="mb-4 flex-grow">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="level">
                                        難易度
                                    </label>
                                    <select id="level" name="recipe[level]" class="border-2 border-gray-400 rounded-md p-2">
                                        <option value="">選択してください</option>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}" {{ old('recipe.level') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    /5
                                    <p class="level__error text-red-500">{{ $errors->first('recipe.level') }}</p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="ingredients">
                                    材料
                                </label>
                                <textarea id="ingredients" name="recipe[ingredients]" placeholder="食材" class="w-3/5" rows="7">{{ old('recipe.ingredients') }}</textarea>
                                <p class="ingredients__error" style="color:red">{{ $errors->first('recipe.ingredients') }}</p>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="content__method">
                                    つくり方
                                </label>
                                <!-- モーダル用のバックグラウンド -->
                                <div class="js-gray-cover hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 cursor-pointer"></div>
                                
                                <div class="flex space-x-1">
                                    <!-- URLボタン -->
                                    <div>
                                        <div class="js-url-btn modal-btn px-2 py-1 bg-stone-950 text-lg text-white rounded-full hover:bg-stone-500 cursor-pointer">
                                            URL
                                        </div>
                                    </div>
                                    <!-- URL入力モーダル -->
                                    <div class="modal-container">
                                        <div class="js-url-content js-modal-content fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden">
                                            <div class="bg-white p-6 rounded-lg max-w-lg w-full">
                                                <label for="url">URL</label>
                                                <input type="text" id="url" name="recipe[url]" class="border border-gray-300 rounded w-full p-2">
                                                <button type="button" id="add-url-id" class="bg-blue-500 text-white px-4 py-2 rounded">追加</button>
                                                <button type="button" onclick="toggleModal(document.querySelector('.js-url-content'), false)" class="bg-gray-500 text-white px-4 py-2 rounded">閉じる</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 説明ボタン -->
                                    <div>
                                        <div class="js-explanation-btn modal-btn px-2 py-1 bg-stone-950 text-lg text-white rounded-full hover:bg-stone-500 cursor-pointer">
                                            説明
                                        </div>
                                    </div>
                                    <!-- 説明入力モーダル -->
                                    <div class="modal-container">
                                        <div id="descriptionModal" class="js-modal-content fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden">
                                            <div class="relative bg-white p-6 rounded-lg max-w-3xl w-full max-h-[90vh] overflow-y-auto">
                                                <div class="mb-4">
                                                    <label for="description">説明入力</label>
                                                    <textarea id="recipe_description_input" name="recipe[description]" class="border border-gray-300 rounded w-full p-2 h-[470px]" maxlength="1000" rows="8">{{ old('recipe.description', '') }}</textarea>
                                                </div>
                                                <div class="flex justify-end space-x-2 mt-4">
                                                    <div id="add-instructions-id" class="bg-blue-500 text-white px-4 py-2 rounded">追加</div>
                                                    <div onclick="toggleModal(document.querySelector('#descriptionModal'), false)" class="bg-gray-500 text-white px-4 py-2 rounded">閉じる</div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 画像ボタン -->
                                    <div>
                                        <div class="js-image-btn modal-btn px-2 py-1 bg-stone-950 text-lg text-white rounded-full hover:bg-stone-500 cursor-pointer">
                                            画像
                                        </div>
                                    </div>
                                    <!-- 画像選択モーダル -->
                                    <div class="modal-container">
                                        <div class="js-image-content js-modal-content fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden">
                                            <div class="bg-white p-6 rounded-lg max-w-md w-full">
                                                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                                                    画像アップロード
                                                </label>
                                                <input type="file" id="image-upload" name="recipe[images][]" multiple accept="image/*" class="border border-gray-300 rounded w-full p-2"/>
                                                <div class="flex gap-2 mt-2">
                                                    <button type="button" id="add-images-id" class="bg-blue-500 text-white px-4 py-2 rounded">追加</button>
                                                    <button type="button" onclick="toggleModal(document.querySelector('.js-image-content'), false)" class="bg-gray-500 text-white px-4 py-2 rounded">閉じる</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 既にアップロード済みの画像を表示 -->
                                @if (session('uploaded_images'))
                                    <div class="mt-4">
                                        <p class="text-gray-700">前回選択した画像：</p>
                                        <div class="grid grid-cols-2 gap-2">
                                            @foreach (session('uploaded_images') as $image)
                                                <div class="relative">
                                                    <img src="{{ $image }}" class="w-32 h-32 object-cover rounded-md">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div>
                                <div id="session-description"></div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="instructions">
                                    メモ
                                </label>
                                <textarea id="instructions" name="recipe[instructions]" placeholder="ご自由にどうぞ" class="w-3/5" rows="5">{{ old('recipe.instructions') }}</textarea>
                            </div>
                            <button type="submit" class="bg-blue-500 text-white p-2 rounded" id="save-recipe-btn">保存</button>
                        </form>
                        
                        <div class="mt-4">
                            <a href="/" class="text-blue-500 hover:underline">戻る</a>
                        </div>
                    </div>
                <!-- </div> -->
                
                
            
        </div>
    

    <!-- リファクタリング済みのスクリプト -->
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        // 表示領域の取得
        const sessionDescription = document.getElementById('session-description');

        // sessionStorageからrecipeDataを復元（なければ初期値）
        let recipeData = JSON.parse(sessionStorage.getItem("recipeData") || '{"url": "", "description": "", "images": []}');

        // 描画更新用の関数
        function updateDisplay() {
            sessionDescription.innerHTML = "";

            // URLの表示
            if (recipeData.url) {
                const urlEl = document.createElement("p");
                urlEl.textContent = "URL: " + recipeData.url;
                sessionDescription.appendChild(urlEl);
            }

            // 説明の表示
            if (recipeData.description) {
                const descEl = document.createElement("p");
                descEl.textContent = recipeData.description;
                sessionDescription.appendChild(descEl);
            }

            // 画像の表示
            if (recipeData.images.length > 0) {
                recipeData.images.forEach(imgURL => {
                    const imgContainer = document.createElement("div");
                    imgContainer.classList.add("relative", "inline-block");

                    const img = document.createElement("img");
                    img.src = imgURL;
                    img.classList.add("w-40", "h-40", "object-cover", "rounded-md");

                    const removeBtn = document.createElement("button");
                    removeBtn.textContent = "✖️";
                    removeBtn.classList.add("absolute", "top-0", "right-0", "bg-red-500", "text-white", "text-xs", "px-1", "rounded-full");
                    removeBtn.addEventListener("click", () => {
                        recipeData.images = recipeData.images.filter(i => i !== imgURL);
                        sessionStorage.setItem("recipeData", JSON.stringify(recipeData));
                        updateDisplay();
                    });

                    imgContainer.appendChild(img);
                    imgContainer.appendChild(removeBtn);
                    sessionDescription.appendChild(imgContainer);
                });
            }
        }

        // 初期描画
        updateDisplay();

        // 入力イベント：URL、説明はそのまま
        document.getElementById("url").addEventListener("input", (e) => {
            recipeData.url = e.target.value;
            sessionStorage.setItem("recipeData", JSON.stringify(recipeData));
        });

        document.getElementById("recipe_description_input").addEventListener("input", (e) => {
            recipeData.description = e.target.value;
            sessionStorage.setItem("recipeData", JSON.stringify(recipeData));
        });

        // ※ファイル入力のchangeイベントは削除し、画像の追加は「追加」ボタンで行う

        // 画像追加用の関数（「追加」ボタン押下時）
        function addImages() {
            const input = document.getElementById("image-upload");
            if (input.files.length > 0) {
                Array.from(input.files).forEach(file => {
                    const imgURL = URL.createObjectURL(file);
                    recipeData.images.push(imgURL);
                });
                sessionStorage.setItem("recipeData", JSON.stringify(recipeData));
                updateDisplay();
            }
            toggleModal(document.querySelector(".js-image-content"), false);
        }

        // モーダル表示/非表示切替用関数
        function toggleModal(modal, show = true) {
            if (!modal) return;
            modal.classList.toggle("hidden", !show);
            const modalBg = document.querySelector(".js-gray-cover");
            if (modalBg) {
                modalBg.classList.toggle("hidden", !show);
            }
        }

        // モーダル開閉ボタンのクリックイベント登録
        document.addEventListener("click", (event) => {
            if (event.target.classList.contains("modal-btn")) {
                let modal = null;
                if (event.target.classList.contains("js-url-btn")) {
                    modal = document.querySelector(".js-url-content");
                } else if (event.target.classList.contains("js-explanation-btn")) {
                    modal = document.querySelector("#descriptionModal");
                } else if (event.target.classList.contains("js-image-btn")) {
                    modal = document.querySelector(".js-image-content");
                }
                if (modal) toggleModal(modal, true);
            }

            if (event.target.classList.contains("bg-gray-500")) {
                const modal = event.target.closest(".js-modal-content");
                if (modal) toggleModal(modal, false);
            }
        });

        // モーダル内の追加ボタンのイベント登録
        [
            { id: "add-instructions-id", handler: () => {
                const descValue = document.getElementById("recipe_description_input").value;
                if (descValue.trim() !== "") {
                    recipeData.description = descValue;
                    sessionStorage.setItem("recipeData", JSON.stringify(recipeData));
                    updateDisplay();
                }
                toggleModal(document.querySelector("#descriptionModal"), false);
            }},
            { id: "add-url-id", handler: () => {
                const urlValue = document.getElementById("url").value;
                if (urlValue.trim() !== "") {
                    recipeData.url = urlValue;
                    sessionStorage.setItem("recipeData", JSON.stringify(recipeData));
                    updateDisplay();
                }
                toggleModal(document.querySelector(".js-url-content"), false);
            }},
            { id: "add-images-id", handler: addImages }
        ].forEach(({ id, handler }) => {
            const button = document.getElementById(id);
            if (button) button.addEventListener("click", handler);
        });

        // 保存ボタン押下時、sessionStorageをクリア
        const saveButton = document.getElementById("save-recipe-btn");
        if (saveButton) {
            saveButton.addEventListener("click", () => {
                sessionStorage.removeItem("recipeData");
            });
        }

        // 編集ページ以外なら初期化
        const isEditPage = window.location.href.includes("edit");
        if (!isEditPage) {
            sessionStorage.removeItem("recipeData");
            updateDisplay();
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
</x-app-layout>