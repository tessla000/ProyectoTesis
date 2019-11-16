<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
        public function __construct()
        {
            $this->middleware('auth')->except('index', 'show');
        }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoria = Categoria::all();
        return view('categoria.index', compact('categoria', $categoria));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->rol_id !== 1) {
            request()->session()->flash('message', 'Acceso Denegado!');
            return redirect()->route('categoria.index');
        }else{
            return view('categoria.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required|min:5|unique:categoria',
                'descripcion' => 'nullable'
            ],[
                'name.required' => 'Nombre requerido',
                'descripcion.nullable' => 'Descripcion'
            ]
        );
        $categoria = Categoria::create($data);
        $request->session()->flash('message', 'Categoria Almacenada!');
        return redirect()->route('categoria.show', $categoria);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        return view('categoria.show', compact('categoria', $categoria));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        if (Auth::user()->rol_id == 1) {
            return view('categoria.edit', compact('categoria', $categoria));
        }else{
            request()->session()->flash('message', 'Acceso Denegado!');
            return redirect()->route('categoria.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        $data = $request->validate(
            [
                'name' => 'required|min:5|unique:categoria',
                'descripcion' => 'nullable'
            ],[
                'name.required' => 'Nombre requerido',
                'descripcion.nullable' => 'Descripcion'
            ]
        );
        $categoria->update($data);
        $request->session()->flash('message', 'Categoria Modificada!');
        return redirect()->route('categoria.show', $categoria);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Categoria $categoria)
    {
        if (Auth::user()->rol_id == 1){
            $categoria->delete();
            $request->session()->flash('message', 'Categoria Eliminada!');
            return redirect()->route('categoria.index', $categoria);
        }else{
            request()->session()->flash('message', 'Acceso Denegado!');
            return redirect()->route('categoria.index');
        }
    }
}
