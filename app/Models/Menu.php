<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Menu extends Model
{
    protected $fillable = ['menu_name', 'user_id', 'image_path', 'description', 'step', 'ingredient', 'seasoning'];

    /**
     * メニューを登録したユーザーを取得
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * メニューに使われる具材を取得
     */
    public function ingredients() {
        return $this->belongsToMany('App\Models\Ingredient');
    }

    /**
     * メニューに使われる調味料を取得
     */
    public function seasonings() {
        return $this->belongsToMany('App\Models\Seasoning');
    }

    /**
     * メニューのカテゴリを取得
     */
    public function recipeCategory() {
        return $this->belongsTo('App\Models\RecipeCategory');
    }

    /**
     * メニューのうちお気に入り登録されたものを取得
     */
    public function favorite() {
        return $this->belongsTo('App\Models\Favorite');
    }

    /**
     * メニューのうちマイメニュー登録されたものを取得
     */
    public function myMenus() {
        return $this->hasMany('App\Models\MyMenu');
    }

    public function create($categoryId, $menuName, $imagePath, $description, $step, $ingredient, $seasoning) {
        $menu = new self();
        $menu->recipe_category_id = $categoryId;
        $menu->user_id = Auth::id();
        $menu->menu_name = $menuName;
        $menu->image_path = $imagePath;
        $menu->description = $description;
        $menu->step = $step;
        $menu->ingredient = $ingredient;
        $menu->seasoning = $seasoning;
        $menu->save();
    }

    public function edit($id, $categoryId, $menuName, $imagePath, $description, $step, $ingredient, $seasoning) {
        $menu = $this->where('id', $id)->first();
        $menu->recipe_category_id = $categoryId;
        $menu->menu_name = $menuName;
        $menu->image_path = $imagePath;
        $menu->description = $description;
        $menu->step = $step;
        $menu->ingredient = $ingredient;
        $menu->seasoning = $seasoning;
        $menu->save();

        return $menu;
    }
}
