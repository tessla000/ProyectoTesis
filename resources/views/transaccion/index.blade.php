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
        <th scope="col">Amount</th>
        <th scope="col">Buy Order</th>
        <th scope="col">Detalle</th>
        @auth
        @if(Auth::user()->rol_id !== 3)
        <th scope="col">Crear Envio</th>
        <th scope="col">Ver Envio</th>
        @endif
        @endauth
      </tr>
    </thead>
    <tbody>
      @foreach($transaccion as $transaccion)
      <tr>
        <td>{{$transaccion->amount}}</td>
        <td>{{$transaccion->buyOrder}}</td>
        <td><a href="{{ route('orden.index', ['orden' => $transaccion->transaccion_id]) }}">Ir A Detalle</a></td>
        <td><a href="{{ route('envio.create', ['envio' => $transaccion->transaccion_id]) }}">Enviar Producto</a></td>
        <td><a href="{{ route('envio.index', ['info' => $transaccion->transaccion_id]) }}">Ver Envio</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection