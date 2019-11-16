<?php

namespace App\Http\Controllers;

use App\Rol;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
            $usuario = User::all();
        }
        return view('usuario.index', compact('usuario', $usuario));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->rol_id == 1) {
            $rol = Rol::all();
        }
        $usuario = new User();
        return view('usuario.create', compact('rol', 'usuario'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'rol_id' => $request['rol_id'],
            'confirmed' => $request['confirmed']
        ]);
        $request->session()->flash('message', 'Usuario Almacenado!');
        return redirect()->route('usuario.show', $usuario);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $usuario)
    {
        return view('usuario.show', compact('usuario', $usuario));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        if (Auth::user()->rol_id == 1) {
            $rol = Rol::all();
        }else{
            request()->session()->flash('message', 'Acceso Denegado!');
            return redirect()->route('home');
        }
        return view('usuario.edit', compact('rol', 'usuario', $usuario));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {
        $usuario->update([
            'name' => $request['name'],
            'email' => $request['email'],
            // 'password' => Hash::make($request['password']),
            'rol_id' => $request['rol_id'],
            'confirmed' => $request['confirmed']
        ]);
        $request->session()->flash('message', 'Usuario Actualizado!');
        return redirect()->route('usuario.show', $usuario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        if (Auth::user()->rol_id == 1) {
            $usuario->delete();
            $request->session()->flash('message', 'Usuario Eliminado!');
            return redirect()->route('usuario.index', $usuario);
        }
    }
}
