<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    //指定したカラムにデータの挿入を許可する
    protected $fillable = ['menu_name', 'user_id', 'image_path', 'description', 'step', 'category_id'];

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
}
