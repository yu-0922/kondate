<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ingredient extends Model
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

    public function create($menu_id, $ingredient_name, $unit) {
        $menu = new self();
        $menu->menu_id = $menu_id;
        $menu->user_id = Auth::id();
        $menu->ingredient_name = $ingredient_name;
        $menu->unit = $unit;
        $menu->save();
    }

}
