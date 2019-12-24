@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  @auth
  @if(Auth::user()->rol_id == 1)
  <div class="btn-group" role="group" aria-label="Basic example">
    <a class="nav-link" href="{{ route('rol.create') }}">
      <button type="button" class="btn btn-warning">Añadir</button>
    </a>
  </div>
  @endif
  @endauth
  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Descripcion</th>
        @auth
        @if(Auth::user()->rol_id == 1)
        <th scope="col">Action</th>
        @endif
        @endauth
      </tr>
    </thead>
    <tbody>
      @foreach($rol as $rol)
      <tr>
        <td><a href="{{ route('rol.show', $rol) }}">{{$rol->name}}</a></td>
        <td>{{$rol->descripcion}}</td>
        @auth
        @if(Auth::user()->rol_id == 1)
        <td>
          <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('rol.edit', $rol) }}">
             <button type="button" class="btn btn-warning">Edit</button>
           </a>
           <form action="{{route('rol.destroy', $rol)}}" method="POST">
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