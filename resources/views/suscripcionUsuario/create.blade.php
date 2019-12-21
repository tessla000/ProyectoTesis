@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="jumbotron text-center">
		<h1>Añadir Nueva Suscripcion</h1>
		<hr>
		<form action="{{ route('suscripcionUsuario.store') }}" method="POST">
			@csrf
			<div class="form-group">
				<label for="suscripcion_id">Suscripcion</label>
				<select name="suscripcion_id" class="form-control">
					@foreach($suscripcion as $suscripcion)
					<option value="{{ $suscripcion->suscripcion_id }}" {{ $suscripcion->suscripcion_id == $suscripcionUsuario->suscripcion_id ? 'selected' : ''}}>{{ $suscripcion->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="usuario_id">Usuario</label>
				<select name="usuario_id" class="form-control">
					@foreach($usuario as $usuario)
					<option value="{{ $usuario->usuario_id }}" {{ $usuario->usuario_id == $suscripcionUsuario->usuario_id ? 'selected' : ''}}>{{ $usuario->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="fecha_inicio">Fecha Inicio Suscripcion</label>
				<input type="text" id="datepicker1" name="fecha_inicio">
			</div>
			<div class="form-group">
				<label for="fecha_inicio">Fecha Inicio Suscripcion</label>
				<input type="text" id="datepicker2" name="fecha_termino">
			</div>
			@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			<button type="submit" class="btn btn-primary">Submit</button>
			<div class="btn-group" role="group" aria-label="Basic example">
				<a href="{{ route('suscripcion.index') }}">
					<button type="button" class="btn btn-warning">Regresar Atrás</button>
				</a>
			</div>
		</form>
	</div>
</div>
<script>
	$(function(){
		$("#datepicker1").datepicker(
			{ dateFormat: 'yy-mm-dd' });
		$("#datepicker2").datepicker(
			{ dateFormat: 'yy-mm-dd' });
	});
</script>
@endsection