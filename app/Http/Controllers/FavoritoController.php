<?php

namespace App\Http\Controllers;

use App\Favorito;
use App\Producto;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritoController extends Controller
{

    public function add(Request $request)
    {
        $favorito =  $request->input('favorito');
        $producto = Producto::find($favorito);
        $producto->addFavorite(Auth::id());
        return redirect()->route('producto.show', $producto);
    }

    public function remove(Request $request)
    {
        $favorito =  $request->input('favorito');
        // dd($favorito);
        $producto = Producto::find($favorito);
        $producto->removeFavorite(Auth::id());
        return redirect()->route('producto.show', $producto);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::id();
        $favorito = Favorito::where('user_id', $user)->get('favoriteable_id');
        $producto = Producto::whereIn('producto_id', $favorito)->get();
        return view('favorito.index', compact('producto', $producto));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

    }
}
