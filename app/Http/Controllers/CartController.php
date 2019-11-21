<?php

namespace App\Http\Controllers;

use Cart;
use App\Producto;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request){
        $producto = Producto::find($request->producto);
        $id = $producto->producto_id;
        $name = $producto->name;
        $price = $producto->valor;
        $quantity = (int)$request->qty+1;
        $stock = $producto->stock;
        foreach (Cart::getContent() as $item) {
            $cart = $item->quantity;
        }
        if (Cart::has($id)) {
            if ($stock > $cart && $stock > 0) {
                Cart::add($id, $name, $price, $quantity, array());
                $request->session()->flash('message', "$producto->name ha sido agregado al carro!");
            }else{
                $request->session()->flash('message', "No se puede agregar más de este producto!");
            }
        }elseif($stock > 0){
            Cart::add($id, $name, $price, $quantity, array());
            $request->session()->flash('message', "$producto->name ha sido agregado al carro!");
        }else{
            $request->session()->flash('message', "No se puede agregar más de este producto!");
        }
        return back();
    }

    public function cart(){
        $params = [
            'title' => 'Shopping Cart Checkout',
        ];
        return view('cart.cart')->with($params);
    }

    public function clear(){
        Cart::clear();
        return back()->with('success',"El carro de compras ha sido vaciado");;
    }
}
