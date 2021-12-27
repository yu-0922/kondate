<?php

namespace App\Http\Controllers;

use Facades\App\Models\Recipe;
use Facades\App\Models\Category;
use Facades\App\Models\Ingredient;
use Facades\App\Models\Menu;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::paginate(15);
        return view('recipes.create',[
            'menus' => $menus
        ]);
    }

    public function createMenu(Request $request)
    {
        return view('recipes.createMenu',[
            'theMenu' => Menu::find($request->id)
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
        return view ('recipes.show', [
            'theMenu' => Menu::where('id', $id)->first(),
            'categories' => Category::get(),
            'ingredients' => Ingredient::where('menu_id', $id)->get()
        ]);
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

    public function destroy(Request $request)
    {
        $theMenu = Recipe::find($request->id);

        if(\Auth::id() == $theMenu->user_id){
            $theMenu->delete();
            return redirect()->route('home.show');
        }
        abort(401);
    }
}
