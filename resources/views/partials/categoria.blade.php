<div class="list-group">
	<button type="button" class="list-group-item list-group-item-action active">Categorias</button>
	@foreach($categoriaC as $categoria)
	<a href="{{ route('producto.index', ['categoria' => $categoria]) }}" class="list-group-item list-group-item-action">{{$categoria->name}}</a>
	@endforeach
</div>
{{-- <nav class="nav flex-column">
	<a class="nav-link disabled" href="#">Categorias</a>
	@foreach($categoriaC as $categoria)
	<a class="nav-link" href="{{ route('producto.index', ['categoria' => $categoria->categoria_id]) }}">{{$categoria->name}}</a>
	@endforeach
</nav> --}}