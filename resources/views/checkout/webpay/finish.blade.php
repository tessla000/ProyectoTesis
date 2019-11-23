@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<section class="jumbotron text-center">
		<div class="container">
			<h1 class="jumbotron-heading">Datos de Compra</h1>
			<strong id="amount">Amount:</strong> {{ $transaccion->amount }}<br>
			<strong id="authorizationCode">Authorization Code:</strong> {{ $transaccion->authorizationCode }}<br>
			<strong id="responseCode">Response Code:</strong> {{ $transaccion->responseCode }}<br>
		</div>
	</section>
</div>
@endsection