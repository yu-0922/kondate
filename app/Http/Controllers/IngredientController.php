<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class IngredientController extends Controller
{
    public function show()
    {
        // 今日を取得
        $dt = Carbon::today();
        // 週初めを取得
        $s_week = $dt->startOfWeek()->subDay(1);
        // 週終わりを取得
        $e_week = $s_week->copy()->addDays(6);

        // 指定の日付範囲のレシピに紐付いたメニューに紐付いた材料を取得
        $recipes = \Auth::user()->recipes()->with('menu.ingredients')->where('cooking_day', '>=', $s_week)->where('cooking_day', '<=', $e_week)->get();

        $ingredients = [];
        foreach($recipes as $recipe) {
            foreach($recipe->menu->ingredients as $ingredient) {
                $ingredients[] = $ingredient->toArray();
            }
        }
        // 名前順にソート
        $ingredients = collect($ingredients)->sortBy('ingredient_name')->values();

        return view('ingredients.show', [
            'ingredients' => $ingredients,
        ]);
    }
}
