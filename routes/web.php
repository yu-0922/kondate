<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    ["middleware" => "auth"],
    function() {
        Route::get('/logout', function () {
            \Auth::logout();
            return redirect()->route('login')->with('message', 'ログアウトしました！');
        })->name('logout');

        // メニュー関連のルーティング
        Route::get('/menus/create', 'MenuController@create')->name('menu.create');
        Route::post('/menus', 'MenuController@store')->name('menu.store');
        Route::get('/menus/{id}', 'MenuController@show')->name('menu.show');
        Route::put('/menus/{id}', 'MenuController@update')->name('menu.update');
        Route::get('/menus/{id}/edit', 'MenuController@edit')->name('menu.edit');
        Route::get('/menus/{id}/delete', 'MenuController@confirmDelete')->name('menu.confirmDelete');
        Route::delete('/menus/{id}', 'MenuController@destroy')->name('menu.destroy');

        // レシピ関連のルーティング
        Route::get('/recipes/create', 'RecipeController@create')->name('recipe.create');
        Route::get('/recipes/create/{id}', 'RecipeController@createMenu')->name('recipe.createMenu');
        Route::get('/recipes/{id}', 'RecipeController@show')->name('recipe.show');
        Route::delete('/recipes', 'RecipeController@destroy')->name('recipe.destroy');

        // ホーム関連のルーティング
        Route::post('/home', 'HomeController@store')->name('home.store');
        Route::get('/home', 'HomeController@show')->name('home.show');

        // 材料関聯のルーティング
        Route::get('/ingredients', 'IngredientController@show')->name('ingredient.show');
    }
);

Route::get('/menus', 'MenuController@index')->name('menu.index');

// カテゴリー関連のルーティング
Route::get('/categories/{id}', 'CategoryController@show')->name('category.show');

Auth::routes();

if (env('APP_ENV') === 'production') {
    URL::forceScheme('https');
}
