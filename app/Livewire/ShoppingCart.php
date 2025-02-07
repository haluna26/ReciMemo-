<?php

namespace App\Livewire;

use Livewire\Component;

class ShoppingCart extends Component
{
    public function render(ShoppingList $shopping)
    {
        return view('livewire.shopping-cart')->with(['Ingredients' => $shopping->get()]);
    }

    public $ingredient;
    public $undoneIngredients;
    public $doneIngredients;

     // public function mount()
    // {
    //     $this->getShoppingList();
    // }

    // public function getShopping_lists()
    // {
    //     $this->undoneIngredients = Shopping_list::where('done', false)->get();
    //     $this->doneIngredients = Shopping_list::where('done', true)->get();
    // }

    public function addShoppingList()
    {
        $ingredient = new ShoppingList();
        $ingredient->ingredient = $this->ingredient;
        $ingredient->save();

        $this->ingredient = null;

        $this->getShoppingList();
    }

    public function updateIngredient($id, $isFinished)
    {
        $ingredient = ShoppingList::find($id);
        if($ingredient) {
            $ingredient->done = $isFinished;
            $ingredient->save();
            $this->getShoppingList();
        }
    }


}
