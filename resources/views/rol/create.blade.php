@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="jumbotron text-center">
		<h1>Añadir Nueva Rol</h1>
		<hr>
		<form action="{{ route('rol.store') }}" method="post">
			@csrf
			<div class="form-group">
				<label for="rol_id">Id</label>
				<input type="text" class="form-control" name="rol_id">
			</div>
			<div class="form-group">
				<label for="name">Nombre</label>
				<input type="text" class="form-control" name="name">
			</div>
			<div class="form-group">
				<label for="descripcion">Descripcion</label>
				<input type="text" class="form-control" name="descripcion">
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
				<a href="{{ route('rol.index') }}">
					<button type="button" class="btn btn-warning">Regresar Atrás</button>
				</a>
			</div>
		</form>
	</div>
</div>
@endsection