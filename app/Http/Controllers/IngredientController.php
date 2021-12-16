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
        // 今日を取得
        $dt = Carbon::today();
        $s_week = $dt->startOfWeek()->subDay(1);
        $e_week = $s_week->copy()->addDays(6);
        // //曜日番号を取得
        // $skip = $carbon->dayOfWeek;
        // //取得した曜日番号の分だけ日数を減らす
        // $carbon->subDays($skip);

        // for($i=0; $i<=6; $i++) {
        //     $date = [];
        //     // 0埋めして日付を取得
        //     $d = sprintf("%04d", $carbon->year). '-'. sprintf("%02d", $carbon->month). "-". sprintf("%02d", $carbon->day);
        //     $ingredients = \App\Models\Recipe::with(['menu' => function($query){
        //             $query->with('ingredients');
        //         }])->get();
        //     // $recipes = \App\Models\Recipe::with('menu')->select('menu_id')->where('cooking_day', $d)->get();
        //     // $ingredients = Ingredient::get();
        //     $date[] = $d;
        //     $date[] = $ingredients;
        //     $carbon->addDay();
        //     $w_day[] = $date;
        // }
        // $menus = $query->orderBy('created_at', 'desc')->paginate(10);
        // dd($w_day);

        // $ingredients = Ingredient::whereHas('menu', function ($query) {
        //     $query->where('user_id', Auth::id());
        // })->where('cooking_day', '>=', $s_week)->where('cooking_day', '<=', $e_week)->orderBy('ingredient_name', 'desc')->get();

        $ingredients = Ingredient::whereHas('menu', function ($query) {
            $query->where('user_id', Auth::id());
        })->whereHas('menu.recipes', function ($query) {
            $dt = Carbon::today();
            $s_week = $dt->startOfWeek()->subDay(1);
            $e_week = $s_week->copy()->addDays(6);
            $query->where('cooking_day', '>=', $s_week)->where('cooking_day', '<=', $e_week);
        })->orderBy('ingredient_name', 'desc')->get();

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
