<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- フレックスボックスによる左右配置 -->  
            <div class="flex space-x-4 w-full justify-between">
                <div class="bg-white shadow-sm sm:rounded-lg w-3/4 p-6">
                    <div class="border-b border-gray-200">
                        <div class="content">
                            <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="content__title">
                                        <!-- <div class='content__name'> -->
                                        レシピ名
                                    </label>
                                    <input type='text' name='recipe[title]' value="{{ old('recipe.title', $recipe->title) }}" class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <p class="title__error" style="color:red">{{ $errors->first('recipe.title') }}</p>
                                        <!-- </div> -->
                                </div>

                                <div class="mb-4">
                                        <div class="category">
                                            <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                                                カテゴリー
                                            </label>
                                            <select id="category" name="recipe[category_id]" class="border-2 border-gray-400 rounded-md p-2">
                                                <option value="">(選択する)</option>
                                                <option value="new">＋新しいカテゴリーを作成</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ old('recipe.category_id', $recipe->category_id) == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>

                                <div class="flex w-full gap-x-0">
                                    <div class="mb-4 flex-grow">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="content__value">
                                            <!-- <div class='content__value'> -->
                                            満足度
                                        </label>
                                        <!-- <select id="value" name="recipe[value]" class="border-2 border-gray-400 rounded-md p-2">
                                            <option value="">選択してください</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select> -->
                                        <select id="value" name="recipe[value]" class="border-2 border-gray-400 rounded-md p-2">
                                            <option value="" {{ old('recipe.value', $recipe->value) == '' ? 'selected' : '' }}>選択してください</option>
                                            <option value="1" {{ old('recipe.value', $recipe->value) == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('recipe.value', $recipe->value) == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('recipe.value', $recipe->value) == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('recipe.value', $recipe->value) == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ old('recipe.value', $recipe->value) == '5' ? 'selected' : '' }}>5</option>
                                        </select>
                                        /5
                                        <!-- <input type='integer' name='recipe[value]' value="{{ $recipe->value }}" class="border-2 border-gray-400 rounded-md h-5 w-10">/5 -->
                                        <p class="value__error" style="color:red">{{ $errors->first('recipe.value') }}</p>
                                                <!-- </div> -->
                                    </div>
                                    <div class="mb-4 flex-grow">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="content__level">
                                            <!-- <div class='content__level'> -->
                                            難易度
                                        </label>

                                            <select id="level" name="recipe[level]" class="border-2 border-gray-400 rounded-md p-2">
                                                <option value="" {{ old('recipe.level', $recipe->level) == '' ? 'selected' : '' }}>選択してください</option>
                                                <option value="1" {{ old('recipe.level', $recipe->level) == '1' ? 'selected' : '' }}>1</option>
                                                <option value="2" {{ old('recipe.level', $recipe->level) == '2' ? 'selected' : '' }}>2</option>
                                                <option value="3" {{ old('recipe.level', $recipe->level) == '3' ? 'selected' : '' }}>3</option>
                                                <option value="4" {{ old('recipe.level', $recipe->level) == '4' ? 'selected' : '' }}>4</option>
                                                <option value="5" {{ old('recipe.level', $recipe->level) == '5' ? 'selected' : '' }}>5</option>
                                            </select>
                                            /5
                                        <!-- <input type='integer' name='recipe[level]' value="{{ $recipe->level }}" class="border-2 border-gray-400 rounded-md h-5 w-10">/5 -->
                                        <p class="level__error" style="color:red">{{ $errors->first('recipe.level') }}</p>
                                            <!-- </div> -->
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="content__ingredients">
                                        <!-- <div class='content__food'> -->
                                        材料
                                    </label>
                                    <textarea name='recipe[ingredients]' class="w-3/5" rows="7">{{ old('recipe.ingredients', $recipe->ingredients) }}</textarea>
                                    <p class="ingredients__error" style="color:red">{{ $errors->first('recipe.ingredients') }}</p>
                                        <!-- </div> -->
                                </div>
                                <!-- <div class='content__method'> -->
                                    <!-- <h2>つくり方</h2> -->
                                    <!-- <textarea name='recipe[method]'>{{ $recipe->method }}</textarea>
                                    <p class="method__error" style="color:red">{{ $errors->first('recipe.method') }}</p>
                                </div> -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="content__method">
                                            <!-- <div class='content__name'> -->
                                        つくり方
                                    </label>
                                        <!-- モーダル用のバックグラウンド -->
                                             <div class="js-gray-cover hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 cursor-pointer"></div>

                                                <!-- URL入力モーダル -->
                                                <div class="flex w-full gap-x-1">
                                                    <div>
                                                        <div class="js-url-btn modal-btn px-2 py-1 bg-stone-950 text-lg text-white rounded-full hover:bg-stone-500 cursor-pointer flex-grow">URL</div>
                                                        <div class="js-url-content hidden js-modal-content max-w-md min-h-[300px] bg-white absolute top-17 mx-auto left-0 right-0 p-4 rounded-lg">
                                                            <label for="url">URL入力</label>
                                                            <input type="text" id="url" name="recipe[url]" value="{{ old('recipe.url', $recipe->url) }}" class="border border-gray-300 rounded w-full p-2"/>
                                                        </div>
                                                    </div>

                                                    <!-- 説明入力モーダル -->
                                                    <div>
                                                        <div class="js-explanation-btn modal-btn px-2 py-1 bg-stone-950 text-lg text-white rounded-full hover:bg-stone-500 cursor-pointer flex-grow">説明</div>
                                                        <div class="js-explanation-content hidden js-modal-content max-w-md min-h-[300px] bg-white absolute top-24 mx-auto left-0 right-0 p-4 rounded-lg">
                                                            <label for="description">説明入力</label>
                                                            <!-- <input type="text" id="description" name="recipe[description]" value="{{ old('recipe.description', $recipe->description) }}" class="border border-gray-300 rounded w-full"/> -->
                                                            <textarea id="description" name="recipe[description]" class="w-full" maxlength="1000" rows="8">{{ old('recipe.description') }}</textarea>
                                                        </div>
                                                    </div> 

                                                    <!-- 画像選択モーダル -->
                                                    <div>
                                                        <div class="js-image-btn modal-btn px-2 py-1 bg-stone-950 text-lg text-white rounded-full hover:bg-stone-500 cursor-pointer flex-grow">画像</div>
                                                        <div class="js-image-content hidden js-modal-content max-w-md min-h-[300px] bg-white absolute top-24 mx-auto left-0 right-0 p-4 rounded-lg">
                                                            <!-- <label for="image">画像選択</label> -->
                                                            <label><input type="file" name="recipe[images][]"></label><br>
                                                            <label><input type="file" name="recipe[images][]"></label><br>
                                                            <label><input type="file" name="recipe[images][]"></label><br>
                                                            <label><input type="file" name="recipe[images][]"></label><br>
                                                            <label><input type="file" name="recipe[images][]"></label><br>
                                                            <!-- <input type="file" id="image" name="recipe[image]" value="{{ old('recipe.image', $recipe->image) }}" class="border border-gray-300 rounded w-full"/> -->
                                                        </div>
                                                    </div>
                                                </div>
                                    </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2" for="instructions">
                                        <!-- <div class='content__memo'> -->
                                            メモ
                                    </label>
                                    <textarea name='recipe[instructions]' class="w-3/5" rows="5">{{ old('recipe.instructions', $recipe->instructions) }}</textarea>
                                        <!-- </div> -->
                                </div>
                                <!-- <input type="submit" value="保存" class="submit bg-blue-700 font-semibold text-white py-1 px-2 rounded inline-block text-center cursor-pointer hover:bg-green-500 border"> -->
                                <button type="submit" class="bg-blue-500 text-white p-2 rounded">保存</button>
                            </form>
                            <script>
                                const modalContent = document.querySelectorAll(".js-modal-content");
                                const modalOpenedBackGround = document.querySelector(".js-gray-cover");

                                // 背景をクリックしたらモーダルを閉じる
                                modalOpenedBackGround.addEventListener("click", () => {
                                    modalOpenedBackGround.classList.add("hidden");
                                    modalContent.forEach((modal) => {
                                        modal.classList.add("hidden");
                                    });
                                });

                                // モーダル内のクリックイベントが背景に伝播しないようにする
                                modalContent.forEach((modal) => {
                                    modal.addEventListener("click", (e) => {
                                        e.stopPropagation(); // モーダル内クリックが背景クリックに伝播しない
                                    });
                                });

                                // モーダルのトグルを設定する関数
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

                                // ボタンとモーダルのトグル設定
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


<!-- editにもURL、説明、画像データが保持されるようにする -->
<script>
                            document.addEventListener("DOMContentLoaded", () => {
                                // モーダルの背景を取得
                                const modalOpenedBackGround = document.querySelector(".js-gray-cover");
                                // if (!modalOpenedBackGround) {
                                //     console.warn("⚠️ モーダル背景 (js-gray-cover) が見つかりませんでした！");
                                // }
                                
                                const modalContents = document.querySelectorAll(".js-modal-content");
                                const sessionDescription = document.getElementById('session-description');

                                // `sessionStorage` に保存するデータ構造　Laravelから既存データを取得
                                let recipeData = JSON.parse(sessionStorage.getItem('recipeData')) || {
                                    //  url: '', description: '', images: [] 
                                    url: @json($recipe->url ?? ''),
                                    description: @json($recipe->description ?? ''),
                                    images: @json($recipe->images ?? [])
                                    };

                                    sessionStorage.setItem('recipeData', JSON.stringify(recipeData));

                                
                                // ✅ データを適切に表示する関数（URL → 説明 → 画像 の順に表示）
                                function updateDisplay() {
                                    sessionDescription.innerHTML = ""; // まずクリアにする

                                    //1️⃣ URLを表示
                                    if (recipeData.url) {
                                        const urlElement = document.createElement('p');
                                        urlElement.textContent = `URL: ${recipeData.url}`;
                                        sessionDescription.appendChild(urlElement);
                                    }

                                    // 2️⃣ 説明を表示
                                    if (recipeData.description) {
                                        const descriptionElement = document.createElement('p');
                                        descriptionElement.textContent = recipeData.description;
                                        sessionDescription.appendChild(descriptionElement);
                                    }

                                    // 3️⃣ 画像を表示
                                    if (recipeData.images.length > 0) {
                                        recipeData.images.forEach(imgURL => {
                                            const imgContainer = document.createElement('div');
                                            imgContainer.classList.add("relative", "inline-block");

                                            const img = document.createElement('img');
                                            img.src = imgURL;
                                            img.classList.add("w-20", "h-20", "object-cover", "rounded-md");

                                            const removeBtn = document.createElement('button');
                                            removeBtn.textContent = "✖️";
                                            removeBtn.classList.add("absolute", "top-0", "right-0", "bg-red-500", "text-white", "text-xs", "px-1", "rounded-full");
                                            removeBtn.onclick = () => {
                                                imgContainer.remove();
                                                recipeData.images = recipeData.images.filter(i => i !== imgURL);
                                                sessionStorage.setItem('recipeData', JSON.stringify(recipeData));
                                            };

                                            imgContainer.appendChild(img);
                                            imgContainer.appendChild(removeBtn);
                                            sessionDescription.appendChild(imgContainer);
                                        });
                                    }
                                }

                                // ✅ URLの追加
                                function addURL() {
                                    const url = document.getElementById('url').value;
                                    if (url.trim() !== '') {
                                        recipeData.url = url;
                                        // sessionStorage.setItem('url', url);
                                        sessionStorage.setItem('recipeData', JSON.stringify(recipeData));
                                        updateDisplay(); // 表示更新

                                        // const urlElement = document.createElement('p');
                                        // urlElement.textContent = `URL: ${url}`;
                                        // sessionDescription.appendChild(urlElement);
                                        // closeModal();

                                        // toggleModal(document.querySelector(".js-url-content"), false);
                                    }
                                    toggleModal(document.querySelector(".js-url-content"), false);
                                }

                                // ✅ 説明の追加
                                function addInstructions() {
                                    const description = document.getElementById('recipe_description_input').value;
                                    // recipeData.description = description;
                                    // // sessionStorage.setItem('description', description);
                                    // sessionStorage.setItem('recipeData', JSON.stringify(recipeData));

                                    // document.getElementById('recipe_description_input').value = description;
                                    // sessionDescription.textContent = description;
                                    // // closeModal();
                                    if (description.trim() !== '') {
                                        recipeData.description = description;
                                        sessionStorage.setItem('recipeData', JSON.stringify(recipeData));
                                        updateDisplay(); // 表示更新
                                    }

                                    toggleModal(document.querySelector("#descriptionModal"), false);
                                }

                                // ✅ 画像の追加
                                function addImages() {
                                    const input = document.getElementById('image-upload');
                                    if (input.files.length > 0) {
                                        // let imageArray = JSON.parse(sessionStorage.getItem('images')) || [];
                                        Array.from(input.files).forEach(file => {
                                            const imgURL = URL.createObjectURL(file);
                                            recipeData.images.push(imgURL);
                                        
                                        });

                                        sessionStorage.setItem('recipeData', JSON.stringify(recipeData));
                                        updateDisplay(); // 表示更新
                                        // closeModal();
                                        // toggleModal(document.querySelector(".js-image-content"), false);
                                    }
                                    toggleModal(document.querySelector(".js-image-content"), false);
                                }

                                // ✅ ページ読み込み時にデータを復元
                                function restoreSessionData() {
                                    updateDisplay();
                                }
                                // updateDisplay();

                                // ✅　`edit` ページの判定
                                const isEditPage = window.location.href.includes("edit");

                                if (!isEditPage) {
                                    sessionStorage.removeItem('recipeData'); // 画像と説明のデータを削除
                                    sessionDescription.innerHTML = "";
                                } else {
                                    restoreSessionData();
                                }

                                // ✅ モーダルの開閉を統一化
                                function toggleModal(modal, show = true) {
                                    if (!modal) return;
                                    modal.classList.toggle("hidden", !show);
                                    document.querySelector(".js-gray-cover")?.classList.toggle("hidden", !show);
                                }

                                // ✅ ページ読み込み時に `sessionStorage` から復元
                                // function restoreSessionData() {
                                    
                                //     if (recipeData.url) {
                                //         const urlElement = document.createElement('p');
                                //         urlElement.textContent = `URL: ${recipeData.url}`;
                                //         sessionDescription.appendChild(urlElement);
                                //     }

                                //     if (recipeData.description) {
                                //         document.getElementById('recipe_description_input').value = recipeData.description;
                                //         sessionDescription.textContent = recipeData.description;
                                //     }

                                //     if (recipeData.images.length > 0) {
                                //         recipeData.images.forEach(imgURL => {
                                //             const imgContainer = document.createElement('div');
                                //             imgContainer.classList.add("relative", "inline-block");

                                //             const img = document.createElement('img');
                                //             img.src = imgURL;
                                //             img.classList.add("w-20", "h-20", "object-cover","rounded-md");

                                //             const removeBtn = document.createElement('button');
                                //             removeBtn.textContent = "✖️";
                                //             removeBtn.classList.add("absolute", "top-0", "right-0", "bg-red-500", "text-white", "text-xs", "px-1", "rounded-full");
                                //             removeBtn.onclick = () => {
                                //                 imgContainer.remove();
                                //                 recipeData.images = recipeData.images.filter(i => i !== imgURL);
                                //                 sessionStorage.setItem('recipeData', JSON.stringify(recipeData));
                                //             };

                                //             imgContainer.appendChild(img);
                                //             imgContainer.appendChild(removeBtn);
                                //             sessionDescription.appendChild(imgContainer);
                                //         });
                                //     }
                                // }

                            
                            

                                // restoreSessionData();

                                // ✅ モーダルを開く関数
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

                                        // console.log("🔍 取得したモーダル:", modal);
                                        if (modal) toggleModal(modal, true);
                                    }

                                    if (event.target.classList.contains("bg-gray-500")) {
                                        toggleModal(event.target.closest(".js-modal-content"), false);
                                    }
                                });

                                
                                // ✅ 各ボタンのイベントリスナー設定
                                [
                                    { id: 'add-instructions-id', handler: addInstructions },
                                    { id: 'add-url-id', handler: addURL },
                                    { id: 'add-images-id', handler: addImages }
                                ].forEach(({ id, handler }) => {
                                    const button = document.getElementById(id);
                                    if (button) {
                                        button.addEventListener('click', handler);
                                    } else {
                                        console.warn(`ボタン (${id}) が見つかりませんでした！`);
                                    }
                                });

                                // const saveButton = document.getElementById('save-recipe-btn'); // 保存ボタンのIDを指定

                                // ✅ 保存ボタンが押されたら `sessionStorage` をクリア
                                const saveButton = document.getElementById('save-recipe-btn'); // 保存ボタンのIDを指定
                                if (saveButton) {
                                    saveButton.addEventListener('click', () => {
                                        sessionStorage.removeItem('recipeData'); // 画像と説明のデータを削除
                                    });
                                }
                                // } else {
                                //     console.warn("保存ボタン (save-recipe-btn) が見つかりませんでした");
                                // }

                                // URLに `edit` が含まれている場合は sessionStorage をクリアしない
                                // const isEditPage = window.location.href.includes("edit");

                                // if (!isEditPage) {
                                //     sessionStorage.removeItem('recipeData'); // 画像と説明のデータを削除

                                //     const sessionDescription = document.getElementById('session-description');
                                //     if (sessionDescription) {
                                //         sessionDescription.textContent = "";
                                //     }

                                //     const imageContainers = sessionDescription.querySelectorAll("div.relative.inline-block");
                                //     imageContainers.forEach(imgContainer => imgContainer.remove());
                                //     updateDisplay();
                                // }

                            });
                            </script>

<script>
document.addEventListener("DOMContentLoaded", () => {
                                // モーダルの背景を取得
                                const modalOpenedBackGround = document.querySelector(".js-gray-cover");
                                // if (!modalOpenedBackGround) {
                                //     console.warn("⚠️ モーダル背景 (js-gray-cover) が見つかりませんでした！");
                                // }
                                
                                const modalContents = document.querySelectorAll(".js-modal-content");
                                const sessionDescription = document.getElementById('session-description');

                                // `sessionStorage` に保存するデータ構造　Laravelから既存データを取得
                                let recipeData = JSON.parse(sessionStorage.getItem('recipeData')) || {
                                    //  url: '', description: '', images: [] 
                                    url: @json($recipe->url ?? ''),
                                    description: @json($recipe->description ?? ''),
                                    images: @json($recipe->images ?? [])
                                    };

                                    sessionStorage.setItem('recipeData', JSON.stringify(recipeData));

                                // ✅ 取得したデータをフォームに反映
                                document.getElementById('url').value = recipeData.url || "";
                                document.getElementById('recipe_description_input').value = recipeData.description || "";

                                // ✅ 画像を表示
                                const sessionDescription = document.getElementById('session-description');
                                sessionDescription.innerHTML = ""; // 一度クリア

                                recipeData.images.forEach(imgURL => {
                                    const imgContainer = document.createElement('div');
                                    imgContainer.classList.add("relative", "inline-block");

                                    const img = document.createElement('img');
                                    img.src = imgURL;
                                    img.classList.add("w-20", "h-20", "object-cover", "rounded-md");

                                    const removeBtn = document.createElement('button');
                                    removeBtn.textContent = "✖️";
                                    removeBtn.classList.add("absolute", "top-0", "right-0", "bg-red-500", "text-white", "text-xs", "px-1", "rounded-full");
                                    removeBtn.onclick = () => {
                                        imgContainer.remove();
                                        recipeData.images = recipeData.images.filter(i => i !== imgURL);
                                        sessionStorage.setItem("recipeData", JSON.stringify(recipeData));
                                    };

                                    imgContainer.appendChild(img);
                                    imgContainer.appendChild(removeBtn);
                                    sessionDescription.appendChild(imgContainer);
                                });

                                
                                // ✅ データを適切に表示する関数（URL → 説明 → 画像 の順に表示）
                                function updateDisplay() {
                                    sessionDescription.innerHTML = ""; // まずクリアにする

                                    //1️⃣ URLを表示
                                    if (recipeData.url) {
                                        const urlElement = document.createElement('p');
                                        urlElement.textContent = `URL: ${recipeData.url}`;
                                        sessionDescription.appendChild(urlElement);
                                    }

                                    // 2️⃣ 説明を表示
                                    if (recipeData.description) {
                                        const descriptionElement = document.createElement('p');
                                        descriptionElement.textContent = recipeData.description;
                                        sessionDescription.appendChild(descriptionElement);
                                    }

                                    // 3️⃣ 画像を表示
                                    if (recipeData.images.length > 0) {
                                        recipeData.images.forEach(imgURL => {
                                            const imgContainer = document.createElement('div');
                                            imgContainer.classList.add("relative", "inline-block");

                                            const img = document.createElement('img');
                                            img.src = imgURL;
                                            img.classList.add("w-20", "h-20", "object-cover", "rounded-md");

                                            const removeBtn = document.createElement('button');
                                            removeBtn.textContent = "✖️";
                                            removeBtn.classList.add("absolute", "top-0", "right-0", "bg-red-500", "text-white", "text-xs", "px-1", "rounded-full");
                                            removeBtn.onclick = () => {
                                                imgContainer.remove();
                                                recipeData.images = recipeData.images.filter(i => i !== imgURL);
                                                sessionStorage.setItem('recipeData', JSON.stringify(recipeData));
                                            };

                                            imgContainer.appendChild(img);
                                            imgContainer.appendChild(removeBtn);
                                            sessionDescription.appendChild(imgContainer);
                                        });
                                    }
                                }

                                // ✅ URLの追加
                                function addURL() {
                                    const url = document.getElementById('url').value;
                                    if (url.trim() !== '') {
                                        recipeData.url = url;
                                        // sessionStorage.setItem('url', url);
                                        sessionStorage.setItem('recipeData', JSON.stringify(recipeData));
                                        updateDisplay(); // 表示更新

                                        // const urlElement = document.createElement('p');
                                        // urlElement.textContent = `URL: ${url}`;
                                        // sessionDescription.appendChild(urlElement);
                                        // closeModal();

                                        // toggleModal(document.querySelector(".js-url-content"), false);
                                    }
                                    toggleModal(document.querySelector(".js-url-content"), false);
                                }

                                // ✅ 説明の追加
                                function addInstructions() {
                                    const description = document.getElementById('recipe_description_input').value;
                                    // recipeData.description = description;
                                    // // sessionStorage.setItem('description', description);
                                    // sessionStorage.setItem('recipeData', JSON.stringify(recipeData));

                                    // document.getElementById('recipe_description_input').value = description;
                                    // sessionDescription.textContent = description;
                                    // // closeModal();
                                    if (description.trim() !== '') {
                                        recipeData.description = description;
                                        sessionStorage.setItem('recipeData', JSON.stringify(recipeData));
                                        updateDisplay(); // 表示更新
                                    }

                                    toggleModal(document.querySelector("#descriptionModal"), false);
                                }

                                // ✅ 画像の追加
                                function addImages() {
                                    const input = document.getElementById('image-upload');
                                    if (input.files.length > 0) {
                                        // let imageArray = JSON.parse(sessionStorage.getItem('images')) || [];
                                        Array.from(input.files).forEach(file => {
                                            const imgURL = URL.createObjectURL(file);
                                            recipeData.images.push(imgURL);
                                        
                                        });

                                        sessionStorage.setItem('recipeData', JSON.stringify(recipeData));
                                        updateDisplay(); // 表示更新
                                        // closeModal();
                                        // toggleModal(document.querySelector(".js-image-content"), false);
                                    }
                                    toggleModal(document.querySelector(".js-image-content"), false);
                                }

                                // ✅ ページ読み込み時にデータを復元
                                function restoreSessionData() {
                                    updateDisplay();
                                }
                                // updateDisplay();

                                // ✅　`edit` ページの判定
                                const isEditPage = window.location.href.includes("edit");

                                if (!isEditPage) {
                                    sessionStorage.removeItem('recipeData'); // 画像と説明のデータを削除
                                    sessionDescription.innerHTML = "";
                                } else {
                                    restoreSessionData();
                                }

                                // ✅ モーダルの開閉を統一化
                                function toggleModal(modal, show = true) {
                                    if (!modal) return;
                                    modal.classList.toggle("hidden", !show);
                                    document.querySelector(".js-gray-cover")?.classList.toggle("hidden", !show);
                                }

                                // ✅ ページ読み込み時に `sessionStorage` から復元
                                // function restoreSessionData() {
                                    
                                //     if (recipeData.url) {
                                //         const urlElement = document.createElement('p');
                                //         urlElement.textContent = `URL: ${recipeData.url}`;
                                //         sessionDescription.appendChild(urlElement);
                                //     }

                                //     if (recipeData.description) {
                                //         document.getElementById('recipe_description_input').value = recipeData.description;
                                //         sessionDescription.textContent = recipeData.description;
                                //     }

                                //     if (recipeData.images.length > 0) {
                                //         recipeData.images.forEach(imgURL => {
                                //             const imgContainer = document.createElement('div');
                                //             imgContainer.classList.add("relative", "inline-block");

                                //             const img = document.createElement('img');
                                //             img.src = imgURL;
                                //             img.classList.add("w-20", "h-20", "object-cover","rounded-md");

                                //             const removeBtn = document.createElement('button');
                                //             removeBtn.textContent = "✖️";
                                //             removeBtn.classList.add("absolute", "top-0", "right-0", "bg-red-500", "text-white", "text-xs", "px-1", "rounded-full");
                                //             removeBtn.onclick = () => {
                                //                 imgContainer.remove();
                                //                 recipeData.images = recipeData.images.filter(i => i !== imgURL);
                                //                 sessionStorage.setItem('recipeData', JSON.stringify(recipeData));
                                //             };

                                //             imgContainer.appendChild(img);
                                //             imgContainer.appendChild(removeBtn);
                                //             sessionDescription.appendChild(imgContainer);
                                //         });
                                //     }
                                // }

                            
                            

                                // restoreSessionData();

                                // ✅ モーダルを開く関数
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

                                        // console.log("🔍 取得したモーダル:", modal);
                                        if (modal) toggleModal(modal, true);
                                    }

                                    if (event.target.classList.contains("bg-gray-500")) {
                                        toggleModal(event.target.closest(".js-modal-content"), false);
                                    }
                                });

                                
                                // ✅ 各ボタンのイベントリスナー設定
                                [
                                    { id: 'add-instructions-id', handler: addInstructions },
                                    { id: 'add-url-id', handler: addURL },
                                    { id: 'add-images-id', handler: addImages }
                                ].forEach(({ id, handler }) => {
                                    const button = document.getElementById(id);
                                    if (button) {
                                        button.addEventListener('click', handler);
                                    } else {
                                        console.warn(`ボタン (${id}) が見つかりませんでした！`);
                                    }
                                });

                                // const saveButton = document.getElementById('save-recipe-btn'); // 保存ボタンのIDを指定

                                // ✅ 保存ボタンが押されたら `sessionStorage` をクリア
                                const saveButton = document.getElementById('save-recipe-btn'); // 保存ボタンのIDを指定
                                if (saveButton) {
                                    saveButton.addEventListener('click', () => {
                                        sessionStorage.removeItem('recipeData'); // 画像と説明のデータを削除
                                    });
                                }
                                // } else {
                                //     console.warn("保存ボタン (save-recipe-btn) が見つかりませんでした");
                                // }

                                // URLに `edit` が含まれている場合は sessionStorage をクリアしない
                                // const isEditPage = window.location.href.includes("edit");

                                // if (!isEditPage) {
                                //     sessionStorage.removeItem('recipeData'); // 画像と説明のデータを削除

                                //     const sessionDescription = document.getElementById('session-description');
                                //     if (sessionDescription) {
                                //         sessionDescription.textContent = "";
                                //     }

                                //     const imageContainers = sessionDescription.querySelectorAll("div.relative.inline-block");
                                //     imageContainers.forEach(imgContainer => imgContainer.remove());
                                //     updateDisplay();
                                // }

                            });
                        </script>