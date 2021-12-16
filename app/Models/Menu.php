<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    //指定したカラムにデータの挿入を許可する
    protected $fillable = ['menu_name', 'user_id', 'image_path', 'description', 'step', 'category_id', 'menu_release'];

    /**
     * メニューを登録したユーザーを取得
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * メニューの材料を取得
     */
    public function ingredients() {
        return $this->hasMany('App\Models\Ingredient');
    }

    /**
     * メニューを登録したレシピを取得
     */
    public function recipes() {
        return $this->hasMany('App\Models\Recipe');
    }

    /**
     * メニューのカテゴリを取得
     */
    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    //インスタンスを作成し、データベースに値を入れる
    // public function create($category_id, $menu_name, $image_path, $description, $step, $menu_release) {
    //     $menu = new self();
    //     $menu->category_id = $category_id;
    //     $menu->user_id = Auth::id();
    //     $menu->menu_name = $menu_name;
    //     $menu->image_path = $image_path;
    //     $menu->description = $description;
    //     $menu->step = $step;
    //     $menu->menu_release = $menu_release;
    //     $menu->save();
    // }

    // public function edit($id, $category_id, $menu_name, $image_path, $description, $ingredient, $step, $menu_release) {
    //     $menu = $this->where('id', $id)->first();
    //     $menu->category_id = $category_id;
    //     $menu->menu_name = $menu_name;
    //     $menu->image_path = $image_path;
    //     $menu->description = $description;
    //     $menu->ingredient = $ingredient;
    //     $menu->step = $step;
    //     $menu->menu_release = $menu_release;
    //     $menu->save();

    //     return $menu;
    // }
}
