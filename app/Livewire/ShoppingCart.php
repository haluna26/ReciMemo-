<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ShoppingList;
use Illuminate\Support\Facades\Auth; // 認証情報取得のため追加

class ShoppingCart extends Component
{
    public $item; //ここにデータが入る（入力中の材料）

    public function render()
    {
        return view('livewire.shopping-cart', [
            // ログインユーザーのデータのみ取得
            'items' => ShoppingList::where('user_id', Auth::id())->get(),
        ]);
    }

    public function addShoppingList()
    {
        if (!empty($this->item)) { //空チェックを追加
            ShoppingList::create([
                'item' => $this->item,
                'user_id' => Auth::id(), // ログインユーザーのIDをセット
            ]);

            $this->reset('item'); // Livewireのリセットメソッドを使用
        }
    }

    public function updateItem($id)
    {
        $item = ShoppingList::where('id', $id)->where('user_id', Auth::id())->first(); // ログインユーザーのデータのみ削除可能にする

        if ($item) {
            $item->delete(); //削除の処理
            $this->emitSelf('refreshComponent'); // Livewireコンポーネントをリフレッシュ
        }
    }
}


//入力フィールド (wire:model="ingredient") に入力したデータが、$ingredient に正しくセットされる。
// addShoppingList() を実行すると、データベースに保存される。
// 登録後、入力フィールドが空になる。
// リアルタイムでリストが更新される。
