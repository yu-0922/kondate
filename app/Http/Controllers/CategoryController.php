<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;

class CategoryController extends Controller
{
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
            'menus' => Menu::where('category_id', $id)->paginate(10)
        ]);
    }
}
