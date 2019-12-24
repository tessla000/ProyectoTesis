@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="jumbotron text-center">
		<h1>Mostrando Envio</h1>
		<p>
			<strong>Codigo Seguimiento:</strong> {{ $envio->codigoSeguimiento }}<br>
			<strong>Direccion:</strong> {{ $envio->direccion ? $envio->direccion->direccion1 :'' }}<br>
			<strong>Buy Order:</strong> {{ $envio->transaccion ? $envio->transaccion->buyOrder : ''}}<br>
		<div class="btn-group" role="group" aria-label="Basic example">
			<a href="{{ route('transaccion.index') }}">
				<button type="button" class="btn btn-warning">Regresar Atrás</button>
			</a>
		</div>
	</div>
</div>
@endsection