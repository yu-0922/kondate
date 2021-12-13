<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\App\Models\Menu;
use Facades\App\Models\Ingredient;

class IngredientController extends Controller
{
    public function create(Request $request, $id)
    {

        return view('ingredients.create');
    }

    public function store(Request $request)
    {
        //バリデーション
        $validatedData = $request->validate([
            'menu_id' => 'required',
            'ing_name.*' => 'required|max:3000',
            'ing_size.*' => 'required|max:3000',
        ]);

        $datas = $request->get('ing_name');
        $sizes = $request->get('ing_size');
        $menu_id = $request->get('menu_id');

        foreach($datas as $key => $data) {
            Ingredient::create([
                'menu_id' => $menu_id,
                'ingredient_name' => $data,
                'unit' => $sizes[$key]
            ]);
        }
        return redirect()->route('menu.index')->with('message', $validatedData['menu_name'] . 'を登録しました！');
    }

}
