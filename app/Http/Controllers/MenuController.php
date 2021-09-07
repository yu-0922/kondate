<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
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
    public function create()
    {
        return view('menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'menu_name' => 'required',
            'tokuchou' => 'max:500',
        ]);
        $data['user_id'] = \Auth::id();
        // var_dump($data['menu_name']);
        Menu::create($data);
        return redirect()->route('menu.index')->with('message', $data['menu_name'] . '登録成功しました！');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $theMenu)
    {
        return view ('menus.show', [ 'theMenu' => $theMenu ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $theMenu)
    {
        Gate::authorize('isOwner', $theMenu);
        return view ('menus.edit', [ 'theMenu' => $theMenu ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $theMenu)
    {
        $data = $request->validate([
            'menu_name' => 'required',
            'tokuchou' => 'max:500',
        ]);
        $data['user_id'] = \Auth::id();
        // var_dump($data['menu_name']);
        $theMenu->fill($data)->update();
        return redirect()->route('menu.edit', [ 'theMenu' => $theMenu ])->with('message', $data['menu_name'] . '登録成功しました！');
    }

    public function confirmDelete(Menu $theMenu)
    {
        return view ('menus.confirmDelete', [ 'theMenu' => $theMenu ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $theMenu)
    {
        $menuName = $theMenu->menu_name;
        $theMenu->delete();
        return redirect()->route('menu.index')->with('message', $menuName . 'を削除しました！');
    }
}
