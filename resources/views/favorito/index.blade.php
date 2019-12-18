@extends('layouts.app')
@section('content')
<div class="row justify-content-center justify-content-md-start">
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
		</div>
		@endforeach
	</div>
</div>
@endsection