@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
  <table class="table table-hover">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Codigo Seguimiento</th>
        <th scope="col">Rut</th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Codigo Postal</th>
        <th scope="col">Direccion</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Comuna</th>
        <th scope="col">Transaccion</th>
        <th scope="col">Created At</th>
        @auth
        @if(Auth::user()->rol_id !== 2)
        <th scope="col">Action</th>
        @endif
        @endauth
      </tr>
    </thead>
    <tbody>
      @foreach($envio as $envio)
      <tr>
        {{-- <th scope="row"><a href="{{ route('envio.show', $envio) }}">{{$envio->envio_id}}</a></th> --}}
        <td>{{$envio->codigoSeguimiento}}</td>
        <td>{{$envio->direccion_id ? $envio->direccion->rut : ''}}</td>
        <td>{{$envio->direccion_id ? $envio->direccion->name : ''}}</td>
        <td>{{$envio->direccion_id ? $envio->direccion->lastname : ''}}</td>
        <td>{{$envio->direccion_id ? $envio->direccion->codigoPostal : ''}}</td>
        <td>{{$envio->direccion_id ? $envio->direccion->direccion1 : ''}}</td>
        <td>{{$envio->direccion_id ? $envio->direccion->descripcion : ''}}</td>
        <td>{{$envio->direccion_id ? $envio->direccion->comuna_id : ''}}</td>
        <td>{{$envio->transaccion_id ? $envio->transaccion->buyOrder : '' }}</td>
        <td>{{$envio->created_at->toFormattedDateString()}}</td>
        @auth
        @if(Auth::user()->rol_id == 1)
        <td>
          <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('envio.edit', ['envio' => $envio]) }}">
             <button type="button" class="btn btn-warning">Edit</button>
           </a>
           <form action="{{ route('envio.destroy', ['envio' => $envio]) }}" method="POST">
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
@auth
@if(request('info'))
<div class="btn-group" role="group" aria-label="Basic example">
  <a href="{{ URL::previous() }}">
    <button type="button" class="btn btn-warning">Regresar Atrás</button>
  </a>
</div>
@endif
@endauth
</div>
@endsection