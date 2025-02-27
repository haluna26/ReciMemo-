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
                                                <!-- <option value="new">＋新しいカテゴリーを作成</option> -->
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
                                                <input type="text" id="url" name="recipe[url]" value="{{ old('recipe.url', $recipe->url) }}" class="border border-gray-300 rounded w-full p-2">
                                                <button type="button" id="add-url-id" class="bg-blue-500 text-white px-4 py-2 rounded">追加</button>
                                                <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">閉じる</button>
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
                                                    <textarea id="recipe_description_input" name="recipe[description]" value="{{ old('recipe.description', $recipe->description) }}"
                                                            class="border border-gray-300 rounded w-full p-2 h-[470px]" maxlength="1000" rows="8">
                                                        <!-- {{ old('recipe.description', '') }} -->
                                                    </textarea>
                                                </div>
                                                <div class="flex justify-end space-x-2 mt-4">
                                                    <div id="add-instructions-id" class="bg-blue-500 text-white px-4 py-2 rounded">追加</div>
                                                    <div onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">閉じる</div>
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
                                                <label for="image">画像選択</label>
                                                <input type="file" id="image-upload" name="recipe[images][]" multiple class="border border-gray-300 rounded w-full"/>
                                                <div class="flex gap-2 mt-2">
                                                    <button type="button" id="add-images-id" class="bg-blue-500 text-white px-4 py-2 rounded">追加</button>
                                                    <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">閉じる</button>
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
                                                    <img src="{{ asset('storage/' . $image) }}" class="w-32 h-32 object-cover rounded-md">
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    </div>

                                    <!-- <div><div id="session-description"></div></div> -->
                                    
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
                            document.addEventListener("DOMContentLoaded", () => {
                                // 1. スクリプト冒頭でストレージのURL接頭辞を定義
                                const storageUrlPrefix = "{{ asset('storage') }}/";

                                // モーダル背景と必要な要素を取得
                                const modalOpenedBackGround = document.querySelector(".js-gray-cover");
                                const modalContents = document.querySelectorAll(".js-modal-content");
                                const sessionDescription = document.getElementById('session-description');

                                // edit.blade 内で必ず Laravel のデータで上書きする
                                let recipeData = {
                                    url: @json($recipe->url ?? ''),
                                    description: @json($recipe->description ?? ''),
                                    images: @json($recipe->images ?? [])
                                };
                                sessionStorage.setItem('recipeData', JSON.stringify(recipeData));

                                

                                // 入力フォームに初期値を反映
                                document.getElementById('url').value = recipeData.url || "";
                                document.getElementById('recipe_description_input').value = recipeData.description || "";

                                // 既に登録済み画像の表示
                                sessionDescription.innerHTML = ""; // 一度クリア
                                recipeData.images.forEach(imgURL => {
                                    const imgContainer = document.createElement('div');
                                    imgContainer.classList.add("relative", "inline-block");

                                    const img = document.createElement('img');
                                    // img.src = imgURL;
                                     // blob URL の場合はそのまま、そうでなければ storage パスを付与
                                    if (imgURL.startsWith("blob:")) {
                                        img.src = imgURL;
                                    } else {
                                        img.src = storageUrlPrefix + imgURL;
                                    }
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

                                // データ表示を更新する関数（URL、説明、画像の順）
                                function updateDisplay() {
                                    sessionDescription.innerHTML = ""; // クリア

                                    if (recipeData.url) {
                                        const urlElement = document.createElement('p');
                                        urlElement.textContent = `URL: ${recipeData.url}`;
                                        sessionDescription.appendChild(urlElement);
                                    }
                                    if (recipeData.description) {
                                        const descriptionElement = document.createElement('p');
                                        descriptionElement.textContent = recipeData.description;
                                        sessionDescription.appendChild(descriptionElement);
                                    }
                                    // if (recipeData.images.length > 0) {
                                    //     recipeData.images.forEach(imgURL => {
                                    //         const imgContainer = document.createElement('div');
                                    //         imgContainer.classList.add("relative", "inline-block");

                                    //         const img = document.createElement('img');
                                    //         // img.src = imgURL;
                                    //         // blob URL かどうかをチェック
                                    //         if (imgURL.startsWith("blob:")) {
                                    //             img.src = imgURL;
                                    //         } else {
                                    //             img.src = storageUrlPrefix + imgURL;
                                    //         }
                                    //         img.classList.add("w-20", "h-20", "object-cover", "rounded-md");

                                    //         const removeBtn = document.createElement('button');
                                    //         removeBtn.textContent = "✖️";
                                    //         removeBtn.classList.add("absolute", "top-0", "right-0", "bg-red-500", "text-white", "text-xs", "px-1", "rounded-full");
                                    //         removeBtn.onclick = () => {
                                    //             imgContainer.remove();
                                    //             recipeData.images = recipeData.images.filter(i => i !== imgURL);
                                    //             sessionStorage.setItem('recipeData', JSON.stringify(recipeData));
                                    //         };

                                    //         imgContainer.appendChild(img);
                                    //         imgContainer.appendChild(removeBtn);
                                    //         sessionDescription.appendChild(imgContainer);
                                    //     });
                                    // }
                                    if (recipeData.images.length > 0) {
                                        recipeData.images.forEach(imgURL => {
                                            const imgContainer = document.createElement('div');
                                            imgContainer.classList.add("relative", "inline-block");

                                            const img = document.createElement('img');
                                            // blob URL の場合はそのまま、そうでなければ storage パスを付与
                                            if (imgURL.startsWith("blob:")) {
                                                img.src = imgURL;
                                            } else {
                                                img.src = storageUrlPrefix + imgURL;
                                            }
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

                                // モーダルで URL を追加する処理
                                function addURL() {
                                    const url = document.getElementById('url').value;
                                    if (url.trim() !== '') {
                                        recipeData.url = url;
                                        sessionStorage.setItem('recipeData', JSON.stringify(recipeData));
                                        updateDisplay();
                                    }
                                    toggleModal(document.querySelector(".js-url-content"), false);
                                }

                                // モーダルで説明を追加する処理
                                function addInstructions() {
                                    const description = document.getElementById('recipe_description_input').value;
                                    if (description.trim() !== '') {
                                        recipeData.description = description;
                                        sessionStorage.setItem('recipeData', JSON.stringify(recipeData));
                                        updateDisplay();
                                    }
                                    toggleModal(document.querySelector("#descriptionModal"), false);
                                }

                                // モーダルで画像を追加する処理
                                function addImages() {
                                    const input = document.getElementById('image-upload');
                                    if (input.files.length > 0) {
                                        Array.from(input.files).forEach(file => {
                                            const imgURL = URL.createObjectURL(file);
                                            recipeData.images.push(imgURL);
                                        });
                                        sessionStorage.setItem('recipeData', JSON.stringify(recipeData));
                                        updateDisplay();
                                    }
                                    toggleModal(document.querySelector(".js-image-content"), false);
                                }

                                // restoreSessionData() は updateDisplay() と同等
                                updateDisplay();

                                // モーダルの開閉処理
                                function toggleModal(modal, show = true) {
                                    if (!modal) return;
                                    modal.classList.toggle("hidden", !show);
                                    document.querySelector(".js-gray-cover")?.classList.toggle("hidden", !show);
                                }

                                // モーダルオープンのためのイベントリスナー
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
                                        toggleModal(event.target.closest(".js-modal-content"), false);
                                    }
                                });

                                // 各モーダルの「追加」ボタンにイベントリスナーを設定
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

                                // edit ページには保存ボタンの id が無いので、ここでの sessionStorage クリア処理は不要
                            });
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