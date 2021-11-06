<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Favorite extends Model
{
    /**
     * お気に入り登録されたメニューを取得
     */
    public function menus() {
        return $this->hasMany('App\Models\Menu');
    }

    /**
     * お気に入り登録しているユーザーを取得
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function add($menuId) {
        $favorite = new self();
        $favorite->user_id = Auth::id();
        $favorite->menu_id = $menuId;
        $favorite->save();
    }
}
