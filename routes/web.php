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

Route::get('/', 'MenuController@index')->name('menu.index');

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

        Route::get('/recipes/create', 'RecipeController@create')->name('recipe.create');
        Route::get('/recipes/create/{id}', 'RecipeController@createMenu')->name('recipe.createMenu');
        Route::get('/recipes/{id}', 'RecipeController@show')->name('recipe.show');
        Route::get('/recipe/{id}/delete', 'RecipeController@confirmDelete')->name('recipe.confirmDelete');
        Route::delete('/recipes/{id}', 'RecipeController@destroy')->name('recipe.destroy');
        // Route::post('/home', 'RecipeController@store')->name('recipe.store');
        // Route::put('/recipes/{id}', 'RecipeController@update')->name('recipe.update');
        // Route::get('/recipes/{id}/edit', 'RecipeController@edit')->name('recipe.edit');

        Route::post('/home', 'HomeController@store')->name('home.store');
        Route::get('/home', 'HomeController@show')->name('home.show');

        Route::get('/ingredients', 'IngredientController@show')->name('ingredient.show');
        Route::delete('/ingredients', 'IngredientController@destroy')->name('ingredient.destroy');
    }
);

Route::get('/categories', 'CategoryController@index')->name('category.index');
Route::get('/categories/{id}', 'CategoryController@show')->name('category.show');


Auth::routes();

