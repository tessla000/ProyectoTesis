@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  @auth
  @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 3)
  <div class="btn-group" role="group" aria-label="Basic example">
    <a class="nav-link" href="{{ route('transaccion.create') }}">
      <button type="button" class="btn btn-warning">Añadir</button>
    </a>
  </div>
  @endif
  @endauth
  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Producto</th>
        <th scope="col">Quantity</th>
        <th scope="col">Price</th>
        <th scope="col">Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orden as $orden)
      <tr>
        <th scope="row"><a href="{{ route('producto.show', ['orden' => $orden->producto->name]) }}">{{ $orden->producto ? $orden->producto->name : 'Sin Nombre' }}</a></th>
        <td>{{$orden->quantity}}</td>
        <td>{{$orden->price}}</td>
        <td>{{$orden->total}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="btn-group" role="group" aria-label="Basic example">
    <a href="{{ route('transaccion.index') }}">
      <button type="button" class="btn btn-warning">Regresar Atrás</button>
    </a>
  </div>

</div>
@endsection