@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<section class="jumbotron text-center">
		<div class="container">
			<h1 class="jumbotron-heading">Datos de Compra</h1>
			<strong>Amount:</strong> {{ $transaccion->amount }}<br>
			<strong>Authorization Code:</strong> {{ $transaccion->authorizationCode }}<br>
			<strong>Response Code:</strong> {{ $transaccion->responseCode }}<br>
		</div>
	</section>
</div>
@endsection