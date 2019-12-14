@extends('layouts.app')
@section('content')
<div class="row justify-content-center justify-content-md-start">
  @auth
  @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 3)
  <div class="btn-group" role="group">
    <a class="nav-link" href="{{ route('producto.create') }}">
      <button type="button" class="btn btn-warning">Añadir</button>
    </a>
  </div>
  @endif
  @endauth
  <div class="container">
    <div class="row">
      <div class="col-6 col-md-2">
        @include('partials.marca')
        @include('partials.categoria')
      </div>
      <div class="col-12 col-md-10">
        <div class="container py-4 bg-light">
          <div class="row">
            <div class="col">
              <div class="card-columns no-gutters rounded-0">
                @foreach($producto as $producto)
                <div class="card rounded-0 border-0 bg-light" style="width: 18rem;">
                  <a href="{{ route('producto.show', $producto) }}">
                    <img class="card-img-top img-fluid"  src="{{ asset('storage/' . $producto->image) }}" alt="Card image cap">
                  </a>
                  <div class="card-body">
                    <h5 class="card-title">{{$producto->name}}</h5>
                    <p class="card-text">{{ $producto->descripcion }}</p>
                    <p class="card-text"><small class="text-muted">${{ $producto->valor }}</small></p>
                  </div>
                  @auth
                  @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 3)
                  <div class="card-footer">
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <a href="{{ route('producto.edit', ['producto' => $producto]) }}">
                       <button type="button" class="btn btn-warning">Edit</button>
                     </a>
                   </div>
                 </div>
                 @endif
                 @endauth
               </div>
               @endforeach
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
</div>
</div>
@endsection