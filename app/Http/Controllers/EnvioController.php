<?php

namespace App\Http\Controllers;

use App\Direccion;
use App\Envio;
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
    public function index()
    {
        $envio = Envio::all();
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
        $transaccion = Transaccion::where('usuario_id', Auth::id())->get();
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
                'direccion_id' => 'nullable',
                'transaccion_id' => 'nullable'
            ],[
                'codigoSeguimiento.nullable' => 'Codigo Seguimiento requerido',
                'estado.nullable' => 'Estado',
                'direccion_id.nullable' => 'Direccion',
                'transaccion_id.nullable' => 'Transaccion'
            ]
        );
        $envio = Envio::create([
            // 'codigoSeguimiento' => $request['codigoSeguimiento'],
            // 'estado' => $request['estado'],
            'transaccion_id' => $request['transaccion_id'],
            'direccion_id' => $request['direccion_id']
        ]);
        $request->session()->flash('message', 'Envio En Proceso!');
        return redirect()->route('envio.show', $envio);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function show(Envio $envio)
    {
        return view('envio.show', compact('envio', $envio));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function edit(Envio $envio)
    {
        return view('envio.edit', compact('envio', $envio));
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
                'direccion_id' => 'nullable',
                'transaccion_id' => 'nullable'
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
    public function destroy(Envio $envio)
    {
        //
    }
}
