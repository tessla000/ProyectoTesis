@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="jumbotron text-center">
		<h1>Editar</h1>
		<hr>
		<form action="{{ route('usuario.update', ['usuario' => $usuario]) }}" method="POST">
			@csrf
			@method('PATCH')
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" value="{{ old('name', $usuario->name) }}" class="form-control" name="name" >
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="text" value="{{ old('email', $usuario->email) }}" class="form-control" name="email" >
			</div>
			{{-- <div class="form-group">
				<label for="password">Contraseña</label>
				<input type="text" value="{{ old('password', $usuario->password) }}" class="form-control" name="password" >
			</div> --}}
			<div class="form-group">
				<label for="confirmed">Confirmación Cliente</label>
				<select name="confirmed" class="form-control">
					<option value="0">Inactivo</option>
					<option value="1">Activo</option>
				</select>
			</div>
			<div class="form-group">
				<label for="rol_id">Rol</label>
				<select name="rol_id" class="form-control">
					@foreach($rol as $rol)
					<option value="{{ $rol->rol_id }}" {{ $rol->rol_id == $usuario->rol_id ? 'selected' : ''}}>{{ $rol->name }}</option>
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
				<a href="{{ route('usuario.index') }}">
					<button type="button" class="btn btn-warning">Regresar Atrás</button>
				</a>
			</div>
		</form>
	</div>
</div>
@endsection