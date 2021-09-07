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
            request()->session()->invalidate();
            return redirect()->route('login')->with('message', 'ログアウトしました！');
        })->name('logout');

        // メニュー関連のルーティング
        Route::get('/menus/create', 'MenuController@create')->name('menu.create');
        Route::post('/menus', 'MenuController@store')->name('menu.store');
        Route::put('/menus/{theMenu}', 'MenuController@update')->name('menu.update');
        Route::get('/menus/{theMenu}/edit', 'MenuController@edit')->name('menu.edit');
        Route::get('/menus/{theMenu}/delete', 'MenuController@confirmDelete')->name('menu.confirmDelete');
        Route::delete('/menus/{theMenu}', 'MenuController@destroy')->name('menu.destroy');

        // 具材関連のルーティング
        /*Route::get('/ingredients/create', 'IngredientController@create')->name('ingredient.create');
        Route::post('/ingredients', 'IngredientController@store')->name('ingredient.store');
        Route::get('/ingredients', 'IngredientController@index')->name('ingredient.index');
        Route::get('/ingredients/{theIngredient}', 'IngredientController@show')->name('ingredient.show');
        Route::get('/ingredients/{theIngredient}/edit', 'IngredientController@edit')->name('ingredient.edit');
        Route::put('/ingredients/{theIngredient}', 'IngredientController@update')->name('ingredient.update');
        Route::get('/ingredients/{theIngredient}/delete', 'IngredientController@confirmDelete')->name('ingredient.confirmDelete');
        Route::delete('/ingredients/{theIngredient}', 'IngredientController@destroy')->name('ingredient.destroy');

        // 調味料関連のルーティング
        Route::get('/seasonings/create', 'SeasoningController@create')->name('seasoning.create');
        Route::post('/seasonings', 'SeasoningController@store')->name('seasoning.store');
        Route::get('/seasonings', 'SeasoningController@index')->name('seasoning.index');
        Route::get('/seasonings/{theSeasoning}', 'SeasoningController@show')->name('seasoning.show');
        Route::get('/seasonings/{theSeasoning}/edit', 'SeasoningController@edit')->name('seasoning.edit');
        Route::put('/seasonings/{theSeasoning}', 'SeasoningController@update')->name('seasoning.update');
        Route::get('/seasonings/{theSeasoning}/delete', 'SeasoningController@confirmDelete')->name('seasoning.confirmDelete');
        Route::delete('/seasonings/{theSeasoning}', 'SeasoningController@destroy')->name('seasoning.destroy'); */

    }
);

Route::get('/menus', 'MenuController@index')->name('menu.index');
Route::get('/menus/{theMenu}', 'MenuController@show')->name('menu.show');


Route::get('/result', function () {
    return view('result');
})->name('system.message');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
