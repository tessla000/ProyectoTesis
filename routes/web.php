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
Route::post('cart/cart-remove', 'CartController@remove')->name('cart.remove');

Route::get('checkout', 'CheckoutController@initTransaction')->name('checkout');
Route::post('checkout/webpay/response', 'CheckoutController@response')->name('response');
Route::post('checkout/webpay/finish', 'CheckoutController@finish')->name('finish');

// Route::get('grafico', 'GraficoController@index')->name('grafico');

Route::get('index', 'FavoritoController@index')->name('favorito.index');
Route::post('add', 'FavoritoController@add')->name('favorito.add');
Route::post('remove', 'FavoritoController@remove')->name('favorito.remove');

Route::resource('categoria','CategoriaController')->parameters(["categoria" => "categoria"])->names('categoria');
Route::resource('direccion','DireccionController')->parameters(["direccion" => "direccion"])->names('direccion');
Route::resource('envio','EnvioController')->parameters(["envio" => "envio"])->names('envio');
Route::resource('info','InfoController')->parameters(["info" => "info"])->names('info');
Route::resource('marca','MarcaController')->parameters(["marca" => "marca"])->names('marca');
Route::resource('orden','OrdenController')->parameters(["orden" => "orden"])->names('orden');
Route::resource('producto','ProductoController')->parameters(["producto" => "producto"])->names('producto');
Route::resource('transaccion','TransaccionController')->parameters(["transaccion" => "transaccion"])->names('transaccion');
Route::resource('usuario','UserController')->parameters(["usuario" => "usuario"])->names('usuario');
Route::resource('grafico','GraficoController')->parameters(["grafico" => "grafico"])->names('grafico');
// Route::resource('favorito','FavoritoController')->parameters(["favorito" => "favorito"])->names('favorito');