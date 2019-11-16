@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
	<div class="jumbotron text-center">
		<h1>Editar</h1>
		<hr>
		<form action="{{ route('producto.update', ['producto' => $producto]) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PATCH')
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" value="{{ old('name', $producto->name) }}" class="form-control" name="name" >
			</div>
			<div class="form-group">
				<label for="valor">Valor</label>
				<input type="text" value="{{ old('valor', $producto->valor) }}" class="form-control" name="valor" >
			</div>
			<div class="form-group">
				<label for="stock">Stock</label>
				<input type="text" value="{{ old('stock', $producto->stock) }}" class="form-control" name="stock" >
			</div>
			<div class="form-group">
				<label for="descripcion">Descripcion</label>
				<input type="text" value="{{ old('descripcion', $producto->descripcion) }}" class="form-control" name="descripcion" >
			</div>
			<div class="form-group">
				<label for="categoria_id">Categoria</label>
				<select name="categoria_id" class="form-control">
					@foreach($categoria as $categoria)
					<option value="{{ $categoria->categoria_id }}" {{ $categoria->categoria_id == $producto->categoria_id ? 'selected' : ''}}>{{ $categoria->name }}</option>
					@endforeach
				</select><br>
			</div>
			<div class="form-group">
				<label for="marca_id">Marca</label>
				<select name="marca_id" class="form-control">
					@foreach($marca as $marca)
					<option value="{{ $marca->marca_id }}" {{ $marca->marca_id == $producto->marca_id ? 'selected' : ''}}>{{ $marca->name }}</option>
					@endforeach
				</select><br>
			</div>
			<div class="form-group">
				<label for="image">Imagen</label><br>
				<input type="file" class="py-2" name="image">
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
				<a href="{{ route('producto.index') }}">
					<button type="button" class="btn btn-warning">Regresar Atrás</button>
				</a>
			</div>
		</form>
	</div>
</div>
@endsection