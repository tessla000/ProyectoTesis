<?php

namespace App\Http\Controllers;

use App\Info;
use App\User;
use Freshwork\ChileanBundle\Rut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
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
        if (Auth::user()->rol_id == 1) {
            $info = Info::all();
        }else{
            $info = Info::where('usuario_id', Auth::id())->get();
        }
        return view('info.index', compact('info', $info));
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
        }else{
            $usuario = Auth::id();
        }
        $info = new Info();
        return view('info.create', compact('usuario', 'info'));
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
                'rut' => 'required|min:9|cl_rut',
                'name' => 'required',
                'lastname' => 'required',
                'usuario_id' => 'nullable'
            ],[
                'rut.required' => 'Rut requerido',
                'rut.cl_rut' => 'Rut incorrecto',
                'name.required' => 'Nombre requerido',
                'lastname.required' => 'Apellido requerido',
                'usuario_id.nullable' => 'Usuario'
            ]
        );
        $usuario = Auth::id();
        $info = Info::create([
            'rut' => $request['rut'],
            'name' => $request['name'],
            'lastname' => $request['lastname'],
            'usuario_id' => $usuario
        ]);
        $request->session()->flash('message', 'Datos Almacenados!');
        return redirect()->route('info.show', $info);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function show(Info $info)
    {
        if ($info->usuario_id !== Auth::id()) {
            request()->session()->flash('message', 'Acceso Denegado!');
            return redirect()->route('info.index');
        }
        return view('info.show', compact('info', $info));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function edit(Info $info)
    {
        if (Auth::user()->rol_id == 1) {
            $usuario = User::all();
        }elseif (Auth::user()->rol_id == 2 || Auth::user()->rol_id == 3) {
            if ($info->usuario_id == Auth::id()) {
                $usuario = Auth::id();
            }else{
                request()->session()->flash('message', 'Acceso Denegado!');
                return redirect()->route('info.index');
            }
        }
        return view('info.edit', compact('usuario', 'info', $info));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Info $info)
    {
        $data = $request->validate(
            [
                'rut' => 'required|min:9|cl_rut',
                'name' => 'required',
                'lastname' => 'required',
                'usuario_id' => 'nullable'
            ],[
                'rut.required' => 'Rut requerido',
                'rut.cl_rut' => 'Rut incorrecto',
                'name.required' => 'Nombre requerido',
                'lastname.required' => 'Apellido requerido',
                'usuario_id.nullable' => 'Usuario'
            ]
        );
        $info->update($data);
        $request->session()->flash('message', 'Datos Modificados!');
        return redirect()->route('info.show', $info);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Info $info)
    {
        if (Auth::user()->rol_id == 2 || Auth::user()->rol_id == 3){
            if ($info->usuario_id == Auth::id()) {
                $info->delete();
                $request->session()->flash('message', 'Datos Eliminados!');
                return redirect()->route('info.index', $info);
            }else{
                $request->session()->flash('message', 'Acceso Denegado!');
                return redirect()->route('info.index');
            }
        }elseif (Auth::user()->rol_id == 1) {
            $info->delete();
            $request->session()->flash('message', 'Datos Eliminados!');
            return redirect()->route('info.index', $info);
        }
    }
}
