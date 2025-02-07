<div>お買い物リスト</div>
    <input type="text" wire:model="shopping_list">
    <button wire:click="addTodo">登録</button>

    <ul>
        @foreach($Shopping_lists as $shopping_list)
        <li>
            <button wire:click="updateShopping_list{{ $shopping_list->id }}">取り消し</button>
        </li>
        @endforeach
    </ul>
</div>