@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="jumbotron text-center">
		<h1>Añadir Datos Envio</h1>
		<hr>
		<form action="{{ route('envio.store') }}" method="post">
			@csrf
			<div class="form-group">
				<label for="transaccion_id">Transaccion</label>
				<select name="transaccion_id" class="form-control">
					@foreach($transaccion as $transaccion)
					<option value="{{ $transaccion->transaccion_id }}" {{ $transaccion->transaccion_id == $envio->transaccion_id ? 'selected' : ''}}>{{ $transaccion->buyOrder }}</option>
					@endforeach
				</select><br>
			</div>
			<div class="form-group">
				<label for="direccion_id">Direccion</label>
				<select name="direccion_id" class="form-control">
					@foreach($direccion as $direccion)
					<option value="{{ $direccion->direccion_id }}" {{ $direccion->direccion_id == $envio->direccion_id ? 'selected' : ''}}>{{ $direccion->direccion1 }}, {{ $direccion->comuna->name }}, {{ $direccion->comuna->codigoPostal }}</option>
					@endforeach
				</select><br>
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
				<a href="{{ route('transaccion.index') }}">
					<button type="button" class="btn btn-warning">Regresar Atrás</button>
				</a>
			</div>
		</form>
	</div>
</div>
@endsection