@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="jumbotron text-center">
		<h1>Mostrando Datos {{ $info->name }}</h1>
		<p>
			<strong>Rut:</strong> {{ $info->rut }}<br>
			<strong>Nombre:</strong> {{ $info->name }}<br>
			<strong>Apellido:</strong> {{ $info->lastname }}<br>
			<strong>Usuario:</strong> {{ $info->usuario ? $info->usuario->name : 'Usuario No Asignado' }}<br>
		</p>
		<div class="btn-group" role="group" aria-label="Basic example">
			<a href="{{ route('info.index') }}">
				<button type="button" class="btn btn-warning">Regresar Atrás</button>
			</a>
		</div>
	</div>
</div>
@endsection