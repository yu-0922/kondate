<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    /**
     * 買い物リストに関連する献立を取得
     */
    public function recipes() {
        return $this->hasMany('App\Models\Recipe');
    }

    /**
     * 買い物リストを作成したユーザーを取得
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * 買い物リストに入っている具材を取得
     */
    public function ingredients() {
        return $this->belongsToMany('App\Models\Ingredient');
    }

    /**
     * 買い物リストに入っている調味料を取得
     */
    public function seasonings() {
        return $this->belongsToMany('App\Models\Seasoning');
    }
}
