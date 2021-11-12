<?php

namespace App\Http\Controllers;

use Facades\App\Models\Menu;
use Facades\App\Models\MyMenu;
use App\Models\Menu as AppMenu;
use App\Models\User;
use Facades\App\Models\RecipeCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Facades\App\Models\Favorite;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
class MenuController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menu_name = $request->get("menu_name");

        if (empty($menu_name)) {
            $query = Menu::query();
        } else {
            $query = Menu::where("menu_name", "LIKE", "%$menu_name%");
        }

        Carbon::now();

        $menus = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('menus.index', ['menus' => $menus]);
    }

    public function favorite($id)
    {
        if ($f = Auth::user()->favorites()->where('menu_id', $id)->first()) {
            $f->delete();
        } else {
            Favorite::add($id);
        }

        return redirect()->route('menu.show', ['theMenu' => $id]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = RecipeCategory::get();
        return view('menus.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'recipe_category_id' => 'required',
            'menu_name' => 'required|max:255',
            'image_path' => 'image|file|nullable',
            'description' => 'max:1000|nullable',
            'ing_name.*' => 'required|max:3000',
            'ing_size.*' => 'required|max:3000',
            'step.*' => 'max:5000|nullable',
            'menu_release' => 'required',
            'my_menu_register' => 'required'
        ]);

        $datas = $request->get('ing_name');
        $sizes = $request->get('ing_size');
        $array = [];
        foreach($datas as $key => $data){
            $array[] = [$data, $sizes[$key]];
        }
        $ingredient = json_encode($array);

        $steps = $request->get('step');

        $ary = [];
        foreach($steps as $key => $value){
            $ary[] = [$value];
        }
        $step = json_encode($ary);

        $path = str_replace("public/", "/storage/", $request->file('image_path')->storeAs("/public/images", $request->file('image_path')->getClientOriginalName()));

        Menu::create(
            $request->get('recipe_category_id'),
            $request->get('menu_name'),
            $path,
            $request->get('description'),
            $ingredient,
            $step,
            $request->get('menu_release'),
        );

        MyMenu::create(
            Auth::user()->menus()->orderBy("created_at", "desc")->first(),
            $ingredient
        );

        return redirect()->route('menu.index')->with('message', $validatedData['menu_name'] . 'を登録しました！');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        return view ('menus.show', [
            'theMenu' => Menu::where('id', $id)->first(),
            'categories' => RecipeCategory::get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $datas)
    {
        $theMenu = Menu::find($request->id);

        if(\Auth::id() == 1 || \Auth::id() == $theMenu->user_id){
            return view ('menus.edit', [
                'theMenu' => $theMenu ,
                'datas' => $datas,
                'categories' => RecipeCategory::get(),
            ]);
        }
        abort(401);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $datas)
    {
        $validatedData = $request->validate([
            'recipe_category_id' => 'required',
            'menu_name' => 'required|max:255',
            'image_path' => 'image|file|nullable',
            'description' => 'max:1000|nullable',
            'ing_name.*' => 'required|max:3000',
            'ing_size.*' => 'required|max:3000',
            'step.*' => 'max:5000|nullable',
            'menu_release' => 'required',
            'my_menu_register' => 'required'
        ]);

        $datas = $request->get('ing_name');
        $sizes = $request->get('ing_size');
        $array = [];
        foreach($datas as $key => $data){
            $array[] = [$data, $sizes[$key]];
        }
        $ingredient = json_encode($array);

        $steps = $request->get('step');

        $ary = [];
        foreach($steps as $key => $value){
            $ary[] = [$value];
        }
        $step = json_encode($ary);

        $path = str_replace("public/", "/storage/", $request->file('image_path')->storeAs("/public/images", $request->file('image_path')->getClientOriginalName()));

        Menu::edit(
            $request->id,
            $request->get('recipe_category_id'),
            $request->get('menu_name'),
            $path,
            $request->get('description'),
            $ingredient,
            $step,
            $request->get('menu_release'),
        );

        return redirect()->route('menu.edit', [ 'theMenu' => Menu::find($request->id) ])->with('message', $datas['menu_name'] . 'を更新しました！');
    }

    public function confirmDelete(Request $request, $datas)
    {
        return view ('menus.confirmDelete', [
            'theMenu' => Menu::find($request->id),
            'datas' => $datas,
            'categories' => RecipeCategory::get(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $theMenu = Menu::find($request->id);
        if(\Auth::id() == 1 || \Auth::id() == $theMenu->user_id){
            $theMenu->delete();
            return redirect()->route('menu.index')->with('message', $theMenu->menu_name . 'を削除しました！');
        }
        abort(401);
    }
}
