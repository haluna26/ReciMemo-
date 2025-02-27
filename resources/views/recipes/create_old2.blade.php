<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('レシピ作成') }}
        </h2>
    </x-slot>
    
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- フレックスボックスによる左右配置 -->   
                <div class="flex space-x-4 w-full justify-between">
                <!-- 左側のコンテンツ -->
                    <div class="bg-white shadow-sm sm:rounded-lg w-3/4 p-6">
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
                                                <!-- <option value="new">＋新しいカテゴリーを作成</option> -->
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- 新しいカテゴリー入力欄（最初は非表示） -->
                                        <!-- <div id="new-category-container" style="display: none; margin-top: 10px;">
                                            <input type="text" name="new_category" id="new-category-input" placeholder="新しいカテゴリー名を入力">
                                        </div> -->
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
                                                    <textarea id="recipe_description_input" name="recipe[description]" 
                                                            class="border border-gray-300 rounded w-full p-2 h-[470px]" maxlength="1000" rows="8">
                                                        {{ old('recipe.description', '') }}
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

                                    <div><div id="session-description"></div></div>

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
                    </div>
                
                
                <script>
                document.addEventListener("DOMContentLoaded", () => {
                    // モーダルの背景を取得
                    const modalOpenedBackGround = document.querySelector(".js-gray-cover");
                    const modalContents = document.querySelectorAll(".js-modal-content");
                    const sessionDescription = document.getElementById('session-description');

                    // ✅ create ページを開くたびに sessionStorage をリセット
                    sessionStorage.removeItem("recipeData");

                    // `recipeData` の初期化
                    let recipeData = {
                        url: "",
                        description: "",
                        images: []
                    };

                    // ✅ URL入力時に sessionStorage に保存
                    document.getElementById('url').addEventListener("input", (e) => {
                        recipeData.url = e.target.value;
                        sessionStorage.setItem("recipeData", JSON.stringify(recipeData));
                    });

                    // ✅ 説明入力時に sessionStorage に保存
                    document.getElementById('recipe_description_input').addEventListener("input", (e) => {
                        recipeData.description = e.target.value;
                        sessionStorage.setItem("recipeData", JSON.stringify(recipeData));
                    });

                    // ✅ 画像を追加時に sessionStorage に保存
                    document.getElementById('image-upload').addEventListener("change", (e) => {
                        Array.from(e.target.files).forEach(file => {
                            const imgURL = URL.createObjectURL(file);
                            recipeData.images.push(imgURL);
                        });

                        sessionStorage.setItem("recipeData", JSON.stringify(recipeData));
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

                            
                        }
                        toggleModal(document.querySelector(".js-url-content"), false);
                    }

                    // ✅ 説明の追加
                    function addInstructions() {
                        const description = document.getElementById('recipe_description_input').value;
                        
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
                            Array.from(input.files).forEach(file => {
                                const imgURL = URL.createObjectURL(file);
                                recipeData.images.push(imgURL);
                            });

                            sessionStorage.setItem('recipeData', JSON.stringify(recipeData));
                            updateDisplay(); // 表示更新
                        }
                        toggleModal(document.querySelector(".js-image-content"), false);
                    }

                    // ✅ ページ読み込み時にデータを復元
                    updateDisplay();

                    // ✅ モーダルの開閉を統一化
                    function toggleModal(modal, show = true) {
                        if (!modal) return;
                        modal.classList.toggle("hidden", !show);
                        document.querySelector(".js-gray-cover")?.classList.toggle("hidden", !show);
                    }

                    // ✅ ページ読み込み時に `sessionStorage` から復元
                    function restoreSessionData() {
                        if (recipeData.url) {
                            const urlElement = document.createElement('p');
                            urlElement.textContent = `URL: ${recipeData.url}`;
                            sessionDescription.appendChild(urlElement);
                        }

                        if (recipeData.description) {
                            document.getElementById('recipe_description_input').value = recipeData.description;
                            sessionDescription.textContent = recipeData.description;
                        }

                        if (recipeData.images.length > 0) {
                            recipeData.images.forEach(imgURL => {
                                const imgContainer = document.createElement('div');
                                imgContainer.classList.add("relative", "inline-block");

                                const img = document.createElement('img');
                                img.src = imgURL;
                                img.classList.add("w-20", "h-20", "object-cover","rounded-md");

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

                    restoreSessionData();

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

                    // ✅ 保存ボタンが押されたら `sessionStorage` をクリア
                    const saveButton = document.getElementById('save-recipe-btn'); // 保存ボタンのIDを指定
                    if (saveButton) {
                        saveButton.addEventListener('click', () => {
                            sessionStorage.removeItem('recipeData'); // 画像と説明のデータを削除
                        });
                    }

                    // URLに `edit` が含まれている場合は sessionStorage をクリアしない
                    const isEditPage = window.location.href.includes("edit");

                    if (!isEditPage) {
                        sessionStorage.removeItem('recipeData'); // 画像と説明のデータを削除

                        const sessionDescription = document.getElementById('session-description');
                        if (sessionDescription) {
                            sessionDescription.textContent = "";
                        }

                        const imageContainers = sessionDescription.querySelectorAll("div.relative.inline-block");
                        imageContainers.forEach(imgContainer => imgContainer.remove());
                        updateDisplay();
                    }

                });
                </script>

                        
               
                <div class="bg-white shadow-sm sm:rounded-lg w-1/4">
                    <div class="p-6">
                    <livewire:shopping-cart />
                    </div>
                </div> 
            </div>
        </div>
</x-app-layout>

public function update(Request $request, $id)
    {
        //バーリデーション
        $validated = $request->validate([
            'recipe.title' => 'required|string|max:255',
            'recipe.ingredients' => 'required|string',
            'recipe.description' => 'nullable|string|max:1000',
            'new_category' => 'nullable|string|max:255'
        ]);
        $data = $request->all();
        $data['recipe']['title'] = $validated['recipe']['title'];
        $data['recipe']['ingredients'] = $validated['recipe']['ingredients'];
        $data['recipe']['user_id'] = Auth::id(); // ユーザーIDを追加

        $categoryId = $request->input('recipe.category_id');
        
        $recipe = Recipe::findOrFail($id);

        $recipe->fill($data['recipe']);
        
        $recipe->category_id = $categoryId;

        //　画像の保存処理
        $imagePaths = []; // 画像のパスを保存する配列
        if ($request->hasFile('recipe.images')) {
            foreach ($request->file('recipe.images') as $image) {
                $path = $image->store('images', 'public'); // storage/app/public/imagesに保存
                $imagePaths[] = $path;
            }
        }
        $recipe->image = !empty($imagePaths) ? json_encode($imagePaths) : json_encode([]);

        $recipe->save(); //レシピを更新
        
        return redirect()->route('recipes.index')->with('success', 'レシピが更新されました');
    }

    public function update(Request $request, $id)
    {
    // バリデーションルール（必要に応じて URL や category_id のバリデーションも追加）
    $validated = $request->validate([
        'recipe.title'        => 'required|string|max:255',
        'recipe.ingredients'  => 'required|string',
        'recipe.description'  => 'nullable|string|max:1000',
        'recipe.category_id'  => 'required|integer|exists:categories,id',
        // 'recipe.url'       => 'nullable|url', // URL更新が必要なら
        'new_category'        => 'nullable|string|max:255'
    ]);

    // 該当レシピの取得
    $recipe = Recipe::findOrFail($id);

    // 新規カテゴリー処理（必要なら）
    if (!empty($validated['new_category'])) {
        // 例：新しいカテゴリーを作成して、そのIDを使用する処理
        $newCategory = Category::create(['name' => $validated['new_category']]);
        $validated['recipe']['category_id'] = $newCategory->id;
    }

    // バリデーション済みのデータで更新（必要なフィールドだけ）
    $recipe->fill($validated['recipe']);

    // ユーザーIDの更新（必要なら）
    $recipe->user_id = Auth::id();

    // 画像の保存処理
    $imagePaths = [];
    if ($request->hasFile('recipe.images')) {
        foreach ($request->file('recipe.images') as $image) {
            $path = $image->store('images', 'public'); // storage/app/public/images に保存
            $imagePaths[] = $path;
        }
    }
    // 画像がアップロードされていれば、画像情報を更新する
    if (!empty($imagePaths)) {
        // キャストを使っているなら配列をそのまま代入
        $recipe->image = $imagePaths;
    }
    // （アップロードされなければ既存画像をそのまま保持する場合は、何もしない）

    // 更新を保存
    $recipe->save();

    return redirect()->route('recipes.index')->with('success', 'レシピが更新されました');
    }

    public function delete(Recipe $recipe)
    {
        $recipe->delete();
        return redirect('/recipes');
    }

    // セッションにデータを一時保存
    public function store(Request $request)
    {
    
    $validated = $request->validate([
        'recipe.title' => 'required|string|max:255',
        'recipe.ingredients' => 'required|string',
        'recipe.value' => 'nullable|integer|min:1|max:5',
        'recipe.level' => 'nullable|integer|min:1|max:5',
        'recipe.description' => 'nullable|string|max:1000',
        'recipe.url' => 'nullable|url', // ★ ここを追加
        'recipe.images.*' => 'nullable|image|max:2048', // ”一枚あたり”2MBまで
        // 'new_category' => 'nullable|string|max:255',
        'recipe.category_id' => 'required|integer|exists:categories,id'
    ]);

    // 画像の保存
    $imagePaths = [];
    if ($request->hasFile('recipe.images')) {
        // $imagePaths = [];
        foreach ($request->file('recipe.images') as $image) {
            $path = $image->store('images', 'public'); // storage/app/public/imagesに保存
            $imagePaths[] = $path;
        }
        
    }
    
   

    // レシピデータをデータベースに保存
    $recipe = new Recipe();
    $recipe->title = $validated['recipe']['title'];
    $recipe->ingredients = $validated['recipe']['ingredients'];
    $recipe->value = $validated['recipe']['value'] ?? null;
    $recipe->level = $validated['recipe']['level'] ?? null;
    $recipe->description = $validated['recipe']['description'] ?? ''; // 説明はセッションから取得
    $recipe->user_id = Auth::id(); // ユーザIDを取得
    $recipe->url = $validated['recipe']['url'] ?? null;
    $recipe->category_id = $validated['recipe']['category_id'];
    $recipe->image = $imagePaths;
    $recipe->save();

    // セッションをクリア
    session()->forget('recipe');
    
    // セッションに保存したデータをフォームに戻して表示（必要なら）
    return redirect()->route('recipes.index')->with('success', 'レシピが作成されました。');
    }













