@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  @auth
  @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 3)
  <div class="btn-group" role="group" aria-label="Basic example">
    <a class="nav-link" href="{{ route('marca.create') }}">
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
        <th scope="col">Productos</th>
        @auth
        @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 3)
        <th scope="col">Action</th>
        @endif
        @endauth
      </tr>
    </thead>
    <tbody>
      @foreach($marca as $marca)
      <tr>
        <td scope="row"><a href="{{ route('marca.show', $marca) }}">{{$marca->name}}</a></td>
        <td>{{$marca->descripcion}}</td>
        <td><a href="{{ route('producto.index', ['marca' => $marca]) }}">Ir A Productos</a></td>
        @auth
        @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 3)
        <td>
          <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('marca.edit', $marca) }}">
             <button type="button" class="btn btn-warning">Edit</button>
           </a>
           <form action="{{route('marca.destroy', $marca)}}" method="POST">
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