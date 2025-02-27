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
    <!-- @livewireScripts -->
</x-app-layout>


<script>
const modalOpenedBackGround = document.querySelector(".js-gray-cover");
                            const modalContents = document.querySelectorAll(".js-modal-content");

                              // モーダルを閉じる関数
                              function closeModal() {
                                    modalOpenedBackGround.classList.add("hidden");
                                    modalContents.forEach(modal => modal.classList.add("hidden"));
                                }

                                // urlの追加と閉じる
                                function addURL() {
                                    const url = document.getElementById('url').value;
                                    if (url.trim() !== '') {
                                        fetch('/recipes/save-url', {
                                            method: 'POST',
                                            headers: {
                                                'Content-type': 'application/json',
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                            },
                                            body: JSON.stringify({ url: url })
                                        }).then(response => response.json())
                                          .then(data => {
                                            if (data.success) {
                                                const sessionDescription = document.getElementById('session-description');
                                                const urlElement = document.createElement('p');
                                                urlElement.textContent = `URL: ${url}`;
                                                sessionDescription.appendChild(urlElement);
                                                closeModal();
                                            }
                                          });
                                    }
                                }

                                // 追加と登録ボタンをモーダルに表示＋モーダルの説明をsessionStorageに保存する関数
                                function addInstructions() {
                                    const description = document.getElementById('recipe_description_input').value;

                                // 一時的に保存（sessionStorageまたはlocalStorageを使用）
                                sessionStorage.setItem('description', description);

                                // フォームにデータを反映
                                document.getElementById('recipe_description_input').textContent = description;
                                document.getElementById('session-description').textContent = description;

                                // モーダルを閉じる
                                closeModal();
                                modalContents.forEach(modal => modal.classList.add("hidden"));
                                }

                                // imageの追加と閉じる
                                function addImages() {
                                    const input = document.getElementById('image-upload');
                                    const sessionDescription = document.getElementById('session-description');

                                    if (input.files.length > 0) {
                                        Array.from(input.files).forEach(file => {
                                            const img = document.createElement('img');
                                            img.src = URL.createObjectURL(file);
                                            img.classList.add("w-20", "h-20", "object-cover","rounded-md", "mr-2");
                                            sessionDescription.appendChild(img);
                                        });
                                        closeModal();
                                    }
                                }

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
                                setupModalToggle('.js-explanation-btn', '.js-explanation-content');
                                setupModalToggle('.js-url-btn', '.js-url-content');
                                setupModalToggle('.js-image-btn', '.js-image-content');

                                // モーダルを開くボタンの設定
                                document.querySelectorAll(".js-url-btn, .js-description-btn, .js-image-btn").forEach(button => {
                                    console.log("モーダルボタン:", button); // デバック用。クリックイベントの正常取得を確認。
                                    button.addEventListener("click", (event) => {
                                        console.log("クリックされたボタン:", event.target); // クリックされたことを確認
                                        // クリックされたボタンに対応するモーダルを取得
                                        const modal = button.closest(".modal-container")?.querySelector(".js-modal-content");
                                        if (!modal) return;

                                        // // クリック位置を取得
                                        // const clickX = event.clientX;
                                        // const clickY = event.clientY;
                                        
                                        // // モーダルの位置を設定（オフセットを考慮）
                                        // modal.style.left = `${clickX}px` ;
                                        // modal.style.top = `${clickY}px` ;
                                        // modal.style.position = "absolute"; //絶対位置指定
                                        // modal.style.transform = "translate(-50%, -50%)"; // モーダルの中心をクリック位置に調整

                                        // // モーダルを表示
                                        modalOpenedBackGround.classList.remove("hidden");
                                        modal.classList.remove("hidden");
                                    });
                                });

                                // モーダルを閉じる処理
                                modalOpenedBackGround.addEventListener("click", closeModal);

                                // モーダル内のクリックイベントが背景に伝播しないようにする
                                modalContents.forEach((modal) => {
                                    modal.addEventListener("click", (e) => {
                                        e.stopPropagation(); // モーダル内クリックが背景クリックに伝播しない
                                    });
                                });

                                // モーダル内のボタンにイベントリスナーを追加
                                document.querySelector('.js-url-add-btn')?.addEventListener("click", addURL);
                                document.querySelector('.js-description-add-btn')?.addEventListener("click", addInstructions);
                                document.querySelector('.js-image-add-btn')?.addEventListener("click", addImages);
                            });
</script>

                                <!-- モーダル用のバックグラウンド -->
                                <div class="js-gray-cover hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 cursor-pointer"></div>
                                    <!-- URLボタン -->
                                    <div class="flex w-full gap-x-1">
                                    <div>
                                        <div class="js-url-btn modal-btn px-2 py-1 bg-stone-950 text-lg text-white rounded-full hover:bg-stone-500 cursor-pointer flex-grow">URL</div>
                                    </div>
                                    <!-- URL入力モーダル -->
                                    <div class="modal-container hidden">
                                        <!-- <div class="js-url-content hidden js-modal-content max-w-[800px] min-h-[120px] bg-white absolute mx-auto p-4 rounded-lg"> -->
                                        <div class="js-url-content js-modal-content fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden">
                                            <div class="bg-white p-6 rounded-lg max-w-lg w-full">
                                                <label for="url">URL</label>
                                                <!-- <input type="text" id="url" name="recipe[url]" value="{{ old('recipe.url') }}" class="border border-gray-300 rounded w-[600px] p-2"/> -->
                                                <input type="text" id="url" name="recipe[url]" class="border border-gray-300 rounded w-[600px] p-2"/>
                                                <button onclick="addURL()" class="bg-blue-500 text-white px-4 py-2 rounded">追加</button>
                                                <button onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">閉じる</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 説明入力モーダル -->
                                    <div>
                                        <div class="js-explanation-btn modal-btn px-2 py-1 bg-stone-950 text-lg text-white rounded-full hover:bg-stone-500 cursor-pointer flex-grow">説明</div>
                                        <!-- モーダル -->
                                         <div id="descriptionModal" class="js-modal-content fixed inset-0 bg-black-500 bg-opacity-75 flex items-center justify-center hidden">
                                            <div class="relative bg-white p-6 rounded-lg max-w-3xl w-full max-h-[90vh] overflow-y-auto">
                                                
                                                <!-- 説明入力欄 -->
                                            <div class="mb-4">
                                                <lavel for="description">説明入力</lavel>
                                                <textarea id="recipe_description_input" name="recipe[description]" class="border border-gray-300 rounded w-full p-2 h-[470px]" maxlength="1000" rows="8">{{ old('recipe.description', session('recipe.description')) }}</textarea>
                                                <!-- 説明内容を格納する隠しフィールド -->
                                                <!-- <input type="hidden" id="recipe_description" name="recipe[description]" value="{{ old('recipe.description') }}"> -->
                                                <!-- h-[470px]＝テキストエリアの高さを設定。max-h-[90vh]＝モーダルの最大高さを画面の90%に設定。 -->
                                            </div>
                                                <div onclick="addInstructions()" class="bg-blue-500 text-white px-4 py-2 rounded">追加</div>
                                                <div onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">閉じる</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- 画像選択モーダル -->
                                    <div>
                                        <div class="js-image-btn modal-btn px-2 py-1 bg-stone-950 text-lg text-white rounded-full hover:bg-stone-500 cursor-pointer flex-grow">画像</div>
                                        <div class="js-image-content hidden js-modal-content max-w-md min-h-[230px] bg-white absolute p-4 rounded-lg">
                                            <label for="image">画像選択</label>
                                            <input type="file" id="image-upload" name="recipe[images][]" multiple class="border border-gray-300 rounded w-full"/>
                                            <div class="flex gap-2 mt-2">
                                                <button onclick="addImages()" class="bg-blue-500 text-white px-4 py-2 rounded">追加</button>
                                                <button onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">閉じる</button>
                                            </div>
                                            <!-- <label><input type="file" name="recipe[images][]"></label><br>
                                            <label><input type="file" name="recipe[images][]"></label><br>
                                            <label><input type="file" name="recipe[images][]"></label><br>
                                            <label><input type="file" name="recipe[images][]"></label><br>
                                            <label><input type="file" name="recipe[images][]"></label><br> -->

                                            <!-- name="recipe[images][]"⇨複数のファイルを配列として送信　multiple を追加することで、一度に複数の画像を選択 -->
                                            <!-- <input type="file" id="image" name="recipe[images][]" class="border border-gray-300 rounded w-full multiple"/> -->
                                            <!-- <div id="image-upload-area">
                                                <input type="file" name="recipe[images][]" class="image-input">
                                            </div> -->


                                            <!-- <button onclick="addInstructions()" class="bg-blue-500 text-white px-4 py-2 rounded">追加</button>
                                            <button onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">閉じる</button> -->
                                        </div>
                                    </div>

                                    document.addEventListener("DOMContentLoaded", () => {
                                    // const modalOpenedBackGround = document.querySelector(".js-gray-cover");
                                    // 背景要素を適切に取得し、null の場合にエラーログを出す
                                    const modalOpenedBackGround = document.querySelector(".js-gray-cover");
                                    if (!modalOpenedBackGround) {
                                        console.warn("⚠️ モーダル背景 (js-gray-cover) が見つかりませんでした！");
                                    }
                                    const modalContents = document.querySelectorAll(".js-modal-content");
                                    const sessionDescription = document.getElementById('session-description');

                                // モーダルを閉じる関数
                                // function closeModal() {
                                //     modalOpenedBackGround.classList.add("hidden");
                                //     modalContents.forEach(modal => modal.classList.add("hidden"));
                                // }
                                function closeModal() {
                                    console.log("🔴 closeModal() 実行");
                                    if (modalOpenedBackGround) {
                                        modalOpenedBackGround.classList.add("hidden");
                                    } else {
                                        console.warn("⚠️ closeModal() で modalOpenedBackGround が取得できませんでした！");
                                    }
                                    modalContents.forEach(modal => modal.classList.add("hidden"));
                                }

                                 // urlの追加と保存
                                function addURL() {
                                    const url = document.getElementById('url').value;
                                    if (url.trim() !== '') {
                                        sessionStorage.setItem('url', url);
                                            
                                        //　表示エリアに反映
                                        const urlElement = document.createElement('p');
                                        urlElement.textContent = `URL: ${url}`;
                                        sessionDescription.appendChild(urlElement);

                                        closeModal();
                                    }
                                }

                                // 説明の追加と保存
                                function addInstructions() {
                                    const description = document.getElementById('recipe_description_input').value;

                                    // 一時的に保存（sessionStorageまたはlocalStorageを使用）
                                    sessionStorage.setItem('description', description);

                                    // フォームにデータを反映
                                    // document.getElementById('recipe_description_input').textContent = description;
                                    document.getElementById('recipe_description_input').value = description;
                                    sessionDescription.textContent = description;

                                    closeModal();
                                }

                                // 画像の追加と保存
                                function addImages() {
                                    const input = document.getElementById('image-upload');
                                    
                                    if (input.files.length > 0) {
                                        let imageArray = JSON.parse(sessionStorage.getItem('images')) || [];

                                        Array.from(input.files).forEach(file => {
                                            const imgURL = URL.createObjectURL(file);
                                            imageArray.push(imgURL);

                                            const img = document.createElement('img');
                                            img.src = imgURL;
                                            img.classList.add("w-20", "h-20", "object-cover","rounded-md", "mr-2");
                                            sessionDescription.appendChild(img);
                                        });

                                        sessionStorage.setItem('images', JSON.stringify(imagesArray));

                                        closeModal();
                                    }
                                }

                                // ページ読み込み時に　sessionStorageから復元
                                function restoreSessionData() {
                                    const savedURL = sessionStorage.getItem('url');
                                    if (savedURL) {
                                        const urlElement = document.createElement('p');
                                        urlElement.textContent = `URL: ${savedURL}`;
                                        sessionDescription.appendChild(urlElement);
                                    }

                                    const savedImages = JSON.parse(sessionStorage.getItem('images'));
                                    if (savedImages && savedImages.length > 0) {
                                        savedImages.forEach(imgURL => {
                                            const img = document.createElement('img');
                                            img.src = imgURL;
                                            img.classList.add("w-20", "h-20", "object-cover","rounded-md", "mr-2");
                                            sessionDescription.appendChild(img);
                                        });
                                    }

                                    const savedDescription = sessionStorage.getItem('description');
                                    if (savedDescription) {
                                        // document.getElementById('recipe_description_input').textContent = savedDescription;
                                        document.getElementById('recipe_description_input').value = savedDescription;
                                        sessionDescription.textContent = savedDescription;
                                    }
                                }

                                restoreSessionData();

                                function openModal(button) {
                                        console.log("✅ ボタンがクリックされました！（修正後）", button);

                                        let modal = null;

                                        if (button.classList.contains("js-url-btn")) {
                                            modal = document.querySelector(".js-url-content");
                                        } else if (button.classList.contains("js-explanation-btn")) {
                                            modal = document.querySelector("#descriptionModal"); // getElementByIdの代わりにquerySelectorでも可
                                        } else if (button.classList.contains("js-image-btn")) {
                                            modal = document.querySelector(".js-image-content");
                                        }

                                        console.log("🔍 取得したモーダル:", modal);

                                        if (modal) {
                                            modal.classList.remove("hidden");
                                            console.log("✅ モーダルを表示 (classList):", modal.classList);
                                        } else {
                                            console.warn("⚠️ 対応するモーダルが見つかりませんでした:", button);
                                            return;
                                        }

                                        // 背景の取得・表示
                                        let modalOpenedBackGround = document.querySelector(".js-gray-cover");
                                        if (modalOpenedBackGround) {
                                            modalOpenedBackGround.classList.remove("hidden");
                                            console.log("✅ 背景を表示 (classList):", modalOpenedBackGround.classList);
                                        } else {
                                            console.warn("⚠️ 背景 (js-gray-cover) が取得できていません！");
                                        }
                                    }
                                    

                                    // ボタンにイベントを設定
                                    function attachModalEvents() {
                                        document.querySelectorAll(".modal-btn").forEach(button => {
                                            button.addEventListener("click", (event) => {
                                                // openModal(event.target);
                                                // event.target ではなく、button（クリックされた要素）を渡す
                                                openModal(button);
                                            });
                                        });

                                        // 閉じるボタンにイベントを追加
                                        document.querySelectorAll(".bg-gray-500").forEach(button => {
                                            button.addEventListener("click", closeModal);
                                        });

                                        // 背景クリックで閉じる
                                        if (modalOpenedBackGround) {
                                            modalOpenedBackGround.addEventListener("click", closeModal);
                                        }
                                    }

                                    // 初回イベント適用
                                    attachModalEvents();

                                    // モーダルの表示処理
                                    function attachModalEvents() {
                                        document.querySelectorAll(".modal-btn").forEach(button => {
                                            // console.log("モーダルボタン:", button); // デバック用。クリックイベントの正常取得を確認。

                                            button.addEventListener("click", (event) => {
                                                // ここで openModal を呼び出して、適切なモーダルを開く
                                                openModal(event.target);
                                                console.log("✅ ボタンがクリックされました！（修正後）", event.target);

                                                // どのボタンが押されたか判定
                                                let modal = null;

                                                if (button.classList.contains("js-url-btn")) {
                                                    modal = document.querySelector(".js-url-content");
                                                } else if (button.classList.contains("js-explanation-btn")) {
                                                    modal = document.getElementById("descriptionModal");
                                                } else if (button.classList.contains("js-image-btn")) {
                                                    modal = document.querySelector(".js-image-content");
                                                }
                                                console.log("🔍 取得したモーダル:", modal);

                                                if (modal) {
                                                    modal.classList.remove("hidden");
                                                    console.log("✅ モーダルを表示 (classList):", modal.classList);

                                                    if (modalOpenedBackGround) {
                                                        modalOpenedBackGround.classList.remove("hidden");
                                                        console.log("✅ 背景を表示 (classList):", modalOpenedBackGround.classList);
                                                    } else {
                                                        console.warn("⚠️ 背景 (js-gray-cover) が取得できていません！");
                                                    }
                                                    
                                                } else {
                                                    console.warn("⚠️ 対応するモーダルが見つかりませんでした:", event.target);
                                                }
                                            });
                                        });

                                        // 閉じるボタンにイベントリスナーを追加
                                        document.querySelectorAll(".bg-gray-500").forEach(button => {
                                            button.addEventListener("click", closeModal);
                                        });

                                        // 背景をクイックしてモーダルを閉じる
                                        if (modalOpenedBackGround) {
                                            modalOpenedBackGround.addEventListener("click", closeModal);
                                        }
                                    }

                                        // 初回のイベント設定
                                        attachModalEvents();

                                        // Livewireコンテンツが更新されたらイベントを再適用
                                        document.addEventListener("livewire:updated", () => {
                                            console.log("Livewireが更新されました!イベントを再設定します。");
                                            attachModalEvents();
                                        });
                                });








                                <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    // const modalOpenedBackGround = document.querySelector(".js-gray-cover");
                                    // 背景要素を適切に取得し、null の場合にエラーログを出す
                                    const modalOpenedBackGround = document.querySelector(".js-gray-cover");
                                    if (!modalOpenedBackGround) {
                                        console.warn("⚠️ モーダル背景 (js-gray-cover) が見つかりませんでした！");
                                    }
                                    const modalContents = document.querySelectorAll(".js-modal-content");
                                    const sessionDescription = document.getElementById('session-description');

                                // モーダルを閉じる関数
                                // function closeModal() {
                                //     modalOpenedBackGround.classList.add("hidden");
                                //     modalContents.forEach(modal => modal.classList.add("hidden"));
                                // }
                                function closeModal() {
                                    console.log("🔴 closeModal() 実行");
                                    if (modalOpenedBackGround) {
                                        modalOpenedBackGround.classList.add("hidden");
                                    } else {
                                        console.warn("⚠️ closeModal() で modalOpenedBackGround が取得できませんでした！");
                                    }
                                    modalContents.forEach(modal => modal.classList.add("hidden"));
                                }

                                 // urlの追加と保存
                                function addURL() {
                                    const url = document.getElementById('url').value;
                                    if (url.trim() !== '') {
                                        sessionStorage.setItem('url', url);
                                            
                                        //　表示エリアに反映
                                        const urlElement = document.createElement('p');
                                        urlElement.textContent = `URL: ${url}`;
                                        sessionDescription.appendChild(urlElement);

                                        closeModal();
                                    }
                                }

                                // 説明の追加と保存
                                function addInstructions() {
                                    const description = document.getElementById('recipe_description_input').value;

                                    // 一時的に保存（sessionStorageまたはlocalStorageを使用）
                                    sessionStorage.setItem('description', description);

                                    // フォームにデータを反映
                                    // document.getElementById('recipe_description_input').textContent = description;
                                    document.getElementById('recipe_description_input').value = description;
                                    sessionDescription.textContent = description;

                                    closeModal();
                                }

                                // 画像の追加と保存
                                function addImages() {
                                    const input = document.getElementById('image-upload');
                                    
                                    if (input.files.length > 0) {
                                        let imageArray = JSON.parse(sessionStorage.getItem('images')) || [];

                                        Array.from(input.files).forEach(file => {
                                            const imgURL = URL.createObjectURL(file);
                                            imageArray.push(imgURL);

                                            const img = document.createElement('img');
                                            img.src = imgURL;
                                            img.classList.add("w-20", "h-20", "object-cover","rounded-md", "mr-2");
                                            sessionDescription.appendChild(img);
                                        });

                                        sessionStorage.setItem('images', JSON.stringify(imagesArray));

                                        closeModal();
                                    }
                                }

                                // ページ読み込み時に　sessionStorageから復元
                                function restoreSessionData() {
                                    const savedURL = sessionStorage.getItem('url');
                                    if (savedURL) {
                                        const urlElement = document.createElement('p');
                                        urlElement.textContent = `URL: ${savedURL}`;
                                        sessionDescription.appendChild(urlElement);
                                    }

                                    const savedImages = JSON.parse(sessionStorage.getItem('images'));
                                    if (savedImages && savedImages.length > 0) {
                                        savedImages.forEach(imgURL => {
                                            const img = document.createElement('img');
                                            img.src = imgURL;
                                            img.classList.add("w-20", "h-20", "object-cover","rounded-md", "mr-2");
                                            sessionDescription.appendChild(img);
                                        });
                                    }

                                    const savedDescription = sessionStorage.getItem('description');
                                    if (savedDescription) {
                                        // document.getElementById('recipe_description_input').textContent = savedDescription;
                                        document.getElementById('recipe_description_input').value = savedDescription;
                                        sessionDescription.textContent = savedDescription;
                                    }
                                }

                                restoreSessionData();

                                function openModal(button) {
                                    console.log("✅ クリックされたボタン:", button);
                                    console.log("🔍 ボタンのクラスリスト:", button.classList);

                                    let modal = null;

                                    if (button.classList.contains("js-url-btn")) {
                                        modal = document.querySelector(".js-url-content"); // `querySelectorAll()` で確実に取得
                                    } else if (button.classList.contains("js-explanation-btn")) {
                                        modal = document.querySelector("#descriptionModal");
                                    } else if (button.classList.contains("js-image-btn")) {
                                        modal = document.querySelector(".js-image-content");
                                    }

                                    console.log("🔍 取得したモーダル:", modal);

                                    // if (modal) {
                                    //     modal.classList.remove("hidden");
                                    //     console.log("✅ モーダルを表示:", modal.classList);
                                    // } else {
                                    //     console.warn("⚠️ 対応するモーダルが見つかりませんでした:", button);
                                    //     return;
                                    // }

                                    // // 背景の表示
                                    // if (modalOpenedBackGround) {
                                    //     modalOpenedBackGround.classList.remove("hidden");
                                    //     console.log("✅ 背景を表示:", modalOpenedBackGround.classList);
                                    // } else {
                                    //     console.warn("⚠️ 背景 (js-gray-cover) が取得できていません！");
                                    // }
                                    if (modal) {
                                        modal.classList.remove("hidden");
                                        let modalOpenedBackGround = document.querySelector(".js-gray-cover");
                                        if (modalOpenedBackGround) {
                                            modalOpenedBackGround.classList.remove("hidden");
                                        }
                                    } else {
                                        console.warn("⚠️ 対応するモーダルが見つかりませんでした:", button);
                                    }
                                }
                                    

                                    // // ボタンにイベントを設定
                                    // function attachModalEvents() {
                                    //     document.querySelectorAll(".modal-btn").forEach(button => {
                                    //         button.addEventListener("click", (event) => {
                                    //             // openModal(event.target);
                                    //             // event.target ではなく、button（クリックされた要素）を渡す
                                    //             openModal(button);
                                    //         });
                                    //     });

                                    //     // 閉じるボタンにイベントを追加
                                    //     document.querySelectorAll(".bg-gray-500").forEach(button => {
                                    //         button.addEventListener("click", closeModal);
                                    //     });

                                    //     // 背景クリックで閉じる
                                    //     if (modalOpenedBackGround) {
                                    //         modalOpenedBackGround.addEventListener("click", closeModal);
                                    //     }
                                    // }

                                    // // 初回イベント適用
                                    // attachModalEvents();

                                    // モーダルの表示処理
                                    // ボタンにイベントを設定
                                    function attachModalEvents() {
                                        // モーダルを開くボタン
                                        document.querySelectorAll(".modal-btn").forEach(button => {
                                            button.addEventListener("click", (event) => {
                                                openModal(event.currentTarget); // 🔴 修正：event.target → event.currentTarget
                                            });
                                        });

                                       

                                        // 閉じるボタンにイベントリスナーを追加
                                        document.querySelectorAll(".bg-gray-500").forEach(button => {
                                            button.addEventListener("click", closeModal);
                                        });

                                        // 背景をクイックしてモーダルを閉じる
                                        if (modalOpenedBackGround) {
                                            modalOpenedBackGround.addEventListener("click", closeModal);
                                        }
                                    }

                                        // 初回のイベント設定
                                        attachModalEvents();

                                        // Livewireコンテンツが更新されたらイベントを再適用
                                        document.addEventListener("livewire:updated", () => {
                                        console.log("Livewireが更新されました! モーダル要素を再取得します。");

                                        // ボタンのイベントを再適用
                                        attachModalEvents();
                                    });
                                });
                            
                            </script>

            <!-- URL → 説明 → 画像 の順に表示する前の修正前スクリプト -->
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    // モーダルの背景を取得
                    const modalOpenedBackGround = document.querySelector(".js-gray-cover");
                    // if (!modalOpenedBackGround) {
                    //     console.warn("⚠️ モーダル背景 (js-gray-cover) が見つかりませんでした！");
                    // }
                    
                    const modalContents = document.querySelectorAll(".js-modal-content");
                    const sessionDescription = document.getElementById('session-description');

                    // `sessionStorage` に保存するデータ構造
                    const recipeData = JSON.parse(sessionStorage.getItem('recipeData')) || { url: '', description: '', images: [] };

                    // ✅ モーダルを閉じる関数
                    // function closeModal() {
                    //     console.log("🔴 closeModal() 実行");
                    //     if (modalOpenedBackGround) {
                    //         modalOpenedBackGround.classList.add("hidden");
                    //     } else {
                    //         console.warn("⚠️ closeModal() で modalOpenedBackGround が取得できませんでした！");
                    //     }
                    //     modalContents.forEach(modal => modal.classList.add("hidden"));
                    // }

                    // ✅ モーダルの開閉を統一化
                    function toggleModal(modal, show = true) {
                        if (!modal) return;
                        modal.classList.toggle("hidden", !show);
                        modalOpenedBackGround?.classList.toggle("hidden", !show);
                    }

                    // ✅ URLの追加
                    function addURL() {
                        const url = document.getElementById('url').value;
                        if (url.trim() !== '') {
                            recipeData.url = url;
                            // sessionStorage.setItem('url', url);
                            sessionStorage.setItem('recipeData', JSON.stringify(recipeData));

                            const urlElement = document.createElement('p');
                            urlElement.textContent = `URL: ${url}`;
                            sessionDescription.appendChild(urlElement);
                            // closeModal();

                            toggleModal(document.querySelector(".js-url-content"), false);
                        }
                    }

                    // ✅ 説明の追加
                    function addInstructions() {
                        const description = document.getElementById('recipe_description_input').value;
                        recipeData.description = description;
                        // sessionStorage.setItem('description', description);
                        sessionStorage.setItem('recipeData', JSON.stringify(recipeData));

                        document.getElementById('recipe_description_input').value = description;
                        sessionDescription.textContent = description;
                        // closeModal();

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
                                // imageArray.push(imgURL);

                                const imgContainer = document.createElement('div');
                                imgContainer.classList.add("relative", "inline-block");
                                
                                const img = document.createElement('img');
                                img.src = imgURL;
                                // img.classList.add("w-20", "h-20", "object-cover","rounded-md", "mr-2");
                                img.classList.add("w-20", "h-20", "object-cover","rounded-md");

                                const removeBtn = document.createElement('button');
                                removeBtn.textContent = "✖"
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

                            sessionStorage.setItem('recipeData', JSON.stringify(recipeData));
                            // closeModal();
                            toggleModal(document.querySelector(".js-image-content"), false);
                        }
                    }

                    // ✅ ページ読み込み時に `sessionStorage` から復元
                    function restoreSessionData() {
                        // const savedURL = sessionStorage.getItem('url');
                        // if (savedURL) {
                        //     const urlElement = document.createElement('p');
                        //     urlElement.textContent = `URL: ${savedURL}`;
                        //     sessionDescription.appendChild(urlElement);
                        // }
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

                    //     const savedImages = JSON.parse(sessionStorage.getItem('images'));
                    //     if (savedImages && savedImages.length > 0) {
                    //         savedImages.forEach(imgURL => {
                    //             const img = document.createElement('img');
                    //             img.src = imgURL;
                    //             img.classList.add("w-20", "h-20", "object-cover","rounded-md", "mr-2");
                    //             sessionDescription.appendChild(img);
                    //         });
                    //     }

                    //     const savedDescription = sessionStorage.getItem('description');
                    //     if (savedDescription) {
                    //         document.getElementById('recipe_description_input').value = savedDescription;
                    //         sessionDescription.textContent = savedDescription;
                    //     }
                    // }
                

                    restoreSessionData();

                    // ✅ モーダルを開く関数
                    function openModal(button) {
                        // console.log("✅ クリックされたボタン:", button);
                        // console.log("🔍 ボタンのクラスリスト:", button.classList);

                        let modal = null;

                        if (button.classList.contains("js-url-btn")) {
                            modal = document.querySelector(".js-url-content");
                        } else if (button.classList.contains("js-explanation-btn")) {
                            modal = document.querySelector("#descriptionModal");
                        } else if (button.classList.contains("js-image-btn")) {
                            modal = document.querySelector(".js-image-content");
                        }

                        // console.log("🔍 取得したモーダル:", modal);
                        if (modal) toggleModal(modal, true);
                    }

                    //     if (modal) {
                    //         modal.classList.remove("hidden");
                    //         console.log("✅ モーダルを開く処理を実行しました:", modal.classList);

                    //         let modalOpenedBackGround = document.querySelector(".js-gray-cover");
                    //         console.log(modalOpenedBackGround);
                    //         if (modalOpenedBackGround) {
                    //             modalOpenedBackGround.classList.remove("hidden");
                    //         }
                    //     } else {
                    //         console.warn("⚠️ 対応するモーダルが見つかりませんでした:", button);
                    //     }
                    // }

                    // ✅ Livewireの影響を受けずに、すべてのモーダルボタンにクリックイベントを適用
                    document.addEventListener("click", (event) => {
                        if (event.target.classList.contains("modal-btn")) {
                            openModal(event.target);
                        }
                        if (event.target.classList.contains("bg-gray-500")) {
                            // closeModal();
                            toggleModal(event.target.closest(".js-modal-content"), false);
                        }
                        if (modalOpenedBackGround && event.target === modalOpenedBackGround) {
                            // closeModal();
                            modalContents.forEach(modal => toggleModal(modal, false));
                        }
                    });

                    // // ✅ Livewireコンテンツが更新されたらイベントを再適用
                    // document.addEventListener("livewire:updated", () => {
                    //     console.log("Livewireが更新されました! モーダル要素を再取得します。");
                    // });

                    //   // `addInstructions` を呼び出すボタンのIDを指定（仮）
                    // const addInstructionButton = document.getElementById('add-instructions-id');
                    // if (addInstructionButton) {
                    //     addInstructionButton.addEventListener('click', addInstructions);
                    // } else {
                    //     console.warn("ボタン (add-instructions-id) が見つかりませんでした！");
                    // }

                    // ✅`addInstructions`, `addURL`, `addImages` を登録
                    const buttonEventMappings = [
                        { id: 'add-instructions-id', handler: addInstructions },
                        { id: 'add-url-id', handler: addURL },
                        { id: 'add-images-id', handler: addImages }
                    ];

                    // それぞれのボタンにイベントを設定
                    buttonEventMappings.forEach(({ id, handler }) => {
                        const button = document.getElementById(id);
                        if (button) {
                            button.addEventListener('click', handler);
                        } else {
                            console.warn(`ボタン (${id}) が見つかりませんでした！`);
                        }
                    });

                    const saveButton = document.getElementById('save-recipe-btn'); // 保存ボタンのIDを指定

                    if (saveButton) {
                        saveButton.addEventListener('click', () => {
                            sessionStorage.removeItem('recipeData'); // 画像と説明のデータを削除
                        });
                    } else {
                        console.warn("保存ボタン (save-recipe-btn) が見つかりませんでした");
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
                    }

                });
                </script>

                <!-- editにも同じ反映を施すスクリプト -->
                <script>
                document.addEventListener("DOMContentLoaded", () => {
                    // モーダルの背景を取得
                    const modalOpenedBackGround = document.querySelector(".js-gray-cover");
                    // if (!modalOpenedBackGround) {
                    //     console.warn("⚠️ モーダル背景 (js-gray-cover) が見つかりませんでした！");
                    // }
                    
                    const modalContents = document.querySelectorAll(".js-modal-content");
                    const sessionDescription = document.getElementById('session-description');

                    // `sessionStorage` に保存するデータ構造
                    let recipeData = JSON.parse(sessionStorage.getItem('recipeData')) || { url: '', description: '', images: [] };

                    // ✅ モーダルを閉じる関数
                    // function closeModal() {
                    //     console.log("🔴 closeModal() 実行");
                    //     if (modalOpenedBackGround) {
                    //         modalOpenedBackGround.classList.add("hidden");
                    //     } else {
                    //         console.warn("⚠️ closeModal() で modalOpenedBackGround が取得できませんでした！");
                    //     }
                    //     modalContents.forEach(modal => modal.classList.add("hidden"));
                    // }

                    // // ✅ モーダルの開閉を統一化
                    // function toggleModal(modal, show = true) {
                    //     if (!modal) return;
                    //     modal.classList.toggle("hidden", !show);
                    //     modalOpenedBackGround?.classList.toggle("hidden", !show);
                    // }

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
                                // imageArray.push(imgURL);

                                // const imgContainer = document.createElement('div');
                                // imgContainer.classList.add("relative", "inline-block");
                                
                                // const img = document.createElement('img');
                                // img.src = imgURL;
                                // // img.classList.add("w-20", "h-20", "object-cover","rounded-md", "mr-2");
                                // img.classList.add("w-20", "h-20", "object-cover","rounded-md");

                                // const removeBtn = document.createElement('button');
                                // removeBtn.textContent = "✖"
                                // removeBtn.classList.add("absolute", "top-0", "right-0", "bg-red-500", "text-white", "text-xs", "px-1", "rounded-full");
                                // removeBtn.onclick = () => {
                                //     imgContainer.remove();
                                //     recipeData.images = recipeData.images.filter(i => i !== imgURL);
                                //     sessionStorage.setItem('recipeData', JSON.stringify(recipeData));
                                // };

                                // imgContainer.appendChild(img);
                                // imgContainer.appendChild(removeBtn);
                                // sessionDescription.appendChild(imgContainer);
                            });

                            sessionStorage.setItem('recipeData', JSON.stringify(recipeData));
                            updateDisplay(); // 表示更新
                            // closeModal();
                            // toggleModal(document.querySelector(".js-image-content"), false);
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
                        // const savedURL = sessionStorage.getItem('url');
                        // if (savedURL) {
                        //     const urlElement = document.createElement('p');
                        //     urlElement.textContent = `URL: ${savedURL}`;
                        //     sessionDescription.appendChild(urlElement);
                        // }
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

                    //     const savedImages = JSON.parse(sessionStorage.getItem('images'));
                    //     if (savedImages && savedImages.length > 0) {
                    //         savedImages.forEach(imgURL => {
                    //             const img = document.createElement('img');
                    //             img.src = imgURL;
                    //             img.classList.add("w-20", "h-20", "object-cover","rounded-md", "mr-2");
                    //             sessionDescription.appendChild(img);
                    //         });
                    //     }

                    //     const savedDescription = sessionStorage.getItem('description');
                    //     if (savedDescription) {
                    //         document.getElementById('recipe_description_input').value = savedDescription;
                    //         sessionDescription.textContent = savedDescription;
                    //     }
                    // }
                

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

                    // function openModal(button) {
                    //     // console.log("✅ クリックされたボタン:", button);
                    //     // console.log("🔍 ボタンのクラスリスト:", button.classList);

                    //     let modal = null;

                    //     if (button.classList.contains("js-url-btn")) {
                    //         modal = document.querySelector(".js-url-content");
                    //     } else if (button.classList.contains("js-explanation-btn")) {
                    //         modal = document.querySelector("#descriptionModal");
                    //     } else if (button.classList.contains("js-image-btn")) {
                    //         modal = document.querySelector(".js-image-content");
                    //     }

                    //     // console.log("🔍 取得したモーダル:", modal);
                    //     if (modal) toggleModal(modal, true);
                    // }

                    //     if (modal) {
                    //         modal.classList.remove("hidden");
                    //         console.log("✅ モーダルを開く処理を実行しました:", modal.classList);

                    //         let modalOpenedBackGround = document.querySelector(".js-gray-cover");
                    //         console.log(modalOpenedBackGround);
                    //         if (modalOpenedBackGround) {
                    //             modalOpenedBackGround.classList.remove("hidden");
                    //         }
                    //     } else {
                    //         console.warn("⚠️ 対応するモーダルが見つかりませんでした:", button);
                    //     }
                    // }

                    // ✅ Livewireの影響を受けずに、すべてのモーダルボタンにクリックイベントを適用
                    // document.addEventListener("click", (event) => {
                    //     if (event.target.classList.contains("modal-btn")) {
                    //         openModal(event.target);
                    //     }
                    //     if (event.target.classList.contains("bg-gray-500")) {
                    //         // closeModal();
                    //         toggleModal(event.target.closest(".js-modal-content"), false);
                    //     }
                    //     if (modalOpenedBackGround && event.target === modalOpenedBackGround) {
                    //         // closeModal();
                    //         modalContents.forEach(modal => toggleModal(modal, false));
                    //     }
                    // });

                    // // ✅ Livewireコンテンツが更新されたらイベントを再適用
                    // document.addEventListener("livewire:updated", () => {
                    //     console.log("Livewireが更新されました! モーダル要素を再取得します。");
                    // });

                    //   // `addInstructions` を呼び出すボタンのIDを指定（仮）
                    // const addInstructionButton = document.getElementById('add-instructions-id');
                    // if (addInstructionButton) {
                    //     addInstructionButton.addEventListener('click', addInstructions);
                    // } else {
                    //     console.warn("ボタン (add-instructions-id) が見つかりませんでした！");
                    // }

                    // ✅`addInstructions`, `addURL`, `addImages` を登録
                    // const buttonEventMappings = [
                    //     { id: 'add-instructions-id', handler: addInstructions },
                    //     { id: 'add-url-id', handler: addURL },
                    //     { id: 'add-images-id', handler: addImages }
                    // ];

                    // それぞれのボタンにイベントを設定
                    // buttonEventMappings.forEach(({ id, handler }) => {
                    //     const button = document.getElementById(id);
                    //     if (button) {
                    //         button.addEventListener('click', handler);
                    //     } else {
                    //         console.warn(`ボタン (${id}) が見つかりませんでした！`);
                    //     }
                    // });

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



