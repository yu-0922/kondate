<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Facades\App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $r_day = $request->get('d');
        $menus = Menu::paginate(15);
        return view('recipes.create',[
            'menus' => $menus,
            // 'r_day' => $r_day
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cooking_day' => 'required|date',
            'recipe_time' => 'required',
            'menu_id' => 'max:255',
        ]);

        $cooking_day = $request->get('cooking_day');
        $recipe_time = $request->get('recipe_time');
        $menu_id = $request->get('menu_id');

        Recipe::create(
            $cooking_day,
            $recipe_time,
            $menu_id
        );

        return redirect()->route('recipe.store', [
            'cooking_day' => $cooking_day,
            'recipe_time' => $recipe_time,
            'menu_id' => $menu_id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('home', ['recipe' => Recipe::get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $recipes = Recipe::find($request->id);

        if(\Auth::id() == $recipes->user_id){
            return view ('recipes.edit', [
                'recipes' => $recipes ,
            ]);
        }
        abort(401);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'morning_recipe.*' => 'max:255',
            'lunch_recipe.*' => 'max:255',
            'dinner_recipe.*' => 'max:255',
            'cooking_day' => 'required|date',
        ]);

        $morning_recipes = $request->get('morning_recipe');
        $ary = [];
        foreach($morning_recipes as $key => $value){
            $ary[] = [$value];
        }
        $morning_recipe = json_encode($ary);

        $cooking_day = $request->get('cooking_day');

        Recipe::create(
            $morning_recipe,
            $request->get('lunch_recipe'),
            $request->get('dinner_recipe'),
            $cooking_day,
        );

        return redirect()->route('home', [
            'recipes' => Recipe::find($request->id),
            'morning_recipe' => $morning_recipe,
            'cooking_day' => $cooking_day
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $recipe = Recipe::find($request->id);
        $recipe->delete();

        return redirect()->route('home');
    }
}
