@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  @auth
  @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 3)
  <div class="btn-group" role="group" aria-label="Basic example">
    <a class="nav-link" href="{{ route('producto.create') }}">
      <button type="button" class="btn btn-warning">Añadir</button>
    </a>
  </div>
  @endif
  @endauth
  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Valor</th>
        <th scope="col">Stock</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Categoria</th>
        <th scope="col">Marca</th>
        <th scope="col">Created At</th>
        @auth
        @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 3)
        <th scope="col">Action</th>
        @endif
        @endauth
      </tr>
    </thead>
    <tbody>
      @foreach($producto as $producto)
      <tr>
        <th scope="row">{{$producto->producto_id}}</th>
        <td><a href="{{ route('producto.show', $producto) }}">{{$producto->name}}</a></td>
        <td>{{$producto->valor}}</td>
        <td>{{$producto->stock}}</td>
        <td>{{$producto->descripcion}}</td>
        <td>{{$producto->categoria ? $producto->categoria->name : 'Categoría No Asignada' }}</td>
        <td>{{$producto->marca ? $producto->marca->name : 'Categoría No Asignada' }}</td>
        <td>{{$producto->created_at->toFormattedDateString()}}</td>
        @auth
        @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 3)
        <td>
          <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('producto.edit', ['producto' => $producto]) }}">
             <button type="button" class="btn btn-warning">Edit</button>
           </a>
           <form action="{{ route('producto.destroy', ['producto' => $producto]) }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="Delete"/>
          </form>
        </div>
      </td>
      @endif
      @endauth
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection