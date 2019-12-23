<?php

namespace App\Http\Controllers;

use App\Suscripcion;
use App\SuscripcionUsuario;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuscripcionUsuarioController extends Controller
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
        $suscripcion = Suscripcion::where('name', $request['suscripcion'])->get();
        $suscripcion2 = $suscripcion->map->only(['suscripcion_id']);
        if ($request['suscripcion']) {
            $suscripcionUsuario = SuscripcionUsuario::where('suscripcion_id', $suscripcion2)->get();
        }else{
            $suscripcionUsuario = SuscripcionUsuario::all();
        }
        return view('suscripcionUsuario.index', compact('suscripcionUsuario', $suscripcionUsuario));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Auth::user()->rol_id == 1) {
            $usuario = User::where('rol_id', 2)->get();
            if ($request->input('nuevaSuscripcion')) {
                $suscripcion = Suscripcion::where('name', $request->input('nuevaSuscripcion'))->get();
            }else{
                $suscripcion = Suscripcion::all();
            }
        }else{
            request()->session()->flash('message', 'Acceso Denegado!');
            return redirect()->route('home');
        }
        $suscripcionUsuario = new SuscripcionUsuario();
        return view('suscripcionUsuario.create', compact('usuario', 'suscripcion', 'suscripcionUsuario'));
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
                'suscripcion_id' => 'required',
                'usuario_id' => 'required',
                'fecha_inicio' => 'required|date',
                'fecha_termino' => 'required|date'
            ],[
                'suscripcion_id.required' => 'Sucripcion requerida',
                'usuario_id.required' => 'Usuario requerido',
                'fecha_inicio.required' => 'Fecha de inicio requerida',
                'fecha_termino.required' => 'Fecha de termino requerida'
            ]
        );

        $suscripcionUsuario = SuscripcionUsuario::create([
            'suscripcion_id' => $request['suscripcion_id'],
            'usuario_id' => $request['usuario_id'],
            'fecha_inicio' => $request['fecha_inicio'],
            'fecha_termino' => $request['fecha_termino']
        ]);
        $request->session()->flash('message', 'Suscripcion Almacenada!');
        return redirect()->route('suscripcionUsuario.index');

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
    public function edit(Request $request, SuscripcionUsuario $suscripcionUsuario)
    {
        if (Auth::user()->rol_id == 1) {
            $usuario = User::where('usuario_id', $suscripcionUsuario->usuario->usuario_id)->get();
            $suscripcion = Suscripcion::all();
            return view('suscripcionUsuario.edit', compact('suscripcionUsuario', 'suscripcion', 'usuario', $suscripcionUsuario, $suscripcion, $usuario));
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
    public function update(Request $request, SuscripcionUsuario $suscripcionUsuario)
    {
        $data = $request->validate(
            [
                'suscripcion_id' => 'required',
                'fecha_inicio' => 'required|date',
                'fecha_termino' => 'required|date'
            ],[
                'suscripcion_id.required' => 'Sucripcion requerida',
                'fecha_inicio.required' => 'Fecha de inicio requerida',
                'fecha_termino.required' => 'Fecha de termino requerida'
            ]
        );
        $suscripcionUsuario->update($data);
        $request->session()->flash('message', 'Suscripcion Modificada!');
        return redirect()->route('suscripcionUsuario.index', $suscripcionUsuario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, SuscripcionUsuario $suscripcionUsuario)
    {
        if (Auth::user()->rol_id == 1){
            $suscripcionUsuario->delete();
            $request->session()->flash('message', 'Suscripcion Eliminada!');
            return redirect()->route('suscripcionUsuario.index', $suscripcionUsuario);
        }else{
            request()->session()->flash('message', 'Acceso Denegado!');
            return redirect()->route('home');
        }
    }
}
