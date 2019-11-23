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
        <th scope="col">#</th>
        <th scope="col">Amount</th>
        <th scope="col">Buy Order</th>
        <th scope="col">Created At</th>
        <th scope="col">Detalle</th>
        @auth
        @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 3)
        <th scope="col">Action</th>
        @endif
        @endauth
      </tr>
    </thead>
    <tbody>
      @foreach($transaccion as $transaccion)
      <tr>
        <th scope="row">{{$transaccion->transaccion_id}}</th>
        <td>{{$transaccion->amount}}</td>
        <td>{{$transaccion->buyOrder}}</td>
        <td>{{$transaccion->created_at->toFormattedDateString()}}</td>
        {{-- <td>{{ route('orden.show', ['orden' => $transaccion->transaccion_id]) }}</td> --}}
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection