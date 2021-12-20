<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\App\Models\Menu;
use Facades\App\Models\User;
use Facades\App\Models\Ingredient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class IngredientController extends Controller
{
    public function create(Request $request)
    {
        // dd($theMenu);
        // $ingredient = $request->get('id');;
        // return view('ingredients.create',['theMenu' => $ingredient]);
    }

    public function store(Request $request)
    {
        //バリデーション
        // $validatedData = $request->validate([
        //     'menu_id' => 'required',
        //     'ing_name.*' => 'required|max:3000',
        //     'ing_size.*' => 'required|max:3000',
        // ]);

        // $datas = $request->get('ing_name');
        // $sizes = $request->get('ing_size');
        // $menu_id = $request->get('menu_id');

        // foreach($datas as $key => $data) {
        //     Ingredient::create([
        //         'menu_id' => $menu_id,
        //         'ingredient_name' => $data,
        //         'unit' => $sizes[$key]
        //     ]);
        // }
        // return redirect()->route('menu.index')->with('message', $validatedData['menu_name'] . 'を登録しました！');
    }

    public function show()
    {
        // $ingredients = Ingredient::whereHas('menu', function ($query) {
        //     $query->where('user_id', Auth::id());
        // })->where('cooking_day', '>=', $s_week)->where('cooking_day', '<=', $e_week)->orderBy('ingredient_name', 'desc')->get();

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

    public function destroy(Request $request)
    {
        $ingredient = Ingredient::find($request->id);
        if(\Auth::id() == 1 || \Auth::id() == User::id()){
            $ingredient->delete();
            return redirect()->route('menu.index');
        }
        abort(401);
    }

}
