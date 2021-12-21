<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories = Category::orderBy('created_at', 'desc')->get();

        // return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categories = Category::where('id', $id)->orderBy('created_at', 'desc')->get();

        return view('categories.show', [
            'categories' => $categories,
            'menus' => Menu::where('recipe_category_id', $id)->paginate(10)]);
    }
}
