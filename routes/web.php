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

// Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');

Route::view('/contact', 'contact')->name('contact');
Route::post('contact', 'MessageController@store')->name('messages.store');

Route::post('cart/cart-add', 'CartController@add')->name('cart.add');
Route::get('cart/cart-checkout', 'CartController@cart')->name('cart.checkout');
Route::post('cart/cart-clear', 'CartController@clear')->name('cart.clear');

Route::resource('categoria','CategoriaController')->parameters(["categoria" => "categoria"])->names('categoria');
Route::resource('marca','MarcaController')->parameters(["marca" => "marca"])->names('marca');
Route::resource('producto','ProductoController')->parameters(["producto" => "producto"])->names('producto');
Route::resource('direccion','DireccionController')->parameters(["direccion" => "direccion"])->names('direccion');
Route::resource('info','InfoController')->parameters(["info" => "info"])->names('info');
Route::resource('usuario','UserController')->parameters(["usuario" => "usuario"])->names('usuario');