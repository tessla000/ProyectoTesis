<?php

namespace App\Http\Controllers;

use App\Suscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuscripcionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suscripcion = Suscripcion::all();
        return view('suscripcion.index', compact('suscripcion', $suscripcion));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->rol_id == 1) {
            $suscripcion = new Suscripcion();
            return view('suscripcion.create', compact('suscripcion'));
        }else{
            request()->session()->flash('message', 'Acceso Denegado!');
            return redirect()->route('home');
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
                'name' => 'required|min:5|unique:suscripcion',
                'cantidad_productos' => 'required|min:1',
            ],[
                'name.required' => 'Nombre requerido',
                'cantidad_productos.required' => 'Cantidad de productos requerida',
            ]
        );
        $suscripcion = Suscripcion::create([
            'name' => $request['name'],
            'cantidad_productos' => $request['cantidad_productos']
        ]);
        $request->session()->flash('message', 'Suscripcion Almacenada!');
        return redirect()->route('suscripcion.show', $suscripcion);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Suscripcion $suscripcion)
    {
        return view('suscripcion.show', compact('suscripcion', $suscripcion));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Suscripcion $suscripcion)
    {
        if (Auth::user()->rol_id == 1) {
            return view('suscripcion.edit', compact('suscripcion', $suscripcion));
        }else{
            request()->session()->flash('message', 'Acceso Denegado!');
            return redirect()->route('home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suscripcion $suscripcion)
    {
        $data = $request->validate(
            [
                // 'name' => 'required|min:5|unique:suscripcion',
                'cantidad_productos' => 'required|min:1',
            ]
        );
        $suscripcion->update($data);
        $request->session()->flash('message', 'Suscripcion Modificada!');
        return redirect()->route('suscripcion.show', $suscripcion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Suscripcion $suscripcion)
    {
        if (Auth::user()->rol_id == 1){
            $suscripcion->delete();
            $request->session()->flash('message', 'Suscripcion Eliminada!');
            return redirect()->route('suscripcion.index', $suscripcion);
        }else{
            request()->session()->flash('message', 'Acceso Denegado!');
            return redirect()->route('home');
        }
    }
}
