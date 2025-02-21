<div class="py-12">
    <!-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-15 bg-white border-b border-gray-200">
                <h2 class="text-lg font-semibold mb-4 text-center">お買い物リスト</h2>
                <form>
                    <!-- <div class="flex items-center justify-center min-h-screen">  -->
                    <!-- flex flex-col items-center justify-center min-h-screen＝中央揃え -->
                    <div class="flex items-center space-x-2">
                        <input type="text" wire:model="item" 
                            class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 break-words"
                            placeholder="材料を入力">
                        <!-- wire:model="item"> -->
                        <!-- wire:modelはlivewireで設定した関数名にする -->

                        <!-- <button wire:click="addShoppingList">登録</button> -->
                        <button type="button" wire:click="addShoppingList" class="bg-blue-500 text-white px-2 py-1 rounded-lg hover:bg-blue-600">
                            Go
                        </button>
                    </div>

                    <!-- <ul class="grid grid-cols-8 sm:grid-cols-18 gap-1 mt-4"> -->
                    @if (!empty($Item) && $Item->isNotEmpty())
                        <ul class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 gap-1 mt-4">

                            @foreach($items as $item)
                            <li class="flex justify-between items-center bg-gray-100 p-2 rounded-lg w-full">
                                <span>{{ $item->item }} </span>
                                <button wire:click="updateItem({{ $item->id }})" class="text-red-500 hover:text-red-700">取消</button>
                            </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 mt-4">まだリストは空です。</p>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
