@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="jumbotron text-center">
		<h1>Editar Envio</h1>
		<hr>
		<form action="{{ route('envio.update', ['envio' => $envio]) }}" method="POST">
			@csrf
			@method('PATCH')
			<div class="form-group">
				<label for="codigoSeguimiento">Codigo Seguimiento</label>
				<input type="text" value="{{ old('codigoSeguimiento', $envio->codigoSeguimiento) }}" class="form-control" name="codigoSeguimiento" >
			</div>
			<div class="form-group">
				<label for="estado">Estado</label>
				<input type="text" value="{{ old('estado', $envio->estado) }}" class="form-control" name="estado" >
			</div>
			<div class="form-group">
				<label for="direccion_id">Direccion</label>
				<input type="text" disabled value="{{ old('direccion_id', $envio->direccion->direccion1) }}" class="form-control" name="direccion_id" >
			</div>
			<div class="form-group">
				<label for="transaccion_id">Estado</label>
				<input type="text" disabled value="{{ old('transaccion_id', $envio->transaccion->buyOrder) }}" class="form-control" name="transaccion_id" >
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
				<a href="{{ route('envio.index') }}">
					<button type="button" class="btn btn-warning">Regresar Atrás</button>
				</a>
			</div>
		</form>
	</div>
</div>
@endsection