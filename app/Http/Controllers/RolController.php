<?php

namespace App\Http\Controllers;

use App\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
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
        $rol = Rol::all();
        return view('rol.index', compact('rol', $rol));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rol = new Rol();
        return view('rol.create', compact('rol'));
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
                'rol_id' => 'required|min:1|unique:rol',
                'name' => 'required|unique:rol',
                'descripcion' => 'nullable'
            ],[
                'rol_id.required' => 'Id requerido',
                'name.required' => 'Nombre requerido'
            ]
        );
        $rol = Rol::create([
            'rol_id' => $request['rol_id'],
            'name' => $request['name']
        ]);
        $request->session()->flash('message', 'Datos Almacenados!');
        return redirect()->route('rol.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Rol $rol)
    {
        return view('rol.show', compact('rol', $rol));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Rol $rol)
    {
        return view('rol.edit', compact('rol', $rol));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rol $rol)
    {
        $data = $request->validate(
            [
                'name' => 'required',
                'descripcion' => 'nullable'
            ],[
                'name.required' => 'Nombre requerido'
            ]
        );
        $rol->update($data);
        $request->session()->flash('message', 'Datos Modificados!');
        return redirect()->route('rol.show', $rol);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Rol $rol)
    {
        $rol->delete();
        $request->session()->flash('message', 'Datos Eliminados!');
        return redirect()->route('rol.index', $rol);
    }
}
