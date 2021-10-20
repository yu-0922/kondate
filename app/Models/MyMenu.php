<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
