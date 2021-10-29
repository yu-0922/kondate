<?php

namespace App\Http\Controllers;

use Facades\App\Models\Menu;
use App\Models\Menu as AppMenu;
use App\Models\User;
use Facades\App\Models\RecipeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu_name = request()->input("menu_name");

        if(empty($menu_name)) {
            $query = Menu::query();
        } else {
            $query = Menu::where("menu_name", "LIKE", "{$menu_name}%");
        }

        $menus = $query->orderBy('created_at', 'desc')->paginate(5);

        return view('menus.index', ['menus' => $menus]);
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
            // 'image_path' => 'image|file|nullable',
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
        $json = json_encode($array);
        $ing = json_decode($json);
        // echo "<br>";
        // foreach($ing as $a) {
        //     echo $a[0]."：".$a[1]."<br>";
        // }

        $steps = $request->get('step');

        $ary = [];
        foreach($steps as $key => $value){
            $ary[] = [$value];
        }
        $json = json_encode($ary);
        $stp = json_decode($json);
        // echo "<br>";
        // foreach($stp as $b) {
        //     echo $b[0]."<br>";
        // }

        // $data['user_id'] = \Auth::id();
        Menu::create(
            $request->get('recipe_category_id'),
            $request->get('menu_name'),
            $request->get('image_path'),
            $request->get('description'),
            $request->get('ingredient'),
            $request->get('step'),
            $request->get('menu_release'),
            $request->get('my_menu_register'),
        );

        Storage::putFileAs('public', $request->file('image_path'), $request->user()->id);

        return redirect()->route('menu.index')->with('message', $datas['menu_name'] . 'を登録しました！');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request, $id)
    {
        $datas = $request->get('ing_name');

        return view ('menus.show', [
            'theMenu' => Menu::where('id', $id)->first(),
            'datas' => $datas,
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
            // 'image_path' => 'image|nullable',
            'description' => 'max:1000|nullable',
            'ing_name.*' => 'required|max:3000',
            'ing_size.*' => 'required|max:3000',
            'step.*' => 'max:5000|nullable',
            'menu_release' => 'required',
            'my_menu_register' => 'required'
        ]);

        $theMenu = Menu::edit(
            $request->id,
            $request->get('recipe_category_id'),
            $request->get('menu_name'),
            $request->get('image_path'),
            $request->get('description'),
            $request->get('ingredient'),
            $request->get('step'),
            $request->get('menu_release'),
            $request->get('my_menu_register'),
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
