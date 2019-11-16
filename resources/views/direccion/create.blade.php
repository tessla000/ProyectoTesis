@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="jumbotron text-center">
		<h1>Añadir Nueva Direccion</h1>
		<hr>
		<form action="{{ route('direccion.store') }}" method="POST" >
			@csrf
			<div class="form-group">
				<label for="rut">Rut</label>
				<input type="text" class="form-control" name="rut">
			</div>
			<div class="form-group">
				<label for="name">Nombre</label>
				<input type="text" class="form-control" name="name">
			</div>
			<div class="form-group">
				<label for="lastname">Apellido</label>
				<input type="text" class="form-control" name="lastname">
			</div>
			<div class="form-group">
				<label for="codigoPostal">Codigo Postal</label>
				<input type="text" class="form-control" name="codigoPostal">
			</div>
			<div class="form-group">
				<label for="direccion1">Direccion</label>
				<input type="text" class="form-control" name="direccion1">
			</div>
			<div class="form-group">
				<label for="descripcion">Descripcion</label>
				<input type="text" class="form-control" name="descripcion">
			</div>
			<div class="form-group">
				<label for="comuna_id">Comuna</label>
				<select name="comuna_id" class="form-control">
					@foreach($comuna as $comuna)
					<option value="{{ $comuna->comuna_id }}" {{ $comuna->comuna_id == $direccion->comuna_id ? 'selected' : ''}}>{{ $comuna->name }}</option>
					@endforeach
				</select><br>
			</div>
			@auth
			@if(Auth::user()->rol_id == 1)
			<div class="form-group">
				<label for="usuario_id">Usuario</label>
				<select name="usuario_id" class="form-control">
					@foreach($usuario as $usuario)
					<option value="{{ $usuario->usuario_id }}" {{ $usuario->usuario_id == $direccion->usuario_id ? 'selected' : ''}}>{{ $usuario->name }}</option>
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
				<a href="{{ route('direccion.index') }}">
					<button type="button" class="btn btn-warning">Regresar Atrás</button>
				</a>
			</div>
		</form>
	</div>
</div>
@endsection