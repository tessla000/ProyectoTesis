@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="jumbotron text-center">
		<h1>Mostrando {{ $suscripcion->name }}</h1>
		<p>
			<strong>Nombre:</strong> {{ $suscripcion->name }}<br>
			<strong>Cantidad De Productos:</strong> {{ $suscripcion->cantidad_productos }}
		</p>
		<div class="btn-group" role="group" aria-label="Basic example">
			<a href="{{ route('suscripcion.index') }}">
				<button type="button" class="btn btn-warning">Regresar Atrás</button>
			</a>
		</div>
	</div>
</div>
@endsection