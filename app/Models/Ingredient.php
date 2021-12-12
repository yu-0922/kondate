<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingIngredient extends Model
{
    protected $fillable = [
        'menu_id', 'ingredient_name', 'unit'
    ];

    /**
     * メニューを登録したユーザーを取得
     */
    public function menu() {
        return $this->belongsTo('App\Models\Menu');
    }

}
