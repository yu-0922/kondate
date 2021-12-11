<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingIngredient extends Model
{
    protected $fillable = [
        'shopping_list_id', 'ingredient_name', 'unit'
    ];

    /**
     * メニューを登録したユーザーを取得
     */
    public function shoppingList() {
        return $this->belongsTo('App\Models\ShoppingList');
    }

}
