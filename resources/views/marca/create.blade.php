@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="jumbotron text-center">
		<h1>Añadir Nueva Marca</h1>
		<hr>
		<form action="{{ route('marca.store') }}" method="post">
			@csrf
			<div class="form-group">
				<label for="title">Name</label>
				<input type="text" class="form-control" name="name">
			</div>
			<div class="form-group">
				<label for="descripcion">Descripcion</label>
				<input type="text" class="form-control" name="descripcion">
			</div>
			@auth
			@if(Auth::user()->rol_id == 1)
			<div class="form-group">
				<label for="usuario_id">Usuario</label>
				<select name="usuario_id" class="form-control">
					@foreach($usuario as $usuario)
					<option value="{{ $usuario->usuario_id }}" {{ $usuario->usuario_id == $marca->usuario_id ? 'selected' : ''}}>{{ $usuario->name }}</option>
					@endforeach
				</select><br>
			</div>
			@endif
			@endauth
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
				<a href="{{ route('marca.index') }}">
					<button type="button" class="btn btn-warning">Regresar Atrás</button>
				</a>
			</div>
		</form>
	</div>
</div>
@endsection