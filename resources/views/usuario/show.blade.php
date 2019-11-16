@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="jumbotron text-center">
		<h1>Mostrando Usuario {{ $usuario->name }}</h1>
		<p>
			<strong>Nombre:</strong> {{ $usuario->name }}<br>
			<strong>Email:</strong> {{ $usuario->email }}<br>
			<strong>Rol:</strong> {{ $usuario->rol ? $usuario->rol->name : 'Sin Rol' }}<br>
			<strong>Confirmación:</strong> {{ $usuario->confirmed }}<br>
		</p>
		<div class="btn-group" role="group" aria-label="Basic example">
			<a href="{{ route('usuario.index') }}">
				<button type="button" class="btn btn-warning">Regresar Atrás</button>
			</a>
		</div>
	</div>
</div>
@endsection