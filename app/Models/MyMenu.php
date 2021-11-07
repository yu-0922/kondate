<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MyMenu extends Model
{
    /**
     * マイメニュー登録されたメニューを取得
     */
    public function menu() {
        return $this->belongsTo('App\Models\Menu');
    }

    /**
     * マイメニューのユーザーを取得
     */
    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function create($menu, $ingredient) {
        $myMenu = new self();
        $myMenu->user_id = Auth::id();
        $myMenu->menu_id = $menu->id;
        $myMenu->ingredient = $ingredient;
        $myMenu->status = 1;
        $myMenu->save();
    }
}
