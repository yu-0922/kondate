<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    /**
     * 具材のカテゴリを取得
     */
    public function ingredientCategory() {
        return $this->belongsTo('App\Models\IngredientCategory');
    }

    /**
     * 具材が使われているメニューを取得
     */
    public function menus() {
        return $this->belongsToMany('App\Models\Menu');
    }

    /**
     * 具材が入っている買い物リストを取得
     */
    public function shoppingLists() {
        return $this->belongsToMany('App\Models\ShoppingList');
    }
}
