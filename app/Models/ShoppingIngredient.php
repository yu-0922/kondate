<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingIngredient extends Model
{
        /**
     * メニューを登録したユーザーを取得
     */
    public function shoppingList() {
        return $this->belongsTo('App\Models\ShoppingList');
    }

}
