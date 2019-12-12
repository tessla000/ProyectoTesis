<?php

namespace App\Http\Controllers;

use App\Marca;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarcaController extends Controller
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
        if (Auth::check()) {
            if (Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2) {
                $marca = Marca::inRandomOrder()->get();
            }else{
                $marca = Marca::where('usuario_id', Auth::id())->get();
            }
            return view('marca.index', compact('marca', $marca));
        }else{
            $marca = Marca::inRandomOrder()->get();
            return view('marca.index', compact('marca', $marca));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->rol_id == 1) {
            $usuario = User::all();
        }elseif(Auth::user()->rol_id == 3){
            $usuario = Auth::id();
        }
        $marca = new Marca();
        return view('marca.create', compact('usuario', 'marca'));
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
                'name' => 'required|min:5|unique:marca',
                'descripcion' => 'nullable',
                'usuario_id' => 'nullable'
            ],[
                'name.required' => 'Nombre requerido',
                'descripcion.nullable' => 'Descripcion',
                'usuario_id.nullable' => 'Usuario'
            ]
        );
        $marca = Marca::create([
            'name' => $request['name'],
            'descripcion' => $request['descripcion'],
            'usuario_id' => Auth::id()
        ]);
        $request->session()->flash('message', 'Marca Almacenada!');
        return redirect()->route('marca.show', $marca);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function show(Marca $marca)
    {
        return view('marca.show', compact('marca', $marca));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        if (Auth::user()->rol_id == 1) {
            $usuario = User::all();
        }elseif (Auth::user()->rol_id == 3) {
            $usuario = Auth::id();
        }elseif (Auth::user()->rol_id == 2) {
            request()->session()->flash('message', 'Acceso Denegado!');
            return redirect()->route('marca.show', $marca);
        }
        return view('marca.edit', compact('usuario', 'marca', $marca));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marca $marca)
    {
        $data = $request->validate(
            [
                'name' => 'nullable',
                'descripcion' => 'nullable',
                'usuario_id' => 'nullable'
            ]
        );
        $marca->update($data);
        $request->session()->flash('message', 'Marca Modificada!');
        return redirect()->route('marca.show', $marca);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Marca $marca)
    {
        if (Auth::user()->rol_id == 1 || Auth::user()->rol_id == 3){
            $marca->delete();
            $request->session()->flash('message', 'Marca Eliminada!');
            return redirect()->route('marca.index', $marca);
        }else{
            request()->session()->flash('message', 'Acceso Denegado!');
            return redirect()->route('marca.index');
        }
    }
}
