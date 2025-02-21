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
                                <form action="{{ route('recipes.storeFinal') }}" method="POST" enctype="multipart/form-data">
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
                                                <option value="new">＋新しいカテゴリーを作成</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- 新しいカテゴリー入力欄（最初は非表示） -->
                                        <div id="new-category-container" style="display: none; margin-top: 10px;">
                                            <input type="text" name="new_category" id="new-category-input" placeholder="新しいカテゴリー名を入力">
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
                                    <!-- URL入力モーダル -->
                                    <div class="flex w-full gap-x-1">
                                    <div>
                                        <div class="js-url-btn modal-btn px-2 py-1 bg-stone-950 text-lg text-white rounded-full hover:bg-stone-500 cursor-pointer flex-grow">URL</div>
                                        <div class="js-url-content hidden js-modal-content max-w-[800px] min-h-[120px] bg-white absolute mx-auto p-4 rounded-lg">
                                            <label for="url">URL</label>
                                            <input type="text" id="url" name="recipe[url]" value="{{ old('recipe.url') }}" class="border border-gray-300 rounded w-[600px] p-2"/>
                                            <!-- <button onclick="addInstructions()" class="bg-blue-500 text-white px-4 py-2 rounded">追加</button>
                                            <button onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">閉じる</button> -->
                                        </div>
                                    </div>

                                    <!-- 説明入力モーダル -->
                                    <div>
                                        <div class="js-explanation-btn modal-btn px-2 py-1 bg-stone-950 text-lg text-white rounded-full hover:bg-stone-500 cursor-pointer flex-grow">説明</div>
                                        <!-- モーダル -->
                                         <div id="descriptionModal" class="fixed inset-0 bg-black-500 bg-opacity-75 flex items-center justify-center hidden">
                                            <div class="relative bg-white p-6 rounded-lg max-w-3xl w-full max-h-[90vh] overflow-y-auto">
                                                
                                                <!-- 説明入力欄 -->
                                            <div class="mb-4">
                                                <lavel for="description">説明入力</lavel>
                                                <textarea id="recipe_description_input" name="recipe[description]" class="border border-gray-300 rounded w-full p-2 h-[470px]" maxlength="1000" rows="8">{{ old('recipe.description', session('recipe.description')) }}</textarea>
                                                <!-- 説明内容を格納する隠しフィールド -->
                                                <!-- <input type="hidden" id="recipe_description" name="recipe[description]" value="{{ old('recipe.description') }}"> -->
                                                <!-- h-[470px]＝テキストエリアの高さを設定。max-h-[90vh]＝モーダルの最大高さを画面の90%に設定。 -->
                                            </div>
                                                <button onclick="addInstructions()" class="bg-blue-500 text-white px-4 py-2 rounded">追加</button>
                                                <button onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">閉じる</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- 画像選択モーダル -->
                                    <div>
                                        <div class="js-image-btn modal-btn px-2 py-1 bg-stone-950 text-lg text-white rounded-full hover:bg-stone-500 cursor-pointer flex-grow">画像</div>
                                        <div class="js-image-content hidden js-modal-content max-w-md min-h-[230px] bg-white absolute p-4 rounded-lg">
                                            <!-- <label for="image">画像選択</label> -->
                                            <label><input type="file" name="recipe[images][]"></label><br>
                                            <label><input type="file" name="recipe[images][]"></label><br>
                                            <label><input type="file" name="recipe[images][]"></label><br>
                                            <label><input type="file" name="recipe[images][]"></label><br>
                                            <label><input type="file" name="recipe[images][]"></label><br>

                                            <!-- name="recipe[images][]"⇨複数のファイルを配列として送信　multiple を追加することで、一度に複数の画像を選択 -->
                                            <!-- <input type="file" id="image" name="recipe[images][]" class="border border-gray-300 rounded w-full multiple"/> -->
                                            <!-- <div id="image-upload-area">
                                                <input type="file" name="recipe[images][]" class="image-input">
                                            </div> -->


                                            <!-- <button onclick="addInstructions()" class="bg-blue-500 text-white px-4 py-2 rounded">追加</button>
                                            <button onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">閉じる</button> -->
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

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold mb-2" for="instructions">
                                            メモ
                                        </label>
                                        <textarea id="instructions" name="recipe[instructions]" placeholder="ご自由にどうぞ" class="w-3/5" rows="5">{{ old('recipe.instructions') }}</textarea>
                                    </div>
                                    <button type="submit" class="bg-blue-500 text-white p-2 rounded">保存</button>
                            </form>
                            <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const modalOpenedBackGround = document.querySelector(".js-gray-cover");
                                const modalContents = document.querySelectorAll(".js-modal-content");

                                // モーダルを開くボタンのリスト
                                const modalButtons = document.querySelectorAll(".modal-btn");

                                modalButtons.forEach(button => {
                                    button.addEventListener("click", (event) => {
                                        // クリックされたボタンに対応するモーダルを取得
                                        const modal = button.closest(".modal-container")?.querySelector(".js-modal-content");
                                        if (!modal) return;

                                        // クリック位置を取得
                                        const clickX = event.clientX;
                                        const clickY = event.clientY;
                                        
                                        // モーダルの位置を設定（オフセットを考慮）
                                        modal.style.left = `${clickX}px` ;
                                        modal.style.top = `${clickY}px` ;
                                        modal.style.position = "absolute"; //絶対位置指定
                                        modal.style.transform = "translate(-50%, -50%)"; // モーダルの中心をクリック位置に調整

                                        // モーダルを表示
                                        modalOpenedBackGround.classList.remove("hidden");
                                        modal.classList.remove("hidden");

                                        // モーダル内の追加ボタンにイベントリスナーを追加
                                        const addButton = modal.querySelector(".add-btn");
                                        if (addButton) {
                                            addButton.addEventListener("click", () => {
                                                addInstructions(); // 説明をセッションストレージに保存する関数
                                            });
                                        }
                                    });
                                });
                                //背景をクリックしたらモーダルを閉じる
                                modalOpenedBackGround.addEventListener("click", () => {
                                    modalOpenedBackGround.classList.add("hidden");
                                    modalContents.forEach(modal => modal.classList.add("hidden"));
                                });

                                // モーダル内のクリックイベントが背景に伝播しないようにする
                                modalContents.forEach((modal) => {
                                    modal.addEventListener("click", (e) => {
                                        e.stopPropagation(); // モーダル内クリックが背景クリックに伝播しない
                                    });
                                });

                                // モーダルを閉じる関数
                                function closeModal() {
                                    modalOpenedBackGround.classList.add("hidden");
                                    modalContents.forEach(modal => modal.classList.add("hidden"));
                                }

                                // 追加と登録ボタンをモーダルに表示＋モーダルの説明をsessionStorageに保存する関数
                                function addInstructions() {
                                    const description = document.getElementById('recipe_description_input').value;

                                // 一時的に保存（sessionStorageまたはlocalStorageを使用）
                                sessionStorage.setItem('description', description);

                                // フォームにデータを反映
                                document.getElementById('recipe_description_input').value = description;

                                // モーダルを閉じる
                                closeModal();
                                }

                                // 説明モーダル用
                                const setupDescriptionModal = () => {
                                    const button = document.querySelector('.js-explanation-btn');
                                    const modal = document.querySelector('#descriptionModal');
                                    if (button && modal) {
                                        button.addEventListener("click", () => {
                                            modalOpenedBackGround.classList.remove("hidden");
                                            modal.classList.remove("hidden");
                                        });
                                    }
                                };

                                // 説明モーダルトグル設定
                                setupDescriptionModal();
                            

                            // // 説明モーダルを閉じる
                            // function closeDescriptionModal() {
                            //     document.getElementById('descriptionModal').classList.add('hidden');
                            //     document.querySelector('js-gray-cover').classList.add('hidden');
                            // }

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

                                // // 新しいカテゴリーを選択したときに、入力欄を表示するスクリプト
                                // document.getElementById('category_id').addEventListener('change', function() {
                                //     let newCategoryContainer = document.getElementById('new-category-container');
                                //     if (this.value === 'new') {
                                //         newCategoryContainer.style.display = 'block';
                                //     } else {
                                //         newCategoryContainer.style.display = 'none';
                                //     }
                                // });
                            });
                            
                            </script>
                            <div class="mt-4">
                                <a href="/" class="text-blue-500 hover:underline">戻る</a>
                            </div>
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
    @livewireScripts
</x-app-layout>














