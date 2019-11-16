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
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Rol</th>
        <th scope="col">Created At</th>
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
        <th scope="row">{{$usuario->usuario_id}}</th>
        <td><a href="{{ route('usuario.show', $usuario) }}">{{$usuario->name}}</a></td>
        <td>{{$usuario->email}}</td>
        <td>{{$usuario->rol ? $usuario->rol->name : 'Sin rol asignado'}}</td>
        <td>{{$usuario->created_at->toFormattedDateString()}}</td>
        @auth
        @if(Auth::user()->rol_id == 1)
        <td>
          <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('usuario.edit', $usuario) }}">
             <button type="button" class="btn btn-warning">Edit</button>
           </a>
           <form action="{{route('usuario.destroy', $usuario)}}" method="POST">
             <input type="hidden" name="_method" value="DELETE">
             <input type="hidden" name="_token" value="{{ csrf_token() }}">
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