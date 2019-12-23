@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="jumbotron text-center">
		<h1>Mostrando Rol {{ $rol->name }}</h1>
		<p>
			<strong>Id:</strong> {{ $rol->rol_id }}<br>
			<strong>Nombre:</strong> {{ $rol->name }}<br>
			<strong>Descripcion:</strong> {{ $rol->descripcion }}
		</p>
		<div class="btn-group" role="group" aria-label="Basic example">
			<a href="{{ route('rol.index') }}">
				<button type="button" class="btn btn-warning">Regresar Atrás</button>
			</a>
		</div>
	</div>
</div>
@endsection