@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  @auth
  @if(Auth::user()->rol_id == 1)
  <div class="btn-group" role="group" aria-label="Basic example">
    <a class="nav-link" href="{{ route('suscripcionUsuario.create') }}">
      <button type="button" class="btn btn-warning">Añadir</button>
    </a>
  </div>
  @endif
  @endauth
  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Suscripcion</th>
        <th scope="col">Usuario</th>
        <th scope="col">Fecha Inicio</th>
        <th scope="col">Fecha Termino</th>
        {{-- <th scope="col">Created At</th> --}}
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($suscripcionUsuario as $suscripcionUsuario)
      <tr>
        <th scope="row">{{$suscripcionUsuario->suscripcion_Usuario_id}}</th>
        <td>{{$suscripcionUsuario->suscripcion_id ? $suscripcionUsuario->suscripcion->name : '' }}</td>
        <td>{{$suscripcionUsuario->usuario_id ? $suscripcionUsuario->usuario->name : ''}}</td>
        <td>{{$suscripcionUsuario->fecha_inicio}}</td>
        <td>{{$suscripcionUsuario->fecha_termino}}</td>
        {{-- <td>{{$suscripcionUsuario->created_at->toFormattedDateString()}}</td> --}}
        <td>
          <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('usuario.edit', $suscripcionUsuario->usuario->name) }}">
             <button type="button" class="btn btn-warning">Editar Usuario</button>
           </a>
         </div>
         <div class="btn-group" role="group" aria-label="Basic example">
          <a href="{{ route('suscripcionUsuario.edit', $suscripcionUsuario) }}">
           <button type="button" class="btn btn-warning">Edit</button>
         </a>
       </div>
       <form action="{{route('suscripcionUsuario.destroy', $suscripcionUsuario)}}" method="POST">
         <input type="hidden" name="_method" value="DELETE">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <input type="submit" class="btn btn-danger" value="Delete"/>
       </form>
     </td>
   </tr>
   @endforeach
 </tbody>
</table>
<div class="btn-group" role="group" aria-label="Basic example">
  <a href="{{ route('suscripcion.index') }}">
    <button type="button" class="btn btn-warning">Regresar Atrás</button>
  </a>
</div>
</div>
@endsection