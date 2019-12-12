<?php

namespace App\Http\Controllers;

use App\Comuna;
use App\Direccion;
use App\User;
use Freshwork\ChileanBundle\Rut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DireccionController extends Controller
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
            $direccion = Direccion::all()->sortBy('updated_at');
        }else{
            $direccion = Direccion::where('usuario_id', Auth::id())->get()->sortBy('updated_at');
        }
        return view('direccion.index', compact('direccion', $direccion));
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
        $comuna = Comuna::all();
        $direccion = new Direccion();
        return view('direccion.create', compact('comuna', 'usuario', 'direccion'));
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
                'codigoPostal' => 'required',
                'direccion1' => 'required',
                'descripcion' => 'nullable',
                'comuna_id' => 'nullable',
                'usuario_id' => 'nullable'
            ],[
                'rut.required' => 'Rut requerido',
                'rut.cl_rut' => 'Rut incorrecto',
                'name.required' => 'Nombre requerido',
                'lastname.required' => 'Apellido requerido',
                'codigoPostal.required' => 'Codigo Postal requerido',
                'direccion1.required' => 'Direccion requerida',
                'descripcion.nullable' => 'Descripcion',
                'comuna_id.nullable' => 'Comuna',
                'usuario_id.nullable' => 'Usuario'
            ]
        );
        $direccion = Direccion::create([
            'rut' => $request['rut'],
            'name' => $request['name'],
            'lastname' => $request['lastname'],
            'codigoPostal' => $request['codigoPostal'],
            'direccion1' => $request['direccion1'],
            'descripcion' => $request['descripcion'],
            'comuna_id' => $request['comuna_id'],
            'usuario_id' => Auth::id()
        ]);
        $request->session()->flash('message', 'Direccion Almacenado!');
        return redirect()->route('direccion.show', $direccion);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function show(Direccion $direccion)
    {
        if ($direccion->usuario_id !== Auth::id()) {
            request()->session()->flash('message', 'Acceso Denegado!');
            return redirect()->route('direccion.index');
        }
        return view('direccion.show', compact('direccion', $direccion));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function edit(Direccion $direccion)
    {
        if (Auth::user()->rol_id == 1) {
            $usuario = User::all();
        }elseif (Auth::user()->rol_id == 2 || Auth::user()->rol_id == 3) {
            if ($direccion->usuario_id == Auth::id()) {
                $usuario = Auth::id();
            }else{
                request()->session()->flash('message', 'Acceso Denegado!');
                return redirect()->route('direccion.index');
            }
        }
        $comuna = Comuna::all();
        return view('direccion.edit', compact('comuna', 'usuario', 'direccion', $direccion));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Direccion $direccion)
    {
        $data = $request->validate(
            [
                'rut' => 'required|min:9|cl_rut',
                'name' => 'required',
                'lastname' => 'required',
                'codigoPostal' => 'required',
                'direccion1' => 'required',
                'descripcion' => 'nullable',
                'comuna_id' => 'nullable',
                'usuario_id' => 'nullable'
            ],[
                'rut.required' => 'Rut requerido',
                'rut.cl_rut' => 'Rut incorrecto',
                'name.required' => 'Nombre requerido',
                'lastname.required' => 'Apellido requerido',
                'codigoPostal.required' => 'Codigo Postal requerido',
                'direccion1.required' => 'Direccion requerida',
                'descripcion.nullable' => 'Descripcion',
                'comuna_id.nullable' => 'Comuna',
                'usuario_id.nullable' => 'Usuario'
            ]
        );
        $direccion->update($data);
        $request->session()->flash('message', 'Direccion Modificada!');
        return redirect()->route('direccion.show', $direccion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Direccion $direccion)
    {
        if (Auth::user()->rol_id == 2 || Auth::user()->rol_id == 3){
            if ($direccion->usuario_id == Auth::id()) {
                $direccion->delete();
                $request->session()->flash('message', 'Direccion Eliminada!');
                return redirect()->route('direccion.index', $direccion);
            }else{
                $request->session()->flash('message', 'Acceso Denegado!');
                return redirect()->route('direccion.index');
            }
        }elseif (Auth::user()->rol_id == 1) {
            $direccion->delete();
            $request->session()->flash('message', 'Direccion Eliminada!');
            return redirect()->route('direccion.index', $direccion);
        }
    }
}
