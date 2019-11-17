@extends('layouts.app')
@section('content')
<div class="row top-15">
    <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Carro de Compra</span>
            <span class="badge badge-secondary badge-pill">{{Cart::getContent()->count()}}</span>
        </h4>
        <ul class="list-group mb-3">
            @foreach(Cart::getContent() as $producto)
            <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                    <a href="{{ route('producto.show', ['producto' => $producto->name]) }}"><h6 class="my-0">{{$producto->name}}</h6></a>
                    <small class="text-muted">{{$producto->quantity . ' x $' . $producto->price}}</small>
                </div>
                <span class="text-muted">{{'$' . $producto->price * $producto->quantity}}</span>
            </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between">
                <span>Total (CLP)</span>
                <strong>{{Cart::getSubTotal()}}</strong>
            </li>
        </ul>
        <form action="{{route('cart.clear')}}" method="POST" class="card p-2">
            @csrf
            <div class="input-group">
                <div class="input-group">
                    <button type="submit" class="btn btn-danger">Vaciar</button>
                </div>
            </div>
        </form>
        <div>
            @if(!Auth::check())
            <a href="{{ route('login') }}">Pagar</a>
            @else
            <a href="{{ route('checkout') }}">Pagar</a>
            @endif
        </div>
    </div>
</div>
@endsection