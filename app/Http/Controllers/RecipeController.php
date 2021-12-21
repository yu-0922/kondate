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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     return view('home', ['recipe' => Recipe::get()]);
    // }
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function confirmDelete(Request $request, $datas)
    {
        return view ('recipes.confirmDelete', [
            'theMenu' => Menu::find($request->id),
            'datas' => $datas,
            'categories' => Category::get(),
        ]);
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
