<?php

namespace App\Http\Controllers;

use App\Envio;
use App\Direccion;
use App\Transaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnvioController extends Controller
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
        if ($request->input('info')) {
            $envio = Envio::where('transaccion_id', $request->input('info'))->get()->sortBy('updated_at');
        }else{
            if (Auth::user()->rol_id == 1) {
                $envio = Envio::all()->sortBy('updated_at');
            }elseif (Auth::user()->rol_id == 2) {
                $direccion = Direccion::where('usuario_id', Auth::id())->get();
                $envio = Envio::whereIn('direccion_id', $direccion)->get()->sortBy('updated_at');
            }
        }
        return view('envio.index', compact('envio', $envio));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $direccion = Direccion::where('usuario_id', Auth::id())->get();
        $transaccion = Transaccion::where('transaccion_id', request()->input('envio'))->get();
        $envio = new Envio();
        return view('envio.create', compact('direccion', 'transaccion', 'envio'));
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
                'codigoSeguimiento' => 'nullable',
                'estado' => 'nullable',
                'direccion_id' => 'required',
                'transaccion_id' => 'required'
            ],[
                'codigoSeguimiento.nullable' => 'Codigo Seguimiento requerido',
                'estado.nullable' => 'Estado',
                'direccion_id.required' => 'Direccion requerida',
                'transaccion_id.required' => 'Transaccion requerida'
            ]
        );
        $envio = Envio::where('transaccion_id', $request['transaccion_id'])->first();
        if ($envio) {
            $request->session()->flash('message', 'El envio ya esta registrado en el sistema!');
            return redirect()->route('transaccion.index');
        }else{
            $envio = Envio::create([
                'codigoSeguimiento' => "0",
                'estado' => 0,
                'transaccion_id' => $request['transaccion_id'],
                'direccion_id' => $request['direccion_id']
            ]);
            $request->session()->flash('message', 'Envio En Proceso!');
            return redirect()->route('envio.show', $envio);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function show(Envio $envio, Request $request)
    {
        if ($request->input('info')) {
            $envio = Envio::where('transaccion_id', $request->input('info'))->get();
            return view('envio.show', compact('envio', $envio));
        }else{
            return view('envio.show', compact('envio', $envio));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function edit(Envio $envio, Request $request)
    {
        if ($request->input('envio')) {
            $codeTransaccion = Envio::where('transaccion_id', $request->input('envio'))->get()->transaccion_id;
            $codeDireccion = Envio::where('direccion_id', $request->input('envio'))->get()->direccion_id;
            $transaccion = Transaccion::where('transaccion_id', $codeTransaccion)->get();
            $direccion = Direccion::where('direccion_id', $codeDireccion)->get();
        }else{
            $transaccion = Transaccion::all();
            $direccion = Direccion::all();
        }
        return view('envio.edit', compact('transaccion','direccion','envio', $envio));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Envio $envio)
    {
        $data = $request->validate(
            [
                'codigoSeguimiento' => 'nullable',
                'estado' => 'nullable',
                // 'direccion_id' => 'nullable',
                // 'transaccion_id' => 'nullable'
            ]
        );
        $envio->update($data);
        $request->session()->flash('message', 'Envio Modificado!');
        return redirect()->route('envio.show', $envio);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Envio $envio, Request $request)
    {
        if (Auth::user()->rol_id !== 2) {
            $envio->delete();
            $request->session()->flash('message', 'Envio Eliminado!');
            return redirect()->route('envio.index', $envio);
        }else{
            $request->session()->flash('message', 'Acceso Denegado!');
            return redirect()->route('envio.index');
        }
    }
}
