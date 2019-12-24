@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  @auth
  @if(Auth::user()->rol_id == 1)
  <div class="btn-group" role="group" aria-label="Basic example">
    <a class="nav-link" href="{{ route('usuario.create') }}">
      <button type="button" class="btn btn-warning">Añadir</button>
    </a>
  </div>
  @endif
  @endauth
  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Rol</th>
        @auth
        @if(Auth::user()->rol_id == 1)
        <th scope="col">Action</th>
        @endif
        @endauth
      </tr>
    </thead>
    <tbody>
      @foreach($usuario as $usuario)
      <tr>
        <td><a href="{{ route('usuario.show', $usuario) }}">{{$usuario->name}}</a></td>
        <td>{{$usuario->email}}</td>
        <td>{{$usuario->rol ? $usuario->rol->name : 'Sin rol asignado'}}</td>
        @auth
        @if(Auth::user()->rol_id == 1)
        <td>
          <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('usuario.edit', $usuario) }}">
             <button type="button" class="btn btn-warning">Edit</button>
           </a>
           <form action="{{route('usuario.destroy', $usuario)}}" method="POST">
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