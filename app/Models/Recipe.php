<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    /**
     * 献立を登録したユーザーを取得
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * 献立の買い物リストを取得
     */
    public function shoppingList() {
        return $this->belongsTo('App\Models\ShoppingList');
    }
}
