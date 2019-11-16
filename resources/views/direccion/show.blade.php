@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="jumbotron text-center">
		<h1>Mostrando Direccion {{ $direccion->name }}</h1>
		<p>
			<strong>Rut:</strong> {{ $direccion->rut }}<br>
			<strong>Nombre:</strong> {{ $direccion->name }}<br>
			<strong>Apellido:</strong> {{ $direccion->lastname }}<br>
			<strong>Codigo Postal:</strong> {{ $direccion->codigoPostal }}<br>
			<strong>Direccion:</strong> {{ $direccion->direccion1 }}<br>
			<strong>Descripcion:</strong> {{ $direccion->descripcion }}<br>
			<strong>Comuna:</strong> {{ $direccion->comuna ? $direccion->comuna->name : 'Comuna No Asignada' }}<br>
			<strong>Usuario:</strong> {{ $direccion->usuario ? $direccion->usuario->name : 'Usuario No Asignado' }}<br>
		</p>
		<div class="btn-group" role="group" aria-label="Basic example">
			<a href="{{ route('direccion.index') }}">
				<button type="button" class="btn btn-warning">Regresar Atrás</button>
			</a>
		</div>
	</div>
</div>
@endsection