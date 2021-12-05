<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{

    protected $fillable = [
        'user_id', 'cooking_day', 'recipe_time', 'menu_id'
    ];


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

    public function create($cooking_day, $recipe_time, $menu_id) {
        $recipe = new self();
        $recipe->user_id = Auth::id();
        $recipe->cooking_day = $cooking_day;
        $recipe->recipe_time = $recipe_time;
        $recipe->menu_id = $menu_id;
        $recipe->save();
    }
}
