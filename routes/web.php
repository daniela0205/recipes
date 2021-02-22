<?php

use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'StartController@index')->name('start.index');

// Recipes Routes
// Route::get('/recipes', 'RecipeController@index')->name('recipes.index');
// Route::get('/recipes/create', 'RecipeController@create')->name('recipes.create');
// Route::post('/recipes', 'RecipeController@store')->name('recipes.store');
// Route::get('/recipes/{recipe}','RecipeController@show')->name('recipes.show');
// Route::get('/recipes/{recipe}/edit','RecipeController@edit')->name('recipes.edit');
// Route::put('/recipes/{recipe}','RecipeController@update')->name('recipes.update');
// Route::delete('/recipes/{recipe}','RecipeController@destroy')->name('recipes.destroy');
Route::resource('recipes', 'RecipeController');
//Categories

Route::get('/categories/{categoryRecipe}','CategoriesController@show')->name('categories.show');

Route::get('/search','RecipeController@search')->name('search.show');


// Prefile Routes
Route::get('/profiles/{profile}','ProfileController@show')->name('profiles.show');
Route::get('/profiles/{profile}/edit','ProfileController@edit')->name('profiles.edit');
Route::put('/profiles/{profile}','ProfileController@update')->name('profiles.update');


//Likes

Route::post('/recipes/{recipe}', 'LikesController@update')->name('likes.update');


Auth::routes();

