<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    protected $fillable = [
        'user_id', 'ingredient', 'recipe_id'
    ];

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
    public function menus() {
        return $this->hasMany('App\Models\Menu');
    }

            /**
     * メニューを登録したユーザーを取得
     */
    public function shoppingIngredients() {
        return $this->hasMany('App\Models\ShoppingIngredient');
    }

}
