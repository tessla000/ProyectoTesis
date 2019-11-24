<?php

namespace App\Http\Controllers;

use App\Orden;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdenController extends Controller
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
    public function index(Request $request)
    {
        $transaccion = $request->input('orden');
        if (Auth::check()) {
            if (Auth::user()->rol_id == 2) {
                $orden = Orden::with('transaccion')->where('transaccion_id', $transaccion)->get();
            }elseif (Auth::user()->rol_id == 1) {
                $orden = Orden::all();
            }
            return view('orden.index', compact('orden', $orden));
        }else{
            $request->session()->flash('message', 'Acceso Denegado!');
            return redirect()->route('producto.index');
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function show(Orden $orden)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function edit(Orden $orden)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orden $orden)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Orden  $orden
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orden $orden)
    {
        //
    }
}
