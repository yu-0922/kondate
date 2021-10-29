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

Route::get('/', function () {
    return view('welcome');
})->name('top');

Route::group(
    ["middleware" => "auth"],
    function() {
        Route::get('/logout', function () {
            \Auth::logout();
            // request()->session()->invalidate();
            return redirect()->route('login')->with('message', 'ログアウトしました！');
        })->name('logout');

        // メニュー関連のルーティング
        Route::get('/menus/create', 'MenuController@create')->name('menu.create');
        Route::post('/menus', 'MenuController@store')->name('menu.store');
        Route::put('/menus/{id}', 'MenuController@update')->name('menu.update');
        Route::get('/menus/{id}/edit', 'MenuController@edit')->name('menu.edit');
        Route::get('/menus/{id}/delete', 'MenuController@confirmDelete')->name('menu.confirmDelete');
        Route::delete('/menus/{id}', 'MenuController@destroy')->name('menu.destroy');

        // 具材関連のルーティング
        // Route::get('/ingredients/create', 'IngredientController@create')->name('ingredient.create');
        // Route::post('/ingredients', 'IngredientController@store')->name('ingredient.store');
        // Route::get('/ingredients', 'IngredientController@index')->name('ingredient.index');
        // Route::get('/ingredients/{theIngredient}', 'IngredientController@show')->name('ingredient.show');
        // Route::get('/ingredients/{theIngredient}/edit', 'IngredientController@edit')->name('ingredient.edit');
        // Route::put('/ingredients/{theIngredient}', 'IngredientController@update')->name('ingredient.update');
        // Route::get('/ingredients/{theIngredient}/delete', 'IngredientController@confirmDelete')->name('ingredient.confirmDelete');
        // Route::delete('/ingredients/{theIngredient}', 'IngredientController@destroy')->name('ingredient.destroy');
    }
);

Route::get('/menus', 'MenuController@index')->name('menu.index');
Route::get('/menus/{id}', 'MenuController@show')->name('menu.show');

Route::get('/categories', 'RecipeCategoryController@index')->name('category.index');
// Route::get('/categories/{id}', 'CategoryController@show')->name('category.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
