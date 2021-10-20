<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IngredientCategory extends Model
{
    /**
     * カテゴリに登録されている具材を取得
     */
    public function ingredients() {
        return $this->hasMany('App\Models\Ingredient');
    }
}
