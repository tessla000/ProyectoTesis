@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="jumbotron text-center">
		<h1>Mostrando Categoria {{ $categoria->name }}</h1>
		<p>
			<strong>Nombre:</strong> {{ $categoria->name }}<br>
			<strong>Descripcion:</strong> {{ $categoria->descripcion }}
		</p>
		<div class="btn-group" role="group" aria-label="Basic example">
			<a href="{{ URL::previous() }}">
				<button type="button" class="btn btn-warning">Regresar Atrás</button>
			</a>
		</div>
	</div>
</div>
@endsection