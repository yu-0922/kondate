<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeCategory extends Model
{
    protected $fillable = [
        'recipe_category_name',
    ];

    /**
     * メニューを取得
     */
    public function menus() {
        return $this->hasMany('App\Models\Menu');
    }
}
