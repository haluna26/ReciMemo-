<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ShoppingList;

class ShoppingCart extends Component
{
    public $item; //ここにデータが入る（入力中の材料）
    // public $Ingredients; //取得したデータを保持（登録済みの材料リスト）
    // public $undoneIngredients;
    // public $doneIngredients;

    // public function render(ShoppingList $shopping)
    // {
    //     return view('livewire.shopping-cart')->with(['Ingredients' => $shopping->get()]);
    // }

    public function render()
    {
        // $this->Ingredients = ShoppingList::all(); //データを取得
        return view('livewire.shopping-cart', [
            'items' => ShoppingList::all(),
        ]);
    }

    // public function addShoppingList()
    // {
    //     $ingredient = new ShoppingList();
    //     $ingredient->ingredient = $this->ingredient;
    //     $ingredient->save();

    //     $this->ingredient = null;

    //     $this->getShoppingList();
    // }

    public function addShoppingList()
    {
        if (!empty($this->item)) { //空チェックを追加
            // $ingredient = new ShoppingList();
            // $ingredient->ingredient = $this->ingredient;
            // $ingredient->user_id = auth()->id(); //ユーザIDを設定
            // $ingredient->save();
            ShoppingList::create([
                'item' => $this->item,
                'user_id' => auth()->id(),
            ]);

            // $this->ingredient = null; //フィールドをリセット
            // $this->ingredient = '';
            $this->reset('item'); // Livewireのリセットメソッドを使用

            // リストを即時更新する⇨直ぐに入力欄が空になる
            // $this->Ingredients = ShoppingList::all();
        }
    }

    // public function updateIngredient($id, $isFinished)
    // {
    //     $ingredient = ShoppingList::find($id);
    //     if($ingredient) {
    //         $ingredient->done = $isFinished;
    //         $ingredient->save();
    //         $this->getShoppingList();
    //     }
    // }

    public function updateItem($id)
    {
        $item = ShoppingList::find($id);
        if ($item) {
            $item->delete(); //削除の処理
            // $this->Ingredients = ShoppingList::all();
            $this->emptySelf('itemDeleted'); //リアルタイム更新
        }
    }
}


//入力フィールド (wire:model="ingredient") に入力したデータが、$ingredient に正しくセットされる。
// addShoppingList() を実行すると、データベースに保存される。
// 登録後、入力フィールドが空になる。
// リアルタイムでリストが更新される。
