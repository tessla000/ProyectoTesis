@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="jumbotron text-center">
		<h1>Editar</h1>
		<hr>
		<form action="{{ route('rol.update', ['rol' => $rol]) }}" method="POST">
			<input type="hidden" name="_method" value="PUT">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="rol_id">Id</label>
				<input type="text" value="{{old('rol_id', $rol->rol_id)}}" class="form-control" name="rol_id" >
			</div>
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" value="{{old('name', $rol->name)}}" class="form-control" name="name" >
			</div>
			<div class="form-group">
				<label for="descripcion">Descripcion</label>
				<input type="text" value="{{old('descripcion', $rol->descripcion)}}" class="form-control" name="descripcion" >
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