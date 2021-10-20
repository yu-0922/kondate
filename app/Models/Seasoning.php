<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seasoning extends Model
{
    /**
     * 調味料が使われているメニューを取得
     */
    public function menus() {
        return $this->belongsToMany('App\Models\Menu');
    }

    /**
     * 調味料が入っている買い物リストを取得
     */
    public function shoppingLists() {
        return $this->belongsToMany('App\Models\ShoppingList');
    }
}
