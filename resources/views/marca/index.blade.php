@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  @auth
  @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 3)
  <div class="btn-group" role="group">
    <a class="nav-link" href="{{ route('marca.create') }}">
      <button type="button" class="btn btn-warning">Añadir</button>
    </a>
  </div>
  @endif
  @endauth
  <div class="container">
    <div class="card-columns no-gutters rounded-0">
      @foreach($marca as $marca)
      <div class="card border-info" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title"><a href="{{ route('marca.show', $marca) }}">Marca {{$marca->name}}</a></h5><hr>
          <p class="card-text">{{$marca->descripcion}}</p><hr>
          <a href="{{ route('producto.index', ['marca' => $marca]) }}" class="card-link">Ir A Productos</a>
          @auth
          @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 3)
          <hr>
          <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('marca.edit', $marca) }}">
             <button type="button" class="btn btn-warning">Edit</button>
           </a>
           <form action="{{route('marca.destroy', $marca)}}" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="Delete"/>
          </form>
        </div>
        @endif
        @endauth
      </div>
    </div>
    @endforeach
  </div>
</div>
</div>
@endsection