<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Marca;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProductoController extends Controller
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
    public function index(Request $request)
    {
        $marca = $request->input('marca');
        $categoria = $request->input('categoria');
        $mode = $request->input('mode');
        if (Auth::check()) {
            if (Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2) {
                if ($marca) {
                    $producto = Producto::with('marca')->where('marca_id', $marca)->get();
                }elseif ($categoria) {
                    $producto = Producto::with('categoria')->where('categoria_id', $categoria)->get();
                }else{
                    $producto = Producto::all();
                }
            }else{
                $marca = Marca::where('usuario_id', Auth::id())->get();
                $producto = Producto::with('marca')->whereIn('marca_id', $marca)->get();
            }
            return view('producto.index', compact('producto', $producto));
        }else{
            if ($marca) {
                $producto = Producto::with('marca')->where('marca_id', $marca)->get();
            }elseif ($categoria) {
                $producto = Producto::with('categoria')->where('categoria_id', $categoria)->get();
            }else{
                $producto = Producto::all();
            }
            return view('producto.index', compact('producto', $producto));
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
            $marca = Marca::all();
        }elseif(Auth::user()->rol_id == 3){
            $marca = Marca::where('usuario_id', Auth::id())->get();
        }
        $categoria = Categoria::all();
        $producto = new Producto();
        return view('producto.create', compact('categoria', 'marca', 'producto'));
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
                'name' => 'required|min:5|unique:producto',
                'valor' => 'required|min:3',
                'stock' => 'required|min:1',
                'descripcion' => 'required',
                'categoria_id' => 'required',
                'marca_id' => 'required',
                'image' => 'nullable'
            ],[
                'name.required' => 'Nombre requerido',
                'valor.required' => 'Valor requerido',
                'valor.min' => 'Valor mayor o igual a $100',
                'stock.required' => 'Stock requerido',
                'stock.min' => 'Stock mínimo igual a 1',
                'descripcion.required' => 'Descripcion requerida',
                'categoria_id.required' => 'Categoria requerida',
                'marca_id.required' => 'Marca requerida'
            ]
        );
        $producto = Producto::create([
            'name' => $request['name'],
            'valor' => $request['valor'],
            'stock' => $request['stock'],
            'descripcion' => $request['descripcion'],
            'categoria_id' => $request['categoria_id'],
            'marca_id' => $request['marca_id'],
            'image' => $request['image']
        ]);
        $this->storeImage($producto);
        $request->session()->flash('message', 'Producto Almacenado!');
        return redirect()->route('producto.show', $producto);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto, Request $request)
    {
        if ($request->input('producto')) {
            $producto = Producto::where('name', $request->input('producto'))->get();
            return view('producto.show', compact('producto', $producto));
        }else{
            return view('producto.show', compact('producto', $producto));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        if (Auth::user()->rol_id == 1) {
            $marca = Marca::all();
        }elseif (Auth::user()->rol_id == 2) {
            request()->session()->flash('message', 'Acceso Denegado!');
            return redirect()->route('producto.index');
        }elseif(Auth::user()->rol_id == 3){
            if ($producto->marca['usuario_id'] == Auth::id()) {
                $marca = Marca::where('usuario_id', Auth::id())->get();
            }else{
               request()->session()->flash('message', 'Acceso Denegado!');
               return redirect()->route('producto.index');
           }
       }
       $categoria = Categoria::all();
       return view('producto.edit', compact('producto', 'categoria', 'marca', $producto));
   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $data = $request->validate(
            [
                'name' => 'nullable',
                'valor' => 'nullable',
                'stock' => 'nullable',
                'descripcion' => 'nullable',
                'categoria_id' => 'nullable',
                'marca_id' => 'nullable',
                'image' => 'nullable'
            ]
        );
        $producto->update($data);
        $this->storeImage($producto);
        $request->session()->flash('message', 'Producto Modificado!');
        return redirect()->route('producto.show', $producto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Producto $producto)
    {
        if (Auth::user()->rol_id !== 2) {
            $producto->delete();
            $request->session()->flash('message', 'Producto Eliminado!');
            return redirect()->route('producto.index', $producto);
        }else{
            $request->session()->flash('message', 'Acceso Denegado!');
            return redirect()->route('producto.index');
        }

    }

    private function storeImage($producto)
    {
        if (request()->has('image')) {
            $producto->update([
                'image' => request()->image->store('uploads', 'public'),
            ]);
            $image = Image::make(public_path('storage/' . $producto->image))->fit(300, 300, null, 'top-left');
            $image->save();
        }
    }
}
