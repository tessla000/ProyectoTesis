@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  @auth
  <div class="btn-group" role="group" aria-label="Basic example">
    <a class="nav-link" href="{{ route('info.create') }}">
      <button type="button" class="btn btn-warning">Añadir</button>
    </a>
  </div>
  @endauth
  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Rut</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Usuario</th>
        <th scope="col">Created At</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($info as $info)
      <tr>
          <td><a href="{{ route('info.show', $info) }}">{{$info->rut}}</a></td>
          <td>{{$info->name}}</td>
          <td>{{$info->lastname}}</td>
          <td>{{$info->usuario ? $info->usuario->name : 'Usuario No Asignado' }}</td>
          <td>{{$info->created_at->toFormattedDateString()}}</td>
          @auth
          <td>
            <div class="btn-group" role="group" aria-label="Basic example">
              <a href="{{ route('info.edit', ['info' => $info]) }}">
               <button type="button" class="btn btn-warning">Edit</button>
             </a>
             @if(Auth::user()->rol_id == 1)
             <form action="{{ route('info.destroy', ['info' => $info]) }}" method="POST">
              @csrf
              @method('DELETE')
              <input type="submit" class="btn btn-danger" value="Delete"/>
            </form>
            @endif
          </div>
        </td>
        @endauth
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection