<?php

namespace App\Http\Controllers;

use Facades\App\Models\Menu;
use Facades\App\Models\Ingredient;
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
        //requestから取得したmenu_nameが空なら全てのメニューを表示、空でなければ該当のものを表示
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
    public function create()
    {
        //カテゴリ一覧を取得
        $categories = Category::get();

        return view('menus.create', ['categories' => $categories]);
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
            'category_id' => 'required',
            'menu_name' => 'required|max:255',
            'image_path' => 'nullable',
            'description' => 'max:5000|nullable',
            'ing_name.*' => 'required|max:3000',
            'ing_size.*' => 'required|max:255',
            'step' => 'max:5000|nullable',
        ]);

        //リクエストがあればS3にアップロードファイルを保存
        $path = '';
        if ($request->file('image_path')->isValid()) {
            $upload_info = Storage::disk('s3')->putFile('/images', $request->file('image_path'), 'public');
            $path = Storage::disk('s3')->url($upload_info);
        }

        //メニューテーブルにrequestで取得した値を保存
        $menu = \Auth::user()->menus()->create([
            'category_id' => $request->get('category_id'),
            'menu_name' => $request->get('menu_name'),
            'image_path' => $path,
            'description' => $request->get('description'),
            'step' => $request->get('step'),
        ]);

        $datas = $request->get('ing_name');
        $sizes = $request->get('ing_size');

        foreach($datas as $key => $data) {
            Ingredient::create([
                'menu_id' => $menu->id,
                'ingredient_name' => $data,
                'unit' => $sizes[$key]
            ]);
        }

        return redirect()->route('home.show')->with('message', $validatedData['menu_name'] . 'を登録しました！');
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
            'categories' => Category::get(),
            'ingredients' => Ingredient::where('menu_id', $id)->get()
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
            'category_id' => 'required',
            'menu_name' => 'required|max:255',
            'image_path' => 'nullable',
            'description' => 'max:5000|nullable',
            'ing_name.*' => 'required|max:3000',
            'ing_size.*' => 'required|max:255',
            'step' => 'max:5000|nullable',
        ]);

        //requestで取得した値をプロパティに代入
        $menu = Menu::find($request->id)->fill([
            'category_id' => $request->get('category_id'),
            'menu_name' => $request->get('menu_name'),
            'description' => $request->get('description'),
            'step' => $request->get('step'),
        ]);

        //画像が選択された場合、S3にアップロードファイルを保存
        if ($request->hasFile('image_path')) {
            if ($request->file('image_path')->isValid()) {
                $upload_info = Storage::disk('s3')->putFile('/images', $request->file('image_path'), 'public');
                $menu->image_path = Storage::disk('s3')->url($upload_info);
            }
        }
        // メニューテーブル更新
        $menu->update();

        $datas = $request->get('ing_name');
        $sizes = $request->get('ing_size');

        foreach($datas as $key => $data) {
            Ingredient::update([
                'menu_id' => $menu->id,
                'ingredient_name' => $data,
                'unit' => $sizes[$key]
            ]);
        }

        return redirect()->route('home.show', [ 'theMenu' => Menu::find($request->id) ])->with('message', $validatedData['menu_name'] . 'を更新しました！');
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
            return redirect()->route('home.show')->with('message', $theMenu->menu_name . 'を削除しました！');
        }
        abort(401);
    }
}
