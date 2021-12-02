<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Overtrue\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use Favoriteable;
    use SoftDeletes;

    //指定したカラムにデータの挿入を許可する
    protected $fillable = ['menu_name', 'user_id', 'image_path', 'description', 'step', 'ingredient', 'recipe_category_id', 'menu_release', 'my_menu_register'];

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
     * メニューのカテゴリを取得
     */
    public function recipeCategory() {
        return $this->belongsTo('App\Models\RecipeCategory');
    }

    /**
     * メニューのうちお気に入り登録されたものを取得
     */
    public function favorites() {
        return $this->hasMany('App\Models\Favorite');
    }

    /**
     * メニューのうちマイメニュー登録されたものを取得
     */
    public function myMenus() {
        return $this->hasMany('App\Models\MyMenu');
    }

    //インスタンスを作成し、データベースに値を入れる
    public function create($recipe_category_id, $menu_name, $image_path, $description, $ingredient, $step, $menu_release) {
        $menu = new self();
        $menu->recipe_category_id = $recipe_category_id;
        $menu->user_id = Auth::id();
        $menu->menu_name = $menu_name;
        $menu->image_path = $image_path;
        $menu->description = $description;
        $menu->ingredient = $ingredient;
        $menu->step = $step;
        $menu->menu_release = $menu_release;
        $menu->save();
    }

    public function edit($id, $recipe_category_id, $menu_name, $image_path, $description, $ingredient, $step, $menu_release) {
        $menu = $this->where('id', $id)->first();
        $menu->recipe_category_id = $recipe_category_id;
        $menu->menu_name = $menu_name;
        $menu->image_path = $image_path;
        $menu->description = $description;
        $menu->ingredient = $ingredient;
        $menu->step = $step;
        $menu->menu_release = $menu_release;
        $menu->save();

        return $menu;
    }
}
