@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  @auth
  @if(Auth::user()->rol_id == 1)
  <div class="btn-group" role="group" aria-label="Basic example">
    <a class="nav-link" href="{{ route('categoria.create') }}">
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
        <th scope="col">Descripcion</th>
        <th scope="col">Productos</th>
        <th scope="col">Created At</th>
        @auth
        @if(Auth::user()->rol_id == 1)
        <th scope="col">Action</th>
        @endif
        @endauth
      </tr>
    </thead>
    <tbody>
      @foreach($categoria as $categoria)
      <tr>
        <th scope="row">{{$categoria->categoria_id}}</th>
        <td><a href="{{ route('categoria.show', $categoria) }}">{{$categoria->name}}</a></td>
        <td>{{$categoria->descripcion}}</td>
        <td><a href="{{ route('producto.index', ['categoria' => $categoria->categoria_id]) }}">Productos</td>
          <td>{{$categoria->created_at->toFormattedDateString()}}</td>
          @auth
          @if(Auth::user()->rol_id == 1)
          <td>
            <div class="btn-group" role="group" aria-label="Basic example">
              <a href="{{ route('categoria.edit', $categoria) }}">
               <button type="button" class="btn btn-warning">Edit</button>
             </a>
             <form action="{{route('categoria.destroy', $categoria)}}" method="POST">
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