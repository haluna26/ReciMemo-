<x-app-layout>
    <h1>レシピの作成</h1>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="/recipes" method="POST">
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
                    <div class="js-gray-cover hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 cursor-pointer"></div>
                        <form class="w-full">
                        <div class="js-gray-cover hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 cursor-pointer"></div>
                        <form class="w-full">
                        <div>
                            <div class="js-url-btn modal-btn cursor-pointer">URL(クリックするとURL入力のモーダルが開く)</div>
                            <div class="js-url-content hidden js-modal-content max-w-md min-h-[300px] bg-white absolute top-24 mx-auto left-0 right-0 p-4 rounded-lg">
                            <label>url入力</label>
                            <input type="text" name="recipe[url]" class="border border-gray-300 rounded w-full p-2"/>
                            </div>
                        </div>
                        
                        <div>
                            <div class="js-image-btn modal-btn cursor-pointer">画像(クリックすると画像入力のモーダルが開く)</div>
                            <div class="js-image-content hidden js-modal-content max-w-md min-h-[300px] bg-white absolute top-24 mx-auto left-0 right-0 p-4 rounded-lg">
                            <label>画像選択</label>
                            <input type="file" name="recipe[image]" class="border border-gray-300 rounded w-full"/>
                            </div>
                        </div>

                        <div>
                            <div class="js-explanation-btn modal-btn cursor-pointer">説明(クリックすると説明入力のモーダルが開く)</div>
                            <div class="js-explanation-content hidden js-modal-content max-w-md min-h-[300px] bg-white absolute top-24 mx-auto left-0 right-0 p-4 rounded-lg">
                            <label>説明入力</label>
                            <input type="text" name="recipe[description]" class="border border-gray-300 rounded w-full"/>
                            </div>
                        </div>
                        </form>

                        <script>
                        const modalContent = document.querySelectorAll(".js-modal-content");
                        const modalOpendBackGround = document.querySelector(".js-gray-cover");

                        // 背景をクリックしたらモーダルを閉じる
                        modalOpendBackGround.addEventListener("click", () => {
                            modalOpendBackGround.classList.add("hidden");
                            modalContent.forEach((modal) => {
                            modal.classList.add("hidden");
                            });
                        });

                        // モーダル内のクリックイベントが背景に伝播しないようにする
                        modalContent.forEach((modal) => {
                            modal.addEventListener("click", (e) => {
                            e.stopPropagation(); // これでモーダル内クリックが背景クリックに伝播しない
                            });
                        });

                        // モーダルのトグルを設定する関数
                        const setupModalToggle = (buttonSelector, modalSelector) => {
                            const button = document.querySelector(buttonSelector);
                            const modal = document.querySelector(modalSelector);
                            
                            if (button && modal) {
                            button.addEventListener("click", () => {
                                modalOpendBackGround.classList.remove("hidden");
                                modal.classList.remove("hidden");
                            });
                            } else {
                            console.log("エラー");
                            }
                        };

                        // ボタンとモーダルのトグル設定
                        setupModalToggle('.js-url-btn', '.js-url-content');
                        setupModalToggle('.js-image-btn', '.js-image-content');
                        setupModalToggle('.js-explanation-btn', '.js-explanation-content');
                        </script>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="memo">
                                <div class="memo">
                                    <h2>メモ</h2>
                                    </label>
                                    <textarea name="recipe[memo]" placeholder="ご自由にどうぞ" class="w-2/5" rows="5">{{ old('recipe.memo') }}</textarea>
                                </div>
                         </div>
                                @csrf
                                <!-- <input type="submit" value="保存" class="submit bg-blue-700 font-semibold text-white py-1 px-2 rounded inline-block text-center cursor-pointer hover:bg-green-500 border"> -->
                                <button type="submit" class="bg-blue-500 text-white p-2 rounded">保存</button>
                            </form>
                            <div class="footer">
                                 <a href="/">戻る</a>
                            </div>
            </div>
        </div>
    </div>
</x-app-layout>





<!-- 画面分割用create -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('レシピの作成') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- フレックスボックスによる左右配置 -->
            <div class="flex space-x-4 w-full">
                <!-- 左側のコンテンツ -->
                <div class="bg-white shadow-sm sm:rounded-lg w-3/4 p-6">
                    <div class="border-b border-gray-200">
                        <!-- レシピ作成フォーム -->
                        <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                                    レシピ名
                                </label>
                                <input type="text" id="title" name="recipe[title]" placeholder="レシピ名" value="{{ old('recipe.title') }}" 
                                    class="shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <p class="name__error" style="color:red">{{ $errors->first('recipe.title') }}</p>
                            </div>
                            <!-- 以下、フォーム項目は省略 -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="value">
                                    満足度
                                </label>
                                <select id="value" name="recipe[value]" class="border-2 border-gray-400 rounded-md p-2">
                                    <option value="">選択してください</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                /5
                                <p class="value__error text-red-500">{{ $errors->first('recipe.value') }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="level">
                                    難易度
                                </label>
                                <select id="value" name="recipe[level]" class="border-2 border-gray-400 rounded-md p-2">
                                    <option value="">選択してください</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                /5
                                <p class="level__error text-red-500">{{ $errors->first('recipe.value') }}</p>
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
                            <div>
                                <div class="js-url-btn modal-btn cursor-pointer">URL(クリックするとURL入力のモーダルが開く)</div>
                                <div class="js-url-content hidden js-modal-content max-w-md min-h-[300px] bg-white absolute top-24 mx-auto left-0 right-0 p-4 rounded-lg">
                                    <label for="url">URL入力</label>
                                    <input type="text" id="url" name="recipe[url]" class="border border-gray-300 rounded w-full p-2"/>
                                </div>
                            </div>

                            <!-- 画像選択モーダル -->
                            <div>
                                <div class="js-image-btn modal-btn cursor-pointer">画像(クリックすると画像入力のモーダルが開く)</div>
                                <div class="js-image-content hidden js-modal-content max-w-md min-h-[300px] bg-white absolute top-24 mx-auto left-0 right-0 p-4 rounded-lg">
                                    <label for="image">画像選択</label>
                                    <input type="file" id="image" name="recipe[image]" class="border border-gray-300 rounded w-full"/>
                                </div>
                            </div>

                            <!-- 説明入力モーダル -->
                            <div>
                                <div class="js-explanation-btn modal-btn cursor-pointer">説明(クリックすると説明入力のモーダルが開く)</div>
                                <div class="js-explanation-content hidden js-modal-content max-w-md min-h-[300px] bg-white absolute top-24 mx-auto left-0 right-0 p-4 rounded-lg">
                                    <label for="description">説明入力</label>
                                    <input type="text" id="description" name="recipe[description]" class="border border-gray-300 rounded w-full"/>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="instructions">
                                    メモ
                                </label>
                                <textarea id="instructions" name="recipe[instructions]" placeholder="ご自由にどうぞ" class="w-3/5" rows="5">{{ old('recipe.instructions') }}</textarea>
                            </div>
                            <button type="submit" class="bg-blue-500 text-white p-2 rounded">保存</button>
                        </form>

                        <!-- 戻るリンク -->
                        <div class="mt-4">
                            <a href="/" class="text-blue-500 hover:underline">戻る</a>
                        </div>
                    </div>
                </div>
                
                <!-- 右側のコンテンツ -->
                <div class="bg-white shadow-sm sm:rounded-lg w-1/4 p-6">
                    <div>
                        <!-- お買い物リスト -->
                        <livewire:shopping-cart />
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
</x-app-layout>




