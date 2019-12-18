@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="jumbotron text-center">
		<h1>Mostrando Producto {{ $producto->name }}</h1>
		<p>
			<strong>Nombre:</strong> {{ $producto->name }}<br>
			<strong>Valor:</strong> {{ $producto->valor }}<br>
			<strong>Stock:</strong> {{ $producto->stock }}<br>
			<strong>Descripcion:</strong> {{ $producto->descripcion }}<br>
			<strong>Categoria:</strong> {{ $producto->categoria ? $producto->categoria->name : 'Categoría No Asignada' }}<br>
			<strong>Marca:</strong> {{ $producto->marca ? $producto->marca->name : 'Categoría No Asignada' }}<br>
			<strong>Favoritos: </strong> {{ $producto->favoritesCount }}<br>
			<strong>Imagen:</strong>
			@if($producto->image)
			<div class="row">
				<div class="col-12">
					<img src="{{ asset('storage/' . $producto->image) }}" alt="" class="img-thumbnail">
				</div>
			</div><br>
			@endif
			<strong>
				<form action="{{ route('cart.add', ['producto' => $producto->producto_id]) }}" method="POST">
					@csrf
					<button class="btn btn-success" type="submit">Añadir Al Carro</button>
				</form><br>
			</strong>
			<strong>
				@auth
				@if($producto->isFavorited())
				<form action="{{ route('favorito.remove', ['favorito' => $producto->producto_id]) }}" method="POST">
					@csrf
					<button type="submit" class="btn btn-info">Quitar De Favoritos</button>
				</form>
				@else
				<form action="{{ route('favorito.add', ['favorito' => $producto->producto_id]) }}" method="POST">
					@csrf
					<button type="submit" class="btn btn-info">Añadir A Favoritos</button>
				</form>
				@endif
				@endauth
			</strong>
		</p>
		<div class="btn-group" role="group" aria-label="Basic example">
			<a href="{{ URL::previous() }}">
				<button type="button" class="btn btn-warning">Regresar Atrás</button>
			</a>
		</div>
	</div>
</div>
@endsection