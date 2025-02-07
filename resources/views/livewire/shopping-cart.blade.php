<div>
<h2>お買い物リスト</h2>
    <input type="text" wire:model="Shopping">
    <button wire:click="addShoppingList">登録</button>

    <ul>
        @foreach($Ingredients as $ingredient)
        <li>
            <button wire:click="updateIngredient({{ $ingredient->id }})">取り消し</button>
            {{ $ingredient->ingredient }}
        </li>
        @endforeach
    </ul>
</div>
