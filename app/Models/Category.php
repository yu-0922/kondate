<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name',
    ];

    /**
     * メニューを取得
     */
    public function menus() {
        return $this->hasMany('App\Models\Menu');
    }
}
