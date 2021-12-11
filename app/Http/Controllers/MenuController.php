<?php

namespace App\Http\Controllers;

use Facades\App\Models\Menu;
use Facades\App\Models\MyMenu;
use App\Models\User;
use Facades\App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        //requestから取得したmenu_nameが空なら全てのメニューを表示、空でなければ該当の者を表示
        if (empty($menu_name)) {
            $query = Menu::query();
        } else {
            $query = Menu::where("menu_name", "LIKE", "%$menu_name%");
        }
        //新しい順に並び替え、1ページあたり10件表示
        $menus = $query->orderBy('created_at', 'desc')->paginate(10);
        //menusディレクトリのindex.blade.phpファイルに$menusを返す
        return view('menus.index', ['menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //カテゴリ一覧を取得
        $categories = Category::get();

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
        //バリデーション
        $validatedData = $request->validate([
            'recipe_category_id' => 'required',
            'menu_name' => 'required|max:255',
            'image_path' => 'image|file|nullable',
            'description' => 'max:1000|nullable',
            'ing_name.*' => 'required|max:3000',
            'ing_size.*' => 'required|max:3000',
            'step.*' => 'max:5000|nullable',
            'menu_release' => 'required',
        ]);
        //材料の名前と量を取得して配列にする
        $datas = $request->get('ing_name');
        $sizes = $request->get('ing_size');
        $array = [];
        foreach($datas as $key => $data){
            $array[] = [$data, $sizes[$key]];
        }
        $ingredient = json_encode($array);

        //手順についても同様に取得して配列に
        $steps = $request->get('step');

        $ary = [];
        foreach($steps as $key => $value){
            $ary[] = [$value];
        }
        $step = json_encode($ary);
        //publicをstorageに置換し、storage/imagesディレクトリにアップロードファイルを保存
        $path = str_replace("public/", "/storage/", $request->file('image_path')->storeAs("/public/images", $request->file('image_path')->getClientOriginalName()));

        //modelのメソッドを利用してデータベースにrequestで取得した値を保存
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
            'categories' => Category::get()
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
                'categories' => Category::get(),
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

        return redirect()->route('menu.edit', [ 'theMenu' => Menu::find($request->id) ])->with('message', $validatedData['menu_name'] . 'を更新しました！');
    }

    public function confirmDelete(Request $request, $datas)
    {
        return view ('menus.confirmDelete', [
            'theMenu' => Menu::find($request->id),
            'datas' => $datas,
            'categories' => Category::get(),
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
