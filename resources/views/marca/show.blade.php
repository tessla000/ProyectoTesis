@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="jumbotron text-center">
		<h1>Mostrando Marca {{ $marca->name }}</h1>
		<p>
			<strong>Nombre:</strong> {{ $marca->name }}<br>
			<strong>Descripcion:</strong> {{ $marca->descripcion }}
		</p>
		<div class="btn-group" role="group" aria-label="Basic example">
			<a href="{{ route('marca.index') }}">
				<button type="button" class="btn btn-warning">Regresar Atrás</button>
			</a>
		</div>
	</div>
</div>
@endsection