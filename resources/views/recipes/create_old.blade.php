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




