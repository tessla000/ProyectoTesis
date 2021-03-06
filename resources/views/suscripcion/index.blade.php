@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  @auth
  @if(Auth::user()->rol_id == 1)
  <div class="btn-group" role="group" aria-label="Basic example">
    <a class="nav-link" href="{{ route('suscripcion.create') }}">
      <button type="button" class="btn btn-warning">Añadir</button>
    </a>
  </div>
  @endif
  @endauth
  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Cantidad De Productos</th>
        <th scope="col">Clientes</th>
        <th scope="col">Nuevo Cliente</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($suscripcion as $suscripcion)
      <tr>
        <td>{{$suscripcion->name}}</td>
        <td>{{$suscripcion->cantidad_productos}}</td>
        <td><a href="{{ route('suscripcionUsuario.index', ['suscripcion' => $suscripcion]) }}">Clientes</a></td>
        <td><a href="{{ route('suscripcionUsuario.create', ['nuevaSuscripcion' => $suscripcion]) }}">Nuevo Cliente</a></td>
        <td>
          <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('suscripcion.edit', $suscripcion) }}">
             <button type="button" class="btn btn-warning">Edit</button>
           </a>
           <form action="{{route('suscripcion.destroy', $suscripcion)}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="Delete"/>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection