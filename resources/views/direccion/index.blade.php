@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  @auth
  <div class="btn-group" role="group" aria-label="Basic example">
    <a class="nav-link" href="{{ route('direccion.create') }}">
      <button type="button" class="btn btn-warning">Añadir</button>
    </a>
  </div>
  @endauth
  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Rut</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Codigo Postal</th>
        <th scope="col">Direccion</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Comuna</th>
        <th scope="col">Usuario</th>
        <th scope="col">Created At</th>
        @auth
        <th scope="col">Action</th>
        @endauth
      </tr>
    </thead>
    <tbody>
      @foreach($direccion as $direccion)
      <tr>
        <th scope="row">{{$direccion->direccion_id}}</th>
        <td><a href="{{ route('direccion.show', $direccion) }}">{{$direccion->rut}}</a></td>
        <td>{{$direccion->name}}</td>
        <td>{{$direccion->lastname}}</td>
        <td>{{$direccion->codigoPostal}}</td>
        <td>{{$direccion->direccion1}}</td>
        <td>{{$direccion->descripcion}}</td>
        <td>{{$direccion->comuna ? $direccion->comuna->name : 'Comuna No Asignada' }}</td>
        <td>{{$direccion->usuario ? $direccion->usuario->name : 'Usuario No Asignado' }}</td>
        <td>{{$direccion->created_at->toFormattedDateString()}}</td>
        @auth
        <td>
          <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('direccion.edit', ['direccion' => $direccion]) }}">
             <button type="button" class="btn btn-warning">Edit</button>
           </a>
           <form action="{{ route('direccion.destroy', ['direccion' => $direccion]) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="Delete"/>
          </form>
        </div>
      </td>
      @endauth
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection